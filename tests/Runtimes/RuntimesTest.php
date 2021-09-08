<?php

namespace Appwrite\Tests;

use Appwrite\Runtimes\Runtimes;
use PHPUnit\Framework\TestCase;
use Utopia\CLI\Console;
use Utopia\Orchestration\Orchestration;
use Utopia\Orchestration\Adapter\DockerAPI;

class RuntimesTest extends TestCase
{
    public $tests;
    /** @var Runtimes $instance */
    public $instance;
    public $functionsDir;
    public $orchestration = new Orchestration(new DockerAPI());

    public function setUp(): void
    {
        $this->functionsDir = $functionsDir = realpath(__DIR__ . '/../resources');
        $this->tests = [
            'node-14.5' => [
                'code' => $functionsDir . '/node.tar.gz',
                'entrypoint' => 'index.js',
                'timeout' => 15,
                'runtime' => 'node-14.5'
            ],
            'node-15.5' => [
                'code' => $functionsDir . '/node.tar.gz',
                'entrypoint' => 'index.js',
                'timeout' => 15,
                'runtime' => 'node-15.5'
            ],
            'node-16' => [
                'code' => $functionsDir . '/node.tar.gz',
                'entrypoint' => 'index.js',
                'timeout' => 15,
                'runtime' => 'node-16'
            ],
            'php-8.0' => [
                'code' => $functionsDir . '/php.tar.gz',
                'entrypoint' => 'index.php',
                'timeout' => 15,
                'runtime' => 'php-8.0'
            ],
            'python-3.9' => [
                'code' => $functionsDir . '/python.tar.gz',
                'entrypoint' => 'main.py',
                'timeout' => 15,
                'runtime' => 'python-3.9'
            ],
            'deno-1.13' => [
                'code' => $functionsDir . '/deno.tar.gz',
                'entrypoint' => 'index.ts',
                'timeout' => 15,
                'runtime' => 'deno-1.11'
            ]
        ];
        $this->instance = new Runtimes();
        $this->tests = array_filter($this->tests, function($test) {
            return array_key_exists($test['runtime'], $this->instance->getAll());
        });
    }

    public function tearDown(): void
    {
    }

    public function testSupportedRuntimes()
    {
        $this->assertNotEmpty($this->instance->get('node'));
        $this->assertNotEmpty($this->instance->getAll());
        $this->assertNotEmpty($this->instance->getAll(supported: false));
        $this->assertCount(1, $this->instance->getAll(filter: ['node-14.5']));
        $this->assertCount(1, $this->instance->getAll(filter: ['node-14.5', 'unknown']));
        $this->assertCount(2, $this->instance->getAll(filter: ['node-14.5', 'node-15.5']));
    }

    public function testGetRuntimes()
    {
        foreach ($this->instance->getAll() as $runtime) {
            $this->assertArrayHasKey('name', $runtime, $runtime['name']);
            $this->assertArrayHasKey('version', $runtime, $runtime['name']);
            $this->assertArrayHasKey('base', $runtime, $runtime['name']);
            $this->assertArrayHasKey('image', $runtime, $runtime['name']);
            $this->assertArrayHasKey('logo', $runtime, $runtime['name']);
            $this->assertArrayHasKey('supports', $runtime, $runtime['name']);

            $this->assertIsArray($runtime['supports']);
            $this->assertNotEmpty($runtime['supports']);
        }
    }

    /**
     * @depends testGetRuntimes
     */
    public function testPullRuntimes()
    {
        $stdout = $stderr = '';
        foreach ($this->instance->getAll() as $runtime) {
            Console::execute("docker pull {$runtime['image']}", '', $stdout, $stderr);
            Console::log($stderr ? $stderr : $stdout);
            $this->assertEmpty($stderr);
            $this->assertNotEmpty($stdout);
        }
    }

    /**
     * @depends testPullRuntimes
     */
    public function testRunRuntimes()
    {
        $stdout = $stderr = '';

        foreach ($this->tests as $key => $test) {
            $containerID = $this->orchestration->run(image: [$test['runtime']]['image'], 
                name: $key,
                workdir: '/usr/local/src',
                volumes: [
                    $this->functionsDir => "/{$this->functionsDir}:rw"
                ]);

            $this->orchestration->execute($containerID, 
                ['sh', '-c', "cp {$test['code']} /usr/local/src/code.tar.gz && tar -zxf /usr/local/src/code.tar.gz --strip 1 && rm /usr/local/src/code.tar.gz"],
                $stdout, $stderr);
        }
    }

    /**
     * @depends testRunRuntimes
     */
    public function testExecRuntimes()
    {
        $stdout = $stderr = '';
        $vars = [
            'APPWRITE_FUNCTION_ID' => 'id',
            'APPWRITE_FUNCTION_NAME' => 'name',
            'APPWRITE_FUNCTION_TAG' => 'tag',
            'APPWRITE_FUNCTION_TRIGGER' => 'trigger',
            'APPWRITE_FUNCTION_ENV_NAME' => 'env_name',
            'APPWRITE_FUNCTION_ENV_VERSION' => 'env_version',
            'APPWRITE_FUNCTION_EVENT' => 'event',
            'APPWRITE_FUNCTION_EVENT_DATA' => 'event_data',
            'APPWRITE_ENDPOINT' => 'endpoint',
            'APPWRITE_PROJECT' => 'project',
            'APPWRITE_SECRET' => 'secret',
        ];

        \array_walk($vars, function (&$value, $key) {
            $value = \escapeshellarg((empty($value)) ? 'null' : $value);
            $value = "--env {$key}={$value}";
        });
        Console::log('');
        foreach ($this->tests as $key => $test) {
            Console::execute("docker exec " . \implode(" ", $vars) . " {$key} {$test['command']}", '', $stdout, $stderr, $test['timeout']);
            $this->assertNotEmpty($stdout);

            $output = explode("\n", $stdout);
            $this->assertEquals('id', $output[0]);
            $this->assertEquals('name', $output[1]);
            $this->assertEquals('tag', $output[2]);
            $this->assertEquals('trigger', $output[3]);
            $this->assertEquals('env_name', $output[4]);
            $this->assertEquals('env_version', $output[5]);
            $this->assertEquals('event', $output[6]);
            $this->assertEquals('event_data', $output[7]);
            Console::execute("docker rm -f {$key}", '', $stdout, $stderr, 30);
            Console::log('✅ ' . $key);
        }
    }
}

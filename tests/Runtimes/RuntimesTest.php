<?php

namespace Appwrite\Tests;

use Appwrite\Runtimes\Runtimes;
use PHPUnit\Framework\TestCase;
use Utopia\CLI\Console;

class RuntimesTest extends TestCase
{
    public $runtimes;
    /** @var Runtimes $instance */
    public $instance;
    public $functionsDir;

    public function setUp(): void
    {
        $this->functionsDir = $functionsDir = realpath(__DIR__ . '/../resources');
        $this->runtimes = [
            'node-14.5' => [
                'code' => $functionsDir . '/node.tar.gz',
                'command' => 'node index.js',
                'timeout' => 15,
            ],
            'node-15.5' => [
                'code' => $functionsDir . '/node.tar.gz',
                'command' => 'node index.js',
                'timeout' => 15,
            ],
            'php-7.4' => [
                'code' => $functionsDir . '/php.tar.gz',
                'command' => 'php index.php',
                'timeout' => 15,
            ],
            'php-8.0' => [
                'code' => $functionsDir . '/php.tar.gz',
                'command' => 'php index.php',
                'timeout' => 15,
            ],
            'ruby-2.7' => [
                'code' => $functionsDir . '/ruby.tar.gz',
                'command' => 'ruby app.rb',
                'timeout' => 15,
            ],
            'ruby-3.0' => [
                'code' => $functionsDir . '/ruby.tar.gz',
                'command' => 'ruby app.rb',
                'timeout' => 15,
            ],
            'python-3.8' => [
                'code' => $functionsDir . '/python.tar.gz',
                'command' => 'python main.py',
                'timeout' => 15,
            ],
            'python-3.9' => [
                'code' => $functionsDir . '/python.tar.gz',
                'command' => 'python main.py',
                'timeout' => 15,
            ],
            'deno-1.2' => [
                'code' => $functionsDir . '/deno.tar.gz',
                'command' => 'deno run --allow-env index.ts',
                'timeout' => 15,
            ],
            'deno-1.5' => [
                'code' => $functionsDir . '/deno.tar.gz',
                'command' => 'deno run --allow-env index.ts',
                'timeout' => 15,
            ],
            'deno-1.6' => [
                'code' => $functionsDir . '/deno.tar.gz',
                'command' => 'deno run --allow-env index.ts',
                'timeout' => 15,
            ],
            'deno-1.8' => [
                'code' => $functionsDir . '/deno.tar.gz',
                'command' => 'deno run --allow-env index.ts',
                'timeout' => 15,
            ],
            'dart-2.10' => [
                'code' => $functionsDir . '/dart.tar.gz',
                'command' => 'dart main.dart',
                'timeout' => 15,
            ],
            'dart-2.12' => [
                'code' => $functionsDir . '/dart.tar.gz',
                'command' => 'dart main.dart',
                'timeout' => 15,
            ],
            'dotnet-3.1' => [
                'code' => $functionsDir . '/dotnet-3.1.tar.gz',
                'command' => 'dotnet dotnet.dll',
                'timeout' => 15,
            ],
            'dotnet-5.0' => [
                'code' => $functionsDir . '/dotnet-5.0.tar.gz',
                'command' => 'dotnet dotnet.dll',
                'timeout' => 15,
            ]
        ];
        $this->instance = new Runtimes();
        foreach ($this->runtimes as $key => $env) {
            if (array_key_exists($key, $this->instance->getAll())) {
                $this->runtimes[$key] = array_merge($env, $this->instance->getAll()[$key]);
            } else {
                unset($this->runtimes[$key]);
            }
        }
    }

    public function tearDown(): void
    {
    }

    public function testSupportedRuntimes()
    {
        $this->assertNotEmpty($this->instance->get('node'));
        $this->assertNotEmpty($this->instance->getAll());
        $this->assertCount(15, $this->instance->getAll(supported: false));
        $this->assertCount(1, $this->instance->getAll(filter: ['node-14.5']));
        $this->assertCount(1, $this->instance->getAll(filter: ['node-14.5', 'unknown']));
        $this->assertCount(2, $this->instance->getAll(filter: ['node-14.5', 'node-15.5']));
    }

    public function testGetRuntimes()
    {
        foreach ($this->runtimes as $runtime) {
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
        foreach ($this->runtimes as $runtime) {
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

        foreach ($this->runtimes as $container => $runtime) {
            Console::execute(
                "docker run -d --name={$container} --workdir /usr/local/src --volume {$this->functionsDir}:/{$this->functionsDir}:rw" .
                    " {$runtime['image']}" .
                    " sh -c 'cp {$runtime['code']} /usr/local/src/code.tar.gz && tar -zxf /usr/local/src/code.tar.gz --strip 1 && rm /usr/local/src/code.tar.gz && tail -f /dev/null'",
                '',
                $stdout,
                $stderr
            );
            Console::log($container . ' : ' . ($stderr ? $stderr : $stdout));
            $this->assertEmpty($stderr);
            $this->assertNotEmpty($stdout);
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
        foreach ($this->runtimes as $container => $runtime) {
            Console::execute("docker exec " . \implode(" ", $vars) . " {$container} {$runtime['command']}", '', $stdout, $stderr, $runtime['timeout']);
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
            Console::execute("docker rm -f {$container}", '', $stdout, $stderr, 30);
            Console::log('✅ ' . $container);
        }
    }
}

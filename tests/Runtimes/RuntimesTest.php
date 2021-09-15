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
    public $tempDir;
    public $orchestration;
    public $hostDirectory;

    public function setUp(): void
    {
        $this->hostDirectory = getenv('CURRENT_DIR');
        $this->functionsDir = $functionsDir = $this->hostDirectory . '/tests/resources';
        $this->tempDir = $tempDir = realpath('/tmp/builtCode');

        $this->tests = [
            'node-14.5' => [
                'code' => $functionsDir . '/node.tar.gz',
                'entrypoint' => 'index.js',
                'timeout' => 15,
                'runtime' => 'node-14.5',
                'buildCommand' => ['npm', 'install'],
                'tarname' => 'node-14-5.tar.gz',
                'filename' => 'index.js'
            ],
            'node-15.5' => [
                'code' => $functionsDir . '/node.tar.gz',
                'entrypoint' => 'index.js',
                'timeout' => 15,
                'runtime' => 'node-15.5',
                'buildCommand' => ['npm', 'install'],
                'tarname' => 'node-15-5.tar.gz',
                'filename' => 'index.js'
            ],
            'node-16' => [
                'code' => $functionsDir . '/node.tar.gz',
                'entrypoint' => 'index.js',
                'timeout' => 15,
                'runtime' => 'node-16.0',
                'buildCommand' => ['npm', 'install'],
                'tarname' => 'node-16.tar.gz',
                'filename' => 'index.js'
            ],
            'php-8.0' => [
                'code' => $functionsDir . '/php.tar.gz',
                'entrypoint' => 'index.php',
                'timeout' => 15,
                'runtime' => 'php-8.0',
                'buildCommand' => ['composer', 'install'],
                'tarname' => 'php-8-0.tar.gz',
                'filename' => 'index.php'
            ],
            'python-3.8' => [
                'code' => $functionsDir . '/python.tar.gz',
                'entrypoint' => 'main.py',
                'timeout' => 15,
                'runtime' => 'python-3.8',
                'buildCommand' => ['pip', 'install'],
                'tarname' => 'python-3-8.tar.gz',
                'filename' => 'index.py'
            ],
            'python-3.9' => [
                'code' => $functionsDir . '/python.tar.gz',
                'entrypoint' => 'main.py',
                'timeout' => 15,
                'runtime' => 'python-3.9',
                'buildCommand' => ['pip', 'install'],
                'tarname' => 'python-3-9.tar.gz',
                'filename' => 'index.py'
            ],
            'deno-1.13' => [
                'code' => $functionsDir . '/deno.tar.gz',
                'entrypoint' => 'index.ts',
                'timeout' => 15,
                'runtime' => 'deno-1.13',
                'tarname' => 'deno-1-13.tar.gz',
                'filename' => 'index.ts'
            ]
        ];
        $this->orchestration = new Orchestration(new DockerAPI());
        $this->instance = new Runtimes();
        $this->tests = array_filter($this->tests, function ($test) {
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
    // public function testPullRuntimes()
    // {
    //     $stdout = $stderr = '';
    //     foreach ($this->instance->getAll() as $runtime) {
    //         Console::execute("docker pull {$runtime['image']}", '', $stdout, $stderr);
    //         Console::log($stderr ? $stderr : $stdout);
    //         $this->assertEmpty($stderr);
    //         $this->assertNotEmpty($stdout);
    //     }
    // }

    public function testRunBuildCommand()
    {
        foreach ($this->tests as $key => $test) {
            // Get runtime
            $runtime = $this->instance->getAll()[$test['runtime']];

            // Check if runtime has a build command
            if (empty($runtime['buildCommand'])) {
                // Copy code to temp dir
                $code = $this->tempDir . '/' . $test['tarname'];
                copy($test['code'], $code);
                return;
            }

            // Create build container
            $id = $this->orchestration->run(
                image: $runtime['base'],
                name: 'build-container',
                workdir: '/usr/code',
                command: [
                    'tail',
                    '-f',
                    '/dev/null'
                ],
                volumes: [
                    $test['code'] . ":/tmp/code.tar.gz",
                    $this->tempDir . ":/tmp/builtCode:rw"
                ]
            );

            // Extract Code
            $untarStdout = '';
            $untarStderr = '';

            $untarSuccess = $this->orchestration->execute(
                name: 'build-container',
                command: [
                    'sh',
                    '-c',
                    'mkdir -p /usr/code && cp /tmp/code.tar.gz /usr/code.tar.gz && cd /usr && tar -zxf /usr/code.tar.gz -C /usr/code && rm /usr/code.tar.gz'
                ],
                stdout: $untarStdout,
                stderr: $untarStderr,
                timeout: 60
            );

            $this->assertEquals(true, $untarSuccess);
            $this->assertEmpty($untarStderr);

            // Build Code / Install Dependencies
            $buildStdout = '';
            $buildStderr = '';

            $buildSuccess = $this->orchestration->execute(
                name: 'build-container',
                command: $runtime['buildCommand'],
                stdout: $buildStdout,
                stderr: $buildStderr,
                timeout: 60
            );

            $this->assertEquals(true, $buildSuccess);

            // Repackage Code and Save.
            $compressStdout = '';
            $compressStderr = '';

            $builtCodePath = $this->tempDir.'/'.$test['tarname'];

            $compressSuccess = $this->orchestration->execute(
                name: 'build-container',
                command: [
                    'sh',
                    '-c',
                    'rm -f /tmp/builtCode/'.$test['tarname'].' && cd /usr/code && tar -czvf /tmp/builtCode/'.$test['tarname'].' .'
                ],
                stdout: $compressStdout,
                stderr: $compressStderr,
                timeout: 60
            );

            $this->assertEquals(true, $compressSuccess);
            $this->assertEquals(true, file_exists($builtCodePath));
            $this->assertEmpty($compressStderr);

            // Remove container
            $this->orchestration->remove($id, true);
        }
    }

    /**
     * @depends testRunBuildCommand
     */
    public function testRunRuntimes()
    {
        $stdout = $stderr = '';
        foreach ($this->tests as $key => $test) {
            $runtime = $this->instance->getAll()[$test['runtime']];
            $containerID = $this->orchestration->run(
                image: $runtime['image'],
                name: $key,
                hostname: $key,
                volumes: [
                    $this->tempDir.'/'.$test['tarname'].":/tmp/code.tar.gz"
                ]
            );

            $this->assertNotFalse($containerID);

            $this->assertNotFalse($this->orchestration->networkConnect($containerID, 'php-runtimes_runtime-tests'));

            $this->orchestration->execute(
                $containerID,
                ['sh', '-c', "mkdir -p /usr/code && cp /tmp/code.tar.gz /usr/code.tar.gz && cd /usr && tar -zxf /usr/code.tar.gz -C /usr/code && rm /usr/code.tar.gz"],
                $stdout,
                $stderr
            );

            // Wait for server to launch
            sleep(5);

            // Make a test execution
            $ch = \curl_init();
            \curl_setopt($ch, CURLOPT_URL, "http://" . $key . ":3000/");
            \curl_setopt($ch, CURLOPT_POST, true);
            \curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
                'path' => '/usr/code',
                'file' => $test['filename'],
                'env' => [
                    'ENV1' => 'Hello World!'
                ],
                'payload' => 'Hello World! 2',
                'timeout' => 60
            ]));
    
            \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            \curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            \curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    
            $executorResponse = \curl_exec($ch);
    
            $error = \curl_error($ch);
    
            $errNo = \curl_errno($ch);

            // Remove container
            $this->orchestration->remove($containerID, true);

            $response = json_decode($executorResponse, true);

            $this->assertEquals('Hello World!', $response['normal']);
            $this->assertEquals('Hello World! 2', $response['payload']);
            $this->assertEquals('Hello World!', $response['env1']);
        }
    }
}

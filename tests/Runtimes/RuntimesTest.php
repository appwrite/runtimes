<?php

namespace Appwrite\Tests;

use Appwrite\Runtimes\Runtimes;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use PHPUnit\Framework\TestCase;
use Utopia\Orchestration\Orchestration;
use Utopia\Orchestration\Adapter\DockerAPI;
use Utopia\System\System;

class RuntimesTest extends TestCase
{
    public array $tests;
    public Runtimes $instance;
    public string $functionsDir;
    public string $tempDir;
    public Orchestration $orchestration;
    public string $hostDirectory;

    public function setUp(): void
    {
        $this->hostDirectory = getenv('CURRENT_DIR');
        $this->functionsDir = $functionsDir = $this->hostDirectory . '/tests/resources';

        $this->tempDir = realpath('/tmp/builtCode');

        $this->tests = [
            // 'java-16.0' => [
            //     'code' => $functionsDir . '/java.tar.gz',
            //     'entrypoint' => 'index.jar',
            //     'timeout' => 15,
            //     'runtime' => 'java-16.0',
            //     'tarname' => 'java-16-0.tar.gz',
            // ],
            'dart-2.12' => [
                'code' => $functionsDir . '/dart.tar.gz',
                'entrypoint' => 'index.dart',
                'timeout' => 15,
                'runtime' => 'dart-2.12',
                'tarname' => 'dart-2-12.tar.gz',
                'filename' => 'index.dart',
            ],
            'dart-2.13' => [
                'code' => $functionsDir . '/dart.tar.gz',
                'entrypoint' => 'index.dart',
                'timeout' => 15,
                'runtime' => 'dart-2.13',
                'tarname' => 'dart-2-13.tar.gz',
                'filename' => 'index.dart',
            ],
            'dart-2.14' => [
                'code' => $functionsDir . '/dart.tar.gz',
                'entrypoint' => 'index.dart',
                'timeout' => 15,
                'runtime' => 'dart-2.14',
                'tarname' => 'dart-2-14.tar.gz',
                'filename' => 'index.dart',
            ],
            'dart-2.15' => [
                'code' => $functionsDir . '/dart.tar.gz',
                'entrypoint' => 'index.dart',
                'timeout' => 15,
                'runtime' => 'dart-2.15',
                'tarname' => 'dart-2-15.tar.gz',
                'filename' => 'index.dart',
            ],
            'node-14.5' => [
                'code' => $functionsDir . '/node.tar.gz',
                'entrypoint' => 'index.js',
                'timeout' => 15,
                'runtime' => 'node-14.5',
                'tarname' => 'node-14-5.tar.gz',
            ],
            'node-15.5' => [
                'code' => $functionsDir . '/node.tar.gz',
                'entrypoint' => 'index.js',
                'timeout' => 15,
                'runtime' => 'node-15.5',
                'tarname' => 'node-15-5.tar.gz',
            ],
            'node-16' => [
                'code' => $functionsDir . '/node.tar.gz',
                'entrypoint' => 'index.js',
                'timeout' => 15,
                'runtime' => 'node-16.0',
                'tarname' => 'node-16.tar.gz',
            ],
            'node-17' => [
                'code' => $functionsDir . '/node.tar.gz',
                'entrypoint' => 'index.js',
                'timeout' => 15,
                'runtime' => 'node-17.0',
                'tarname' => 'node-17.tar.gz',
            ],
            'php-8.0' => [
                'code' => $functionsDir . '/php.tar.gz',
                'entrypoint' => 'index.php',
                'timeout' => 15,
                'runtime' => 'php-8.0',
                'tarname' => 'php-8-0.tar.gz',
            ],
            'php-8.1' => [
                'code' => $functionsDir . '/php.tar.gz',
                'entrypoint' => 'index.php',
                'timeout' => 15,
                'runtime' => 'php-8.1',
                'tarname' => 'php-8-1.tar.gz',
            ],
            'python-3.8' => [
                'code' => $functionsDir . '/python.tar.gz',
                'entrypoint' => 'index.py',
                'timeout' => 15,
                'runtime' => 'python-3.8',
                'tarname' => 'python-3-8.tar.gz',
            ],
            'python-3.9' => [
                'code' => $functionsDir . '/python.tar.gz',
                'entrypoint' => 'index.py',
                'timeout' => 15,
                'runtime' => 'python-3.9',
                'tarname' => 'python-3-9.tar.gz',
            ],
            'python-3.10' => [
                'code' => $functionsDir . '/python.tar.gz',
                'entrypoint' => 'index.py',
                'timeout' => 15,
                'runtime' => 'python-3.10',
                'tarname' => 'python-3-10.tar.gz',
            ],
            'deno-1.12' => [
                'code' => $functionsDir . '/deno.tar.gz',
                'entrypoint' => 'index.ts',
                'timeout' => 15,
                'runtime' => 'deno-1.12',
                'tarname' => 'deno-1-12.tar.gz',
            ],
            'deno-1.13' => [
                'code' => $functionsDir . '/deno.tar.gz',
                'entrypoint' => 'index.ts',
                'timeout' => 15,
                'runtime' => 'deno-1.13',
                'tarname' => 'deno-1-13.tar.gz',
            ],
            'deno-1.14' => [
                'code' => $functionsDir . '/deno.tar.gz',
                'entrypoint' => 'index.ts',
                'timeout' => 15,
                'runtime' => 'deno-1.14',
                'tarname' => 'deno-1-14.tar.gz',
            ],
            'rust-1.55' => [
                'code' => $functionsDir . '/rust.tar.gz',
                'entrypoint' => 'index.rs',
                'timeout' => 15,
                'runtime' => 'rust-1.55',
                'tarname' => 'rust-1-55.tar.gz',
            ],
            'ruby-3.0' => [
                'code' => $functionsDir . '/ruby.tar.gz',
                'entrypoint' => 'index.rb',
                'timeout' => 15,
                'runtime' => 'ruby-3.0',
                'tarname' => 'ruby-3-0.tar.gz',
            ],
            'swift-5.5' => [
                'code' => $functionsDir . '/swift.tar.gz',
                'entrypoint' => 'index.swift',
                'timeout' => 15,
                'runtime' => 'swift-5.5',
                'tarname' => 'swift-5-5.tar.gz',
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

    public function testSupportedRuntimes(): void
    {
        $this->assertNotEmpty($this->instance->get('node'));
        $this->assertNotEmpty($this->instance->getAll());
        $this->assertNotEmpty($this->instance->getAll(supported: false));
        $this->assertCount(1, $this->instance->getAll(filter: ['node-14.5']));
        $this->assertCount(1, $this->instance->getAll(filter: ['node-14.5', 'unknown']));
        $this->assertCount(2, $this->instance->getAll(filter: ['node-14.5', 'node-15.5']));
    }

    public function testGetRuntimes(): void
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

    public function testRunBuildCommand(): void
    {
        foreach ($this->tests as $test) {
            // Get runtime
            $runtime = $this->instance->getAll()[$test['runtime']];

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
                vars: [
                    'ENTRYPOINT_NAME' => $test['entrypoint'],
                ],
                volumes: [
                    $test['code'] . ":/tmp/code.tar.gz",
                    $this->tempDir . ":/usr/builtCode:rw"
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
                    'mkdir -p /usr/code && cp /tmp/code.tar.gz /usr/workspace/code.tar.gz && cd /usr && tar -zxf /usr/workspace/code.tar.gz -C /usr/code && rm /usr/workspace/code.tar.gz'
                ],
                stdout: $untarStdout,
                stderr: $untarStderr,
                timeout: 600
            );

            $this->assertEquals(true, $untarSuccess, $untarStderr);
            $this->assertEmpty($untarStderr, $untarStderr);

            // Build Code / Install Dependencies
            $buildStdout = '';
            $buildStderr = '';

            $buildSuccess = $this->orchestration->execute(
                name: 'build-container',
                command: ['sh', '-c', 'cd /usr/local/src && ./build.sh'],
                vars: [
                    'ENTRYPOINT_NAME' => $test['entrypoint'],
                ],
                stdout: $buildStdout,
                stderr: $buildStderr,
                timeout: 600
            );

            $this->assertEquals(true, $buildSuccess, $buildStderr);

            // Repackage Code and Save.
            $compressStdout = '';
            $compressStderr = '';

            $builtCodePath = $this->tempDir . '/' . $test['tarname'];

            $compressSuccess = $this->orchestration->execute(
                name: 'build-container',
                command: [
                    'sudo', 'tar', '-C', '/usr/code', '-czvf', $builtCodePath, './'
                ],
                stdout: $compressStdout,
                stderr: $compressStderr,
                timeout: 60
            );

            $this->assertEquals(true, $compressSuccess, $compressStderr);
            // $this->assertEquals(true, file_exists($builtCodePath)); // Check needs to be reimplemented.
            // It attempts to check the container's file system, but the compiled code is on the host's filesystem.
            $this->assertEmpty($compressStderr, $compressStderr);

            // Remove container
            $this->orchestration->remove($id, true);
        }
    }

    /**
     * @depends testRunBuildCommand
     */
    public function testRunRuntimes(): void
    {
        $stdout = $stderr = '';
        $secret = \bin2hex(\random_bytes(16));
        foreach ($this->tests as $key => $test) {
            $runtime = $this->instance->getAll()[$test['runtime']];
            $containerID = $this->orchestration->run(
                image: $runtime['image'],
                command: ['/usr/local/src/launch.sh'],
                name: $key,
                hostname: $key,
                vars: [
                    'INTERNAL_RUNTIME_KEY' => $secret,
                ],
                volumes: [
                    $this->tempDir . '/' . $test['tarname'] . ":/tmp/code.tar.gz"
                ]
            );

            $this->assertNotFalse($containerID);

            $this->assertNotFalse($this->orchestration->networkConnect($containerID, 'php-runtimes_runtime-tests'));

            // Wait for server to launch
            sleep(5);

            $body = json_encode([
                'path' => '/usr/code',
                'file' => $test['entrypoint'],
                'env' => [
                    'ENV1' => 'Hello World!'
                ],
                'payload' => 'Hello World! 2',
                'timeout' => 60,
                'headers' => [
                    'test' => 'test1'
                ]
            ]);

            // Make a test execution
            $ch = \curl_init();
            \curl_setopt($ch, CURLOPT_URL, "http://" . $key . ":3000/");
            \curl_setopt($ch, CURLOPT_POST, true);
            \curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

            \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            \curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            \curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            \curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . \strlen($body),
                'x-internal-challenge: ' . $secret
            ]);

            $executorResponse = \curl_exec($ch);

            $error = \curl_error($ch);

            $errNo = \curl_errno($ch);

            $response = json_decode($executorResponse, true);

            $this->assertEquals('Hello World!', $response['normal']);
            $this->assertEquals('Hello World! 2', $response['payload']);
            $this->assertEquals('Hello World!', $response['env1']);

            // Remove container
            $this->orchestration->remove($containerID, true);
        }
    }

    /**
     * @depends testRunRuntimes
     */
    public function testRuntimeSecurityFail(): void
    {
        $stdout = $stderr = '';
        $secret = 'secret';
        foreach ($this->tests as $key => $test) {
            $runtime = $this->instance->getAll()[$test['runtime']];
            $containerID = $this->orchestration->run(
                image: $runtime['image'],
                command: ['/usr/local/src/launch.sh'],
                name: $key,
                hostname: $key,
                vars: [
                    'INTERNAL_RUNTIME_KEY' => $secret,
                ],
                volumes: [
                    $this->tempDir . '/' . $test['tarname'] . ":/tmp/code.tar.gz"
                ]
            );

            $this->assertNotFalse($containerID);

            $this->assertNotFalse($this->orchestration->networkConnect($containerID, 'php-runtimes_runtime-tests'));

            // Wait for server to launch
            sleep(5);

            $body = json_encode([
                'path' => '/usr/code',
                'file' => $test['entrypoint'],
                'env' => [
                    'ENV1' => 'Hello World!'
                ],
                'payload' => 'Hello World! 2',
                'timeout' => 60
            ]);

            // Make a test execution
            $ch = \curl_init();
            \curl_setopt($ch, CURLOPT_URL, "http://" . $key . ":3000/");
            \curl_setopt($ch, CURLOPT_POST, true);
            \curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

            \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            \curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            \curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            \curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . \strlen($body),
                'x-internal-challenge: ' . 'notthesecretexpected'
            ]);

            $executorResponse = \curl_exec($ch);

            $error = \curl_error($ch);

            $errNo = \curl_errno($ch);

            // Remove container
            $this->orchestration->remove($containerID, true);

            $response = json_decode($executorResponse, true);

            // Status Code
            $this->assertEquals(401, \curl_getinfo($ch, CURLINFO_HTTP_CODE));
            $this->assertEquals(401, $response['code']);
            $this->assertEquals('Unauthorized', $response['message']);
            \curl_close($ch);
        }
    }
}

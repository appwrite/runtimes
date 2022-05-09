<?php

namespace Appwrite\Tests;

use Appwrite\Runtimes\Runtimes;
use PHPUnit\Framework\TestCase;
use Utopia\CLI\Console;

class RuntimesTest extends TestCase
{
    public $tests;
    /** @var Runtimes $instance */
    public $instance;
    public $functionsDir;

    public function setUp(): void
    {
        $this->functionsDir = $functionsDir = realpath(__DIR__ . '/../resources');
        $this->tests = [
            'node-14.5' => [
                'code' => $functionsDir . '/node.tar.gz',
                'command' => 'node index.js',
                'timeout' => 15,
                'runtime' => 'node-14.5'
            ],
            'node-15.5' => [
                'code' => $functionsDir . '/node.tar.gz',
                'command' => 'node index.js',
                'timeout' => 15,
                'runtime' => 'node-15.5'
            ],
            'node-16' => [
                'code' => $functionsDir . '/node.tar.gz',
                'command' => 'node index.js',
                'timeout' => 15,
                'runtime' => 'node-16'
            ],
            'php-7.4' => [
                'code' => $functionsDir . '/php.tar.gz',
                'command' => 'php index.php',
                'timeout' => 15,
                'runtime' => 'php-7.4'
            ],
            'php-8.0' => [
                'code' => $functionsDir . '/php.tar.gz',
                'command' => 'php index.php',
                'timeout' => 15,
                'runtime' => 'php-8.0'
            ],
            'ruby-2.7' => [
                'code' => $functionsDir . '/ruby.tar.gz',
                'command' => 'ruby app.rb',
                'timeout' => 15,
                'runtime' => 'ruby-2.7'
            ],
            'ruby-3.0' => [
                'code' => $functionsDir . '/ruby.tar.gz',
                'command' => 'ruby app.rb',
                'timeout' => 15,
                'runtime' => 'ruby-3.0'
            ],
            'python-3.8' => [
                'code' => $functionsDir . '/python.tar.gz',
                'command' => 'python main.py',
                'timeout' => 15,
                'runtime' => 'python-3.8'
            ],
            'python-3.9' => [
                'code' => $functionsDir . '/python.tar.gz',
                'command' => 'python main.py',
                'timeout' => 15,
                'runtime' => 'python-3.9'
            ],
            'deno-1.5' => [
                'code' => $functionsDir . '/deno.tar.gz',
                'command' => 'deno run --allow-env index.ts',
                'timeout' => 15,
                'runtime' => 'deno-1.5'
            ],
            'deno-1.6' => [
                'code' => $functionsDir . '/deno.tar.gz',
                'command' => 'deno run --allow-env index.ts',
                'timeout' => 15,
                'runtime' => 'deno-1.6'
            ],
            'deno-1.8' => [
                'code' => $functionsDir . '/deno.tar.gz',
                'command' => 'deno run --allow-env index.ts',
                'timeout' => 15,
                'runtime' => 'deno-1.8'
            ],
            'deno-1.10' => [
                'code' => $functionsDir . '/deno.tar.gz',
                'command' => 'deno run --allow-env index.ts',
                'timeout' => 15,
                'runtime' => 'deno-1.10'
            ],
            'deno-1.11' => [
                'code' => $functionsDir . '/deno.tar.gz',
                'command' => 'deno run --allow-env index.ts',
                'timeout' => 15,
                'runtime' => 'deno-1.11'
            ],
            'dart-2.10' => [
                'code' => $functionsDir . '/dart.tar.gz',
                'command' => 'dart main.dart',
                'timeout' => 15,
                'runtime' => 'dart-2.10'
            ],
            'dart-2.12' => [
                'code' => $functionsDir . '/dart.tar.gz',
                'command' => 'dart main.dart',
                'timeout' => 15,
                'runtime' => 'dart-2.12'
            ],
            'dart-2.13' => [
                'code' => $functionsDir . '/dart.tar.gz',
                'command' => 'dart main.dart',
                'timeout' => 15,
                'runtime' => 'dart-2.13'
            ],
            'dotnet-3.1' => [
                'code' => $functionsDir . '/dotnet-3.1.tar.gz',
                'command' => 'dotnet dotnet.dll',
                'timeout' => 15,
                'runtime' => 'dotnet-3.1'
            ],
            'dotnet-6.0' => [
                'code' => $functionsDir . '/dotnet-6.0.tar.gz',
                'command' => 'dotnet dotnet.dll',
                'timeout' => 15,
                'runtime' => 'dotnet-6.0'
            ],
            'java-8.0' => [
                'code' => $functionsDir . '/java-8.tar.gz',
                'command' => 'java HelloWorld',
                'timeout' => 15,
                'runtime' => 'java-8.0'
            ],
            'java-11.0' => [
                'code' => $functionsDir . '/java-11.tar.gz',
                'command' => 'java HelloWorld',
                'timeout' => 15,
                'runtime' => 'java-11.0'
            ],
            'java-17.0' => [
                'code' => $functionsDir . '/java-17.tar.gz',
                'command' => 'java HelloWorld',
                'timeout' => 15,
                'runtime' => 'java-17.0'
            ],
            'swift-5.5' => [
                'code' => $functionsDir . '/swift.tar.gz',
                'command' => './helloworld',
                'timeout' => 15,
                'runtime' => 'swift-5.5'
            ],
            'kotlin-1.6' => [
                'code' => $functionsDir . '/kotlin.tar.gz',
                'command' => 'kotlin HelloWorld',
                'timeout' => 15,
                'runtime' => 'kotlin-1.6'
            ],
            'cpp-17.0' => [
                'code' => $functionsDir . '/cpp.tar.gz',
                'command' => './HelloWorld',
                'timeout' => 15,
                'runtime' => 'cpp-17.0'
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
}

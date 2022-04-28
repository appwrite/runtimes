<?php

namespace Appwrite\Runtimes;

use Exception;
use Utopia\System\System;

class Runtimes
{
    /** @var array<string, Runtime> $runtimes */
    protected $runtimes = [];

    /**
     * Runtimes.
     */
    public function __construct()
    {
        $node = new Runtime('node', 'Node.js');
        $node->addVersion('14.5', 'node:14.5-alpine', 'openruntimes/node:14.5', [System::X86, System::ARM]);
        $node->addVersion('15.5', 'node:15.5-alpine', 'openruntimes/node:15.5', [System::X86, System::ARM]);
        $node->addVersion('16.0', 'node:16-alpine', 'openruntimes/node:16.0', [System::X86, System::ARM]);
        $node->addVersion('17.0', 'node:17-alpine', 'openruntimes/node:17.0', [System::X86, System::ARM]);
        $this->runtimes['node'] = $node;

        $php = new Runtime('php', 'PHP');
        $php->addVersion('8.0', 'php:8.0-cli-alpine', 'openruntimes/php:8.0', [System::X86, System::ARM]);
        $php->addVersion('8.1', 'php:8.1-cli-alpine', 'openruntimes/php:8.1', [System::X86, System::ARM]);
        $this->runtimes['php'] = $php;

        $ruby = new Runtime('ruby', 'Ruby');
        $ruby->addVersion('3.0', 'ruby:3.0-alpine', 'openruntimes/ruby:3.0', [System::X86, System::ARM]);
        $ruby->addVersion('3.1', 'ruby:3.1-alpine', 'openruntimes/ruby:3.1', [System::X86, System::ARM]);
        $this->runtimes['ruby'] = $ruby;

        $python = new Runtime('python', 'Python');
        $python->addVersion('3.8', 'python:3.8-alpine', 'openruntimes/python:3.8', [System::X86, System::ARM]);
        $python->addVersion('3.9', 'python:3.9-alpine', 'openruntimes/python:3.9', [System::X86, System::ARM]);
        $python->addVersion('3.10', 'python:3.10-alpine', 'openruntimes/python:3.10', [System::X86, System::ARM]);
        $this->runtimes['python'] = $python;

        $deno = new Runtime('deno', 'Deno');
        $deno->addVersion('1.12', 'denoland/deno:alpine-1.12.2', 'openruntimes/deno:1.12', [System::X86]);
        $deno->addVersion('1.13', 'denoland/deno:alpine-1.13.2', 'openruntimes/deno:1.13', [System::X86]);
        $deno->addVersion('1.14', 'denoland/deno:alpine-1.14.3', 'openruntimes/deno:1.14', [System::X86]);
        $this->runtimes['deno'] = $deno;

        $dart = new Runtime('dart', 'Dart');
        $dart->addVersion('2.12', 'dart:2.12', 'openruntimes/dart:2.12', [System::X86]);
        $dart->addVersion('2.13', 'dart:2.13', 'openruntimes/dart:2.13', [System::X86]);
        $dart->addVersion('2.14', 'dart:2.14', 'openruntimes/dart:2.14', [System::X86, System::ARM]);
        $dart->addVersion('2.15', 'dart:2.15', 'openruntimes/dart:2.15', [System::X86, System::ARM]);
        $dart->addVersion('2.16', 'dart:2.16', 'openruntimes/dart:2.16', [System::X86, System::ARM]);
        $this->runtimes['dart'] = $dart;

        // $dotnet = new Runtime('dotnet', '.NET');
        // $dotnet->addVersion('3.1', 'mcr.microsoft.com/dotnet/runtime:3.1-alpine', 'openruntimes/dotnet:3.1', [System::X86]);
        // $dotnet->addVersion('5.0', 'mcr.microsoft.com/dotnet/runtime:5.0-alpine', 'openruntimes/dotnet:5.0', [System::X86, System::ARM]);
        // $this->runtimes['dotnet'] = $dotnet;

        $java = new Runtime('java', 'Java');
        $java->addVersion('8.0', 'openjdk/8-jdk-slim', 'openruntimes/java:8.0', [System::X86, System::ARM]);
        $java->addVersion('11.0', 'openjdk/11-jdk-slim', 'openruntimes/java:11.0', [System::X86, System::ARM]);
        $java->addVersion('17.0', 'openjdk/17-jdk-slim', 'openruntimes/java:17.0', [System::X86, System::ARM]);
        $this->runtimes['java'] = $java;

        $swift = new Runtime('swift', 'Swift');
        $swift->addVersion('5.5', 'swiftarm/swift:5.5.2-focal-multi-arch', 'openruntimes/swift:5.5', [System::X86, System::ARM]);
        $this->runtimes['swift'] = $swift;

        $kotlin = new Runtime('kotlin', 'Kotlin');
        $kotlin->addVersion('1.6', 'openjdk/17-jdk-slim', 'openruntimes/kotlin:1.6', [System::X86, System::ARM]);
        $this->runtimes['kotlin'] = $kotlin;
    }

    /**
     * Adds runtime.
     * 
     * @param Runtime $runtime
     * @return void
     */
    public function add(Runtime $runtime): void
    {
        $this->runtimes[$runtime->getKey()] = $runtime;
    }

    /**
     * Get Runtime by key.
     * 
     * @param string $key
     * 
     * @return Runtime
     */
    public function get(string $key): Runtime
    {
        if (!array_key_exists($key, $this->runtimes)) {
            throw new Exception("Runtime not found!");
        }
        return $this->runtimes[$key];
    }

    /**
     * Returns all supported runtimes.
     * 
     * @param bool $supported Pass `false` to also return unsupported CPU architecture.
     * 
     * @return array
     */
    public function getAll(bool $supported = true, array $filter = []): array
    {
        $supportedRuntimes = [];

        foreach ($this->runtimes as $runtime) {
            $supportedRuntimes = array_merge(array_reverse(array_filter($runtime->list(), function (array $version, string $key) use ($supported, $filter) {
                $isSupported = in_array(System::getArchEnum(), $version["supports"]);
                $isFiltered = in_array($key, $filter);
                return $supported ? ($isSupported && ($filter ? $isFiltered : true)) : true;
            }, ARRAY_FILTER_USE_BOTH)), $supportedRuntimes);
        }

        return array_reverse($supportedRuntimes);
    }
}

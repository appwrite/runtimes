<?php

namespace Appwrite\Runtimes;

use Exception;
use Utopia\System\System;

class Runtimes
{
    /** @var array<string, Runtime> */
    protected $runtimes = [];

    protected string $version;

    /**
     * Runtimes.
     */
    public function __construct(string $version = '')
    {
        $this->version = $version;

        $node = new Runtime('node', 'Node.js', 'sh helpers/server.sh');
        $node->addVersion('14.5', 'node:14.5-alpine3.11', 'openruntimes/node:'.$this->version.'-14.5', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $node->addVersion('16.0', 'node:16.0-alpine3.13', 'openruntimes/node:'.$this->version.'-16.0', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $node->addVersion('18.0', 'node:18.0-alpine3.15', 'openruntimes/node:'.$this->version.'-18.0', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $node->addVersion('19.0', 'node:19.0-alpine3.16', 'openruntimes/node:'.$this->version.'-19.0', [System::X86, System::ARM64]);
        $node->addVersion('20.0', 'node:20.0-alpine3.16', 'openruntimes/node:'.$this->version.'-20.0', [System::X86, System::ARM64]);
        $node->addVersion('21.0', 'node:21.0-alpine3.18', 'openruntimes/node:'.$this->version.'-21.0', [System::X86, System::ARM64]);
        $this->runtimes['node'] = $node;

        $php = new Runtime('php', 'PHP', 'sh helpers/server.sh');
        $php->addVersion('8.0', 'php:8.0.30-cli-alpine3.16', 'openruntimes/php:'.$this->version.'-8.0', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $php->addVersion('8.1', 'php:8.1.30-cli-alpine3.20', 'openruntimes/php:'.$this->version.'-8.1', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $php->addVersion('8.2', 'php:8.2.24-cli-alpine3.20', 'openruntimes/php:'.$this->version.'-8.2', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $php->addVersion('8.3', 'php:8.3.12-cli-alpine3.20', 'openruntimes/php:'.$this->version.'-8.3', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $this->runtimes['php'] = $php;

        $ruby = new Runtime('ruby', 'Ruby', 'sh helpers/server.sh');
        $ruby->addVersion('3.0', 'ruby:3.0-alpine3.16', 'openruntimes/ruby:'.$this->version.'-3.0', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $ruby->addVersion('3.1', 'ruby:3.1-alpine3.16', 'openruntimes/ruby:'.$this->version.'-3.1', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $ruby->addVersion('3.2', 'ruby:3.2-alpine3.16', 'openruntimes/ruby:'.$this->version.'-3.2', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $ruby->addVersion('3.3', 'ruby:3.3-alpine3.18', 'openruntimes/ruby:'.$this->version.'-3.3', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $this->runtimes['ruby'] = $ruby;

        $python = new Runtime('python', 'Python', 'sh helpers/server.sh');
        $python->addVersion('3.8', 'python:3.8.20-alpine3.20', 'openruntimes/python:'.$this->version.'-3.8', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $python->addVersion('3.9', 'python:3.9.20-alpine3.20', 'openruntimes/python:'.$this->version.'-3.9', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $python->addVersion('3.10', 'python:3.10.15-alpine3.20', 'openruntimes/python:'.$this->version.'-3.10', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $python->addVersion('3.11', 'python:3.11.10-alpine3.20', 'openruntimes/python:'.$this->version.'-3.11', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $python->addVersion('3.12', 'python:3.12.6-alpine3.20', 'openruntimes/python:'.$this->version.'-3.12', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $this->runtimes['python'] = $python;

        $pythonML = new Runtime('python-ml', 'Python (ML)', 'sh helpers/server.sh');
        $pythonML->addVersion('3.11', 'python:3.11.10-bookworm', 'openruntimes/python-ml:'.$this->version.'-3.11', [System::X86, System::ARM64]);
        $this->runtimes['python-ml'] = $pythonML;

        $deno = new Runtime('deno', 'Deno', 'sh helpers/server.sh');
        $deno->addVersion('1.21', 'denoland/deno:alpine-1.21.3', 'openruntimes/deno:'.$this->version.'-1.21', [System::X86]);
        $deno->addVersion('1.24', 'denoland/deno:alpine-1.24.3', 'openruntimes/deno:'.$this->version.'-1.24', [System::X86]);
        $deno->addVersion('1.35', 'denoland/deno:alpine-1.35.3', 'openruntimes/deno:'.$this->version.'-1.35', [System::X86]);
        $deno->addVersion('1.40', 'denoland/deno:alpine-1.40.5', 'openruntimes/deno:'.$this->version.'-1.40', [System::X86, System::ARM64]);
        $deno->addVersion('1.46', 'denoland/deno:alpine-1.46.3', 'openruntimes/deno:'.$this->version.'-1.46', [System::X86, System::ARM64]);
        $deno->addVersion('2.0', 'denoland/deno:alpine-2.0.0-rc.5', 'openruntimes/deno:'.$this->version.'-2.0', [System::X86, System::ARM64]);
        $this->runtimes['deno'] = $deno;

        $dart = new Runtime('dart', 'Dart', 'sh helpers/server.sh');
        $dart->addVersion('2.15', 'dart:2.15.1', 'openruntimes/dart:'.$this->version.'-2.15', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $dart->addVersion('2.16', 'dart:2.16.2', 'openruntimes/dart:'.$this->version.'-2.16', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $dart->addVersion('2.17', 'dart:2.17.7', 'openruntimes/dart:'.$this->version.'-2.17', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $dart->addVersion('2.18', 'dart:2.18.7', 'openruntimes/dart:'.$this->version.'-2.18', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $dart->addVersion('2.18', 'dart:2.19.6', 'openruntimes/dart:'.$this->version.'-2.19', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $dart->addVersion('3.0', 'dart:3.0.7', 'openruntimes/dart:'.$this->version.'-3.0', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $dart->addVersion('3.1', 'dart:3.1.5', 'openruntimes/dart:'.$this->version.'-3.1', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $dart->addVersion('3.3', 'dart:3.3.4', 'openruntimes/dart:'.$this->version.'-3.3', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $dart->addVersion('3.5', 'dart:3.5.2', 'openruntimes/dart:'.$this->version.'-3.5', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $this->runtimes['dart'] = $dart;

        $dotnet = new Runtime('dotnet', '.NET', 'sh helpers/server.sh');
        $dotnet->addVersion('6.0', 'mcr.microsoft.com/dotnet/sdk:6.0.425-alpine3.19', 'openruntimes/dotnet:'.$this->version.'-6.0', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $dotnet->addVersion('7.0', 'mcr.microsoft.com/dotnet/sdk:7.0.410-alpine3.19', 'openruntimes/dotnet:'.$this->version.'-7.0', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $dotnet->addVersion('8.0', 'mcr.microsoft.com/dotnet/sdk:8.0.402-alpine3.19', 'openruntimes/dotnet:'.$this->version.'-8.0', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $this->runtimes['dotnet'] = $dotnet;

        $java = new Runtime('java', 'Java', 'sh helpers/server.sh');
        $java->addVersion('8.0', 'openjdk/8-jdk-slim', 'openruntimes/java:'.$this->version.'-8.0', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $java->addVersion('11.0', 'openjdk/11-jdk-slim', 'openruntimes/java:'.$this->version.'-11.0', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $java->addVersion('17.0', 'openjdk/17-jdk-slim', 'openruntimes/java:'.$this->version.'-17.0', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $java->addVersion('18.0', 'openjdk/18-jdk-slim', 'openruntimes/java:'.$this->version.'-18.0', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $java->addVersion('21.0', 'openjdk/21-jdk-slim', 'openruntimes/java:'.$this->version.'-21.0', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $this->runtimes['java'] = $java;

        $swift = new Runtime('swift', 'Swift', 'sh helpers/server.sh');
        $swift->addVersion('5.5', 'swiftarm/swift:5.5.3-ubuntu-jammy', 'openruntimes/swift:'.$this->version.'-5.5', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $swift->addVersion('5.8', 'swiftarm/swift:5.8-ubuntu-jammy', 'openruntimes/swift:'.$this->version.'-5.8', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $swift->addVersion('5.9', 'swift:5.9-jammy', 'openruntimes/swift:'.$this->version.'-5.9', [System::X86, System::ARM64,  System::ARMV7, System::ARMV8]);
        $this->runtimes['swift'] = $swift;

        $kotlin = new Runtime('kotlin', 'Kotlin', 'sh helpers/server.sh');
        $kotlin->addVersion('1.6', 'eclipse-temurin:18-jdk-alpine', 'openruntimes/kotlin:'.$this->version.'-1.6', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $kotlin->addVersion('1.8', 'eclipse-temurin:19-jdk-alpine', 'openruntimes/kotlin:'.$this->version.'-1.8', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $kotlin->addVersion('1.9', 'eclipse-temurin:19-jdk-alpine', 'openruntimes/kotlin:'.$this->version.'-1.9', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $kotlin->addVersion('1.9', 'eclipse-temurin:19-jdk-alpine', 'openruntimes/kotlin:'.$this->version.'-1.9', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $kotlin->addVersion('2.0', 'eclipse-temurin:22-jdk-alpine', 'openruntimes/kotlin:'.$this->version.'-2.0', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $this->runtimes['kotlin'] = $kotlin;

        $cpp = new Runtime('cpp', 'C++', 'sh helpers/server.sh');
        $cpp->addVersion('17', 'alpine:3.20.2', 'openruntimes/cpp:'.$this->version.'-17', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $cpp->addVersion('20', 'alpine:3.20.2', 'openruntimes/cpp:'.$this->version.'-20', [System::X86, System::ARM64, System::ARMV7, System::ARMV8]);
        $this->runtimes['cpp'] = $cpp;

        $bun = new Runtime('bun', 'Bun', 'sh helpers/server.sh');
        $bun->addVersion('1.0', 'oven/bun:1.0.36-alpine', 'openruntimes/bun:'.$this->version.'-1.0', [System::X86, System::ARM64]);
        $bun->addVersion('1.1', 'oven/bun:1.1.29-alpine', 'openruntimes/bun:'.$this->version.'-1.1', [System::X86, System::ARM64]);
        $this->runtimes['bun'] = $bun;

        $go = new Runtime('go', 'Go', 'sh helpers/server.sh');
        $go->addVersion('1.23', 'golang:1.23.1-alpine3.20', 'openruntimes/go:'.$this->version.'-1.23', [System::X86, System::ARM64]);
        $this->runtimes['go'] = $go;
    }

    /**
     * Adds runtime.
     */
    public function add(Runtime $runtime): void
    {
        $this->runtimes[$runtime->getKey()] = $runtime;
    }

    /**
     * Get Runtime by key.
     */
    public function get(string $key): Runtime
    {
        if (! array_key_exists($key, $this->runtimes)) {
            throw new Exception('Runtime not found!');
        }

        return $this->runtimes[$key];
    }

    /**
     * Returns all supported runtimes.
     *
     * @param  bool  $supported  Pass `false` to also return unsupported CPU architecture.
     * @param  array<mixed>  $filter
     * @return array<mixed>
     */
    public function getAll(bool $supported = true, array $filter = []): array
    {
        $supportedRuntimes = [];

        foreach ($this->runtimes as $runtime) {
            $supportedRuntimes = array_merge(array_reverse(array_filter($runtime->list(), function (array $version, string $key) use ($supported, $filter) {
                $isSupported = in_array(System::getArchEnum(), $version['supports']);
                $isFiltered = in_array($key, $filter);

                return $supported ? ($isSupported && ($filter ? $isFiltered : true)) : true;
            }, ARRAY_FILTER_USE_BOTH)), $supportedRuntimes);
        }

        return array_reverse($supportedRuntimes);
    }
}

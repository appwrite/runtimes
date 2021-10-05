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
        $node->addVersion('14.5', 'node:14.5-alpine', 'appwrite/runtime-for-node:14.5', [System::X86, System::PPC, System::ARM]);
        $node->addVersion('15.5', 'node:15.5-alpine', 'appwrite/runtime-for-node:15.5', [System::X86, System::PPC, System::ARM]);
        $node->addVersion('16.0', 'node:16-alpine', 'appwrite/runtime-for-node:16.0', [System::X86, System::PPC, System::ARM]);
        $this->runtimes['node'] = $node;

        $php = new Runtime('php', 'PHP');
        $php->addVersion('7.4', 'php:7.4-cli-alpine', 'appwrite/runtime-for-php:7.4', [System::X86, System::PPC, System::ARM]);
        $php->addVersion('8.0', 'php:8.0-cli-alpine', 'appwrite/runtime-for-php:8.0', [System::X86, System::PPC, System::ARM]);
        $this->runtimes['php'] = $php;

        $ruby = new Runtime('ruby', 'Ruby');
        $ruby->addVersion('2.7', 'ruby:2.7-alpine', 'appwrite/runtime-for-ruby:2.7', [System::X86, System::PPC, System::ARM]);
        $ruby->addVersion('3.0', 'ruby:3.0-alpine', 'appwrite/runtime-for-ruby:3.0', [System::X86, System::PPC, System::ARM]);
        $this->runtimes['ruby'] = $ruby;

        $python = new Runtime('python', 'Python');
        $python->addVersion('3.8', 'python:3.8-alpine', 'appwrite/runtime-for-python:3.8', [System::X86, System::PPC, System::ARM]);
        $python->addVersion('3.9', 'python:3.9-alpine', 'appwrite/runtime-for-python:3.9', [System::X86, System::PPC, System::ARM]);
        $this->runtimes['python'] = $python;

        $deno = new Runtime('deno', 'Deno');
        $deno->addVersion('1.8', 'hayd/deno:alpine-1.8.3', 'appwrite/runtime-for-deno:1.8', [System::X86]);
        $deno->addVersion('1.10', 'denoland/deno:alpine-1.10.3', 'appwrite/runtime-for-deno:1.10', [System::X86]);
        $deno->addVersion('1.11', 'denoland/deno:alpine-1.11.5', 'appwrite/runtime-for-deno:1.11', [System::X86]);
        $this->runtimes['deno'] = $deno;

        $dart = new Runtime('dart', 'Dart');
        $dart->addVersion('2.10', 'google/dart:2.10', 'appwrite/env-dart-2.10:1.0.0', [System::X86]);
        $dart->addVersion('2.12', 'dart:2.12', 'appwrite/env-dart-2.12:1.0.0', [System::X86]);
        $dart->addVersion('2.13', 'dart:2.12', 'appwrite/env-dart-2.13:1.0.0', [System::X86]);
        $this->runtimes['dart'] = $dart;

        $dotnet = new Runtime('dotnet', '.NET');
        $dotnet->addVersion('3.1', 'mcr.microsoft.com/dotnet/runtime:3.1-alpine', 'appwrite/runtime-for-dotnet:3.1', [System::X86]);
        $dotnet->addVersion('5.0', 'mcr.microsoft.com/dotnet/runtime:5.0-alpine', 'appwrite/runtime-for-dotnet:5.0', [System::X86, System::ARM]);
        $this->runtimes['dotnet'] = $dotnet;

        $java = new Runtime('java', 'Java');
        $java->addVersion('11.0', 'openjdk/11-jre', 'appwrite/runtime-for-java:11.0', [System::X86]);
        $java->addVersion('16.0', 'openjdk/16-jdk-alpine', 'appwrite/runtime-for-java:16.0', [System::X86]);
        $this->runtimes['java'] = $java;

        $swift = new Runtime('swift', 'Swift');
        $java->addVersion('5.5', 'swift:5.5-slim', 'appwrite/runtime-for-swift:5.5', [System::X86]);
        $this->runtimes['swift'] = $swift;
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
            $supportedRuntimes = array_merge(array_filter($runtime->list(), function (array $version, string $key) use ($supported, $filter) {
                $isSupported = in_array(System::getArchEnum(), $version["supports"]);
                $isFiltered = in_array($key, $filter);
                return $supported ? ($isSupported && ($filter ? $isFiltered : true)) : true;
            }, ARRAY_FILTER_USE_BOTH), $supportedRuntimes);
        }

        return $supportedRuntimes;
    }
}

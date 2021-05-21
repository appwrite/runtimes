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
        $node->addVersion('14.5', 'node:14.5-alpine', 'appwrite/env-node-14.5:1.0.0', [System::X86, System::PPC, System::ARM]);
        $node->addVersion('15.5', 'node:15.5-alpine', 'appwrite/env-node-15.5:1.0.0', [System::X86, System::PPC, System::ARM]);
        $this->runtimes['node'] = $node;

        $php = new Runtime('php', 'PHP');
        $php->addVersion('7.4', 'php:7.4-cli-alpine', 'appwrite/env-php-7.4:1.0.0', [System::X86, System::PPC, System::ARM]);
        $php->addVersion('8.0', 'php:8.0-cli-alpine', 'appwrite/env-php-8.0:1.0.0', [System::X86, System::PPC, System::ARM]);
        $this->runtimes['php'] = $php;

        $ruby = new Runtime('ruby', 'Ruby');
        $ruby->addVersion('2.7', 'ruby:2.7-alpine', 'appwrite/env-ruby-2.7:1.0.2', [System::X86, System::PPC, System::ARM]);
        $ruby->addVersion('3.0', 'ruby:3.0-alpine', 'appwrite/env-ruby-3.0:1.0.0', [System::X86, System::PPC, System::ARM]);
        $this->runtimes['ruby'] = $ruby;

        $python = new Runtime('python', 'Python');
        $python->addVersion('3.8', 'python:3.8-alpine', 'appwrite/env-python-3.8:1.0.0', [System::X86, System::PPC, System::ARM]);
        $python->addVersion('3.9', 'python:3.9-alpine', 'appwrite/env-python-3.9:1.0.0', [System::X86, System::PPC, System::ARM]);
        $this->runtimes['python'] = $python;

        $deno = new Runtime('deno', 'Deno');
        $deno->addVersion('1.5', 'hayd/deno:alpine-1.5.0', 'appwrite/env-deno-1.5:1.0.0', [System::X86]);
        $deno->addVersion('1.6', 'hayd/deno:alpine-1.6.0', 'appwrite/env-deno-1.6:1.0.0', [System::X86]);
        $deno->addVersion('1.8', 'hayd/deno:alpine-1.8.2', 'appwrite/env-deno-1.8:1.0.0', [System::X86]);
        $this->runtimes['deno'] = $deno;

        $dart = new Runtime('dart', 'Dart');
        $dart->addVersion('2.10', 'dart:2.10', 'appwrite/env-dart-2.10:1.0.0', [System::X86]);
        $dart->addVersion('2.12', 'dart:2.12', 'appwrite/env-dart-2.12:1.0.0', [System::X86]);
        $this->runtimes['dart'] = $dart;

        $dotnet = new Runtime('dotnet', '.NET');
        $dotnet->addVersion('3.1', 'mcr.microsoft.com/dotnet/runtime:3.1-alpine', 'appwrite/env-dotnet-3.1:1.0.0', [System::X86]);
        $dotnet->addVersion('5.0', 'mcr.microsoft.com/dotnet/runtime:5.0-alpine', 'appwrite/env-dotnet-5.0:1.0.0', [System::X86, System::ARM]);
        $this->runtimes['dotnet'] = $dotnet;

        $java = new Runtime('java', 'Java');
        $java->addVersion('11', 'openjdk/11-jre', 'appwrite/env-java-11:1.0.0', [System::X86]);
        $java->addVersion('16', 'openjdk/16-jre', 'appwrite/env-java-16:1.0.0', [System::X86]);
        $this->runtimes['java'] = $java;
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

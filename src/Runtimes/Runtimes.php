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
        $dart = new Runtime('dart', 'Dart');
        $dart->addVersion('2.12', 'dart-runtime:2.12', 'dart-runtime:2.12', [System::X86, System::ARM]);
        $this->runtimes['dart'] = $dart;

        $node = new Runtime('node', 'Node.js');
        $node->addVersion('14.5', 'node-runtime:14.5', 'node-runtime:14.5', [System::X86, System::ARM]);
        $node->addVersion('15.5', 'node-runtime:15.5', 'node-runtime:15.5', [System::X86, System::ARM]);
        $node->addVersion('16.0', 'node-runtime:16.0', 'node-runtime:16.0', [System::X86, System::ARM]);
        $this->runtimes['node'] = $node;

        $deno = new Runtime('deno', 'Deno');
        $deno->addVersion('1.10', 'deno-runtime:1.10', 'deno-runtime:1.10', [System::X86]);
        $deno->addVersion('1.11', 'deno-runtime:1.11', 'deno-runtime:1.11', [System::X86]);
        $deno->addVersion('1.14', 'deno-runtime:1.14', 'deno-runtime:1.14', [System::X86]);
        $this->runtimes['deno'] = $deno;

        $php = new Runtime('php', 'PHP');
        $php->addVersion('8.0', 'php-runtime:8.0', 'php-runtime:8.0', [System::X86, System::ARM]);
        $this->runtimes['php'] = $php;

        $python = new Runtime('python', 'Python');
        $python->addVersion('3.8', 'python-runtime:3.8', 'python-runtime:3.8', [System::X86, System::ARM]);
        $python->addVersion('3.9', 'python-runtime:3.9', 'python-runtime:3.9', [System::X86, System::ARM]);
        $this->runtimes['python'] = $python;

        $rust = new Runtime('rust', 'Rust');
        $rust->addVersion('1.55', 'rust-runtime:1.55', 'appwrite-alpine:3.13.6', [System::X86, System::ARM]);
        $this->runtimes['rust'] = $rust;
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

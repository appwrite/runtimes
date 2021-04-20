<?php

namespace Appwrite\Runtimes;

use Utopia\System\System;

class Runtimes
{
    public static function get(): array
    {
        $runtimes = [];

        $node = new Runtime('node', 'Node.js');
        $node->addVersion('14.5', 'node:14.5-alpine', 'appwrite/env-node-14.5:1.0.0', [System::X86, System::PPC, System::ARM]);
        $node->addVersion('15.5', 'node:15.5-alpine', 'appwrite/env-node-15.5:1.0.0', [System::X86, System::PPC, System::ARM]);
        $runtimes[] = $node;

        $php = new Runtime('php', 'PHP');
        $php->addVersion('7.4', 'php:7.4-cli-alpine', 'appwrite/env-php-7.4:1.0.0', [System::X86, System::PPC, System::ARM]);
        $php->addVersion('8.0', 'php:8.0-cli-alpine', 'appwrite/env-php-8.0:1.0.0', [System::X86, System::PPC, System::ARM]);
        $runtimes[] = $php;

        $ruby = new Runtime('ruby', 'Ruby');
        $ruby->addVersion('2.7', 'ruby:2.7-alpine', 'appwrite/env-ruby-2.7:1.0.2', [System::X86, System::PPC, System::ARM]);
        $ruby->addVersion('3.0', 'ruby:3.0-alpine', 'appwrite/env-ruby-3.0:1.0.0', [System::X86, System::PPC, System::ARM]);
        $runtimes[] = $ruby;

        $python = new Runtime('python', 'Python');
        $python->addVersion('3.8', 'python:3.8-alpine', 'appwrite/env-python-3.8:1.0.0', [System::X86, System::PPC, System::ARM]);
        $python->addVersion('3.9', 'python:3.9-alpine', 'appwrite/env-python-3.9:1.0.0', [System::X86, System::PPC, System::ARM]);
        $runtimes[] = $python;

        $deno = new Runtime('deno', 'Deno');
        $deno->addVersion('1.2', 'hayd/deno:alpine-1.2.0', 'appwrite/env-deno-1.2:1.0.0', [System::X86]);
        $deno->addVersion('1.5', 'hayd/deno:alpine-1.5.0', 'appwrite/env-deno-1.5:1.0.0', [System::X86]);
        $deno->addVersion('1.6', 'hayd/deno:alpine-1.6.0', 'appwrite/env-deno-1.6:1.0.0', [System::X86]);
        $deno->addVersion('1.8', 'hayd/deno:alpine-1.8.2', 'appwrite/env-deno-1.8:1.0.0', [System::X86]);
        $runtimes[] = $deno;

        $dart = new Runtime('dart', 'Dart');
        $dart->addVersion('2.10', 'google/dart:2.10', 'appwrite/env-dart-2.10:1.0.0', [System::X86]);
        $dart->addVersion('2.12', 'google/dart:2.12', 'appwrite/env-dart-2.12:1.0.0', [System::X86]);
        $runtimes[] = $dart;

        $dotnet = new Runtime('dotnet', '.NET');
        $dotnet->addVersion('3.1', 'mcr.microsoft.com/dotnet/runtime:3.1-alpine', 'appwrite/env-dotnet-3.1:1.0.0', [System::X86]);
        $dotnet->addVersion('5.0', 'mcr.microsoft.com/dotnet/runtime:5.0-alpine', 'appwrite/env-dotnet-5.0:1.0.0', [System::X86, System::ARM]);
        $runtimes[] = $dotnet;

        $withVersion = [];

        foreach ($runtimes as $runtime) {
            $withVersion = array_merge(array_filter($runtime->list(), function($version) {
                return in_array(System::getArchEnum(), $version["supports"]);
            }), $withVersion);
        }

        return $withVersion;
    }
}

class Runtime
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Version[]
     */
    protected $versions = [];

    public function __construct(string $key, string $name)
    {
        $this->key = $key;
        $this->name = $name;
        $this->versions;
    }

    public function addVersion(string $version, string $base, string $image, array $supports): void
    {
        $this->versions[] = new Version($version, $base, $image, $supports);
    }

    /**
     * @return array[]
     */
    public function list(): array
    {
        $list = [];
        foreach ($this->versions as $version) {
            $key = "{$this->key}-{$version->version}";
            $list[$key] = array_merge(
                [
                    'name' => $this->name,
                    'logo' => "{$this->key}.png",
                    'build' => "/usr/src/code/docker/environments/{$key}"
                ],
                $version->get()
            );
        }

        return $list;
    }
}

class Version
{
    /**
     * @var string
     */
    public $version;

    /**
     * @var string
     */
    public $base;

    /**
     * @var string
     */
    public $image;

    /**
     * @var array
     */
    public $supports;

    public function __construct(string $version, string $base, string $image, array $supports)
    {
        $this->version = $version;
        $this->base = $base;
        $this->image = $image;
        $this->supports = $supports;
    }

    /**
     * @return (array|string)[]
     */
    public function get(): array
    {
        return
            [
                'version' => $this->version,
                'base' => $this->base,
                'image' => $this->image,
                'supports' => $this->supports
            ];
    }
}

<?php

namespace Appwrite\Runtimes;

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

    /**
     * @var string[]
     */
    protected $buildCommand = [];

    /**
     * NOTE: Only used for compiled languages.
     * @var string[]
    */
    protected $runCommand = [];

    /**
     * Runtime that can contain different Versions.
     * 
     * @param string $key
     * @param string $name
     * @param string[] $buildCommand
     * @param string[] $runCommand // NOTE: Only used for compiled languages.
     */
    public function __construct(string $key, string $name, array $buildCommand = [], array $runCommand = [])
    {
        $this->key = $key;
        $this->name = $name;
        $this->buildCommand = $buildCommand;
        $this->runCommand = $runCommand;
        $this->versions;
    }

    /**
     * Get key.
     * 
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * Get build command
     * 
     * @return string[]
    */
    public function getBuildCommand(): array
    {
        return $this->buildCommand;
    }

    /**
     * Get run command
     * 
     * @return string[]
    */
    public function getRunCommand(): array
    {
        return $this->runCommand;
    }

    /**
     * Adds new version to runtime.
     * 
     * @param string $version
     * @param string $base
     * @param string $image
     * @param string[] $supports
     */
    public function addVersion(string $version, string $base, string $image, array $supports): void
    {
        $this->versions[] = new Version($version, $base, $image, $supports);
    }

    /**
     * List runtime with all parsed Versions.
     * 
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
                    'buildCommand' => $this->buildCommand,
                    'runCommand' => $this->runCommand,
                ],
                $version->get()
            );
        }

        return $list;
    }
}
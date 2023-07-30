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
     * @var string
     */
    protected $startCommand;

    /**
     * @var Version[]
     */
    protected $versions = [];

    /**
     * Runtime that can contain different Versions.
     * 
     * @param string $key
     * @param string $name
     */
    public function __construct(string $key, string $name, string $startCommand)
    {
        $this->key = $key;
        $this->name = $name;
        $this->startCommand = $startCommand;
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
                    'key' => $this->key,
                    'name' => $this->name,
                    'logo' => "{$this->key}.png",
                    'startCommand' => $this->startCommand
                ],
                $version->get()
            );
        }

        return $list;
    }
}
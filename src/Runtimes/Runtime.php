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
     */
    public function __construct(string $key, string $name, string $startCommand)
    {
        $this->key = $key;
        $this->name = $name;
        $this->startCommand = $startCommand;
    }

    /**
     * Get key.
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * Adds new version to runtime.
     *
     * @param  string[]  $supports
     */
    public function addVersion(string $version, string $base, string $image, array $supports, bool $deprecated = false): void
    {
        $this->versions[] = new Version($version, $base, $image, $supports, $deprecated);
    }

    /**
     * List runtime with all parsed Versions.
     *
     * @return array<mixed>[]
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
                    'startCommand' => $this->startCommand,
                ],
                $version->get()
            );
        }

        return $list;
    }
}

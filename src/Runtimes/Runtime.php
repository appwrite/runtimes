<?php

namespace Appwrite\Runtimes;

class Runtime
{
    /**
     * @var string
     */
     protected $key;

    /**
     * Describes if runtime us custom or provided by Appwrite
     * 
     * @var bool
     */
    protected $isCustom = false;

    /**
     * @var string
     */
    protected $name;

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
    public function __construct(string $key, string $name)
    {
        $this->key = $key;
        $this->name = $name;
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
     * Mark runtime as custom.
     * 
     * @param bool $isCustom
     */
     public function setCustom(bool $isCustom): void
     {
         $this->isCustom = $isCustom;
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
                    'logo' => $this->isCustom ? "custom.png" : "{$this->key}.png",
                ],
                $version->get()
            );
        }

        return $list;
    }
}
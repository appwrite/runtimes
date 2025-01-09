<?php

namespace Appwrite\Runtimes;

class Version
{
    /**
     * @var string
     */
    public $version;

    public string $base;

    public string $image;

    /**
     * @var array<string>
     */
    public array $supports;

    public bool $deprecated;

    /**
     * Version class that holds metadata about a Runtime Version.
     *
     * @param  array<string>  $supports
     */
    public function __construct(string $version, string $base, string $image, array $supports, bool $deprecated = false)
    {
        $this->version = $version;
        $this->base = $base;
        $this->image = $image;
        $this->supports = $supports;
        $this->deprecated = $deprecated;
    }

    /**
     * Get parsed Version.
     *
     * @return array<string, mixed>
     */
    public function get(): array
    {
        return
            [
                'version' => $this->version,
                'base' => $this->base,
                'image' => $this->image,
                'supports' => $this->supports,
                'deprecated' => $this->deprecated,
            ];
    }
}

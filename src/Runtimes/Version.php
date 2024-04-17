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

    /**
     * Version class that holds metadata about a Runtime Version.
     *
     * @param  array<string>  $supports
     */
    public function __construct(string $version, string $base, string $image, array $supports)
    {
        $this->version = $version;
        $this->base = $base;
        $this->image = $image;
        $this->supports = $supports;
    }

    /**
     * Get parsed Version.
     *
     * @return (array<mixed>|string)[]
     */
    public function get(): array
    {
        return
            [
                'version' => $this->version,
                'base' => $this->base,
                'image' => $this->image,
                'supports' => $this->supports,
            ];
    }
}

<?php

namespace Appwrite\Runtimes;

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

    /**
     * Version class that holds metadata about a Runtime Version.
     * 
     * @param string $version
     * @param string $base
     * @param string $image
     * @param array $supports
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
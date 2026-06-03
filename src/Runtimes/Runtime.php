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

    protected array $services;

    public const SERVICE_FUNCTIONS = 'functions';
    public const SERVICE_SITES = 'sites';

    /**
     * Runtime that can contain different Versions.
     *
     * @param  string[]  $services
     */
    public function __construct(string $key, string $name, string $startCommand, array $services = [self::SERVICE_FUNCTIONS, self::SERVICE_SITES])
    {
        $this->key = $key;
        $this->name = $name;
        $this->startCommand = $startCommand;
        $this->setServices($services);
    }

    /**
     * Get services.
     *
     * @return string[]
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * Set services.
     *
     * @param  string[]  $services
     */
    public function setServices(array $services): void
    {
        if (empty($services)) {
            throw new \InvalidArgumentException('Runtime must be associated with at least one service.');
        }
        $validServices = [self::SERVICE_FUNCTIONS, self::SERVICE_SITES];
        foreach ($services as $service) {
            if (!\in_array($service, $validServices, true)) {
                throw new \InvalidArgumentException("Invalid runtime service: {$service}");
            }
        }
        $this->services = $services;
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
                    'services' => $this->services,
                ],
                $version->get()
            );
        }

        return $list;
    }
}

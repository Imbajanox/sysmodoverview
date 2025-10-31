<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer;

class NpmModules extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $name;

    /** @var null|string */
    protected $module;

    /** @var null|string */
    protected $installedVersion;

    /** @var null|string */
    protected $wantedVersion;

    /** @var null|string */
    protected $latestVersion;

    protected $dependencies;

    /** @var null|string */
    protected $location;

    /** @var null|LaminasSystemServer */
    protected $laminasSystemServer;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): NpmModules
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName($name): NpmModules
    {
        $this->name = $name;
        return $this;
    }

    public function getModule(): ?string
    {
        return $this->module;
    }

    /**
     * @param null|string $module
     */
    public function setModule($module): NpmModules
    {
        $this->module = $module;
        return $this;
    }

    public function getInstalledVersion(): ?string
    {
        return $this->installedVersion;
    }

    /**
     * @param null|string $installedVersion
     */
    public function setInstalledVersion($installedVersion): NpmModules
    {
        $this->installedVersion = $installedVersion;
        return $this;
    }

    public function getWantedVersion(): ?string
    {
        return $this->wantedVersion;
    }

    /**
     * @param null|string $wantedVersion
     */
    public function setWantedVersion($wantedVersion): NpmModules
    {
        $this->wantedVersion = $wantedVersion;
        return $this;
    }

    public function getLatestVersion(): ?string
    {
        return $this->latestVersion;
    }

    /**
     * @param null|string $latestVersion
     */
    public function setLatestVersion($latestVersion): NpmModules
    {
        $this->latestVersion = $latestVersion;
        return $this;
    }

    public function getDependencies()
    {
        return $this->dependencies;
    }

    public function setDependencies($dependencies): NpmModules
    {
        $this->dependencies = $dependencies;
        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param null|string $location
     */
    public function setLocation($location): NpmModules
    {
        $this->location = $location;
        return $this;
    }

    public function getLaminasSystemServer(): ?LaminasSystemServer
    {
        return $this->laminasSystemServer;
    }

    public function setLaminasSystemServer(?LaminasSystemServer $laminasSystemServer): NpmModules
    {
        $this->laminasSystemServer = $laminasSystemServer;
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function __clone()
    {
    }
}

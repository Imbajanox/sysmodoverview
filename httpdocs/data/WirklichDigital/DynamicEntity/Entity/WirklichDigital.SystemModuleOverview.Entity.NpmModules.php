<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class NpmModules extends AbstractEntity
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $name = null;

    /**
     * @var null|string
     */
    protected $module = null;

    /**
     * @var null|string
     */
    protected $installedVersion = null;

    /**
     * @var null|string
     */
    protected $wantedVersion = null;

    /**
     * @var null|string
     */
    protected $latestVersion = null;

    protected $dependencies = null;

    /**
     * @var null|string
     */
    protected $location = null;

    /**
     * @var null|\WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
     */
    protected $laminasSystemServer = null;

    /**
     * @return null|int
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id) : \WirklichDigital\SystemModuleOverview\Entity\NpmModules
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName($name) : \WirklichDigital\SystemModuleOverview\Entity\NpmModules
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getModule() : ?string
    {
        return $this->module;
    }

    /**
     * @param null|string $module
     */
    public function setModule($module) : \WirklichDigital\SystemModuleOverview\Entity\NpmModules
    {
        $this->module = $module;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getInstalledVersion() : ?string
    {
        return $this->installedVersion;
    }

    /**
     * @param null|string $installedVersion
     */
    public function setInstalledVersion($installedVersion) : \WirklichDigital\SystemModuleOverview\Entity\NpmModules
    {
        $this->installedVersion = $installedVersion;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getWantedVersion() : ?string
    {
        return $this->wantedVersion;
    }

    /**
     * @param null|string $wantedVersion
     */
    public function setWantedVersion($wantedVersion) : \WirklichDigital\SystemModuleOverview\Entity\NpmModules
    {
        $this->wantedVersion = $wantedVersion;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLatestVersion() : ?string
    {
        return $this->latestVersion;
    }

    /**
     * @param null|string $latestVersion
     */
    public function setLatestVersion($latestVersion) : \WirklichDigital\SystemModuleOverview\Entity\NpmModules
    {
        $this->latestVersion = $latestVersion;
        return $this;
    }

    public function getDependencies()
    {
        return $this->dependencies;
    }

    public function setDependencies($dependencies) : \WirklichDigital\SystemModuleOverview\Entity\NpmModules
    {
        $this->dependencies = $dependencies;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLocation() : ?string
    {
        return $this->location;
    }

    /**
     * @param null|string $location
     */
    public function setLocation($location) : \WirklichDigital\SystemModuleOverview\Entity\NpmModules
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return null|\WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
     */
    public function getLaminasSystemServer() : ?\WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        return $this->laminasSystemServer;
    }

    /**
     * @param null|\WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer $laminasSystemServer
     */
    public function setLaminasSystemServer(?\WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer $laminasSystemServer) : \WirklichDigital\SystemModuleOverview\Entity\NpmModules
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


<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class LaminasSystemServerComposerOutdated extends AbstractEntity
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
    protected $version = null;

    /**
     * @var null|string
     */
    protected $latest = null;

    /**
     * @var null|string
     */
    protected $latestStatus = null;

    /**
     * @var null|string
     */
    protected $description = null;

    /**
     * @var null|\WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
     */
    protected $laminasSystemServer = null;

    /**
     * @var null|\WirklichDigital\SystemModuleOverview\Entity\ComposerModule
     */
    protected $composerModule = null;

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
    public function setId($id) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated
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
    public function setName($name) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getVersion() : ?string
    {
        return $this->version;
    }

    /**
     * @param null|string $version
     */
    public function setVersion($version) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLatest() : ?string
    {
        return $this->latest;
    }

    /**
     * @param null|string $latest
     */
    public function setLatest($latest) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated
    {
        $this->latest = $latest;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLatestStatus() : ?string
    {
        return $this->latestStatus;
    }

    /**
     * @param null|string $latestStatus
     */
    public function setLatestStatus($latestStatus) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated
    {
        $this->latestStatus = $latestStatus;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription() : ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription($description) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated
    {
        $this->description = $description;
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
    public function setLaminasSystemServer(?\WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer $laminasSystemServer) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated
    {
        $this->laminasSystemServer = $laminasSystemServer;
        return $this;
    }

    /**
     * @return null|\WirklichDigital\SystemModuleOverview\Entity\ComposerModule
     */
    public function getComposerModule() : ?\WirklichDigital\SystemModuleOverview\Entity\ComposerModule
    {
        return $this->composerModule;
    }

    /**
     * @param null|\WirklichDigital\SystemModuleOverview\Entity\ComposerModule $composerModule
     */
    public function setComposerModule(?\WirklichDigital\SystemModuleOverview\Entity\ComposerModule $composerModule) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated
    {
        $this->composerModule = $composerModule;
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


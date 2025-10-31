<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SystemModuleOverview\Entity\ComposerModule;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer;

class LaminasSystemServerComposerOutdated extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $name;

    /** @var null|string */
    protected $version;

    /** @var null|string */
    protected $latest;

    /** @var null|string */
    protected $latestStatus;

    /** @var null|string */
    protected $description;

    /** @var null|LaminasSystemServer */
    protected $laminasSystemServer;

    /** @var null|ComposerModule */
    protected $composerModule;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): LaminasSystemServerComposerOutdated
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
    public function setName($name): LaminasSystemServerComposerOutdated
    {
        $this->name = $name;
        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * @param null|string $version
     */
    public function setVersion($version): LaminasSystemServerComposerOutdated
    {
        $this->version = $version;
        return $this;
    }

    public function getLatest(): ?string
    {
        return $this->latest;
    }

    /**
     * @param null|string $latest
     */
    public function setLatest($latest): LaminasSystemServerComposerOutdated
    {
        $this->latest = $latest;
        return $this;
    }

    public function getLatestStatus(): ?string
    {
        return $this->latestStatus;
    }

    /**
     * @param null|string $latestStatus
     */
    public function setLatestStatus($latestStatus): LaminasSystemServerComposerOutdated
    {
        $this->latestStatus = $latestStatus;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription($description): LaminasSystemServerComposerOutdated
    {
        $this->description = $description;
        return $this;
    }

    public function getLaminasSystemServer(): ?LaminasSystemServer
    {
        return $this->laminasSystemServer;
    }

    public function setLaminasSystemServer(?LaminasSystemServer $laminasSystemServer): LaminasSystemServerComposerOutdated
    {
        $this->laminasSystemServer = $laminasSystemServer;
        return $this;
    }

    public function getComposerModule(): ?ComposerModule
    {
        return $this->composerModule;
    }

    public function setComposerModule(?ComposerModule $composerModule): LaminasSystemServerComposerOutdated
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

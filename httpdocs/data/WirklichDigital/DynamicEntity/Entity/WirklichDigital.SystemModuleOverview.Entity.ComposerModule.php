<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule;

class ComposerModule extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $vendor;

    /** @var null|string */
    protected $name;

    /** @var null|int */
    protected $systems;

    /** @var null|int */
    protected $upToDate;

    /** @var null|int */
    protected $outdated;

    /** @var LaminasSystemServerModule[]|Collection */
    protected $laminasSystemServerModule;

    /** @var LaminasSystemServerComposerOutdated[]|Collection */
    protected $laminasSystemServerComposerOutdated;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): ComposerModule
    {
        $this->id = $id;
        return $this;
    }

    public function getVendor(): ?string
    {
        return $this->vendor;
    }

    /**
     * @param null|string $vendor
     */
    public function setVendor($vendor): ComposerModule
    {
        $this->vendor = $vendor;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName($name): ComposerModule
    {
        $this->name = $name;
        return $this;
    }

    public function getSystems(): ?int
    {
        return $this->systems;
    }

    /**
     * @param null|int $systems
     */
    public function setSystems($systems): ComposerModule
    {
        $this->systems = $systems;
        return $this;
    }

    public function getUpToDate(): ?int
    {
        return $this->upToDate;
    }

    /**
     * @param null|int $upToDate
     */
    public function setUpToDate($upToDate): ComposerModule
    {
        $this->upToDate = $upToDate;
        return $this;
    }

    public function getOutdated(): ?int
    {
        return $this->outdated;
    }

    /**
     * @param null|int $outdated
     */
    public function setOutdated($outdated): ComposerModule
    {
        $this->outdated = $outdated;
        return $this;
    }

    /**
     * @return LaminasSystemServerModule[]|Collection
     */
    public function getLaminasSystemServerModule(): Collection
    {
        return $this->laminasSystemServerModule;
    }

    /**
     * @param LaminasSystemServerModule[]|Collection $laminasSystemServerModule
     */
    public function setLaminasSystemServerModule(Collection $laminasSystemServerModule): ComposerModule
    {
        $this->laminasSystemServerModule = $laminasSystemServerModule;
        if ($this->laminasSystemServerModule) {
            foreach ($this->laminasSystemServerModule as $_laminasSystemServerModule) {
                $_laminasSystemServerModule->setComposerModule($this);
            }
        }
        return $this;
    }

    /**
     * @param LaminasSystemServerModule[]|Collection $laminasSystemServerModule
     */
    public function addLaminasSystemServerModule($laminasSystemServerModule): ComposerModule
    {
        foreach ($laminasSystemServerModule as $_laminasSystemServerModule) {
            $_laminasSystemServerModule->setComposerModule($this);
            $this->laminasSystemServerModule->add($_laminasSystemServerModule);
        }
        return $this;
    }

    /**
     * @param LaminasSystemServerModule[]|Collection $laminasSystemServerModule
     */
    public function removeLaminasSystemServerModule($laminasSystemServerModule): ComposerModule
    {
        foreach ($laminasSystemServerModule as $_laminasSystemServerModule) {
            $_laminasSystemServerModule->setComposerModule(null);
            $this->laminasSystemServerModule->removeElement($_laminasSystemServerModule);
        }
        return $this;
    }

    /**
     * @return LaminasSystemServerComposerOutdated[]|Collection
     */
    public function getLaminasSystemServerComposerOutdated(): Collection
    {
        return $this->laminasSystemServerComposerOutdated;
    }

    /**
     * @param LaminasSystemServerComposerOutdated[]|Collection $laminasSystemServerComposerOutdated
     */
    public function setLaminasSystemServerComposerOutdated(Collection $laminasSystemServerComposerOutdated): ComposerModule
    {
        $this->laminasSystemServerComposerOutdated = $laminasSystemServerComposerOutdated;
        if ($this->laminasSystemServerComposerOutdated) {
            foreach ($this->laminasSystemServerComposerOutdated as $_laminasSystemServerComposerOutdated) {
                $_laminasSystemServerComposerOutdated->setComposerModule($this);
            }
        }
        return $this;
    }

    /**
     * @param LaminasSystemServerComposerOutdated[]|Collection $laminasSystemServerComposerOutdated
     */
    public function addLaminasSystemServerComposerOutdated($laminasSystemServerComposerOutdated): ComposerModule
    {
        foreach ($laminasSystemServerComposerOutdated as $_laminasSystemServerComposerOutdated) {
            $_laminasSystemServerComposerOutdated->setComposerModule($this);
            $this->laminasSystemServerComposerOutdated->add($_laminasSystemServerComposerOutdated);
        }
        return $this;
    }

    /**
     * @param LaminasSystemServerComposerOutdated[]|Collection $laminasSystemServerComposerOutdated
     */
    public function removeLaminasSystemServerComposerOutdated($laminasSystemServerComposerOutdated): ComposerModule
    {
        foreach ($laminasSystemServerComposerOutdated as $_laminasSystemServerComposerOutdated) {
            $_laminasSystemServerComposerOutdated->setComposerModule(null);
            $this->laminasSystemServerComposerOutdated->removeElement($_laminasSystemServerComposerOutdated);
        }
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->laminasSystemServerModule           = new ArrayCollection();
        $this->laminasSystemServerComposerOutdated = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->laminasSystemServerModule           = clone $this->laminasSystemServerModule;
        $this->laminasSystemServerComposerOutdated = clone $this->laminasSystemServerComposerOutdated;
    }
}

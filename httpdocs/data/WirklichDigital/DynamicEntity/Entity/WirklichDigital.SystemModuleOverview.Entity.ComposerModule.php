<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class ComposerModule extends AbstractEntity
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $vendor = null;

    /**
     * @var null|string
     */
    protected $name = null;

    /**
     * @var null|int
     */
    protected $systems = null;

    /**
     * @var null|int
     */
    protected $upToDate = null;

    /**
     * @var null|int
     */
    protected $outdated = null;

    /**
     * @var \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule[]|\Doctrine\Common\Collections\Collection
     */
    protected $laminasSystemServerModule = null;

    /**
     * @var \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated[]|\Doctrine\Common\Collections\Collection
     */
    protected $laminasSystemServerComposerOutdated = null;

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
    public function setId($id) : \WirklichDigital\SystemModuleOverview\Entity\ComposerModule
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getVendor() : ?string
    {
        return $this->vendor;
    }

    /**
     * @param null|string $vendor
     */
    public function setVendor($vendor) : \WirklichDigital\SystemModuleOverview\Entity\ComposerModule
    {
        $this->vendor = $vendor;
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
    public function setName($name) : \WirklichDigital\SystemModuleOverview\Entity\ComposerModule
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getSystems() : ?int
    {
        return $this->systems;
    }

    /**
     * @param null|int $systems
     */
    public function setSystems($systems) : \WirklichDigital\SystemModuleOverview\Entity\ComposerModule
    {
        $this->systems = $systems;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getUpToDate() : ?int
    {
        return $this->upToDate;
    }

    /**
     * @param null|int $upToDate
     */
    public function setUpToDate($upToDate) : \WirklichDigital\SystemModuleOverview\Entity\ComposerModule
    {
        $this->upToDate = $upToDate;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getOutdated() : ?int
    {
        return $this->outdated;
    }

    /**
     * @param null|int $outdated
     */
    public function setOutdated($outdated) : \WirklichDigital\SystemModuleOverview\Entity\ComposerModule
    {
        $this->outdated = $outdated;
        return $this;
    }

    /**
     * @return \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule[]|\Doctrine\Common\Collections\Collection
     */
    public function getLaminasSystemServerModule() : \Doctrine\Common\Collections\Collection
    {
        return $this->laminasSystemServerModule;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule[]|\Doctrine\Common\Collections\Collection $laminasSystemServerModule
     */
    public function setLaminasSystemServerModule(\Doctrine\Common\Collections\Collection $laminasSystemServerModule) : \WirklichDigital\SystemModuleOverview\Entity\ComposerModule
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
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule[]|\Doctrine\Common\Collections\Collection $laminasSystemServerModule
     */
    public function addLaminasSystemServerModule($laminasSystemServerModule) : \WirklichDigital\SystemModuleOverview\Entity\ComposerModule
    {
        foreach ($laminasSystemServerModule as $_laminasSystemServerModule) {
            $_laminasSystemServerModule->setComposerModule($this);
            $this->laminasSystemServerModule->add($_laminasSystemServerModule);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule[]|\Doctrine\Common\Collections\Collection $laminasSystemServerModule
     */
    public function removeLaminasSystemServerModule($laminasSystemServerModule) : \WirklichDigital\SystemModuleOverview\Entity\ComposerModule
    {
        foreach ($laminasSystemServerModule as $_laminasSystemServerModule) {
            $_laminasSystemServerModule->setComposerModule(null);
            $this->laminasSystemServerModule->removeElement($_laminasSystemServerModule);
        }
        return $this;
    }

    /**
     * @return \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated[]|\Doctrine\Common\Collections\Collection
     */
    public function getLaminasSystemServerComposerOutdated() : \Doctrine\Common\Collections\Collection
    {
        return $this->laminasSystemServerComposerOutdated;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated[]|\Doctrine\Common\Collections\Collection $laminasSystemServerComposerOutdated
     */
    public function setLaminasSystemServerComposerOutdated(\Doctrine\Common\Collections\Collection $laminasSystemServerComposerOutdated) : \WirklichDigital\SystemModuleOverview\Entity\ComposerModule
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
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated[]|\Doctrine\Common\Collections\Collection $laminasSystemServerComposerOutdated
     */
    public function addLaminasSystemServerComposerOutdated($laminasSystemServerComposerOutdated) : \WirklichDigital\SystemModuleOverview\Entity\ComposerModule
    {
        foreach ($laminasSystemServerComposerOutdated as $_laminasSystemServerComposerOutdated) {
            $_laminasSystemServerComposerOutdated->setComposerModule($this);
            $this->laminasSystemServerComposerOutdated->add($_laminasSystemServerComposerOutdated);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated[]|\Doctrine\Common\Collections\Collection $laminasSystemServerComposerOutdated
     */
    public function removeLaminasSystemServerComposerOutdated($laminasSystemServerComposerOutdated) : \WirklichDigital\SystemModuleOverview\Entity\ComposerModule
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
        $this->laminasSystemServerModule = new ArrayCollection();
        $this->laminasSystemServerComposerOutdated = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->laminasSystemServerModule = clone $this->laminasSystemServerModule;
        $this->laminasSystemServerComposerOutdated = clone $this->laminasSystemServerComposerOutdated;
    }
}


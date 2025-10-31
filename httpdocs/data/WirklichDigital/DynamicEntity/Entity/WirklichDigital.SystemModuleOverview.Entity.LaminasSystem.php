<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class LaminasSystem extends AbstractEntity
{
    protected $id;

    /** @var null|string */
    protected $repositoryName;

    /** @var null|string */
    protected $repository;

    /** @var LaminasSystemServer[]|Collection */
    protected $laminasSystemServer;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): LaminasSystem
    {
        $this->id = $id;
        return $this;
    }

    public function getRepositoryName(): ?string
    {
        return $this->repositoryName;
    }

    /**
     * @param null|string $repositoryName
     */
    public function setRepositoryName($repositoryName): LaminasSystem
    {
        $this->repositoryName = $repositoryName;
        return $this;
    }

    public function getRepository(): ?string
    {
        return $this->repository;
    }

    /**
     * @param null|string $repository
     */
    public function setRepository($repository): LaminasSystem
    {
        $this->repository = $repository;
        return $this;
    }

    /**
     * @return LaminasSystemServer[]|Collection
     */
    public function getLaminasSystemServer(): Collection
    {
        return $this->laminasSystemServer;
    }

    /**
     * @param LaminasSystemServer[]|Collection $laminasSystemServer
     */
    public function setLaminasSystemServer(Collection $laminasSystemServer): LaminasSystem
    {
        $this->laminasSystemServer = $laminasSystemServer;
        if ($this->laminasSystemServer) {
            foreach ($this->laminasSystemServer as $_laminasSystemServer) {
                $_laminasSystemServer->setLaminasSystem($this);
            }
        }
        return $this;
    }

    /**
     * @param LaminasSystemServer[]|Collection $laminasSystemServer
     */
    public function addLaminasSystemServer($laminasSystemServer): LaminasSystem
    {
        foreach ($laminasSystemServer as $_laminasSystemServer) {
            $_laminasSystemServer->setLaminasSystem($this);
            $this->laminasSystemServer->add($_laminasSystemServer);
        }
        return $this;
    }

    /**
     * @param LaminasSystemServer[]|Collection $laminasSystemServer
     */
    public function removeLaminasSystemServer($laminasSystemServer): LaminasSystem
    {
        foreach ($laminasSystemServer as $_laminasSystemServer) {
            $_laminasSystemServer->setLaminasSystem(null);
            $this->laminasSystemServer->removeElement($_laminasSystemServer);
        }
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->laminasSystemServer = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->laminasSystemServer = clone $this->laminasSystemServer;
    }
}

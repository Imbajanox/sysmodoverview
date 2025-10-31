<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class LaminasSystem extends AbstractEntity
{
    protected $id = null;

    /**
     * @var null|string
     */
    protected $repositoryName = null;

    /**
     * @var null|string
     */
    protected $repository = null;

    /**
     * @var \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer[]|\Doctrine\Common\Collections\Collection
     */
    protected $laminasSystemServer = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystem
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getRepositoryName() : ?string
    {
        return $this->repositoryName;
    }

    /**
     * @param null|string $repositoryName
     */
    public function setRepositoryName($repositoryName) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystem
    {
        $this->repositoryName = $repositoryName;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getRepository() : ?string
    {
        return $this->repository;
    }

    /**
     * @param null|string $repository
     */
    public function setRepository($repository) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystem
    {
        $this->repository = $repository;
        return $this;
    }

    /**
     * @return \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer[]|\Doctrine\Common\Collections\Collection
     */
    public function getLaminasSystemServer() : \Doctrine\Common\Collections\Collection
    {
        return $this->laminasSystemServer;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer[]|\Doctrine\Common\Collections\Collection $laminasSystemServer
     */
    public function setLaminasSystemServer(\Doctrine\Common\Collections\Collection $laminasSystemServer) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystem
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
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer[]|\Doctrine\Common\Collections\Collection $laminasSystemServer
     */
    public function addLaminasSystemServer($laminasSystemServer) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystem
    {
        foreach ($laminasSystemServer as $_laminasSystemServer) {
            $_laminasSystemServer->setLaminasSystem($this);
            $this->laminasSystemServer->add($_laminasSystemServer);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer[]|\Doctrine\Common\Collections\Collection $laminasSystemServer
     */
    public function removeLaminasSystemServer($laminasSystemServer) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystem
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


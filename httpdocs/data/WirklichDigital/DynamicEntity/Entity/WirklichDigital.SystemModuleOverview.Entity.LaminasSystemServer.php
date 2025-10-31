<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class LaminasSystemServer extends AbstractEntity
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $url = null;

    /**
     * @var null|string
     */
    protected $ipAddress = null;

    /**
     * @var null|string
     */
    protected $phpinfo = null;

    /**
     * @var null|string
     */
    protected $config = null;

    /**
     * @var null|string
     */
    protected $j77Config = null;

    /**
     * @var null|string
     */
    protected $phpVersion = null;

    /**
     * @var null|bool
     */
    protected $isDeinPim = null;

    /**
     * @var null|bool
     */
    protected $isDevelopment = null;

    /**
     * @var null|bool
     */
    protected $hasMinorUpdates = null;

    /**
     * @var null|bool
     */
    protected $hasMajorUpdates = null;

    /**
     * @var null|bool
     */
    protected $hasWirklichDigitalMinorUpdates = null;

    /**
     * @var null|bool
     */
    protected $hasWirklichDigitalMajorUpdates = null;

    /**
     * @var null|int
     */
    protected $lastUpdateValue = null;

    /**
     * @var null|\DateTime
     */
    protected $createdAt = null;

    /**
     * @var null|\DateTime
     */
    protected $updatedAt = null;

    /**
     * @var \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo[]|\Doctrine\Common\Collections\Collection
     */
    protected $laminasSystemServerDatabaseInfo = null;

    /**
     * @var \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerMigrationInfo[]|\Doctrine\Common\Collections\Collection
     */
    protected $laminasSystemServerMigrationInfo = null;

    /**
     * @var \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated[]|\Doctrine\Common\Collections\Collection
     */
    protected $laminasSystemServerComposerOutdated = null;

    /**
     * @var \WirklichDigital\SystemModuleOverview\Entity\NpmModules[]|\Doctrine\Common\Collections\Collection
     */
    protected $npmModules = null;

    /**
     * @var \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule[]|\Doctrine\Common\Collections\Collection
     */
    protected $laminasSystemServerModule = null;

    /**
     * @var null|\WirklichDigital\SystemModuleOverview\Entity\LaminasSystem
     */
    protected $laminasSystem = null;

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
    public function setId($id) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getUrl() : ?string
    {
        return $this->url;
    }

    /**
     * @param null|string $url
     */
    public function setUrl($url) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getIpAddress() : ?string
    {
        return $this->ipAddress;
    }

    /**
     * @param null|string $ipAddress
     */
    public function setIpAddress($ipAddress) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->ipAddress = $ipAddress;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPhpinfo() : ?string
    {
        return $this->phpinfo;
    }

    /**
     * @param null|string $phpinfo
     */
    public function setPhpinfo($phpinfo) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->phpinfo = $phpinfo;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getConfig() : ?string
    {
        return $this->config;
    }

    /**
     * @param null|string $config
     */
    public function setConfig($config) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getJ77Config() : ?string
    {
        return $this->j77Config;
    }

    /**
     * @param null|string $j77Config
     */
    public function setJ77Config($j77Config) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->j77Config = $j77Config;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPhpVersion() : ?string
    {
        return $this->phpVersion;
    }

    /**
     * @param null|string $phpVersion
     */
    public function setPhpVersion($phpVersion) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->phpVersion = $phpVersion;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getIsDeinPim() : ?bool
    {
        return $this->isDeinPim;
    }

    /**
     * @param null|bool $isDeinPim
     */
    public function setIsDeinPim($isDeinPim) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->isDeinPim = $isDeinPim;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getIsDevelopment() : ?bool
    {
        return $this->isDevelopment;
    }

    /**
     * @param null|bool $isDevelopment
     */
    public function setIsDevelopment($isDevelopment) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->isDevelopment = $isDevelopment;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getHasMinorUpdates() : ?bool
    {
        return $this->hasMinorUpdates;
    }

    /**
     * @param null|bool $hasMinorUpdates
     */
    public function setHasMinorUpdates($hasMinorUpdates) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->hasMinorUpdates = $hasMinorUpdates;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getHasMajorUpdates() : ?bool
    {
        return $this->hasMajorUpdates;
    }

    /**
     * @param null|bool $hasMajorUpdates
     */
    public function setHasMajorUpdates($hasMajorUpdates) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->hasMajorUpdates = $hasMajorUpdates;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getHasWirklichDigitalMinorUpdates() : ?bool
    {
        return $this->hasWirklichDigitalMinorUpdates;
    }

    /**
     * @param null|bool $hasWirklichDigitalMinorUpdates
     */
    public function setHasWirklichDigitalMinorUpdates($hasWirklichDigitalMinorUpdates) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->hasWirklichDigitalMinorUpdates = $hasWirklichDigitalMinorUpdates;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getHasWirklichDigitalMajorUpdates() : ?bool
    {
        return $this->hasWirklichDigitalMajorUpdates;
    }

    /**
     * @param null|bool $hasWirklichDigitalMajorUpdates
     */
    public function setHasWirklichDigitalMajorUpdates($hasWirklichDigitalMajorUpdates) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->hasWirklichDigitalMajorUpdates = $hasWirklichDigitalMajorUpdates;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getLastUpdateValue() : ?int
    {
        return $this->lastUpdateValue;
    }

    /**
     * @param null|int $lastUpdateValue
     */
    public function setLastUpdateValue($lastUpdateValue) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->lastUpdateValue = $lastUpdateValue;
        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getCreatedAt() : ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param null|\DateTime $createdAt
     */
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getUpdatedAt() : ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param null|\DateTime $updatedAt
     */
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo[]|\Doctrine\Common\Collections\Collection
     */
    public function getLaminasSystemServerDatabaseInfo() : \Doctrine\Common\Collections\Collection
    {
        return $this->laminasSystemServerDatabaseInfo;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo[]|\Doctrine\Common\Collections\Collection $laminasSystemServerDatabaseInfo
     */
    public function setLaminasSystemServerDatabaseInfo(\Doctrine\Common\Collections\Collection $laminasSystemServerDatabaseInfo) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->laminasSystemServerDatabaseInfo = $laminasSystemServerDatabaseInfo;
        if ($this->laminasSystemServerDatabaseInfo) {
            foreach ($this->laminasSystemServerDatabaseInfo as $_laminasSystemServerDatabaseInfo) {
                $_laminasSystemServerDatabaseInfo->setLaminasSystemServer($this);
            }
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo[]|\Doctrine\Common\Collections\Collection $laminasSystemServerDatabaseInfo
     */
    public function addLaminasSystemServerDatabaseInfo($laminasSystemServerDatabaseInfo) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        foreach ($laminasSystemServerDatabaseInfo as $_laminasSystemServerDatabaseInfo) {
            $_laminasSystemServerDatabaseInfo->setLaminasSystemServer($this);
            $this->laminasSystemServerDatabaseInfo->add($_laminasSystemServerDatabaseInfo);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo[]|\Doctrine\Common\Collections\Collection $laminasSystemServerDatabaseInfo
     */
    public function removeLaminasSystemServerDatabaseInfo($laminasSystemServerDatabaseInfo) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        foreach ($laminasSystemServerDatabaseInfo as $_laminasSystemServerDatabaseInfo) {
            $_laminasSystemServerDatabaseInfo->setLaminasSystemServer(null);
            $this->laminasSystemServerDatabaseInfo->removeElement($_laminasSystemServerDatabaseInfo);
        }
        return $this;
    }

    /**
     * @return \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerMigrationInfo[]|\Doctrine\Common\Collections\Collection
     */
    public function getLaminasSystemServerMigrationInfo() : \Doctrine\Common\Collections\Collection
    {
        return $this->laminasSystemServerMigrationInfo;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerMigrationInfo[]|\Doctrine\Common\Collections\Collection $laminasSystemServerMigrationInfo
     */
    public function setLaminasSystemServerMigrationInfo(\Doctrine\Common\Collections\Collection $laminasSystemServerMigrationInfo) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->laminasSystemServerMigrationInfo = $laminasSystemServerMigrationInfo;
        if ($this->laminasSystemServerMigrationInfo) {
            foreach ($this->laminasSystemServerMigrationInfo as $_laminasSystemServerMigrationInfo) {
                $_laminasSystemServerMigrationInfo->setLaminasSystemServer($this);
            }
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerMigrationInfo[]|\Doctrine\Common\Collections\Collection $laminasSystemServerMigrationInfo
     */
    public function addLaminasSystemServerMigrationInfo($laminasSystemServerMigrationInfo) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        foreach ($laminasSystemServerMigrationInfo as $_laminasSystemServerMigrationInfo) {
            $_laminasSystemServerMigrationInfo->setLaminasSystemServer($this);
            $this->laminasSystemServerMigrationInfo->add($_laminasSystemServerMigrationInfo);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerMigrationInfo[]|\Doctrine\Common\Collections\Collection $laminasSystemServerMigrationInfo
     */
    public function removeLaminasSystemServerMigrationInfo($laminasSystemServerMigrationInfo) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        foreach ($laminasSystemServerMigrationInfo as $_laminasSystemServerMigrationInfo) {
            $_laminasSystemServerMigrationInfo->setLaminasSystemServer(null);
            $this->laminasSystemServerMigrationInfo->removeElement($_laminasSystemServerMigrationInfo);
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
    public function setLaminasSystemServerComposerOutdated(\Doctrine\Common\Collections\Collection $laminasSystemServerComposerOutdated) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->laminasSystemServerComposerOutdated = $laminasSystemServerComposerOutdated;
        if ($this->laminasSystemServerComposerOutdated) {
            foreach ($this->laminasSystemServerComposerOutdated as $_laminasSystemServerComposerOutdated) {
                $_laminasSystemServerComposerOutdated->setLaminasSystemServer($this);
            }
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated[]|\Doctrine\Common\Collections\Collection $laminasSystemServerComposerOutdated
     */
    public function addLaminasSystemServerComposerOutdated($laminasSystemServerComposerOutdated) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        foreach ($laminasSystemServerComposerOutdated as $_laminasSystemServerComposerOutdated) {
            $_laminasSystemServerComposerOutdated->setLaminasSystemServer($this);
            $this->laminasSystemServerComposerOutdated->add($_laminasSystemServerComposerOutdated);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated[]|\Doctrine\Common\Collections\Collection $laminasSystemServerComposerOutdated
     */
    public function removeLaminasSystemServerComposerOutdated($laminasSystemServerComposerOutdated) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        foreach ($laminasSystemServerComposerOutdated as $_laminasSystemServerComposerOutdated) {
            $_laminasSystemServerComposerOutdated->setLaminasSystemServer(null);
            $this->laminasSystemServerComposerOutdated->removeElement($_laminasSystemServerComposerOutdated);
        }
        return $this;
    }

    /**
     * @return \WirklichDigital\SystemModuleOverview\Entity\NpmModules[]|\Doctrine\Common\Collections\Collection
     */
    public function getNpmModules() : \Doctrine\Common\Collections\Collection
    {
        return $this->npmModules;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\NpmModules[]|\Doctrine\Common\Collections\Collection $npmModules
     */
    public function setNpmModules(\Doctrine\Common\Collections\Collection $npmModules) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->npmModules = $npmModules;
        if ($this->npmModules) {
            foreach ($this->npmModules as $_npmModules) {
                $_npmModules->setLaminasSystemServer($this);
            }
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\NpmModules[]|\Doctrine\Common\Collections\Collection $npmModules
     */
    public function addNpmModules($npmModules) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        foreach ($npmModules as $_npmModules) {
            $_npmModules->setLaminasSystemServer($this);
            $this->npmModules->add($_npmModules);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\NpmModules[]|\Doctrine\Common\Collections\Collection $npmModules
     */
    public function removeNpmModules($npmModules) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        foreach ($npmModules as $_npmModules) {
            $_npmModules->setLaminasSystemServer(null);
            $this->npmModules->removeElement($_npmModules);
        }
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
    public function setLaminasSystemServerModule(\Doctrine\Common\Collections\Collection $laminasSystemServerModule) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->laminasSystemServerModule = $laminasSystemServerModule;
        return $this;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule[]|\Doctrine\Common\Collections\Collection $laminasSystemServerModule
     */
    public function addLaminasSystemServerModule($laminasSystemServerModule) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        foreach ($laminasSystemServerModule as $_laminasSystemServerModule) {
            $_laminasSystemServerModule->addLaminasSystemServer([$this]);
            $this->laminasSystemServerModule->add($_laminasSystemServerModule);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule[]|\Doctrine\Common\Collections\Collection $laminasSystemServerModule
     */
    public function removeLaminasSystemServerModule($laminasSystemServerModule) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        foreach ($laminasSystemServerModule as $_laminasSystemServerModule) {
            $_laminasSystemServerModule->removeLaminasSystemServer([$this]);
            $this->laminasSystemServerModule->removeElement($_laminasSystemServerModule);
        }
        return $this;
    }

    /**
     * @return null|\WirklichDigital\SystemModuleOverview\Entity\LaminasSystem
     */
    public function getLaminasSystem() : ?\WirklichDigital\SystemModuleOverview\Entity\LaminasSystem
    {
        return $this->laminasSystem;
    }

    /**
     * @param null|\WirklichDigital\SystemModuleOverview\Entity\LaminasSystem $laminasSystem
     */
    public function setLaminasSystem(?\WirklichDigital\SystemModuleOverview\Entity\LaminasSystem $laminasSystem) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        $this->laminasSystem = $laminasSystem;
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->laminasSystemServerDatabaseInfo = new ArrayCollection();
        $this->laminasSystemServerMigrationInfo = new ArrayCollection();
        $this->laminasSystemServerComposerOutdated = new ArrayCollection();
        $this->npmModules = new ArrayCollection();
        $this->laminasSystemServerModule = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->laminasSystemServerDatabaseInfo = clone $this->laminasSystemServerDatabaseInfo;
        $this->laminasSystemServerMigrationInfo = clone $this->laminasSystemServerMigrationInfo;
        $this->laminasSystemServerComposerOutdated = clone $this->laminasSystemServerComposerOutdated;
        $this->npmModules = clone $this->npmModules;
        $this->laminasSystemServerModule = clone $this->laminasSystemServerModule;
    }
}


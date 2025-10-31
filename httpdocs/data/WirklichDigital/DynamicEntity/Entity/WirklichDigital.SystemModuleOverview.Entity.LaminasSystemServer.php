<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystem;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerMigrationInfo;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule;
use WirklichDigital\SystemModuleOverview\Entity\NpmModules;

class LaminasSystemServer extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $url;

    /** @var null|string */
    protected $ipAddress;

    /** @var null|string */
    protected $phpinfo;

    /** @var null|string */
    protected $config;

    /** @var null|string */
    protected $j77Config;

    /** @var null|string */
    protected $phpVersion;

    /** @var null|bool */
    protected $isDeinPim;

    /** @var null|bool */
    protected $isDevelopment;

    /** @var null|bool */
    protected $hasMinorUpdates;

    /** @var null|bool */
    protected $hasMajorUpdates;

    /** @var null|bool */
    protected $hasWirklichDigitalMinorUpdates;

    /** @var null|bool */
    protected $hasWirklichDigitalMajorUpdates;

    /** @var null|int */
    protected $lastUpdateValue;

    /** @var null|DateTime */
    protected $createdAt;

    /** @var null|DateTime */
    protected $updatedAt;

    /** @var LaminasSystemServerDatabaseInfo[]|Collection */
    protected $laminasSystemServerDatabaseInfo;

    /** @var LaminasSystemServerMigrationInfo[]|Collection */
    protected $laminasSystemServerMigrationInfo;

    /** @var LaminasSystemServerComposerOutdated[]|Collection */
    protected $laminasSystemServerComposerOutdated;

    /** @var NpmModules[]|Collection */
    protected $npmModules;

    /** @var LaminasSystemServerModule[]|Collection */
    protected $laminasSystemServerModule;

    /** @var null|LaminasSystem */
    protected $laminasSystem;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): LaminasSystemServer
    {
        $this->id = $id;
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param null|string $url
     */
    public function setUrl($url): LaminasSystemServer
    {
        $this->url = $url;
        return $this;
    }

    public function getIpAddress(): ?string
    {
        return $this->ipAddress;
    }

    /**
     * @param null|string $ipAddress
     */
    public function setIpAddress($ipAddress): LaminasSystemServer
    {
        $this->ipAddress = $ipAddress;
        return $this;
    }

    public function getPhpinfo(): ?string
    {
        return $this->phpinfo;
    }

    /**
     * @param null|string $phpinfo
     */
    public function setPhpinfo($phpinfo): LaminasSystemServer
    {
        $this->phpinfo = $phpinfo;
        return $this;
    }

    public function getConfig(): ?string
    {
        return $this->config;
    }

    /**
     * @param null|string $config
     */
    public function setConfig($config): LaminasSystemServer
    {
        $this->config = $config;
        return $this;
    }

    public function getJ77Config(): ?string
    {
        return $this->j77Config;
    }

    /**
     * @param null|string $j77Config
     */
    public function setJ77Config($j77Config): LaminasSystemServer
    {
        $this->j77Config = $j77Config;
        return $this;
    }

    public function getPhpVersion(): ?string
    {
        return $this->phpVersion;
    }

    /**
     * @param null|string $phpVersion
     */
    public function setPhpVersion($phpVersion): LaminasSystemServer
    {
        $this->phpVersion = $phpVersion;
        return $this;
    }

    public function getIsDeinPim(): ?bool
    {
        return $this->isDeinPim;
    }

    /**
     * @param null|bool $isDeinPim
     */
    public function setIsDeinPim($isDeinPim): LaminasSystemServer
    {
        $this->isDeinPim = $isDeinPim;
        return $this;
    }

    public function getIsDevelopment(): ?bool
    {
        return $this->isDevelopment;
    }

    /**
     * @param null|bool $isDevelopment
     */
    public function setIsDevelopment($isDevelopment): LaminasSystemServer
    {
        $this->isDevelopment = $isDevelopment;
        return $this;
    }

    public function getHasMinorUpdates(): ?bool
    {
        return $this->hasMinorUpdates;
    }

    /**
     * @param null|bool $hasMinorUpdates
     */
    public function setHasMinorUpdates($hasMinorUpdates): LaminasSystemServer
    {
        $this->hasMinorUpdates = $hasMinorUpdates;
        return $this;
    }

    public function getHasMajorUpdates(): ?bool
    {
        return $this->hasMajorUpdates;
    }

    /**
     * @param null|bool $hasMajorUpdates
     */
    public function setHasMajorUpdates($hasMajorUpdates): LaminasSystemServer
    {
        $this->hasMajorUpdates = $hasMajorUpdates;
        return $this;
    }

    public function getHasWirklichDigitalMinorUpdates(): ?bool
    {
        return $this->hasWirklichDigitalMinorUpdates;
    }

    /**
     * @param null|bool $hasWirklichDigitalMinorUpdates
     */
    public function setHasWirklichDigitalMinorUpdates($hasWirklichDigitalMinorUpdates): LaminasSystemServer
    {
        $this->hasWirklichDigitalMinorUpdates = $hasWirklichDigitalMinorUpdates;
        return $this;
    }

    public function getHasWirklichDigitalMajorUpdates(): ?bool
    {
        return $this->hasWirklichDigitalMajorUpdates;
    }

    /**
     * @param null|bool $hasWirklichDigitalMajorUpdates
     */
    public function setHasWirklichDigitalMajorUpdates($hasWirklichDigitalMajorUpdates): LaminasSystemServer
    {
        $this->hasWirklichDigitalMajorUpdates = $hasWirklichDigitalMajorUpdates;
        return $this;
    }

    public function getLastUpdateValue(): ?int
    {
        return $this->lastUpdateValue;
    }

    /**
     * @param null|int $lastUpdateValue
     */
    public function setLastUpdateValue($lastUpdateValue): LaminasSystemServer
    {
        $this->lastUpdateValue = $lastUpdateValue;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): LaminasSystemServer
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): LaminasSystemServer
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return LaminasSystemServerDatabaseInfo[]|Collection
     */
    public function getLaminasSystemServerDatabaseInfo(): Collection
    {
        return $this->laminasSystemServerDatabaseInfo;
    }

    /**
     * @param LaminasSystemServerDatabaseInfo[]|Collection $laminasSystemServerDatabaseInfo
     */
    public function setLaminasSystemServerDatabaseInfo(Collection $laminasSystemServerDatabaseInfo): LaminasSystemServer
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
     * @param LaminasSystemServerDatabaseInfo[]|Collection $laminasSystemServerDatabaseInfo
     */
    public function addLaminasSystemServerDatabaseInfo($laminasSystemServerDatabaseInfo): LaminasSystemServer
    {
        foreach ($laminasSystemServerDatabaseInfo as $_laminasSystemServerDatabaseInfo) {
            $_laminasSystemServerDatabaseInfo->setLaminasSystemServer($this);
            $this->laminasSystemServerDatabaseInfo->add($_laminasSystemServerDatabaseInfo);
        }
        return $this;
    }

    /**
     * @param LaminasSystemServerDatabaseInfo[]|Collection $laminasSystemServerDatabaseInfo
     */
    public function removeLaminasSystemServerDatabaseInfo($laminasSystemServerDatabaseInfo): LaminasSystemServer
    {
        foreach ($laminasSystemServerDatabaseInfo as $_laminasSystemServerDatabaseInfo) {
            $_laminasSystemServerDatabaseInfo->setLaminasSystemServer(null);
            $this->laminasSystemServerDatabaseInfo->removeElement($_laminasSystemServerDatabaseInfo);
        }
        return $this;
    }

    /**
     * @return LaminasSystemServerMigrationInfo[]|Collection
     */
    public function getLaminasSystemServerMigrationInfo(): Collection
    {
        return $this->laminasSystemServerMigrationInfo;
    }

    /**
     * @param LaminasSystemServerMigrationInfo[]|Collection $laminasSystemServerMigrationInfo
     */
    public function setLaminasSystemServerMigrationInfo(Collection $laminasSystemServerMigrationInfo): LaminasSystemServer
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
     * @param LaminasSystemServerMigrationInfo[]|Collection $laminasSystemServerMigrationInfo
     */
    public function addLaminasSystemServerMigrationInfo($laminasSystemServerMigrationInfo): LaminasSystemServer
    {
        foreach ($laminasSystemServerMigrationInfo as $_laminasSystemServerMigrationInfo) {
            $_laminasSystemServerMigrationInfo->setLaminasSystemServer($this);
            $this->laminasSystemServerMigrationInfo->add($_laminasSystemServerMigrationInfo);
        }
        return $this;
    }

    /**
     * @param LaminasSystemServerMigrationInfo[]|Collection $laminasSystemServerMigrationInfo
     */
    public function removeLaminasSystemServerMigrationInfo($laminasSystemServerMigrationInfo): LaminasSystemServer
    {
        foreach ($laminasSystemServerMigrationInfo as $_laminasSystemServerMigrationInfo) {
            $_laminasSystemServerMigrationInfo->setLaminasSystemServer(null);
            $this->laminasSystemServerMigrationInfo->removeElement($_laminasSystemServerMigrationInfo);
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
    public function setLaminasSystemServerComposerOutdated(Collection $laminasSystemServerComposerOutdated): LaminasSystemServer
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
     * @param LaminasSystemServerComposerOutdated[]|Collection $laminasSystemServerComposerOutdated
     */
    public function addLaminasSystemServerComposerOutdated($laminasSystemServerComposerOutdated): LaminasSystemServer
    {
        foreach ($laminasSystemServerComposerOutdated as $_laminasSystemServerComposerOutdated) {
            $_laminasSystemServerComposerOutdated->setLaminasSystemServer($this);
            $this->laminasSystemServerComposerOutdated->add($_laminasSystemServerComposerOutdated);
        }
        return $this;
    }

    /**
     * @param LaminasSystemServerComposerOutdated[]|Collection $laminasSystemServerComposerOutdated
     */
    public function removeLaminasSystemServerComposerOutdated($laminasSystemServerComposerOutdated): LaminasSystemServer
    {
        foreach ($laminasSystemServerComposerOutdated as $_laminasSystemServerComposerOutdated) {
            $_laminasSystemServerComposerOutdated->setLaminasSystemServer(null);
            $this->laminasSystemServerComposerOutdated->removeElement($_laminasSystemServerComposerOutdated);
        }
        return $this;
    }

    /**
     * @return NpmModules[]|Collection
     */
    public function getNpmModules(): Collection
    {
        return $this->npmModules;
    }

    /**
     * @param NpmModules[]|Collection $npmModules
     */
    public function setNpmModules(Collection $npmModules): LaminasSystemServer
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
     * @param NpmModules[]|Collection $npmModules
     */
    public function addNpmModules($npmModules): LaminasSystemServer
    {
        foreach ($npmModules as $_npmModules) {
            $_npmModules->setLaminasSystemServer($this);
            $this->npmModules->add($_npmModules);
        }
        return $this;
    }

    /**
     * @param NpmModules[]|Collection $npmModules
     */
    public function removeNpmModules($npmModules): LaminasSystemServer
    {
        foreach ($npmModules as $_npmModules) {
            $_npmModules->setLaminasSystemServer(null);
            $this->npmModules->removeElement($_npmModules);
        }
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
    public function setLaminasSystemServerModule(Collection $laminasSystemServerModule): LaminasSystemServer
    {
        $this->laminasSystemServerModule = $laminasSystemServerModule;
        return $this;
    }

    /**
     * @param LaminasSystemServerModule[]|Collection $laminasSystemServerModule
     */
    public function addLaminasSystemServerModule($laminasSystemServerModule): LaminasSystemServer
    {
        foreach ($laminasSystemServerModule as $_laminasSystemServerModule) {
            $_laminasSystemServerModule->addLaminasSystemServer([$this]);
            $this->laminasSystemServerModule->add($_laminasSystemServerModule);
        }
        return $this;
    }

    /**
     * @param LaminasSystemServerModule[]|Collection $laminasSystemServerModule
     */
    public function removeLaminasSystemServerModule($laminasSystemServerModule): LaminasSystemServer
    {
        foreach ($laminasSystemServerModule as $_laminasSystemServerModule) {
            $_laminasSystemServerModule->removeLaminasSystemServer([$this]);
            $this->laminasSystemServerModule->removeElement($_laminasSystemServerModule);
        }
        return $this;
    }

    public function getLaminasSystem(): ?LaminasSystem
    {
        return $this->laminasSystem;
    }

    public function setLaminasSystem(?LaminasSystem $laminasSystem): LaminasSystemServer
    {
        $this->laminasSystem = $laminasSystem;
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->laminasSystemServerDatabaseInfo     = new ArrayCollection();
        $this->laminasSystemServerMigrationInfo    = new ArrayCollection();
        $this->laminasSystemServerComposerOutdated = new ArrayCollection();
        $this->npmModules                          = new ArrayCollection();
        $this->laminasSystemServerModule           = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->laminasSystemServerDatabaseInfo     = clone $this->laminasSystemServerDatabaseInfo;
        $this->laminasSystemServerMigrationInfo    = clone $this->laminasSystemServerMigrationInfo;
        $this->laminasSystemServerComposerOutdated = clone $this->laminasSystemServerComposerOutdated;
        $this->npmModules                          = clone $this->npmModules;
        $this->laminasSystemServerModule           = clone $this->laminasSystemServerModule;
    }
}

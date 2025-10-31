<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SystemModuleOverview\Entity\ComposerModule;

class LaminasSystemServerModule extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $moduleName;

    /** @var null|string */
    protected $moduleVersion;

    /** @var null|string */
    protected $moduleVersionNormalized;

    protected $moduleSource;

    protected $moduleDist;

    protected $moduleRequire;

    protected $moduleConflict;

    protected $moduleProvide;

    protected $moduleReplace;

    protected $moduleRequiredev;

    protected $moduleSuggest;

    /** @var null|string */
    protected $moduleTime;

    protected $moduleBin;

    /** @var null|string */
    protected $moduleType;

    protected $moduleExtra;

    /** @var null|string */
    protected $moduleInstallationsource;

    protected $moduleAutoload;

    protected $moduleAutoloaddev;

    protected $moduleScripts;

    /** @var null|string */
    protected $moduleNotificationurl;

    protected $moduleLicense;

    protected $moduleIncludepath;

    protected $moduleAuthors;

    /** @var null|string */
    protected $moduleDescription;

    /** @var null|string */
    protected $moduleHomepage;

    protected $moduleKeywords;

    protected $moduleSupport;

    protected $moduleFunding;

    /** @var null|string */
    protected $moduleAbandoned;

    /** @var null|string */
    protected $moduleInstallpath;

    /** @var LaminasSystemServer[]|Collection */
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
    public function setId($id): LaminasSystemServerModule
    {
        $this->id = $id;
        return $this;
    }

    public function getModuleName(): ?string
    {
        return $this->moduleName;
    }

    /**
     * @param null|string $moduleName
     */
    public function setModuleName($moduleName): LaminasSystemServerModule
    {
        $this->moduleName = $moduleName;
        return $this;
    }

    public function getModuleVersion(): ?string
    {
        return $this->moduleVersion;
    }

    /**
     * @param null|string $moduleVersion
     */
    public function setModuleVersion($moduleVersion): LaminasSystemServerModule
    {
        $this->moduleVersion = $moduleVersion;
        return $this;
    }

    public function getModuleVersionNormalized(): ?string
    {
        return $this->moduleVersionNormalized;
    }

    /**
     * @param null|string $moduleVersionNormalized
     */
    public function setModuleVersionNormalized($moduleVersionNormalized): LaminasSystemServerModule
    {
        $this->moduleVersionNormalized = $moduleVersionNormalized;
        return $this;
    }

    public function getModuleSource()
    {
        return $this->moduleSource;
    }

    public function setModuleSource($moduleSource): LaminasSystemServerModule
    {
        $this->moduleSource = $moduleSource;
        return $this;
    }

    public function getModuleDist()
    {
        return $this->moduleDist;
    }

    public function setModuleDist($moduleDist): LaminasSystemServerModule
    {
        $this->moduleDist = $moduleDist;
        return $this;
    }

    public function getModuleRequire()
    {
        return $this->moduleRequire;
    }

    public function setModuleRequire($moduleRequire): LaminasSystemServerModule
    {
        $this->moduleRequire = $moduleRequire;
        return $this;
    }

    public function getModuleConflict()
    {
        return $this->moduleConflict;
    }

    public function setModuleConflict($moduleConflict): LaminasSystemServerModule
    {
        $this->moduleConflict = $moduleConflict;
        return $this;
    }

    public function getModuleProvide()
    {
        return $this->moduleProvide;
    }

    public function setModuleProvide($moduleProvide): LaminasSystemServerModule
    {
        $this->moduleProvide = $moduleProvide;
        return $this;
    }

    public function getModuleReplace()
    {
        return $this->moduleReplace;
    }

    public function setModuleReplace($moduleReplace): LaminasSystemServerModule
    {
        $this->moduleReplace = $moduleReplace;
        return $this;
    }

    public function getModuleRequiredev()
    {
        return $this->moduleRequiredev;
    }

    public function setModuleRequiredev($moduleRequiredev): LaminasSystemServerModule
    {
        $this->moduleRequiredev = $moduleRequiredev;
        return $this;
    }

    public function getModuleSuggest()
    {
        return $this->moduleSuggest;
    }

    public function setModuleSuggest($moduleSuggest): LaminasSystemServerModule
    {
        $this->moduleSuggest = $moduleSuggest;
        return $this;
    }

    public function getModuleTime(): ?string
    {
        return $this->moduleTime;
    }

    /**
     * @param null|string $moduleTime
     */
    public function setModuleTime($moduleTime): LaminasSystemServerModule
    {
        $this->moduleTime = $moduleTime;
        return $this;
    }

    public function getModuleBin()
    {
        return $this->moduleBin;
    }

    public function setModuleBin($moduleBin): LaminasSystemServerModule
    {
        $this->moduleBin = $moduleBin;
        return $this;
    }

    public function getModuleType(): ?string
    {
        return $this->moduleType;
    }

    /**
     * @param null|string $moduleType
     */
    public function setModuleType($moduleType): LaminasSystemServerModule
    {
        $this->moduleType = $moduleType;
        return $this;
    }

    public function getModuleExtra()
    {
        return $this->moduleExtra;
    }

    public function setModuleExtra($moduleExtra): LaminasSystemServerModule
    {
        $this->moduleExtra = $moduleExtra;
        return $this;
    }

    public function getModuleInstallationsource(): ?string
    {
        return $this->moduleInstallationsource;
    }

    /**
     * @param null|string $moduleInstallationsource
     */
    public function setModuleInstallationsource($moduleInstallationsource): LaminasSystemServerModule
    {
        $this->moduleInstallationsource = $moduleInstallationsource;
        return $this;
    }

    public function getModuleAutoload()
    {
        return $this->moduleAutoload;
    }

    public function setModuleAutoload($moduleAutoload): LaminasSystemServerModule
    {
        $this->moduleAutoload = $moduleAutoload;
        return $this;
    }

    public function getModuleAutoloaddev()
    {
        return $this->moduleAutoloaddev;
    }

    public function setModuleAutoloaddev($moduleAutoloaddev): LaminasSystemServerModule
    {
        $this->moduleAutoloaddev = $moduleAutoloaddev;
        return $this;
    }

    public function getModuleScripts()
    {
        return $this->moduleScripts;
    }

    public function setModuleScripts($moduleScripts): LaminasSystemServerModule
    {
        $this->moduleScripts = $moduleScripts;
        return $this;
    }

    public function getModuleNotificationurl(): ?string
    {
        return $this->moduleNotificationurl;
    }

    /**
     * @param null|string $moduleNotificationurl
     */
    public function setModuleNotificationurl($moduleNotificationurl): LaminasSystemServerModule
    {
        $this->moduleNotificationurl = $moduleNotificationurl;
        return $this;
    }

    public function getModuleLicense()
    {
        return $this->moduleLicense;
    }

    public function setModuleLicense($moduleLicense): LaminasSystemServerModule
    {
        $this->moduleLicense = $moduleLicense;
        return $this;
    }

    public function getModuleIncludepath()
    {
        return $this->moduleIncludepath;
    }

    public function setModuleIncludepath($moduleIncludepath): LaminasSystemServerModule
    {
        $this->moduleIncludepath = $moduleIncludepath;
        return $this;
    }

    public function getModuleAuthors()
    {
        return $this->moduleAuthors;
    }

    public function setModuleAuthors($moduleAuthors): LaminasSystemServerModule
    {
        $this->moduleAuthors = $moduleAuthors;
        return $this;
    }

    public function getModuleDescription(): ?string
    {
        return $this->moduleDescription;
    }

    /**
     * @param null|string $moduleDescription
     */
    public function setModuleDescription($moduleDescription): LaminasSystemServerModule
    {
        $this->moduleDescription = $moduleDescription;
        return $this;
    }

    public function getModuleHomepage(): ?string
    {
        return $this->moduleHomepage;
    }

    /**
     * @param null|string $moduleHomepage
     */
    public function setModuleHomepage($moduleHomepage): LaminasSystemServerModule
    {
        $this->moduleHomepage = $moduleHomepage;
        return $this;
    }

    public function getModuleKeywords()
    {
        return $this->moduleKeywords;
    }

    public function setModuleKeywords($moduleKeywords): LaminasSystemServerModule
    {
        $this->moduleKeywords = $moduleKeywords;
        return $this;
    }

    public function getModuleSupport()
    {
        return $this->moduleSupport;
    }

    public function setModuleSupport($moduleSupport): LaminasSystemServerModule
    {
        $this->moduleSupport = $moduleSupport;
        return $this;
    }

    public function getModuleFunding()
    {
        return $this->moduleFunding;
    }

    public function setModuleFunding($moduleFunding): LaminasSystemServerModule
    {
        $this->moduleFunding = $moduleFunding;
        return $this;
    }

    public function getModuleAbandoned(): ?string
    {
        return $this->moduleAbandoned;
    }

    /**
     * @param null|string $moduleAbandoned
     */
    public function setModuleAbandoned($moduleAbandoned): LaminasSystemServerModule
    {
        $this->moduleAbandoned = $moduleAbandoned;
        return $this;
    }

    public function getModuleInstallpath(): ?string
    {
        return $this->moduleInstallpath;
    }

    /**
     * @param null|string $moduleInstallpath
     */
    public function setModuleInstallpath($moduleInstallpath): LaminasSystemServerModule
    {
        $this->moduleInstallpath = $moduleInstallpath;
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
    public function setLaminasSystemServer(Collection $laminasSystemServer): LaminasSystemServerModule
    {
        $this->laminasSystemServer = $laminasSystemServer;
        return $this;
    }

    /**
     * @param LaminasSystemServer[]|Collection $laminasSystemServer
     */
    public function addLaminasSystemServer($laminasSystemServer): LaminasSystemServerModule
    {
        foreach ($laminasSystemServer as $_laminasSystemServer) {
            $this->laminasSystemServer->add($_laminasSystemServer);
        }
        return $this;
    }

    /**
     * @param LaminasSystemServer[]|Collection $laminasSystemServer
     */
    public function removeLaminasSystemServer($laminasSystemServer): LaminasSystemServerModule
    {
        foreach ($laminasSystemServer as $_laminasSystemServer) {
            $this->laminasSystemServer->removeElement($_laminasSystemServer);
        }
        return $this;
    }

    public function getComposerModule(): ?ComposerModule
    {
        return $this->composerModule;
    }

    public function setComposerModule(?ComposerModule $composerModule): LaminasSystemServerModule
    {
        $this->composerModule = $composerModule;
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

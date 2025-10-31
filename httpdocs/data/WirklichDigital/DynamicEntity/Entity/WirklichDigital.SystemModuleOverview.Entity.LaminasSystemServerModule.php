<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class LaminasSystemServerModule extends AbstractEntity
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $moduleName = null;

    /**
     * @var null|string
     */
    protected $moduleVersion = null;

    /**
     * @var null|string
     */
    protected $moduleVersionNormalized = null;

    protected $moduleSource = null;

    protected $moduleDist = null;

    protected $moduleRequire = null;

    protected $moduleConflict = null;

    protected $moduleProvide = null;

    protected $moduleReplace = null;

    protected $moduleRequiredev = null;

    protected $moduleSuggest = null;

    /**
     * @var null|string
     */
    protected $moduleTime = null;

    protected $moduleBin = null;

    /**
     * @var null|string
     */
    protected $moduleType = null;

    protected $moduleExtra = null;

    /**
     * @var null|string
     */
    protected $moduleInstallationsource = null;

    protected $moduleAutoload = null;

    protected $moduleAutoloaddev = null;

    protected $moduleScripts = null;

    /**
     * @var null|string
     */
    protected $moduleNotificationurl = null;

    protected $moduleLicense = null;

    protected $moduleIncludepath = null;

    protected $moduleAuthors = null;

    /**
     * @var null|string
     */
    protected $moduleDescription = null;

    /**
     * @var null|string
     */
    protected $moduleHomepage = null;

    protected $moduleKeywords = null;

    protected $moduleSupport = null;

    protected $moduleFunding = null;

    /**
     * @var null|string
     */
    protected $moduleAbandoned = null;

    /**
     * @var null|string
     */
    protected $moduleInstallpath = null;

    /**
     * @var \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer[]|\Doctrine\Common\Collections\Collection
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
    public function setId($id) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getModuleName() : ?string
    {
        return $this->moduleName;
    }

    /**
     * @param null|string $moduleName
     */
    public function setModuleName($moduleName) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleName = $moduleName;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getModuleVersion() : ?string
    {
        return $this->moduleVersion;
    }

    /**
     * @param null|string $moduleVersion
     */
    public function setModuleVersion($moduleVersion) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleVersion = $moduleVersion;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getModuleVersionNormalized() : ?string
    {
        return $this->moduleVersionNormalized;
    }

    /**
     * @param null|string $moduleVersionNormalized
     */
    public function setModuleVersionNormalized($moduleVersionNormalized) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleVersionNormalized = $moduleVersionNormalized;
        return $this;
    }

    public function getModuleSource()
    {
        return $this->moduleSource;
    }

    public function setModuleSource($moduleSource) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleSource = $moduleSource;
        return $this;
    }

    public function getModuleDist()
    {
        return $this->moduleDist;
    }

    public function setModuleDist($moduleDist) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleDist = $moduleDist;
        return $this;
    }

    public function getModuleRequire()
    {
        return $this->moduleRequire;
    }

    public function setModuleRequire($moduleRequire) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleRequire = $moduleRequire;
        return $this;
    }

    public function getModuleConflict()
    {
        return $this->moduleConflict;
    }

    public function setModuleConflict($moduleConflict) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleConflict = $moduleConflict;
        return $this;
    }

    public function getModuleProvide()
    {
        return $this->moduleProvide;
    }

    public function setModuleProvide($moduleProvide) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleProvide = $moduleProvide;
        return $this;
    }

    public function getModuleReplace()
    {
        return $this->moduleReplace;
    }

    public function setModuleReplace($moduleReplace) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleReplace = $moduleReplace;
        return $this;
    }

    public function getModuleRequiredev()
    {
        return $this->moduleRequiredev;
    }

    public function setModuleRequiredev($moduleRequiredev) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleRequiredev = $moduleRequiredev;
        return $this;
    }

    public function getModuleSuggest()
    {
        return $this->moduleSuggest;
    }

    public function setModuleSuggest($moduleSuggest) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleSuggest = $moduleSuggest;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getModuleTime() : ?string
    {
        return $this->moduleTime;
    }

    /**
     * @param null|string $moduleTime
     */
    public function setModuleTime($moduleTime) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleTime = $moduleTime;
        return $this;
    }

    public function getModuleBin()
    {
        return $this->moduleBin;
    }

    public function setModuleBin($moduleBin) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleBin = $moduleBin;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getModuleType() : ?string
    {
        return $this->moduleType;
    }

    /**
     * @param null|string $moduleType
     */
    public function setModuleType($moduleType) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleType = $moduleType;
        return $this;
    }

    public function getModuleExtra()
    {
        return $this->moduleExtra;
    }

    public function setModuleExtra($moduleExtra) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleExtra = $moduleExtra;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getModuleInstallationsource() : ?string
    {
        return $this->moduleInstallationsource;
    }

    /**
     * @param null|string $moduleInstallationsource
     */
    public function setModuleInstallationsource($moduleInstallationsource) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleInstallationsource = $moduleInstallationsource;
        return $this;
    }

    public function getModuleAutoload()
    {
        return $this->moduleAutoload;
    }

    public function setModuleAutoload($moduleAutoload) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleAutoload = $moduleAutoload;
        return $this;
    }

    public function getModuleAutoloaddev()
    {
        return $this->moduleAutoloaddev;
    }

    public function setModuleAutoloaddev($moduleAutoloaddev) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleAutoloaddev = $moduleAutoloaddev;
        return $this;
    }

    public function getModuleScripts()
    {
        return $this->moduleScripts;
    }

    public function setModuleScripts($moduleScripts) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleScripts = $moduleScripts;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getModuleNotificationurl() : ?string
    {
        return $this->moduleNotificationurl;
    }

    /**
     * @param null|string $moduleNotificationurl
     */
    public function setModuleNotificationurl($moduleNotificationurl) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleNotificationurl = $moduleNotificationurl;
        return $this;
    }

    public function getModuleLicense()
    {
        return $this->moduleLicense;
    }

    public function setModuleLicense($moduleLicense) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleLicense = $moduleLicense;
        return $this;
    }

    public function getModuleIncludepath()
    {
        return $this->moduleIncludepath;
    }

    public function setModuleIncludepath($moduleIncludepath) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleIncludepath = $moduleIncludepath;
        return $this;
    }

    public function getModuleAuthors()
    {
        return $this->moduleAuthors;
    }

    public function setModuleAuthors($moduleAuthors) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleAuthors = $moduleAuthors;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getModuleDescription() : ?string
    {
        return $this->moduleDescription;
    }

    /**
     * @param null|string $moduleDescription
     */
    public function setModuleDescription($moduleDescription) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleDescription = $moduleDescription;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getModuleHomepage() : ?string
    {
        return $this->moduleHomepage;
    }

    /**
     * @param null|string $moduleHomepage
     */
    public function setModuleHomepage($moduleHomepage) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleHomepage = $moduleHomepage;
        return $this;
    }

    public function getModuleKeywords()
    {
        return $this->moduleKeywords;
    }

    public function setModuleKeywords($moduleKeywords) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleKeywords = $moduleKeywords;
        return $this;
    }

    public function getModuleSupport()
    {
        return $this->moduleSupport;
    }

    public function setModuleSupport($moduleSupport) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleSupport = $moduleSupport;
        return $this;
    }

    public function getModuleFunding()
    {
        return $this->moduleFunding;
    }

    public function setModuleFunding($moduleFunding) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleFunding = $moduleFunding;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getModuleAbandoned() : ?string
    {
        return $this->moduleAbandoned;
    }

    /**
     * @param null|string $moduleAbandoned
     */
    public function setModuleAbandoned($moduleAbandoned) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleAbandoned = $moduleAbandoned;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getModuleInstallpath() : ?string
    {
        return $this->moduleInstallpath;
    }

    /**
     * @param null|string $moduleInstallpath
     */
    public function setModuleInstallpath($moduleInstallpath) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->moduleInstallpath = $moduleInstallpath;
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
    public function setLaminasSystemServer(\Doctrine\Common\Collections\Collection $laminasSystemServer) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        $this->laminasSystemServer = $laminasSystemServer;
        return $this;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer[]|\Doctrine\Common\Collections\Collection $laminasSystemServer
     */
    public function addLaminasSystemServer($laminasSystemServer) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        foreach ($laminasSystemServer as $_laminasSystemServer) {
            $this->laminasSystemServer->add($_laminasSystemServer);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer[]|\Doctrine\Common\Collections\Collection $laminasSystemServer
     */
    public function removeLaminasSystemServer($laminasSystemServer) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
    {
        foreach ($laminasSystemServer as $_laminasSystemServer) {
            $this->laminasSystemServer->removeElement($_laminasSystemServer);
        }
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
    public function setComposerModule(?\WirklichDigital\SystemModuleOverview\Entity\ComposerModule $composerModule) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule
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


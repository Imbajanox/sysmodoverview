<?php

namespace WirklichDigital\SyshelperBase\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SyshelperAlerts\Entity\Alert;
use WirklichDigital\SyshelperBase\Entity\AssignedIp;
use WirklichDigital\SyshelperBase\Entity\HostRawFact;
use WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping;
use WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin;
use WirklichDigital\SyshelperBase\Entity\SyshelperTag;

class Host extends AbstractEntity
{
    protected $id;

    /** @var null|string */
    protected $name;

    /** @var null|string */
    protected $syshelperDescription;

    /** @var null|DateTime */
    protected $lastConnectionAt;

    protected $connectionIp;

    /** @var null|string */
    protected $systemUuid;

    /** @var null|string */
    protected $scriptVersion;

    /** @var null|string */
    protected $fqdn;

    /** @var null|string */
    protected $externalIpV4;

    /** @var null|string */
    protected $externalIpV6;

    protected $nameservers;

    protected $interfaces;

    protected $servicesListening;

    protected $processesRunning;

    /** @var null|string */
    protected $puppetVersion;

    /** @var null|bool */
    protected $puppetIsOK;

    /** @var null|string */
    protected $webserverVersionApache;

    /** @var null|string */
    protected $webserverVersionNginx;

    protected $webserverDomainsApache;

    protected $webserverDomainsNginx;

    /** @var null|bool */
    protected $isVirtual;

    /** @var null|int */
    protected $cpuCores;

    /** @var null|string */
    protected $cpuModel;

    /** @var null|int */
    protected $ramSizeKb;

    /** @var null|int */
    protected $ramAvailableKb;

    protected $disks;

    /** @var null|string */
    protected $osName;

    /** @var null|string */
    protected $osVersion;

    /** @var null|string */
    protected $kernelVersion;

    protected $packagesAptMirrors;

    /** @var null|bool */
    protected $packagesAptHasRepoError;

    protected $packagesAptUpgradable;

    protected $packagesInstalled;

    /** @var null|string */
    protected $pleskVersion;

    /** @var null|bool */
    protected $pleskBackupIsDone;

    /** @var null|bool */
    protected $pleskBackupHasError;

    /** @var null|int */
    protected $mailqCount;

    /** @var null|string */
    protected $proxmoxVersion;

    /** @var null|int */
    protected $uptimeSeconds;

    /** @var null|DateTime */
    protected $createdAt;

    /** @var null|DateTime */
    protected $updatedAt;

    /** @var AssignedIp[]|Collection */
    protected $assignedIps;

    /** @var HostRawFact[]|Collection */
    protected $rawFacts;

    /** @var SshPublicKeyHostMapping[]|Collection */
    protected $sshPublicKeyHostMappings;

    /** @var SshPublicKeyLogin[]|Collection */
    protected $sshPublicKeyLogins;

    /** @var Alert[]|Collection */
    protected $alerts;

    /** @var SyshelperTag[]|Collection */
    protected $tags;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): Host
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
    public function setName($name): Host
    {
        $this->name = $name;
        return $this;
    }

    public function getSyshelperDescription(): ?string
    {
        return $this->syshelperDescription;
    }

    /**
     * @param null|string $syshelperDescription
     */
    public function setSyshelperDescription($syshelperDescription): Host
    {
        $this->syshelperDescription = $syshelperDescription;
        return $this;
    }

    public function getLastConnectionAt(): ?DateTime
    {
        return $this->lastConnectionAt;
    }

    public function setLastConnectionAt(?DateTime $lastConnectionAt): Host
    {
        $this->lastConnectionAt = $lastConnectionAt;
        return $this;
    }

    public function getConnectionIp()
    {
        return $this->connectionIp;
    }

    public function setConnectionIp($connectionIp): Host
    {
        $this->connectionIp = $connectionIp;
        return $this;
    }

    public function getSystemUuid(): ?string
    {
        return $this->systemUuid;
    }

    /**
     * @param null|string $systemUuid
     */
    public function setSystemUuid($systemUuid): Host
    {
        $this->systemUuid = $systemUuid;
        return $this;
    }

    public function getScriptVersion(): ?string
    {
        return $this->scriptVersion;
    }

    /**
     * @param null|string $scriptVersion
     */
    public function setScriptVersion($scriptVersion): Host
    {
        $this->scriptVersion = $scriptVersion;
        return $this;
    }

    public function getFqdn(): ?string
    {
        return $this->fqdn;
    }

    /**
     * @param null|string $fqdn
     */
    public function setFqdn($fqdn): Host
    {
        $this->fqdn = $fqdn;
        return $this;
    }

    public function getExternalIpV4(): ?string
    {
        return $this->externalIpV4;
    }

    /**
     * @param null|string $externalIpV4
     */
    public function setExternalIpV4($externalIpV4): Host
    {
        $this->externalIpV4 = $externalIpV4;
        return $this;
    }

    public function getExternalIpV6(): ?string
    {
        return $this->externalIpV6;
    }

    /**
     * @param null|string $externalIpV6
     */
    public function setExternalIpV6($externalIpV6): Host
    {
        $this->externalIpV6 = $externalIpV6;
        return $this;
    }

    public function getNameservers()
    {
        return $this->nameservers;
    }

    public function setNameservers($nameservers): Host
    {
        $this->nameservers = $nameservers;
        return $this;
    }

    public function getInterfaces()
    {
        return $this->interfaces;
    }

    public function setInterfaces($interfaces): Host
    {
        $this->interfaces = $interfaces;
        return $this;
    }

    public function getServicesListening()
    {
        return $this->servicesListening;
    }

    public function setServicesListening($servicesListening): Host
    {
        $this->servicesListening = $servicesListening;
        return $this;
    }

    public function getProcessesRunning()
    {
        return $this->processesRunning;
    }

    public function setProcessesRunning($processesRunning): Host
    {
        $this->processesRunning = $processesRunning;
        return $this;
    }

    public function getPuppetVersion(): ?string
    {
        return $this->puppetVersion;
    }

    /**
     * @param null|string $puppetVersion
     */
    public function setPuppetVersion($puppetVersion): Host
    {
        $this->puppetVersion = $puppetVersion;
        return $this;
    }

    public function getPuppetIsOK(): ?bool
    {
        return $this->puppetIsOK;
    }

    /**
     * @param null|bool $puppetIsOK
     */
    public function setPuppetIsOK($puppetIsOK): Host
    {
        $this->puppetIsOK = $puppetIsOK;
        return $this;
    }

    public function getWebserverVersionApache(): ?string
    {
        return $this->webserverVersionApache;
    }

    /**
     * @param null|string $webserverVersionApache
     */
    public function setWebserverVersionApache($webserverVersionApache): Host
    {
        $this->webserverVersionApache = $webserverVersionApache;
        return $this;
    }

    public function getWebserverVersionNginx(): ?string
    {
        return $this->webserverVersionNginx;
    }

    /**
     * @param null|string $webserverVersionNginx
     */
    public function setWebserverVersionNginx($webserverVersionNginx): Host
    {
        $this->webserverVersionNginx = $webserverVersionNginx;
        return $this;
    }

    public function getWebserverDomainsApache()
    {
        return $this->webserverDomainsApache;
    }

    public function setWebserverDomainsApache($webserverDomainsApache): Host
    {
        $this->webserverDomainsApache = $webserverDomainsApache;
        return $this;
    }

    public function getWebserverDomainsNginx()
    {
        return $this->webserverDomainsNginx;
    }

    public function setWebserverDomainsNginx($webserverDomainsNginx): Host
    {
        $this->webserverDomainsNginx = $webserverDomainsNginx;
        return $this;
    }

    public function getIsVirtual(): ?bool
    {
        return $this->isVirtual;
    }

    /**
     * @param null|bool $isVirtual
     */
    public function setIsVirtual($isVirtual): Host
    {
        $this->isVirtual = $isVirtual;
        return $this;
    }

    public function getCpuCores(): ?int
    {
        return $this->cpuCores;
    }

    /**
     * @param null|int $cpuCores
     */
    public function setCpuCores($cpuCores): Host
    {
        $this->cpuCores = $cpuCores;
        return $this;
    }

    public function getCpuModel(): ?string
    {
        return $this->cpuModel;
    }

    /**
     * @param null|string $cpuModel
     */
    public function setCpuModel($cpuModel): Host
    {
        $this->cpuModel = $cpuModel;
        return $this;
    }

    public function getRamSizeKb(): ?int
    {
        return $this->ramSizeKb;
    }

    /**
     * @param null|int $ramSizeKb
     */
    public function setRamSizeKb($ramSizeKb): Host
    {
        $this->ramSizeKb = $ramSizeKb;
        return $this;
    }

    public function getRamAvailableKb(): ?int
    {
        return $this->ramAvailableKb;
    }

    /**
     * @param null|int $ramAvailableKb
     */
    public function setRamAvailableKb($ramAvailableKb): Host
    {
        $this->ramAvailableKb = $ramAvailableKb;
        return $this;
    }

    public function getDisks()
    {
        return $this->disks;
    }

    public function setDisks($disks): Host
    {
        $this->disks = $disks;
        return $this;
    }

    public function getOsName(): ?string
    {
        return $this->osName;
    }

    /**
     * @param null|string $osName
     */
    public function setOsName($osName): Host
    {
        $this->osName = $osName;
        return $this;
    }

    public function getOsVersion(): ?string
    {
        return $this->osVersion;
    }

    /**
     * @param null|string $osVersion
     */
    public function setOsVersion($osVersion): Host
    {
        $this->osVersion = $osVersion;
        return $this;
    }

    public function getKernelVersion(): ?string
    {
        return $this->kernelVersion;
    }

    /**
     * @param null|string $kernelVersion
     */
    public function setKernelVersion($kernelVersion): Host
    {
        $this->kernelVersion = $kernelVersion;
        return $this;
    }

    public function getPackagesAptMirrors()
    {
        return $this->packagesAptMirrors;
    }

    public function setPackagesAptMirrors($packagesAptMirrors): Host
    {
        $this->packagesAptMirrors = $packagesAptMirrors;
        return $this;
    }

    public function getPackagesAptHasRepoError(): ?bool
    {
        return $this->packagesAptHasRepoError;
    }

    /**
     * @param null|bool $packagesAptHasRepoError
     */
    public function setPackagesAptHasRepoError($packagesAptHasRepoError): Host
    {
        $this->packagesAptHasRepoError = $packagesAptHasRepoError;
        return $this;
    }

    public function getPackagesAptUpgradable()
    {
        return $this->packagesAptUpgradable;
    }

    public function setPackagesAptUpgradable($packagesAptUpgradable): Host
    {
        $this->packagesAptUpgradable = $packagesAptUpgradable;
        return $this;
    }

    public function getPackagesInstalled()
    {
        return $this->packagesInstalled;
    }

    public function setPackagesInstalled($packagesInstalled): Host
    {
        $this->packagesInstalled = $packagesInstalled;
        return $this;
    }

    public function getPleskVersion(): ?string
    {
        return $this->pleskVersion;
    }

    /**
     * @param null|string $pleskVersion
     */
    public function setPleskVersion($pleskVersion): Host
    {
        $this->pleskVersion = $pleskVersion;
        return $this;
    }

    public function getPleskBackupIsDone(): ?bool
    {
        return $this->pleskBackupIsDone;
    }

    /**
     * @param null|bool $pleskBackupIsDone
     */
    public function setPleskBackupIsDone($pleskBackupIsDone): Host
    {
        $this->pleskBackupIsDone = $pleskBackupIsDone;
        return $this;
    }

    public function getPleskBackupHasError(): ?bool
    {
        return $this->pleskBackupHasError;
    }

    /**
     * @param null|bool $pleskBackupHasError
     */
    public function setPleskBackupHasError($pleskBackupHasError): Host
    {
        $this->pleskBackupHasError = $pleskBackupHasError;
        return $this;
    }

    public function getMailqCount(): ?int
    {
        return $this->mailqCount;
    }

    /**
     * @param null|int $mailqCount
     */
    public function setMailqCount($mailqCount): Host
    {
        $this->mailqCount = $mailqCount;
        return $this;
    }

    public function getProxmoxVersion(): ?string
    {
        return $this->proxmoxVersion;
    }

    /**
     * @param null|string $proxmoxVersion
     */
    public function setProxmoxVersion($proxmoxVersion): Host
    {
        $this->proxmoxVersion = $proxmoxVersion;
        return $this;
    }

    public function getUptimeSeconds(): ?int
    {
        return $this->uptimeSeconds;
    }

    /**
     * @param null|int $uptimeSeconds
     */
    public function setUptimeSeconds($uptimeSeconds): Host
    {
        $this->uptimeSeconds = $uptimeSeconds;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): Host
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): Host
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return AssignedIp[]|Collection
     */
    public function getAssignedIps(): Collection
    {
        return $this->assignedIps;
    }

    /**
     * @param AssignedIp[]|Collection $assignedIps
     */
    public function setAssignedIps(Collection $assignedIps): Host
    {
        $this->assignedIps = $assignedIps;
        if ($this->assignedIps) {
            foreach ($this->assignedIps as $_assignedIps) {
                $_assignedIps->setHost($this);
            }
        }
        return $this;
    }

    /**
     * @param AssignedIp[]|Collection $assignedIps
     */
    public function addAssignedIps($assignedIps): Host
    {
        foreach ($assignedIps as $_assignedIps) {
            $_assignedIps->setHost($this);
            $this->assignedIps->add($_assignedIps);
        }
        return $this;
    }

    /**
     * @param AssignedIp[]|Collection $assignedIps
     */
    public function removeAssignedIps($assignedIps): Host
    {
        foreach ($assignedIps as $_assignedIps) {
            $_assignedIps->setHost(null);
            $this->assignedIps->removeElement($_assignedIps);
        }
        return $this;
    }

    /**
     * @return HostRawFact[]|Collection
     */
    public function getRawFacts(): Collection
    {
        return $this->rawFacts;
    }

    /**
     * @param HostRawFact[]|Collection $rawFacts
     */
    public function setRawFacts(Collection $rawFacts): Host
    {
        $this->rawFacts = $rawFacts;
        if ($this->rawFacts) {
            foreach ($this->rawFacts as $_rawFacts) {
                $_rawFacts->setHost($this);
            }
        }
        return $this;
    }

    /**
     * @param HostRawFact[]|Collection $rawFacts
     */
    public function addRawFacts($rawFacts): Host
    {
        foreach ($rawFacts as $_rawFacts) {
            $_rawFacts->setHost($this);
            $this->rawFacts->add($_rawFacts);
        }
        return $this;
    }

    /**
     * @param HostRawFact[]|Collection $rawFacts
     */
    public function removeRawFacts($rawFacts): Host
    {
        foreach ($rawFacts as $_rawFacts) {
            $_rawFacts->setHost(null);
            $this->rawFacts->removeElement($_rawFacts);
        }
        return $this;
    }

    /**
     * @return SshPublicKeyHostMapping[]|Collection
     */
    public function getSshPublicKeyHostMappings(): Collection
    {
        return $this->sshPublicKeyHostMappings;
    }

    /**
     * @param SshPublicKeyHostMapping[]|Collection $sshPublicKeyHostMappings
     */
    public function setSshPublicKeyHostMappings(Collection $sshPublicKeyHostMappings): Host
    {
        $this->sshPublicKeyHostMappings = $sshPublicKeyHostMappings;
        if ($this->sshPublicKeyHostMappings) {
            foreach ($this->sshPublicKeyHostMappings as $_sshPublicKeyHostMappings) {
                $_sshPublicKeyHostMappings->setHost($this);
            }
        }
        return $this;
    }

    /**
     * @param SshPublicKeyHostMapping[]|Collection $sshPublicKeyHostMappings
     */
    public function addSshPublicKeyHostMappings($sshPublicKeyHostMappings): Host
    {
        foreach ($sshPublicKeyHostMappings as $_sshPublicKeyHostMappings) {
            $_sshPublicKeyHostMappings->setHost($this);
            $this->sshPublicKeyHostMappings->add($_sshPublicKeyHostMappings);
        }
        return $this;
    }

    /**
     * @param SshPublicKeyHostMapping[]|Collection $sshPublicKeyHostMappings
     */
    public function removeSshPublicKeyHostMappings($sshPublicKeyHostMappings): Host
    {
        foreach ($sshPublicKeyHostMappings as $_sshPublicKeyHostMappings) {
            $_sshPublicKeyHostMappings->setHost(null);
            $this->sshPublicKeyHostMappings->removeElement($_sshPublicKeyHostMappings);
        }
        return $this;
    }

    /**
     * @return SshPublicKeyLogin[]|Collection
     */
    public function getSshPublicKeyLogins(): Collection
    {
        return $this->sshPublicKeyLogins;
    }

    /**
     * @param SshPublicKeyLogin[]|Collection $sshPublicKeyLogins
     */
    public function setSshPublicKeyLogins(Collection $sshPublicKeyLogins): Host
    {
        $this->sshPublicKeyLogins = $sshPublicKeyLogins;
        if ($this->sshPublicKeyLogins) {
            foreach ($this->sshPublicKeyLogins as $_sshPublicKeyLogins) {
                $_sshPublicKeyLogins->setHost($this);
            }
        }
        return $this;
    }

    /**
     * @param SshPublicKeyLogin[]|Collection $sshPublicKeyLogins
     */
    public function addSshPublicKeyLogins($sshPublicKeyLogins): Host
    {
        foreach ($sshPublicKeyLogins as $_sshPublicKeyLogins) {
            $_sshPublicKeyLogins->setHost($this);
            $this->sshPublicKeyLogins->add($_sshPublicKeyLogins);
        }
        return $this;
    }

    /**
     * @param SshPublicKeyLogin[]|Collection $sshPublicKeyLogins
     */
    public function removeSshPublicKeyLogins($sshPublicKeyLogins): Host
    {
        foreach ($sshPublicKeyLogins as $_sshPublicKeyLogins) {
            $_sshPublicKeyLogins->setHost(null);
            $this->sshPublicKeyLogins->removeElement($_sshPublicKeyLogins);
        }
        return $this;
    }

    /**
     * @return Alert[]|Collection
     */
    public function getAlerts(): Collection
    {
        return $this->alerts;
    }

    /**
     * @param Alert[]|Collection $alerts
     */
    public function setAlerts(Collection $alerts): Host
    {
        $this->alerts = $alerts;
        if ($this->alerts) {
            foreach ($this->alerts as $_alerts) {
                $_alerts->setHost($this);
            }
        }
        return $this;
    }

    /**
     * @param Alert[]|Collection $alerts
     */
    public function addAlerts($alerts): Host
    {
        foreach ($alerts as $_alerts) {
            $_alerts->setHost($this);
            $this->alerts->add($_alerts);
        }
        return $this;
    }

    /**
     * @param Alert[]|Collection $alerts
     */
    public function removeAlerts($alerts): Host
    {
        foreach ($alerts as $_alerts) {
            $_alerts->setHost(null);
            $this->alerts->removeElement($_alerts);
        }
        return $this;
    }

    /**
     * @return SyshelperTag[]|Collection
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @param SyshelperTag[]|Collection $tags
     */
    public function setTags(Collection $tags): Host
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @param SyshelperTag[]|Collection $tags
     */
    public function addTags($tags): Host
    {
        foreach ($tags as $_tags) {
            $this->tags->add($_tags);
        }
        return $this;
    }

    /**
     * @param SyshelperTag[]|Collection $tags
     */
    public function removeTags($tags): Host
    {
        foreach ($tags as $_tags) {
            $this->tags->removeElement($_tags);
        }
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->assignedIps              = new ArrayCollection();
        $this->rawFacts                 = new ArrayCollection();
        $this->sshPublicKeyHostMappings = new ArrayCollection();
        $this->sshPublicKeyLogins       = new ArrayCollection();
        $this->alerts                   = new ArrayCollection();
        $this->tags                     = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->assignedIps              = clone $this->assignedIps;
        $this->rawFacts                 = clone $this->rawFacts;
        $this->sshPublicKeyHostMappings = clone $this->sshPublicKeyHostMappings;
        $this->sshPublicKeyLogins       = clone $this->sshPublicKeyLogins;
        $this->alerts                   = clone $this->alerts;
        $this->tags                     = clone $this->tags;
    }
}

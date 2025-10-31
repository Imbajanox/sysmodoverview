<?php

namespace WirklichDigital\SyshelperBase\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Host extends AbstractEntity
{
    protected $id = null;

    /**
     * @var null|string
     */
    protected $name = null;

    /**
     * @var null|string
     */
    protected $syshelperDescription = null;

    /**
     * @var null|\DateTime
     */
    protected $lastConnectionAt = null;

    protected $connectionIp = null;

    /**
     * @var null|string
     */
    protected $systemUuid = null;

    /**
     * @var null|string
     */
    protected $scriptVersion = null;

    /**
     * @var null|string
     */
    protected $fqdn = null;

    /**
     * @var null|string
     */
    protected $externalIpV4 = null;

    /**
     * @var null|string
     */
    protected $externalIpV6 = null;

    protected $nameservers = null;

    protected $interfaces = null;

    protected $servicesListening = null;

    protected $processesRunning = null;

    /**
     * @var null|string
     */
    protected $puppetVersion = null;

    /**
     * @var null|bool
     */
    protected $puppetIsOK = null;

    /**
     * @var null|string
     */
    protected $webserverVersionApache = null;

    /**
     * @var null|string
     */
    protected $webserverVersionNginx = null;

    protected $webserverDomainsApache = null;

    protected $webserverDomainsNginx = null;

    /**
     * @var null|bool
     */
    protected $isVirtual = null;

    /**
     * @var null|int
     */
    protected $cpuCores = null;

    /**
     * @var null|string
     */
    protected $cpuModel = null;

    /**
     * @var null|int
     */
    protected $ramSizeKb = null;

    /**
     * @var null|int
     */
    protected $ramAvailableKb = null;

    protected $disks = null;

    /**
     * @var null|string
     */
    protected $osName = null;

    /**
     * @var null|string
     */
    protected $osVersion = null;

    /**
     * @var null|string
     */
    protected $kernelVersion = null;

    protected $packagesAptMirrors = null;

    /**
     * @var null|bool
     */
    protected $packagesAptHasRepoError = null;

    protected $packagesAptUpgradable = null;

    protected $packagesInstalled = null;

    /**
     * @var null|string
     */
    protected $pleskVersion = null;

    /**
     * @var null|bool
     */
    protected $pleskBackupIsDone = null;

    /**
     * @var null|bool
     */
    protected $pleskBackupHasError = null;

    /**
     * @var null|int
     */
    protected $mailqCount = null;

    /**
     * @var null|string
     */
    protected $proxmoxVersion = null;

    /**
     * @var null|int
     */
    protected $uptimeSeconds = null;

    /**
     * @var null|\DateTime
     */
    protected $createdAt = null;

    /**
     * @var null|\DateTime
     */
    protected $updatedAt = null;

    /**
     * @var \WirklichDigital\SyshelperBase\Entity\AssignedIp[]|\Doctrine\Common\Collections\Collection
     */
    protected $assignedIps = null;

    /**
     * @var \WirklichDigital\SyshelperBase\Entity\HostRawFact[]|\Doctrine\Common\Collections\Collection
     */
    protected $rawFacts = null;

    /**
     * @var \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping[]|\Doctrine\Common\Collections\Collection
     */
    protected $sshPublicKeyHostMappings = null;

    /**
     * @var \WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin[]|\Doctrine\Common\Collections\Collection
     */
    protected $sshPublicKeyLogins = null;

    /**
     * @var \WirklichDigital\SyshelperAlerts\Entity\Alert[]|\Doctrine\Common\Collections\Collection
     */
    protected $alerts = null;

    /**
     * @var \WirklichDigital\SyshelperBase\Entity\SyshelperTag[]|\Doctrine\Common\Collections\Collection
     */
    protected $tags = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->id = $id;
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
    public function setName($name) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getSyshelperDescription() : ?string
    {
        return $this->syshelperDescription;
    }

    /**
     * @param null|string $syshelperDescription
     */
    public function setSyshelperDescription($syshelperDescription) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->syshelperDescription = $syshelperDescription;
        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getLastConnectionAt() : ?\DateTime
    {
        return $this->lastConnectionAt;
    }

    /**
     * @param null|\DateTime $lastConnectionAt
     */
    public function setLastConnectionAt(?\DateTime $lastConnectionAt) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->lastConnectionAt = $lastConnectionAt;
        return $this;
    }

    public function getConnectionIp()
    {
        return $this->connectionIp;
    }

    public function setConnectionIp($connectionIp) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->connectionIp = $connectionIp;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getSystemUuid() : ?string
    {
        return $this->systemUuid;
    }

    /**
     * @param null|string $systemUuid
     */
    public function setSystemUuid($systemUuid) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->systemUuid = $systemUuid;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getScriptVersion() : ?string
    {
        return $this->scriptVersion;
    }

    /**
     * @param null|string $scriptVersion
     */
    public function setScriptVersion($scriptVersion) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->scriptVersion = $scriptVersion;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFqdn() : ?string
    {
        return $this->fqdn;
    }

    /**
     * @param null|string $fqdn
     */
    public function setFqdn($fqdn) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->fqdn = $fqdn;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getExternalIpV4() : ?string
    {
        return $this->externalIpV4;
    }

    /**
     * @param null|string $externalIpV4
     */
    public function setExternalIpV4($externalIpV4) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->externalIpV4 = $externalIpV4;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getExternalIpV6() : ?string
    {
        return $this->externalIpV6;
    }

    /**
     * @param null|string $externalIpV6
     */
    public function setExternalIpV6($externalIpV6) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->externalIpV6 = $externalIpV6;
        return $this;
    }

    public function getNameservers()
    {
        return $this->nameservers;
    }

    public function setNameservers($nameservers) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->nameservers = $nameservers;
        return $this;
    }

    public function getInterfaces()
    {
        return $this->interfaces;
    }

    public function setInterfaces($interfaces) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->interfaces = $interfaces;
        return $this;
    }

    public function getServicesListening()
    {
        return $this->servicesListening;
    }

    public function setServicesListening($servicesListening) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->servicesListening = $servicesListening;
        return $this;
    }

    public function getProcessesRunning()
    {
        return $this->processesRunning;
    }

    public function setProcessesRunning($processesRunning) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->processesRunning = $processesRunning;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPuppetVersion() : ?string
    {
        return $this->puppetVersion;
    }

    /**
     * @param null|string $puppetVersion
     */
    public function setPuppetVersion($puppetVersion) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->puppetVersion = $puppetVersion;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getPuppetIsOK() : ?bool
    {
        return $this->puppetIsOK;
    }

    /**
     * @param null|bool $puppetIsOK
     */
    public function setPuppetIsOK($puppetIsOK) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->puppetIsOK = $puppetIsOK;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getWebserverVersionApache() : ?string
    {
        return $this->webserverVersionApache;
    }

    /**
     * @param null|string $webserverVersionApache
     */
    public function setWebserverVersionApache($webserverVersionApache) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->webserverVersionApache = $webserverVersionApache;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getWebserverVersionNginx() : ?string
    {
        return $this->webserverVersionNginx;
    }

    /**
     * @param null|string $webserverVersionNginx
     */
    public function setWebserverVersionNginx($webserverVersionNginx) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->webserverVersionNginx = $webserverVersionNginx;
        return $this;
    }

    public function getWebserverDomainsApache()
    {
        return $this->webserverDomainsApache;
    }

    public function setWebserverDomainsApache($webserverDomainsApache) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->webserverDomainsApache = $webserverDomainsApache;
        return $this;
    }

    public function getWebserverDomainsNginx()
    {
        return $this->webserverDomainsNginx;
    }

    public function setWebserverDomainsNginx($webserverDomainsNginx) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->webserverDomainsNginx = $webserverDomainsNginx;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getIsVirtual() : ?bool
    {
        return $this->isVirtual;
    }

    /**
     * @param null|bool $isVirtual
     */
    public function setIsVirtual($isVirtual) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->isVirtual = $isVirtual;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getCpuCores() : ?int
    {
        return $this->cpuCores;
    }

    /**
     * @param null|int $cpuCores
     */
    public function setCpuCores($cpuCores) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->cpuCores = $cpuCores;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCpuModel() : ?string
    {
        return $this->cpuModel;
    }

    /**
     * @param null|string $cpuModel
     */
    public function setCpuModel($cpuModel) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->cpuModel = $cpuModel;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getRamSizeKb() : ?int
    {
        return $this->ramSizeKb;
    }

    /**
     * @param null|int $ramSizeKb
     */
    public function setRamSizeKb($ramSizeKb) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->ramSizeKb = $ramSizeKb;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getRamAvailableKb() : ?int
    {
        return $this->ramAvailableKb;
    }

    /**
     * @param null|int $ramAvailableKb
     */
    public function setRamAvailableKb($ramAvailableKb) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->ramAvailableKb = $ramAvailableKb;
        return $this;
    }

    public function getDisks()
    {
        return $this->disks;
    }

    public function setDisks($disks) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->disks = $disks;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getOsName() : ?string
    {
        return $this->osName;
    }

    /**
     * @param null|string $osName
     */
    public function setOsName($osName) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->osName = $osName;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getOsVersion() : ?string
    {
        return $this->osVersion;
    }

    /**
     * @param null|string $osVersion
     */
    public function setOsVersion($osVersion) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->osVersion = $osVersion;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getKernelVersion() : ?string
    {
        return $this->kernelVersion;
    }

    /**
     * @param null|string $kernelVersion
     */
    public function setKernelVersion($kernelVersion) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->kernelVersion = $kernelVersion;
        return $this;
    }

    public function getPackagesAptMirrors()
    {
        return $this->packagesAptMirrors;
    }

    public function setPackagesAptMirrors($packagesAptMirrors) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->packagesAptMirrors = $packagesAptMirrors;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getPackagesAptHasRepoError() : ?bool
    {
        return $this->packagesAptHasRepoError;
    }

    /**
     * @param null|bool $packagesAptHasRepoError
     */
    public function setPackagesAptHasRepoError($packagesAptHasRepoError) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->packagesAptHasRepoError = $packagesAptHasRepoError;
        return $this;
    }

    public function getPackagesAptUpgradable()
    {
        return $this->packagesAptUpgradable;
    }

    public function setPackagesAptUpgradable($packagesAptUpgradable) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->packagesAptUpgradable = $packagesAptUpgradable;
        return $this;
    }

    public function getPackagesInstalled()
    {
        return $this->packagesInstalled;
    }

    public function setPackagesInstalled($packagesInstalled) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->packagesInstalled = $packagesInstalled;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPleskVersion() : ?string
    {
        return $this->pleskVersion;
    }

    /**
     * @param null|string $pleskVersion
     */
    public function setPleskVersion($pleskVersion) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->pleskVersion = $pleskVersion;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getPleskBackupIsDone() : ?bool
    {
        return $this->pleskBackupIsDone;
    }

    /**
     * @param null|bool $pleskBackupIsDone
     */
    public function setPleskBackupIsDone($pleskBackupIsDone) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->pleskBackupIsDone = $pleskBackupIsDone;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getPleskBackupHasError() : ?bool
    {
        return $this->pleskBackupHasError;
    }

    /**
     * @param null|bool $pleskBackupHasError
     */
    public function setPleskBackupHasError($pleskBackupHasError) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->pleskBackupHasError = $pleskBackupHasError;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getMailqCount() : ?int
    {
        return $this->mailqCount;
    }

    /**
     * @param null|int $mailqCount
     */
    public function setMailqCount($mailqCount) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->mailqCount = $mailqCount;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getProxmoxVersion() : ?string
    {
        return $this->proxmoxVersion;
    }

    /**
     * @param null|string $proxmoxVersion
     */
    public function setProxmoxVersion($proxmoxVersion) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->proxmoxVersion = $proxmoxVersion;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getUptimeSeconds() : ?int
    {
        return $this->uptimeSeconds;
    }

    /**
     * @param null|int $uptimeSeconds
     */
    public function setUptimeSeconds($uptimeSeconds) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->uptimeSeconds = $uptimeSeconds;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\SyshelperBase\Entity\Host
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \WirklichDigital\SyshelperBase\Entity\AssignedIp[]|\Doctrine\Common\Collections\Collection
     */
    public function getAssignedIps() : \Doctrine\Common\Collections\Collection
    {
        return $this->assignedIps;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\AssignedIp[]|\Doctrine\Common\Collections\Collection $assignedIps
     */
    public function setAssignedIps(\Doctrine\Common\Collections\Collection $assignedIps) : \WirklichDigital\SyshelperBase\Entity\Host
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
     * @param \WirklichDigital\SyshelperBase\Entity\AssignedIp[]|\Doctrine\Common\Collections\Collection $assignedIps
     */
    public function addAssignedIps($assignedIps) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        foreach ($assignedIps as $_assignedIps) {
            $_assignedIps->setHost($this);
            $this->assignedIps->add($_assignedIps);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\AssignedIp[]|\Doctrine\Common\Collections\Collection $assignedIps
     */
    public function removeAssignedIps($assignedIps) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        foreach ($assignedIps as $_assignedIps) {
            $_assignedIps->setHost(null);
            $this->assignedIps->removeElement($_assignedIps);
        }
        return $this;
    }

    /**
     * @return \WirklichDigital\SyshelperBase\Entity\HostRawFact[]|\Doctrine\Common\Collections\Collection
     */
    public function getRawFacts() : \Doctrine\Common\Collections\Collection
    {
        return $this->rawFacts;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\HostRawFact[]|\Doctrine\Common\Collections\Collection $rawFacts
     */
    public function setRawFacts(\Doctrine\Common\Collections\Collection $rawFacts) : \WirklichDigital\SyshelperBase\Entity\Host
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
     * @param \WirklichDigital\SyshelperBase\Entity\HostRawFact[]|\Doctrine\Common\Collections\Collection $rawFacts
     */
    public function addRawFacts($rawFacts) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        foreach ($rawFacts as $_rawFacts) {
            $_rawFacts->setHost($this);
            $this->rawFacts->add($_rawFacts);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\HostRawFact[]|\Doctrine\Common\Collections\Collection $rawFacts
     */
    public function removeRawFacts($rawFacts) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        foreach ($rawFacts as $_rawFacts) {
            $_rawFacts->setHost(null);
            $this->rawFacts->removeElement($_rawFacts);
        }
        return $this;
    }

    /**
     * @return \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping[]|\Doctrine\Common\Collections\Collection
     */
    public function getSshPublicKeyHostMappings() : \Doctrine\Common\Collections\Collection
    {
        return $this->sshPublicKeyHostMappings;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping[]|\Doctrine\Common\Collections\Collection $sshPublicKeyHostMappings
     */
    public function setSshPublicKeyHostMappings(\Doctrine\Common\Collections\Collection $sshPublicKeyHostMappings) : \WirklichDigital\SyshelperBase\Entity\Host
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
     * @param \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping[]|\Doctrine\Common\Collections\Collection $sshPublicKeyHostMappings
     */
    public function addSshPublicKeyHostMappings($sshPublicKeyHostMappings) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        foreach ($sshPublicKeyHostMappings as $_sshPublicKeyHostMappings) {
            $_sshPublicKeyHostMappings->setHost($this);
            $this->sshPublicKeyHostMappings->add($_sshPublicKeyHostMappings);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping[]|\Doctrine\Common\Collections\Collection $sshPublicKeyHostMappings
     */
    public function removeSshPublicKeyHostMappings($sshPublicKeyHostMappings) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        foreach ($sshPublicKeyHostMappings as $_sshPublicKeyHostMappings) {
            $_sshPublicKeyHostMappings->setHost(null);
            $this->sshPublicKeyHostMappings->removeElement($_sshPublicKeyHostMappings);
        }
        return $this;
    }

    /**
     * @return \WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin[]|\Doctrine\Common\Collections\Collection
     */
    public function getSshPublicKeyLogins() : \Doctrine\Common\Collections\Collection
    {
        return $this->sshPublicKeyLogins;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin[]|\Doctrine\Common\Collections\Collection $sshPublicKeyLogins
     */
    public function setSshPublicKeyLogins(\Doctrine\Common\Collections\Collection $sshPublicKeyLogins) : \WirklichDigital\SyshelperBase\Entity\Host
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
     * @param \WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin[]|\Doctrine\Common\Collections\Collection $sshPublicKeyLogins
     */
    public function addSshPublicKeyLogins($sshPublicKeyLogins) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        foreach ($sshPublicKeyLogins as $_sshPublicKeyLogins) {
            $_sshPublicKeyLogins->setHost($this);
            $this->sshPublicKeyLogins->add($_sshPublicKeyLogins);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin[]|\Doctrine\Common\Collections\Collection $sshPublicKeyLogins
     */
    public function removeSshPublicKeyLogins($sshPublicKeyLogins) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        foreach ($sshPublicKeyLogins as $_sshPublicKeyLogins) {
            $_sshPublicKeyLogins->setHost(null);
            $this->sshPublicKeyLogins->removeElement($_sshPublicKeyLogins);
        }
        return $this;
    }

    /**
     * @return \WirklichDigital\SyshelperAlerts\Entity\Alert[]|\Doctrine\Common\Collections\Collection
     */
    public function getAlerts() : \Doctrine\Common\Collections\Collection
    {
        return $this->alerts;
    }

    /**
     * @param \WirklichDigital\SyshelperAlerts\Entity\Alert[]|\Doctrine\Common\Collections\Collection $alerts
     */
    public function setAlerts(\Doctrine\Common\Collections\Collection $alerts) : \WirklichDigital\SyshelperBase\Entity\Host
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
     * @param \WirklichDigital\SyshelperAlerts\Entity\Alert[]|\Doctrine\Common\Collections\Collection $alerts
     */
    public function addAlerts($alerts) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        foreach ($alerts as $_alerts) {
            $_alerts->setHost($this);
            $this->alerts->add($_alerts);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperAlerts\Entity\Alert[]|\Doctrine\Common\Collections\Collection $alerts
     */
    public function removeAlerts($alerts) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        foreach ($alerts as $_alerts) {
            $_alerts->setHost(null);
            $this->alerts->removeElement($_alerts);
        }
        return $this;
    }

    /**
     * @return \WirklichDigital\SyshelperBase\Entity\SyshelperTag[]|\Doctrine\Common\Collections\Collection
     */
    public function getTags() : \Doctrine\Common\Collections\Collection
    {
        return $this->tags;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\SyshelperTag[]|\Doctrine\Common\Collections\Collection $tags
     */
    public function setTags(\Doctrine\Common\Collections\Collection $tags) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\SyshelperTag[]|\Doctrine\Common\Collections\Collection $tags
     */
    public function addTags($tags) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        foreach ($tags as $_tags) {
            $this->tags->add($_tags);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\SyshelperTag[]|\Doctrine\Common\Collections\Collection $tags
     */
    public function removeTags($tags) : \WirklichDigital\SyshelperBase\Entity\Host
    {
        foreach ($tags as $_tags) {
            $this->tags->removeElement($_tags);
        }
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->assignedIps = new ArrayCollection();
        $this->rawFacts = new ArrayCollection();
        $this->sshPublicKeyHostMappings = new ArrayCollection();
        $this->sshPublicKeyLogins = new ArrayCollection();
        $this->alerts = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->assignedIps = clone $this->assignedIps;
        $this->rawFacts = clone $this->rawFacts;
        $this->sshPublicKeyHostMappings = clone $this->sshPublicKeyHostMappings;
        $this->sshPublicKeyLogins = clone $this->sshPublicKeyLogins;
        $this->alerts = clone $this->alerts;
        $this->tags = clone $this->tags;
    }
}


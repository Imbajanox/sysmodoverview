<?php

namespace WirklichDigital\SyshelperBase\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SyshelperAlerts\Entity\Alert;
use WirklichDigital\SyshelperBase\Entity\AssignedIp;
use WirklichDigital\SyshelperBase\Entity\ReachableIp;
use WirklichDigital\SyshelperBase\Entity\SyshelperTag;

class IpSubnet extends AbstractEntity
{
    protected $id;

    protected $networkAddress;

    /** @var null|int */
    protected $networkCidrMask;

    /** @var null|string */
    protected $importSource;

    /** @var null|string */
    protected $syshelperDescription;

    protected $externalUpIps;

    /** @var null|DateTime */
    protected $externalUpIpLastScanAt;

    /** @var null|bool */
    protected $isDynamic = 0;

    /** @var null|bool */
    protected $isDynamicSetManually = 0;

    /** @var null|DateTime */
    protected $createdAt;

    /** @var null|DateTime */
    protected $updatedAt;

    /** @var AssignedIp[]|Collection */
    protected $assignedIps;

    /** @var ReachableIp[]|Collection */
    protected $reachableIps;

    /** @var Alert[]|Collection */
    protected $alerts;

    /** @var SyshelperTag[]|Collection */
    protected $tags;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): IpSubnet
    {
        $this->id = $id;
        return $this;
    }

    public function getNetworkAddress()
    {
        return $this->networkAddress;
    }

    public function setNetworkAddress($networkAddress): IpSubnet
    {
        $this->networkAddress = $networkAddress;
        return $this;
    }

    public function getNetworkCidrMask(): ?int
    {
        return $this->networkCidrMask;
    }

    /**
     * @param null|int $networkCidrMask
     */
    public function setNetworkCidrMask($networkCidrMask): IpSubnet
    {
        $this->networkCidrMask = $networkCidrMask;
        return $this;
    }

    public function getImportSource(): ?string
    {
        return $this->importSource;
    }

    /**
     * @param null|string $importSource
     */
    public function setImportSource($importSource): IpSubnet
    {
        $this->importSource = $importSource;
        return $this;
    }

    public function getSyshelperDescription(): ?string
    {
        return $this->syshelperDescription;
    }

    /**
     * @param null|string $syshelperDescription
     */
    public function setSyshelperDescription($syshelperDescription): IpSubnet
    {
        $this->syshelperDescription = $syshelperDescription;
        return $this;
    }

    public function getExternalUpIps()
    {
        return $this->externalUpIps;
    }

    public function setExternalUpIps($externalUpIps): IpSubnet
    {
        $this->externalUpIps = $externalUpIps;
        return $this;
    }

    public function getExternalUpIpLastScanAt(): ?DateTime
    {
        return $this->externalUpIpLastScanAt;
    }

    public function setExternalUpIpLastScanAt(?DateTime $externalUpIpLastScanAt): IpSubnet
    {
        $this->externalUpIpLastScanAt = $externalUpIpLastScanAt;
        return $this;
    }

    public function getIsDynamic(): ?bool
    {
        return $this->isDynamic;
    }

    /**
     * @param null|bool $isDynamic
     */
    public function setIsDynamic($isDynamic): IpSubnet
    {
        $this->isDynamic = $isDynamic;
        return $this;
    }

    public function getIsDynamicSetManually(): ?bool
    {
        return $this->isDynamicSetManually;
    }

    /**
     * @param null|bool $isDynamicSetManually
     */
    public function setIsDynamicSetManually($isDynamicSetManually): IpSubnet
    {
        $this->isDynamicSetManually = $isDynamicSetManually;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): IpSubnet
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): IpSubnet
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
    public function setAssignedIps(Collection $assignedIps): IpSubnet
    {
        $this->assignedIps = $assignedIps;
        if ($this->assignedIps) {
            foreach ($this->assignedIps as $_assignedIps) {
                $_assignedIps->setSubnet($this);
            }
        }
        return $this;
    }

    /**
     * @param AssignedIp[]|Collection $assignedIps
     */
    public function addAssignedIps($assignedIps): IpSubnet
    {
        foreach ($assignedIps as $_assignedIps) {
            $_assignedIps->setSubnet($this);
            $this->assignedIps->add($_assignedIps);
        }
        return $this;
    }

    /**
     * @param AssignedIp[]|Collection $assignedIps
     */
    public function removeAssignedIps($assignedIps): IpSubnet
    {
        foreach ($assignedIps as $_assignedIps) {
            $_assignedIps->setSubnet(null);
            $this->assignedIps->removeElement($_assignedIps);
        }
        return $this;
    }

    /**
     * @return ReachableIp[]|Collection
     */
    public function getReachableIps(): Collection
    {
        return $this->reachableIps;
    }

    /**
     * @param ReachableIp[]|Collection $reachableIps
     */
    public function setReachableIps(Collection $reachableIps): IpSubnet
    {
        $this->reachableIps = $reachableIps;
        if ($this->reachableIps) {
            foreach ($this->reachableIps as $_reachableIps) {
                $_reachableIps->setSubnet($this);
            }
        }
        return $this;
    }

    /**
     * @param ReachableIp[]|Collection $reachableIps
     */
    public function addReachableIps($reachableIps): IpSubnet
    {
        foreach ($reachableIps as $_reachableIps) {
            $_reachableIps->setSubnet($this);
            $this->reachableIps->add($_reachableIps);
        }
        return $this;
    }

    /**
     * @param ReachableIp[]|Collection $reachableIps
     */
    public function removeReachableIps($reachableIps): IpSubnet
    {
        foreach ($reachableIps as $_reachableIps) {
            $_reachableIps->setSubnet(null);
            $this->reachableIps->removeElement($_reachableIps);
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
    public function setAlerts(Collection $alerts): IpSubnet
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
    public function addAlerts($alerts): IpSubnet
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
    public function removeAlerts($alerts): IpSubnet
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
    public function setTags(Collection $tags): IpSubnet
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @param SyshelperTag[]|Collection $tags
     */
    public function addTags($tags): IpSubnet
    {
        foreach ($tags as $_tags) {
            $this->tags->add($_tags);
        }
        return $this;
    }

    /**
     * @param SyshelperTag[]|Collection $tags
     */
    public function removeTags($tags): IpSubnet
    {
        foreach ($tags as $_tags) {
            $this->tags->removeElement($_tags);
        }
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->assignedIps  = new ArrayCollection();
        $this->reachableIps = new ArrayCollection();
        $this->alerts       = new ArrayCollection();
        $this->tags         = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->assignedIps  = clone $this->assignedIps;
        $this->reachableIps = clone $this->reachableIps;
        $this->alerts       = clone $this->alerts;
        $this->tags         = clone $this->tags;
    }
}

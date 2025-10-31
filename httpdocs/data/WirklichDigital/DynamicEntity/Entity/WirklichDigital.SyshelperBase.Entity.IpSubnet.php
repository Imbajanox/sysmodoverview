<?php

namespace WirklichDigital\SyshelperBase\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class IpSubnet extends AbstractEntity
{
    protected $id = null;

    protected $networkAddress = null;

    /**
     * @var null|int
     */
    protected $networkCidrMask = null;

    /**
     * @var null|string
     */
    protected $importSource = null;

    /**
     * @var null|string
     */
    protected $syshelperDescription = null;

    protected $externalUpIps = null;

    /**
     * @var null|\DateTime
     */
    protected $externalUpIpLastScanAt = null;

    /**
     * @var null|bool
     */
    protected $isDynamic = 0;

    /**
     * @var null|bool
     */
    protected $isDynamicSetManually = 0;

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
     * @var \WirklichDigital\SyshelperBase\Entity\ReachableIp[]|\Doctrine\Common\Collections\Collection
     */
    protected $reachableIps = null;

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

    public function setId($id) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
    {
        $this->id = $id;
        return $this;
    }

    public function getNetworkAddress()
    {
        return $this->networkAddress;
    }

    public function setNetworkAddress($networkAddress) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
    {
        $this->networkAddress = $networkAddress;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getNetworkCidrMask() : ?int
    {
        return $this->networkCidrMask;
    }

    /**
     * @param null|int $networkCidrMask
     */
    public function setNetworkCidrMask($networkCidrMask) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
    {
        $this->networkCidrMask = $networkCidrMask;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getImportSource() : ?string
    {
        return $this->importSource;
    }

    /**
     * @param null|string $importSource
     */
    public function setImportSource($importSource) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
    {
        $this->importSource = $importSource;
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
    public function setSyshelperDescription($syshelperDescription) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
    {
        $this->syshelperDescription = $syshelperDescription;
        return $this;
    }

    public function getExternalUpIps()
    {
        return $this->externalUpIps;
    }

    public function setExternalUpIps($externalUpIps) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
    {
        $this->externalUpIps = $externalUpIps;
        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getExternalUpIpLastScanAt() : ?\DateTime
    {
        return $this->externalUpIpLastScanAt;
    }

    /**
     * @param null|\DateTime $externalUpIpLastScanAt
     */
    public function setExternalUpIpLastScanAt(?\DateTime $externalUpIpLastScanAt) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
    {
        $this->externalUpIpLastScanAt = $externalUpIpLastScanAt;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getIsDynamic() : ?bool
    {
        return $this->isDynamic;
    }

    /**
     * @param null|bool $isDynamic
     */
    public function setIsDynamic($isDynamic) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
    {
        $this->isDynamic = $isDynamic;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getIsDynamicSetManually() : ?bool
    {
        return $this->isDynamicSetManually;
    }

    /**
     * @param null|bool $isDynamicSetManually
     */
    public function setIsDynamicSetManually($isDynamicSetManually) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
    {
        $this->isDynamicSetManually = $isDynamicSetManually;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
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
    public function setAssignedIps(\Doctrine\Common\Collections\Collection $assignedIps) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
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
     * @param \WirklichDigital\SyshelperBase\Entity\AssignedIp[]|\Doctrine\Common\Collections\Collection $assignedIps
     */
    public function addAssignedIps($assignedIps) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
    {
        foreach ($assignedIps as $_assignedIps) {
            $_assignedIps->setSubnet($this);
            $this->assignedIps->add($_assignedIps);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\AssignedIp[]|\Doctrine\Common\Collections\Collection $assignedIps
     */
    public function removeAssignedIps($assignedIps) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
    {
        foreach ($assignedIps as $_assignedIps) {
            $_assignedIps->setSubnet(null);
            $this->assignedIps->removeElement($_assignedIps);
        }
        return $this;
    }

    /**
     * @return \WirklichDigital\SyshelperBase\Entity\ReachableIp[]|\Doctrine\Common\Collections\Collection
     */
    public function getReachableIps() : \Doctrine\Common\Collections\Collection
    {
        return $this->reachableIps;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\ReachableIp[]|\Doctrine\Common\Collections\Collection $reachableIps
     */
    public function setReachableIps(\Doctrine\Common\Collections\Collection $reachableIps) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
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
     * @param \WirklichDigital\SyshelperBase\Entity\ReachableIp[]|\Doctrine\Common\Collections\Collection $reachableIps
     */
    public function addReachableIps($reachableIps) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
    {
        foreach ($reachableIps as $_reachableIps) {
            $_reachableIps->setSubnet($this);
            $this->reachableIps->add($_reachableIps);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\ReachableIp[]|\Doctrine\Common\Collections\Collection $reachableIps
     */
    public function removeReachableIps($reachableIps) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
    {
        foreach ($reachableIps as $_reachableIps) {
            $_reachableIps->setSubnet(null);
            $this->reachableIps->removeElement($_reachableIps);
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
    public function setAlerts(\Doctrine\Common\Collections\Collection $alerts) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
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
    public function addAlerts($alerts) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
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
    public function removeAlerts($alerts) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
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
    public function setTags(\Doctrine\Common\Collections\Collection $tags) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\SyshelperTag[]|\Doctrine\Common\Collections\Collection $tags
     */
    public function addTags($tags) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
    {
        foreach ($tags as $_tags) {
            $this->tags->add($_tags);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\SyshelperTag[]|\Doctrine\Common\Collections\Collection $tags
     */
    public function removeTags($tags) : \WirklichDigital\SyshelperBase\Entity\IpSubnet
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
        $this->reachableIps = new ArrayCollection();
        $this->alerts = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->assignedIps = clone $this->assignedIps;
        $this->reachableIps = clone $this->reachableIps;
        $this->alerts = clone $this->alerts;
        $this->tags = clone $this->tags;
    }
}


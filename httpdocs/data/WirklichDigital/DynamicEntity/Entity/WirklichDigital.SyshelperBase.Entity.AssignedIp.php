<?php

namespace WirklichDigital\SyshelperBase\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class AssignedIp extends AbstractEntity
{
    protected $id = null;

    protected $address = null;

    /**
     * @var null|string
     */
    protected $ptr = null;

    /**
     * @var null|string
     */
    protected $syshelperDescription = null;

    protected $openPortsInternal = null;

    /**
     * @var null|\DateTime
     */
    protected $openPortsInternalLastScanAt = null;

    protected $openPortsExternal = null;

    /**
     * @var null|\DateTime
     */
    protected $openPortsExternalLastScanAt = null;

    /**
     * @var null|\DateTime
     */
    protected $createdAt = null;

    /**
     * @var null|\DateTime
     */
    protected $updatedAt = null;

    /**
     * @var null|\WirklichDigital\SyshelperBase\Entity\ReachableIp
     */
    protected $reachableIp = null;

    /**
     * @var \WirklichDigital\SyshelperAlerts\Entity\Alert[]|\Doctrine\Common\Collections\Collection
     */
    protected $alerts = null;

    /**
     * @var \WirklichDigital\SyshelperBase\Entity\SyshelperTag[]|\Doctrine\Common\Collections\Collection
     */
    protected $tags = null;

    /**
     * @var null|\WirklichDigital\SyshelperBase\Entity\Host
     */
    protected $host = null;

    /**
     * @var null|\WirklichDigital\SyshelperBase\Entity\IpSubnet
     */
    protected $subnet = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
    {
        $this->id = $id;
        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPtr() : ?string
    {
        return $this->ptr;
    }

    /**
     * @param null|string $ptr
     */
    public function setPtr($ptr) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
    {
        $this->ptr = $ptr;
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
    public function setSyshelperDescription($syshelperDescription) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
    {
        $this->syshelperDescription = $syshelperDescription;
        return $this;
    }

    public function getOpenPortsInternal()
    {
        return $this->openPortsInternal;
    }

    public function setOpenPortsInternal($openPortsInternal) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
    {
        $this->openPortsInternal = $openPortsInternal;
        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getOpenPortsInternalLastScanAt() : ?\DateTime
    {
        return $this->openPortsInternalLastScanAt;
    }

    /**
     * @param null|\DateTime $openPortsInternalLastScanAt
     */
    public function setOpenPortsInternalLastScanAt(?\DateTime $openPortsInternalLastScanAt) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
    {
        $this->openPortsInternalLastScanAt = $openPortsInternalLastScanAt;
        return $this;
    }

    public function getOpenPortsExternal()
    {
        return $this->openPortsExternal;
    }

    public function setOpenPortsExternal($openPortsExternal) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
    {
        $this->openPortsExternal = $openPortsExternal;
        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getOpenPortsExternalLastScanAt() : ?\DateTime
    {
        return $this->openPortsExternalLastScanAt;
    }

    /**
     * @param null|\DateTime $openPortsExternalLastScanAt
     */
    public function setOpenPortsExternalLastScanAt(?\DateTime $openPortsExternalLastScanAt) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
    {
        $this->openPortsExternalLastScanAt = $openPortsExternalLastScanAt;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return null|\WirklichDigital\SyshelperBase\Entity\ReachableIp
     */
    public function getReachableIp() : ?\WirklichDigital\SyshelperBase\Entity\ReachableIp
    {
        return $this->reachableIp;
    }

    /**
     * @param null|\WirklichDigital\SyshelperBase\Entity\ReachableIp $reachableIp
     */
    public function setReachableIp(?\WirklichDigital\SyshelperBase\Entity\ReachableIp $reachableIp) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
    {
        $this->reachableIp = $reachableIp;
        if ($this->reachableIp) {
            $this->reachableIp->setAssignedIp($this);
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
    public function setAlerts(\Doctrine\Common\Collections\Collection $alerts) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
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
    public function addAlerts($alerts) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
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
    public function removeAlerts($alerts) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
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
    public function setTags(\Doctrine\Common\Collections\Collection $tags) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\SyshelperTag[]|\Doctrine\Common\Collections\Collection $tags
     */
    public function addTags($tags) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
    {
        foreach ($tags as $_tags) {
            $this->tags->add($_tags);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\SyshelperTag[]|\Doctrine\Common\Collections\Collection $tags
     */
    public function removeTags($tags) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
    {
        foreach ($tags as $_tags) {
            $this->tags->removeElement($_tags);
        }
        return $this;
    }

    /**
     * @return null|\WirklichDigital\SyshelperBase\Entity\Host
     */
    public function getHost() : ?\WirklichDigital\SyshelperBase\Entity\Host
    {
        return $this->host;
    }

    /**
     * @param null|\WirklichDigital\SyshelperBase\Entity\Host $host
     */
    public function setHost(?\WirklichDigital\SyshelperBase\Entity\Host $host) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return null|\WirklichDigital\SyshelperBase\Entity\IpSubnet
     */
    public function getSubnet() : ?\WirklichDigital\SyshelperBase\Entity\IpSubnet
    {
        return $this->subnet;
    }

    /**
     * @param null|\WirklichDigital\SyshelperBase\Entity\IpSubnet $subnet
     */
    public function setSubnet(?\WirklichDigital\SyshelperBase\Entity\IpSubnet $subnet) : \WirklichDigital\SyshelperBase\Entity\AssignedIp
    {
        $this->subnet = $subnet;
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->alerts = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->alerts = clone $this->alerts;
        $this->tags = clone $this->tags;
    }
}


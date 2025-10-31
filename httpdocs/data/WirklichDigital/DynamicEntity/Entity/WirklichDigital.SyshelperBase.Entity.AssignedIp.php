<?php

namespace WirklichDigital\SyshelperBase\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SyshelperAlerts\Entity\Alert;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SyshelperBase\Entity\IpSubnet;
use WirklichDigital\SyshelperBase\Entity\ReachableIp;
use WirklichDigital\SyshelperBase\Entity\SyshelperTag;

class AssignedIp extends AbstractEntity
{
    protected $id;

    protected $address;

    /** @var null|string */
    protected $ptr;

    /** @var null|string */
    protected $syshelperDescription;

    protected $openPortsInternal;

    /** @var null|DateTime */
    protected $openPortsInternalLastScanAt;

    protected $openPortsExternal;

    /** @var null|DateTime */
    protected $openPortsExternalLastScanAt;

    /** @var null|DateTime */
    protected $createdAt;

    /** @var null|DateTime */
    protected $updatedAt;

    /** @var null|ReachableIp */
    protected $reachableIp;

    /** @var Alert[]|Collection */
    protected $alerts;

    /** @var SyshelperTag[]|Collection */
    protected $tags;

    /** @var null|Host */
    protected $host;

    /** @var null|IpSubnet */
    protected $subnet;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): AssignedIp
    {
        $this->id = $id;
        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address): AssignedIp
    {
        $this->address = $address;
        return $this;
    }

    public function getPtr(): ?string
    {
        return $this->ptr;
    }

    /**
     * @param null|string $ptr
     */
    public function setPtr($ptr): AssignedIp
    {
        $this->ptr = $ptr;
        return $this;
    }

    public function getSyshelperDescription(): ?string
    {
        return $this->syshelperDescription;
    }

    /**
     * @param null|string $syshelperDescription
     */
    public function setSyshelperDescription($syshelperDescription): AssignedIp
    {
        $this->syshelperDescription = $syshelperDescription;
        return $this;
    }

    public function getOpenPortsInternal()
    {
        return $this->openPortsInternal;
    }

    public function setOpenPortsInternal($openPortsInternal): AssignedIp
    {
        $this->openPortsInternal = $openPortsInternal;
        return $this;
    }

    public function getOpenPortsInternalLastScanAt(): ?DateTime
    {
        return $this->openPortsInternalLastScanAt;
    }

    public function setOpenPortsInternalLastScanAt(?DateTime $openPortsInternalLastScanAt): AssignedIp
    {
        $this->openPortsInternalLastScanAt = $openPortsInternalLastScanAt;
        return $this;
    }

    public function getOpenPortsExternal()
    {
        return $this->openPortsExternal;
    }

    public function setOpenPortsExternal($openPortsExternal): AssignedIp
    {
        $this->openPortsExternal = $openPortsExternal;
        return $this;
    }

    public function getOpenPortsExternalLastScanAt(): ?DateTime
    {
        return $this->openPortsExternalLastScanAt;
    }

    public function setOpenPortsExternalLastScanAt(?DateTime $openPortsExternalLastScanAt): AssignedIp
    {
        $this->openPortsExternalLastScanAt = $openPortsExternalLastScanAt;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): AssignedIp
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): AssignedIp
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getReachableIp(): ?ReachableIp
    {
        return $this->reachableIp;
    }

    public function setReachableIp(?ReachableIp $reachableIp): AssignedIp
    {
        $this->reachableIp = $reachableIp;
        if ($this->reachableIp) {
            $this->reachableIp->setAssignedIp($this);
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
    public function setAlerts(Collection $alerts): AssignedIp
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
    public function addAlerts($alerts): AssignedIp
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
    public function removeAlerts($alerts): AssignedIp
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
    public function setTags(Collection $tags): AssignedIp
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @param SyshelperTag[]|Collection $tags
     */
    public function addTags($tags): AssignedIp
    {
        foreach ($tags as $_tags) {
            $this->tags->add($_tags);
        }
        return $this;
    }

    /**
     * @param SyshelperTag[]|Collection $tags
     */
    public function removeTags($tags): AssignedIp
    {
        foreach ($tags as $_tags) {
            $this->tags->removeElement($_tags);
        }
        return $this;
    }

    public function getHost(): ?Host
    {
        return $this->host;
    }

    public function setHost(?Host $host): AssignedIp
    {
        $this->host = $host;
        return $this;
    }

    public function getSubnet(): ?IpSubnet
    {
        return $this->subnet;
    }

    public function setSubnet(?IpSubnet $subnet): AssignedIp
    {
        $this->subnet = $subnet;
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->alerts = new ArrayCollection();
        $this->tags   = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->alerts = clone $this->alerts;
        $this->tags   = clone $this->tags;
    }
}

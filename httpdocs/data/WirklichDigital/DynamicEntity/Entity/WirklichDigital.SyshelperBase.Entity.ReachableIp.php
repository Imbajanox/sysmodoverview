<?php

namespace WirklichDigital\SyshelperBase\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class ReachableIp extends AbstractEntity
{
    protected $id = null;

    protected $address = null;

    /**
     * @var null|string
     */
    protected $ptr = null;

    /**
     * @var null|\DateTime
     */
    protected $createdAt = null;

    /**
     * @var null|\DateTime
     */
    protected $updatedAt = null;

    /**
     * @var null|\WirklichDigital\SyshelperBase\Entity\AssignedIp
     */
    protected $assignedIp = null;

    /**
     * @var \WirklichDigital\SyshelperAlerts\Entity\Alert[]|\Doctrine\Common\Collections\Collection
     */
    protected $alerts = null;

    /**
     * @var null|\WirklichDigital\SyshelperBase\Entity\IpSubnet
     */
    protected $subnet = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id) : \WirklichDigital\SyshelperBase\Entity\ReachableIp
    {
        $this->id = $id;
        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address) : \WirklichDigital\SyshelperBase\Entity\ReachableIp
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
    public function setPtr($ptr) : \WirklichDigital\SyshelperBase\Entity\ReachableIp
    {
        $this->ptr = $ptr;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\SyshelperBase\Entity\ReachableIp
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\SyshelperBase\Entity\ReachableIp
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return null|\WirklichDigital\SyshelperBase\Entity\AssignedIp
     */
    public function getAssignedIp() : ?\WirklichDigital\SyshelperBase\Entity\AssignedIp
    {
        return $this->assignedIp;
    }

    /**
     * @param null|\WirklichDigital\SyshelperBase\Entity\AssignedIp $assignedIp
     */
    public function setAssignedIp(?\WirklichDigital\SyshelperBase\Entity\AssignedIp $assignedIp) : \WirklichDigital\SyshelperBase\Entity\ReachableIp
    {
        $this->assignedIp = $assignedIp;
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
    public function setAlerts(\Doctrine\Common\Collections\Collection $alerts) : \WirklichDigital\SyshelperBase\Entity\ReachableIp
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
    public function addAlerts($alerts) : \WirklichDigital\SyshelperBase\Entity\ReachableIp
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
    public function removeAlerts($alerts) : \WirklichDigital\SyshelperBase\Entity\ReachableIp
    {
        foreach ($alerts as $_alerts) {
            $_alerts->setHost(null);
            $this->alerts->removeElement($_alerts);
        }
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
    public function setSubnet(?\WirklichDigital\SyshelperBase\Entity\IpSubnet $subnet) : \WirklichDigital\SyshelperBase\Entity\ReachableIp
    {
        $this->subnet = $subnet;
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->alerts = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->alerts = clone $this->alerts;
    }
}


<?php

namespace WirklichDigital\SyshelperBase\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class SyshelperTag extends AbstractEntity
{
    protected $id = null;

    /**
     * @var null|string
     */
    protected $name = null;

    /**
     * @var null|string
     */
    protected $color = null;

    /**
     * @var null|\DateTime
     */
    protected $createdAt = null;

    /**
     * @var null|\DateTime
     */
    protected $updatedAt = null;

    /**
     * @var \WirklichDigital\SyshelperBase\Entity\Host[]|\Doctrine\Common\Collections\Collection
     */
    protected $hosts = null;

    /**
     * @var \WirklichDigital\SyshelperBase\Entity\IpSubnet[]|\Doctrine\Common\Collections\Collection
     */
    protected $ipSubnets = null;

    /**
     * @var \WirklichDigital\SyshelperBase\Entity\AssignedIp[]|\Doctrine\Common\Collections\Collection
     */
    protected $assignedIps = null;

    /**
     * @var null|\WirklichDigital\Authentication\Entity\User
     */
    protected $createdBy = null;

    /**
     * @var null|\WirklichDigital\Authentication\Entity\User
     */
    protected $updatedBy = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id) : \WirklichDigital\SyshelperBase\Entity\SyshelperTag
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
    public function setName($name) : \WirklichDigital\SyshelperBase\Entity\SyshelperTag
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getColor() : ?string
    {
        return $this->color;
    }

    /**
     * @param null|string $color
     */
    public function setColor($color) : \WirklichDigital\SyshelperBase\Entity\SyshelperTag
    {
        $this->color = $color;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\SyshelperBase\Entity\SyshelperTag
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\SyshelperBase\Entity\SyshelperTag
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \WirklichDigital\SyshelperBase\Entity\Host[]|\Doctrine\Common\Collections\Collection
     */
    public function getHosts() : \Doctrine\Common\Collections\Collection
    {
        return $this->hosts;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\Host[]|\Doctrine\Common\Collections\Collection $hosts
     */
    public function setHosts(\Doctrine\Common\Collections\Collection $hosts) : \WirklichDigital\SyshelperBase\Entity\SyshelperTag
    {
        $this->hosts = $hosts;
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\Host[]|\Doctrine\Common\Collections\Collection $hosts
     */
    public function addHosts($hosts) : \WirklichDigital\SyshelperBase\Entity\SyshelperTag
    {
        foreach ($hosts as $_hosts) {
            $_hosts->addTags([$this]);
            $this->hosts->add($_hosts);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\Host[]|\Doctrine\Common\Collections\Collection $hosts
     */
    public function removeHosts($hosts) : \WirklichDigital\SyshelperBase\Entity\SyshelperTag
    {
        foreach ($hosts as $_hosts) {
            $_hosts->removeTags([$this]);
            $this->hosts->removeElement($_hosts);
        }
        return $this;
    }

    /**
     * @return \WirklichDigital\SyshelperBase\Entity\IpSubnet[]|\Doctrine\Common\Collections\Collection
     */
    public function getIpSubnets() : \Doctrine\Common\Collections\Collection
    {
        return $this->ipSubnets;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\IpSubnet[]|\Doctrine\Common\Collections\Collection $ipSubnets
     */
    public function setIpSubnets(\Doctrine\Common\Collections\Collection $ipSubnets) : \WirklichDigital\SyshelperBase\Entity\SyshelperTag
    {
        $this->ipSubnets = $ipSubnets;
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\IpSubnet[]|\Doctrine\Common\Collections\Collection $ipSubnets
     */
    public function addIpSubnets($ipSubnets) : \WirklichDigital\SyshelperBase\Entity\SyshelperTag
    {
        foreach ($ipSubnets as $_ipSubnets) {
            $_ipSubnets->addTags([$this]);
            $this->ipSubnets->add($_ipSubnets);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\IpSubnet[]|\Doctrine\Common\Collections\Collection $ipSubnets
     */
    public function removeIpSubnets($ipSubnets) : \WirklichDigital\SyshelperBase\Entity\SyshelperTag
    {
        foreach ($ipSubnets as $_ipSubnets) {
            $_ipSubnets->removeTags([$this]);
            $this->ipSubnets->removeElement($_ipSubnets);
        }
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
    public function setAssignedIps(\Doctrine\Common\Collections\Collection $assignedIps) : \WirklichDigital\SyshelperBase\Entity\SyshelperTag
    {
        $this->assignedIps = $assignedIps;
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\AssignedIp[]|\Doctrine\Common\Collections\Collection $assignedIps
     */
    public function addAssignedIps($assignedIps) : \WirklichDigital\SyshelperBase\Entity\SyshelperTag
    {
        foreach ($assignedIps as $_assignedIps) {
            $_assignedIps->addTags([$this]);
            $this->assignedIps->add($_assignedIps);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\AssignedIp[]|\Doctrine\Common\Collections\Collection $assignedIps
     */
    public function removeAssignedIps($assignedIps) : \WirklichDigital\SyshelperBase\Entity\SyshelperTag
    {
        foreach ($assignedIps as $_assignedIps) {
            $_assignedIps->removeTags([$this]);
            $this->assignedIps->removeElement($_assignedIps);
        }
        return $this;
    }

    /**
     * @return null|\WirklichDigital\Authentication\Entity\User
     */
    public function getCreatedBy() : ?\WirklichDigital\Authentication\Entity\User
    {
        return $this->createdBy;
    }

    /**
     * @param null|\WirklichDigital\Authentication\Entity\User $createdBy
     */
    public function setCreatedBy(?\WirklichDigital\Authentication\Entity\User $createdBy) : \WirklichDigital\SyshelperBase\Entity\SyshelperTag
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * @return null|\WirklichDigital\Authentication\Entity\User
     */
    public function getUpdatedBy() : ?\WirklichDigital\Authentication\Entity\User
    {
        return $this->updatedBy;
    }

    /**
     * @param null|\WirklichDigital\Authentication\Entity\User $updatedBy
     */
    public function setUpdatedBy(?\WirklichDigital\Authentication\Entity\User $updatedBy) : \WirklichDigital\SyshelperBase\Entity\SyshelperTag
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->hosts = new ArrayCollection();
        $this->ipSubnets = new ArrayCollection();
        $this->assignedIps = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->hosts = clone $this->hosts;
        $this->ipSubnets = clone $this->ipSubnets;
        $this->assignedIps = clone $this->assignedIps;
    }
}


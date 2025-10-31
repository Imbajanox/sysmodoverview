<?php

namespace WirklichDigital\SyshelperBase\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use WirklichDigital\Authentication\Entity\User;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SyshelperBase\Entity\AssignedIp;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SyshelperBase\Entity\IpSubnet;

class SyshelperTag extends AbstractEntity
{
    protected $id;

    /** @var null|string */
    protected $name;

    /** @var null|string */
    protected $color;

    /** @var null|DateTime */
    protected $createdAt;

    /** @var null|DateTime */
    protected $updatedAt;

    /** @var Host[]|Collection */
    protected $hosts;

    /** @var IpSubnet[]|Collection */
    protected $ipSubnets;

    /** @var AssignedIp[]|Collection */
    protected $assignedIps;

    /** @var null|User */
    protected $createdBy;

    /** @var null|User */
    protected $updatedBy;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): SyshelperTag
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
    public function setName($name): SyshelperTag
    {
        $this->name = $name;
        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param null|string $color
     */
    public function setColor($color): SyshelperTag
    {
        $this->color = $color;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): SyshelperTag
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): SyshelperTag
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return Host[]|Collection
     */
    public function getHosts(): Collection
    {
        return $this->hosts;
    }

    /**
     * @param Host[]|Collection $hosts
     */
    public function setHosts(Collection $hosts): SyshelperTag
    {
        $this->hosts = $hosts;
        return $this;
    }

    /**
     * @param Host[]|Collection $hosts
     */
    public function addHosts($hosts): SyshelperTag
    {
        foreach ($hosts as $_hosts) {
            $_hosts->addTags([$this]);
            $this->hosts->add($_hosts);
        }
        return $this;
    }

    /**
     * @param Host[]|Collection $hosts
     */
    public function removeHosts($hosts): SyshelperTag
    {
        foreach ($hosts as $_hosts) {
            $_hosts->removeTags([$this]);
            $this->hosts->removeElement($_hosts);
        }
        return $this;
    }

    /**
     * @return IpSubnet[]|Collection
     */
    public function getIpSubnets(): Collection
    {
        return $this->ipSubnets;
    }

    /**
     * @param IpSubnet[]|Collection $ipSubnets
     */
    public function setIpSubnets(Collection $ipSubnets): SyshelperTag
    {
        $this->ipSubnets = $ipSubnets;
        return $this;
    }

    /**
     * @param IpSubnet[]|Collection $ipSubnets
     */
    public function addIpSubnets($ipSubnets): SyshelperTag
    {
        foreach ($ipSubnets as $_ipSubnets) {
            $_ipSubnets->addTags([$this]);
            $this->ipSubnets->add($_ipSubnets);
        }
        return $this;
    }

    /**
     * @param IpSubnet[]|Collection $ipSubnets
     */
    public function removeIpSubnets($ipSubnets): SyshelperTag
    {
        foreach ($ipSubnets as $_ipSubnets) {
            $_ipSubnets->removeTags([$this]);
            $this->ipSubnets->removeElement($_ipSubnets);
        }
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
    public function setAssignedIps(Collection $assignedIps): SyshelperTag
    {
        $this->assignedIps = $assignedIps;
        return $this;
    }

    /**
     * @param AssignedIp[]|Collection $assignedIps
     */
    public function addAssignedIps($assignedIps): SyshelperTag
    {
        foreach ($assignedIps as $_assignedIps) {
            $_assignedIps->addTags([$this]);
            $this->assignedIps->add($_assignedIps);
        }
        return $this;
    }

    /**
     * @param AssignedIp[]|Collection $assignedIps
     */
    public function removeAssignedIps($assignedIps): SyshelperTag
    {
        foreach ($assignedIps as $_assignedIps) {
            $_assignedIps->removeTags([$this]);
            $this->assignedIps->removeElement($_assignedIps);
        }
        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): SyshelperTag
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): SyshelperTag
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->hosts       = new ArrayCollection();
        $this->ipSubnets   = new ArrayCollection();
        $this->assignedIps = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->hosts       = clone $this->hosts;
        $this->ipSubnets   = clone $this->ipSubnets;
        $this->assignedIps = clone $this->assignedIps;
    }
}

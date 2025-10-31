<?php

namespace WirklichDigital\SyshelperBase\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SyshelperAlerts\Entity\Alert;
use WirklichDigital\SyshelperBase\Entity\AssignedIp;
use WirklichDigital\SyshelperBase\Entity\IpSubnet;

class ReachableIp extends AbstractEntity
{
    protected $id;

    protected $address;

    /** @var null|string */
    protected $ptr;

    /** @var null|DateTime */
    protected $createdAt;

    /** @var null|DateTime */
    protected $updatedAt;

    /** @var null|AssignedIp */
    protected $assignedIp;

    /** @var Alert[]|Collection */
    protected $alerts;

    /** @var null|IpSubnet */
    protected $subnet;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): ReachableIp
    {
        $this->id = $id;
        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address): ReachableIp
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
    public function setPtr($ptr): ReachableIp
    {
        $this->ptr = $ptr;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): ReachableIp
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): ReachableIp
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getAssignedIp(): ?AssignedIp
    {
        return $this->assignedIp;
    }

    public function setAssignedIp(?AssignedIp $assignedIp): ReachableIp
    {
        $this->assignedIp = $assignedIp;
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
    public function setAlerts(Collection $alerts): ReachableIp
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
    public function addAlerts($alerts): ReachableIp
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
    public function removeAlerts($alerts): ReachableIp
    {
        foreach ($alerts as $_alerts) {
            $_alerts->setHost(null);
            $this->alerts->removeElement($_alerts);
        }
        return $this;
    }

    public function getSubnet(): ?IpSubnet
    {
        return $this->subnet;
    }

    public function setSubnet(?IpSubnet $subnet): ReachableIp
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

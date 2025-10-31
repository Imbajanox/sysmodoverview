<?php

namespace WirklichDigital\SyshelperAlerts\Entity;

use DateTime;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SyshelperBase\Entity\AssignedIp;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SyshelperBase\Entity\IpSubnet;
use WirklichDigital\SyshelperBase\Entity\ReachableIp;

class Alert extends AbstractEntity
{
    protected $id;

    /** @var null|string */
    protected $name;

    /** @var null|string */
    protected $description;

    /** @var null|DateTime */
    protected $lastSeenAt;

    /** @var null|string */
    protected $cronjobClass;

    /** @var null|string */
    protected $alertIdentifier;

    /** @var null|bool */
    protected $isAcknowledged = 0;

    /** @var null|bool */
    protected $isMuted = 0;

    /** @var null|DateTime */
    protected $createdAt;

    /** @var null|DateTime */
    protected $updatedAt;

    /** @var null|Host */
    protected $host;

    /** @var null|IpSubnet */
    protected $ipSubnet;

    /** @var null|AssignedIp */
    protected $assignedIp;

    /** @var null|ReachableIp */
    protected $reachableIp;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): Alert
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
    public function setName($name): Alert
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription($description): Alert
    {
        $this->description = $description;
        return $this;
    }

    public function getLastSeenAt(): ?DateTime
    {
        return $this->lastSeenAt;
    }

    public function setLastSeenAt(?DateTime $lastSeenAt): Alert
    {
        $this->lastSeenAt = $lastSeenAt;
        return $this;
    }

    public function getCronjobClass(): ?string
    {
        return $this->cronjobClass;
    }

    /**
     * @param null|string $cronjobClass
     */
    public function setCronjobClass($cronjobClass): Alert
    {
        $this->cronjobClass = $cronjobClass;
        return $this;
    }

    public function getAlertIdentifier(): ?string
    {
        return $this->alertIdentifier;
    }

    /**
     * @param null|string $alertIdentifier
     */
    public function setAlertIdentifier($alertIdentifier): Alert
    {
        $this->alertIdentifier = $alertIdentifier;
        return $this;
    }

    public function getIsAcknowledged(): ?bool
    {
        return $this->isAcknowledged;
    }

    /**
     * @param null|bool $isAcknowledged
     */
    public function setIsAcknowledged($isAcknowledged): Alert
    {
        $this->isAcknowledged = $isAcknowledged;
        return $this;
    }

    public function getIsMuted(): ?bool
    {
        return $this->isMuted;
    }

    /**
     * @param null|bool $isMuted
     */
    public function setIsMuted($isMuted): Alert
    {
        $this->isMuted = $isMuted;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): Alert
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): Alert
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getHost(): ?Host
    {
        return $this->host;
    }

    public function setHost(?Host $host): Alert
    {
        $this->host = $host;
        return $this;
    }

    public function getIpSubnet(): ?IpSubnet
    {
        return $this->ipSubnet;
    }

    public function setIpSubnet(?IpSubnet $ipSubnet): Alert
    {
        $this->ipSubnet = $ipSubnet;
        return $this;
    }

    public function getAssignedIp(): ?AssignedIp
    {
        return $this->assignedIp;
    }

    public function setAssignedIp(?AssignedIp $assignedIp): Alert
    {
        $this->assignedIp = $assignedIp;
        return $this;
    }

    public function getReachableIp(): ?ReachableIp
    {
        return $this->reachableIp;
    }

    public function setReachableIp(?ReachableIp $reachableIp): Alert
    {
        $this->reachableIp = $reachableIp;
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function __clone()
    {
    }
}

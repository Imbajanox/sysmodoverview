<?php

namespace WirklichDigital\SyshelperAlerts\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class Alert extends AbstractEntity
{
    protected $id = null;

    /**
     * @var null|string
     */
    protected $name = null;

    /**
     * @var null|string
     */
    protected $description = null;

    /**
     * @var null|\DateTime
     */
    protected $lastSeenAt = null;

    /**
     * @var null|string
     */
    protected $cronjobClass = null;

    /**
     * @var null|string
     */
    protected $alertIdentifier = null;

    /**
     * @var null|bool
     */
    protected $isAcknowledged = 0;

    /**
     * @var null|bool
     */
    protected $isMuted = 0;

    /**
     * @var null|\DateTime
     */
    protected $createdAt = null;

    /**
     * @var null|\DateTime
     */
    protected $updatedAt = null;

    /**
     * @var null|\WirklichDigital\SyshelperBase\Entity\Host
     */
    protected $host = null;

    /**
     * @var null|\WirklichDigital\SyshelperBase\Entity\IpSubnet
     */
    protected $ipSubnet = null;

    /**
     * @var null|\WirklichDigital\SyshelperBase\Entity\AssignedIp
     */
    protected $assignedIp = null;

    /**
     * @var null|\WirklichDigital\SyshelperBase\Entity\ReachableIp
     */
    protected $reachableIp = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id) : \WirklichDigital\SyshelperAlerts\Entity\Alert
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
    public function setName($name) : \WirklichDigital\SyshelperAlerts\Entity\Alert
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription() : ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription($description) : \WirklichDigital\SyshelperAlerts\Entity\Alert
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getLastSeenAt() : ?\DateTime
    {
        return $this->lastSeenAt;
    }

    /**
     * @param null|\DateTime $lastSeenAt
     */
    public function setLastSeenAt(?\DateTime $lastSeenAt) : \WirklichDigital\SyshelperAlerts\Entity\Alert
    {
        $this->lastSeenAt = $lastSeenAt;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCronjobClass() : ?string
    {
        return $this->cronjobClass;
    }

    /**
     * @param null|string $cronjobClass
     */
    public function setCronjobClass($cronjobClass) : \WirklichDigital\SyshelperAlerts\Entity\Alert
    {
        $this->cronjobClass = $cronjobClass;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getAlertIdentifier() : ?string
    {
        return $this->alertIdentifier;
    }

    /**
     * @param null|string $alertIdentifier
     */
    public function setAlertIdentifier($alertIdentifier) : \WirklichDigital\SyshelperAlerts\Entity\Alert
    {
        $this->alertIdentifier = $alertIdentifier;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getIsAcknowledged() : ?bool
    {
        return $this->isAcknowledged;
    }

    /**
     * @param null|bool $isAcknowledged
     */
    public function setIsAcknowledged($isAcknowledged) : \WirklichDigital\SyshelperAlerts\Entity\Alert
    {
        $this->isAcknowledged = $isAcknowledged;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getIsMuted() : ?bool
    {
        return $this->isMuted;
    }

    /**
     * @param null|bool $isMuted
     */
    public function setIsMuted($isMuted) : \WirklichDigital\SyshelperAlerts\Entity\Alert
    {
        $this->isMuted = $isMuted;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\SyshelperAlerts\Entity\Alert
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\SyshelperAlerts\Entity\Alert
    {
        $this->updatedAt = $updatedAt;
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
    public function setHost(?\WirklichDigital\SyshelperBase\Entity\Host $host) : \WirklichDigital\SyshelperAlerts\Entity\Alert
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return null|\WirklichDigital\SyshelperBase\Entity\IpSubnet
     */
    public function getIpSubnet() : ?\WirklichDigital\SyshelperBase\Entity\IpSubnet
    {
        return $this->ipSubnet;
    }

    /**
     * @param null|\WirklichDigital\SyshelperBase\Entity\IpSubnet $ipSubnet
     */
    public function setIpSubnet(?\WirklichDigital\SyshelperBase\Entity\IpSubnet $ipSubnet) : \WirklichDigital\SyshelperAlerts\Entity\Alert
    {
        $this->ipSubnet = $ipSubnet;
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
    public function setAssignedIp(?\WirklichDigital\SyshelperBase\Entity\AssignedIp $assignedIp) : \WirklichDigital\SyshelperAlerts\Entity\Alert
    {
        $this->assignedIp = $assignedIp;
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
    public function setReachableIp(?\WirklichDigital\SyshelperBase\Entity\ReachableIp $reachableIp) : \WirklichDigital\SyshelperAlerts\Entity\Alert
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


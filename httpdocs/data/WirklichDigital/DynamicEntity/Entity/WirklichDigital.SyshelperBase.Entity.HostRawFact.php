<?php

namespace WirklichDigital\SyshelperBase\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class HostRawFact extends AbstractEntity
{
    protected $id = null;

    /**
     * @var null|string
     */
    protected $type = null;

    /**
     * @var null|string
     */
    protected $rawValue = null;

    /**
     * @var null|bool
     */
    protected $hasBeenParsed = 0;

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

    public function getId()
    {
        return $this->id;
    }

    public function setId($id) : \WirklichDigital\SyshelperBase\Entity\HostRawFact
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getType() : ?string
    {
        return $this->type;
    }

    /**
     * @param null|string $type
     */
    public function setType($type) : \WirklichDigital\SyshelperBase\Entity\HostRawFact
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getRawValue() : ?string
    {
        return $this->rawValue;
    }

    /**
     * @param null|string $rawValue
     */
    public function setRawValue($rawValue) : \WirklichDigital\SyshelperBase\Entity\HostRawFact
    {
        $this->rawValue = $rawValue;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getHasBeenParsed() : ?bool
    {
        return $this->hasBeenParsed;
    }

    /**
     * @param null|bool $hasBeenParsed
     */
    public function setHasBeenParsed($hasBeenParsed) : \WirklichDigital\SyshelperBase\Entity\HostRawFact
    {
        $this->hasBeenParsed = $hasBeenParsed;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\SyshelperBase\Entity\HostRawFact
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\SyshelperBase\Entity\HostRawFact
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
    public function setHost(?\WirklichDigital\SyshelperBase\Entity\Host $host) : \WirklichDigital\SyshelperBase\Entity\HostRawFact
    {
        $this->host = $host;
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


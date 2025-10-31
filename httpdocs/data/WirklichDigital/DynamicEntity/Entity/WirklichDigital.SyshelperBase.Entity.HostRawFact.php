<?php

namespace WirklichDigital\SyshelperBase\Entity;

use DateTime;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SyshelperBase\Entity\Host;

class HostRawFact extends AbstractEntity
{
    protected $id;

    /** @var null|string */
    protected $type;

    /** @var null|string */
    protected $rawValue;

    /** @var null|bool */
    protected $hasBeenParsed = 0;

    /** @var null|DateTime */
    protected $createdAt;

    /** @var null|DateTime */
    protected $updatedAt;

    /** @var null|Host */
    protected $host;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): HostRawFact
    {
        $this->id = $id;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param null|string $type
     */
    public function setType($type): HostRawFact
    {
        $this->type = $type;
        return $this;
    }

    public function getRawValue(): ?string
    {
        return $this->rawValue;
    }

    /**
     * @param null|string $rawValue
     */
    public function setRawValue($rawValue): HostRawFact
    {
        $this->rawValue = $rawValue;
        return $this;
    }

    public function getHasBeenParsed(): ?bool
    {
        return $this->hasBeenParsed;
    }

    /**
     * @param null|bool $hasBeenParsed
     */
    public function setHasBeenParsed($hasBeenParsed): HostRawFact
    {
        $this->hasBeenParsed = $hasBeenParsed;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): HostRawFact
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): HostRawFact
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getHost(): ?Host
    {
        return $this->host;
    }

    public function setHost(?Host $host): HostRawFact
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

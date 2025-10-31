<?php

namespace WirklichDigital\DynamicEntityLoggableModule\Entity;

use DateTime;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class LogEntry extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $action;

    /** @var null|DateTime */
    protected $loggedAt;

    /** @var null|string */
    protected $objectId;

    /** @var null|string */
    protected $objectClass;

    /** @var null|int */
    protected $version;

    /** @var null|array */
    protected $data;

    /** @var null|string */
    protected $username;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): LogEntry
    {
        $this->id = $id;
        return $this;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    /**
     * @param null|string $action
     */
    public function setAction($action): LogEntry
    {
        $this->action = $action;
        return $this;
    }

    public function getLoggedAt(): ?DateTime
    {
        return $this->loggedAt;
    }

    public function getObjectId(): ?string
    {
        return $this->objectId;
    }

    /**
     * @param null|string $objectId
     */
    public function setObjectId($objectId): LogEntry
    {
        $this->objectId = $objectId;
        return $this;
    }

    public function getObjectClass(): ?string
    {
        return $this->objectClass;
    }

    /**
     * @param null|string $objectClass
     */
    public function setObjectClass($objectClass): LogEntry
    {
        $this->objectClass = $objectClass;
        return $this;
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

    /**
     * @param null|int $version
     */
    public function setVersion($version): LogEntry
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return null|array
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @param null|array $data
     */
    public function setData($data): LogEntry
    {
        $this->data = $data;
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param null|string $username
     */
    public function setUsername($username): LogEntry
    {
        $this->username = $username;
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function __clone()
    {
    }

    public function setLoggedAt()
    {
        $this->loggedAt = new DateTime();
        return $this;
    }
}

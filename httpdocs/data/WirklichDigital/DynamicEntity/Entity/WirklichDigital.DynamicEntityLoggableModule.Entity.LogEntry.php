<?php

namespace WirklichDigital\DynamicEntityLoggableModule\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class LogEntry extends AbstractEntity
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $action = null;

    /**
     * @var null|\DateTime
     */
    protected $loggedAt = null;

    /**
     * @var null|string
     */
    protected $objectId = null;

    /**
     * @var null|string
     */
    protected $objectClass = null;

    /**
     * @var null|int
     */
    protected $version = null;

    /**
     * @var null|array
     */
    protected $data = null;

    /**
     * @var null|string
     */
    protected $username = null;

    /**
     * @return null|int
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id) : \WirklichDigital\DynamicEntityLoggableModule\Entity\LogEntry
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getAction() : ?string
    {
        return $this->action;
    }

    /**
     * @param null|string $action
     */
    public function setAction($action) : \WirklichDigital\DynamicEntityLoggableModule\Entity\LogEntry
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getLoggedAt() : ?\DateTime
    {
        return $this->loggedAt;
    }

    /**
     * @return null|string
     */
    public function getObjectId() : ?string
    {
        return $this->objectId;
    }

    /**
     * @param null|string $objectId
     */
    public function setObjectId($objectId) : \WirklichDigital\DynamicEntityLoggableModule\Entity\LogEntry
    {
        $this->objectId = $objectId;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getObjectClass() : ?string
    {
        return $this->objectClass;
    }

    /**
     * @param null|string $objectClass
     */
    public function setObjectClass($objectClass) : \WirklichDigital\DynamicEntityLoggableModule\Entity\LogEntry
    {
        $this->objectClass = $objectClass;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getVersion() : ?int
    {
        return $this->version;
    }

    /**
     * @param null|int $version
     */
    public function setVersion($version) : \WirklichDigital\DynamicEntityLoggableModule\Entity\LogEntry
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return null|array
     */
    public function getData() : ?array
    {
        return $this->data;
    }

    /**
     * @param null|array $data
     */
    public function setData($data) : \WirklichDigital\DynamicEntityLoggableModule\Entity\LogEntry
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getUsername() : ?string
    {
        return $this->username;
    }

    /**
     * @param null|string $username
     */
    public function setUsername($username) : \WirklichDigital\DynamicEntityLoggableModule\Entity\LogEntry
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
        $this->loggedAt = new \DateTime();
        return $this;
    }
}


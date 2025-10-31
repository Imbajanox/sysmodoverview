<?php

namespace WirklichDigital\Logger\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class ApplicationLog extends AbstractEntity
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $message = null;

    protected $extra = null;

    /**
     * @var null|int
     */
    protected $priority = null;

    /**
     * @var null|string
     */
    protected $url = null;

    /**
     * @var null|string
     */
    protected $component = null;

    /**
     * @var null|\DateTime
     */
    protected $createdAt = null;

    /**
     * @var null|\DateTime
     */
    protected $updatedAt = null;

    /**
     * @var null|\WirklichDigital\Authentication\Entity\User
     */
    protected $createdBy = null;

    /**
     * @var null|\WirklichDigital\Authentication\Entity\User
     */
    protected $updatedBy = null;

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
    public function setId($id) : \WirklichDigital\Logger\Entity\ApplicationLog
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getMessage() : ?string
    {
        return $this->message;
    }

    /**
     * @param null|string $message
     */
    public function setMessage($message) : \WirklichDigital\Logger\Entity\ApplicationLog
    {
        $this->message = $message;
        return $this;
    }

    public function getExtra()
    {
        return $this->extra;
    }

    public function setExtra($extra) : \WirklichDigital\Logger\Entity\ApplicationLog
    {
        $this->extra = $extra;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getPriority() : ?int
    {
        return $this->priority;
    }

    /**
     * @param null|int $priority
     */
    public function setPriority($priority) : \WirklichDigital\Logger\Entity\ApplicationLog
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getUrl() : ?string
    {
        return $this->url;
    }

    /**
     * @param null|string $url
     */
    public function setUrl($url) : \WirklichDigital\Logger\Entity\ApplicationLog
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getComponent() : ?string
    {
        return $this->component;
    }

    /**
     * @param null|string $component
     */
    public function setComponent($component) : \WirklichDigital\Logger\Entity\ApplicationLog
    {
        $this->component = $component;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\Logger\Entity\ApplicationLog
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\Logger\Entity\ApplicationLog
    {
        $this->updatedAt = $updatedAt;
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
    public function setCreatedBy(?\WirklichDigital\Authentication\Entity\User $createdBy) : \WirklichDigital\Logger\Entity\ApplicationLog
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
    public function setUpdatedBy(?\WirklichDigital\Authentication\Entity\User $updatedBy) : \WirklichDigital\Logger\Entity\ApplicationLog
    {
        $this->updatedBy = $updatedBy;
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


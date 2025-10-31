<?php

namespace WirklichDigital\Logger\Entity;

use DateTime;
use WirklichDigital\Authentication\Entity\User;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class ApplicationLog extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $message;

    protected $extra;

    /** @var null|int */
    protected $priority;

    /** @var null|string */
    protected $url;

    /** @var null|string */
    protected $component;

    /** @var null|DateTime */
    protected $createdAt;

    /** @var null|DateTime */
    protected $updatedAt;

    /** @var null|User */
    protected $createdBy;

    /** @var null|User */
    protected $updatedBy;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): ApplicationLog
    {
        $this->id = $id;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param null|string $message
     */
    public function setMessage($message): ApplicationLog
    {
        $this->message = $message;
        return $this;
    }

    public function getExtra()
    {
        return $this->extra;
    }

    public function setExtra($extra): ApplicationLog
    {
        $this->extra = $extra;
        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @param null|int $priority
     */
    public function setPriority($priority): ApplicationLog
    {
        $this->priority = $priority;
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param null|string $url
     */
    public function setUrl($url): ApplicationLog
    {
        $this->url = $url;
        return $this;
    }

    public function getComponent(): ?string
    {
        return $this->component;
    }

    /**
     * @param null|string $component
     */
    public function setComponent($component): ApplicationLog
    {
        $this->component = $component;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): ApplicationLog
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): ApplicationLog
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): ApplicationLog
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): ApplicationLog
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

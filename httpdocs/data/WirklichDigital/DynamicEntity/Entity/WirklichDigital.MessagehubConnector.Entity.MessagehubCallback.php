<?php

namespace WirklichDigital\MessagehubConnector\Entity;

use DateTime;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class MessagehubCallback extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|int */
    protected $messagehubId;

    /** @var null|string */
    protected $callback;

    /** @var null|DateTime */
    protected $createdAt;

    /** @var null|DateTime */
    protected $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): MessagehubCallback
    {
        $this->id = $id;
        return $this;
    }

    public function getMessagehubId(): ?int
    {
        return $this->messagehubId;
    }

    /**
     * @param null|int $messagehubId
     */
    public function setMessagehubId($messagehubId): MessagehubCallback
    {
        $this->messagehubId = $messagehubId;
        return $this;
    }

    public function getCallback(): ?string
    {
        return $this->callback;
    }

    /**
     * @param null|string $callback
     */
    public function setCallback($callback): MessagehubCallback
    {
        $this->callback = $callback;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): MessagehubCallback
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): MessagehubCallback
    {
        $this->updatedAt = $updatedAt;
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

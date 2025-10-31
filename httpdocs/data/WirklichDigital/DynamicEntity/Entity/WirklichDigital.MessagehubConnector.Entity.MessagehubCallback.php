<?php

namespace WirklichDigital\MessagehubConnector\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class MessagehubCallback extends AbstractEntity
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|int
     */
    protected $messagehubId = null;

    /**
     * @var null|string
     */
    protected $callback = null;

    /**
     * @var null|\DateTime
     */
    protected $createdAt = null;

    /**
     * @var null|\DateTime
     */
    protected $updatedAt = null;

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
    public function setId($id) : \WirklichDigital\MessagehubConnector\Entity\MessagehubCallback
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getMessagehubId() : ?int
    {
        return $this->messagehubId;
    }

    /**
     * @param null|int $messagehubId
     */
    public function setMessagehubId($messagehubId) : \WirklichDigital\MessagehubConnector\Entity\MessagehubCallback
    {
        $this->messagehubId = $messagehubId;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCallback() : ?string
    {
        return $this->callback;
    }

    /**
     * @param null|string $callback
     */
    public function setCallback($callback) : \WirklichDigital\MessagehubConnector\Entity\MessagehubCallback
    {
        $this->callback = $callback;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\MessagehubConnector\Entity\MessagehubCallback
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\MessagehubConnector\Entity\MessagehubCallback
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


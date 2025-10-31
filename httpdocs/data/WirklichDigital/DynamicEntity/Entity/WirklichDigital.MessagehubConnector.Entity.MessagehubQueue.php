<?php

namespace WirklichDigital\MessagehubConnector\Entity;

use DateTime;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class MessagehubQueue extends AbstractEntity
{
    protected $id;

    /** @var null|string */
    protected $channel;

    protected $messageData;

    /** @var null|DateTime */
    protected $lastRequestAttempt;

    /** @var null|int */
    protected $failedRequets = 0;

    /** @var null|DateTime */
    protected $createdAt;

    /** @var null|DateTime */
    protected $updatedAt;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): MessagehubQueue
    {
        $this->id = $id;
        return $this;
    }

    public function getChannel(): ?string
    {
        return $this->channel;
    }

    /**
     * @param null|string $channel
     */
    public function setChannel($channel): MessagehubQueue
    {
        $this->channel = $channel;
        return $this;
    }

    public function getMessageData()
    {
        return $this->messageData;
    }

    public function setMessageData($messageData): MessagehubQueue
    {
        $this->messageData = $messageData;
        return $this;
    }

    public function getLastRequestAttempt(): ?DateTime
    {
        return $this->lastRequestAttempt;
    }

    public function setLastRequestAttempt(?DateTime $lastRequestAttempt): MessagehubQueue
    {
        $this->lastRequestAttempt = $lastRequestAttempt;
        return $this;
    }

    public function getFailedRequets(): ?int
    {
        return $this->failedRequets;
    }

    /**
     * @param null|int $failedRequets
     */
    public function setFailedRequets($failedRequets): MessagehubQueue
    {
        $this->failedRequets = $failedRequets;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): MessagehubQueue
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): MessagehubQueue
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

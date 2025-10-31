<?php

namespace WirklichDigital\MessagehubConnector\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class MessagehubQueue extends AbstractEntity
{
    protected $id = null;

    /**
     * @var null|string
     */
    protected $channel = null;

    protected $messageData = null;

    /**
     * @var null|\DateTime
     */
    protected $lastRequestAttempt = null;

    /**
     * @var null|int
     */
    protected $failedRequets = 0;

    /**
     * @var null|\DateTime
     */
    protected $createdAt = null;

    /**
     * @var null|\DateTime
     */
    protected $updatedAt = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id) : \WirklichDigital\MessagehubConnector\Entity\MessagehubQueue
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getChannel() : ?string
    {
        return $this->channel;
    }

    /**
     * @param null|string $channel
     */
    public function setChannel($channel) : \WirklichDigital\MessagehubConnector\Entity\MessagehubQueue
    {
        $this->channel = $channel;
        return $this;
    }

    public function getMessageData()
    {
        return $this->messageData;
    }

    public function setMessageData($messageData) : \WirklichDigital\MessagehubConnector\Entity\MessagehubQueue
    {
        $this->messageData = $messageData;
        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getLastRequestAttempt() : ?\DateTime
    {
        return $this->lastRequestAttempt;
    }

    /**
     * @param null|\DateTime $lastRequestAttempt
     */
    public function setLastRequestAttempt(?\DateTime $lastRequestAttempt) : \WirklichDigital\MessagehubConnector\Entity\MessagehubQueue
    {
        $this->lastRequestAttempt = $lastRequestAttempt;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getFailedRequets() : ?int
    {
        return $this->failedRequets;
    }

    /**
     * @param null|int $failedRequets
     */
    public function setFailedRequets($failedRequets) : \WirklichDigital\MessagehubConnector\Entity\MessagehubQueue
    {
        $this->failedRequets = $failedRequets;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\MessagehubConnector\Entity\MessagehubQueue
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\MessagehubConnector\Entity\MessagehubQueue
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


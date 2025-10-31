<?php

namespace WirklichDigital\SyshelperBase\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class SshPublicKeyHostMapping extends AbstractEntity
{
    protected $id = null;

    /**
     * @var null|string
     */
    protected $userOnHost = null;

    /**
     * @var null|string
     */
    protected $comment = null;

    /**
     * @var null|string
     */
    protected $environment = null;

    /**
     * @var null|\DateTime
     */
    protected $createdAt = null;

    /**
     * @var null|\DateTime
     */
    protected $updatedAt = null;

    /**
     * @var null|\WirklichDigital\SyshelperBase\Entity\SshPublicKey
     */
    protected $sshPublicKey = null;

    /**
     * @var null|\WirklichDigital\SyshelperBase\Entity\Host
     */
    protected $host = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id) : \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getUserOnHost() : ?string
    {
        return $this->userOnHost;
    }

    /**
     * @param null|string $userOnHost
     */
    public function setUserOnHost($userOnHost) : \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping
    {
        $this->userOnHost = $userOnHost;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getComment() : ?string
    {
        return $this->comment;
    }

    /**
     * @param null|string $comment
     */
    public function setComment($comment) : \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getEnvironment() : ?string
    {
        return $this->environment;
    }

    /**
     * @param null|string $environment
     */
    public function setEnvironment($environment) : \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping
    {
        $this->environment = $environment;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return null|\WirklichDigital\SyshelperBase\Entity\SshPublicKey
     */
    public function getSshPublicKey() : ?\WirklichDigital\SyshelperBase\Entity\SshPublicKey
    {
        return $this->sshPublicKey;
    }

    /**
     * @param null|\WirklichDigital\SyshelperBase\Entity\SshPublicKey $sshPublicKey
     */
    public function setSshPublicKey(?\WirklichDigital\SyshelperBase\Entity\SshPublicKey $sshPublicKey) : \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping
    {
        $this->sshPublicKey = $sshPublicKey;
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
    public function setHost(?\WirklichDigital\SyshelperBase\Entity\Host $host) : \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping
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


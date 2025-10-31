<?php

namespace WirklichDigital\SyshelperBase\Entity;

use DateTime;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SyshelperBase\Entity\SshPublicKey;

class SshPublicKeyHostMapping extends AbstractEntity
{
    protected $id;

    /** @var null|string */
    protected $userOnHost;

    /** @var null|string */
    protected $comment;

    /** @var null|string */
    protected $environment;

    /** @var null|DateTime */
    protected $createdAt;

    /** @var null|DateTime */
    protected $updatedAt;

    /** @var null|SshPublicKey */
    protected $sshPublicKey;

    /** @var null|Host */
    protected $host;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): SshPublicKeyHostMapping
    {
        $this->id = $id;
        return $this;
    }

    public function getUserOnHost(): ?string
    {
        return $this->userOnHost;
    }

    /**
     * @param null|string $userOnHost
     */
    public function setUserOnHost($userOnHost): SshPublicKeyHostMapping
    {
        $this->userOnHost = $userOnHost;
        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param null|string $comment
     */
    public function setComment($comment): SshPublicKeyHostMapping
    {
        $this->comment = $comment;
        return $this;
    }

    public function getEnvironment(): ?string
    {
        return $this->environment;
    }

    /**
     * @param null|string $environment
     */
    public function setEnvironment($environment): SshPublicKeyHostMapping
    {
        $this->environment = $environment;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): SshPublicKeyHostMapping
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): SshPublicKeyHostMapping
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getSshPublicKey(): ?SshPublicKey
    {
        return $this->sshPublicKey;
    }

    public function setSshPublicKey(?SshPublicKey $sshPublicKey): SshPublicKeyHostMapping
    {
        $this->sshPublicKey = $sshPublicKey;
        return $this;
    }

    public function getHost(): ?Host
    {
        return $this->host;
    }

    public function setHost(?Host $host): SshPublicKeyHostMapping
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

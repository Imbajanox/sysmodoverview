<?php

namespace WirklichDigital\SyshelperBase\Entity;

use DateTime;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SyshelperBase\Entity\SshPublicKey;

class SshPublicKeyHostAccess extends AbstractEntity
{
    protected $id;

    /** @var null|string */
    protected $userOnHost;

    /** @var null|bool */
    protected $doNotBlockIfUnused = 0;

    /** @var null|bool */
    protected $blockedBecauseUnused = 0;

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

    public function setId($id): SshPublicKeyHostAccess
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
    public function setUserOnHost($userOnHost): SshPublicKeyHostAccess
    {
        $this->userOnHost = $userOnHost;
        return $this;
    }

    public function getDoNotBlockIfUnused(): ?bool
    {
        return $this->doNotBlockIfUnused;
    }

    /**
     * @param null|bool $doNotBlockIfUnused
     */
    public function setDoNotBlockIfUnused($doNotBlockIfUnused): SshPublicKeyHostAccess
    {
        $this->doNotBlockIfUnused = $doNotBlockIfUnused;
        return $this;
    }

    public function getBlockedBecauseUnused(): ?bool
    {
        return $this->blockedBecauseUnused;
    }

    /**
     * @param null|bool $blockedBecauseUnused
     */
    public function setBlockedBecauseUnused($blockedBecauseUnused): SshPublicKeyHostAccess
    {
        $this->blockedBecauseUnused = $blockedBecauseUnused;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): SshPublicKeyHostAccess
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): SshPublicKeyHostAccess
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getSshPublicKey(): ?SshPublicKey
    {
        return $this->sshPublicKey;
    }

    public function setSshPublicKey(?SshPublicKey $sshPublicKey): SshPublicKeyHostAccess
    {
        $this->sshPublicKey = $sshPublicKey;
        return $this;
    }

    public function getHost(): ?Host
    {
        return $this->host;
    }

    public function setHost(?Host $host): SshPublicKeyHostAccess
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

<?php

namespace WirklichDigital\SyshelperBase\Entity;

use DateTime;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SyshelperBase\Entity\SshPublicKey;

class SshPublicKeyLogin extends AbstractEntity
{
    protected $id;

    /** @var null|string */
    protected $user;

    protected $ip;

    /** @var null|DateTime */
    protected $loggedInAt;

    /** @var null|Host */
    protected $host;

    /** @var null|SshPublicKey */
    protected $sshPublicKey;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): SshPublicKeyLogin
    {
        $this->id = $id;
        return $this;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    /**
     * @param null|string $user
     */
    public function setUser($user): SshPublicKeyLogin
    {
        $this->user = $user;
        return $this;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip): SshPublicKeyLogin
    {
        $this->ip = $ip;
        return $this;
    }

    public function getLoggedInAt(): ?DateTime
    {
        return $this->loggedInAt;
    }

    public function setLoggedInAt(?DateTime $loggedInAt): SshPublicKeyLogin
    {
        $this->loggedInAt = $loggedInAt;
        return $this;
    }

    public function getHost(): ?Host
    {
        return $this->host;
    }

    public function setHost(?Host $host): SshPublicKeyLogin
    {
        $this->host = $host;
        return $this;
    }

    public function getSshPublicKey(): ?SshPublicKey
    {
        return $this->sshPublicKey;
    }

    public function setSshPublicKey(?SshPublicKey $sshPublicKey): SshPublicKeyLogin
    {
        $this->sshPublicKey = $sshPublicKey;
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

<?php

namespace WirklichDigital\SyshelperBase\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class SshPublicKeyLogin extends AbstractEntity
{
    protected $id = null;

    /**
     * @var null|string
     */
    protected $user = null;

    protected $ip = null;

    /**
     * @var null|\DateTime
     */
    protected $loggedInAt = null;

    /**
     * @var null|\WirklichDigital\SyshelperBase\Entity\Host
     */
    protected $host = null;

    /**
     * @var null|\WirklichDigital\SyshelperBase\Entity\SshPublicKey
     */
    protected $sshPublicKey = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id) : \WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getUser() : ?string
    {
        return $this->user;
    }

    /**
     * @param null|string $user
     */
    public function setUser($user) : \WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin
    {
        $this->user = $user;
        return $this;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip) : \WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getLoggedInAt() : ?\DateTime
    {
        return $this->loggedInAt;
    }

    /**
     * @param null|\DateTime $loggedInAt
     */
    public function setLoggedInAt(?\DateTime $loggedInAt) : \WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin
    {
        $this->loggedInAt = $loggedInAt;
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
    public function setHost(?\WirklichDigital\SyshelperBase\Entity\Host $host) : \WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin
    {
        $this->host = $host;
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
    public function setSshPublicKey(?\WirklichDigital\SyshelperBase\Entity\SshPublicKey $sshPublicKey) : \WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin
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


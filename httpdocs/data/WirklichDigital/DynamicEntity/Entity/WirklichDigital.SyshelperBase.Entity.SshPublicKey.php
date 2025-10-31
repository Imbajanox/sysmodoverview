<?php

namespace WirklichDigital\SyshelperBase\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class SshPublicKey extends AbstractEntity
{
    protected $id = null;

    /**
     * @var null|string
     */
    protected $title = null;

    /**
     * @var null|string
     */
    protected $keyType = null;

    /**
     * @var null|string
     */
    protected $keyData = null;

    /**
     * @var null|bool
     */
    protected $doNotTrackLogins = 0;

    /**
     * @var null|string
     */
    protected $fingerprint = null;

    /**
     * @var null|string
     */
    protected $usergroup = null;

    /**
     * @var null|\DateTime
     */
    protected $createdAt = null;

    /**
     * @var null|\DateTime
     */
    protected $updatedAt = null;

    /**
     * @var \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping[]|\Doctrine\Common\Collections\Collection
     */
    protected $hostMappings = null;

    /**
     * @var \WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin[]|\Doctrine\Common\Collections\Collection
     */
    protected $sshPublicKeyLogins = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id) : \WirklichDigital\SyshelperBase\Entity\SshPublicKey
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getTitle() : ?string
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     */
    public function setTitle($title) : \WirklichDigital\SyshelperBase\Entity\SshPublicKey
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getKeyType() : ?string
    {
        return $this->keyType;
    }

    /**
     * @param null|string $keyType
     */
    public function setKeyType($keyType) : \WirklichDigital\SyshelperBase\Entity\SshPublicKey
    {
        $this->keyType = $keyType;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getKeyData() : ?string
    {
        return $this->keyData;
    }

    /**
     * @param null|string $keyData
     */
    public function setKeyData($keyData) : \WirklichDigital\SyshelperBase\Entity\SshPublicKey
    {
        $this->keyData = $keyData;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getDoNotTrackLogins() : ?bool
    {
        return $this->doNotTrackLogins;
    }

    /**
     * @param null|bool $doNotTrackLogins
     */
    public function setDoNotTrackLogins($doNotTrackLogins) : \WirklichDigital\SyshelperBase\Entity\SshPublicKey
    {
        $this->doNotTrackLogins = $doNotTrackLogins;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFingerprint() : ?string
    {
        return $this->fingerprint;
    }

    /**
     * @param null|string $fingerprint
     */
    public function setFingerprint($fingerprint) : \WirklichDigital\SyshelperBase\Entity\SshPublicKey
    {
        $this->fingerprint = $fingerprint;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getUsergroup() : ?string
    {
        return $this->usergroup;
    }

    /**
     * @param null|string $usergroup
     */
    public function setUsergroup($usergroup) : \WirklichDigital\SyshelperBase\Entity\SshPublicKey
    {
        $this->usergroup = $usergroup;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\SyshelperBase\Entity\SshPublicKey
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\SyshelperBase\Entity\SshPublicKey
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping[]|\Doctrine\Common\Collections\Collection
     */
    public function getHostMappings() : \Doctrine\Common\Collections\Collection
    {
        return $this->hostMappings;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping[]|\Doctrine\Common\Collections\Collection $hostMappings
     */
    public function setHostMappings(\Doctrine\Common\Collections\Collection $hostMappings) : \WirklichDigital\SyshelperBase\Entity\SshPublicKey
    {
        $this->hostMappings = $hostMappings;
        if ($this->hostMappings) {
            foreach ($this->hostMappings as $_hostMappings) {
                $_hostMappings->setSshPublicKey($this);
            }
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping[]|\Doctrine\Common\Collections\Collection $hostMappings
     */
    public function addHostMappings($hostMappings) : \WirklichDigital\SyshelperBase\Entity\SshPublicKey
    {
        foreach ($hostMappings as $_hostMappings) {
            $_hostMappings->setSshPublicKey($this);
            $this->hostMappings->add($_hostMappings);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping[]|\Doctrine\Common\Collections\Collection $hostMappings
     */
    public function removeHostMappings($hostMappings) : \WirklichDigital\SyshelperBase\Entity\SshPublicKey
    {
        foreach ($hostMappings as $_hostMappings) {
            $_hostMappings->setSshPublicKey(null);
            $this->hostMappings->removeElement($_hostMappings);
        }
        return $this;
    }

    /**
     * @return \WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin[]|\Doctrine\Common\Collections\Collection
     */
    public function getSshPublicKeyLogins() : \Doctrine\Common\Collections\Collection
    {
        return $this->sshPublicKeyLogins;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin[]|\Doctrine\Common\Collections\Collection $sshPublicKeyLogins
     */
    public function setSshPublicKeyLogins(\Doctrine\Common\Collections\Collection $sshPublicKeyLogins) : \WirklichDigital\SyshelperBase\Entity\SshPublicKey
    {
        $this->sshPublicKeyLogins = $sshPublicKeyLogins;
        if ($this->sshPublicKeyLogins) {
            foreach ($this->sshPublicKeyLogins as $_sshPublicKeyLogins) {
                $_sshPublicKeyLogins->setSshPublicKey($this);
            }
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin[]|\Doctrine\Common\Collections\Collection $sshPublicKeyLogins
     */
    public function addSshPublicKeyLogins($sshPublicKeyLogins) : \WirklichDigital\SyshelperBase\Entity\SshPublicKey
    {
        foreach ($sshPublicKeyLogins as $_sshPublicKeyLogins) {
            $_sshPublicKeyLogins->setSshPublicKey($this);
            $this->sshPublicKeyLogins->add($_sshPublicKeyLogins);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin[]|\Doctrine\Common\Collections\Collection $sshPublicKeyLogins
     */
    public function removeSshPublicKeyLogins($sshPublicKeyLogins) : \WirklichDigital\SyshelperBase\Entity\SshPublicKey
    {
        foreach ($sshPublicKeyLogins as $_sshPublicKeyLogins) {
            $_sshPublicKeyLogins->setSshPublicKey(null);
            $this->sshPublicKeyLogins->removeElement($_sshPublicKeyLogins);
        }
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->hostMappings = new ArrayCollection();
        $this->sshPublicKeyLogins = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->hostMappings = clone $this->hostMappings;
        $this->sshPublicKeyLogins = clone $this->sshPublicKeyLogins;
    }
}


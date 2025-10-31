<?php

namespace WirklichDigital\SyshelperBase\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping;
use WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin;

class SshPublicKey extends AbstractEntity
{
    protected $id;

    /** @var null|string */
    protected $title;

    /** @var null|string */
    protected $keyType;

    /** @var null|string */
    protected $keyData;

    /** @var null|bool */
    protected $doNotTrackLogins = 0;

    /** @var null|string */
    protected $fingerprint;

    /** @var null|string */
    protected $usergroup;

    /** @var null|DateTime */
    protected $createdAt;

    /** @var null|DateTime */
    protected $updatedAt;

    /** @var SshPublicKeyHostMapping[]|Collection */
    protected $hostMappings;

    /** @var SshPublicKeyLogin[]|Collection */
    protected $sshPublicKeyLogins;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): SshPublicKey
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     */
    public function setTitle($title): SshPublicKey
    {
        $this->title = $title;
        return $this;
    }

    public function getKeyType(): ?string
    {
        return $this->keyType;
    }

    /**
     * @param null|string $keyType
     */
    public function setKeyType($keyType): SshPublicKey
    {
        $this->keyType = $keyType;
        return $this;
    }

    public function getKeyData(): ?string
    {
        return $this->keyData;
    }

    /**
     * @param null|string $keyData
     */
    public function setKeyData($keyData): SshPublicKey
    {
        $this->keyData = $keyData;
        return $this;
    }

    public function getDoNotTrackLogins(): ?bool
    {
        return $this->doNotTrackLogins;
    }

    /**
     * @param null|bool $doNotTrackLogins
     */
    public function setDoNotTrackLogins($doNotTrackLogins): SshPublicKey
    {
        $this->doNotTrackLogins = $doNotTrackLogins;
        return $this;
    }

    public function getFingerprint(): ?string
    {
        return $this->fingerprint;
    }

    /**
     * @param null|string $fingerprint
     */
    public function setFingerprint($fingerprint): SshPublicKey
    {
        $this->fingerprint = $fingerprint;
        return $this;
    }

    public function getUsergroup(): ?string
    {
        return $this->usergroup;
    }

    /**
     * @param null|string $usergroup
     */
    public function setUsergroup($usergroup): SshPublicKey
    {
        $this->usergroup = $usergroup;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): SshPublicKey
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): SshPublicKey
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return SshPublicKeyHostMapping[]|Collection
     */
    public function getHostMappings(): Collection
    {
        return $this->hostMappings;
    }

    /**
     * @param SshPublicKeyHostMapping[]|Collection $hostMappings
     */
    public function setHostMappings(Collection $hostMappings): SshPublicKey
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
     * @param SshPublicKeyHostMapping[]|Collection $hostMappings
     */
    public function addHostMappings($hostMappings): SshPublicKey
    {
        foreach ($hostMappings as $_hostMappings) {
            $_hostMappings->setSshPublicKey($this);
            $this->hostMappings->add($_hostMappings);
        }
        return $this;
    }

    /**
     * @param SshPublicKeyHostMapping[]|Collection $hostMappings
     */
    public function removeHostMappings($hostMappings): SshPublicKey
    {
        foreach ($hostMappings as $_hostMappings) {
            $_hostMappings->setSshPublicKey(null);
            $this->hostMappings->removeElement($_hostMappings);
        }
        return $this;
    }

    /**
     * @return SshPublicKeyLogin[]|Collection
     */
    public function getSshPublicKeyLogins(): Collection
    {
        return $this->sshPublicKeyLogins;
    }

    /**
     * @param SshPublicKeyLogin[]|Collection $sshPublicKeyLogins
     */
    public function setSshPublicKeyLogins(Collection $sshPublicKeyLogins): SshPublicKey
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
     * @param SshPublicKeyLogin[]|Collection $sshPublicKeyLogins
     */
    public function addSshPublicKeyLogins($sshPublicKeyLogins): SshPublicKey
    {
        foreach ($sshPublicKeyLogins as $_sshPublicKeyLogins) {
            $_sshPublicKeyLogins->setSshPublicKey($this);
            $this->sshPublicKeyLogins->add($_sshPublicKeyLogins);
        }
        return $this;
    }

    /**
     * @param SshPublicKeyLogin[]|Collection $sshPublicKeyLogins
     */
    public function removeSshPublicKeyLogins($sshPublicKeyLogins): SshPublicKey
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
        $this->hostMappings       = new ArrayCollection();
        $this->sshPublicKeyLogins = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->hostMappings       = clone $this->hostMappings;
        $this->sshPublicKeyLogins = clone $this->sshPublicKeyLogins;
    }
}

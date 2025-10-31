<?php

namespace WirklichDigital\Authentication\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\Authorization\Role\HierarchicalRoleInterface;
use WirklichDigital\Authorization\Entity\UserAsHierarchicalRoleTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class User extends AbstractEntity implements HierarchicalRoleInterface
{
    use UserAsHierarchicalRoleTrait;

    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $type = null;

    /**
     * @var null|bool
     */
    protected $isHidden = 0;

    /**
     * @var null|bool
     */
    protected $canLogin = true;

    protected $roles = null;

    /**
     * @var null|\DateTime
     */
    protected $createdAt = null;

    /**
     * @var null|\DateTime
     */
    protected $updatedAt = null;

    /**
     * @var null|\WirklichDigital\Authentication\Entity\SystemUser
     */
    protected $systemUser = null;

    /**
     * @var null|\WirklichDigital\DefaultUser\Entity\DefaultUser
     */
    protected $defaultUser = null;

    /**
     * @var \WirklichDigital\AuthenticationMail\Entity\AuthenticationMail[]|\Doctrine\Common\Collections\Collection
     */
    protected $authenticationMails = null;

    /**
     * @var null|\WirklichDigital\Authentication\Entity\User
     */
    protected $createdBy = null;

    /**
     * @var null|\WirklichDigital\Authentication\Entity\User
     */
    protected $updatedBy = null;

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
    public function setId($id) : \WirklichDigital\Authentication\Entity\User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getType() : ?string
    {
        return $this->type;
    }

    /**
     * @param null|string $type
     */
    public function setType($type) : \WirklichDigital\Authentication\Entity\User
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getIsHidden() : ?bool
    {
        return $this->isHidden;
    }

    /**
     * @param null|bool $isHidden
     */
    public function setIsHidden($isHidden) : \WirklichDigital\Authentication\Entity\User
    {
        $this->isHidden = $isHidden;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getCanLogin() : ?bool
    {
        return $this->canLogin;
    }

    /**
     * @param null|bool $canLogin
     */
    public function setCanLogin($canLogin) : \WirklichDigital\Authentication\Entity\User
    {
        $this->canLogin = $canLogin;
        return $this;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles($roles) : \WirklichDigital\Authentication\Entity\User
    {
        $this->roles = $roles;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\Authentication\Entity\User
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\Authentication\Entity\User
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return null|\WirklichDigital\Authentication\Entity\SystemUser
     */
    public function getSystemUser() : ?\WirklichDigital\Authentication\Entity\SystemUser
    {
        return $this->systemUser;
    }

    /**
     * @param null|\WirklichDigital\Authentication\Entity\SystemUser $systemUser
     */
    public function setSystemUser(?\WirklichDigital\Authentication\Entity\SystemUser $systemUser) : \WirklichDigital\Authentication\Entity\User
    {
        $this->systemUser = $systemUser;
        if ($this->systemUser) {
            $this->systemUser->setUser($this);
        }
        return $this;
    }

    /**
     * @return null|\WirklichDigital\DefaultUser\Entity\DefaultUser
     */
    public function getDefaultUser() : ?\WirklichDigital\DefaultUser\Entity\DefaultUser
    {
        return $this->defaultUser;
    }

    /**
     * @param null|\WirklichDigital\DefaultUser\Entity\DefaultUser $defaultUser
     */
    public function setDefaultUser(?\WirklichDigital\DefaultUser\Entity\DefaultUser $defaultUser) : \WirklichDigital\Authentication\Entity\User
    {
        $this->defaultUser = $defaultUser;
        if ($this->defaultUser) {
            $this->defaultUser->setUser($this);
        }
        return $this;
    }

    /**
     * @return \WirklichDigital\AuthenticationMail\Entity\AuthenticationMail[]|\Doctrine\Common\Collections\Collection
     */
    public function getAuthenticationMails() : \Doctrine\Common\Collections\Collection
    {
        return $this->authenticationMails;
    }

    /**
     * @param \WirklichDigital\AuthenticationMail\Entity\AuthenticationMail[]|\Doctrine\Common\Collections\Collection $authenticationMails
     */
    public function setAuthenticationMails(\Doctrine\Common\Collections\Collection $authenticationMails) : \WirklichDigital\Authentication\Entity\User
    {
        $this->authenticationMails = $authenticationMails;
        if ($this->authenticationMails) {
            foreach ($this->authenticationMails as $_authenticationMails) {
                $_authenticationMails->setUser($this);
            }
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\AuthenticationMail\Entity\AuthenticationMail[]|\Doctrine\Common\Collections\Collection $authenticationMails
     */
    public function addAuthenticationMails($authenticationMails) : \WirklichDigital\Authentication\Entity\User
    {
        foreach ($authenticationMails as $_authenticationMails) {
            $_authenticationMails->setUser($this);
            $this->authenticationMails->add($_authenticationMails);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\AuthenticationMail\Entity\AuthenticationMail[]|\Doctrine\Common\Collections\Collection $authenticationMails
     */
    public function removeAuthenticationMails($authenticationMails) : \WirklichDigital\Authentication\Entity\User
    {
        foreach ($authenticationMails as $_authenticationMails) {
            $_authenticationMails->setUser(null);
            $this->authenticationMails->removeElement($_authenticationMails);
        }
        return $this;
    }

    /**
     * @return null|\WirklichDigital\Authentication\Entity\User
     */
    public function getCreatedBy() : ?\WirklichDigital\Authentication\Entity\User
    {
        return $this->createdBy;
    }

    /**
     * @param null|\WirklichDigital\Authentication\Entity\User $createdBy
     */
    public function setCreatedBy(?\WirklichDigital\Authentication\Entity\User $createdBy) : \WirklichDigital\Authentication\Entity\User
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * @return null|\WirklichDigital\Authentication\Entity\User
     */
    public function getUpdatedBy() : ?\WirklichDigital\Authentication\Entity\User
    {
        return $this->updatedBy;
    }

    /**
     * @param null|\WirklichDigital\Authentication\Entity\User $updatedBy
     */
    public function setUpdatedBy(?\WirklichDigital\Authentication\Entity\User $updatedBy) : \WirklichDigital\Authentication\Entity\User
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->authenticationMails = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->authenticationMails = clone $this->authenticationMails;
    }
}


<?php

namespace WirklichDigital\Authentication\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use WirklichDigital\Authentication\Entity\SystemUser;
use WirklichDigital\AuthenticationMail\Entity\AuthenticationMail;
use WirklichDigital\Authorization\Entity\UserAsHierarchicalRoleTrait;
use WirklichDigital\Authorization\Role\HierarchicalRoleInterface;
use WirklichDigital\DefaultUser\Entity\DefaultUser;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class User extends AbstractEntity implements HierarchicalRoleInterface
{
    use UserAsHierarchicalRoleTrait;

    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $type;

    /** @var null|bool */
    protected $isHidden = 0;

    /** @var null|bool */
    protected $canLogin = true;

    protected $roles;

    /** @var null|DateTime */
    protected $createdAt;

    /** @var null|DateTime */
    protected $updatedAt;

    /** @var null|SystemUser */
    protected $systemUser;

    /** @var null|DefaultUser */
    protected $defaultUser;

    /** @var AuthenticationMail[]|Collection */
    protected $authenticationMails;

    /** @var null|User */
    protected $createdBy;

    /** @var null|User */
    protected $updatedBy;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): User
    {
        $this->id = $id;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param null|string $type
     */
    public function setType($type): User
    {
        $this->type = $type;
        return $this;
    }

    public function getIsHidden(): ?bool
    {
        return $this->isHidden;
    }

    /**
     * @param null|bool $isHidden
     */
    public function setIsHidden($isHidden): User
    {
        $this->isHidden = $isHidden;
        return $this;
    }

    public function getCanLogin(): ?bool
    {
        return $this->canLogin;
    }

    /**
     * @param null|bool $canLogin
     */
    public function setCanLogin($canLogin): User
    {
        $this->canLogin = $canLogin;
        return $this;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles($roles): User
    {
        $this->roles = $roles;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): User
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): User
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getSystemUser(): ?SystemUser
    {
        return $this->systemUser;
    }

    public function setSystemUser(?SystemUser $systemUser): User
    {
        $this->systemUser = $systemUser;
        if ($this->systemUser) {
            $this->systemUser->setUser($this);
        }
        return $this;
    }

    public function getDefaultUser(): ?DefaultUser
    {
        return $this->defaultUser;
    }

    public function setDefaultUser(?DefaultUser $defaultUser): User
    {
        $this->defaultUser = $defaultUser;
        if ($this->defaultUser) {
            $this->defaultUser->setUser($this);
        }
        return $this;
    }

    /**
     * @return AuthenticationMail[]|Collection
     */
    public function getAuthenticationMails(): Collection
    {
        return $this->authenticationMails;
    }

    /**
     * @param AuthenticationMail[]|Collection $authenticationMails
     */
    public function setAuthenticationMails(Collection $authenticationMails): User
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
     * @param AuthenticationMail[]|Collection $authenticationMails
     */
    public function addAuthenticationMails($authenticationMails): User
    {
        foreach ($authenticationMails as $_authenticationMails) {
            $_authenticationMails->setUser($this);
            $this->authenticationMails->add($_authenticationMails);
        }
        return $this;
    }

    /**
     * @param AuthenticationMail[]|Collection $authenticationMails
     */
    public function removeAuthenticationMails($authenticationMails): User
    {
        foreach ($authenticationMails as $_authenticationMails) {
            $_authenticationMails->setUser(null);
            $this->authenticationMails->removeElement($_authenticationMails);
        }
        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): User
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): User
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

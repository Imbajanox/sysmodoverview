<?php

namespace WirklichDigital\AuthenticationMail\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use WirklichDigital\Authentication\Entity\User;
use WirklichDigital\AuthenticationMailForgotPassword\Entity\AuthMailReset;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

use function password_hash;

use const PASSWORD_DEFAULT;

class AuthenticationMail extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $email;

    /** @var null|string */
    protected $password;

    /** @var null|DateTime */
    protected $passwordExpires;

    /** @var null|bool */
    protected $isActive;

    /** @var AuthMailReset[]|Collection */
    protected $authMailResets;

    /** @var null|User */
    protected $user;

    protected $passwordPlaintext;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): AuthenticationMail
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param null|string $email
     */
    public function setEmail($email): AuthenticationMail
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param null|string $password
     */
    public function setPassword($password): AuthenticationMail
    {
        $this->password = $password;
        return $this;
    }

    public function getPasswordExpires(): ?DateTime
    {
        return $this->passwordExpires;
    }

    public function setPasswordExpires(?DateTime $passwordExpires): AuthenticationMail
    {
        $this->passwordExpires = $passwordExpires;
        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    /**
     * @param null|bool $isActive
     */
    public function setIsActive($isActive): AuthenticationMail
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return AuthMailReset[]|Collection
     */
    public function getAuthMailResets(): Collection
    {
        return $this->authMailResets;
    }

    /**
     * @param AuthMailReset[]|Collection $authMailResets
     */
    public function setAuthMailResets(Collection $authMailResets): AuthenticationMail
    {
        $this->authMailResets = $authMailResets;
        if ($this->authMailResets) {
            foreach ($this->authMailResets as $_authMailResets) {
                $_authMailResets->setAuthMail($this);
            }
        }
        return $this;
    }

    /**
     * @param AuthMailReset[]|Collection $authMailResets
     */
    public function addAuthMailResets($authMailResets): AuthenticationMail
    {
        foreach ($authMailResets as $_authMailResets) {
            $_authMailResets->setAuthMail($this);
            $this->authMailResets->add($_authMailResets);
        }
        return $this;
    }

    /**
     * @param AuthMailReset[]|Collection $authMailResets
     */
    public function removeAuthMailResets($authMailResets): AuthenticationMail
    {
        foreach ($authMailResets as $_authMailResets) {
            $_authMailResets->setAuthMail(null);
            $this->authMailResets->removeElement($_authMailResets);
        }
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): AuthenticationMail
    {
        $this->user = $user;
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->authMailResets = new ArrayCollection();
    }

    public function __clone()
    {
        parent::__clone();
        $this->authMailResets = clone $this->authMailResets;
    }

    public function setPasswordPlaintext($passwordPlaintext)
    {
        if (! empty($passwordPlaintext)) {
            $this->password = password_hash($passwordPlaintext, PASSWORD_DEFAULT);
        }
        return $this;
    }
}

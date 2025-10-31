<?php

namespace WirklichDigital\AuthenticationMail\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class AuthenticationMail extends AbstractEntity
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $email = null;

    /**
     * @var null|string
     */
    protected $password = null;

    /**
     * @var null|\DateTime
     */
    protected $passwordExpires = null;

    /**
     * @var null|bool
     */
    protected $isActive = null;

    /**
     * @var \WirklichDigital\AuthenticationMailForgotPassword\Entity\AuthMailReset[]|\Doctrine\Common\Collections\Collection
     */
    protected $authMailResets = null;

    /**
     * @var null|\WirklichDigital\Authentication\Entity\User
     */
    protected $user = null;

    protected $passwordPlaintext = null;

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
    public function setId($id) : \WirklichDigital\AuthenticationMail\Entity\AuthenticationMail
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getEmail() : ?string
    {
        return $this->email;
    }

    /**
     * @param null|string $email
     */
    public function setEmail($email) : \WirklichDigital\AuthenticationMail\Entity\AuthenticationMail
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPassword() : ?string
    {
        return $this->password;
    }

    /**
     * @param null|string $password
     */
    public function setPassword($password) : \WirklichDigital\AuthenticationMail\Entity\AuthenticationMail
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getPasswordExpires() : ?\DateTime
    {
        return $this->passwordExpires;
    }

    /**
     * @param null|\DateTime $passwordExpires
     */
    public function setPasswordExpires(?\DateTime $passwordExpires) : \WirklichDigital\AuthenticationMail\Entity\AuthenticationMail
    {
        $this->passwordExpires = $passwordExpires;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getIsActive() : ?bool
    {
        return $this->isActive;
    }

    /**
     * @param null|bool $isActive
     */
    public function setIsActive($isActive) : \WirklichDigital\AuthenticationMail\Entity\AuthenticationMail
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return \WirklichDigital\AuthenticationMailForgotPassword\Entity\AuthMailReset[]|\Doctrine\Common\Collections\Collection
     */
    public function getAuthMailResets() : \Doctrine\Common\Collections\Collection
    {
        return $this->authMailResets;
    }

    /**
     * @param \WirklichDigital\AuthenticationMailForgotPassword\Entity\AuthMailReset[]|\Doctrine\Common\Collections\Collection $authMailResets
     */
    public function setAuthMailResets(\Doctrine\Common\Collections\Collection $authMailResets) : \WirklichDigital\AuthenticationMail\Entity\AuthenticationMail
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
     * @param \WirklichDigital\AuthenticationMailForgotPassword\Entity\AuthMailReset[]|\Doctrine\Common\Collections\Collection $authMailResets
     */
    public function addAuthMailResets($authMailResets) : \WirklichDigital\AuthenticationMail\Entity\AuthenticationMail
    {
        foreach ($authMailResets as $_authMailResets) {
            $_authMailResets->setAuthMail($this);
            $this->authMailResets->add($_authMailResets);
        }
        return $this;
    }

    /**
     * @param \WirklichDigital\AuthenticationMailForgotPassword\Entity\AuthMailReset[]|\Doctrine\Common\Collections\Collection $authMailResets
     */
    public function removeAuthMailResets($authMailResets) : \WirklichDigital\AuthenticationMail\Entity\AuthenticationMail
    {
        foreach ($authMailResets as $_authMailResets) {
            $_authMailResets->setAuthMail(null);
            $this->authMailResets->removeElement($_authMailResets);
        }
        return $this;
    }

    /**
     * @return null|\WirklichDigital\Authentication\Entity\User
     */
    public function getUser() : ?\WirklichDigital\Authentication\Entity\User
    {
        return $this->user;
    }

    /**
     * @param null|\WirklichDigital\Authentication\Entity\User $user
     */
    public function setUser(?\WirklichDigital\Authentication\Entity\User $user) : \WirklichDigital\AuthenticationMail\Entity\AuthenticationMail
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
        if(!empty($passwordPlaintext)){
            $this->password = password_hash($passwordPlaintext, PASSWORD_DEFAULT);
        }
        return $this;
    }
}


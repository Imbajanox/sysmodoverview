<?php

namespace WirklichDigital\AuthenticationMailForgotPassword\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class AuthMailReset extends AbstractEntity
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|\DateTime
     */
    protected $validUntil = null;

    /**
     * @var null|string
     */
    protected $resetCode = null;

    /**
     * @var null|\WirklichDigital\AuthenticationMail\Entity\AuthenticationMail
     */
    protected $authMail = null;

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
    public function setId($id) : \WirklichDigital\AuthenticationMailForgotPassword\Entity\AuthMailReset
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getValidUntil() : ?\DateTime
    {
        return $this->validUntil;
    }

    /**
     * @param null|\DateTime $validUntil
     */
    public function setValidUntil(?\DateTime $validUntil) : \WirklichDigital\AuthenticationMailForgotPassword\Entity\AuthMailReset
    {
        $this->validUntil = $validUntil;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getResetCode() : ?string
    {
        return $this->resetCode;
    }

    /**
     * @param null|string $resetCode
     */
    public function setResetCode($resetCode) : \WirklichDigital\AuthenticationMailForgotPassword\Entity\AuthMailReset
    {
        $this->resetCode = $resetCode;
        return $this;
    }

    /**
     * @return null|\WirklichDigital\AuthenticationMail\Entity\AuthenticationMail
     */
    public function getAuthMail() : ?\WirklichDigital\AuthenticationMail\Entity\AuthenticationMail
    {
        return $this->authMail;
    }

    /**
     * @param null|\WirklichDigital\AuthenticationMail\Entity\AuthenticationMail $authMail
     */
    public function setAuthMail(?\WirklichDigital\AuthenticationMail\Entity\AuthenticationMail $authMail) : \WirklichDigital\AuthenticationMailForgotPassword\Entity\AuthMailReset
    {
        $this->authMail = $authMail;
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


<?php

namespace WirklichDigital\AuthenticationMailForgotPassword\Entity;

use DateTime;
use WirklichDigital\AuthenticationMail\Entity\AuthenticationMail;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class AuthMailReset extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|DateTime */
    protected $validUntil;

    /** @var null|string */
    protected $resetCode;

    /** @var null|AuthenticationMail */
    protected $authMail;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): AuthMailReset
    {
        $this->id = $id;
        return $this;
    }

    public function getValidUntil(): ?DateTime
    {
        return $this->validUntil;
    }

    public function setValidUntil(?DateTime $validUntil): AuthMailReset
    {
        $this->validUntil = $validUntil;
        return $this;
    }

    public function getResetCode(): ?string
    {
        return $this->resetCode;
    }

    /**
     * @param null|string $resetCode
     */
    public function setResetCode($resetCode): AuthMailReset
    {
        $this->resetCode = $resetCode;
        return $this;
    }

    public function getAuthMail(): ?AuthenticationMail
    {
        return $this->authMail;
    }

    public function setAuthMail(?AuthenticationMail $authMail): AuthMailReset
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

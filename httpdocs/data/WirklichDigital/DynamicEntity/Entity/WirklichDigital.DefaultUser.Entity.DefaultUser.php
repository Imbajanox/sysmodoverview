<?php

namespace WirklichDigital\DefaultUser\Entity;

use WirklichDigital\Authentication\Entity\User;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class DefaultUser extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $name;

    /** @var null|User */
    protected $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): DefaultUser
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName($name): DefaultUser
    {
        $this->name = $name;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): DefaultUser
    {
        $this->user = $user;
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

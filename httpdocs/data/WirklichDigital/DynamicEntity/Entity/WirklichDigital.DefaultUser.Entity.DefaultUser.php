<?php

namespace WirklichDigital\DefaultUser\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class DefaultUser extends AbstractEntity
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $name = null;

    /**
     * @var null|\WirklichDigital\Authentication\Entity\User
     */
    protected $user = null;

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
    public function setId($id) : \WirklichDigital\DefaultUser\Entity\DefaultUser
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName($name) : \WirklichDigital\DefaultUser\Entity\DefaultUser
    {
        $this->name = $name;
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
    public function setUser(?\WirklichDigital\Authentication\Entity\User $user) : \WirklichDigital\DefaultUser\Entity\DefaultUser
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


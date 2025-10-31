<?php

namespace WirklichDigital\Authentication\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class SystemUser extends AbstractEntity
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
     * @var null|\DateTime
     */
    protected $createdAt = null;

    /**
     * @var null|\DateTime
     */
    protected $updatedAt = null;

    /**
     * @var null|\WirklichDigital\Authentication\Entity\User
     */
    protected $user = null;

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
    public function setId($id) : \WirklichDigital\Authentication\Entity\SystemUser
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
    public function setName($name) : \WirklichDigital\Authentication\Entity\SystemUser
    {
        $this->name = $name;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\Authentication\Entity\SystemUser
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\Authentication\Entity\SystemUser
    {
        $this->updatedAt = $updatedAt;
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
    public function setUser(?\WirklichDigital\Authentication\Entity\User $user) : \WirklichDigital\Authentication\Entity\SystemUser
    {
        $this->user = $user;
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
    public function setCreatedBy(?\WirklichDigital\Authentication\Entity\User $createdBy) : \WirklichDigital\Authentication\Entity\SystemUser
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
    public function setUpdatedBy(?\WirklichDigital\Authentication\Entity\User $updatedBy) : \WirklichDigital\Authentication\Entity\SystemUser
    {
        $this->updatedBy = $updatedBy;
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


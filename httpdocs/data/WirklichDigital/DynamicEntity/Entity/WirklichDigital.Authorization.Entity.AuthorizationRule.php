<?php

namespace WirklichDigital\Authorization\Entity;

use WirklichDigital\Authorization\Rule\RuleInterface;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class AuthorizationRule extends AbstractEntity implements RuleInterface
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $roleId;

    /** @var null|string */
    protected $resourceId;

    /** @var null|string */
    protected $privilegeId;

    /** @var null|bool */
    protected $isAllow;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): AuthorizationRule
    {
        $this->id = $id;
        return $this;
    }

    public function getRoleId(): ?string
    {
        return $this->roleId;
    }

    /**
     * @param null|string $roleId
     */
    public function setRoleId($roleId): AuthorizationRule
    {
        $this->roleId = $roleId;
        return $this;
    }

    public function getResourceId(): ?string
    {
        return $this->resourceId;
    }

    /**
     * @param null|string $resourceId
     */
    public function setResourceId($resourceId): AuthorizationRule
    {
        $this->resourceId = $resourceId;
        return $this;
    }

    public function getPrivilegeId(): ?string
    {
        return $this->privilegeId;
    }

    /**
     * @param null|string $privilegeId
     */
    public function setPrivilegeId($privilegeId): AuthorizationRule
    {
        $this->privilegeId = $privilegeId;
        return $this;
    }

    public function getIsAllow(): ?bool
    {
        return $this->isAllow;
    }

    /**
     * @param null|bool $isAllow
     */
    public function setIsAllow($isAllow): AuthorizationRule
    {
        $this->isAllow = $isAllow;
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

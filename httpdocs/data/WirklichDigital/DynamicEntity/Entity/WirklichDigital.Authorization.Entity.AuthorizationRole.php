<?php

namespace WirklichDigital\Authorization\Entity;

use WirklichDigital\Authorization\Entity\AuthorizationRoleAsHierarchicalResourceTrait;
use WirklichDigital\Authorization\Resource\HierarchicalResourceInterface;
use WirklichDigital\Authorization\Role\HierarchicalRoleInterface;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class AuthorizationRole extends AbstractEntity implements HierarchicalRoleInterface, HierarchicalResourceInterface
{
    use AuthorizationRoleAsHierarchicalResourceTrait;

    /** @var null|string */
    protected $roleId;

    protected $parents;

    /** @var null|int */
    protected $priority;

    public function getRoleId(): ?string
    {
        return $this->roleId;
    }

    /**
     * @param null|string $roleId
     */
    public function setRoleId($roleId): AuthorizationRole
    {
        $this->roleId = $roleId;
        return $this;
    }

    public function getParents()
    {
        return $this->parents;
    }

    public function setParents($parents): AuthorizationRole
    {
        $this->parents = $parents;
        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @param null|int $priority
     */
    public function setPriority($priority): AuthorizationRole
    {
        $this->priority = $priority;
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

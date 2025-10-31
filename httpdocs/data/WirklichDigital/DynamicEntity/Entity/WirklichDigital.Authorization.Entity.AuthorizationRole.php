<?php

namespace WirklichDigital\Authorization\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\Authorization\Role\HierarchicalRoleInterface;
use WirklichDigital\Authorization\Resource\HierarchicalResourceInterface;
use WirklichDigital\Authorization\Entity\AuthorizationRoleAsHierarchicalResourceTrait;

class AuthorizationRole extends AbstractEntity implements HierarchicalRoleInterface, HierarchicalResourceInterface
{
    use AuthorizationRoleAsHierarchicalResourceTrait;

    /**
     * @var null|string
     */
    protected $roleId = null;

    protected $parents = null;

    /**
     * @var null|int
     */
    protected $priority = null;

    /**
     * @return null|string
     */
    public function getRoleId() : ?string
    {
        return $this->roleId;
    }

    /**
     * @param null|string $roleId
     */
    public function setRoleId($roleId) : \WirklichDigital\Authorization\Entity\AuthorizationRole
    {
        $this->roleId = $roleId;
        return $this;
    }

    public function getParents()
    {
        return $this->parents;
    }

    public function setParents($parents) : \WirklichDigital\Authorization\Entity\AuthorizationRole
    {
        $this->parents = $parents;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getPriority() : ?int
    {
        return $this->priority;
    }

    /**
     * @param null|int $priority
     */
    public function setPriority($priority) : \WirklichDigital\Authorization\Entity\AuthorizationRole
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


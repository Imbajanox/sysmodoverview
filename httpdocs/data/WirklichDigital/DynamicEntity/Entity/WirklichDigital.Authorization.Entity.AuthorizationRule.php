<?php

namespace WirklichDigital\Authorization\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\Authorization\Rule\RuleInterface;

class AuthorizationRule extends AbstractEntity implements RuleInterface
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $roleId = null;

    /**
     * @var null|string
     */
    protected $resourceId = null;

    /**
     * @var null|string
     */
    protected $privilegeId = null;

    /**
     * @var null|bool
     */
    protected $isAllow = null;

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
    public function setId($id) : \WirklichDigital\Authorization\Entity\AuthorizationRule
    {
        $this->id = $id;
        return $this;
    }

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
    public function setRoleId($roleId) : \WirklichDigital\Authorization\Entity\AuthorizationRule
    {
        $this->roleId = $roleId;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getResourceId() : ?string
    {
        return $this->resourceId;
    }

    /**
     * @param null|string $resourceId
     */
    public function setResourceId($resourceId) : \WirklichDigital\Authorization\Entity\AuthorizationRule
    {
        $this->resourceId = $resourceId;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPrivilegeId() : ?string
    {
        return $this->privilegeId;
    }

    /**
     * @param null|string $privilegeId
     */
    public function setPrivilegeId($privilegeId) : \WirklichDigital\Authorization\Entity\AuthorizationRule
    {
        $this->privilegeId = $privilegeId;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getIsAllow() : ?bool
    {
        return $this->isAllow;
    }

    /**
     * @param null|bool $isAllow
     */
    public function setIsAllow($isAllow) : \WirklichDigital\Authorization\Entity\AuthorizationRule
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


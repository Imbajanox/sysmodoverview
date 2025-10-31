<?php

namespace WirklichDigital\Search\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class SearchIndexSchedule extends AbstractEntity
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $objectClass = null;

    /**
     * @var null|string
     */
    protected $objectId = null;

    /**
     * @var null|string
     */
    protected $updateType = null;

    /**
     * @var null|\DateTime
     */
    protected $createdAt = null;

    /**
     * @var null|\DateTime
     */
    protected $updatedAt = null;

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
    public function setId($id) : \WirklichDigital\Search\Entity\SearchIndexSchedule
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getObjectClass() : ?string
    {
        return $this->objectClass;
    }

    /**
     * @param null|string $objectClass
     */
    public function setObjectClass($objectClass) : \WirklichDigital\Search\Entity\SearchIndexSchedule
    {
        $this->objectClass = $objectClass;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getObjectId() : ?string
    {
        return $this->objectId;
    }

    /**
     * @param null|string $objectId
     */
    public function setObjectId($objectId) : \WirklichDigital\Search\Entity\SearchIndexSchedule
    {
        $this->objectId = $objectId;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getUpdateType() : ?string
    {
        return $this->updateType;
    }

    /**
     * @param null|string $updateType
     */
    public function setUpdateType($updateType) : \WirklichDigital\Search\Entity\SearchIndexSchedule
    {
        $this->updateType = $updateType;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\Search\Entity\SearchIndexSchedule
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\Search\Entity\SearchIndexSchedule
    {
        $this->updatedAt = $updatedAt;
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


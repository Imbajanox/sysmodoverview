<?php

namespace WirklichDigital\Search\Entity;

use DateTime;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class SearchIndexSchedule extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $objectClass;

    /** @var null|string */
    protected $objectId;

    /** @var null|string */
    protected $updateType;

    /** @var null|DateTime */
    protected $createdAt;

    /** @var null|DateTime */
    protected $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): SearchIndexSchedule
    {
        $this->id = $id;
        return $this;
    }

    public function getObjectClass(): ?string
    {
        return $this->objectClass;
    }

    /**
     * @param null|string $objectClass
     */
    public function setObjectClass($objectClass): SearchIndexSchedule
    {
        $this->objectClass = $objectClass;
        return $this;
    }

    public function getObjectId(): ?string
    {
        return $this->objectId;
    }

    /**
     * @param null|string $objectId
     */
    public function setObjectId($objectId): SearchIndexSchedule
    {
        $this->objectId = $objectId;
        return $this;
    }

    public function getUpdateType(): ?string
    {
        return $this->updateType;
    }

    /**
     * @param null|string $updateType
     */
    public function setUpdateType($updateType): SearchIndexSchedule
    {
        $this->updateType = $updateType;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): SearchIndexSchedule
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): SearchIndexSchedule
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

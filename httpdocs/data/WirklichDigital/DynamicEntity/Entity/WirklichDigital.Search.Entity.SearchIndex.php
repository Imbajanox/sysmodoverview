<?php

namespace WirklichDigital\Search\Entity;

use DateTime;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class SearchIndex extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $category;

    /** @var null|string */
    protected $objectClass;

    /** @var null|string */
    protected $objectId;

    /** @var null|string */
    protected $locale;

    /** @var null|string */
    protected $text;

    protected $additionalData;

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
    public function setId($id): SearchIndex
    {
        $this->id = $id;
        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @param null|string $category
     */
    public function setCategory($category): SearchIndex
    {
        $this->category = $category;
        return $this;
    }

    public function getObjectClass(): ?string
    {
        return $this->objectClass;
    }

    /**
     * @param null|string $objectClass
     */
    public function setObjectClass($objectClass): SearchIndex
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
    public function setObjectId($objectId): SearchIndex
    {
        $this->objectId = $objectId;
        return $this;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @param null|string $locale
     */
    public function setLocale($locale): SearchIndex
    {
        $this->locale = $locale;
        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param null|string $text
     */
    public function setText($text): SearchIndex
    {
        $this->text = $text;
        return $this;
    }

    public function getAdditionalData()
    {
        return $this->additionalData;
    }

    public function setAdditionalData($additionalData): SearchIndex
    {
        $this->additionalData = $additionalData;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): SearchIndex
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): SearchIndex
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

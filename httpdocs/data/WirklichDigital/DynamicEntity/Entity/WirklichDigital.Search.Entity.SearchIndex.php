<?php

namespace WirklichDigital\Search\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class SearchIndex extends AbstractEntity
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $category = null;

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
    protected $locale = null;

    /**
     * @var null|string
     */
    protected $text = null;

    protected $additionalData = null;

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
    public function setId($id) : \WirklichDigital\Search\Entity\SearchIndex
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCategory() : ?string
    {
        return $this->category;
    }

    /**
     * @param null|string $category
     */
    public function setCategory($category) : \WirklichDigital\Search\Entity\SearchIndex
    {
        $this->category = $category;
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
    public function setObjectClass($objectClass) : \WirklichDigital\Search\Entity\SearchIndex
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
    public function setObjectId($objectId) : \WirklichDigital\Search\Entity\SearchIndex
    {
        $this->objectId = $objectId;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLocale() : ?string
    {
        return $this->locale;
    }

    /**
     * @param null|string $locale
     */
    public function setLocale($locale) : \WirklichDigital\Search\Entity\SearchIndex
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getText() : ?string
    {
        return $this->text;
    }

    /**
     * @param null|string $text
     */
    public function setText($text) : \WirklichDigital\Search\Entity\SearchIndex
    {
        $this->text = $text;
        return $this;
    }

    public function getAdditionalData()
    {
        return $this->additionalData;
    }

    public function setAdditionalData($additionalData) : \WirklichDigital\Search\Entity\SearchIndex
    {
        $this->additionalData = $additionalData;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\Search\Entity\SearchIndex
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\Search\Entity\SearchIndex
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


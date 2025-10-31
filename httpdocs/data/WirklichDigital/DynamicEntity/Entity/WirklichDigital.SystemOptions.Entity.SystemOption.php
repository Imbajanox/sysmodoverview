<?php

namespace WirklichDigital\SystemOptions\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\DynamicEntityTranslatableModule\Entity\TranslatableInterface;

class SystemOption extends AbstractEntity implements TranslatableInterface
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $optionKey = null;

    /**
     * @var null|string
     */
    protected $title = null;

    /**
     * @var null|string
     */
    protected $description = null;

    /**
     * @var null|string
     */
    protected $value = null;

    /**
     * @var null|bool
     */
    protected $isEditable = 1;

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
    protected $createdBy = null;

    /**
     * @var null|\WirklichDigital\Authentication\Entity\User
     */
    protected $updatedBy = null;

    protected $translatableLocale = null;

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
    public function setId($id) : \WirklichDigital\SystemOptions\Entity\SystemOption
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getOptionKey() : ?string
    {
        return $this->optionKey;
    }

    /**
     * @param null|string $optionKey
     */
    public function setOptionKey($optionKey) : \WirklichDigital\SystemOptions\Entity\SystemOption
    {
        $this->optionKey = $optionKey;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getTitle() : ?string
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     */
    public function setTitle($title) : \WirklichDigital\SystemOptions\Entity\SystemOption
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription() : ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription($description) : \WirklichDigital\SystemOptions\Entity\SystemOption
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getValue() : ?string
    {
        return $this->value;
    }

    /**
     * @param null|string $value
     */
    public function setValue($value) : \WirklichDigital\SystemOptions\Entity\SystemOption
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getIsEditable() : ?bool
    {
        return $this->isEditable;
    }

    /**
     * @param null|bool $isEditable
     */
    public function setIsEditable($isEditable) : \WirklichDigital\SystemOptions\Entity\SystemOption
    {
        $this->isEditable = $isEditable;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\SystemOptions\Entity\SystemOption
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\SystemOptions\Entity\SystemOption
    {
        $this->updatedAt = $updatedAt;
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
    public function setCreatedBy(?\WirklichDigital\Authentication\Entity\User $createdBy) : \WirklichDigital\SystemOptions\Entity\SystemOption
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
    public function setUpdatedBy(?\WirklichDigital\Authentication\Entity\User $updatedBy) : \WirklichDigital\SystemOptions\Entity\SystemOption
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

    public function getTranslatableLocale()
    {
        return $this->translatableLocale;
    }

    public function setTranslatableLocale($translatableLocale)
    {
        $this->translatableLocale = $translatableLocale; 
        return $this;
    }
}


<?php

namespace WirklichDigital\SystemOptions\Entity;

use DateTime;
use WirklichDigital\Authentication\Entity\User;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\DynamicEntityTranslatableModule\Entity\TranslatableInterface;

class SystemOption extends AbstractEntity implements TranslatableInterface
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $optionKey;

    /** @var null|string */
    protected $title;

    /** @var null|string */
    protected $description;

    /** @var null|string */
    protected $value;

    /** @var null|bool */
    protected $isEditable = 1;

    /** @var null|DateTime */
    protected $createdAt;

    /** @var null|DateTime */
    protected $updatedAt;

    /** @var null|User */
    protected $createdBy;

    /** @var null|User */
    protected $updatedBy;

    protected $translatableLocale;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): SystemOption
    {
        $this->id = $id;
        return $this;
    }

    public function getOptionKey(): ?string
    {
        return $this->optionKey;
    }

    /**
     * @param null|string $optionKey
     */
    public function setOptionKey($optionKey): SystemOption
    {
        $this->optionKey = $optionKey;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     */
    public function setTitle($title): SystemOption
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription($description): SystemOption
    {
        $this->description = $description;
        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param null|string $value
     */
    public function setValue($value): SystemOption
    {
        $this->value = $value;
        return $this;
    }

    public function getIsEditable(): ?bool
    {
        return $this->isEditable;
    }

    /**
     * @param null|bool $isEditable
     */
    public function setIsEditable($isEditable): SystemOption
    {
        $this->isEditable = $isEditable;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): SystemOption
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): SystemOption
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): SystemOption
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): SystemOption
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

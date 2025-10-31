<?php

namespace WirklichDigital\EntityTranslation\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class EntityLocale extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $localeKey;

    /** @var null|string */
    protected $locale;

    /** @var null|string */
    protected $iconClass;

    /** @var null|bool */
    protected $isDefault = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): EntityLocale
    {
        $this->id = $id;
        return $this;
    }

    public function getLocaleKey(): ?string
    {
        return $this->localeKey;
    }

    /**
     * @param null|string $localeKey
     */
    public function setLocaleKey($localeKey): EntityLocale
    {
        $this->localeKey = $localeKey;
        return $this;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @param null|string $locale
     */
    public function setLocale($locale): EntityLocale
    {
        $this->locale = $locale;
        return $this;
    }

    public function getIconClass(): ?string
    {
        return $this->iconClass;
    }

    /**
     * @param null|string $iconClass
     */
    public function setIconClass($iconClass): EntityLocale
    {
        $this->iconClass = $iconClass;
        return $this;
    }

    public function getIsDefault(): ?bool
    {
        return $this->isDefault;
    }

    /**
     * @param null|bool $isDefault
     */
    public function setIsDefault($isDefault): EntityLocale
    {
        $this->isDefault = $isDefault;
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

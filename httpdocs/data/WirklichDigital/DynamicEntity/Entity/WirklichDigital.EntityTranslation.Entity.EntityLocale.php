<?php

namespace WirklichDigital\EntityTranslation\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class EntityLocale extends AbstractEntity
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $localeKey = null;

    /**
     * @var null|string
     */
    protected $locale = null;

    /**
     * @var null|string
     */
    protected $iconClass = null;

    /**
     * @var null|bool
     */
    protected $isDefault = 0;

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
    public function setId($id) : \WirklichDigital\EntityTranslation\Entity\EntityLocale
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLocaleKey() : ?string
    {
        return $this->localeKey;
    }

    /**
     * @param null|string $localeKey
     */
    public function setLocaleKey($localeKey) : \WirklichDigital\EntityTranslation\Entity\EntityLocale
    {
        $this->localeKey = $localeKey;
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
    public function setLocale($locale) : \WirklichDigital\EntityTranslation\Entity\EntityLocale
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getIconClass() : ?string
    {
        return $this->iconClass;
    }

    /**
     * @param null|string $iconClass
     */
    public function setIconClass($iconClass) : \WirklichDigital\EntityTranslation\Entity\EntityLocale
    {
        $this->iconClass = $iconClass;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getIsDefault() : ?bool
    {
        return $this->isDefault;
    }

    /**
     * @param null|bool $isDefault
     */
    public function setIsDefault($isDefault) : \WirklichDigital\EntityTranslation\Entity\EntityLocale
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


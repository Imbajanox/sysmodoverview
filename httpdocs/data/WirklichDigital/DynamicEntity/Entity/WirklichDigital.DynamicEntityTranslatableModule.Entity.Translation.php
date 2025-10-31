<?php

namespace WirklichDigital\DynamicEntityTranslatableModule\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class Translation extends AbstractEntity
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $locale = null;

    /**
     * @var null|string
     */
    protected $objectClass = null;

    /**
     * @var null|string
     */
    protected $field = null;

    /**
     * @var null|string
     */
    protected $foreignKey = null;

    /**
     * @var null|string
     */
    protected $content = null;

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
    public function setId($id) : \WirklichDigital\DynamicEntityTranslatableModule\Entity\Translation
    {
        $this->id = $id;
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
    public function setLocale($locale) : \WirklichDigital\DynamicEntityTranslatableModule\Entity\Translation
    {
        $this->locale = $locale;
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
    public function setObjectClass($objectClass) : \WirklichDigital\DynamicEntityTranslatableModule\Entity\Translation
    {
        $this->objectClass = $objectClass;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getField() : ?string
    {
        return $this->field;
    }

    /**
     * @param null|string $field
     */
    public function setField($field) : \WirklichDigital\DynamicEntityTranslatableModule\Entity\Translation
    {
        $this->field = $field;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getForeignKey() : ?string
    {
        return $this->foreignKey;
    }

    /**
     * @param null|string $foreignKey
     */
    public function setForeignKey($foreignKey) : \WirklichDigital\DynamicEntityTranslatableModule\Entity\Translation
    {
        $this->foreignKey = $foreignKey;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getContent() : ?string
    {
        return $this->content;
    }

    /**
     * @param null|string $content
     */
    public function setContent($content) : \WirklichDigital\DynamicEntityTranslatableModule\Entity\Translation
    {
        $this->content = $content;
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


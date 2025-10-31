<?php

namespace WirklichDigital\DynamicEntityTranslatableModule\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class Translation extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $locale;

    /** @var null|string */
    protected $objectClass;

    /** @var null|string */
    protected $field;

    /** @var null|string */
    protected $foreignKey;

    /** @var null|string */
    protected $content;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): Translation
    {
        $this->id = $id;
        return $this;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @param null|string $locale
     */
    public function setLocale($locale): Translation
    {
        $this->locale = $locale;
        return $this;
    }

    public function getObjectClass(): ?string
    {
        return $this->objectClass;
    }

    /**
     * @param null|string $objectClass
     */
    public function setObjectClass($objectClass): Translation
    {
        $this->objectClass = $objectClass;
        return $this;
    }

    public function getField(): ?string
    {
        return $this->field;
    }

    /**
     * @param null|string $field
     */
    public function setField($field): Translation
    {
        $this->field = $field;
        return $this;
    }

    public function getForeignKey(): ?string
    {
        return $this->foreignKey;
    }

    /**
     * @param null|string $foreignKey
     */
    public function setForeignKey($foreignKey): Translation
    {
        $this->foreignKey = $foreignKey;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param null|string $content
     */
    public function setContent($content): Translation
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

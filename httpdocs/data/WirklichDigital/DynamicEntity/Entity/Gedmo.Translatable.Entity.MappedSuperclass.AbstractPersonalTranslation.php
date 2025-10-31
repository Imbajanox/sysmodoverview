<?php

namespace Gedmo\Translatable\Entity\MappedSuperclass;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class AbstractPersonalTranslation extends AbstractEntity
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
    protected $field = null;

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
    public function setId($id) : \Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation
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
    public function setLocale($locale) : \Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation
    {
        $this->locale = $locale;
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
    public function setField($field) : \Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation
    {
        $this->field = $field;
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
    public function setContent($content) : \Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation
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


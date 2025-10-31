<?php

namespace Gedmo\Translatable\Entity\MappedSuperclass;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class AbstractPersonalTranslation extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $locale;

    /** @var null|string */
    protected $field;

    /** @var null|string */
    protected $content;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): AbstractPersonalTranslation
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
    public function setLocale($locale): AbstractPersonalTranslation
    {
        $this->locale = $locale;
        return $this;
    }

    public function getField(): ?string
    {
        return $this->field;
    }

    /**
     * @param null|string $field
     */
    public function setField($field): AbstractPersonalTranslation
    {
        $this->field = $field;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param null|string $content
     */
    public function setContent($content): AbstractPersonalTranslation
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

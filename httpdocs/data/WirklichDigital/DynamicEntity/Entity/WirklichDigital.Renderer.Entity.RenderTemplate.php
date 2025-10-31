<?php

namespace WirklichDigital\Renderer\Entity;

use DateTime;
use WirklichDigital\Authentication\Entity\User;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\DynamicEntityTranslatableModule\Entity\TranslatableInterface;

class RenderTemplate extends AbstractEntity implements TranslatableInterface
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $name;

    /** @var null|string */
    protected $template = '';

    /** @var null|string */
    protected $renderer;

    protected $lastData;

    /** @var null|string */
    protected $component;

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
    public function setId($id): RenderTemplate
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName($name): RenderTemplate
    {
        $this->name = $name;
        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    /**
     * @param null|string $template
     */
    public function setTemplate($template): RenderTemplate
    {
        $this->template = $template;
        return $this;
    }

    public function getRenderer(): ?string
    {
        return $this->renderer;
    }

    /**
     * @param null|string $renderer
     */
    public function setRenderer($renderer): RenderTemplate
    {
        $this->renderer = $renderer;
        return $this;
    }

    public function getLastData()
    {
        return $this->lastData;
    }

    public function setLastData($lastData): RenderTemplate
    {
        $this->lastData = $lastData;
        return $this;
    }

    public function getComponent(): ?string
    {
        return $this->component;
    }

    /**
     * @param null|string $component
     */
    public function setComponent($component): RenderTemplate
    {
        $this->component = $component;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): RenderTemplate
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): RenderTemplate
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): RenderTemplate
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): RenderTemplate
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

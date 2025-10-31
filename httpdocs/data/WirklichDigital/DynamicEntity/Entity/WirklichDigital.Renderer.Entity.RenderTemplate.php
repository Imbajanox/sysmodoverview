<?php

namespace WirklichDigital\Renderer\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\DynamicEntityTranslatableModule\Entity\TranslatableInterface;

class RenderTemplate extends AbstractEntity implements TranslatableInterface
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $name = null;

    /**
     * @var null|string
     */
    protected $template = '';

    /**
     * @var null|string
     */
    protected $renderer = null;

    protected $lastData = null;

    /**
     * @var null|string
     */
    protected $component = null;

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
    public function setId($id) : \WirklichDigital\Renderer\Entity\RenderTemplate
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName($name) : \WirklichDigital\Renderer\Entity\RenderTemplate
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getTemplate() : ?string
    {
        return $this->template;
    }

    /**
     * @param null|string $template
     */
    public function setTemplate($template) : \WirklichDigital\Renderer\Entity\RenderTemplate
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getRenderer() : ?string
    {
        return $this->renderer;
    }

    /**
     * @param null|string $renderer
     */
    public function setRenderer($renderer) : \WirklichDigital\Renderer\Entity\RenderTemplate
    {
        $this->renderer = $renderer;
        return $this;
    }

    public function getLastData()
    {
        return $this->lastData;
    }

    public function setLastData($lastData) : \WirklichDigital\Renderer\Entity\RenderTemplate
    {
        $this->lastData = $lastData;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getComponent() : ?string
    {
        return $this->component;
    }

    /**
     * @param null|string $component
     */
    public function setComponent($component) : \WirklichDigital\Renderer\Entity\RenderTemplate
    {
        $this->component = $component;
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
    public function setCreatedAt(?\DateTime $createdAt) : \WirklichDigital\Renderer\Entity\RenderTemplate
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
    public function setUpdatedAt(?\DateTime $updatedAt) : \WirklichDigital\Renderer\Entity\RenderTemplate
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
    public function setCreatedBy(?\WirklichDigital\Authentication\Entity\User $createdBy) : \WirklichDigital\Renderer\Entity\RenderTemplate
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
    public function setUpdatedBy(?\WirklichDigital\Authentication\Entity\User $updatedBy) : \WirklichDigital\Renderer\Entity\RenderTemplate
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


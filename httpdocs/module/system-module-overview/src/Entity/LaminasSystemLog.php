<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use DateTime;

/**
 * LaminasSystemLog Entity
 * 
 * Logs all important events in the system-module-overview module.
 * Replaces the previous file-based logging mechanism with a database-backed solution.
 */
class LaminasSystemLog
{
    protected ?int $id = null;
    protected ?string $level = null;
    protected ?string $message = null;
    protected ?string $context = null;
    protected ?array $additionalData = null;
    protected ?DateTime $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(?string $level): void
    {
        $this->level = $level;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }

    public function setContext(?string $context): void
    {
        $this->context = $context;
    }

    public function getAdditionalData(): ?array
    {
        return $this->additionalData;
    }

    public function setAdditionalData(?array $additionalData): void
    {
        $this->additionalData = $additionalData;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}

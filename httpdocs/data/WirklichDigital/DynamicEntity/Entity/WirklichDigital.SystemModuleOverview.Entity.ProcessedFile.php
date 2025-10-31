<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use DateTime;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class ProcessedFile extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $filename;

    /** @var null|string */
    protected $filePath;

    /** @var null|string */
    protected $fileHash;

    /** @var null|DateTime */
    protected $processedAt;

    /** @var null|string */
    protected $status;

    /** @var null|string */
    protected $errorMessage;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): ProcessedFile
    {
        $this->id = $id;
        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param null|string $filename
     */
    public function setFilename($filename): ProcessedFile
    {
        $this->filename = $filename;
        return $this;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    /**
     * @param null|string $filePath
     */
    public function setFilePath($filePath): ProcessedFile
    {
        $this->filePath = $filePath;
        return $this;
    }

    public function getFileHash(): ?string
    {
        return $this->fileHash;
    }

    /**
     * @param null|string $fileHash
     */
    public function setFileHash($fileHash): ProcessedFile
    {
        $this->fileHash = $fileHash;
        return $this;
    }

    public function getProcessedAt(): ?DateTime
    {
        return $this->processedAt;
    }

    public function setProcessedAt(?DateTime $processedAt): ProcessedFile
    {
        $this->processedAt = $processedAt;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param null|string $status
     */
    public function setStatus($status): ProcessedFile
    {
        $this->status = $status;
        return $this;
    }

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    /**
     * @param null|string $errorMessage
     */
    public function setErrorMessage($errorMessage): ProcessedFile
    {
        $this->errorMessage = $errorMessage;
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

<?php

namespace WirklichDigital\CronScheduler\Entity;

use DateTime;
use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class CronScheduledJob extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $name;

    /** @var null|bool */
    protected $isEnabled = 0;

    /** @var null|string */
    protected $cronString = '* * * * *';

    /** @var null|bool */
    protected $isRunning = 0;

    /** @var null|string */
    protected $lastResult = '';

    /** @var null|bool */
    protected $lastExecutionError = 0;

    /** @var null|float */
    protected $lastExecutionDuration = '0.0000';

    /** @var null|DateTime */
    protected $lastInvocationTime;

    /** @var null|int */
    protected $autoRestartAfter = 120;

    /** @var null|int */
    protected $priority = 1;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): CronScheduledJob
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
    public function setName($name): CronScheduledJob
    {
        $this->name = $name;
        return $this;
    }

    public function getIsEnabled(): ?bool
    {
        return $this->isEnabled;
    }

    /**
     * @param null|bool $isEnabled
     */
    public function setIsEnabled($isEnabled): CronScheduledJob
    {
        $this->isEnabled = $isEnabled;
        return $this;
    }

    public function getCronString(): ?string
    {
        return $this->cronString;
    }

    /**
     * @param null|string $cronString
     */
    public function setCronString($cronString): CronScheduledJob
    {
        $this->cronString = $cronString;
        return $this;
    }

    public function getIsRunning(): ?bool
    {
        return $this->isRunning;
    }

    /**
     * @param null|bool $isRunning
     */
    public function setIsRunning($isRunning): CronScheduledJob
    {
        $this->isRunning = $isRunning;
        return $this;
    }

    public function getLastResult(): ?string
    {
        return $this->lastResult;
    }

    /**
     * @param null|string $lastResult
     */
    public function setLastResult($lastResult): CronScheduledJob
    {
        $this->lastResult = $lastResult;
        return $this;
    }

    public function getLastExecutionError(): ?bool
    {
        return $this->lastExecutionError;
    }

    /**
     * @param null|bool $lastExecutionError
     */
    public function setLastExecutionError($lastExecutionError): CronScheduledJob
    {
        $this->lastExecutionError = $lastExecutionError;
        return $this;
    }

    public function getLastExecutionDuration(): ?float
    {
        return $this->lastExecutionDuration;
    }

    /**
     * @param null|float $lastExecutionDuration
     */
    public function setLastExecutionDuration($lastExecutionDuration): CronScheduledJob
    {
        $this->lastExecutionDuration = $lastExecutionDuration;
        return $this;
    }

    public function getLastInvocationTime(): ?DateTime
    {
        return $this->lastInvocationTime;
    }

    public function setLastInvocationTime(?DateTime $lastInvocationTime): CronScheduledJob
    {
        $this->lastInvocationTime = $lastInvocationTime;
        return $this;
    }

    public function getAutoRestartAfter(): ?int
    {
        return $this->autoRestartAfter;
    }

    /**
     * @param null|int $autoRestartAfter
     */
    public function setAutoRestartAfter($autoRestartAfter): CronScheduledJob
    {
        $this->autoRestartAfter = $autoRestartAfter;
        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @param null|int $priority
     */
    public function setPriority($priority): CronScheduledJob
    {
        $this->priority = $priority;
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

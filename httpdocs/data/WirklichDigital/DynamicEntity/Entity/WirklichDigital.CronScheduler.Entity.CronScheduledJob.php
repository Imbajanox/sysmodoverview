<?php

namespace WirklichDigital\CronScheduler\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class CronScheduledJob extends AbstractEntity
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
     * @var null|bool
     */
    protected $isEnabled = 0;

    /**
     * @var null|string
     */
    protected $cronString = '* * * * *';

    /**
     * @var null|bool
     */
    protected $isRunning = 0;

    /**
     * @var null|string
     */
    protected $lastResult = '';

    /**
     * @var null|bool
     */
    protected $lastExecutionError = 0;

    /**
     * @var null|float
     */
    protected $lastExecutionDuration = '0.0000';

    /**
     * @var null|\DateTime
     */
    protected $lastInvocationTime = null;

    /**
     * @var null|int
     */
    protected $autoRestartAfter = 120;

    /**
     * @var null|int
     */
    protected $priority = 1;

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
    public function setId($id) : \WirklichDigital\CronScheduler\Entity\CronScheduledJob
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
    public function setName($name) : \WirklichDigital\CronScheduler\Entity\CronScheduledJob
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getIsEnabled() : ?bool
    {
        return $this->isEnabled;
    }

    /**
     * @param null|bool $isEnabled
     */
    public function setIsEnabled($isEnabled) : \WirklichDigital\CronScheduler\Entity\CronScheduledJob
    {
        $this->isEnabled = $isEnabled;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCronString() : ?string
    {
        return $this->cronString;
    }

    /**
     * @param null|string $cronString
     */
    public function setCronString($cronString) : \WirklichDigital\CronScheduler\Entity\CronScheduledJob
    {
        $this->cronString = $cronString;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getIsRunning() : ?bool
    {
        return $this->isRunning;
    }

    /**
     * @param null|bool $isRunning
     */
    public function setIsRunning($isRunning) : \WirklichDigital\CronScheduler\Entity\CronScheduledJob
    {
        $this->isRunning = $isRunning;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLastResult() : ?string
    {
        return $this->lastResult;
    }

    /**
     * @param null|string $lastResult
     */
    public function setLastResult($lastResult) : \WirklichDigital\CronScheduler\Entity\CronScheduledJob
    {
        $this->lastResult = $lastResult;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getLastExecutionError() : ?bool
    {
        return $this->lastExecutionError;
    }

    /**
     * @param null|bool $lastExecutionError
     */
    public function setLastExecutionError($lastExecutionError) : \WirklichDigital\CronScheduler\Entity\CronScheduledJob
    {
        $this->lastExecutionError = $lastExecutionError;
        return $this;
    }

    /**
     * @return null|float
     */
    public function getLastExecutionDuration() : ?float
    {
        return $this->lastExecutionDuration;
    }

    /**
     * @param null|float $lastExecutionDuration
     */
    public function setLastExecutionDuration($lastExecutionDuration) : \WirklichDigital\CronScheduler\Entity\CronScheduledJob
    {
        $this->lastExecutionDuration = $lastExecutionDuration;
        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getLastInvocationTime() : ?\DateTime
    {
        return $this->lastInvocationTime;
    }

    /**
     * @param null|\DateTime $lastInvocationTime
     */
    public function setLastInvocationTime(?\DateTime $lastInvocationTime) : \WirklichDigital\CronScheduler\Entity\CronScheduledJob
    {
        $this->lastInvocationTime = $lastInvocationTime;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getAutoRestartAfter() : ?int
    {
        return $this->autoRestartAfter;
    }

    /**
     * @param null|int $autoRestartAfter
     */
    public function setAutoRestartAfter($autoRestartAfter) : \WirklichDigital\CronScheduler\Entity\CronScheduledJob
    {
        $this->autoRestartAfter = $autoRestartAfter;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getPriority() : ?int
    {
        return $this->priority;
    }

    /**
     * @param null|int $priority
     */
    public function setPriority($priority) : \WirklichDigital\CronScheduler\Entity\CronScheduledJob
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


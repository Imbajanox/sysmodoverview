<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer;

class LaminasSystemServerDatabaseInfo extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    /** @var null|string */
    protected $dbName;

    /** @var null|string */
    protected $dbEngine;

    /** @var null|string */
    protected $dbVersion;

    /** @var null|string */
    protected $dbRowFormat;

    /** @var null|string */
    protected $dbRows;

    /** @var null|string */
    protected $dbAvgRowLength;

    /** @var null|string */
    protected $dbDataLength;

    /** @var null|string */
    protected $dbMaxDataLength;

    /** @var null|string */
    protected $dbIndexLength;

    /** @var null|string */
    protected $dbDataFree;

    /** @var null|string */
    protected $dbAutoIncrement;

    /** @var null|string */
    protected $dbCreateTime;

    /** @var null|string */
    protected $dbUpdateTime;

    /** @var null|string */
    protected $dbCheckTime;

    /** @var null|string */
    protected $dbCollation;

    /** @var null|string */
    protected $dbChecksum;

    /** @var null|string */
    protected $dbCreateOptions;

    /** @var null|string */
    protected $dbComment;

    /** @var null|string */
    protected $dbMaxIndexLength;

    /** @var null|string */
    protected $dbTemporary;

    /** @var null|LaminasSystemServer */
    protected $laminasSystemServer;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): LaminasSystemServerDatabaseInfo
    {
        $this->id = $id;
        return $this;
    }

    public function getDbName(): ?string
    {
        return $this->dbName;
    }

    /**
     * @param null|string $dbName
     */
    public function setDbName($dbName): LaminasSystemServerDatabaseInfo
    {
        $this->dbName = $dbName;
        return $this;
    }

    public function getDbEngine(): ?string
    {
        return $this->dbEngine;
    }

    /**
     * @param null|string $dbEngine
     */
    public function setDbEngine($dbEngine): LaminasSystemServerDatabaseInfo
    {
        $this->dbEngine = $dbEngine;
        return $this;
    }

    public function getDbVersion(): ?string
    {
        return $this->dbVersion;
    }

    /**
     * @param null|string $dbVersion
     */
    public function setDbVersion($dbVersion): LaminasSystemServerDatabaseInfo
    {
        $this->dbVersion = $dbVersion;
        return $this;
    }

    public function getDbRowFormat(): ?string
    {
        return $this->dbRowFormat;
    }

    /**
     * @param null|string $dbRowFormat
     */
    public function setDbRowFormat($dbRowFormat): LaminasSystemServerDatabaseInfo
    {
        $this->dbRowFormat = $dbRowFormat;
        return $this;
    }

    public function getDbRows(): ?string
    {
        return $this->dbRows;
    }

    /**
     * @param null|string $dbRows
     */
    public function setDbRows($dbRows): LaminasSystemServerDatabaseInfo
    {
        $this->dbRows = $dbRows;
        return $this;
    }

    public function getDbAvgRowLength(): ?string
    {
        return $this->dbAvgRowLength;
    }

    /**
     * @param null|string $dbAvgRowLength
     */
    public function setDbAvgRowLength($dbAvgRowLength): LaminasSystemServerDatabaseInfo
    {
        $this->dbAvgRowLength = $dbAvgRowLength;
        return $this;
    }

    public function getDbDataLength(): ?string
    {
        return $this->dbDataLength;
    }

    /**
     * @param null|string $dbDataLength
     */
    public function setDbDataLength($dbDataLength): LaminasSystemServerDatabaseInfo
    {
        $this->dbDataLength = $dbDataLength;
        return $this;
    }

    public function getDbMaxDataLength(): ?string
    {
        return $this->dbMaxDataLength;
    }

    /**
     * @param null|string $dbMaxDataLength
     */
    public function setDbMaxDataLength($dbMaxDataLength): LaminasSystemServerDatabaseInfo
    {
        $this->dbMaxDataLength = $dbMaxDataLength;
        return $this;
    }

    public function getDbIndexLength(): ?string
    {
        return $this->dbIndexLength;
    }

    /**
     * @param null|string $dbIndexLength
     */
    public function setDbIndexLength($dbIndexLength): LaminasSystemServerDatabaseInfo
    {
        $this->dbIndexLength = $dbIndexLength;
        return $this;
    }

    public function getDbDataFree(): ?string
    {
        return $this->dbDataFree;
    }

    /**
     * @param null|string $dbDataFree
     */
    public function setDbDataFree($dbDataFree): LaminasSystemServerDatabaseInfo
    {
        $this->dbDataFree = $dbDataFree;
        return $this;
    }

    public function getDbAutoIncrement(): ?string
    {
        return $this->dbAutoIncrement;
    }

    /**
     * @param null|string $dbAutoIncrement
     */
    public function setDbAutoIncrement($dbAutoIncrement): LaminasSystemServerDatabaseInfo
    {
        $this->dbAutoIncrement = $dbAutoIncrement;
        return $this;
    }

    public function getDbCreateTime(): ?string
    {
        return $this->dbCreateTime;
    }

    /**
     * @param null|string $dbCreateTime
     */
    public function setDbCreateTime($dbCreateTime): LaminasSystemServerDatabaseInfo
    {
        $this->dbCreateTime = $dbCreateTime;
        return $this;
    }

    public function getDbUpdateTime(): ?string
    {
        return $this->dbUpdateTime;
    }

    /**
     * @param null|string $dbUpdateTime
     */
    public function setDbUpdateTime($dbUpdateTime): LaminasSystemServerDatabaseInfo
    {
        $this->dbUpdateTime = $dbUpdateTime;
        return $this;
    }

    public function getDbCheckTime(): ?string
    {
        return $this->dbCheckTime;
    }

    /**
     * @param null|string $dbCheckTime
     */
    public function setDbCheckTime($dbCheckTime): LaminasSystemServerDatabaseInfo
    {
        $this->dbCheckTime = $dbCheckTime;
        return $this;
    }

    public function getDbCollation(): ?string
    {
        return $this->dbCollation;
    }

    /**
     * @param null|string $dbCollation
     */
    public function setDbCollation($dbCollation): LaminasSystemServerDatabaseInfo
    {
        $this->dbCollation = $dbCollation;
        return $this;
    }

    public function getDbChecksum(): ?string
    {
        return $this->dbChecksum;
    }

    /**
     * @param null|string $dbChecksum
     */
    public function setDbChecksum($dbChecksum): LaminasSystemServerDatabaseInfo
    {
        $this->dbChecksum = $dbChecksum;
        return $this;
    }

    public function getDbCreateOptions(): ?string
    {
        return $this->dbCreateOptions;
    }

    /**
     * @param null|string $dbCreateOptions
     */
    public function setDbCreateOptions($dbCreateOptions): LaminasSystemServerDatabaseInfo
    {
        $this->dbCreateOptions = $dbCreateOptions;
        return $this;
    }

    public function getDbComment(): ?string
    {
        return $this->dbComment;
    }

    /**
     * @param null|string $dbComment
     */
    public function setDbComment($dbComment): LaminasSystemServerDatabaseInfo
    {
        $this->dbComment = $dbComment;
        return $this;
    }

    public function getDbMaxIndexLength(): ?string
    {
        return $this->dbMaxIndexLength;
    }

    /**
     * @param null|string $dbMaxIndexLength
     */
    public function setDbMaxIndexLength($dbMaxIndexLength): LaminasSystemServerDatabaseInfo
    {
        $this->dbMaxIndexLength = $dbMaxIndexLength;
        return $this;
    }

    public function getDbTemporary(): ?string
    {
        return $this->dbTemporary;
    }

    /**
     * @param null|string $dbTemporary
     */
    public function setDbTemporary($dbTemporary): LaminasSystemServerDatabaseInfo
    {
        $this->dbTemporary = $dbTemporary;
        return $this;
    }

    public function getLaminasSystemServer(): ?LaminasSystemServer
    {
        return $this->laminasSystemServer;
    }

    public function setLaminasSystemServer(?LaminasSystemServer $laminasSystemServer): LaminasSystemServerDatabaseInfo
    {
        $this->laminasSystemServer = $laminasSystemServer;
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

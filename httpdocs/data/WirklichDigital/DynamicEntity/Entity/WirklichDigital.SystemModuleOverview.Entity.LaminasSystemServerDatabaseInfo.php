<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class LaminasSystemServerDatabaseInfo extends AbstractEntity
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $dbName = null;

    /**
     * @var null|string
     */
    protected $dbEngine = null;

    /**
     * @var null|string
     */
    protected $dbVersion = null;

    /**
     * @var null|string
     */
    protected $dbRowFormat = null;

    /**
     * @var null|string
     */
    protected $dbRows = null;

    /**
     * @var null|string
     */
    protected $dbAvgRowLength = null;

    /**
     * @var null|string
     */
    protected $dbDataLength = null;

    /**
     * @var null|string
     */
    protected $dbMaxDataLength = null;

    /**
     * @var null|string
     */
    protected $dbIndexLength = null;

    /**
     * @var null|string
     */
    protected $dbDataFree = null;

    /**
     * @var null|string
     */
    protected $dbAutoIncrement = null;

    /**
     * @var null|string
     */
    protected $dbCreateTime = null;

    /**
     * @var null|string
     */
    protected $dbUpdateTime = null;

    /**
     * @var null|string
     */
    protected $dbCheckTime = null;

    /**
     * @var null|string
     */
    protected $dbCollation = null;

    /**
     * @var null|string
     */
    protected $dbChecksum = null;

    /**
     * @var null|string
     */
    protected $dbCreateOptions = null;

    /**
     * @var null|string
     */
    protected $dbComment = null;

    /**
     * @var null|string
     */
    protected $dbMaxIndexLength = null;

    /**
     * @var null|string
     */
    protected $dbTemporary = null;

    /**
     * @var null|\WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
     */
    protected $laminasSystemServer = null;

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
    public function setId($id) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbName() : ?string
    {
        return $this->dbName;
    }

    /**
     * @param null|string $dbName
     */
    public function setDbName($dbName) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbName = $dbName;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbEngine() : ?string
    {
        return $this->dbEngine;
    }

    /**
     * @param null|string $dbEngine
     */
    public function setDbEngine($dbEngine) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbEngine = $dbEngine;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbVersion() : ?string
    {
        return $this->dbVersion;
    }

    /**
     * @param null|string $dbVersion
     */
    public function setDbVersion($dbVersion) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbVersion = $dbVersion;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbRowFormat() : ?string
    {
        return $this->dbRowFormat;
    }

    /**
     * @param null|string $dbRowFormat
     */
    public function setDbRowFormat($dbRowFormat) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbRowFormat = $dbRowFormat;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbRows() : ?string
    {
        return $this->dbRows;
    }

    /**
     * @param null|string $dbRows
     */
    public function setDbRows($dbRows) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbRows = $dbRows;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbAvgRowLength() : ?string
    {
        return $this->dbAvgRowLength;
    }

    /**
     * @param null|string $dbAvgRowLength
     */
    public function setDbAvgRowLength($dbAvgRowLength) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbAvgRowLength = $dbAvgRowLength;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbDataLength() : ?string
    {
        return $this->dbDataLength;
    }

    /**
     * @param null|string $dbDataLength
     */
    public function setDbDataLength($dbDataLength) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbDataLength = $dbDataLength;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbMaxDataLength() : ?string
    {
        return $this->dbMaxDataLength;
    }

    /**
     * @param null|string $dbMaxDataLength
     */
    public function setDbMaxDataLength($dbMaxDataLength) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbMaxDataLength = $dbMaxDataLength;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbIndexLength() : ?string
    {
        return $this->dbIndexLength;
    }

    /**
     * @param null|string $dbIndexLength
     */
    public function setDbIndexLength($dbIndexLength) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbIndexLength = $dbIndexLength;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbDataFree() : ?string
    {
        return $this->dbDataFree;
    }

    /**
     * @param null|string $dbDataFree
     */
    public function setDbDataFree($dbDataFree) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbDataFree = $dbDataFree;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbAutoIncrement() : ?string
    {
        return $this->dbAutoIncrement;
    }

    /**
     * @param null|string $dbAutoIncrement
     */
    public function setDbAutoIncrement($dbAutoIncrement) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbAutoIncrement = $dbAutoIncrement;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbCreateTime() : ?string
    {
        return $this->dbCreateTime;
    }

    /**
     * @param null|string $dbCreateTime
     */
    public function setDbCreateTime($dbCreateTime) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbCreateTime = $dbCreateTime;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbUpdateTime() : ?string
    {
        return $this->dbUpdateTime;
    }

    /**
     * @param null|string $dbUpdateTime
     */
    public function setDbUpdateTime($dbUpdateTime) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbUpdateTime = $dbUpdateTime;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbCheckTime() : ?string
    {
        return $this->dbCheckTime;
    }

    /**
     * @param null|string $dbCheckTime
     */
    public function setDbCheckTime($dbCheckTime) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbCheckTime = $dbCheckTime;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbCollation() : ?string
    {
        return $this->dbCollation;
    }

    /**
     * @param null|string $dbCollation
     */
    public function setDbCollation($dbCollation) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbCollation = $dbCollation;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbChecksum() : ?string
    {
        return $this->dbChecksum;
    }

    /**
     * @param null|string $dbChecksum
     */
    public function setDbChecksum($dbChecksum) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbChecksum = $dbChecksum;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbCreateOptions() : ?string
    {
        return $this->dbCreateOptions;
    }

    /**
     * @param null|string $dbCreateOptions
     */
    public function setDbCreateOptions($dbCreateOptions) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbCreateOptions = $dbCreateOptions;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbComment() : ?string
    {
        return $this->dbComment;
    }

    /**
     * @param null|string $dbComment
     */
    public function setDbComment($dbComment) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbComment = $dbComment;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbMaxIndexLength() : ?string
    {
        return $this->dbMaxIndexLength;
    }

    /**
     * @param null|string $dbMaxIndexLength
     */
    public function setDbMaxIndexLength($dbMaxIndexLength) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbMaxIndexLength = $dbMaxIndexLength;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDbTemporary() : ?string
    {
        return $this->dbTemporary;
    }

    /**
     * @param null|string $dbTemporary
     */
    public function setDbTemporary($dbTemporary) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
    {
        $this->dbTemporary = $dbTemporary;
        return $this;
    }

    /**
     * @return null|\WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
     */
    public function getLaminasSystemServer() : ?\WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer
    {
        return $this->laminasSystemServer;
    }

    /**
     * @param null|\WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer $laminasSystemServer
     */
    public function setLaminasSystemServer(?\WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer $laminasSystemServer) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerDatabaseInfo
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


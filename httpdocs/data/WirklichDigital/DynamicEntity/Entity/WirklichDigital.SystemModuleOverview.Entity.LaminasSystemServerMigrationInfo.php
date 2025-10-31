<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer;

class LaminasSystemServerMigrationInfo extends AbstractEntity
{
    /** @var null|int */
    protected $id;

    protected $databaseDetails;

    protected $versions;

    protected $migrationDetails;

    /** @var null|LaminasSystemServer */
    protected $laminasSystemServer;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId($id): LaminasSystemServerMigrationInfo
    {
        $this->id = $id;
        return $this;
    }

    public function getDatabaseDetails()
    {
        return $this->databaseDetails;
    }

    public function setDatabaseDetails($databaseDetails): LaminasSystemServerMigrationInfo
    {
        $this->databaseDetails = $databaseDetails;
        return $this;
    }

    public function getVersions()
    {
        return $this->versions;
    }

    public function setVersions($versions): LaminasSystemServerMigrationInfo
    {
        $this->versions = $versions;
        return $this;
    }

    public function getMigrationDetails()
    {
        return $this->migrationDetails;
    }

    public function setMigrationDetails($migrationDetails): LaminasSystemServerMigrationInfo
    {
        $this->migrationDetails = $migrationDetails;
        return $this;
    }

    public function getLaminasSystemServer(): ?LaminasSystemServer
    {
        return $this->laminasSystemServer;
    }

    public function setLaminasSystemServer(?LaminasSystemServer $laminasSystemServer): LaminasSystemServerMigrationInfo
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

<?php

namespace WirklichDigital\SystemModuleOverview\Entity;

use WirklichDigital\DynamicEntityModule\Entity\AbstractEntity;

class LaminasSystemServerMigrationInfo extends AbstractEntity
{
    /**
     * @var null|int
     */
    protected $id = null;

    protected $databaseDetails = null;

    protected $versions = null;

    protected $migrationDetails = null;

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
    public function setId($id) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerMigrationInfo
    {
        $this->id = $id;
        return $this;
    }

    public function getDatabaseDetails()
    {
        return $this->databaseDetails;
    }

    public function setDatabaseDetails($databaseDetails) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerMigrationInfo
    {
        $this->databaseDetails = $databaseDetails;
        return $this;
    }

    public function getVersions()
    {
        return $this->versions;
    }

    public function setVersions($versions) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerMigrationInfo
    {
        $this->versions = $versions;
        return $this;
    }

    public function getMigrationDetails()
    {
        return $this->migrationDetails;
    }

    public function setMigrationDetails($migrationDetails) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerMigrationInfo
    {
        $this->migrationDetails = $migrationDetails;
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
    public function setLaminasSystemServer(?\WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer $laminasSystemServer) : \WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerMigrationInfo
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


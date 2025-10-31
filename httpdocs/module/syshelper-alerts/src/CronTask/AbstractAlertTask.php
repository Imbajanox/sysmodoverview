<?php
namespace WirklichDigital\SyshelperAlerts\CronTask;

use WirklichDigital\CronScheduler\CronTask\CronTaskExecutable;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperAlerts\Service\AlertService;

abstract class AbstractAlertTask implements CronTaskExecutable
{
    const ALERT_NAME = "Alert name";
    const ALERT_DESCRIPTION = "Alert Description";

    protected static $verifiedAlertIds = [];

    /** @var EntityManager */
    protected $entityManager;

    /** @var AlertService */
    protected $alertService;

    public function __construct(EntityManager $entityManager, $alertService)
    {
        $this->entityManager = $entityManager;
        $this->alertService = $alertService;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function run()
    {
        $this->detectAlerts();
        $this->releaseAlerts();
        return true;
    }

    abstract protected function detectAlerts();
    abstract protected function releaseAlerts();
}

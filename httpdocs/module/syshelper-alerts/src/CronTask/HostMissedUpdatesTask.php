<?php
namespace WirklichDigital\SyshelperAlerts\CronTask;

use WirklichDigital\CronScheduler\CronTask\CronTaskExecutable;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperAlerts\Entity\Alert;
use WirklichDigital\SyshelperAlerts\Service\AlertService;
use WirklichDigital\SyshelperBase\Entity\Host;

class HostMissedUpdatesTask implements CronTaskExecutable
{
    const ALERT_NAME = "Host is missing updates";
    const ALERT_DESCRIPTION = "This host has 10+ missed upgradable apt packages: ";

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

    private function detectAlerts()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->select('h')
                    ->from(Host::class, 'h')
                    ->andWhere('LENGTH(h.packagesAptUpgradable) > 3')
                    ->getQuery();
        $result = $query->getResult();

        foreach ($result as $host) {
            if (count($host->getPackagesAptUpgradable()) < 10) {
                continue;
            }

            self::$verifiedAlertIds[] = $host->getId();
            $this->alertService->newAlert(self::class, $host->getId(), self::ALERT_NAME, self::ALERT_DESCRIPTION.count($host->getPackagesAptUpgradable()), $host);
        }
    }

    private function releaseAlerts()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->select('a')
                    ->from(Alert::class, 'a')
                    ->andWhere('a.cronjobClass = :cronjobClass')
                    ->setParameter('cronjobClass', self::class)
                    ->getQuery();
        $result = $query->getResult();

        foreach ($result as $alert) {
            if (! in_array($alert->getAlertIdentifier(), self::$verifiedAlertIds)) {
                $this->alertService->releaseAlert($alert);
            }
        }
    }
}

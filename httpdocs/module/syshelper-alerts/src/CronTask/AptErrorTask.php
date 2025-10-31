<?php
namespace WirklichDigital\SyshelperAlerts\CronTask;

use WirklichDigital\SyshelperAlerts\Entity\Alert;
use WirklichDigital\SyshelperBase\Entity\Host;

class AptErrorTask extends AbstractAlertTask
{
    const ALERT_NAME = "Apt Error";
    const ALERT_DESCRIPTION = "Host has packages with repo error";
    protected static $verifiedAlertIds = [];

    protected function detectAlerts()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->select('h')
                    ->from(Host::class, 'h')
                    ->andWhere('h.packagesAptHasRepoError = 1')
                    ->getQuery();
        $result = $query->getResult();

        foreach ($result as $host) {
            self::$verifiedAlertIds[] = $host->getId();
            $this->alertService->newAlert(self::class, $host->getId(), self::ALERT_NAME, self::ALERT_DESCRIPTION, $host);
        }
    }

    protected function releaseAlerts()
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

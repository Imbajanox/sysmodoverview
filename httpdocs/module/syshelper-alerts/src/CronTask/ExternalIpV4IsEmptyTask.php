<?php
namespace WirklichDigital\SyshelperAlerts\CronTask;

use WirklichDigital\SyshelperAlerts\Entity\Alert;
use WirklichDigital\SyshelperBase\Entity\Host;

class ExternalIpV4IsEmptyTask extends AbstractAlertTask
{
    const ALERT_NAME = "External IpV4 empty";
    const ALERT_DESCRIPTION = "External IpV4 of host is empty";
    protected static $verifiedAlertIds = [];

    protected function detectAlerts()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->select('h')
                    ->from(Host::class, 'h')
                    ->andWhere("h.externalIpV4 = ''")
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

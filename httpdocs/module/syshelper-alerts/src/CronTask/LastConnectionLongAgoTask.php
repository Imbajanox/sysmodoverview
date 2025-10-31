<?php
namespace WirklichDigital\SyshelperAlerts\CronTask;

use WirklichDigital\SyshelperAlerts\Entity\Alert;
use WirklichDigital\SyshelperBase\Entity\Host;

class LastConnectionLongAgoTask extends AbstractAlertTask
{
    const ALERT_NAME = "Host last connect is long ago";
    const ALERT_DESCRIPTION = "This host did not connect for more than 3h. Last connection: ";
    const LONG_AGO_TIME = 3;
    protected static $verifiedAlertIds = [];

    protected function detectAlerts()
    {
        $date = new \DateTime("-".self::LONG_AGO_TIME." hours");
        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->select('h')
                    ->from(Host::class, 'h')
                    ->andWhere('h.lastConnectionAt < :date')
                    ->setParameter('date', $date)
                    ->getQuery();
        $result = $query->getResult();

        foreach ($result as $host) {
            self::$verifiedAlertIds[] = $host->getId();
            $this->alertService->newAlert(self::class, $host->getId(), self::ALERT_NAME, self::ALERT_DESCRIPTION.$host->getLastConnectionAt()->format('d-m-Y H:i:s'), $host);
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

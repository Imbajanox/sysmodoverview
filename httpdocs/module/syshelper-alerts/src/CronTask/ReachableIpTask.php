<?php
namespace WirklichDigital\SyshelperAlerts\CronTask;

use WirklichDigital\SyshelperAlerts\Entity\Alert;
use WirklichDigital\SyshelperBase\Entity\AssignedIp;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SyshelperBase\Entity\IpSubnet;
use WirklichDigital\SyshelperBase\Entity\ReachableIp;

class ReachableIpTask extends AbstractAlertTask
{
    const ALERT_NAME = "Reachable IP has no assignedIP";
    const ALERT_DESCRIPTION = "Assigned IP is NULL and subnet is not dynamic";
    protected static $verifiedAlertIds = [];

    protected function detectAlerts()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->select('r')
                    ->from(ReachableIp::class, 'r')
                    ->leftJoin('r.subnet', 's')
                    ->andWhere('r.assignedIp IS NULL')
                    ->andWhere('s.isDynamic = 0')
                    ->getQuery();
        $result = $query->getResult();

        foreach ($result as $reachableIp) {
            self::$verifiedAlertIds[] = $reachableIp->getId();
            $this->alertService->newAlert(self::class, $reachableIp->getId(), self::ALERT_NAME, self::ALERT_DESCRIPTION, null, $reachableIp->getSubnet(), null, $reachableIp);
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

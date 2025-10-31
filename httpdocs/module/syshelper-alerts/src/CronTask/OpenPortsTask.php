<?php
namespace WirklichDigital\SyshelperAlerts\CronTask;

use WirklichDigital\SyshelperAlerts\Entity\Alert;
use WirklichDigital\SyshelperBase\Entity\AssignedIp;

class OpenPortsTask extends AbstractAlertTask
{
    const CRITICAL_PORT_AMMOUNT_LIMIT = 17;
    const ALERT_NAME = "Assigned IP has many open Ports";
    const ALERT_DESCRIPTION = "This AssignedIP has ".self::CRITICAL_PORT_AMMOUNT_LIMIT."+ Ports open: ";
    protected static $verifiedAlertIds = [];

    protected function detectAlerts()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->select('a')
                    ->from(AssignedIp::class, 'a')
                    ->andWhere('LENGTH(a.openPortsExternal) > 19')
                    ->getQuery();
        $result = $query->getResult();

        foreach ($result as $assignedIp) {
            if (empty($assignedIp->getOpenPortsExternal())) {
                continue;
            }
            $amm = count($assignedIp->getOpenPortsExternal()['tcp']) + count($assignedIp->getOpenPortsExternal()['udp']);
            if ($amm < self::CRITICAL_PORT_AMMOUNT_LIMIT) {
                continue;
            }

            self::$verifiedAlertIds[] = $assignedIp->getId();
            $this->alertService->newAlert(self::class, $assignedIp->getId(), self::ALERT_NAME, self::ALERT_DESCRIPTION.$amm, null, $assignedIp->getSubnet(), $assignedIp);
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

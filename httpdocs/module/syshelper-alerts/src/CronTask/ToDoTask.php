<?php
namespace WirklichDigital\SyshelperAlerts\CronTask;

use WirklichDigital\SyshelperAlerts\Entity\Alert;
use WirklichDigital\SyshelperBase\Entity\AssignedIp;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SyshelperBase\Entity\IpSubnet;
use WirklichDigital\SyshelperBase\Entity\SyshelperTag;

class ToDoTask extends AbstractAlertTask
{
    const ALERT_NAME = "TODOs";
    const ALERT_DESCRIPTION = "There is an open TODO: ";
    protected static $verifiedAlertIds = [];

    protected function detectAlerts()
    {
        // For Host-Tag
        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->select('h')
                    ->from(Host::class, 'h')
                    ->getQuery();
        $result = $query->getResult();
        
        foreach ($result as $host) {
            if (count($host->getTags()) > 0) {
                foreach ($host->getTags() as $tag) {
                    if (strpos(strtolower($tag->getName()), "todo")) {
                        self::$verifiedAlertIds[] = $host->getId().$tag->getId();
                        $this->alertService->newAlert(self::class, $host->getId().$tag->getId(), self::ALERT_NAME, self::ALERT_DESCRIPTION.$tag->getName(), $host);
                    }
                }
            }
        }

        // For AssignedIp-Tag
        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->select('a')
                    ->from(AssignedIp::class, 'a')
                    ->getQuery();
        $result = $query->getResult();
        
        foreach ($result as $assignedIp) {
            if (count($assignedIp->getTags()) > 0) {
                foreach ($assignedIp->getTags() as $tag) {
                    if (strpos(strtolower($tag->getName()), "todo")) {
                        self::$verifiedAlertIds[] = $assignedIp->getId().$tag->getId();
                        $this->alertService->newAlert(self::class, $assignedIp->getId().$tag->getId(), self::ALERT_NAME, self::ALERT_DESCRIPTION.$tag->getName(), null, null, $assignedIp);
                    }
                }
            }
        }
        
        // For Subnet-Tag
        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->select('s')
                    ->from(IpSubnet::class, 's')
                    ->getQuery();
        $result = $query->getResult();
        
        foreach ($result as $subnet) {
            if (count($subnet->getTags()) > 0) {
                foreach ($subnet->getTags() as $tag) {
                    if (strpos(strtolower($tag->getName()), "todo")) {
                        self::$verifiedAlertIds[] = $subnet->getId().$tag->getId();
                        $this->alertService->newAlert(self::class, $subnet->getId().$tag->getId(), self::ALERT_NAME, self::ALERT_DESCRIPTION.$tag->getName(), null, $subnet);
                    }
                }
            }
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

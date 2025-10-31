<?php
namespace WirklichDigital\SyshelperAlerts\Service;

use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperAlerts\Entity\Alert;

class AlertService
{

    /** @var EntityManager */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function getAlert($cronjobClass, $alertIdentifier)
    {
        return $this->entityManager->getRepository(Alert::class)->findOneBy(['cronjobClass' => $cronjobClass, 'alertIdentifier' => $alertIdentifier]);
    }

    public function newAlert($cronjobClass, $alertIdentifier, $name, $description, $host = null, $subnet = null, $assignedIp = null, $reachableIp = null)
    {
        $existingAlert = $this->getAlert($cronjobClass, $alertIdentifier);

        if (! empty($existingAlert)) {
            $existingAlert->setName($name);
            $existingAlert->setDescription(substr($description,0,512));
            $existingAlert->setLastSeenAt(new \DateTime());
            $this->entityManager->flush();
        } else {
            $alert = new Alert();
            $alert->setCronjobClass($cronjobClass);
            $alert->setAlertIdentifier($alertIdentifier);
            $alert->setName($name);
            $alert->setDescription(substr($description,0,512));
            $alert->setLastSeenAt(new \DateTime());
            $alert->setHost($host);
            $alert->setIpSubnet($subnet);
            $alert->setAssignedIp($assignedIp);
            $alert->setReachableIp($reachableIp);
            $alert->setIsMuted(false);
            $alert->setIsAcknowledged(false);

            $this->entityManager->persist($alert);
            $this->entityManager->flush();
        }
    
    }

    public function releaseAlert($alert)
    {
        $this->entityManager->remove($alert);
        $this->entityManager->flush();
    }
}

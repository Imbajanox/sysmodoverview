<?php
namespace WirklichDigital\SyshelperAlerts\CronTask;

use WirklichDigital\CronScheduler\CronTask\CronTaskExecutable;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperAlerts\Service\AlertService;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer;

class LastTransmissionOfModulesLongAgoTask implements CronTaskExecutable
{
    const ALERT_NAME = "Transmission of Modules Long Ago";
    const ALERT_DESCRIPTION = "Host has not transmitted module or server data for more than 7 days";

    public function __construct(
        protected EntityManager $entityManager,
        protected AlertService $alertService
    ) {
    }

    public function run()
    {
        $query = $this->entityManager->createQueryBuilder();
        $query->select("s.updatedAt, s.id")
            ->from(LaminasSystemServer::class, 's')
            ->andWhere('s.updatedAt < :date')
            ->setParameter('date', new \DateTime('-7 days'));
        $result = $query->getQuery()->getResult();
        // dump($result);
        // die();

        foreach ($result as $row) {
            $this->alertService->newAlert(self::class, $row['id'], self::ALERT_NAME, self::ALERT_DESCRIPTION);
        }

        return true;
    }
}

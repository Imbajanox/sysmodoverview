<?php
namespace WirklichDigital\SyshelperAlerts\CronTask\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\SyshelperAlerts\CronTask\HostMissedUpdatesTask;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperAlerts\Service\AlertService;

class GenericAlertTaskFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);
        $alertService = $container->get(AlertService::class);
        return new $requestedName($entityManager, $alertService);
    }
}

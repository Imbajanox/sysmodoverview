<?php
namespace WirklichDigital\SyshelperAlerts\Service\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\SyshelperAlerts\Service\AlertService;
use Doctrine\ORM\EntityManager;

class AlertServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);
        return new AlertService($entityManager);
    }
}

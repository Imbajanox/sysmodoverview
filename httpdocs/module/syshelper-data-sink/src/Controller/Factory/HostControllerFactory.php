<?php
namespace WirklichDigital\SyshelperDataSink\Controller\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\SyshelperDataSink\Controller\HostController;
use Doctrine\ORM\EntityManager;

class HostControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);
        return new HostController($entityManager);
    }
}

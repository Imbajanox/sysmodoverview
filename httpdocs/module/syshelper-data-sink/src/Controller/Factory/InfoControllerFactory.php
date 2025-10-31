<?php
namespace WirklichDigital\SyshelperDataSink\Controller\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\SyshelperDataSink\Controller\InfoController;
use Doctrine\ORM\EntityManager;

class InfoControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);
        return new InfoController($entityManager);
    }
}

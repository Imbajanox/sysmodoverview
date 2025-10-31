<?php
namespace WirklichDigital\SyshelperBase\Service\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\SyshelperBase\Service\IpAssignmentService;
use Doctrine\ORM\EntityManager;

class IpAssignmentServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);
        return new IpAssignmentService($entityManager);
    }
}

<?php
namespace WirklichDigital\SyshelperBase\Service\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\SyshelperBase\Service\HostRawFactsParsingService;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperBase\Service\IpAssignmentService;

class HostRawFactsParsingServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);
        $ipAssignmentService = $container->get(IpAssignmentService::class);
        return new HostRawFactsParsingService($entityManager, $ipAssignmentService);
    }
}

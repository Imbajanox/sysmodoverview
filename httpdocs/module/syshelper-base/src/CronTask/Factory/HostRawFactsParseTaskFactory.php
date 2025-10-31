<?php
namespace WirklichDigital\SyshelperBase\CronTask\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\SyshelperBase\CronTask\HostRawFactsParseTask;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperBase\Service\HostRawFactsParsingService;

class HostRawFactsParseTaskFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);
        $hostRawFactsParsingService = $container->get(HostRawFactsParsingService::class);
        return new HostRawFactsParseTask($entityManager,$hostRawFactsParsingService);
    }
}

<?php
namespace WirklichDigital\SyshelperBase\CronTask\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\SyshelperBase\CronTask\ImportIPRangesTask;
use Doctrine\ORM\EntityManager;

class ImportIPRangesTaskFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);
        return new ImportIPRangesTask($entityManager);
    }
}

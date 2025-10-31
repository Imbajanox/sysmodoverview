<?php
namespace WirklichDigital\SyshelperScanner\CronTask\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\SyshelperScanner\CronTask\PingscanTask;
use Doctrine\ORM\EntityManager;

class PingscanTaskFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);
        return new PingscanTask($entityManager);
    }
}

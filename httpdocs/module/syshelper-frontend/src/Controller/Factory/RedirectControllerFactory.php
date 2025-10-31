<?php
namespace WirklichDigital\SyshelperFrontend\Controller\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\SyshelperFrontend\Controller\RedirectController;
use Doctrine\ORM\EntityManager;

class RedirectControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);
        return new RedirectController($entityManager);
    }
}

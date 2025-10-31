<?php
namespace WirklichDigital\SyshelperFrontend\Controller\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\SyshelperFrontend\Controller\IndexController;
use Doctrine\ORM\EntityManager;
use WirklichDigital\DataTables\Service\DataTableAPI;
use WirklichDigital\SyshelperBase\Service\IpAssignmentService;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);
        $ipAssignmentService = $container->get(IpAssignmentService::class);
        $dataTableApi = $container->get(DataTableAPI::class);
        return new IndexController($entityManager, $ipAssignmentService,$dataTableApi);
    }
}

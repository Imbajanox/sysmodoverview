<?php

namespace WirklichDigital\SyshelperFrontend\Controller\Factory;

use WirklichDigital\SyshelperFrontend\Controller\AssignedIpController;
use Interop\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Form\FormElementManager;
use WirklichDigital\DataTables\Service\DataTableAPI;

class AssignedIpControllerFactory implements FactoryInterface
{

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $em = $container->get(EntityManager::class);
        $formManager = $container->get(FormElementManager::class);
        $dataTableApi = $container->get(DataTableAPI::class);
        return new AssignedIpController($em, $formManager, $dataTableApi);
    }
}

<?php

namespace WirklichDigital\SystemModuleOverview\Table\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use WirklichDigital\DataTables\Table\SimpleDataTable;
use WirklichDigital\DataTables\Service\ColumnPluginManager;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface as ContainerContainerInterface;
use WirklichDigital\SystemModuleOverview\Entity\NpmModules;
use WirklichDigital\SystemModuleOverview\Service\ComposerModuleService;
use WirklichDigital\SystemModuleOverview\Service\LaminasModuleService;

class NpmModuleTableFactory implements FactoryInterface
{
    protected $router;

    public function __invoke(ContainerContainerInterface $container, $requestedName, array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);
        $em = $container->get(EntityManager::class);
        /** @var LaminasModuleService $moduleService */
        $moduleService = $container->get(LaminasModuleService::class);


        $query = $em->createQueryBuilder();
        $query->select('DISTINCT c.name')
            ->from(NpmModules::class, 'c');
            

        $columns = [];

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Module Name'),
            'columnName' => 'c.name',
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Systems'),
            'columnName' => 'c.name',
            'dataBuilder' => [
                'name' => 'callback',
                'options' => [
                    'callback' => function ($row) use ($moduleService) {
                        return $moduleService->getAmountOfSystemsWithModules(NpmModules::class, $row['name']);
                    },
                ],
            ]
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Up to date'),
            'columnName' => 'c.name',
            'dataBuilder' => [
                'name' => 'callback',
                'options' => [
                    'callback' => function ($row) use ($moduleService) {
                        return $moduleService->getAmountOfSystemsWhichAreUpToDateWithModules(NpmModules::class, $row['name']);
                    },
                ],
            ]
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Outdated'),
            'columnName' => 'c.name',
            'dataBuilder' => [
                'name' => 'callback',
                'options' => [
                    'callback' => function ($row) use ($moduleService) {
                        return $moduleService->getAmountOfSystemsWhichAreOutdatedWithModules(NpmModules::class, $row['name']);
                    },
                ],
            ]
        ]);

        $columns[] = $colManager->get('link', [
            'title' => gettext_noop('Actions'),
            'actions' => [
                [
                    'class' => 'fb_auto_small',
                    'hrefBuilder' => [
                        'name' => 'url',
                        'options' => [
                            'routeName' => 'sysModOverview/module/npmView',
                            'parameterCallback' => function ($row) {
                                return ['name' => $row['name']];
                            },
                        ],
                    ],
                    'contentBuilder' => [
                        'name' => 'literal',
                        'options' => [
                            'value' => gettext_noop('Show details'),
                        ],
                    ],
                ],
            ],
        ]);


        return new SimpleDataTable($columns, $query, []);
    }
}

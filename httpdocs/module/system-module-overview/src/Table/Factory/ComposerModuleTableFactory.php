<?php

namespace WirklichDigital\SystemModuleOverview\Table\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use WirklichDigital\DataTables\Table\SimpleDataTable;
use WirklichDigital\DataTables\Service\ColumnPluginManager;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface as ContainerContainerInterface;
use WirklichDigital\SystemModuleOverview\Entity\ComposerModule;

class ComposerModuleTableFactory implements FactoryInterface
{
    protected $router;

    public function __invoke(ContainerContainerInterface $container, $requestedName, array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);
        $em = $container->get(EntityManager::class);
        $this->router = $container->get('router');
        
        
        $query = $em->createQueryBuilder();
        $query->select(' c.id, c.vendor, c.name, c.systems, c.upToDate, c.outdated')
            ->from(ComposerModule::class, 'c');

        $columns = [];

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Vendor'),
            'columnName' => 'c.vendor',
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Name'),
            'columnName' => 'c.name',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Systems'),
            'columnName' => 'c.systems',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Up tp date'),
            'columnName' => 'c.upToDate',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Outdated'),
            'columnName' => 'c.outdated',
        ]);

        $columns[] = $colManager->get('link', [
            'title' => gettext_noop('Actions'),
            'actions' => [
                [
                    'class' => 'fb_auto_small',
                    'hrefBuilder' => [
                        'name' => 'url',
                        
                        'options' => [
                            'routeName' => 'sysModOverview/module/view',
                            'parameterCallback' => function ($row) {
                                return ['vendor' => $row['vendor'], 'name' => $row['name']];
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

<?php

namespace WirklichDigital\SystemModuleOverview\Table\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\DataTables\Table\SimpleDataTable;
use WirklichDigital\DataTables\Column\Column;
use WirklichDigital\DataTables\Service\ColumnPluginManager;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface as ContainerContainerInterface;
use WirklichDigital\StdLib\ColorUtils\ColorCalculator;
use WirklichDigital\StdLib\FileUtils\HumanReadbleFilesize;
use WirklichDigital\SyshelperAlerts\Entity\Alert;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystem;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule;

class SystemTableFactory implements FactoryInterface
{
    public function __invoke(ContainerContainerInterface $container, $requestedName, array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);
        $em = $container->get(EntityManager::class);
        
        $query = $em->createQueryBuilder();
        $query->select('l.id, l.repositoryName, l.repository')
            ->from(LaminasSystem::class, 'l');

        $columns = [];

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Laminas System'),
            'columnName' => 'l.repositoryName',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Laminas System Repository'),
            'columnName' => 'l.repository',
        ]);

        $columns[] = $colManager->get('link', [
            'title' => gettext_noop('Actions'),
            'actions' => [
                [
                    'class' => 'fb_auto_small',
                    'hrefBuilder' => [
                        'name' => 'url',
                        'options' => [
                            'routeName' => 'sysModOverview/system/server/list',
                            'parameterCallback' => function ($row) {
                                return ['id' => $row['id']];
                            },
                        ],
                    ],
                    'contentBuilder' => [
                        'name' => 'literal',
                        'options' => [
                            'value' => gettext_noop('Show Systems'),
                        ],
                    ],
                ],
            ],
        ]);

        return new SimpleDataTable($columns, $query, []);
    }
}

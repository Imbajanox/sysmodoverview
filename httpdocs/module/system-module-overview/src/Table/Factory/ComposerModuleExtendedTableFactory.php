<?php

namespace WirklichDigital\SystemModuleOverview\Table\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\DataTables\Table\SimpleDataTable;
use WirklichDigital\DataTables\Column\Column;
use WirklichDigital\DataTables\Service\ColumnPluginManager;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface as ContainerContainerInterface;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule;
use WirklichDigital\SystemModuleOverview\Service\LaminasModuleService;

class ComposerModuleExtendedTableFactory implements FactoryInterface
{
    public function __invoke(ContainerContainerInterface $container, $requestedName, array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);
        $em = $container->get(EntityManager::class);
        
        /** @var ModuleService $moduleService */
        $moduleService = $container->get(LaminasModuleService::class);

        /** @var EntityManager $em */
        $query = $em->createQueryBuilder();
        $query->select('sm.moduleVersionNormalized, sm.moduleVersion')
            ->from(LaminasSystemServerModule::class, 'sm');
        $query->leftJoin('sm.composerModule', 'm')
            ->addSelect('m.vendor, m.name');
        $query->leftJoin('sm.laminasSystemServer', 'ss')
            ->addSelect('ss.url, ss.isDeinPim, ss.id as sid');
        $query->leftJoin('ss.laminasSystem', 's')
            ->addSelect('s.repositoryName');
        $query->leftJoin('ss.laminasSystemServerComposerOutdated', 'o', 'WITH', 'o.composerModule = m')
            ->addSelect('o.latest');

        $columns = [];

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Vendor'),
            'columnName' => 'm.vendor',
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Name'),
            'columnName' => 'm.name',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Repo Name'),
            'columnName' => 's.repositoryName',
        ]);
        $columns[] = $colManager->get('boolean', [
            'title' => gettext_noop('deinPim'),
            'columnName' => 'ss.isDeinPim',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Latest Version'),
            'columnName' => 'o.latest',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        if ($row['latest'] === null) {
                            return "<span style='color:red;'>".gettext_noop("No Version detected")."<span>";
                        }
                        return $row['latest'];
                    }
                ],
            ],
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Installed Version'),
            'columnName' => 'sm.moduleVersion',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Installed Version Normalized'),
            'columnName' => 'sm.moduleVersionNormalized',
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Outdated'),
            'columnName' => 'outdated',
            'filterType' => Column::FILTER_TYPE_DROPDOWN,
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) use ($moduleService) {
                        if($row["latest"] == null || $row["moduleVersion"] == null || $moduleService->whichUpdateIsNeeded($row['moduleVersion'], $row['latest']) == "unknown") {
                            return '<span style="color:red;">'.gettext_noop("unknown")."</span>";
                        }
                        return $moduleService->whichUpdateIsNeeded($row['moduleVersion'], $row['latest']);
                    },
                ],
            ],
            'searchBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($query, $value) {
                        switch($value){
                            case "^unknown$" :
                            case '^<span style="color:red;">unknown<\/span>$' :
                                $query->andHaving("o.latest IS NULL");
                                break;
                            case '^major$' : 
                                $query->andHaving("CAST(SUBSTRING_INDEX(o.latest,'.',1) AS UNSIGNED) > CAST(SUBSTRING_INDEX(sm.moduleVersion,'.', 1) AS UNSIGNED)");
                                break;
                            case '^minor$' : 
                                $query->andHaving("
                                    CAST(SUBSTRING_INDEX(o.latest,'.',1) AS UNSIGNED) = CAST(SUBSTRING_INDEX(sm.moduleVersion,'.', 1) AS UNSIGNED)
                                    AND 
                                    CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(o.latest,'.',2),'.',-1) AS UNSIGNED) > CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(sm.moduleVersion,'.',2),'.',-1) AS UNSIGNED)
                                ");
                                break;
                            case '^patch$' : 
                                $query->andHaving("
                                    CAST(SUBSTRING_INDEX(o.latest,'.',1) AS UNSIGNED) = CAST(SUBSTRING_INDEX(sm.moduleVersion,'.', 1) AS UNSIGNED)
                                    AND
                                    CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(o.latest,'.',2),'.',-1) AS UNSIGNED) = CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(sm.moduleVersion,'.',2),'.',-1) AS UNSIGNED)
                                    AND
                                    CAST(SUBSTRING_INDEX(o.latest,'.',-1) AS UNSIGNED) > CAST(SUBSTRING_INDEX(sm.moduleVersion, '.', -1) AS UNSIGNED)
                                ");
                                break;
                            case '^up\-to\-date$' : 
                                $query->andHaving("
                                    (
                                        CAST(SUBSTRING_INDEX(o.latest,'.',1) AS UNSIGNED) <= CAST(SUBSTRING_INDEX(sm.moduleVersion,'.', 1) AS UNSIGNED)
                                        AND
                                        CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(o.latest,'.',2),'.',-1) AS UNSIGNED) <= CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(sm.moduleVersion,'.',2),'.',-1) AS UNSIGNED)
                                        AND
                                        CAST(SUBSTRING_INDEX(o.latest,'.',-1) AS UNSIGNED) <= CAST(SUBSTRING_INDEX(sm.moduleVersion, '.', -1) AS UNSIGNED)
                                    )
                                    OR
                                    (
                                        CAST(SUBSTRING_INDEX(o.latest,'.',1) AS UNSIGNED) < CAST(SUBSTRING_INDEX(sm.moduleVersion,'.', 1) AS UNSIGNED)
                                    )
                                    OR
                                    (
                                        CAST(SUBSTRING_INDEX(o.latest,'.',1) AS UNSIGNED) <= CAST(SUBSTRING_INDEX(sm.moduleVersion,'.', 1) AS UNSIGNED)
                                        AND
                                        CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(o.latest,'.',2),'.',-1) AS UNSIGNED) < CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(sm.moduleVersion,'.',2),'.',-1) AS UNSIGNED)
                                    )
                                ");
                                break;
                            default : break;
                        }
                        return $query;
                    }
                ],
            ],
            'orderBuilder' => null,
        ]);
        $columns[] = $colManager->get('link', [
            'title' => gettext_noop('URL'),
            'columnName' => 'ss.url',
            'actions' => [
                [
                    'class' => 'fb_auto_big',
                    'hrefBuilder' => [
                        'name' => 'url',
                        'options' => [
                            'routeName' => 'sysModOverview/system/server/view',
                            'parameterCallback' => function ($row) {
                                return ['id' => $row['sid']];
                            },
                        ],
                    ],
                    'contentBuilder' => [
                        'name' => 'callback',
                        'options' => [
                            'callback' => function ($row) {
                                return $row['url'];
                            },
                        ],
                    ],
                ],
            ],
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
                    'displayConditionCallback' => function ($row) {
                        return $row['vendor'] !== null && $row['name'] !== null;
                    },
                ],
            ],
        ]);

        return new SimpleDataTable($columns, $query, []);
    }
}

<?php

namespace WirklichDigital\SystemModuleOverview\Table\Factory;

use WirklichDigital\DataTables\Column\Column;
use Laminas\ServiceManager\Factory\FactoryInterface;
use WirklichDigital\DataTables\Table\SimpleDataTable;
use WirklichDigital\DataTables\Service\ColumnPluginManager;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface as ContainerContainerInterface;
use WirklichDigital\SystemModuleOverview\Entity\NpmModules;
use WirklichDigital\SystemModuleOverview\Service\LaminasModuleService;

class NpmModuleExtendedTableFactory implements FactoryInterface
{
    protected $router;

    public function __invoke(ContainerContainerInterface $container, $requestedName, array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);
        $em = $container->get(EntityManager::class);
        /** @var LaminasModuleService $moduleService */
        $moduleService = $container->get(LaminasModuleService::class);

        $query = $em->createQueryBuilder();
        $query->select('c.name, c.module, c.installedVersion,c.latestVersion, c.wantedVersion')
            ->from(NpmModules::class, 'c')
            ->leftJoin('c.laminasSystemServer', 'ss')
            ->addSelect('ss.url, ss.isDeinPim, ss.id as sid')
            ->leftJoin('ss.laminasSystem', 's')
            ->addSelect('s.repositoryName')
            ;

        $columns = [];

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Name'),
            'columnName' => 'c.name',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Repo Name'),
            'columnName' => 's.repositoryName',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Installed in Module'),
            'columnName' => 'c.module',
        ]);
        $columns[] = $colManager->get('boolean', [
            'title' => gettext_noop('deinPim'),
            'columnName' => 'ss.isDeinPim',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Latest Version'),
            'columnName' => 'c.latestVersion',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Installed Version'),
            'columnName' => 'c.installedVersion',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Wanted Version'),
            'columnName' => 'c.wantedVersion',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Outdated'),
            'columnName' => 'outdated',
            'filterType' => Column::FILTER_TYPE_DROPDOWN,
            'dataBuilder' => [
                'name' => 'callback',
                'options' => [
                    'callback' => function ($row) use ($moduleService) {
                        if($row["latestVersion"] == null || $row["installedVersion"] == null || $moduleService->whichUpdateIsNeeded($row["installedVersion"], $row["latestVersion"]) == "unknown") {
                            return '<span style="color:red;">'.gettext_noop("unknown").'</span>';
                        }
                        return $moduleService->whichUpdateIsNeeded($row['installedVersion'], $row['latestVersion']);
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
                                $query->andHaving("c.latestVersion IS NULL OR c.installedVersion IS NULL");
                                break;
                            case '^major$' : 
                                $query->andHaving("SUBSTRING_INDEX(c.latestVersion,'.',1) > SUBSTRING_INDEX(c.installedVersion,'.', 1)");
                                break;
                            case '^minor$' : 
                                $query->andHaving("
                                    SUBSTRING_INDEX(c.latestVersion,'.',1) = SUBSTRING_INDEX(c.installedVersion,'.', 1)
                                    AND 
                                    SUBSTRING_INDEX(SUBSTRING_INDEX(c.latestVersion,'.',2),'.',-1) > SUBSTRING_INDEX(SUBSTRING_INDEX(c.installedVersion,'.',2),'.',-1)
                                ");
                                break;
                            case '^patch$' : 
                                $query->andHaving("
                                    SUBSTRING_INDEX(c.latestVersion,'.',1) = SUBSTRING_INDEX(c.installedVersion,'.', 1)
                                    AND
                                    SUBSTRING_INDEX(SUBSTRING_INDEX(c.latestVersion,'.',2),'.',-1) = SUBSTRING_INDEX(SUBSTRING_INDEX(c.installedVersion,'.',2),'.',-1)
                                    AND
                                    SUBSTRING_INDEX(c.latestVersion,'.',-1) > SUBSTRING_INDEX(c.installedVersion, '.', -1)
                                ");
                                break;
                            case '^up\-to\-date$' : 
                                $query->andHaving("
                                    (SUBSTRING_INDEX(c.latestVersion,'.',1) <= SUBSTRING_INDEX(c.installedVersion,'.', 1)
                                    AND
                                    SUBSTRING_INDEX(SUBSTRING_INDEX(c.latestVersion,'.',2),'.',-1) <= SUBSTRING_INDEX(SUBSTRING_INDEX(c.installedVersion,'.',2),'.',-1)
                                    AND
                                    SUBSTRING_INDEX(c.latestVersion,'.',-1) <= SUBSTRING_INDEX(c.installedVersion, '.', -1))
                                    OR
                                    (SUBSTRING_INDEX(c.latestVersion,'.',1) < SUBSTRING_INDEX(c.installedVersion,'.', 1))
                                    OR
                                    (SUBSTRING_INDEX(c.latestVersion,'.',1) <= SUBSTRING_INDEX(c.installedVersion,'.', 1)
                                    AND
                                    SUBSTRING_INDEX(SUBSTRING_INDEX(c.latestVersion,'.',2),'.',-1) < SUBSTRING_INDEX(SUBSTRING_INDEX(c.installedVersion,'.',2),'.',-1))
                                    OR
                                    (SUBSTRING_INDEX(c.latestVersion,'.',1) <= SUBSTRING_INDEX(c.installedVersion,'.', 1)
                                    AND
                                    SUBSTRING_INDEX(SUBSTRING_INDEX(c.latestVersion,'.',2),'.',-1) <= SUBSTRING_INDEX(SUBSTRING_INDEX(c.installedVersion,'.',2),'.',-1)
                                    AND
                                    SUBSTRING_INDEX(c.latestVersion,'.',-1) < SUBSTRING_INDEX(c.installedVersion, '.', -1))
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

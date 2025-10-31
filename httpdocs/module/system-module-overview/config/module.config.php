<?php

namespace WirklichDigital\SystemModuleOverview;

use DoctrineExtensions\Query\Mysql\Cast;
use DoctrineExtensions\Query\Mysql\SubstringIndex;
use WirklichDigital\ReflectionBasedAbstractFactory\AbstractFactory\ReflectionBasedAbstractFactory;
use function gettext_noop;

return [
    'translator'       => [
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ],
        ],
    ],
    'doctrine'         => [
        'driver'        => [
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\\Entity' => 'WirklichDigital\DynamicEntityModule_driver',
                ],
            ],
        ],
        'configuration' => [
            'orm_default' => [
                'string_functions' => [
                    'substring_index' => SubstringIndex::class,
                    'cast'            => Cast::class,
                ],
            ],
        ],
    ],
    'service_manager'  => [
        'factories' => [
            Service\SysModOverviewService::class       => ReflectionBasedAbstractFactory::class,
            Service\LaminasSystemServerService::class  => ReflectionBasedAbstractFactory::class,
            Service\ComposerModuleService::class       => ReflectionBasedAbstractFactory::class,
            Service\LaminasModuleService::class        => ReflectionBasedAbstractFactory::class,
            Service\ProcessedFileCleanupService::class => ReflectionBasedAbstractFactory::class,
            Service\LaminasSystemLogService::class     => ReflectionBasedAbstractFactory::class,
        ],
    ],
    'controllers'      => [
        'factories' => [
            Controller\IndexController::class                => ReflectionBasedAbstractFactory::class,
            Controller\LaminasSystemController::class        => ReflectionBasedAbstractFactory::class,
            Controller\LaminasModuleController::class        => ReflectionBasedAbstractFactory::class,
            Controller\LaminasServerController::class        => ReflectionBasedAbstractFactory::class,
            Controller\LaminasNegatedserverController::class => ReflectionBasedAbstractFactory::class,
        ],
    ],
    'asset_manager'    => [
        'resolver_configs' => [
            'aliases' => [
                'assets/system-module-overview/' => __DIR__ . '/../assets/',
            ],
        ],
        'filters'          => [],
    ],
    'view_manager'     => [
        'layout'              => 'layout/altair',
        'not_found_template'  => 'altair/404',
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'wirklich-digital' => [
        'system-module-overview' => [
            'processing' => [
                'max_files_per_run'       => 50,
                'archive_processed_files' => true,
                'retention_days'          => 30,
            ],
        ],
        'data-tables'            => [
            'tables' => [
                'factories' => [
                    'moduleTable'                 => Table\Factory\ModuleTableFactory::class,
                    'serverTable'                 => Table\Factory\ServerTableFactory::class,
                    'systemTable'                 => Table\Factory\SystemTableFactory::class,
                    'composerModuleTable'         => Table\Factory\ComposerModuleTableFactory::class,
                    'composerModuleExtendedTable' => Table\Factory\ComposerModuleExtendedTableFactory::class,
                    'npmModuleTable'              => Table\Factory\NpmModuleTableFactory::class,
                    'npmModuleExtendedTable'      => Table\Factory\NpmModuleExtendedTableFactory::class,
                    'npmModuleViewTable'          => Table\Factory\NpmModuleViewTableFactory::class,
                    'negatedserverTable'          => Table\Factory\NegatedserverTableFactory::class,
                ],
            ],
        ],
        'cron-scheduler'         => [
            'jobs'           => [
                CronTask\SaveSystemdatasTask::class       => [
                    'defaults' => [
                        'cronString'       => '* * * * *',
                        'autoRestartAfter' => '120',
                        'enabled'          => true,
                    ],
                ],
                CronTask\CleanupProcessedFilesTask::class => [
                    'defaults' => [
                        'cronString'       => '* * * * *',
                        'autoRestartAfter' => '120',
                        'enabled'          => true,
                    ],
                ],
            ],
            'plugin_manager' => [
                'factories' => [
                    CronTask\SaveSystemdatasTask::class       => ReflectionBasedAbstractFactory::class,
                    CronTask\CleanupProcessedFilesTask::class => ReflectionBasedAbstractFactory::class,
                ],
            ],
        ],
        'authorization'          => [
            'rules' => [
                [
                    'roleId'    => 'guest',
                    'resource'  => 'wirklich-digital/route/sysModOverview/receive-system-infos',
                    'privilege' => null,
                    'allow'     => true,
                ],
            ],
        ],
        'admin'                  => [
            'navigation' => [
                'syshelper-frontend' => [
                    'pages' => [
                        'sysModOverview' => [
                            'title'           => gettext_noop('Laminas Systems'),
                            'label'           => gettext_noop('Laminas Systems'),
                            'route'           => 'sysModOverview/system/list',
                            'fontawesomeIcon' => 'fas fa-server',
                            'materialIcon'    => 'storage',
                            'order'           => 0,
                            'pages'           => [
                                'serverlist'         => [
                                    'title' => gettext_noop('By Repository'),
                                    'label' => gettext_noop('By Repository'),
                                    'route' => 'sysModOverview/system/list',
                                    'order' => 0,
                                ],
                                'modulelist'         => [
                                    'title' => gettext_noop('Systemlist'),
                                    'label' => gettext_noop('Systemlist'),
                                    'route' => 'sysModOverview/system/server/list',
                                    'order' => 0,
                                    'pages' => [
                                        'databaseinfolist' => [
                                            'route'   => 'sysModOverview/system/server/view',
                                            'visible' => false,
                                        ],
                                    ],
                                ],
                                'moduleshow'         => [
                                    'title' => gettext_noop('Modulelist'),
                                    'label' => gettext_noop('Modulelist'),
                                    'route' => 'sysModOverview/module/list',
                                    'order' => 0,
                                    'pages' => [
                                        'moduleView' => [
                                            'route'   => 'sysModOverview/module/view',
                                            'visible' => false,
                                        ],
                                        'npmView'    => [
                                            'route'   => 'sysModOverview/module/npmView',
                                            'visible' => false,
                                        ],
                                    ],
                                ],
                                'moduleshowExtendet' => [
                                    'title' => gettext_noop('Modulelist Extended'),
                                    'label' => gettext_noop('Modulelist Extended'),
                                    'route' => 'sysModOverview/module/list/extended',
                                    'order' => 0,
                                ],
                                'negatedserverlist'  => [
                                    'title' => gettext_noop('Installed Modules'),
                                    'label' => gettext_noop('Installed Modules'),
                                    'route' => 'sysModOverview/module/negatedserver/list',
                                    'order' => 0,
                                ],
                                'serverlist2'        => [
                                    'title'   => gettext_noop('By Repository'),
                                    'label'   => gettext_noop('By Repository'),
                                    'route'   => 'sysModOverview/system/server/list',
                                    'visible' => false,
                                ],
                                'modulelist2'        => [
                                    'title'   => gettext_noop('Systemlist'),
                                    'label'   => gettext_noop('Systemlist'),
                                    'route'   => 'sysModOverview/system/module/list',
                                    'visible' => false,
                                ],
                                'moduleshow2'        => [
                                    'title'   => gettext_noop('Modulelist'),
                                    'label'   => gettext_noop('Modulelist'),
                                    'route'   => 'sysModOverview/system/show',
                                    'visible' => false,
                                ],
                                'databaseinfoshow'   => [
                                    'route'   => 'sysModOverview/system/databaseinfo/show',
                                    'visible' => false,
                                ],
                                'migrationstateshow' => [
                                    'route'   => 'sysModOverview/system/migrationstate/show',
                                    'visible' => false,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'dynamic-entity'         => [
            'entities' => require __DIR__ . '/module.entities.config.php',
        ],
    ],
    'router'           => require __DIR__ . '/module.routes.config.php',
    'console'          => [
        'router' => [
            'routes' => [],
        ],
    ],
];

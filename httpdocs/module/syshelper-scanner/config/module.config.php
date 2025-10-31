<?php
namespace WirklichDigital\SyshelperScanner;

return  [

    'translator' => [
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__ .  '/../language',
                'pattern'  => '%s.mo',
            ],
        ],
    ],

    'doctrine' => [
        'driver' => [
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\\Entity' => 'WirklichDigital\DynamicEntityModule_driver',
                ],
            ],
        ],
    ],

    'service_manager' => [
        'factories' => [
        ],
    ],

    'controllers' => [
        'factories' => [
        ],
    ],

    'asset_manager' => [
        'resolver_configs' => [
            'aliases' => [
                'assets/syshelper-scanner/' => __DIR__ . '/../assets/',
            ],
        ],
        'filters' => [],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

    'wirklich-digital' => [
        'cron-scheduler' => [
            'jobs' => [
                CronTask\PingscanTask::class => [ 
                    'defaults' => [
                        'cronString' => '* * * * *',
                        'autoRestartAfter' => '120',
                    ],
                ],
                CronTask\PortscanTask::class => [ 
                    'defaults' => [
                        'cronString' => '* * * * *',
                        'autoRestartAfter' => '120',
                    ],
                ],
            ],
            'plugin_manager' => [ 
                'factories' => [
                    CronTask\PingscanTask::class => CronTask\Factory\PingscanTaskFactory::class,
                    CronTask\PortscanTask::class => CronTask\Factory\PortscanTaskFactory::class,
                ],
            ],
        ],
        'syshelper-scanner' => [
            'url' => [
                'internal' => null,
                'external' => null,
            ]
        ]
    ],

    'router' => [
        'routes' => [
        ],
    ],

    'console' => [
        'router' => [
            'routes' => [
            ],
        ],
    ],
];

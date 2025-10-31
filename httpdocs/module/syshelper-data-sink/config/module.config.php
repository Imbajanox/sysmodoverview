<?php
namespace WirklichDigital\SyshelperDataSink;

use Reflection;
use WirklichDigital\ReflectionBasedAbstractFactory\AbstractFactory\ReflectionBasedAbstractFactory;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;

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
            Controller\HostController::class => ReflectionBasedAbstractFactory::class,
        ],
    ],

    'asset_manager' => [
        'resolver_configs' => [
            'aliases' => [
                'assets/syshelper-data-sink/' => __DIR__ . '/../assets/',
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
        'dynamic-entity' => [
            'entities' => [
            ],
        ],
    ],

    'router' => [
        'routes' => [
            'data-sink' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/data-sink',
                ],
                'may_terminate' => false,
                'child_routes' => [
                    'host' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/host',
                            'defaults' => [
                                'controller' => Controller\HostController::class,
                                'action'     => 'index',
                            ],
                        ]
                    ],
                    'info' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/info',
                            'defaults' => [
                                'controller' => Controller\InfoController::class,
                                'action'     => 'index',
                            ],
                        ]
                    ],
                ]
            ],
        ],
    ],

    'console' => [
        'router' => [
            'routes' => [
            ],
        ],
    ],
];

<?php

namespace WirklichDigital\SystemModuleOverview;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;

return [
    'routes' => [
        'sysModOverview' => [
            'type' => Literal::class,
            'options' => [
                'route'    => '/sysModOverview',
                // 'defaults' => [
                //     'controller' => Controller\IndexController::class,
                //     'action'     => 'sys-mod-overview',
                // ],
            ],
            'may_terminate' => true,
            'child_routes' => [
                'receive-system-infos' => [
                    'type' => Literal::class,
                    'options' => [
                        'route'    => '/receive-system-infos',
                        'defaults' => [
                            'controller' => Controller\IndexController::class,
                            'action'     => 'receive-system-infos',
                        ],
                    ],
                    'may_terminate' => true,
                    'child_routes' => [],
                ],
                'module' => [
                    'type' => Literal::class,
                    'options' => [
                        'route'    => '/module',
                        'defaults' => [
                            'controller' => Controller\LaminasModuleController::class,
                            'action'     => 'module',
                        ],
                    ],
                    'may_terminate' => true,
                    'child_routes' => [
                        'list' => [
                            'type' => Literal::class,
                            'options' => [
                                'route' => '/list',
                                'defaults' => [
                                    'controller' => Controller\LaminasModuleController::class,
                                    'action'     => 'list',
                                ],
                            ],
                            'may_terminate' => true,
                            'child_routes' => [
                                'extended' => [
                                    'type' => Literal::class,
                                    'options' => [
                                        'route' => '/extended',
                                        'defaults' => [
                                            'controller' => Controller\LaminasModuleController::class,
                                            'action'     => 'extended',
                                        ],
                                    ],
                                ],
                                'composerExtendedAjax' => [
                                    'type'    => Literal::class,
                                    'options' => [
                                        'route'    => '/composerExtendedAjax',
                                        'defaults' => [
                                            'controller' => Controller\LaminasModuleController::class,
                                            'action'     => 'composer-extended-ajax',
                                        ],
                                    ],
                                ],
                                'npmExtendedAjax' => [
                                    'type'    => Literal::class,
                                    'options' => [
                                        'route'    => '/npmExtendedAjax',
                                        'defaults' => [
                                            'controller' => Controller\LaminasModuleController::class,
                                            'action'     => 'npm-extended-ajax',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'composerListAjax' => [
                            'type'    => Literal::class,
                            'options' => [
                                'route'    => '/composerListAjax',
                                'defaults' => [
                                    'controller' => Controller\LaminasModuleController::class,
                                    'action'     => 'composer-list-ajax',
                                ],
                            ],
                        ],
                        'npmListAjax' => [
                            'type'    => Literal::class,
                            'options' => [
                                'route'    => '/npmListAjax',
                                'defaults' => [
                                    'controller' => Controller\LaminasModuleController::class,
                                    'action'     => 'npm-list-ajax',
                                ],
                            ],
                        ],
                        'view' => [
                            'type' => Segment::class,
                            'options' => [
                                'route' => '/view/:vendor/:name',
                                'defaults' => [
                                    'controller' => Controller\LaminasModuleController::class,
                                    'action'     => 'view',
                                ],
                            ],
                        ],
                        'npmView' => [
                            'type' => Segment::class,
                            'options' => [
                                'route' => '/npmview/:name',
                                'defaults' => [
                                    'controller' => Controller\LaminasModuleController::class,
                                    'action'     => 'npm-view',
                                ],
                            ],
                        ],
                        'npmViewAjax' => [
                            'type' => Segment::class,
                            'options' => [
                                'route' => '/npmviewAjax/:name',
                                'defaults' => [
                                    'controller' => Controller\LaminasModuleController::class,
                                    'action'     => 'npm-view-ajax',
                                ],
                            ],
                        ],
                        'negatedserver' => [
                            'type'    => Literal::class,
                            'options' => [
                                'route'    => '/negatedserver',
                                'defaults' => [
                                    'controller' => Controller\LaminasNegatedserverController::class,
                                    'action'     => 'negatedserver',
                                ],
                            ],
                            'may_terminate' => true,
                            'child_routes' => [
                                'list' => [
                                    'type'    => Literal::class,
                                    'options' => [
                                        'route'    => '/list',
                                        'defaults' => [
                                            'action'     => 'list',
                                        ],
                                    ],
                                ],
                                'getModule' => [
                                    'type'    => Literal::class,
                                    'options' => [
                                        'route'    => '/getModule',
                                        'defaults' => [
                                            'action'     => 'getModule',
                                        ],
                                    ],
                                ],
                                'composerListAjax' => [
                                    'type'    => Segment::class,
                                    'options' => [
                                        'route'    => '/composerListAjax[/:modulename/:moduleversion]',
                                        'defaults' => [
                                            'action'     => 'composer-list-ajax',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'system' => [
                    'type' => Literal::class,
                    'options' => [
                        'route'    => '/system',
                        'defaults' => [
                            'controller' => Controller\LaminasSystemController::class,
                            'action'     => 'system',
                        ],
                    ],
                    'may_terminate' => true,
                    'child_routes' => [
                        'server' => [
                            'type' => Literal::class,
                            'options' => [
                                'route'    => '/server',
                                'defaults' => [
                                    'controller' => Controller\LaminasServerController::class,
                                    'action'     => 'server',
                                ],
                            ],
                            'may_terminate' => true,
                            'child_routes' => [
                                'view' => [
                                    'type' => Segment::class,
                                    'options' => [
                                        'route'    => '/view/:id',
                                        'defaults' => [
                                            'controller' => Controller\LaminasServerController::class,
                                            'action'     => 'view',
                                        ],
                                        'constraints' => [
                                            'id' => '[0-9]+',
                                        ],
                                    ],
                                ],
                                'list' => [
                                    'type' => Segment::class,
                                    'options' => [
                                        'route' => '/list[/:id]',
                                        'defaults' => [
                                            'controller' => Controller\LaminasServerController::class,
                                            'action'     => 'list',
                                        ],

                                    ],
                                ],
                                'listAjax' => [
                                    'type'    => Segment::class,
                                    'options' => [
                                        'route'    => '/listAjax[/:id]',
                                        'defaults' => [
                                            'controller' => Controller\LaminasServerController::class,
                                            'action'     => 'list-ajax',
                                        ],

                                    ],
                                ],
                            ],
                        ],
                        'list' => [
                            'type' => Literal::class,
                            'options' => [
                                'route' => '/list',
                                'defaults' => [
                                    'action' => 'list',
                                ],
                            ],
                        ],
                        'listAjax' => [
                            'type' => Literal::class,
                            'options' => [
                                'route' => '/listAjax',
                                'defaults' => [
                                    'action' => 'listAjax',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
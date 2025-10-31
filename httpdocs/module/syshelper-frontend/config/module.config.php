<?php
namespace WirklichDigital\SyshelperFrontend;

use WirklichDigital\ReflectionBasedAbstractFactory\AbstractFactory\ReflectionBasedAbstractFactory;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Placeholder;
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
            Controller\RedirectController::class => Controller\Factory\RedirectControllerFactory::class,
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
            Controller\IpSubnetController::class => Controller\Factory\IpSubnetControllerFactory::class,
            Controller\SyshelperTagController::class => Controller\Factory\SyshelperTagControllerFactory::class,
            Controller\HostController::class => Controller\Factory\HostControllerFactory::class,
            Controller\AssignedIpController::class => Controller\Factory\AssignedIpControllerFactory::class,
            Controller\ReachableIpController::class => Controller\Factory\ReachableIpControllerFactory::class,
            Controller\SshPublicKeyController::class => ReflectionBasedAbstractFactory::class,
        ],
    ],

    'asset_manager' => [
        'resolver_configs' => [
            'aliases' => [
                'assets/syshelper-frontend/' => __DIR__ . '/../assets/',
            ],
        ],
        'filters' => [],
    ],

    'view_manager' => [
        'layout' => 'layout/altair',
        'not_found_template'       => 'altair/404',
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

    'wirklich-digital' => [

        'data-tables' => [
            'tables' => [
                'factories' => [
                    'assignedIpTable' => Table\Factory\AssignedIpTableFactory::class,
                    'reachableIpTable' => Table\Factory\ReachableIpTableFactory::class,
                    'hostTable' => Table\Factory\HostTableFactory::class,
                    'ipSubnetTable' => Table\Factory\IpSubnetTableFactory::class,
                    'syshelperTagTable' => Table\Factory\SyshelperTagTableFactory::class,
                    'alertTable' => Table\Factory\AlertTableFactory::class,
                    'sshPublicKeyTable' => Table\Factory\SshPublicKeyTableFactory::class,
                    'sshAccessTable' => Table\Factory\SshAccessTableFactory::class,
                    'sshLoginTable' => Table\Factory\SshLoginTableFactory::class,
                ],
            ],
        ],
        
        'authentication' => [
            'options' => [
                'defaultLoginRedirect' => 'handle-login-redirect',
            ],
        ],
        'authorization' => [
            'options' => [
                'homeRouteName' => 'handle-login-redirect',
            ],
        ],

        'admin' => [
            'navigation' => [
                'logout' => [
                    'title' => gettext_noop('Logout'),
                    'label' => gettext_noop('Logout'),
                    'route' => 'authentication/logout',
                    'materialIcon' => 'exit_to_app',
                    'fontawesomeIcon' => 'fas fa-sign-out-alt',
                    'order' => 10000,
                ],

                'admin' => [
                    'materialIcon' => 'build',
                    'fontawesomeIcon' => 'icon fas fa-tools',
                ],
                

                'syshelper-frontend' => [
                    'title' => gettext_noop('Syshelper Dashboard'),
                    'label' => gettext_noop('Syshelper Dashboard'),
                    'route' => 'syshelper-frontend/dashboard',
                    'fontawesomeIcon' => 'fas fa-columns',
                    'materialIcon' => 'dashboard',
                    'order' => 0,
                    'pages' => [
                        'dashboard' => [
                            'title' => gettext_noop('Dashboard'),
                            'label' => gettext_noop('Dashboard'),
                            'route' => 'syshelper-frontend/dashboard',
                            'fontawesomeIcon' => 'fas fa-columns',
                            'materialIcon' => 'dashboard',
                            'order' => 0,
                            'pages' => [
                                'update' => [
                                    'route' => 'syshelper-frontend/dashboard/quickSearch',
                                    'visible' => false,
                                ],
                            ]
                        ],
                        'ip-subnet' => [
                            'title' => gettext_noop('IP Subnets'),
                            'label' => gettext_noop('IP Subnets'),
                            'route' => 'syshelper-frontend/ip-subnet/list',
                            'fontawesomeIcon' => 'fas fa-columns',
                            'materialIcon' => 'settings_ethernet',
                            'order' => 0,
                            'pages' => [
                                'show' => [
                                    'route' => 'syshelper-frontend/ip-subnet/show',
                                    'visible' => false,
                                ],
                                'update' => [
                                    'route' => 'syshelper-frontend/ip-subnet/update',
                                    'visible' => false,
                                ],
                            ]
                        ],
                        'assigned-ip' => [
                            'title' => gettext_noop('Assigned IPs'),
                            'label' => gettext_noop('Assigned IPs'),
                            'route' => 'syshelper-frontend/assigned-ip/list',
                            'fontawesomeIcon' => 'fas fa-columns',
                            'materialIcon' => 'assignment_turned_in',
                            'order' => 0,
                            'pages' => [
                                'update' => [
                                    'route' => 'syshelper-frontend/assigned-ip/update',
                                    'visible' => false,
                                ],
                                'scan' => [
                                    'route' => 'syshelper-frontend/assigned-ip/scan',
                                    'visible' => false,
                                ],
                            ]
                        ],
                        'reachable-ip' => [
                            'title' => gettext_noop('Reachable IPs'),
                            'label' => gettext_noop('Reachable IPs'),
                            'route' => 'syshelper-frontend/reachable-ip/list',
                            'fontawesomeIcon' => 'fas fa-columns',
                            'materialIcon' => 'assignment_turned_in',
                            'order' => 0,
                            'pages' => [
                                'update' => [
                                    'route' => 'syshelper-frontend/reachable-ip/update',
                                    'visible' => false,
                                ],
                            ]
                        ],
                        'host' => [
                            'title' => gettext_noop('Hosts'),
                            'label' => gettext_noop('Hosts'),
                            'route' => 'syshelper-frontend/host/list',
                            'fontawesomeIcon' => 'fas fa-columns',
                            'materialIcon' => 'dns',
                            'order' => 0,
                            'pages' => [
                                'show' => [
                                    'route' => 'syshelper-frontend/host/show',
                                    'visible' => false,
                                ],
                                'update' => [
                                    'route' => 'syshelper-frontend/host/update',
                                    'visible' => false,
                                ],
                            ]
                        ],
                        'ssh-public-key' => [
                            'title' => gettext_noop('Ssh Keys'),
                            'label' => gettext_noop('Ssh Keys'),
                            'route' => 'syshelper-frontend/ssh-public-key/list',
                            'fontawesomeIcon' => 'fas fa-columns',
                            'materialIcon' => 'vpn_key',
                            'order' => 0,
                            'pages' => [
                                'ssh-public-key' => [
                                    'title' => gettext_noop('List keys'),
                                    'label' => gettext_noop('List keys'),
                                    'route' => 'syshelper-frontend/ssh-public-key/list',
                                    'order' => 0,
                                    'pages' => [
                                        'show' => [
                                            'route' => 'syshelper-frontend/ssh-public-key/show',
                                            'visible' => false,
                                        ],
                                        'create' => [
                                            'route' => 'syshelper-frontend/ssh-public-key/create',
                                            'visible' => false,
                                        ],
                                        'update' => [
                                            'route' => 'syshelper-frontend/ssh-public-key/update',
                                            'visible' => false,
                                        ],
                                    ]
                                ],
                                'ssh-logins' => [
                                    'title' => gettext_noop('Latest logins'),
                                    'label' => gettext_noop('Latest logins'),
                                    'route' => 'syshelper-frontend/ssh-public-key/logins',
                                    'order' => 0,
                                    'pages' => [
                                    ]
                                ],
                                'ssh-access' => [
                                    'title' => gettext_noop('Access'),
                                    'label' => gettext_noop('Access'),
                                    'route' => 'syshelper-frontend/ssh-public-key/access',
                                    'order' => 0,
                                    'pages' => [
                                        'create' => [
                                            'route' => 'syshelper-frontend/ssh-public-key/access-create',
                                            'visible' => false,
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        'syshelper-tag' => [
                            'title' => gettext_noop('Tags'),
                            'label' => gettext_noop('Tags'),
                            'route' => 'syshelper-frontend/syshelper-tag/list',
                            'fontawesomeIcon' => 'fas fa-columns',
                            'materialIcon' => 'local_offer',
                            'order' => 0,
                        ],
                    ],
                ],
            ],  
            'logo' => [
                "src-dark" => "",
                "src-bright" => "",
                "title" => "syshelper",
                "alt" => "syshelper",
            ],
            'page-layout' => [
                'layouts' => [
                    [
                        'prefix'    => 'syshelper-frontend',
                        'priority'  => 100,
                        'template'  => 'layout/altair',
                    ],
                    [
                        'prefix'    => 'sysModOverview',
                        'priority'  => 100,
                        'template'  => 'layout/altair',
                    ],
                    [
                        'prefix'    => 'authentication/login',
                        'priority'  => 150,
                        'template'  => 'layout/altair_login',
                    ],
                    [
                        'prefix'    => '',
                        'priority'  => 0,
                        'template'  => 'layout/layout_sidebar_two',
                    ],
                    [
                        'prefix'    => null,
                        'priority'  => 10,
                        'template'  => 'layout/altair_error',
                    ],
                    [
                        'prefix'    => 'authentication-mail-forgot-password',
                        'priority'  => 150,
                        'template'  => 'layout/altair_login',
                    ],
                ],
                'errorLayouts' => [
                    [
                        'prefix'    => "",
                        'priority'  => 10,
                        'template'  => 'layout/altair_error',
                    ],
                    [
                        'prefix'    => null,
                        'priority'  => 10,
                        'template'  => 'layout/altair_error',
                    ],
                ],
            ],
        ],
    ],

    'router' => [
        'routes' => [
            'handle-login-redirect' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\RedirectController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'syshelper-frontend' => [
                'type'    => Placeholder::class,
                'child_routes' => [
                    'dashboard' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/dashboard',
                            'defaults' => [
                                'controller' => Controller\IndexController::class,
                                'action'     => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'quickSearch' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/quick-search',
                                    'defaults' => [
                                        'action' => 'quickSearch',
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
                            'alert-type-acknowledge' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/alert-type-acknowledge',
                                    'defaults' => [
                                        'action' => 'alertTypeAcknowledge',
                                    ],
                                ],
                            ],
                            'alert-type-show' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/alert-type-show',
                                    'defaults' => [
                                        'action' => 'alertTypeShow',
                                    ],
                                ],
                            ],
                            'alert-type-mute' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/alert-type-mute',
                                    'defaults' => [
                                        'action' => 'alertTypeMute',
                                    ],
                                ],
                            ],
                            'alert-acknowledge-toggle' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/alert-acknowledge-toggle/:id',
                                    'defaults' => [
                                        'action' => 'alertAcknowledgeToggle',
                                    ],
                                    'constraints' => [
                                        'id' => '[0-9a-f-]+',
                                    ],
                                ],
                            ],
                            'alert-mute-toggle' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/alert-mute-toggle/:id',
                                    'defaults' => [
                                        'action' => 'alertMuteToggle',
                                    ],
                                    'constraints' => [
                                        'id' => '[0-9a-f-]+',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'assigned-ip' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/assigned-ip',
                            'defaults' => [
                                'controller' => Controller\AssignedIpController::class,
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
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
                            'update' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/update/:id',
                                    'defaults' => [
                                        'action' => 'update',
                                    ],
                                    'constraints' => [
                                        'id' => '[0-9a-f-]+',
                                    ],
                                ],
                            ],
                            'scan' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/scan/:id',
                                    'defaults' => [
                                        'action' => 'scan',
                                    ],
                                    'constraints' => [
                                        'id' => '[0-9a-f-]+',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'reachable-ip' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/reachable-ip',
                            'defaults' => [
                                'controller' => Controller\ReachableIpController::class,
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
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
                            'update' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/update/:id',
                                    'defaults' => [
                                        'action' => 'update',
                                    ],
                                    'constraints' => [
                                        'id' => '[0-9a-f-]+',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'host' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/host',
                            'defaults' => [
                                'controller' => Controller\HostController::class,
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
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
                            'update' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/update/:id',
                                    'defaults' => [
                                        'action' => 'update',
                                    ],
                                    'constraints' => [
                                        'id' => '[0-9a-f-]+',
                                    ],
                                ],
                            ],
                            'show' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/show/:id',
                                    'defaults' => [
                                        'action' => 'show',
                                    ],
                                    'constraints' => [
                                        'id' => '[0-9a-f-]+',
                                    ],
                                ],
                            ],
                            'remove' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/remove/:id',
                                    'defaults' => [
                                        'action' => 'remove',
                                    ],
                                    'constraints' => [
                                        'id' => '[0-9a-f-]+',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'ssh-public-key' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/ssh-public-key',
                            'defaults' => [
                                'controller' => Controller\SshPublicKeyController::class,
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'list' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/list',
                                    'defaults' => [
                                        'action' => 'list',
                                    ],
                                ],
                            ],
                            'create' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/create',
                                    'defaults' => [
                                        'action' => 'create',
                                    ],
                                ],
                            ],
                            'update' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/update/:id',
                                    'defaults' => [
                                        'action' => 'update',
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
                            'logins' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/logins',
                                    'defaults' => [
                                        'action' => 'logins',
                                    ],
                                ],
                            ],
                            'loginsAjax' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/loginsAjax',
                                    'defaults' => [
                                        'action' => 'loginsAjax',
                                    ],
                                ],
                            ],
                            'access' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/access',
                                    'defaults' => [
                                        'action' => 'access',
                                    ],
                                ],
                            ],
                            'accessAjax' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/accessAjax',
                                    'defaults' => [
                                        'action' => 'accessAjax',
                                    ],
                                ],
                            ],
                            'access-create' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/access-create',
                                    'defaults' => [
                                        'action' => 'access-create',
                                    ],
                                ],
                            ],
                            'access-renew' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/access-renew/:id',
                                    'defaults' => [
                                        'action' => 'access-renew',
                                    ],
                                ],
                            ],
                            'access-remove' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/access-remove/:id',
                                    'defaults' => [
                                        'action' => 'access-remove',
                                    ],
                                ],
                            ],
                            'show' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/show/:id',
                                    'defaults' => [
                                        'action' => 'show',
                                    ],
                                    'constraints' => [
                                        'id' => '[0-9a-f-]+',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'ip-subnet' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/ip-subnet',
                            'defaults' => [
                                'controller' => Controller\IpSubnetController::class,
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
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
                            'toggle-is-dynamic' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/toggle-is-dynamic/:id',
                                    'defaults' => [
                                        'action' => 'toggleIsDynamic',
                                    ],
                                    'constraints' => [
                                        'id' => '[0-9a-f-]+',
                                    ],
                                ],
                            ],
                            'update' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/update/:id',
                                    'defaults' => [
                                        'action' => 'update',
                                    ],
                                    'constraints' => [
                                        'id' => '[0-9a-f-]+',
                                    ],
                                ],
                            ],
                            'show' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/show/:id',
                                    'defaults' => [
                                        'action' => 'show',
                                    ],
                                    'constraints' => [
                                        'id' => '[0-9a-f-]+',
                                    ],
                                ],
                            ],
                            'remove' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/remove/:id',
                                    'defaults' => [
                                        'action' => 'remove',
                                    ],
                                    'constraints' => [
                                        'id' => '[0-9a-f-]+',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'syshelper-tag' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/syshelper-tag',
                            'defaults' => [
                                'controller' => Controller\SyshelperTagController::class,
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
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
                            'create' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/create',
                                    'defaults' => [
                                        'action' => 'create',
                                    ],
                                ],
                            ],
                            'update' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/update/:id',
                                    'defaults' => [
                                        'action' => 'update',
                                    ],
                                    'constraints' => [
                                        'id' => '[0-9a-f-]+',
                                    ],
                                ],
                            ],
                            'delete' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/delete/:id',
                                    'defaults' => [
                                        'action' => 'delete',
                                    ],
                                    'constraints' => [
                                        'id' => '[0-9a-f-]+',
                                    ],
                                ],
                            ],
                        ],
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

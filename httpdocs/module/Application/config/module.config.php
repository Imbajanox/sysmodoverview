<?php
/*
  This configuration handles project or application (but never environment) specific properties.
  You can and should adjust it to your needs.
  The other code in this module is also free to be changed and adjusted as you wish.
  Although, application logic and services should be developed in a separate module, especially for bigger projects.
*/

namespace Application;

use Laminas\Router\Http\Literal;
use WirklichDigital\SystemTranslation\Module as SystemTranslation;
use WirklichDigital\AdminBase\Module as AdminBase;

gettext_noop('Invokable Syshelper');

return [
    'translator' => [
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__ .  '/../language',
                'pattern'  => '%s.mo',
            ],
        ],
    ],

    'wirklich-digital' => [
        SystemTranslation::CONFIG_KEY => [
            'locales' => [
                'de' => 'de_DE',
                'en' => 'en_GB',
            ],
            'defaultLocale' => 'de_DE',
        ],
        AdminBase::CONFIG_KEY => [
            'head-title' => [
                'separators' => [
                    [
                        'prefix' => '',
                        'priority' => -1000,
                        'separator' => ' - ',
                    ]
                ],
                'titles' => [
                    [
                        'prefix' => '',
                        'priority' => 1000,
                        'title' => gettext_noop('Syshelper'), // Changes this
                    ],
                ],
            ],

            'navigation' => [
                'logout' => [
                    'title' => gettext_noop('Logout'),
                    'label' => gettext_noop('Logout'),
                    'route' => 'authentication/logout',
                    'class' => 'icon fas fa-sign-out-alt',
                    'order' => 10000,
                ],
            ],
        ],
    ],

    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];

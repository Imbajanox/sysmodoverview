<?php
/*
  This configuration handles project or application (but never environment) specific authorization (ACL) rights.
  The configuration represents the most common use cases of this framework. You can and should adjust it to your needs.
  This module contains just this configuration and it is not required. It just makes starting your project easier.
  You can move this configuration to other modules.
  You can extend this configuration in other modules.
*/

namespace ApplicationAuthorization;

return [
    'wirklich-digital' => [
        'authorization' => [
            'roles' => [
                [ // guest user (without Login)
                    'roleId' => 'guest',
                    'priority' => 1,
                    'parents' => [],
                ],
                [ // general user
                    'roleId' => 'user',
                    'priority' => 100,
                    'parents' => [],
                ],
                [ // administrator
                    'roleId' => 'admin',
                    'priority' => 50,
                    'parents' => ['user'],
                ],
            ],

            'rules' => [
                // guest rules
                [
                    'roleId' => 'guest',
                    'resource' => 'wirklich-digital/route/authentication/login',
                    'privilege' => null,
                    'allow' => true,
                ],
                [
                    'roleId' => 'guest',
                    'resource' => 'wirklich-digital/route/close-popup',
                    'privilege' => null,
                    'allow' => true,
                ],
                [
                    'roleId' => 'guest',
                    'resource' => 'wirklich-digital/route/confirm-popup',
                    'privilege' => null,
                    'allow' => true,
                ],
                [
                    'roleId' => 'guest',
                    'resource' => 'wirklich-digital/route/authentication-mail-forgot-password',
                    'privilege' => null,
                    'allow' => true,
                ],
                [
                    'roleId' => 'guest',
                    'resource' => 'wirklich-digital/route/messagehub-connector-callback',
                    'privilege' => null,
                    'allow' => true,
                ],
                [
                    'roleId' => 'guest',
                    'resource' => 'wirklich-digital/route/data-sink',
                    'privilege' => null,
                    'allow' => true,
                ],

                // user rules
                [
                    'roleId' => 'user',
                    'resource' => 'wirklich-digital/route/authentication/logout',
                    'privilege' => null,
                    'allow' => true,
                ],
                [
                    'roleId' => 'user',
                    'resource' => 'wirklich-digital/route/authentication/login-successful',
                    'privilege' => null,
                    'allow' => true,
                ],
                [
                    'roleId' => 'user',
                    'resource' => 'wirklich-digital/route/home',
                    'privilege' => null,
                    'allow' => true,
                ],
                [
                    'roleId' => 'user',
                    'resource' => 'entity-translation/form-show-compared-locale',
                    'privilege' => null,
                    'allow' => true,
                ],
                [
                    'roleId' => 'user',
                    'resource' => 'wirklich-digital/route/datatables',
                    'privilege' => null,
                    'allow' => true,
                ],
                [
                    'roleId' => 'user',
                    'resource' => 'wirklich-digital/route/close-popup',
                    'privilege' => null,
                    'allow' => true,
                ],
                [
                    'roleId' => 'user',
                    'resource' => 'wirklich-digital/route/confirm-popup',
                    'privilege' => null,
                    'allow' => true,
                ],

                // admin rules
                [ // The admin can do everything
                    'roleId' => 'admin',
                    'resource' => null,
                    'privilege' => null,
                    'allow' => true,
                ],
                [ // except deleting themselves by default
                    'roleId' => 'admin',
                    'resource' => 'wirklich-digital/role/admin',
                    'privilege' => 'deleteUser',
                    'allow' => false,
                ],

                /*
                // Uncomment this when you do no longer need the admin user management tool
                // This disables the default admin user management tool.
                // This tool is not well suited for productive use.
                [
                    'roleId' => 'admin',
                    'resource' => 'wirklich-digital/route/admin-user-management',
                    'privilege' => null,
                    'allow' => false,
                ],
                */
            ],
        ],
    ],
];

<?php

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => [
                    'host'     => 'localhost',
                    'port'     => '',
                    'user' => 'app_user',
                    'password' => 'ba781a29',
                    'dbname' => 'syshelper',
                ],
            ],
        ],
        'configuration' => [
            'orm_default' => [
                'metadata_cache' => 'array',
                'query_cache'    => 'array',
            ],
        ],
    ],
];

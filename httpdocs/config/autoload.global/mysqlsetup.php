<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Darsyn\IP\Doctrine\MultiType;
use DoctrineExtensions\Query\Mysql\GroupConcat;
use DoctrineExtensions\Query\Mysql\IfElse;
use DoctrineExtensions\Query\Mysql\IfNull;
use DoctrineExtensions\Query\Mysql\Inet6Ntoa;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDO\MySQL\Driver::class,
                'params' => [
                    'charset' => 'utf8',
                    'driverOptions' => [
                        1002 => 'SET NAMES utf8',
                    ],
                ],
            ],
        ],
        'cache' => [
            'wirklich-digital' => [
                'instance' => 'doctrine', // Name of the cache pool instance
            ],
        ],
        'configuration' => [
            'orm_default' => [
                'metadata_cache' => 'wirklich-digital',
                'query_cache'    => 'wirklich-digital',
                'types' => [
                    "ip" => MultiType::class
                ],
                'string_functions' => [
                    'group_concat' => GroupConcat::class,
                    'if' => IfElse::class,
                    'ifnull' => IfNull::class,
                    'inet6_ntoa' => Inet6Ntoa::class,
                ]
            ],
        ]
    ],
];

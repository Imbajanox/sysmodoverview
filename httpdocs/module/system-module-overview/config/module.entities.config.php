<?php

namespace WirklichDigital\SystemModuleOverview;

use WirklichDigital\DynamicEntityTimestampableModule\Entity\TimestampableInterface;
use WirklichDigital\SyshelperAlerts\Entity\Alert;

return [
    Entity\LaminasSystem::class => [
        'metadata_definition' => [
            'id' => [
                'id' => [
                    'type' => 'uuid',
                    'generator' => ['strategy' => "CUSTOM"],
                    'custom-id-generator' => ['class' => "Ramsey\\Uuid\\Doctrine\\UuidGenerator"],
                ],
            ],
            'fields' => [
                'repositoryName' => [
                    'type' => 'string',
                ],
                'repository' => [
                    'type' => 'string',
                ]
            ],
            'oneToMany' => [
                'laminasSystemServer' => [
                    'targetEntity' => Entity\LaminasSystemServer::class,
                    'mappedBy' => 'laminasSystem',
                ],
            ],
        ],
    ],
    // Alert::class => [
    //     'metadata_definition' => [
    //         'oneToOne' => [
    //             'laminasSystemServer' => [
    //                 'targetEntity' => Entity\LaminasSystemServer::class,
    //                 'inversedBy' => 'alert',
    //             ],
    //         ],
    //     ],
    // ],
    Entity\LaminasSystemServer::class => [
        'extra' => [
            TimestampableInterface::class => [],
                    ],
        'metadata_definition' => [
            'id' => [
                'id' => [
                    'type' => 'integer',
                    'generator' => [
                        'strategy' => 'AUTO'
                    ],
                ],
            ],
            'fields' => [
                'url' => [
                    'type' => 'string',
                    "nullable" => true,
                ],
                'ipAddress' => [
                    'type' => 'string',
                ],
                'phpinfo' => [
                    'type' => 'string',
                    "nullable" => true,
                ],
                'config' => [
                    'type' => 'string',
                    "nullable" => true,
                ],
                'j77Config' => [
                    'type' => 'text',
                    "nullable" => true,
                ],
                'phpVersion' => [
                    'type' => 'string',
                    "nullable" => true,
                ],
                'isDeinPim' => [
                    'type' => 'boolean',
                    "nullable" => true,
                ],
                'isDevelopment' => [
                    'type' => 'boolean',
                    "nullable" => true,
                ],
                'hasMinorUpdates' => [
                    'type' => 'boolean',
                    "nullable" => true,
                ],
                'hasMajorUpdates' => [
                    'type' => 'boolean',
                    "nullable" => true,
                ],
                'hasWirklichDigitalMinorUpdates' => [
                    'type' => 'boolean',
                    "nullable" => true,
                ],
                'hasWirklichDigitalMajorUpdates' => [
                    'type' => 'boolean',
                    "nullable" => true,
                ],
                'lastUpdateValue' => [
                    'type' => 'integer',
                    "nullable" => true,
                ],
            ],
            'manyToMany' => [
                'laminasSystemServerModule' => [
                    'targetEntity' => Entity\LaminasSystemServerModule::class,
                    'mappedBy' => 'laminasSystemServer',
                ],
            ],
            'oneToMany' => [
                'laminasSystemServerDatabaseInfo' => [
                    'targetEntity' => Entity\LaminasSystemServerDatabaseInfo::class,
                    'mappedBy' => 'laminasSystemServer',
                ],
                'laminasSystemServerMigrationInfo' => [
                    'targetEntity' => Entity\LaminasSystemServerMigrationInfo::class,
                    'mappedBy' => 'laminasSystemServer',
                ],
                'laminasSystemServerComposerOutdated' => [
                    'targetEntity' => Entity\LaminasSystemServerComposerOutdated::class,
                    'mappedBy' => 'laminasSystemServer',
                ],
                'npmModules' => [
                    'targetEntity' => Entity\NpmModules::class,
                    'mappedBy' => 'laminasSystemServer',
                ],
            ],
            'manyToOne' => [
                'laminasSystem' => [
                    'targetEntity' => Entity\LaminasSystem::class,
                    'inversedBy' => 'laminasSystemServer',
                ],
            ],
            // 'oneToOne' => [
            //     'alert' => [
            //         'targetEntity' => Alert::class,
            //         'mappedBy' => 'laminasSystemServer',
            //     ],
            // ],
        ],
    ],
    Entity\ComposerModule::class => [
        'metadata_definition' => [
            'id' => [
                'id' => [
                    'type' => 'integer',
                    'generator' => [
                        'strategy' => 'AUTO'
                    ],
                ],
            ],
            'fields' => [
                'vendor' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'name' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'systems' => [
                    'type' => 'integer',
                    'nullable' => true,
                ],
                'upToDate' => [
                    'type' => 'integer',
                    'nullable' => true,
                ],
                'outdated' => [
                    'type' => 'integer',
                    'nullable' => true,
                ],
            ],
            'oneToMany' => [
                'laminasSystemServerModule' => [
                    'targetEntity' => Entity\LaminasSystemServerModule::class,
                    'mappedBy' => 'composerModule',
                ],
                'laminasSystemServerComposerOutdated' => [
                    'targetEntity' => Entity\LaminasSystemServerComposerOutdated::class,
                    'mappedBy' => 'composerModule',
                ],
            ],
        ],
    ],
    Entity\NpmModules::class => [
        'metadata_definition' => [
            'id' => [
                'id' => [
                    'type' => 'integer',
                    'generator' => [
                        'strategy' => 'AUTO'
                    ],
                ],
            ],
            'fields' => [
                'name' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'module' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'installedVersion' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'wantedVersion' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'latestVersion' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dependencies' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'location' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
            ],
            'manyToOne' => [
                'laminasSystemServer' => [
                    'targetEntity' => Entity\LaminasSystemServer::class,
                    'inversedBy' => 'npmModules',
                ],
            ],
        ],
    ],
    Entity\LaminasSystemServerModule::class => [
        'repository_functions' => [ 
            'aliases' => [
                'getModuleData' => Repository\Functions\GetModuleData::class,
            ],
            'invokables' => [
                Repository\Functions\GetModuleData::class,
            ]
        ],
        'metadata_definition' => [
            'id' => [
                'id' => [
                    'type' => 'integer',
                    'generator' => [
                        'strategy' => 'AUTO'
                    ],
                ],
            ],
            'fields' => [
                'moduleName' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'moduleVersion' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'moduleVersionNormalized' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'moduleSource' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleDist' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleRequire' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleConflict' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleProvide' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleReplace' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleRequiredev' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleSuggest' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleTime' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'moduleBin' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleType' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'moduleExtra' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleInstallationsource' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'moduleAutoload' => [
                    'type' => 'json',

                    'nullable' => true,
                ],
                'moduleAutoloaddev' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleScripts' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleNotificationurl' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'moduleLicense' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleIncludepath' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleAuthors' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleDescription' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'moduleHomepage' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'moduleKeywords' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleSupport' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleFunding' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'moduleAbandoned' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'moduleInstallpath' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
            ],
            'manyToMany' => [
                'laminasSystemServer' => [
                    'targetEntity' => Entity\LaminasSystemServer::class,
                    'inversedBy' => 'laminasSystemServerModule',
                ],
            ],
            'manyToOne' => [
                'composerModule' => [
                    'targetEntity' => Entity\ComposerModule::class,
                    'inversedBy' => 'laminasSystemServerModule',
                ],
            ],
        ],
    ],
    Entity\LaminasSystemServerDatabaseInfo::class => [
        'metadata_definition' => [
            'id' => [
                'id' => [
                    'type' => 'integer',
                    'generator' => [
                        'strategy' => 'AUTO'
                    ],
                ],
            ],
            'fields' => [
                'dbName' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbEngine' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbVersion' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbRowFormat' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbRows' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbAvgRowLength' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbDataLength' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbMaxDataLength' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbIndexLength' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbDataFree' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbAutoIncrement' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbCreateTime' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbUpdateTime' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbCheckTime' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbCollation' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbChecksum' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbCreateOptions' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbComment' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbMaxIndexLength' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'dbTemporary' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
            ],
            'manyToOne' => [
                'laminasSystemServer' => [
                    'targetEntity' => Entity\LaminasSystemServer::class,
                    'inversedBy' => 'laminasSystemServerDatabaseInfo',
                ],
            ],
        ],
    ],
    Entity\LaminasSystemServerMigrationInfo::class => [
        'metadata_definition' => [
            'id' => [
                'id' => [
                    'type' => 'integer',
                    'generator' => [
                        'strategy' => 'AUTO'
                    ],
                ],
            ],
            'fields' => [
                'databaseDetails' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'versions' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
                'migrationDetails' => [
                    'type' => 'json',
                    'nullable' => true,
                ],
            ],
            'manyToOne' => [
                'laminasSystemServer' => [
                    'targetEntity' => Entity\LaminasSystemServer::class,
                    'inversedBy' => 'laminasSystemServerMigrationInfo',
                ],
            ],
        ],
    ],
    Entity\LaminasSystemServerComposerOutdated::class => [
        'metadata_definition' => [
            'id' => [
                'id' => [
                    'type' => 'integer',
                    'generator' => [
                        'strategy' => 'AUTO'
                    ],
                ],
            ],
            'fields' => [
                'name' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'version' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'latest' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'latestStatus' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
                'description' => [
                    'type' => 'string',
                    'nullable' => true,
                ],
            ],
            'manyToOne' => [
                'laminasSystemServer' => [
                    'targetEntity' => Entity\LaminasSystemServer::class,
                    'inversedBy' => 'laminasSystemServerComposerOutdated',
                ],
                'composerModule' => [
                    'targetEntity' => Entity\ComposerModule::class,
                    'inversedBy' => 'laminasSystemServerComposerOutdated',
                ],
            ],
        ],
    ],
];

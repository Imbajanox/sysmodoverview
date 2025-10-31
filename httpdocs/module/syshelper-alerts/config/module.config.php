<?php
namespace WirklichDigital\SyshelperAlerts;

use WirklichDigital\DynamicEntityTimestampableModule\Entity\TimestampableInterface;
use WirklichDigital\SyshelperBase\Entity\AssignedIp;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SyshelperBase\Entity\IpSubnet;
use WirklichDigital\SyshelperBase\Entity\ReachableIp;

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
            Service\AlertService::class => Service\Factory\AlertServiceFactory::class,
        ],
    ],

    'controllers' => [
        'factories' => [
        ],
    ],

    'asset_manager' => [
        'resolver_configs' => [
            'aliases' => [
                'assets/syshelper-alerts/' => __DIR__ . '/../assets/',
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
                CronTask\AptErrorTask::class => [
                    'defaults' => [
                        'cronString' => '* * * * *',
                        'autoRestartAfter' => '120',
                    ],
                ],
                CronTask\ExternalIpV4IsEmptyTask::class => [
                    'defaults' => [
                        'cronString' => '* * * * *',
                        'autoRestartAfter' => '600',
                    ],
                ],
                CronTask\HostMissedUpdatesTask::class => [
                    'defaults' => [
                        'cronString' => '* * * * *',
                        'autoRestartAfter' => '900',
                    ],
                ],
                CronTask\HostVulnerablePackagesTask::class => [
                    'defaults' => [
                        'cronString' => '* * * * *',
                        'autoRestartAfter' => '600',
                    ],
                ],
                CronTask\LastConnectionLongAgoTask::class => [
                    'defaults' => [
                        'cronString' => '* * * * *',
                        'autoRestartAfter' => '600',
                    ],
                ],
                CronTask\MailqTask::class => [
                    'defaults' => [
                        'cronString' => '* * * * *',
                        'autoRestartAfter' => '600',
                    ],
                ],
                CronTask\OpenPortsTask::class => [
                    'defaults' => [
                        'cronString' => '* * * * *',
                        'autoRestartAfter' => '360',
                    ],
                ],
                CronTask\PleskBackupHasErrorTask::class => [
                    'defaults' => [
                        'cronString' => '* * * * *',
                        'autoRestartAfter' => '300',
                    ],
                ],
                CronTask\NoPleskBackupTask::class => [
                    'defaults' => [
                        'cronString' => '* * * * *',
                        'autoRestartAfter' => '300',
                    ],
                ],
                CronTask\PuppetErrorTask::class => [
                    'defaults' => [
                        'cronString' => '* * * * *',
                        'autoRestartAfter' => '300',
                    ],
                ],
                CronTask\ReachableIpTask::class => [
                    'defaults' => [
                        'cronString' => '* * * * *',
                        'autoRestartAfter' => '120',
                    ],
                ],
                CronTask\ToDoTask::class => [
                    'defaults' => [
                        'cronString' => '* * * * *',
                        'autoRestartAfter' => '180',
                    ],
                ],
                CronTask\LastTransmissionOfModulesLongAgoTask::class => [ 
                    'defaults' => [
                        'cronString' => '* * * * *',
                        'autoRestartAfter' => '120',
                        'enabled' => true,
                    ],
                ],
            ],
            'plugin_manager' => [
                'factories' => [
                    CronTask\AptErrorTask::class => CronTask\Factory\GenericAlertTaskFactory::class,
                    CronTask\ExternalIpV4IsEmptyTask::class => CronTask\Factory\GenericAlertTaskFactory::class,
                    CronTask\HostMissedUpdatesTask::class => CronTask\Factory\GenericAlertTaskFactory::class,
                    CronTask\HostVulnerablePackagesTask::class => CronTask\Factory\GenericAlertTaskFactory::class,
                    CronTask\LastConnectionLongAgoTask::class => CronTask\Factory\GenericAlertTaskFactory::class,
                    CronTask\MailqTask::class => CronTask\Factory\GenericAlertTaskFactory::class,
                    CronTask\OpenPortsTask::class => CronTask\Factory\GenericAlertTaskFactory::class,
                    CronTask\NoPleskBackupTask::class => CronTask\Factory\GenericAlertTaskFactory::class,
                    CronTask\PleskBackupHasErrorTask::class => CronTask\Factory\GenericAlertTaskFactory::class,
                    CronTask\PuppetErrorTask::class => CronTask\Factory\GenericAlertTaskFactory::class,
                    CronTask\ReachableIpTask::class => CronTask\Factory\GenericAlertTaskFactory::class,
                    CronTask\ToDoTask::class => CronTask\Factory\GenericAlertTaskFactory::class,
                    CronTask\LastTransmissionOfModulesLongAgoTask::class => CronTask\Factory\GenericAlertTaskFactory::class,
                ],
            ],
        ],
        'dynamic-entity' => [
            'entities' => [
                Entity\Alert::class => [
                    'repository_functions' => [
                        'aliases' => [
                        ],
                        'invokables' => [
                        ],
                    ],
                    'extra' => [
                        TimestampableInterface::class => []
                    ],
                    'metadata_definition' => [
                        'id' => [
                            'id' => [
                                'type' => 'uuid',
                                'generator' => [ 'strategy' => "CUSTOM" ],
                                'custom-id-generator' => [ 'class' => "Ramsey\\Uuid\\Doctrine\\UuidGenerator" ],
                            ],
                        ],
                        'fields' => [

                            'name' => [
                                'type' => 'string'
                            ],

                            'description' => [
                                'type' => 'string',
                                'length' => 512,
                            ],

                            'lastSeenAt' => [
                                'type' => 'datetime',
                                'nullable' => true
                            ],

                            'cronjobClass' => [
                                'type' => 'string'
                            ],

                            'alertIdentifier' => [
                                'type' => 'string'
                            ],

                            'isAcknowledged' => [
                                'type' => 'boolean',
                                'options' => [
                                    'default' => 0
                                ]
                            ],

                            'isMuted' => [
                                'type' => 'boolean',
                                'options' => [
                                    'default' => 0
                                ]
                            ],
                        ],
                        'manyToOne' => [
                            'host' => [
                                'targetEntity' => Host::class,
                                'inversedBy' => 'alerts',
                            ],
                            'ipSubnet' => [
                                'targetEntity' => IpSubnet::class,
                                'inversedBy' => 'alerts',
                            ],
                            'assignedIp' => [
                                'targetEntity' => AssignedIp::class,
                                'inversedBy' => 'alerts',
                            ],
                            'reachableIp' => [
                                'targetEntity' => ReachableIp::class,
                                'inversedBy' => 'alerts',
                            ],
                        ],
                    ]
                ],
                Host::class => [
                    'metadata_definition' => [
                        'oneToMany' => [
                            'alerts' => [
                                'targetEntity' => Entity\Alert::class,
                                'mappedBy' => 'host',
                            ],
                        ]
                    ]
                ],
                AssignedIp::class => [
                    'metadata_definition' => [
                        'oneToMany' => [
                            'alerts' => [
                                'targetEntity' => Entity\Alert::class,
                                'mappedBy' => 'host',
                            ],
                        ]
                    ]
                ],
                IpSubnet::class => [
                    'metadata_definition' => [
                        'oneToMany' => [
                            'alerts' => [
                                'targetEntity' => Entity\Alert::class,
                                'mappedBy' => 'host',
                            ],
                        ]
                    ]
                ],
                ReachableIp::class => [
                    'metadata_definition' => [
                        'oneToMany' => [
                            'alerts' => [
                                'targetEntity' => Entity\Alert::class,
                                'mappedBy' => 'host',
                            ],
                        ]
                    ]
                ],
            ],
        ],
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

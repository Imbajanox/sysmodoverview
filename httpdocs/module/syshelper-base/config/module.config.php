<?php
namespace WirklichDigital\SyshelperBase;

use WirklichDigital\DynamicEntityBlameableModule\Entity\BlameableInterface;
use WirklichDigital\DynamicEntityTimestampableModule\Entity\TimestampableInterface;
use WirklichDigital\ReflectionBasedAbstractFactory\AbstractFactory\ReflectionBasedAbstractFactory;

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
            Service\HostRawFactsParsingService::class => ReflectionBasedAbstractFactory::class,
            Service\IpAssignmentService::class => ReflectionBasedAbstractFactory::class,
            Service\SshPublicKeyService::class => ReflectionBasedAbstractFactory::class,
            Command\PuppetSshAccessCommand::class => ReflectionBasedAbstractFactory::class,
            Command\MigrateCommand::class => ReflectionBasedAbstractFactory::class,
        ],
    ],

    'controllers' => [
        'factories' => [
        ],
    ],

    'asset_manager' => [
        'resolver_configs' => [
            'aliases' => [
                'assets/syshelper-base/' => __DIR__ . '/../assets/',
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
                CronTask\ImportIPRangesTask::class => [ 
                    'defaults' => [
                        'cronString' => '5 * * * *',
                        'autoRestartAfter' => '120',
                    ],
                ],
                CronTask\HostRawFactsParseTask::class => [ 
                    'defaults' => [
                        'cronString' => '* * * * *',
                        'autoRestartAfter' => '120',
                    ],
                ],
                CronTask\BlockUnusedSshAccessTask::class => [ 
                    'defaults' => [
                        'cronString' => '0 * * * *',
                        'autoRestartAfter' => '120',
                    ],
                ],
            ],
            'plugin_manager' => [ 
                'factories' => [
                    CronTask\ImportIPRangesTask::class => CronTask\Factory\ImportIPRangesTaskFactory::class,
                    CronTask\HostRawFactsParseTask::class => CronTask\Factory\HostRawFactsParseTaskFactory::class,
                    CronTask\BlockUnusedSshAccessTask::class => ReflectionBasedAbstractFactory::class,
                ],
            ],
        ],
        
        'cli' => [
            'commands' => [
                'syshelper:puppet-ssh-access' => Command\PuppetSshAccessCommand::class,
                'syshelper:migrate' => Command\MigrateCommand::class,
            ],
        ],
        'dynamic-entity' => [
            'entities' => [

                Entity\Host::class => [
                    'repository_functions' => [
                        'aliases' => [
                        ],
                        'invokables' => [
                        ],
                    ],
                    'extra' => [
                        TimestampableInterface::class => [],
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
                                'type' => 'string',
                                'nullable' => true
                            ],
                            
                            'syshelperDescription' => [
                                'type' => 'text',
                                'nullable' => true
                            ],
                            
                            'lastConnectionAt' => [
                                'type' => 'datetime',
                                'nullable' => true
                            ],
                            
                            'connectionIp' => [
                                'type' => 'ip',
                                'nullable' => true
                            ],
                            
                            'systemUuid' => [
                                'type' => 'string',
                                'nullable' => true
                            ],
                            
                            'scriptVersion' => [
                                'type' => 'string',
                                'nullable' => true
                            ],
                            
                            'fqdn' => [
                                'type' => 'string',
                                'nullable' => true
                            ],
                            
                            'externalIpV4' => [
                                'type' => 'string',
                                'nullable' => true
                            ],
                            
                            'externalIpV6' => [
                                'type' => 'string',
                                'nullable' => true
                            ],
                            
                            'nameservers' => [
                                'type' => 'json',
                                'nullable' => true
                            ],
                            
                            'interfaces' => [
                                'type' => 'json',
                                'nullable' => true
                            ],
                            
                            'servicesListening' => [
                                'type' => 'json',
                                'nullable' => true
                            ],
                            
                            'processesRunning' => [
                                'type' => 'json',
                                'nullable' => true
                            ],
                            
                            'puppetVersion' => [
                                'type' => 'string',
                                'nullable' => true
                            ],
                            
                            'puppetIsOK' => [
                                'type' => 'boolean',
                                'nullable' => true
                            ],
                            
                            'webserverVersionApache' => [
                                'type' => 'string',
                                'nullable' => true
                            ],
                            
                            'webserverVersionNginx' => [
                                'type' => 'string',
                                'nullable' => true
                            ],
                            
                            'webserverDomainsApache' => [
                                'type' => 'json',
                                'nullable' => true
                            ],
                            
                            'webserverDomainsNginx' => [
                                'type' => 'json',
                                'nullable' => true
                            ],
                            
                            'isVirtual' => [
                                'type' => 'boolean',
                                'nullable' => true
                            ],
                            
                            'cpuCores' => [
                                'type' => 'integer',
                                'nullable' => true
                            ],
                            
                            'cpuModel' => [
                                'type' => 'string',
                                'nullable' => true
                            ],
                            
                            'ramSizeKb' => [
                                'type' => 'integer',
                                'nullable' => true
                            ],
                            
                            'ramAvailableKb' => [
                                'type' => 'integer',
                                'nullable' => true
                            ],
                            
                            'disks' => [
                                'type' => 'json',
                                'nullable' => true
                            ],
                            
                            'osName' => [
                                'type' => 'string',
                                'nullable' => true
                            ],
                            
                            'osVersion' => [
                                'type' => 'string',
                                'nullable' => true
                            ],
                            
                            'kernelVersion' => [
                                'type' => 'string',
                                'length' => 512,
                                'nullable' => true
                            ],
                            
                            'packagesAptMirrors' => [
                                'type' => 'json',
                                'nullable' => true
                            ],
                            
                            'packagesAptHasRepoError' => [
                                'type' => 'boolean',
                                'nullable' => true
                            ],
                            
                            'packagesAptUpgradable' => [
                                'type' => 'json',
                                'nullable' => true
                            ],
                            
                            'packagesInstalled' => [
                                'type' => 'json',
                                'nullable' => true
                            ],
                            
                            'pleskVersion' => [
                                'type' => 'string',
                                'nullable' => true
                            ],
                            
                            'pleskBackupIsDone' => [
                                'type' => 'boolean',
                                'nullable' => true
                            ],
                            
                            'pleskBackupHasError' => [
                                'type' => 'boolean',
                                'nullable' => true
                            ],
                            
                            'mailqCount' => [
                                'type' => 'integer',
                                'nullable' => true
                            ],
                            
                            'proxmoxVersion' => [
                                'type' => 'string',
                                'nullable' => true
                            ],
                            
                            'uptimeSeconds' => [
                                'type' => 'integer',
                                'nullable' => true
                            ],

                        ],
                        'oneToMany' => [
                            'assignedIps' => [
                                'targetEntity' => Entity\AssignedIp::class,
                                'mappedBy' => 'host',
                                'cascade' => ['remove'],
                            ],
                            'rawFacts' => [
                                'targetEntity' => Entity\HostRawFact::class,
                                'mappedBy' => 'host',
                                'cascade' => ['remove'],
                            ],
                            'sshPublicKeyHostMappings' => [
                                'targetEntity' => Entity\SshPublicKeyHostMapping::class,
                                'mappedBy' => 'host',
                                'cascade' => ['remove'],
                            ],
                            'sshPublicKeyLogins' => [
                                'targetEntity' => Entity\SshPublicKeyLogin::class,
                                'mappedBy' => 'host',
                                'cascade' => ['persist', 'remove']
                            ],
                        ],
                        
                        'manyToMany' => [
                            'tags' => [
                                'targetEntity' => Entity\SyshelperTag::class,
                                'inversedBy' => 'hosts',
                            ],
                        ],
                                                
                    ]
                ],

                Entity\HostRawFact::class => [
                    'repository_functions' => [
                        'aliases' => [
                        ],
                        'invokables' => [
                        ],
                    ],
                    'extra' => [
                        TimestampableInterface::class => [],
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
                            
                            'type' => [
                                'type' => 'string'
                            ],
                            
                            'rawValue' => [
                                'type' => 'text',
                                'nullable' => true
                            ],
                            
                            'hasBeenParsed' => [
                                'type' => 'boolean',
                                'options' => [
                                    "default" => 0
                                ]
                            ],

                        ],
                        'manyToOne' => [
                            'host' => [
                                'targetEntity' => Entity\Host::class,
                                'inversedBy' => 'rawFacts',
                            ],
                        ],
                                                
                    ]
                ],

                Entity\AssignedIp::class => [
                    'repository_functions' => [
                        'aliases' => [
                        ],
                        'invokables' => [
                        ],
                    ],
                    'extra' => [
                        TimestampableInterface::class => [],
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
                            
                            'address' => [
                                'type' => 'ip'
                            ],
                            
                            'ptr' => [
                                'type' => 'string',
                                'nullable' => true
                            ],

                            'syshelperDescription' => [
                                'type' => 'text',
                                'nullable' => true
                            ],

                            'openPortsInternal' => [
                                'type' => 'json',
                                'nullable' => true,
                            ],
                            
                            'openPortsInternalLastScanAt' => [
                                'type' => 'datetime',
                                'nullable' => true,
                            ],
                            
                            'openPortsExternal' => [
                                'type' => 'json',
                                'nullable' => true,
                            ],
                            
                            'openPortsExternalLastScanAt' => [
                                'type' => 'datetime',
                                'nullable' => true,
                            ],

                        ],

                        'manyToOne' => [
                            'host' => [
                                'targetEntity' => Entity\Host::class,
                                'inversedBy' => 'assignedIps',
                            ],
                            'subnet' => [
                                'targetEntity' => Entity\IpSubnet::class,
                                'inversedBy' => 'assignedIps',
                            ],
                        ],
                        
                        'manyToMany' => [
                            'tags' => [
                                'targetEntity' => Entity\SyshelperTag::class,
                                'inversedBy' => 'assignedIps',
                            ],
                        ],
                        
                        'oneToOne' => [
                            'reachableIp' => [
                                'targetEntity' => Entity\ReachableIp::class,
                                'mappedBy' => 'assignedIp',
                            ],
                        ],
                                                
                    ]
                ],

                Entity\ReachableIp::class => [
                    'repository_functions' => [
                        'aliases' => [
                        ],
                        'invokables' => [
                        ],
                    ],
                    'extra' => [
                        TimestampableInterface::class => [],
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
                            
                            'address' => [
                                'type' => 'ip'
                            ],
                            
                            'ptr' => [
                                'type' => 'string',
                                'nullable' => true
                            ],

                        ],

                        'manyToOne' => [
                            'subnet' => [
                                'targetEntity' => Entity\IpSubnet::class,
                                'inversedBy' => 'reachableIps',
                            ],
                        ],
                        
                        'oneToOne' => [
                            'assignedIp' => [
                                'targetEntity' => Entity\AssignedIp::class,
                                'inversedBy' => 'reachableIp',
                            ],
                        ],
                                                
                    ]
                ],               

                Entity\IpSubnet::class => [
                    'repository_functions' => [
                        'aliases' => [
                        ],
                        'invokables' => [
                        ],
                    ],
                    'extra' => [
                        TimestampableInterface::class => [],
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
                            
                            'networkAddress' => [
                                'type' => 'ip'
                            ],
                            
                            'networkCidrMask' => [
                                'type' => 'integer'
                            ],
                            
                            'importSource' => [
                                'type' => 'string'
                            ],

                            'syshelperDescription' => [
                                'type' => 'text',
                                'nullable' => true
                            ],
                            
                            'externalUpIps' => [
                                'type' => 'json',
                                'nullable' => true
                            ],

                            'externalUpIpLastScanAt' => [
                                'type' => 'datetime',
                                'nullable' => true
                            ],

                            /**
                             * If true, this will:
                             * - Delete the subnet and its ip assignments, if the subnet is not included in the import data anymore
                             * - Delete hosts of the subnet, if they are only assigned to this subnet and the subnet is not included in the import data anymore
                             * - Display reachable IPs of this subnet as "OK", even if we do not have host data for them.
                             */
                            'isDynamic' => [
                                'type' => 'boolean',
                                'options' => [
                                    'comment' => 'Whether this subnet (or hosts that are connected to this subnet) are expected to appear for a short time only (e.g. metacloud or cloudcontrol instances).',
                                    'default' => 0
                                ]
                            ],

                            'isDynamicSetManually' => [
                                'type' => 'boolean',
                                'options' => [
                                    'comment' => 'Whether the "isDynamic"-status has been set manually and should not be updated in the future.',
                                    'default' => 0
                                ]
                            ]

                        ],

                        'oneToMany' => [
                            'assignedIps' => [
                                'targetEntity' => Entity\AssignedIp::class,
                                'mappedBy' => 'subnet',
                            ],
                            'reachableIps' => [
                                'targetEntity' => Entity\ReachableIp::class,
                                'mappedBy' => 'subnet',
                                'cascade' => ['persist', 'remove'],
                            ],
                        ],
                        
                        'manyToMany' => [
                            'tags' => [
                                'targetEntity' => Entity\SyshelperTag::class,
                                'inversedBy' => 'ipSubnets',
                            ],
                        ],
                                                
                    ]
                ],

                Entity\SyshelperTag::class => [
                    'repository_functions' => [
                        'aliases' => [
                        ],
                        'invokables' => [
                        ],
                    ],
                    'extra' => [
                        TimestampableInterface::class => [],
                        BlameableInterface::class => []
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

                            'color' => [
                                'type' => 'string'
                            ],
                            
                        ],

                        'manyToMany' => [
                            'hosts' => [
                                'targetEntity' => Entity\Host::class,
                                'mappedBy' => 'tags',
                            ],
                            'ipSubnets' => [
                                'targetEntity' => Entity\IpSubnet::class,
                                'mappedBy' => 'tags',
                            ],
                            'assignedIps' => [
                                'targetEntity' => Entity\AssignedIp::class,
                                'mappedBy' => 'tags',
                            ],
                        ],
                                                
                    ]
                ],

                Entity\SshPublicKey::class => [
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
                        'index' => [
                            'type_key' => [
                                'columns' => ['keyType', 'keyData'],
                            ],
                        ],
                        'fields' => [
                            'title' => [
                                'type' => 'string',
                                'nullable' => true
                            ],

                            'keyType' => [
                                'type' => 'string'
                            ],

                            'keyData' => [
                                'type' => 'string',
                                'length' => 4096
                            ],

                            'doNotTrackLogins' => [
                                'type' => 'boolean',
                                'options' => [
                                    'default' => 0
                                ]
                            ],

                            'fingerprint' => [
                                'type' => 'string',
                                'length' => 512
                            ],

                            'usergroup' => [
                                'type' => 'string',
                                'length' => 512
                            ],
                        ],

                        'oneToMany' => [
                            'hostMappings' => [
                                'targetEntity' => Entity\SshPublicKeyHostMapping::class,
                                'mappedBy' => 'sshPublicKey',
                                'cascade' => ['persist', 'remove'],
                            ],
                            'sshPublicKeyLogins' => [
                                'targetEntity' => Entity\SshPublicKeyLogin::class,
                                'mappedBy' => 'sshPublicKey',
                                'cascade' => ['persist', 'remove']
                            ],
                        ],
                                                
                    ]
                ],

                Entity\SshPublicKeyHostMapping::class => [
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
                            'userOnHost' => [
                                'type' => 'string',
                                'nullable' => true
                            ],
                            'comment' => [
                                'type' => 'string',
                                'nullable' => true,
                                'length' => 512
                            ],
                            'environment' => [
                                'type' => 'string',
                                'nullable' => true,
                                'length' => 512
                            ],
                        ],
                        'manyToOne' => [
                            'sshPublicKey' => [
                                'targetEntity' => Entity\SshPublicKey::class,
                                'inversedBy' => 'hostMappings',
                            ],
                            'host' => [
                                'targetEntity' => Entity\Host::class,
                                'inversedBy' => 'sshPublicKeyHostMappings',
                            ],
                        ],
                    ]
                ],

                Entity\SshPublicKeyHostAccess::class => [
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
                            'userOnHost' => [
                                'type' => 'string',
                                'nullable' => true
                            ],
                            'doNotBlockIfUnused' => [
                                'type' => 'boolean',
                                'nullable' => false,
                                'options' => [
                                    'default' => 0
                                ]
                            ],
                            'blockedBecauseUnused' => [
                                'type' => 'boolean',
                                'nullable' => false,
                                'options' => [
                                    'default' => 0
                                ]
                            ],
                        ],
                        'manyToOne' => [
                            'sshPublicKey' => [
                                'targetEntity' => Entity\SshPublicKey::class,
                                'inversedBy' => 'hostMappings',
                            ],
                            'host' => [
                                'targetEntity' => Entity\Host::class,
                                'inversedBy' => 'sshPublicKeyHostMappings',
                            ],
                        ],
                    ]
                ],

                Entity\SshPublicKeyLogin::class => [
                    'repository_functions' => [
                        'aliases' => [
                        ],
                        'invokables' => [
                        ],
                    ],
                    'extra' => [
                    ],
                    'metadata_definition' => [
                        'id' => [
                            'id' => [
                                'type' => 'uuid',
                                'generator' => [ 'strategy' => "CUSTOM" ],
                                'custom-id-generator' => [ 'class' => "Ramsey\\Uuid\\Doctrine\\UuidGenerator" ],
                            ],
                        ],
                        'index' => [
                            'loggedInAt' => [
                                'columns' => ['loggedInAt'],
                            ],
                        ],
                        'fields' => [
                            'user' => [
                                'type' => 'string',
                                'nullable' => true,
                                'length' => 32
                            ],
                            'ip' => [
                                'type' => 'ip',
                                'nullable' => true
                            ],
                            'loggedInAt' => [
                                'type' => 'datetime'
                            ],
                        ],
                        'manyToOne' => [
                            'host' => [
                                'targetEntity' => Entity\Host::class,
                                'mappedBy' => 'sshPublicKeyLogins'
                            ],
                            'sshPublicKey' => [
                                'targetEntity' => Entity\SshPublicKey::class,
                                'inversedBy' => 'sshPublicKeyLogins',
                            ],
                        ],
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

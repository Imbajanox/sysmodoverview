<?php

namespace WirklichDigital\SyshelperFrontend\Table\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\DataTables\Table\SimpleDataTable;
use WirklichDigital\DataTables\Column\Column;
use WirklichDigital\DataTables\Service\ColumnPluginManager;
use Doctrine\ORM\EntityManager;
use WirklichDigital\StdLib\ColorUtils\ColorCalculator;
use WirklichDigital\StdLib\FileUtils\HumanReadbleFilesize;
use WirklichDigital\SyshelperBase\Entity\Host;

class HostTableFactory implements FactoryInterface
{
    protected static $fullView = false;
    protected $router;

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);
        $em = $container->get(EntityManager::class);
        $this->router = $container->get('router');

        $query = $em->createQueryBuilder()
            ->select('h.id, h.name, h.syshelperDescription, h.lastConnectionAt, h.connectionIp, h.systemUuid, h.scriptVersion, h.fqdn, h.externalIpV4, h.externalIpV6, h.nameservers, h.interfaces, h.servicesListening, h.processesRunning, h.puppetVersion, h.puppetIsOK, h.webserverVersionApache, h.webserverVersionNginx, h.webserverDomainsApache, h.webserverDomainsNginx, h.isVirtual, h.cpuCores, h.cpuModel, h.ramSizeKb, h.ramAvailableKb, h.disks, h.osName, h.osVersion, h.kernelVersion, h.packagesAptMirrors, h.packagesAptHasRepoError, h.packagesAptUpgradable, h.packagesInstalled, h.pleskVersion, h.pleskBackupIsDone, h.pleskBackupHasError, h.mailqCount, h.proxmoxVersion, DATE_DIFF(CURRENT_DATE(),DATE_SUB(CURRENT_DATE(),h.uptimeSeconds,\'SECOND\')) uptimeDays, GROUP_CONCAT(t.name,\'|\', t.color) thetags')
            ->from(Host::class, 'h')
            ->leftJoin('h.tags', 't')
            ->groupBy('h.id');

        $columns = [];

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Fqdn'),
            'columnName' => 'h.fqdn',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        return '<a href="'.$this->router->assemble(['id' => $row['id']],['name' => 'syshelper-frontend/host/show','query' => []]).'" target="_blank">'.($row['fqdn']?$row['fqdn']:'ERROR: FQDN').'</a>';
                    }
                ],
            ]
        ]);

        $columns[] = $colManager->get('date', [
            'title' => gettext_noop('LastConnectionAt'),
            'columnName' => 'h.lastConnectionAt',
            'pattern' => 'yyyy-MM-dd HH:mm:ss',
        ]);

         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('SystemUuid'),
            'columnName' => 'h.systemUuid',
            'headAttributes' => [
                'visible' => false
            ]
        ]);

         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('ScriptVersion'),
            'columnName' => 'h.scriptVersion',
            'headAttributes' => [
                'visible' => false
            ]
        ]);

         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('ExternalIpV4'),
            'columnName' => 'h.externalIpV4',
            'headAttributes' => [
                'visible' => false
            ]
        ]);

         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('ExternalIpV6'),
            'columnName' => 'h.externalIpV6',
            'headAttributes' => [
                'visible' => false
            ]
        ]);

         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Nameservers'),
            'columnName' => 'h.nameservers',
            'headAttributes' => [
                'visible' => false
            ]
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Interfaces'),
            'columnName' => 'h.interfaces',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        if(empty($row['interfaces'])) return "";
                        
                        $ips = [];
                        foreach($row['interfaces'] as $interface)
                        {
                            foreach($interface as $ip)
                            {
                                $ips[] = '<span class="uk-badge '.( (($ip == $row['externalIpV4']) || ($ip == $row['externalIpV6']) )? '': 'uk-badge-muted').'">'.$ip.'</span>';
                                if(count($ips)%5 == 0) $ips[] = "<br/>";
                            }
                        }
                        return implode(' ',$ips); 
                    }
                ],
            ],
        ]);

         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('ServicesListening'),
            'columnName' => 'h.servicesListening',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        return 'Search-only';
                    }
                ],
            ],
            'headAttributes' => [
                'visible' => false
            ]
        ]);

        $columns[] = $colManager->get('default', [
           'title' => gettext_noop('ProcessesRunning'),
           'columnName' => 'h.processesRunning',
           'dataBuilder' => [
               'name'      => 'callback',
               'options'   => [
                   'callback' => function ($row) {
                      array_multisort( array_column($row['processesRunning'], "cpu_percent"), SORT_DESC, $row['processesRunning'] );
                      $i = 0;
                      $output = [];
                      foreach($row['processesRunning'] as $process)
                      {
                          if($i > 3) break;
                          if($process['cpu_percent'] > 50) $output[] = $process['process']." (".$process['cpu_percent']."%)";
                          $i++;
                      }

                      if(empty($output))
                        return "(searchable)";
                      else
                        return "Top Processes:<br/>".implode('<br/> ',$output).'<br/>(searchable)';
                   }
               ],
           ],
           'headAttributes' => [
               'visible' => false
           ]
       ]);


         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('PuppetVersion'),
            'columnName' => 'h.puppetVersion',
            'headAttributes' => [
                'visible' => false
            ]
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('PuppetIsOK (10n)'),
            'columnName' => 'h.puppetIsOK',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        if($row['puppetIsOK'] === null) return 'Puppet not installed';
                        if($row['puppetIsOK'] === true) return 'OK';
                        return 'ERROR';
                    }
                ],
            ],
            'headAttributes' => [
                'visible' => false
            ]
        ]);

         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('WebserverVersionApache'),
            'columnName' => 'h.webserverVersionApache',
            'headAttributes' => [
                'visible' => false
            ]
        ]);

         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('WebserverVersionNginx'),
            'columnName' => 'h.webserverVersionNginx',
            'headAttributes' => [
                'visible' => false
            ]
        ]);

         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('WebserverDomainsApache'),
            'columnName' => 'h.webserverDomainsApache',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        return 'Search-only';
                    }
                ],
            ],
            'headAttributes' => [
                'visible' => false
            ]
        ]);

         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('WebserverDomainsNginx'),
            'columnName' => 'h.webserverDomainsNginx',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        return 'Search-only';
                    }
                ],
            ],
            'headAttributes' => [
                'visible' => false
            ]
        ]);

         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('CpuCores'),
            'columnName' => 'h.cpuCores',
            'headAttributes' => [
                'visible' => false
            ]
        ]);

         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('CpuModel'),
            'columnName' => 'h.cpuModel',
            'headAttributes' => [
                'visible' => false
            ]
        ]);

         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('RamSizeKb'),
            'columnName' => 'h.ramSizeKb',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        return HumanReadbleFilesize::humanBytes($row['ramSizeKb']*1024);
                    }
                ],
            ],
            'headAttributes' => [
                'visible' => false
            ]
        ]);

        $columns[] = $colManager->get('default', [
           'title' => gettext_noop('RamAvailableKb'),
           'columnName' => 'h.ramAvailableKb',
           'dataBuilder' => [
               'name'      => 'callback',
               'options'   => [
                   'callback' => function ($row) {
                       return HumanReadbleFilesize::humanBytes($row['ramAvailableKb']*1024);
                   }
               ],
           ],
           'headAttributes' => [
               'visible' => false
           ]
       ]);

       $columns[] = $colManager->get('default', [
          'title' => gettext_noop('Uptime [Days]'),
          'columnName' => 'DATE_DIFF(CURRENT_DATE(),DATE_SUB(CURRENT_DATE(),h.uptimeSeconds,\'SECOND\'))',
          'dataBuilder' => [
              'name'      => 'callback',
              'options'   => [
                  'callback' => function ($row) {
                      return floor($row['uptimeDays']);
                  }
              ],
          ],
          'headAttributes' => [
              'visible' => false
          ]
      ]);

         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('OsName'),
            'columnName' => 'h.osName',
            'headAttributes' => [
                'visible' => false
            ]
        ]);
         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('OsVersion'),
            'columnName' => 'h.osVersion',
            'headAttributes' => [
                'visible' => false
            ]
        ]);
         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('KernelVersion'),
            'columnName' => 'h.kernelVersion',
            'headAttributes' => [
                'visible' => false
            ]
        ]);
         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('PackagesAptMirrors'),
            'columnName' => 'h.packagesAptMirrors',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        return 'Search-only';
                    }
                ],
            ],
            'headAttributes' => [
                'visible' => false
            ]
        ]);
         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('PackagesAptHasRepoError (10n)'),
            'columnName' => 'h.packagesAptHasRepoError',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        if($row['packagesAptHasRepoError'] === null) return 'Unknown';
                        if($row['packagesAptHasRepoError'] === false) return 'OK';
                        return 'ERROR';
                    }
                ],
            ],
            'headAttributes' => [
                'visible' => false
            ]
        ]);
         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('PackagesAptUpgradable'),
            'columnName' => 'h.packagesAptUpgradable',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        return count($row['packagesAptUpgradable'] ?? []);
                    }
                ],
            ],
            'headAttributes' => [
                'visible' => false
            ]
        ]);
         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('PackagesInstalled'),
            'columnName' => 'h.packagesInstalled',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        return 'Search-only';
                    }
                ],
            ],
            'headAttributes' => [
                'visible' => false
            ]
        ]);
        $columns[] = $colManager->get('default', [
           'title' => gettext_noop('ProxmoxVersion'),
           'columnName' => 'h.proxmoxVersion',
           'headAttributes' => [
               'visible' => false
           ]
       ]);

         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('PleskVersion'),
            'columnName' => 'h.pleskVersion',
            'headAttributes' => [
                'visible' => false
            ]
        ]);
         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('PleskBackupIsDone (10n)'),
            'columnName' => 'h.pleskBackupIsDone',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        if($row['pleskBackupIsDone'] === null) return 'Plesk not installed';
                        if($row['pleskBackupIsDone'] === true) return 'OK';
                        return 'ERROR';
                    }
                ],
            ],
            'headAttributes' => [
                'visible' => false
            ]
        ]);
         $columns[] = $colManager->get('default', [
            'title' => gettext_noop('PleskBackupHasError (10n)'),
            'columnName' => 'h.pleskBackupHasError',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        if($row['pleskBackupHasError'] === null) return 'Plesk not detected';
                        if($row['pleskBackupHasError'] === true) return 'Errors detected';
                        return 'No Error';
                    }
                ],
            ],
            'headAttributes' => [
                'visible' => false
            ]
        ]);

        $columns[] = $colManager->get('default', [
           'title' => gettext_noop('mailqCount'),
           'columnName' => 'h.mailqCount',
           'headAttributes' => [
               'visible' => false
           ]
       ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Description'),
            'columnName' => 'h.syshelperDescription'
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Tags'),
            'columnName' => 'GROUP_CONCAT(t.name,\'|\', t.color)',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        if(empty($row['thetags'])) return "";
                        $thetags = explode(',',$row['thetags']);
                        $tags = [];
                        foreach($thetags as $tag)
                        {
                            list($name,$color) = explode("|",$tag);
                            $tags[] = '<span class="uk-badge" style="background-color: '.$color.'; '.(ColorCalculator::isLightHtmlColor($color)?'color: #000;':'color: #FFF;').'">'.$name.'</span>';
                        }
                        return implode(' ',$tags); 
                    }
                ],
            ],
            'searchBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($queryBuilder,$query) {
                        $queryBuilder->andWhere('t.name LIKE :q')
                                    ->setParameter('q',"%".$query."%");
                        return $queryBuilder;
                    }
                ],
            ],
        ]);
        $columns[] = $colManager->get('link', [
            'title' => gettext_noop('Actions'),
            'actions' => [
                [
                    'class' => 'fb_auto_small',
                    'hrefBuilder' => [
                        'name' => 'url',
                        'options' => [
                            'routeName' => 'syshelper-frontend/host/show',
                            'parameterCallback' => function ($row) {
                                return ['id' => $row['id']];
                            },
                        ],
                    ],
                    'contentBuilder' => [
                        'name' => 'literal',
                        'options' => [
                            'value' => gettext_noop('View'),
                        ],
                    ],
                ],
                [
                    'class' => 'fb_auto_small',
                    'hrefBuilder' => [
                        'name' => 'url',
                        'options' => [
                            'routeName' => 'syshelper-frontend/host/update',
                            'parameterCallback' => function ($row) {
                                return ['id' => $row['id']];
                            },
                            'queryCallback' => function ($row) {
                                return ['fullview' => self::$fullView];
                            },
                        ],
                    ],
                    'contentBuilder' => [
                        'name' => 'literal',
                        'options' => [
                            'value' => gettext_noop('Edit'),
                        ],
                    ],
                ],/*
                [
                    'class' => 'fb_auto_small',
                    'hrefBuilder' => [
                        'name' => 'url',
                        'options' => [
                            'routeName' => 'syshelper-frontend/host/remove',
                            'parameterCallback' => function ($row) {
                                return ['id' => $row['id']];
                            },
                            'queryCallback' => function ($row) {
                                return ['fullview' => self::$fullView];
                            },
                        ],
                    ],
                    'contentBuilder' => [
                        'name' => 'literal',
                        'options' => [
                            'value' => gettext_noop('Remove'),
                        ],
                    ],
                ],*/
            ],
        ]);

        $options = [
            'queryCountManipulationCallback' => function ($query) {
                /** @var querybuilder $query */
                $query->resetdqlpart('select')
                    ->select('count(h.id) as count');
            },
            'countUsingDql' => false,
        ];

        return new SimpleDataTable($columns, $query, $options);
    }
}

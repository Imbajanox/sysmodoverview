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
use WirklichDigital\SyshelperAlerts\Entity\Alert;
use WirklichDigital\SyshelperBase\Entity\Host;

class AlertTableFactory implements FactoryInterface
{
    protected static $fullView = false;
    protected $router;

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);
        $em = $container->get(EntityManager::class);
        $this->router = $container->get('router');

        $query = $em->createQueryBuilder()
            ->select('a.id, a.name,a.description,a.isAcknowledged,a.isMuted,a.lastSeenAt,a.createdAt,h.fqdn,h.id hid,h.externalIpV4 hip,aiphost.externalIpV4 aiphostip,aiphost.id aiphostid, aiphost.fqdn aiphostname,s.networkAddress,s.networkCidrMask,s.id sid,s.importSource ssource, aip.id aipid, aip.address aipaddress, rip.id ripid, rip.address ripaddress')
            ->from(Alert::class, 'a')
            ->leftJoin('a.host', 'h')
            ->leftJoin('a.ipSubnet', 'ips')
            ->leftJoin('a.assignedIp', 'aip')
            ->leftJoin('aip.host', 'aiphost')
            ->leftJoin('a.reachableIp', 'rip')
            ->leftJoin('rip.subnet', 's');

        if($_GET['showMuted'] ?? false)
            $query->andWhere('a.isMuted = 1');
        else
            $query->andWhere('a.isMuted = 0');

        if ($_GET['name'] ?? false) {
            $query->andWhere('a.name = :name')
                ->setParameter('name', $_GET['name']);
        }

        $columns = [];


        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Name'),
            'columnName' => 'a.name',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        return $row['name'].' <i class="material-icons" style="cursor: pointer;" title="'.htmlentities($row['description']).'">help_outline</i>';
                    }
                ],
            ]
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Host'),
            'columnName' => 'h.fqdn',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        if( ! empty($row['hid'])) {
			    $hostname = (empty($row['fqdn'])) ? "ERROR: FQDN" : $row['fqdn'];
			    return '<a href="'.$this->router->assemble(['id' => $row['hid']],['name' => 'syshelper-frontend/host/show','query' => []]).'" target="_blank">'.$hostname.'</a>';
                        } elseif( ! empty($row['aiphostid'])) {
			    $hostname = (empty($row['aiphostname'])) ? "ERROR: FQDN by AssIP" : $row['aiphostname'];
                            return '<a href="'.$this->router->assemble(['id' => $row['aiphostid']],['name' => 'syshelper-frontend/host/show','query' => []]).'" target="_blank">'.$hostname.'</a>';
                        } else {
                            return "-";
                        }
                    }
                ],
            ]
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Subnet'),
            'columnName' => 'h.fqdn',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        if(empty($row['sid'])) return '-';
                        return '<a href="'.$this->router->assemble(['id' => $row['sid']],['name' => 'syshelper-frontend/ip-subnet/show','query' => []]).'" target="_blank">'.$row['networkAddress'].'/'.$row['networkCidrMask'].'</a>';
                    }
                ],
            ]
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Source'),
            'columnName' => 's.importSource',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        return $row['ssource'] ?? '-';
                    }
                ],
            ]
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('AssignedIp'),
            'columnName' => 'aip.address',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        return $row['aipaddress'] ?? ($row['hip'] ?? '-');
                    }
                ],
            ],
            'searchBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($queryBuilder,$query) {
                        $queryBuilder->andWhere('INET6_NTOA(aip.address) LIKE :q')
                                    ->setParameter('q',"%".$query."%");
                        return $queryBuilder;
                    }
                ],
            ],
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('ReachableIp'),
            'columnName' => 'rip.address',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        return $row['ripaddress'] ?? '-';
                    }
                ],
            ],
            'searchBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($queryBuilder,$query) {
                        $queryBuilder->andWhere('INET6_NTOA(rip.address) LIKE :q')
                                    ->setParameter('q',"%".$query."%");
                        return $queryBuilder;
                    }
                ],
            ],
        ]);

        $columns[] = $colManager->get('date', [
            'title' => gettext_noop('CreatedAt'),
            'columnName' => 'a.createdAt',
            'pattern' => 'yyyy-MM-dd HH:mm:ss',
        ]);

        $columns[] = $colManager->get('date', [
            'title' => gettext_noop('LastSeenAt'),
            'columnName' => 'a.lastSeenAt',
            'pattern' => 'yyyy-MM-dd HH:mm:ss'
        ]);

        $columns[] = $colManager->get('boolean', [
            'title' => gettext_noop('IsAcknowledged'),
            'columnName' => 'a.isAcknowledged',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        return '<a href="'.$this->router->assemble(['id' => $row['id']],['name' => 'syshelper-frontend/dashboard/alert-acknowledge-toggle','query' => ['showMuted' => ($_GET['showMuted'] ?? 0)]]).'">'.($row['isAcknowledged'] ? 'Ja' : 'Nein').'</a>';
                    }
                ],
            ],
        ]);

        $columns[] = $colManager->get('link', [
            'title' => gettext_noop('Actions'),
            'actions' => [
                [
                    'hrefBuilder' => [
                        'name' => 'url',
                        'options' => [
                            'routeName' => 'syshelper-frontend/dashboard/alert-mute-toggle',
                            'parameterCallback' => function ($row) {
                                return ['id' => $row['id']];
                            },
                            'queryCallback' => function ($row) {
                                return ['showMuted' => ($_GET['showMuted'] ?? 0)];
                            },
                        ],
                    ],
                    'contentBuilder' => [
                        'name' => 'literal',
                        'options' => [
                            'value' => gettext_noop('UN-/MUTE'),
                        ],
                    ],
                ],
            ],
        ]);

        $options = [
            'queryCountManipulationCallback' => function ($query) {
                /** @var querybuilder $query */
                $query->resetdqlpart('select')
                    ->select('count(a.id) as count');
            },
            'countUsingDql' => true,
            'classCallback' => function ($row) {
                $classes = [];

                if($row['isMuted']) $classes[] = 'muted';
                if($row['isAcknowledged']) 
                    $classes[] = 'acknowledged';
                else
                    $classes[] = 'not-acknowledged';

                return implode(' ',$classes);
            }
        ];

        return new SimpleDataTable($columns, $query, $options);
    }
}

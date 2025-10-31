<?php

namespace WirklichDigital\SyshelperFrontend\Table\Factory;

use Darsyn\IP\Version\Multi;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\DataTables\Table\SimpleDataTable;
use WirklichDigital\DataTables\Column\Column;
use WirklichDigital\DataTables\Service\ColumnPluginManager;
use Doctrine\ORM\EntityManager;
use WirklichDigital\StdLib\ColorUtils\ColorCalculator;
use WirklichDigital\SyshelperBase\Entity\AssignedIp;
use WirklichDigital\SyshelperBase\Entity\SyshelperTag;

class AssignedIpTableFactory implements FactoryInterface
{
    protected static $fullView = false;
    protected $router;

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);
        $em = $container->get(EntityManager::class);
        $this->router = $container->get('router');

        $query = $em->createQueryBuilder()
            ->select('a.id, a.address, h.id hid, h.fqdn, a.syshelperDescription, a.openPortsInternal, a.openPortsInternalLastScanAt, a.openPortsExternal, a.openPortsExternalLastScanAt, s.isDynamic, GROUP_CONCAT(t.name,\'|\', t.color) thetags')
            ->from(AssignedIp::class, 'a')
            ->leftJoin('a.tags', 't')
            ->join('a.host', 'h')
            ->join('a.subnet', 's')
            ->groupBy('a.id');

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Address'),
            'columnName' => 'a.address',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        return $row['address'];
                    }
                ],
            ],
            'searchBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($queryBuilder,$query) {
                        $queryBuilder->andWhere('INET6_NTOA(a.address) LIKE :q')
                                    ->setParameter('q',"%".$query."%");
                        return $queryBuilder;
                    }
                ],
            ],
        ]);
        
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Host FQDN'),
            'columnName' => 'h.fqdn',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        return '<a href="'.$this->router->assemble(['id' => $row['hid']],['name' => 'syshelper-frontend/host/show','query' => []]).'" target="_blank">'.$row['fqdn'].'</a>';
                    }
                ],
            ],
        ]);
        
        if(self::$fullView) $columns[] = $colManager->get('default', [
            'title' => gettext_noop('OpenPortsInternal'),
            'columnName' => 'a.openPortsInternal',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Open Ports (ext)'),
            'columnName' => 'a.openPortsExternal',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        $elm = [];
                        $tcp_ports = $row['openPortsExternal']['tcp'] ?? [];
                        foreach($tcp_ports as $port)
                        {
                            $elm[] = '<span class="uk-badge">'.$port.'/TCP</span>';
                            if(count($elm)%7 == 0) $elm[] = "<br/>";
                        }
                        $udp_ports = $row['openPortsExternal']['udp'] ?? [];
                        foreach($udp_ports as $port)
                        {
                            $elm[] = '<span class="uk-badge">'.$port.'/UDP</span>';
                            if(count($elm)%7 == 0) $elm[] = "<br/>";
                        }
                        return implode(' ',$elm); 
                    }
                ],
            ],
        ]);
        $columns[] = $colManager->get('boolean', [
            'title' => gettext_noop('subnetIsDynamic'),
            'columnName' => 's.isDynamic',
            'headAttributes' => [
                'visible' => false
            ]
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Description'),
            'columnName' => 'a.syshelperDescription',
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
                            'routeName' => 'syshelper-frontend/assigned-ip/update',
                            'parameterCallback' => function ($row) {
                                return ['id' => $row['id']];
                            },
                        ],
                    ],
                    'contentBuilder' => [
                        'name' => 'literal',
                        'options' => [
                            'value' => gettext_noop('Edit'),
                        ],
                    ],
                ],
                [
                    'class' => 'fb_auto_small',
                    'hrefBuilder' => [
                        'name' => 'url',
                        'options' => [
                            'routeName' => 'syshelper-frontend/assigned-ip/scan',
                            'parameterCallback' => function ($row) {
                                return ['id' => $row['id']];
                            },
                        ],
                    ],
                    'contentBuilder' => [
                        'name' => 'literal',
                        'options' => [
                            'value' => gettext_noop('Rescan'),
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
            'countUsingDql' => false,
        ];

        return new SimpleDataTable($columns, $query, $options);
    }
}

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
use WirklichDigital\SyshelperBase\Entity\IpSubnet;

class IpSubnetTableFactory implements FactoryInterface
{
    protected static $fullView = false;

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);
        $em = $container->get(EntityManager::class);

        $query = $em->createQueryBuilder()
            ->select('i.id, i.networkAddress, i.networkCidrMask, i.importSource, i.syshelperDescription, i.externalUpIps, i.externalUpIpLastScanAt, i.isDynamic, GROUP_CONCAT(t.name,\'|\', t.color) thetags')
            ->from(IpSubnet::class, 'i')
            ->leftJoin('i.tags', 't')
            ->groupBy('i.id');
        $columns = [];
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('NetworkAddress'),
            'columnName' => 'i.networkAddress',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        return $row['networkAddress'];
                    }
                ],
            ],
            'searchBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($queryBuilder,$query) {
                        $queryBuilder->andWhere('INET6_NTOA(i.networkAddress) LIKE :q')
                                    ->setParameter('q',"%".$query."%");
                        return $queryBuilder;
                    }
                ],
            ],
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('NetworkCidrMask'),
            'columnName' => 'i.networkCidrMask',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('ImportSource'),
            'columnName' => 'i.importSource',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('ExternalUpIpLastScanAt'),
            'columnName' => 'i.externalUpIpLastScanAt',
            'headAttributes' => [
                'visible' => false
            ]
        ]);
        $columns[] = $colManager->get('boolean', [
            'title' => gettext_noop('IsDynamic'),
            'columnName' => 'i.isDynamic',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Description'),
            'columnName' => 'i.syshelperDescription',
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
                    'hrefBuilder' => [
                        'name' => 'url',
                        'options' => [
                            'routeName' => 'syshelper-frontend/ip-subnet/show',
                            'parameterCallback' => function ($row) {
                                return ['id' => $row['id']];
                            },
                        ],
                    ],
                    'contentBuilder' => [
                        'name' => 'literal',
                        'options' => [
                            'value' => gettext_noop('Show'),
                        ],
                    ],
                ],
                [
                    'class' => 'fb_auto_small',
                    'hrefBuilder' => [
                        'name' => 'url',
                        'options' => [
                            'routeName' => 'syshelper-frontend/ip-subnet/update',
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
            ],
        ]);

        $options = [
            'queryCountManipulationCallback' => function ($query) {
                /** @var querybuilder $query */
                $query->resetdqlpart('select')
                    ->select('count(i.id) as count');
            },
            'countUsingDql' => false,
        ];

        return new SimpleDataTable($columns, $query, $options);
    }
}

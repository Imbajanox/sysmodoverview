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
use WirklichDigital\SyshelperBase\Entity\ReachableIp;
use WirklichDigital\SyshelperBase\Entity\SyshelperTag;

class ReachableIpTableFactory implements FactoryInterface
{
    protected static $fullView = false;
    protected $router;

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);
        $em = $container->get(EntityManager::class);
        $this->router = $container->get('router');

        $query = $em->createQueryBuilder()
            ->select("r.id, r.address, r.ptr, a.id aid, h.id hid, h.fqdn, s.id sid, s.networkAddress, s.networkCidrMask, IF(IFNULL(a.id,-1) >= 0, 'OK / ASSIGNED', IF(s.isDynamic = 1, 'OK / DYN','NOT ASSIGNED')) status")
            ->from(ReachableIp::class, 'r')
            ->leftJoin('r.assignedIp','a')
            ->leftJoin('r.subnet','s')
            ->leftJoin('a.host', 'h')
            ->groupBy('r.id');

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Address'),
            'columnName' => 'r.address',
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
                        $queryBuilder->andWhere('INET6_NTOA(r.address) LIKE :q')
                                    ->setParameter('q',"%".$query."%");
                        return $queryBuilder;
                    }
                ],
            ],
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('PTR'),
            'columnName' => 'r.ptr',
        ]);
        
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Status'),
            'columnName' => "IF(IFNULL(a.id,-1) >= 0, 'OK / ASSIGNED', IF(s.isDynamic = 1, 'OK / DYN','NOT ASSIGNED'))",
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        return $row['status'];
                    }
                ],
            ],
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Assigned Ip / Host'),
            'columnName' => 'h.fqdn',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        if(empty($row['hid']))
                            return "-";
                        else
                            return '<a href="'.$this->router->assemble(['id' => $row['hid']],['name' => 'syshelper-frontend/host/show','query' => []]).'" target="_blank">'.$row['fqdn'].'</a>';
                    }
                ],
            ],
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Subnet'),
            'columnName' => 's.networkAddress',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                        if(empty($row['sid']))
                            return "-";
                        else
                            return '<a href="'.$this->router->assemble(['id' => $row['sid']],['name' => 'syshelper-frontend/ip-subnet/show','query' => []]).'" target="_blank">'.$row['networkAddress'].'/'.$row['networkCidrMask'].'</a>';
                    }
                ],
            ],
            'searchBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($queryBuilder,$query) {
                        $queryBuilder->andWhere('INET6_NTOA(s.networkAddress) LIKE :q')
                                    ->setParameter('q',"%".$query."%");
                        return $queryBuilder;
                    }
                ],
            ],
        ]);

        $options = [
            'queryCountManipulationCallback' => function ($query) {
                /** @var querybuilder $query */
                $query->resetdqlpart('select')
                    ->select('count(r.id) as count');
            },
            'countUsingDql' => false,
        ];

        return new SimpleDataTable($columns, $query, $options);
    }
}

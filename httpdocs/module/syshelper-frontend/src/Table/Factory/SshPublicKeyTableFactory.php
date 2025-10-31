<?php

namespace WirklichDigital\SyshelperFrontend\Table\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use WirklichDigital\DataTables\Table\SimpleDataTable;
use WirklichDigital\DataTables\Service\ColumnPluginManager;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperBase\Entity\SshPublicKey;

class SshPublicKeyTableFactory implements FactoryInterface
{
    protected static $fullView = false;
    protected $router;

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);
        $em = $container->get(EntityManager::class);
        $this->router = $container->get('router');
        
        $includeUnassigned = $options['includeUnassigned'] ?? false;

        $query = $em->createQueryBuilder()
            ->select('spk.id, spk.title, spk.keyType, spk.keyData, count(hm.id) as mappingCount, spk.doNotTrackLogins')
            ->from(SshPublicKey::class, 'spk')
            ->leftJoin('spk.hostMappings', 'hm')
            ->groupBy('spk.id');

        if(!$includeUnassigned) {
            $query->andWhere('hm.id IS NOT NULL');
        }

        $columns = [];

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Title'),
            'columnName' => 'spk.title',
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Key Type'),
            'columnName' => 'spk.keyType'
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Key Data'),
            'columnName' => 'spk.keyData',
            'dataBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($row) {
                       if(empty($row['keyData'])) return "";
                       return substr($row['keyData'],0,10).'...'.substr($row['keyData'],-10);
                    }
                ],
            ],
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('#Mappings'),
            'columnName' => 'mappingCount'
        ]);

        $columns[] = $colManager->get('boolean', [
            'title' => gettext_noop('Do not track logins'),
            'columnName' => 'doNotTrackLogins'
        ]);

        $columns[] = $colManager->get('link', [
            'title' => gettext_noop('Actions'),
            'actions' => [
                [
                    'hrefBuilder' => [
                        'name' => 'url',
                        'options' => [
                            'routeName' => 'syshelper-frontend/ssh-public-key/show',
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
                    'hrefBuilder' => [
                        'name' => 'url',
                        'options' => [
                            'routeName' => 'syshelper-frontend/ssh-public-key/update',
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
        ];

        return new SimpleDataTable($columns, $query, $options);
    }
}

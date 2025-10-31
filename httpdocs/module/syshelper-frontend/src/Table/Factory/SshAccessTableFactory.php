<?php

namespace WirklichDigital\SyshelperFrontend\Table\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use WirklichDigital\DataTables\Table\SimpleDataTable;
use WirklichDigital\DataTables\Service\ColumnPluginManager;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperBase\Entity\SshPublicKey;
use WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostAccess;
use WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin;

class SshAccessTableFactory implements FactoryInterface
{
    protected static $fullView = false;
    protected $router;

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);
        /** @var EntityManager */
        $em = $container->get(EntityManager::class);
        $this->router = $container->get('router');

        $query = $em->createQueryBuilder()
            ->select('spkha.id as spkhaId, spkha.userOnHost as userOnHost, spkha.doNotBlockIfUnused, spkha.blockedBecauseUnused, spk.id as spkId, spk.title, h.fqdn, h.id as hostId, max(spkl.loggedInAt) as lastLogin')
            ->from(SshPublicKeyHostAccess::class, 'spkha')
            ->leftJoin('spkha.sshPublicKey', 'spk')
            ->leftJoin('spkha.host', 'h')
            ->leftJoin('spk.sshPublicKeyLogins', 'spkl')
            ->groupBy('spkha.id');

        $columns = [];

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Key'),
            'columnName' => 'spk.title',
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Host'),
            'columnName' => 'h.fqdn',
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Last Login'),
            'columnName' => 'lastLogin',
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('User'),
            'columnName' => 'userOnHost',
        ]);

        $columns[] = $colManager->get('boolean', [
            'title' => gettext_noop('Do Not Delete If Unused'),
            'columnName' => 'doNotBlockIfUnused',
        ]);

        $columns[] = $colManager->get('boolean', [
            'title' => gettext_noop('Is Blocked'),
            'columnName' => 'spkha.blockedBecauseUnused',
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
                                return ['id' => $row['spkId']];
                            },
                        ],
                    ],
                    'contentBuilder' => [
                        'name' => 'literal',
                        'options' => [
                            'value' => gettext_noop('View Key'),
                        ],
                    ],
                ],
                [
                    'hrefBuilder' => [
                        'name' => 'url',
                        'options' => [
                            'routeName' => 'syshelper-frontend/host/show',
                            'parameterCallback' => function ($row) {
                                return ['id' => $row['hostId']];
                            },
                        ],
                    ],
                    'contentBuilder' => [
                        'name' => 'literal',
                        'options' => [
                            'value' => gettext_noop('View Host'),
                        ],
                    ],
                ],
                [
                    'hrefBuilder' => [
                        'name' => 'url',
                        'options' => [
                            'routeName' => 'syshelper-frontend/ssh-public-key/access-renew',
                            'parameterCallback' => function ($row) {
                                return ['id' => $row['spkhaId']];
                            },
                        ],
                    ],
                    'contentBuilder' => [
                        'name' => 'literal',
                        'options' => [
                            'value' => gettext_noop('Renew access'),
                        ],
                    ],
                ],
                [
                    'hrefBuilder' => [
                        'name' => 'url',
                        'options' => [
                            'routeName' => 'syshelper-frontend/ssh-public-key/access-remove',
                            'parameterCallback' => function ($row) {
                                return ['id' => $row['spkhaId']];
                            },
                        ],
                    ],
                    'contentBuilder' => [
                        'name' => 'literal',
                        'options' => [
                            'value' => gettext_noop('Remove access'),
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

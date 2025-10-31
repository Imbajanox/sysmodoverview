<?php

namespace WirklichDigital\SyshelperFrontend\Table\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use WirklichDigital\DataTables\Table\SimpleDataTable;
use WirklichDigital\DataTables\Service\ColumnPluginManager;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperBase\Entity\SshPublicKey;
use WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin;

class SshLoginTableFactory implements FactoryInterface
{
    protected static $fullView = false;
    protected $router;

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);
        $em = $container->get(EntityManager::class);
        $this->router = $container->get('router');

        $query = $em->createQueryBuilder()
            ->select('spk.id, spk.title, spkl.loggedInAt, h.fqdn, h.id as hostId')
            ->from(SshPublicKeyLogin::class, 'spkl')
            ->leftJoin('spkl.sshPublicKey', 'spk')
            ->leftJoin('spkl.host', 'h')
            ->orderBy('spkl.loggedInAt', 'DESC');

        $columns = [];

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Logged in at'),
            'columnName' => 'spkl.loggedInAt',
            'dataBuilder' => [
                'name' => 'callback',
                'options' => [
                    'callback' => function ($row) {
                        if (! isset($row['loggedInAt'])) {
                            return "";
                        }
                        return $row['loggedInAt']->format('Y-m-d H:i');
                    }
                ],
            ],
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('SSH Public Key'),
            'columnName' => 'spk.title',
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Host'),
            'columnName' => 'h.fqdn',
        ]);

        $columns[] = $colManager->get('link', [
            'title' => gettext_noop('Actions'),
            'actions' => [
                [
                    'class' => 'fb_auto_small',
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
            ],
        ]);

        $options = [
        ];

        return new SimpleDataTable($columns, $query, $options);
    }
}

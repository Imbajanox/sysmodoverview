<?php

namespace WirklichDigital\SystemModuleOverview\Table\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\DataTables\Table\SimpleDataTable;
use WirklichDigital\DataTables\Column\Column;
use WirklichDigital\DataTables\Service\ColumnPluginManager;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface as ContainerContainerInterface;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer;
use WirklichDigital\SystemModuleOverview\Service\LaminasSystemServerService;
use WirklichDigital\SystemModuleOverview\Service\LaminasModuleService;

class ServerTableFactory implements FactoryInterface
{
    protected $router;

    public function __invoke(ContainerContainerInterface $container, $requestedName, array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);
        $em = $container->get(EntityManager::class);
        $this->router = $container->get('router');
        /** @var LaminasModuleService $moduleService */
        $moduleService = $container->get(LaminasModuleService::class);
        /** @var LaminasSystemServerService $laminasSystemServerService */
        $laminasSystemServerService = $container->get(LaminasSystemServerService::class);

        $query = $em->createQueryBuilder();
        $query->select('s.id, s.url, s.phpVersion, s.isDevelopment, s.ipAddress as ip, s.phpinfo, s.config, s.updatedAt as update, s.isDeinPim, s.hasMinorUpdates, s.hasMajorUpdates, s.hasWirklichDigitalMinorUpdates, s.hasWirklichDigitalMajorUpdates, l.repositoryName, l.repository')
            ->from(LaminasSystemServer::class, 's')
            ->leftJoin('s.laminasSystem', 'l');

        if (is_array($options) && isset($options['systemId'])) {
            $query->where('l.id = :systemId')
                ->setParameter('systemId', $options['systemId']);
        }

        $columns = [];

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('System'),
            'columnName' => 'l.repositoryName',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('URL'),
            'columnName' => 's.url',
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('IP Address'),
            'columnName' => 's.ipAddress',
            'dataBuilder' => [
                'name' => 'callback',
                'options' => [
                    'callback' => function ($row) {
                        if (empty($row['ip'])) {
                            return '';
                        }
                        // Split by '-' to separate IPv4 and IPv6
                        $parts = explode('-', $row['ip']);
                        $ipv4 = trim($parts[0]);
                        $ipv6 = isset($parts[1]) ? trim($parts[1]) : '';
                        if ($ipv6) {
                            return htmlspecialchars($ipv4) . ' (' . htmlspecialchars($ipv6) . ')';
                        }
                        return htmlspecialchars($ipv4);
                    },
                ],
            ],
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('System Repository'),
            'columnName' => 'l.repository',
            'dataBuilder' => [
                'name' => 'callback',
                'options' => [
                    'callback' => function ($row) {
                        $repo = $row['repository'] ?? '';
                        // Remove prefix
                        $repo = preg_replace('#^ssh://git@git\.jar\.media:8723/#', '', $repo);
                        // Remove .git suffix
                        $repo = preg_replace('#\.git$#', '', $repo);
                        return htmlspecialchars($repo);
                    },
                ],
            ],
        ]);
        $columns[] = $colManager->get('empty', [
            'title' => gettext_noop('Kunden Nummer'),
            // 'filterType' => Column::FILTER_TYPE_DROPDOWN,
            'dataBuilder' => [
                'name' => 'callback',
                'options' => [
                    'callback' => function ($row) use ($laminasSystemServerService) {
                        return $laminasSystemServerService->getCustomerAndSubNumber($row['repository'])["custNum"];
                    },
                ],
            ]
        ]);
        $columns[] = $colManager->get('empty', [
            'title' => gettext_noop('Subprojekt Nummer'),
            // 'filterType' => Column::FILTER_TYPE_DROPDOWN,
            'dataBuilder' => [
                'name' => 'callback',
                'options' => [
                    'callback' => function ($row) use ($laminasSystemServerService) {
                        return $laminasSystemServerService->getCustomerAndSubNumber($row['repository'])["subpNum"];
                    },
                ],
            ]
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('PHP Version'),
            'columnName' => 's.phpVersion',
        ]);
        $columns[] = $colManager->get('boolean', [
            //'filterType' => Column::FILTER_TYPE_DROPDOWN,
            'title' => gettext_noop('deimPim'),
            'columnName' => 's.isDeinPim',
        ]);
        $columns[] = $colManager->get('boolean', [
            //'filterType' => Column::FILTER_TYPE_DROPDOWN,
            'title' => gettext_noop('Development'),
            'columnName' => 's.isDevelopment',
        ]);
        $columns[] = $colManager->get('empty', [
            'title' => gettext_noop('Update Possible'),
            // 'filterType' => Column::FILTER_TYPE_DROPDOWN,
            'dataBuilder' => [
                'name' => 'callback',
                'options' => [
                    'callback' => function ($row) use ($moduleService) {
                        return $moduleService->hasServerOutdatedComposerModules($row['id']);
                    },
                ],
            ]
        ]);
        $columns[] = $colManager->get('empty', [
            'title' => gettext_noop('WiDi-Update Possible'),
            // 'filterType' => Column::FILTER_TYPE_DROPDOWN,
            'dataBuilder' => [
                'name' => 'callback',
                'options' => [
                    'callback' => function ($row) use ($moduleService) {
                        return $moduleService->hasServerOutdatedComposerModules($row['id'], true);
                    },
                ],
            ]
        ]);
        $columns[] = $colManager->get('empty', [
            'title' => gettext_noop('NPM Update Possible'),
            // 'filterType' => Column::FILTER_TYPE_DROPDOWN,
            'dataBuilder' => [
                'name' => 'callback',
                'options' => [
                    'callback' => function ($row) use ($moduleService) {
                        return $moduleService->hasServerOutdatedNpmModules($row['id']);
                    },
                ],
            ]
        ]);

        $columns[] = $colManager->get('date', [
            'title' => gettext_noop('Updated At'),
            'columnName' => 'update',
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Last Update'),
            'columnName' => 'update',
            'searchBuilder' => [
                'name'      => 'callback',
                'options'   => [
                    'callback' => function ($query, $value) {
                        $now = new \DateTime();
                        switch ($value) {
                            case 'Today':
                                $start = (clone $now)->setTime(0, 0, 0);
                                $end = (clone $now)->setTime(23, 59, 59);
                                $query->andWhere('s.updatedAt BETWEEN :start AND :end')
                                      ->setParameter('start', $start)
                                      ->setParameter('end', $end);
                                break;
                            case 'This Week':
                                // Monday as first day of week
                                $start = (clone $now)->modify('monday this week')->setTime(0, 0, 0);
                                $end = (clone $now)->setTime(23, 59, 59);
                                $query->andWhere('s.updatedAt BETWEEN :start AND :end')
                                      ->setParameter('start', $start)
                                      ->setParameter('end', $end);
                                break;
                            case 'This Month':
                                $start = (clone $now)->modify('first day of this month')->setTime(0, 0, 0);
                                $end = (clone $now)->setTime(23, 59, 59);
                                $query->andWhere('s.updatedAt BETWEEN :start AND :end')
                                      ->setParameter('start', $start)
                                      ->setParameter('end', $end);
                                break;
                        }
                        return $query;
                    }
                ],
            ],
            'dataBuilder' => [
            'name' => 'callback',
            'options' => [
                'callback' => function ($row) {
                if (empty($row['update'])) {
                    return '<span style="color: #ff9800;">No Date</span>';
                }
                $updateDate = $row['update'] instanceof \DateTimeInterface
                    ? $row['update']
                    : new \DateTime($row['update']);

                $now = new \DateTime();
                $interval = $now->diff($updateDate);
                $days = (int)$interval->format('%r%a');

                if ($updateDate->format('Y-m-d') === $now->format('Y-m-d')) {
                    $color = '#4caf50'; // green
                    $text = gettext_noop("Today");
                } elseif ($days >= -6 && $days < 0) {
                    $color = '#2196f3'; // blue
                    $text = gettext_noop("This Week");
                } elseif ($days <= -7 || $days > -30) {
                    $color = '#f44336'; // red
                    $text = gettext_noop("More than a Week");
                } else {
                    $color = '#757575'; // grey
                    $text = gettext_noop("More than a Month") . $days;
                }

                return sprintf('<span style="color: %s;">%s</span>', $color, htmlspecialchars($text));
                },
            ],
            ],
        ]);

// Link to modules
        $columns[] = $colManager->get('link', [
            'title' => gettext_noop('Actions'),
            'actions' => [
                [
                    'class' => 'fb_auto_big',
                    'hrefBuilder' => [
                        'name' => 'url',

                        'options' => [
                            'routeName' => 'sysModOverview/system/server/view',
                            'parameterCallback' => function ($row) {
                                return ['id' => $row['id']];
                            },
                        ],
                    ],
                    'contentBuilder' => [
                        'name' => 'literal',
                        'options' => [
                            'value' => gettext_noop('Show Details'),
                        ],
                    ],
                ],
            ],
        ]);

        return new SimpleDataTable($columns, $query, []);
    }
}

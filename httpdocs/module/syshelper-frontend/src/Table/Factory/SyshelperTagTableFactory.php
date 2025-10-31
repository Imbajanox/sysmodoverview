<?php

namespace WirklichDigital\SyshelperFrontend\Table\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\DataTables\Table\SimpleDataTable;
use WirklichDigital\DataTables\Column\Column;
use WirklichDigital\DataTables\Service\ColumnPluginManager;
use Doctrine\ORM\EntityManager;
use WirklichDigital\StdLib\ColorUtils\ColorCalculator;
use WirklichDigital\SyshelperBase\Entity\SyshelperTag;

class SyshelperTagTableFactory implements FactoryInterface
{

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);
        $em = $container->get(EntityManager::class);

        $query = $em->createQueryBuilder()
            ->select('s.id, s.name, s.color')
            ->from(SyshelperTag::class, 's');

        $columns = [
            $colManager->get('default', [
                'title' => gettext_noop('Name'),
                'columnName' => 's.name',
            ]),
            $colManager->get('default', [
                'title' => gettext_noop('Color'),
                'columnName' => 's.color',
                'dataBuilder' => [
                    'name'      => 'callback',
                    'options'   => [
                        'callback' => function ($row) {
                             return '<span style="padding: 3px 5px; background-color: '.$row['color'].'; '.(ColorCalculator::isLightHtmlColor($row['color'])?'color: #000;':'color: #FFF;').'">'.$row['color'].'</span>';
                        }
                    ],
                ],
            ]),
            $colManager->get('link', [
                'title' => gettext_noop('Actions'),
                'actions' => [
                    [
                        'class' => 'fb_auto_small',
                        'hrefBuilder' => [
                            'name' => 'url',
                            'options' => [
                                'routeName' => 'syshelper-frontend/syshelper-tag/update',
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
                        'class' => 'fb_auto_confirm',
                        'attributeBuilder' => [
                            'name' => 'multipleAttributes',
                            'options' => [
                                'attributes' => [
                                    [
                                        'keyBuilder' => 'data-text',
                                        'valueBuilder' => gettext_noop('Do you really want to delete this Syshelper Tag?'),
                                    ],
                                    [
                                        'keyBuilder' => 'data-title',
                                        'valueBuilder' => gettext_noop('Delete Syshelper Tag'),
                                    ],
                                ],
                            ],
                        ],
                        'hrefBuilder' => [
                            'name' => 'url',
                            'options' => [
                                'routeName' => 'syshelper-frontend/syshelper-tag/delete',
                                'parameterCallback' => function ($row) {
                                    return ['id' => $row['id']];
                                },
                            ],
                        ],
                        'contentBuilder' => [
                            'name' => 'literal',
                            'options' => [
                                'value' => gettext_noop('Delete'),
                            ],
                        ],
                    ],
                ],
            ]),
        ];

        $options = [
            'queryCountManipulationCallback' => function ($query) {
                /** @var querybuilder $query */
                $query->resetdqlpart('select')
                    ->select('count(s.id) as count');
            },
            'countUsingDql' => true,
        ];

        return new SimpleDataTable($columns, $query, $options);
    }
}

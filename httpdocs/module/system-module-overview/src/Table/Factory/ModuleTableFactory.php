<?php

namespace WirklichDigital\SystemModuleOverview\Table\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WirklichDigital\DataTables\Table\SimpleDataTable;
use WirklichDigital\DataTables\Column\Column;
use WirklichDigital\DataTables\Service\ColumnPluginManager;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface as ContainerContainerInterface;
use WirklichDigital\StdLib\ColorUtils\ColorCalculator;
use WirklichDigital\StdLib\FileUtils\HumanReadbleFilesize;
use WirklichDigital\SyshelperAlerts\Entity\Alert;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule;

class ModuleTableFactory implements FactoryInterface
{
    protected $router;

    public function __invoke(ContainerContainerInterface $container, $requestedName, array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);
        $em = $container->get(EntityManager::class);
        $this->router = $container->get('router');  
        
        $query = $em->createQueryBuilder();
        $query->select('DISTINCT m.id, m.moduleName, m.moduleVersionNormalized, m.moduleTime')
            ->from(LaminasSystemServerModule::class, 'm')
            ->leftJoin('m.laminasSystemServer', 's');

        if (is_array($options) && isset($options['serverId'])) {
            $query->andWhere(':serverId MEMBER OF m.laminasSystemServer')
            ->setParameter('serverId', $options['serverId']);
        }

        $columns = [];
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Id'),
            'columnName' => 'm.id',
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Name'),
            'columnName' => 'm.moduleName',
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Version'),
            'columnName' => 'm.moduleVersionNormalized',
        ]);

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Time'),
            'columnName' => 'm.moduleTime',
        ]);  

        $columns[] = $colManager->get('link', [
            'title' => gettext_noop('Actions'),
            'actions' => [
                [
                    'class' => 'fb_auto_small',
                    'hrefBuilder' => [
                        'name' => 'url',
                        
                        'options' => [
                            'routeName' => 'sysModOverview/system/show',
                            'parameterCallback' => function ($row) {
                                return ['id' => $row['id']];
                            },
                        ],
                    ],
                    'contentBuilder' => [
                        'name' => 'literal',
                        'options' => [
                            'value' => gettext_noop('Show details'),
                        ],
                    ],
                ],
            ],
        ]);

        return new SimpleDataTable($columns, $query, []);
    }
}

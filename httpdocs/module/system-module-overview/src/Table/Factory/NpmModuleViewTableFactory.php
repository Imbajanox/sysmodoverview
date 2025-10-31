<?php

namespace WirklichDigital\SystemModuleOverview\Table\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use WirklichDigital\DataTables\Table\SimpleDataTable;
use WirklichDigital\DataTables\Service\ColumnPluginManager;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface as ContainerContainerInterface;
use WirklichDigital\DataTables\Column\Column;
use WirklichDigital\SystemModuleOverview\Entity\NpmModules;
use WirklichDigital\SystemModuleOverview\Service\ComposerModuleService;
use WirklichDigital\SystemModuleOverview\Service\LaminasModuleService;

class NpmModuleViewTableFactory implements FactoryInterface
{
    protected $router;

    public function __invoke(ContainerContainerInterface $container, $requestedName, array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);
        $em = $container->get(EntityManager::class);
        /** @var LaminasModuleService $moduleService */
        $moduleService = $container->get(LaminasModuleService::class);

        $query = $em->createQueryBuilder();
        $query->select('c.installedVersion,c.latestVersion, c.module')
            ->from(NpmModules::class, 'c');

        if(is_array($options) && isset($options['name'])) {
            $parameter = $options['name'];
            $query->where('c.name = :name')
            ->setParameter('name', $parameter);
        }

            $query->join('c.laminasSystemServer', 'ls')
            ->addSelect('ls.url, ls.ipAddress')
            ->join('ls.laminasSystem', 's')
            ->addSelect('s.repositoryName')
            ;

        $columns = [];

        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Repository Name'),
            'columnName' => 's.repositoryName',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Server URL'),
            'columnName' => 'ls.url',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('IP Address'),
            'columnName' => 'ls.ipAddress',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Installed in Module'),
            'columnName' => 'c.module',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Current Version'),
            'columnName' => 'c.installedVersion',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Latest Version'),
            'columnName' => 'c.latestVersion',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Outdated'),
            'columnName' => 'outdated',
            'filterType' => Column::FILTER_TYPE_DROPDOWN,
            'dataBuilder' => [
                'name' => 'callback',
                'options' => [
                    'callback' => function ($row) use ($moduleService) {
                        return $moduleService->whichUpdateIsNeeded($row['installedVersion'], $row['latestVersion']);
                    },
                ],
            ]
        ]);


        return new SimpleDataTable($columns, $query, []);
    }
}

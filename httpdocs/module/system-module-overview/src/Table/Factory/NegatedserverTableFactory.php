<?php

namespace WirklichDigital\SystemModuleOverview\Table\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use WirklichDigital\DataTables\Table\SimpleDataTable;
use WirklichDigital\DataTables\Service\ColumnPluginManager;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer;
use Psr\Container\ContainerInterface as ContainerContainerInterface;
use WirklichDigital\DataTables\Column\Column;

class NegatedserverTableFactory implements FactoryInterface
{
    protected $router;

    public function __invoke(ContainerContainerInterface $container, $requestedName, ?array $options = null)
    {
        $colManager = $container->get(ColumnPluginManager::class);

        /** @var EntityManager */
        $em = $container->get(EntityManager::class);

        $query = $em->createQueryBuilder();
        $query->select(
            'se.id, se.url, se.ipAddress, sy.repositoryName,
            SUM(CASE WHEN sm.moduleVersion = :moduleVersion THEN 1 ELSE 0 END) AS isVersionInstalled,
            SUM(CASE WHEN sm.id IS NOT NULL THEN 1 ELSE 0 END) AS isInstalled'
        )
            ->from(LaminasSystemServer::class, 'se')
            ->join('se.laminasSystem', 'sy')
            ->leftJoin(
                'se.laminasSystemServerModule',
                'sm',
                'WITH',
                'sm.moduleName = :moduleName'
            )
            ->groupBy('se.id, se.url, se.ipAddress, sy.repositoryName');

        if ($options != null && count($options) == 2) {
            $query->setParameter('moduleName', str_replace("_", "/", $options['moduleName']))
                ->setParameter('moduleVersion', $options['moduleVersion']);
        }


        $columns = [];

        $columns[] = $colManager->get('boolean', [
            'filterType' => Column::FILTER_TYPE_DROPDOWN,
            'title' => gettext_noop('Is Module with Version Installed'),
            'columnName' => 'isVersionInstalled',
            'searchBuilder' => [
                'name'    => 'callback',
                'options' => [
                    'callback' => function ($query, $value) {
                        if ($value === 'Ja' || $value === '^Ja$') {
                            $query->andHaving('isVersionInstalled = TRUE');
                        } elseif ($value === 'Nein' || $value === '^Nein$') {
                            $query->andHaving('isVersionInstalled = FALSE');
                        }
                        return $query;
                    }
                ],
            ],
        ]);
        $columns[] = $colManager->get('boolean', [
            'filterType' => Column::FILTER_TYPE_DROPDOWN,
            'title' => gettext_noop('Is Module Installed'),
            'columnName' => 'isInstalled',
            'searchBuilder' => [
                'name'    => 'callback',
                'options' => [
                    'callback' => function ($query, $value) {
                        if ($value === 'Ja' || $value === '^Ja$') {
                            $query->andHaving('isInstalled = TRUE');
                        } elseif ($value === 'Nein' || $value === '^Nein$') {
                            $query->andHaving('isInstalled = FALSE');
                        }
                        return $query;
                    }
                ],
            ],
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Laminas Repository'),
            'columnName' => 'sy.repositoryName',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('Server URL'),
            'columnName' => 'se.url',
        ]);
        $columns[] = $colManager->get('default', [
            'title' => gettext_noop('IP-Address'),
            'columnName' => 'se.ipAddress',
        ]);

        return new SimpleDataTable($columns, $query, []);
    }
}

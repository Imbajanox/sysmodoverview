<?php
namespace WirklichDigital\SystemModuleOverview\Repository\Functions;

use Doctrine\ORM\EntityManager;
use WirklichDigital\DynamicEntityModule\Repository\DynamicEntityRepository;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule;

class GetModuleData
{
    /**
     * @param DynamicEntityRepository $repository
     * @param EntityManager $em
     * @param string $name
     */
    public function __invoke(DynamicEntityRepository $repository, EntityManager $entityManager, string $name, LaminasSystemServer $server, string $moduleName, string $moduleVersion)
    {
        $query = $entityManager->createQueryBuilder()
            ->select('m')
            ->from(LaminasSystemServerModule::class, 'm')
            ->join('m.laminasSystemServer', 'ls')
            ->where('m.moduleName = :moduleName')
            ->andWhere('m.moduleVersionNormalized = :moduleVersionNormalized')
            ->andWhere('ls = :server')
            ->setParameter('moduleName', $moduleName)
            ->setParameter('moduleVersionNormalized', $moduleVersion)
            ->setParameter('server', $server);

        return $query->getQuery()
            ->getResult();
    }
}
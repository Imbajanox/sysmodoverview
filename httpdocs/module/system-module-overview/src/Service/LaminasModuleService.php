<?php

namespace WirklichDigital\SystemModuleOverview\Service;

use Doctrine\ORM\EntityManager;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerComposerOutdated;
use WirklichDigital\SystemModuleOverview\Entity\NpmModules;

class LaminasModuleService
{
    public function __construct(
        protected EntityManager $entityManager
    ) {}

    public function whichUpdateIsNeeded(?string $currentVersion, ?string $newVersion): string
    {
        if($currentVersion && $newVersion){
            if (version_compare($currentVersion, $newVersion, '=') || version_compare($currentVersion, $newVersion, ">")) {
                return 'up-to-date';
            } else {
                if (version_compare($currentVersion, $newVersion, '<')) {
                    $currentParts = explode('.', $currentVersion);
                    $newParts = explode('.', $newVersion);
                    if ($currentParts[0] < $newParts[0]) {
                        return 'major';
                    } elseif (isset($currentParts[1]) && $currentParts[1] < $newParts[1]) {
                        return 'minor';
                    } elseif (isset($currentParts[2]) && $currentParts[2] < $newParts[2]) {
                        return 'patch';
                    } else {
                        return 'unknown';
                    }
                } else {
                    return 'unknown';
                }
            }
        }else{
            return "unknown";
        }
    }

    public function getAmountOfSystemsWithModules($entity, string $moduleName): int
    {
        $query = $this->entityManager->createQueryBuilder();
        $query->select('COUNT(DISTINCT n.laminasSystemServer)')
            ->from($entity, 'n')
            ->where('n.name = :name')
            ->setParameter('name', $moduleName);
        $result = $query->getQuery()->getResult();

        return $result[0][1] ?? 0;
    }

    public function getAmountOfSystemsWhichAreUpToDateWithModules($entity, string $moduleName): int
    {
        $query = $this->entityManager->createQueryBuilder();
        $query->select('n.installedVersion, n.latestVersion')
            ->from($entity, 'n')
            ->where('n.name = :name')
            ->groupBy('n.laminasSystemServer')
            ->setParameter('name', $moduleName);
        $result = $query->getQuery()->getResult();;

        $amountOfSystems = 0;
        foreach ($result as $row) {
            if (version_compare($row['installedVersion'], $row['latestVersion'], '>')) {
                $amountOfSystems++;
            }
        }

        return $amountOfSystems;
    }

    public function getAmountOfSystemsWhichAreOutdatedWithModules($entity, string $moduleName): int
    {
        $query = $this->entityManager->createQueryBuilder();
        $query->select('COUNT(DISTINCT n.laminasSystemServer)')
            ->from($entity, 'n')
            ->where('n.name = :name')
            ->setParameter('name', $moduleName);
        $result = $query->getQuery()->getResult()[0][1] ?? 0;

        $amountOfSystems = $result - $this->getAmountOfSystemsWhichAreUpToDateWithModules($entity, $moduleName);
        return $amountOfSystems;
    }

    private function getOutdated(array $rows): string
    {
        $isPatch = false;
        $isMinor = false;
        $isMajor = false;
        foreach ($rows as $row) {
            $whichUpdate = $this->whichUpdateIsNeeded($row['version'], $row['latest']);
            switch ($whichUpdate) {
                case 'major':
                    $isMajor = true;
                    break;
                case 'minor':
                    $isMinor = true;
                    break;
                case 'patch':
                    $isPatch = true;
                    break;
                default:
                    'unknown';
                    break;
            }
        }
        if ($isMajor) {
            return "major";
        } elseif ($isMinor) {
            return "minor";
        } elseif ($isPatch) {
            return "patch";
        } else {
            return "unknown";
        }
    }

    public function hasServerOutdatedComposerModules($serverId, $isWirklichDigital = false): string
    {
        $query = $this->entityManager->createQueryBuilder();
        $query->select('o.version, o.latest, o.name')
            ->from(LaminasSystemServerComposerOutdated::class, 'o')
            ->where('o.laminasSystemServer = :serverId')
            ->setParameter('serverId', $serverId)
        ;
        $result = $query->getQuery()->getResult();

        $array = [];
        foreach ($result as $row) {
            if ($isWirklichDigital) {
                if (strpos($row['name'], 'wirklich-digital') !== 0) {
                    $array["wirklichDigital"][] = $row;
                }
            } else {
                $array["other"][] = $row;
            }
        }

        if ($isWirklichDigital && isset($array["wirklichDigital"])) {
            return $this->getOutdated($array["wirklichDigital"]);
        } elseif (isset($array["other"])) {
            return $this->getOutdated($array["other"]);
        } else {
            return "unknown";
        }
    }

    public function hasServerOutdatedNpmModules($serverId): string
    {
        $query = $this->entityManager->createQueryBuilder();
        $query->select('o.installedVersion as version, o.latestVersion as latest')
            ->from(NpmModules::class, 'o')
            ->where('o.laminasSystemServer = :serverId')
            ->setParameter('serverId', $serverId)
        ;
        $result = $query->getQuery()->getResult();

        return $this->getOutdated($result);
    }
}

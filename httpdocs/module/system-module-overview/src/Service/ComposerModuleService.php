<?php

namespace WirklichDigital\SystemModuleOverview\Service;

use Doctrine\ORM\EntityManager;
use WirklichDigital\SystemModuleOverview\Entity\ComposerModule;

class ComposerModuleService
{
    public function __construct(
        protected EntityManager $entityManager
    ) {}

    public function getNumberOfSystems(ComposerModule $module): int
    {
        $mouldes = $module->getLaminasSystemServerModule();
        $servers = [];
        foreach ($mouldes as $serverModule) {
            foreach ($serverModule->getLaminasSystemServer() as $server) {
                $servers[] = $server;
            }
        }
        $numberOfSystems = count($servers);
        return $numberOfSystems;
    }
    public function getNumberOffSystemsUpToDate(ComposerModule $module): int
    {
        $upToDate = 0;
        $mouldes = $module->getLaminasSystemServerModule();
        foreach ($mouldes as $serverModule) {
            foreach ($serverModule->getLaminasSystemServer() as $server) {
                $found = false;
                foreach ($server->getLaminasSystemServerComposerOutdated() as $outdated) {
                    if ($outdated->getComposerModule() === $serverModule->getComposermodule()) {
                        $found = true;
                        if ($outdated->getLatestStatus() === 'up-to-date') {
                            $upToDate++;
                        }
                        break;
                    }
                }
                if (!$found) {
                    $upToDate++;
                }
            }
        }
        return $upToDate;
    }
    public function getNumberOfSystemsWithUpdates(ComposerModule $module): int
    {
        $withUpdates = 0;
        $mouldes = $module->getLaminasSystemServerModule();
        foreach ($mouldes as $serverModule) {
            foreach ($serverModule->getLaminasSystemServer() as $server) {
                foreach ($server->getLaminasSystemServerComposerOutdated() as $outdated) {
                    if ($outdated->getComposerModule() === $serverModule->getComposermodule()) {
                        if ($outdated->getLatestStatus() !== 'up-to-date') {
                            $withUpdates++;
                        }
                    }
                }
            }
        }
        return $withUpdates;
    }

    public function setInfosOnAllModules()
    {
        $modules = $this->entityManager->getRepository(ComposerModule::class)->findAll();
        foreach ($modules as $module) {
            /** @var ComposerModule $module  */
            $module->setSystems($this->getNumberOfSystems($module));
            $module->setUpToDate($this->getNumberOffSystemsUpToDate($module));
            $module->setOutdated($this->getNumberOfSystemsWithUpdates($module));
        }
        $this->entityManager->flush();
    }
}

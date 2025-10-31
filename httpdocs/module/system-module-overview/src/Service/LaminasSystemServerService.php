<?php

namespace WirklichDigital\SystemModuleOverview\Service;

use Doctrine\ORM\EntityManager;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer;

class LaminasSystemServerService
{
    public function __construct(
        protected EntityManager $entityManager
    ) {}

    public function getIfServerIsDeinPim(LaminasSystemServer $server)
    {
        $moduleName = "wirklich-digital/deinpim";
        $serverModules = $server->getLaminasSystemServerModule();
        foreach ($serverModules as $module) {
            if (method_exists($module, 'getName') && $module->getModuleName() === $moduleName) {
                return true;
            }
        }

        $j77Config = json_decode($server->getJ77Config(), true);
        if ($j77Config["name"] === "deinpim") {
            return true;
        }
        return false;
    }

    public function getIfServerIsDevelopment(LaminasSystemServer $server)
    {
        $url = $server->getUrl();
        //if url ends with '.e5j.de' it is a development server
        if (str_ends_with($url, '.e5j.de')) {
            return true;
        }
        return false;
    }

    public function checkAndSetIfServerHasUpdates(LaminasSystemServer $server)
    {
        $serverModules = $server->getLaminasSystemServerModule();
        $serverComposerOutdated = $server->getLaminasSystemServerComposerOutdated();

        $hasMinorUpdates = false;
        $hasWirklichDigitalMinorUpdates = false;
        $hasMajorUpdates = false;
        $hasWirklichDigitalMajorUpdates = false;

        foreach ($serverComposerOutdated as $outdated) {
            $isWirklichDigitalModule = false;
            $name = $outdated->getName();
            if (strpos($name, 'wirklich-digital') === 0) {
                $isWirklichDigitalModule = true;
            }

            switch ($outdated->getLatestStatus()) {
                case 'semver-safe-update':
                    if ($isWirklichDigitalModule) {
                        $hasWirklichDigitalMinorUpdates = true;
                    } else {
                        $hasMinorUpdates = true;
                    }
                    break;
                case 'update-possible':
                    if ($isWirklichDigitalModule) {
                        $hasWirklichDigitalMajorUpdates = true;
                    } else {
                        $hasMajorUpdates = true;
                    }
                    break;
                case 'up-to-date':
                    break;
                default:
                    break;
            }
        }

        $server->setHasMinorUpdates($hasMinorUpdates);
        $server->setHasWirklichDigitalMinorUpdates($hasWirklichDigitalMinorUpdates);
        $server->setHasMajorUpdates($hasMajorUpdates);
        $server->setHasWirklichDigitalMajorUpdates($hasWirklichDigitalMajorUpdates);

        $this->entityManager->flush();
    }

    public function getCustomerAndSubNumber($systemRepository): array
    {
        $customerNumber = null;
        $subpNumber = null;

        $customer = explode("kunde_", $systemRepository);
        $customerNumber = explode("/", $customer[1], 2)[0];

        $subp = explode("subp_", $systemRepository);
        $subpNumber = explode("/", $subp[1], 2)[0];

        return ["custNum" => $customerNumber, "subpNum" => $subpNumber];
    }
}

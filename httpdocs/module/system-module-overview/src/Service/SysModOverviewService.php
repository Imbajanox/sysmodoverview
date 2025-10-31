<?php

namespace WirklichDigital\SystemModuleOverview\Service;

use DateTime;
use Doctrine\ORM\EntityManager;
use Exception;
use Laminas\View\Model\JsonModel;
use Symfony\Component\Filesystem\Path;
use WirklichDigital\SystemModuleOverview\Entity\ComposerModule;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystem;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule;
use WirklichDigital\SystemModuleOverview\Entity\NpmModules;

use function array_unique;
use function basename;
use function class_exists;
use function count;
use function explode;
use function file_put_contents;
use function implode;
use function is_array;
use function is_dir;
use function is_integer;
use function is_string;
use function is_writable;
use function json_decode;
use function json_encode;
use function key;
use function lcfirst;
use function method_exists;
use function mkdir;
use function preg_split;
use function sprintf;
use function str_replace;
use function ucfirst;

use const PREG_SPLIT_NO_EMPTY;

class SysModOverviewService
{
    public function __construct(
        protected EntityManager $entityManager,
        protected LaminasSystemServerService $laminasSystemServerService,
        protected ComposerModuleService $composerModuleService
    ) {
    }

    private function checkIfEntityIsSet($entity, $server)
    {
        $className = "WirklichDigital\\SystemModuleOverview\\Entity\\" . $entity;
        $data      = $this->entityManager->getRepository($className)->findOneBy(["laminasSystemServer" => $server]);

        if (empty($data)) {
            return false;
        } else {
            return true;
        }
    }

    private function checkIfModuleHasMultipleVersionsForServer($name, LaminasSystemServer $server, $newestVersion)
    {
        $modules = $this->entityManager->getRepository(LaminasSystemServerModule::class)
            ->findBy(['moduleName' => $name]);

        $versions = [];
        foreach ($modules as $module) {
            if ($module->getLaminasSystemServer()->contains($server)) {
                $versions[] = $module->getModuleVersionNormalized();
            }
        }

        if (count(array_unique($versions)) > 1) {
            foreach ($modules as $module) {
                if (
                    $module->getLaminasSystemServer()->contains($server) &&
                    $module->getModuleVersionNormalized() !== $newestVersion
                ) {
                    $module->removeLaminasSystemServer([$server]);
                    $this->entityManager->persist($module);
                }
            }

            return true;
        }

        return false;
    }

    private function getModule($name, $version, LaminasSystemServer $server)
    {
        $modules = $this->entityManager->getRepository(LaminasSystemServerModule::class)
            ->findBy([
                'moduleName'              => $name,
                'moduleVersionNormalized' => $version,
            ]);

        foreach ($modules as $module) {
            if ($module->getLaminasSystemServer()->contains($server)) {
                return $module;
            }
        }

        return null;
    }

    private function checkIfModuleIsSet($name, $version, $serverIp = null)
    {
        $server = $this->entityManager->getRepository(LaminasSystemServer::class)->findOneBy(["ipAddress" => $serverIp]);
        $module = $this->entityManager->getRepository(LaminasSystemServerModule::class)->findOneBy(["moduleName" => $name, "moduleVersionNormalized" => $version]);

        if (empty($module)) {
            return false;
        } else {
            if ($server && $module->getLaminasSystemServer()->contains($server)) {
                return true;
            } else {
                if ($server) {
                    $module->addLaminasSystemServer([$server]);
                    $this->entityManager->persist($module);
                    $this->entityManager->flush();
                }

                return true;
            }
        }
    }

    private function createLaminasSystemServerIfNotExists($ipAdress, $url, $laminasSystem = null)
    {
        $server = $this->entityManager->getRepository(LaminasSystemServer::class)->findOneBy(['url' => $url]);
        if ($server) {
            $server->setIpAddress($ipAdress);
            if ($laminasSystem !== null && $server->getLaminasSystem() !== $laminasSystem) {
                $server->setLaminasSystem($laminasSystem);
            }
            $this->entityManager->flush();
            return $server;
        }

        $server = new LaminasSystemServer();
        $server->setIpAddress($ipAdress);
        $server->setUrl($url);
        if ($laminasSystem !== null) {
            $server->setLaminasSystem($laminasSystem);
        }
        $this->entityManager->persist($server);
        $this->entityManager->flush();

        return $server;
    }

    private function createLaminasSystemIfnotExists($repositoryName, $repository)
    {
        $system = $this->entityManager->getRepository(LaminasSystem::class)->findOneBy(['repositoryName' => $repositoryName]);
        if ($system) {
            return $system;
        }

        $system = new LaminasSystem();
        $system->setRepositoryName($repositoryName);
        $system->setRepository($repository);

        $this->entityManager->persist($system);
        $this->entityManager->flush();

        return $system;
    }

    public function createComposerModuleIfnotExists($vendor, $name)
    {
        $module = $this->entityManager->getRepository(ComposerModule::class)->findOneBy(['vendor' => $vendor, 'name' => $name]);
        if ($module) {
            return $module;
        }

        $module = new ComposerModule();
        $module->setVendor($vendor);
        $module->setName($name);

        $this->entityManager->persist($module);
        $this->entityManager->flush();

        return $module;
    }

    public function deleteUnnecessaryNpmModules(array $npmModules, LaminasSystemServer $laminasSystemServer)
    {
        $modules = $this->entityManager->getRepository(NpmModules::class)->findBy([
            "laminasSystemServer" => $laminasSystemServer,
        ]);

        foreach ($modules as $module) {
            /** @var NpmModules $module */
            $npmComposerModuleName = $npmModules[$module->getModule()];
            if (isset($npmComposerModuleName) && ! empty($npmComposerModuleName) && isset($npmComposerModuleName[$module->getName()])) {
                continue;
            } else {
                $this->entityManager->remove($module);
            }
        }
        $this->entityManager->flush();
    }

    public function createNpmModuleIfnotExists($npmModules, $installedModule, $laminasSystemServer)
    {
        $existingModules = [];
        foreach ($npmModules as $npmModuleName => $npmModule) {
            $module = $this->entityManager->getRepository(NpmModules::class)->findOneBy([
                "laminasSystemServer" => $laminasSystemServer,
                "module"              => $installedModule,
                "name"                => $npmModuleName,
            ]);
            if (! $module) {
                $module = new NpmModules();
                $module->setName($npmModuleName);
                $module->setInstalledVersion($npmModule["current"] ?? null);
                $module->setWantedVersion($npmModule["wanted"] ?? null);
                $module->setLatestVersion($npmModule["latest"] ?? null);
                $module->setDependencies($npmModule["dependent"] ?? null);
                $module->setLocation($npmModule["location"] ?? null);
                $module->setLaminasSystemServer($laminasSystemServer);
                $module->setModule($installedModule);
            } else {
                // Look if versions are same
                if (isset($npmModule["current"]) && $module->getInstalledVersion() !== $npmModule["current"]) {
                    $module->setInstalledVersion($npmModule["current"]);
                }
                if (isset($npmModule["wanted"]) && $module->getWantedVersion() !== $npmModule["wanted"]) {
                    $module->setWantedVersion($npmModule["wanted"]);
                }
                if (isset($npmModule["latest"]) && $module->getLatestVersion() !== $npmModule["latest"]) {
                    $module->setLatestVersion($npmModule["latest"]);
                }
                if (isset($npmModule["dependent"]) && $module->getDependencies() !== $npmModule["dependent"]) {
                    $module->setDependencies($npmModule["dependent"]);
                }
            }
            $this->entityManager->persist($module);
        }
        return $existingModules;
    }

    private function createNpmArray($npmModules)
    {
        foreach ($npmModules as $key => $module) {
            if (is_array($module)) {
                $modules = [];
                if (is_integer(key($module))) {
                    $dependencies = [];
                    foreach ($module as $depModule) {
                        $dependencies[] = $depModule["dependent"];
                    }
                    $dependencies           = array_unique($dependencies);
                    $module[0]["dependent"] = $dependencies;
                    $module                 = $module[0];
                    $modules[$key]          = $module;
                } else {
                    $modules[$key] = $module;
                }
                $npmModules[$key] = $modules[$key];
            }
        }

        return $npmModules;
    }

    public function setInfosInEntity(?array $data, $entity, $entityObject = null)
    {
        try {
            $className = "WirklichDigital\\SystemModuleOverview\\Entity\\" . $entity;

            if (! class_exists($className)) {
                throw new Exception("Class not found: " . $className);
            }

            /** @var LaminasSystemServerModule $em */
            if (! $entityObject) {
                $em = new $className();
            } elseif ($entityObject instanceof $className) {
                $em = $entityObject;
            }

            if (is_array($data)) {
                foreach ($data as $originalKey => $value) {
                    $originalKey   = str_replace("-", "", $originalKey);
                    $originalKey   = str_replace("_", "", $originalKey);
                    $parts         = preg_split('/(?=[A-Z])/', $originalKey, -1, PREG_SPLIT_NO_EMPTY);
                    $keyPart       = lcfirst(implode('', $parts));
                    $setterName    = "setModule" . ucfirst($keyPart);
                    $setterNameDb  = "setDb" . ucfirst($keyPart);
                    $setterNameAlt = "set" . ucfirst($keyPart);

                    // dump($originalKey,$value);

                    if (method_exists($em, $setterName)) {
                        if (!is_array($value)) {
                            $value = ltrim($value,"v");
                        }
                        $em->$setterName($value);
                    } elseif (method_exists($em, $setterNameDb)) {
                        $em->$setterNameDb($value);
                    } elseif (method_exists($em, $setterNameAlt)) {
                        if (!is_array($value)) {
                            $value = ltrim($value,"v");
                        }
                        $em->$setterNameAlt($value);
                    }
                }
            }
            $this->entityManager->persist($em);
            return $em;
        } catch (Exception $e) {
            echo "Fehler: " . $e->getMessage();
        }
    }

    public function setInfos(array $data)
    {
        $parsedData = $this->createModuleOverviewArray($data);
        $system = $this->processLaminasSystemAndServer($parsedData);

        $this->processEntities($parsedData, $system);
        // die("nach processEntites");
        // echo "nach precessentite";
        $this->processNpmModules($parsedData, $system);
        // die("nach npm Modules");
        $this->saveServerFiles($parsedData, $system);
        $this->runFinalServices($system);
    }

    private function createModuleOverviewArray($data)
    {
        return [
            "LaminasSystemServerModule"           => $data["modules"]["packages"] ?? [],
            "NpmModules"                          => $data["npmmodules"] ?? [],
            "LaminasSystemServer"                 => ["ipAddress" => $data["ipaddress"]],
            "LaminasSystemServerconfig"           => $data["config"] ?? [],
            "LaminasSystemServerphpinfo"          => $data["phpinfo"] ?? [],
            "LaminasSystemServerDatabaseInfo"     => $data["databaseInfo"] ?? [],
            "LaminasSystemServerMigrationInfo"    => $data["migrationState"] ?? [],
            "LaminasSystemServerComposerOutdated" => $data["composerOutdated"]["installed"] ?? [],
            "LaminasSystem"                       => $data["gitSystem"] ?? [],
            "LaminasJ77Config"                    => $data["j77Config"] ?? [],
        ];
    }

    private function processLaminasSystemAndServer(array $datas)
    {
        // Verarbeite LaminasSystem (Git)
        $repositoryName = null;
        $repositoryUrl  = null;
        foreach ($datas["LaminasSystem"] as $system) {
            if (! is_string($system)) {
                continue;
            } // Sicherstellen, dass der Wert ein String ist
            $parts = explode("=", $system);
            if (count($parts) === 2) {
                if ($parts[0] === "remote.origin.url") {
                    $repositoryUrl  = $parts[1];
                    $repositoryFile = basename($repositoryUrl);
                    $repositoryName = str_replace(".git", "", $repositoryFile);
                }
            }
        }

        $system = $this->createLaminasSystemIfnotExists($repositoryName, $repositoryUrl);

        // Bestimme die URL des Servers
        $j77Url = null;
        if ($datas["LaminasJ77Config"]) {
            $j77Config = $datas["LaminasJ77Config"];
            $j77Url    = sprintf("https://%s-%s-%s.e5j.de", $j77Config["pms_id"], $j77Config["name"], $j77Config["branch"]);
        }

        $laminasSystemUrl = $datas["LaminasSystemServerconfig"]["wirklich-digital"]["system-options"]["application.site.base-url"]["default"] ?? null;
        $serverUrl        = $j77Url ?: $laminasSystemUrl;

        // Erstelle oder aktualisiere den Server
        $server = $this->createLaminasSystemServerIfNotExists($datas["LaminasSystemServer"]["ipAddress"], $serverUrl, $system);
        $server->setUpdatedAt(new DateTime('now'));

        if ($datas["LaminasJ77Config"]) {
            $server->setJ77Config(json_encode($datas["LaminasJ77Config"]));
        }

        return $server;
    }

    /**
     * @param LaminasSystemServer $server
     * @return void
     */
    private function processEntities(array $datas, $server)
    {
        $serverIpAddress = $server->getIpAddress();
        $modules         = [];
        // Process LaminasSystemServerModule (Composer modules)
        if (isset($datas["LaminasSystemServerModule"])) {
            // dump($datas["LaminasSystemServerModule"]);
            // die("in Lamianssystemservermodule");
            foreach ($datas["LaminasSystemServerModule"] as $module) {
                if (! $this->checkIfModuleIsSet($module["name"], $module["version_normalized"], $serverIpAddress)) {
                    $entity = $this->setInfosInEntity($module, "LaminasSystemServerModule");
                    $entity->addLaminasSystemServer([$server]);
                    $modules[] = $entity;
                } else {
                    $entity = $this->getModule($module["name"], $module["version_normalized"], $server);
                    $entity = $this->setInfosInEntity($module, "LaminasSystemServerModule", $entity);
                    if (! $entity->getLaminasSystemServer()->contains($server)) {
                        $entity->addLaminasSystemServer([$server]);
                    }
                    $modules[] = $entity;
                }

                // Common logic for both new and existing modules
                $parts  = explode('/', $module["name"], 2);
                $vendor = $parts[0] ?? null;
                $name   = $parts[1] ?? null;
                if ($vendor && $name) {
                    $composerModule = $this->createComposerModuleIfnotExists($vendor, $name);
                    $entity->setComposerModule($composerModule);
                }
            }
            // die("vor zweitem foreach");
            foreach ($modules as $module) {
                $this->checkIfModuleHasMultipleVersionsForServer($module->getModuleName(), $server, $module->getModuleVersionNormalized());
            }
        }

        // Process ComposerOutdated and DatabaseInfo
        foreach (["LaminasSystemServerComposerOutdated", "LaminasSystemServerDatabaseInfo"] as $key) {
            if (isset($datas[$key]) && is_array($datas[$key])) {
                foreach ($datas[$key] as $data) {
                    $entityName = "WirklichDigital\\SystemModuleOverview\\Entity\\" . $key;

                    // Suche nach der Entität basierend auf spezifischen Kriterien
                    $findCriteria = ["laminasSystemServer" => $server];

                    if ($key === "LaminasSystemServerComposerOutdated") {
                        $findCriteria['name'] = $data['name'];
                    } elseif ($key === "LaminasSystemServerDatabaseInfo") {
                        // Hier wird der Datenbankname als Kriterium hinzugefügt
                        $findCriteria['dbName'] = $data['Name'];
                    }

                    // Versuche, eine vorhandene Entität zu finden
                    $entity = $this->entityManager->getRepository($entityName)->findOneBy($findCriteria);

                    // Wenn keine Entität gefunden wird, erstelle eine neue
                    if ($entity === null) {
                        $entity = $this->setInfosInEntity($data, $key);
                    } else {
                        // Wenn eine Entität gefunden wird, aktualisiere sie
                        $entity = $this->setInfosInEntity($data, $key, $entity);
                    }

                    $entity->setLaminasSystemServer($server);

                    // Speziallogik nur für ComposerOutdated
                    if ($key === "LaminasSystemServerComposerOutdated") {
                        $parts  = explode('/', $data["name"], 2);
                        $vendor = $parts[0] ?? null;
                        $name   = $parts[1] ?? null;
                        if ($vendor && $name) {
                            $composerModule = $this->createComposerModuleIfnotExists($vendor, $name);
                            $entity->setComposerModule($composerModule);
                        }
                    }
                }
            }
        }

        // Process MigrationState
        if (isset($datas["LaminasSystemServerMigrationInfo"])) {
            $key        = "LaminasSystemServerMigrationInfo";
            $entityName = "WirklichDigital\\SystemModuleOverview\\Entity\\" . $key;

            if (! $this->checkIfEntityIsSet($key, $server)) {
                $entity = $this->setInfosInEntity($datas[$key], $key);
            } else {
                $entity = $this->entityManager->getRepository($entityName)->findOneBy(["laminasSystemServer" => $server]);
                $entity = $this->setInfosInEntity($datas[$key], $key, $entity);
            }
            $entity->setLaminasSystemServer($server);
        }

        $this->entityManager->flush();
    }

    private function processNpmModules($datas, $server)
    {
        if ($datas["NpmModules"] !== null) {
            $npmModules = [];
            foreach ($datas["NpmModules"] as $key => $module) {
                $npmModules[$key] = json_decode($module, true);
            }

            foreach ($npmModules as $key => $modules) {
                if (empty($modules)) {
                    continue;
                }
                // Create NPM Modules
                $npmModule        = $this->createNpmArray($modules);
                $npmModules[$key] = $npmModule;
                $npmModule        = $this->createNpmModuleIfnotExists($npmModule, $key, $server);
            }
            $this->entityManager->flush();
            $this->deleteUnnecessaryNpmModules($npmModules, $server);
        }
    }

    private function saveServerFiles($datas, $server)
    {
        $serverId = $server->getId();

        $fileFolder = "data/sysmoddatas";
        if (! is_dir($fileFolder)) {
            mkdir($fileFolder, 0755, true);
        }

        if (! is_writable($fileFolder)) {
            return;
        }

        // PHPInfo
        if (isset($datas["LaminasSystemServerphpinfo"])) {
            $phpInfoPath = Path::join($fileFolder, "LaminasSystemServerphpinfo-$serverId.json");
            file_put_contents($phpInfoPath, json_encode($datas["LaminasSystemServerphpinfo"]));
            $server->setPhpinfo($phpInfoPath);
            if(isset($datas["LaminasSystemServerphpinfo"]["PHP Version"][0])){
                $server->setPhpVersion($datas["LaminasSystemServerphpinfo"]["PHP Version"][0] ?? null);
            }elseif(isset($datas["LaminasSystemServerphpinfo"]["PHP Version "][0])){
                $server->setPhpVersion($datas["LaminasSystemServerphpinfo"]["PHP Version "][0] ?? null);
            }
        }else{
            return new JsonModel([
                'message' => 'No PHP-Info found'
            ]);
        }

        // Config
        if (isset($datas["LaminasSystemServerconfig"])) {
            $configPath = Path::join($fileFolder, "LaminasSystemServerconfig-$serverId.json");
            file_put_contents($configPath, json_encode($datas["LaminasSystemServerconfig"]));
            $server->setConfig($configPath);
        }else{
            return new JsonModel([
                'message' => 'No Serverconfig found'
            ]);
        }
    }

    private function runFinalServices($server)
    {
        // Die folgenden Aufrufe wurden aus der Originalmethode extrahiert
        $isDeinPim = $this->laminasSystemServerService->getIfServerIsDeinPim($server);
        $server->setIsDeinPim($isDeinPim);

        $isDevelopmentServer = $this->laminasSystemServerService->getIfServerIsDevelopment($server);
        $server->setIsDevelopment($isDevelopmentServer);

        $this->laminasSystemServerService->checkAndSetIfServerHasUpdates($server);

        $this->composerModuleService->setInfosOnAllModules();

        $this->entityManager->flush();
    }
}

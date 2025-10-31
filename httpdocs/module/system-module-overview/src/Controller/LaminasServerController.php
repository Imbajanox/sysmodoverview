<?php

namespace WirklichDigital\SystemModuleOverview\Controller;

use Doctrine\ORM\EntityManager;
use Laminas\Form\FormElementManager;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use WirklichDigital\DataTables\Service\DataTableAPI;
use WirklichDigital\DataTables\Service\TablePluginManager;
use WirklichDigital\DynamicCrudModule\Controller\AbstractCrudActionController;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServer;
use WirklichDigital\SystemModuleOverview\Service\LaminasModuleService;

use function explode;
use function file_exists;
use function file_get_contents;
use function gettext_noop;
use function is_array;
use function is_string;
use function json_decode;
use function preg_replace;
use function str_ends_with;
use function strpos;
use function trim;

class LaminasServerController extends AbstractCrudActionController
{
    public function __construct(
        protected EntityManager $entityManager,
        protected TablePluginManager $tablePluginManager,
        protected FormElementManager $formManager,
        protected DataTableAPI $dataTableApi,
        protected LaminasModuleService $moduleService
    ) {
    }

    public function viewAction()
    {
        $serverId = $this->params()->fromRoute('id', null);
        /** @var LaminasSystemServer $server */
        $server  = $this->entityManager->getRepository(LaminasSystemServer::class)->find($serverId);
        $system  = $server->getLaminasSystem();
        $repoUrl = $system->getRepository();
        if (is_string($repoUrl)) {
            $repoUrl = preg_replace('#^ssh://git@git\.jar\.media:8723/pms/#', '', $repoUrl);
            $repoUrl = preg_replace('#\.git$#', '', $repoUrl);
        }

        $phpInfoFilePath = $server->getPhpinfo();
        $serverPhpInfo   = [];
        if (is_string($phpInfoFilePath) && file_exists($phpInfoFilePath)) {
            $content       = file_get_contents($phpInfoFilePath);
            $serverPhpInfo = json_decode($content, true);
            if (! is_array($serverPhpInfo)) {
                $serverPhpInfo = [];
            }
        }

        $laminasMigration = $server->getLaminasSystemServerMigrationInfo()[0];
        $db               = $laminasMigration ? $laminasMigration->getDatabaseDetails() : null;
        $versions         = $laminasMigration ? $laminasMigration->getVersions() : null;
        $migrations       = $laminasMigration ? $laminasMigration->getMigrationDetails() : null;
        $modules          = $server->getLaminasSystemServerModule();
        $composerOutdated = $server->getLaminasSystemServerComposerOutdated();

        $modulesWithComposerOutdated = [];

        $composerOutdatedByModuleId = [];
        foreach ($composerOutdated as $outdated) {
            $composerModule = $outdated->getComposerModule();
            if ($composerModule) {
                $composerOutdatedByModuleId[$composerModule->getId()] = $outdated;
            }
        }
        foreach ($modules as $module) {
            $composerModule = $module->getComposerModule();
            $outdated       = null;
            if ($composerModule && isset($composerOutdatedByModuleId[$composerModule->getId()])) {
                $outdated = $composerOutdatedByModuleId[$composerModule->getId()];
            }
            $modulesWithComposerOutdated[] = [
                'module'           => $module,
                'composerOutdated' => $outdated,
            ];
        }
        $database  = $server->getLaminasSystemServerDatabaseInfo()->getValues();
        $ipAddress = $server->getIpAddress();
        $ipv4      = '';
        $ipv6      = '';
        if (strpos($ipAddress, '-') !== false) {
            [$ipv4, $ipv6] = explode('-', $ipAddress, 2);
            $ipv4          = trim($ipv4);
            $ipv6          = trim($ipv6);
        } else {
            $ipv4 = trim($ipAddress);
        }

        return new ViewModel([
            'server'                      => $server,
            'system'                      => $system,
            'ipv4'                        => $ipv4,
            'ipv6'                        => $ipv6,
            'repo'                        => $repoUrl,
            'modules'                     => $modules,
            'database'                    => $db,
            'versions'                    => $versions,
            'migrations'                  => $migrations,
            'databaseInfo'                => $database,
            'php'                         => $serverPhpInfo['PHP Version'] ?? '',
            'systemInfo'                  => $serverPhpInfo['System'] ?? '',
            'devSystem'                   => is_string($server->getUrl()) && str_ends_with($server->getUrl(), '.e5j.de'),
            'composerOutdated'            => $composerOutdated,
            'modulesWithComposerOutdated' => $modulesWithComposerOutdated,
        ]);
    }

    public function listAction()
    {
        $systemId = $this->params()->fromRoute('id', null);
        return new ViewModel([
            'datatable' => 'serverTable',
            'systemId'  => $systemId,
        ]);
    }

    public function listAjaxAction()
    {
        $systemId     = $this->params()->fromRoute('id', null);
        $tableOptions = [];
        if ($systemId !== null) {
            $tableOptions['systemId']      = $systemId;
            $tableOptions['classCallback'] = '';
        }
        $table = $this->getTablePluginManager()->get('serverTable', $tableOptions);

        return new JsonModel($this->getDataTableApi()->handle($table, $this->getRequest()));
    }

    public function getTablePluginManager()
    {
        return $this->tablePluginManager;
    }

    public function getDataTableApi()
    {
        return $this->dataTableApi;
    }
}

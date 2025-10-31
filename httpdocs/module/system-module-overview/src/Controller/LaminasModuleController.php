<?php

namespace WirklichDigital\SystemModuleOverview\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;
use Laminas\Form\FormElementManager;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use WirklichDigital\DataTables\Service\DataTableAPI;
use WirklichDigital\DataTables\Service\TablePluginManager;
use WirklichDigital\SystemModuleOverview\Entity\ComposerModule;
use WirklichDigital\SystemModuleOverview\Service\LaminasModuleService;

class LaminasModuleController extends AbstractActionController
{
    public function __construct(
        protected EntityManager $entityManager,
        protected FormElementManager $formManager,
        protected DataTableAPI $dataTableApi,
        protected TablePluginManager $tablePluginManager,
        protected LaminasModuleService $moduleService,
    ) {}

    public function moduleAction()
    {
        $this->redirect()->toRoute('sysModOverview/module/list');
        return new ViewModel();
    }

    public function extendedAction()
    {
        $viewModel = new ViewModel([
            'composerDatatable' => 'composerModuleExtendedTable',
            'npmDatatable' => 'npmModuleExtendedTable',
        ]);
        return $viewModel;
    }
    public function composerExtendedAjaxAction()
    {
        return new JsonModel($this->getDataTableApi()->handle('composerModuleExtendedTable', $this->getRequest()));
    }
    public function npmExtendedAjaxAction()
    {
        return new JsonModel($this->getDataTableApi()->handle('npmModuleExtendedTable', $this->getRequest()));
    }

    public function listAction()
    {
        $viewModel = new ViewModel([
            'composerDatatable' => 'composerModuleTable',
            'npmDatatable' => 'npmModuleTable',
        ]);
        return $viewModel;
    }

    public function composerListAjaxAction()
    {
        return new JsonModel($this->getDataTableApi()->handle('composerModuleTable', $this->getRequest()));
    }
    public function npmListAjaxAction()
    {
        return new JsonModel($this->getDataTableApi()->handle('npmModuleTable', $this->getRequest()));
    }

    public function viewAction()
    {
        $vendor = $this->params()->fromRoute("vendor", null);
        $name = $this->params()->fromRoute("name", null);

        $module = $this->entityManager->getRepository(ComposerModule::class)->findOneBy(['vendor' => $vendor, 'name' => $name]);
        $composerOutdated = $module->getLaminasSystemServerComposerOutdated()->getValues();
        $composerServers = [];
        foreach ($composerOutdated as $composer) {
            $serverCollection = $composer->getLaminasSystemServer();
            if ($serverCollection && is_iterable($serverCollection)) {
                foreach ($serverCollection as $server) {
                    if ($server) {
                        $composerServers[] = $server;
                    }
                }
            } elseif ($serverCollection) {
                $composerServers[] = $serverCollection;
            }
        }

        $serverModules = $module->getLaminasSystemServerModule()->getValues();
        $servers = [];
        foreach ($serverModules as $serverModule) {
            $serverCollection = $serverModule->getLaminasSystemServer();
            if ($serverCollection && is_iterable($serverCollection)) {
                foreach ($serverCollection as $server) {
                    if ($server) {
                        $servers[] = $server;
                    }
                }
            } elseif ($serverCollection) {
                $servers[] = $serverCollection;
            }
        }
        $serverInfo = [];
        foreach ($servers as $server) {
            $matchingComposerOutdated = null;
            foreach ($composerOutdated as $composer) {
                $composerServersForOutdated = $composer->getLaminasSystemServer();
                if ($composerServersForOutdated && is_iterable($composerServersForOutdated)) {
                    foreach ($composerServersForOutdated as $composerServer) {
                        if ($composerServer === $server) {
                            $matchingComposerOutdated = $composer;
                            break 2;
                        }
                    }
                } elseif ($composerServersForOutdated && $composerServersForOutdated === $server) {
                    $matchingComposerOutdated = $composer;
                    break;
                }
            }

            $matchingServerModule = null;
            foreach ($serverModules as $serverModule) {
                $serverCollection = $serverModule->getLaminasSystemServer();
                if ($serverCollection && is_iterable($serverCollection)) {
                    foreach ($serverCollection as $serverItem) {
                        if ($serverItem === $server) {
                            $matchingServerModule = $serverModule;
                            break 2;
                        }
                    }
                } elseif ($serverCollection && $serverCollection === $server) {
                    $matchingServerModule = $serverModule;
                    break;
                }
            }

            $serverInfo[] = [
                'composerModulVendor' => $module->getVendor(),
                'composerModulName' => $module->getName(),
                'serverId' => $server->getId(),
                'systemRepositoryName' => $server->getLaminasSystem()->getRepositoryName(),
                'serverURL' => $server->getUrl(),
                'ipAddress' => $server->getIpAddress(),
                'composerOutdated' => $matchingComposerOutdated,
                'version' => $matchingComposerOutdated ? $matchingComposerOutdated->getVersion() : $matchingServerModule->getModuleVersion(),
                'latestVersion' => $matchingComposerOutdated ? $matchingComposerOutdated->getLatest() : "unknown",
                'outdated' => $this->moduleService->whichUpdateIsNeeded(
                    $matchingComposerOutdated ? $matchingComposerOutdated->getVersion() : null,
                    $matchingComposerOutdated ? $matchingComposerOutdated->getLatest() : null
                ),
            ];
        }

        return new ViewModel([
            'vendor' => $vendor,
            'name' => $name,
            'serverInfo' => $serverInfo
        ]);
    }

    public function npmViewAction()
    {
        $name = $this->params()->fromRoute("name", null);

        return new ViewModel([
            'name' => $name,
            'datatable' => 'npmModuleViewTable',
        ]);
    }

    public function npmViewAjaxAction()
    {
        $name = $this->params()->fromRoute('name', null);
        $tableOptions = [];
        if ($name !== null) {
            $tableOptions['name'] = $name;
        }
        $table = $this->getTablePluginManager()->get('npmModuleViewTable', $tableOptions);

        return new JsonModel($this->getDataTableApi()->handle($table, $this->getRequest()));
    }

    public function getTablePluginManager()
    {
        return $this->tablePluginManager;
    }

    public function getFormElementManager()
    {
        return $this->formManager;
    }

    public function getDataTableApi()
    {
        return $this->dataTableApi;
    }
}

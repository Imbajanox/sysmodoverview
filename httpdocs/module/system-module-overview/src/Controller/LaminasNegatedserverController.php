<?php

namespace WirklichDigital\SystemModuleOverview\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;
use Laminas\Form\FormElementManager;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use WirklichDigital\DataTables\Service\DataTableAPI;
use WirklichDigital\DataTables\Service\TablePluginManager;
use WirklichDigital\DynamicCrudModule\Controller\AbstractCrudActionController;
use WirklichDigital\SystemModuleOverview\Entity\ComposerModule;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule;
use WirklichDigital\SystemModuleOverview\Form\ModuleForm;
use WirklichDigital\SystemModuleOverview\Service\SysModOverviewService;
use Laminas\Mvc\I18n\Translator;

class LaminasNegatedserverController extends AbstractCrudActionController
{
    public function __construct(
        protected EntityManager $entityManager,
        protected SysModOverviewService $sysModOverviewService,
        protected FormElementManager $formManager,
        protected DataTableAPI $dataTableApi,
        protected TablePluginManager $tablePluginManager,
        protected Translator $translator,
    ) {}

    public function negatedserverAction()
    {
        $this->redirect()->toRoute('sysModOverview/module/negatedserver/list');
        return new ViewModel();
    }

    public function listAction()
    {
        /** @var Request */
        $request = $this->getRequest();
        /** @var ModuleForm $form */
        $form = $this->getFormElementManager()->get(ModuleForm::class);

        if ($request->isPost()) {
            $data = $request->getPost();
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $moduleName = str_replace("/", "_", $data["modulename"]);
                $moduleVersion = $data["moduleversion"];
            }
        }

        return new ViewModel([
            'form' => $form,
            'datatable' => 'negatedserverTable',
            'moduleName' => $moduleName ?? "assetic/framework",
            'moduleVersion' => $moduleVersion ?? "3.1.3",
        ]);
    }

    public function composerListAjaxAction()
    {
        $moduleName = $this->params()->fromRoute('modulename', null);
        $moduleVersion = $this->params()->fromRoute('moduleversion', null);

        $tableOptions = [];
        if ($moduleName !== null) {
            $tableOptions['moduleName'] = $moduleName;
        } else {
            $tableOptions['moduleName'] = 'assetic/framework';
        }
        if ($moduleVersion !== null) {
            $tableOptions['moduleVersion'] = $moduleVersion;
        } else {
            $tableOptions['moduleVersion'] = '3.1.3';
        }

        $table = $this->getTablePluginManager()->get('negatedserverTable', $tableOptions);
        return new JsonModel($this->getDataTableApi()->handle($table, $this->getRequest()));
    }

    public function getModuleAction()
    {
        /** @var Request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            $postData = $request->getPost()->toArray();

            $responseData = null;
            if (isset($postData['module']) && isset($postData['vendorModule'])) {
                [$vendor, $moduleName] = explode('/', $postData['vendorModule'], 2);

                $this->entityManager->getRepository(ComposerModule::class)->findOneBy(['name' => $moduleName]);

                $composerModule = $this->entityManager->getRepository(ComposerModule::class)->findOneBy(['name' => $moduleName, 'vendor' => $vendor]);
                $moduleVersions = [];
                if ($composerModule) {
                    $modules = $this->entityManager->getRepository(LaminasSystemServerModule::class)->findBy(['composerModule' => $composerModule]);
                    foreach ($modules as $mod) {
                        $version = $mod->getModuleVersion();
                        if ($version && !in_array($version, $moduleVersions)) {
                            $moduleVersions[] = $version;
                        }
                    }
                }
                $responseData['versions'] = $moduleVersions;

                $responseData['status'] = 'success';
                $responseData['message'] = sprintf($this->translator->translate("Fetch module successfully %s"), $moduleName);
                $responseData['module'] = $moduleName;
                $responseData['vendor'] = $vendor;
            }
            return new JsonModel($responseData);
        }
    }

    private function getFormElementManager()
    {
        return $this->formManager;
    }

    private function getTablePluginManager()
    {
        return $this->tablePluginManager;
    }

    private function getDataTableApi()
    {
        return $this->dataTableApi;
    }
}

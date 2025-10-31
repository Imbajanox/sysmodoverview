<?php
namespace WirklichDigital\SystemModuleOverview\Controller;

use Doctrine\ORM\EntityManager;
use Laminas\Form\FormElementManager;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use WirklichDigital\DataTables\Service\DataTableAPI;
use WirklichDigital\DynamicCrudModule\Controller\AbstractCrudActionController;

class LaminasSystemController extends AbstractCrudActionController
{
    public function __construct(
        protected EntityManager $entityManager,
        protected FormElementManager $formManager, 
        protected DataTableAPI $dataTableApi
    ) {
    }

    public function systemAction()
    {
        $this->redirect()->toRoute('sysModOverview/system/list');
        return new ViewModel();
    }

    public function listAction()
    {
        $viewModel = new ViewModel([
            'datatable' => 'systemTable'
        ]);
        return $viewModel;
    }

    public function listAjaxAction()
    {
        return new JsonModel($this->getDataTableApi()->handle('systemTable', $this->getRequest()));
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

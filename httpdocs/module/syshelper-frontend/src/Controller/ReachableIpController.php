<?php

namespace WirklichDigital\SyshelperFrontend\Controller;

use WirklichDigital\DynamicCrudModule\Controller\AbstractCrudActionController;
use WirklichDigital\DataTables\Service\DataTableAPI;
use Laminas\View\Model\ViewModel;
use Laminas\View\Model\JsonModel;
use Laminas\Form\FormElementManager;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperBase\Entity\ReachableIp;
use WirklichDigital\SyshelperFrontend\Form\ReachableIpForm;

class ReachableIpController extends AbstractCrudActionController
{

    /**
     * @var FormElementManager
     */
    protected $formManager = null;

    /**
     * @var DataTableApi
     */
    protected $dataTableApi = null;

    public function __construct(\Doctrine\ORM\EntityManager $em, \Laminas\Form\FormElementManager $formManager, \WirklichDigital\DataTables\Service\DataTableAPI $dataTableApi)
    {
        parent::__construct($em);
        $this->formManager = $formManager;
        $this->dataTableApi = $dataTableApi;
    }

    public function redirectToList()
    {
        return $this->redirect()->toRoute('syshelper-frontend/assigned-ip/list');
    }

    public function closePopupAndRedirectToList()
    {
        return $this->closePopup(true, $this->url()->fromRoute('syshelper-frontend/assigned-ip/list'));
    }

    public function getFormElementManager()
    {
        return $this->formManager;
    }

    public function getDataTableApi()
    {
        return $this->dataTableApi;
    }

    public function listAction()
    {
        $viewModel = new ViewModel([
            'datatable' => 'reachableIpTable',
        ]);
        return $viewModel;
    }

    public function listAjaxAction()
    {
        return new JsonModel($this->getDataTableApi()->handle('reachableIpTable', $this->getRequest()));
    }

    public function indexAction()
    {
        return $this->redirectToList();
    }

    public function updateAction()
    {
        $id = $this->params()->fromRoute("id", null);
        $form = $this->getFormElementManager()->get(ReachableIpForm::class);
        $viewModel = new ViewModel(["form" => $form]);

        if ($id === null) {
            return $this->closePopupAndRedirectToList();
        }

        $item = $this->getEntityManager()->getRepository(ReachableIp::class)->find($id);
        if ($item === null) {
            return $this->closePopupAndRedirectToList();
        }

        $viewModel->setVariable("item", $item);

        if ($this->editItem($item, $form)) {
            return $this->closePopupAndRedirectToList();
        }

        return $viewModel;
    }

}

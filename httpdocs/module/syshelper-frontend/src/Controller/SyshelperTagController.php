<?php

namespace WirklichDigital\SyshelperFrontend\Controller;

use WirklichDigital\DynamicCrudModule\Controller\AbstractCrudActionController;
use WirklichDigital\DataTables\Service\DataTableAPI;
use Laminas\View\Model\ViewModel;
use Laminas\View\Model\JsonModel;
use Laminas\Form\FormElementManager;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperBase\Entity\SyshelperTag;
use WirklichDigital\SyshelperFrontend\Form\SyshelperTagForm;

class SyshelperTagController extends AbstractCrudActionController
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
        return $this->redirect()->toRoute('syshelper-frontend/syshelper-tag/list');
    }

    public function closePopupAndRedirectToList()
    {
        return $this->closePopup(true, $this->url()->fromRoute('syshelper-frontend/syshelper-tag/list'));
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
            'datatable' => 'syshelperTagTable',
        ]);
        return $viewModel;
    }

    public function listAjaxAction()
    {
        return new JsonModel($this->getDataTableApi()->handle('syshelperTagTable', $this->getRequest()));
    }

    public function indexAction()
    {
        return $this->redirectToList();
    }

    public function createAction()
    {
        $request = $this->getRequest();
        $form = $this->getFormElementManager()->get(SyshelperTagForm::class);

        $viewModel = new ViewModel(['form' => $form]);

        if ($request->isPost()) {
            $item = new SyshelperTag();
            if ($this->createItem($item, $form)) {
                return $this->closePopupAndRedirectToList();
            }
        }

        return $viewModel;
    }

    public function updateAction()
    {
        $id = $this->params()->fromRoute("id", null);
        $form = $this->getFormElementManager()->get(SyshelperTagForm::class);
        $viewModel = new ViewModel(["form" => $form]);

        if ($id === null) {
            return $this->closePopupAndRedirectToList();
        }

        $item = $this->getEntityManager()->getRepository(SyshelperTag::class)->find($id);
        if ($item === null) {
            return $this->closePopupAndRedirectToList();
        }

        $viewModel->setVariable("item", $item);

        if ($this->editItem($item, $form)) {
            return $this->closePopupAndRedirectToList();
        }

        return $viewModel;
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id', null);

        if (! $id) {
            return $this->redirectToList();
        }

        $item = $this->getEntityManager()->getRepository(SyshelperTag::class)->find($id);
        // no item found
        if ($item === null) {
            return $this->redirectToList();
        }

        if ($this->deleteItem($item)) {
        } else {
        }

        return $this->redirectToList();
    }
}

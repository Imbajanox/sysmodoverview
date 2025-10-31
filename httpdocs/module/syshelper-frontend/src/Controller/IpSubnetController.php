<?php

namespace WirklichDigital\SyshelperFrontend\Controller;

use WirklichDigital\DynamicCrudModule\Controller\AbstractCrudActionController;
use WirklichDigital\DataTables\Service\DataTableAPI;
use Laminas\View\Model\ViewModel;
use Laminas\View\Model\JsonModel;
use Laminas\Form\FormElementManager;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperAlerts\Entity\Alert;
use WirklichDigital\SyshelperBase\Entity\IpSubnet;
use WirklichDigital\SyshelperFrontend\Form\IpSubnetForm;

class IpSubnetController extends AbstractCrudActionController
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
        return $this->redirect()->toRoute('syshelper-frontend/ip-subnet/list');
    }

    public function closePopupAndRedirectToList()
    {
        return $this->closePopup(true, $this->url()->fromRoute('syshelper-frontend/ip-subnet/list'));
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
            'datatable' => 'ipSubnetTable',
        ]);
        return $viewModel;
    }

    public function listAjaxAction()
    {
        return new JsonModel($this->getDataTableApi()->handle('ipSubnetTable', $this->getRequest()));
    }

    public function indexAction()
    {
        return $this->redirectToList();
    }

    public function showAction()
    {
        $id = $this->params()->fromRoute("id", null);

        $viewModel = new ViewModel([]);
        $item = $this->getEntityManager()->getRepository(IpSubnet::class)->find($id);

        $viewModel->setVariable("subnet", $item);

        
        if($item->getNetworkAddress()->getVersion() == 4)
            $maxCidr = 32;
        else
            $maxCidr = 128;
        $maxIps = pow(2,($maxCidr-$item->getNetworkCidrMask()));
        
        $viewModel->setVariable("maxIps", $maxIps);
        $viewModel->setVariable("maxCidr", $maxCidr);

        return $viewModel;
    }

    public function toggleIsDynamicAction()
    {
        $id = $this->params()->fromRoute("id", null);
        $item = $this->getEntityManager()->getRepository(IpSubnet::class)->find($id);
        if(!empty($item))
        {
            $item->setIsDynamic(!$item->getIsDynamic());
            $item->setIsDynamicSetManually(true);
        }
        $this->getEntityManager()->flush($item);

        return $this->redirect()->toRoute('syshelper-frontend/ip-subnet/show',['id' => $id]);
    }

    public function updateAction()
    {
        $id = $this->params()->fromRoute("id", null);
        $form = $this->getFormElementManager()->get(IpSubnetForm::class);
        $viewModel = new ViewModel(["form" => $form]);

        if ($id === null) {
            return $this->closePopupAndRedirectToList();
        }

        $item = $this->getEntityManager()->getRepository(IpSubnet::class)->find($id);
        if ($item === null) {
            return $this->closePopupAndRedirectToList();
        }

        $viewModel->setVariable("item", $item);

        if ($this->editItem($item, $form)) {
            return $this->closePopupAndRedirectToList();
        }

        return $viewModel;
    }

    public function removeAction()
    {
        $sn = $this->getEntityManager()->getRepository(IpSubnet::class)->find($this->params()->fromRoute('id'));
	//Remove all Alerts concerning this Subnet
        foreach ($sn->getAlerts() as $alert) {
            $this->getEntityManager()->remove($alert);
            $sn->removeAlerts([$alert]);
        }
        foreach ($sn->getReachableIps() as $rIp) {
            $assIp = $rIp->getAssignedIp();
            if ($assIp) {
		//Remove all Alerts concerning AssignedIPs in this Subnet
                foreach ($assIp->getAlerts() as $alert) {
                    $this->getEntityManager()->remove($alert);
                    $assIp->removeAlerts([$alert]);
                }
                $assIp->setReachableIp(null);
                $assIp->setSubnet(null);
                $this->getEntityManager()->remove($assIp);
                $this->getEntityManager()->flush();
            }
	    //Remove all Alerts identifying by this ReachableIP
	    $alerts = $this->getEntityManager()->getRepository(Alert::class)->findBy(['alertIdentifier' => $rIp->getId()]);
            foreach ($alerts as $alert) {
                $this->getEntityManager()->remove($alert);
                $rIp->removeAlerts([$alert]);
            }
	    //Remove all Alerts known by this ReachableIP
            foreach ($rIp->getAlerts() as $alert) {
                $this->getEntityManager()->remove($alert);
                $rIp->removeAlerts([$alert]);
            }
            $rIp->setAssignedIp(null);
            $rIp->setSubnet(null);
            $this->getEntityManager()->remove($rIp);
            $this->getEntityManager()->flush();
        }
        $sn->setAssignedIps(null);
        $sn->setReachableIps(null);
        $this->getEntityManager()->remove($sn);
        $this->getEntityManager()->flush();
        return $this->redirect()->toRoute('syshelper-frontend/dashboard');
    }

}

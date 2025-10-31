<?php

namespace WirklichDigital\SyshelperFrontend\Controller;

use WirklichDigital\DynamicCrudModule\Controller\AbstractCrudActionController;
use WirklichDigital\DataTables\Service\DataTableAPI;
use Laminas\View\Model\ViewModel;
use Laminas\View\Model\JsonModel;
use Laminas\Form\FormElementManager;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin;
use WirklichDigital\SyshelperFrontend\Form\HostForm;

class HostController extends AbstractCrudActionController
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
        return $this->redirect()->toRoute('syshelper-frontend/host/list');
    }

    public function closePopupAndRedirectToList()
    {
        return $this->closePopup(true, $this->url()->fromRoute('syshelper-frontend/host/list'));
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
            'datatable' => 'hostTable'
        ]);
        return $viewModel;
    }

    public function listAjaxAction()
    {
        return new JsonModel($this->getDataTableApi()->handle('hostTable', $this->getRequest()));
    }

    public function indexAction()
    {
        return $this->redirectToList();
    }

    public function showAction()
    {
        /** @var Host */
        $host = $this->getEntityManager()->getRepository(Host::class)->find($this->params()->fromRoute('id'));

        $domains = [];
        if(!empty($host->getWebserverDomainsApache()))
        {
            foreach($host->getWebserverDomainsApache() as $domain)
            {
                if(!isset($domains[$domain]))
                    $domains[$domain] = ['apache'];
            }
        }
        if(!empty($host->getWebserverDomainsNginx()))
        {
            foreach($host->getWebserverDomainsNginx() as $domain)
            {
                if(!isset($domains[$domain]))
                    $domains[$domain] = [];
                $domains[$domain][] = 'nginx';
            }
        }

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('l')
            ->from(SshPublicKeyLogin::class, 'l')
            ->where('l.host = :host')
            ->orderBy('l.loggedInAt', 'DESC')
            ->setMaxResults(100)
            ->setParameter('host', $host);
        $logins = $qb->getQuery()->getResult();

        return new ViewModel([
            'host' => $host,
            'domains' => $domains,
            'logins' => $logins
        ]);
    }

    public function removeAction()
    {
        $host = $this->getEntityManager()->getRepository(Host::class)->find($this->params()->fromRoute('id'));
        //var_dump($host);
        foreach ($host->getAssignedIps() as $assIp) {
            $rIp = $assIp->getReachableIp();
            $assIp->setReachableIp(null);
            $subnet = $assIp->getSubnet();
            $assIp->setSubnet(null);
            if ($rIp) $rIp->setAssignedIp(null);
            if ($subnet) $subnet->removeAssignedIps($assIp);
            foreach ($assIp->getAlerts() as $alert) {
                $this->getEntityManager()->remove($alert);
                $assIp->removeAlerts([$alert]);
            }
            $this->getEntityManager()->remove($assIp);
            $host->removeAssignedIps([$assIp]);
        }
        foreach ($host->getAlerts() as $alert) {
            $this->getEntityManager()->remove($alert);
            $host->removeAlerts([$alert]);
        }
        $this->getEntityManager()->remove($host);
        $this->getEntityManager()->flush();
        return $this->redirect()->toRoute('syshelper-frontend/dashboard');
    }

    public function updateAction()
    {
        $id = $this->params()->fromRoute("id", null);
        $form = $this->getFormElementManager()->get(HostForm::class);
        $viewModel = new ViewModel(["form" => $form]);

        if ($id === null) {
            return $this->closePopupAndRedirectToList();
        }

        $item = $this->getEntityManager()->getRepository(Host::class)->find($id);
        if ($item === null) {
            return $this->closePopupAndRedirectToList();
        }

        $viewModel->setVariable("item", $item);

        if ($this->editItem($item, $form)) {
            return $this->redirect()->toRoute('syshelper-frontend/host/list',[],['query' => ['fullview' => ($_REQUEST['fullview'] ?? 0)]]);
        }

        return $viewModel;
    }

}

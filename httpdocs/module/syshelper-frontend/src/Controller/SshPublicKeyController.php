<?php
namespace WirklichDigital\SyshelperFrontend\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;
use Laminas\Form\FormElementManager;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use WirklichDigital\DataTables\Service\DataTableAPI;
use WirklichDigital\DataTables\Service\TablePluginManager;
use WirklichDigital\DynamicCrudModule\Controller\AbstractCrudActionController;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SyshelperBase\Entity\SshPublicKey;
use WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostAccess;
use WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin;
use WirklichDigital\SyshelperBase\Service\SshPublicKeyService;
use WirklichDigital\SyshelperFrontend\Form\SshPublicKeyForm;
use WirklichDigital\SyshelperFrontend\Form\SshPublicKeyHostAccessForm;

class SshPublicKeyController extends AbstractCrudActionController
{
    public function __construct(
        protected EntityManager $entityManager,
        protected FormElementManager $formManager,
        protected DataTableAPI $dataTableApi,
        protected TablePluginManager $datatablePluginManager,
        protected SshPublicKeyService $sshPublicKeyService
    ) {
        parent::__construct($entityManager);
    }

    public function indexAction()
    {
    }

    public function redirectToList()
    {
        return $this->redirect()->toRoute('syshelper-frontend/ssh-public-key/list');
    }

    public function closePopupAndRedirectToList()
    {
        return $this->closePopup(true, $this->url()->fromRoute('syshelper-frontend/ssh-public-key/list'));
    }

    public function getFormElementManager()
    {
        return $this->formManager;
    }

    public function getDataTableApi()
    {
        return $this->dataTableApi;
    }

    public function showAction()
    {
        /** @var SshPublicKey */
        $sshPublicKey = $this->entityManager->getRepository(SshPublicKey::class)->find($this->params()->fromRoute('id'));

        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('l')
            ->from(SshPublicKeyLogin::class, 'l')
            ->where('l.sshPublicKey = :sshPublicKey')
            ->orderBy('l.loggedInAt', 'DESC')
            ->setMaxResults(100)
            ->setParameter('sshPublicKey', $sshPublicKey);
        $logins = $qb->getQuery()->getResult();

        return new ViewModel([
            'sshPublicKey' => $sshPublicKey,
            'logins' => $logins
        ]);
    }

    public function listAction()
    {
        $viewModel = new ViewModel([
            'datatable' => 'sshPublicKeyTable',
            'includeUnassigned' => $this->params()->fromQuery('includeUnassigned', false),
        ]);
        return $viewModel;
    }

    public function listAjaxAction()
    {
        $tableOptions = [
            "includeUnassigned" => $this->params()->fromQuery('includeUnassigned', false),
        ];
        $table = $this->datatablePluginManager->get('sshPublicKeyTable', $tableOptions);
        return new JsonModel($this->getDataTableApi()->handle($table, $this->getRequest()));
    }

    public function loginsAction()
    {
        $viewModel = new ViewModel([
            'datatable' => 'sshLoginTable'
        ]);
        return $viewModel;
    }

    public function loginsAjaxAction()
    {
        return new JsonModel($this->getDataTableApi()->handle('sshLoginTable', $this->getRequest()));
    }

    public function accessAction()
    {
        $viewModel = new ViewModel([
            'datatable' => 'sshAccessTable'
        ]);
        return $viewModel;
    }

    public function accessAjaxAction()
    {
        return new JsonModel($this->getDataTableApi()->handle('sshAccessTable', $this->getRequest()));
    }

    public function createAction()
    {
        $request = $this->getRequest();
        $form = $this->getFormElementManager()->get(SshPublicKeyForm::class);

        $viewModel = new ViewModel(['form' => $form]);

        if ($request->isPost()) {
            $item = new SshPublicKey();
            $data = array_replace_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            $data['SshPublicKey']['fingerprint'] = $this->sshPublicKeyService->getSshPublicKeyFingerprint(
                $data['SshPublicKey']['keyType'] ?? "",
                $data['SshPublicKey']['keyData'] ?? ""
            );
            if(empty($data['SshPublicKey']['fingerprint'])) {
                $form->get('SshPublicKey')->get('keyData')->setMessages(['Invalid key data for the chosen type. Could not calculate fingerprint.']);
            }
            elseif($this->entityManager->getRepository(SshPublicKey::class)->findOneBy(['fingerprint' => $data['SshPublicKey']['fingerprint']])) {
                $form->get('SshPublicKey')->get('keyData')->setMessages(['This key is already known!']);
            }
            else {
                if ($this->createItem($item, $form, $data)) {
                    $this->getEntityManager()->flush();
                    return $this->redirect()->toRoute('syshelper-frontend/ssh-public-key/list',[],['query' => ['includeUnassigned' => 1]]);
                }
            }
        }

        return $viewModel;
    }

    public function updateAction()
    {
        $id = $this->params()->fromRoute("id", null);
        $form = $this->getFormElementManager()->get(SshPublicKeyForm::class);
        $form->get('SshPublicKey')->get('keyData')->setAttribute('readonly', true);
        $form->get('SshPublicKey')->get('keyType')->setAttribute('readonly', true);
        $viewModel = new ViewModel(["form" => $form]);

        if ($id === null) {
            return $this->closePopupAndRedirectToList();
        }

        $item = $this->getEntityManager()->getRepository(SshPublicKey::class)->find($id);
        if ($item === null) {
            return $this->closePopupAndRedirectToList();
        }

        $viewModel->setVariable("item", $item);

        $request = $this->getRequest();
        $data = array_replace_recursive(
            $request->getPost()->toArray(),
            $request->getFiles()->toArray()
        );
        $data['SshPublicKey']['keyType'] = $item->getKeyType();
        $data['SshPublicKey']['keyData'] = $item->getKeyData();
        $data['SshPublicKey']['fingerprint'] = $item->getFingerprint();

        if ($this->editItem($item, $form, $data)) {
            return $this->redirect()->toRoute('syshelper-frontend/ssh-public-key/list',[],['query' => ['fullview' => ($_REQUEST['fullview'] ?? 0)]]);
        }

        return $viewModel;
    }

    public function accessCreateAction()
    {
        $request = $this->getRequest();
        $form = $this->getFormElementManager()->get(SshPublicKeyHostAccessForm::class);

        $viewModel = new ViewModel(['form' => $form]);

        if ($request->isPost()) {

            $host = $this->entityManager->getRepository(Host::class)->find($this->params()->fromPost('SshPublicKeyHostAccess')['host']);
            $sshPublicKey = $this->entityManager->getRepository(SshPublicKey::class)->find($this->params()->fromPost('SshPublicKeyHostAccess')['sshPublicKey']);
            $userOnHost = $this->params()->fromPost('SshPublicKeyHostAccess')['userOnHost'];

            $item = new SshPublicKeyHostAccess();
            if($this->entityManager->getRepository(SshPublicKeyHostAccess::class)->findOneBy(['host' => $host, 'userOnHost' => $userOnHost, 'sshPublicKey' => $sshPublicKey])) {
                $form->get('SshPublicKeyHostAccess')->get('userOnHost')->setMessages(['The key already has access!']);
            }
            else {
                if ($this->createItem($item, $form)) {
                    $this->getEntityManager()->flush();
                    return $this->redirect()->toRoute('syshelper-frontend/ssh-public-key/access');
                }
            }
        } else {
            $form->get('SshPublicKeyHostAccess')->get('userOnHost')->setValue('root');
        }

        return $viewModel;
    }

    public function accessRenewAction()
    {
        $id = $this->params()->fromRoute("id", null);
        $item = $this->getEntityManager()->getRepository(SshPublicKeyHostAccess::class)->find($id);
        if ($item !== null) {
            $item->setBlockedBecauseUnused(false);
            $item->setCreatedAt(new \DateTime());
            $this->getEntityManager()->flush();
        }
        return $this->redirect()->toRoute('syshelper-frontend/ssh-public-key/access');
    }

    public function accessRemoveAction()
    {
        $id = $this->params()->fromRoute("id", null);
        $item = $this->getEntityManager()->getRepository(SshPublicKeyHostAccess::class)->find($id);
        if ($item !== null) {
            $this->getEntityManager()->remove($item);
            $this->getEntityManager()->flush();
        }
        return $this->redirect()->toRoute('syshelper-frontend/ssh-public-key/access');
    }
}

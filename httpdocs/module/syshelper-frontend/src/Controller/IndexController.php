<?php
namespace WirklichDigital\SyshelperFrontend\Controller;

use Darsyn\IP\Version\Multi;
use Doctrine\ORM\AbstractQuery;
use Laminas\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;
use WirklichDigital\DataTables\Service\DataTableAPI;
use WirklichDigital\SyshelperAlerts\Entity\Alert;
use WirklichDigital\SyshelperBase\Entity\AssignedIp;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SyshelperBase\Entity\IpSubnet;
use WirklichDigital\SyshelperBase\Service\IpAssignmentService;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    /** @var EntityManager */
    protected $entityManager;

    /** @var IpAssignmentService */
    protected $ipAssignmentService;

    /**
     * @var DataTableAPI
     */
    protected $dataTableApi = null;

    public function __construct(EntityManager $entityManager, $ipAssignmentService, $dataTableApi)
    {
        $this->entityManager = $entityManager;
        $this->ipAssignmentService = $ipAssignmentService;
        $this->dataTableApi = $dataTableApi;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function getDataTableApi()
    {
        return $this->dataTableApi;
    }

    public function indexAction()
    {
        $stats = $this->_getStats();
        return new ViewModel([
            'stats' => $stats,
            'datatable' => 'alertTable'
        ]);
    }

    public function listAjaxAction()
    {
        return new JsonModel($this->getDataTableApi()->handle('alertTable', $this->getRequest()));
    }

    public function alertAcknowledgeToggleAction()
    {
        /** @var Alert */
        $item = $this->entityManager->getRepository(Alert::class)->find($this->params()->fromRoute('id'));
        $item->setIsAcknowledged(!$item->getIsAcknowledged());
        $this->entityManager->flush($item);
        $this->redirect()->toRoute('syshelper-frontend/dashboard',[],['query' => ['showMuted' => ($_GET['showMuted'] ?? 0)]]);
    }

    public function alertTypeAcknowledgeAction()
    {
        $cronJobClass = $this->params()->fromQuery('cronjobClass', null);
        if(empty($cronJobClass)) {
            $this->redirect()->toRoute('syshelper-frontend/dashboard',[],['query' => ['showMuted' => ($_GET['showMuted'] ?? 0)]]);
        }
        
        /** @var Alert[] */
        $items = $this->entityManager->getRepository(Alert::class)->findBy(['cronjobClass' => $cronJobClass]);
        foreach($items as $item) {
            $item->setIsAcknowledged(true);
        }

        $this->entityManager->flush();
        $this->redirect()->toRoute('syshelper-frontend/dashboard',[],['query' => ['showMuted' => ($_GET['showMuted'] ?? 0)]]);
    }

    public function alertTypeMuteAction()
    {

        $cronJobClass = $this->params()->fromQuery('cronjobClass', null);
        if(empty($cronJobClass)) {
            $this->redirect()->toRoute('syshelper-frontend/dashboard',[],['query' => ['showMuted' => ($_GET['showMuted'] ?? 0)]]);
        }
        
        /** @var Alert[] */
        $items = $this->entityManager->getRepository(Alert::class)->findBy(['cronjobClass' => $cronJobClass]);
        foreach($items as $item) {
            $item->setIsMuted(true);
        }

        $this->entityManager->flush();
        $this->redirect()->toRoute('syshelper-frontend/dashboard',[],['query' => ['showMuted' => ($_GET['showMuted'] ?? 0)]]);
    }

    public function alertTypeShowAction()
    {

        $cronJobClass = $this->params()->fromQuery('cronjobClass', null);
        if(empty($cronJobClass)) {
            $this->redirect()->toRoute('syshelper-frontend/dashboard',[],['query' => ['showMuted' => ($_GET['showMuted'] ?? 0)]]);
        }
    }

    public function alertMuteToggleAction()
    {
        /** @var Alert */
        $item = $this->entityManager->getRepository(Alert::class)->find($this->params()->fromRoute('id'));
        $item->setIsMuted(!$item->getIsMuted());
        $this->entityManager->flush($item);
        $this->redirect()->toRoute('syshelper-frontend/dashboard',[],['query' => ['showMuted' => ($_GET['showMuted'] ?? 0)]]);
    }

    private function _getStats()
    {
        $result = [];

        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->select('count(ipsubnet.id)')
                    ->from(IpSubnet::class,'ipsubnet');
        $result['subnets'] = $query->getQuery()->getSingleScalarResult();

        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->select('count(host.id)')
                    ->from(Host::class,'host');
        $result['hosts'] = $query->getQuery()->getSingleScalarResult();

        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->select('count(aip.id)')
                    ->from(AssignedIp::class,'aip');
        $result['assigned_ips'] = $query->getQuery()->getSingleScalarResult();

        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->select('count(a.id) cnt,sum(a.isMuted) cnt_muted,a.name, a.cronjobClass')
                    ->from(Alert::class,'a')
                    ->groupBy('a.cronjobClass');
        $result['alerts'] = $query->getQuery()->getResult(AbstractQuery::HYDRATE_ARRAY);

        return $result;
    }

    public function quickSearchAction()
    {
        $value = trim($this->params()->fromQuery('v'));
        $type = trim($this->params()->fromQuery('type'));

        $result_entries = [];

        if($type == "hostname")
        {

            // Search for FQDN Matches
            $qb = $this->entityManager->createQueryBuilder();
            $query = $qb->select('h')
                        ->from(Host::class, 'h')
                        ->where('h.fqdn like :s_fqdn')
                        ->setParameter('s_fqdn','%'.$value.'%');
            $result = @$query->getQuery()->getResult();

            foreach($result as $r)
            {
                $hash = md5('host'.$r->getId());
                if(!isset($result_entries[$hash])) $result_entries[$hash] = [
                    'type' => 'host',
                    'name' => $r->getFqdn()." (matched: FQDN)",
                    'url' => $this->url()->fromRoute('syshelper-frontend/host/show',['id' => $r->getId()]),
                    'o' => $r,
                ];
            }

            // Search for Domain Matches
            $qb = $this->entityManager->createQueryBuilder();
            $query = $qb->select('h')
                        ->from(Host::class, 'h')
                        ->orWhere('h.webserverDomainsApache like :s_fqdn')
                        ->orWhere('h.webserverDomainsNginx like :s_fqdn')
                        ->setParameter('s_fqdn','%'.$value.'%');
            $result = @$query->getQuery()->getResult();

            foreach($result as $r)
            {
                $hash = md5('host'.$r->getId());
                if(!isset($result_entries[$hash])) $result_entries[$hash] = [
                    'type' => 'host',
                    'name' => $r->getFqdn()." (matched: webserver domain)",
                    'url' => $this->url()->fromRoute('syshelper-frontend/host/show',['id' => $r->getId()]),
                    'o' => $r,
                ];
            }

            // Try resolving name
            $ip = @gethostbyname($value);
            if(!empty($ip))
            {
                // Append result for ip aswell...
                $type = "ip";
                $value = $ip;
            }
        }

        if($type == "ip")
        {
            try {
                $value = Multi::factory($value);
                /** @var AssignedIp */
                $assignment = $this->ipAssignmentService->getAssignmentOfIp($value);
                if($assignment)
                {
                    $hash = md5('host'.$assignment->getHost()->getId());
                    if(!isset($result_entries[$hash])) $result_entries[$hash] = [
                        'type' => 'host',
                        'name' => $assignment->getHost()->getFqdn().' (matched: IP-Assignment)',
                        'url' => $this->url()->fromRoute('syshelper-frontend/host/show',['id' => $assignment->getHost()->getId()]),
                        'o' => $assignment,
                    ];
                }

                $subnet = $this->ipAssignmentService->isPartOfOurSubnets($value);
                if(!empty($subnet))
                {
                    $isUp = false;
                    foreach($subnet->getReachableIps() as $rip)
                        if((string)$rip->getAddress() == $value)
                            $isUp = true;

                    $result_entries[] = [
                        'type' => 'subnet',
                        'name' => $subnet->getNetworkAddress().'/'.$subnet->getNetworkCidrMask(),
                        'url' => null,
                        'ip' => $value,
                        'isUp' => $isUp,
                        'hostname' => gethostbyaddr($value),
                        'o' => $subnet,
                    ];
                }
            }
            catch(\Throwable $e) {}
        }

        if(!empty($result_entries) && count($result_entries) == 1)
        {
            $firstEntry = array_values($result_entries)[0];
            if(!empty($firstEntry['url']))
                return $this->redirect()->toUrl($firstEntry['url']);
        }

        return new ViewModel([
            'result_entries' => $result_entries
        ]);
    }
}

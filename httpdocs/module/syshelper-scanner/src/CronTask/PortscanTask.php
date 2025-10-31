<?php
namespace WirklichDigital\SyshelperScanner\CronTask;

use WirklichDigital\CronScheduler\CronTask\CronTaskExecutable;
use Doctrine\ORM\EntityManager;
use WirklichDigital\GlobalAvailableConfig\GlobalAvailableConfig;
use WirklichDigital\SyshelperBase\Entity\AssignedIp;
use WirklichDigital\SyshelperBase\Entity\Host;

class PortscanTask implements CronTaskExecutable
{
    /** @var EntityManager */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function run()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->select('assignedIp')
                    ->from(AssignedIp::class,'assignedIp')
                    ->orWhere('assignedIp.openPortsExternalLastScanAt IS NULL')
                    ->orWhere('assignedIp.openPortsExternalLastScanAt < :threshold')
                    ->setParameter('threshold',new \DateTime('-6hours'))
                    ->setMaxResults(25);
        $assignedIps = $query->getQuery()->getResult();

        foreach($assignedIps as $assignedIp)
        {
            /** @var AssignedIp $assignedIp */
            $result = $this->_apiCall($assignedIp->getAddress(),'external');
            if($result)
            {
                if($result == "ERROR")
                {
                    $assignedIp->setOpenPortsExternalLastScanAt(new \DateTime());
                    $assignedIp->setOpenPortsExternal(null);
                }
                else
                {
                    $openPorts=[
                        'tcp' => [],
                        'udp' => [],
                    ];

                    if(!isset($result['host']['ports']['port']))
                    {
                        // No ports up...
                    }
                    else
                    {
                        // Multiple ports up
                        foreach($result['host']['ports']['port'] as $port)
                        {
                            if(($port['state']['@attributes']['state'] ?? "") == "open")
                                $openPorts[$port['@attributes']['protocol']][] = $port['@attributes']['portid'];
                        }
                    }   
                    
                    $assignedIp->setOpenPortsExternalLastScanAt(new \DateTime());
                    $assignedIp->setOpenPortsExternal($openPorts);            
                }
            }
        }
        $this->entityManager->flush();

        return true;
    }

    public function scanSingle($assignedIp) {
        /** @var AssignedIp $assignedIp */
        $result = $this->_apiCall($assignedIp->getAddress(),'external');
        if($result)
        {
            if($result == "ERROR")
            {
                $assignedIp->setOpenPortsExternalLastScanAt(new \DateTime());
                $assignedIp->setOpenPortsExternal(null);
            }
            else
            {
                $openPorts=[
                    'tcp' => [],
                    'udp' => [],
                ];

                if(!isset($result['host']['ports']['port']))
                {
                    // No ports up...
                }
                else
                {
                    // Multiple ports up
                    foreach($result['host']['ports']['port'] as $port)
                    {
                        if(($port['state']['@attributes']['state'] ?? "") == "open")
                            $openPorts[$port['@attributes']['protocol']][] = $port['@attributes']['portid'];
                    }
                }

                $assignedIp->setOpenPortsExternalLastScanAt(new \DateTime());
                $assignedIp->setOpenPortsExternal($openPorts);
            }
        }
        $this->entityManager->flush();
    }

    private function _apiCall($address,$type)
    {
        $url = GlobalAvailableConfig::get()['wirklich-digital']['syshelper-scanner']['url'][$type].'/portscan.php?address='.$address;
        try {
			$client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $url, ['connect_timeout' => 10]);
            $response_body = (string)$response->getBody();

			if($response->getStatusCode() == 200)
			{
				$data = $response_body;
				$data = json_decode($data,1);
				if(json_last_error() == JSON_ERROR_NONE)
				{
                    return $data;
				}
			}
		}
		catch(\Throwable $e)
		{
            return 'ERROR';
        }
        return false;
    }
}

<?php
namespace WirklichDigital\SyshelperScanner\CronTask;

use WirklichDigital\CronScheduler\CronTask\CronTaskExecutable;
use Doctrine\ORM\EntityManager;
use WirklichDigital\GlobalAvailableConfig\GlobalAvailableConfig;
use WirklichDigital\SyshelperBase\Entity\AssignedIp;
use WirklichDigital\SyshelperBase\Entity\IpSubnet;
use WirklichDigital\SyshelperBase\Entity\ReachableIp;

class PingscanTask implements CronTaskExecutable
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
        $query = $qb->select('ipsubnet')
                    ->from(IpSubnet::class,'ipsubnet')
                    ->orWhere('ipsubnet.externalUpIpLastScanAt IS NULL')
                    ->orWhere('ipsubnet.externalUpIpLastScanAt < :threshold')
                    ->setParameter('threshold',new \DateTime('-2hours'))
                    ->setMaxResults(50);
        $subnets = $query->getQuery()->getResult();

        foreach($subnets as $subnet)
        {
            /** @var IpSubnet $subnet */
            $cidr = $subnet->getNetworkCidrMask();
            if($cidr == 64) $cidr = 122;
            $result = $this->_apiCall($subnet->getNetworkAddress(),$cidr,'external');
            $upHosts = [];
            if($result)
            {
                if($result == "ERROR")
                {
                    $subnet->setExternalUpIps(null);
                }
                else
                {

                    if(!isset($result['host']))
                    {
                        // No hosts up...
                    }
                    elseif(isset($result['host']['address']))
                    {
                        // 1 Host up
                        $upHosts[] = $result['host']['address']['@attributes']['addr'];
                    }
                    else
                    {
                        // Multiple Hosts up
                        foreach($result['host'] as $host)
                        {
                            $upHosts[] = $host['address']['@attributes']['addr'];
                        }
                    }        
                               
                }

                $subnet->setExternalUpIpLastScanAt(new \DateTime());
                $subnetAddresses = [];
                foreach($subnet->getReachableIps() as $reachableIp)
                {
                    $subnetAddresses[] = (string)$reachableIp->getAddress();
                    /** @var ReachableIp $reachableIp */
                    if(!in_array((string)$reachableIp->getAddress(),$upHosts))
                        $this->entityManager->remove($reachableIp);
                }
                array_unique($subnetAddresses);
                array_unique($upHosts);
                
                foreach($upHosts as $reachableAddress)
                {
                    if(!in_array($reachableAddress,$subnetAddresses))
                    {
                        $reachableIp = new ReachableIp();
                        $reachableIp->setAddress($reachableAddress);
                        $reachableIp->setSubnet($subnet);

                        $ptr = @gethostbyaddr($reachableAddress);
                        if(!empty($ptr) && $ptr != $reachableAddress)
                            $reachableIp->setPtr($ptr);
                        else
                            $reachableIp->setPtr(null);
                        
                        foreach($subnet->getAssignedIps() as $assignedIp)
                        {
                            /** @var AssignedIp $assignedIp */
                            if($assignedIp->getAddress() == $reachableAddress)
                                $reachableIp->setAssignedIp($assignedIp);
                        }

                        $this->entityManager->persist($reachableIp);
                        $this->entityManager->flush($reachableIp);
                    }
                }
            }
            
        }
        $this->entityManager->flush();

        return true;
    }

    private function _apiCall($network_address,$cidr,$type)
    {
        $url = GlobalAvailableConfig::get()['wirklich-digital']['syshelper-scanner']['url'][$type].'/pingscan.php?network_address='.$network_address.'&cidr='.$cidr;
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

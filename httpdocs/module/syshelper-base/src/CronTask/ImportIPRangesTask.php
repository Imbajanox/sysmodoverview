<?php
namespace WirklichDigital\SyshelperBase\CronTask;

use WirklichDigital\CronScheduler\CronTask\CronTaskExecutable;
use Doctrine\ORM\EntityManager;
use WirklichDigital\Logger\GlobalAvailableLogger;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SyshelperBase\Entity\HostRawFact;
use WirklichDigital\SyshelperBase\Entity\IpSubnet;

class ImportIPRangesTask implements CronTaskExecutable
{
    /** @var EntityManager */
    protected $entityManager;

    protected static $dynamicSources = [
        'hetznercloud_cloud_control_dev',
        'hetznercloud_cloud_control_live',
        'hetznercloud_mc_bbbserver_dev',
        'hetznercloud_mc_bbbserver_live',
    ];

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
        echo 'DISABLED, BECAUSE hetzner-api.jar.media CHANGED. CURRENTLY NOT WORKING!';
        return true;

        $ipWhitelist = $this->_getIpWhitelist();

        if($ipWhitelist !== false)
            foreach($ipWhitelist as $source => $network)
                $this->_importNetworks($network,$source);

        return true;
    }

    private function _importNetworks($networks,$source="unknown")
    {
        echo "*** IMPORTING NEW SUBNETS: ".$source."\n";
        foreach($networks as &$network)
        {
            if(empty($network)) continue;

            $is_v4 = (stristr($network,':') === false);
            if(!stristr($network,'/'))
            {
                if($is_v4) $network = $network.'/32';
                else $network = $network.'/128';
            }

            list($networkAddress,$cidrMask) = explode('/',$network,2);

            $entry = $this->entityManager->getRepository(IpSubnet::class)->findOneBy(['networkAddress' => $networkAddress]);

            if(!empty($entry))
            {
                /** @var IpSubnet $entry */

                if($entry->getImportSource() != $source)
                {
                    echo "--> ".$network." has changed its source (".$entry->getImportSource()." => ".$source.").\n";
                    $entry->setImportSource($source);
                }

                if($entry->getNetworkCidrMask() != $cidrMask)
                {
                    echo "--> ".$network." has changed its size (".$entry->getNetworkCidrMask()." => ".$cidrMask.").\n";
                    $entry->setNetworkCidrMask($cidrMask);
                }

                // Do not change "isDynamic", if it has been set manually (e.g. via web interface).
                if(!$entry->getIsDynamicSetManually())
                {
                    $isDynamic = false;
                    if(in_array($source,self::$dynamicSources)) $isDynamic = true;
                    if($entry->getIsDynamic() != $isDynamic)
                    {
                        echo "--> ".$network." has changed its dynamic status.\n";
                        $entry->setIsDynamic($isDynamic);
                    }
                }

                $this->entityManager->flush($entry);
                continue;
            }

            echo "--> ".$network." is new.\n";
            $entry = new IpSubnet();
            $entry->setNetworkAddress($networkAddress);
            $entry->setNetworkCidrMask($cidrMask);
            $entry->setImportSource($source);
            if(in_array($source,self::$dynamicSources)) $entry->setIsDynamic(true);
            $this->entityManager->persist($entry);
            $this->entityManager->flush($entry);
        }

        try {
        echo "*** CHECK FOR MISSING SUBNETS: ".$source."\n";
        $allEntriesOfSource = $this->entityManager->getRepository(IpSubnet::class)->findBy(['importSource' => $source]);
        foreach($allEntriesOfSource as $entry)
        {
            $n = $entry->getNetworkAddress().'/'.$entry->getNetworkCidrMask();
            /** @var IpSubnet $entry */
            if(!in_array($n,$networks))
            {
                echo "--> ".$n." is missing.\n";

                if(count($entry->getAssignedIps()) == 0)
                {
                    echo "-----> Removed ".$n.": Not assigned.\n";
                    $this->entityManager->remove($entry);
                    $this->entityManager->flush();
                }
                elseif($entry->getIsDynamic())
                {
                    echo "-----> Removed ".$n.": Dynamic source.\n";
                    foreach($entry->getAssignedIps() as $assignedIp)
                    {
                        $host = $assignedIp->getHost();
                        if(count($host->getAssignedIps()) == 1)  // If the host has only one (this) assigned ip, then we will also remove the host. (dynamic host)
                            $this->entityManager->remove($host);
                        $this->entityManager->remove($assignedIp);
                    }
                    $this->entityManager->remove($entry);
                    $this->entityManager->flush();
                }
            }
        }
        }
        catch(\Throwable $e)
        {
            d($e);die();
        }

        return true;
    }

    private function _getIpWhitelist()
    {
        $url = "https://h17.jarmedia.de/ip_whitelist/?json=1";

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $url, ['connect_timeout' => 30]);
            $response_body = (string)$response->getBody();

			if($response->getStatusCode() == 200)
			{
				$data = $response_body;
				$data = json_decode($data,true);
                
                if(json_last_error() !== JSON_ERROR_NONE) return false;
				
				return $data;
			}
			else
			{
				return false;
			}

        } catch(\Throwable $e)
        {}

        return false;
    }
}

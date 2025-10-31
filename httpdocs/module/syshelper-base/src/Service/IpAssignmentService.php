<?php
namespace WirklichDigital\SyshelperBase\Service;

use Darsyn\IP\Version\IPv4;
use Darsyn\IP\Version\Multi;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperBase\Entity\AssignedIp;
use WirklichDigital\SyshelperBase\Entity\IpSubnet;

class IpAssignmentService
{

    protected static $cache_ourSubnets = [];

    public function __construct(
        protected EntityManager $entityManager)
    {
        $this->warmupIpCache();
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    private function warmupIpCache()
    {
        self::$cache_ourSubnets = $this->entityManager->getRepository(IpSubnet::class)->findAll();
    }

    public function isPartOfOurSubnets($ip)
    {
        $ipVersion = $ip->getVersion();
        foreach(self::$cache_ourSubnets as $subnet)
        {
            /** @var IpSubnet $subnet */
            $subnetVersion = $subnet->getNetworkAddress()->getVersion();

            if($subnetVersion != $ipVersion) continue;

            if($ip->inRange($subnet->getNetworkAddress(), $subnet->getNetworkCidrMask()))
                return $subnet;
        }

        return false;
    }

    public function getAssignmentOfIp($ip)
    {
        return $this->entityManager->getRepository(AssignedIp::class)->findOneBy(['address' => $ip]);
    }

    public function assignIp($host,$ip,$subnet,$assignReachableIp = true)
    {
        $assignment = new AssignedIp();
        $assignment->setHost($host);
        $assignment->setAddress($ip);
        $assignment->setSubnet($subnet);

        $ptr = @gethostbyaddr((string)$ip);
        if(!empty($ptr) && $ptr != (string)$ip)
            $assignment->setPtr($ptr);
        else
            $assignment->setPtr(null);
        
        $this->entityManager->persist($assignment);
        $this->entityManager->flush($assignment);

        if($assignReachableIp) {
            foreach($subnet->getReachableIps() as $reachableIp) {
                if($reachableIp->getAddress() == $ip) {
                    $reachableIp->setAssignedIp($assignment);
                    $this->entityManager->persist($reachableIp);
                    $this->entityManager->flush($reachableIp);
                    break;
                }
            }
        }
        return;
    }
}

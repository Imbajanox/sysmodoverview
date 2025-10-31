<?php
namespace WirklichDigital\SyshelperBase\Service;

use Darsyn\IP\Version\Multi;
use DateTime;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SyshelperBase\Entity\HostRawFact;
use WirklichDigital\SyshelperBase\Entity\SshPublicKey;
use WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostMapping;
use WirklichDigital\SyshelperBase\Entity\SshPublicKeyLogin;

class HostRawFactsParsingService
{

    public function __construct(
        protected EntityManager $entityManager,
        protected IpAssignmentService $ipAssignmentService,
        protected SshPublicKeyService $sshPublicKeyService
    )
    {
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function canParse($type) {
        return method_exists($this, 'parse_'.$type);
    }

    public function parse(HostRawFact $rawFact)
    {
        $type = $rawFact->getType();
        $method_name = 'parse_'.$type;

        try {
            if(method_exists($this,$method_name)) {
                echo "Parsing rawFact ".$rawFact->getId()." with Method ".$method_name."\n";
                return call_user_func([$this, $method_name], $rawFact);
            }
            else
            {
                echo "Method ".$method_name." does not exist for rawFact ".$rawFact->getId()."\n";
            }
        }
        catch(\Throwable $e)
        {
            d($e);
            echo "Exception for rawFact ".$rawFact->getId()." and Method ".$method_name."\n";
        }

        return false;
    }

    private function parse_SSH_LOGINS(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        // Get latest login tracked in the database
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('spkl.loggedInAt')
            ->from(SshPublicKeyLogin::class,'spkl')
            ->where('spkl.host = :host')
            ->orderBy('spkl.loggedInAt','DESC')
            ->setMaxResults(1)
            ->setParameter('host',$host);
        $latestLoginResult = $qb->getQuery()->getOneOrNullResult();
        $latestLogin = $latestLoginResult['loggedInAt'] ?? new \DateTime('1970-01-01 00:00:00');

        $parts = explode("|||",$rawFact->getRawValue(),2);
        if(count($parts) != 2 || !in_array($parts[0],['JOURNALCTL','VARLOGAUTHLOG','VARLOGSECURE']))
            return false;

        $logType = $parts[0];
        $rawValue = $parts[1];

        $loglines = explode("\n",$rawValue);

        $fingerprintMap = $this->sshPublicKeyService->getSshPublicKeyFingerprintMap();
        $changedSshKeys = [];

        foreach($loglines as $line) {

            if($logType == 'JOURNALCTL') {
                $re = '/(?P<datetime>[^\s]+)\s+[^\s]+\s+sshd.*Accepted\s+publickey\s+for\s+(?P<user>[^\s]+)\s+from\s+(?P<ip>[^\s]+).*(?P<fingerprint>SHA256:[^\s]+)/m';
                $dtFormat = 'Y-m-d\TH:i:sP';
            }
            elseif($logType == 'VARLOGAUTHLOG') {
                $re = '/(?P<datetime>[A-Z][a-z]{2}\s+\d{1,2}\s+\d{2}:\d{2}:\d{2})\s+[^\s]+\s+sshd.*Accepted\s+publickey\s+for\s+(?P<user>[^\s]+)\s+from\s+(?P<ip>[^\s]+).*(?P<fingerprint>SHA256:[^\s]+)/m';
                $dtFormat = 'SYSLOG';
            }
            elseif($logType == 'VARLOGSECURE') {
                $re = '/(?P<datetime>[A-Z][a-z]{2}\s+\d{1,2}\s+\d{2}:\d{2}:\d{2})\s+[^\s]+\s+sshd.*Accepted\s+publickey\s+for\s+(?P<user>[^\s]+)\s+from\s+(?P<ip>[^\s]+).*(?P<fingerprint>SHA256:[^\s]+)/m';
                $dtFormat = 'SYSLOG';
            }
            else
                continue;

            preg_match($re, $line, $match);

            if(isset($match['datetime']) && isset($match['user']) && isset($match['ip']) && isset($match['fingerprint']))
            {
                $sshPublicKey = $fingerprintMap[$match['fingerprint']] ?? null;
                if($sshPublicKey->getDoNotTrackLogins())
                    continue;

                if($dtFormat == 'SYSLOG')
                    $datetime = $this->translateSyslogDate($match['datetime']);
                else
                    $datetime = \DateTime::createFromFormat($dtFormat,$match['datetime']);

                if($datetime === false)
                    continue;

                if($datetime <= $latestLogin)
                    continue;

                $changedSshKeys[] = $sshPublicKey;

                $sshPublicKeyLogin = new SshPublicKeyLogin();
                $sshPublicKeyLogin->setHost($host);
                $sshPublicKeyLogin->setSshPublicKey($sshPublicKey);
                $sshPublicKeyLogin->setUser($match['user']);
                $sshPublicKeyLogin->setIp($match['ip']);
                $sshPublicKeyLogin->setLoggedInAt($datetime);
                $this->entityManager->persist($sshPublicKeyLogin);

                $this->entityManager->flush();
            }
            else {
                //GlobalAvailableLogger::get()->debug("Could not parse ssh login line",['line' => $line, 'host' => $host->getId(), 'component' => 'HostRawFactsParsingService']);
            }
        }

        $this->entityManager->flush();

        return true;
    }

    private function translateSyslogDate($syslogString)
    {
        // Define a regular expression pattern for syslog timestamps
        $pattern = '/^([A-Za-z]{3})\s+(\d{1,2})\s+(\d{2}:\d{2}:\d{2})/';

        if (preg_match($pattern, $syslogString, $matches)) {
            list(, $month, $day, $time) = $matches;

            // Get the current year
            $currentYear = date("Y");

            // Create a timestamp assuming the current year
            $timestampString = "$month $day $currentYear $time";
            $dateTime = DateTime::createFromFormat('M d Y H:i:s', $timestampString);

            // Check for year transition (if the parsed date is in the future, it belongs to the previous year)
            if ($dateTime > new DateTime()) {
                $lastYear = $currentYear - 1;
                $timestampString = "$month $day $lastYear $time";
                $dateTime = DateTime::createFromFormat('M d Y H:i:s', $timestampString);
            }

            return $dateTime;
        }

        return null; // Return null if parsing fails
    }

    private function parse_AUTHORIZED_KEYS(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());
        $lines = explode("\\n",$value);
        $currentMappings = [];
        foreach($lines as $line){
            $parts = explode("|",$line,2);
            $userOnHost = $parts[0] ?? null;
            $restOfLine = $parts[1] ?? null;

            if(empty($userOnHost) || empty($restOfLine)) continue;

            // preg match $line:
            // May begin with environment="NAME=value" or no spaces
            // Followed by "ssh-SOMETHING" type
            // Followed by the key
            // Followed by comment, if any
            // Example: ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDQ6
            // Example: environment="NAME=value" ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDQ6
            // Example: ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDQ6 user@host
            // Example: environment="NAME=value" ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDQ6 user@host
            // Use named groups to extract the parts

            $re = '/(environment="(?P<environment>[^"]+)"\s+)?(?P<type>ssh-[^\s]+)\s+(?P<key>[^\s]+)\s+(?P<comment>.+)/m';
            preg_match($re, $line, $match);
            if(isset($match['key']))
            {
                $type = $match['type'];
                $key = $match['key'];
                $comment = $match['comment'];
                $environment = $match['environment'];

                // Check if key exists
                $sshPublicKey = $this->entityManager->getRepository(SshPublicKey::class)->findOneBy(['keyData' => $key, 'keyType' => $type]);
                if(empty($sshPublicKey))
                {
                    $sshPublicKey = new SshPublicKey();
                    $sshPublicKey->setKeyData($key);
                    $sshPublicKey->setKeyType($type);
                    $sshPublicKey->setUsergroup("");

                    $fingerPrint = $this->sshPublicKeyService->getSshPublicKeyFingerprint($type, $key);
                    $sshPublicKey->setFingerprint($fingerPrint);

                    $this->entityManager->persist($sshPublicKey);
                    $this->entityManager->flush($host);
                }

                // Check if Mapping exists
                $sshPublicKeyHostMapping = $this->entityManager->getRepository(SshPublicKeyHostMapping::class)->findOneBy([
                    'host' => $host,
                    'sshPublicKey' => $sshPublicKey,
                    'userOnHost' => $userOnHost
                ]);
                if(empty($sshPublicKeyHostMapping))
                {
                    $sshPublicKeyHostMapping = new SshPublicKeyHostMapping();
                    $sshPublicKeyHostMapping->setHost($host);
                    $sshPublicKeyHostMapping->setUserOnHost($userOnHost);
                    $sshPublicKeyHostMapping->setSshPublicKey($sshPublicKey);
                    $sshPublicKeyHostMapping->setComment($comment);
                    $sshPublicKeyHostMapping->setEnvironment($environment);
                    $this->entityManager->persist($sshPublicKeyHostMapping);
                    $this->entityManager->flush($host);
                }
                $currentMappings[] = (string)$sshPublicKeyHostMapping->getId();
                $this->sshPublicKeyService->updateTitleIfNeeded($sshPublicKey);
            }
        }

        // Remove all mappings that are not in $currentMappings
        $oldMappings = $this->entityManager->getRepository(SshPublicKeyHostMapping::class)->findBy(['host' => $host]);

        foreach($oldMappings as $oldMapping)
        {
            if(!in_array((string)$oldMapping->getId(),$currentMappings))
            {
                $this->entityManager->remove($oldMapping);
                $this->entityManager->flush($host);
            }
        }

        return true;
    }

    private function parse_VERSION(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value == "NULL")
            $value = null;
        else
        {
            $re = '/([\d]+\.)+[\d]+/m';
            preg_match($re, $value, $matches);
            $value=$matches[0];
        }

        $host->setScriptVersion($value);
        $this->entityManager->flush($host);

        return true;
    }

    private function parse_HOSTNAME(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $host->setName(trim($rawFact->getRawValue()));
        $this->entityManager->flush($host);

        return true;
    }

    private function parse_FQDN(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $host->setFqdn(trim($rawFact->getRawValue()));
        $this->entityManager->flush($host);

        return true;
    }

    private function parse_IP_V4_EXT(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $host->setExternalIpV4(trim($rawFact->getRawValue()));
        $this->entityManager->flush($host);

        return true;
    }

    private function parse_IP_V6_EXT(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $host->setExternalIpV6(trim($rawFact->getRawValue()));
        $this->entityManager->flush($host);

        return true;
    }

    private function parse_APACHE_VERSION(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        $value = null;
        if(!empty($value) && $value != "NULL")
        {
            $re = '/[\d]+\.[\d]+\.[\d]+/m';
            preg_match($re, $value, $matches);
            if(isset($matches[0]))
                $value=$matches[0];
        }

        $host->setWebserverVersionApache($value);
        $this->entityManager->flush($host);

        return true;
    }

    private function parse_NGINX_VERSION(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());


        $value = null;
        if(!empty($value) && $value != "NULL")
        {
            $re = '/[\d]+\.[\d]+\.[\d]+/m';
            preg_match($re, $value, $matches);
            if(isset($matches[0]))
                $value=$matches[0];
        }

        $host->setWebserverVersionNginx($value);
        $this->entityManager->flush($host);

       return true;
    }

    private function parse_PUPPET_VERSION(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value == "NULL")
            $value = null;
        else
        {
            $re = '/[\d]+\.[\d]+\.[\d]+/m';
            preg_match($re, $value, $matches);
            $value=$matches[0];
        }

        $host->setPuppetVersion($value);
        $this->entityManager->flush($host);

        return true;
    }

    private function parse_RESOLVE(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value == "NULL")
            $value = null;
        else
        {
            $re = '/nameserver\s+([\d]+\.[\d]+\.[\d]+.[\d]+)/m';
            preg_match_all($re, $value, $matches, PREG_SET_ORDER, 0);
            $value = [];
            foreach($matches as $match)
            {
                if(isset($match[1]))
                    $value[] = $match[1];
            }
        }

        $host->setNameservers($value);
        $this->entityManager->flush($host);

        return true;
    }

    private function parse_IP_INFOS(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        $host->setInterfaces(null);
        if(!empty($value) && $value != "NULL")
        {
            $interfaces = [];
            $value = explode("\n",$value);
            foreach($value as $line)
            {
                $parts = explode(" ",$line,2);
                if(!empty($parts) && isset($parts[1]))
                {
                    $interface = $parts[0];
                    $address = $parts[1];

                    $cidr = null;
                    if(stristr($address,"/"))
                        list($address,$cidr) = explode("/",$address,2);

                    // Check, if this is a valid IP
                    try {
                        $ip = Multi::factory($address);
                    } catch(\Throwable $e)
                    {
                        // Not a valid IP.
                        continue;
                    }

                    if(!isset($interfaces[$interface]))
                        $interfaces[$interface] = [];

                    $interfaces[$interface][] = $address;
                }
            }
            $host->setInterfaces($interfaces);
        }
        $this->entityManager->flush($host);

        if(!empty($host->getInterfaces()))
        {
            foreach($host->getInterfaces() as $interface)
            {
                foreach($interface as $address)
                {
                    try {
                        $ip = Multi::factory($address);
                    } catch(\Throwable $e)
                    {
                        continue;
                    }

                    if(!$ip->isPrivateUse() && !$ip->isLoopback())
                    {
                        $assignment = $this->ipAssignmentService->getAssignmentOfIp($ip);

                        if(empty($assignment))
                        {
                            $subnet = $this->ipAssignmentService->isPartOfOurSubnets($ip);
                            if($subnet !== false) 
                                $this->ipAssignmentService->assignIp($host,$ip,$subnet, true);
                        }
                        else
                        {
                            $subnet = $this->ipAssignmentService->isPartOfOurSubnets($ip);
                            foreach($subnet->getReachableIps() as $reachableIp) {
                                if($reachableIp->getAddress() == $address) {
                                    $reachableIp->setAssignedIp($assignment);
                                    $this->entityManager->persist($reachableIp);
                                    $this->entityManager->flush($reachableIp);
                                    break;
                                }
                            }

                            if($assignment->getHost() != $host)
                            {
                                // ALERT: IP is already assigned to another known host. Problem?
                                if($ip->getVersion() == 4)
                                    echo "ALERT: IP ".$ip->getDotAddress()." might be assigned to two hosts (".$assignment->getHost()->getId().", ".$host->getId().").";
                                else
                                    echo "ALERT: IP ".$ip->getCompactedAddress()." might be assigned to two hosts (".$assignment->getHost()->getId().", ".$host->getId().").";
                            }
                        }
                    }
                }
            }
        }

        return true;
    }

    private function parse_KERNEL(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value == "NULL")
            $value = null;
        else
        {
            $parts = explode(' ',$value);
            if(isset($parts[2]) && preg_match("/[\d]+\.[\d]+\.[\d]+/",$value))
                $value = $parts[2];
        }

        $host->setKernelVersion($value);
        $this->entityManager->flush($host);

        return true;
    }

    private function parse_PLESK_VERSION(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value == "NULL")
            $value = null;
        else
        {
            $re = '/Product version([^\d]+)(([\d]+(\.)?)+)/';
            preg_match($re, $value, $matches);

            if(isset($matches[2]))
                $value=$matches[2];
        }

        $host->setPleskVersion($value);
        $this->entityManager->flush($host);

        return true;
    }

    private function parse_PUPPET_LASTLOG(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value == "NULL")
            $value = null;
        else
        {

            $re = '/status\: failed/m';
            if(preg_match($re, $value, $matches))
                $value = false;
            else
                $value = true;
        }

        $host->setPuppetIsOK($value);
        $this->entityManager->flush($host);

        return true;
    }

    private function parse_PLESK_BACKUPS(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value === "NULL")
            $value = null;
        else
        {
            $value = $value > 0;
        }

        $host->setPleskBackupIsDone($value);
        $this->entityManager->flush($host);

        return true;
    }

    private function parse_PLESK_BACKUP_ERR(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value === "NULL")
            if($value === "0") $value = false;
	    else $value = null;
        else
        {
            $value = $value > 0;
        }

        $host->setPleskBackupHasError($value);
        $this->entityManager->flush($host);

        return true;
    }

    private function parse_CPU(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value == "NULL")
        {
            $host->setCpuCores(null);
            $host->setCpuModel(null);
        }
        else
        {
            $matches = [];
            $re = '/processor\s+:\s+(\d+)/m';
            preg_match_all($re, $value, $matches);
            $host->setCpuCores(count($matches[1]));

            $matches = [];
            $re = '/model\s+name\s+:\s+(.+)/';
            preg_match($re, $value, $matches);
            if(isset($matches[1]))
                $value=$matches[1];
            else
                $value=null;
            $host->setCpuModel($value);
        }

        $this->entityManager->flush($host);

        return true;
    }

    private function parse_RAM(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value == "NULL")
        {
            $host->setRamSizeKb(null);
            $host->setRamAvailableKb(null);
        }
        else
        {
            $matches = [];
            $re = '/MemTotal:\s+(\d+)\skB/';
            preg_match($re, $value, $matches);
            if(isset($matches[1]))
                $v=$matches[1];
            else
                $v=null;
            $host->setRamSizeKb($v);
            $matches = [];

            $re = '/MemAvailable:\s+(\d+)\skB/';
            preg_match($re, $value, $matches);
            if(isset($matches[1]))
                $v=$matches[1];
            else
                $v=null;
            $host->setRamAvailableKb($v);
        }

        $this->entityManager->flush($host);

        return true;
    }

    private function parse_OS(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value == "NULL")
        {
            $host->setOsName(null);
            $host->setOsVersion(null);
        }
        else
        {
            $data = parse_ini_string($value);
            $host->setOsName($data['ID'] ?? null);
            if($data['ID'] === "ubuntu")
            {
                $host->setOsVersion($data['VERSION_ID'] ?? $data['DEBIAN_VERSION'] ?? null);
            }
            else
            {
                $host->setOsVersion($data['DEBIAN_VERSION'] ?? $data['VERSION_ID'] ?? null);
            }
        }

        $this->entityManager->flush($host);

        return true;
    }

    private function parse_APACHE_STATUS(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value == "NULL")
        {
            $host->setWebserverDomainsApache(null);
        }
        else
        {
            $v = [];

            $re = '/([^\s]+) \([^\s]+\:[\d]+\)/';
            preg_match_all($re, $value, $matches, PREG_SET_ORDER, 0);
            foreach($matches as $match)
            {
                if(isset($match[1]))
                    $v[] = $match[1];
            }

            $re = '/wild alias ([^\s]+)/';
            preg_match_all($re, $value, $matches, PREG_SET_ORDER, 0);
            foreach($matches as $match)
            {
                if(isset($match[1]))
                    $v[] = $match[1];
            }

            $host->setWebserverDomainsApache($v);
        }

        $this->entityManager->flush($host);

        return true;
    }

    private function parse_NGINX_STATUS(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value == "NULL")
        {
            $host->setWebserverDomainsNginx(null);
        }
        else
        {
            $v = [];

            $re = '/server_name\s+([^;]+)/';
            preg_match_all($re, $value, $matches, PREG_SET_ORDER, 0);
            foreach($matches as $match)
            {
                if(isset($match[1]))
                    $v[] = trim($match[1],"\"");
            }
            $v = array_unique($v);
            $host->setWebserverDomainsNginx($v);
        }

        $this->entityManager->flush($host);

        return true;
    }

    private function parse_MIRRORS(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value == "NULL")
        {
            $host->setPackagesAptMirrors(null);
        }
        else
        {
            $v = [];

            $re = '/^deb( \[[^\s]+\])? ([^\s]+) ([^\s]+) (.+)/m';
            preg_match_all($re, $value, $matches, PREG_SET_ORDER, 0);
            foreach($matches as $match)
            {
                if(isset($match[2]) && isset($match[3]) && isset($match[4]))
                    $v[] = [
                        'url' => $match[2],
                        'distribution' => $match[3],
                        'components' => explode(' ',trim($match[4])),
                    ];
            }

            $host->setPackagesAptMirrors($v);
        }

        $this->entityManager->flush($host);

        return true;
    }

    private function parse_APT_ERROR(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $host->setPackagesAptHasRepoError(trim($rawFact->getRawValue()) != 0);
        $this->entityManager->flush($host);

        return true;
    }

    private function parse_DF(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value == "NULL")
        {
            $host->setDisks(null);
        }
        else
        {
            $v = [];

            $lines = explode("\n",$value);
            foreach($lines as $line)
            {
                if(!stristr($line,"/")) continue;

                $cols = preg_split('/\s+/', $line);

                $v[] = [
                    'mount' => $cols[5],
                    'filesystem' => $cols[0],
                    'size_kb' => $cols[1],
                    'used_kb' => $cols[2],
                    'free_kb' => $cols[3],
                ];
            }

            $host->setDisks($v);
        }

        $this->entityManager->flush($host);

        return true;
    }

    private function parse_NETSTAT(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value == "NULL")
        {
            $host->setDisks(null);
        }
        else
        {
            $v = [];

            $lines = explode("\n",$value);
            foreach($lines as $line)
            {
                $cols = preg_split('/\s+/', $line);

                if(!isset($cols[6]) || $cols[5] != "LISTEN") continue;

                list($local_port,$local_address) = explode(':',strrev($cols[3]),2);
                list($foreign_port,$foreign_address) = explode(':',strrev($cols[4]),2);
                list($pname,$pid) = explode('/',strrev($cols[6]),2);

                $v[] = [
                    'protocol' => $cols[0],
                    'local_address' => strrev($local_address),
                    'local_port' => strrev($local_port),
                    'foreign_address' => strrev($foreign_address),
                    'foreign_port' => strrev($foreign_port),
                    'pid' => strrev($pid),
                    'pname' => strrev($pname)
                ];
            }

            $host->setServicesListening($v);
        }

        $this->entityManager->flush($host);

        return true;
    }

    private function parse_DPKG(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value == "NULL")
        {
            $host->setPackagesInstalled(null);
        }
        else
        {
            $v = [];

            $lines = explode("\n",$value);
            foreach($lines as $line)
            {
                if(empty($line)) continue;
                $cols = explode(";",$line);
                if(!isset($cols[4])) continue;

                $v[] = [
                    'name' => $cols[0],
                    'version' => $cols[1],
                    'current_state' => $cols[2],
                    'wanted_state' => $cols[3],
                    'error_flag' => $cols[4],
                ];
            }

            $host->setPackagesInstalled($v);
        }

        $this->entityManager->flush($host);

        return true;
    }

    private function parse_PS(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value == "NULL")
        {
            $host->setProcessesRunning(null);
        }
        else
        {
            $v = [];

            $lines = explode("\n",$value);
            foreach($lines as $line_no => $line)
            {
                if(empty($line) || $line_no == 0) continue;

                $cols = preg_split('/\s+/', $line);

                $v[] = [
                    'process' => $cols[10],
                    'user' => $cols[0],
                    'pid' => $cols[1],
                    'cpu_percent' => $cols[2],
                    'ram_percent' => $cols[3],
                    'tty' => $cols[6],
                    'status' => $cols[7],
                ];
            }
            $host->setProcessesRunning($v);
        }

        $this->entityManager->flush($host);

        return true;
    }

    private function parse_APT_UPGRADABLE(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $value = trim($rawFact->getRawValue());

        if(empty($value) || $value == "NULL")
        {
            $host->setPackagesAptUpgradable(null);
        }
        else
        {
            $v = [];

            $re = "/([^\s]+) \(([^\s]+) => ([^\s]+)\)/m";
            preg_match_all($re, $value, $matches, PREG_SET_ORDER, 0);
            foreach($matches as $match)
            {
                if(isset($match[3]))
                    $v[] = [
                        'name' => $match[1],
                        'version_from' => $match[2],
                        'version_to' => $match[3],
                    ];
            }

            $host->setPackagesAptUpgradable($v);
        }

        $this->entityManager->flush($host);

        return true;
    }

    private function parse_MAILQ(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $result = null;

        $value = $rawFact->getRawValue();
        if(!empty($value))
        {
            $re = '/in (\d+) Request/';
            preg_match($re, $value, $matches);
            if(isset($matches[1]))
                $result=$matches[1];

            if(empty($result))
            {
                $re = '/Total requests: (\d+)/';
                preg_match_all($re, $value, $matches1);

                if(isset($matches1[1]))
                {
                    $result=array_sum($matches1[1]);
                }
            }

            if(empty($result))
                $result = 0;
        }

        $host->setMailqCount($result);
        $this->entityManager->flush($host);

        return true;
    }

    private function parse_UPTIME(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $result = null;

        $value = $rawFact->getRawValue();
        if(!empty($value))
        {
            $re = '/up (\d+) days/';
            preg_match($re, $value, $matches);
            if(isset($matches[1]))
                $result=$matches[1];

            if(empty($result))
                $result = 0;
        }

        $host->setUptimeSeconds($result*60*60*24);
        $this->entityManager->flush($host);

        return true;
    }

    private function parse_PROXMOX_VERSION(HostRawFact $rawFact)
    {
        /** @var Host $host */
        $host = $rawFact->getHost();

        $result = null;

        $value = $rawFact->getRawValue();
        if(!empty($value))
        {
            $re = '/│\s+version\s+│\s+([\d+\.\-]+)\s+│/';
            preg_match($re, $value, $matches);
            if(isset($matches[1]))
                $result=$matches[1];
        }

        $host->setProxmoxVersion($result);
        $this->entityManager->flush($host);

        return true;
    }



}

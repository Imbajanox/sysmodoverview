<?php
namespace WirklichDigital\SyshelperDataSink\Controller;

use Darsyn\IP\Doctrine\MultiType;
use Laminas\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;
use Ramsey\Uuid\Uuid;
use WirklichDigital\Logger\GlobalAvailableLogger;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SyshelperBase\Entity\HostRawFact;
use WirklichDigital\SyshelperBase\Service\HostRawFactsParsingService;
use Laminas\View\Model\JsonModel;

class HostController extends AbstractActionController
{

    const LOG_SINK_REQUESTS = false;

    public function __construct(
        protected EntityManager $entityManager,
        protected HostRawFactsParsingService $hostRawFactsParsingService
    )
    {
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function indexAction()
    {
        $type = $this->params()->fromQuery('type');
        $rawValue = file_get_contents('php://input');

        if(self::LOG_SINK_REQUESTS) 
            GlobalAvailableLogger::get()->debug('New data sink request',[
                'type' => $type,
                'rawValue' => $rawValue
            ]);

        $connectionIp = $_SERVER['REMOTE_ADDR'];
        $systemUuid = $this->params()->fromQuery("uuid");

        if(empty($connectionIp))
            die("CONNECTION IP NOT VISIBLE");
        if(empty($systemUuid))
            die("SYSTEM UUID CANNOT BE EMPTY");
        if(!$this->hostRawFactsParsingService->canParse($type)) {
            GlobalAvailableLogger::get()->debug('Invalid / unparsable type detected in ingress',[
                'type' => $type,
                'rawValue' => $rawValue
            ]);
            die("INVALID TYPE");
        }

        $host = $this->entityManager->getRepository(Host::class)->findOneBy(['connectionIp' => $connectionIp, 'systemUuid' => $systemUuid]);
        if(empty($host))
        	$host = $this->entityManager->getRepository(Host::class)->findOneBy(['externalIpV4' => $connectionIp, 'systemUuid' => $systemUuid]);
        if(empty($host))
	        $host = $this->entityManager->getRepository(Host::class)->findOneBy(['externalIpV6' => $connectionIp, 'systemUuid' => $systemUuid]);

        if(empty($host))
        {
            $host = new Host();
            $host->setConnectionIp($connectionIp);
            $host->setLastConnectionAt(new \DateTime());
            $host->setSystemUuid($systemUuid);
            $this->entityManager->persist($host);
            $this->entityManager->flush($host);
        }
        $host->setConnectionIp($connectionIp);
        $host->setLastConnectionAt(new \DateTime());
        $this->entityManager->flush($host);

        $rawFact = $this->entityManager->getRepository(HostRawFact::class)->findOneBy(['host' => $host, 'type' => $type]);
        if(empty($rawFact))
        {
            $rawFact = new HostRawFact();
            $rawFact->setHost($host);
            $rawFact->setType($type);
            $this->entityManager->persist($rawFact);
        }

        $rawFact->setRawValue($rawValue);
        $rawFact->setHasBeenParsed(false);
        $this->entityManager->flush($rawFact);

        return new JsonModel(["OK"]);
    }
}

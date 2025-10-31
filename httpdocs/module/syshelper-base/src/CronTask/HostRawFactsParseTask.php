<?php
namespace WirklichDigital\SyshelperBase\CronTask;

use WirklichDigital\CronScheduler\CronTask\CronTaskExecutable;
use Doctrine\ORM\EntityManager;
use WirklichDigital\GlobalAvailableRedisMutex\GlobalAvailableRedisMutex;
use WirklichDigital\SyshelperBase\Entity\Host;
use WirklichDigital\SyshelperBase\Entity\HostRawFact;
use WirklichDigital\SyshelperBase\Entity\SshPublicKey;
use WirklichDigital\SyshelperBase\Service\HostRawFactsParsingService;

class HostRawFactsParseTask implements CronTaskExecutable
{
    /** @var EntityManager */
    protected $entityManager;

    /** @var HostRawFactsParsingService */
    protected $hostRawFactsParsingService;

    public function __construct(EntityManager $entityManager, $hostRawFactsParsingService)
    {
        $this->entityManager = $entityManager;
        $this->hostRawFactsParsingService = $hostRawFactsParsingService;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function run()
    {
        $rawFacts = $this->entityManager->getRepository(HostRawFact::class)->findBy(['hasBeenParsed' => false], ['updatedAt' => 'ASC'],500);
        foreach($rawFacts as $rawFact)
        {
            $mutexKey = 'hostRawFactsParseTask_'.$rawFact->getId();

            if(!GlobalAvailableRedisMutex::get($mutexKey, false, 20)) {
                echo "Mutex already locked for ".$rawFact->getId().". Skipping.\n";
                continue;
            }

            $this->hostRawFactsParsingService->parse($rawFact);
            $rawFact->setHasBeenParsed(true);
            $this->entityManager->flush($rawFact);

            GlobalAvailableRedisMutex::release($mutexKey);
        }
        return true;
    }
}

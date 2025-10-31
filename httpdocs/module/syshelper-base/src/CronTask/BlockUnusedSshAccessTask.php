<?php
namespace WirklichDigital\SyshelperBase\CronTask;

use Doctrine\Common\Collections\Criteria;
use WirklichDigital\CronScheduler\CronTask\CronTaskExecutable;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostAccess;

class BlockUnusedSshAccessTask implements CronTaskExecutable
{
    public function __construct(
        protected EntityManager $entityManager
    )
    {
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function run()
    {
        $blockBefore = new \DateTime('-2 months');

        $query = $this->entityManager->createQueryBuilder()
            ->select('spkha.id as spkhaId, spkha.createdAt, max(spkl.loggedInAt) as lastLogin')
            ->from(SshPublicKeyHostAccess::class, 'spkha')
            ->leftJoin('spkha.sshPublicKey', 'spk')
            ->leftJoin('spk.sshPublicKeyLogins', 'spkl')
            ->andWhere('spkha.doNotBlockIfUnused = 0')
            ->groupBy('spkha.id');

        $accesses = $query->getQuery()->getResult();
        foreach($accesses as $access) {
            if(empty($access['lastLogin']) && $access['createdAt'] < $blockBefore) {
                /** @var SshPublicKeyHostAccess */
                $accessObj = $this->entityManager->getRepository(SshPublicKeyHostAccess::class)->find($access['spkhaId']);
                $accessObj->setBlockedBecauseUnused(true);
                echo "Blocked access: " . $access['spkhaId'] . "\n";
            }
            else if(!empty($access['lastLogin']) && (new \DateTime($access['lastLogin'])) < $blockBefore) {
                /** @var SshPublicKeyHostAccess */
                $accessObj = $this->entityManager->getRepository(SshPublicKeyHostAccess::class)->find($access['spkhaId']);
                $accessObj->setBlockedBecauseUnused(true);
                echo "Blocked access: " . $access['spkhaId'] . "\n";
            }
        }
        $this->entityManager->flush();

        return true;
    }
}

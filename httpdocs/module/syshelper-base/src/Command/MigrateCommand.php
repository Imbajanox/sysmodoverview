<?php
namespace WirklichDigital\SyshelperBase\Command;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use Laminas\Filter\Word\CamelCaseToDash;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Path;
use WirklichDigital\SyshelperBase\Entity\SshPublicKey;
use WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostAccess;

class MigrateCommand extends Command
{
    public function __construct(
        protected EntityManager $entityManager,
    )
    {
        parent::__construct();
    }

    public function getDescription(): string
    {
        return "MigrateCommand";
    }

    public function getInputDefinition()
    {
        $inputDefinition = [
        ];

        return $inputDefinition;
    }

    protected function configure(): void
    {
        $inputDefinition = $this->getInputDefinition();

        $this
            ->setName('syshelper:migrate')
            ->addUsage('syshelper:migrate [options]')
            ->setDefinition(
                new InputDefinition($inputDefinition)
            );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $sshKeys = $this->entityManager->getRepository(SshPublicKey::class)->findAll();

        /** @var SshPublicKey */
        foreach($sshKeys as $sshKey) {
            if(in_array($sshKey->getUsergroup(),['admin','high','employee'])) {
                continue;
            }

            foreach($sshKey->getHostMappings() as $mapping) {

                //If not exists
                if($this->entityManager->getRepository(SshPublicKeyHostAccess::class)->findOneBy([
                    'host' => $mapping->getHost(),
                    'sshPublicKey' => $sshKey,
                    'userOnHost' => $mapping->getUserOnHost()
                ])) {
                    continue;
                }

                $hostAccess = new SshPublicKeyHostAccess();
                $hostAccess->setHost($mapping->getHost());
                $hostAccess->setSshPublicKey($sshKey);
                $hostAccess->setUserOnHost($mapping->getUserOnHost());
                $hostAccess->setDoNotBlockIfUnused(false);
                $this->entityManager->persist($hostAccess);
            }
            $this->entityManager->flush();
        }

        return Command::SUCCESS;
    }
}

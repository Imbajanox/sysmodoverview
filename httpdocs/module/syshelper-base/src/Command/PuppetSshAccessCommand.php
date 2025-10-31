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

class PuppetSshAccessCommand extends Command
{
    public function __construct(
        protected EntityManager $entityManager,
    )
    {
        parent::__construct();
    }

    public function getDescription(): string
    {
        return "Outputs a puppet manfiest formatted file with SSH public keys";
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
            ->setName('syshelper:puppet-ssh-access')
            ->addUsage('syshelper:puppet-ssh-access [options]')
            ->setDefinition(
                new InputDefinition($inputDefinition)
            );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $baseTemplate = file_get_contents(__DIR__ . '/../../assets/templates/puppet-manifest.pp');
        $hostTemplate = file_get_contents(__DIR__ . '/../../assets/templates/puppet-manifest-host.pp');
        $sshkeyTemplate = file_get_contents(__DIR__ . '/../../assets/templates/puppet-manifest-sshkey.pp');
        
        $criteriaAllHostKeys = new Criteria();
        $criteriaAllHostKeys
            ->andWhere(Criteria::expr()->in('usergroup', ["admin", "high"]))
            ->orderBy(['title' => 'ASC']);
        $allHostKeys = $this->entityManager->getRepository(SshPublicKey::class)->matching($criteriaAllHostKeys);

        $criteriaEmployees = new Criteria();
        $criteriaEmployees
            ->andWhere(Criteria::expr()->in('usergroup', ["admin", "high", "employee"]))
            ->orderBy(['title' => 'ASC']);
        $employees = $this->entityManager->getRepository(SshPublicKey::class)->matching($criteriaEmployees);
        
        $accessItems = $this->entityManager->getRepository(SshPublicKeyHostAccess::class)->findBy(['blockedBecauseUnused' => false]);

        $output = $baseTemplate;

        $allHostKeysString = "";
        foreach($allHostKeys as $sshPublicKey) {
            $sshkey = $sshkeyTemplate;
            $sshkey = str_replace("%%RESOURCENAME%%", $sshPublicKey->getUsergroup().'-'.$sshPublicKey->getTitle(), $sshkey);
            $sshkey = str_replace("%%TITLE%%", $sshPublicKey->getTitle()." for root", $sshkey);
            $sshkey = str_replace("%%USER%%", "root", $sshkey);
            $sshkey = str_replace("%%KEYTYPE%%", $sshPublicKey->getKeyType(), $sshkey);
            $sshkey = str_replace("%%KEYDATA%%", $sshPublicKey->getKeyData(), $sshkey);
            $allHostKeysString .= $sshkey."\n\n";
        }
        $output = str_replace("%%FORALLHOSTS%%", $allHostKeysString, $output);

        $hosts = [];
        foreach($accessItems as $accessItem) {
            /** @var SshPublicKeyHostAccess $accessItem */
            $host = $accessItem->getHost()->getFqdn();
            if(!isset($hosts[$host])) {
                $hosts[$host] = [];
            }

            $sshkey = $sshkeyTemplate;
            $sshPublicKey = $accessItem->getSshPublicKey();
            $sshkey = str_replace("%%RESOURCENAME%%", $host.'-'.$accessItem->getUserOnHost().'-'.$sshPublicKey->getTitle(), $sshkey);
            $sshkey = str_replace("%%TITLE%%", $sshPublicKey->getTitle()." for ".$accessItem->getUserOnHost(), $sshkey);
            $sshkey = str_replace("%%USER%%", $accessItem->getUserOnHost(), $sshkey);
            $sshkey = str_replace("%%KEYTYPE%%", $sshPublicKey->getKeyType(), $sshkey);
            $sshkey = str_replace("%%KEYDATA%%", $sshPublicKey->getKeyData(), $sshkey);
            $hosts[$host][] = $sshkey;
        }
        
        // Patch for cloud control
        $hosts["hc04.jarmedia.de"] = [];
        foreach($employees as $employee) {
            $sshkey = $sshkeyTemplate;
            $sshkey = str_replace("%%RESOURCENAME%%", 'hc04-containerUser-'.$employee->getTitle(), $sshkey);
            $sshkey = str_replace("%%TITLE%%", $employee->getTitle()." for containerUser", $sshkey);
            $sshkey = str_replace("%%USER%%", 'containerUser', $sshkey);
            $sshkey = str_replace("%%KEYTYPE%%", $employee->getKeyType(), $sshkey);
            $sshkey = str_replace("%%KEYDATA%%", $employee->getKeyData(), $sshkey);
            $hosts["hc04.jarmedia.de"][] = $sshkey;
        }
        
        $hostCaseString = "";
        foreach($hosts as $fqdn => $sshkeys) {
            $hostString = $hostTemplate;
            $hostString = str_replace("%%FQDN%%", $fqdn, $hostString);
            $hostString = str_replace("%%SSHKEYS%%", implode("\n", $sshkeys), $hostString);
            $hostCaseString .= $hostString."\n";
        }

        $output = str_replace("%%HOSTCASE%%", $hostCaseString, $output);

        $io->write($output);

        return Command::SUCCESS;
    }
}

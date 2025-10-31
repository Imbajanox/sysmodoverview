<?php
namespace WirklichDigital\SyshelperBase\Service;

use Doctrine\ORM\EntityManager;
use WirklichDigital\SyshelperBase\Entity\SshPublicKey;

class SshPublicKeyService
{

    public function __construct(
        protected EntityManager $entityManager
    )
    {
    }

    public function getSshPublicKeyFingerprintMap() {
        /** @var SshPublicKey $sshPublicKey */
        $sshPublicKey = $this->entityManager->getRepository(SshPublicKey::class)->findAll();
        $fingerprints = [];
        foreach($sshPublicKey as $sshPublicKey) {
            $fingerprints[$sshPublicKey->getFingerprint()] = $sshPublicKey;
        }
        return $fingerprints;
    }

    public function updateTitleIfNeeded(SshPublicKey $sshPublicKey) {
        // If title is already set, do not update it
        if(!empty($sshPublicKey->getTitle()))
            return;

        $envs = [];
        $comments = [];
        $titleToSet = $sshPublicKey->getTitle();

        foreach($sshPublicKey->getHostMappings() as $hostMapping) {
            $env = $hostMapping->getEnvironment();
            if(!empty($env)) {
                if(stristr($env,'=') !== false) {
                    $env = explode('=',$env);
                    $envs[] = $env[1];
                }
                else {
                    $envs[] = $hostMapping->getEnvironment();
                }
            }
            if(!empty($hostMapping->getComment()))
                $comments[] = $hostMapping->getComment();
        }

        $envs = array_unique($envs);
        $comments = array_unique($comments);

        if(!empty($envs)) {
            $titleToSet = implode(', ', $envs);
        }
        else if(!empty($comments)) {
            $titleToSet = implode(', ', $comments);
        }
        
        if($titleToSet != $sshPublicKey->getTitle()) {
            $sshPublicKey->setTitle($titleToSet);
            $this->entityManager->flush($sshPublicKey);
        }
    }

    public function getSshPublicKeyFingerprint($keyType, $keyData)
    {
        // Use "ssh-keygen -lf <tmpfile>" to get the fingerprint
        $fingerprint = null;
        $fileContent = $keyType." ".$keyData."\n";
        $tmpFile = tempnam(sys_get_temp_dir(), 'sshkey');
        file_put_contents($tmpFile, $fileContent);
        $output = [];
        exec("ssh-keygen -lf ".$tmpFile,$output);
        if(!empty($output))
        {
            $parts = explode(" ",$output[0]);
            if(isset($parts[1]))
                $fingerprint = $parts[1];
        }
        unlink($tmpFile);

        return $fingerprint;
    }

}

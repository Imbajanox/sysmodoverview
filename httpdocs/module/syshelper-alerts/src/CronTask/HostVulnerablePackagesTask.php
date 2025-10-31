<?php

namespace WirklichDigital\SyshelperAlerts\CronTask;

use WirklichDigital\SyshelperAlerts\Entity\Alert;
use WirklichDigital\SyshelperBase\Entity\Host;

class HostVulnerablePackagesTask extends AbstractAlertTask
{
    const ALERT_NAME = "Host has vulnerable packet";
    const ALERT_DESCRIPTION = "This host has at least one package that is listed as potentially vulnerable: ";

    const VULNERABLE = 'vulnerable';
    const NON_VULNERABLE = 'nonVulnerable';

    /**
     *
     * The array VULN_PKG contains the packages that are checked for vulnerabilities.
     * Structure:
     * [
     *      [
     *          "name" => "package name",
     *          "versionType" => self::VULNERABLE or self::NON_VULNERABLE,
     *          "versions" => [
     *              [
     *                  "from_version" => "version number",
     *                  "to_version" => "version number",
     *                  "include_to_version" => true or false,
     *                  "osNamePrefix" => "os name prefix", // or null
     *                  "osVersionPrefix" => "os version prefix" // or null
     *              ]
     *          ]
     *      ]
     * ]
     */

    const VULN_PKG = [
        [
            "name" => "networkd-dispatcher",
            "versionType" => self::VULNERABLE,
            "versions" => [
                [
                    "from_version" => "2.0", 
                    "to_version" => "2.1-2", 
                    "include_to_version" => false, 
                    "osNamePrefix" => null, 
                    "osVersionPrefix" => null
                ]
            ]
        ],
        [
            "name" => "bind9", 
            "versionType" => self::VULNERABLE,
            "versions" => [
                [
                    "from_version" => "9.0", 
                    "to_version" => "9.18.3", 
                    "include_to_version" => false, 
                    "osNamePrefix" => null, 
                    "osVersionPrefix" => null
                ]
            ]
        ],
        [
            "name" => "openssh-server", 
            "versionType" => self::NON_VULNERABLE,
            "versions" => [
                [
                    "from_version" => "1:0", 
                    "to_version" => "1:8.5p1", 
                    "include_to_version" => false,
                    "osNamePrefix" => "debian", 
                    "osVersionPrefix" => "7"
                ],
                [
                    "from_version" => "1:0",
                    "to_version" => "1:8.5p1", 
                    "include_to_version" => false,
                    "osNamePrefix" => "debian", 
                    "osVersionPrefix" => "8"
                ],
                [
                    "from_version" => "1:0",
                    "to_version" => "1:8.5p1", 
                    "include_to_version" => false,
                    "osNamePrefix" => "debian", 
                    "osVersionPrefix" => "9"
                ],
                [
                    "from_version" => "1:7.9p1", 
                    "to_version" => "9999", 
                    "include_to_version" => true,
                    "osNamePrefix" => "debian", 
                    "osVersionPrefix" => "10"
                ],
                [
                    "from_version" => "1:8.4p1", 
                    "to_version" => "9999", 
                    "include_to_version" => true,
                    "osNamePrefix" => "debian", 
                    "osVersionPrefix" => "11"
                ],
                [
                    "from_version" => "1:9.2p1", 
                    "to_version" => "9999", 
                    "include_to_version" => true,
                    "osNamePrefix" => "debian", 
                    "osVersionPrefix" => "12"
                ],
                [
                    "from_version" => "1:0",
                    "to_version" => "1:8.5p1", 
                    "include_to_version" => false,
                    "osNamePrefix" => "ubuntu", 
                    "osVersionPrefix" => "16"
                ],
                [
                    "from_version" => "1:0",
                    "to_version" => "1:8.5p1",
                    "include_to_version" => false,
                    "osNamePrefix" => "ubuntu", 
                    "osVersionPrefix" => "18"
                ],
                [
                    "from_version" => "1:0",
                    "to_version" => "1:8.5p1", 
                    "include_to_version" => false,
                    "osNamePrefix" => "ubuntu", 
                    "osVersionPrefix" => "20"
                ],
                [
                    "from_version" => "1:8.9p1", 
                    "to_version" => "9999", 
                    "include_to_version" => true,
                    "osNamePrefix" => "ubuntu", 
                    "osVersionPrefix" => "22"
                ],
                [
                    "from_version" => "1:9.6p1", 
                    "to_version" => "9999", 
                    "include_to_version" => true,
                    "osNamePrefix" => "ubuntu", 
                    "osVersionPrefix" => "24"
                ]
            ]
        ]
    ];
    //                       ["name" => "openssh-server", "from_version" => "1:0","to_version" => "1:4.4_p1"] ]; //,
    //                       ["name" => "rsync", "from_version" => "1:0","to_version" => "3.2.5"] ];
    protected static $verifiedAlertIds = [];

    protected function detectAlerts()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $tmp_query = $qb->select('h')
            ->from(Host::class, 'h')
            ->andWhere("'1' = '0'");
        foreach (self::VULN_PKG as $i => $vuln) {
            $tmp_query = $tmp_query->orWhere("h.packagesInstalled LIKE '%" . $vuln['name'] . "%'");
        }
        $query = $tmp_query->getQuery();
        $result = $query->getResult();

        foreach ($result as $host) {
            $details = '';
            foreach (self::VULN_PKG as $i => $vuln) {
                //echo "\n\nSearching Host ".$host->getFqdn()." for Vuln ".$vuln['name']."\n";
                foreach ($host->getPackagesInstalled() as $pkg) {
                    if ($pkg["name"] === $vuln['name']) {

                        if($vuln['versionType'] == self::NON_VULNERABLE){
                            $isVulnerable = true;
                            foreach ($vuln['versions'] as $version) {

                                if(!$this->versionSuitsHost($host, $version)) {
                                    continue;
                                }

                                if ($this->versionIsInRange($pkg["version"], $version['from_version'], $version['to_version'], $version['include_to_version'])) {
                                    $isVulnerable = false;
                                    break;
                                }
                            }
                            if($isVulnerable){
                                $details .= "\n    -" . $pkg["name"] . " (Installed version " . $pkg["version"] . " does not match the unvulnerable version range.)";
                            }
                        }

                        if($vuln['versionType'] == self::VULNERABLE){
                            foreach ($vuln['versions'] as $version) {
                            
                                if(!$this->versionSuitsHost($host, $version)) {
                                    continue;
                                }

                                if ($this->versionIsInRange($pkg["version"], $version['from_version'], $version['to_version'], $version['include_to_version'])) {
                                    $details .= "\n    -" . $pkg["name"] . " (Version ".$version['from_version']." - ".$version['to_version']." are vulnerable. Version installed is ".$pkg["version"];
                                    break;
                                }
                            }
                        }
                    }
                }
            }
            if ($details != '') {
                self::$verifiedAlertIds[] = $host->getId();
                $this->alertService->newAlert(self::class, $host->getId(), self::ALERT_NAME, self::ALERT_DESCRIPTION . $details, $host);
            }
        }
    }

    protected function releaseAlerts()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->select('a')
            ->from(Alert::class, 'a')
            ->andWhere('a.cronjobClass = :cronjobClass')
            ->setParameter('cronjobClass', self::class)
            ->getQuery();
        $result = $query->getResult();

        foreach ($result as $alert) {
            if (!in_array($alert->getAlertIdentifier(), self::$verifiedAlertIds)) {
                $this->alertService->releaseAlert($alert);
            } else {
                $details = '';
                foreach (self::VULN_PKG as $i => $vuln) {
                    foreach ($alert->getHost()->getPackagesInstalled() as $pkg) {
                        $host = $alert->getHost();
                        if ($pkg["name"] === $vuln['name']) {
                            
                            if($vuln['versionType'] == self::NON_VULNERABLE){
                                $isVulnerable = true;
                                foreach ($vuln['versions'] as $version) {
    
                                    if(!$this->versionSuitsHost($host, $version)) {
                                        continue;
                                    }
    
                                    if ($this->versionIsInRange($pkg["version"], $version['from_version'], $version['to_version'], $version['include_to_version'])) {
                                        $isVulnerable = false;
                                        break;
                                    }
                                }
                                if($isVulnerable){
                                    $details .= "\n    -" . $pkg["name"] . " (Your version " . $pkg["version"] . " does not match the unvulnerable version range.)";
                                }
                            }
    
                            if($vuln['versionType'] == self::VULNERABLE){
                                foreach ($vuln['versions'] as $version) {
                                
                                    if(!$this->versionSuitsHost($host, $version)) {
                                        continue;
                                    }
    
                                    if ($this->versionIsInRange($pkg["version"], $version['from_version'], $version['to_version'], $version['include_to_version'])) {
                                        $details .= "\n    -" . $pkg["name"] . " (Version ".$version['from_version']." - ".$version['to_version']." are vulnerable. You have ".$pkg["version"] . ' ' . $host->getOsVersion() .")";
                                        break;
                                    }
                                }
                            }

                        }
                    }
                }
                if ($details == '') {
                    $this->alertService->releaseAlert($alert);
                } else {
                    $alert->setDescription(self::ALERT_DESCRIPTION . $details);
                }
            }
        }
    }

    private function versionSuitsHost($host, $version)
    {
        $osNamePrefix = $version['osNamePrefix'] ?? null;
        $osVersionPrefix = $version['osVersionPrefix'] ?? null;

        if($osNamePrefix != null && substr(strtolower($host->getOsName()), 0, strlen($osNamePrefix)) != strtolower($osNamePrefix)){
            return false;
        }

        if($osVersionPrefix != null && substr(strtolower($host->getOsVersion()), 0, strlen($osVersionPrefix)) != strtolower($osVersionPrefix)){
            return false;
        }

        return true;
    }

    protected function versionIsInRange($version, $min, $max, $includeMax = false)
    {
        $version = implode(".",explode(",", preg_replace('/\s+/', ',', preg_replace('/[^0-9]/', ' ', $version))));
        $min = implode(".",explode(",", preg_replace('/\s+/', ',', preg_replace('/[^0-9]/', ' ', $min))));
        $max = implode(".",explode(",", preg_replace('/\s+/', ',', preg_replace('/[^0-9]/', ' ', $max))));

        $isBiggerThanMin = version_compare($version, $min) >= 0;
        if($includeMax){
            $isSmallerThanFix = version_compare($version, $max) <= 0;
        }
        else{
            $isSmallerThanFix = version_compare($version, $max) < 0;
        }

        return $isBiggerThanMin && $isSmallerThanFix;
    }
}

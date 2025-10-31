<?php
namespace WirklichDigital\SystemModuleOverview\CronTask;

use WirklichDigital\CronScheduler\CronTask\CronTaskExecutable;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SystemModuleOverview\Service\SysModOverviewService;

class SaveSystemdatasTask implements CronTaskExecutable
{
    public function __construct(
        protected EntityManager $entityManager,
        protected SysModOverviewService $sysModOverviewService
    ) {
    }

    public function run()
    {
        $files = scandir("data/sysmoddatas/systems");
        array_splice($files,0,2);
        print_r($files);
        return true;
        // if()
        $data = json_decode(file_get_contents(""),true);
        
        $this->sysModOverviewService->setInfos($data);
        return true;
    }
}

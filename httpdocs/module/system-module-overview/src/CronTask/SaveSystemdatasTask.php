<?php
namespace WirklichDigital\SystemModuleOverview\CronTask;

use WirklichDigital\CronScheduler\CronTask\CronTaskExecutable;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SystemModuleOverview\Service\SysModOverviewService;
use Exception;

use function array_diff;
use function file_get_contents;
use function is_dir;
use function is_file;
use function json_decode;
use function json_last_error;
use function json_last_error_msg;
use function scandir;
use function sprintf;
use function str_ends_with;

use const JSON_ERROR_NONE;

class SaveSystemdatasTask implements CronTaskExecutable
{
    public function __construct(
        protected EntityManager $entityManager,
        protected SysModOverviewService $sysModOverviewService
    ) {
    }

    public function run()
    {
        $systemsDir = "data/sysmoddatas/systems";
        
        if (!is_dir($systemsDir)) {
            error_log(sprintf("SaveSystemdatasTask: Directory '%s' does not exist", $systemsDir));
            return false;
        }

        $files = scandir($systemsDir);
        if ($files === false) {
            error_log(sprintf("SaveSystemdatasTask: Failed to scan directory '%s'", $systemsDir));
            return false;
        }

        // Remove . and .. from the list
        $files = array_diff($files, ['.', '..']);
        
        $processedCount = 0;
        $errorCount = 0;

        foreach ($files as $file) {
            $filePath = $systemsDir . '/' . $file;
            
            // Only process JSON files
            if (!is_file($filePath) || !str_ends_with($file, '.json')) {
                continue;
            }

            try {
                $jsonContent = file_get_contents($filePath);
                if ($jsonContent === false) {
                    error_log(sprintf("SaveSystemdatasTask: Failed to read file '%s'", $filePath));
                    $errorCount++;
                    continue;
                }

                $data = json_decode($jsonContent, true);
                if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                    error_log(sprintf("SaveSystemdatasTask: Invalid JSON in file '%s': %s", $filePath, json_last_error_msg()));
                    $errorCount++;
                    continue;
                }

                if (!is_array($data)) {
                    error_log(sprintf("SaveSystemdatasTask: Invalid data format in file '%s'", $filePath));
                    $errorCount++;
                    continue;
                }

                $this->sysModOverviewService->setInfos($data);
                $processedCount++;
                
                error_log(sprintf("SaveSystemdatasTask: Successfully processed file '%s'", $file));
            } catch (Exception $e) {
                error_log(sprintf("SaveSystemdatasTask: Error processing file '%s': %s", $filePath, $e->getMessage()));
                $errorCount++;
            }
        }

        error_log(sprintf("SaveSystemdatasTask: Processed %d files, %d errors", $processedCount, $errorCount));
        
        return true;
    }
}

<?php

namespace WirklichDigital\SystemModuleOverview\CronTask;

use Doctrine\ORM\EntityManager;
use Exception;
use WirklichDigital\CronScheduler\CronTask\CronTaskExecutable;
use WirklichDigital\SystemModuleOverview\Service\LaminasSystemLogService;
use WirklichDigital\SystemModuleOverview\Service\ProcessedFileCleanupService;

use function date;
use function fclose;
use function file_exists;
use function file_put_contents;
use function fopen;
use function fwrite;
use function sprintf;

class CleanupProcessedFilesTask implements CronTaskExecutable
{
    private const DEFAULT_RETENTION_DAYS = 30;

    private int $retentionDays;

    public function __construct(
        protected EntityManager $entityManager,
        protected ProcessedFileCleanupService $cleanupService,
        protected LaminasSystemLogService $logService,
        protected array $config,
    ) {
        $processingConfig    = $config['wirklich-digital']['system-module-overview']['processing'] ?? [];
        $this->retentionDays = $processingConfig['retention_days'] ?? self::DEFAULT_RETENTION_DAYS;
    }

    public function run()
    {
        $this->logService->info(
            sprintf("Starting cleanup with retention period of %d days", $this->retentionDays),
            'CleanupProcessedFilesTask::run'
        );

        try {
            // Clean up old database records
            $deletedRecords = $this->cleanupService->cleanupOldRecords($this->retentionDays);

            // Clean up old archived files
            $deletedFiles = $this->cleanupService->cleanupArchivedFiles($this->retentionDays);

            // Log statistics
            $stats = $this->cleanupService->getStatistics();
            $this->logService->info(
                sprintf(
                    "Cleanup complete. Deleted %d records, %d files. Current stats: %d total files (%d successful, %d failed)",
                    $deletedRecords,
                    $deletedFiles,
                    $stats['total_files'],
                    $stats['successful_files'],
                    $stats['failed_files']
                ),
                'CleanupProcessedFilesTask::run'
            );

            return true;
        } catch (Exception $e) {
            $this->logService->error(
                sprintf("Error during cleanup: %s", $e->getMessage()),
                'CleanupProcessedFilesTask::run'
            );
            return false;
        }
    }
}

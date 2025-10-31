<?php

namespace WirklichDigital\SystemModuleOverview\CronTask;

use WirklichDigital\CronScheduler\CronTask\CronTaskExecutable;
use WirklichDigital\SystemModuleOverview\Service\ProcessedFileCleanupService;

use function sprintf;

/**
 * Cronjob to clean up old processed files and database records
 * Runs daily to remove old data based on retention policy
 */
class CleanupProcessedFilesTask implements CronTaskExecutable
{
    // Default retention period in days
    private const DEFAULT_RETENTION_DAYS = 30;
    
    private int $retentionDays;
    
    public function __construct(
        protected ProcessedFileCleanupService $cleanupService,
        protected array $config = []
    ) {
        // Load configuration with fallback to default
        $processingConfig = $config['wirklich-digital']['system-module-overview']['processing'] ?? [];
        $this->retentionDays = $processingConfig['retention_days'] ?? self::DEFAULT_RETENTION_DAYS;
    }
    
    public function run()
    {
        error_log(sprintf(
            "CleanupProcessedFilesTask: Starting cleanup with retention period of %d days",
            $this->retentionDays
        ));
        
        try {
            // Clean up old database records
            $deletedRecords = $this->cleanupService->cleanupOldRecords($this->retentionDays);
            
            // Clean up old archived files
            $deletedFiles = $this->cleanupService->cleanupArchivedFiles($this->retentionDays);
            
            // Log statistics
            $stats = $this->cleanupService->getStatistics();
            error_log(sprintf(
                "CleanupProcessedFilesTask: Cleanup complete. Deleted %d records, %d files. Current stats: %d total files (%d successful, %d failed)",
                $deletedRecords,
                $deletedFiles,
                $stats['total_files'],
                $stats['successful_files'],
                $stats['failed_files']
            ));
            
            return true;
        } catch (\Exception $e) {
            error_log(sprintf(
                "CleanupProcessedFilesTask: Error during cleanup: %s",
                $e->getMessage()
            ));
            return false;
        }
    }
}

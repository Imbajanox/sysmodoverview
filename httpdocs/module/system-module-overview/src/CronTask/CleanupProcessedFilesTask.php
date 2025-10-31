<?php

namespace WirklichDigital\SystemModuleOverview\CronTask;

use Doctrine\ORM\EntityManager;
use Exception;
use WirklichDigital\CronScheduler\CronTask\CronTaskExecutable;
use WirklichDigital\SystemModuleOverview\Service\ProcessedFileCleanupService;

use function date;
use function fclose;
use function file_exists;
use function file_put_contents;
use function fopen;
use function fwrite;
use function sprintf;

use const FILE_APPEND;
use const PHP_EOL;

class CleanupProcessedFilesTask implements CronTaskExecutable
{
    private $logFile = '';

    private const DEFAULT_RETENTION_DAYS = 30;

    private int $retentionDays;

    public function __construct(
        protected EntityManager $entityManager,
        protected ProcessedFileCleanupService $cleanupService,
        protected array $config,
    ) {
        $processingConfig    = $config['wirklich-digital']['system-module-overview']['processing'] ?? [];
        $this->retentionDays = $processingConfig['retention_days'] ?? self::DEFAULT_RETENTION_DAYS;
    }

    /**
     * Schreibt eine Nachricht mit Zeitstempel in die Log-Datei.
     *
     * @param string $message Die zu protokollierende Nachricht.
     */
    private function logMessage(string $message): void
    {
        $logDir        = 'data/log/cron.log';
        $this->logFile = $logDir;

        $timestamp = date('[Y-m-d H:i:s] ');
        $logEntry  = $timestamp . $message . PHP_EOL;

        if (! file_exists($logDir)) {
        // The file does not exist, so create it
            $fileHandle = fopen($logDir, 'w');

            if ($fileHandle) {
                // Optionally write some initial content
                fwrite($fileHandle, "");
                // Close the file handle
                fclose($fileHandle);
            }
        }

        // Fügt den Eintrag ans Ende der Datei an
        file_put_contents($this->logFile, $logEntry, FILE_APPEND);
    }

    public function run()
    {
        $this->logMessage(sprintf(
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
            $this->logMessage(sprintf(
                "CleanupProcessedFilesTask: Cleanup complete. Deleted %d records, %d files. Current stats: %d total files (%d successful, %d failed)",
                $deletedRecords,
                $deletedFiles,
                $stats['total_files'],
                $stats['successful_files'],
                $stats['failed_files']
            ));

            return true;
        } catch (Exception $e) {
            $this->logMessage(sprintf(
                "CleanupProcessedFilesTask: Error during cleanup: %s",
                $e->getMessage()
            ));
            return false;
        }
    }
}

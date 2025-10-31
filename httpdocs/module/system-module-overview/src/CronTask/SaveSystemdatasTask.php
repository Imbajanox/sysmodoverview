<?php

namespace WirklichDigital\SystemModuleOverview\CronTask;

use DateTime;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManager;
use Exception;
use WirklichDigital\CronScheduler\CronTask\CronTaskExecutable;
use WirklichDigital\SystemModuleOverview\Entity\ProcessedFile;
use WirklichDigital\SystemModuleOverview\Service\LaminasSystemLogService;
use WirklichDigital\SystemModuleOverview\Service\SysModOverviewService;

use function array_diff;
use function array_slice;
use function count;
use function date;
use function fclose;
use function file_exists;
use function file_get_contents;
use function file_put_contents;
use function filemtime;
use function fopen;
use function fwrite;
use function is_array;
use function is_dir;
use function is_file;
use function json_decode;
use function json_last_error;
use function json_last_error_msg;
use function md5_file;
use function mkdir;
use function pathinfo;
use function rename;
use function scandir;
use function sprintf;
use function strpos;
use function strtolower;
use function usort;

use const FILE_APPEND;
use const JSON_ERROR_NONE;
use const PATHINFO_EXTENSION;
use const PHP_EOL;

class SaveSystemdatasTask implements CronTaskExecutable
{
    // Default batch processing configuration
    private const DEFAULT_MAX_FILES_PER_RUN = 50;

    // Directory paths
    private const SYSTEMS_DIR   = 'data/sysmoddatas/systems';
    private const PROCESSED_DIR = 'data/sysmoddatas/processed';

    // File processing status constants
    private const STATUS_SUCCESS = 'success';
    private const STATUS_ERROR   = 'error';

    private int $maxFilesPerRun;
    private bool $archiveProcessedFiles;

    public function __construct(
        protected EntityManager $entityManager,
        protected SysModOverviewService $sysModOverviewService,
        protected LaminasSystemLogService $logService,
        protected array $config
    ) {
        $processingConfig            = $config['wirklich-digital']['system-module-overview']['processing'] ?? [];
        $this->maxFilesPerRun        = $processingConfig['max_files_per_run'] ?? self::DEFAULT_MAX_FILES_PER_RUN;
        $this->archiveProcessedFiles = $processingConfig['archive_processed_files'] ?? true;
    }

    public function run()
    {
        $systemsDir   = self::SYSTEMS_DIR;
        $processedDir = self::PROCESSED_DIR;

        if (! is_dir($systemsDir)) {
            $this->logService->error(
                sprintf("Directory '%s' does not exist", $systemsDir),
                'SaveSystemdatasTask::run'
            );
            return false;
        }

        // Create processed directory if it doesn't exist
        if (! is_dir($processedDir)) {
            mkdir($processedDir, 0755, true);
        }

        $files = scandir($systemsDir);
        if ($files === false) {
            $this->logService->error(
                sprintf("Failed to scan directory '%s'", $systemsDir),
                'SaveSystemdatasTask::run'
            );
            return false;
        }

        // Remove . and .. from the list
        $files = array_diff($files, ['.', '..']);

        // Filter to only unprocessed JSON files and sort by modification time (oldest first)
        $unprocessedFiles = $this->getUnprocessedFiles($systemsDir, $files);

        // Apply batch limit
        $filesToProcess = array_slice($unprocessedFiles, 0, $this->maxFilesPerRun);

        $processedCount = 0;
        $errorCount     = 0;
        $skippedCount   = count($unprocessedFiles) - count($filesToProcess);

        $this->logService->info(
            sprintf(
                "Found %d unprocessed files, processing %d (batch limit: %d)",
                count($unprocessedFiles),
                count($filesToProcess),
                $this->maxFilesPerRun
            ),
            'SaveSystemdatasTask::run'
        );

        foreach ($filesToProcess as $fileInfo) {
            $file     = $fileInfo['name'];
            $filePath = $systemsDir . '/' . $file;
            $fileHash = $fileInfo['hash'];

            try {
                $jsonContent = file_get_contents($filePath);
                if ($jsonContent === false) {
                    $this->markFileAsProcessed($file, $filePath, $fileHash, self::STATUS_ERROR, "Failed to read file");
                    $this->logService->error(
                        sprintf("Failed to read file '%s'", $filePath),
                        'SaveSystemdatasTask::run'
                    );
                    $errorCount++;
                    continue;
                }

                $data = json_decode($jsonContent, true);
                if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                    $errorMessage = sprintf("Invalid JSON: %s", json_last_error_msg());
                    $this->markFileAsProcessed($file, $filePath, $fileHash, self::STATUS_ERROR, $errorMessage);
                    $this->logService->error(
                        sprintf("Invalid JSON in file '%s': %s", $filePath, json_last_error_msg()),
                        'SaveSystemdatasTask::run'
                    );
                    $errorCount++;
                    continue;
                }

                if (! is_array($data)) {
                    $this->markFileAsProcessed($file, $filePath, $fileHash, self::STATUS_ERROR, "Invalid data format");
                    $this->logService->error(
                        sprintf("Invalid data format in file '%s'", $filePath),
                        'SaveSystemdatasTask::run'
                    );
                    $errorCount++;
                    continue;
                }

                $this->sysModOverviewService->setInfos($data);
                $this->markFileAsProcessed($file, $filePath, $fileHash, self::STATUS_SUCCESS, null);
                $processedCount++;

                // Archive the processed file if configured
                if ($this->archiveProcessedFiles) {
                    $this->archiveFile($filePath, $processedDir, $file);
                }

                $this->logService->info(
                    sprintf("Successfully processed file '%s'", $file),
                    'SaveSystemdatasTask::run'
                );
            } catch (Exception $e) {
                $this->markFileAsProcessed($file, $filePath, $fileHash, self::STATUS_ERROR, $e->getMessage());
                $this->logService->error(
                    sprintf("Error processing file '%s': %s", $filePath, $e->getMessage()),
                    'SaveSystemdatasTask::run'
                );
                $errorCount++;
            }
        }

        $this->logService->info(
            sprintf(
                "Processed %d files successfully, %d errors, %d skipped (will be processed in next run)",
                $processedCount,
                $errorCount,
                $skippedCount
            ),
            'SaveSystemdatasTask::run'
        );

        return true;
    }

    /**
     * Get list of unprocessed files with their metadata
     *
     * @return array Array of file info with 'name', 'path', 'hash', 'mtime'
     */
    private function getUnprocessedFiles(string $systemsDir, array $files): array
    {
        $unprocessedFiles = [];

        foreach ($files as $file) {
            $filePath = $systemsDir . '/' . $file;

            // Only process JSON files (case-insensitive)
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (! is_file($filePath) || $extension !== 'json') {
                continue;
            }

            // Calculate file hash
            $fileHash = md5_file($filePath);
            if ($fileHash === false) {
                $this->logService->warning(
                    sprintf("Failed to calculate hash for file '%s'", $filePath),
                    'SaveSystemdatasTask::getUnprocessedFiles'
                );
                continue;
            }

            // Check if file was already processed (by hash)
            if ($this->isFileProcessed($fileHash)) {
                continue;
            }

            $unprocessedFiles[] = [
                'name'  => $file,
                'path'  => $filePath,
                'hash'  => $fileHash,
                'mtime' => filemtime($filePath),
            ];
        }

        // Sort by modification time (oldest first)
        usort($unprocessedFiles, function ($a, $b) {
            return $a['mtime'] <=> $b['mtime'];
        });

        return $unprocessedFiles;
    }

    /**
     * Check if a file with the given hash was already processed
     */
    private function isFileProcessed(string $fileHash): bool
    {
        $processedFile = $this->entityManager
            ->getRepository(ProcessedFile::class)
            ->findOneBy(['fileHash' => $fileHash]);

        return $processedFile !== null;
    }

    /**
     * Mark file as processed in database
     * Handles duplicate hash errors gracefully (race condition protection)
     */
    private function markFileAsProcessed(
        string $filename,
        string $filePath,
        string $fileHash,
        string $status,
        ?string $errorMessage = null
    ): void {
        try {
            $processedFile = new ProcessedFile();
            $processedFile->setFilename($filename);
            $processedFile->setFilePath($filePath);
            $processedFile->setFileHash($fileHash);
            $processedFile->setProcessedAt(new DateTime());
            $processedFile->setStatus($status);
            $processedFile->setErrorMessage($errorMessage);

            $this->entityManager->persist($processedFile);
            $this->entityManager->flush();
        } catch (UniqueConstraintViolationException $e) {
            // File was already marked by another process - this is OK (race condition)
            $this->logService->info(
                sprintf("File '%s' already marked as processed (race condition handled)", $filename),
                'SaveSystemdatasTask::markFileAsProcessed'
            );
        } catch (Exception $e) {
            // Check for generic duplicate entry errors as fallback
            if (
                strpos($e->getMessage(), 'Duplicate entry') !== false ||
                strpos($e->getMessage(), 'SQLSTATE[23000]') !== false
            ) {
                $this->logService->info(
                    sprintf("File '%s' already marked as processed (race condition handled)", $filename),
                    'SaveSystemdatasTask::markFileAsProcessed'
                );
            } else {
                // Re-throw other errors
                $this->logService->error(
                    sprintf("Error marking file '%s' as processed: %s", $filename, $e->getMessage()),
                    'SaveSystemdatasTask::markFileAsProcessed'
                );
                throw $e;
            }
        }
    }

    /**
     * Archive processed file to processed directory
     */
    private function archiveFile(string $filePath, string $processedDir, string $filename): void
    {
        try {
            $archivePath = $processedDir . '/' . $filename;

            // If file with same name exists in archive, append timestamp
            if (file_exists($archivePath)) {
                $pathInfo    = pathinfo($filename);
                $timestamp   = (new DateTime())->format('Y-m-d_H-i-s');
                $archivePath = sprintf(
                    "%s/%s_%s.%s",
                    $processedDir,
                    $pathInfo['filename'],
                    $timestamp,
                    $pathInfo['extension']
                );
            }

            if (rename($filePath, $archivePath)) {
                $this->logService->info(
                    sprintf("Archived file '%s' to '%s'", $filename, $archivePath),
                    'SaveSystemdatasTask::archiveFile'
                );
            } else {
                $this->logService->error(
                    sprintf("Failed to archive file '%s'", $filename),
                    'SaveSystemdatasTask::archiveFile'
                );
            }
        } catch (Exception $e) {
            $this->logService->error(
                sprintf("Error archiving file '%s': %s", $filename, $e->getMessage()),
                'SaveSystemdatasTask::archiveFile'
            );
        }
    }
}

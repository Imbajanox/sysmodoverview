<?php

namespace WirklichDigital\SystemModuleOverview\Service;

use DateTime;
use Doctrine\ORM\EntityManager;
use Exception;
use WirklichDigital\SystemModuleOverview\Entity\ProcessedFile;

use function array_diff;
use function filemtime;
use function is_dir;
use function is_file;
use function scandir;
use function sprintf;
use function unlink;

/**
 * Service to manage processed files cleanup
 */
class ProcessedFileCleanupService
{
    // Default retention period in days
    private const DEFAULT_RETENTION_DAYS = 30;

    // Directory path for processed files
    private const PROCESSED_DIR = 'data/sysmoddatas/processed';

    public function __construct(
        protected EntityManager $entityManager,
        protected LaminasSystemLogService $logService,
        protected array $config,
    ) {
    }

    /**
     * Clean up old processed file records from database
     *
     * @param int|null $daysToKeep Number of days to keep records (default: 30)
     * @return int Number of records deleted
     */
    public function cleanupOldRecords(?int $daysToKeep = null): int
    {
        $daysToKeep = $daysToKeep ?? self::DEFAULT_RETENTION_DAYS;
        $cutoffDate = new DateTime("-{$daysToKeep} days");

        $qb    = $this->entityManager->createQueryBuilder();
        $query = $qb->delete(ProcessedFile::class, 'pf')
            ->where('pf.processedAt < :cutoffDate')
            ->andWhere('pf.status = :status')
            ->setParameter('cutoffDate', $cutoffDate)
            ->setParameter('status', 'success')
            ->getQuery();

        $deletedCount = $query->execute();

        $this->logService->info(
            sprintf("Deleted %d old processed file records (older than %d days)", $deletedCount, $daysToKeep),
            'ProcessedFileCleanupService::cleanupOldRecords'
        );

        return $deletedCount;
    }

    /**
     * Clean up old archived files from filesystem
     *
     * @param int|null $daysToKeep Number of days to keep archived files (default: 30)
     * @return int Number of files deleted
     */
    public function cleanupArchivedFiles(?int $daysToKeep = null): int
    {
        $daysToKeep   = $daysToKeep ?? self::DEFAULT_RETENTION_DAYS;
        $processedDir = self::PROCESSED_DIR;

        if (! is_dir($processedDir)) {
            $this->logService->warning(
                "Processed directory does not exist",
                'ProcessedFileCleanupService::cleanupArchivedFiles'
            );
            return 0;
        }

        $files = scandir($processedDir);
        if ($files === false) {
            $this->logService->error(
                "Failed to scan processed directory",
                'ProcessedFileCleanupService::cleanupArchivedFiles'
            );
            return 0;
        }

        $files           = array_diff($files, ['.', '..']);
        $cutoffTimestamp = (new DateTime("-{$daysToKeep} days"))->getTimestamp();
        $deletedCount    = 0;

        foreach ($files as $file) {
            $filePath = $processedDir . '/' . $file;

            if (! is_file($filePath)) {
                continue;
            }

            try {
                $fileTime = filemtime($filePath);
                if ($fileTime === false) {
                    $this->logService->warning(
                        sprintf("Could not get modification time for '%s'", $filePath),
                        'ProcessedFileCleanupService::cleanupArchivedFiles'
                    );
                    continue;
                }

                if ($fileTime < $cutoffTimestamp) {
                    if (unlink($filePath)) {
                        $deletedCount++;
                        $this->logService->info(
                            sprintf("Deleted old archived file '%s'", $file),
                            'ProcessedFileCleanupService::cleanupArchivedFiles'
                        );
                    } else {
                        $this->logService->error(
                            sprintf("Failed to delete archived file '%s'", $file),
                            'ProcessedFileCleanupService::cleanupArchivedFiles'
                        );
                    }
                }
            } catch (Exception $e) {
                $this->logService->error(
                    sprintf("Error processing file '%s': %s", $file, $e->getMessage()),
                    'ProcessedFileCleanupService::cleanupArchivedFiles'
                );
            }
        }

        $this->logService->info(
            sprintf("Deleted %d old archived files (older than %d days)", $deletedCount, $daysToKeep),
            'ProcessedFileCleanupService::cleanupArchivedFiles'
        );

        return $deletedCount;
    }

    /**
     * Get statistics about processed files
     *
     * @return array Statistics array with success/error counts and dates
     */
    public function getStatistics(): array
    {
        $repository = $this->entityManager->getRepository(ProcessedFile::class);

        $qb = $this->entityManager->createQueryBuilder();

        // Total count
        $totalCount = $qb->select('COUNT(pf.id)')
            ->from(ProcessedFile::class, 'pf')
            ->getQuery()
            ->getSingleScalarResult();

        // Success count
        $qb           = $this->entityManager->createQueryBuilder();
        $successCount = $qb->select('COUNT(pf.id)')
            ->from(ProcessedFile::class, 'pf')
            ->where('pf.status = :status')
            ->setParameter('status', 'success')
            ->getQuery()
            ->getSingleScalarResult();

        // Error count
        $qb         = $this->entityManager->createQueryBuilder();
        $errorCount = $qb->select('COUNT(pf.id)')
            ->from(ProcessedFile::class, 'pf')
            ->where('pf.status = :status')
            ->setParameter('status', 'error')
            ->getQuery()
            ->getSingleScalarResult();

        // Latest processed file
        $qb         = $this->entityManager->createQueryBuilder();
        $latestFile = $qb->select('pf')
            ->from(ProcessedFile::class, 'pf')
            ->orderBy('pf.processedAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return [
            'total_files'           => $totalCount,
            'successful_files'      => $successCount,
            'failed_files'          => $errorCount,
            'latest_processed_at'   => $latestFile ? $latestFile->getProcessedAt() : null,
            'latest_processed_file' => $latestFile ? $latestFile->getFilename() : null,
        ];
    }
}

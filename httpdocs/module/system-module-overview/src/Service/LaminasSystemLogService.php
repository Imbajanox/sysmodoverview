<?php

namespace WirklichDigital\SystemModuleOverview\Service;

use DateTime;
use Doctrine\ORM\EntityManager;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemLog;

/**
 * Service to handle logging operations for the system-module-overview module
 * 
 * Replaces the previous file-based logging with database-backed logging.
 * Provides methods to log messages at different severity levels.
 */
class LaminasSystemLogService
{
    // Log level constants
    public const LEVEL_INFO = 'info';
    public const LEVEL_WARNING = 'warning';
    public const LEVEL_ERROR = 'error';
    public const LEVEL_DEBUG = 'debug';

    public function __construct(
        protected EntityManager $entityManager
    ) {
    }

    /**
     * Log a message with the specified level
     *
     * @param string $message The log message
     * @param string $level The log level (info, warning, error, debug)
     * @param string|null $context The context where the log was created (e.g., class name)
     * @param array|null $additionalData Any additional data to log
     * @return void
     */
    public function log(
        string $message,
        string $level = self::LEVEL_INFO,
        ?string $context = null,
        ?array $additionalData = null
    ): void {
        try {
            $logEntry = new LaminasSystemLog();
            $logEntry->setMessage($message);
            $logEntry->setLevel($level);
            $logEntry->setContext($context);
            $logEntry->setAdditionalData($additionalData);
            $logEntry->setCreatedAt(new DateTime());

            $this->entityManager->persist($logEntry);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            // Fallback to error_log if database logging fails
            error_log(sprintf(
                '[%s] LaminasSystemLog failed to write to database: %s. Original message: [%s] %s',
                date('Y-m-d H:i:s'),
                $e->getMessage(),
                $level,
                $message
            ));
        }
    }

    /**
     * Log an info message
     */
    public function info(string $message, ?string $context = null, ?array $additionalData = null): void
    {
        $this->log($message, self::LEVEL_INFO, $context, $additionalData);
    }

    /**
     * Log a warning message
     */
    public function warning(string $message, ?string $context = null, ?array $additionalData = null): void
    {
        $this->log($message, self::LEVEL_WARNING, $context, $additionalData);
    }

    /**
     * Log an error message
     */
    public function error(string $message, ?string $context = null, ?array $additionalData = null): void
    {
        $this->log($message, self::LEVEL_ERROR, $context, $additionalData);
    }

    /**
     * Log a debug message
     */
    public function debug(string $message, ?string $context = null, ?array $additionalData = null): void
    {
        $this->log($message, self::LEVEL_DEBUG, $context, $additionalData);
    }
}

<?php

declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Migration for LaminasSystemLog entity
 * Adds logging table to track all important events in the system-module-overview module
 */
final class Version20251031120000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add LaminasSystemLog entity for database-backed logging';
    }

    public function up(Schema $schema): void
    {
        // Create LaminasSystemLog table
        $this->addSql('CREATE TABLE LaminasSystemLog (
            id INT AUTO_INCREMENT NOT NULL,
            level VARCHAR(50) NOT NULL,
            message LONGTEXT NOT NULL,
            context VARCHAR(255) DEFAULT NULL,
            additionalData JSON DEFAULT NULL,
            createdAt DATETIME NOT NULL,
            PRIMARY KEY(id),
            INDEX IDX_laminas_system_log_level (level),
            INDEX IDX_laminas_system_log_created_at (createdAt),
            INDEX IDX_laminas_system_log_context (context)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // Drop LaminasSystemLog table
        $this->addSql('DROP TABLE LaminasSystemLog');
    }
}

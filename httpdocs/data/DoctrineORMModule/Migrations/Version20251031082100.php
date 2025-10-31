<?php

declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Migration for ProcessedFile entity
 * Adds tracking table to prevent reprocessing of files
 */
final class Version20251031082100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add ProcessedFile entity for tracking processed system data files';
    }

    public function up(Schema $schema): void
    {
        // Create ProcessedFile table
        $this->addSql('CREATE TABLE ProcessedFile (
            id INT AUTO_INCREMENT NOT NULL,
            filename VARCHAR(255) NOT NULL,
            filePath VARCHAR(500) DEFAULT NULL,
            fileHash VARCHAR(32) NOT NULL,
            processedAt DATETIME NOT NULL,
            status VARCHAR(50) NOT NULL,
            errorMessage LONGTEXT DEFAULT NULL,
            PRIMARY KEY(id),
            UNIQUE INDEX UNIQ_processed_file_hash (fileHash),
            INDEX IDX_processed_file_status (status),
            INDEX IDX_processed_file_processed_at (processedAt)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // Drop ProcessedFile table
        $this->addSql('DROP TABLE ProcessedFile');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250926090652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE LaminasSystemServerMigrationInfo (id INT AUTO_INCREMENT NOT NULL, databaseDetails JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', versions JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', migrationDetails JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', laminasSystemServer_id INT DEFAULT NULL, INDEX IDX_AFF50C94A1F143F2 (laminasSystemServer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE LaminasSystemServerMigrationInfo ADD CONSTRAINT FK_AFF50C94A1F143F2 FOREIGN KEY (laminasSystemServer_id) REFERENCES LaminasSystemServer (id)');
        $this->addSql('ALTER TABLE Translation CHANGE field field VARCHAR(64) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE LaminasSystemServerMigrationInfo DROP FOREIGN KEY FK_AFF50C94A1F143F2');
        $this->addSql('DROP TABLE LaminasSystemServerMigrationInfo');
        $this->addSql('ALTER TABLE Translation CHANGE field field VARCHAR(32) NOT NULL');
    }
}

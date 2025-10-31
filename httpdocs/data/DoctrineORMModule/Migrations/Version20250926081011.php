<?php

declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250926081011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ComposerModule (id INT AUTO_INCREMENT NOT NULL, vendor VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, systems INT DEFAULT NULL, upToDate INT DEFAULT NULL, outdated INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE LaminasSystem (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', repositoryName VARCHAR(255) NOT NULL, repository VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE LaminasSystemServer (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) DEFAULT NULL, ipAddress VARCHAR(255) NOT NULL, phpinfo VARCHAR(255) DEFAULT NULL, config VARCHAR(255) DEFAULT NULL, j77Config LONGTEXT DEFAULT NULL, phpVersion VARCHAR(255) DEFAULT NULL, isDeinPim TINYINT(1) DEFAULT NULL, isDevelopment TINYINT(1) DEFAULT NULL, hasMinorUpdates TINYINT(1) DEFAULT NULL, hasMajorUpdates TINYINT(1) DEFAULT NULL, hasWirklichDigitalMinorUpdates TINYINT(1) DEFAULT NULL, hasWirklichDigitalMajorUpdates TINYINT(1) DEFAULT NULL, lastUpdateValue INT DEFAULT NULL, createdAt DATETIME DEFAULT NULL, updatedAt DATETIME DEFAULT NULL, laminasSystem_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_A342A506C276D508 (laminasSystem_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE LaminasSystemServerComposerOutdated (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, version VARCHAR(255) NOT NULL, latest VARCHAR(255) NOT NULL, latestStatus VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, laminasSystemServer_id INT DEFAULT NULL, composerModule_id INT DEFAULT NULL, INDEX IDX_30731CDDA1F143F2 (laminasSystemServer_id), INDEX IDX_30731CDD6836830C (composerModule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE LaminasSystemServerDatabaseInfo (id INT AUTO_INCREMENT NOT NULL, dbName VARCHAR(255) DEFAULT NULL, dbEngine VARCHAR(255) DEFAULT NULL, dbVersion VARCHAR(255) DEFAULT NULL, dbRowFormat VARCHAR(255) DEFAULT NULL, dbRows VARCHAR(255) DEFAULT NULL, dbAvgRowLength VARCHAR(255) DEFAULT NULL, dbDataLength VARCHAR(255) DEFAULT NULL, dbMaxDataLength VARCHAR(255) DEFAULT NULL, dbIndexLength VARCHAR(255) DEFAULT NULL, dbDataFree VARCHAR(255) DEFAULT NULL, dbAutoIncrement VARCHAR(255) DEFAULT NULL, dbCreateTime VARCHAR(255) DEFAULT NULL, dbUpdateTime VARCHAR(255) DEFAULT NULL, dbCheckTime VARCHAR(255) DEFAULT NULL, dbCollation VARCHAR(255) DEFAULT NULL, dbChecksum VARCHAR(255) DEFAULT NULL, dbCreateOptions VARCHAR(255) DEFAULT NULL, dbComment VARCHAR(255) DEFAULT NULL, dbMaxIndexLength VARCHAR(255) DEFAULT NULL, dbTemporary VARCHAR(255) DEFAULT NULL, laminasSystemServer_id INT DEFAULT NULL, INDEX IDX_6CB54FF3A1F143F2 (laminasSystemServer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE LaminasSystemServerModule (id INT AUTO_INCREMENT NOT NULL, moduleName VARCHAR(255) DEFAULT NULL, moduleVersion VARCHAR(255) DEFAULT NULL, moduleVersionNormalized VARCHAR(255) DEFAULT NULL, moduleSource JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleDist JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleRequire JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleConflict JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleProvide JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleReplace JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleRequiredev JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleSuggest JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleTime VARCHAR(255) DEFAULT NULL, moduleBin JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleType VARCHAR(255) DEFAULT NULL, moduleExtra JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleInstallationsource VARCHAR(255) DEFAULT NULL, moduleAutoload JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleAutoloaddev JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleScripts JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleNotificationurl VARCHAR(255) DEFAULT NULL, moduleLicense JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleIncludepath JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleAuthors JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleDescription VARCHAR(255) DEFAULT NULL, moduleHomepage VARCHAR(255) DEFAULT NULL, moduleKeywords JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleSupport JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleFunding JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', moduleAbandoned VARCHAR(255) DEFAULT NULL, moduleInstallpath VARCHAR(255) DEFAULT NULL, composerModule_id INT DEFAULT NULL, INDEX IDX_8F35A36A6836830C (composerModule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE laminassystemservermodule_laminassystemserver (laminassystemservermodule_id INT NOT NULL, laminassystemserver_id INT NOT NULL, INDEX IDX_1C0EEA745BDB9A05 (laminassystemservermodule_id), INDEX IDX_1C0EEA74ABC5FFCF (laminassystemserver_id), PRIMARY KEY(laminassystemservermodule_id, laminassystemserver_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE NpmModules (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, module VARCHAR(255) DEFAULT NULL, installedVersion VARCHAR(255) DEFAULT NULL, wantedVersion VARCHAR(255) DEFAULT NULL, latestVersion VARCHAR(255) DEFAULT NULL, dependencies JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', location VARCHAR(255) DEFAULT NULL, laminasSystemServer_id INT DEFAULT NULL, INDEX IDX_A4D28CEFA1F143F2 (laminasSystemServer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE LaminasSystemServer ADD CONSTRAINT FK_A342A506C276D508 FOREIGN KEY (laminasSystem_id) REFERENCES LaminasSystem (id)');
        $this->addSql('ALTER TABLE LaminasSystemServerComposerOutdated ADD CONSTRAINT FK_30731CDDA1F143F2 FOREIGN KEY (laminasSystemServer_id) REFERENCES LaminasSystemServer (id)');
        $this->addSql('ALTER TABLE LaminasSystemServerComposerOutdated ADD CONSTRAINT FK_30731CDD6836830C FOREIGN KEY (composerModule_id) REFERENCES ComposerModule (id)');
        $this->addSql('ALTER TABLE LaminasSystemServerDatabaseInfo ADD CONSTRAINT FK_6CB54FF3A1F143F2 FOREIGN KEY (laminasSystemServer_id) REFERENCES LaminasSystemServer (id)');
        $this->addSql('ALTER TABLE LaminasSystemServerModule ADD CONSTRAINT FK_8F35A36A6836830C FOREIGN KEY (composerModule_id) REFERENCES ComposerModule (id)');
        $this->addSql('ALTER TABLE laminassystemservermodule_laminassystemserver ADD CONSTRAINT FK_1C0EEA745BDB9A05 FOREIGN KEY (laminassystemservermodule_id) REFERENCES LaminasSystemServerModule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE laminassystemservermodule_laminassystemserver ADD CONSTRAINT FK_1C0EEA74ABC5FFCF FOREIGN KEY (laminassystemserver_id) REFERENCES LaminasSystemServer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE NpmModules ADD CONSTRAINT FK_A4D28CEFA1F143F2 FOREIGN KEY (laminasSystemServer_id) REFERENCES LaminasSystemServer (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE LaminasSystemServer DROP FOREIGN KEY FK_A342A506C276D508');
        $this->addSql('ALTER TABLE LaminasSystemServerComposerOutdated DROP FOREIGN KEY FK_30731CDDA1F143F2');
        $this->addSql('ALTER TABLE LaminasSystemServerComposerOutdated DROP FOREIGN KEY FK_30731CDD6836830C');
        $this->addSql('ALTER TABLE LaminasSystemServerDatabaseInfo DROP FOREIGN KEY FK_6CB54FF3A1F143F2');
        $this->addSql('ALTER TABLE LaminasSystemServerModule DROP FOREIGN KEY FK_8F35A36A6836830C');
        $this->addSql('ALTER TABLE laminassystemservermodule_laminassystemserver DROP FOREIGN KEY FK_1C0EEA745BDB9A05');
        $this->addSql('ALTER TABLE laminassystemservermodule_laminassystemserver DROP FOREIGN KEY FK_1C0EEA74ABC5FFCF');
        $this->addSql('ALTER TABLE NpmModules DROP FOREIGN KEY FK_A4D28CEFA1F143F2');
        $this->addSql('DROP TABLE ComposerModule');
        $this->addSql('DROP TABLE LaminasSystem');
        $this->addSql('DROP TABLE LaminasSystemServer');
        $this->addSql('DROP TABLE LaminasSystemServerComposerOutdated');
        $this->addSql('DROP TABLE LaminasSystemServerDatabaseInfo');
        $this->addSql('DROP TABLE LaminasSystemServerModule');
        $this->addSql('DROP TABLE laminassystemservermodule_laminassystemserver');
        $this->addSql('DROP TABLE NpmModules');
    }
}

/*M!999999\- enable the sandbox mode */ 

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;
DROP TABLE IF EXISTS `Alert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Alert` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  `host_id` char(36) DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(255) NOT NULL,
  `description` varchar(512) NOT NULL,
  `alertIdentifier` varchar(255) NOT NULL,
  `isAcknowledged` tinyint(1) NOT NULL DEFAULT 0,
  `isMuted` tinyint(1) NOT NULL DEFAULT 0,
  `ipSubnet_id` char(36) DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `assignedIp_id` char(36) DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `reachableIp_id` char(36) DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `cronjobClass` varchar(255) NOT NULL,
  `lastSeenAt` datetime DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D63C69C51FB8D185` (`host_id`),
  KEY `IDX_D63C69C51B609EBC` (`ipSubnet_id`),
  KEY `IDX_D63C69C5D5A3FB79` (`assignedIp_id`),
  KEY `IDX_D63C69C51BB2FF67` (`reachableIp_id`),
  CONSTRAINT `FK_D63C69C51B609EBC` FOREIGN KEY (`ipSubnet_id`) REFERENCES `IpSubnet` (`id`),
  CONSTRAINT `FK_D63C69C51BB2FF67` FOREIGN KEY (`reachableIp_id`) REFERENCES `ReachableIp` (`id`),
  CONSTRAINT `FK_D63C69C51FB8D185` FOREIGN KEY (`host_id`) REFERENCES `Host` (`id`),
  CONSTRAINT `FK_D63C69C5D5A3FB79` FOREIGN KEY (`assignedIp_id`) REFERENCES `AssignedIp` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ApplicationLog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ApplicationLog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) NOT NULL,
  `extra` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`extra`)),
  `priority` smallint(6) NOT NULL,
  `url` varchar(512) NOT NULL,
  `component` varchar(512) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `createdBy_id` int(11) DEFAULT NULL,
  `updatedBy_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_225499003174800F` (`createdBy_id`),
  KEY `IDX_2254990065FF1AEC` (`updatedBy_id`),
  KEY `index_priority` (`priority`),
  KEY `index_url` (`url`),
  KEY `index_component` (`component`),
  CONSTRAINT `FK_225499003174800F` FOREIGN KEY (`createdBy_id`) REFERENCES `User` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_2254990065FF1AEC` FOREIGN KEY (`updatedBy_id`) REFERENCES `User` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `AssignedIp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `AssignedIp` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  `host_id` char(36) DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `subnet_id` char(36) DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `address` varbinary(16) NOT NULL COMMENT '(DC2Type:ip)',
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `openPortsInternal` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`openPortsInternal`)),
  `openPortsInternalLastScanAt` datetime DEFAULT NULL,
  `openPortsExternal` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`openPortsExternal`)),
  `openPortsExternalLastScanAt` datetime DEFAULT NULL,
  `syshelperDescription` longtext DEFAULT NULL,
  `ptr` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_664673CE1FB8D185` (`host_id`),
  KEY `IDX_664673CEC9CF9478` (`subnet_id`),
  CONSTRAINT `FK_664673CE1FB8D185` FOREIGN KEY (`host_id`) REFERENCES `Host` (`id`),
  CONSTRAINT `FK_664673CEC9CF9478` FOREIGN KEY (`subnet_id`) REFERENCES `IpSubnet` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `AuthMailReset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `AuthMailReset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `validUntil` datetime NOT NULL,
  `resetCode` longtext NOT NULL,
  `authMail_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5AB7788BDE5A16FC` (`authMail_id`),
  CONSTRAINT `FK_5AB7788BDE5A16FC` FOREIGN KEY (`authMail_id`) REFERENCES `AuthenticationMail` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `AuthenticationMail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `AuthenticationMail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `passwordExpires` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9C8C6C54E7927C74` (`email`),
  KEY `IDX_9C8C6C54A76ED395` (`user_id`),
  KEY `index_email` (`email`),
  KEY `index_isActive` (`isActive`),
  KEY `index_passwordExpires` (`passwordExpires`),
  KEY `index_isActive_passwordExpires` (`isActive`,`passwordExpires`),
  KEY `index_email_isActive_passwordExpires` (`email`,`isActive`,`passwordExpires`),
  CONSTRAINT `FK_9C8C6C54A76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `AuthorizationRole`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `AuthorizationRole` (
  `parents` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`parents`)),
  `priority` int(11) NOT NULL,
  `roleId` varchar(64) NOT NULL,
  PRIMARY KEY (`roleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `AuthorizationRule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `AuthorizationRule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleId` varchar(64) DEFAULT NULL,
  `resourceId` varchar(255) DEFAULT NULL,
  `privilegeId` varchar(255) DEFAULT NULL,
  `isAllow` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ComposerModule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ComposerModule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `systems` int(11) DEFAULT NULL,
  `upToDate` int(11) DEFAULT NULL,
  `outdated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=565 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `CronScheduledJob`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `CronScheduledJob` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `isEnabled` tinyint(1) NOT NULL DEFAULT 0,
  `cronString` varchar(50) NOT NULL DEFAULT '* * * * *',
  `isRunning` tinyint(1) NOT NULL DEFAULT 0,
  `lastResult` longtext NOT NULL DEFAULT '',
  `lastExecutionError` tinyint(1) NOT NULL DEFAULT 0,
  `lastExecutionDuration` decimal(10,4) NOT NULL DEFAULT 0.0000,
  `lastInvocationTime` datetime DEFAULT NULL,
  `autoRestartAfter` int(11) NOT NULL DEFAULT 120,
  `priority` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `index_name` (`name`),
  KEY `index_priority` (`priority`),
  KEY `index_isRunning` (`isRunning`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `DefaultUser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `DefaultUser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C8319C77A76ED395` (`user_id`),
  CONSTRAINT `FK_C8319C77A76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `EntityLocale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `EntityLocale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `localeKey` varchar(255) NOT NULL,
  `locale` varchar(255) NOT NULL,
  `iconClass` varchar(255) NOT NULL,
  `isDefault` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_78D1C13331C5F7A8` (`localeKey`),
  KEY `isDefault` (`isDefault`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `Host`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Host` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(255) DEFAULT NULL,
  `lastConnectionAt` datetime DEFAULT NULL,
  `connectionIp` varbinary(16) DEFAULT NULL COMMENT '(DC2Type:ip)',
  `systemUuid` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `fqdn` varchar(255) DEFAULT NULL,
  `externalIpV4` varchar(255) DEFAULT NULL,
  `externalIpV6` varchar(255) DEFAULT NULL,
  `nameservers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`nameservers`)),
  `servicesListening` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`servicesListening`)),
  `puppetVersion` varchar(255) DEFAULT NULL,
  `puppetIsOK` tinyint(1) DEFAULT NULL,
  `webserverVersionApache` varchar(255) DEFAULT NULL,
  `webserverVersionNginx` varchar(255) DEFAULT NULL,
  `webserverDomainsApache` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`webserverDomainsApache`)),
  `isVirtual` tinyint(1) DEFAULT NULL,
  `cpuCores` int(11) DEFAULT NULL,
  `cpuModel` varchar(255) DEFAULT NULL,
  `ramSizeKb` int(11) DEFAULT NULL,
  `disks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`disks`)),
  `osName` varchar(255) DEFAULT NULL,
  `osVersion` varchar(255) DEFAULT NULL,
  `kernelVersion` varchar(512) DEFAULT NULL,
  `packagesAptMirrors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`packagesAptMirrors`)),
  `packagesAptHasRepoError` tinyint(1) DEFAULT NULL,
  `packagesAptUpgradable` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`packagesAptUpgradable`)),
  `packagesInstalled` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`packagesInstalled`)),
  `pleskVersion` varchar(255) DEFAULT NULL,
  `pleskBackupIsDone` tinyint(1) DEFAULT NULL,
  `pleskBackupHasError` tinyint(1) DEFAULT NULL,
  `ramAvailableKb` int(11) DEFAULT NULL,
  `webserverDomainsNginx` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`webserverDomainsNginx`)),
  `scriptVersion` varchar(255) DEFAULT NULL,
  `processesRunning` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`processesRunning`)),
  `interfaces` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`interfaces`)),
  `syshelperDescription` longtext DEFAULT NULL,
  `mailqCount` int(11) DEFAULT NULL,
  `proxmoxVersion` varchar(255) DEFAULT NULL,
  `uptimeSeconds` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `HostRawFact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `HostRawFact` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  `host_id` char(36) DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `type` varchar(255) NOT NULL,
  `rawValue` longtext DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `hasBeenParsed` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `IDX_141645C81FB8D185` (`host_id`),
  CONSTRAINT `FK_141645C81FB8D185` FOREIGN KEY (`host_id`) REFERENCES `Host` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `IpSubnet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `IpSubnet` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  `networkAddress` varbinary(16) NOT NULL COMMENT '(DC2Type:ip)',
  `networkCidrMask` int(11) NOT NULL,
  `importSource` varchar(255) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `externalUpIps` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`externalUpIps`)),
  `externalUpIpLastScanAt` datetime DEFAULT NULL,
  `isDynamic` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Whether this subnet (or hosts that are connected to this subnet) are expected to appear for a short time only (e.g. metacloud or cloudcontrol instances).',
  `syshelperDescription` longtext DEFAULT NULL,
  `isDynamicSetManually` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Whether the "isDynamic"-status has been set manually and should not be updated in the future.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `LaminasSystem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `LaminasSystem` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  `repositoryName` varchar(255) NOT NULL,
  `repository` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `LaminasSystemServer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `LaminasSystemServer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `ipAddress` varchar(255) NOT NULL,
  `phpinfo` varchar(255) DEFAULT NULL,
  `config` varchar(255) DEFAULT NULL,
  `j77Config` longtext DEFAULT NULL,
  `phpVersion` varchar(255) DEFAULT NULL,
  `isDeinPim` tinyint(1) DEFAULT NULL,
  `isDevelopment` tinyint(1) DEFAULT NULL,
  `hasMinorUpdates` tinyint(1) DEFAULT NULL,
  `hasMajorUpdates` tinyint(1) DEFAULT NULL,
  `hasWirklichDigitalMinorUpdates` tinyint(1) DEFAULT NULL,
  `hasWirklichDigitalMajorUpdates` tinyint(1) DEFAULT NULL,
  `lastUpdateValue` int(11) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `laminasSystem_id` char(36) DEFAULT NULL COMMENT '(DC2Type:uuid)',
  PRIMARY KEY (`id`),
  KEY `IDX_A342A506C276D508` (`laminasSystem_id`),
  CONSTRAINT `FK_A342A506C276D508` FOREIGN KEY (`laminasSystem_id`) REFERENCES `LaminasSystem` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `LaminasSystemServerComposerOutdated`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `LaminasSystemServerComposerOutdated` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `latest` varchar(255) DEFAULT NULL,
  `latestStatus` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `laminasSystemServer_id` int(11) DEFAULT NULL,
  `composerModule_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_30731CDDA1F143F2` (`laminasSystemServer_id`),
  KEY `IDX_30731CDD6836830C` (`composerModule_id`),
  CONSTRAINT `FK_30731CDD6836830C` FOREIGN KEY (`composerModule_id`) REFERENCES `ComposerModule` (`id`),
  CONSTRAINT `FK_30731CDDA1F143F2` FOREIGN KEY (`laminasSystemServer_id`) REFERENCES `LaminasSystemServer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=326 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `LaminasSystemServerDatabaseInfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `LaminasSystemServerDatabaseInfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dbName` varchar(255) DEFAULT NULL,
  `dbEngine` varchar(255) DEFAULT NULL,
  `dbVersion` varchar(255) DEFAULT NULL,
  `dbRowFormat` varchar(255) DEFAULT NULL,
  `dbRows` varchar(255) DEFAULT NULL,
  `dbAvgRowLength` varchar(255) DEFAULT NULL,
  `dbDataLength` varchar(255) DEFAULT NULL,
  `dbMaxDataLength` varchar(255) DEFAULT NULL,
  `dbIndexLength` varchar(255) DEFAULT NULL,
  `dbDataFree` varchar(255) DEFAULT NULL,
  `dbAutoIncrement` varchar(255) DEFAULT NULL,
  `dbCreateTime` varchar(255) DEFAULT NULL,
  `dbUpdateTime` varchar(255) DEFAULT NULL,
  `dbCheckTime` varchar(255) DEFAULT NULL,
  `dbCollation` varchar(255) DEFAULT NULL,
  `dbChecksum` varchar(255) DEFAULT NULL,
  `dbCreateOptions` varchar(255) DEFAULT NULL,
  `dbComment` varchar(255) DEFAULT NULL,
  `dbMaxIndexLength` varchar(255) DEFAULT NULL,
  `dbTemporary` varchar(255) DEFAULT NULL,
  `laminasSystemServer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6CB54FF3A1F143F2` (`laminasSystemServer_id`),
  CONSTRAINT `FK_6CB54FF3A1F143F2` FOREIGN KEY (`laminasSystemServer_id`) REFERENCES `LaminasSystemServer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `LaminasSystemServerMigrationInfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `LaminasSystemServerMigrationInfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `databaseDetails` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`databaseDetails`)),
  `versions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`versions`)),
  `migrationDetails` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`migrationDetails`)),
  `laminasSystemServer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AFF50C94A1F143F2` (`laminasSystemServer_id`),
  CONSTRAINT `FK_AFF50C94A1F143F2` FOREIGN KEY (`laminasSystemServer_id`) REFERENCES `LaminasSystemServer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `LaminasSystemServerModule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `LaminasSystemServerModule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moduleName` varchar(255) DEFAULT NULL,
  `moduleVersion` varchar(255) DEFAULT NULL,
  `moduleVersionNormalized` varchar(255) DEFAULT NULL,
  `moduleSource` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleSource`)),
  `moduleDist` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleDist`)),
  `moduleRequire` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleRequire`)),
  `moduleConflict` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleConflict`)),
  `moduleProvide` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleProvide`)),
  `moduleReplace` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleReplace`)),
  `moduleRequiredev` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleRequiredev`)),
  `moduleSuggest` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleSuggest`)),
  `moduleTime` varchar(255) DEFAULT NULL,
  `moduleBin` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleBin`)),
  `moduleType` varchar(255) DEFAULT NULL,
  `moduleExtra` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleExtra`)),
  `moduleInstallationsource` varchar(255) DEFAULT NULL,
  `moduleAutoload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleAutoload`)),
  `moduleAutoloaddev` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleAutoloaddev`)),
  `moduleScripts` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleScripts`)),
  `moduleNotificationurl` varchar(255) DEFAULT NULL,
  `moduleLicense` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleLicense`)),
  `moduleIncludepath` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleIncludepath`)),
  `moduleAuthors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleAuthors`)),
  `moduleDescription` varchar(255) DEFAULT NULL,
  `moduleHomepage` varchar(255) DEFAULT NULL,
  `moduleKeywords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleKeywords`)),
  `moduleSupport` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleSupport`)),
  `moduleFunding` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`moduleFunding`)),
  `moduleAbandoned` varchar(255) DEFAULT NULL,
  `moduleInstallpath` varchar(255) DEFAULT NULL,
  `composerModule_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F35A36A6836830C` (`composerModule_id`),
  CONSTRAINT `FK_8F35A36A6836830C` FOREIGN KEY (`composerModule_id`) REFERENCES `ComposerModule` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=691 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `LogEntry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `LogEntry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(8) NOT NULL,
  `loggedAt` datetime NOT NULL,
  `objectId` varchar(64) DEFAULT NULL,
  `objectClass` varchar(255) NOT NULL,
  `version` int(11) NOT NULL,
  `data` longtext DEFAULT NULL COMMENT '(DC2Type:array)',
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_class_lookup_idx` (`objectClass`),
  KEY `log_date_lookup_idx` (`loggedAt`),
  KEY `log_user_lookup_idx` (`username`),
  KEY `log_version_lookup_idx` (`objectId`,`objectClass`,`version`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `MessagehubCallback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `MessagehubCallback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `messagehubId` int(11) DEFAULT NULL,
  `callback` varchar(255) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `MessagehubQueue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `MessagehubQueue` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  `channel` varchar(255) NOT NULL,
  `messageData` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`messageData`)),
  `lastRequestAttempt` datetime DEFAULT NULL,
  `failedRequets` int(11) NOT NULL DEFAULT 0,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `NpmModules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `NpmModules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `installedVersion` varchar(255) DEFAULT NULL,
  `wantedVersion` varchar(255) DEFAULT NULL,
  `latestVersion` varchar(255) DEFAULT NULL,
  `dependencies` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`dependencies`)),
  `location` varchar(255) DEFAULT NULL,
  `laminasSystemServer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A4D28CEFA1F143F2` (`laminasSystemServer_id`),
  CONSTRAINT `FK_A4D28CEFA1F143F2` FOREIGN KEY (`laminasSystemServer_id`) REFERENCES `LaminasSystemServer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ReachableIp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ReachableIp` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  `address` varbinary(16) NOT NULL COMMENT '(DC2Type:ip)',
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `assignedIp_id` char(36) DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `subnet_id` char(36) DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `ptr` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_BFB616D2D5A3FB79` (`assignedIp_id`),
  KEY `IDX_BFB616D2C9CF9478` (`subnet_id`),
  CONSTRAINT `FK_BFB616D2C9CF9478` FOREIGN KEY (`subnet_id`) REFERENCES `IpSubnet` (`id`),
  CONSTRAINT `FK_BFB616D2D5A3FB79` FOREIGN KEY (`assignedIp_id`) REFERENCES `AssignedIp` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `RenderTemplate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `RenderTemplate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `template` longtext NOT NULL DEFAULT '',
  `renderer` varchar(255) NOT NULL,
  `lastData` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`lastData`)),
  `component` varchar(255) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `createdBy_id` int(11) DEFAULT NULL,
  `updatedBy_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C7C3C3CD5E237E06` (`name`),
  KEY `IDX_C7C3C3CD3174800F` (`createdBy_id`),
  KEY `IDX_C7C3C3CD65FF1AEC` (`updatedBy_id`),
  KEY `index_component` (`component`),
  CONSTRAINT `FK_C7C3C3CD3174800F` FOREIGN KEY (`createdBy_id`) REFERENCES `User` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_C7C3C3CD65FF1AEC` FOREIGN KEY (`updatedBy_id`) REFERENCES `User` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `SearchIndex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `SearchIndex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `objectClass` varchar(255) NOT NULL,
  `objectId` varchar(255) NOT NULL,
  `locale` varchar(255) DEFAULT NULL,
  `text` longtext NOT NULL,
  `additionalData` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`additionalData`)),
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `category_object` (`category`,`objectClass`,`objectId`),
  KEY `objectclass` (`objectClass`,`objectId`),
  KEY `category_object_locale` (`category`,`objectClass`,`objectId`,`locale`),
  KEY `objectclass_locale` (`objectClass`,`objectId`,`locale`),
  FULLTEXT KEY `fulltext_search` (`text`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `SearchIndexSchedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `SearchIndexSchedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objectClass` varchar(255) NOT NULL,
  `objectId` varchar(255) NOT NULL,
  `updateType` varchar(255) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `objectclass` (`objectClass`,`objectId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `SshPublicKey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `SshPublicKey` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `keyType` varchar(255) NOT NULL,
  `keyData` varchar(4096) NOT NULL,
  `fingerprint` varchar(512) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `doNotTrackLogins` tinyint(1) NOT NULL DEFAULT 0,
  `usergroup` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `SshPublicKeyHostAccess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `SshPublicKeyHostAccess` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  `host_id` char(36) DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `userOnHost` varchar(255) DEFAULT NULL,
  `doNotBlockIfUnused` tinyint(1) NOT NULL DEFAULT 0,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `sshPublicKey_id` char(36) DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `blockedBecauseUnused` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `IDX_76E4551710C73291` (`sshPublicKey_id`),
  KEY `IDX_76E455171FB8D185` (`host_id`),
  CONSTRAINT `FK_76E4551710C73291` FOREIGN KEY (`sshPublicKey_id`) REFERENCES `SshPublicKey` (`id`),
  CONSTRAINT `FK_76E455171FB8D185` FOREIGN KEY (`host_id`) REFERENCES `Host` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `SshPublicKeyHostMapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `SshPublicKeyHostMapping` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  `host_id` char(36) DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `environment` varchar(512) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `sshPublicKey_id` char(36) DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `comment` varchar(512) DEFAULT NULL,
  `userOnHost` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A643B1DE10C73291` (`sshPublicKey_id`),
  KEY `IDX_A643B1DE1FB8D185` (`host_id`),
  CONSTRAINT `FK_A643B1DE10C73291` FOREIGN KEY (`sshPublicKey_id`) REFERENCES `SshPublicKey` (`id`),
  CONSTRAINT `FK_A643B1DE1FB8D185` FOREIGN KEY (`host_id`) REFERENCES `Host` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `SshPublicKeyLogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `SshPublicKeyLogin` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  `user` varchar(32) DEFAULT NULL,
  `loggedInAt` datetime NOT NULL,
  `sshPublicKey_id` char(36) DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `host_id` char(36) DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `ip` varbinary(16) DEFAULT NULL COMMENT '(DC2Type:ip)',
  PRIMARY KEY (`id`),
  KEY `IDX_D1AF4A7F10C73291` (`sshPublicKey_id`),
  KEY `IDX_D1AF4A7F1FB8D185` (`host_id`),
  CONSTRAINT `FK_D1AF4A7F10C73291` FOREIGN KEY (`sshPublicKey_id`) REFERENCES `SshPublicKey` (`id`),
  CONSTRAINT `FK_D1AF4A7F1FB8D185` FOREIGN KEY (`host_id`) REFERENCES `Host` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `SyshelperTag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `SyshelperTag` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `createdBy_id` int(11) DEFAULT NULL,
  `updatedBy_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C4C402163174800F` (`createdBy_id`),
  KEY `IDX_C4C4021665FF1AEC` (`updatedBy_id`),
  CONSTRAINT `FK_C4C402163174800F` FOREIGN KEY (`createdBy_id`) REFERENCES `User` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_C4C4021665FF1AEC` FOREIGN KEY (`updatedBy_id`) REFERENCES `User` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `SystemOption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `SystemOption` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `optionKey` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `value` longtext DEFAULT NULL,
  `isEditable` tinyint(1) NOT NULL DEFAULT 1,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `createdBy_id` int(11) DEFAULT NULL,
  `updatedBy_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9BECA97873583516` (`optionKey`),
  KEY `IDX_9BECA9783174800F` (`createdBy_id`),
  KEY `IDX_9BECA97865FF1AEC` (`updatedBy_id`),
  CONSTRAINT `FK_9BECA9783174800F` FOREIGN KEY (`createdBy_id`) REFERENCES `User` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_9BECA97865FF1AEC` FOREIGN KEY (`updatedBy_id`) REFERENCES `User` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `SystemUser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `SystemUser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `createdBy_id` int(11) DEFAULT NULL,
  `updatedBy_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E22FC986A76ED395` (`user_id`),
  KEY `IDX_E22FC9863174800F` (`createdBy_id`),
  KEY `IDX_E22FC98665FF1AEC` (`updatedBy_id`),
  CONSTRAINT `FK_E22FC9863174800F` FOREIGN KEY (`createdBy_id`) REFERENCES `User` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_E22FC98665FF1AEC` FOREIGN KEY (`updatedBy_id`) REFERENCES `User` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_E22FC986A76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `Translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(8) NOT NULL,
  `objectClass` varchar(255) NOT NULL,
  `field` varchar(64) NOT NULL,
  `foreignKey` varchar(64) NOT NULL,
  `content` longtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup_unique_idx` (`locale`,`objectClass`,`foreignKey`,`field`),
  KEY `translations_lookup_idx` (`locale`,`objectClass`,`foreignKey`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `type` varchar(255) NOT NULL,
  `isHidden` tinyint(1) NOT NULL DEFAULT 0,
  `canLogin` tinyint(1) NOT NULL DEFAULT 1,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `createdBy_id` int(11) DEFAULT NULL,
  `updatedBy_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2DA179773174800F` (`createdBy_id`),
  KEY `IDX_2DA1797765FF1AEC` (`updatedBy_id`),
  KEY `index_type` (`type`),
  KEY `index_isHidden` (`isHidden`),
  KEY `index_canLogin` (`canLogin`),
  CONSTRAINT `FK_2DA179773174800F` FOREIGN KEY (`createdBy_id`) REFERENCES `User` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_2DA1797765FF1AEC` FOREIGN KEY (`updatedBy_id`) REFERENCES `User` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `assignedip_syshelpertag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `assignedip_syshelpertag` (
  `assignedip_id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  `syshelpertag_id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  PRIMARY KEY (`assignedip_id`,`syshelpertag_id`),
  KEY `IDX_621283321462D47D` (`assignedip_id`),
  KEY `IDX_621283325FBC45B5` (`syshelpertag_id`),
  CONSTRAINT `FK_621283321462D47D` FOREIGN KEY (`assignedip_id`) REFERENCES `AssignedIp` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_621283325FBC45B5` FOREIGN KEY (`syshelpertag_id`) REFERENCES `SyshelperTag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `host_syshelpertag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `host_syshelpertag` (
  `host_id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  `syshelpertag_id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  PRIMARY KEY (`host_id`,`syshelpertag_id`),
  KEY `IDX_BEC4343E1FB8D185` (`host_id`),
  KEY `IDX_BEC4343E5FBC45B5` (`syshelpertag_id`),
  CONSTRAINT `FK_BEC4343E1FB8D185` FOREIGN KEY (`host_id`) REFERENCES `Host` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_BEC4343E5FBC45B5` FOREIGN KEY (`syshelpertag_id`) REFERENCES `SyshelperTag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ipsubnet_syshelpertag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ipsubnet_syshelpertag` (
  `ipsubnet_id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  `syshelpertag_id` char(36) NOT NULL COMMENT '(DC2Type:uuid)',
  PRIMARY KEY (`ipsubnet_id`,`syshelpertag_id`),
  KEY `IDX_2C3A6EB499911C1F` (`ipsubnet_id`),
  KEY `IDX_2C3A6EB45FBC45B5` (`syshelpertag_id`),
  CONSTRAINT `FK_2C3A6EB45FBC45B5` FOREIGN KEY (`syshelpertag_id`) REFERENCES `SyshelperTag` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_2C3A6EB499911C1F` FOREIGN KEY (`ipsubnet_id`) REFERENCES `IpSubnet` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `laminassystemservermodule_laminassystemserver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `laminassystemservermodule_laminassystemserver` (
  `laminassystemservermodule_id` int(11) NOT NULL,
  `laminassystemserver_id` int(11) NOT NULL,
  PRIMARY KEY (`laminassystemservermodule_id`,`laminassystemserver_id`),
  KEY `IDX_1C0EEA745BDB9A05` (`laminassystemservermodule_id`),
  KEY `IDX_1C0EEA74ABC5FFCF` (`laminassystemserver_id`),
  CONSTRAINT `FK_1C0EEA745BDB9A05` FOREIGN KEY (`laminassystemservermodule_id`) REFERENCES `LaminasSystemServerModule` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_1C0EEA74ABC5FFCF` FOREIGN KEY (`laminassystemserver_id`) REFERENCES `LaminasSystemServer` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `version` varchar(191) NOT NULL,
  `executedAt` datetime DEFAULT NULL,
  `executionTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;


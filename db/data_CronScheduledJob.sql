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

LOCK TABLES `CronScheduledJob` WRITE;
/*!40000 ALTER TABLE `CronScheduledJob` DISABLE KEYS */;
INSERT INTO `CronScheduledJob` VALUES
(2,'WirklichDigital\\Search\\CronTask\\RunScheduledIndexers',1,'ANYTIME',0,'',0,0.0034,'2025-10-31 12:12:01',900,1),
(3,'WirklichDigital\\SyshelperBase\\CronTask\\ImportIPRangesTask',1,'5 * * * *',0,'DISABLED, BECAUSE hetzner-api.jar.media CHANGED. CURRENTLY NOT WORKING!',0,0.0008,'2025-10-31 12:05:02',300,1),
(4,'WirklichDigital\\SyshelperBase\\CronTask\\HostRawFactsParseTask',1,'* * * * *',0,'',0,0.0897,'2025-10-31 12:12:01',120,1),
(5,'WirklichDigital\\SyshelperScanner\\CronTask\\PingscanTask',1,'* * * * *',0,'',0,3.4204,'2025-10-31 12:12:01',300,1),
(6,'WirklichDigital\\SyshelperScanner\\CronTask\\PortscanTask',1,'* * * * *',0,'',0,1.6942,'2025-10-31 12:12:05',300,1),
(7,'WirklichDigital\\SyshelperAlerts\\CronTask\\HostMissedUpdatesTask',1,'* * * * *',0,'',0,4.1427,'2025-10-31 12:12:06',900,1),
(8,'WirklichDigital\\SyshelperAlerts\\CronTask\\LastConnectionLongAgoTask',1,'* * * * *',0,'',0,14.0140,'2025-10-31 12:12:11',600,1),
(9,'WirklichDigital\\SyshelperAlerts\\CronTask\\PuppetErrorTask',1,'* * * * *',0,'',0,0.0110,'2025-10-31 12:12:25',300,1),
(10,'WirklichDigital\\SyshelperAlerts\\CronTask\\AptErrorTask',1,'* * * * *',0,'',0,1.0759,'2025-10-31 12:12:25',120,1),
(11,'WirklichDigital\\SyshelperAlerts\\CronTask\\ExternalIpV4IsEmptyTask',1,'* * * * *',0,'',0,0.0107,'2025-10-31 12:12:26',600,1),
(13,'WirklichDigital\\SyshelperAlerts\\CronTask\\ReachableIpTask',1,'* * * * *',0,'',0,7.7298,'2025-10-31 12:12:26',120,1),
(14,'WirklichDigital\\SyshelperAlerts\\CronTask\\OpenPortsTask',1,'* * * * *',0,'',0,0.4141,'2025-10-31 12:12:33',360,1),
(15,'WirklichDigital\\SyshelperAlerts\\CronTask\\HostVulnerablePackagesTask',1,'* * * * *',0,'',0,2.6655,'2025-10-31 12:12:34',600,1),
(16,'WirklichDigital\\SyshelperAlerts\\CronTask\\MailqTask',1,'* * * * *',0,'',0,0.0083,'2025-10-31 12:12:37',600,1),
(17,'WirklichDigital\\SyshelperAlerts\\CronTask\\ToDoTask',1,'* * * * *',0,'',0,1.2467,'2025-10-31 12:12:37',120,1),
(18,'WirklichDigital\\SyshelperAlerts\\CronTask\\PleskBackupHasErrorTask',0,'* * * * *',0,'',0,0.0000,NULL,300,1),
(19,'WirklichDigital\\SyshelperAlerts\\CronTask\\NoPleskBackupTask',0,'* * * * *',0,'',0,0.0000,NULL,300,1),
(20,'WirklichDigital\\EntityTranslation\\CronTask\\EnsureTranslationsRemovedForDeletedLanguagesTask',0,'0 3 * * *',0,'',0,0.0000,NULL,300,1),
(21,'WirklichDigital\\MessagehubConnector\\CronTask\\RunMessagehubQueue',1,'* * * * *',0,'',0,0.0035,'2025-10-31 12:12:38',120,1),
(24,'WirklichDigital\\SyshelperBase\\CronTask\\BlockUnusedSshAccessTask',0,'0 * * * *',0,'',0,0.0339,'2025-05-06 13:39:16',120,1),
(25,'WirklichDigital\\SyshelperAlerts\\CronTask\\LastTransmissionOfModulesLongAgoTask',1,'* * * * *',0,'',0,0.0054,'2025-10-31 12:12:38',120,1),
(26,'WirklichDigital\\ErrorLogger\\CronTask\\LogRotateTask',1,'0 * * * *',0,'',0,0.0019,'2025-10-31 12:00:40',120,1),
(27,'WirklichDigital\\SystemModuleOverview\\CronTask\\SaveSystemdatasTask',1,'* * * * *',0,'',0,0.0028,'2025-10-31 12:12:38',120,1),
(28,'WirklichDigital\\SystemModuleOverview\\CronTask\\CleanupProcessedFilesTask',1,'* * * * *',0,'',0,0.0090,'2025-10-31 12:12:38',120,1);
/*!40000 ALTER TABLE `CronScheduledJob` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;


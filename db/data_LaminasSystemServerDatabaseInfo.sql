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

LOCK TABLES `LaminasSystemServerDatabaseInfo` WRITE;
/*!40000 ALTER TABLE `LaminasSystemServerDatabaseInfo` DISABLE KEYS */;
INSERT INTO `LaminasSystemServerDatabaseInfo` VALUES
(91,'ApplicationLog','InnoDB','11','Dynamic','162','9810','1589248','0','81920','4194304','344','2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(92,'AuthMailReset','InnoDB','10','Dynamic','0','0','16384','0','16384','0','3','2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(93,'AuthenticationMail','InnoDB','10','Dynamic','0','0','16384','0','114688','0','27','2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(94,'AuthorizationRole','InnoDB','11','Dynamic','0','0','16384','0','0','0',NULL,'2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(95,'AuthorizationRule','InnoDB','10','Dynamic','0','0','16384','0','0','0','23','2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(96,'CronScheduledJob','InnoDB','11','Dynamic','5','3276','16384','0','49152','0','7','2025-10-29 04:56:41','2025-10-29 14:00:02',NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(97,'DefaultUser','InnoDB','10','Dynamic','0','0','16384','0','16384','0','17','2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(98,'DeinPimModule','InnoDB','10','Dynamic','2','8192','16384','0','16384','0','224','2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(99,'DeinPimSystem','InnoDB','10','Dynamic','2','8192','16384','0','0','0',NULL,'2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(100,'EntityLocale','InnoDB','10','Dynamic','2','8192','16384','0','32768','0','3','2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(101,'LogEntry','InnoDB','10','Dynamic','3','5461','16384','0','65536','0','19','2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(102,'MessagehubCallback','InnoDB','10','Dynamic','0','0','16384','0','0','0','1','2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(103,'RenderTemplate','InnoDB','11','Dynamic','0','0','16384','0','65536','0','1','2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(104,'SearchIndex','InnoDB','11','Dynamic','0','0','16384','0','114688','0','1','2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(105,'SearchIndexSchedule','InnoDB','10','Dynamic','0','0','16384','0','16384','0','1','2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(106,'SystemOption','InnoDB','10','Dynamic','5','3276','16384','0','49152','0','7','2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(107,'SystemUser','InnoDB','10','Dynamic','0','0','16384','0','49152','0','2','2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(108,'Translation','InnoDB','10','Dynamic','0','0','16384','0','32768','0','13','2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(109,'User','InnoDB','11','Dynamic','0','0','16384','0','81920','0','30','2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(110,'migrations','InnoDB','10','Dynamic','4','4096','16384','0','0','0',NULL,'2025-10-29 04:56:41',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',1),
(111,'ApplicationLog','InnoDB','11','Dynamic','1568','1013','1589248','0','327680','4194304','1629','2025-10-29 04:15:40','2025-10-29 04:18:32',NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(112,'AuthMailReset','InnoDB','10','Dynamic','0','0','16384','0','16384','0','3','2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(113,'AuthenticationMail','InnoDB','10','Dynamic','2','8192','16384','0','114688','0','27','2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(114,'AuthorizationRole','InnoDB','11','Dynamic','0','0','16384','0','0','0',NULL,'2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(115,'AuthorizationRule','InnoDB','10','Dynamic','0','0','16384','0','0','0','23','2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(116,'CronScheduledJob','InnoDB','11','Dynamic','5','3276','16384','0','49152','0','8','2025-10-29 04:15:40','2025-10-29 14:00:02',NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(117,'DefaultUser','InnoDB','10','Dynamic','0','0','16384','0','16384','0','17','2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(118,'EntityLocale','InnoDB','10','Dynamic','2','8192','16384','0','32768','0','3','2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(119,'ExtForVersion','InnoDB','10','Dynamic','25','655','16384','0','0','0','44','2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(120,'Extensions','InnoDB','10','Dynamic','8633','184','1589248','0','278528','4194304',NULL,'2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(121,'LogEntry','InnoDB','10','Dynamic','600','327','196608','0','147456','0','616','2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(122,'MessagehubCallback','InnoDB','10','Dynamic','0','0','16384','0','0','0','1','2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(123,'RenderTemplate','InnoDB','11','Dynamic','0','0','16384','0','65536','0','1','2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(124,'SearchIndex','InnoDB','11','Dynamic','0','0','16384','0','114688','0','1','2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(125,'SearchIndexSchedule','InnoDB','10','Dynamic','0','0','16384','0','16384','0','1','2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(126,'SystemOption','InnoDB','10','Dynamic','6','2730','16384','0','49152','0','8','2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(127,'SystemUser','InnoDB','10','Dynamic','2','8192','16384','0','49152','0','3','2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(128,'Test','InnoDB','10','Dynamic','9','1820','16384','0','0','0',NULL,'2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(129,'Translation','InnoDB','10','Dynamic','14','1170','16384','0','32768','0','15','2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(130,'User','InnoDB','11','Dynamic','2','8192','16384','0','81920','0','30','2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(131,'UserLoginToken','InnoDB','10','Dynamic','0','0','16384','0','65536','0','5','2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2),
(132,'migrations','InnoDB','10','Dynamic','26','630','16384','0','0','0',NULL,'2025-10-29 04:15:40',NULL,NULL,'utf8mb3_unicode_ci',NULL,'','','0','N',2);
/*!40000 ALTER TABLE `LaminasSystemServerDatabaseInfo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;


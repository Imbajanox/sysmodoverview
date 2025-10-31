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

LOCK TABLES `LaminasSystemServer` WRITE;
/*!40000 ALTER TABLE `LaminasSystemServer` DISABLE KEYS */;
INSERT INTO `LaminasSystemServer` VALUES
(1,'https://2162-deinpimoverview-master.e5j.de','138.199.172.117-2a01:4f8:c012:a24::1','data/sysmoddatas/LaminasSystemServerphpinfo-1.json','data/sysmoddatas/LaminasSystemServerconfig-1.json','{\"name\":\"deinpimoverview\",\"pms_id\":\"2162\",\"base_system\":\"j77-php81\",\"vhost\":{\"document_root\":\"\\/var\\/www\\/html\\/public\"},\"additional_vhosts\":[],\"setup_actions\":{\"replace_db\":[],\"replace_file\":[],\"setup_cronjobs\":[\"* * * * * root php \\/git\\/httpdocs\\/public\\/index.php cron-scheduler tick\"]},\"non_git_folders\":[\"filecontent\"],\"disable_auto_save\":0,\"disable_auto_pausing\":0,\"disable_auto_stop\":0,\"subgit_save\":1,\"add_readonly_git_key\":1,\"branch\":\"master\"}','8.1.32',0,1,1,1,1,1,NULL,'2025-10-21 12:57:52','2025-10-29 14:00:21','0f8309b6-81f0-4b59-aba4-d091c6e069be'),
(2,'https://2062-t3extchecker-master.e5j.de','46.224.6.138-2a01:4f8:c013:e058::1','data/sysmoddatas/LaminasSystemServerphpinfo-2.json','data/sysmoddatas/LaminasSystemServerconfig-2.json','{\"name\":\"t3extchecker\",\"pms_id\":\"2062\",\"base_system\":\"j77-php81\",\"vhost\":{\"document_root\":\"\\/var\\/www\\/html\\/public\"},\"additional_vhosts\":[],\"setup_actions\":{\"replace_db\":[],\"replace_file\":[],\"setup_cronjobs\":[\"* * * * * root php \\/git\\/httpdocs\\/public\\/index.php cron-scheduler tick\"]},\"non_git_folders\":[\"filecontent\"],\"disable_auto_save\":0,\"disable_auto_pausing\":0,\"disable_auto_stop\":0,\"subgit_save\":1,\"add_readonly_git_key\":1,\"branch\":\"master\"}','8.1.32',0,1,1,1,1,1,NULL,'2025-10-21 13:00:07','2025-10-31 12:00:40','e46a1d38-01c5-42cf-9152-fde4d39b07ae');
/*!40000 ALTER TABLE `LaminasSystemServer` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;


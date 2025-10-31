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

LOCK TABLES `LaminasSystemServerMigrationInfo` WRITE;
/*!40000 ALTER TABLE `LaminasSystemServerMigrationInfo` DISABLE KEYS */;
INSERT INTO `LaminasSystemServerMigrationInfo` VALUES
(1,'{\"Driver\":\"Doctrine\\\\DBAL\\\\Driver\\\\PDO\\\\MySQL\\\\Driver\",\"Name\":\"deinpimoverview\"}','{\"Previous\":\"DoctrineORMModule\\\\Migrations\\\\Version20250408125123\",\"Current\":\"DoctrineORMModule\\\\Migrations\\\\Version20250410132040\",\"Next\":\"Already at latest version\",\"Latest\":\"DoctrineORMModule\\\\Migrations\\\\Version20250410132040\"}','{\"Executed\":\"4\",\"Executed Unavailable\":\"0\",\"Available\":\"4\",\"New\":\"0\"}',1),
(2,'{\"Driver\":\"Doctrine\\\\DBAL\\\\Driver\\\\PDO\\\\MySQL\\\\Driver\",\"Name\":\"t3extchecker\"}','{\"Previous\":\"DoctrineORMModule\\\\Migrations\\\\Version20250423080525\",\"Current\":\"DoctrineORMModule\\\\Migrations\\\\Version20250520142721\",\"Next\":\"Already at latest version\",\"Latest\":\"DoctrineORMModule\\\\Migrations\\\\Version20250520142721\"}','{\"Executed\":\"26\",\"Executed Unavailable\":\"0\",\"Available\":\"26\",\"New\":\"0\"}',2);
/*!40000 ALTER TABLE `LaminasSystemServerMigrationInfo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;


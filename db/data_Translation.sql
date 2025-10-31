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

LOCK TABLES `Translation` WRITE;
/*!40000 ALTER TABLE `Translation` DISABLE KEYS */;
INSERT INTO `Translation` VALUES
(1,'de_DE','WirklichDigital\\SystemOptions\\Entity\\SystemOption','title','3','Editierbare Rollen'),
(2,'de_DE','WirklichDigital\\SystemOptions\\Entity\\SystemOption','description','3','Rollen sind standardmäßig nicht bearbeitbar oder löschbar. Sie können diesen Wert verwenden, um diese Funktion zu aktivieren.'),
(3,'de_DE','WirklichDigital\\SystemOptions\\Entity\\SystemOption','title','2','Standard-Sprache als Fallback nutzen'),
(4,'de_DE','WirklichDigital\\SystemOptions\\Entity\\SystemOption','description','2','Bestimmt, ob die Standardsprache genutzt werden soll, wenn keine Übersetzung für die aktuelle Sprache vorhanden ist.'),
(5,'de_DE','WirklichDigital\\SystemOptions\\Entity\\SystemOption','title','4','Standard-Sprache'),
(6,'de_DE','WirklichDigital\\SystemOptions\\Entity\\SystemOption','description','4','Sprache, welche in der Entity selbst gespeichert wird. Sie wird immer als Standard-Sprache verwendet, wenn die entsprechende Option aktiviert ist'),
(7,'de_DE','WirklichDigital\\SystemOptions\\Entity\\SystemOption','title','1','Min. Länge der Suchzeichenfolge'),
(8,'de_DE','WirklichDigital\\SystemOptions\\Entity\\SystemOption','description','1','Die kürzeste Länge der einzugebenden Suchzeichenfolge'),
(9,'de_DE','WirklichDigital\\SystemOptions\\Entity\\SystemOption','title','5','Application Base Url'),
(10,'de_DE','WirklichDigital\\SystemOptions\\Entity\\SystemOption','description','5','Do not use a tailing slash');
/*!40000 ALTER TABLE `Translation` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;


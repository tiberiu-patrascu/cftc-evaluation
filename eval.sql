/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage de la structure de la base pour eval
CREATE DATABASE IF NOT EXISTS `eval` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `eval`;

-- Listage de la structure de table eval. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Listage des données de la table eval.user : 5 rows
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `login`, `pwd`, `mail`) VALUES
	(1, 'loksiock', '*GTEH3ZxDG4CcAVT', 'loksiock@mycftc.fr');
INSERT INTO `user` (`id`, `login`, `pwd`, `mail`) VALUES
	(2, 'noxisqui', 'wX^y8toRcK4ny@KS!', 'noxisqui@cftc.fr');
INSERT INTO `user` (`id`, `login`, `pwd`, `mail`) VALUES
	(3, 'talonfau', 'yvoKuP@@mp2#uo!8', 'talonfau@cftc.fr');
INSERT INTO `user` (`id`, `login`, `pwd`, `mail`) VALUES
	(4, 'pertlyphen', 'bmZPdVj2%#ht%@Hw', 'pertlyphen@cftc.fr');
INSERT INTO `user` (`id`, `login`, `pwd`, `mail`) VALUES
	(5, 'buracesto', 'oLDz3!z2zGHysU3g', 'buracesto@cftc.fr');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
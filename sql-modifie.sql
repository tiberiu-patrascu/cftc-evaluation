CREATE DATABASE IF NOT EXISTS `eval`;
USE `eval`;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `login` varchar(50) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=70;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` ( `login`, `pwd`, `mail`) VALUES
('buracesto', '$2y$10$EPxsQFmHdnUTT2nM9UUKkOMBiVzyCydn3Vkynkhuvkr', 'buracesto@cftc.fr'),
( 'noxisqui', '$2y$10$kyRNiA/x2z9QPyOR3/En6esPasRBpAq7pj/kDtliQ5L', 'noxisqui@cftc.fr'),
( 'Baptiste', '$2y$10$05DBtWcIK2cn.b6HkqSHHuI/cddleNWM7VWfehr1jm2', 'Baptiste@gmail.com'),
( 'pertlyphen', '$2y$10$zxJ9K655UwsvN/h/4qAtj.8qcWpt4t2T06C60wl6dUq', 'pertlyphen@cftc.fr'),
('talonfau', '$2y$10$fvZhCy9CUllnScNUOzcAOu1ldE0LajXVK1aWug48rLG', 'talonfau@cftc.fr'),
('nicolas', '$2y$10$cn4Uako4yVolhpTZEoEH6.hUtK82PGsJXMN25gCSoWR', 'nicolas@gmail.com'),
( 'loksiock', '$2y$10$tx7X76gXAci4L116CNWfO.foUmZzkz.6DQ9IaHzz.23', 'loksiock@mycftc.fr'),
( 'mickael', '$2y$10$1UzEOb5gHTFUVN24mfR7fOlyKiZ1tKtKPLt8fygCyC3', 'mickael@gmail.com'),
( 'duront', '$2y$10$8Xihfj81.Y/gVV9ot3lTzO9oUkS9.rNyGdsFkaS.o6y', 'duront@gmail.com'),
( 'dupont', '$2y$10$Z5TXhfeppWC8nqFBHoboOu6XNoSNJqBeiQOYeEsQSaj', 'dupont@gmail.com'),
('toto', '$2y$10$tj0HqfhmWk18THtoTArSfO2GsBQlvPqpZSVPNMQSZ90', 'toto@gmail.com');
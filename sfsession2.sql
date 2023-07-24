-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour sfsession_2
CREATE DATABASE IF NOT EXISTS `sfsession_2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sfsession_2`;

-- Listage de la structure de table sfsession_2. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsession_2.categorie : ~4 rows (environ)
REPLACE INTO `categorie` (`id`, `titre`) VALUES
	(1, 'Dev Web'),
	(2, 'Design'),
	(3, 'Bureautique'),
	(4, 'Langues');

-- Listage de la structure de table sfsession_2. doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table sfsession_2.doctrine_migration_versions : ~1 rows (environ)
REPLACE INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20230721122433', '2023-07-21 12:25:20', 415);

-- Listage de la structure de table sfsession_2. formation
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptif` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsession_2.formation : ~3 rows (environ)
REPLACE INTO `formation` (`id`, `intitule`, `descriptif`) VALUES
	(1, 'DWWM', 'Développer dans les principaux langages de programmation demandés par les entreprises'),
	(2, 'Web Design', '- Appliquez l’ergonomie dans une démarche centrée utilisateur, designez des interfaces numériques dans Sketch ou XD, appliquez la logique responsive à un ensemble d’interfaces '),
	(3, 'Bureautique', 'La formation Pack Office et Access vous donne les clés pour rédiger un rapport, une lettre, un document… ou bien créer des tableaux et des bases de données.');

-- Listage de la structure de table sfsession_2. matiere
CREATE TABLE IF NOT EXISTS `matiere` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categorie_id` int NOT NULL,
  `denomination` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9014574ABCF5E72D` (`categorie_id`),
  CONSTRAINT `FK_9014574ABCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsession_2.matiere : ~12 rows (environ)
REPLACE INTO `matiere` (`id`, `categorie_id`, `denomination`) VALUES
	(1, 1, 'HTML'),
	(2, 1, 'CSS'),
	(3, 1, 'PHP'),
	(4, 1, 'JavaScript'),
	(5, 2, 'Photoshop'),
	(6, 2, 'Indesign'),
	(7, 3, 'Word'),
	(8, 3, 'Excel'),
	(9, 3, 'PowerPoint'),
	(10, 4, 'Anglais'),
	(11, 4, 'Allemand'),
	(12, 4, 'Italien');

-- Listage de la structure de table sfsession_2. messenger_messages
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsession_2.messenger_messages : ~0 rows (environ)

-- Listage de la structure de table sfsession_2. programme
CREATE TABLE IF NOT EXISTS `programme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `session_id` int NOT NULL,
  `matiere_id` int NOT NULL,
  `duree` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3DDCB9FF613FECDF` (`session_id`),
  KEY `IDX_3DDCB9FFF46CD258` (`matiere_id`),
  CONSTRAINT `FK_3DDCB9FF613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`),
  CONSTRAINT `FK_3DDCB9FFF46CD258` FOREIGN KEY (`matiere_id`) REFERENCES `matiere` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsession_2.programme : ~6 rows (environ)
REPLACE INTO `programme` (`id`, `session_id`, `matiere_id`, `duree`) VALUES
	(1, 1, 1, 5),
	(2, 1, 2, 10),
	(3, 1, 3, 25),
	(4, 1, 4, 4),
	(5, 2, 5, 10),
	(6, 2, 6, 8);

-- Listage de la structure de table sfsession_2. session
CREATE TABLE IF NOT EXISTS `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `formation_id` int NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `nombre_place_max` int NOT NULL,
  `denomination` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D45200282E` (`formation_id`),
  CONSTRAINT `FK_D044D5D45200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsession_2.session : ~3 rows (environ)
REPLACE INTO `session` (`id`, `formation_id`, `date_debut`, `date_fin`, `nombre_place_max`, `denomination`) VALUES
	(1, 1, '2023-03-15 14:36:06', '2023-12-01 14:36:19', 12, 'Préparation au titre de DWWM'),
	(2, 2, '2023-07-21 14:38:32', '2024-07-21 14:38:36', 10, 'Préparation au titre de Web Design'),
	(3, 3, '2023-09-21 14:39:01', '2024-07-21 14:39:22', 9, 'Initiation à la bureautique');

-- Listage de la structure de table sfsession_2. stagiaire
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` datetime NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsession_2.stagiaire : ~3 rows (environ)
REPLACE INTO `stagiaire` (`id`, `prenom`, `nom`, `genre`, `date_naissance`, `ville`, `email`, `telephone`) VALUES
	(1, 'Franck', 'PERRIN', 'Masculin', '1977-09-01 14:40:18', 'Haguenau', 'frank@gmail.fr', '0623548974'),
	(2, 'Fred', 'GENCE', 'Masculin', '1976-05-10 14:41:23', 'Toulouse', 'fred@skynet.be', '0745623814'),
	(3, 'Pascal', 'SCHINDELMEYER', 'Masculin', '1972-04-11 14:42:15', 'Reichoffen', 'pascal@laposte.fr', '0625698745');

-- Listage de la structure de table sfsession_2. stagiaire_session
CREATE TABLE IF NOT EXISTS `stagiaire_session` (
  `stagiaire_id` int NOT NULL,
  `session_id` int NOT NULL,
  PRIMARY KEY (`stagiaire_id`,`session_id`),
  KEY `IDX_D32D02D4BBA93DD6` (`stagiaire_id`),
  KEY `IDX_D32D02D4613FECDF` (`session_id`),
  CONSTRAINT `FK_D32D02D4613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_D32D02D4BBA93DD6` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaire` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsession_2.stagiaire_session : ~7 rows (environ)
REPLACE INTO `stagiaire_session` (`stagiaire_id`, `session_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(2, 1),
	(2, 3),
	(3, 2),
	(3, 3);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

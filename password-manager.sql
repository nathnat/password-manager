SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `password-manager`
--

-- --------------------------------------------------------

--
-- Structure de la table `champ`
--

DROP TABLE IF EXISTS `champ`;
CREATE TABLE IF NOT EXISTS `champ` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site` varchar(255) COLLATE utf32_bin NOT NULL,
  `email` varchar(255) COLLATE utf32_bin NOT NULL,
  `username` varchar(255) COLLATE utf32_bin NOT NULL,
  `password` text COLLATE utf32_bin NOT NULL,
  `description` text COLLATE utf32_bin NOT NULL,
  `timestamp` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32 COLLATE=utf32_bin;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf32_bin NOT NULL,
  `password` text COLLATE utf32_bin NOT NULL,
  `timestamp` int(11) NOT NULL,
  `numberOfTry` int(11) NOT NULL DEFAULT 0,
  `blockTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32 COLLATE=utf32_bin;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

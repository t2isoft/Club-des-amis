


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `newclubamis`
--
CREATE DATABASE IF NOT EXISTS `newclubamis` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `newclubamis`;

-- --------------------------------------------------------

--
-- Structure de la table `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `id_action` int(11) NOT NULL AUTO_INCREMENT,
  `nom_action` varchar(50) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `fonds_col` float DEFAULT NULL,
  `id_com` int(11) DEFAULT NULL,
  `id_amis` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_action`),
  KEY `FK_action_id_com` (`id_com`),
  KEY `FK_action_id_amis` (`id_amis`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE IF NOT EXISTS `amis` (
  `id_amis` int(11) NOT NULL AUTO_INCREMENT,
  `nom_amis` varchar(50) DEFAULT NULL,
  `prenom_amis` varchar(50) DEFAULT NULL,
  `date_entree` date DEFAULT NULL,
  `tel_fixe` varchar(10) DEFAULT NULL,
  `tel_port` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `num_adr` varchar(5) DEFAULT NULL,
  `rue_adr` varchar(50) DEFAULT NULL,
  `cp_adr` varchar(5) DEFAULT NULL,
  `ville_adr` varchar(50) DEFAULT NULL,
  `parrain1` varchar(50) DEFAULT NULL,
  `parrain2` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_amis`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `amis`
--

INSERT INTO `amis` (`id_amis`, `nom_amis`, `prenom_amis`, `date_entree`, `tel_fixe`, `tel_port`, `email`, `num_adr`, `rue_adr`, `cp_adr`, `ville_adr`, `parrain1`, `parrain2`) VALUES
(1, 'BAUDRY', 'Johan', '2012-09-19', '0174547510', '0617668037', 'johanbaudry@sfr.fr', '136', 'Rue Salvador Allende', '92000', 'NANTERRE', 'KELLEOGLU', 'RIBEIRO'),
(2, 'KELLEOGLU', 'Karl', '2012-09-20', '0154878855', '0612548966', 'karl.kelleoglu@sfr.fr', '12', 'Rue du Temple', '92450', 'VILLENEUVE-LA-GARENNE', 'RIBEIRO', 'BAUDRY'),
(3, 'RIBEIRO', 'Johnny', '2012-09-19', '0745856666', '0617665233', 'fsdgdsf.gfdg@sfr.fr', '12', 'Rue de l''Eure', '78120', 'JOUY-LE-MOUTIER', 'KELLEOGLU', 'BAUDRY');

-- --------------------------------------------------------

--
-- Structure de la table `bureau`
--

CREATE TABLE IF NOT EXISTS `bureau` (
  `id_bureau` int(11) NOT NULL AUTO_INCREMENT,
  `datecreation_bureau` date DEFAULT NULL,
  `datefin_bureau` date DEFAULT NULL,
  PRIMARY KEY (`id_bureau`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `bureau`
--

INSERT INTO `bureau` (`id_bureau`, `datecreation_bureau`, `datefin_bureau`) VALUES
(1, '2012-12-18', '2014-12-18');

-- --------------------------------------------------------

--
-- Structure de la table `commission`
--

CREATE TABLE IF NOT EXISTS `commission` (
  `id_com` int(11) NOT NULL AUTO_INCREMENT,
  `nom_com` varchar(50) DEFAULT NULL,
  `datecreation_commission` date DEFAULT NULL,
  `datefin_commission` date DEFAULT NULL,
  PRIMARY KEY (`id_com`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `commission`
--

INSERT INTO `commission` (`id_com`, `nom_com`, `datecreation_commission`, `datefin_commission`) VALUES
(1, 'Aucune', NULL, NULL),
(2, 'Commission des actions', '2012-12-18', '2014-12-18'),
(3, 'Commission des finances', '2012-12-18', '2014-12-18'),
(4, 'Commission des relations exterieures', '2012-12-18', '2014-12-18');

-- --------------------------------------------------------

--
-- Structure de la table `diner`
--

CREATE TABLE IF NOT EXISTS `diner` (
  `id_diner` int(11) NOT NULL AUTO_INCREMENT,
  `date_diner` date DEFAULT NULL,
  `lieu_diner` varchar(50) DEFAULT NULL,
  `prix_diner` double DEFAULT NULL,
  PRIMARY KEY (`id_diner`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fonctionbureau`
--

CREATE TABLE IF NOT EXISTS `fonctionbureau` (
  `id_fonctionbureau` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fonctionbureau` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_fonctionbureau`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `fonctionbureau`
--

INSERT INTO `fonctionbureau` (`id_fonctionbureau`, `nom_fonctionbureau`) VALUES
(1, 'PRESIDENT'),
(2, 'VICE-PRESIDENT'),
(3, 'SECRETAIRE'),
(4, 'SECRETAIRE-ADJOINT'),
(5, 'TRESORIER'),
(6, 'TRESORIER-ADJOINT');

-- --------------------------------------------------------

--
-- Structure de la table `fonctionbureauami`
--

CREATE TABLE IF NOT EXISTS `fonctionbureauami` (
  `login` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `id_amis` int(11) NOT NULL,
  `id_bureau` int(11) NOT NULL,
  `id_fonctionbureau` int(11) NOT NULL,
  PRIMARY KEY (`id_amis`,`id_bureau`,`id_fonctionbureau`),
  KEY `FK_fonctionbureauami_id_bureau` (`id_bureau`),
  KEY `FK_fonctionbureauami_id_fonctionbureau` (`id_fonctionbureau`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fonctionbureauami`
--

INSERT INTO `fonctionbureauami` (`login`, `password`, `id_amis`, `id_bureau`, `id_fonctionbureau`) VALUES
('johan', 'johan', 1, 1, 3),
('karl', 'karl', 2, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `fonctioncommission`
--

CREATE TABLE IF NOT EXISTS `fonctioncommission` (
  `id_fonctioncommission` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fonctioncommission` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_fonctioncommission`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `fonctioncommission`
--

INSERT INTO `fonctioncommission` (`id_fonctioncommission`, `nom_fonctioncommission`) VALUES
(1, 'PRESIDENT DE COMMISSION'),
(2, 'SECRETAIRE'),
(3, 'COORDINATEUR');

-- --------------------------------------------------------

--
-- Structure de la table `fonctioncommissionami`
--

CREATE TABLE IF NOT EXISTS `fonctioncommissionami` (
  `id_amis` int(11) NOT NULL,
  `id_fonctioncommission` int(11) NOT NULL,
  `id_com` int(11) NOT NULL,
  PRIMARY KEY (`id_amis`,`id_fonctioncommission`,`id_com`),
  KEY `FK_fonctioncommissionami_id_fonctioncommission` (`id_fonctioncommission`),
  KEY `FK_fonctioncommissionami_id_com` (`id_com`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `manger`
--

CREATE TABLE IF NOT EXISTS `manger` (
  `nb_invites` int(11) DEFAULT NULL,
  `id_amis` int(11) NOT NULL,
  `id_diner` int(11) NOT NULL,
  PRIMARY KEY (`id_amis`,`id_diner`),
  KEY `FK_manger_id_diner` (`id_diner`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

CREATE TABLE IF NOT EXISTS `participer` (
  `don_amis` float DEFAULT NULL,
  `id_amis` int(11) NOT NULL,
  `id_action` int(11) NOT NULL,
  PRIMARY KEY (`id_amis`,`id_action`),
  KEY `FK_participer_id_action` (`id_action`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `releve`
--

CREATE TABLE IF NOT EXISTS `releve` (
  `id_releve` int(11) NOT NULL AUTO_INCREMENT,
  `annee_montant` year(4) DEFAULT NULL,
  `montant_releve` float DEFAULT NULL,
  `id_amis` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_releve`),
  KEY `FK_releve_id_amis` (`id_amis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `action`
--
ALTER TABLE `action`
  ADD CONSTRAINT `FK_action_id_amis` FOREIGN KEY (`id_amis`) REFERENCES `amis` (`id_amis`),
  ADD CONSTRAINT `FK_action_id_com` FOREIGN KEY (`id_com`) REFERENCES `commission` (`id_com`);

--
-- Contraintes pour la table `fonctionbureauami`
--
ALTER TABLE `fonctionbureauami`
  ADD CONSTRAINT `FK_fonctionbureauami_id_amis` FOREIGN KEY (`id_amis`) REFERENCES `amis` (`id_amis`),
  ADD CONSTRAINT `FK_fonctionbureauami_id_bureau` FOREIGN KEY (`id_bureau`) REFERENCES `bureau` (`id_bureau`),
  ADD CONSTRAINT `FK_fonctionbureauami_id_fonctionbureau` FOREIGN KEY (`id_fonctionbureau`) REFERENCES `fonctionbureau` (`id_fonctionbureau`);

--
-- Contraintes pour la table `fonctioncommissionami`
--
ALTER TABLE `fonctioncommissionami`
  ADD CONSTRAINT `FK_fonctioncommissionami_id_amis` FOREIGN KEY (`id_amis`) REFERENCES `amis` (`id_amis`),
  ADD CONSTRAINT `FK_fonctioncommissionami_id_com` FOREIGN KEY (`id_com`) REFERENCES `commission` (`id_com`),
  ADD CONSTRAINT `FK_fonctioncommissionami_id_fonctioncommission` FOREIGN KEY (`id_fonctioncommission`) REFERENCES `fonctioncommission` (`id_fonctioncommission`);

--
-- Contraintes pour la table `manger`
--
ALTER TABLE `manger`
  ADD CONSTRAINT `FK_manger_id_amis` FOREIGN KEY (`id_amis`) REFERENCES `amis` (`id_amis`),
  ADD CONSTRAINT `FK_manger_id_diner` FOREIGN KEY (`id_diner`) REFERENCES `diner` (`id_diner`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `FK_participer_id_action` FOREIGN KEY (`id_action`) REFERENCES `action` (`id_action`),
  ADD CONSTRAINT `FK_participer_id_amis` FOREIGN KEY (`id_amis`) REFERENCES `amis` (`id_amis`);

--
-- Contraintes pour la table `releve`
--
ALTER TABLE `releve`
  ADD CONSTRAINT `FK_releve_id_amis` FOREIGN KEY (`id_amis`) REFERENCES `amis` (`id_amis`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql306.byetcluster.com
-- Generation Time: Jul 09, 2017 at 12:07 PM
-- Server version: 5.6.35-81.0
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `b7_20129419_dnd`
--

-- --------------------------------------------------------

--
-- Table structure for table `adventure`
--

CREATE TABLE IF NOT EXISTS `adventure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `dm` int(11) NOT NULL,
  `synopsis` text,
  PRIMARY KEY (`id`),
  KEY `dm` (`dm`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `adventure`
--

INSERT INTO `adventure` (`id`, `name`, `dm`, `synopsis`) VALUES
(1, 'Testna avantura', 1, NULL),
(2, 'Testna avantura', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE IF NOT EXISTS `equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `distance` int(11) DEFAULT NULL,
  `dmg` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `type`, `distance`, `dmg`) VALUES
(1, 'Longsword', 'slashing', NULL, '1d8');

-- --------------------------------------------------------

--
-- Table structure for table `feat_and_trait`
--

CREATE TABLE IF NOT EXISTS `feat_and_trait` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pc_equipment`
--

CREATE TABLE IF NOT EXISTS `pc_equipment` (
  `player_character` int(11) NOT NULL,
  `equipment` int(11) NOT NULL,
  KEY `player_character` (`player_character`),
  KEY `equipment` (`equipment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pc_equipment`
--

INSERT INTO `pc_equipment` (`player_character`, `equipment`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pc_feat_and_trait`
--

CREATE TABLE IF NOT EXISTS `pc_feat_and_trait` (
  `player_character` int(11) NOT NULL,
  `feat_and_trait` int(11) NOT NULL,
  KEY `player_character` (`player_character`),
  KEY `feat_and_trait` (`feat_and_trait`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pc_skill`
--

CREATE TABLE IF NOT EXISTS `pc_skill` (
  `player_character` int(11) NOT NULL,
  `skill` int(11) NOT NULL,
  KEY `player_character` (`player_character`),
  KEY `skill` (`skill`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pc_skill`
--

INSERT INTO `pc_skill` (`player_character`, `skill`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pc_stat`
--

CREATE TABLE IF NOT EXISTS `pc_stat` (
  `player_character` int(11) NOT NULL,
  `stat` int(11) NOT NULL,
  KEY `player_character` (`player_character`),
  KEY `stat` (`stat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pc_stat`
--

INSERT INTO `pc_stat` (`player_character`, `stat`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE IF NOT EXISTS `player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(59) NOT NULL,
  `password` char(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`id`, `user_name`, `password`, `name`, `email`) VALUES
(1, 'jsostaric', 'pass123', 'Jurica', 'ime.prezime@netko.com');

-- --------------------------------------------------------

--
-- Table structure for table `player_adventure`
--

CREATE TABLE IF NOT EXISTS `player_adventure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player` int(11) NOT NULL,
  `adventure` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `player` (`player`),
  KEY `adventure` (`adventure`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `player_adventure`
--

INSERT INTO `player_adventure` (`id`, `player`, `adventure`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `player_character`
--

CREATE TABLE IF NOT EXISTS `pc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `race` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `background` varchar(50) NOT NULL,
  `alignment` varchar(50) DEFAULT NULL,
  `hd` varchar(5) DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `proficiency_bonus` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)

) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `player_character`
--

INSERT INTO `player_character` (`id`, `name`, `race`, `class`, `level`, `background`, `alignment`, `hd`, `hp`, `proficiency_bonus`) VALUES
(1, 1, 'Hooman', 'Human', 'Fighter', 1, 'Soldier', 'Chaotic Good', '1d10', 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE IF NOT EXISTS `skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `stat_link` varchar(50) DEFAULT NULL,
  `proficiency` tinyint(1) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`id`, `name`, `stat_link`, `proficiency`, `value`) VALUES
(1, 'Athletics', 'Strength', 1, 5),
(2, 'History', 'Intelligence', 1, 3),
(3, 'Intimidation', 'Charisma', 1, 4),
(4, 'Perception', 'Wisdom', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `stat`
--

CREATE TABLE IF NOT EXISTS `stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

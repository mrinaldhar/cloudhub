-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2014 at 02:38 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cloudhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `photoid` int(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `photoid`, `userid`, `comment`, `username`) VALUES
(10, 103, 11, 'hi', 'Vaibhav Kumar'),
(11, 90, 11, 'awesome picture.', 'Vaibhav Kumar'),
(12, 90, 3, 'thanks buddy.', 'Mrinal Dhar');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `userid` int(255) NOT NULL,
  `usernick` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filetype` varchar(255) NOT NULL,
  `filesize` int(255) NOT NULL,
  `shareid` int(255) NOT NULL,
  `directory` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `userid`, `usernick`, `filename`, `filetype`, `filesize`, `shareid`, `directory`) VALUES
(78, 3, 'Mrinal Dhar', 'iphone.mp4', 'video', 4707793, 3, 'f08c50691bbb1175a291696b4a641a03'),
(79, 3, 'Mrinal Dhar', 'Schools out of Summer.mp3', 'audio', 3435334, 3, 'f08c50691bbb1175a291696b4a641a03'),
(80, 3, 'Mrinal Dhar', 'Love me again.mp3', 'audio', 5659886, 3, 'f08c50691bbb1175a291696b4a641a03'),
(81, 3, 'Mrinal Dhar', 'mac.mp4', 'video', 6559339, 3, 'f08c50691bbb1175a291696b4a641a03'),
(88, 3, 'Mrinal Dhar', 'pic2.jpg', 'image', 889905, 3, 'f08c50691bbb1175a291696b4a641a03'),
(89, 3, 'Mrinal Dhar', 'pic3.jpg', 'image', 1016797, 3, 'f08c50691bbb1175a291696b4a641a03'),
(90, 3, 'Mrinal Dhar', 'pic1.jpg', 'image', 1117857, 3, 'f08c50691bbb1175a291696b4a641a03'),
(91, 11, 'Vaibhav Kumar', '20090207 - Loverman.mp3', 'audio', 3001236, 11, '325b15e9380bd4ba750a478a20ce09b5');

-- --------------------------------------------------------

--
-- Table structure for table `sharedfiles`
--

CREATE TABLE IF NOT EXISTS `sharedfiles` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `fileid` int(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `shareid` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `sharedfiles`
--

INSERT INTO `sharedfiles` (`id`, `fileid`, `userid`, `shareid`) VALUES
(1, 78, 3, 11),
(2, 90, 3, 11),
(3, 80, 3, 11),
(4, 88, 3, 11),
(5, 89, 3, 11),
(6, 91, 11, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `userid` int(255) NOT NULL,
  `photoid` int(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tags`
--


-- --------------------------------------------------------

--
-- Table structure for table `toconfirm`
--

CREATE TABLE IF NOT EXISTS `toconfirm` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `naam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `toconfirm`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `naam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `naam`, `email`, `password`, `nickname`) VALUES
(3, 'Mrinal Dhar', 'mrinal.dhar@gmail.com', 'c1fcac5d1b4645edf4705c0ba4d1326130374470', 'mrinaldhar'),
(11, 'Vaibhav Kumar', 'vaibhav4595@gmail.com', 'f7d7247e7677a9dece3a5d2b2f42118d002575b0', 'vaibhav4595');

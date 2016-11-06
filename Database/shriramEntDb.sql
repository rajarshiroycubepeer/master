-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 06, 2016 at 10:57 AM
-- Server version: 5.5.49-cll-lve
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shriramEntDb`
--

-- --------------------------------------------------------

--
-- Table structure for table `dpr`
--

CREATE TABLE IF NOT EXISTS `dpr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(100) DEFAULT NULL,
  `timingIn` datetime NOT NULL,
  `timingOut` datetime NOT NULL,
  `description` varchar(1000) NOT NULL,
  `measurement` varchar(1000) NOT NULL,
  `supervisor` int(10) DEFAULT NULL,
  `fitter` int(10) DEFAULT NULL,
  `welder` int(10) DEFAULT NULL,
  `helper` int(10) DEFAULT NULL,
  `rigger` int(10) DEFAULT NULL,
  `electrician` int(10) DEFAULT NULL,
  `remarks` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `dpr`
--

INSERT INTO `dpr` (`id`, `location`, `timingIn`, `timingOut`, `description`, `measurement`, `supervisor`, `fitter`, `welder`, `helper`, `rigger`, `electrician`, `remarks`) VALUES
(9, 'nagarNar', '2016-10-02 23:41:00', '2016-10-14 00:30:00', 'rerere', 'rtrtrt', 1, 9, 8, 7, 5, 44, 'yuyuyuyuy'),
(7, 'pkg-61', '2016-10-02 23:32:00', '2016-10-09 00:00:00', 'y', 'ioioioioi', 9, 8, 7, 6, 5, 4, 'ffgfgfhghgf'),
(14, 'pkg-64', '2016-11-06 22:13:00', '2016-11-06 22:13:00', 'yuy', 'hgghg', 5, 4, 3, 2, 8, 9, 'jjjkhg');

-- --------------------------------------------------------

--
-- Table structure for table `profileDetail`
--

CREATE TABLE IF NOT EXISTS `profileDetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` bigint(15) NOT NULL,
  `fileName` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `profileDetail`
--

INSERT INTO `profileDetail` (`id`, `firstName`, `lastName`, `email`, `mobile`, `fileName`) VALUES
(41, 'tt', 'ttyy', 'yy@tt.c', 7777777777, 'VIKRAM_Resume_new (2).doc');

-- --------------------------------------------------------

--
-- Table structure for table `Vacancies`
--

CREATE TABLE IF NOT EXISTS `Vacancies` (
  `title` varchar(500) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `skillSet` varchar(500) NOT NULL,
  `workEx` varchar(1000) NOT NULL,
  `salaryRange` varchar(100) NOT NULL,
  `jobType` varchar(100) NOT NULL,
  `createdTime` date NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `Vacancies`
--

INSERT INTO `Vacancies` (`title`, `city`, `description`, `skillSet`, `workEx`, `salaryRange`, `jobType`, `createdTime`, `id`) VALUES
('Sales and Marketing (Healthcare Equipments)', 'Bhilai', '1. Sales and Marketing of Healthcare and Laboratory Products.\n2. Business development with crusading new markets in the state.\n3. Maintaining and good business relationship with existing clients.', 'Good communication skills, Familiar with Biological terms, basic computer knowledge like MS Office and Various mail platform, Pleasing personality, Must posses a two wheeler for frequent visit across Chhattisgarh', '1 to 4 Years', '7000 - 10000 INR', 'Sales and Marketing', '2016-10-20', 22),
('Safety Officer', 'Bhilai', 'The Safety Officer is responsible for monitoring and assessing hazardous and unsafe situations and developing measures to assure personnel safety.\r\nThe Safety Officer will correct unsafe acts or conditions through the regular line of authority, although the Safety Officer may exercise emergency authority to prevent or stop unsafe acts when immediate action is required.\r\nThe Safety Officer maintains awareness of active and developing situations.\r\nThe Safety Officer ensures the Site Safety and Health Plan is prepared and implemented.\r\nThe Safety Officer ensures there are safety messages in each Incident Action Plan.\r\nThe safety officer monitor the job progress in site and assist the team whenever needed for finish the specific task.', 'Diploma in safety.', '1 to 4 years', '7000 - 10000 INR', 'Safety Officer', '2016-10-20', 21);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Server version: 5.0.41
-- PHP Version: 4.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `344827_iceDEV`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_log`
--

CREATE TABLE `auth_log` (
  `id` mediumint(9) NOT NULL auto_increment,
  `user_id` mediumint(9) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL default '-1',
  `entry` longtext NOT NULL,
  `URL` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`,`ip`,`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

CREATE TABLE `auth_users` (
  `id` mediumint(9) NOT NULL,
  `session` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `loggedIn` tinyint(1) NOT NULL,
  `created` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `ip` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `session` (`session`,`active`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

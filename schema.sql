-- phpMyAdmin SQL Dump
-- version 2.11.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 01, 2009 at 05:45 PM
-- Server version: 5.0.41
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `344827_iceDEV`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaign_index`
--

CREATE TABLE `campaign_index` (
  `client_id` int(10) NOT NULL,
  `campaign_id` int(10) NOT NULL auto_increment,
  `campaign` varchar(200) NOT NULL,
  `widget_num` int(10) NOT NULL default '6',
  PRIMARY KEY  (`campaign_id`),
  KEY `campaign` (`campaign`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `campaign_index`
--

INSERT INTO `campaign_index` VALUES(1, 1, 'Spring Break', 12);

-- --------------------------------------------------------

--
-- Table structure for table `client_index`
--

CREATE TABLE `client_index` (
  `client_id` int(10) NOT NULL auto_increment,
  `client` varchar(200) NOT NULL,
  PRIMARY KEY  (`client_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `client_index`
--

INSERT INTO `client_index` VALUES(1, 'Ford');

-- --------------------------------------------------------

--
-- Table structure for table `post_index`
--

CREATE TABLE `post_index` (
  `source_id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL auto_increment,
  `content` varchar(600) NOT NULL,
  `url` varchar(400) NOT NULL,
  `pull_date` datetime NOT NULL,
  `image_url` varchar(400) default NULL,
  `approval` int(2) NOT NULL default '0' COMMENT '1=show,0=hide',
  `approval_date` datetime default NULL,
  PRIMARY KEY  (`post_id`),
  KEY `source_id` (`source_id`,`content`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=170 ;

--
-- Dumping data for table `post_index`
--


-- --------------------------------------------------------

--
-- Table structure for table `source_campaign`
--

CREATE TABLE `source_campaign` (
  `campaign_id` int(10) NOT NULL,
  `source_id` int(10) NOT NULL,
  KEY `campaign_id` (`campaign_id`,`source_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `source_campaign`
--


-- --------------------------------------------------------

--
-- Table structure for table `source_index`
--

CREATE TABLE `source_index` (
  `source_id` int(10) NOT NULL auto_increment,
  `source` varchar(200) NOT NULL,
  `source_desc` varchar(200) NOT NULL,
  `url` varchar(500) NOT NULL,
  `feed` varchar(500) NOT NULL,
  `type` varchar(2) NOT NULL COMMENT '1=blog,2=twitter,3=flickr,4=youtube,5=delicious',
  PRIMARY KEY  (`source_id`),
  KEY `source` (`source`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `source_index`
--


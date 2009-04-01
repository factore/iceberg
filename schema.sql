-- phpMyAdmin SQL Dump
-- version 2.11.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 01, 2009 at 11:41 AM
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

INSERT INTO `campaign_index` VALUES(1, 1, 'Spring Break', 6);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;

--
-- Dumping data for table `post_index`
--

INSERT INTO `post_index` VALUES(1, 1, ' Youtube: Ford Environmental: How do you get featured on YouTube?', 'http://www.youtube.com/watch?v=3eZTh94Fapg', '2009-04-01 11:36:15', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 2, ' Youtube: Ford Environmental: The Making of YouTube', 'http://www.youtube.com/watch?v=X2N_V2dfS1U', '2009-04-01 11:36:16', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 3, ' Youtube: Ford Environmental: Powers talks about new features', 'http://www.youtube.com/watch?v=uM4B5_jgFHM', '2009-04-01 11:36:17', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 4, ' Youtube: Ford Environmental: YouTube on the tube!', 'http://www.youtube.com/watch?v=rdwz7QiG0lk', '2009-04-01 11:36:18', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 5, ' Youtube: Ford Environmental: What''s New for February', 'http://www.youtube.com/watch?v=jbz73KG6eUU', '2009-04-01 11:36:19', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 6, ' Youtube: Ford Environmental: Stephen King Visits YouTube - Part 2', 'http://www.youtube.com/watch?v=CmCE8kzDkQo', '2009-04-01 11:36:20', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 7, ' Youtube: Ford Environmental: Stephen King Visits YouTube - Part 1', 'http://www.youtube.com/watch?v=Wz9CMhMWl_E', '2009-04-01 11:36:21', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 8, ' Youtube: Ford Environmental: Bill Clinton talks about the YouTube Nonprofit Program', 'http://www.youtube.com/watch?v=fvfumQ0_0_Q', '2009-04-01 11:36:22', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 9, ' Youtube: Ford Environmental: YouTube News - April Edition', 'http://www.youtube.com/watch?v=EgqdrirA2F4', '2009-04-01 11:36:23', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 10, ' Youtube: Ford Environmental: YouTube News - New Features For Search, Contacts and Inbox', 'http://www.youtube.com/watch?v=mKIKeEG7SRI', '2009-04-01 11:36:24', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 11, ' Youtube: Ford Environmental: Partner Program Expands', 'http://www.youtube.com/watch?v=b6tLq9AXwLk', '2009-04-01 11:36:25', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 12, ' Youtube: Ford Environmental: YouTube Captions and Subtitles', 'http://www.youtube.com/watch?v=QRS8MkLhQmM', '2009-04-01 11:36:26', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 13, ' Youtube: Ford Environmental: What''s New in March', 'http://www.youtube.com/watch?v=MaWi9JfOk3Y', '2009-04-01 11:36:27', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 14, ' Youtube: Ford Environmental: YouTube News - March Edition', 'http://www.youtube.com/watch?v=WFJdlW12BCw', '2009-04-01 11:36:28', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 15, ' Youtube: Ford Environmental: What''s New in April', 'http://www.youtube.com/watch?v=yuQOtxfF3XI', '2009-04-01 11:36:29', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 16, ' Youtube: Ford Environmental: Re: One World', 'http://www.youtube.com/watch?v=aWp3fpvrTBk', '2009-04-01 11:36:30', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 17, ' Youtube: Ford Environmental: Chad & Steve @ D5', 'http://www.youtube.com/watch?v=N1LtFh3uT44', '2009-04-01 11:36:31', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 18, ' Youtube: Ford Environmental: YouTube Happy New Year', 'http://www.youtube.com/watch?v=BPsfbV9t8Vw', '2009-04-01 11:36:32', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 19, ' Youtube: Ford Environmental: Creating YouTube Videos with Your Mobile Phone', 'http://www.youtube.com/watch?v=UXvhH8XfTKI', '2009-04-01 11:36:33', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 20, ' Youtube: Ford Environmental: Meet the Inaugural Community Council', 'http://www.youtube.com/watch?v=eDiS1fThZos', '2009-04-01 11:36:35', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 21, ' Youtube: Ford Environmental: Last Day in San Mateo', 'http://www.youtube.com/watch?v=zJOI3E4OdBw', '2009-04-01 11:36:36', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 22, ' Youtube: Ford Environmental: Hammer Time!', 'http://www.youtube.com/watch?v=v9Qiwzgkxhw', '2009-04-01 11:36:37', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 23, ' Youtube: Ford Environmental: YouTube News - December Edition', 'http://www.youtube.com/watch?v=T28Jwq35Cig', '2009-04-01 11:36:38', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 24, ' Youtube: Ford Environmental: YouTube Awards - Go Vote!', 'http://www.youtube.com/watch?v=kWgmnAslhNo', '2009-04-01 11:36:39', '', 0, NULL);
INSERT INTO `post_index` VALUES(1, 25, ' Youtube: Ford Environmental: First Day in San Bruno', 'http://www.youtube.com/watch?v=3VsWReBrfeg', '2009-04-01 11:36:40', '', 0, NULL);
INSERT INTO `post_index` VALUES(2, 26, 'Flickr: tag=green: 2009 Ford Escape Hybrid', 'http://www.flickr.com/photos/fordmotorcompany/2711328622/', '2009-04-01 11:36:42', 'http://farm4.static.flickr.com/3122/2711328622_51484320ee_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 27, 'Flickr: tag=green: 2009 Ford Escape Hybrid', 'http://www.flickr.com/photos/fordmotorcompany/2711327168/', '2009-04-01 11:36:43', 'http://farm4.static.flickr.com/3186/2711327168_4d683ae277_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 28, 'Flickr: tag=green: 2009 Ford Escape Hybrid', 'http://www.flickr.com/photos/fordmotorcompany/2711325096/', '2009-04-01 11:36:44', 'http://farm4.static.flickr.com/3147/2711325096_b5a8106b22_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 29, 'Flickr: tag=green: 2008 Ford Escape Hybrid', 'http://www.flickr.com/photos/fordmotorcompany/2606891061/', '2009-04-01 11:36:45', 'http://farm4.static.flickr.com/3196/2606891061_67e867f972_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 30, 'Flickr: tag=green: Hybrid logo', 'http://www.flickr.com/photos/fordmotorcompany/2212233461/', '2009-04-01 11:36:46', 'http://farm3.static.flickr.com/2377/2212233461_e3b0c876f4_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 31, 'Flickr: tag=green: 2009 Ford Escape Hybrid', 'http://www.flickr.com/photos/fordmotorcompany/2212028993/', '2009-04-01 11:36:47', 'http://farm3.static.flickr.com/2140/2212028993_6a0cc58edc_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 32, 'Flickr: tag=green: 2008 Ford Mustang Bullitt', 'http://www.flickr.com/photos/fordmotorcompany/1921209518/', '2009-04-01 11:36:48', 'http://farm3.static.flickr.com/2092/1921209518_d4eb51b57c_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 33, 'Flickr: tag=green: 2008 Ford Mustang Bullitt', 'http://www.flickr.com/photos/fordmotorcompany/1920404359/', '2009-04-01 11:36:49', 'http://farm3.static.flickr.com/2048/1920404359_5a0de5ed79_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 34, 'Flickr: tag=green: 2008 Ford Mustang Bullitt', 'http://www.flickr.com/photos/fordmotorcompany/1921242556/', '2009-04-01 11:36:50', 'http://farm3.static.flickr.com/2352/1921242556_f4acbcad83_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 35, 'Flickr: tag=green: 2008 Ford Mustang Bullitt', 'http://www.flickr.com/photos/fordmotorcompany/1920401633/', '2009-04-01 11:36:51', 'http://farm3.static.flickr.com/2365/1920401633_9012cd9790_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 36, 'Flickr: tag=green: 2008 Ford Mustang Bullitt', 'http://www.flickr.com/photos/fordmotorcompany/1920420937/', '2009-04-01 11:36:52', 'http://farm3.static.flickr.com/2224/1920420937_db0d8ebea8_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 37, 'Flickr: tag=green: 2008 Ford Mustang Bullitt', 'http://www.flickr.com/photos/fordmotorcompany/1920369463/', '2009-04-01 11:36:53', 'http://farm3.static.flickr.com/2182/1920369463_564946f475_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 38, 'Flickr: tag=green: 2008 Ford Mustang Bullitt', 'http://www.flickr.com/photos/fordmotorcompany/1921219030/', '2009-04-01 11:36:54', 'http://farm3.static.flickr.com/2341/1921219030_a42197409e_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 39, 'Flickr: tag=green: 2008 Ford Mustang Bullitt', 'http://www.flickr.com/photos/fordmotorcompany/1921199852/', '2009-04-01 11:36:55', 'http://farm3.static.flickr.com/2386/1921199852_b127bf6201_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 40, 'Flickr: tag=green: 2008 Ford Mustang Bullitt', 'http://www.flickr.com/photos/fordmotorcompany/1920408113/', '2009-04-01 11:36:56', 'http://farm3.static.flickr.com/2308/1920408113_97c8cddf3f_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 41, 'Flickr: tag=green: 2008 Ford Mustang Bullitt', 'http://www.flickr.com/photos/fordmotorcompany/1920418061/', '2009-04-01 11:36:57', 'http://farm3.static.flickr.com/2196/1920418061_ee3992c76f_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 42, 'Flickr: tag=green: 2008 Ford Mustang Bullitt', 'http://www.flickr.com/photos/fordmotorcompany/1921222248/', '2009-04-01 11:36:58', 'http://farm3.static.flickr.com/2388/1921222248_44b20ab227_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 43, 'Flickr: tag=green: 2008 Ford Mustang Bullitt', 'http://www.flickr.com/photos/fordmotorcompany/1920377935/', '2009-04-01 11:36:59', 'http://farm3.static.flickr.com/2034/1920377935_f23e74e61e_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 44, 'Flickr: tag=green: 2008 Ford Mustang Bullitt', 'http://www.flickr.com/photos/fordmotorcompany/1920388561/', '2009-04-01 11:37:00', 'http://farm3.static.flickr.com/2124/1920388561_ba1098a3f3_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(2, 45, 'Flickr: tag=green: a Ford Escape Hybrid & Esai Morales', 'http://www.flickr.com/photos/fordmotorcompany/1801733944/', '2009-04-01 11:37:01', 'http://farm3.static.flickr.com/2080/1801733944_3a8af5b3dc_t.jpg', 0, NULL);
INSERT INTO `post_index` VALUES(3, 46, 'FordDriveOne: We''ve changed our name. Finally claimed the @Ford account. #Ford', 'http://twitter.com/FordDriveOne/statuses/1427762034', '2009-04-01 11:37:02', 'http://twitter.com/FordDriveOne/statuses/1427762034', 0, NULL);
INSERT INTO `post_index` VALUES(3, 47, 'FordDriveOne: @lindsaymogard Sorry - what you do mean, exactly?', 'http://twitter.com/FordDriveOne/statuses/1427428766', '2009-04-01 11:37:03', 'http://twitter.com/FordDriveOne/statuses/1427428766', 0, NULL);
INSERT INTO `post_index` VALUES(3, 48, 'FordDriveOne: @hillarybrooke Now you''re talking! Let us know if we can help.', 'http://twitter.com/FordDriveOne/statuses/1420192311', '2009-04-01 11:37:04', 'http://twitter.com/FordDriveOne/statuses/1420192311', 0, NULL);
INSERT INTO `post_index` VALUES(3, 49, 'FordDriveOne: @redstatemomma :-)', 'http://twitter.com/FordDriveOne/statuses/1419925538', '2009-04-01 11:37:05', 'http://twitter.com/FordDriveOne/statuses/1419925538', 0, NULL);
INSERT INTO `post_index` VALUES(3, 50, 'FordDriveOne: @admiralhbyrd Now why you gotta go harshin'' on us like that? #Ford', 'http://twitter.com/FordDriveOne/statuses/1419268868', '2009-04-01 11:37:06', 'http://twitter.com/FordDriveOne/statuses/1419268868', 0, NULL);
INSERT INTO `post_index` VALUES(3, 51, 'FordDriveOne: @RobMcNealy @mpgomatic Two parts: http://tinyurl.com/68fpbu http://www.youtube.com/watch?v=fnvpNVJ48s8', 'http://twitter.com/FordDriveOne/statuses/1398736940', '2009-04-01 11:37:07', 'http://twitter.com/FordDriveOne/statuses/1398736940', 0, NULL);
INSERT INTO `post_index` VALUES(3, 52, 'FordDriveOne: @delchoness Thanks for your staunch support and advice. #Ford', 'http://twitter.com/FordDriveOne/statuses/1398567963', '2009-04-01 11:37:08', 'http://twitter.com/FordDriveOne/statuses/1398567963', 0, NULL);
INSERT INTO `post_index` VALUES(3, 53, 'FordDriveOne: @RobMcNealy You''re way over my head there.', 'http://twitter.com/FordDriveOne/statuses/1398467892', '2009-04-01 11:37:09', 'http://twitter.com/FordDriveOne/statuses/1398467892', 0, NULL);
INSERT INTO `post_index` VALUES(3, 54, 'FordDriveOne: @RobMcNealy It has to do with the EPA standards we measure by.', 'http://twitter.com/FordDriveOne/statuses/1398462639', '2009-04-01 11:37:10', 'http://twitter.com/FordDriveOne/statuses/1398462639', 0, NULL);
INSERT INTO `post_index` VALUES(3, 55, 'FordDriveOne: @delchoness I hear ya. #Ford', 'http://twitter.com/FordDriveOne/statuses/1398455405', '2009-04-01 11:37:11', 'http://twitter.com/FordDriveOne/statuses/1398455405', 0, NULL);
INSERT INTO `post_index` VALUES(3, 56, 'FordDriveOne: @delchoness Oh. I have no idea on that one - I don''t know that we have any creative direction. I think we just lend the car.', 'http://twitter.com/FordDriveOne/statuses/1398447439', '2009-04-01 11:37:12', 'http://twitter.com/FordDriveOne/statuses/1398447439', 0, NULL);
INSERT INTO `post_index` VALUES(3, 57, 'FordDriveOne: @RobMcNealy It''s a false analogy. That figure was based on Imperial gallons & the UK engine cycle - equal to about 43 mpg #Ford', 'http://twitter.com/FordDriveOne/statuses/1398443248', '2009-04-01 11:37:13', 'http://twitter.com/FordDriveOne/statuses/1398443248', 0, NULL);
INSERT INTO `post_index` VALUES(3, 58, 'FordDriveOne: @delchoness Don''t know if we''re referring to the same one http://tinyurl.com/dlyke9 #Ford', 'http://twitter.com/FordDriveOne/statuses/1398437673', '2009-04-01 11:37:14', 'http://twitter.com/FordDriveOne/statuses/1398437673', 0, NULL);
INSERT INTO `post_index` VALUES(3, 59, 'FordDriveOne: @delchoness Got it. Thanks for the input. #americanidol #Ford', 'http://twitter.com/FordDriveOne/statuses/1398429388', '2009-04-01 11:37:15', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 60, 'Autoblog: Peter Horbury returns to head Volvo design; Moray Callum in as Ford''s design chief', 'http://www.autoblog.com/2009/04/01/peter-horbury-returns-to-head-volvo-design-moray-callum-in-as-f/', '2009-04-01 11:37:16', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 61, 'Autoblog: 2010 Ford Shelby GT500 squeezes out an extra 2 MPG', 'http://www.autoblog.com/2009/04/01/2010-ford-shelby-gt500-squeezes-out-an-extra-2-mpg/', '2009-04-01 11:37:17', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 62, 'Autoblog: Ford reportedly turning its back on production Fiesta RS', 'http://www.autoblog.com/2009/03/31/ford-reportedly-turning-its-back-on-production-fiesta-rs/', '2009-04-01 11:37:18', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 63, 'Autoblog: Incentive Program Comparo: GM vs. Ford vs. Hyundai', 'http://www.autoblog.com/2009/03/31/incentive-program-comparo-gm-vs-ford-vs-hyundai/', '2009-04-01 11:37:19', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 64, 'Autoblog: Ford Advantage Plan guarantees job loss protection for new vehicle loans', 'http://www.autoblog.com/2009/03/31/ford-advantage-plan-guarantees-job-loss-protection-for-new-vehic/', '2009-04-01 11:37:20', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 65, 'Autoblog: 2011 Ford Explorer reportedly to be built in Chicago on Taurus X platform', 'http://www.autoblog.com/2009/03/31/2011-ford-explorer-reportedly-to-be-built-in-chicago-on-taurus-x/', '2009-04-01 11:37:21', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 66, 'Autoblog: Winning Bet: Davey G. Johnson gets a Fiesta, we don''t', 'http://www.autoblog.com/2009/03/31/winning-bet-davey-g-johnson-gets-his-fiesta/', '2009-04-01 11:37:22', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 67, 'Autoblog: Everybody loves... the Fiesta Movement?', 'http://www.autoblog.com/2009/03/29/everybody-loves-the-fiesta-movement/', '2009-04-01 11:37:23', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 68, 'Autoblog: Spy Shots: Next Ford Focus mules caught testing', 'http://www.autoblog.com/2009/03/26/spy-shots-next-ford-focus-mules-caught-testing/', '2009-04-01 11:37:24', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 69, 'Autoblog: Ford Focus RS heads to ''Ring in search of a class record', 'http://www.autoblog.com/2009/03/26/ford-focus-rs-heads-to-ring-in-search-of-a-class-record/', '2009-04-01 11:37:25', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 70, 'Autoblog: Rendered Speculation: 2011 Ford F-Series Super Duty looks beefy, more modern', 'http://www.autoblog.com/2009/03/26/rendered-speculation-2011-ford-f-series-super-duty-looks-beefy/', '2009-04-01 11:37:26', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 71, 'Autoblog: Ford CEO Mulally gets 37% pay cut; Gephardt, Earley appointed to board', 'http://www.autoblog.com/2009/03/25/ford-ceo-mulally-gets-37-pay-cut-gephardt-earley-appointed-to/', '2009-04-01 11:37:27', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 72, 'Autoblog: VIDEO: AutoblogGreen tries out for the Fiesta Movement', 'http://www.autoblog.com/2009/03/24/video-autobloggreen-tries-out-for-the-fiesta-movement/', '2009-04-01 11:37:28', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 73, 'Autoblog: Ford throws support behind aid for GM Europe', 'http://www.autoblog.com/2009/03/19/ford-throws-support-behind-aid-for-gm-europe/', '2009-04-01 11:37:29', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 74, 'Autoblog: Review: 2010 Ford Mustang GT - A full week changes attitudes', 'http://www.autoblog.com/2009/03/18/review-2010-ford-mustang-gt/', '2009-04-01 11:37:30', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 75, 'Autoblog: First to the Punch: Roush unveils 2010 427R Mustang', 'http://www.autoblog.com/2009/03/18/first-to-the-punch-roush-unveils-2010-427r-mustang/', '2009-04-01 11:37:31', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 76, 'Autoblog: REPORT: Congress members drafting cash-for-clunkers bill', 'http://www.autoblog.com/2009/03/18/report-congress-members-drafting-cash-for-clunkers-bill/', '2009-04-01 11:37:32', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 77, 'Autoblog: Mullaly awarded option to buy 5 million shares of Ford stock', 'http://www.autoblog.com/2009/03/17/mullaly-awarded-option-to-buy-5-million-shares-of-ford-stock/', '2009-04-01 11:37:33', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(4, 78, 'Autoblog: Former Ford plant home to thousands of unsold Hondas', 'http://www.autoblog.com/2009/03/16/former-ford-plant-home-to-thousands-of-unsold-hondas/', '2009-04-01 11:37:34', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(5, 79, 'Jessica Knows: Oprah: Social Media Fantasy Campaign', 'http://jessicaknows.com/?p=1302', '2009-04-01 11:37:35', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(5, 80, 'Jessica Knows: Ford Advantage Plan?A Peace of Mind in this Shaky Economy', 'http://jessicaknows.com/?p=1300', '2009-04-01 11:37:36', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(5, 81, 'Jessica Knows: Save the Boobies.  Choose StudioPress.', 'http://jessicaknows.com/?p=1295', '2009-04-01 11:37:37', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(5, 82, 'Jessica Knows: Uppercase Living Helped Me Fake Upscale Decorating', 'http://jessicaknows.com/?p=1289', '2009-04-01 11:37:38', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);
INSERT INTO `post_index` VALUES(5, 83, 'Jessica Knows: Cadbury Dairy Milk: Social Media Fantasy Campaign', 'http://jessicaknows.com/?p=1277', '2009-04-01 11:37:39', 'http://twitter.com/FordDriveOne/statuses/1398429388', 0, NULL);

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

INSERT INTO `source_campaign` VALUES(1, 1);
INSERT INTO `source_campaign` VALUES(1, 2);
INSERT INTO `source_campaign` VALUES(1, 3);
INSERT INTO `source_campaign` VALUES(1, 4);
INSERT INTO `source_campaign` VALUES(1, 5);

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

INSERT INTO `source_index` VALUES(1, ' Youtube: Ford Environmental', 'Ford Environmental Youtube feed', 'http://www.youtube.com/user/FordEnvironmental', 'http://gdata.youtube.com/feeds/base/users/youtube/uploads', '4');
INSERT INTO `source_index` VALUES(2, 'Flickr: tag=green', 'Ford Flickr feed tagged with ''green''', 'http://www.flickr.com/photos/fordmotorcompany/tags/green/', 'http://api.flickr.com/services/feeds/photos_public.gne?id=13524418@N07&tags=green&lang=en-us&format=rss_200', '3');
INSERT INTO `source_index` VALUES(3, 'FordDriveOne', 'Twitter Stream from FordDriveOne', 'http://twitter.com/FordDriveOne', 'http://search.twitter.com/search.atom?q=+from%3Aforddriveone', '2');
INSERT INTO `source_index` VALUES(4, 'Autoblog', 'Autoblog feed', 'http://www.autoblog.com', 'http://www.autoblog.com/category/ford/rss.xml', '1a');
INSERT INTO `source_index` VALUES(5, 'Jessica Knows', 'Jessica Knows - Mommy Blogger', 'http://jessicaknows.com/', 'http://feeds2.feedburner.com/jessicaknows', '1b');

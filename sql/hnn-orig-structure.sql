-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5278
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for hnn
CREATE DATABASE IF NOT EXISTS `hnn` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `hnn`;

-- Dumping structure for table hnn.article
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `author` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(255) NOT NULL DEFAULT '',
  `source_url` varchar(255) NOT NULL DEFAULT '',
  `source_date` varchar(50) NOT NULL DEFAULT '',
  `source_bio` longtext NOT NULL,
  `body` longtext NOT NULL,
  `teaser` longtext NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `created` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `node_created` (`created`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=169250 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.article_category_xref
CREATE TABLE IF NOT EXISTS `article_category_xref` (
  `article_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `article_category_index` (`article_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.authassignment
CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.authitem
CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.authitemchild
CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
   PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.blog
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `author_id` int(11) unsigned NOT NULL DEFAULT '0',
  `category_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(255) NOT NULL DEFAULT '',
  `body` longtext NOT NULL,
  `teaser` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=154113 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.blog_author
CREATE TABLE IF NOT EXISTS `blog_author` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `author` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `group_id` int(10) unsigned NOT NULL,
  `description` longtext NOT NULL,
  `weight` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.category_group
CREATE TABLE IF NOT EXISTS `category_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.comment
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(60) DEFAULT NULL,
  `subject` varchar(64) NOT NULL DEFAULT '',
  `comment` longtext NOT NULL,
  `timestamp` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `nid` (`nid`),
  KEY `comment_uid` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=148036 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.country
CREATE TABLE IF NOT EXISTS `country` (
  `ixCountry` char(2) NOT NULL,
  `sName` varchar(80) NOT NULL,
  `sFormattedName` varchar(80) NOT NULL,
  `ixCountry2` char(3) DEFAULT NULL,
  `sIsoNumCode` smallint(6) DEFAULT NULL,
  `sRegion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ixCountry`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.file
CREATE TABLE IF NOT EXISTS `file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nid` int(10) unsigned NOT NULL DEFAULT '0',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `filepath` varchar(255) NOT NULL DEFAULT '',
  `filemime` varchar(255) NOT NULL DEFAULT '',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(32) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `nid` (`nid`),
  KEY `type` (`type`),
  KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB AUTO_INCREMENT=28738 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.hnn_ad
CREATE TABLE IF NOT EXISTS `hnn_ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slot` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ad_code` text COLLATE utf8_unicode_ci,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table hnn.jobpost
CREATE TABLE IF NOT EXISTS `jobpost` (
  `ixJobPost` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `sSource` varchar(50) DEFAULT NULL,
  `sLocation` varchar(255) DEFAULT NULL,
  `sGeneralStartDate` varchar(255) DEFAULT NULL,
  `sSalaryDescription` text,
  `sRequirements` text,
  `sBenefits` varchar(255) DEFAULT NULL,
  `sDescription` text NOT NULL,
  `sTitle` varchar(255) NOT NULL,
  `sEmployerName` varchar(255) NOT NULL,
  `sContactEmail` varchar(100) DEFAULT NULL,
  `sUrl` varchar(255) DEFAULT NULL,
  `sUrlExternal` varchar(255) DEFAULT NULL,
  `sApplicationUrl` varchar(255) DEFAULT NULL,
  `dtPosted` datetime NOT NULL,
  `dtExpire` datetime NOT NULL,
  `sAddress` varchar(255) DEFAULT NULL,
  `sStateProvince` varchar(100) DEFAULT NULL,
  `sCity` varchar(100) DEFAULT NULL,
  `ixCountry` char(2) DEFAULT NULL,
  `fVerified` tinyint(1) NOT NULL DEFAULT '1',
  `fActive` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ixJobPost`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.node_set
CREATE TABLE IF NOT EXISTS `node_set` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ids` text NOT NULL,
  `set_id` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.node_tag_xref
CREATE TABLE IF NOT EXISTS `node_tag_xref` (
  `nid` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT '',
  UNIQUE KEY `node_tag_index` (`nid`,`tag_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.seo
CREATE TABLE IF NOT EXISTS `seo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(16) NOT NULL DEFAULT '',
  `nid` int(10) unsigned NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` longtext,
  `keywords` longtext,
  `robots` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `nid` (`nid`)
) ENGINE=InnoDB AUTO_INCREMENT=914 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.seo_sitemap
CREATE TABLE IF NOT EXISTS `seo_sitemap` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `loc` varchar(255) NOT NULL DEFAULT '',
  `priority` float NOT NULL DEFAULT '0.5',
  `changefreq` varchar(20) NOT NULL DEFAULT 'never',
  `lastmod` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=164047 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.seo_url_alias
CREATE TABLE IF NOT EXISTS `seo_url_alias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nid` int(10) unsigned NOT NULL DEFAULT '0',
  `alias` varchar(128) NOT NULL DEFAULT '',
  `path` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=32817 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.static_page
CREATE TABLE IF NOT EXISTS `static_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `modified` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.tag
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12766 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.trendingarticle
CREATE TABLE IF NOT EXISTS `trendingarticle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemId` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `trendingArticle_articleId_uindex` (`itemId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pass` varchar(128) NOT NULL DEFAULT '',
  `mail` varchar(64) DEFAULT '',
  `first_name` varchar(32) DEFAULT '',
  `middle_name` varchar(32) DEFAULT '',
  `last_name` varchar(32) DEFAULT '',
  `created` int(11) NOT NULL DEFAULT '0',
  `login` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mail` (`mail`),
  KEY `created` (`created`)
) ENGINE=InnoDB AUTO_INCREMENT=78815 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hnn.user_blog_author_xref
CREATE TABLE IF NOT EXISTS `user_blog_author_xref` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `blog_author_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1492 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table hnn.user_category_xref
CREATE TABLE IF NOT EXISTS `user_category_xref` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2293 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table hnn.user_profile
CREATE TABLE IF NOT EXISTS `user_profile` (
  `user_profile_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `sCompanyName` varchar(255) DEFAULT NULL,
  `sPhonePrimary` varchar(100) DEFAULT NULL,
  `sPhoneSecondary` varchar(100) DEFAULT NULL,
  `sAddressLine1` varchar(255) DEFAULT NULL,
  `sAddressLine2` varchar(255) DEFAULT NULL,
  `sCity` varchar(100) DEFAULT NULL,
  `sStateProvince` varchar(255) DEFAULT NULL,
  `sPostalCode` varchar(50) DEFAULT NULL,
  `ixCountry` char(2) DEFAULT NULL,
  PRIMARY KEY (`user_profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

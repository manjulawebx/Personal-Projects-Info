# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.20-log)
# Database: comtech_projects
# Generation Time: 2015-04-04 10:53:17 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table clients
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clients`;

CREATE TABLE `clients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `added` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `prj_name` varchar(100) DEFAULT NULL,
  `prj_description` text,
  `prj_prod_url` varchar(200) DEFAULT '',
  `prj_prod_admin_url` varchar(200) DEFAULT NULL,
  `prj_prod_admin_un` varchar(100) DEFAULT NULL,
  `prj_prod_admin_pw` varchar(200) DEFAULT NULL,
  `prj_local_url` varchar(200) DEFAULT NULL,
  `prj_local_admin_url` varchar(200) DEFAULT NULL,
  `prj_local_admin_un` varchar(100) DEFAULT NULL,
  `prj_local_admin_pw` varchar(100) DEFAULT NULL,
  `prj_testing_url` varchar(200) DEFAULT NULL,
  `prj_testing_admin_url` varchar(200) DEFAULT NULL,
  `prj_testing_admin_un` varchar(100) DEFAULT NULL,
  `prj_testing_admin_pw` varchar(200) DEFAULT NULL,
  `prj_host_url` varchar(200) DEFAULT NULL,
  `prj_host_un` varchar(100) DEFAULT NULL,
  `prj_host_pw` varchar(200) DEFAULT NULL,
  `prj_git_repo_url` varchar(200) DEFAULT NULL,
  `prj_ftp_server` varchar(200) DEFAULT NULL,
  `prj_ftp_path` varchar(100) DEFAULT NULL,
  `prj_ftp_un` varchar(200) DEFAULT NULL,
  `prj_ftp_pw` varchar(200) DEFAULT NULL,
  `prj_quotation_amount` decimal(11,2) DEFAULT NULL,
  `prj_quotation_date` date DEFAULT NULL,
  `prj_added` datetime DEFAULT NULL,
  `prj_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table projects_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projects_log`;

CREATE TABLE `projects_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `log_details` text,
  `log_created` datetime DEFAULT NULL,
  `log_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

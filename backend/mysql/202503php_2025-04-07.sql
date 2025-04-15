# ************************************************************
# Sequel Ace SQL dump
# 版本号： 20089
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# 主机: 127.0.0.1 (MySQL 8.0.41)
# 数据库: 202503php
# 生成时间: 2025-04-07 10:58:01 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# 转储表 Tax_info
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Tax_info`;

CREATE TABLE `Tax_info` (
  `Tax_id` int NOT NULL AUTO_INCREMENT,
  `container_id` int NOT NULL,
  `Tax_status` enum('TAX','TAX-FREE') NOT NULL,
  `customs_declaration_no` varchar(100) DEFAULT NULL,
  `valid_from` date DEFAULT NULL,
  `valid_to` date DEFAULT NULL,
  PRIMARY KEY (`Tax_id`),
  KEY `container_id` (`container_id`),
  CONSTRAINT `Tax_info_ibfk_1` FOREIGN KEY (`container_id`) REFERENCES `containers` (`container_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `Tax_info` WRITE;
/*!40000 ALTER TABLE `Tax_info` DISABLE KEYS */;

INSERT INTO `Tax_info` (`Tax_id`, `container_id`, `Tax_status`, `customs_declaration_no`, `valid_from`, `valid_to`)
VALUES
	(1,1,'TAX','001',NULL,NULL);

/*!40000 ALTER TABLE `Tax_info` ENABLE KEYS */;
UNLOCK TABLES;


# 转储表 containers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `containers`;

CREATE TABLE `containers` (
  `container_id` int NOT NULL AUTO_INCREMENT,
  `container_no` varchar(50) NOT NULL,
  `entry_time` datetime NOT NULL,
  `exit_time` datetime DEFAULT NULL,
  `customer_id` int NOT NULL,
  `status` enum('IN_WAREHOUSE','OUT_WAREHOUSE') DEFAULT 'IN_WAREHOUSE',
  PRIMARY KEY (`container_id`),
  UNIQUE KEY `container_no` (`container_no`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `containers_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `containers` WRITE;
/*!40000 ALTER TABLE `containers` DISABLE KEYS */;

INSERT INTO `containers` (`container_id`, `container_no`, `entry_time`, `exit_time`, `customer_id`, `status`)
VALUES
	(1,'2','2023-09-20 14:30:00',NULL,1,'IN_WAREHOUSE'),
	(1000,'1','2023-09-20 14:30:00',NULL,1,'IN_WAREHOUSE');

/*!40000 ALTER TABLE `containers` ENABLE KEYS */;
UNLOCK TABLES;


# 转储表 customers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `contact_person` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`customer_id`),
  KEY `idx_customers_name` (`name`),
  KEY `idx_customers_email` (`email`),
  KEY `idx_customers_phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;

INSERT INTO `customers` (`customer_id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`)
VALUES
	(1,'han','han','07014252333','alsdjhflkaj@qq.com','setagaya','2025-04-07 18:15:49'),
	(2,'全球贸易有限公司','张伟','138-1234-5678','zhangwei@globaltrade.com','上海市浦东新区世纪大道100号','2025-04-07 19:10:04'),
	(3,'欧亚物流集团','Maria Schmidt','+49 30 12345678','maria@eurasia-logistics.de','德国柏林市勃兰登堡大街5号','2025-04-07 19:10:04'),
	(4,'跨境易购电商','李晓红','0755-87654321','lixiaohong@cbe.com','深圳市南山区科技园科兴路3号','2025-04-07 19:10:04'),
	(5,'北方重工进出口','王刚','010-66554433','wanggang@nhi-imp-exp.cn','北京市朝阳区建国门外大街1号','2025-04-07 19:10:04'),
	(6,'东南亚航运联盟','Tan Wei Ming','+65 6123 4567','tanwm@seaship.sg','新加坡滨海湾金融中心2号楼','2025-04-07 19:10:04');

/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

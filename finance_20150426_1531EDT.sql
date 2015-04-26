#
# SQL Export
# Created by Querious (962)
# Created: April 26, 2015 at 3:31:37 PM EDT
# Encoding: Unicode (UTF-8)
#


DROP TABLE IF EXISTS `usertable`;
DROP TABLE IF EXISTS `transactions`;
DROP TABLE IF EXISTS `accounts`;


CREATE TABLE `accounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `account_type` varchar(100) DEFAULT NULL,
  `balance` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;


CREATE TABLE `transactions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `account_name` varchar(45) DEFAULT NULL,
  `transaction_type` varchar(45) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `date` varchar(128) DEFAULT NULL,
  `payee_comments` varchar(500) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;


CREATE TABLE `usertable` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(200) DEFAULT '',
  `first_name` varchar(11) DEFAULT NULL,
  `last_name` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;




SET @PREVIOUS_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS = 0;


LOCK TABLES `accounts` WRITE;
ALTER TABLE `accounts` DISABLE KEYS;
INSERT INTO `accounts` (`id`, `username`, `account_name`, `account_type`, `balance`) VALUES 
	(32,'test@test.com','Suntrust','Savings','-100');
ALTER TABLE `accounts` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `transactions` WRITE;
ALTER TABLE `transactions` DISABLE KEYS;
ALTER TABLE `transactions` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `usertable` WRITE;
ALTER TABLE `usertable` DISABLE KEYS;
INSERT INTO `usertable` (`id`, `email`, `password`, `first_name`, `last_name`) VALUES 
	(0,'test@test.com','test','test','test');
ALTER TABLE `usertable` ENABLE KEYS;
UNLOCK TABLES;




SET FOREIGN_KEY_CHECKS = @PREVIOUS_FOREIGN_KEY_CHECKS;



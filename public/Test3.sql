SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for employee
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `id_code_ssn` int(11) DEFAULT NULL,
  `is_current_employee` tinyint(1) NOT NULL DEFAULT '1',
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for employee_resume
-- ----------------------------
DROP TABLE IF EXISTS `employee_resume`;
CREATE TABLE `employee_resume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `introduction` text,
  `previous_work_experience` text,
  `education_information` text,
  PRIMARY KEY (`id`),
  KEY `employee_id` (`employee_id`),
  KEY `employee_resume_ibfk_2` (`language_id`),
  CONSTRAINT `employee_resume_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `employee_resume_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for language
-- ----------------------------
DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `code` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `short_name_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for log_info
-- ----------------------------
DROP TABLE IF EXISTS `log_info`;
CREATE TABLE `log_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `log_type` enum('insert','update','delete') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `log_info_ibfk_1` (`user_id`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `log_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `log_info_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `family` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;

-- ----------------------------
-- Records of language
-- ----------------------------
INSERT INTO `language` VALUES (1, 'English', 'en');
INSERT INTO `language` VALUES (2, 'Spanish', 'es');
INSERT INTO `language` VALUES (3, 'French', 'fr');

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'Admin1', 'Alex', 'Fergosen');

-- ----------------------------
-- Records of employee and log_info
-- ----------------------------
INSERT INTO `employee` VALUES (1, 'Mohamad Habibi', '1986-04-08', 123456, 1, 'habibi.mh@gmail.com', '+989193049624', 'Tehran');
INSERT INTO `log_info` (`user_id`, `employee_id`, `log_type`) VALUES (1, 1, 'insert');

INSERT INTO `employee` VALUES (2, 'Mohsen Yeganeh', '1988-11-24', 654321, 1, 'mohsen@gmail.com', '+989121234567', 'Ahvaz');
INSERT INTO `log_info` (`user_id`, `employee_id`, `log_type`) VALUES (1, 2, 'insert');

UPDATE `employee` SET `email` = 'mohsen.yeganeh@gmail.com' WHERE `id` = 2;
INSERT INTO `log_info` (`user_id`, `employee_id`, `log_type`) VALUES (1, 2, 'update');

-- ----------------------------
-- Records of employee_resume
-- ----------------------------
INSERT INTO `employee_resume` VALUES (1, 1, 1, 'I\'m Mohamad', 'I have experienced about 12 years', 'bachelor of computer engineering');
INSERT INTO `employee_resume` VALUES (2, 1, 2, 'Soy Mohamad', 'He experimentado unos 12 años', 'licenciado en ingeniería informática');
INSERT INTO `employee_resume` VALUES (3, 1, 3, 'Je suis Mohamad', 'J\'ai connu environ 12 ans', 'baccalauréat en génie informatique');
INSERT INTO `employee_resume` VALUES (4, 2, 1, 'I\'m Mohsen', 'I don\'t have any experience', 'Diploma');
INSERT INTO `employee_resume` VALUES (5, 2, 2, 'Soy Mohsen', 'No tengo ninguna experiencia', 'Diploma');
INSERT INTO `employee_resume` VALUES (6, 2, 3, 'Je suis Mohsen', 'Je n\'ai aucune expérience', 'Diplôme');


-- ----------------------------
-- Example query to get 1-person data in all languages
-- ----------------------------

SET @employeeID = 1;

SELECT * FROM employee WHERE id = @employeeID;

SELECT l.name AS language, r.introduction, r.previous_work_experience, r.education_information FROM employee_resume r
INNER JOIN `language` l ON r.language_id = l.id
WHERE employee_id = @employeeID;


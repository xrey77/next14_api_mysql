-- nextDB.account definition
CREATE TABLE `account` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `isadmin` tinyint DEFAULT '0',
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `mobileno` varchar(100) DEFAULT NULL,
  `profilepic` varchar(100) DEFAULT NULL,
  `qrcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `secretkey` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

USE `gunnm`;

-- gunnm.manga_user definition

CREATE TABLE `manga_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `manga_id` int NOT NULL,
  `user_id` int NOT NULL,
  `is_fav` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `manga_user_FK` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `manga_user_FK_1` FOREIGN KEY (`id`) REFERENCES `manga` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- gunnm.manga definition

CREATE TABLE `manga` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author` varchar(100) NOT NULL,
  `release_at` datetime NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- gunnm.`user` definition

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

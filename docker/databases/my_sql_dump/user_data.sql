CREATE TABLE IF NOT EXISTS `php_pro`.`user_data` (
                                                     `id` INT NOT NULL AUTO_INCREMENT,
                                                     `created_at` DATETIME NOT NULL,
                                                     `update_at` DATETIME NULL,
                                                     `status` INT(2) NULL DEFAULT 0,
    `name` VARCHAR(15) NOT NULL,
    `password` VARCHAR(32) NOT NULL,
    `banned` TINYINT NULL DEFAULT 0,
    PRIMARY KEY (`id`));

INSERT INTO `php_pro`.`user_data` (`id`,`created_at`,`update_at`,`status`,`name`,`password`,`banned`) VALUES (1,'2022-11-16 19:40:16','2022-11-16 19:40:16',0,'Вадим','5f4dcc3b5aa765d61d8327deb882cf99',0);
INSERT INTO `php_pro`.`user_data` (`id`,`created_at`,`update_at`,`status`,`name`,`password`,`banned`) VALUES (2,'2022-11-16 19:50:58','2022-11-16 19:50:58',0,'Наталка','c5fe25896e49ddfe996db7508cf00534',0);
INSERT INTO `php_pro`.`user_data` (`id`,`created_at`,`update_at`,`status`,`name`,`password`,`banned`) VALUES (3,'2022-11-16 19:51:27','2022-11-16 19:51:27',0,'Кірюша','158ec78df27ecea6993da672ef17b556',0);
INSERT INTO `php_pro`.`user_data` (`id`,`created_at`,`update_at`,`status`,`name`,`password`,`banned`) VALUES (4,'2022-11-16 19:53:00','2022-11-16 19:53:00',0,'Оленка','bf6fdde5f52a8cfcaf6183b0336d8b09',0);

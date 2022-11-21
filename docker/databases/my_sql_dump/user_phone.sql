CREATE TABLE IF NOT EXISTS `php_pro`.`user_phone` (
                                       `id_phone` INT NOT NULL AUTO_INCREMENT,
                                       `id_user` INT NOT NULL,
                                       `phone` VARCHAR(20) NOT NULL,
                                       PRIMARY KEY (`id_phone`));

/*
-- Query: SELECT * FROM php_pro.user_phone
LIMIT 0, 1000

-- Date: 2022-11-21 16:54
*/
INSERT INTO `php_pro`.`user_phone` (`id_phone`,`id_user`,`phone`) VALUES (1,1,'+380981111111');
INSERT INTO `php_pro`.`user_phone` (`id_phone`,`id_user`,`phone`) VALUES (2,1,'+380731111111');
INSERT INTO `php_pro`.`user_phone` (`id_phone`,`id_user`,`phone`) VALUES (3,2,'+380982222222');
INSERT INTO `php_pro`.`user_phone` (`id_phone`,`id_user`,`phone`) VALUES (4,3,'+380983333333');
INSERT INTO `php_pro`.`user_phone` (`id_phone`,`id_user`,`phone`) VALUES (5,4,'+380985555555');

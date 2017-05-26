#2017-05-26
ALTER TABLE `user`
ADD COLUMN `first_name`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `link`,
ADD COLUMN `last_name`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `first_name`;
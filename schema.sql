SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `ci_sessions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ci_sessions` ;

CREATE  TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL DEFAULT '0' ,
  `ip_address` VARCHAR(16) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL DEFAULT '0' ,
  `user_agent` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_activity` INT(10) UNSIGNED NOT NULL DEFAULT '0' ,
  `user_data` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  PRIMARY KEY (`session_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `things`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `things` ;

CREATE  TABLE IF NOT EXISTS `things` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `thing_name` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `item_name` (`thing_name` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE  TABLE IF NOT EXISTS `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `password` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `email` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `activated` TINYINT(1) NOT NULL DEFAULT '1' ,
  `banned` TINYINT(1) NOT NULL DEFAULT '0' ,
  `ban_reason` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `new_password_key` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `new_password_requested` DATETIME NULL DEFAULT NULL ,
  `new_email` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `new_email_key` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `last_ip` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_login` DATETIME NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `tag_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tag_types` ;

CREATE  TABLE IF NOT EXISTS `tag_types` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `type_name` VARCHAR(150) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tags`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tags` ;

CREATE  TABLE IF NOT EXISTS `tags` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `tag_name` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL ,
  `tag_types_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `tag_types_id`) ,
  UNIQUE INDEX `tag_name` (`tag_name` ASC) ,
  INDEX `fk_tags_tag_types1` (`tag_types_id` ASC) ,
  CONSTRAINT `fk_tags_tag_types1`
    FOREIGN KEY (`tag_types_id` )
    REFERENCES `tag_types` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `things_tags_joins`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `things_tags_joins` ;

CREATE  TABLE IF NOT EXISTS `things_tags_joins` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `things_id` INT(11) NULL ,
  `tags_id` INT(11) NULL ,
  `users_id` INT(11) NOT NULL ,
  `originator` TINYINT(1) NULL DEFAULT 0 ,
  `anonymous` TINYINT(1) NULL DEFAULT 0 ,
  PRIMARY KEY (`id`, `things_id`, `tags_id`, `users_id`) ,
  INDEX `fk_connections_things1` (`things_id` ASC) ,
  INDEX `fk_connections_users1` (`users_id` ASC) ,
  INDEX `fk_connections_tags1` (`tags_id` ASC) ,
  CONSTRAINT `fk_connections_things1`
    FOREIGN KEY (`things_id` )
    REFERENCES `things` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_connections_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_connections_tags1`
    FOREIGN KEY (`tags_id` )
    REFERENCES `tags` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `login_attempts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `login_attempts` ;

CREATE  TABLE IF NOT EXISTS `login_attempts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `ip_address` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `login` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `thing_main_categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `thing_main_categories` ;

CREATE  TABLE IF NOT EXISTS `thing_main_categories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `category_name` VARCHAR(200) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `type_name` (`category_name` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `user_autologin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_autologin` ;

CREATE  TABLE IF NOT EXISTS `user_autologin` (
  `key_id` CHAR(32) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `user_id` INT(11) NOT NULL DEFAULT '0' ,
  `user_agent` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_ip` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_login` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`key_id`, `user_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `user_profiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_profiles` ;

CREATE  TABLE IF NOT EXISTS `user_profiles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `country` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `website` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `spectrum`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spectrum` ;

CREATE  TABLE IF NOT EXISTS `spectrum` (
  `id` INT NOT NULL ,
  `spectrum_value` INT NULL ,
  `tags_id` INT(11) NOT NULL ,
  `users_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`, `tags_id`, `users_id`) ,
  INDEX `fk_spectrum_tags1` (`tags_id` ASC) ,
  INDEX `fk_spectrum_users1` (`users_id` ASC) ,
  CONSTRAINT `fk_spectrum_tags1`
    FOREIGN KEY (`tags_id` )
    REFERENCES `tags` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_spectrum_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `person_info`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `person_info` ;

CREATE  TABLE IF NOT EXISTS `person_info` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `birth_date` DATETIME NOT NULL ,
  `birth_location` VARCHAR(200) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `category_thing_joins`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `category_thing_joins` ;

CREATE  TABLE IF NOT EXISTS `category_thing_joins` (
  `id` INT NOT NULL ,
  `things_id` INT(11) NOT NULL ,
  `thing_categories_id` INT(11) NOT NULL ,
  `person_info_id` INT(11) NOT NULL ,
  `users_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`, `things_id`, `thing_categories_id`, `person_info_id`, `users_id`) ,
  INDEX `fk_category_thing_joins_things1` (`things_id` ASC) ,
  INDEX `fk_category_thing_joins_thing_categories1` (`thing_categories_id` ASC) ,
  INDEX `fk_category_thing_joins_person_info1` (`person_info_id` ASC) ,
  INDEX `fk_category_thing_joins_users1` (`users_id` ASC) ,
  CONSTRAINT `fk_category_thing_joins_things1`
    FOREIGN KEY (`things_id` )
    REFERENCES `things` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_category_thing_joins_thing_categories1`
    FOREIGN KEY (`thing_categories_id` )
    REFERENCES `thing_main_categories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_category_thing_joins_person_info1`
    FOREIGN KEY (`person_info_id` )
    REFERENCES `person_info` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_category_thing_joins_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `user_suggestions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_suggestions` ;

CREATE  TABLE IF NOT EXISTS `user_suggestions` (
  `id` INT NOT NULL ,
  `things_id1` INT(11) NOT NULL ,
  `things_id2` INT(11) NOT NULL ,
  `users_id` INT(11) NOT NULL ,
  `originator` TINYINT(1) NULL DEFAULT 0 ,
  PRIMARY KEY (`id`, `users_id`, `things_id1`, `things_id2`) ,
  INDEX `fk_user_suggestions_things1` (`things_id2` ASC) ,
  INDEX `fk_user_suggestions_things2` (`things_id1` ASC) ,
  INDEX `fk_user_suggestions_users1` (`users_id` ASC) ,
  CONSTRAINT `fk_user_suggestions_things1`
    FOREIGN KEY (`things_id2` )
    REFERENCES `things` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_suggestions_things2`
    FOREIGN KEY (`things_id1` )
    REFERENCES `things` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_suggestions_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comments` ;

CREATE  TABLE IF NOT EXISTS `comments` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `users_id` INT(11) NOT NULL ,
  `things_id` INT(11) NOT NULL ,
  `tags_id` INT(11) NULL DEFAULT NULL ,
  `comment` VARCHAR(150) NOT NULL ,
  `created_ts` INT NULL ,
  `modified_ts` INT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`, `users_id`, `things_id`, `tags_id`) ,
  INDEX `fk_comments_users1` (`users_id` ASC) ,
  INDEX `fk_comments_things1` (`things_id` ASC) ,
  INDEX `fk_comments_tags1` (`tags_id` ASC) ,
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_things1`
    FOREIGN KEY (`things_id` )
    REFERENCES `things` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_tags1`
    FOREIGN KEY (`tags_id` )
    REFERENCES `tags` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

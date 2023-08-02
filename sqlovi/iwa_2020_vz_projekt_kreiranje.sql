-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema iwa_2020_vz_projekt
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema iwa_2020_vz_projekt
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `iwa_2020_vz_projekt` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `iwa_2020_vz_projekt` ;

-- -----------------------------------------------------
-- Table `iwa_2020_vz_projekt`.`tip_korisnika`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2020_vz_projekt`.`tip_korisnika` (
  `tip_korisnika_id` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`tip_korisnika_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2020_vz_projekt`.`korisnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2020_vz_projekt`.`korisnik` (
  `korisnik_id` INT NOT NULL AUTO_INCREMENT,
  `tip_korisnika_id` INT NOT NULL,
  `korisnicko_ime` VARCHAR(50) NOT NULL,
  `lozinka` VARCHAR(50) NOT NULL,
  `ime` VARCHAR(50) NOT NULL,
  `prezime` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `blokiran` INT(1) NOT NULL,
  `slika` TEXT NULL,
  PRIMARY KEY (`korisnik_id`),
  INDEX `fk_korisnik_tip_korisnika_idx` (`tip_korisnika_id` ASC),
  CONSTRAINT `fk_korisnik_tip_korisnika`
    FOREIGN KEY (`tip_korisnika_id`)
    REFERENCES `iwa_2020_vz_projekt`.`tip_korisnika` (`tip_korisnika_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2020_vz_projekt`.`planina`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2020_vz_projekt`.`planina` (
  `planina_id` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(100) NOT NULL,
  `opis` TEXT NOT NULL,
  `lokacija` TEXT NULL,
  `geografska_sirina` DOUBLE NULL,
  `geografska_duzina` DOUBLE NULL,
  PRIMARY KEY (`planina_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2020_vz_projekt`.`slika`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2020_vz_projekt`.`slika` (
  `slika_id` INT NOT NULL AUTO_INCREMENT,
  `planina_id` INT NOT NULL,
  `korisnik_id` INT NOT NULL,
  `naziv` VARCHAR(50) NOT NULL,
  `url` TEXT NOT NULL,
  `opis` TEXT NOT NULL,
  `datum_vrijeme_slikanja` TIMESTAMP NOT NULL,
  `status` INT(1) NOT NULL,
  PRIMARY KEY (`slika_id`),
  INDEX `fk_slika_korisnik1_idx` (`korisnik_id` ASC) ,
  INDEX `fk_slika_planina1_idx` (`planina_id` ASC) ,
  CONSTRAINT `fk_slika_korisnik1`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `iwa_2020_vz_projekt`.`korisnik` (`korisnik_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_slika_planina1`
    FOREIGN KEY (`planina_id`)
    REFERENCES `iwa_2020_vz_projekt`.`planina` (`planina_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'korisnik_korisnik_id';


-- -----------------------------------------------------
-- Table `iwa_2020_vz_projekt`.`moderator`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2020_vz_projekt`.`moderator` (
  `korisnik_id` INT NOT NULL,
  `planina_id` INT NOT NULL,
  PRIMARY KEY (`korisnik_id`, `planina_id`),
  INDEX `fk_korisnik_has_planina_planina1_idx` (`planina_id` ASC) ,
  INDEX `fk_korisnik_has_planina_korisnik1_idx` (`korisnik_id` ASC) ,
  CONSTRAINT `fk_korisnik_has_planina_korisnik1`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `iwa_2020_vz_projekt`.`korisnik` (`korisnik_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_korisnik_has_planina_planina1`
    FOREIGN KEY (`planina_id`)
    REFERENCES `iwa_2020_vz_projekt`.`planina` (`planina_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE USER 'iwa_2020'@'localhost' IDENTIFIED BY 'foi2020';

GRANT SELECT, INSERT, TRIGGER, UPDATE, DELETE ON TABLE `iwa_2020_vz_projekt`.* TO 'iwa_2020'@'localhost';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

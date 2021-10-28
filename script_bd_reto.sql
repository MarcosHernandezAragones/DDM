-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`preguntas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`preguntas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`preguntas` (
  `idPreguntas` INT NOT NULL AUTO_INCREMENT,
  `enunciado` VARCHAR(250) NOT NULL,
  `tipo` ENUM('rojo', 'verde', 'azul', 'amarillo') NOT NULL,
  PRIMARY KEY (`idPreguntas`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`centro`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`centro` ;

CREATE TABLE IF NOT EXISTS `mydb`.`centro` (
  `idCentro` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `ubicacion` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`idCentro`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`curso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`curso` ;

CREATE TABLE IF NOT EXISTS `mydb`.`curso` (
  `idCurso` INT NOT NULL AUTO_INCREMENT,
  `centro_idCentro` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCurso`, `centro_idCentro`),
  CONSTRAINT `fk_curso_centro1`
    FOREIGN KEY (`centro_idCentro`)
    REFERENCES `mydb`.`centro` (`idCentro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`grupo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`grupo` ;

CREATE TABLE IF NOT EXISTS `mydb`.`grupo` (
  `idGrupo` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(25) NULL,
  `curso_idCurso` INT NOT NULL,
  `curso_centro_idCentro` INT NOT NULL,
  PRIMARY KEY (`idGrupo`),
  INDEX `fk_grupo_curso1_idx` (`curso_idCurso` ASC, `curso_centro_idCentro` ASC) VISIBLE,
  CONSTRAINT `fk_grupo_curso1`
    FOREIGN KEY (`curso_idCurso` , `curso_centro_idCentro`)
    REFERENCES `mydb`.`curso` (`idCurso` , `centro_idCentro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`usuario` ;

CREATE TABLE IF NOT EXISTS `mydb`.`usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `DNI` VARCHAR(25) NOT NULL,
  `nombre` VARCHAR(30) NULL,
  `apellidos` VARCHAR(60) NULL,
  `password` VARCHAR(64) NULL,
  `correo` VARCHAR(100) NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE INDEX `idUsuario_UNIQUE` (`idUsuario` ASC) VISIBLE,
  UNIQUE INDEX `DNI_UNIQUE` (`DNI` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`alumno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`alumno` ;

CREATE TABLE IF NOT EXISTS `mydb`.`alumno` (
  `usuario_idUsuario` INT NOT NULL,
  `rojo` INT NULL,
  `verde` INT NULL,
  `azul` INT NULL,
  `amarillo` INT NULL,
  `grupo_idGrupo` INT NOT NULL,
  `curso_idCurso` INT NOT NULL,
  `curso_centro_idCentro` INT NOT NULL,
  PRIMARY KEY (`usuario_idUsuario`),
  INDEX `fk_alumno_grupo1_idx` (`grupo_idGrupo` ASC) VISIBLE,
  INDEX `fk_alumno_curso1_idx` (`curso_idCurso` ASC, `curso_centro_idCentro` ASC) VISIBLE,
  CONSTRAINT `fk_alumno_usuario1`
    FOREIGN KEY (`usuario_idUsuario`)
    REFERENCES `mydb`.`usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_alumno_grupo1`
    FOREIGN KEY (`grupo_idGrupo`)
    REFERENCES `mydb`.`grupo` (`idGrupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_alumno_curso1`
    FOREIGN KEY (`curso_idCurso` , `curso_centro_idCentro`)
    REFERENCES `mydb`.`curso` (`idCurso` , `centro_idCentro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`docente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`docente` ;

CREATE TABLE IF NOT EXISTS `mydb`.`docente` (
  `usuario_idUsuario` INT NOT NULL,
  `rol` ENUM('0', '1', '2') NOT NULL,
  `centro_idCentro` INT NOT NULL,
  PRIMARY KEY (`usuario_idUsuario`),
  INDEX `fk_docente_usuario_idx` (`usuario_idUsuario` ASC) VISIBLE,
  INDEX `fk_docente_centro1_idx` (`centro_idCentro` ASC) VISIBLE,
  CONSTRAINT `fk_docente_usuario`
    FOREIGN KEY (`usuario_idUsuario`)
    REFERENCES `mydb`.`usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_docente_centro1`
    FOREIGN KEY (`centro_idCentro`)
    REFERENCES `mydb`.`centro` (`idCentro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`alumno_has_preguntas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`alumno_has_preguntas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`alumno_has_preguntas` (
  `alumno_usuario_idUsuario` INT NOT NULL,
  `preguntas_idPreguntas` INT NOT NULL,
  `respuesta` INT NULL,
  PRIMARY KEY (`alumno_usuario_idUsuario`, `preguntas_idPreguntas`),
  INDEX `fk_alumno_has_preguntas_preguntas1_idx` (`preguntas_idPreguntas` ASC) VISIBLE,
  INDEX `fk_alumno_has_preguntas_alumno1_idx` (`alumno_usuario_idUsuario` ASC) VISIBLE,
  CONSTRAINT `fk_alumno_has_preguntas_alumno1`
    FOREIGN KEY (`alumno_usuario_idUsuario`)
    REFERENCES `mydb`.`alumno` (`usuario_idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_alumno_has_preguntas_preguntas1`
    FOREIGN KEY (`preguntas_idPreguntas`)
    REFERENCES `mydb`.`preguntas` (`idPreguntas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`curso_has_docente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`curso_has_docente` ;

CREATE TABLE IF NOT EXISTS `mydb`.`curso_has_docente` (
  `curso_idCurso` INT NOT NULL,
  `curso_centro_idCentro` INT NOT NULL,
  `docente_usuario_idUsuario` INT NOT NULL,
  PRIMARY KEY (`curso_idCurso`, `curso_centro_idCentro`, `docente_usuario_idUsuario`),
  INDEX `fk_curso_has_docente_docente1_idx` (`docente_usuario_idUsuario` ASC) VISIBLE,
  INDEX `fk_curso_has_docente_curso1_idx` (`curso_idCurso` ASC, `curso_centro_idCentro` ASC) VISIBLE,
  CONSTRAINT `fk_curso_has_docente_curso1`
    FOREIGN KEY (`curso_idCurso` , `curso_centro_idCentro`)
    REFERENCES `mydb`.`curso` (`idCurso` , `centro_idCentro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_curso_has_docente_docente1`
    FOREIGN KEY (`docente_usuario_idUsuario`)
    REFERENCES `mydb`.`docente` (`usuario_idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

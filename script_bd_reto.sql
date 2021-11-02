-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema reto
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `reto` ;

-- -----------------------------------------------------
-- Schema reto
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `reto` ;
USE `reto` ;

-- -----------------------------------------------------
-- Table `reto`.`tipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reto`.`tipo` ;

CREATE TABLE IF NOT EXISTS `reto`.`tipo` (
  `idTipo` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto`.`preguntas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reto`.`preguntas` ;

CREATE TABLE IF NOT EXISTS `reto`.`preguntas` (
  `idPreguntas` INT NOT NULL AUTO_INCREMENT,
  `enunciado` VARCHAR(200) NOT NULL,
  `explicacion` VARCHAR(200) NULL,
  `tipo_idTipo` INT NOT NULL,
  PRIMARY KEY (`idPreguntas`),
  INDEX `fk_preguntas_tipo1_idx` (`tipo_idTipo` ASC),
  CONSTRAINT `fk_preguntas_tipo1`
    FOREIGN KEY (`tipo_idTipo`)
    REFERENCES `reto`.`tipo` (`idTipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto`.`centro`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reto`.`centro` ;

CREATE TABLE IF NOT EXISTS `reto`.`centro` (
  `idCentro` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `ubicacion` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`idCentro`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto`.`curso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reto`.`curso` ;

CREATE TABLE IF NOT EXISTS `reto`.`curso` (
  `idCurso` INT NOT NULL AUTO_INCREMENT,
  `centro_idCentro` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCurso`, `centro_idCentro`),
  CONSTRAINT `fk_curso_centro1`
    FOREIGN KEY (`centro_idCentro`)
    REFERENCES `reto`.`centro` (`idCentro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto`.`grupo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reto`.`grupo` ;

CREATE TABLE IF NOT EXISTS `reto`.`grupo` (
  `idGrupo` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(25) NULL,
  `curso_idCurso` INT NOT NULL,
  `curso_centro_idCentro` INT NOT NULL,
  PRIMARY KEY (`idGrupo`),
  INDEX `fk_grupo_curso1_idx` (`curso_idCurso` ASC, `curso_centro_idCentro` ASC),
  CONSTRAINT `fk_grupo_curso1`
    FOREIGN KEY (`curso_idCurso` , `curso_centro_idCentro`)
    REFERENCES `reto`.`curso` (`idCurso` , `centro_idCentro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reto`.`usuario` ;

CREATE TABLE IF NOT EXISTS `reto`.`usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `DNI` VARCHAR(25) NOT NULL,
  `nombre` VARCHAR(30) NULL,
  `apellidos` VARCHAR(60) NULL,
  `password` VARCHAR(64) NULL,
  `correo` VARCHAR(100) NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE INDEX `idUsuario_UNIQUE` (`idUsuario` ASC),
  UNIQUE INDEX `DNI_UNIQUE` (`DNI` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto`.`alumno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reto`.`alumno` ;

CREATE TABLE IF NOT EXISTS `reto`.`alumno` (
  `usuario_idUsuario` INT NOT NULL,
  `rojo` INT NULL,
  `verde` INT NULL,
  `azul` INT NULL,
  `amarillo` INT NULL,
  `grupo_idGrupo` INT NOT NULL,
  `curso_idCurso` INT NOT NULL,
  `curso_centro_idCentro` INT NOT NULL,
  PRIMARY KEY (`usuario_idUsuario`),
  INDEX `fk_alumno_grupo1_idx` (`grupo_idGrupo` ASC),
  INDEX `fk_alumno_curso1_idx` (`curso_idCurso` ASC, `curso_centro_idCentro` ASC),
  CONSTRAINT `fk_alumno_usuario1`
    FOREIGN KEY (`usuario_idUsuario`)
    REFERENCES `reto`.`usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_alumno_grupo1`
    FOREIGN KEY (`grupo_idGrupo`)
    REFERENCES `reto`.`grupo` (`idGrupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_alumno_curso1`
    FOREIGN KEY (`curso_idCurso` , `curso_centro_idCentro`)
    REFERENCES `reto`.`curso` (`idCurso` , `centro_idCentro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto`.`rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reto`.`rol` ;

CREATE TABLE IF NOT EXISTS `reto`.`rol` (
  `idRol` INT NOT NULL AUTO_INCREMENT,
  `rol` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`idRol`),
  UNIQUE INDEX `rol_UNIQUE` (`rol` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto`.`docente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reto`.`docente` ;

CREATE TABLE IF NOT EXISTS `reto`.`docente` (
  `usuario_idUsuario` INT NOT NULL,
  `centro_idCentro` INT NOT NULL,
  `rol_idRol` INT NOT NULL,
  PRIMARY KEY (`usuario_idUsuario`),
  INDEX `fk_docente_usuario_idx` (`usuario_idUsuario` ASC),
  INDEX `fk_docente_centro1_idx` (`centro_idCentro` ASC),
  INDEX `fk_docente_rol1_idx` (`rol_idRol` ASC),
  CONSTRAINT `fk_docente_usuario`
    FOREIGN KEY (`usuario_idUsuario`)
    REFERENCES `reto`.`usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_docente_centro1`
    FOREIGN KEY (`centro_idCentro`)
    REFERENCES `reto`.`centro` (`idCentro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_docente_rol1`
    FOREIGN KEY (`rol_idRol`)
    REFERENCES `reto`.`rol` (`idRol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto`.`alumno_has_preguntas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reto`.`alumno_has_preguntas` ;

CREATE TABLE IF NOT EXISTS `reto`.`alumno_has_preguntas` (
  `alumno_usuario_idUsuario` INT NOT NULL,
  `preguntas_idPreguntas` INT NOT NULL,
  `respuesta` INT NULL,
  PRIMARY KEY (`alumno_usuario_idUsuario`, `preguntas_idPreguntas`),
  INDEX `fk_alumno_has_preguntas_preguntas1_idx` (`preguntas_idPreguntas` ASC),
  INDEX `fk_alumno_has_preguntas_alumno1_idx` (`alumno_usuario_idUsuario` ASC),
  CONSTRAINT `fk_alumno_has_preguntas_alumno1`
    FOREIGN KEY (`alumno_usuario_idUsuario`)
    REFERENCES `reto`.`alumno` (`usuario_idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_alumno_has_preguntas_preguntas1`
    FOREIGN KEY (`preguntas_idPreguntas`)
    REFERENCES `reto`.`preguntas` (`idPreguntas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto`.`curso_has_docente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reto`.`curso_has_docente` ;

CREATE TABLE IF NOT EXISTS `reto`.`curso_has_docente` (
  `curso_idCurso` INT NOT NULL,
  `curso_centro_idCentro` INT NOT NULL,
  `docente_usuario_idUsuario` INT NOT NULL,
  PRIMARY KEY (`curso_idCurso`, `curso_centro_idCentro`, `docente_usuario_idUsuario`),
  INDEX `fk_curso_has_docente_docente1_idx` (`docente_usuario_idUsuario` ASC),
  INDEX `fk_curso_has_docente_curso1_idx` (`curso_idCurso` ASC, `curso_centro_idCentro` ASC),
  CONSTRAINT `fk_curso_has_docente_curso1`
    FOREIGN KEY (`curso_idCurso` , `curso_centro_idCentro`)
    REFERENCES `reto`.`curso` (`idCurso` , `centro_idCentro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_curso_has_docente_docente1`
    FOREIGN KEY (`docente_usuario_idUsuario`)
    REFERENCES `reto`.`docente` (`usuario_idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

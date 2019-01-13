-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema administracion_colegio
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `administracion_colegio` ;

-- -----------------------------------------------------
-- Schema administracion_colegio
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `administracion_colegio` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `administracion_colegio` ;

-- -----------------------------------------------------
-- Table `administracion_colegio`.`actividad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`actividad` (
  `id_Actividad` INT(11) NOT NULL,
  `dia` INT(11) NOT NULL,
  `mes` INT(11) NOT NULL,
  `año` INT(11) NOT NULL,
  `descripcion` VARCHAR(75) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `lugar` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `hora` DATETIME NOT NULL,
  `duración` TIME NOT NULL,
  PRIMARY KEY (`id_Actividad`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`estados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`estados` (
  `estado_id` INT(11) NOT NULL,
  `nombre` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  PRIMARY KEY (`estado_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`nivel_educacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`nivel_educacion` (
  `nivel_id` INT(11) NOT NULL,
  `nombre` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `descripcion` VARCHAR(100) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  PRIMARY KEY (`nivel_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`periodo_electivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`periodo_electivo` (
  `periodo_id` INT(11) NOT NULL,
  `anio_inicio` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `anio_fin` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `estado_id` INT(11) NOT NULL,
  `fecha_inicio_periodo` DATE NOT NULL,
  `fecha_fin_periodo` DATE NOT NULL,
  PRIMARY KEY (`periodo_id`),
  INDEX `estado_id` (`estado_id` ASC) VISIBLE,
  CONSTRAINT `periodo_electivo_ibfk_1`
    FOREIGN KEY (`estado_id`)
    REFERENCES `administracion_colegio`.`estados` (`estado_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`generos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`generos` (
  `genero_id` INT(11) NOT NULL,
  `sexo` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  PRIMARY KEY (`genero_id`),
  INDEX `genero_id` (`genero_id` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`estado_civil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`estado_civil` (
  `estado_civil_id` INT(11) NOT NULL,
  `descripcion` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  PRIMARY KEY (`estado_civil_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`personal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`personal` (
  `personal_id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `apellidos` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `especialidad_id` INT(11) NOT NULL,
  `telefono` VARCHAR(20) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `mail` VARCHAR(100) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `fecha_creacion` DATE NOT NULL,
  `usuario_creacion` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `genero_id` INT(11) NOT NULL,
  `estado_civil_id` INT(11) NOT NULL,
  `direccion` VARCHAR(200) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `fechaNac` DATE NOT NULL,
  `fechaLaboral` DATE NOT NULL,
  `aniosExperiencia` INT(11) NOT NULL,
  `cargas` INT(11) NOT NULL,
  `curriculum_direccion` VARCHAR(200) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `usuario_id` INT(11) NOT NULL,
  `foto` BLOB NOT NULL,
  `cedula` VARCHAR(10) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  PRIMARY KEY (`personal_id`),
  UNIQUE INDEX `cedula` (`cedula` ASC) VISIBLE,
  INDEX `genero_id` (`genero_id` ASC) VISIBLE,
  INDEX `estado_civil_id` (`estado_civil_id` ASC) VISIBLE,
  CONSTRAINT `personal_ibfk_1`
    FOREIGN KEY (`genero_id`)
    REFERENCES `administracion_colegio`.`generos` (`genero_id`),
  CONSTRAINT `personal_ibfk_2`
    FOREIGN KEY (`estado_civil_id`)
    REFERENCES `administracion_colegio`.`estado_civil` (`estado_civil_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`cursos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`cursos` (
  `curso_id` INT(11) NOT NULL,
  `nombre` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `jornada` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `cant_alumnos` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `paralelo` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `estado_id` INT(11) NOT NULL,
  `nivel_id` INT(11) NOT NULL,
  `usuario_creacion` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `fecha_creacion` DATE NOT NULL,
  `dirigente` INT(11) NOT NULL,
  `periodo_electivo_periodo_id` INT(11) NOT NULL,
  PRIMARY KEY (`curso_id`),
  INDEX `estado_id` (`estado_id` ASC) VISIBLE,
  INDEX `nivel_id` (`nivel_id` ASC) VISIBLE,
  INDEX `periodo_electivo_periodo_id` (`periodo_electivo_periodo_id` ASC) VISIBLE,
  INDEX `dirigente` (`dirigente` ASC) VISIBLE,
  CONSTRAINT `cursos_ibfk_1`
    FOREIGN KEY (`estado_id`)
    REFERENCES `administracion_colegio`.`estados` (`estado_id`),
  CONSTRAINT `cursos_ibfk_2`
    FOREIGN KEY (`nivel_id`)
    REFERENCES `administracion_colegio`.`nivel_educacion` (`nivel_id`),
  CONSTRAINT `cursos_ibfk_3`
    FOREIGN KEY (`periodo_electivo_periodo_id`)
    REFERENCES `administracion_colegio`.`periodo_electivo` (`periodo_id`),
  CONSTRAINT `cursos_ibfk_4`
    FOREIGN KEY (`dirigente`)
    REFERENCES `administracion_colegio`.`personal` (`personal_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`actividad_curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`actividad_curso` (
  `id_Actividad_curso` INT(11) NOT NULL,
  `dia` INT(11) NOT NULL,
  `mes` INT(11) NOT NULL,
  `año` INT(11) NOT NULL,
  `descripcion` VARCHAR(75) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `lugar` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `hora` DATETIME NOT NULL,
  `duración` TIME NOT NULL,
  `curso_id` INT(11) NOT NULL,
  PRIMARY KEY (`id_Actividad_curso`),
  INDEX `curso_id` (`curso_id` ASC) VISIBLE,
  CONSTRAINT `actividad_curso_ibfk_1`
    FOREIGN KEY (`curso_id`)
    REFERENCES `administracion_colegio`.`cursos` (`curso_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`mensaje`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`mensaje` (
  `id_mensaje` INT(11) NOT NULL,
  `asunto` VARCHAR(35) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `contenido` VARCHAR(200) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `fecha` DATETIME NOT NULL,
  `tipo` VARCHAR(25) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  PRIMARY KEY (`id_mensaje`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`adjunto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`adjunto` (
  `id_documento` INT(11) NOT NULL,
  `link` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `nombre` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `mensaje_id` INT(11) NOT NULL,
  PRIMARY KEY (`id_documento`),
  INDEX `mensaje_id` (`mensaje_id` ASC) VISIBLE,
  CONSTRAINT `adjunto_ibfk_1`
    FOREIGN KEY (`mensaje_id`)
    REFERENCES `administracion_colegio`.`mensaje` (`id_mensaje`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`usuario` (
  `usuario` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `clave` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `tipo` VARCHAR(2) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `usuario_id` INT(11) NOT NULL AUTO_INCREMENT,
  `estado_id` INT(11) NOT NULL,
  PRIMARY KEY (`usuario_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`administrador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`administrador` (
  `admin_id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `apellido` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `correo` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `foto` BLOB NULL,
  `cedula` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `usuarios_usuario_id` INT(11) NOT NULL,
  PRIMARY KEY (`admin_id`),
  INDEX `usuarios_usuario_id` (`usuarios_usuario_id` ASC) VISIBLE,
  CONSTRAINT `administrador_ibfk_1`
    FOREIGN KEY (`usuarios_usuario_id`)
    REFERENCES `administracion_colegio`.`usuario` (`usuario_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`instituciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`instituciones` (
  `institucion_id` INT(11) NOT NULL,
  `nombre` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  PRIMARY KEY (`institucion_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`lugares`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`lugares` (
  `lugar_id` INT(11) NOT NULL,
  `provincia` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `ciudad` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  PRIMARY KEY (`lugar_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`alumno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`alumno` (
  `cedula` VARCHAR(20) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `nombres` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `apellidos` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `genero_id` INT(11) NOT NULL,
  `direccion` VARCHAR(100) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  `lugar_id` INT(11) NOT NULL,
  `foto_direccion` VARCHAR(255) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `fecha_creacion` DATE NOT NULL,
  `usuario_creacion` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `estado_id` INT(11) NOT NULL,
  `instituciones_id` INT(11) NOT NULL,
  `observacion` VARCHAR(250) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `pension` DOUBLE NOT NULL,
  `cursos_curso_id` INT(11) NOT NULL,
  PRIMARY KEY (`cedula`),
  INDEX `instituciones_id` (`instituciones_id` ASC) VISIBLE,
  INDEX `lugar_id` (`lugar_id` ASC) VISIBLE,
  INDEX `genero_id` (`genero_id` ASC) VISIBLE,
  CONSTRAINT `alumno_ibfk_1`
    FOREIGN KEY (`instituciones_id`)
    REFERENCES `administracion_colegio`.`instituciones` (`institucion_id`),
  CONSTRAINT `alumno_ibfk_2`
    FOREIGN KEY (`lugar_id`)
    REFERENCES `administracion_colegio`.`lugares` (`lugar_id`),
  CONSTRAINT `alumno_ibfk_3`
    FOREIGN KEY (`genero_id`)
    REFERENCES `administracion_colegio`.`generos` (`genero_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`autorizado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`autorizado` (
  `nombre` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `apellido` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `direccion` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `telefono` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `correo` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `estado_civil_id` INT(11) NOT NULL,
  `genero_id` INT(11) NOT NULL,
  `cedula` VARCHAR(12) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `usuario_id` INT(11) NOT NULL,
  `foto` BLOB NOT NULL,
  `fechaNac` DATE NOT NULL,
  PRIMARY KEY (`cedula`),
  INDEX `genero_id` (`genero_id` ASC) VISIBLE,
  INDEX `estado_civil_id` (`estado_civil_id` ASC) VISIBLE,
  INDEX `usuario_id` (`usuario_id` ASC) VISIBLE,
  CONSTRAINT `autorizado_ibfk_1`
    FOREIGN KEY (`genero_id`)
    REFERENCES `administracion_colegio`.`generos` (`genero_id`),
  CONSTRAINT `autorizado_ibfk_2`
    FOREIGN KEY (`estado_civil_id`)
    REFERENCES `administracion_colegio`.`estado_civil` (`estado_civil_id`),
  CONSTRAINT `autorizado_ibfk_3`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `administracion_colegio`.`usuario` (`usuario_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`parentesco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`parentesco` (
  `idparentesco` INT(11) NOT NULL,
  `parentesco` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  PRIMARY KEY (`idparentesco`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`autorizacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`autorizacion` (
  `idautorizacion` INT(11) NOT NULL,
  `tipo` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `alumno_cedula` VARCHAR(20) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `parentesco_id` INT(11) NOT NULL,
  `autorizado_cedula` VARCHAR(12) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  PRIMARY KEY (`idautorizacion`),
  INDEX `autorizado_cedula` (`autorizado_cedula` ASC) VISIBLE,
  INDEX `alumno_cedula` (`alumno_cedula` ASC) VISIBLE,
  INDEX `parentesco_id` (`parentesco_id` ASC) VISIBLE,
  CONSTRAINT `autorizacion_ibfk_1`
    FOREIGN KEY (`autorizado_cedula`)
    REFERENCES `administracion_colegio`.`autorizado` (`cedula`),
  CONSTRAINT `autorizacion_ibfk_2`
    FOREIGN KEY (`alumno_cedula`)
    REFERENCES `administracion_colegio`.`alumno` (`cedula`),
  CONSTRAINT `autorizacion_ibfk_3`
    FOREIGN KEY (`parentesco_id`)
    REFERENCES `administracion_colegio`.`parentesco` (`idparentesco`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`citacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`citacion` (
  `id_citacion` INT(11) NOT NULL,
  `fecha` DATE NOT NULL,
  `duración` TIME NOT NULL,
  `hora` TIMESTAMP(5) NOT NULL DEFAULT CURRENT_TIMESTAMP(5) ON UPDATE CURRENT_TIMESTAMP(5),
  PRIMARY KEY (`id_citacion`),
  CONSTRAINT `citacion_ibfk_1`
    FOREIGN KEY (`id_citacion`)
    REFERENCES `administracion_colegio`.`mensaje` (`id_mensaje`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`grupo_sanguineo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`grupo_sanguineo` (
  `idgrupo_sanguineo` INT(11) NOT NULL,
  `nombre` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  PRIMARY KEY (`idgrupo_sanguineo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`datos_medicos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`datos_medicos` (
  `tiene_discapacidad` TINYINT(4) NOT NULL,
  `porcentaje_discapacidad` INT(11) NOT NULL,
  `tipo_discapacidad` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `alumnos_cedula` VARCHAR(20) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `idgrupo_sanguuineo` INT(11) NOT NULL,
  PRIMARY KEY (`alumnos_cedula`),
  INDEX `idgrupo_sanguuineo` (`idgrupo_sanguuineo` ASC) VISIBLE,
  CONSTRAINT `datos_medicos_ibfk_1`
    FOREIGN KEY (`alumnos_cedula`)
    REFERENCES `administracion_colegio`.`alumno` (`cedula`),
  CONSTRAINT `datos_medicos_ibfk_2`
    FOREIGN KEY (`idgrupo_sanguuineo`)
    REFERENCES `administracion_colegio`.`grupo_sanguineo` (`idgrupo_sanguineo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`materia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`materia` (
  `id_materia` INT(11) NOT NULL,
  `imagen` BLOB NOT NULL,
  `descripcion` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `nombre` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  PRIMARY KEY (`id_materia`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`detalle_materia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`detalle_materia` (
  `id_detalle_materia` INT(11) NOT NULL,
  `materia_id` INT(11) NOT NULL,
  `personal_personal_id` INT(11) NOT NULL,
  `cursos_curso_id` INT(11) NOT NULL,
  PRIMARY KEY (`id_detalle_materia`),
  INDEX `cursos_curso_id` (`cursos_curso_id` ASC) VISIBLE,
  INDEX `personal_personal_id` (`personal_personal_id` ASC) VISIBLE,
  INDEX `materia_id` (`materia_id` ASC) VISIBLE,
  CONSTRAINT `detalle_materia_ibfk_1`
    FOREIGN KEY (`cursos_curso_id`)
    REFERENCES `administracion_colegio`.`cursos` (`curso_id`),
  CONSTRAINT `detalle_materia_ibfk_2`
    FOREIGN KEY (`personal_personal_id`)
    REFERENCES `administracion_colegio`.`personal` (`personal_id`),
  CONSTRAINT `detalle_materia_ibfk_3`
    FOREIGN KEY (`materia_id`)
    REFERENCES `administracion_colegio`.`materia` (`id_materia`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`factura` (
  `factura_id` INT(11) NOT NULL,
  `n_factura` INT(11) NOT NULL,
  `orden_pago__id` INT(11) NOT NULL,
  `modo_pago_id` INT(11) NOT NULL,
  `fecha_pago` DATE NOT NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`horario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`horario` (
  `id_horario` INT(11) NOT NULL,
  `dia` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `hora_inicio` TIME NOT NULL,
  `hora_fin` TIME NOT NULL,
  `detalle_materia_id_detalle_materia` INT(11) NOT NULL,
  PRIMARY KEY (`id_horario`),
  INDEX `detalle_materia_id_detalle_materia` (`detalle_materia_id_detalle_materia` ASC) VISIBLE,
  CONSTRAINT `horario_ibfk_1`
    FOREIGN KEY (`detalle_materia_id_detalle_materia`)
    REFERENCES `administracion_colegio`.`detalle_materia` (`id_detalle_materia`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`mensaje_autorizado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`mensaje_autorizado` (
  `id_mensaje_autorizado` INT(11) NOT NULL,
  `id_mensaje` INT(11) NOT NULL,
  `cedula_autorizado` VARCHAR(12) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `cedula_alumno` VARCHAR(20) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `profesor_id` INT(11) NOT NULL,
  PRIMARY KEY (`id_mensaje_autorizado`),
  INDEX `cedula_autorizado` (`cedula_autorizado` ASC) VISIBLE,
  INDEX `id_mensaje` (`id_mensaje` ASC) VISIBLE,
  INDEX `cedula_alumno` (`cedula_alumno` ASC) VISIBLE,
  INDEX `profesor_id` (`profesor_id` ASC) VISIBLE,
  CONSTRAINT `mensaje_autorizado_ibfk_1`
    FOREIGN KEY (`cedula_autorizado`)
    REFERENCES `administracion_colegio`.`autorizado` (`cedula`),
  CONSTRAINT `mensaje_autorizado_ibfk_2`
    FOREIGN KEY (`id_mensaje`)
    REFERENCES `administracion_colegio`.`mensaje` (`id_mensaje`),
  CONSTRAINT `mensaje_autorizado_ibfk_3`
    FOREIGN KEY (`cedula_alumno`)
    REFERENCES `administracion_colegio`.`alumno` (`cedula`),
  CONSTRAINT `mensaje_autorizado_ibfk_4`
    FOREIGN KEY (`profesor_id`)
    REFERENCES `administracion_colegio`.`personal` (`personal_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`mensaje_curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`mensaje_curso` (
  `id_mensaje_curso` INT(11) NOT NULL,
  `profesor` INT(11) NOT NULL,
  `mensaje` INT(11) NOT NULL,
  PRIMARY KEY (`id_mensaje_curso`),
  INDEX `mensaje` (`mensaje` ASC) VISIBLE,
  INDEX `profesor` (`profesor` ASC) VISIBLE,
  CONSTRAINT `mensaje_curso_ibfk_1`
    FOREIGN KEY (`mensaje`)
    REFERENCES `administracion_colegio`.`mensaje` (`id_mensaje`),
  CONSTRAINT `mensaje_curso_ibfk_2`
    FOREIGN KEY (`profesor`)
    REFERENCES `administracion_colegio`.`personal` (`personal_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`noticias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`noticias` (
  `noticia_id` INT(11) NOT NULL,
  `titulo` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `descripcion` TEXT CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `foto` BLOB NOT NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`noticia_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `administracion_colegio`.`telefonos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administracion_colegio`.`telefonos` (
  `cedula` VARCHAR(12) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `telefono` VARCHAR(20) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  PRIMARY KEY (`cedula`, `telefono`),
  CONSTRAINT `telefonos_ibfk_1`
    FOREIGN KEY (`cedula`)
    REFERENCES `administracion_colegio`.`autorizado` (`cedula`),
  CONSTRAINT `telefonos_ibfk_2`
    FOREIGN KEY (`cedula`)
    REFERENCES `administracion_colegio`.`personal` (`cedula`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

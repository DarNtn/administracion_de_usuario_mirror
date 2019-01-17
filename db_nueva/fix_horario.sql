-- MySQL Workbench Synchronization
-- Generated: 2018-12-28 16:56
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: DarNtn

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `administracion_colegio`.`detalle_materia` 
DROP FOREIGN KEY `detalle_materia_ibfk_1`,
DROP FOREIGN KEY `detalle_materia_ibfk_2`,
DROP FOREIGN KEY `detalle_materia_ibfk_3`;

-- EN DETALLE_MATERIA Y EN HORARIO SETEAR EL ON-DELETE DE LOS FOREIGN KEYS

ALTER TABLE `administracion_colegio`.`detalle_materia` 
CHANGE COLUMN `materia_id` `id_materia` INT(11) NOT NULL ,
CHANGE COLUMN `personal_personal_id` `id_profesor` INT(11) NOT NULL ,
CHANGE COLUMN `cursos_curso_id` `id_curso` INT(11) NOT NULL ;

ALTER TABLE `administracion_colegio`.`detalle_materia` 
ADD CONSTRAINT `detalle_materia_ibfk_1`
  FOREIGN KEY (`id_curso`)
  REFERENCES `administracion_colegio`.`cursos` (`curso_id`),
ADD CONSTRAINT `detalle_materia_ibfk_2`
  FOREIGN KEY (`id_profesor`)
  REFERENCES `administracion_colegio`.`personal` (`personal_id`),
ADD CONSTRAINT `detalle_materia_ibfk_3`
  FOREIGN KEY (`id_materia`)
  REFERENCES `administracion_colegio`.`materia` (`id_materia`);
  
  
ALTER TABLE `administracion_colegio`.`horario` 
CHANGE COLUMN `id_horario` `id_horario` INT(11) NOT NULL AUTO_INCREMENT ;  
  
ALTER TABLE `administracion_colegio`.`horario` 
DROP FOREIGN KEY `horario_ibfk_1`;

ALTER TABLE `administracion_colegio`.`horario` 
CHANGE COLUMN `detalle_materia_id_detalle_materia` `id_detalle_materia` INT(11) NOT NULL ;

ALTER TABLE `administracion_colegio`.`horario` 
ADD CONSTRAINT `horario_ibfk_1`
  FOREIGN KEY (`id_detalle_materia`)
  REFERENCES `administracion_colegio`.`detalle_materia` (`id_detalle_materia`);

-- Personal
ALTER TABLE `administracion_colegio`.`personal` 
DROP FOREIGN KEY `personal_ibfk_3`;

ALTER TABLE `administracion_colegio`.`personal` 
CHANGE COLUMN `personal_id` `personal_id` INT(11) NOT NULL AUTO_INCREMENT ;

ALTER TABLE `administracion_colegio`.`personal` 
CHANGE COLUMN `fecha_creacion` `fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
CHANGE COLUMN `usuario_creacion` `usuario_creacion` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL DEFAULT 'Admin' ,
CHANGE COLUMN `foto` `foto` BLOB NULL DEFAULT NULL ;

ALTER TABLE `administracion_colegio`.`personal` 
ADD CONSTRAINT `personal_ibfk_3`
  FOREIGN KEY (`usuario_id`)
  REFERENCES `administracion_colegio`.`usuario` (`usuario_id`)
  ON DELETE CASCADE
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
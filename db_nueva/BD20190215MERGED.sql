CREATE DATABASE  IF NOT EXISTS `administracion_colegio` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `administracion_colegio`;
-- MySQL dump 10.13  Distrib 8.0.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: administracion_colegio
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `actividad`
--

DROP TABLE IF EXISTS `actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `actividad` (
  `id_Actividad` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `año` int(11) NOT NULL,
  `descripcion` varchar(75) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `lugar` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `hora` datetime NOT NULL,
  `duración` time NOT NULL,
  PRIMARY KEY (`id_Actividad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividad`
--

LOCK TABLES `actividad` WRITE;
/*!40000 ALTER TABLE `actividad` DISABLE KEYS */;
/*!40000 ALTER TABLE `actividad` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `actividades`
--
--  NUEVO

DROP TABLE IF EXISTS `actividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actividades` (
  `id_actividad` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `descripcion` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `color` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_reg` timestamp NULL DEFAULT current_timestamp(),
  `fecha_mod` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_estado` int(11) DEFAULT NULL,
  `id_user_reg` int(11) DEFAULT NULL,
  `tipo_actividad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_actividad`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `actividad_curso`
--

DROP TABLE IF EXISTS `actividad_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `actividad_curso` (
  `id_Actividad_curso` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `año` int(11) NOT NULL,
  `descripcion` varchar(75) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `lugar` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `hora` datetime NOT NULL,
  `duración` time NOT NULL,
  `curso_id` int(11) NOT NULL,
  PRIMARY KEY (`id_Actividad_curso`),
  KEY `curso_id` (`curso_id`),
  CONSTRAINT `actividad_curso_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`curso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividad_curso`
--

LOCK TABLES `actividad_curso` WRITE;
/*!40000 ALTER TABLE `actividad_curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `actividad_curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adjunto`
--

DROP TABLE IF EXISTS `adjunto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `adjunto` (
  `id_documento` int(11) NOT NULL,
  `link` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `mensaje_id` int(11) NOT NULL,
  PRIMARY KEY (`id_documento`),
  KEY `mensaje_id` (`mensaje_id`),
  CONSTRAINT `adjunto_ibfk_1` FOREIGN KEY (`mensaje_id`) REFERENCES `mensaje` (`id_mensaje`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adjunto`
--

LOCK TABLES `adjunto` WRITE;
/*!40000 ALTER TABLE `adjunto` DISABLE KEYS */;
/*!40000 ALTER TABLE `adjunto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `administrador` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `apellido` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `correo` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `foto` blob NULL DEFAULT NULL,
  `cedula` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `usuarios_usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `usuarios_usuario_id` (`usuarios_usuario_id`),
  CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`usuarios_usuario_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` VALUES (100,'Administrador','','',NULL,'0987654321',1);
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `alumno` (
  `cedula` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `nombres` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `apellidos` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `genero_id` int(11) NOT NULL,
  `direccion` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `lugar_id` int(11) NOT NULL,
  `foto_direccion` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `usuario_creacion` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `estado_id` int(11) NOT NULL,
  `instituciones_id` int(11) NOT NULL,
  `observacion` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `pension` double NOT NULL,
  `curso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cedula`),
  KEY `instituciones_id` (`instituciones_id`),
  KEY `lugar_id` (`lugar_id`),
  KEY `genero_id` (`genero_id`),
  KEY `alumno_ibfk_4_idx` (`curso_id`),
  CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`instituciones_id`) REFERENCES `instituciones` (`institucion_id`),
  CONSTRAINT `alumno_ibfk_2` FOREIGN KEY (`lugar_id`) REFERENCES `lugares` (`lugar_id`),
  CONSTRAINT `alumno_ibfk_3` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`genero_id`),
  CONSTRAINT `alumno_ibfk_4` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`curso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno`
--

LOCK TABLES `alumno` WRITE;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
INSERT INTO `alumno` VALUES ('0987651234','Jaime David','Perez Chica',1,'-','2003-01-12',88,'','2019-01-15','admin',1,3,'..',230,2),('0987654321','Alumno nombre','Alumno apellido',1,'-','2003-01-12',88,'','2019-01-15','admin',1,3,'..',230,1);
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `autorizacion`
--

DROP TABLE IF EXISTS `autorizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `autorizacion` (
  `idautorizacion` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `alumno_cedula` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `parentesco_id` int(11) NOT NULL,
  `autorizado_cedula` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`idautorizacion`),
  KEY `autorizado_cedula` (`autorizado_cedula`),
  KEY `alumno_cedula` (`alumno_cedula`),
  KEY `parentesco_id` (`parentesco_id`),
  CONSTRAINT `autorizacion_ibfk_1` FOREIGN KEY (`autorizado_cedula`) REFERENCES `autorizado` (`cedula`),
  CONSTRAINT `autorizacion_ibfk_2` FOREIGN KEY (`alumno_cedula`) REFERENCES `alumno` (`cedula`),
  CONSTRAINT `autorizacion_ibfk_3` FOREIGN KEY (`parentesco_id`) REFERENCES `parentesco` (`idparentesco`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autorizacion`
--

LOCK TABLES `autorizacion` WRITE;
/*!40000 ALTER TABLE `autorizacion` DISABLE KEYS */;
INSERT INTO `autorizacion` VALUES (1,'Representante','0987654321',1,'0930703707');
/*!40000 ALTER TABLE `autorizacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `autorizado`
--

DROP TABLE IF EXISTS `autorizado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `autorizado` (
  `nombre` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `apellido` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `correo` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `estado_civil_id` int(11) NOT NULL,
  `genero_id` int(11) NOT NULL,
  `cedula` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `foto` blob DEFAULT NULL,
  `fechaNac` date NOT NULL,
  PRIMARY KEY (`cedula`),
  KEY `genero_id` (`genero_id`),
  KEY `estado_civil_id` (`estado_civil_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `autorizado_ibfk_1` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`genero_id`),
  CONSTRAINT `autorizado_ibfk_2` FOREIGN KEY (`estado_civil_id`) REFERENCES `estado_civil` (`estado_civil_id`),
  CONSTRAINT `autorizado_ibfk_3` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autorizado`
--

LOCK TABLES `autorizado` WRITE;
/*!40000 ALTER TABLE `autorizado` DISABLE KEYS */;
INSERT INTO `autorizado` VALUES ('Tio Nombre','Tio Apellido','Km 4 vía a Samborondón','249853','prueba@example.com',1,1,'0909187148',15,NULL,'1999-10-11'),('Padre Name','Padre Apellido','Km 4 vía a Samborondón','3456785','prueba@example.com',2,1,'0930703707',NULL,NULL,'1982-10-11'),('Nombre Madre','Apellido Madre','direccion','2345678','email@example.com',2,2,'0950078105',NULL,NULL,'1982-10-05');
/*!40000 ALTER TABLE `autorizado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citacion`
--

DROP TABLE IF EXISTS `citacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `citacion` (
  `id_citacion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `duración` time NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id_citacion`),
  CONSTRAINT `citacion_ibfk_1` FOREIGN KEY (`id_citacion`) REFERENCES `mensaje` (`id_mensaje`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citacion`
--

LOCK TABLES `citacion` WRITE;
/*!40000 ALTER TABLE `citacion` DISABLE KEYS */;
INSERT INTO `citacion` VALUES (1,'2019-02-14','02:00:00','08:30:00');
/*!40000 ALTER TABLE `citacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cursos` (
  `curso_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `jornada` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `cant_alumnos` int NOT NULL,
  `paralelo` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `estado_id` int(11) NOT NULL,
  `nivel_id` int(11) NOT NULL,
  `usuario_creacion` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL,
  `fecha_creacion` date NOT NULL,
  `dirigente` int(11) DEFAULT NULL,
  `periodo_electivo_periodo_id` int(11) NOT NULL,
  PRIMARY KEY (`curso_id`),
  KEY `estado_id` (`estado_id`),
  KEY `nivel_id` (`nivel_id`),
  KEY `periodo_electivo_periodo_id` (`periodo_electivo_periodo_id`),
  KEY `dirigente` (`dirigente`),
  CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`estado_id`),
  CONSTRAINT `cursos_ibfk_2` FOREIGN KEY (`nivel_id`) REFERENCES `nivel_educacion` (`nivel_id`),
  CONSTRAINT `cursos_ibfk_3` FOREIGN KEY (`periodo_electivo_periodo_id`) REFERENCES `periodo_electivo` (`periodo_id`),
  CONSTRAINT `cursos_ibfk_4` FOREIGN KEY (`dirigente`) REFERENCES `personal` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES (1,'Rabanitos','Matutina','25','1-A',1,1,'admin','2001-01-19',1,1),(2,'Prueba','Matutina','25','1-B',1,1,'admin','2001-02-19',1,1);
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datos_medicos`
--

DROP TABLE IF EXISTS `datos_medicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `datos_medicos` (
  `tiene_discapacidad` tinyint(4) NOT NULL,
  `porcentaje_discapacidad` int(11) NOT NULL,
  `tipo_discapacidad` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `alumnos_cedula` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `idgrupo_sanguuineo` int(11) NOT NULL,
  PRIMARY KEY (`alumnos_cedula`),
  KEY `idgrupo_sanguuineo` (`idgrupo_sanguuineo`),
  CONSTRAINT `datos_medicos_ibfk_1` FOREIGN KEY (`alumnos_cedula`) REFERENCES `alumno` (`cedula`),
  CONSTRAINT `datos_medicos_ibfk_2` FOREIGN KEY (`idgrupo_sanguuineo`) REFERENCES `grupo_sanguineo` (`idgrupo_sanguineo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datos_medicos`
--

LOCK TABLES `datos_medicos` WRITE;
/*!40000 ALTER TABLE `datos_medicos` DISABLE KEYS */;
/*!40000 ALTER TABLE `datos_medicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_materia`
--

DROP TABLE IF EXISTS `detalle_materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `detalle_materia` (
  `id_detalle_materia` int(11) NOT NULL AUTO_INCREMENT,
  `id_materia` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle_materia`),
  KEY `cursos_curso_id` (`id_curso`),
  KEY `personal_personal_id` (`id_profesor`),
  KEY `materia_id` (`id_materia`),
  CONSTRAINT `detalle_materia_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`curso_id`) ON DELETE CASCADE,
  CONSTRAINT `detalle_materia_ibfk_2` FOREIGN KEY (`id_profesor`) REFERENCES `personal` (`personal_id`) ON DELETE CASCADE,
  CONSTRAINT `detalle_materia_ibfk_3` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_materia`
--

LOCK TABLES `detalle_materia` WRITE;
/*!40000 ALTER TABLE `detalle_materia` DISABLE KEYS */;
INSERT INTO `detalle_materia` VALUES (24,1,1,1),(25,2,2,1),(26,3,3,1),(27,4,4,1),(28,1,4,2),(29,3,1,2),(30,5,2,2),(31,6,3,2);
/*!40000 ALTER TABLE `detalle_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_civil`
--

DROP TABLE IF EXISTS `estado_civil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `estado_civil` (
  `estado_civil_id` int(11) NOT NULL,
  `descripcion` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`estado_civil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_civil`
--

LOCK TABLES `estado_civil` WRITE;
/*!40000 ALTER TABLE `estado_civil` DISABLE KEYS */;
INSERT INTO `estado_civil` VALUES (1,'Soltero(a)'),(2,'Casado(a)'),(3,'Viudo(a)'),(4,'Divorciado(a)'),(5,'Unión de Hecho');
/*!40000 ALTER TABLE `estado_civil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `estados` (
  `estado_id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`estado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` VALUES (1,'Activo'),(2,'Inactivo');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factura`
--

DROP TABLE IF EXISTS `factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `factura` (
  `factura_id` int(11) NOT NULL,
  `n_factura` int(11) NOT NULL,
  `orden_pago__id` int(11) NOT NULL,
  `modo_pago_id` int(11) NOT NULL,
  `fecha_pago` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura`
--

LOCK TABLES `factura` WRITE;
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generos`
--

DROP TABLE IF EXISTS `generos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `generos` (
  `genero_id` int(11) NOT NULL,
  `sexo` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`genero_id`),
  KEY `genero_id` (`genero_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generos`
--

LOCK TABLES `generos` WRITE;
/*!40000 ALTER TABLE `generos` DISABLE KEYS */;
INSERT INTO `generos` VALUES (1,'Masculino'),(2,'Femenino');
/*!40000 ALTER TABLE `generos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_sanguineo`
--

DROP TABLE IF EXISTS `grupo_sanguineo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `grupo_sanguineo` (
  `idgrupo_sanguineo` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`idgrupo_sanguineo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_sanguineo`
--

LOCK TABLES `grupo_sanguineo` WRITE;
/*!40000 ALTER TABLE `grupo_sanguineo` DISABLE KEYS */;
INSERT INTO `grupo_sanguineo` VALUES (1,'Escoja Grupo Sanguineo'),(2,'O+'),(3,'O-'),(4,'B+'),(5,'B-'),(6,'A+'),(7,'A-'),(8,'AB+'),(9,'AB-');
/*!40000 ALTER TABLE `grupo_sanguineo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horario`
--

DROP TABLE IF EXISTS `horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL AUTO_INCREMENT,
  `dia` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `id_detalle_materia` int(11) NOT NULL,
  PRIMARY KEY (`id_horario`),
  KEY `detalle_materia_id_detalle_materia` (`id_detalle_materia`),
  CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`id_detalle_materia`) REFERENCES `detalle_materia` (`id_detalle_materia`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario`
--

LOCK TABLES `horario` WRITE;
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
INSERT INTO `horario` VALUES (106,'Lunes','09:30:00','10:30:00',25),(107,'Lunes','10:30:00','11:30:00',26),(108,'Martes','09:30:00','10:30:00',26),(109,'Martes','10:30:00','11:30:00',27),(110,'Miercoles','09:30:00','10:30:00',27),(111,'Miercoles','10:30:00','11:30:00',24),(112,'Jueves','09:30:00','10:30:00',24),(113,'Jueves','10:30:00','11:30:00',25),(114,'Viernes','09:30:00','10:30:00',25),(115,'Viernes','10:30:00','11:30:00',26),(131,'Lunes','07:30:00','08:30:00',29),(132,'Lunes','12:30:00','13:30:00',28),(133,'Lunes','13:30:00','14:30:00',28),(134,'Martes','07:30:00','08:30:00',31),(135,'Martes','12:30:00','13:30:00',31),(136,'Martes','13:30:00','14:30:00',29),(137,'Miercoles','07:30:00','08:30:00',28),(138,'Miercoles','12:30:00','13:30:00',29),(139,'Miercoles','13:30:00','14:30:00',30),(140,'Jueves','07:30:00','08:30:00',29),(141,'Jueves','12:30:00','13:30:00',28),(142,'Jueves','13:30:00','14:30:00',31),(143,'Viernes','07:30:00','08:30:00',29),(144,'Viernes','12:30:00','13:30:00',31),(145,'Viernes','13:30:00','14:30:00',28);
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instituciones`
--

DROP TABLE IF EXISTS `instituciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `instituciones` (
  `institucion_id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`institucion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instituciones`
--

LOCK TABLES `instituciones` WRITE;
/*!40000 ALTER TABLE `instituciones` DISABLE KEYS */;
INSERT INTO `instituciones` VALUES (1,'Escoja Institución'),(2,'IEES'),(3,'Banco Pacifico'),(4,'Seguros Sucre'),(5,'Junta de Beneficencia');
/*!40000 ALTER TABLE `instituciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lugares`
--

DROP TABLE IF EXISTS `lugares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lugares` (
  `lugar_id` int(11) NOT NULL,
  `provincia` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `ciudad` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`lugar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lugares`
--

LOCK TABLES `lugares` WRITE;
/*!40000 ALTER TABLE `lugares` DISABLE KEYS */;
INSERT INTO `lugares` VALUES (1,'','Escoja lugar de Nacimiento'),(2,'AZUAY','CHORDELEG'),(3,'AZUAY','CUENCA'),(4,'AZUAY','EL PAN'),(5,'AZUAY','GIRON'),(6,'AZUAY','GUACHAPALA'),(7,'AZUAY','GUALACEO'),(8,'AZUAY','NABON'),(9,'AZUAY','ONA'),(10,'AZUAY','PAUTE'),(11,'AZUAY','PUCARA'),(12,'AZUAY','SAN FERNANDO'),(13,'AZUAY','SANTA ISABEL'),(14,'AZUAY','SEVILLA DE ORO'),(15,'AZUAY','SIGSIG'),(16,'BOLIVAR','CALUMA'),(17,'BOLIVAR','CHILLANES'),(18,'BOLIVAR','CHIMBO'),(19,'BOLIVAR','ECHEANDIA'),(20,'BOLIVAR','GUARANDA'),(21,'BOLIVAR','LAS NAVES'),(22,'BOLIVAR','SAN MIGUEL'),(23,'CANAR','AZOGUES'),(24,'CANAR','BIBLIAN'),(25,'CANAR','CANAR'),(26,'CANAR','DELEG'),(27,'CANAR','EL TAMBO'),(28,'CANAR','LA TRONCAL'),(29,'CANAR','SUSCAL'),(30,'CARCHI','BOLIVAR'),(31,'CARCHI','ESPEJO'),(32,'CARCHI','MIRA'),(33,'CARCHI','MONTUFAR (SAN GABRIEL)'),(34,'CARCHI','SAN PEDRO DE HUACA'),(35,'CARCHI','TULCAN'),(36,'CHIMBORAZO','ALAUSI'),(37,'CHIMBORAZO','CHAMBO'),(38,'CHIMBORAZO','CHUNCHI'),(39,'CHIMBORAZO','COLTA'),(40,'CHIMBORAZO','CUMANDA'),(41,'CHIMBORAZO','GUAMOTE'),(42,'CHIMBORAZO','GUANO'),(43,'CHIMBORAZO','PALLATANGA'),(44,'CHIMBORAZO','PENIPE'),(45,'CHIMBORAZO','RIOBAMBA'),(46,'COTOPAXI','LA MANA'),(47,'COTOPAXI','LASSO'),(48,'COTOPAXI','LATACUNGA'),(49,'COTOPAXI','PANGUA'),(50,'COTOPAXI','PUJILI'),(51,'COTOPAXI','SALCEDO'),(52,'COTOPAXI','SAQUISILI'),(53,'COTOPAXI','SIGCHOS'),(54,'EL ORO','ARENILLAS'),(55,'EL ORO','ATAHUALPA'),(56,'EL ORO','BALSAS'),(57,'EL ORO','CHILLA'),(58,'EL ORO','EL GUABO'),(59,'EL ORO','HUAQUILLAS'),(60,'EL ORO','LAS LAJAS'),(61,'EL ORO','MACHALA'),(62,'EL ORO','MARCABELI'),(63,'EL ORO','PASAJE'),(64,'EL ORO','PINAS'),(65,'EL ORO','PORTOVELO'),(66,'EL ORO','SANTA ROSA'),(67,'EL ORO','ZARUMA'),(68,'ESMERALDAS','ATACAMES'),(69,'ESMERALDAS','ELOY ALFARO (LIMONES)'),(70,'ESMERALDAS','ESMERALDAS'),(71,'ESMERALDAS','MUISNE'),(72,'ESMERALDAS','QUININDE'),(73,'ESMERALDAS','RIOVERDE'),(74,'ESMERALDAS','SAN LORENZO'),(75,'GALAPAGOS','ISABELA'),(76,'GALAPAGOS','SAN CRISTOBAL'),(77,'GALAPAGOS','SANTA CRUZ'),(78,'GUAYAS','ALFREDO BAQUERIZO MORENO (JUJAN)'),(79,'GUAYAS','BALAO'),(80,'GUAYAS','BALZAR'),(81,'GUAYAS','COLIMES'),(82,'GUAYAS','DAULE'),(83,'GUAYAS','DURAN'),(84,'GUAYAS','EL EMPALME'),(85,'GUAYAS','ELOY ALFARO (DURAN)'),(86,'GUAYAS','EL TRIUNFO'),(87,'GUAYAS','GENERAL ANTONIO ELIZALDE (BUCAY)'),(88,'GUAYAS','GUAYAQUIL'),(89,'GUAYAS','ISIDRO AYORA'),(90,'GUAYAS','LOMAS DE SARGENTILLO'),(91,'GUAYAS','CRNEL MARCELINO MARIDUENA'),(92,'GUAYAS','MILAGRO'),(93,'GUAYAS','NARANJAL'),(94,'GUAYAS','NARANJITO'),(95,'GUAYAS','NARCISA DE JESUS (NOBOL)'),(96,'GUAYAS','PALESTINA'),(97,'GUAYAS','PEDRO CARBO'),(98,'GUAYAS','PLAYAS (GENERAL VILLAMIL)'),(99,'GUAYAS','SALITRE (URBINA JADO)'),(100,'GUAYAS','SAMBORONDON'),(101,'GUAYAS','SANTA LUCIA'),(102,'GUAYAS','SIMON BOLIVAR'),(103,'GUAYAS','SAN JACINTO DE YAGUACHI'),(104,'GUAYAS','URBINA JADO'),(105,'IMBABURA','ANTONIO ANTE'),(106,'IMBABURA','ATUNTAQUI'),(107,'IMBABURA','COTACACHI'),(108,'IMBABURA','IBARRA'),(109,'IMBABURA','OTAVALO'),(110,'IMBABURA','PIMAMPIRO'),(111,'IMBABURA','SAN MIGUEL DE URCUQUI'),(112,'LOJA','CALVAS (CARIAMANGA)'),(113,'LOJA','CATAMAYO'),(114,'LOJA','CELICA'),(115,'LOJA','CHAGUARPAMBA'),(116,'LOJA','ESPINDOLA (AMALUZA)'),(117,'LOJA','GONZANAMA'),(118,'LOJA','LOJA'),(119,'LOJA','MACARA'),(120,'LOJA','OLMEDO'),(121,'LOJA','PALTAS'),(122,'LOJA','PINDAL'),(123,'LOJA','PUYANGO (ALAMOR)'),(124,'LOJA','QUILANGA'),(125,'LOJA','SARAGURO'),(126,'LOJA','SOZORANGA'),(127,'LOJA','ZAPOTILLO'),(128,'LOS RIOS','BABA'),(129,'LOS RIOS','BABAHOYO'),(130,'LOS RIOS','BUENA FE'),(131,'LOS RIOS','MOCACHE'),(132,'LOS RIOS','MONTALVO'),(133,'LOS RIOS','PALENQUE'),(134,'LOS RIOS','PUEBLOVIEJO'),(135,'LOS RIOS','QUEVEDO'),(136,'LOS RIOS','QUINSALOMA'),(137,'LOS RIOS','URDANETA'),(138,'LOS RIOS','VALENCIA'),(139,'LOS RIOS','VENTANAS'),(140,'LOS RIOS','VINCES'),(141,'MANABI','24 DE MAYO'),(142,'MANABI','BAHIA DE CARAQUEZ'),(143,'MANABI','BOLIVAR (CALCETA)'),(144,'MANABI','CHONE'),(145,'MANABI','EL CARMEN'),(146,'MANABI','FLAVIO ALFARO'),(147,'MANABI','JAMA'),(148,'MANABI','JARAMIJO'),(149,'MANABI','JIPIJAPA'),(150,'MANABI','JUNIN'),(151,'MANABI','MANTA'),(152,'MANABI','MONTECRISTI'),(153,'MANABI','OLMEDO'),(154,'MANABI','PAJAN'),(155,'MANABI','PEDERNALES'),(156,'MANABI','PICHINCHA'),(157,'MANABI','PORTOVIEJO'),(158,'MANABI','PUERTO LOPEZ'),(159,'MANABI','ROCAFUERTE'),(160,'MANABI','SAN VICENTE'),(161,'MANABI','SANTA ANA'),(162,'MANABI','SUCRE'),(163,'MANABI','TOSAGUA'),(164,'MORONA SANTIAGO','GUALAQUIZA'),(165,'MORONA SANTIAGO','HUAMBOYA'),(166,'MORONA SANTIAGO','LIMON INDANZA'),(167,'MORONA SANTIAGO','LOGRONO'),(168,'MORONA SANTIAGO','MORONA'),(169,'MORONA SANTIAGO','PABLO SEXTO'),(170,'MORONA SANTIAGO','PALORA'),(171,'MORONA SANTIAGO','SAN JUAN BOSCO'),(172,'MORONA SANTIAGO','SANTIAGO'),(173,'MORONA SANTIAGO','SUCUA'),(174,'MORONA SANTIAGO','TAISHA'),(175,'MORONA SANTIAGO','TIWINTZA'),(176,'NAPO','ARCHIDONA'),(177,'NAPO','CARLOS JULIO AROSEMENA TOLA'),(178,'NAPO','EL CHACO'),(179,'NAPO','QUIJOS (BAEZA)'),(180,'NAPO','TENA'),(181,'ORELLANA','AGUARICO'),(182,'ORELLANA','EL COCA'),(183,'ORELLANA','FRANCISCO DE ORELLANA'),(184,'ORELLANA','LA JOYA DE LOS SACHAS'),(185,'ORELLANA','LORETO'),(186,'ORELLANA','ORELLANA'),(187,'PASTAZA','ARAJUNO'),(188,'PASTAZA','MERA'),(189,'PASTAZA','PUYO'),(190,'PASTAZA','SANTA CLARA'),(191,'PICHINCHA','CAYAMBE'),(192,'PICHINCHA','MEJIA (MACHACHI)'),(193,'PICHINCHA','PEDRO MONCAYO (TABACUNDO)'),(194,'PICHINCHA','PEDRO VICENTE MALDONADO'),(195,'PICHINCHA','PUERTO QUITO'),(196,'PICHINCHA','QUITO'),(197,'PICHINCHA','RUMINAHUI'),(198,'PICHINCHA','SAN MIGUEL DE LOS BANCOS'),(199,'SANTA ELENA','LA LIBERTAD'),(200,'SANTA ELENA','SALINAS'),(201,'SANTA ELENA','SANTA ELENA'),(202,'SANTO DOMINGO DE LOS TSACHILAS','SANTO DOMINGO'),(203,'SANTO DOMINGO DE LOS TSACHILAS','LA CONCORDIA'),(204,'SUCUMBIOS','CASCALES'),(205,'SUCUMBIOS','CUYABENO'),(206,'SUCUMBIOS','GONZALO PIZARRO (LUMBAQUI)'),(207,'SUCUMBIOS','LA BONITA'),(208,'SUCUMBIOS','LAGO AGRIO'),(209,'SUCUMBIOS','NUEVA LOJA'),(210,'SUCUMBIOS','PUTUMAYO PUERTO EL CARMEN DEL PUTUMAYO'),(211,'SUCUMBIOS','SHUSHUFINDI'),(212,'SUCUMBIOS','SUCUMBIOS  (LA BONITA)'),(213,'SUCUMBIOS','TARAPOA'),(214,'TUNGURAHUA','AMBATO'),(215,'TUNGURAHUA','BANOS'),(216,'TUNGURAHUA','BANOS DE AGUA SANTA'),(217,'TUNGURAHUA','CEVALLOS'),(218,'TUNGURAHUA','MOCHA'),(219,'TUNGURAHUA','PATATE'),(220,'TUNGURAHUA','QUERO'),(221,'TUNGURAHUA','SAN PEDRO DE PELILEO'),(222,'TUNGURAHUA','SANTIAGO DE PILLARO'),(223,'TUNGURAHUA','TISALEO'),(224,'ZAMORA CHINCHIPE','CENTINELA DEL CONDOR (ZUMBI)'),(225,'ZAMORA CHINCHIPE','CHINCHIPE'),(226,'ZAMORA CHINCHIPE','EL PANGUI'),(227,'ZAMORA CHINCHIPE','NANGARITZA'),(228,'ZAMORA CHINCHIPE','PALANDA'),(229,'ZAMORA CHINCHIPE','PAQUISHA'),(230,'ZAMORA CHINCHIPE','YACUAMBI'),(231,'ZAMORA CHINCHIPE','YANZATZA'),(232,'ZAMORA CHINCHIPE','ZAMORA');
/*!40000 ALTER TABLE `lugares` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL AUTO_INCREMENT,
  `imagen` blob DEFAULT NULL,
  `descripcion` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_materia`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES (1,NULL,'...','Matemáticas'),(2,NULL,'...','Lenguaje'),(3,NULL,'...','Computación'),(4,NULL,'...','Estudios Sociales'),(5,NULL,'...','Ciencias Naturales'),(6,NULL,'...','Educación Física'),(7,NULL,'...','Inglés');
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje`
--

DROP TABLE IF EXISTS `mensaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `mensaje` (
  `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,
  `asunto` varchar(35) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `contenido` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `tipo` varchar(25) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_mensaje`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje`
--

LOCK TABLES `mensaje` WRITE;
/*!40000 ALTER TABLE `mensaje` DISABLE KEYS */;
INSERT INTO `mensaje` VALUES (1,'Pregunta','Saludos profesor, me dirijo a usted para pedirle encarecidamente que me informe sobre la que ocurrió con mi hijo xD','2019-01-10 00:00:00','Notificacion'),(2,'Pregunta','Saludos sr. administrador, me dirijo a usted para pedirle encarecidamente que me informe sobre la que ocurrió con mi hijo xD','2019-01-10 00:00:00','Notificacion'),(4,'Informe de rendimiento','Esta es una plantilla de informe de rendimiento....','2019-01-10 00:00:00','Plantilla'),(5,'Olimpiadas','Esta es una plantilla de olimpiadas .....','2019-01-10 00:00:00','Plantilla'),(6,'Fiestas julianas','Esta es una plantilla de fiestas julianas .....','2019-01-10 00:00:00','Plantilla'),(7,'Casa abierta','Esta es una plantilla de casa abierta .....','2019-01-10 00:00:00','Plantilla'),(8,'Campaña de vacunación','Esta es una plantilla de campaña de vacunación .....','2019-01-10 00:00:00','Plantilla'),(9,'Otro','','2019-01-10 00:00:00','Plantilla');
/*!40000 ALTER TABLE `mensaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje_autorizado`
--

DROP TABLE IF EXISTS `mensaje_autorizado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `mensaje_autorizado` (
  `id_mensaje_autorizado` int(11) NOT NULL AUTO_INCREMENT,
  `id_mensaje` int(11) NOT NULL,
  `cedula_autorizado` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `cedula_alumno` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `profesor_id` int(11) NOT NULL,
  PRIMARY KEY (`id_mensaje_autorizado`),
  KEY `cedula_autorizado` (`cedula_autorizado`),
  KEY `id_mensaje` (`id_mensaje`),
  KEY `cedula_alumno` (`cedula_alumno`),
  CONSTRAINT `mensaje_autorizado_ibfk_1` FOREIGN KEY (`cedula_autorizado`) REFERENCES `autorizado` (`cedula`),
  CONSTRAINT `mensaje_autorizado_ibfk_2` FOREIGN KEY (`id_mensaje`) REFERENCES `mensaje` (`id_mensaje`),
  CONSTRAINT `mensaje_autorizado_ibfk_3` FOREIGN KEY (`cedula_alumno`) REFERENCES `alumno` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje_autorizado`
--

LOCK TABLES `mensaje_autorizado` WRITE;
/*!40000 ALTER TABLE `mensaje_autorizado` DISABLE KEYS */;
INSERT INTO `mensaje_autorizado` VALUES (1,1,'0930703707','0987654321',1),(2,2,'0930703707','0987654321',100);
/*!40000 ALTER TABLE `mensaje_autorizado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje_curso`
--

DROP TABLE IF EXISTS `mensaje_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `mensaje_curso` (
  `id_mensaje_curso` int(11) NOT NULL AUTO_INCREMENT,
  `profesor` int(11) NOT NULL,
  `mensaje` int(11) NOT NULL,
  `curso` int(11) NOT NULL,
  PRIMARY KEY (`id_mensaje_curso`),
  KEY `mensaje` (`mensaje`),
  KEY `fk_mensaje_curso_cursos1_idx` (`curso`),
  CONSTRAINT `fk_mensaje_curso_cursos1` FOREIGN KEY (`curso`) REFERENCES `cursos` (`curso_id`),
  CONSTRAINT `mensaje_curso_ibfk_1` FOREIGN KEY (`mensaje`) REFERENCES `mensaje` (`id_mensaje`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje_curso`
--

LOCK TABLES `mensaje_curso` WRITE;
/*!40000 ALTER TABLE `mensaje_curso` DISABLE KEYS */;
INSERT INTO `mensaje_curso` VALUES (1,1,1,1);
/*!40000 ALTER TABLE `mensaje_curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivel_educacion`
--

DROP TABLE IF EXISTS `nivel_educacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `nivel_educacion` (
  `nivel_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`nivel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivel_educacion`
--

LOCK TABLES `nivel_educacion` WRITE;
/*!40000 ALTER TABLE `nivel_educacion` DISABLE KEYS */;
INSERT INTO `nivel_educacion` VALUES (1,'Inicial','...');
/*!40000 ALTER TABLE `nivel_educacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticias`
--

DROP TABLE IF EXISTS `noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `noticias` (
  `noticia_id` int(11) NOT NULL,
  `titulo` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `foto` blob NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`noticia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticias`
--

LOCK TABLES `noticias` WRITE;
/*!40000 ALTER TABLE `noticias` DISABLE KEYS */;
/*!40000 ALTER TABLE `noticias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parentesco`
--

DROP TABLE IF EXISTS `parentesco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `parentesco` (
  `idparentesco` int(11) NOT NULL AUTO_INCREMENT,
  `parentesco` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`idparentesco`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parentesco`
--

LOCK TABLES `parentesco` WRITE;
/*!40000 ALTER TABLE `parentesco` DISABLE KEYS */;
INSERT INTO `parentesco` VALUES (1,'Padre'),(2,'Madre'),(3,'Tio/a'),(4,'Abuelo/a');
/*!40000 ALTER TABLE `parentesco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodo_electivo`
--

DROP TABLE IF EXISTS `periodo_electivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `periodo_electivo` (
  `periodo_id` int(11) NOT NULL AUTO_INCREMENT,
  `anio_inicio` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `anio_fin` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `estado_id` int(11) NOT NULL,
  `fecha_inicio_periodo` date NOT NULL,
  `fecha_fin_periodo` date NOT NULL,
  PRIMARY KEY (`periodo_id`),
  KEY `estado_id` (`estado_id`),
  CONSTRAINT `periodo_electivo_ibfk_1` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`estado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo_electivo`
--

LOCK TABLES `periodo_electivo` WRITE;
/*!40000 ALTER TABLE `periodo_electivo` DISABLE KEYS */;
INSERT INTO `periodo_electivo` VALUES (1,'2019','2020',1,'2019-01-19','2020-01-20');
/*!40000 ALTER TABLE `periodo_electivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal`
--

DROP TABLE IF EXISTS `personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `personal` (
  `personal_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `apellidos` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `especialidad_id` int(11) NOT NULL,
  `telefono` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `mail` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_creacion` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT 'Admin',
  `genero_id` int(11) NOT NULL,
  `estado_civil_id` int(11) NOT NULL,
  `direccion` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `fechaNac` date NOT NULL,
  `fechaLaboral` date NOT NULL,
  `aniosExperiencia` int(11) NOT NULL,
  `cargas` int(11) NOT NULL,
  `curriculum_direccion` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `foto` blob DEFAULT NULL,
  `cedula` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`personal_id`),
  UNIQUE KEY `cedula` (`cedula`),
  KEY `genero_id` (`genero_id`),
  KEY `estado_civil_id` (`estado_civil_id`),
  KEY `personal_ibfk_3_idx` (`usuario_id`),
  CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`genero_id`),
  CONSTRAINT `personal_ibfk_2` FOREIGN KEY (`estado_civil_id`) REFERENCES `estado_civil` (`estado_civil_id`),
  CONSTRAINT `personal_ibfk_3` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal`
--

LOCK TABLES `personal` WRITE;
/*!40000 ALTER TABLE `personal` DISABLE KEYS */;
INSERT INTO `personal` VALUES (1,'Armando','Guerra',1,'2435686','mail@example.com','2001-01-19 00:00:00','admin',1,2,'direccion example','2001-01-01','2001-01-01',3,1,'url',2,'',''),(2,'Rosa','Velez',1,'0987654321','m@example.com','2018-12-29 00:08:03','Admin',2,1,'direccion','1980-03-10','2017-04-04',3,1,'dir_curriculum',10,NULL,'0987651234'),(3,'Mateo','Perez',1,'0987654321','m@example.com','2018-12-29 00:10:14','Admin',1,1,'direccion','1980-03-10','2017-04-04',4,1,'dir_curriculum',11,NULL,'0987541234'),(4,'Lucia','Fernandez',1,'0987654321','m@example.com','2018-12-29 00:12:01','Admin',2,1,'direccion','1980-03-10','2017-04-04',5,1,'dir_curriculum',12,NULL,'0987541299');
/*!40000 ALTER TABLE `personal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefonos`
--

DROP TABLE IF EXISTS `telefonos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `telefonos` (
  `cedula` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`cedula`,`telefono`),
  CONSTRAINT `telefonos_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `autorizado` (`cedula`),
  CONSTRAINT `telefonos_ibfk_2` FOREIGN KEY (`cedula`) REFERENCES `personal` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefonos`
--

LOCK TABLES `telefonos` WRITE;
/*!40000 ALTER TABLE `telefonos` DISABLE KEYS */;
/*!40000 ALTER TABLE `telefonos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `usuario` (
  `usuario` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `clave` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `tipo` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) NOT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('admin','admin','a',1,1),('profesor','profesor','p',2,1),('rosav','rosav','p',10,1),('mateop','mateop','p',11,1),('luciaf','luciaf','p',12,1),('madreUser','madre','r',13,1),('userM','123456','r',14,1),('tiouser','tiouser','r',15,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-15  7:44:05

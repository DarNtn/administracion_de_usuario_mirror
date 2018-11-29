-- MySQL dump 10.13  Distrib 8.0.12, for macos10.13 (x86_64)
--
-- Host: localhost    Database: administracion_colegio
-- ------------------------------------------------------
-- Server version	8.0.12

CREATE DATABASE IF NOT EXISTS administracion_colegio;
USE administracion_colegio;

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
  `id_Actividad` int(11) NOT NULL AUTO_INCREMENT,
  `dia` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `año` int(11) DEFAULT NULL,
  `descripcion` varchar(75) DEFAULT NULL,
  `lugar` varchar(45) DEFAULT NULL,
  `hora` datetime DEFAULT NULL,
  `duración` time DEFAULT NULL,
  PRIMARY KEY (`id_Actividad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividad`
--

LOCK TABLES `actividad` WRITE;
/*!40000 ALTER TABLE `actividad` DISABLE KEYS */;
/*!40000 ALTER TABLE `actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adjunto`
--

DROP TABLE IF EXISTS `adjunto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `adjunto` (
  `id_documento` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `mensaje_id` int(11) NOT NULL,
  PRIMARY KEY (`id_documento`),
  KEY `fk_adjunto_mensajes1_idx` (`mensaje_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `foto` blob,
  `cedula` varchar(45) DEFAULT NULL,
  `usuarios_usuario_id` int(11) NOT NULL,
  `cedula_copy1` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `fk_administradores_usuarios1_idx` (`usuarios_usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `alumno` (
  `cedula` varchar(20) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `genero_id` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `lugar_id` int(11) NOT NULL,
  `foto_direccion` varchar(255) DEFAULT NULL,
  `fecha_creacion` date NOT NULL,
  `usuario_creacion` varchar(45) DEFAULT NULL,
  `estado_id` int(11) NOT NULL,
  `instituciones_id` int(11) NOT NULL,
  `observacion` varchar(250) DEFAULT NULL,
  `pension` double NOT NULL,
  `cursos_curso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cedula`),
  KEY `alumnos_genero_id_fk_idx` (`genero_id`),
  KEY `alumnos_estados_idx` (`estado_id`),
  KEY `alumnos_instituciones_fk_idx` (`instituciones_id`),
  KEY `alumnos_lugares_fk_idx` (`lugar_id`),
  KEY `fk_alumnos_cursos1_idx` (`cursos_curso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno`
--

LOCK TABLES `alumno` WRITE;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
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
  `tipo` varchar(45) NOT NULL,
  `alumno_cedula` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `parentesco_id` int(11) NOT NULL,
  `autorizado_cedula` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`idautorizacion`),
  KEY `fk_autorizacion_alumno1_idx` (`alumno_cedula`),
  KEY `fk_autorizacion_parentezco1_idx` (`parentesco_id`),
  KEY `fk_autorizacion_autorizado1_idx` (`autorizado_cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autorizacion`
--

LOCK TABLES `autorizacion` WRITE;
/*!40000 ALTER TABLE `autorizacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `autorizacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `autorizado`
--

DROP TABLE IF EXISTS `autorizado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `autorizado` (
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `estado_civil_id` int(11) NOT NULL,
  `genero_id` int(11) NOT NULL,
  `cedula` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `usuario_usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cedula`),
  KEY `fk_padre_estado_civil1_idx` (`estado_civil_id`),
  KEY `fk_autorizacion_generos1_idx` (`genero_id`),
  KEY `fk_autorizacion_usuario1_idx` (`usuario_usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autorizado`
--

LOCK TABLES `autorizado` WRITE;
/*!40000 ALTER TABLE `autorizado` DISABLE KEYS */;
/*!40000 ALTER TABLE `autorizado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citacion`
--

DROP TABLE IF EXISTS `citacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `citacion` (
  `id_Citacion` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `duración` time DEFAULT NULL,
  `mensaje` int(11) NOT NULL,
  `hora` timestamp(5) NULL DEFAULT NULL,
  PRIMARY KEY (`id_Citacion`),
  KEY `fk_Citación_mensaje1_idx` (`mensaje`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citacion`
--

LOCK TABLES `citacion` WRITE;
/*!40000 ALTER TABLE `citacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `citacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citacion_curso`
--

DROP TABLE IF EXISTS `citacion_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `citacion_curso` (
  `id_citacion_curso` int(11) NOT NULL AUTO_INCREMENT,
  `profesor` int(11) NOT NULL,
  `citacion` int(11) NOT NULL,
  PRIMARY KEY (`id_citacion_curso`),
  KEY `fk_citación_curso_personal1_idx` (`profesor`),
  KEY `fk_citación_curso_citación1_idx` (`citacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citacion_curso`
--

LOCK TABLES `citacion_curso` WRITE;
/*!40000 ALTER TABLE `citacion_curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `citacion_curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citacion_padre`
--

DROP TABLE IF EXISTS `citacion_padre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `citacion_padre` (
  `id_citacion_padre` int(11) NOT NULL,
  `citacion` int(11) NOT NULL,
  `autorizado_cedula` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_citacion_padre`),
  KEY `fk_citacion_padre_Citación1_idx` (`citacion`),
  KEY `fk_citacion_padre_autorizado1_idx` (`autorizado_cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citacion_padre`
--

LOCK TABLES `citacion_padre` WRITE;
/*!40000 ALTER TABLE `citacion_padre` DISABLE KEYS */;
/*!40000 ALTER TABLE `citacion_padre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cursos` (
  `curso_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `jornada` varchar(45) DEFAULT NULL,
  `cant_alumnos` varchar(45) DEFAULT NULL,
  `paralelo` varchar(45) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `nivel_id` int(11) DEFAULT NULL,
  `usuario_creacion` varchar(45) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `dirigente` int(11) NOT NULL,
  `periodo_electivo_periodo_id` int(11) NOT NULL,
  PRIMARY KEY (`curso_id`),
  KEY `cursos_estados_fk_idx` (`estado_id`),
  KEY `cursos_niveles_fk_idx` (`nivel_id`),
  KEY `fk_cursos_personal1_idx` (`dirigente`),
  KEY `fk_cursos_periodo_electivo1_idx` (`periodo_electivo_periodo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datos_medicos`
--

DROP TABLE IF EXISTS `datos_medicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `datos_medicos` (
  `tiene_discapacidad` tinyint(4) DEFAULT NULL,
  `porcentaje_discapacidad` int(11) DEFAULT NULL,
  `tipo_discapacidad` varchar(45) DEFAULT NULL,
  `alumnos_cedula` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `idgrupo_sanguineo` int(11) NOT NULL,
  PRIMARY KEY (`alumnos_cedula`),
  KEY `fk_datos_medicos_alumnos1_idx` (`alumnos_cedula`),
  KEY `fk_datos_medicos_grupo_sanguineo1_idx` (`idgrupo_sanguineo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `materia_id_materia` int(11) NOT NULL,
  `personal_personal_id` int(11) NOT NULL,
  `cursos_curso_id` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle_materia`),
  KEY `fk_detalle_materia_materia1_idx` (`materia_id_materia`),
  KEY `fk_detalle_materia_personal1_idx` (`personal_personal_id`),
  KEY `fk_detalle_materia_cursos1_idx` (`cursos_curso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_materia`
--

LOCK TABLES `detalle_materia` WRITE;
/*!40000 ALTER TABLE `detalle_materia` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento`
--

DROP TABLE IF EXISTS `documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `documento` (
  `link` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `alumno_cedula` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  KEY `fk_documento_alumno1_idx` (`alumno_cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento`
--

LOCK TABLES `documento` WRITE;
/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
/*!40000 ALTER TABLE `documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_civil`
--

DROP TABLE IF EXISTS `estado_civil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `estado_civil` (
  `estado_civil_id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`estado_civil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_civil`
--

LOCK TABLES `estado_civil` WRITE;
/*!40000 ALTER TABLE `estado_civil` DISABLE KEYS */;
/*!40000 ALTER TABLE `estado_civil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `estados` (
  `estado_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`estado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_civil`
--

LOCK TABLES `estado_civil` WRITE;
/*!40000 ALTER TABLE `estado_civil` DISABLE KEYS */;
INSERT  IGNORE INTO `estado_civil` (`estado_civil_id`, `descripcion`) VALUES (1,'Soltero(a)'),(2,'Casado(a)'),(3,'Viudo(a)'),(4,'Divorciado(a)'),(5,'Unión de Hecho');
/*!40000 ALTER TABLE `estado_civil` ENABLE KEYS */;
UNLOCK TABLES;

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
  `factura_id` int(11) NOT NULL AUTO_INCREMENT,
  `n_factura` int(11) DEFAULT NULL,
  `orden_pago_id` int(11) DEFAULT NULL,
  `modo_pago_id` int(11) DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  PRIMARY KEY (`factura_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
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
  `sexo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`genero_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `idgrupo_sanguineo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idgrupo_sanguineo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
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
  `dia` varchar(45) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `detalle_materia_id_detalle_materia` int(11) NOT NULL,
  PRIMARY KEY (`id_horario`),
  KEY `fk_horario_detalle_materia1_idx` (`detalle_materia_id_detalle_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario`
--

LOCK TABLES `horario` WRITE;
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instituciones`
--

DROP TABLE IF EXISTS `instituciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `instituciones` (
  `institucion_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`institucion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
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
  `lugar_id` int(11) NOT NULL AUTO_INCREMENT,
  `provincia` varchar(45) DEFAULT NULL,
  `ciudad` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`lugar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8;
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
  `imagen` blob,
  `descripcion` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje`
--

DROP TABLE IF EXISTS `mensaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `mensaje` (
  `id_mensajes` int(11) NOT NULL AUTO_INCREMENT,
  `asunto` varchar(35) DEFAULT NULL,
  `contenido` varchar(200) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `tipo` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_mensajes`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje`
--

LOCK TABLES `mensaje` WRITE;
/*!40000 ALTER TABLE `mensaje` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivel_educacion`
--

DROP TABLE IF EXISTS `nivel_educacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `nivel_educacion` (
  `nivel_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nivel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivel_educacion`
--

LOCK TABLES `nivel_educacion` WRITE;
/*!40000 ALTER TABLE `nivel_educacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `nivel_educacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parentesco`
--

DROP TABLE IF EXISTS `parentesco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `parentesco` (
  `idparentesco` int(11) NOT NULL AUTO_INCREMENT,
  `parentesco` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idparentesco`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
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
  `anio_inicio` varchar(45) DEFAULT NULL,
  `anio_fin` varchar(45) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `fecha_inicio_periodo` date DEFAULT NULL,
  `fecha_fin_periodo` date DEFAULT NULL,
  PRIMARY KEY (`periodo_id`),
  KEY `periodo_electivo_estados_fk_idx` (`estado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo_electivo`
--

LOCK TABLES `periodo_electivo` WRITE;
/*!40000 ALTER TABLE `periodo_electivo` DISABLE KEYS */;
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
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `especialidad_id` int(11) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `usuario_creacion` varchar(45) DEFAULT NULL,
  `genero_id` int(11) DEFAULT NULL,
  `estado_civil_id` int(11) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `fechaNac` date DEFAULT NULL,
  `fechaLaboral` date DEFAULT NULL,
  `aniosExperiencia` int(11) DEFAULT NULL,
  `cargas` int(11) DEFAULT NULL,
  `curriculum_direccion` varchar(200) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `foto` blob,
  `cedula` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`personal_id`),
  KEY `profesores_generos_idx` (`genero_id`),
  KEY `profesores_especialidades_fk_idx` (`especialidad_id`),
  KEY `profesor_id` (`personal_id`),
  KEY `profesor_id_2` (`personal_id`),
  KEY `fk_personal_usuarios1_idx` (`usuario_id`),
  KEY `profesores_estado_civil_idx` (`estado_civil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal`
--

LOCK TABLES `personal` WRITE;
/*!40000 ALTER TABLE `personal` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `usuario` (
  `usuario` varchar(45) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `tipo` varchar(2) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `fk_usuario_estados1_idx` (`estado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('admin','admin','a',1,1);
INSERT INTO `usuario` VALUES ('profesor','profesor','p',2,1);
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

-- Dump completed on 2018-11-03 17:15:17

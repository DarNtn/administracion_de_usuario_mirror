CREATE DATABASE  IF NOT EXISTS `innovasystemcom_jardin` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `innovasystemcom_jardin`;
-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: localhost    Database: innovasystemcom_jardin
-- ------------------------------------------------------
-- Server version	5.5.5-10.2.6-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumnos` (
  `alumno_id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(20) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `genero_id` int(11) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `tiene_discapacidad` varchar(2) DEFAULT NULL,
  `porcentaje_discapacidad` int(11) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `lugar_id` int(11) DEFAULT NULL,
  `grupo_sangrineo_id` int(11) DEFAULT NULL,
  `foto_direccion` varchar(200) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `usuario_creacion` varchar(45) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `instituciones_id` int(11) DEFAULT NULL,
  `tipo_de_discapacidad` varchar(150) DEFAULT NULL,
  `observacion` varchar(250) DEFAULT NULL,
  `nombresPadre` varchar(45) DEFAULT NULL,
  `telefonoPadre` varchar(15) DEFAULT NULL,
  `direccionPadre` varchar(100) DEFAULT NULL,
  `nombresMadre` varchar(45) DEFAULT NULL,
  `telefonoMadre` varchar(15) DEFAULT NULL,
  `direccionMadre` varchar(100) DEFAULT NULL,
  `certificado_direccion` varchar(200) DEFAULT NULL,
  `apellidoPadre` varchar(45) DEFAULT NULL,
  `apellidoMadre` varchar(45) DEFAULT NULL,
  `correoPadre` varchar(100) DEFAULT NULL,
  `correoMadre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`alumno_id`),
  KEY `tipo_sangre_id_idx` (`grupo_sangrineo_id`),
  KEY `alumnos_genero_id_fk_idx` (`genero_id`),
  KEY `alumnos_estados_idx` (`estado_id`),
  KEY `alumnos_instituciones_fk_idx` (`instituciones_id`),
  KEY `alumnos_lugares_fk_idx` (`lugar_id`),
  CONSTRAINT `alumnos_estados_fk` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`estado_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `alumnos_generos_fk` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`genero_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `alumnos_grupo_sangineo_fk` FOREIGN KEY (`grupo_sangrineo_id`) REFERENCES `grupo_sangineo` (`tipo_sangrineo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `alumnos_instituciones_fk` FOREIGN KEY (`instituciones_id`) REFERENCES `instituciones` (`institucion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `alumnos_lugares_fk` FOREIGN KEY (`lugar_id`) REFERENCES `lugares` (`lugar_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos`
--

LOCK TABLES `alumnos` WRITE;
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
INSERT  IGNORE INTO `alumnos` (`alumno_id`, `cedula`, `nombres`, `apellidos`, `genero_id`, `direccion`, `tiene_discapacidad`, `porcentaje_discapacidad`, `fecha_nacimiento`, `lugar_id`, `grupo_sangrineo_id`, `foto_direccion`, `fecha_creacion`, `usuario_creacion`, `estado_id`, `instituciones_id`, `tipo_de_discapacidad`, `observacion`, `nombresPadre`, `telefonoPadre`, `direccionPadre`, `nombresMadre`, `telefonoMadre`, `direccionMadre`, `certificado_direccion`, `apellidoPadre`, `apellidoMadre`, `correoPadre`, `correoMadre`) VALUES (1,'0915291488','Daniel Jose','Rios Chiquito',2,'Desconocida','NO',0,'2013-10-21',88,4,'fotos/user.png','2018-08-27','',1,1,'','Ninguna','','','','','','','','','','',''),(2,'0932223449','Juan Carlos','Carrillo Arzube',1,'nueva Venecia mz B villa 40','NO',0,'2012-11-08',88,2,'fotos/user.png','2018-08-27','',1,1,'','No posee observacion','Juan Carlos ','0980062280','Nueva Venecia Mz B villa 40','Olga Karina','0967856429','Nueva Venecia Mz B villa 40','certificados/defaul.jpg','Carrillo Valencia','Arzube Auquilla','juancarlos.carrillovalencia@gmail.com','carina_arzube@hotmail.com');
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asignar_profesor`
--

DROP TABLE IF EXISTS `asignar_profesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asignar_profesor` (
  `asignar_profesor_id` int(11) NOT NULL AUTO_INCREMENT,
  `salon_id` int(11) DEFAULT NULL,
  `personal_id` int(11) DEFAULT NULL,
  `periodo_id` int(11) DEFAULT NULL,
  `usuario_creacion` varchar(45) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  PRIMARY KEY (`asignar_profesor_id`),
  KEY `asignar_salones_fk_idx` (`salon_id`),
  KEY `asignar_profesores_idx` (`personal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignar_profesor`
--

LOCK TABLES `asignar_profesor` WRITE;
/*!40000 ALTER TABLE `asignar_profesor` DISABLE KEYS */;
INSERT  IGNORE INTO `asignar_profesor` (`asignar_profesor_id`, `salon_id`, `personal_id`, `periodo_id`, `usuario_creacion`, `fecha_creacion`) VALUES (10,1,2,1,NULL,NULL),(11,4,4,1,NULL,NULL);
/*!40000 ALTER TABLE `asignar_profesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asignar_representante`
--

DROP TABLE IF EXISTS `asignar_representante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asignar_representante` (
  `asignar_representante_id` int(11) NOT NULL AUTO_INCREMENT,
  `representante_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `principal` int(11) DEFAULT NULL,
  `parentesco_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`asignar_representante_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignar_representante`
--

LOCK TABLES `asignar_representante` WRITE;
/*!40000 ALTER TABLE `asignar_representante` DISABLE KEYS */;
INSERT  IGNORE INTO `asignar_representante` (`asignar_representante_id`, `representante_id`, `alumno_id`, `principal`, `parentesco_id`) VALUES (3,1,3,2,2),(4,1,1,1,2),(5,1,3,2,2),(6,2,1,2,1),(7,2,3,2,2),(8,2,3,2,2),(9,2,3,2,2),(12,3,2,2,2);
/*!40000 ALTER TABLE `asignar_representante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asistencias`
--

DROP TABLE IF EXISTS `asistencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asistencias` (
  `asistecia_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `lista_curso_id` int(11) DEFAULT NULL,
  `estado_id` varchar(45) DEFAULT NULL,
  `usuario_creacion` varchar(45) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  PRIMARY KEY (`asistecia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistencias`
--

LOCK TABLES `asistencias` WRITE;
/*!40000 ALTER TABLE `asistencias` DISABLE KEYS */;
/*!40000 ALTER TABLE `asistencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias_empleo`
--

DROP TABLE IF EXISTS `categorias_empleo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias_empleo` (
  `categoria_empleo_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`categoria_empleo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_empleo`
--

LOCK TABLES `categorias_empleo` WRITE;
/*!40000 ALTER TABLE `categorias_empleo` DISABLE KEYS */;
INSERT  IGNORE INTO `categorias_empleo` (`categoria_empleo_id`, `tipo`) VALUES (1,'Profesores'),(2,'Postulantes'),(3,'Otros');
/*!40000 ALTER TABLE `categorias_empleo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  PRIMARY KEY (`curso_id`),
  KEY `cursos_estados_fk_idx` (`estado_id`),
  KEY `cursos_niveles_fk_idx` (`nivel_id`),
  CONSTRAINT `cursos_estados_fk` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`estado_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cursos_niveles_fk` FOREIGN KEY (`nivel_id`) REFERENCES `nivel_educacion` (`nivel_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT  IGNORE INTO `cursos` (`curso_id`, `nombre`, `jornada`, `cant_alumnos`, `paralelo`, `estado_id`, `nivel_id`, `usuario_creacion`, `fecha_creacion`) VALUES (1,'Maternal','Matutino','15','1',1,1,'wilson','2017-04-07'),(2,'Nursery','Matutino','25','A',1,1,'wilson','2017-04-07'),(3,'Nursery','Matutino','25','B',1,1,'wilson','2017-04-07'),(4,'Kinder','Matutino','30','A',1,2,'wilson','2017-04-07'),(5,'Kinder','Matutino','30','B',1,2,'wilson','2017-04-07'),(6,'PreKinder','Matutino','25','C',1,2,'wilson','2017-04-07'),(7,'PreKinder','Matutino','25','A',1,2,'wilson','2017-04-07'),(8,'PreKinder','Matutino','50','B',1,2,'wilson','2017-04-07');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidades`
--

DROP TABLE IF EXISTS `especialidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especialidades` (
  `especialidad_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_empleo_id` int(11) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`especialidad_id`),
  KEY `fk_categoria_empleo_categoria_empleo_id_idx` (`categoria_empleo_id`),
  CONSTRAINT `fk_categoria_empleo_categoria_empleo_id` FOREIGN KEY (`categoria_empleo_id`) REFERENCES `categorias_empleo` (`categoria_empleo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidades`
--

LOCK TABLES `especialidades` WRITE;
/*!40000 ALTER TABLE `especialidades` DISABLE KEYS */;
INSERT  IGNORE INTO `especialidades` (`especialidad_id`, `categoria_empleo_id`, `descripcion`) VALUES (1,1,'Seleccione una Especialidad'),(2,1,'Licenciatura en Lingüística Inglesa'),(3,1,'Licenciada en Educación de Párvulos'),(4,1,'Educación de Párvulos'),(5,1,'Doctorado en Eduacación'),(6,1,'Psicóloga Educativa'),(7,1,'Licenciada en Terapia de Lenguaje'),(8,1,'Administración Educativa'),(9,1,'Auxiliar de Párvulos');
/*!40000 ALTER TABLE `especialidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_civil`
--

DROP TABLE IF EXISTS `estado_civil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
INSERT  IGNORE INTO `estado_civil` (`estado_civil_id`, `descripcion`) VALUES (1,'Soltero(a)'),(2,'Casado(a)'),(3,'Viudo(a)'),(4,'Divorciado(a)'),(5,'Unión de Hecho');
/*!40000 ALTER TABLE `estado_civil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados` (
  `estado_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`estado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT  IGNORE INTO `estados` (`estado_id`, `nombre`) VALUES (1,'activo'),(2,'desactivo'),(3,'eliminado');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factura`
--

DROP TABLE IF EXISTS `factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
INSERT  IGNORE INTO `factura` (`factura_id`, `n_factura`, `orden_pago_id`, `modo_pago_id`, `fecha_pago`) VALUES (1,123,1,1,'2018-08-25');
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generos`
--

DROP TABLE IF EXISTS `generos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
INSERT  IGNORE INTO `generos` (`genero_id`, `sexo`) VALUES (1,'Masculino'),(2,'Femenino');
/*!40000 ALTER TABLE `generos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_sangineo`
--

DROP TABLE IF EXISTS `grupo_sangineo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_sangineo` (
  `tipo_sangrineo_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`tipo_sangrineo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_sangineo`
--

LOCK TABLES `grupo_sangineo` WRITE;
/*!40000 ALTER TABLE `grupo_sangineo` DISABLE KEYS */;
INSERT  IGNORE INTO `grupo_sangineo` (`tipo_sangrineo_id`, `tipo`) VALUES (1,'Escoja Grupo Sanguineo'),(2,'O+'),(3,'O-'),(4,'B+'),(5,'B-'),(6,'A+'),(7,'A-'),(8,'AB+'),(9,'AB-');
/*!40000 ALTER TABLE `grupo_sangineo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instituciones`
--

DROP TABLE IF EXISTS `instituciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
INSERT  IGNORE INTO `instituciones` (`institucion_id`, `nombre`) VALUES (1,'Ninguna Institución'),(2,'IEES'),(3,'Banco Pacifico'),(4,'Seguros Sucre'),(5,'Junta de Beneficencia');
/*!40000 ALTER TABLE `instituciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lista_curso`
--

DROP TABLE IF EXISTS `lista_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lista_curso` (
  `lista_curso_id` int(11) NOT NULL AUTO_INCREMENT,
  `alumno_id` int(11) DEFAULT NULL,
  `salon_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `representante_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`lista_curso_id`),
  KEY `lista_alumnos_idx` (`alumno_id`),
  KEY `lista_salones_idx` (`salon_id`),
  KEY `lista_estado_idx` (`estado_id`),
  CONSTRAINT `lista_alumnos` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `lista_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`estado_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `lista_salones` FOREIGN KEY (`salon_id`) REFERENCES `salones` (`salon_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lista_curso`
--

LOCK TABLES `lista_curso` WRITE;
/*!40000 ALTER TABLE `lista_curso` DISABLE KEYS */;
INSERT  IGNORE INTO `lista_curso` (`lista_curso_id`, `alumno_id`, `salon_id`, `estado_id`, `representante_id`) VALUES (2,1,1,1,1);
/*!40000 ALTER TABLE `lista_curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lugares`
--

DROP TABLE IF EXISTS `lugares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
INSERT  IGNORE INTO `lugares` (`lugar_id`, `provincia`, `ciudad`) VALUES (1,'','Escoja lugar de Nacimiento'),(2,'AZUAY','CHORDELEG'),(3,'AZUAY','CUENCA'),(4,'AZUAY','EL PAN'),(5,'AZUAY','GIRON'),(6,'AZUAY','GUACHAPALA'),(7,'AZUAY','GUALACEO'),(8,'AZUAY','NABON'),(9,'AZUAY','ONA'),(10,'AZUAY','PAUTE'),(11,'AZUAY','PUCARA'),(12,'AZUAY','SAN FERNANDO'),(13,'AZUAY','SANTA ISABEL'),(14,'AZUAY','SEVILLA DE ORO'),(15,'AZUAY','SIGSIG'),(16,'BOLIVAR','CALUMA'),(17,'BOLIVAR','CHILLANES'),(18,'BOLIVAR','CHIMBO'),(19,'BOLIVAR','ECHEANDIA'),(20,'BOLIVAR','GUARANDA'),(21,'BOLIVAR','LAS NAVES'),(22,'BOLIVAR','SAN MIGUEL'),(23,'CANAR','AZOGUES'),(24,'CANAR','BIBLIAN'),(25,'CANAR','CANAR'),(26,'CANAR','DELEG'),(27,'CANAR','EL TAMBO'),(28,'CANAR','LA TRONCAL'),(29,'CANAR','SUSCAL'),(30,'CARCHI','BOLIVAR'),(31,'CARCHI','ESPEJO'),(32,'CARCHI','MIRA'),(33,'CARCHI','MONTUFAR (SAN GABRIEL)'),(34,'CARCHI','SAN PEDRO DE HUACA'),(35,'CARCHI','TULCAN'),(36,'CHIMBORAZO','ALAUSI'),(37,'CHIMBORAZO','CHAMBO'),(38,'CHIMBORAZO','CHUNCHI'),(39,'CHIMBORAZO','COLTA'),(40,'CHIMBORAZO','CUMANDA'),(41,'CHIMBORAZO','GUAMOTE'),(42,'CHIMBORAZO','GUANO'),(43,'CHIMBORAZO','PALLATANGA'),(44,'CHIMBORAZO','PENIPE'),(45,'CHIMBORAZO','RIOBAMBA'),(46,'COTOPAXI','LA MANA'),(47,'COTOPAXI','LASSO'),(48,'COTOPAXI','LATACUNGA'),(49,'COTOPAXI','PANGUA'),(50,'COTOPAXI','PUJILI'),(51,'COTOPAXI','SALCEDO'),(52,'COTOPAXI','SAQUISILI'),(53,'COTOPAXI','SIGCHOS'),(54,'EL ORO','ARENILLAS'),(55,'EL ORO','ATAHUALPA'),(56,'EL ORO','BALSAS'),(57,'EL ORO','CHILLA'),(58,'EL ORO','EL GUABO'),(59,'EL ORO','HUAQUILLAS'),(60,'EL ORO','LAS LAJAS'),(61,'EL ORO','MACHALA'),(62,'EL ORO','MARCABELI'),(63,'EL ORO','PASAJE'),(64,'EL ORO','PINAS'),(65,'EL ORO','PORTOVELO'),(66,'EL ORO','SANTA ROSA'),(67,'EL ORO','ZARUMA'),(68,'ESMERALDAS','ATACAMES'),(69,'ESMERALDAS','ELOY ALFARO (LIMONES)'),(70,'ESMERALDAS','ESMERALDAS'),(71,'ESMERALDAS','MUISNE'),(72,'ESMERALDAS','QUININDE'),(73,'ESMERALDAS','RIOVERDE'),(74,'ESMERALDAS','SAN LORENZO'),(75,'GALAPAGOS','ISABELA'),(76,'GALAPAGOS','SAN CRISTOBAL'),(77,'GALAPAGOS','SANTA CRUZ'),(78,'GUAYAS','ALFREDO BAQUERIZO MORENO (JUJAN)'),(79,'GUAYAS','BALAO'),(80,'GUAYAS','BALZAR'),(81,'GUAYAS','COLIMES'),(82,'GUAYAS','DAULE'),(83,'GUAYAS','DURAN'),(84,'GUAYAS','EL EMPALME'),(85,'GUAYAS','ELOY ALFARO (DURAN)'),(86,'GUAYAS','EL TRIUNFO'),(87,'GUAYAS','GENERAL ANTONIO ELIZALDE (BUCAY)'),(88,'GUAYAS','GUAYAQUIL'),(89,'GUAYAS','ISIDRO AYORA'),(90,'GUAYAS','LOMAS DE SARGENTILLO'),(91,'GUAYAS','CRNEL MARCELINO MARIDUENA'),(92,'GUAYAS','MILAGRO'),(93,'GUAYAS','NARANJAL'),(94,'GUAYAS','NARANJITO'),(95,'GUAYAS','NARCISA DE JESUS (NOBOL)'),(96,'GUAYAS','PALESTINA'),(97,'GUAYAS','PEDRO CARBO'),(98,'GUAYAS','PLAYAS (GENERAL VILLAMIL)'),(99,'GUAYAS','SALITRE (URBINA JADO)'),(100,'GUAYAS','SAMBORONDON'),(101,'GUAYAS','SANTA LUCIA'),(102,'GUAYAS','SIMON BOLIVAR'),(103,'GUAYAS','SAN JACINTO DE YAGUACHI'),(104,'GUAYAS','URBINA JADO'),(105,'IMBABURA','ANTONIO ANTE'),(106,'IMBABURA','ATUNTAQUI'),(107,'IMBABURA','COTACACHI'),(108,'IMBABURA','IBARRA'),(109,'IMBABURA','OTAVALO'),(110,'IMBABURA','PIMAMPIRO'),(111,'IMBABURA','SAN MIGUEL DE URCUQUI'),(112,'LOJA','CALVAS (CARIAMANGA)'),(113,'LOJA','CATAMAYO'),(114,'LOJA','CELICA'),(115,'LOJA','CHAGUARPAMBA'),(116,'LOJA','ESPINDOLA (AMALUZA)'),(117,'LOJA','GONZANAMA'),(118,'LOJA','LOJA'),(119,'LOJA','MACARA'),(120,'LOJA','OLMEDO'),(121,'LOJA','PALTAS'),(122,'LOJA','PINDAL'),(123,'LOJA','PUYANGO (ALAMOR)'),(124,'LOJA','QUILANGA'),(125,'LOJA','SARAGURO'),(126,'LOJA','SOZORANGA'),(127,'LOJA','ZAPOTILLO'),(128,'LOS RIOS','BABA'),(129,'LOS RIOS','BABAHOYO'),(130,'LOS RIOS','BUENA FE'),(131,'LOS RIOS','MOCACHE'),(132,'LOS RIOS','MONTALVO'),(133,'LOS RIOS','PALENQUE'),(134,'LOS RIOS','PUEBLOVIEJO'),(135,'LOS RIOS','QUEVEDO'),(136,'LOS RIOS','QUINSALOMA'),(137,'LOS RIOS','URDANETA'),(138,'LOS RIOS','VALENCIA'),(139,'LOS RIOS','VENTANAS'),(140,'LOS RIOS','VINCES'),(141,'MANABI','24 DE MAYO'),(142,'MANABI','BAHIA DE CARAQUEZ'),(143,'MANABI','BOLIVAR (CALCETA)'),(144,'MANABI','CHONE'),(145,'MANABI','EL CARMEN'),(146,'MANABI','FLAVIO ALFARO'),(147,'MANABI','JAMA'),(148,'MANABI','JARAMIJO'),(149,'MANABI','JIPIJAPA'),(150,'MANABI','JUNIN'),(151,'MANABI','MANTA'),(152,'MANABI','MONTECRISTI'),(153,'MANABI','OLMEDO'),(154,'MANABI','PAJAN'),(155,'MANABI','PEDERNALES'),(156,'MANABI','PICHINCHA'),(157,'MANABI','PORTOVIEJO'),(158,'MANABI','PUERTO LOPEZ'),(159,'MANABI','ROCAFUERTE'),(160,'MANABI','SAN VICENTE'),(161,'MANABI','SANTA ANA'),(162,'MANABI','SUCRE'),(163,'MANABI','TOSAGUA'),(164,'MORONA SANTIAGO','GUALAQUIZA'),(165,'MORONA SANTIAGO','HUAMBOYA'),(166,'MORONA SANTIAGO','LIMON INDANZA'),(167,'MORONA SANTIAGO','LOGRONO'),(168,'MORONA SANTIAGO','MORONA'),(169,'MORONA SANTIAGO','PABLO SEXTO'),(170,'MORONA SANTIAGO','PALORA'),(171,'MORONA SANTIAGO','SAN JUAN BOSCO'),(172,'MORONA SANTIAGO','SANTIAGO'),(173,'MORONA SANTIAGO','SUCUA'),(174,'MORONA SANTIAGO','TAISHA'),(175,'MORONA SANTIAGO','TIWINTZA'),(176,'NAPO','ARCHIDONA'),(177,'NAPO','CARLOS JULIO AROSEMENA TOLA'),(178,'NAPO','EL CHACO'),(179,'NAPO','QUIJOS (BAEZA)'),(180,'NAPO','TENA'),(181,'ORELLANA','AGUARICO'),(182,'ORELLANA','EL COCA'),(183,'ORELLANA','FRANCISCO DE ORELLANA'),(184,'ORELLANA','LA JOYA DE LOS SACHAS'),(185,'ORELLANA','LORETO'),(186,'ORELLANA','ORELLANA'),(187,'PASTAZA','ARAJUNO'),(188,'PASTAZA','MERA'),(189,'PASTAZA','PUYO'),(190,'PASTAZA','SANTA CLARA'),(191,'PICHINCHA','CAYAMBE'),(192,'PICHINCHA','MEJIA (MACHACHI)'),(193,'PICHINCHA','PEDRO MONCAYO (TABACUNDO)'),(194,'PICHINCHA','PEDRO VICENTE MALDONADO'),(195,'PICHINCHA','PUERTO QUITO'),(196,'PICHINCHA','QUITO'),(197,'PICHINCHA','RUMINAHUI'),(198,'PICHINCHA','SAN MIGUEL DE LOS BANCOS'),(199,'SANTA ELENA','LA LIBERTAD'),(200,'SANTA ELENA','SALINAS'),(201,'SANTA ELENA','SANTA ELENA'),(202,'SANTO DOMINGO DE LOS TSACHILAS','SANTO DOMINGO'),(203,'SANTO DOMINGO DE LOS TSACHILAS','LA CONCORDIA'),(204,'SUCUMBIOS','CASCALES'),(205,'SUCUMBIOS','CUYABENO'),(206,'SUCUMBIOS','GONZALO PIZARRO (LUMBAQUI)'),(207,'SUCUMBIOS','LA BONITA'),(208,'SUCUMBIOS','LAGO AGRIO'),(209,'SUCUMBIOS','NUEVA LOJA'),(210,'SUCUMBIOS','PUTUMAYO PUERTO EL CARMEN DEL PUTUMAYO'),(211,'SUCUMBIOS','SHUSHUFINDI'),(212,'SUCUMBIOS','SUCUMBIOS  (LA BONITA)'),(213,'SUCUMBIOS','TARAPOA'),(214,'TUNGURAHUA','AMBATO'),(215,'TUNGURAHUA','BANOS'),(216,'TUNGURAHUA','BANOS DE AGUA SANTA'),(217,'TUNGURAHUA','CEVALLOS'),(218,'TUNGURAHUA','MOCHA'),(219,'TUNGURAHUA','PATATE'),(220,'TUNGURAHUA','QUERO'),(221,'TUNGURAHUA','SAN PEDRO DE PELILEO'),(222,'TUNGURAHUA','SANTIAGO DE PILLARO'),(223,'TUNGURAHUA','TISALEO'),(224,'ZAMORA CHINCHIPE','CENTINELA DEL CONDOR (ZUMBI)'),(225,'ZAMORA CHINCHIPE','CHINCHIPE'),(226,'ZAMORA CHINCHIPE','EL PANGUI'),(227,'ZAMORA CHINCHIPE','NANGARITZA'),(228,'ZAMORA CHINCHIPE','PALANDA'),(229,'ZAMORA CHINCHIPE','PAQUISHA'),(230,'ZAMORA CHINCHIPE','YACUAMBI'),(231,'ZAMORA CHINCHIPE','YANZATZA'),(232,'ZAMORA CHINCHIPE','ZAMORA');
/*!40000 ALTER TABLE `lugares` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modo_pago`
--

DROP TABLE IF EXISTS `modo_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modo_pago` (
  `modo_pago_id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`modo_pago_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modo_pago`
--

LOCK TABLES `modo_pago` WRITE;
/*!40000 ALTER TABLE `modo_pago` DISABLE KEYS */;
/*!40000 ALTER TABLE `modo_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivel_educacion`
--

DROP TABLE IF EXISTS `nivel_educacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
INSERT  IGNORE INTO `nivel_educacion` (`nivel_id`, `nombre`, `descripcion`) VALUES (1,'Inicial 1','Niños de 1 a 3 años'),(2,'Inicial 2','Niños de 3 a 5 años');
/*!40000 ALTER TABLE `nivel_educacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orden_pagos`
--

DROP TABLE IF EXISTS `orden_pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orden_pagos` (
  `orden_pago_id` int(11) NOT NULL AUTO_INCREMENT,
  `servicio_id` int(11) DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `fecha_vencimiento_pago` date DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `lista_curso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`orden_pago_id`),
  KEY `servicio_id_fk_idx` (`servicio_id`),
  KEY `orden_pagos_tipo_id_fk_idx` (`estado_id`),
  KEY `orden_pagos_lista_fk_idx` (`lista_curso_id`),
  CONSTRAINT `orden_pagos_estados_fk` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`estado_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `orden_pagos_lista_fk` FOREIGN KEY (`lista_curso_id`) REFERENCES `lista_curso` (`lista_curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `orden_pagos_servicios_fk` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`servicio_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orden_pagos`
--

LOCK TABLES `orden_pagos` WRITE;
/*!40000 ALTER TABLE `orden_pagos` DISABLE KEYS */;
INSERT  IGNORE INTO `orden_pagos` (`orden_pago_id`, `servicio_id`, `fecha_pago`, `fecha_vencimiento_pago`, `estado_id`, `lista_curso_id`) VALUES (2,1,'2018-08-27','2018-08-31',1,2),(3,2,'2018-08-15','2018-08-31',1,2),(4,3,'2018-08-15','2018-08-31',1,2),(5,2,'2018-09-15','2018-09-30',1,2),(6,3,'2018-09-15','2018-09-30',1,2),(7,2,'2018-10-15','2018-10-31',1,2),(8,3,'2018-10-15','2018-10-31',1,2),(9,2,'2018-11-15','2018-11-30',1,2),(10,3,'2018-11-15','2018-11-30',1,2),(11,2,'2018-12-15','2018-12-31',1,2),(12,3,'2018-12-15','2018-12-31',1,2),(13,2,'2019-01-15','2019-01-31',1,2),(14,3,'2019-01-15','2019-01-31',1,2);
/*!40000 ALTER TABLE `orden_pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parentesco`
--

DROP TABLE IF EXISTS `parentesco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parentesco` (
  `parentesco_id` int(11) NOT NULL AUTO_INCREMENT,
  `parntesco` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`parentesco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parentesco`
--

LOCK TABLES `parentesco` WRITE;
/*!40000 ALTER TABLE `parentesco` DISABLE KEYS */;
INSERT  IGNORE INTO `parentesco` (`parentesco_id`, `parntesco`) VALUES (1,'Padre'),(2,'Madre'),(3,'Tio/a'),(4,'Abuelo/a');
/*!40000 ALTER TABLE `parentesco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodo_electivo`
--

DROP TABLE IF EXISTS `periodo_electivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodo_electivo` (
  `periodo_id` int(11) NOT NULL AUTO_INCREMENT,
  `anio_inicio` varchar(45) DEFAULT NULL,
  `anio_fin` varchar(45) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `fecha_inicio_periodo` date DEFAULT NULL,
  `fecha_fin_periodo` date DEFAULT NULL,
  PRIMARY KEY (`periodo_id`),
  KEY `periodo_electivo_estados_fk_idx` (`estado_id`),
  CONSTRAINT `periodo_electivo_estados_fk` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`estado_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo_electivo`
--

LOCK TABLES `periodo_electivo` WRITE;
/*!40000 ALTER TABLE `periodo_electivo` DISABLE KEYS */;
INSERT  IGNORE INTO `periodo_electivo` (`periodo_id`, `anio_inicio`, `anio_fin`, `estado_id`, `fecha_inicio_periodo`, `fecha_fin_periodo`) VALUES (1,'2017','2018',1,'2017-05-02','2018-02-23');
/*!40000 ALTER TABLE `periodo_electivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal`
--

DROP TABLE IF EXISTS `personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal` (
  `personal_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `cedula` varchar(20) DEFAULT NULL,
  `especialidad_id` int(11) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `usuario_creacion` varchar(45) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `genero_id` int(11) DEFAULT NULL,
  `estado_civil_id` int(11) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `fechaNac` date DEFAULT NULL,
  `fechaLaboral` date DEFAULT NULL,
  `aniosExperiencia` int(11) DEFAULT NULL,
  `cargas` int(11) DEFAULT NULL,
  `curriculum_direccion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`personal_id`),
  KEY `profesores_generos_idx` (`genero_id`),
  KEY `profesores_estados_idx` (`estado_id`),
  KEY `profesores_estado_civil_idx` (`estado_civil_id`),
  KEY `profesores_especialidades_fk_idx` (`especialidad_id`),
  KEY `profesor_id` (`personal_id`),
  KEY `profesor_id_2` (`personal_id`),
  CONSTRAINT `profesores_estado_civil` FOREIGN KEY (`estado_civil_id`) REFERENCES `estado_civil` (`estado_civil_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `profesores_estados` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`estado_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `profesores_generos` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`genero_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal`
--

LOCK TABLES `personal` WRITE;
/*!40000 ALTER TABLE `personal` DISABLE KEYS */;
INSERT  IGNORE INTO `personal` (`personal_id`, `nombres`, `apellidos`, `cedula`, `especialidad_id`, `telefono`, `mail`, `fecha_creacion`, `usuario_creacion`, `estado_id`, `genero_id`, `estado_civil_id`, `direccion`, `fechaNac`, `fechaLaboral`, `aniosExperiencia`, `cargas`, `curriculum_direccion`) VALUES (1,'Ingrid Magdalena','Piure Villagomez','0916689821',3,'042441132','estempranaplazadanin@hotmail.com',NULL,NULL,1,2,2,'Callejon camal 316 y Robles','1976-11-03',NULL,NULL,NULL,NULL),(2,'Ketty Gardenia','Cedeño Franco','0915853857',3,'0993306833','ketty.cedeno@hotmail.com',NULL,NULL,1,2,5,'Guasmo central coop. nueva granada mz 15 sl 5','1972-07-05','2012-05-03',NULL,NULL,NULL),(3,'Mariuxi Maribel','Landazuri Calderón','0913677340',3,'0983711074','mmlc_gye@hotmail.com',NULL,NULL,1,2,2,'Cdla. Floresta 1 Mz 19 V 23','1974-10-05','2010-05-03',NULL,NULL,NULL),(4,'Priscila Tatiana','Zamora Crespo','0926300013',2,'042047226','priscilazamora2605@yahoo.es',NULL,NULL,1,2,2,'Km. 6 1/2 vía Daule','1989-05-26',NULL,NULL,NULL,NULL),(5,'Rita Elizabeth','Granados Guzman','0907751523',3,'0979311693','rita_parvularia@hotmail.com',NULL,NULL,1,2,2,'Letamendi 1314 y Pedro Moncayo','1959-05-22','2010-03-03',NULL,NULL,NULL),(6,'Ruth Esther','Peredo Cordova','0910591155',3,'0996127115','miyatoys@hotmail.com','2017-04-12','priscilazamora2605@yahoo.es',1,2,2,'Guasmo central coop. hogar para los pobres mz 7 sl 20','1937-05-31','2017-04-03',NULL,NULL,NULL),(7,'Mayra Yadira ','Posligua Zambrano ','1309169512',8,'0993218913','mayra_yadira1212@hotmail.com','2017-04-25','3',1,2,1,'CAMILO DESTRUJE 1106 Y VILLAVICENCIO','1977-03-15','2009-05-13',7,1,'curriculum/1309169512.pdf'),(8,'Wilson Olmedo ','Quinto Gutierrez','0941106080',3,'3241232','Wilson.quinto@yahoo.es','2017-04-26','3',1,1,5,'Guayaquil','2017-03-28',NULL,0,0,'');
/*!40000 ALTER TABLE `personal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `representantes`
--

DROP TABLE IF EXISTS `representantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `representantes` (
  `representante_id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(13) DEFAULT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `genero_id` int(11) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `usuario_creacion` varchar(45) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `estado_civil_id` int(11) DEFAULT NULL,
  `certificado_direccion` varchar(200) DEFAULT NULL,
  `parentesco_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`representante_id`),
  KEY `representantes_generos_idx` (`genero_id`),
  KEY `representantes_estados_idx` (`estado_id`),
  KEY `representante_estado_civil_idx` (`estado_civil_id`),
  CONSTRAINT `representante_estado_civil` FOREIGN KEY (`estado_civil_id`) REFERENCES `estado_civil` (`estado_civil_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `representantes_estados` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`estado_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `representantes_generos` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`genero_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `representantes`
--

LOCK TABLES `representantes` WRITE;
/*!40000 ALTER TABLE `representantes` DISABLE KEYS */;
INSERT  IGNORE INTO `representantes` (`representante_id`, `cedula`, `nombres`, `apellidos`, `genero_id`, `direccion`, `telefono`, `fecha_nacimiento`, `email`, `fecha_creacion`, `usuario_creacion`, `estado_id`, `estado_civil_id`, `certificado_direccion`, `parentesco_id`) VALUES (1,'0915291488','Danny José','Rí­os Tigrero',1,'Desconocida','0988856264','1987-05-26','xxxx@ninguno.es','2017-04-26','3',1,2,NULL,1),(2,'0917398356','Juan Carlos ','Carrillo Valencia',1,'nueva Venecia Mz B Villa 40','0980062280','1979-07-14','juancarlos.carrillovalencia@gmail.com','2017-04-18','3',1,2,'certificadoTrabajo/defaul.jpg',2),(3,'0941106080','Wilson Olmedo','Quinto Gutierrez',1,'Guasmo central coop. hogar para los pobres mz','0967808374','2017-03-28','wilsson.quinto@yahoo.es','2017-04-25','1',1,2,'certificadoTrabajo/defaul.jpg',2),(4,'0920185857','Diana Carolina ','Navarro Bastidas ',2,'ninguna','0000000000','1985-08-03','ningun@a','2017-04-26','3',1,2,'certificadoTrabajo/defaul.jpg',1);
/*!40000 ALTER TABLE `representantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salones`
--

DROP TABLE IF EXISTS `salones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salones` (
  `salon_id` int(11) NOT NULL AUTO_INCREMENT,
  `curso_id` int(11) DEFAULT NULL,
  `periodo_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_creacion` varchar(45) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  PRIMARY KEY (`salon_id`),
  KEY `salones_cursos_idx` (`curso_id`),
  KEY `salones_periodos_idx` (`periodo_id`),
  KEY `salones_estados_idx` (`estado_id`),
  CONSTRAINT `salones_cursos` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `salones_estados` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`estado_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `salones_periodos` FOREIGN KEY (`periodo_id`) REFERENCES `periodo_electivo` (`periodo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salones`
--

LOCK TABLES `salones` WRITE;
/*!40000 ALTER TABLE `salones` DISABLE KEYS */;
INSERT  IGNORE INTO `salones` (`salon_id`, `curso_id`, `periodo_id`, `estado_id`, `usuario_creacion`, `fecha_creacion`) VALUES (1,1,1,1,'1','2017-04-25'),(2,2,1,1,'1','2017-04-25'),(3,7,1,1,'1','2017-04-25'),(4,4,1,1,'1','2017-04-25'),(5,6,1,1,'3','2017-04-26'),(6,3,1,1,'3','2017-04-26'),(7,5,1,1,'3','2017-04-26'),(8,8,1,1,'3','2017-04-26');
/*!40000 ALTER TABLE `salones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicios` (
  `servicio_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `valor_servicio` int(11) DEFAULT NULL,
  `tipo_servicio_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`servicio_id`),
  KEY `tipo_servicio_id_fk_idx` (`tipo_servicio_id`),
  KEY `servicios_estados_fk_idx` (`estado_id`),
  CONSTRAINT `servicios_estados_fk` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`estado_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `servicios_tipo_servicio_fk` FOREIGN KEY (`tipo_servicio_id`) REFERENCES `tipo_servicio` (`tipo_servicio_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT  IGNORE INTO `servicios` (`servicio_id`, `nombre`, `valor_servicio`, `tipo_servicio_id`, `estado_id`) VALUES (1,'Matricula',80,1,1),(2,'Pension',130,1,1),(3,'servicios complementarios de guardería medio tiemp',20,1,1),(4,'servicios complementarios de guardería tiempo comp',80,1,1);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_servicio`
--

DROP TABLE IF EXISTS `tipo_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_servicio` (
  `tipo_servicio_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`tipo_servicio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_servicio`
--

LOCK TABLES `tipo_servicio` WRITE;
/*!40000 ALTER TABLE `tipo_servicio` DISABLE KEYS */;
INSERT  IGNORE INTO `tipo_servicio` (`tipo_servicio_id`, `nombre`) VALUES (1,'Fijos'),(2,'Temporales'),(3,'Adicionales');
/*!40000 ALTER TABLE `tipo_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(10) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `tipo` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT  IGNORE INTO `usuarios` (`usuario_id`, `cedula`, `estado`, `nombre`, `usuario`, `clave`, `tipo`) VALUES (1,'0941106080','1','Wilson','wilson','wilson','a'),(2,'0930233762','2','Ka','ka@gmail.com','123456','a'),(3,'0926300013','1','Priscila Zamora','priscilazamora2605@yahoo.es','jesus1811','a');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'innovasystemcom_jardin'
--

--
-- Dumping routines for database 'innovasystemcom_jardin'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-27  9:26:52

-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-12-2018 a las 05:30:48
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

CREATE DATABASE administracion_colegio;
USE administracion_colegio;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `administracion_usuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `id_Actividad` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `año` int(11) NOT NULL,
  `descripcion` varchar(75) COLLATE latin1_spanish_ci NOT NULL,
  `lugar` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `hora` datetime NOT NULL,
  `duración` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_curso`
--

CREATE TABLE `actividad_curso` (
  `id_Actividad_curso` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `año` int(11) NOT NULL,
  `descripcion` varchar(75) COLLATE latin1_spanish_ci NOT NULL,
  `lugar` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `hora` datetime NOT NULL,
  `duración` time NOT NULL,
  `curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adjunto`
--

CREATE TABLE `adjunto` (
  `id_documento` int(11) NOT NULL,
  `link` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `mensaje_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `admin_id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `apellido` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `correo` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `foto` blob NOT NULL,
  `cedula` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `usuarios_usuario_id` int(11) NOT NULL,
  `cedula_copy1` varchar(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `cedula` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `nombres` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `apellidos` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `genero_id` int(11) NOT NULL,
  `direccion` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `lugar_id` int(11) NOT NULL,
  `foto_direccion` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `usuario_creacion` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `estado_id` int(11) NOT NULL,
  `instituciones_id` int(11) NOT NULL,
  `observacion` varchar(250) COLLATE latin1_spanish_ci NOT NULL,
  `pension` double NOT NULL,
  `cursos_curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autorizacion`
--

CREATE TABLE `autorizacion` (
  `idautorizacion` int(11) NOT NULL,
  `tipo` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `alumno_cedula` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `parentesco_id` int(11) NOT NULL,
  `autorizado_cedula` varchar(12) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autorizado`
--

CREATE TABLE `autorizado` (
  `nombre` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `apellido` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `correo` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `estado_civil_id` int(11) NOT NULL,
  `genero_id` int(11) NOT NULL,
  `cedula` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `foto` blob NOT NULL,
  `fechaNac` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citacion`
--

CREATE TABLE `citacion` (
  `id_citacion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `duración` time NOT NULL,
  `hora` timestamp(5) NOT NULL DEFAULT CURRENT_TIMESTAMP(5) ON UPDATE CURRENT_TIMESTAMP(5)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `curso_id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `jornada` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `cant_alumnos` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `paralelo` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `estado_id` int(11) NOT NULL,
  `nivel_id` int(11) NOT NULL,
  `usuario_creacion` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `dirigente` int(11) NOT NULL,
  `periodo_electivo_periodo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_medicos`
--

CREATE TABLE `datos_medicos` (
  `tiene_discapacidad` tinyint(4) NOT NULL,
  `porcentaje_discapacidad` int(11) NOT NULL,
  `tipo_discapacidad` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `alumnos_cedula` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `idgrupo_sanguuineo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_materia`
--

CREATE TABLE `detalle_materia` (
  `id_detalle_materia` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `personal_personal_id` int(11) NOT NULL,
  `cursos_curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `estado_id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_civil`
--

CREATE TABLE `estado_civil` (
  `estado_civil_id` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `factura_id` int(11) NOT NULL,
  `n_factura` int(11) NOT NULL,
  `orden_pago__id` int(11) NOT NULL,
  `modo_pago_id` int(11) NOT NULL,
  `fecha_pago` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `genero_id` int(11) NOT NULL,
  `sexo` varchar(45) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_sanguineo`
--

CREATE TABLE `grupo_sanguineo` (
  `idgrupo_sanguineo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL,
  `dia` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `detalle_materia_id_detalle_materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituciones`
--

CREATE TABLE `instituciones` (
  `institucion_id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares`
--

CREATE TABLE `lugares` (
  `lugar_id` int(11) NOT NULL,
  `provincia` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `ciudad` varchar(45) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL,
  `imagen` blob NOT NULL,
  `descripcion` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id_mensaje` int(11) NOT NULL,
  `asunto` varchar(35) COLLATE latin1_spanish_ci NOT NULL,
  `contenido` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `tipo` varchar(25) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje_autorizado`
--

CREATE TABLE `mensaje_autorizado` (
  `id_mensaje_autorizado` int(11) NOT NULL,
  `id_mensaje` int(11) NOT NULL,
  `cedula_autorizado` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `cedula_alumno` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `profesor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje_curso`
--

CREATE TABLE `mensaje_curso` (
  `id_mensaje_curso` int(11) NOT NULL,
  `profesor` int(11) NOT NULL,
  `mensaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_educacion`
--

CREATE TABLE `nivel_educacion` (
  `nivel_id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `noticia_id` int(11) NOT NULL,
  `titulo` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` text COLLATE latin1_spanish_ci NOT NULL,
  `foto` blob NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parentesco`
--

CREATE TABLE `parentesco` (
  `idparentesco` int(11) NOT NULL,
  `parentesco` varchar(45) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo_electivo`
--

CREATE TABLE `periodo_electivo` (
  `periodo_id` int(11) NOT NULL,
  `anio_inicio` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `anio_fin` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `estado_id` int(11) NOT NULL,
  `fecha_inicio_periodo` date NOT NULL,
  `fecha_fin_periodo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `personal_id` int(11) NOT NULL,
  `nombres` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `apellidos` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `especialidad_id` int(11) NOT NULL,
  `telefono` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `mail` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `usuario_creacion` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `genero_id` int(11) NOT NULL,
  `estado_civil_id` int(11) NOT NULL,
  `direccion` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `fechaNac` date NOT NULL,
  `fechaLaboral` date NOT NULL,
  `aniosExperiencia` int(11) NOT NULL,
  `cargas` int(11) NOT NULL,
  `curriculum_direccion` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `foto` blob NOT NULL,
  `cedula` varchar(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonos`
--

CREATE TABLE `telefonos` (
  `cedula` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `clave` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `tipo` varchar(2) COLLATE latin1_spanish_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id_Actividad`);

--
-- Indices de la tabla `actividad_curso`
--
ALTER TABLE `actividad_curso`
  ADD PRIMARY KEY (`id_Actividad_curso`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Indices de la tabla `adjunto`
--
ALTER TABLE `adjunto`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `mensaje_id` (`mensaje_id`);

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `usuarios_usuario_id` (`usuarios_usuario_id`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `instituciones_id` (`instituciones_id`),
  ADD KEY `lugar_id` (`lugar_id`),
  ADD KEY `genero_id` (`genero_id`);

--
-- Indices de la tabla `autorizacion`
--
ALTER TABLE `autorizacion`
  ADD PRIMARY KEY (`idautorizacion`),
  ADD KEY `autorizado_cedula` (`autorizado_cedula`),
  ADD KEY `alumno_cedula` (`alumno_cedula`),
  ADD KEY `parentesco_id` (`parentesco_id`);

--
-- Indices de la tabla `autorizado`
--
ALTER TABLE `autorizado`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `genero_id` (`genero_id`),
  ADD KEY `estado_civil_id` (`estado_civil_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `citacion`
--
ALTER TABLE `citacion`
  ADD PRIMARY KEY (`id_citacion`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`curso_id`),
  ADD KEY `estado_id` (`estado_id`),
  ADD KEY `nivel_id` (`nivel_id`),
  ADD KEY `periodo_electivo_periodo_id` (`periodo_electivo_periodo_id`),
  ADD KEY `dirigente` (`dirigente`);

--
-- Indices de la tabla `datos_medicos`
--
ALTER TABLE `datos_medicos`
  ADD PRIMARY KEY (`alumnos_cedula`),
  ADD KEY `idgrupo_sanguuineo` (`idgrupo_sanguuineo`);

--
-- Indices de la tabla `detalle_materia`
--
ALTER TABLE `detalle_materia`
  ADD PRIMARY KEY (`id_detalle_materia`),
  ADD KEY `cursos_curso_id` (`cursos_curso_id`),
  ADD KEY `personal_personal_id` (`personal_personal_id`),
  ADD KEY `materia_id` (`materia_id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`estado_id`);

--
-- Indices de la tabla `estado_civil`
--
ALTER TABLE `estado_civil`
  ADD PRIMARY KEY (`estado_civil_id`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`genero_id`),
  ADD KEY `genero_id` (`genero_id`);

--
-- Indices de la tabla `grupo_sanguineo`
--
ALTER TABLE `grupo_sanguineo`
  ADD PRIMARY KEY (`idgrupo_sanguineo`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `detalle_materia_id_detalle_materia` (`detalle_materia_id_detalle_materia`);

--
-- Indices de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  ADD PRIMARY KEY (`institucion_id`);

--
-- Indices de la tabla `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`lugar_id`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id_mensaje`);

--
-- Indices de la tabla `mensaje_autorizado`
--
ALTER TABLE `mensaje_autorizado`
  ADD PRIMARY KEY (`id_mensaje_autorizado`),
  ADD KEY `cedula_autorizado` (`cedula_autorizado`),
  ADD KEY `id_mensaje` (`id_mensaje`),
  ADD KEY `cedula_alumno` (`cedula_alumno`),
  ADD KEY `profesor_id` (`profesor_id`);

--
-- Indices de la tabla `mensaje_curso`
--
ALTER TABLE `mensaje_curso`
  ADD PRIMARY KEY (`id_mensaje_curso`),
  ADD KEY `mensaje` (`mensaje`),
  ADD KEY `profesor` (`profesor`);

--
-- Indices de la tabla `nivel_educacion`
--
ALTER TABLE `nivel_educacion`
  ADD PRIMARY KEY (`nivel_id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`noticia_id`);

--
-- Indices de la tabla `parentesco`
--
ALTER TABLE `parentesco`
  ADD PRIMARY KEY (`idparentesco`);

--
-- Indices de la tabla `periodo_electivo`
--
ALTER TABLE `periodo_electivo`
  ADD PRIMARY KEY (`periodo_id`),
  ADD KEY `estado_id` (`estado_id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`personal_id`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD KEY `genero_id` (`genero_id`),
  ADD KEY `estado_civil_id` (`estado_civil_id`);

--
-- Indices de la tabla `telefonos`
--
ALTER TABLE `telefonos`
  ADD PRIMARY KEY (`cedula`,`telefono`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad_curso`
--
ALTER TABLE `actividad_curso`
  ADD CONSTRAINT `actividad_curso_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`curso_id`);

--
-- Filtros para la tabla `adjunto`
--
ALTER TABLE `adjunto`
  ADD CONSTRAINT `adjunto_ibfk_1` FOREIGN KEY (`mensaje_id`) REFERENCES `mensaje` (`id_mensaje`);

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`usuarios_usuario_id`) REFERENCES `usuario` (`usuario_id`);

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`instituciones_id`) REFERENCES `instituciones` (`institucion_id`),
  ADD CONSTRAINT `alumno_ibfk_2` FOREIGN KEY (`lugar_id`) REFERENCES `lugares` (`lugar_id`),
  ADD CONSTRAINT `alumno_ibfk_3` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`genero_id`);

--
-- Filtros para la tabla `autorizacion`
--
ALTER TABLE `autorizacion`
  ADD CONSTRAINT `autorizacion_ibfk_1` FOREIGN KEY (`autorizado_cedula`) REFERENCES `autorizado` (`cedula`),
  ADD CONSTRAINT `autorizacion_ibfk_2` FOREIGN KEY (`alumno_cedula`) REFERENCES `alumno` (`cedula`),
  ADD CONSTRAINT `autorizacion_ibfk_3` FOREIGN KEY (`parentesco_id`) REFERENCES `parentesco` (`idparentesco`);

--
-- Filtros para la tabla `autorizado`
--
ALTER TABLE `autorizado`
  ADD CONSTRAINT `autorizado_ibfk_1` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`genero_id`),
  ADD CONSTRAINT `autorizado_ibfk_2` FOREIGN KEY (`estado_civil_id`) REFERENCES `estado_civil` (`estado_civil_id`),
  ADD CONSTRAINT `autorizado_ibfk_3` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);

--
-- Filtros para la tabla `citacion`
--
ALTER TABLE `citacion`
  ADD CONSTRAINT `citacion_ibfk_1` FOREIGN KEY (`id_citacion`) REFERENCES `mensaje` (`id_mensaje`);

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`estado_id`),
  ADD CONSTRAINT `cursos_ibfk_2` FOREIGN KEY (`nivel_id`) REFERENCES `nivel_educacion` (`nivel_id`),
  ADD CONSTRAINT `cursos_ibfk_3` FOREIGN KEY (`periodo_electivo_periodo_id`) REFERENCES `periodo_electivo` (`periodo_id`),
  ADD CONSTRAINT `cursos_ibfk_4` FOREIGN KEY (`dirigente`) REFERENCES `personal` (`personal_id`);

--
-- Filtros para la tabla `datos_medicos`
--
ALTER TABLE `datos_medicos`
  ADD CONSTRAINT `datos_medicos_ibfk_1` FOREIGN KEY (`alumnos_cedula`) REFERENCES `alumno` (`cedula`),
  ADD CONSTRAINT `datos_medicos_ibfk_2` FOREIGN KEY (`idgrupo_sanguuineo`) REFERENCES `grupo_sanguineo` (`idgrupo_sanguineo`);

--
-- Filtros para la tabla `detalle_materia`
--
ALTER TABLE `detalle_materia`
  ADD CONSTRAINT `detalle_materia_ibfk_1` FOREIGN KEY (`cursos_curso_id`) REFERENCES `cursos` (`curso_id`),
  ADD CONSTRAINT `detalle_materia_ibfk_2` FOREIGN KEY (`personal_personal_id`) REFERENCES `personal` (`personal_id`),
  ADD CONSTRAINT `detalle_materia_ibfk_3` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id_materia`);

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`detalle_materia_id_detalle_materia`) REFERENCES `detalle_materia` (`id_detalle_materia`);

--
-- Filtros para la tabla `mensaje_autorizado`
--
ALTER TABLE `mensaje_autorizado`
  ADD CONSTRAINT `mensaje_autorizado_ibfk_1` FOREIGN KEY (`cedula_autorizado`) REFERENCES `autorizado` (`cedula`),
  ADD CONSTRAINT `mensaje_autorizado_ibfk_2` FOREIGN KEY (`id_mensaje`) REFERENCES `mensaje` (`id_mensaje`),
  ADD CONSTRAINT `mensaje_autorizado_ibfk_3` FOREIGN KEY (`cedula_alumno`) REFERENCES `alumno` (`cedula`),
  ADD CONSTRAINT `mensaje_autorizado_ibfk_4` FOREIGN KEY (`profesor_id`) REFERENCES `personal` (`personal_id`);

--
-- Filtros para la tabla `mensaje_curso`
--
ALTER TABLE `mensaje_curso`
  ADD CONSTRAINT `mensaje_curso_ibfk_1` FOREIGN KEY (`mensaje`) REFERENCES `mensaje` (`id_mensaje`),
  ADD CONSTRAINT `mensaje_curso_ibfk_2` FOREIGN KEY (`profesor`) REFERENCES `personal` (`personal_id`);

--
-- Filtros para la tabla `periodo_electivo`
--
ALTER TABLE `periodo_electivo`
  ADD CONSTRAINT `periodo_electivo_ibfk_1` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`estado_id`);

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`genero_id`),
  ADD CONSTRAINT `personal_ibfk_2` FOREIGN KEY (`estado_civil_id`) REFERENCES `estado_civil` (`estado_civil_id`);

--
-- Filtros para la tabla `telefonos`
--
ALTER TABLE `telefonos`
  ADD CONSTRAINT `telefonos_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `autorizado` (`cedula`),
  ADD CONSTRAINT `telefonos_ibfk_2` FOREIGN KEY (`cedula`) REFERENCES `personal` (`cedula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

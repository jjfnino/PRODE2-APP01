-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2015 a las 19:30:49
-- Versión del servidor: 5.5.36
-- Versión de PHP: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `copa2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Banners`
--

CREATE TABLE IF NOT EXISTS `Banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `seccion` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `rutafoto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Equipos`
--

CREATE TABLE IF NOT EXISTS `Equipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `bandera` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grupo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rutafoto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `Equipos`
--

INSERT INTO `Equipos` (`id`, `nombre`, `bandera`, `grupo`, `rutafoto`) VALUES
(1, 'Argentina', 'arg', 'B', 'equipos-554269b4c5a6e-foto1.jpg'),
(2, 'Chile', 'chi', 'A', 'equipos-55426a89bf065-foto1.jpg'),
(3, 'Mexico', 'mex', 'A', 'equipos-55426a9496702-foto1.jpg'),
(4, 'Ecuador', 'ecu', 'A', 'equipos-55426aa194d14-foto1.jpg'),
(5, 'Bolivia', 'bol', 'A', 'equipos-55426aad422f1-foto1.jpg'),
(6, 'Uruguay', 'uru', 'B', 'equipos-55426abf2350c-foto1.jpg'),
(7, 'Paraguay', 'par', 'B', 'equipos-55426acaf0b8c-foto1.jpg'),
(8, 'Jamaica', 'jam', 'B', 'equipos-55426ad76c620-foto1.jpg'),
(9, 'Brasil', 'bra', 'C', 'equipos-55426ae25f6dc-foto1.jpg'),
(10, 'Colombia', 'col', 'C', 'equipos-55426aed48206-foto1.jpg'),
(11, 'Venezuela', 'ven', 'C', 'equipos-55426af80a4fe-foto1.jpg'),
(12, 'Peru', 'per', 'C', 'equipos-5543cf32565c5-foto1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Jugada`
--

CREATE TABLE IF NOT EXISTS `Jugada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_partido` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `equipoa` int(11) DEFAULT NULL,
  `equipob` int(11) DEFAULT NULL,
  `golesa` int(11) NOT NULL,
  `golesb` int(11) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `procesado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `Jugada`
--

INSERT INTO `Jugada` (`id`, `id_partido`, `email`, `fecha_alta`, `equipoa`, `equipob`, `golesa`, `golesb`, `puntos`, `procesado`) VALUES
(2, 1, 'elbatidelagente@gmail.com', '2015-05-02 20:51:58', NULL, NULL, 2, 2, 0, 0),
(3, 2, 'elbatidelagente@gmail.com', '2015-05-02 21:31:25', NULL, NULL, 3, 1, 0, 0),
(4, 3, 'elbatidelagente@gmail.com', '2015-05-02 21:37:45', NULL, NULL, 2, 3, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Paises`
--

CREATE TABLE IF NOT EXISTS `Paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `bandera` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grupo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Partidos`
--

CREATE TABLE IF NOT EXISTS `Partidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipoa_id` int(11) DEFAULT NULL,
  `equipob_id` int(11) DEFAULT NULL,
  `sede_id` int(11) DEFAULT NULL,
  `ronda` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `grupo` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `golesa` int(11) DEFAULT NULL,
  `golesb` int(11) DEFAULT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75E40DA0C3D8870F` (`equipoa_id`),
  KEY `IDX_75E40DA0D16D28E1` (`equipob_id`),
  KEY `IDX_75E40DA0E19F41BF` (`sede_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `Partidos`
--

INSERT INTO `Partidos` (`id`, `equipoa_id`, `equipob_id`, `sede_id`, `ronda`, `grupo`, `golesa`, `golesb`, `hora`, `fecha`, `estado`) VALUES
(1, 2, 4, 5, '1', 'A', NULL, NULL, '19:30:00', '2015-06-11', 1),
(2, 3, 5, 8, '1', 'A', NULL, NULL, '19:30:00', '2015-06-12', 1),
(3, 6, 8, 1, '1', 'B', NULL, NULL, '15:00:00', '2015-06-13', 1),
(4, 1, 7, 3, '1', 'B', NULL, NULL, '18:30:00', '2015-06-13', 1),
(5, 10, 11, 4, '1', 'C', NULL, NULL, '16:00:00', '2015-06-14', 1),
(6, 9, 12, 6, '1', 'C', NULL, NULL, '18:30:00', '2015-06-14', 1),
(7, 4, 5, 7, '1', 'A', NULL, NULL, '18:00:00', '2015-06-15', 1),
(8, 2, 3, 5, '1', 'A', NULL, NULL, '20:30:00', '2015-06-15', 1),
(9, 7, 8, 1, '1', 'B', NULL, NULL, '18:00:00', '2015-06-16', 1),
(10, 1, 6, 3, '1', 'B', NULL, NULL, '20:30:00', '2015-06-16', 1),
(11, 9, 10, 5, '1', 'C', NULL, NULL, '21:00:00', '2015-06-17', 1),
(12, 12, 11, 7, '1', 'C', NULL, NULL, '20:30:00', '2015-06-18', 1),
(13, 3, 4, 4, '1', 'A', NULL, NULL, '18:00:00', '2015-06-19', 1),
(14, 2, 5, 5, '1', 'A', NULL, NULL, '20:30:00', '2015-06-19', 1),
(15, 6, 7, 3, '1', 'B', NULL, NULL, '16:00:00', '2015-06-20', 1),
(16, 1, 8, 8, '1', 'B', NULL, NULL, '18:30:00', '2015-06-20', 1),
(17, 10, 12, 6, '1', 'C', NULL, NULL, '16:00:00', '2015-06-21', 1),
(18, 9, 11, 5, '1', 'C', NULL, NULL, '18:30:00', '2015-06-21', 1),
(19, NULL, NULL, 5, '2', 'CUA', NULL, NULL, '19:30:00', '2015-06-24', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Premios`
--

CREATE TABLE IF NOT EXISTS `Premios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `categoria` int(11) DEFAULT NULL,
  `puesto` int(11) NOT NULL,
  `orden` int(11) DEFAULT NULL,
  `rutafoto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `style` int(11) DEFAULT NULL,
  `detalle` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Premios`
--

INSERT INTO `Premios` (`id`, `titulo`, `categoria`, `puesto`, `orden`, `rutafoto`, `estado`, `style`, `detalle`) VALUES
(1, 'Led Smart TV', 1, 1, NULL, 'premios-55458f8e72166-foto1.jpg', 1, 1, 'Un LG 42" led Smart tv para ti'),
(2, 'IPhone 5s', 1, 2, NULL, 'premios-55458fcb1e37b-foto1.jpg', 1, 1, 'Un Iphone 5s color a elección'),
(3, 'Play Station 4', 1, 3, NULL, 'premios-554599ae70af3-foto1.jpg', 1, 1, 'PS4 con un control inalambrico'),
(4, 'Sillón reclinable', 2, 1000, NULL, 'premios-554590f9d527f-foto1.jpg', 1, 2, 'Sillón reclinable'),
(5, 'Home Theater', 2, 500, NULL, 'premios-5545919f107d0-foto1.jpg', 1, 2, 'Home Theater');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sedes`
--

CREATE TABLE IF NOT EXISTS `Sedes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `Sedes`
--

INSERT INTO `Sedes` (`id`, `nombre`) VALUES
(1, 'Antofagasta'),
(2, 'Concepción'),
(3, 'La Serena'),
(4, 'Rancagua'),
(5, 'Santiago'),
(6, 'Temuco'),
(7, 'Valparaíso'),
(8, 'Viña del Mar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pais_id` int(11) DEFAULT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `empresa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `apodo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `comision` int(11) DEFAULT NULL,
  `sexo` int(11) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `ciudad` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `equipo` int(11) DEFAULT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deacuerdo` int(11) NOT NULL,
  `prodecomp` int(11) DEFAULT NULL,
  `perfilpublico` int(11) DEFAULT NULL,
  `jugadapublico` int(11) DEFAULT NULL,
  `triviacomp` int(11) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `puntosventa` int(11) DEFAULT NULL,
  `puntostrivia` int(11) DEFAULT NULL,
  `puntospartido` int(11) DEFAULT NULL,
  `puntoscambio` int(11) DEFAULT NULL,
  `ingresos` int(11) DEFAULT NULL,
  `puesto` int(11) DEFAULT NULL,
  `rutafoto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EDD889C1C604D5C6` (`pais_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`id`, `pais_id`, `nombre`, `apellido`, `email`, `dni`, `password`, `empresa`, `estado`, `apodo`, `comision`, `sexo`, `fecha_nacimiento`, `ciudad`, `area`, `telefono`, `equipo`, `fecha_alta`, `fecha_modificacion`, `salt`, `token`, `deacuerdo`, `prodecomp`, `perfilpublico`, `jugadapublico`, `triviacomp`, `puntos`, `puntosventa`, `puntostrivia`, `puntospartido`, `puntoscambio`, `ingresos`, `puesto`, `rutafoto`, `roles`, `tipo`) VALUES
(1, NULL, 'Francisco', 'Niño', 'jjfnino@gmail.com', '12.124.124', 'Ezh1Skc86FMlBuPew5pIXvRv8cKIRcsNTlQPAeM/XftOXtX2BoDW7hns4V5c+AP7rVt5cHbKqIyhewWPYCqdHQ==', 'La Citruca', 1, 'Fran84', 0, 0, '1989-07-02', 'Bs As', '011', '154658756', NULL, '2015-04-24 00:13:11', '2015-04-24 00:13:11', '98226304c508f544e87386ac223820e6', NULL, 1, 0, NULL, NULL, 0, 50, 50, NULL, NULL, 50, NULL, NULL, NULL, 'a:1:{i:0;s:12:"ROLE_USUARIO";}', 1),
(2, NULL, 'Francisco', 'Niño', 'jjfnino2@gmail.com', '12.124.124', 'csysfI4eMQN3U7Jhm3+K7btDbm91ktLVSrhE7wiU2wC5m0EBe1G/73aIKV6ZKvOjUfnVn4Od0O6QMg9TTffhNw==', 'La Citruca', 1, 'Fran85', 0, 0, '1989-07-02', 'Bs As', '011', '154658756', NULL, '2015-04-24 00:19:43', '2015-04-24 00:19:43', '18abf024f4e415f9584a0a8d4f160598', NULL, 1, 0, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'a:1:{i:0;s:12:"ROLE_USUARIO";}', 1),
(4, NULL, 'Gabriel', 'Omar', 'elbatidelagente@gmail.com', '12.124.124', 'toADZhIvCGLa8DuxyncbYS6gRZHm1gPtEbTttUs0k7ENyB0+LYkAroGOfU7g7ahoUn0q5/30LfyBLoXo1TnCjA==', 'asdsd', 1, 'elbati', 0, 0, '1910-01-01', 'Bs As', '123', '3214654984', NULL, '2015-04-30 01:19:47', '2015-04-30 01:19:47', '22351acbea753dcbea65cd23a0a4217c', NULL, 1, 0, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 4, NULL, NULL, 'a:1:{i:0;s:12:"ROLE_USUARIO";}', NULL),
(5, NULL, 'Gabriel', 'Omar', 'avidela@gmail.com', '12.124.124', 'hFWbKywF3pPbkwlh6lUvER+JKUj0oJYvRgzFSQC8AXw0kxmQ5z8eaXtp2FulzMtlkKuY8btlNIJFeBcKaSIWvA==', 'sfaqe', 1, 'elbati2', 0, 0, '1910-01-01', 'Bs As', '123465', '654654', NULL, '2015-04-30 01:36:08', '2015-04-30 01:36:08', 'ec6afdf93264c4fd4c40ff05d8483f6b', NULL, 1, 0, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'a:1:{i:0;s:12:"ROLE_USUARIO";}', NULL),
(6, NULL, 'fraas', 'nilo', 'jjfnino@gmail.comasd', '12324', 'LsAsWuKvGz3kgxpmh9BleOcs+CLMlTNFSZ9QNTaEoHKGD9tALVzD/H9Cf6Zi7wswo22GeJkAsMM/zovyJxTjuQ==', 'asda', 1, 'elfran84', 0, 0, '1910-01-01', 'asdasd', NULL, NULL, NULL, '2015-04-30 01:39:07', '2015-04-30 01:39:07', '9b20d4d972b2a90775b431de880862cd', NULL, 1, 0, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ventas`
--

CREATE TABLE IF NOT EXISTS `Ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `semana` int(11) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `Ventas`
--

INSERT INTO `Ventas` (`id`, `usuario`, `semana`, `puntos`, `fecha`, `descripcion`) VALUES
(1, 1, 1, 50, '2015-05-03 02:24:51', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Partidos`
--
ALTER TABLE `Partidos`
  ADD CONSTRAINT `FK_75E40DA0C3D8870F` FOREIGN KEY (`equipoa_id`) REFERENCES `Equipos` (`id`),
  ADD CONSTRAINT `FK_75E40DA0D16D28E1` FOREIGN KEY (`equipob_id`) REFERENCES `Equipos` (`id`),
  ADD CONSTRAINT `FK_75E40DA0E19F41BF` FOREIGN KEY (`sede_id`) REFERENCES `Sedes` (`id`);

--
-- Filtros para la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `FK_EDD889C1C604D5C6` FOREIGN KEY (`pais_id`) REFERENCES `Paises` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

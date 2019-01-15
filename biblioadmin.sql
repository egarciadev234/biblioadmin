-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 12-01-2019 a las 21:59:36
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioadmin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EJEMPLARES`
--

CREATE TABLE `EJEMPLARES` (
  `ID` int(11) NOT NULL,
  `EJEMPLAR` int(11) NOT NULL,
  `ESTADO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='tabla de ejemplares para el sistema biblioadmin';

--
-- Volcado de datos para la tabla `EJEMPLARES`
--

INSERT INTO `EJEMPLARES` (`ID`, `EJEMPLAR`, `ESTADO`) VALUES
(2, 10, 0),
(3, 10, 0),
(4, 10, 0),
(5, 11, 0),
(6, 11, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `LIBROS`
--

CREATE TABLE `LIBROS` (
  `ID` int(11) NOT NULL,
  `TITULO` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `ISBN` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `AUTOR` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `EDITORIAL` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `NO_PAGINAS` int(11) NOT NULL,
  `FECHA_PUBLICACION` date NOT NULL,
  `DESHABILITAR` int(11) NOT NULL,
  `ESTADO_LIBRO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='tabla de  libros para el sistema biblioadmin';

--
-- Volcado de datos para la tabla `LIBROS`
--

INSERT INTO `LIBROS` (`ID`, `TITULO`, `ISBN`, `AUTOR`, `EDITORIAL`, `NO_PAGINAS`, `FECHA_PUBLICACION`, `DESHABILITAR`, `ESTADO_LIBRO`) VALUES
(10, 'Libro 1', '122432sds', 'Erick', 'er', 120, '2019-01-05', 0, 1),
(11, 'Libro 2', '122432sdds', 'rick', 'er', 25, '2019-01-25', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PRESTAMOS`
--

CREATE TABLE `PRESTAMOS` (
  `ID` int(11) NOT NULL,
  `FECHA_PRESTAMO` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `FECHA_ENTREGA` date NOT NULL,
  `USUARIO` int(11) NOT NULL,
  `LIBROS_PRESTADOS` int(11) NOT NULL,
  `ESTADO_PRESTAMO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS`
--

CREATE TABLE `USUARIOS` (
  `ID` int(11) NOT NULL,
  `NOMBRE_COMPLETO` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `TELEFONO` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `EMAIL` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `PASSWORD` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `ROL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='tabla de usuarios para el sistema biblioadmin';

--
-- Volcado de datos para la tabla `USUARIOS`
--

INSERT INTO `USUARIOS` (`ID`, `NOMBRE_COMPLETO`, `TELEFONO`, `EMAIL`, `PASSWORD`, `ROL`) VALUES
(2, 'Erick Echeverry Garcia', '3052448292', 'developeeg@gmail.com', '$2y$10$K9r9CS1PbEyU46DQaXPGYeAZM.qxCtJbtbotI9TMudWuuXLwpU4c2', 1),
(3, 'Otro usuario', '3052448292', 'erickecheverry48@gmail.com', '$2y$10$u3gYc5IGpogIDSM6JojTuedUPQiRhgInVYVbqAKqH.CY.9rf.bnI6', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `EJEMPLARES`
--
ALTER TABLE `EJEMPLARES`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EJEMPLAR` (`EJEMPLAR`);

--
-- Indices de la tabla `LIBROS`
--
ALTER TABLE `LIBROS`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `PRESTAMOS`
--
ALTER TABLE `PRESTAMOS`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USUARIO` (`USUARIO`),
  ADD KEY `LIBROS_PRESTADOS` (`LIBROS_PRESTADOS`);

--
-- Indices de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `EJEMPLARES`
--
ALTER TABLE `EJEMPLARES`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `LIBROS`
--
ALTER TABLE `LIBROS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `PRESTAMOS`
--
ALTER TABLE `PRESTAMOS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `EJEMPLARES`
--
ALTER TABLE `EJEMPLARES`
  ADD CONSTRAINT `ejemplares_ibfk_1` FOREIGN KEY (`EJEMPLAR`) REFERENCES `LIBROS` (`ID`);

--
-- Filtros para la tabla `PRESTAMOS`
--
ALTER TABLE `PRESTAMOS`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`USUARIO`) REFERENCES `USUARIOS` (`ID`),
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`LIBROS_PRESTADOS`) REFERENCES `LIBROS` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

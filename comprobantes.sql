-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-03-2022 a las 18:53:44
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comprobantes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_chica`
--

CREATE TABLE `caja_chica` (
  `ID` int(10) NOT NULL,
  `Comprobante` varchar(50) NOT NULL,
  `Presentado` varchar(100) NOT NULL,
  `Destino` varchar(100) NOT NULL,
  `Motivo` varchar(100) NOT NULL,
  `Lugar` varchar(100) NOT NULL,
  `Fecha` varchar(10) NOT NULL,
  `Nro_comprobante` varchar(15) NOT NULL,
  `Total` varchar(12) NOT NULL,
  `Controlado` varchar(100) NOT NULL,
  `Aprobado` varchar(100) NOT NULL,
  `Rechazado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `caja_chica`
--

INSERT INTO `caja_chica` (`ID`, `Comprobante`, `Presentado`, `Destino`, `Motivo`, `Lugar`, `Fecha`, `Nro_comprobante`, `Total`, `Controlado`, `Aprobado`, `Rechazado`) VALUES
(1, 'Caja chica', 'Guillermo Silva', 'Mendoza', 'Viaje', 'CABA', '10/02/2022', '00123', '1000', '-', '-', '-'),
(2, 'Caja chica', '123', '123', '123', '123', '123', '123', '123', '', '', ''),
(3, 'Caja chica', '111', '111', 'Test', '1111', '111', '1111', '111', '', '', ''),
(4, 'Caja chica', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `ID` int(10) NOT NULL,
  `Comprobante` varchar(100) NOT NULL,
  `Presentado` varchar(100) NOT NULL,
  `Destino` varchar(100) NOT NULL,
  `Motivo` varchar(200) NOT NULL,
  `Lugar` varchar(100) NOT NULL,
  `Fecha` varchar(10) NOT NULL,
  `Nro_comprobante` varchar(15) NOT NULL,
  `Total` varchar(12) NOT NULL,
  `Controlado` varchar(100) NOT NULL,
  `Aprobado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`ID`, `Comprobante`, `Presentado`, `Destino`, `Motivo`, `Lugar`, `Fecha`, `Nro_comprobante`, `Total`, `Controlado`, `Aprobado`) VALUES
(0, 'Caja Chica', 'Guillermo Silva', 'Entre Ríos', 'Viaje', 'Ciudad de Buenos Aires', '25/03/2022', 'N° 0001', '$65.000', 'David Romero', 'Horario Murga');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(10) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Contraseña` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `Nombre`, `Apellido`, `Email`, `Contraseña`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', 'pass');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja_chica`
--
ALTER TABLE `caja_chica`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja_chica`
--
ALTER TABLE `caja_chica`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

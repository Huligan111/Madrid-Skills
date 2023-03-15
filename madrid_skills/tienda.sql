-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2023 a las 10:52:57
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `codigoEmpleado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `usuario`, `clave`, `nombre`, `apellidos`, `codigoEmpleado`) VALUES
(2, 'Sancho', '123', 'Sancho', 'Panza', 'uno'),
(3, 'User', '321', 'Nombreadmin', 'fffff', '5555'),
(6, 'ivo01', '123456', 'Ivan', 'Montero Alvarez', '123456'),
(8, 'SuperAdmin', '555', 'Super', 'Super Super', '654'),
(16, 'postman', '123456', 'postman', 'post-man', 'post123456'),
(17, 'postman', '123456', 'postman', 'post-man', 'post123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `categoriaPadre` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `categoriaPadre`) VALUES
(1, 'Queso', 'Lacteo'),
(7, 'Salami', 'Embutidos'),
(26, 'caramelo', 'bombon'),
(40, 'vaso', 'cristal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `genero` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fechaNacimiento` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tipoIdentificador` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `identificador` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `usuario`, `clave`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `telefono`, `email`, `direccion`, `tipoIdentificador`, `identificador`) VALUES
(2, 'Usuario cliente', '54321', 'Ivan', 'Alvarez Martinez', 'masculino', '01/01/1990', '4564899765456', 'ivan@gmail.com', 'Calle Esquina 4-5-b', 'Pasaporte', '456498797456'),
(3, 'ClienteOro', '888', 'Carlos', 'Baute', 'masculino', '15/06/2000', '987987456', 'carlos@gmail.com', 'Calle Mieses 7-4-A', 'NIE', 'X4654789-L'),
(4, 'Juan', 'juan123', 'Juan', 'Garcia Garcia', 'masculino', '10/10/2010', '7897456465', 'juan@mail.com', 'caller Juan 23', 'DNI', '45669879995'),
(5, 'Antonio', 'anto123', 'Antonio', 'Gomez Perez', 'masculino', '01/01/2001', '7897456231', 'antonio_perez@gmail.com', 'Calle General Tribaldos', 'Pasaporte', '4564564132'),
(15, 'postwoman', '123', 'postwoman', 'postwoman postwoman', 'femenino', '01/01/2000', '797897897', 'post@woman.com', 'Calle otra 2-A', 'DNI', '456464983L'),
(16, '', '123', 'gancho', '', '', '', '', 'gancho@mail.com', '', '', ''),
(17, 'gancho', '123', '', '', '', '', '', 'gancho@mail.com', '', '', ''),
(18, 'Ivan', '123', '', '', '', '', '', 'ivan@mail.com', '', '', ''),
(19, 'Maria', '123', '', '', '', '', '', 'maria@mail.com', '', '', ''),
(20, 'Nuria', '123', '', '', '', '', '', 'nuria@mail.com', '', '', ''),
(21, 'rut', '123', 'Rut', 'Alvarez Martinez', '', '1988-11-16', '789875461', 'rut@mail.com', 'Calle abajo 5-C', 'NIE', 'X32131231-L'),
(22, 'usercasado', '123', 'Pablo', 'Casado', '', '2023-03-08', '789465413', 'pablo@mail.com', 'Calle uno 2', 'NIE', '456497879A'),
(23, 'timi', '123', 'Tim', 'Cook', '', '1996-05-16', '789465124', 'tim@mail.com', 'Calle otra 7-A', 'DNI', '4564132148A'),
(24, 'ani', '123', 'Ana', 'Ivanova', '', '1987-03-05', '456789456', 'ana@mail.com', 'Avenida Mostoles 1', 'DNI', '45647987K'),
(25, 'john', '123', 'John', 'Wouker', '', '1999-03-10', '898989897', 'john@mail.com', 'Avenida alcala 234', 'NIE', 'x456465456D'),
(26, 'lina', '123', 'Lina', 'Alvarez', '', '2006-04-06', '989789545', 'lina@mail.com', 'Calle izquierda D-2', 'DNI', '456462313L'),
(27, 'jim', '123', 'Jim', 'Beam', '', '1989-03-15', '898978745', 'jim@mail.com', 'Avenida La otra  178', 'NIE', 'X4564989754-D'),
(28, 'bobi', '123', 'Bobi', 'Mar', '', '2011-03-17', '789797897', 'bobi@mail.com', 'Avenida Mar 3', 'DNI', '456456G'),
(29, 'vanesa', '123', 'Vanesa', 'martin', '', '2009-03-05', '78977789', 'vanesa@mail.com', 'Calle Mieses 7-4-A', 'DNI', '432423443H');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `precio` float NOT NULL,
  `productos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`productos`)),
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario`, `fecha`, `precio`, `productos`, `estado`) VALUES
(1, 'usuario primero', '12/02/2020', 10, '1', ''),
(2, 'user', '12/12/2023', 11, '1', ''),
(3, 'Ivo', '10/12/2022', 10, '5', ''),
(5, 'gggg', '12/12/2022', 10, '1', ''),
(8, 'postman', '12/12/2012', 12.12, '1', ''),
(10, 'postman', '12/12/2012', 10.3, '1', 'en preparacion'),
(11, 'postman', '12/12/2012', 12.12, '1', ''),
(12, 'postman', '12/12/2012', 12.12, '1', 'solicitado'),
(13, 'rut', '2023-03-11', 17, '[{\"id\":4,\"nombre\":\"Cristal\",\"precio\":5,\"categoria\":\"Vaso de cristal\",\"unidadesStock\":6,\"imagen\":\"vaso.jpg\"},{\"id\":5,\"nombre\":\"Tirma\",\"precio\":2,\"categoria\":\"Chocolatina\",\"unidadesStock\":2,\"imagen\":\"tirma.jpg\"},{\"id\":6,\"nombre\":\"Comestible\",\"precio\":10,\"categoria\":\"Galleta\",\"unidadesStock\":2,\"imagen\":\"galleta.jpg\"}]', 'en preparacion'),
(14, 'rut', '2023-03-11', 17, '[{\"id\":4,\"nombre\":\"Cristal\",\"precio\":5,\"categoria\":\"Vaso de cristal\",\"unidadesStock\":6,\"imagen\":\"vaso.jpg\"},{\"id\":5,\"nombre\":\"Tirma\",\"precio\":2,\"categoria\":\"Chocolatina\",\"unidadesStock\":2,\"imagen\":\"tirma.jpg\"},{\"id\":6,\"nombre\":\"Comestible\",\"precio\":10,\"categoria\":\"Galleta\",\"unidadesStock\":2,\"imagen\":\"galleta.jpg\"}]', 'en preparacion'),
(15, 'john', '2023-03-11', 1100, '[{\"id\":10,\"nombre\":\"televizor\",\"precio\":500,\"categoria\":\"electronica\",\"unidadesStock\":5,\"imagen\":\"tele.jpg\"},{\"id\":8,\"nombre\":\"chasovnik\",\"precio\":45,\"categoria\":\"reloj\",\"unidadesStock\":11,\"imagen\":\"reloj.jpg\"},{\"id\":7,\"nombre\":\"Vegetal\",\"precio\":10,\"categoria\":\"Pepino\",\"unidadesStock\":15,\"imagen\":\"pepino.jpg\"},{\"id\":8,\"nombre\":\"chasovnik\",\"precio\":45,\"categoria\":\"reloj\",\"unidadesStock\":11,\"imagen\":\"reloj.jpg\"},{\"id\":10,\"nombre\":\"televizor\",\"precio\":500,\"categoria\":\"electronica\",\"unidadesStock\":5,\"imagen\":\"tele.jpg\"}]', 'en preparacion'),
(16, 'john', '2023-03-11', 565, '[{\"id\":10,\"nombre\":\"televizor\",\"precio\":500,\"categoria\":\"electronica\",\"unidadesStock\":5,\"imagen\":\"tele.jpg\"},{\"id\":8,\"nombre\":\"chasovnik\",\"precio\":45,\"categoria\":\"reloj\",\"unidadesStock\":11,\"imagen\":\"reloj.jpg\"},{\"id\":7,\"nombre\":\"Vegetal\",\"precio\":10,\"categoria\":\"Pepino\",\"unidadesStock\":15,\"imagen\":\"pepino.jpg\"},{\"id\":6,\"nombre\":\"Comestible\",\"precio\":10,\"categoria\":\"Galleta\",\"unidadesStock\":2,\"imagen\":\"galleta.jpg\"}]', 'en preparacion'),
(17, 'rut', '2023-03-11', 12, '[{\"id\":7,\"nombre\":\"Vegetal\",\"precio\":10,\"categoria\":\"Pepino\",\"unidadesStock\":15,\"imagen\":\"pepino.jpg\"},{\"id\":5,\"nombre\":\"Tirma\",\"precio\":2,\"categoria\":\"Chocolatina\",\"unidadesStock\":2,\"imagen\":\"tirma.jpg\"}]', 'en preparacion'),
(18, 'lina', '2023-03-12', 12, '[{\"id\":5,\"nombre\":\"Tirma\",\"precio\":2,\"categoria\":\"Chocolatina\",\"unidadesStock\":2,\"imagen\":\"tirma.jpg\"},{\"id\":6,\"nombre\":\"Comestible\",\"precio\":10,\"categoria\":\"Galleta\",\"unidadesStock\":2,\"imagen\":\"galleta.jpg\"}]', 'en preparacion'),
(19, 'ani', '2023-03-12', 65, '[{\"id\":8,\"nombre\":\"chasovnik\",\"precio\":45,\"categoria\":\"reloj\",\"unidadesStock\":11,\"imagen\":\"reloj.jpg\"},{\"id\":7,\"nombre\":\"Vegetal\",\"precio\":10,\"categoria\":\"Pepino\",\"unidadesStock\":15,\"imagen\":\"pepino.jpg\"},{\"id\":6,\"nombre\":\"Comestible\",\"precio\":10,\"categoria\":\"Galleta\",\"unidadesStock\":2,\"imagen\":\"galleta.jpg\"}]', 'en preparacion'),
(20, 'jim', '2023-03-12', 7, '[{\"id\":4,\"nombre\":\"Cristal\",\"precio\":5,\"categoria\":\"Vaso de cristal\",\"unidadesStock\":6,\"imagen\":\"vaso.jpg\"},{\"id\":5,\"nombre\":\"Tirma\",\"precio\":2,\"categoria\":\"Chocolatina\",\"unidadesStock\":2,\"imagen\":\"tirma.jpg\"}]', 'en preparacion'),
(21, 'bobi', '2023-03-13', 17, '[{\"id\":4,\"nombre\":\"Cristal\",\"precio\":5,\"categoria\":\"Vaso de cristal\",\"unidadesStock\":6,\"imagen\":\"vaso.jpg\"},{\"id\":5,\"nombre\":\"Tirma\",\"precio\":2,\"categoria\":\"Chocolatina\",\"unidadesStock\":2,\"imagen\":\"tirma.jpg\"},{\"id\":6,\"nombre\":\"Comestible\",\"precio\":10,\"categoria\":\"Galleta\",\"unidadesStock\":2,\"imagen\":\"galleta.jpg\"}]', 'en preparacion'),
(22, 'vanesa', '2023-03-13', 65, '[{\"id\":6,\"nombre\":\"Comestible\",\"precio\":10,\"categoria\":\"Galleta\",\"unidadesStock\":2,\"imagen\":\"galleta.jpg\"},{\"id\":7,\"nombre\":\"Vegetal\",\"precio\":10,\"categoria\":\"Pepino\",\"unidadesStock\":15,\"imagen\":\"pepino.jpg\"},{\"id\":8,\"nombre\":\"chasovnik\",\"precio\":45,\"categoria\":\"reloj\",\"unidadesStock\":11,\"imagen\":\"reloj.jpg\"}]', 'en preparacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `precio` float NOT NULL,
  `categoria` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `unidadesStock` int(11) NOT NULL,
  `imagen` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `categoria`, `unidadesStock`, `imagen`) VALUES
(4, 'Cristal', 5, 'Vaso de cristal', 6, 'vaso.jpg'),
(5, 'Tirma', 2, 'Chocolatina', 2, 'tirma.jpg'),
(6, 'Comestible', 10, 'Galleta', 2, 'galleta.jpg'),
(7, 'Vegetal', 10, 'Pepino', 15, 'pepino.jpg'),
(8, 'chasovnik', 45, 'reloj', 11, 'reloj.jpg'),
(10, 'televizor', 500, 'electronica', 5, 'tele.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `imagen` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

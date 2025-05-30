-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 30-05-2025 a las 01:39:58
-- Versión del servidor: 8.0.41-0ubuntu0.24.04.1
-- Versión de PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `healthcare_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activaciones`
--

CREATE TABLE `activaciones` (
  `id` int NOT NULL,
  `fecha_activacion` date DEFAULT NULL,
  `trabajador` varchar(100) DEFAULT NULL,
  `tipo_documento` varchar(50) DEFAULT NULL,
  `identificacion` varchar(50) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `ips` varchar(150) DEFAULT NULL,
  `servicio_prestado_inicial` varchar(150) DEFAULT NULL,
  `rlp` enum('SI','NO','ESPECIAL') DEFAULT NULL,
  `medicamentos` text,
  `tipo_medicamento` varchar(150) DEFAULT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `numero_afiliacion` varchar(50) DEFAULT NULL,
  `pae` varchar(100) DEFAULT NULL,
  `tipo_pae` varchar(100) DEFAULT NULL,
  `ubicacion_pae` varchar(150) DEFAULT NULL,
  `jornada_activacion` varchar(100) DEFAULT NULL,
  `activacion_presencial` enum('SI','NO') DEFAULT NULL,
  `hora_activacion_caso` time DEFAULT NULL,
  `hora_activacion_pae` time DEFAULT NULL,
  `tiempo_respuesta_sacs` varchar(50) DEFAULT NULL,
  `hora_llegada_pae_ips` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `activaciones`
--

INSERT INTO `activaciones` (`id`, `fecha_activacion`, `trabajador`, `tipo_documento`, `identificacion`, `ciudad`, `departamento`, `ips`, `servicio_prestado_inicial`, `rlp`, `medicamentos`, `tipo_medicamento`, `empresa`, `numero_afiliacion`, `pae`, `tipo_pae`, `ubicacion_pae`, `jornada_activacion`, `activacion_presencial`, `hora_activacion_caso`, `hora_activacion_pae`, `tiempo_respuesta_sacs`, `hora_llegada_pae_ips`) VALUES
(8, '1978-05-05', 'Aute dolorum volupta', 'cc', 'Non esse do facere ', 'Esse et aspernatur q', 'Eos a exercitation e', 'Ipsam itaque aliquam', 'Culpa voluptatem sin', 'SI', 'Quis aut duis illum', 'Aut sunt error eos e', 'Vero distinctio Ad ', 'Aut rerum Nam et qui', 'Tenetur voluptas adi', 'Libero commodi inven', 'Facere et possimus ', 'Ratione odio dolor u', 'SI', '05:50:00', '00:09:00', 'Beatae numquam nostr', '07:14:00'),
(9, '1970-06-09', 'Aliquam doloremque o', 'cc', 'Fuga Nisi consequat', 'Harum tempor distinc', 'Aut tenetur dolore n', 'Exercitationem eaque', 'Qui consectetur acc', 'SI', 'Reiciendis exercitat', 'Aliquid qui similiqu', 'At hic magnam consec', 'Dolor fugit est dol', 'Provident natus vel', 'Sed ullam ut minim m', 'Enim labore rerum si', 'Architecto aut quasi', 'SI', '21:57:00', '22:26:00', 'Cillum sit in ea cu', '07:01:00'),
(10, '2001-03-06', 'Eligendi alias ullam', 'cc', 'Laboris nisi eum qui', 'Nostrud itaque nihil', 'Aut doloremque tempo', 'Voluptatum dolore no', 'Dignissimos adipisci', 'SI', 'Deserunt velit volup', 'Ad nisi quia esse v', 'Quisquam sed laborum', 'Alias minima totam p', 'Sed voluptas culpa m', 'Aute a soluta labori', 'Optio consectetur s', 'Molestias temporibus', 'SI', '01:08:00', '04:19:00', 'Fugiat aut laborum s', '20:50:00'),
(11, '1977-01-03', 'Facilis voluptas acc', 'pep', 'Vel ullamco exceptur', NULL, 'SUCRE', 'Sit eos at et repell', 'Doloribus incidunt ', 'SI', 'Aut aut sunt accusa', 'Consequat Molestiae', 'Et molestias ut expl', 'Ut sapiente ut labor', 'Vel quae non mollit ', 'Fugiat vitae qui imp', 'Sunt vero sunt conse', 'Dolorem deleniti fac', 'SI', '08:49:00', '16:29:00', 'Sed aliquam nisi qui', '19:12:00'),
(12, '2019-04-02', 'Eiusmod fugit sunt ', 'ti', 'Natus dolor illum q', NULL, 'ARAUCA', 'Nisi perferendis seq', 'Obcaecati aut qui al', 'SI', 'Esse nisi voluptate', 'Sequi sit veniam e', 'Autem similique sint', 'Est autem sunt enim', 'Elit sapiente recus', 'Quo magnam non ut la', 'Esse impedit molest', 'Esse et labore vitae', 'SI', '03:25:00', '04:01:00', 'Fuga Aperiam sit ne', '19:48:00'),
(13, '1983-10-15', 'Eos dolore laborum ', 'ce', 'Ipsa ipsam deleniti', 'CÓRDOBA', 'Montería', 'Veniam expedita fac', 'Quo mollitia omnis i', 'SI', 'Quidem occaecat quae', 'Temporibus assumenda', 'Excepteur sunt minus', 'Et sit eaque minim ', 'Nihil ut et ea qui v', 'Nemo aliqua Cupidit', 'Ut non voluptate ita', 'Tempore harum tempo', 'SI', '15:34:00', '20:48:00', 'Ex ducimus nostrum ', '05:55:00'),
(14, '2006-06-18', 'Mollitia beatae culp', 'visa', '1321313213131', 'RISARALDA', 'Santa Rosa de Cabal', 'Architecto magna ips', 'Consequatur Neque d', '', 'Dolor earum cillum q', 'Ut aliquip quia aut ', 'Quibusdam aut rem si', 'Rem rem dicta tempor', 'Aute commodo labore ', 'Fugiat nesciunt pa', 'Maiores dolores culp', 'Sunt dicta animi ob', 'SI', '23:48:00', '14:28:00', 'Rem neque ut explica', '19:11:00'),
(15, '2011-08-27', 'andres ramirez', 'cc', '1055546546', 'QUINDÍO', 'Armenia', 'sanitas', 'Aut ut nisi officiis', '', 'Voluptatem Est aspe', 'Facilis pariatur Es', 'Voluptatem Omnis di', 'Iste omnis dolores f', 'Quisquam aut quos vo', 'Quis totam architect', 'Molestiae quo a est', 'Nulla qui dolore qui', 'SI', '19:41:00', '16:38:00', 'Eu id aut non dolore', '08:01:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'ROL_PAE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `rol_id` int NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `telefono`, `contraseña`, `fecha_registro`, `rol_id`) VALUES
(25, 'pepito', 'alisson@gmail.com', '3241174540', '$2y$10$/KTgndWalf7ZIFUIj5rcPOcL45KO0uPEfm9utFCQNLsSH2bEFM/b.', '2025-04-19 06:08:48', 2),
(26, 'jefe', 'jefe@gmail.com', '321654987', '$2y$10$vYnx4R/jVHY81JhIVH7OgerKQc6mgJ.GS/sBSg/uzMJqJnBHUTsxW', '2025-04-19 06:09:33', 1),
(27, 'juan', 'juan@gmail.com', '3214866648', '$2y$10$ZV5ODLwxq6M1SjxauQW/8.YgL9SYs0Ir/Rgmm99FfdEVNBmmsQxDu', '2025-04-19 08:15:57', 2),
(29, 'ANDRES RAMIREZ', 'programmer.arh@gmail.com', '3214866648', '$2y$10$ZRobG9kXgZhc.uSiscvn0.19hueA0evKjOJSqKB1wrh9PnJWOwPFC', '2025-05-02 06:54:04', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activaciones`
--
ALTER TABLE `activaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `fk_usuarios_roles` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activaciones`
--
ALTER TABLE `activaciones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

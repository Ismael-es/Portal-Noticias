-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2026 a las 17:39:53
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `portalnoticias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id` int(11) NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fechaYhora` datetime NOT NULL DEFAULT current_timestamp(),
  `id_estado_antiguo` int(11) NOT NULL,
  `id_estado_nuevo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id`, `id_noticia`, `id_usuario`, `fechaYhora`, `id_estado_antiguo`, `id_estado_nuevo`) VALUES
(3, 8, 10, '2026-04-16 14:42:25', 1, 2),
(6, 10, 8, '2026-05-04 18:42:21', 2, 4),
(7, 8, 8, '2026-05-06 11:02:48', 2, 3),
(8, 8, 8, '2026-05-06 11:05:54', 1, 2),
(9, 8, 8, '2026-05-06 11:06:00', 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `nombre`) VALUES
(1, 'borrador'),
(2, 'lista para validacion'),
(3, 'para correccion'),
(4, 'publicada'),
(5, 'expirada'),
(6, 'anulada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaPublicacion` datetime DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `id_estado` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id`, `titulo`, `descripcion`, `fechaCreacion`, `fechaPublicacion`, `imagen`, `id_estado`, `id_autor`) VALUES
(8, 'titulo lorem  ipsun 3', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which', '2026-04-16 14:36:53', '2026-05-06 11:06:00', '', 4, 10),
(10, 'titulo lorem  ipsun 4', 'Imaginá que un amigo te pide prestados 100 dólares, prometiendo devolvértelos en un mes. Sin embargo, cuando llega el momento de pagar, tu amigo te dice que no tiene el dinero y no sabe cuándo podrá devolverlo. Este incumplimiento de su promesa de pago es lo que se conoce como en términos financieros.', '2026-04-16 14:57:24', '2026-05-04 18:42:21', '', 4, 10),
(17, 'titulo lorem ipsum 7', 'Maecenas quis commodo massa, ac auctor augue. Praesent ultricies condimentum pulvinar. Integer condimentum nisi dui, vitae convallis neque eleifend non. Praesent vulputate sem vel justo dictum sagittis. Aliquam erat volutpat.', '2026-05-06 12:38:55', NULL, 'uploads/img-69fb608fa72af6.34748459.jpg', 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`id`, `nombre`, `valor`) VALUES
(1, 'maxDiasPublicacion', 30),
(2, 'tamMax', 2097152);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'editor'),
(2, 'validador'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombreYapellido` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombreYapellido`, `mail`, `contraseña`) VALUES
(7, 'lucas alcaraz', 'lucas@gmail.com', '$2y$10$tbGK5uD997W1R5Ox14FkC.jXHnolq6pIYn5UiFCQNpZ2GmclPKuNO'),
(8, 'antonella gatica', 'anto@gmail.com', '$2y$10$4UTZ85UbQ6fztQN5Ky79KOjfE1TWFGuX9Uy6mleLGiW0ICJ5ncGFe'),
(9, 'admin', 'admin@gmail.com', '$2y$10$EhMt.tQ7BDrc7FWHcW2kPu/Ain1AHZuEERodKzQEPACVfg6ylnLF6'),
(10, 'maxi elero', 'maxi@gmail.com', '$2y$10$IGcoQCvhkiyxr/d43gbHQevjzIDUK6CGWC5rBV2B4naDD7m3GMPgu'),
(11, 'lautaro martinez', 'lautaro@gmail.com', '$2y$10$6M1DdUPLTwI58ltf2hAck.MewlGSBJWan7NdBRP60zc5n9QnI7XNy'),
(12, 'jose', 'jose@gmail.com', '$2y$10$S.ZU0j6Wo/TcvXISRny6i.56mVKwA/8ouesdpjlm87DpDW.t9QJgi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_roles`
--

CREATE TABLE `usuario_roles` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_roles`
--

INSERT INTO `usuario_roles` (`id`, `id_usuario`, `id_rol`) VALUES
(4, 7, 1),
(5, 8, 1),
(6, 8, 2),
(7, 10, 1),
(8, 10, 2),
(9, 9, 3),
(10, 11, 2),
(11, 12, 1),
(12, 12, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_noticia_fdk1` (`id_noticia`),
  ADD KEY `id_usuario_fdk` (`id_usuario`),
  ADD KEY `id_esatdo_dfj3` (`id_estado_antiguo`),
  ADD KEY `id_etsado_fh3` (`id_estado_nuevo`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado_fdk1` (`id_estado`),
  ADD KEY `id_autor_fdk2` (`id_autor`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario_roles`
--
ALTER TABLE `usuario_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario_fdk1` (`id_usuario`),
  ADD KEY `id_rol_fdk2` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuario_roles`
--
ALTER TABLE `usuario_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `id_esatdo_dfj3` FOREIGN KEY (`id_estado_antiguo`) REFERENCES `estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_etsado_fh3` FOREIGN KEY (`id_estado_nuevo`) REFERENCES `estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_noticia_fdk1` FOREIGN KEY (`id_noticia`) REFERENCES `noticia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_usuario_fdk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `id_autor_fdk2` FOREIGN KEY (`id_autor`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `id_estado_fdk1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_roles`
--
ALTER TABLE `usuario_roles`
  ADD CONSTRAINT `id_rol_fdk2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_usuario_fdk1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

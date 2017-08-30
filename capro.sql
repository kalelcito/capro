-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-08-2017 a las 15:55:12
-- Versión del servidor: 5.5.34
-- Versión de PHP: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `capro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salt` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `activo`, `nombre`, `apellido`, `email`, `telefono`, `password`, `salt`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cesar', 'Rios', 'cesar@innology.mx', NULL, '123456', NULL, '2017-07-31 00:00:00', '2017-07-31 00:00:00'),
(2, 1, 'Super', 'Usuario', 'test@innology.mx', NULL, 'capro2017', NULL, '2017-08-01 10:03:27', '2017-08-01 10:03:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color_text` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `descripcion`, `imagen`, `color`, `color_text`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Deportivo Toluca F.C.', 'Descripcion', 'e927ee846380fa16cc0e35e2797eff56.jpeg', '#fa1414', '#ffffff', 1, '2017-08-01 09:56:05', '2017-08-01 09:56:05'),
(2, 'Casino Life', 'Descripcion', '7eb0350712fd829f6ed913f956c82f30.jpeg', '#075c1a', '#ffffff', 1, '2017-08-01 09:57:33', '2017-08-01 09:57:33'),
(3, 'Dentimex', 'Descripcion', 'c2bf552f8dd992442620089ff298c6ca.jpeg', '#ac18c4', '#fcfcfc', 1, '2017-08-01 09:58:01', '2017-08-01 09:58:01'),
(4, 'Emotion', 'Descripcion', '8434d4b622b3b732940abc04c957daf9.jpeg', '#ffffff', '#000000', 1, '2017-08-01 09:58:28', '2017-08-01 09:58:28'),
(5, 'UAEMex', 'Descripcion', '52c0a7cf4be12b5253d9255092d83d3d.jpeg', '#d1bd0d', '#121212', 1, '2017-08-01 09:59:01', '2017-08-01 09:59:01'),
(6, 'Ingenor', 'Decripcion', 'c107ba7b880b84a7de3f34c7b4c630ec.jpeg', '#2515e6', '#ffffff', 1, '2017-08-01 09:59:40', '2017-08-01 09:59:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ext_log_entries`
--

CREATE TABLE `ext_log_entries` (
  `id` int(11) NOT NULL,
  `action` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `logged_at` datetime NOT NULL,
  `object_id` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ext_translations`
--

CREATE TABLE `ext_translations` (
  `id` int(11) NOT NULL,
  `locale` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` tinyint(1) DEFAULT NULL,
  `color_avg` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `nombre`, `imagen`, `tipo`, `color_avg`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Caption', '95483f0dc6f7b1c14e3af9a91fc29b7f.jpeg', 1, '#361B10', 1, '2017-07-31 16:44:54', '2017-07-31 16:44:54'),
(2, 'Caption', 'e09a7a50b94d26c4960ddde41e06d834.jpeg', 1, '#5C2E1F', 1, '2017-07-31 17:12:52', '2017-07-31 17:12:52'),
(3, 'Caption', 'c2ad68434ca5fc0e2fb20c2328a07c94.jpeg', 1, '#32110C', 1, '2017-07-31 17:13:20', '2017-07-31 17:13:20'),
(4, 'Menú', '498e52a144dcf19598bdc8b4a1ed0640.png', 3, '#FFEAFF', 1, '2017-07-31 17:24:06', '2017-07-31 17:24:06'),
(5, 'Nosotros', 'e4f7b1cc8838bc9cc3566db5bcd18321.jpeg', 2, '#000000', 1, '2017-07-31 17:52:53', '2017-07-31 17:52:53'),
(6, 'Nosotros', '12106d4563ca9c798f75a711d9b469a8.jpeg', 2, '#20293A', 1, '2017-07-31 17:31:38', '2017-07-31 17:31:38'),
(7, '800x600', '42582443e299f78002ce38852db09ae3.jpeg', 1, '#955F3D', 1, '2017-08-04 10:09:06', '2017-08-04 10:09:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `metakeys` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `metadesc` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `nombre`, `descripcion`, `activo`, `slug`, `metakeys`, `metadesc`, `created_at`, `updated_at`) VALUES
(1, 'Terraza Casa Champs', 'El gusto por el diseño orgánico y la increíble conexión que sentimos al compartir momentos únicos con nuestros seres queridos nos han llevado a crear este espacio, desde cimientos hasta vinilos decorativos. La terraza champs cuenta con parrilla para asar a gas y leña, quemadores para cocinar, tarja para lavar,cocinera para guardar, gimnasio con baño completo, medio baño y chimenea de gasa desnivel', 1, 'terraza-casa-champs', 'terraza,casa,champs,capro', 'Terraza Casa Champs - Capro Carpintería', '2017-08-01 11:26:44', '2017-08-01 11:26:44'),
(2, 'Terraza Rosedal', 'Un espacio natural, con vida, diseñado para tener momentos de tranquilidad dentro de tu hogar. La terraza Rosedal tiene 40 vigas de madera de pino de 8\" X4\" con una aplicación de barniz SPA-N-DECK para resistir al clima abierto.Disfruta la tranquilidad de tu hogar, eso alimentara tu corazón.', 1, 'terraza-rosedal', 'terraza,rosedal,capro', 'Terraza Rosedal - Capro Carpintería', '2017-08-01 11:29:03', '2017-08-01 11:29:03'),
(3, 'Deportivo Toluca F.C.', 'Nuestro gusto por el fútbol y el cariño por la gran institución, nos inspiró para ser parte del festejo de los 100 años del Deportivo Toluca F.C., contribuyendo con los trabajos de carpintería en la remodelación de su casa el estadio \"Nemesio Diez\". Un orgullo para nosotros haber sido parte de la cuadrilla de proveedores en este gran proyecto. \"Que el balón ruede a nuestro favor\"', 1, 'deportivo-toluca-f-c', 'deportivo,toluca,capro', 'Deportivo Toluca F.C. - Capro Carpintería', '2017-08-01 11:30:03', '2017-08-01 11:30:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `p_imagenes`
--

CREATE TABLE `p_imagenes` (
  `id` int(11) NOT NULL,
  `proyectos_id` int(11) NOT NULL,
  `imagen` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color_avg` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `principal` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `p_imagenes`
--

INSERT INTO `p_imagenes` (`id`, `proyectos_id`, `imagen`, `color_avg`, `activo`, `principal`, `created_at`, `updated_at`) VALUES
(1, 1, 'b36e73ec1232288f3cc5e69702c6dfe6.jpeg', '#000000', 1, 1, '2017-08-01 11:58:42', '2017-08-01 11:58:42'),
(2, 2, 'db6c7edf5ab37de24d0a57d7e13fbb3b.jpeg', '#27150B', 1, 1, '2017-08-01 12:00:08', '2017-08-01 12:00:08'),
(3, 3, 'db635e3b186c3763ee7c00bef94ac348.jpeg', '#27150B', 1, 1, '2017-08-01 12:05:00', '2017-08-01 12:05:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ext_log_entries`
--
ALTER TABLE `ext_log_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_class_lookup_idx` (`object_class`),
  ADD KEY `log_date_lookup_idx` (`logged_at`),
  ADD KEY `log_user_lookup_idx` (`username`),
  ADD KEY `log_version_lookup_idx` (`object_id`,`object_class`,`username`);

--
-- Indices de la tabla `ext_translations`
--
ALTER TABLE `ext_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lookup_unique_idx` (`locale`,`object_class`,`field`,`foreign_key`),
  ADD KEY `translations_lookup_idx` (`locale`,`object_class`,`foreign_key`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `p_imagenes`
--
ALTER TABLE `p_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_p_imagenes_proyectos_idx` (`proyectos_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `ext_log_entries`
--
ALTER TABLE `ext_log_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ext_translations`
--
ALTER TABLE `ext_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `p_imagenes`
--
ALTER TABLE `p_imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `p_imagenes`
--
ALTER TABLE `p_imagenes`
  ADD CONSTRAINT `FK_EA60DC21CC33C266` FOREIGN KEY (`proyectos_id`) REFERENCES `proyectos` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

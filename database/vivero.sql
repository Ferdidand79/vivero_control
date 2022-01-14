-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-01-2022 a las 21:06:34
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vivero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elementos`
--

CREATE TABLE `elementos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `muestra_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `lugar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `responsable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `elementos`
--

INSERT INTO `elementos` (`id`, `muestra_id`, `fecha`, `lugar`, `estado`, `responsable`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-05-13', 'parcerla A', 1, 'Eduardo de las casas', '2021-05-14 05:30:32', '2021-05-14 05:30:32'),
(2, 2, '2021-05-13', 'parcela B', 1, 'Abel Sangama', '2021-05-14 05:39:13', '2021-05-14 05:39:13'),
(3, 1, '2021-05-13', 'parcela B', 1, 'los gonzalez', '2021-05-14 05:41:05', '2021-05-14 05:41:05'),
(4, 3, '2021-05-13', 'parcela c', 1, 'Luis Miranda', '2021-05-14 06:52:01', '2021-05-14 06:52:01'),
(5, 4, '2021-05-13', 'parcela c', 1, 'marco ruiz', '2021-05-14 06:53:37', '2021-05-14 06:53:37'),
(6, 3, '2021-05-14', 'Morales', 1, 'Eduardo de las casas', '2021-05-15 03:26:21', '2021-05-15 03:26:21'),
(7, 5, '2021-05-15', 'Vivero 1', 1, 'Tecnico 1', '2021-05-15 22:00:48', '2021-05-15 22:00:48'),
(8, 5, '2021-05-16', 'Vivero 2', 1, 'Tecnico 2', '2021-05-15 22:01:37', '2021-05-15 22:01:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elementos_image`
--

CREATE TABLE `elementos_image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `elemento_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `elementos_image`
--

INSERT INTO `elementos_image` (`id`, `elemento_id`, `url`, `created_at`, `updated_at`) VALUES
(1, 1, 'phppiLq2H.png', '2021-05-14 05:30:32', '2021-05-14 05:30:32'),
(2, 2, 'phpR4TaYK.png', '2021-05-14 05:39:13', '2021-05-14 05:39:13'),
(3, 4, 'phpJOz0Xn.png', '2021-05-14 06:52:01', '2021-05-14 06:52:01'),
(4, 5, 'php5GEuFx.png', '2021-05-14 06:53:37', '2021-05-14 06:53:37'),
(5, 6, 'php1BjyvW.jfif', '2021-05-15 03:26:21', '2021-05-15 03:26:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elemento_parametro`
--

CREATE TABLE `elemento_parametro` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `elemento_id` bigint(20) UNSIGNED NOT NULL,
  `parametro_id` bigint(20) UNSIGNED NOT NULL,
  `valor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `elemento_parametro`
--

INSERT INTO `elemento_parametro` (`id`, `elemento_id`, `parametro_id`, `valor`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '45cm', '2021-05-14 05:30:32', '2021-05-14 05:30:32'),
(3, 2, 4, '5mlg', '2021-05-14 05:39:39', '2021-05-14 05:39:39'),
(4, 2, 2, '6', '2021-05-14 05:39:39', '2021-05-14 05:39:39'),
(5, 3, 1, '63cm', '2021-05-14 05:41:05', '2021-05-14 05:41:05'),
(6, 4, 2, '6', '2021-05-14 06:52:01', '2021-05-14 06:52:01'),
(7, 5, 3, '56cm', '2021-05-14 06:53:37', '2021-05-14 06:53:37'),
(8, 6, 2, '5', '2021-05-15 03:26:21', '2021-05-15 03:26:21'),
(9, 7, 2, '2', '2021-05-15 22:00:48', '2021-05-15 22:00:48'),
(10, 7, 1, '5', '2021-05-15 22:00:48', '2021-05-15 22:00:48'),
(11, 8, 1, '5', '2021-05-15 22:01:37', '2021-05-15 22:01:37'),
(12, 8, 4, '2', '2021-05-15 22:01:37', '2021-05-15 22:01:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elemento_plaga`
--

CREATE TABLE `elemento_plaga` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `elemento_id` bigint(20) UNSIGNED NOT NULL,
  `plaga_id` bigint(20) UNSIGNED NOT NULL,
  `valor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nivel` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `elemento_plaga`
--

INSERT INTO `elemento_plaga` (`id`, `elemento_id`, `plaga_id`, `valor`, `nivel`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '5', '1', '2021-05-14 05:30:32', '2021-05-14 05:30:32'),
(3, 2, 1, '5', '2', '2021-05-14 05:39:39', '2021-05-14 05:39:39'),
(4, 3, 2, '4', '0', '2021-05-14 05:41:05', '2021-05-14 05:41:05'),
(5, 4, 4, '4', '2', '2021-05-14 06:52:01', '2021-05-14 06:52:01'),
(6, 5, 2, '2', '2', '2021-05-14 06:53:37', '2021-05-14 06:53:37'),
(7, 6, 2, '2', '1', '2021-05-15 03:26:21', '2021-05-15 03:26:21'),
(8, 7, 4, '2', '1', '2021-05-15 22:00:48', '2021-05-15 22:00:48'),
(9, 7, 3, '3', '2', '2021-05-15 22:00:48', '2021-05-15 22:00:48'),
(10, 8, 2, '1', '1', '2021-05-15 22:01:37', '2021-05-15 22:01:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_12_022912_create_parametros_table', 1),
(5, '2021_05_12_044235_create_plantas_table', 1),
(6, '2021_05_12_044258_create_plagas_table', 1),
(7, '2021_05_12_051939_create_vincular_table', 1),
(8, '2021_05_12_161118_create_muestras_table', 1),
(9, '2021_05_12_162952_create_elementos_table', 1),
(10, '2021_05_12_163149_create_elementos_image_table', 1),
(11, '2021_05_12_235347_create_elemento_parametro_table', 1),
(12, '2021_05_12_235359_create_elemento_plaga_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muestras`
--

CREATE TABLE `muestras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `planta_id` bigint(20) UNSIGNED NOT NULL,
  `ubicacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `fecha` date NOT NULL,
  `responsable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `muestras`
--

INSERT INTO `muestras` (`id`, `planta_id`, `ubicacion`, `estado`, `fecha`, `responsable`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tarapoto', 1, '2021-05-13', 'marco ruiz', '2021-05-14 05:28:52', '2021-05-14 05:28:52'),
(2, 2, 'morales', 1, '2021-05-13', 'Jose Ignacio', '2021-05-14 05:38:18', '2021-05-14 05:38:18'),
(3, 3, 'Moyobamba', 1, '2021-05-13', 'José Armando', '2021-05-14 06:51:18', '2021-05-14 06:51:18'),
(4, 1, 'Tingo', 1, '2021-05-13', 'Antoni Soliz', '2021-05-14 06:52:39', '2021-05-14 06:52:39'),
(5, 6, 'Utcubamba', 1, '2021-05-15', 'Ariel Chichipe', '2021-05-15 21:59:21', '2021-05-15 21:59:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Altura', 'Distancia desde la saliente de la planta hasta la hoja mas alta', '2021-05-14 05:16:28', '2021-05-14 05:16:28'),
(2, 'PH', 'nivel de concentración acida', '2021-05-14 05:16:50', '2021-05-14 05:16:50'),
(3, 'Ancho de tallo', 'distancia de lado a lado de tallo', '2021-05-14 05:17:48', '2021-05-14 06:48:10'),
(4, 'humedad', 'cantidad de partículas de agua contenidas en la s hojas', '2021-05-14 05:37:07', '2021-05-14 05:37:07'),
(5, 'Área folear', 'El índice de área de la hoja es una cantidad adimensional que caracteriza la canopia de las plantas', '2021-05-14 06:47:34', '2021-05-14 06:47:34'),
(6, 'Acido foliar', 'Este es un  componentes importante de las plantas', '2021-05-15 22:04:44', '2021-05-15 22:04:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plagas`
--

CREATE TABLE `plagas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plagas`
--

INSERT INTO `plagas` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'pulgon', 'Insectos que tienen el aspecto de granos de arroz. Los hay negros, amarillos, verdes o blancos, diferentes especies.', '2021-05-14 05:20:30', '2021-05-14 05:23:17'),
(2, 'Cochinillas', 'Son insectos que poseen una especie de coraza o costra que los protege de los insecticidas. Hay muchas especies, tipo caspilla o bolitas de algodón.', '2021-05-14 05:22:42', '2021-05-14 05:22:42'),
(3, 'Araña roja', 'Son ácaros difíciles de ver a simple vista, con una lupa sí.', '2021-05-14 05:23:33', '2021-05-14 05:23:33'),
(4, 'Roya', 'La roya es una enfermedad de las plantas causada por hongos que aparece principalmente en la zona aérea de las plantas, como las hojas, tallos, frutos y flores', '2021-05-14 06:48:52', '2021-05-14 06:48:52'),
(5, 'Moho', 'El oídio. La acumulación que parece un polvo blanco en las hojas, retoños y tallos de las plantas', '2021-05-14 06:50:17', '2021-05-14 06:50:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantas`
--

CREATE TABLE `plantas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_comun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_cientifico` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plantas`
--

INSERT INTO `plantas` (`id`, `nombre_comun`, `nombre_cientifico`, `created_at`, `updated_at`) VALUES
(1, 'malva', 'malvisuis cronicus', '2021-05-14 05:18:31', '2021-05-14 05:18:31'),
(2, 'palma aceitera', 'palmicius aceitus', '2021-05-14 05:18:50', '2021-05-14 05:18:50'),
(3, 'achote', 'achoticus aceitosus', '2021-05-14 05:19:12', '2021-05-14 05:19:12'),
(4, 'Aliso', 'Alnus glutinosa', '2021-05-15 02:23:33', '2021-05-15 02:23:33'),
(5, 'Árbol de la quina', 'Cinchona officinalis', '2021-05-15 02:31:12', '2021-05-15 02:31:12'),
(6, 'Café', 'cafetos', '2021-05-15 02:31:39', '2021-05-15 02:31:39'),
(7, 'Cacao', 'Theobroma cacao', '2021-05-15 02:31:59', '2021-05-15 02:31:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Marco', 'sorkiar@gmail.com', NULL, '$2y$10$aa8xJTbWI5chPwpMYPOF5Ox1ut2XJG.wO70M6l7a2XO063Y76OCii', NULL, '2021-05-13 22:43:39', '2021-05-13 22:43:39'),
(4, 'erik', 'erik@gmail.com', NULL, '$2y$10$iULa80ExKRNZ4PVlYRe6FOn6UbwHtnveMU8JFkksIO09CuNl7LhYK', NULL, '2021-05-14 04:33:04', '2021-05-14 04:33:04'),
(5, 'Antoni', 'ansir.manuel@gmail.com', NULL, '$2y$10$wBg13XWu1v9B6KD4JF4L7.zMujtXLXVYZRBFHashDksDEEHEIyq9C', NULL, '2021-05-14 05:07:45', '2021-05-14 05:07:45'),
(6, 'abel', 'ferdidand_09_jfk@hotmail.com', NULL, '$2y$10$L7zfxkqkQg2mc.3YwtBX2uN9GGkqkB5H9XnDqepM4bJT0qr2iyE0q', 'rD2Osc2blPrR6tOPW2OzsN2TDxCJYRKpfvYxEk2v9nbi8NrNHgnqpSYSUWM5', '2021-05-14 05:14:07', '2021-05-14 05:14:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vincular`
--

CREATE TABLE `vincular` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `planta_id` bigint(20) UNSIGNED NOT NULL,
  `parametro_id` bigint(20) UNSIGNED NOT NULL,
  `valor_min` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor_max` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vincular`
--

INSERT INTO `vincular` (`id`, `planta_id`, `parametro_id`, `valor_min`, `valor_max`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '15cm', '56cm', '2021-05-14 05:24:03', '2021-05-14 05:24:03'),
(2, 1, 2, '5', '9', '2021-05-14 05:24:28', '2021-05-14 05:24:28'),
(3, 1, 3, '45cm', '58cm', '2021-05-14 05:25:02', '2021-05-14 05:25:02'),
(4, 2, 1, '45cm', '458cm', '2021-05-14 05:25:41', '2021-05-14 05:25:41'),
(5, 2, 2, '5', '9', '2021-05-14 05:25:57', '2021-05-14 05:25:57'),
(6, 3, 1, '56cm', '52cm', '2021-05-14 05:26:13', '2021-05-14 05:26:13'),
(7, 2, 3, '5cm', '6cm', '2021-05-14 05:26:25', '2021-05-14 05:26:36'),
(8, 3, 3, '6cm', '8cm', '2021-05-14 05:27:07', '2021-05-14 05:27:16'),
(9, 3, 2, '2', '6', '2021-05-14 05:27:30', '2021-05-14 05:27:30'),
(10, 2, 4, '5 mlg', '9mlg', '2021-05-14 05:37:31', '2021-05-14 05:37:31'),
(11, 3, 5, '5', '6', '2021-05-14 06:50:44', '2021-05-14 06:50:44');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `elementos`
--
ALTER TABLE `elementos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elementos_muestra_id_foreign` (`muestra_id`);

--
-- Indices de la tabla `elementos_image`
--
ALTER TABLE `elementos_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elementos_image_elemento_id_foreign` (`elemento_id`);

--
-- Indices de la tabla `elemento_parametro`
--
ALTER TABLE `elemento_parametro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elemento_parametro_elemento_id_foreign` (`elemento_id`),
  ADD KEY `elemento_parametro_parametro_id_foreign` (`parametro_id`);

--
-- Indices de la tabla `elemento_plaga`
--
ALTER TABLE `elemento_plaga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elemento_plaga_elemento_id_foreign` (`elemento_id`),
  ADD KEY `elemento_plaga_plaga_id_foreign` (`plaga_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `muestras`
--
ALTER TABLE `muestras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `muestras_planta_id_foreign` (`planta_id`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `plagas`
--
ALTER TABLE `plagas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plantas`
--
ALTER TABLE `plantas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `vincular`
--
ALTER TABLE `vincular`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vincular_planta_id_foreign` (`planta_id`),
  ADD KEY `vincular_parametro_id_foreign` (`parametro_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `elementos`
--
ALTER TABLE `elementos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `elementos_image`
--
ALTER TABLE `elementos_image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `elemento_parametro`
--
ALTER TABLE `elemento_parametro`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `elemento_plaga`
--
ALTER TABLE `elemento_plaga`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `muestras`
--
ALTER TABLE `muestras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `plagas`
--
ALTER TABLE `plagas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `plantas`
--
ALTER TABLE `plantas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vincular`
--
ALTER TABLE `vincular`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `elementos`
--
ALTER TABLE `elementos`
  ADD CONSTRAINT `elementos_muestra_id_foreign` FOREIGN KEY (`muestra_id`) REFERENCES `muestras` (`id`);

--
-- Filtros para la tabla `elementos_image`
--
ALTER TABLE `elementos_image`
  ADD CONSTRAINT `elementos_image_elemento_id_foreign` FOREIGN KEY (`elemento_id`) REFERENCES `elementos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `elemento_parametro`
--
ALTER TABLE `elemento_parametro`
  ADD CONSTRAINT `elemento_parametro_elemento_id_foreign` FOREIGN KEY (`elemento_id`) REFERENCES `elementos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `elemento_parametro_parametro_id_foreign` FOREIGN KEY (`parametro_id`) REFERENCES `parametros` (`id`);

--
-- Filtros para la tabla `elemento_plaga`
--
ALTER TABLE `elemento_plaga`
  ADD CONSTRAINT `elemento_plaga_elemento_id_foreign` FOREIGN KEY (`elemento_id`) REFERENCES `elementos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `elemento_plaga_plaga_id_foreign` FOREIGN KEY (`plaga_id`) REFERENCES `plagas` (`id`);

--
-- Filtros para la tabla `muestras`
--
ALTER TABLE `muestras`
  ADD CONSTRAINT `muestras_planta_id_foreign` FOREIGN KEY (`planta_id`) REFERENCES `plantas` (`id`);

--
-- Filtros para la tabla `vincular`
--
ALTER TABLE `vincular`
  ADD CONSTRAINT `vincular_parametro_id_foreign` FOREIGN KEY (`parametro_id`) REFERENCES `parametros` (`id`),
  ADD CONSTRAINT `vincular_planta_id_foreign` FOREIGN KEY (`planta_id`) REFERENCES `plantas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

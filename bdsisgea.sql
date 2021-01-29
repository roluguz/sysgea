-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 11-09-2017 a las 01:21:15
-- Versión del servidor: 5.5.45
-- Versión de PHP: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdsisgea`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `consulta` ()  NO SQL
BEGIN 
SELECT * FROM login ORDER BY id_login ASC; 
END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `DiaLetras` (`PFECHA` DATE) RETURNS INT(11) NO SQL
BEGIN
DECLARE Dia varchar(10);
SELECT 
CONCAT(ELT(WEEKDAY( PFECHA ) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) 
into Dia;
RETURN Dia;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesoriavirtual`
--

CREATE TABLE `asesoriavirtual` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `mensaje` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asesoriavirtual`
--

INSERT INTO `asesoriavirtual` (`id`, `nombre`, `mensaje`, `create_at`) VALUES
(1, '', '', '2017-09-06 00:06:36'),
(2, 'test', 'estes en el primer mesaje de prueba enviado desde el codigo', '2017-09-06 00:21:36'),
(3, 'cristian', 'ya :D', '2017-09-07 23:19:10'),
(4, 'cristian', 'aquí todo esta bien', '2017-09-08 03:22:45'),
(5, 'juan', 'este si que es un bien chat\r\n', '2017-09-08 03:25:05'),
(6, '', 'anque no funciona del todo bien :C', '2017-09-08 03:25:28'),
(7, 'crus', 'jajaja se me olvido el nombre', '2017-09-08 03:25:45'),
(8, 'fdfd', 'que tan rápido carrga esto\r\n', '2017-09-08 03:26:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendar`
--

CREATE TABLE `calendar` (
  `  id` int(11) NOT NULL,
  `  title` varchar(255) NOT NULL,
  `  allDay` varchar(5) NOT NULL,
  `url` varchar(70) NOT NULL,
  `backgroundColor` varchar(10) NOT NULL,
  `borderColor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `calendar`
--

INSERT INTO `calendar` (`  id`, `  title`, `  allDay`, `url`, `backgroundColor`, `borderColor`) VALUES
(1, 'presentación de proyecto', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evenement`
--

CREATE TABLE `evenement` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `backgroundColor` varchar(10) COLLATE utf8_bin NOT NULL,
  `borderColor` varchar(10) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `evenement`
--

INSERT INTO `evenement` (`id`, `title`, `start`, `end`, `backgroundColor`, `borderColor`) VALUES
(1, 'prueba 1', '2017-08-27 07:28:29', '2017-08-28 13:23:00', '#f56954', '#f56954'),
(2, 'est 2', '2017-08-29 14:36:00', '2017-08-28 13:34:00', '#f39c12', '#f39c12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `usuario` varchar(70) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `token` text,
  `password` varchar(250) NOT NULL,
  `creates_at` date DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id_login`, `usuario`, `correo`, `token`, `password`, `creates_at`, `updated_at`, `estado`) VALUES
(1, 'test1', 'test1@americana.edu.co', '4d367354bfd6905d3195508e593bc485cbfbb613', 'b444ac06613fc8d63795be9ad0beaf55011936ac', NULL, '2017-09-10 20:03:21', 1),
(2, 'test2', 'test2@americana.edu.co', '46815ed50ed242c3669d80108d09b58714036b48', '109f4b3c50d7b0df729d299bc6f8e9ef9066971f', NULL, '2017-09-11 03:37:57', 1),
(3, 'test3', 'test3@coruniamericana.edu.co', '416c7e528d6b35640de6c8bd11fe1da9075a3c36', '3ebfa301dc59196f18593c45e519287a23297589', NULL, '2017-09-11 04:11:18', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_perfil`
--

CREATE TABLE `login_perfil` (
  `id` int(11) NOT NULL,
  `login` int(11) NOT NULL,
  `perfil` int(11) NOT NULL,
  `create_at` date NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `codigo_menu` varchar(7) NOT NULL,
  `nombre_menu` varchar(70) NOT NULL,
  `link_menu` varchar(200) NOT NULL,
  `icono_menu` varchar(200) NOT NULL,
  `descripcion_menu` text NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id_menu`, `codigo_menu`, `nombre_menu`, `link_menu`, `icono_menu`, `descripcion_menu`, `create_at`, `updated_at`) VALUES
(1, 'regpro', 'Registro proyecto', '?page=frm_reg_proy', 'fa-cogs', 'Desde este formulario el usurio puede completar el registro inicil del proyecto integrador', '2017-08-01 00:00:00', '2017-08-27 03:55:36'),
(2, 'carch', 'Subir archivos', '?page=frm_carg_arch', 'fa-upload', 'Formulario para carga de los diferentes archivos requeridos para la presentación del proyecto', '2017-08-01 00:00:00', '2017-08-27 03:55:36'),
(3, 'perfil', 'Perfil', '?page=perfil', 'fa-newspaper-o', 'perfil publico donde se pueden ver informacion basica del proyecto', '2017-08-01 00:00:00', '2017-08-27 19:44:04'),
(4, 'Docpry', 'Documentos Proyecto', '?page=tbl_documentos_proyecto', 'fa-table', 'esta tabla muestra el historial de archivos del proyecto existentes en la plataforma', '2017-08-01 00:00:00', '2017-08-27 19:44:04'),
(5, 'calend', 'Calendario', '?page=calendario\r\n', 'fa-calendar', 'calendario de actividades', '2017-08-01 00:00:00', '2017-08-27 19:51:45'),
(6, 'chatest', 'Asesorías Virtuales', '?page=asesoriavirtual', 'fa-weixin', 'Chat para realizar asesorias virtuales de los proyectos integradores', '2017-09-07 00:00:00', '2017-09-08 03:43:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_perfil`
--

CREATE TABLE `menu_perfil` (
  `idm_P` int(11) NOT NULL,
  `perfil` int(11) NOT NULL,
  `menu` int(11) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `codigo_perfil` varchar(7) NOT NULL,
  `nombre_perfil` varchar(255) NOT NULL,
  `descripcion_perfil` text NOT NULL,
  `estado_perfil` int(11) NOT NULL DEFAULT '1',
  `creates_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `codigo_perfil`, `nombre_perfil`, `descripcion_perfil`, `estado_perfil`, `creates_at`, `updated_at`) VALUES
(1, 'EST', 'Estudiante', 'Perfil asiganado a estudiantes, perfil estandar de la base de datos', 1, '2017-08-01 05:00:00', '2017-08-20 15:17:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_estudiante`
--

CREATE TABLE `proyecto_estudiante` (
  `id` int(11) NOT NULL,
  `estudiante` int(11) NOT NULL,
  `proyecto` int(11) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyecto_estudiante`
--

INSERT INTO `proyecto_estudiante` (`id`, `estudiante`, `proyecto`, `update_at`) VALUES
(1, 1, 1, '2017-09-11 02:57:24'),
(2, 2, 6, '2017-09-11 04:04:51'),
(3, 2, 8, '2017-09-11 04:05:29'),
(4, 5, 10, '2017-09-11 04:54:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblproyecto`
--

CREATE TABLE `tblproyecto` (
  `id_proyecto` int(11) NOT NULL,
  `cod_proy` varchar(20) NOT NULL,
  `semestre_proyecto` varchar(30) NOT NULL,
  `nombre_proyecto` text NOT NULL,
  `tema_proyecto` text NOT NULL,
  `problema_proyecto` text NOT NULL,
  `descripcion_proyecto` text NOT NULL,
  `objetivoG_proyecto` text NOT NULL,
  `objetivoE_proyecto` text NOT NULL,
  `justificacion_proyecto` text NOT NULL,
  `estado_proyecto` int(11) DEFAULT '1',
  `create_at` date DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblproyecto`
--

INSERT INTO `tblproyecto` (`id_proyecto`, `cod_proy`, `semestre_proyecto`, `nombre_proyecto`, `tema_proyecto`, `problema_proyecto`, `descripcion_proyecto`, `objetivoG_proyecto`, `objetivoE_proyecto`, `justificacion_proyecto`, `estado_proyecto`, `create_at`, `update_at`) VALUES
(1, '152017203I', 'Primero', 'proyecto de prueba numero uno', 'proyecto para ejemplificar el perfil', 'verificicar que todos los componentes del proyecto funcionen bien', 'prueba pra mostrar el funciona miento del perfil y otros motivos', 'mostrar de manera optima el perfil del proyecto', 'crear perfil en base de datos; mostar perfil en entorno web; hacer que todo funcione', 'prueba para que se muestre de manera optima en la web', 1, '2017-09-01', '2017-09-10 20:31:54'),
(2, '252017205I', 'Primero', 'prueba de registro de proyecto numero uno', ' registro desde formulario', 'garantizar que la primera fase de registro sea exitosa', 'ingresar datos desde el formulario y validar que llegue a la base de datos', 'meterle info al sistema desde el fomrukario', 'revisar que todo funcione; comporbar que las cosas funcionen bien', 'esperamos que la prueba sea exitosa', 1, NULL, '2017-09-10 21:51:26'),
(3, '352017205I', 'Primero', 'segunda prueba con registro en tabla pivot', ' registro en tabla pivot', 'validaar el registro completo en pivot', 'proyecto', 'regisro ', 'codificar; registrar; probar', 'probar y validar', 1, NULL, '2017-09-11 03:41:56'),
(6, '452017205I', 'Primero', 'segunda prueba con registro en tabla pivot', ' registro en tabla pivot', 'validaar el registro completo en pivot', 'proyecto', 'regisro ', 'codificar; registrar; probar', 'probar y validar', 1, NULL, '2017-09-11 03:59:38'),
(7, '552017205I', 'Primero', 'segunda prueba con registro en tabla pivot', ' registro en tabla pivot', 'validaar el registro completo en pivot', 'proyecto', 'regisro ', 'codificar; registrar; probar', 'probar y validar', 1, NULL, '2017-09-11 04:03:40'),
(8, '652017205I', 'Primero', 'segunda prueba con registro en tabla pivot', ' registro en tabla pivot', 'validaar el registro completo en pivot', 'proyecto', 'regisro ', 'codificar; registrar; probar', 'probar y validar', 1, NULL, '2017-09-11 04:05:29'),
(9, '852017205I', 'Semestre', 'hdhsdfjkhsdj', ' idsjfklsdjfksfjd', 'dksjfksdjflk', 'dskjfkdsjsjlkñ', 'dskjfkdsjflñ', 'ksdfjkdsjffjslj', 'kjfdksjfdkl', 1, NULL, '2017-09-11 04:47:36'),
(10, '2352017205I', 'Primero', 'jdfsdjsl', ' jwelkjwekjkl', 'klwjfklwejkj', 'jksdkdjsg', 'kdjkerjº', 'ksdjfksdj', 'kjdfkldsj', 1, NULL, '2017-09-11 04:54:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuarios`
--

CREATE TABLE `tblusuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres_usario` varchar(100) NOT NULL,
  `apellidos_usuario` varchar(100) NOT NULL,
  `tipo_documento` varchar(100) NOT NULL,
  `numero_documento` int(11) NOT NULL,
  `carrera` varchar(100) NOT NULL,
  `semestre` int(11) NOT NULL DEFAULT '1',
  `correo_personal` varchar(150) NOT NULL,
  `numero_telefono` bigint(11) NOT NULL,
  `create_at` date DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `login` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblusuarios`
--

INSERT INTO `tblusuarios` (`id_usuario`, `nombres_usario`, `apellidos_usuario`, `tipo_documento`, `numero_documento`, `carrera`, `semestre`, `correo_personal`, `numero_telefono`, `create_at`, `update_at`, `login`) VALUES
(1, 'test1', 'test1', 'Cedula de Cuidadania', 1234567890, 'Ingenieria Sistemas', 1, 'test1@gmail.com', 55555555, NULL, '2017-09-10 20:03:21', 'test1'),
(2, 'test2', 'test2', 'Cedula de Cuidadania', 987654321, 'Ingenieria Sistemas', 1, 'test2@gmail.com', 56789887, NULL, '2017-09-11 03:37:57', 'test2'),
(5, 'test3', 'test3', 'Tarjeta de Identidad', 123456777, 'Ingenieria Sistemas', 1, 'test3@gmail.com', 325263625, NULL, '2017-09-11 04:41:33', 'test3');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_usuarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_usuarios` (
`usuario` varchar(70)
,`password` varchar(250)
,`nombres_usario` varchar(100)
,`apellidos_usuario` varchar(100)
,`carrera` varchar(100)
,`semestre` int(11)
,`id_perfil` int(11)
,`nombre_perfil` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vs_session`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vs_session` (
`usuario` varchar(70)
,`password` varchar(250)
,`nombres_usario` varchar(100)
,`apellidos_usuario` varchar(100)
,`carrera` varchar(100)
,`semestre` int(11)
,`id_perfil` int(11)
,`nombre_perfil` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_usuarios`
--
DROP TABLE IF EXISTS `vista_usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_usuarios`  AS  select `login`.`usuario` AS `usuario`,`login`.`password` AS `password`,`tblusuarios`.`nombres_usario` AS `nombres_usario`,`tblusuarios`.`apellidos_usuario` AS `apellidos_usuario`,`tblusuarios`.`carrera` AS `carrera`,`tblusuarios`.`semestre` AS `semestre`,`perfil`.`id_perfil` AS `id_perfil`,`perfil`.`nombre_perfil` AS `nombre_perfil` from ((`perfil` join (`login` join `login_perfil` on((`login`.`id_login` = `login_perfil`.`login`))) on((`perfil`.`id_perfil` = `login_perfil`.`perfil`))) join `tblusuarios` on((`login`.`usuario` = `tblusuarios`.`login`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vs_session`
--
DROP TABLE IF EXISTS `vs_session`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_session`  AS  select `login`.`usuario` AS `usuario`,`login`.`password` AS `password`,`tblusuarios`.`nombres_usario` AS `nombres_usario`,`tblusuarios`.`apellidos_usuario` AS `apellidos_usuario`,`tblusuarios`.`carrera` AS `carrera`,`tblusuarios`.`semestre` AS `semestre`,`perfil`.`id_perfil` AS `id_perfil`,`perfil`.`nombre_perfil` AS `nombre_perfil` from ((`perfil` join (`login` join `login_perfil` on((`login`.`id_login` = `login_perfil`.`login`))) on((`perfil`.`id_perfil` = `login_perfil`.`perfil`))) join `tblusuarios` on((`login`.`usuario` = `tblusuarios`.`login`))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asesoriavirtual`
--
ALTER TABLE `asesoriavirtual`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`  id`);

--
-- Indices de la tabla `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`),
  ADD UNIQUE KEY `login_user` (`usuario`),
  ADD UNIQUE KEY `correo_usuario` (`correo`);

--
-- Indices de la tabla `login_perfil`
--
ALTER TABLE `login_perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `menu_perfil`
--
ALTER TABLE `menu_perfil`
  ADD PRIMARY KEY (`idm_P`),
  ADD KEY `FK_menu_perfil` (`menu`),
  ADD KEY `FK_perfil_menu` (`perfil`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `proyecto_estudiante`
--
ALTER TABLE `proyecto_estudiante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tblproyecto`
--
ALTER TABLE `tblproyecto`
  ADD PRIMARY KEY (`id_proyecto`),
  ADD UNIQUE KEY `codigo_proyecto` (`cod_proy`);

--
-- Indices de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `numero_documento` (`numero_documento`),
  ADD UNIQUE KEY `correo_personal` (`correo_personal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asesoriavirtual`
--
ALTER TABLE `asesoriavirtual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `calendar`
--
ALTER TABLE `calendar`
  MODIFY `  id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `login_perfil`
--
ALTER TABLE `login_perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `menu_perfil`
--
ALTER TABLE `menu_perfil`
  MODIFY `idm_P` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `proyecto_estudiante`
--
ALTER TABLE `proyecto_estudiante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tblproyecto`
--
ALTER TABLE `tblproyecto`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `menu_perfil`
--
ALTER TABLE `menu_perfil`
  ADD CONSTRAINT `FK_menu_perfil` FOREIGN KEY (`menu`) REFERENCES `menu` (`id_menu`),
  ADD CONSTRAINT `FK_perfil_menu` FOREIGN KEY (`perfil`) REFERENCES `perfil` (`id_perfil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

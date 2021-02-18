-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2021 a las 16:05:53
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `apirest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `CitaId` int(11) NOT NULL,
  `PacienteId` int(11) NOT NULL,
  `Fecha` varchar(45) DEFAULT NULL,
  `HoraInicio` varchar(45) DEFAULT NULL,
  `HoraFin` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT 'Activo',
  `Motivo` varchar(45) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`CitaId`, `PacienteId`, `Fecha`, `HoraInicio`, `HoraFin`, `Estado`, `Motivo`, `id_usuario`) VALUES
(1, 1, '2021-02-14', '08:30:00', '09:00:00', 'Activo', 'El paciente presenta un leve dolor de espalda', 1),
(2, 2, '2020-06-10', '08:30:00', '09:00:00', 'Activo', 'Dolor en la zona lumbar ', 5),
(3, 3, '2020-06-18', '09:00:00', '09:30:00', 'Activo', 'Dolor en el cuello', 4),
(6, 2, '2021-02-27', '08:30', '09:00', 'Activo', 'El paciente presenta dolor de cabeza y oidos', 1),
(7, 2, '2021-02-26', '10:00', '10:30', 'Activo', 'El paciente le duele espalda y rodillas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `idnotas` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`idnotas`, `titulo`, `descripcion`, `idusuario`) VALUES
(1, 'Reunion con Compañeros', 'Reunirme el dia 22 de febrero del 2021.', 1),
(2, 'Hello', 'La teoria de la relatividad es muy hermosa', 4),
(4, 'Buscar Agenda ', 'Buscar agenda que contiene informacion sobre medicamentos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `PacienteId` int(11) NOT NULL,
  `DNI` varchar(45) DEFAULT NULL,
  `Nombre` varchar(150) DEFAULT NULL,
  `Direccion` varchar(45) DEFAULT NULL,
  `CodigoPostal` varchar(45) DEFAULT NULL,
  `Telefono` varchar(45) DEFAULT NULL,
  `Genero` varchar(45) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Correo` varchar(45) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`PacienteId`, `DNI`, `Nombre`, `Direccion`, `CodigoPostal`, `Telefono`, `Genero`, `FechaNacimiento`, `Correo`, `id_usuario`) VALUES
(1, 'A000000001', 'Juan Carlos Medina', 'Calle de pruebas 1', '20001', '633281515', 'M', '1989-03-02', 'Paciente1@gmail.com', 2),
(2, 'B000000002', 'Daniel Rios', 'Calle de pruebas 2', '20002', '633281512', 'M', '1990-05-11', 'Paciente2@gmail.com', 0),
(3, 'C000000003', 'Marcela Dubon', 'Calle de pruebas 3', '20003', '633281511', 'F', '2000-07-22', 'Paciente3@gmail.com', 0),
(4, 'D000000004', 'Maria Mendez', 'Calle de pruebas 4', '20004', '633281516', 'F', '1980-01-01', 'Paciente4@gmail.com', 0),
(5, 'E000000005', 'Zamuel Valladares', 'Calle de pruebas 5', '20006', '633281519', 'M', '1985-12-15', 'Paciente5@gmail.com', 0),
(6, 'F000000006', 'Angel Rios', 'Calle de pruebas 6', '20005', '633281510', 'M', '1988-11-30', 'Paciente6@gmail.com', 0),
(7, '0308', 'Darwin Pacheco', 'Esquipulas', '515', '54123310', 'M', '2011-05-26', 'darwin@gmail.com', 1),
(8, '443r435', 'Jose Perez Leon', 'Ciudad Capital ', '515', '54123310', 'M', '2000-05-26', 'camila@gmail.com', 1),
(9, '44355435', 'Byron Lopes', 'Esquipulas', '515', '66161616', 'M', '2000-05-26', 'byronlopez@gmail.com', 0),
(10, '5478435', 'Ernesto Ramirez', 'Ciudad Capital', '5155', '54789421', 'M', '1980-05-26', 'ernestoramirez@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT 'Activo',
  `telefono` int(11) NOT NULL,
  `idrol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `usuario`, `password`, `estado`, `telefono`, `idrol`) VALUES
(1, 'Edvin Pacheco', 'edvinpacheco03@gmail.com', '883b79f2889beac4ec9e03a36952f943', 'Activo', 37031611, 1),
(2, 'Usuario 2', 'usuario2@gmail.com', '883b79f2889beac4ec9e03a36952f943', 'Activo', 54786987, 2),
(3, 'Usuario 3', 'usuario3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo', 45698732, 2),
(4, 'Usuario 4', 'usuario4@gmail.com', '883b79f2889beac4ec9e03a36952f943', 'Inactivo', 41235478, 2),
(5, 'Francisco Alarcon', 'franciscoalarcon@gmail.com', '883b79f2889beac4ec9e03a36952f943', 'Activo', 54621354, 2),
(6, 'Usuario 6', 'usuario6@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo', 54781245, 2),
(7, 'Usuario 7', 'usuario7@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Inactivo', 54632151, 2),
(8, 'Usuario 8', 'usuario8@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Inactivo', 54124752, 2),
(9, 'Usuario 9', 'usuario9@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Inactivo', 21325415, 2),
(10, 'Mario Enrique Carbajal', 'mariocarbajal@gmail.com', '883b79f2889beac4ec9e03a36952f943', 'Activo', 54213695, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_token`
--

CREATE TABLE `usuarios_token` (
  `TokenId` int(11) NOT NULL,
  `UsuarioId` varchar(45) DEFAULT NULL,
  `Token` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) CHARACTER SET armscii8 DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios_token`
--

INSERT INTO `usuarios_token` (`TokenId`, `UsuarioId`, `Token`, `Estado`, `Fecha`) VALUES
(2, '1', '8f76f3b93219e3cf5f923d26f3b3871b', 'Activo', '2021-01-27 02:49:00'),
(3, '1', '0ab1a7155e2b041f4bdbe1c3c59ca2c4', 'Activo', '2021-01-27 02:53:00'),
(4, '1', '8323ccba7874fad82fbd866f8b03d345', 'Activo', '2021-01-29 04:02:00'),
(5, '1', 'd24c4912d00e0a7816c053395316f843', 'Activo', '2021-01-29 06:35:00'),
(6, '1', '875d4b044266fe98076d2c915f4a7343', 'Activo', '2021-01-30 01:54:00'),
(7, '1', '87d31dc709c656c71fcc0fce1bb6aa4b', 'Activo', '2021-01-30 02:02:00'),
(22, '1', '6bac3e4b580b74fc1c17507ec33ef44b', 'Activo', '2021-01-30 16:04:00'),
(23, '1', '679d86dd644e550543a09e483ca3ec1f', 'Activo', '2021-01-30 16:05:00'),
(24, '1', 'd1c8058a0bd9280a522106021b268439', 'Activo', '2021-01-30 16:06:00'),
(25, '1', '5528f95497f12d77131916892d2c3145', 'Activo', '2021-01-30 16:11:00'),
(32, '1', '4bbca1fc42da88ed624bb0534f2ef257', 'Activo', '2021-01-30 17:35:00'),
(33, '1', '64683081aa892e03db901743334e9bd0', 'Activo', '2021-01-30 17:37:00'),
(34, '1', 'd011e787c62dcc9beb9f517917acc517', 'Activo', '2021-01-30 17:39:00'),
(35, '1', '04bf7ab28e483e6ceb0e0dbe30d6bdd4', 'Activo', '2021-01-30 17:44:00'),
(36, '1', '414c00eff31413423f22ecfcfebff25d', 'Activo', '2021-01-30 17:58:00'),
(37, '1', '32bde70ff7606d9e17b7f33009c141b0', 'Activo', '2021-01-30 18:02:00'),
(38, '1', 'a6c8cf7cf8d36cee244b00e1ce7a5a8b', 'Activo', '2021-01-30 18:02:00'),
(39, '1', '1948739c9b3deae98721f39c69c83ea0', 'Activo', '2021-01-30 18:05:00'),
(40, '1', '1ca2188a5c255efc3263e42b8964bfb7', 'Activo', '2021-01-30 18:05:00'),
(41, '1', '5e5162e22ce41b8c58808ba385b2b2cb', 'Activo', '2021-01-30 19:10:00'),
(42, '1', '40a972c92a4d46de7587f3d4edb0eb51', 'Activo', '2021-01-30 19:12:00'),
(43, '1', 'd37843dad9ff6c4bcfbafc33e247a261', 'Activo', '2021-01-30 19:13:00'),
(44, '1', '38119fd6343da08891febef8c30e3f2f', 'Activo', '2021-01-30 19:54:00'),
(45, '1', '71eeed774d1b16f42059fb3e11e76ddf', 'Activo', '2021-01-30 20:14:00'),
(46, '1', '3e1b28a828d049132ee616efe7c29640', 'Activo', '2021-01-30 20:38:00'),
(47, '1', 'e8de4f05a98384edd349a67c5e9ec5eb', 'Activo', '2021-01-30 20:39:00'),
(48, '1', '4643eb9413ef1177136f809347fdff09', 'Activo', '2021-01-30 20:41:00'),
(49, '1', 'dc67b0aa644e3f2537d50e23e0c70b0c', 'Activo', '2021-01-30 20:41:00'),
(50, '1', 'b90497721aeabd994899cf01ceb8241b', 'Activo', '2021-01-30 20:47:00'),
(51, '1', '589d5b0c2a00ede48b2619b551a5cc5c', 'Activo', '2021-01-30 20:48:00'),
(52, '1', '76063ce7e3f7c527689736b45aa83891', 'Activo', '2021-01-30 20:52:00'),
(53, '1', 'a6e9b797ff2478cde2011d2268288a3b', 'Activo', '2021-01-30 20:54:00'),
(54, '1', 'fe78aef9a3ba335d159fc09b3ca5b241', 'Activo', '2021-01-30 20:55:00'),
(55, '1', '494f88dd1fb48b4ab0ad16c3f730da85', 'Activo', '2021-01-30 20:57:00'),
(56, '1', '323850989f493a03a156d19ca7fb553c', 'Activo', '2021-01-30 21:00:00'),
(57, '1', 'ccd97d8300d694048fdfbfa6cc4c3679', 'Activo', '2021-01-30 21:15:00'),
(58, '1', '4c4c67fdacaf45cd4c2893ea98815373', 'Activo', '2021-01-31 18:40:00'),
(59, '1', 'b26635a5e7fd947660aaea19a0c0bd5f', 'Activo', '2021-02-02 03:04:00'),
(60, '1', 'afe87c1dde0c82125a36a0ce5fa6d150', 'Activo', '2021-02-02 03:07:00'),
(61, '1', '309058ad42f7d9388121f387ca789259', 'Activo', '2021-02-02 03:08:00'),
(62, '1', 'aa3e8512ca772177b9faa7727c29d97b', 'Activo', '2021-02-05 05:14:00'),
(63, '1', '433c20950b0abfe87f88998e9c381e89', 'Activo', '2021-02-05 05:14:00'),
(64, '1', 'e8ab81cf78887dab68c64259458db7b2', 'Activo', '2021-02-05 05:15:00'),
(65, '1', 'f335fddb495923a8bca248e801a40f8b', 'Activo', '2021-02-05 05:15:00'),
(66, '1', '85a29f8bd37f38c7d4afe4da2c942ccc', 'Activo', '2021-02-06 01:16:00'),
(67, '1', '23c5530119922767d31510028e3e6c73', 'Activo', '2021-02-06 01:17:00'),
(68, '1', '37e763687bc42fb62cf3ca9a0f4234a6', 'Activo', '2021-02-06 01:18:00'),
(69, '1', '5d83c54093af44d557bf03983cb06290', 'Activo', '2021-02-06 01:25:00'),
(70, '1', '6d944d9d80f21d1843ba187c69995080', 'Activo', '2021-02-06 01:28:00'),
(71, '2', 'cb49b2923a5134376091dc194fd0d593', 'Activo', '2021-02-06 01:29:00'),
(72, '1', 'f985fc7f14c058342b9145a5d6952ef8', 'Activo', '2021-02-06 01:43:00'),
(73, '1', '3344ff76ffe56ab54d19ca26e5446619', 'Activo', '2021-02-06 18:41:00'),
(74, '1', '12065f0fb8b6d183530b048af3608571', 'Activo', '2021-02-06 18:55:00'),
(75, '1', '3d0941be898c3f1393cfd9557495b2f4', 'Activo', '2021-02-06 19:49:00'),
(76, '1', '65402cf475e6d655809a170162cb02de', 'Activo', '2021-02-06 19:56:00'),
(77, '1', '7863b3d901fe7060c5ba1c7a68217b13', 'Activo', '2021-02-06 19:57:00'),
(78, '1', 'aa840a8162f26fce211ca4e92eeda508', 'Activo', '2021-02-06 20:08:00'),
(79, '1', 'c3f1346f6a617e352bfb12aeb435b11b', 'Activo', '2021-02-06 20:11:00'),
(80, '1', 'db32efad0792e1481f906dacc4eb8228', 'Activo', '2021-02-06 20:23:00'),
(81, '1', 'e3416970a095cb8b375cd4f51c5c9430', 'Activo', '2021-02-06 22:08:00'),
(82, '1', '3d22db6b899d752656b92eb54a0f00d3', 'Activo', '2021-02-07 18:44:00'),
(83, '1', 'dac50ce0f4f7847be894dc83ae3c025e', 'Activo', '2021-02-08 01:47:00'),
(84, '1', '279068e9da51cb4af7c2d89175b6ceba', 'Activo', '2021-02-08 05:25:00'),
(85, '4', '9f2249459dd2b2b53c5870d4d739175d', 'Activo', '2021-02-08 22:56:00'),
(86, '4', 'ff312ef483a2504f90a27a1f619970c8', 'Activo', '2021-02-08 23:01:00'),
(87, '4', 'c8de85bda52fab95fc4fa75891b9caa5', 'Activo', '2021-02-08 23:02:00'),
(88, '1', '007d2244ec088d8e427f1f868ed2033b', 'Activo', '2021-02-09 02:34:00'),
(89, '1', 'e3d228cc6050fe2eff4a33a0b74bfb58', 'Activo', '2021-02-09 17:02:00'),
(90, '1', '914364142211240f7cc64bd40c259aa7', 'Activo', '2021-02-09 20:46:00'),
(91, '1', '1eb8279c17b40ca29bb046a6002159d5', 'Activo', '2021-02-11 15:52:00'),
(92, '1', '9ca94c77448f041295ecbaacf856cca8', 'Activo', '2021-02-11 17:40:00'),
(93, '1', '12b982ae92a695a4c9e000dd4e8193d0', 'Activo', '2021-02-11 17:42:00'),
(94, '1', 'a2b974af1aa38093b380a3fb20890289', 'Activo', '2021-02-11 20:26:00'),
(95, '1', '0fb46d6bdd0e8b19c17bf06c67ee1d2e', 'Activo', '2021-02-11 20:50:00'),
(96, '1', 'f485db0a5fd0867f0cf3fc913d5c6132', 'Activo', '2021-02-12 01:42:00'),
(97, '1', '39101f0637577e422b9c57dfbba482b0', 'Activo', '2021-02-12 23:58:00'),
(98, '2', '1f2f68a8144a46347bb16c8f5d00adbb', 'Activo', '2021-02-13 18:41:00'),
(99, '2', 'a5cca7c59f825f9e1c29633d42f68d30', 'Activo', '2021-02-13 18:42:00'),
(100, '1', 'e688fb2cc373a7ec0fb3a905879109a4', 'Activo', '2021-02-13 18:44:00'),
(101, '1', '2507f9d613c5e36733447577bc357257', 'Activo', '2021-02-13 19:12:00'),
(102, '1', 'c50ac980a6092811fd060eea49bb0056', 'Activo', '2021-02-14 22:12:00'),
(103, '1', '04f309ef0595a66e3d4a1317db348a94', 'Activo', '2021-02-14 23:03:00'),
(104, '1', '25de2d43ad7e130135138504f95d5953', 'Activo', '2021-02-14 23:19:00'),
(105, '1', '021e8aa66a5c08f44e3c009e20f55036', 'Activo', '2021-02-14 23:25:00'),
(106, '1', '7cdc8e3e0409e4fefba530d9cd6832a7', 'Activo', '2021-02-14 23:45:00'),
(107, '1', '6ad3c48d450b84019310428d2cb9b362', 'Activo', '2021-02-15 00:54:00'),
(108, '1', 'e238d0142ad892386f7e8bce97e6954f', 'Activo', '2021-02-15 02:01:00'),
(109, '5', '0c6c03ffdb5f2f62bd497b36b11d48fa', 'Activo', '2021-02-15 16:03:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`CitaId`),
  ADD KEY `fk_cita_paciente` (`PacienteId`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`idnotas`),
  ADD KEY `fk_notas_usuarios` (`idusuario`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`PacienteId`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuarios_token`
--
ALTER TABLE `usuarios_token`
  ADD PRIMARY KEY (`TokenId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `CitaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `idnotas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `PacienteId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios_token`
--
ALTER TABLE `usuarios_token`
  MODIFY `TokenId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_cita_paciente` FOREIGN KEY (`PacienteId`) REFERENCES `pacientes` (`PacienteId`);

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `fk_notas_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-09-2025 a las 00:43:27
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
-- Base de datos: `sistema_facturacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canton`
--

CREATE TABLE `canton` (
  `cod_canton` int(10) NOT NULL,
  `descrip_canton` varchar(100) NOT NULL,
  `cod_prov` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `canton`
--

INSERT INTO `canton` (`cod_canton`, `descrip_canton`, `cod_prov`) VALUES
(1, 'Camilo Ponce Enríquez', 1),
(2, 'Chordeleg', 1),
(3, 'Cuenca', 1),
(4, 'El Pan', 1),
(5, 'Girón', 1),
(6, 'Guachapala', 1),
(7, 'Gualaceo', 1),
(8, 'Nabón', 1),
(9, 'Oña', 1),
(10, 'Paute', 1),
(11, 'Pucará', 1),
(12, 'San Fernando', 1),
(13, 'Santa Isabel', 1),
(14, 'Sevilla de Oro', 1),
(15, 'Sígsig', 1),
(16, 'Guaranda', 2),
(17, 'Chillanes', 2),
(18, 'Chimbo', 2),
(19, 'Echeandía', 2),
(20, 'Caluma', 2),
(21, 'San José de Chimbo', 2),
(22, 'Las Naves', 2),
(23, 'Azogues', 3),
(24, 'Cañar', 3),
(25, 'Biblián', 3),
(26, 'La Troncal', 3),
(27, 'El Tambo', 3),
(28, 'Déleg', 3),
(29, 'Suscal', 3),
(30, 'Bolívar', 4),
(31, 'Espejo', 4),
(32, 'Mira', 4),
(33, 'Montufar', 4),
(34, 'San Pedro de Huaca', 4),
(35, 'Tulcán', 4),
(36, 'Alausí', 5),
(37, 'Chambo', 5),
(38, 'Chunchi', 5),
(39, 'Colta', 5),
(40, 'Cumandá', 5),
(41, 'Guamote', 5),
(42, 'Guano', 5),
(43, 'Pallatanga', 5),
(44, 'Latacunga', 6),
(45, 'Pujilí', 6),
(46, 'Salcedo', 6),
(47, 'Pangua', 6),
(48, 'Saquisilí', 6),
(49, 'La Maná', 6),
(50, 'Sigchos', 6),
(51, 'Machala', 7),
(52, 'Arenillas', 7),
(53, 'Atahualpa', 7),
(54, 'Balsas', 7),
(55, 'Chilla', 7),
(56, 'El Guabo', 7),
(57, 'Huaquillas', 7),
(58, 'Las Lajas', 7),
(59, 'Marcabelí', 7),
(60, 'Pasaje', 7),
(61, 'Piñas', 7),
(62, 'Portovelo', 7),
(63, 'Santa Rosa', 7),
(64, 'Zaruma', 7),
(65, 'Esmeraldas', 8),
(66, 'Atacames', 8),
(67, 'Eloy Alfaro', 8),
(68, 'Muisne', 8),
(69, 'Quinindé', 8),
(70, 'Rioverde', 8),
(71, 'San Lorenzo', 8),
(72, 'San Cristóbal', 9),
(73, 'Santa Cruz', 9),
(74, 'Isabela', 9),
(75, 'Alfredo Baquerizo Moreno', 10),
(76, 'Balao', 10),
(77, 'Balzar', 10),
(78, 'Colimes', 10),
(79, 'Coronel Marcelino Maridueña', 10),
(80, 'Daule', 10),
(81, 'Durán', 10),
(82, 'El Empalme', 10),
(83, 'El Triunfo', 10),
(84, 'General Antonio Elizalde', 10),
(85, 'Guayaquil', 10),
(86, 'Isidro Ayora', 10),
(87, 'Lomas de Sargentillo', 10),
(88, 'Milagro', 10),
(89, 'Naranjal', 10),
(90, 'Naranjito', 10),
(91, 'Nobol', 10),
(92, 'Palestina', 10),
(93, 'Pedro Carbo', 10),
(94, 'Playas', 10),
(95, 'Salitre', 10),
(96, 'Samborondón', 10),
(97, 'San Jacinto de Yaguachi', 10),
(98, 'Santa Lucía', 10),
(99, 'Simón Bolívar', 10),
(100, 'Ibarra', 11),
(101, 'Otavalo', 11),
(102, 'Cotacachi', 11),
(103, 'Antonio Ante', 11),
(104, 'Pimampiro', 11),
(105, 'Urcuquí', 11),
(106, 'Calvas', 12),
(107, 'Catamayo', 12),
(108, 'Celica', 12),
(109, 'Chaguarpamba', 12),
(110, 'Espíndola', 12),
(111, 'Gonzanamá', 12),
(112, 'Loja', 12),
(113, 'Macará', 12),
(114, 'Olmedo', 12),
(115, 'Paltas', 12),
(116, 'Pindal', 12),
(117, 'Puyango', 12),
(118, 'Quilanga', 12),
(119, 'Saraguro', 12),
(120, 'Sozoranga', 12),
(121, 'Zapotillo', 12),
(122, 'Baba', 13),
(123, 'Babahoyo', 13),
(124, 'Buena Fe', 13),
(125, 'Mocache', 13),
(126, 'Montalvo', 13),
(127, 'Palenque', 13),
(128, 'Puebloviejo', 13),
(129, 'Quevedo', 13),
(130, 'Quinsaloma', 13),
(131, 'Urdaneta', 13),
(132, 'Valencia', 13),
(133, 'Ventanas', 13),
(134, 'Vinces', 13),
(135, '24 de Mayo', 14),
(136, 'Bolívar', 14),
(137, 'Chone', 14),
(138, 'El Carmen', 14),
(139, 'Flavio Alfaro', 14),
(140, 'Jama', 14),
(141, 'Jaramijó', 14),
(142, 'Jipijapa', 14),
(143, 'Junín', 14),
(144, 'Manta', 14),
(145, 'Montecristi', 14),
(146, 'Olmedo', 14),
(147, 'Paján', 14),
(148, 'Pedernales', 14),
(149, 'Pichincha', 14),
(150, 'Portoviejo', 14),
(151, 'Puerto López', 14),
(152, 'Rocafuerte', 14),
(153, 'Santa Ana', 14),
(154, 'San Vicente', 14),
(155, 'Sucre', 14),
(156, 'Tosagua', 14),
(157, 'Gualaquiza', 15),
(158, 'Huamboya', 15),
(159, 'Limón Indanza', 15),
(160, 'Logroño', 15),
(161, 'Morona', 15),
(162, 'Pablo Sexto', 15),
(163, 'Palora', 15),
(164, 'San Juan Bosco', 15),
(165, 'Santiago', 15),
(166, 'Sevilla Don Bosco', 15),
(167, 'Sucúa', 15),
(168, 'Taisha', 15),
(169, 'Tiwintza', 15),
(170, 'Archidona', 16),
(171, 'Carlos Julio Arosemena Tola', 16),
(172, 'El Chaco', 16),
(173, 'Quijos', 16),
(174, 'Tena', 16),
(175, 'Francisco de Orellana', 17),
(176, 'Aguarico', 17),
(177, 'La Joya de los Sachas', 17),
(178, 'Loreto', 17),
(179, 'Pastaza', 18),
(180, 'Mera', 18),
(181, 'Santa Clara', 18),
(182, 'Arajuno', 18),
(183, 'Quito', 19),
(184, 'Cayambe', 19),
(185, 'Mejía', 19),
(186, 'Pedro Moncayo', 19),
(187, 'Pedro Vicente Maldonado', 19),
(188, 'Puerto Quito', 19),
(189, 'Rumiñahui', 19),
(190, 'San Miguel de los Bancos', 19),
(191, 'Santa Elena', 20),
(192, 'La Libertad', 20),
(193, 'Salinas', 20),
(194, 'Santo Domingo', 21),
(195, 'La Concordia', 21),
(196, 'Lago Agrio', 22),
(197, 'Gonzalo Pizarro', 22),
(198, 'Shushufindi', 22),
(199, 'Sucumbíos', 22),
(200, 'Cuyabeno', 22),
(201, 'Putumayo', 22),
(202, 'Cascales', 22),
(203, 'Ambato', 23),
(204, 'Baños de Agua Santa', 23),
(205, 'Cevallos', 23),
(206, 'Mocha', 23),
(207, 'Patate', 23),
(208, 'Quero', 23),
(209, 'Pelileo', 23),
(210, 'Píllaro', 23),
(211, 'Tisaleo', 23),
(212, 'Centinela del Cóndor', 24),
(213, 'Chinchipe', 24),
(214, 'El Pangui', 24),
(215, 'Nangaritza', 24),
(216, 'Palanda', 24),
(217, 'Paquisha', 24),
(218, 'Yacuambi', 24),
(219, 'Yantzaza', 24),
(220, 'Zamora', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `cod_cate` int(10) NOT NULL,
  `descrip_cate` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`cod_cate`, `descrip_cate`) VALUES
(1, 'Evaporadores 60 Hz'),
(2, 'Condensadores HCAS 60Hz'),
(3, 'Termostatos y Controladores'),
(4, 'Gases Refrigerantes'),
(5, 'Motores'),
(6, 'Compresores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cod_client` varchar(13) NOT NULL,
  `nombre_client` varchar(50) NOT NULL,
  `apellido_client` varchar(50) NOT NULL,
  `telf_client` varchar(10) NOT NULL,
  `correo_client` varchar(100) NOT NULL,
  `direccion_client` varchar(200) NOT NULL,
  `cod_tipo_client` int(10) DEFAULT NULL,
  `cod_canton` int(10) NOT NULL,
  `estado_client` tinyint(1) NOT NULL,
  `fecha_registro_client` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cod_client`, `nombre_client`, `apellido_client`, `telf_client`, `correo_client`, `direccion_client`, `cod_tipo_client`, `cod_canton`, `estado_client`, `fecha_registro_client`) VALUES
('0112233490', 'Patricio', 'Espinoza', '0998088990', 'patricio.espinoza@example.com', 'AV. SOLANO Y REMIGIO CRESPO', NULL, 3, 1, '2025-04-13 09:57:51'),
('0165566778', 'Ricardo', 'Salazar', '0997890123', 'ricardo.salazar@example.com', 'AV. REMIGIO PABÓN, SECTOR EL VADO', NULL, 3, 0, '2025-06-25 09:39:12'),
('0724455612', 'Gustavo', 'Campoverde', '0991111222', 'gustavo.campoverde@example.com', 'AV. ROCAFUERTE, CENTRO', NULL, 51, 1, '2025-04-17 14:29:18'),
('0911122233', 'Gabriela', 'Morales', '0997778899', 'gabriela.morales@example.com', 'CALLE 7 N32-45, CENTRO', NULL, 81, 1, '2025-04-20 12:41:56'),
('0912345678', 'Ana', 'Torres', '0993334455', 'ana.torres@example.com', 'CALLE PRINCIPAL MZ. B, VILLA AZUL', NULL, 96, 0, '2025-07-03 14:27:45'),
('0913475331', 'Angelica', 'Salazar', '0914567845', 'angsala@gmail.com', 'LOS ESTEROS', NULL, 85, 1, '2025-04-01 09:14:27'),
('0917743258', 'Andrés', 'Villacís', '0991122789', 'andres.villacis@example.com', 'FLOR DE BASTIÓN BLOQUE 9', NULL, 1, 1, '2025-09-10 12:45:27'),
('0920901256', 'Miguel', 'Villalba', '0996066778', 'miguel.villalba@example.com', 'URB. BELLAVISTA', NULL, 81, 1, '2025-04-23 09:19:44'),
('0921012367', 'Diana', 'Maldonado', '0996677556', 'diana.maldonado@example.com', 'URB. CEIBOS NORTE, VIA A LA COSTA', NULL, 85, 1, '2025-04-28 13:55:12'),
('0922123478', 'Roberto', 'Zambrano', '0997788667', 'roberto.zambrano@example.com', 'LA FLORIDA, CALLE 18', NULL, 85, 1, '2025-05-02 16:07:38'),
('0922233344', 'Manuel', 'Paredes', '0999990011', 'manuel.paredes@example.com', 'URB. SANTA ANA, SECTOR COSTANERA', NULL, 85, 1, '2025-04-07 10:51:28'),
('0923234589', 'Verónica', 'Almeida', '0998899778', 'veronica.almeida@example.com', 'LOS ESTEROS, AV. PRINCIPAL', NULL, 85, 1, '2025-05-05 10:18:21'),
('0923344556', 'David', 'Martínez', '0995678901', 'david.martinez@example.com', 'VIA A MILAGRO, SECTOR LA CRUZ', NULL, 88, 1, '2025-05-08 11:49:57'),
('0923456789', 'Carlos', 'Mendoza', '0997654321', 'carlos.mendoza@example.com', 'GUASMO SUR MZ. 3 V. 4', NULL, 85, 1, '2025-05-12 15:36:04'),
('0924345690', 'Héctor', 'Aguilar', '0999900889', 'hector.aguilar@example.com', 'SAUCES 9, CALLE 3', NULL, 85, 1, '2025-05-15 09:44:39'),
('0925456701', 'Mónica', 'Loor', '0991011223', 'monica.loor@example.com', 'BARRIO LETAMENDI, MZ. 15', NULL, 85, 1, '2025-06-15 12:57:38'),
('0925566723', 'Camila', 'Moreno', '0992122333', 'camila.moreno@example.com', 'URB. LA JOYA, VIA SAMBORONDÓN', NULL, 96, 1, '2025-05-19 13:58:27'),
('0925567812', 'Daniel', 'Carvajal', '0991122001', 'daniel.carvajal@example.com', 'COOP. FLOR DE BASTIÓN BLOQUE 5', NULL, 85, 1, '2025-05-23 11:12:54'),
('0926567812', 'Juan', 'Paredes', '0992022334', 'juan.paredes@example.com', 'URB. PUERTO AZUL, VIA A LA COSTA', NULL, 85, 1, '2025-05-27 14:25:33'),
('0926677889', 'Lucía', 'Fernández', '0998901234', 'lucia.fernandez@example.com', 'URB. LAS MALVINAS, PROX. AL MALL', NULL, 85, 1, '2025-05-27 15:17:12'),
('0926678923', 'Paula', 'Ríos', '0992233112', 'paula.rios@example.com', 'GUASMO SUR MZ. 12 V. 6', NULL, 85, 1, '2025-05-27 16:44:23'),
('0927678923', 'Carla', 'Suárez', '0993033445', 'carla.suarez@example.com', 'URB. LOS CEIBOS, CALLE 6', NULL, 85, 1, '2025-05-31 09:15:30'),
('0927789034', 'Francisco', 'Narváez', '0993344223', 'francisco.narvaez@example.com', 'MAPASINGUE ESTE MZ.10 V.9', NULL, 85, 1, '2025-05-31 14:40:05'),
('0928298520', 'Sebastian', 'Loor', '0959140703', 'arielloor.22@hotmail.com', 'FLORESTA 2 MZ. 135 V. 6', NULL, 85, 1, '2025-04-03 15:45:06'),
('0928789034', 'Jorge', 'Andrade', '0994044556', 'jorge.andrade@example.com', 'URB. VILLA CLUB ', NULL, 85, 1, '2025-05-31 16:00:59'),
('0928890145', 'Leonardo', 'Alarcon', '0994455334', 'Leoalarcon_2001@example.com', 'BARRIO GARAY MZ. 8 V.7', NULL, 85, 1, '2025-06-03 10:18:45'),
('0929890145', 'Emiliano', 'Bravo', '0995055667', 'emi.bravo96@example.com', 'CDLA. LA NARCISA MZ. 21 V. 3', NULL, 80, 1, '2025-06-03 10:50:10'),
('0929901256', 'Esteban', 'Pino', '0995566445', 'esteban.pino@example.com', 'PRADERA 2, AV. RODRÍGUEZ BONÍN', NULL, 85, 1, '2025-06-03 11:59:02'),
('0943121418', 'Bryan', 'Santillan', '0963262929', 'bryansantilla204@gmail.com', 'NUEVA PERLA', NULL, 85, 1, '2025-06-03 16:30:25'),
('0953549458', 'Jonathan', 'Bailon', '0939082001', 'jonathanjoel077@gmail.com', 'GUASMO SUR', NULL, 85, 1, '2025-06-11 10:05:15'),
('0954321876', 'José', 'Ramírez', '0992223344', 'jose.ramirez@example.com', 'VIA A LA COSTA KM.6, SECTOR LA PROVIDENCIA', NULL, 80, 1, '2025-06-11 14:30:40'),
('0957768120', 'Britany', 'Torres', '0978929484', 'britanytorees@gmail.com', 'PRADERA 3', NULL, 85, 1, '2025-04-06 09:27:44'),
('0967891234', 'Luis', 'González', '0994445566', 'luis.gonzalez@example.com', 'URB. LA FLORESTA, SECTOR SAN JOSÉ', NULL, 88, 1, '2025-06-14 09:08:20'),
('0976543210', 'Pedro', 'Lima', '0996667788', 'pedro.lima@example.com', 'URB. LOS ALAMOS,  GUASMO SUR', NULL, 85, 1, '2025-06-18 13:44:29'),
('0980012345001', 'Importadora', 'Pacífico', '042567890', 'importadora.pacifico@example.com', 'PARQUE INDUSTRIAL, SAMBORONDÓN', 2, 96, 1, '2025-06-22 11:40:25'),
('0987746356', 'Agustin', 'Maldonado', '0987654432', 'agus12maldonado@example.com', 'GUASMO SUR, COOP. NUEVA ESPERANZA', NULL, 1, 1, '2025-09-10 09:42:15'),
('0991234567', 'Sofía', 'Vera', '0995556677', 'sofia.vera@example.com', 'MANGLARALTA MZ. F V.12, SECTOR LA BOCA', NULL, 85, 1, '2025-07-10 09:25:05'),
('0994455667', 'Paola', 'Reyes', '0996789012', 'paola.reyes@example.com', 'CALLE 15 Y LAHOYA, BARRIO SAN MARTÍN', NULL, 85, 1, '2025-07-10 10:21:18'),
('0994455667001', 'Constructora', 'Sur', '045678901', 'constructora.sur@example.com', 'URB. ALBORADA SUR, MANZANA 7', 2, 85, 1, '2025-07-14 12:48:09'),
('0998765432', 'María', 'Lopez', '0991112233', 'maria.lopez@example.com', 'AV. 25 DE JULIO N45-12', NULL, 85, 1, '2025-07-29 13:42:06'),
('0999988776', 'Andrea', 'Herrera', '0998889900', 'andrea.herrera@example.com', 'URBANIZACION EL RIO', NULL, 96, 1, '2025-08-09 12:17:42'),
('1113475331001', 'Pedro', 'Menendez', '0948756134', 'pmendenz@gmail.com', 'SANTA LUCIA', 1, 100, 1, '2025-08-16 09:34:55'),
('1423344501', 'Andrey', 'Cedeño', '0999099001', 'ancede657@example.com', 'AV. 4 DE NOVIEMBRE, TARQUI', NULL, 144, 1, '2025-08-27 15:46:43'),
('1481122334', 'Elena', 'Cedeño', '0991234123', 'elena.cedeno@example.com', 'CALLE 8 Y AV. 1, SECTOR EL MIRADOR', NULL, 144, 1, '2025-08-27 16:40:25'),
('1790012345001', 'Comercial', 'Andes', '042345678', 'comercial.andes@example.com', 'AV. MALDONADO N32-45, BARRIO INDUSTRIAL', 2, 85, 1, '2025-09-02 13:39:12'),
('1798765432001', 'Servicios', 'Ecuador', '044556677', 'servicios.ecuador@example.com', 'EDIF. GUBERNAMENTAL, AV. 9 DE OCTUBRE', 3, 85, 1, '2025-09-04 16:21:26'),
('1911122389', 'Lorena', 'Cruz', '0997077889', 'lorena.cruz@example.com', 'AV. COLÓN Y 6 DE DICIEMBRE', NULL, 183, 1, '2025-09-05 11:07:44'),
('1912345678001', 'Transporte', 'Nacional', '022334455', 'transporte.nacional@example.com', 'KM 12 VIA A PIFO, BODEGA CENTRAL', 2, 183, 1, '2025-09-05 13:50:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `cod_detalle` int(10) NOT NULL,
  `cant_detalle` int(10) NOT NULL,
  `total_detalle` double(10,2) NOT NULL,
  `fecha_detalle` datetime DEFAULT current_timestamp(),
  `cod_product` int(10) NOT NULL,
  `cod_fact` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`cod_detalle`, `cant_detalle`, `total_detalle`, `fecha_detalle`, `cod_product`, `cod_fact`) VALUES
(1, 5, 11.50, '2025-04-01 09:14:27', 4, 1),
(2, 5, 46.00, '2025-04-01 09:14:27', 5, 1),
(3, 2, 98.90, '2025-04-02 10:32:41', 3, 2),
(4, 3, 27.60, '2025-04-02 10:32:41', 5, 2),
(5, 2, 98.90, '2025-04-03 15:45:06', 3, 3),
(6, 4, 9.20, '2025-04-03 15:45:06', 4, 3),
(7, 1, 9.20, '2025-04-04 11:18:59', 5, 4),
(8, 1, 9.20, '2025-09-03 14:05:33', 5, 6),
(9, 1, 49.45, '2025-09-03 14:05:33', 3, 6),
(10, 1, 49.45, '2025-04-08 13:39:21', 3, 7),
(11, 1, 11.95, '2025-05-01 12:14:02', 29, 8),
(12, 2, 51.75, '2025-05-01 12:14:02', 10, 8),
(13, 1, 46.40, '2025-05-01 12:14:02', 38, 8),
(14, 2, 103.48, '2025-04-01 09:50:26', 26, 9),
(15, 1, 175.95, '2025-04-01 09:50:26', 39, 9),
(16, 4, 44.49, '2025-04-17 14:29:18', 30, 10),
(17, 2, 21.33, '2025-04-17 14:29:18', 31, 10),
(18, 2, 351.90, '2025-04-20 12:41:56', 39, 11),
(19, 3, 77.62, '2025-04-20 12:41:56', 10, 11),
(20, 3, 81.42, '2025-04-20 12:41:56', 11, 11),
(21, 1, 184.00, '2025-05-07 10:45:22', 42, 12),
(22, 5, 232.82, '2025-05-07 10:45:22', 28, 12),
(23, 4, 103.50, '2025-05-15 11:27:54', 10, 13),
(24, 4, 207.69, '2025-05-15 11:27:54', 3, 13),
(25, 2, 83.49, '2025-05-15 11:27:54', 18, 13),
(26, 1, 25.88, '2025-04-18 12:38:26', 10, 14),
(27, 1, 93.09, '2025-04-18 12:38:26', 5, 14),
(28, 1, 25.99, '2025-04-18 12:38:26', 13, 14),
(29, 2, 351.90, '2025-05-05 10:18:21', 39, 15),
(30, 10, 167.67, '2025-05-05 10:18:21', 16, 15),
(31, 3, 86.22, '2025-05-05 10:18:21', 19, 15),
(32, 3, 92.98, '2025-05-08 11:49:57', 15, 16),
(33, 2, 276.00, '2025-05-12 15:36:04', 32, 17),
(34, 3, 381.57, '2025-05-12 15:36:04', 33, 17),
(35, 3, 77.62, '2025-05-15 09:44:39', 10, 18),
(36, 1, 21.27, '2025-05-15 09:44:39', 21, 18),
(37, 1, 80.50, '2025-05-19 13:58:27', 37, 19),
(38, 1, 104.19, '2025-05-19 13:58:27', 36, 19),
(39, 1, 104.25, '2025-05-19 13:58:27', 34, 19),
(40, 5, 208.72, '2025-05-23 11:12:54', 18, 20),
(41, 5, 259.61, '2025-05-23 11:12:54', 3, 20),
(42, 2, 42.55, '2025-05-23 11:12:54', 21, 20),
(43, 5, 431.19, '2025-05-27 14:25:33', 4, 21),
(44, 2, 103.84, '2025-05-27 14:25:33', 3, 21),
(45, 3, 77.62, '2025-05-27 14:25:33', 10, 22),
(46, 1, 27.14, '2025-05-27 14:25:33', 11, 22),
(47, 2, 92.81, '2025-05-27 16:44:23', 38, 23),
(48, 3, 125.23, '2025-05-31 09:15:30', 18, 24),
(49, 1, 29.55, '2025-05-31 09:15:30', 22, 24),
(50, 4, 71.76, '2025-05-31 14:40:05', 17, 25),
(51, 1, 124.55, '2025-05-31 16:00:59', 41, 26),
(52, 1, 175.95, '2025-06-03 10:18:45', 39, 27),
(53, 5, 142.03, '2025-06-03 10:50:10', 12, 28),
(54, 3, 137.31, '2025-06-03 11:59:02', 25, 29),
(55, 3, 155.77, '2025-06-03 11:59:02', 3, 29),
(56, 5, 232.82, '2025-06-03 11:59:02', 28, 29),
(57, 3, 552.00, '2025-06-03 16:30:25', 42, 30),
(58, 1, 11.12, '2025-06-03 16:30:25', 30, 30),
(59, 1, 102.68, '2025-06-11 10:05:15', 6, 31),
(60, 2, 249.09, '2025-06-11 14:30:40', 41, 32),
(61, 1, 104.19, '2025-06-14 09:08:20', 36, 33),
(62, 4, 91.08, '2025-06-18 13:44:29', 14, 34),
(63, 1, 16.77, '2025-06-18 13:44:29', 16, 34),
(64, 2, 51.75, '2025-06-18 13:44:29', 10, 34),
(65, 2, 23.90, '2025-06-18 13:44:29', 29, 34),
(66, 3, 527.85, '2025-06-22 11:40:25', 39, 35),
(67, 3, 414.00, '2025-06-22 11:40:25', 40, 35),
(68, 2, 249.09, '2025-06-22 11:40:25', 41, 35),
(69, 5, 232.82, '2025-06-22 11:40:25', 28, 35),
(70, 2, 23.90, '2025-06-22 11:40:25', 29, 35),
(71, 2, 96.60, '2025-06-22 16:32:41', 3, 36),
(72, 1, 48.30, '2025-06-22 16:59:15', 3, 37),
(73, 3, 85.22, '2025-06-25 09:39:12', 12, 38),
(74, 1, 25.99, '2025-06-25 09:39:12', 13, 38),
(75, 1, 22.77, '2025-06-25 09:39:12', 14, 38),
(76, 1, 60.02, '2025-07-03 14:27:45', 27, 39),
(77, 3, 32.00, '2025-07-10 09:25:05', 31, 40),
(78, 2, 23.90, '2025-07-10 10:21:18', 29, 41),
(79, 3, 527.85, '2025-07-14 12:48:09', 39, 42),
(80, 5, 513.42, '2025-07-14 12:48:09', 6, 42),
(81, 3, 116.61, '2025-07-14 12:48:09', 9, 42),
(82, 10, 862.38, '2025-07-14 12:48:09', 4, 42),
(83, 2, 276.00, '2025-07-29 13:42:06', 32, 43),
(84, 3, 312.57, '2025-07-29 13:42:06', 35, 43),
(85, 1, 104.25, '2025-07-29 13:42:06', 34, 43),
(86, 2, 22.24, '2025-08-09 12:17:42', 30, 44),
(87, 2, 83.49, '2025-08-16 09:34:55', 18, 45),
(88, 2, 57.48, '2025-08-16 09:34:55', 19, 45),
(89, 2, 39.79, '2025-08-27 15:46:43', 24, 46),
(90, 1, 45.77, '2025-08-27 15:46:43', 25, 46),
(91, 1, 29.55, '2025-08-27 15:46:43', 22, 46),
(92, 1, 25.88, '2025-08-27 16:40:25', 10, 47),
(93, 6, 177.33, '2025-09-02 13:39:12', 23, 48),
(94, 6, 119.37, '2025-09-02 13:39:12', 24, 48),
(95, 1, 124.55, '2025-09-02 13:39:12', 41, 48),
(96, 3, 527.85, '2025-09-04 16:21:26', 39, 49),
(97, 3, 552.00, '2025-09-04 16:21:26', 42, 49),
(98, 3, 414.00, '2025-09-04 16:21:26', 32, 49),
(99, 3, 381.57, '2025-09-04 16:21:26', 33, 49),
(100, 4, 67.07, '2025-09-05 11:07:44', 16, 50),
(101, 10, 258.75, '2025-09-05 13:50:00', 10, 51),
(102, 10, 259.90, '2025-09-05 13:50:00', 13, 51),
(103, 1, 46.56, '2025-09-05 13:50:00', 28, 51),
(104, 1, 28.74, '2025-09-07 11:20:30', 19, 52),
(105, 4, 372.37, '2025-09-07 11:20:30', 5, 52),
(106, 2, 120.04, '2025-09-07 11:20:30', 27, 52),
(107, 2, 51.75, '2025-09-07 15:58:37', 10, 53),
(108, 4, 152.72, '2025-09-07 15:58:37', 20, 53),
(109, 10, 167.67, '2025-09-07 15:58:37', 16, 53),
(110, 3, 279.28, '2025-09-07 15:58:37', 5, 53),
(111, 3, 312.57, '2025-09-10 16:28:49', 36, 54),
(112, 1, 104.19, '2025-09-10 16:28:49', 35, 54),
(113, 5, 142.03, '2025-09-10 17:15:21', 12, 55),
(114, 1, 124.55, '2025-09-10 17:15:45', 41, 56);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura_temp`
--

CREATE TABLE `detalle_factura_temp` (
  `cod_detalle` int(10) NOT NULL,
  `cant_detalle` int(10) NOT NULL,
  `total_detalle` decimal(10,2) NOT NULL,
  `fecha_detalle` datetime DEFAULT current_timestamp(),
  `cod_product` int(10) NOT NULL,
  `cod_fact` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_factura_temp`
--

INSERT INTO `detalle_factura_temp` (`cod_detalle`, `cant_detalle`, `total_detalle`, `fecha_detalle`, `cod_product`, `cod_fact`) VALUES
(1, 2, 172.48, '2025-04-01 09:14:27', 4, 1),
(2, 1, 9.20, '2025-04-01 09:14:27', 5, 1),
(3, 2, 98.90, '2025-04-02 10:32:41', 3, 2),
(4, 2, 18.40, '2025-04-02 10:32:41', 5, 2),
(5, 2, 98.90, '2025-04-03 15:45:06', 3, 3),
(6, 4, 9.20, '2025-04-03 15:45:06', 4, 3),
(7, 1, 9.20, '2025-04-04 11:18:59', 5, 4),
(8, 1, 9.20, '2025-04-04 09:57:51', 5, 6),
(9, 1, 49.45, '2025-04-04 09:57:51', 3, 6),
(10, 1, 49.45, '2025-04-08 13:39:21', 3, 7),
(11, 1, 11.95, '2025-04-10 14:58:37', 29, 8),
(12, 2, 51.75, '2025-04-10 14:58:37', 10, 8),
(13, 1, 46.40, '2025-04-10 14:58:37', 38, 8),
(14, 2, 103.48, '2025-04-13 09:57:51', 26, 9),
(15, 1, 175.95, '2025-04-13 09:57:51', 39, 9),
(16, 4, 44.49, '2025-04-17 14:29:18', 30, 10),
(17, 2, 21.33, '2025-04-17 14:29:18', 31, 10),
(18, 2, 351.90, '2025-04-20 12:41:56', 39, 11),
(19, 3, 77.63, '2025-04-20 12:41:56', 10, 11),
(20, 3, 81.42, '2025-04-20 12:41:56', 11, 11),
(21, 1, 184.00, '2025-04-23 09:19:44', 42, 12),
(22, 5, 232.82, '2025-04-23 09:19:44', 28, 12),
(23, 4, 103.50, '2025-04-28 13:55:12', 10, 13),
(24, 4, 207.69, '2025-04-28 13:55:12', 3, 13),
(25, 2, 83.49, '2025-04-28 13:55:12', 18, 13),
(26, 1, 25.88, '2025-05-02 16:07:38', 10, 14),
(27, 1, 93.09, '2025-05-02 16:07:38', 5, 14),
(28, 1, 25.99, '2025-05-02 16:07:38', 13, 14),
(29, 2, 351.90, '2025-05-05 10:18:21', 39, 15),
(30, 10, 167.67, '2025-05-05 10:18:21', 16, 15),
(31, 3, 86.22, '2025-05-05 10:18:21', 19, 15),
(32, 3, 92.98, '2025-05-08 11:49:57', 15, 16),
(33, 2, 276.00, '2025-05-12 15:36:04', 32, 17),
(34, 3, 381.57, '2025-05-12 15:36:04', 33, 17),
(35, 3, 77.63, '2025-05-15 09:44:39', 10, 18),
(36, 1, 21.28, '2025-05-15 09:44:39', 21, 18),
(37, 1, 80.50, '2025-05-15 09:44:39', 37, 19),
(38, 1, 104.19, '2025-05-19 13:58:27', 36, 19),
(39, 1, 104.25, '2025-05-19 13:58:27', 34, 19),
(40, 4, 166.98, '2025-05-23 11:12:54', 18, 20),
(41, 5, 259.61, '2025-05-23 11:12:54', 3, 20),
(42, 1, 21.28, '2025-05-23 11:12:54', 21, 20),
(43, 5, 431.19, '2025-05-27 14:25:33', 4, 21),
(44, 2, 103.85, '2025-05-27 14:25:33', 3, 21),
(45, 2, 51.75, '2025-05-27 15:17:12', 10, 22),
(46, 0, 0.00, '2025-05-27 15:17:12', 11, 22),
(47, 2, 92.81, '2025-05-27 16:44:23', 38, 23),
(48, 3, 125.24, '2025-05-31 09:15:30', 18, 24),
(49, 1, 29.56, '2025-05-31 09:15:30', 22, 24),
(50, 4, 71.76, '2025-05-31 14:40:05', 17, 25),
(51, 1, 124.55, '2025-05-31 16:00:59', 41, 26),
(52, 1, 175.95, '2025-06-03 10:18:45', 39, 27),
(53, 5, 142.03, '2025-06-03 10:50:10', 12, 28),
(54, 3, 137.31, '2025-06-03 11:59:02', 25, 29),
(55, 3, 155.77, '2025-06-03 11:59:02', 3, 29),
(56, 5, 232.82, '2025-06-03 11:59:02', 28, 29),
(57, 3, 552.00, '2025-06-03 16:30:25', 42, 30),
(58, 1, 11.12, '2025-06-03 16:30:25', 30, 30),
(59, 0, 0.00, '2025-06-11 10:05:15', 6, 31),
(60, 1, 124.55, '2025-06-11 14:30:40', 41, 32),
(61, 1, 104.19, '2025-06-14 09:08:20', 36, 33),
(62, 4, 91.08, '2025-06-18 13:44:29', 14, 34),
(63, 1, 16.77, '2025-06-18 13:44:29', 16, 34),
(64, 2, 51.75, '2025-06-18 13:44:29', 10, 34),
(65, 2, 23.90, '2025-06-18 13:44:29', 29, 34),
(66, 3, 527.85, '2025-06-22 11:40:25', 39, 35),
(67, 3, 414.00, '2025-06-22 11:40:25', 40, 35),
(68, 2, 249.09, '2025-06-22 11:40:25', 41, 35),
(69, 5, 232.82, '2025-06-22 11:40:25', 28, 35),
(70, 2, 23.90, '2025-06-22 11:40:25', 29, 35),
(71, 2, 96.60, '2025-06-22 16:32:41', 3, 36),
(72, 1, 48.30, '2025-06-22 16:59:15', 3, 37),
(73, 3, 85.22, '2025-06-25 09:39:12', 12, 38),
(74, 1, 25.99, '2025-06-25 09:39:12', 13, 38),
(75, 1, 22.77, '2025-06-25 09:39:12', 14, 38),
(76, 0, 0.00, '2025-07-03 14:27:45', 27, 39),
(77, 3, 32.00, '2025-07-10 09:25:05', 31, 40),
(78, 2, 23.90, '2025-07-10 10:21:18', 29, 41),
(79, 3, 527.85, '2025-07-14 12:48:09', 39, 42),
(80, 5, 513.42, '2025-07-14 12:48:09', 6, 42),
(81, 3, 116.61, '2025-07-14 12:48:09', 9, 42),
(82, 10, 862.39, '2025-07-14 12:48:09', 4, 42),
(83, 2, 276.00, '2025-07-29 13:42:06', 32, 43),
(84, 3, 312.57, '2025-07-29 13:42:06', 35, 43),
(85, 1, 104.25, '2025-07-29 13:42:06', 34, 43),
(86, 1, 11.12, '2025-08-09 12:17:42', 30, 44),
(87, 1, 41.75, '2025-08-16 09:34:55', 18, 45),
(88, 2, 57.48, '2025-08-16 09:34:55', 19, 45),
(89, 2, 39.79, '2025-08-27 15:46:43', 24, 46),
(90, 1, 45.77, '2025-08-27 15:46:43', 25, 46),
(91, 1, 29.56, '2025-08-27 15:46:43', 22, 46),
(92, 1, 25.88, '2025-08-27 16:40:25', 10, 47),
(93, 6, 177.33, '2025-09-02 13:39:12', 23, 48),
(94, 6, 119.37, '2025-09-02 13:39:12', 24, 48),
(95, 1, 124.55, '2025-09-02 13:39:12', 41, 48),
(96, 3, 527.85, '2025-09-04 16:21:26', 39, 49),
(97, 2, 368.00, '2025-09-04 16:21:26', 42, 49),
(98, 1, 138.00, '2025-09-04 16:21:26', 32, 49),
(99, 3, 381.57, '2025-09-04 16:21:26', 33, 49),
(100, 4, 67.07, '2025-09-05 11:07:44', 16, 50),
(101, 10, 258.75, '2025-09-05 13:50:00', 10, 51),
(102, 10, 259.90, '2025-09-05 13:50:00', 13, 51),
(103, 1, 46.56, '2025-09-05 13:50:00', 28, 51),
(104, 1, 28.74, '2025-09-07 11:20:30', 19, 52),
(105, 4, 372.37, '2025-09-07 11:20:30', 5, 52),
(106, 2, 120.04, '2025-09-07 11:20:30', 27, 52),
(107, 2, 51.75, '2025-09-07 15:58:37', 10, 53),
(108, 4, 152.72, '2025-09-07 15:58:37', 20, 53),
(109, 10, 167.67, '2025-09-07 15:58:37', 16, 53),
(110, 3, 279.28, '2025-09-07 15:58:37', 5, 53),
(111, 3, 312.57, '2025-09-07 16:15:50', 36, 54),
(112, 1, 104.19, '2025-09-07 16:15:50', 35, 54),
(113, 5, 142.03, '2025-09-10 17:15:21', 12, 55),
(114, 1, 124.55, '2025-09-10 17:15:45', 41, 56);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devolucion`
--

CREATE TABLE `devolucion` (
  `cod_devo` int(10) NOT NULL,
  `motivo_devo` varchar(300) DEFAULT NULL,
  `fecha_devo` datetime NOT NULL DEFAULT current_timestamp(),
  `cant_devo` int(10) NOT NULL,
  `total_devo` decimal(10,2) NOT NULL,
  `cod_detalle` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `devolucion`
--

INSERT INTO `devolucion` (`cod_devo`, `motivo_devo`, `fecha_devo`, `cant_devo`, `total_devo`, `cod_detalle`) VALUES
(1, '', '2025-04-04 11:32:41', 1, 2.30, 1),
(2, '', '2025-04-08 12:14:16', 1, 9.20, 2),
(3, '', '2025-04-04 11:32:41', 1, 2.30, 1),
(4, '', '2025-04-08 12:14:16', 1, 9.20, 2),
(5, 'Producto en mal estado', '2025-04-08 12:14:16', 2, 18.40, 2),
(6, '', '2025-04-11 16:45:23', 1, 9.20, 4),
(7, 'Producto en mal estado o defectuoso', '2025-04-04 11:32:41', 1, 86.24, 1),
(8, 'producto mal estado', '2025-08-20 13:40:31', 1, 41.75, 87),
(9, '', '2025-08-15 15:13:32', 1, 11.12, 86),
(10, '', '2025-09-10 17:31:01', 1, 184.00, 97),
(11, '', '2025-09-10 17:31:01', 2, 276.00, 98),
(12, 'Gas poco efectivo', '2025-07-05 09:17:28', 1, 60.02, 76),
(13, '', '2025-06-14 12:23:22', 1, 102.68, 59),
(14, '', '2025-06-16 16:26:11', 1, 124.55, 60),
(15, '', '2025-05-26 11:39:22', 1, 41.75, 40),
(16, '', '2025-05-28 11:26:47', 1, 21.28, 42),
(17, '', '2025-05-29 09:35:16', 1, 25.88, 45),
(18, '', '2025-05-29 10:32:17', 1, 27.14, 46);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `cod_fact` int(10) NOT NULL,
  `fecha_fact` datetime DEFAULT current_timestamp(),
  `total_fact` decimal(10,2) NOT NULL,
  `recibido_fact` decimal(10,2) NOT NULL,
  `vuelto_fact` double(10,2) NOT NULL,
  `cod_client` varchar(13) NOT NULL,
  `cod_vend` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`cod_fact`, `fecha_fact`, `total_fact`, `recibido_fact`, `vuelto_fact`, `cod_client`, `cod_vend`) VALUES
(1, '2025-04-01 09:14:27', 57.50, 57.50, 0.00, '0913475331', '0928298520'),
(2, '2025-04-02 10:32:41', 126.50, 126.50, 0.00, '0913475331', '0928298520'),
(3, '2025-04-03 15:45:06', 108.10, 108.10, 0.00, '0928298520', '0928298520'),
(4, '2025-04-04 11:18:59', 9.20, 9.20, 0.00, '0943121418', '0928298520'),
(6, '2025-04-06 09:27:44', 58.65, 58.65, 0.00, '0957768120', '0928298520'),
(7, '2025-04-08 13:39:21', 49.45, 49.45, 0.00, '1113475331001', '0928298520'),
(8, '2025-04-10 14:58:37', 110.10, 111.00, 0.90, '0923344556', '0950997346'),
(9, '2025-04-13 09:57:51', 279.43, 279.43, 0.00, '0112233490', '0955311444'),
(10, '2025-04-17 14:29:18', 65.81, 65.81, 0.00, '0724455612', '0951296037'),
(11, '2025-04-20 12:41:56', 510.94, 510.94, 0.00, '0911122233', '0950997346'),
(12, '2025-04-23 09:19:44', 416.83, 416.83, 0.00, '0920901256', '0928298520'),
(13, '2025-04-28 13:55:12', 394.68, 394.68, 0.00, '0921012367', '0917448177'),
(14, '2025-05-02 16:07:38', 144.96, 150.00, 5.04, '0922123478', '0913944310'),
(15, '2025-05-05 10:18:21', 605.79, 605.79, 0.00, '0923234589', '0950997346'),
(16, '2025-05-08 11:49:57', 92.98, 100.00, 7.02, '0923344556', '0917448177'),
(17, '2025-05-12 15:36:04', 657.57, 657.57, 0.00, '0923456789', '0955311444'),
(18, '2025-05-15 09:44:39', 98.90, 100.00, 1.10, '0924345690', '0913944310'),
(19, '2025-05-19 13:58:27', 288.94, 288.94, 0.00, '0925566723', '0913944310'),
(20, '2025-05-23 11:12:54', 510.89, 510.89, 0.00, '0925567812', '0928298520'),
(21, '2025-05-27 14:25:33', 535.04, 535.50, 0.46, '0926567812', '0951296037'),
(22, '2025-05-27 15:17:12', 104.76, 105.00, 0.24, '0926677889', '0951296037'),
(23, '2025-05-27 16:44:23', 92.81, 92.81, 0.00, '0926678923', '0951296037'),
(24, '2025-05-31 09:15:30', 154.79, 155.00, 0.21, '0927678923', '0913944310'),
(25, '2025-05-31 14:40:05', 71.76, 71.80, 0.04, '0927789034', '0950997346'),
(26, '2025-05-31 16:00:59', 124.54, 125.00, 0.46, '0928789034', '0955311444'),
(27, '2025-06-03 10:18:45', 175.95, 180.00, 4.05, '0928890145', '0913944310'),
(28, '2025-06-03 10:50:10', 142.03, 150.00, 7.97, '0929890145', '0951296037'),
(29, '2025-06-03 11:59:02', 525.91, 530.00, 4.09, '0929901256', '0928298520'),
(30, '2025-06-03 16:30:25', 563.12, 563.12, 0.00, '0943121418', '0955311444'),
(31, '2025-06-11 10:05:15', 102.68, 105.00, 2.32, '0953549458', '0955311444'),
(32, '2025-06-11 14:30:40', 249.09, 250.00, 0.91, '0954321876', '0913944310'),
(33, '2025-06-14 09:08:20', 104.19, 104.19, 0.00, '0967891234', '0917448177'),
(34, '2025-06-18 13:44:29', 183.49, 185.00, 1.51, '0976543210', '0917448177'),
(35, '2025-06-22 11:40:25', 1447.67, 1447.67, 0.00, '0980012345001', '0950997346'),
(36, '2025-06-22 16:32:41', 96.60, 100.00, 3.40, '0112233490', '0913944310'),
(37, '2025-06-22 16:59:15', 48.30, 48.30, 0.00, '0724455612', '0950997346'),
(38, '2025-06-25 09:39:12', 133.97, 135.00, 1.03, '0165566778', '0913944310'),
(39, '2025-07-03 14:27:45', 60.02, 60.02, 0.00, '0912345678', '0955311444'),
(40, '2025-07-10 09:25:05', 31.99, 31.99, 0.00, '0991234567', '0951296037'),
(41, '2025-07-10 10:21:18', 23.90, 30.00, 6.10, '0994455667', '0951296037'),
(42, '2025-07-14 12:48:09', 2020.26, 2020.26, 0.00, '0994455667001', '0928298520'),
(43, '2025-07-29 13:42:06', 692.82, 700.00, 7.18, '0998765432', '0913944310'),
(44, '2025-08-09 12:17:42', 22.24, 30.00, 7.76, '0999988776', '0951296037'),
(45, '2025-08-16 09:34:55', 140.97, 140.97, 0.00, '1113475331001', '0950997346'),
(46, '2025-08-27 15:46:43', 115.12, 120.00, 4.88, '1423344501', '0950997346'),
(47, '2025-08-27 16:40:25', 25.88, 25.88, 0.00, '1481122334', '0955311444'),
(48, '2025-09-02 13:39:12', 421.25, 425.00, 3.75, '1790012345001', '0917448177'),
(49, '2025-09-04 16:21:26', 1875.42, 1875.42, 0.00, '1798765432001', '0917448177'),
(50, '2025-09-05 11:07:44', 67.07, 67.07, 0.00, '1911122389', '0955311444'),
(51, '2025-09-05 13:50:00', 565.21, 565.21, 0.00, '1912345678001', '0955311444'),
(52, '2025-09-07 11:20:30', 521.15, 530.00, 8.85, '0112233490', '0913944310'),
(53, '2025-09-07 15:58:37', 651.42, 651.42, 0.00, '0920901256', '0917448177'),
(54, '2025-09-07 16:15:50', 416.76, 416.76, 0.00, '0922233344', '0928298520'),
(55, '2025-09-10 17:15:21', 142.03, 143.00, 0.97, '0987746356', '0951296037'),
(56, '2025-09-10 17:15:45', 124.54, 125.00, 0.46, '0917743258', '0955311444');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `cod_product` int(10) NOT NULL,
  `nombre_product` varchar(50) NOT NULL,
  `stock_product` int(10) NOT NULL,
  `precio_product` double(10,2) NOT NULL,
  `descuento_product` int(10) DEFAULT NULL,
  `foto_product` varchar(255) NOT NULL,
  `estado_product` tinyint(1) NOT NULL,
  `cod_cate` int(10) NOT NULL,
  `cod_prove` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`cod_product`, `nombre_product`, `stock_product`, `precio_product`, `descuento_product`, `foto_product`, `estado_product`, `cod_cate`, `cod_prove`) VALUES
(3, 'HEA', 0, 52.50, 20, '../assets/productos/3.png', 1, 1, '0991383573001'),
(4, 'HEB', 79, 74.99, 0, '../assets/productos/4.png', 1, 1, '0991383573001'),
(5, 'HEC', 87, 80.95, 0, '../assets/productos/5.png', 1, 1, '0991383573001'),
(6, 'HED Medium', 25, 93.99, 5, '../assets/productos/6.png', 1, 1, '0991383573001'),
(7, 'HED High', 30, 54.99, 0, '../assets/productos/7.png', 1, 1, '0991383573001'),
(8, 'HEF', 60, 40.00, 6, '../assets/productos/8.png', 1, 1, '0991383573001'),
(9, 'HEJ', 77, 33.80, 0, '../assets/productos/9.png', 1, 1, '0991383573001'),
(10, 'TC-900RG2P slim/01', 20, 22.50, 0, '../assets/productos/10.png', 1, 3, '0991383573001'),
(11, 'TC-900E Power /07', 57, 23.60, 0, '../assets/productos/11.png', 1, 3, '0991383573001'),
(12, 'TIC-17s /09', 42, 24.70, 0, '../assets/productos/12.png', 1, 3, '0991383573001'),
(13, 'CAJA GB01S', 18, 22.60, 0, '../assets/productos/13.png', 1, 3, '0991383573001'),
(14, 'MT-530E super /05', 55, 19.80, 0, '../assets/productos/14.png', 1, 3, '0991383573001'),
(15, 'MT-512E 2HP /13', 37, 26.95, 0, '../assets/productos/15.png', 1, 3, '0991383573001'),
(16, 'TIC-17RGTi', 75, 16.20, 10, '../assets/productos/16.png', 1, 3, '0992646160001'),
(17, 'TO-712F /02', 66, 15.60, 0, '../assets/productos/17.png', 1, 3, '0992646160001'),
(18, 'HCAS 84 ¼ HP', 10, 36.30, 0, '../assets/productos/18.png', 1, 2, '0992646160001'),
(19, 'HCAS 93 ⅓ HP', 14, 24.99, 0, '../assets/productos/19.png', 1, 2, '0992646160001'),
(20, 'HCAS 94 ⅜ HP', 26, 33.20, 0, '../assets/productos/20.png', 1, 2, '0992646160001'),
(21, 'HCAS 114 ½ HP', 18, 18.50, 0, '../assets/productos/21.png', 1, 2, '0992646160001'),
(22, 'HCAS 143 ⅝ HP', 48, 25.70, 0, '../assets/productos/22.png', 1, 2, '0992516666001'),
(23, 'HCAS 143 ⅝ HP', 44, 25.70, 0, '../assets/productos/23.png', 1, 2, '0992646160001'),
(24, 'HCAS 145 ¾ HP', 32, 17.30, 0, '../assets/productos/24.png', 1, 2, '0992646160001'),
(25, 'HCAS 164A 1HP', 21, 39.80, 0, '../assets/productos/25.png', 1, 2, '0992646160001'),
(26, 'GAS R22 13.6KG', 18, 49.99, 10, '../assets/productos/26.png', 1, 4, '0991383573001'),
(27, 'GAS R134A 13.6KG BESTCOOL', 23, 57.99, 10, '../assets/productos/27.png', 1, 4, '0991383573001'),
(28, 'GAS R404A 10.9KG BESTCOOL', 14, 44.99, 10, '../assets/productos/28.png', 1, 4, '0991383573001'),
(29, 'GAS R134A 340G POTE', 13, 12.99, 20, '../assets/productos/29.png', 1, 4, '0992516666001'),
(30, 'GAS R134A 1KG POTE GENETRON', 14, 10.99, 12, '../assets/productos/30.png', 1, 4, '0992516666001'),
(31, 'GAS R134A 1KG POTE ARKOOL', 20, 13.25, 30, '../assets/productos/31.png', 1, 4, '0992516666001'),
(32, 'MOTOR VENTILADOR EVAPORADOR 13 US MOTORS 1972', 15, 120.00, 0, '../assets/productos/32.png', 1, 5, '0992646160001'),
(33, 'MOTOR VENTILADOR EVAPORADOR 34 GENTEQ 6207E', 14, 110.60, 0, '../assets/productos/33.png', 1, 5, '0992646160001'),
(34, 'MOTOR VENTILADOR EVAPORADOR 16 110V QE QMD-165601', 23, 90.65, 0, '../assets/productos/34.png', 1, 5, '0992646160001'),
(35, 'MOTOR VENTILADOR EVAPORADOR 110 EMINENT PM4115165', 21, 90.60, 0, '../assets/productos/35.png', 1, 5, '0992646160001'),
(36, 'MOTOR VENTILADOR EVAPORADOR 13 TGM FME13-2D', 25, 90.60, 0, '../assets/productos/36.png', 1, 5, '0992646160001'),
(37, 'MOTOR VENTILADOR EVAPORADOR 13 SE 3586', 9, 70.00, 0, '../assets/productos/37.png', 1, 5, '0992646160001'),
(38, 'MOTOR VENTILADOR CAMARA 115 FASCO', 17, 40.35, 0, '../assets/productos/38.png', 1, 5, '0992646160001'),
(39, 'ZR94KC-TF5-522', 5, 170.00, 10, '../assets/productos/39.png', 1, 6, '0991383573001'),
(40, 'ZR34K5-PFV-600', 7, 120.00, 0, '../assets/productos/40.png', 1, 6, '0991383573001'),
(41, 'ZR32K5-PFV-600', 14, 108.30, 0, '../assets/productos/41.png', 1, 6, '0991383573001'),
(42, 'ZR21K5-PFV-830 PFV-130', 14, 160.00, 0, '../assets/productos/42.png', 1, 6, '0991383573001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `cod_prove` varchar(20) NOT NULL,
  `nombre_prove` varchar(20) NOT NULL,
  `telf_prove` varchar(10) NOT NULL,
  `correo_prove` varchar(30) NOT NULL,
  `direccion_prove` varchar(50) NOT NULL,
  `logo_prove` varchar(200) DEFAULT NULL,
  `cod_tipo_client` int(10) NOT NULL,
  `estado_prove` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`cod_prove`, `nombre_prove`, `telf_prove`, `correo_prove`, `direccion_prove`, `logo_prove`, `cod_tipo_client`, `estado_prove`) VALUES
('0991383573001', 'FrioRecord S.A.', '0980248010', 'friorec@hotmail.com', 'Av. Quito 1800 y Pedro Pablo Gomez', '../assets/proveedores/0991383573001.png', 2, 1),
('0992516666001', 'Centuriosa', '04-3709590', 'comercial@centuriosa.com', 'Arq. Guillermo Cubillo R. 1171 y Dr. Emilio Romero', '..\\assets\\proveedores\\0992516666001.png', 2, 0),
('0992646160001', 'TecniFrost S.A.', '0939879547', 'info@tecnifrost.com.ec', 'C.C Plaza Proyecto Local 3 - Km 10 1/2 Vía Samboro', '..\\assets\\proveedores\\0992646160001.png', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `cod_prov` int(10) NOT NULL,
  `descrip_prov` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`cod_prov`, `descrip_prov`) VALUES
(1, 'Azuay'),
(2, 'Bolívar'),
(3, 'Cañar'),
(4, 'Carchi'),
(5, 'Chimborazo'),
(6, 'Cotopaxi'),
(7, 'El Oro'),
(8, 'Esmeraldas'),
(9, 'Galápagos'),
(10, 'Guayas'),
(11, 'Imbabura'),
(12, 'Loja'),
(13, 'Los Ríos'),
(14, 'Manabí'),
(15, 'Morona Santiago'),
(16, 'Napo'),
(17, 'Orellana'),
(18, 'Pastaza'),
(19, 'Pichincha'),
(20, 'Santa Elena'),
(21, 'Santo Domingo de los Tsáchilas'),
(22, 'Sucumbíos'),
(23, 'Tungurahua'),
(24, 'Zamora Chinchipe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cliente`
--

CREATE TABLE `tipo_cliente` (
  `cod_tipo_client` int(10) NOT NULL,
  `descrip_tipo_client` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_cliente`
--

INSERT INTO `tipo_cliente` (`cod_tipo_client`, `descrip_tipo_client`) VALUES
(1, 'Personas naturales y extranjeros residentes'),
(2, 'Sociedades privadas y extranjeros no residentes'),
(3, 'Sociedades públicas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `cod_vend` varchar(10) NOT NULL,
  `nombre_vend` varchar(50) NOT NULL,
  `apellido_vend` varchar(50) NOT NULL,
  `telf_vend` varchar(10) NOT NULL,
  `correo_vend` varchar(100) NOT NULL,
  `direccion_vend` varchar(200) NOT NULL,
  `cod_canton` int(10) NOT NULL,
  `estado_vend` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`cod_vend`, `nombre_vend`, `apellido_vend`, `telf_vend`, `correo_vend`, `direccion_vend`, `cod_canton`, `estado_vend`) VALUES
('0913944310', 'Isaac', 'Gómez', '0946836798', 'isaaac1992@hotmail.com', 'CDLA. LA SOPEÑA MZ. 34 V. 23', 85, 1),
('0917448177', 'Mayra', 'Lucas', '0914675824', 'mayra.lucasg@gmail.com', 'LA VALDIVIA BLOQUE 19 PISO 4', 85, 1),
('0928298520', 'Juan', 'Velazquez', '0978929484', 'juanv1234@hotmail.com', 'AV. JORGE VILLEGAS', 123, 1),
('0950997346', 'Justin', 'Arevalo', '0960315247', 'jarevalomontes@hotmail.com', 'SAMANES 2 MZ. 4 V. 10', 85, 1),
('0951296037', 'David', 'Miranda', '0990968964', 'david10@gmail.com', 'CDLA. URBASUR ', 85, 1),
('0955311444', 'Ariana', 'Armijos', '0960512972', 'arimijos@gmail.com', 'DURAN 5TA ETAPA', 81, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `canton`
--
ALTER TABLE `canton`
  ADD PRIMARY KEY (`cod_canton`),
  ADD KEY `cod_prov` (`cod_prov`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cod_cate`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cod_client`),
  ADD KEY `cod_tipo_client` (`cod_tipo_client`,`cod_canton`),
  ADD KEY `cod_canton` (`cod_canton`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`cod_detalle`),
  ADD KEY `cod_product` (`cod_product`),
  ADD KEY `cod_fact` (`cod_fact`);

--
-- Indices de la tabla `detalle_factura_temp`
--
ALTER TABLE `detalle_factura_temp`
  ADD PRIMARY KEY (`cod_detalle`),
  ADD UNIQUE KEY `cod_product` (`cod_product`,`cod_fact`),
  ADD KEY `cod_fact` (`cod_fact`);

--
-- Indices de la tabla `devolucion`
--
ALTER TABLE `devolucion`
  ADD PRIMARY KEY (`cod_devo`),
  ADD KEY `cod_fact` (`cod_detalle`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`cod_fact`),
  ADD KEY `cod_client` (`cod_client`,`cod_vend`),
  ADD KEY `cod_vend` (`cod_vend`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`cod_product`),
  ADD KEY `cod_cate` (`cod_cate`),
  ADD KEY `cod_prove` (`cod_prove`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`cod_prove`),
  ADD KEY `cod_tipo_client` (`cod_tipo_client`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`cod_prov`);

--
-- Indices de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  ADD PRIMARY KEY (`cod_tipo_client`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`cod_vend`),
  ADD KEY `cod_prov` (`cod_canton`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `cod_cate` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `cod_detalle` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `detalle_factura_temp`
--
ALTER TABLE `detalle_factura_temp`
  MODIFY `cod_detalle` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `devolucion`
--
ALTER TABLE `devolucion`
  MODIFY `cod_devo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `cod_fact` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `cod_product` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `canton`
--
ALTER TABLE `canton`
  ADD CONSTRAINT `canton_ibfk_1` FOREIGN KEY (`cod_prov`) REFERENCES `provincia` (`cod_prov`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`cod_tipo_client`) REFERENCES `tipo_cliente` (`cod_tipo_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_ibfk_3` FOREIGN KEY (`cod_canton`) REFERENCES `canton` (`cod_canton`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`cod_fact`) REFERENCES `factura` (`cod_fact`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`cod_product`) REFERENCES `producto` (`cod_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_factura_temp`
--
ALTER TABLE `detalle_factura_temp`
  ADD CONSTRAINT `detalle_factura_temp_ibfk_1` FOREIGN KEY (`cod_fact`) REFERENCES `factura` (`cod_fact`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_factura_temp_ibfk_2` FOREIGN KEY (`cod_product`) REFERENCES `producto` (`cod_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `devolucion`
--
ALTER TABLE `devolucion`
  ADD CONSTRAINT `devolucion_ibfk_1` FOREIGN KEY (`cod_detalle`) REFERENCES `detalle_factura_temp` (`cod_detalle`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`cod_vend`) REFERENCES `vendedor` (`cod_vend`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`cod_client`) REFERENCES `cliente` (`cod_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`cod_prove`) REFERENCES `proveedor` (`cod_prove`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`cod_cate`) REFERENCES `categoria` (`cod_cate`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`cod_tipo_client`) REFERENCES `tipo_cliente` (`cod_tipo_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD CONSTRAINT `vendedor_ibfk_1` FOREIGN KEY (`cod_canton`) REFERENCES `canton` (`cod_canton`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

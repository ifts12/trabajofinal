-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.16 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para upcn
DROP DATABASE IF EXISTS `upcn`;
CREATE DATABASE IF NOT EXISTS `upcn` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `upcn`;

-- Volcando estructura para tabla upcn.asistencia_medica
DROP TABLE IF EXISTS `asistencia_medica`;
CREATE TABLE IF NOT EXISTS `asistencia_medica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `precio` decimal(10,2) NOT NULL,
  `detalle` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla upcn.asistencia_medica: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `asistencia_medica` DISABLE KEYS */;
INSERT INTO `asistencia_medica` (`id`, `precio`, `detalle`) VALUES
	(1, 1500.00, 'Clinica+traslado+medicamentos');
/*!40000 ALTER TABLE `asistencia_medica` ENABLE KEYS */;

-- Volcando estructura para tabla upcn.compra
DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` int(11) NOT NULL,
  `id_adicional` int(11) NOT NULL,
  `id_asistencia_medica` int(11) NOT NULL,
  `id_viaje` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `precio_final` decimal(10,2) NOT NULL,
  `cantidad_invitados` int(11) DEFAULT NULL,
  `cantidad_afiliados` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `compra_adicional` (`id_adicional`),
  KEY `compra_asistencia_medica` (`id_asistencia_medica`),
  KEY `compra_viaje` (`id_viaje`),
  KEY `compra_hotel` (`id_hotel`),
  CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_adicional`) REFERENCES `asistencia_medica` (`id`),
  CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`id_asistencia_medica`) REFERENCES `asistencia_medica` (`id`),
  CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`id_viaje`) REFERENCES `viaje` (`id`),
  CONSTRAINT `compra_ibfk_4` FOREIGN KEY (`id_hotel`) REFERENCES `hotel` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla upcn.compra: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;

-- Volcando estructura para tabla upcn.hotel
DROP TABLE IF EXISTS `hotel`;
CREATE TABLE IF NOT EXISTS `hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_provincia` int(11) NOT NULL,
  `estrellas` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hotel_provincia` (`id_provincia`),
  CONSTRAINT `hotel_ibfk_1` FOREIGN KEY (`id_provincia`) REFERENCES `provincia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla upcn.hotel: ~14 rows (aproximadamente)
/*!40000 ALTER TABLE `hotel` DISABLE KEYS */;
INSERT INTO `hotel` (`id`, `foto`, `nombre`, `id_provincia`, `estrellas`, `precio`, `cantidad`) VALUES
	(1, NULL, 'Hotel Sol Andino', 13, 3, 5577.00, 15),
	(2, NULL, 'Hotel Cordón del Plata', 13, 4, 6176.00, 10),
	(3, NULL, 'Gran Hotel San Luis', 19, 5, 6778.00, 12),
	(4, NULL, 'Hotel El Mirador', 6, 3, 5531.00, 15),
	(5, NULL, 'Hotel Kalton', 6, 4, 6262.00, 15),
	(6, NULL, 'hotel Carmen', 14, 4, 7000.00, 20),
	(7, NULL, 'hotel Turrance', 14, 5, 8000.00, 15),
	(8, NULL, 'Hotel Eco Max', 16, 5, 5000.00, 15),
	(9, NULL, 'Hotel Miglierina', 2, 4, 3000.00, 25),
	(10, NULL, 'Hotel Rivoli', 2, 5, 4000.00, 15),
	(11, NULL, 'Provincial Plaza Hotel', 17, 4, 4700.00, 10),
	(12, NULL, 'Wilson Hotel', 17, 3, 2500.00, 11),
	(13, NULL, 'Hotel Ushuaia', 23, 3, 3500.00, 12),
	(14, NULL, 'Hotel las Leñas', 23, 4, 5000.00, 12);
/*!40000 ALTER TABLE `hotel` ENABLE KEYS */;

-- Volcando estructura para tabla upcn.perfil
DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `dni` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefono` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_provincia` int(11) NOT NULL,
  `fecha_nac` date NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`dni`),
  KEY `afiliado_rol` (`id_rol`),
  KEY `afiliado_provincia` (`id_provincia`),
  CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`),
  CONSTRAINT `perfil_ibfk_2` FOREIGN KEY (`id_provincia`) REFERENCES `provincia` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla upcn.perfil: ~20 rows (aproximadamente)
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` (`dni`, `nombre`, `apellido`, `pass`, `foto`, `telefono`, `direccion`, `id_provincia`, `fecha_nac`, `email`, `id_rol`) VALUES
	(7939954, 'Eduardo', 'Sundblad', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '4318-3404', 'Roca 710', 2, '1961-10-17', 'e.sundabland@gmail.com', 3),
	(8550842, 'Jose ', 'Alcorta', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '4257-5872', 'Roca 710', 2, '1979-08-07', 'j.alcorta@hotmail.com', 3),
	(17889219, 'Gabriela', 'Caino', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '5781-5872', 'Av.Belgrano 448', 2, '1989-11-07', 'g.caino@gmail.com', 2),
	(21362151, 'Luisa', 'Gamboa', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, ' 4317-2000', 'Av.Belgrano 448', 2, '1980-04-12', 'g.caino@gmail.com', 2),
	(22333444, 'Tony', 'DL', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '4318-3404', 'Roca 710', 2, '1961-10-17', 'tonydl@gmail.com', 1),
	(22976274, 'Lorena', 'Olivera', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '4528-2875', 'Av.Belgrano 448', 2, '1989-01-05', 'L.olivera@hotmail.com', 2),
	(23140162, 'Silvia', 'Freire', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '4582-2747', 'Av.Belgrano 485', 2, '1985-05-03', 's.freire@hotmail.com', 3),
	(27771259, 'Claudia', 'Avalos', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '5452-2488', 'Av.Belgrano 448', 2, '1995-02-13', 'c.avalos@gmail.com', 3),
	(28379836, 'Maria', 'Torres', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '4318-3404', 'Roca 710', 2, '1982-09-01', 'm.torres@hotmail.com', 3),
	(30191893, 'Florencia', 'Sanchez', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '4257-8792', 'Av.Belgrano 448', 2, '1990-10-06', 'f.sanchez@hotmail.com', 3),
	(30913912, 'Ana', 'Mazzeo', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '4258-8512', 'Av.Belgrano 448', 2, '1990-04-01', 'a.mazzeo@hotmail.com', 3),
	(31609032, 'Analia', 'Blanco', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '4825-2577', 'Av.Belgrano 448', 2, '1999-09-20', 'a.blanco@hotmail.com', 3),
	(32545825, 'Claudia', 'Gonzalez', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '5472-8721', 'Roca 710', 2, '1998-02-15', 'c.gonzalez@hotmail.com', 3),
	(32875623, 'Romina', 'Mejia', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '5781-2484', 'Roca 710', 2, '1993-03-25', 'r.mejia@gmail.com', 1),
	(33195378, 'Rocio', 'Martin', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '4528-2577', 'Av.Belgrano 448', 2, '1990-10-15', 'r.martin@hotmail.com', 3),
	(33223372, 'Analia', 'Oliva', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '5459-8752', 'Av.Belgrano 448', 2, '1995-08-02', 'a.oliva@hotmail.com', 3),
	(34978622, 'Micaela', 'Gieco', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '5789-2547', 'Av.Belgrano 448', 2, '1992-07-11', 'm.gieco@gmail.com', 1),
	(35426279, 'Jose Maria ', 'Rodriguez', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '4527-8576', 'Av.Belgrano 448', 2, '1992-06-08', 'j.rodriguez@gmail.com', 3),
	(36592331, 'Fiorella', 'Freire', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '4575-3257', 'Roca 710', 2, '1994-10-01', 'f.freire@gmail.com', 1),
	(36873330, 'Belen', 'Sanchez', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', NULL, '1152486538', 'Roca 710', 2, '1092-07-19', 'belen.sanchez@hotmail.com', 1);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;

-- Volcando estructura para tabla upcn.provincia
DROP TABLE IF EXISTS `provincia`;
CREATE TABLE IF NOT EXISTS `provincia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla upcn.provincia: ~24 rows (aproximadamente)
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
INSERT INTO `provincia` (`id`, `nombre`) VALUES
	(1, 'Ciudad Autónoma de Buenos Aires'),
	(2, 'Buenos Aires'),
	(3, 'Catamarca'),
	(4, 'Chaco'),
	(5, 'Chubut'),
	(6, 'Córdoba'),
	(7, 'Corrientes'),
	(8, 'Entre Ríos'),
	(9, 'Formosa'),
	(10, 'Jujuy'),
	(11, 'La Pampa'),
	(12, 'La Rioja'),
	(13, 'Mendoza'),
	(14, 'Misiones'),
	(15, 'Neuquén'),
	(16, 'Río Negro'),
	(17, 'Salta'),
	(18, 'San Juan'),
	(19, 'San Luis'),
	(20, 'Santa Cruz'),
	(21, 'Santa Fe'),
	(22, 'Santiago del Estero'),
	(23, 'Tierra del Fuego, Antártida e Islas del Atlántico '),
	(24, 'Tucumán');
/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;

-- Volcando estructura para tabla upcn.rol
DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla upcn.rol: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`id`, `rol`) VALUES
	(1, 'Administrador'),
	(2, 'Empleado'),
	(3, 'Afiliado');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;

-- Volcando estructura para tabla upcn.tipo_viaje
DROP TABLE IF EXISTS `tipo_viaje`;
CREATE TABLE IF NOT EXISTS `tipo_viaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla upcn.tipo_viaje: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_viaje` DISABLE KEYS */;
INSERT INTO `tipo_viaje` (`id`, `nombre`) VALUES
	(1, 'Miniturismo'),
	(2, 'Escapada'),
	(3, 'Paquete');
/*!40000 ALTER TABLE `tipo_viaje` ENABLE KEYS */;

-- Volcando estructura para tabla upcn.viaje
DROP TABLE IF EXISTS `viaje`;
CREATE TABLE IF NOT EXISTS `viaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_viaje` int(11) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_provincia` int(11) NOT NULL,
  `lugar` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `detalle` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `dias` int(11) NOT NULL,
  `noches` int(11) NOT NULL,
  `fecha_desde` date NOT NULL,
  `fecha_hasta` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paquete_tipo` (`id_tipo_viaje`),
  KEY `paquete_provincia` (`id_provincia`),
  CONSTRAINT `viaje_ibfk_1` FOREIGN KEY (`id_tipo_viaje`) REFERENCES `tipo_viaje` (`id`),
  CONSTRAINT `viaje_ibfk_2` FOREIGN KEY (`id_provincia`) REFERENCES `provincia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla upcn.viaje: ~25 rows (aproximadamente)
/*!40000 ALTER TABLE `viaje` DISABLE KEYS */;
INSERT INTO `viaje` (`id`, `id_tipo_viaje`, `foto`, `id_provincia`, `lugar`, `precio`, `detalle`, `dias`, `noches`, `fecha_desde`, `fecha_hasta`) VALUES
	(1, 1, NULL, 13, 'Con termas de Cacheuta', 5677.00, 'Hotel Sol Andino+Media pensión', 4, 2, '2020-03-02', '2020-03-05'),
	(2, 1, NULL, 13, 'Con termas de Cacheuta', 6176.00, 'Hotel Cordón del Plata+Media pensión', 4, 2, '2020-03-06', '2020-03-09'),
	(3, 1, NULL, 19, 'Parque Nacional Sierras de la Quijada', 6778.00, 'Gran Hotel San Luis+Media pensión', 4, 2, '2020-03-02', '2020-03-05'),
	(4, 1, NULL, 6, 'Villa Carlos Paz', 5531.00, 'Hotel El Mirador+ Pensión completa', 4, 2, '2020-03-02', '2020-03-05'),
	(5, 1, NULL, 6, 'Villa Carlos Paz', 6262.00, 'Hotel Kalton + Pensión completa', 4, 2, '2020-03-02', '2020-03-05'),
	(6, 1, NULL, 2, 'Mar del Plata', 4207.00, 'Hotel Dos Reyes+ Desayuno incluido', 4, 2, '2020-02-03', '2020-03-06'),
	(7, 1, NULL, 2, 'Mar del Plata', 3800.00, 'Hotel Pergamino + Desayuno incluido', 4, 2, '2020-02-03', '2020-02-06'),
	(8, 1, NULL, 21, 'Rosario', 2500.00, 'Hotel de la Cité+ Desayuno incluido', 4, 2, '2020-04-04', '2020-04-07'),
	(9, 1, NULL, 14, 'Cataratas del Iguazu', 6000.00, 'Hotel Colonial Iguazu+ Media Pensión', 4, 2, '2020-04-04', '2020-04-07'),
	(10, 1, NULL, 14, 'Caratas del Iguazu', 7000.00, 'Exe Hotel Cataratas+ Media Pensión', 4, 2, '2020-04-04', '2020-04-07'),
	(11, 2, NULL, 2, 'Día de campo en Brandsen', 2000.00, 'Actividades de campo+ Desayuno+ Picada+ Merienda', 1, 2, '2020-07-10', '2020-07-14'),
	(12, 2, NULL, 19, 'Parque Nacional Sierras de la Quijada', 6778.00, 'Gran Hotel San Luis + Media pensión', 4, 2, '2020-07-10', '2020-07-14'),
	(13, 2, NULL, 6, 'Villa Carlos Paz', 5531.00, 'Hotel El Mirador + Pensión completa', 4, 2, '2020-07-10', '2020-07-14'),
	(14, 2, NULL, 6, 'Villa Carlos Paz', 6262.00, 'Hotel Kalton + Pensión completa', 4, 2, '2020-07-10', '2020-07-14'),
	(15, 2, NULL, 8, 'Villa Elisa ', 5200.00, 'Hotel Quinto Elemento + Media pensión', 4, 2, '2020-10-13', '2020-07-16'),
	(16, 2, NULL, 2, 'Tigre ', 3350.00, 'Hotel Wyndham Nordelta + Desayuno incluido ', 4, 2, '2020-10-13', '2020-07-16'),
	(17, 2, NULL, 2, 'Lobos', 3000.00, 'La candelaria + Media pension ', 4, 2, '2020-06-12', '2020-06-15'),
	(18, 3, NULL, 13, 'Termas de Cacheuta', 5677.00, 'Hotel Sol Andino + Media pensión+ Micro', 4, 2, '2020-06-12', '2020-07-12'),
	(19, 3, NULL, 13, 'Termas de Cacheuta', 6176.00, 'Hotel Cordón del Plata + Media pensión+ Micro', 4, 2, '2020-06-10', '2020-06-14'),
	(20, 3, NULL, 19, 'Parque Nacional Sierras de la Quijada', 6778.00, 'Gran Hotel San Luis+ Media pensión+ Micro', 4, 2, '2020-01-12', '2020-01-15'),
	(21, 3, NULL, 6, 'Villa Carlos Paz', 5531.00, 'Hotel El Mirador+ Media pensión+ Micro ', 4, 2, '2020-01-12', '2020-01-15'),
	(22, 3, NULL, 6, 'Villa Carlos Paz', 6262.00, 'Hotel Kalton + pensión completa + Micro', 4, 2, '2020-02-10', '2020-02-14'),
	(23, 3, NULL, 13, 'MENDOZA', 12000.00, 'Hotel Provincial+ Desayuno incluido+ Aereo', 4, 2, '2020-02-06', '2020-02-09'),
	(24, 3, NULL, 16, 'Bariloche', 20000.00, 'Hotel Nevada+ Desayuno + Aereo', 4, 2, '2020-02-06', '2020-02-09'),
	(25, 3, NULL, 5, 'Puerto Madryn', 15000.00, 'Hotel Península Valdés+ Desayuno+ Aereo', 4, 2, '2020-02-06', '2020-02-09');
/*!40000 ALTER TABLE `viaje` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

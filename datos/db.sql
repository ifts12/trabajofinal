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

-- Volcando estructura para tabla upcn.adicional
DROP TABLE IF EXISTS `provincia`;
CREATE TABLE IF NOT EXISTS `provincia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
	(23, 'Tierra del Fuego, Antártida e Islas del Atlántico Sur'),
	(24, 'Tucumán');

-- Volcando estructura para tabla upcn.adicional
DROP TABLE IF EXISTS `adicional`;
CREATE TABLE IF NOT EXISTS `adicional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `precio` decimal(10,2) NOT NULL,
  `detalle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla upcn.adicional: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `adicional` DISABLE KEYS */;
INSERT INTO `adicional` (`id`, `precio`, `detalle`) VALUES
	(1, 1500, 'Clinica+traslado+medicamentos');
/*!40000 ALTER TABLE `adicional` ENABLE KEYS */;

-- Volcando estructura para tabla upcn.asistencia
DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE IF NOT EXISTS `asistencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detalle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla upcn.asistencia: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
INSERT INTO `asistencia` (`id`, `detalle`) VALUES
	(1, 'clinica+traslado+medicamentos');
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;

-- Volcando estructura para tabla upcn.hotel
DROP TABLE IF EXISTS `hotel`;
CREATE TABLE IF NOT EXISTS `hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(255),
  `nombre` varchar(50) NOT NULL,
  `id_provincia` int(11) NOT NULL,
  `estrellas` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT FOREIGN KEY hotel_provincia (id_provincia) REFERENCES provincia (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla upcn.hotel: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `hotel` DISABLE KEYS */;
INSERT INTO `hotel` (`id`, `nombre`, `id_provincia`, `estrellas`, `precio`, `cantidad`) VALUES
	(1, 'Hotel Sol Andino', 13, 3, 5577, 15),
	(2, 'Hotel Cordón del Plata', 13, 4, 6176, 10),
	(3, 'Gran Hotel San Luis', 19, 5, 6778, 12),
	(4, 'Hotel El Mirador', 6, 3, 5531, 15),
	(5, 'Hotel Kalton', 6, 4, 6262, 15),
	(6, 'hotel Carmen', 14, 4, 7000, 20),
	(7, 'hotel Turrance', 14, 5, 8000, 15),
	(8, 'Hotel Eco Max', 16, 5, 5000, 15),
	(9, 'Hotel Miglierina', 2, 4, 3000, 25),
	(10, 'Hotel Rivoli', 2, 5, 4000, 15),
	(11, 'Provincial Plaza Hotel', 17, 4, 4700, 10),
	(12, 'Wilson Hotel', 17, 3, 2500, 11),
	(13, 'Hotel Ushuaia', 23, 3, 3500, 12),
	(14, 'Hotel las Leñas', 23, 4, 5000, 12);
/*!40000 ALTER TABLE `hotel` ENABLE KEYS */;

-- Volcando estructura para tabla upcn.rol
DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla upcn.rol: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`id`, `rol`) VALUES
	(1, 'Administrador'),
	(2, 'Empleado'),
	(3, 'Afiliado');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;

-- Volcando estructura para tabla upcn.afiliado
DROP TABLE IF EXISTS `afiliado`;
CREATE TABLE IF NOT EXISTS `afiliado` (
  `dni` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `pass` varchar(120) NOT NULL,
  `foto` varchar(255),
  `telefono` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `id_provincia` int(11) NOT NULL,
  `fecha_nac` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`dni`),
  CONSTRAINT FOREIGN KEY afiliado_rol (id_rol) REFERENCES rol (id),
  CONSTRAINT FOREIGN KEY afiliado_provincia (id_provincia) REFERENCES provincia (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla upcn.afiliado: ~19 rows (aproximadamente)
/*!40000 ALTER TABLE `afiliado` DISABLE KEYS */;
INSERT INTO `afiliado` (`dni`, `nombre`, `apellido`, `pass`, `telefono`, `direccion`, `id_provincia`, `fecha_nac`, `email`, `id_rol`) VALUES
	(22333444, 'Tony', 'DL', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y',  '4318-3404', 'Roca 710', 2, '1961-10-17', 'tonydl@gmail.com', 1),
	(7939954, 'Eduardo', 'Sundblad', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '4318-3404', 'Roca 710', 2, '1961-10-17', 'e.sundabland@gmail.com', 3),
	(8550842, 'Jose ', 'Alcorta', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '4257-5872', 'Roca 710', 2, '1979-08-07', 'j.alcorta@hotmail.com', 3),
	(17889219, 'Gabriela', 'Caino', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '5781-5872', 'Av.Belgrano 448', 2, '1989-11-07', 'g.caino@gmail.com', 2),
	(21362151, 'Luisa', 'Gamboa', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', ' 4317-2000', 'Av.Belgrano 448', 2, '1980-04-12', 'g.caino@gmail.com', 2),
	(22976274, 'Lorena', 'Olivera', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '4528-2875', 'Av.Belgrano 448', 2, '1989-01-05', 'L.olivera@hotmail.com', 2),
	(23140162, 'Silvia', 'Freire', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '4582-2747', 'Av.Belgrano 485', 2, '1985-05-03', 's.freire@hotmail.com', 3),
	(27771259, 'Claudia', 'Avalos', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '5452-2488', 'Av.Belgrano 448', 2, '1995-02-13', 'c.avalos@gmail.com', 3),
	(28379836, 'Maria', 'Torres', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '4318-3404', 'Roca 710', 2, '1982-09-01', 'm.torres@hotmail.com', 3),
	(30191893, 'Florencia', 'Sanchez', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '4257-8792', 'Av.Belgrano 448', 2, '1990-10-06', 'f.sanchez@hotmail.com', 3),
	(30913912, 'Ana', 'Mazzeo', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '4258-8512', 'Av.Belgrano 448', 2, '1990-04-01', 'a.mazzeo@hotmail.com', 3),
	(31609032, 'Analia', 'Blanco', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '4825-2577', 'Av.Belgrano 448', 2, '1999-09-20', 'a.blanco@hotmail.com', 3),
	(32545825, 'Claudia', 'Gonzalez', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '5472-8721', 'Roca 710', 2, '1998-02-15', 'c.gonzalez@hotmail.com', 3),
	(32875623, 'Romina', 'Mejia', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '5781-2484', 'Roca 710', 2, '1993-03-25', 'r.mejia@gmail.com', 1),
	(33195378, 'Rocio', 'Martin', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '4528-2577', 'Av.Belgrano 448', 2, '1990-10-15', 'r.martin@hotmail.com', 3),
	(33223372, 'Analia', 'Oliva', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '5459-8752', 'Av.Belgrano 448', 2, '1995-08-02', 'a.oliva@hotmail.com', 3),
	(34978622, 'Micaela', 'Gieco', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '5789-2547', 'Av.Belgrano 448', 2, '1992-07-11', 'm.gieco@gmail.com', 1),
	(35426279, 'Jose Maria ', 'Rodriguez', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '4527-8576', 'Av.Belgrano 448', 2, '1992-06-08', 'j.rodriguez@gmail.com', 3),
	(36592331, 'Fiorella', 'Freire', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '4575-3257', 'Roca 710', 2, '1994-10-01', 'f.freire@gmail.com', 1),
	(36873330, 'Belen', 'Sanchez', '$argon2i$v=19$m=2048,t=4,p=3$L2RiTC9Td1ZNQy41MTJjRg$Y6tU/eJ+KiIZG6TN3gfVG787qyREbKfVp43X8B/BN4Y', '1152486538', 'Roca 710', 2, '1092-07-19', 'belen.sanchez@hotmail.com', 1);
/*!40000 ALTER TABLE `afiliado` ENABLE KEYS */;

-- Volcando estructura para tabla upcn.tipo
DROP TABLE IF EXISTS `tipo_paquete`;
CREATE TABLE IF NOT EXISTS `tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla upcn.tipo: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
INSERT INTO `tipo_paquete` (`id`, `nombre`) VALUES
	(1, 'Miniturismo'),
	(2, 'Escapada'),
	(3, 'Paquete');
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;

-- Volcando estructura para tabla upcn.viaje
DROP TABLE IF EXISTS `paquete`;
CREATE TABLE IF NOT EXISTS `paquete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(255),
  `id_provincia` int(11) NOT NULL,
  `lugar` varchar(50) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `detalle` varchar(50) NOT NULL,
  `dias` int(11) NOT NULL,
  `noches` int(11) NOT NULL,
  `cantidad` varchar(50) NOT NULL,
  `id_tipo_paquete` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT FOREIGN KEY paquete_tipo (id_tipo_paquete) REFERENCES tipo (id),
  CONSTRAINT FOREIGN KEY paquete_provincia (id_provincia) REFERENCES provincia (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla upcn.viaje: ~25 rows (aproximadamente)
/*!40000 ALTER TABLE `viaje` DISABLE KEYS */;
INSERT INTO `viaje` (`id`, `id_provincia`, `lugar`, `precio`, `detalle`, `dias`, `noches`, `cantidad`, `id_tipo_paquete`) VALUES
	(1, 13, 'Con termas de Cacheuta', 5677, 'Hotel Sol Andino+Media pensión', '4', '2', '10', 1),
	(2, 13, 'Con termas de Cacheuta', 6176, 'Hotel Cordón del Plata+Media pensión', '4', '2', '10', 1),
	(3, 19, 'Parque Nacional Sierras de la Quijada', 6778, 'Gran Hotel San Luis+Media pensión', '4', '2', '10', 1),
	(4, 6, 'Villa Carlos Paz', 5531, 'Hotel El Mirador+ Pensión completa', '4', '2', '10', 1),
	(5, 6, 'Villa Carlos Paz', 6262, 'Hotel Kalton + Pensión completa', '4', '2', '10', 1),
	(6, 2, 'Mar del Plata', 4207, 'Hotel Dos Reyes+ Desayuno incluido', '4', '2', '10', 1),
	(7, 2, 'Mar del Plata', 3800, 'Hotel Pergamino + Desayuno incluido', '4', '2', '10', 1),
	(8, 21, 'Rosario', 2500, 'Hotel de la Cité+ Desayuno incluido', '4', '2', '10', 1),
	(9, 14, 'Cataratas del Iguazu', 6000, 'Hotel Colonial Iguazu+ Media Pensión', '4', '2', '10', 1),
	(10, 14, 'Caratas del Iguazu', 7000, 'Exe Hotel Cataratas+ Media Pensión', '4', '2', '10', 1),
	(11, 2, 'Día de campo en Brandsen', 2000, 'Actividades de campo+ Desayuno+ Picada+ Merienda', '1 dia', '15', 2),
	(12, 19, 'Parque Nacional Sierras de la Quijada', 6778, 'Gran Hotel San Luis + Media pensión', '4', '2', '15', 2),
	(13, 6, 'Villa Carlos Paz', 5531, 'Hotel El Mirador + Pensión completa', '4', '2', '15', 2),
	(14, 6, 'Villa Carlos Paz', 6262, 'Hotel Kalton + Pensión completa', '4', '2', '15', 2),
	(15, 8, 'Villa Elisa ', 5200, 'Hotel Quinto Elemento + Media pensión', '4', '2', '15', 2),
	(16, 2, 'Tigre ', 3350, 'Hotel Wyndham Nordelta + Desayuno incluido ', '1 dia ', '15', 2),
	(17, 2, 'Lobos', 3000, 'La candelaria + Media pension ', '2 dias ', '15', 2),
	(18, 13, 'Termas de Cacheuta', 5677, 'Hotel Sol Andino + Media pensión+ Micro', '4', '2', '20', 3),
	(19, 13, 'Termas de Cacheuta', 6176, 'Hotel Cordón del Plata + Media pensión+ Micro', '4 dias / 2 noches ', '20', 3),
	(20, 19, 'Parque Nacional Sierras de la Quijada', 6778, 'Gran Hotel San Luis+ Media pensión+ Micro', '4 días / 2 noches', '20', 3),
	(21, 6, 'Villa Carlos Paz', 5531, 'Hotel El Mirador+ Media pensión+ Micro ', '4 días / 2 noches', '20', 3),
	(22, 6, 'Villa Carlos Paz', 6262, 'Hotel Kalton + pensión completa + Micro', '4', '2', '20', 3),
	(23, 13, 'MENDOZA', 12000, 'Hotel Provincial+ Desayuno incluido+ Aereo', '2', '1', '20', 3),
	(24, 16, 'Bariloche', 20000, 'Hotel Nevada+ Desayuno + Aereo', '4', '2', '20', 3),
	(25, 5, 'Puerto Madryn', 15000, 'Hotel Península Valdés+ Desayuno+ Aereo', '1', '2', '20', 3);
/*!40000 ALTER TABLE `viaje` ENABLE KEYS */;

-- Volcando estructura para tabla upcn.compra
DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` int(11) NOT NULL,
  `id_adicional` int(11) NOT NULL,
  `id_asist` int(11) NOT NULL,
  `id_viaje` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_final` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT FOREIGN KEY compra_adicional (id_adicional) REFERENCES adicional (id),
  CONSTRAINT FOREIGN KEY compra_asistencia (id_asist) REFERENCES asistencia (id),
  CONSTRAINT FOREIGN KEY compra_viaje (id_viaje) REFERENCES viaje (id),
  CONSTRAINT FOREIGN KEY compra_hotel (id_hotel) REFERENCES hotel (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla upcn.compra: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;



-- Exportación de la base de datos
-- Base de datos: gamch
-- Versión: 80306

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `borradores`;
CREATE TABLE `borradores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lugar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `borradores_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `borradores`

DROP TABLE IF EXISTS `cargos`;
CREATE TABLE `cargos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nivel_id` int NOT NULL,
  `cargo_empleado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'activo',
  PRIMARY KEY (`id`),
  KEY `nivel_id` (`nivel_id`),
  CONSTRAINT `cargos_ibfk_1` FOREIGN KEY (`nivel_id`) REFERENCES `niveles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `cargos`

INSERT INTO `cargos` VALUES
(1,6,'TECNICO DE SISTEMAS Y MANTENIMIENTO','2025-06-30 20:50:53','2025-06-30 20:50:53','activo'),
(2,6,'RESPONSABLE DE CULTURA Y TURISMO','2025-06-30 20:50:53','2025-06-30 20:50:53','activo'),
(3,6,'ENCARGADO CANAL DE TELEVISIÓN MUNICIPAL','2025-06-30 20:50:53','2025-06-30 20:50:53','activo');
DROP TABLE IF EXISTS `clases`;
CREATE TABLE `clases` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_clase` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `clases`

INSERT INTO `clases` VALUES
(1,'ELECTOS','2025-06-30 20:51:04','2025-06-30 20:51:04'),
(2,'LIBRE NOMBRAMIENTOS','2025-06-30 20:51:04','2025-06-30 20:51:04'),
(3,'S/N','2025-06-30 20:51:04','2025-06-30 20:51:04');
DROP TABLE IF EXISTS `consultas`;
CREATE TABLE `consultas` (
  `cod_cons` int NOT NULL AUTO_INCREMENT,
  `consulta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `respuesta_consulta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`cod_cons`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `consultas`

INSERT INTO `consultas` VALUES
(1,'hola','hola, en que puedo ayudarte'),
(2,'como estas','estoy bien y tu'),
(3,'yo estoy bien','que bien me alegra escuchar que estes bien'),
(4,'cual es tu nombre','mi nombre es chatbot GAMCH'),
(5,NULL,'en que mas podria ayudarte'),
(6,'Elije una de las opciones en las que te podria ayudar',NULL),
(7,'quisiera mas informacion sobre el centro de salud','le pido que especifique su consulta'),
(8,'como te llamas','me llamo chatbot GAMCH'),
(9,'cual es tu nombre','me llamo chatbot cala cala'),
(10,'me podrias dar los horarios de atencion','los horarios de atencion son por la mañana desde las 8:00 a 12:00 y por la tarde de 14:00 a 18:00'),
(11,'como te encuentras','yo estoy bien'),
(12,'en que lugar se encuentra la ciudad de challapata','la ubicacion esta en Challapata'),
(13,'cuantos años tienes','No se sabe mi edad porque soy un chatbot'),
(14,'en donde vives','soy parte de la alcaldia de challapata'),
(15,'eres persona','soy una ia'),
(16,'quien te creo','fui creado en la alcaldia de challapata'),
(17,'tiene mujer o esposa','no tengo respuesta para esa pregunta'),
(18,'donde te encuentras','estoy ubicado en la alcaldia de challapata'),
(19,'que tecnologias se uso para tu creacion','no tengo una respuesta para esa pregunta'),
(20,'que servicios brindan en la alcandia','tenemos los servicios de pagos de impuestos inmubiliarios, pago de vehiculos, compra de terreno en el cementerio, para mas informacion preguntar directamente en la alcaldia de challapata'),
(21,'cuantas secretarias se tiene en la alcaldia','se tiene 4 secretarias, de finanzas, de desarrollo productivo, obras publicas, y de desarrollo humano y social'),
(22,'cual es tu sexo','no tengo sexo soy una ia chatbot'),
(23,'donde esta ubicado la alcaldia','Alcaldía de Challapata, Plaza Eduardo Avaroa, Esquina Av. Mariano Baptista'),
(24,'en que departamento se encuentra challapata','en oruro'),
(25,'cuantas sub alcaldias se tiene','se cuenta con 9 sub alcaldias');
DROP TABLE IF EXISTS `cultura`;
CREATE TABLE `cultura` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_actividad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipo_actividad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `ubicacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contacto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `enlace_web` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagen_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_tipo_actividad` (`tipo_actividad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `cultura`

DROP TABLE IF EXISTS `documentos`;
CREATE TABLE `documentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `categoria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cod` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `entidad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `fecha_creacion` date DEFAULT NULL,
  `archivo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nombre_documento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `datos_documento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `publicar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cod` (`cod`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `documentos`

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE `empleados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nivel_id` int NOT NULL,
  `cargo_id` int NOT NULL,
  `tipo_empleado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellido_p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellido_m` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sexo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `correo_electronico` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'default.jpg',
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'activo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo_electronico` (`correo_electronico`),
  KEY `nivel_id` (`nivel_id`),
  KEY `cargo_id` (`cargo_id`),
  CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`nivel_id`) REFERENCES `niveles` (`id`),
  CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `empleados`

INSERT INTO `empleados` VALUES
(1,6,1,'normal','Limbert','Lipiri','Villca','Masculino','Calle La Paz entre Linarez',63260832,'lipiri12345678xp@gmail.com','vista/activos/FotoUsuario/11637c65a09ff090279a0bce3a7bb3ca.jpg','2025-06-30 20:50:54','2025-07-07 14:35:16','activo'),
(2,6,3,'normal','Florencio','Argandoña','Colque','Masculino','Oruro',0,'florencio@gmail.com',NULL,'2025-07-17 15:01:22','2025-07-17 15:01:22','activo');
DROP TABLE IF EXISTS `gestionTransparente`;
CREATE TABLE `gestionTransparente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `categoria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cod` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `fecha_creacion` date DEFAULT NULL,
  `archivo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nombre_documento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `publicar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cod` (`cod`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `gestionTransparente_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `gestionTransparente`

DROP TABLE IF EXISTS `niveles`;
CREATE TABLE `niveles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nivel_empleado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'activo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `niveles`

INSERT INTO `niveles` VALUES
(1,'SECRETARIA MUNICIPAL DE ADMINISTRACIÓN Y FINANZAS','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(2,'EJECUTIVO','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(3,'SECRETARIA MUNICIPAL DE DESARROLLO PRODUCTIVO','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(4,'UNIDAD DE ORDENAMIENTO TERRITORIAL Y CATASTRO','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(5,'SECRETARIA MUNICIPAL DE OBRAS PUBLICAS','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(6,'SECRETARIA MUNICIPAL DE DESARROLLO HUMANO Y SOCIAL','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(7,'SUB ALCALDIA CHALLAPATA','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(8,'SUB ALCALDIA QAQACHACA','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(9,'SUB ALCALDIA AGUAS CALIENTES','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(10,'SUB ALCALDIA HUANCANE','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(11,'SUB ALCALDIA TOLAPALCA','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(12,'SUB ALCALDIA NORTE CONDO ARRIBA','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(13,'SUB ALCALDIA NORTE CONDO ABAJO','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(14,'SUB ALCALDIA CULTA','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(15,'SUB ALCALDIA ANCACATO','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(16,'ALIMENTACION COMPLEMENTARIA','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(17,'APOYO AL DESARROLLO DEPORTIVO','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(18,'APOYO A LA CULTURA','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(19,'APOYO AL TURISMO','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(20,'APOYO DE SERVICIO LEGAL INTEGRAL MUNICIPAL (SLIM)','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(21,'EQUIDAD DE GENERO LEY 348','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(22,'UMAPEDIS','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(23,'FUNCIONAMIENTO CASA INTEGRAL DE ACOGIDA','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(24,'RECURSO PARA ADULTOS MAYORES (LEY 548)','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(25,'DEFENSORIA DE LA NIÑEZ Y LA ADOLESCENCIA','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(26,'SEGURIDAD CIUDADANA','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(27,'LIMITES TERRITORIALES','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(28,'FUNCIONAMIENTO CANAL MUNICIPAL','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(29,'UNIDAD DE DESARROLLO PRODUCTIVO AGROPECUARIO','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(30,'UNIDAD DE INSEMINACION ARTIFICIAL CHALLAPATA','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(31,'UNIDAD DE APOYO AL FUNCIONAMIENTO ZOONOSIS','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(32,'UNIDAD IMPLEMENTACION Y MANTENIMIENTO DE AREAS VERDES','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(33,'UNIDAD DE APOYO MEDIO AMBIENTE MUNICIPIO CHALLAPATA','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(34,'UNIDAD DE ASEO URBANO','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(35,'UNIDAD DE INHUMACION CEMENTERIO','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(36,'UNIDAD DE UGR C. A.P.','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(37,'UNIDAD DE PREVISION DE RECURSOS PARA GESTION DE RIESGOS','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(38,'RESPONSABLE DE RECURSOS HUMANOS','2025-06-30 20:50:52','2025-06-30 20:50:52','activo'),
(39,'RESPONSABLE DE CONTRATACIONES','2025-06-30 20:50:52','2025-06-30 20:50:52','activo');
DROP TABLE IF EXISTS `normas`;
CREATE TABLE `normas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `categoria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cod` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `fecha_creacion` date DEFAULT NULL,
  `archivo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nombre_documento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `publicar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cod` (`cod`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `normas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `normas`

INSERT INTO `normas` VALUES
(1,1,'MANUAL-DE-ORGANIZACION-FUNCIONES','DECRETO EDIL N°003/2022','MANUAL','2022-01-01','vista/activos/documento/normativas/f8656b8fb3612590bed25a2415ae0314.pdf','MANUAL DE ORGANIZACIONES Y FUNCIONES','vigente',1,'2025-07-05 20:46:25','2025-07-14 16:52:48');
DROP TABLE IF EXISTS `nuevas_paginas`;
CREATE TABLE `nuevas_paginas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contenido` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha` date NOT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `nuevas_paginas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `nuevas_paginas`

INSERT INTO `nuevas_paginas` VALUES
(1,1,'Festividad de la Virgen del Carmen de Challapata','Challapata se prepara para la Festividad de la Virgen del Carmen 2025
La localidad de Challapata, en el departamento de Oruro, se alista para vivir una de sus celebraciones más importantes: la Festividad de la Virgen del Carmen, que se llevará a cabo los días 15 y 16 de julio de 2025. Esta tradicional manifestación de fe y cultura convoca cada año a miles de feligreses y visitantes, reafirmando su carácter como uno de los eventos religiosos más significativos del altiplano boliviano.
Reconocida por la Ley Nº 3371 como Patrimonio Cultural, Religioso, Intangible y Oral de la Nación, esta festividad destaca por su mezcla única de devoción mariana, danzas folklóricas, música autóctona y costumbres ancestrales que reflejan la identidad viva del pueblo challapateño.
La población se prepara con entusiasmo para recibir a devotos, fraternidades, turistas y autoridades que se darán cita en un encuentro lleno de espiritualidad, cultura y tradición.','vista/activos/NoticiasImagen/08815a3c2109522c6d2eb0f90197ca45.jpg','2025-07-08','2025-07-08 14:38:36','2025-07-10 14:03:28');
DROP TABLE IF EXISTS `permiso_rol`;
CREATE TABLE `permiso_rol` (
  `id` int NOT NULL AUTO_INCREMENT,
  `permiso_id` int NOT NULL,
  `rol_id` int NOT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `permiso_id` (`permiso_id`),
  KEY `rol_id` (`rol_id`),
  CONSTRAINT `permiso_rol_ibfk_1` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permiso_rol_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `permiso_rol`

INSERT INTO `permiso_rol` VALUES
(1,36,1,'2025-06-30 20:51:03','2025-06-30 20:51:03');
DROP TABLE IF EXISTS `permiso_usuario`;
CREATE TABLE `permiso_usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `permiso_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `permiso_id` (`permiso_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `permiso_usuario_ibfk_1` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`id`),
  CONSTRAINT `permiso_usuario_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `permiso_usuario`

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `permisos`

INSERT INTO `permisos` VALUES
(1,'Crear','users.create','Crea Usuarios para la administracion del sistema','2025-06-30 20:50:55','2025-06-30 20:50:55'),
(2,'Navegar','users.index','Lista y navega por todos los usuarios del sistema','2025-06-30 20:50:55','2025-06-30 20:50:55'),
(3,'detalle','users.show','muestra en detalle cada usuario del sistema','2025-06-30 20:50:55','2025-06-30 20:50:55'),
(4,'Editar','users.edit','Edita cualquier dato de un usuario del sistema','2025-06-30 20:50:55','2025-06-30 20:50:55'),
(5,'Eliminar','users.destroy','Eliminina cualquier usuario de sistema','2025-06-30 20:50:55','2025-06-30 20:50:55'),
(6,'Crear','roles.create','Crea un rol del sistema','2025-06-30 20:50:55','2025-06-30 20:50:55'),
(7,'Navegar','roles.index','Lista y navega por todos los roles del sistema','2025-06-30 20:50:55','2025-06-30 20:50:55'),
(8,'detalle','roles.show','muestra en detalle cada rol del sistema','2025-06-30 20:50:55','2025-06-30 20:50:55'),
(9,'Editar','roles.edit','Edita cualquier dato de un rol del sistema','2025-06-30 20:50:56','2025-06-30 20:50:56'),
(10,'Eliminar','roles.destroy','Eliminina cualquier rol de sistema','2025-06-30 20:50:56','2025-06-30 20:50:56'),
(11,'Crear','doc.create','Crea un document del sistema','2025-06-30 20:50:56','2025-06-30 20:50:56'),
(12,'Navegar','doc.index','Lista y navega por todos los documents del sistema','2025-06-30 20:50:56','2025-06-30 20:50:56'),
(13,'detalle','doc.show','muestra en detalle cada document del sistema','2025-06-30 20:50:56','2025-06-30 20:50:56'),
(14,'Editar','doc.edit','Edita cualquier dato de un document del sistema','2025-06-30 20:50:56','2025-06-30 20:50:56'),
(15,'Eliminar','doc.destroy','Eliminina cualquier document de sistema','2025-06-30 20:50:56','2025-06-30 20:50:56'),
(16,'Crear','employees.create','Crea un Empleados del sistema','2025-06-30 20:50:56','2025-06-30 20:50:56'),
(17,'Navegar','employees.index','Lista y navega por todos los Empleados del sistema','2025-06-30 20:50:56','2025-06-30 20:50:56'),
(18,'detalle','employees.show','muestra en detalle cada Empleados del sistema','2025-06-30 20:50:56','2025-06-30 20:50:56'),
(19,'Editar','employees.edit','Edita cualquier dato de un Empleados del sistema','2025-06-30 20:50:56','2025-06-30 20:50:56'),
(20,'Eliminar','employees.destroy','Eliminina cualquier Empleados de sistema','2025-06-30 20:50:56','2025-06-30 20:50:56'),
(21,'Crear','salaries.create','Crea un Salarios del sistema','2025-06-30 20:50:56','2025-06-30 20:50:56'),
(22,'Navegar','salaries.index','Lista y navega por todos los Salarios del sistema','2025-06-30 20:50:56','2025-06-30 20:50:56'),
(23,'detalle','salaries.show','muestra en detalle cada Salarios del sistema','2025-06-30 20:50:56','2025-06-30 20:50:56'),
(24,'Editar','salaries.edit','Edita cualquier dato de un Salarios del sistema','2025-06-30 20:50:56','2025-06-30 20:50:56'),
(25,'Eliminar','salaries.destroy','Eliminina cualquier Salarios de sistema','2025-06-30 20:50:56','2025-06-30 20:50:56'),
(26,'Crear','newpages.create','Crea un Noticias del sistema','2025-06-30 20:50:57','2025-06-30 20:50:57'),
(27,'Navegar','newpages.index','Lista y navega por todos los Noticias del sistema','2025-06-30 20:50:57','2025-06-30 20:50:57'),
(28,'detalle','newpages.show','muestra en detalle cada Noticias del sistema','2025-06-30 20:50:57','2025-06-30 20:50:57'),
(29,'Editar','newpages.edit','Edita cualquier dato de un Noticias del sistema','2025-06-30 20:50:57','2025-06-30 20:50:57'),
(30,'Eliminar','newpages.destroy','Eliminina cualquier Noticias de sistema','2025-06-30 20:50:57','2025-06-30 20:50:57'),
(31,'Crear','projects.create','Crea un Niveles del sistema','2025-06-30 20:50:57','2025-06-30 20:50:57'),
(32,'Navegar','projects.index','Lista y navega por todos los Niveles del sistema','2025-06-30 20:50:57','2025-06-30 20:50:57'),
(33,'detalle','projects.show','muestra en detalle cada Niveles del sistema','2025-06-30 20:50:57','2025-06-30 20:50:57'),
(34,'Editar','projects.edit','Edita cualquier dato de un Niveles del sistema','2025-06-30 20:50:57','2025-06-30 20:50:57'),
(35,'Eliminar','projects.destroy','Eliminina cualquier Niveles de sistema','2025-06-30 20:50:57','2025-06-30 20:50:57'),
(36,'Todo','todo.*','control del sistema','2025-06-30 20:50:57','2025-06-30 20:50:57');
DROP TABLE IF EXISTS `rol_usuario`;
CREATE TABLE `rol_usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rol_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `rol_id` (`rol_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `rol_usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rol_usuario_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `rol_usuario`

INSERT INTO `rol_usuario` VALUES
(1,1,1,'2025-06-30 20:51:02','2025-06-30 20:51:02'),
(2,3,2,'2025-07-17 15:11:26','2025-07-17 15:11:26');
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `especial` enum('acceso-total','sin-acceso') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'sin-acceso',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `roles`

INSERT INTO `roles` VALUES
(1,'Admin','admin','encargado del sistema','2025-06-30 20:51:01','2025-06-30 20:51:01','acceso-total'),
(2,'Documentos','documentos','sube documentos','2025-06-30 20:51:01','2025-06-30 20:51:01','sin-acceso'),
(3,'Noticia','Noticia','Encargado de poner las noticias','2025-07-17 15:10:59','2025-07-17 15:10:59','sin-acceso');
DROP TABLE IF EXISTS `salarios`;
CREATE TABLE `salarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `salcat_id` int NOT NULL,
  `clase_id` int NOT NULL,
  `nivel_sueldo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `denominacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nro_item` int NOT NULL,
  `sueldo_mensual` double NOT NULL,
  `sueldo_total` double NOT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_salcat_id` (`salcat_id`),
  KEY `idx_clase_id` (`clase_id`),
  CONSTRAINT `salarios_ibfk_1` FOREIGN KEY (`salcat_id`) REFERENCES `salcats` (`id`) ON DELETE CASCADE,
  CONSTRAINT `salarios_ibfk_2` FOREIGN KEY (`clase_id`) REFERENCES `clases` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `salarios`

DROP TABLE IF EXISTS `salcats`;
CREATE TABLE `salcats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `salcats`

INSERT INTO `salcats` VALUES
(1,'SUPERIOR','2025-06-30 20:51:04','2025-06-30 20:51:04'),
(2,'EJECUTIVA','2025-06-30 20:51:04','2025-06-30 20:51:04'),
(3,'OPERATIVO','2025-06-30 20:51:04','2025-06-30 20:51:04');
DROP TABLE IF EXISTS `turismo`;
CREATE TABLE `turismo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_destino` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipo_destino` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `actividades_disponibles` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ubicacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contacto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `enlace_web` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagen_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_tipo_destino` (`tipo_destino`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `turismo`

INSERT INTO `turismo` VALUES
(1,'REPRESA DE TACAGUA','La Represa de Tacagua se encuentra a 10 km de la población de Challapata, en la carretera que conduce a Potosí, en el departamento de Oruro, Bolivia.

La cortina de la represa tiene una altura de 28 metros y un coronamiento de 185 metros de longitud por 5.5 metros de ancho. En la parte central de la estructura se ubica un túnel vertical que alberga dos válvulas tipo mariposa, las cuales tienen una capacidad de desfogue de 10 m³/s.

La represa tiene una capacidad de almacenamiento de 45 millones de metros cúbicos (m³) de agua, los cuales están destinados principalmente al riego de 6,000 hectáreas de tierras agrícolas. Este agua se distribuye a través de tres canales principales: el Canal Norte, el Canal Centro y el Canal Sur.

El excedente de agua que no es utilizado para riego se dirige hacia el lago Poopó, contribuyendo a su mantenimiento y regulación hídrica.
','Campo','Paseo en Botes.','Se Ubica a 10 km de la ciudad de Challapata.',0,NULL,'vista/activos/turismoImagen/f629ed55358ff6c8f7651c7ba6df7766.jpg','2025-07-04 20:01:26','2025-07-17 14:57:27');
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `empleado_id` int NOT NULL,
  `usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contrasena` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'activo',
  `token_recordar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `empleado_id` (`empleado_id`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `usuarios`

INSERT INTO `usuarios` VALUES
(1,1,'admin','$2y$10$HcDmz5/npUWmiwxbW0QK8.fp2fvu0xcbAU8McwvvJDRBf29TvuroS','activo',NULL,'2025-06-30 20:50:54','2025-06-30 20:50:54'),
(2,2,'florencio','$2y$10$kPNvtTGcUq1A/srBk3MZbeO/ypwsfSqsm0UmDvgPH0b8BlSgaXvpq','activo',NULL,'2025-07-17 15:07:15','2025-07-17 15:07:35');
SET FOREIGN_KEY_CHECKS = 1;
-- Se exporta la base de datos correctamen
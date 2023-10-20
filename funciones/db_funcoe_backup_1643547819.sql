

CREATE TABLE `asesores` (
  `id_asesor` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(20) NOT NULL,
  `nombre_asesor` varchar(100) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `fecha_registro` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_asesor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO asesores VALUES("4","11111111","FUNCOE","0000000","2022-01-25");



CREATE TABLE `conceptos` (
  `id_concepto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_concepto` varchar(30) NOT NULL,
  PRIMARY KEY (`id_concepto`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

INSERT INTO conceptos VALUES("5","Constancia Notas");
INSERT INTO conceptos VALUES("6","Constancia Estudio");
INSERT INTO conceptos VALUES("7","Seguro");
INSERT INTO conceptos VALUES("8","Carnet");
INSERT INTO conceptos VALUES("9","Uniforme");
INSERT INTO conceptos VALUES("10","Derecho a Grado");
INSERT INTO conceptos VALUES("11","Supletorio");
INSERT INTO conceptos VALUES("12","Seminario");
INSERT INTO conceptos VALUES("13","Habilitación");
INSERT INTO conceptos VALUES("14","Inscripcion");
INSERT INTO conceptos VALUES("15","Curso Ingles");
INSERT INTO conceptos VALUES("16","Curso Lecto Escritura");
INSERT INTO conceptos VALUES("18","Clase");
INSERT INTO conceptos VALUES("19","Todos");



CREATE TABLE `dias` (
  `id_dia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`id_dia`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO dias VALUES("1","LUNES");
INSERT INTO dias VALUES("2","MARTES");
INSERT INTO dias VALUES("3","MIERCOLES");
INSERT INTO dias VALUES("4","JUEVES");
INSERT INTO dias VALUES("5","VIERNES");
INSERT INTO dias VALUES("6","SABADO");
INSERT INTO dias VALUES("7","DOMINGO");



CREATE TABLE `docente` (
  `id_docente` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(15) NOT NULL,
  `nombre_comp_docente` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `fecha_registro` date NOT NULL DEFAULT current_timestamp(),
  `ultima_conexion` datetime DEFAULT NULL,
  `programa_id` int(11) NOT NULL,
  PRIMARY KEY (`id_docente`),
  KEY `programa_id` (`programa_id`),
  CONSTRAINT `docente_ibfk_1` FOREIGN KEY (`programa_id`) REFERENCES `programa` (`id_programa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;




CREATE TABLE `estudiantes` (
  `id_estudiante` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL DEFAULT current_timestamp(),
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(70) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `genero` varchar(15) DEFAULT NULL,
  `recomendacion` varchar(100) NOT NULL,
  `medio_publicitario` varchar(50) NOT NULL,
  `dia_id` int(11) NOT NULL,
  `fecha_registro` date NOT NULL DEFAULT current_timestamp(),
  `jornada` varchar(20) NOT NULL,
  `numero_registro` varchar(100) NOT NULL,
  `asesor_id` int(11) NOT NULL,
  PRIMARY KEY (`id_estudiante`),
  KEY `asesor_id` (`asesor_id`),
  KEY `dia_id` (`dia_id`),
  CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`asesor_id`) REFERENCES `asesores` (`id_asesor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `estudiantes_ibfk_2` FOREIGN KEY (`dia_id`) REFERENCES `dias` (`id_dia`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO estudiantes VALUES("13","111","2022-01-29","LUIS","PEREZ","CAREPA","BARRIO VILLA PAZ","3208975647","MASCULINO","Egresado","Instagram","3","2022-01-29","TARDE","H5409","4");



CREATE TABLE `matricula` (
  `id_matricula` int(11) NOT NULL AUTO_INCREMENT,
  `estudiante_id` int(11) NOT NULL,
  `programa_id` int(11) NOT NULL,
  `semestre` int(11) NOT NULL,
  `valor` decimal(19,4) NOT NULL,
  `pendiente` decimal(19,4) DEFAULT NULL,
  `saldo_favor` decimal(19,2) NOT NULL,
  `cuotas` int(10) NOT NULL,
  `nro_cuota` int(100) NOT NULL,
  `valorxcuotas` decimal(19,4) NOT NULL,
  `fecha_registro` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_matricula`),
  KEY `estudiante_id` (`estudiante_id`),
  KEY `programa_id` (`programa_id`),
  KEY `semestre` (`semestre`),
  CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiantes` (`id_estudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`programa_id`) REFERENCES `programa` (`id_programa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `matricula_ibfk_3` FOREIGN KEY (`semestre`) REFERENCES `semestres` (`id_semestre`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

INSERT INTO matricula VALUES("39","13","15","1","280000.0000","186666.0000","8334.00","24","6","11666.0000","2022-01-29");
INSERT INTO matricula VALUES("40","13","15","2","300000.0000","280000.0000","7500.00","24","1","12500.0000","2022-01-29");



CREATE TABLE `modulo` (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_modulo` varchar(80) NOT NULL,
  `programa_id` int(11) NOT NULL,
  `semestre` int(11) NOT NULL,
  PRIMARY KEY (`id_modulo`),
  KEY `programa_id` (`programa_id`),
  KEY `semestre` (`semestre`),
  KEY `semestre_2` (`semestre`),
  CONSTRAINT `modulo_ibfk_1` FOREIGN KEY (`programa_id`) REFERENCES `programa` (`id_programa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `modulo_ibfk_2` FOREIGN KEY (`semestre`) REFERENCES `semestres` (`id_semestre`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;




CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL AUTO_INCREMENT,
  `matricula_id` int(11) NOT NULL,
  `concepto_id` int(11) NOT NULL,
  `valor` decimal(19,4) NOT NULL,
  `fecha_pago` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_pago`),
  KEY `estudiante_id` (`matricula_id`),
  KEY `concepto_id` (`concepto_id`),
  KEY `matricula_id` (`matricula_id`),
  CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`concepto_id`) REFERENCES `conceptos` (`id_concepto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`matricula_id`) REFERENCES `matricula` (`id_matricula`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=utf8mb4;

INSERT INTO pagos VALUES("212","39","18","15000.0000","2022-01-29");
INSERT INTO pagos VALUES("213","39","18","15000.0000","2022-01-29");
INSERT INTO pagos VALUES("214","39","18","15000.0000","2022-01-29");
INSERT INTO pagos VALUES("215","39","18","13334.0000","2022-01-29");
INSERT INTO pagos VALUES("216","39","7","25000.0000","2022-01-29");
INSERT INTO pagos VALUES("217","39","18","15000.0000","2022-01-29");
INSERT INTO pagos VALUES("218","39","5","12000.0000","2022-01-29");
INSERT INTO pagos VALUES("219","40","18","20000.0000","2022-01-29");
INSERT INTO pagos VALUES("220","40","13","20000.0000","2022-01-29");
INSERT INTO pagos VALUES("221","39","5","12000.0000","2022-01-29");
INSERT INTO pagos VALUES("222","39","5","12000.0000","2022-01-29");
INSERT INTO pagos VALUES("223","39","18","20000.0000","2022-01-29");



CREATE TABLE `pensum` (
  `id_pensum` int(11) NOT NULL AUTO_INCREMENT,
  `programa_id` int(11) NOT NULL,
  `semestre_id` int(11) NOT NULL,
  `cantidad_clases` int(11) NOT NULL,
  `valor` decimal(19,4) NOT NULL,
  PRIMARY KEY (`id_pensum`),
  KEY `programa_id` (`programa_id`),
  KEY `semestre_id` (`semestre_id`),
  CONSTRAINT `pensum_ibfk_1` FOREIGN KEY (`semestre_id`) REFERENCES `semestres` (`id_semestre`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pensum_ibfk_2` FOREIGN KEY (`programa_id`) REFERENCES `programa` (`id_programa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

INSERT INTO pensum VALUES("8","15","1","24","280000.0000");
INSERT INTO pensum VALUES("11","15","2","24","300000.0000");



CREATE TABLE `programa` (
  `id_programa` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_programa` varchar(50) NOT NULL,
  PRIMARY KEY (`id_programa`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

INSERT INTO programa VALUES("15","ATENCION A LA PRIMERA INFANCIA");



CREATE TABLE `semestres` (
  `id_semestre` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_semestre` varchar(1) NOT NULL,
  PRIMARY KEY (`id_semestre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO semestres VALUES("1","1");
INSERT INTO semestres VALUES("2","2");
INSERT INTO semestres VALUES("3","3");



CREATE TABLE `turnos` (
  `id_turno` int(11) NOT NULL AUTO_INCREMENT,
  `modulo_id` int(11) NOT NULL,
  `cant_horas` int(10) NOT NULL,
  `sueldo` decimal(19,4) NOT NULL,
  `fecha_registro` date NOT NULL DEFAULT current_timestamp(),
  `docente_id` int(11) NOT NULL,
  PRIMARY KEY (`id_turno`),
  KEY `modulo_id` (`modulo_id`),
  KEY `docente_id` (`docente_id`),
  CONSTRAINT `turnos_ibfk_1` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `turnos_ibfk_2` FOREIGN KEY (`modulo_id`) REFERENCES `modulo` (`id_modulo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4;




CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(15) NOT NULL,
  `nombre_completo` varchar(80) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `ultima_conexion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO usuarios VALUES("1","1111111","Yetis Potes","admin","admin","@yetopotes","2022-01-18 13:34:14","2022-01-24 10:25:55");


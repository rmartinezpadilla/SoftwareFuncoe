

CREATE TABLE `asesores` (
  `id_asesor` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(20) NOT NULL,
  `nombre_asesor` varchar(100) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `fecha_registro` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_asesor`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO asesores VALUES("4","11111111","FUNCOE","0000000","2022-01-25");
INSERT INTO asesores VALUES("6","1067892266","JESUS ALBERTO ARGEL TIRADO","3008116948","2022-01-28");
INSERT INTO asesores VALUES("7","10966345","LUIS CARLOS TIRADO VEGA","3016508428","2022-01-28");



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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

INSERT INTO estudiantes VALUES("14","1002999041","1996-06-23","JOSE GREGORIO","FERNANDEZ OQUENDO","MONTERIA","MZ 55 LOTE 31 VILLACIELO","3136246449","MASCULINO","Asesor","Visita Barrios","6","2022-01-29","MAñANA","h 7151","7");
INSERT INTO estudiantes VALUES("15","1067865441","2022-01-29","DAYANA GREY","MARTINEZ VIDAL","MONTERIA","MZ 55 LOTE 29 VILLACIELO","3108713518","FEMENINO","Asesor","Facebook","6","2022-01-29","MAñANA","h 7174","6");
INSERT INTO estudiantes VALUES("16","1067948991","1996-05-15","ELISA DEL CARMEN","BEGAMBRE MARTINEZ","MONTERIA","MZ 7 LOTE 3 VILLA MARGARITA","3022186768","FEMENINO","Ninguno","Facebook","6","2022-01-29","MAñANA","h7025","4");
INSERT INTO estudiantes VALUES("17","1133870128","1998-11-26","ANA GREY","FURNIELES VEGA","MONTERIA","MZ 18 LOTE 11 VILLACIELO","3218602479","FEMENINO","Ninguno","Visita Barrios","6","2022-01-29","MAñANA","h7184","4");
INSERT INTO estudiantes VALUES("18","1062960592","2022-01-29","MELISA","VERTEL LEON","MONTERIA","MZ 74 LOTE 19","3147991991","FEMENINO","Asesor","Visita Barrios","6","2022-01-29","MAñANA","h 7712","7");
INSERT INTO estudiantes VALUES("19","1003431970","2022-01-29","ANGELA PATRICIA","OSTEN CAVADIA","MONTERIA","MZ 55 LOTE 25 VILLACIELO","3024695004","FEMENINO","Asesor","Visita Barrios","6","2022-01-29","MAñANA","h 7176","6");
INSERT INTO estudiantes VALUES("20","1003048099","2003-01-08","ALDAIR","CORONADO PADILLA","MONTERIA","MZ 80 LOTE 03 CANTACLARO","3007149647","MASCULINO","Ninguno","Visita Barrios","6","2022-01-29","MAñANA","h 7195","4");
INSERT INTO estudiantes VALUES("21","1067857852","2022-01-29","JENIFER","YEPES MENDOZA","MONTERIA","MZ 42 LOTE 5 LA PALMA","3113326077","FEMENINO","Ninguno","Visita Barrios","6","2022-01-29","MAñANA","h 7027","7");
INSERT INTO estudiantes VALUES("22","1003450679","1997-04-18","ORNEIDA AIDETH","ESPITIA ARGEL","MONTERIA","EL CAMPANO CASA 25","3215001437","FEMENINO","Asesor","Visita Barrios","6","2022-01-29","MAñANA","h7152","7");
INSERT INTO estudiantes VALUES("23","50930397","1973-03-20","JENNIS DE JESUS","MOGROVEJO LORA","MONTERIA","CLL 3 KR 2-21 SANTA LUCIA","3163151096","FEMENINO","Ninguno","Visita Barrios","6","2022-01-29","MAñANA","H7024","7");
INSERT INTO estudiantes VALUES("24","1064311468","2022-01-29","MARIA CLARA","MIRANDA SANCHEZ","MONTERIA","MZ B LOTE 14 EL POBLADO","3106675714","FEMENINO","Ninguno","Visita Barrios","1","2022-01-29","MAñANA","H 7131","7");
INSERT INTO estudiantes VALUES("25","1067870408","2001-11-01","FELIX JAVIER","MONTES SAENZ","MONTERIA","VILLACIELO","3147255314","MASCULINO","Ninguno","Visita Barrios","6","2022-01-29","MAñANA","h7738","4");
INSERT INTO estudiantes VALUES("26","1001035417","1998-08-25","YULIS ADELA","ALEAN QUIÑONEZ","MONTERIA","MZ I BQ 7 APTO 308 LOS RECUERDOS","3162549861","FEMENINO","Ninguno","Visita Barrios","6","2022-01-29","TARDE","H7131","7");
INSERT INTO estudiantes VALUES("27","1062432057","2022-01-29","KEREN","NEGRETE AGRESOT","MONTERIA","CLL 27 KRA 19 DORADO","3146740750","MASCULINO","Ninguno","Visita Barrios","1","2022-01-29","MAñANA","H7737","7");
INSERT INTO estudiantes VALUES("28","1067933476","1994-09-07","MERARI","NEGRETE AGRESOT","MONTERIA","DORADO","3216613636","FEMENINO","Asesor","Visita Barrios","6","2022-01-29","TARDE","G 6789","6");
INSERT INTO estudiantes VALUES("29","1067962940","1998-11-21","DANIELA","VITOLA LOPEZ","MONTERIA","CLL 1A N° 28-11 LA CANDELARIA","3106394472","FEMENINO","Ninguno","Visita Barrios","6","2022-01-29","TARDE","H7022","4");
INSERT INTO estudiantes VALUES("30","1041259943","2005-06-20","CARLOS ANDRES","HOYOS YUGO","MONTERIA","MZ 7 LOTE 3 LOS COLORES","3022165867","MASCULINO","Asesor","Visita Barrios","6","2022-01-29","TARDE","H7199","4");
INSERT INTO estudiantes VALUES("31","1003001914","2002-05-04","DANNA PAOLA","MUÑOZ LOPEZ","MONTERIA","MZ 38 LOTE 2 CANTACLARO","3005622508","FEMENINO","Ninguno","Visita Barrios","6","2022-01-29","TARDE","H7147","7");
INSERT INTO estudiantes VALUES("32","1062424688","2003-10-25","ISAURA VANESSA","AGAMEZ RAMIREZ","MONTERIA","MZ J BQ 13 APTO 101 LOS RECUERDOS","3003416476","FEMENINO","Asesor","Visita Barrios","6","2022-01-29","TARDE","H7165","7");
INSERT INTO estudiantes VALUES("33","1003001019","2002-04-16","DIANA KARINA","RIVERA ORTEGA","MONTERIA","MZ 61 LOTE 10 SAN JERONIMO","3128341017","FEMENINO","Asesor","Visita Barrios","6","2022-01-29","TARDE","H 7724","7");
INSERT INTO estudiantes VALUES("34","1062424507","2003-11-03","LUISA FERNANDA","MORENO MARTINEZ","MONTERIA","MZ 69 LOTE 09 NISPERO","3233965225","FEMENINO","Ninguno","Visita Barrios","6","2022-01-29","TARDE","H7148","7");
INSERT INTO estudiantes VALUES("35","1067878751","2004-05-14","ANA CAROLINA","SAENZ ACEVEDO","MONTERIA","MZ 99 LOTE 1 CANTACLARO","3003124060","FEMENINO","Ninguno","Visita Barrios","6","2022-01-29","TARDE","H7181","4");
INSERT INTO estudiantes VALUES("36","1068661120","2001-01-12","GUADALUPE","ARGUMEDO PACHECO","MONTERIA","CLL 29 CRA 17 DORADO","3105353000","FEMENINO","Ninguno","Visita Barrios","6","2022-01-29","TARDE","H7158","6");
INSERT INTO estudiantes VALUES("37","1003435554","2000-11-16","MELISSA ANDREA","CUELLO ORTEGA","MONTERIA","CLL 29 CRA 17 W DORADO","3002369015","FEMENINO","Asesor","Visita Barrios","6","2022-01-29","TARDE","H7157","6");
INSERT INTO estudiantes VALUES("38","1067853397","1986-06-30","ELIZABETH","VELASQUEZ RAMOS","MONTERIA","MZ C LOTE 8 LOS RECUERDOS","3103977999","FEMENINO","Ninguno","Visita Barrios","6","2022-01-29","TARDE","H7739","4");
INSERT INTO estudiantes VALUES("39","1065010730","1997-03-10","MARIA SUSANA","LEON AGUILAR","MONTERIA","CLL 126 N° 11 -40 GARZONES","3126597011","FEMENINO","Ninguno","Visita Barrios","6","2022-01-29","TARDE","H7030","4");



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
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4;

INSERT INTO matricula VALUES("40","24","17","1","312000.0000","304000.0000","-5000.00","24","1","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("41","23","17","1","312000.0000","299000.0000","0.00","24","1","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("42","16","17","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("43","22","17","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("44","20","17","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("45","21","17","1","312000.0000","299000.0000","0.00","24","1","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("46","15","17","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("47","25","17","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("48","18","17","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("49","19","17","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("50","17","17","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("51","14","17","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("52","38","18","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("53","37","18","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("54","28","18","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("55","29","18","1","312000.0000","299000.0000","0.00","24","1","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("56","30","18","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("57","31","18","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("58","32","18","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("59","33","18","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("60","34","18","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("61","36","18","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("62","35","18","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("63","26","18","1","312000.0000","312000.0000","0.00","24","0","13000.0000","2022-01-29");
INSERT INTO matricula VALUES("64","27","18","1","312000.0000","312000.0000","0.00","24","1","13000.0000","2022-01-29");



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
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=utf8mb4;

INSERT INTO pagos VALUES("214","47","14","25000.0000","2022-01-29");
INSERT INTO pagos VALUES("215","46","14","12000.0000","2022-01-29");
INSERT INTO pagos VALUES("216","45","18","13000.0000","2022-01-29");
INSERT INTO pagos VALUES("217","44","14","22000.0000","2022-01-29");
INSERT INTO pagos VALUES("218","43","14","22000.0000","2022-01-29");
INSERT INTO pagos VALUES("219","41","18","13000.0000","2022-01-29");
INSERT INTO pagos VALUES("220","40","14","22000.0000","2022-01-29");
INSERT INTO pagos VALUES("221","40","18","8000.0000","2022-01-29");
INSERT INTO pagos VALUES("222","50","14","22000.0000","2022-01-29");
INSERT INTO pagos VALUES("223","51","14","22000.0000","2022-01-29");
INSERT INTO pagos VALUES("224","52","14","25000.0000","2022-01-29");
INSERT INTO pagos VALUES("225","53","14","15000.0000","2022-01-29");
INSERT INTO pagos VALUES("226","54","14","10000.0000","2022-01-29");
INSERT INTO pagos VALUES("227","55","18","13000.0000","2022-01-29");
INSERT INTO pagos VALUES("228","56","14","5000.0000","2022-01-29");
INSERT INTO pagos VALUES("229","58","14","22000.0000","2022-01-29");
INSERT INTO pagos VALUES("230","59","14","22000.0000","2022-01-29");
INSERT INTO pagos VALUES("231","61","14","15000.0000","2022-01-29");
INSERT INTO pagos VALUES("232","62","14","22000.0000","2022-01-29");
INSERT INTO pagos VALUES("233","63","14","22000.0000","2022-01-29");
INSERT INTO pagos VALUES("234","64","14","22000.0000","2022-01-29");



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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

INSERT INTO pensum VALUES("11","16","1","24","312000.0000");
INSERT INTO pensum VALUES("12","16","2","24","348000.0000");
INSERT INTO pensum VALUES("13","16","3","24","384000.0000");
INSERT INTO pensum VALUES("14","17","1","24","312000.0000");
INSERT INTO pensum VALUES("15","17","2","24","348000.0000");
INSERT INTO pensum VALUES("16","17","3","28","448000.0000");
INSERT INTO pensum VALUES("17","18","1","24","312000.0000");
INSERT INTO pensum VALUES("18","18","2","24","348000.0000");
INSERT INTO pensum VALUES("19","18","3","24","384000.0000");



CREATE TABLE `programa` (
  `id_programa` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_programa` varchar(50) NOT NULL,
  PRIMARY KEY (`id_programa`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

INSERT INTO programa VALUES("16","T.L ATENCION A LA PRIMERA INFANCIA");
INSERT INTO programa VALUES("17","T.L EN MERCADERISTA E IMPULSADOR");
INSERT INTO programa VALUES("18","T.L EN AUXILIAR EN ARCHIVO Y REGISTRO");



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


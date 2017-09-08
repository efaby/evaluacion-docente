-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.9-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema evaluacion
--

CREATE DATABASE IF NOT EXISTS evaluacion;
USE evaluacion;

--
-- Definition of table `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE `curso` (
  `curso_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(512) DEFAULT NULL,
  `especialidad_id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`curso_id`),
  KEY `fk_curso_especialidad1` (`especialidad_id`),
  CONSTRAINT `fk_curso_especialidad1` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidad` (`especialidad_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `curso`
--

/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`curso_id`,`nombre`,`descripcion`,`especialidad_id`,`estado`) VALUES 
 (1,'Primero','Primero',1,1),
 (2,'Juan11','Pedro',1,0),
 (3,'Curso 3','sls',1,0),
 (4,'aa','bb',2,0),
 (5,'sakksa','ldsldsl',1,0),
 (6,'Segundo','Segundo',1,1),
 (7,'dslsdl','dsldsl',1,0),
 (9,'dsllds','sdñds',1,0),
 (10,'Tercero','Tercero',1,1),
 (11,'Cuarto','Cuarto',1,1);
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;


--
-- Definition of table `especialidad`
--

DROP TABLE IF EXISTS `especialidad`;
CREATE TABLE `especialidad` (
  `especialidad_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `seccion_id` int(11) NOT NULL,
  `descripcion` varchar(512) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`especialidad_id`),
  KEY `fk_especialidad_seccion1` (`seccion_id`),
  CONSTRAINT `fk_especialidad_seccion1` FOREIGN KEY (`seccion_id`) REFERENCES `seccion` (`seccion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `especialidad`
--

/*!40000 ALTER TABLE `especialidad` DISABLE KEYS */;
INSERT INTO `especialidad` (`especialidad_id`,`nombre`,`seccion_id`,`descripcion`,`estado`) VALUES 
 (1,'Informatica',1,'Informatica',1),
 (2,'Contabilidad',1,'Contabilidad',1),
 (3,'laslls',1,'sdllds',0),
 (4,'epsepss',1,'slslls',0);
/*!40000 ALTER TABLE `especialidad` ENABLE KEYS */;


--
-- Definition of table `evaluacion`
--

DROP TABLE IF EXISTS `evaluacion`;
CREATE TABLE `evaluacion` (
  `evaluacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(1024) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`evaluacion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluacion`
--

/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
INSERT INTO `evaluacion` (`evaluacion_id`,`nombre`,`descripcion`,`estado`) VALUES 
 (1,'Evaluación 11','Evaluación 11',1),
 (2,'Evaluación 2','Evaluación 2',0);
/*!40000 ALTER TABLE `evaluacion` ENABLE KEYS */;


--
-- Definition of table `evaluacion_pregunta`
--

DROP TABLE IF EXISTS `evaluacion_pregunta`;
CREATE TABLE `evaluacion_pregunta` (
  `evaluacion_pregunta_id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluacion_id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  PRIMARY KEY (`evaluacion_pregunta_id`),
  KEY `fk_evaluacion_pregunta_evaluacion1` (`evaluacion_id`),
  KEY `fk_evaluacion_pregunta_pregunta1` (`pregunta_id`),
  CONSTRAINT `fk_evaluacion_pregunta_evaluacion1` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluacion` (`evaluacion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_evaluacion_pregunta_pregunta1` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`pregunta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluacion_pregunta`
--

/*!40000 ALTER TABLE `evaluacion_pregunta` DISABLE KEYS */;
INSERT INTO `evaluacion_pregunta` (`evaluacion_pregunta_id`,`evaluacion_id`,`pregunta_id`) VALUES 
 (1,1,1),
 (2,1,3),
 (3,1,2),
 (4,1,4),
 (5,1,5),
 (6,1,6),
 (7,1,7),
 (8,1,8),
 (9,1,9),
 (10,1,10),
 (11,1,11),
 (12,1,12),
 (13,1,13),
 (14,1,14),
 (15,1,15),
 (16,1,16),
 (17,1,17);
/*!40000 ALTER TABLE `evaluacion_pregunta` ENABLE KEYS */;


--
-- Definition of table `materia`
--

DROP TABLE IF EXISTS `materia`;
CREATE TABLE `materia` (
  `materia_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(512) DEFAULT NULL,
  `curso_id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`materia_id`),
  KEY `fk_materia_curso1` (`curso_id`),
  CONSTRAINT `fk_materia_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materia`
--

/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` (`materia_id`,`nombre`,`descripcion`,`curso_id`,`estado`) VALUES 
 (1,'Materia','sdlsd',1,0),
 (2,'Matematicas','Matematicas',1,1),
 (3,'aslas','laslsa',1,0),
 (4,'Fundamentos Inf','Fundamentos Inf',1,1),
 (5,'Materia 3','ajaja',1,0),
 (6,'Mamr','111',1,0),
 (7,'Fisica','Fisica',1,1),
 (8,'Didactica','Didactica',1,1);
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;


--
-- Definition of table `materia_periodo`
--

DROP TABLE IF EXISTS `materia_periodo`;
CREATE TABLE `materia_periodo` (
  `materia_periodo_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_registro` date NOT NULL,
  `materia_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `docente_id` int(11) NOT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`materia_periodo_id`),
  KEY `fk_matricula_materia1` (`materia_id`),
  KEY `fk_matricula_periodo1` (`periodo_id`),
  KEY `fk_matricula_usuario1_idx` (`docente_id`),
  CONSTRAINT `fk_matricula_materia1` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`materia_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_periodo1` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`periodo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_usuario1` FOREIGN KEY (`docente_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materia_periodo`
--

/*!40000 ALTER TABLE `materia_periodo` DISABLE KEYS */;
INSERT INTO `materia_periodo` (`materia_periodo_id`,`fecha_registro`,`materia_id`,`periodo_id`,`docente_id`,`estado`) VALUES 
 (27,'2017-07-28',2,1,2,0),
 (30,'2017-07-29',4,1,2,0),
 (31,'2017-07-31',2,5,2,1),
 (32,'2017-07-31',7,5,2,1),
 (33,'2017-08-23',4,5,2,1),
 (34,'2017-08-23',8,5,2,1);
/*!40000 ALTER TABLE `materia_periodo` ENABLE KEYS */;


--
-- Definition of table `matricula`
--

DROP TABLE IF EXISTS `matricula`;
CREATE TABLE `matricula` (
  `matricula_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `materia_periodo_id` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  PRIMARY KEY (`matricula_id`),
  KEY `fk_matricula_estudiante_usuario1_idx` (`usuario_id`),
  KEY `fk_matricula_materia_periodo1_idx` (`materia_periodo_id`),
  CONSTRAINT `fk_matricula_estudiante_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_materia_periodo1` FOREIGN KEY (`materia_periodo_id`) REFERENCES `materia_periodo` (`materia_periodo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matricula`
--

/*!40000 ALTER TABLE `matricula` DISABLE KEYS */;
INSERT INTO `matricula` (`matricula_id`,`usuario_id`,`materia_periodo_id`,`fecha_registro`) VALUES 
 (1,3,31,'2017-08-27'),
 (2,3,33,'2017-08-27'),
 (3,4,31,'2017-09-05'),
 (4,4,32,'2017-09-05');
/*!40000 ALTER TABLE `matricula` ENABLE KEYS */;


--
-- Definition of table `matricula_evaluacion`
--

DROP TABLE IF EXISTS `matricula_evaluacion`;
CREATE TABLE `matricula_evaluacion` (
  `matricula_evaluacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluacion_id` int(11) NOT NULL,
  `matricula_id` int(11) NOT NULL,
  `fecha_evaluacion` date DEFAULT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`matricula_evaluacion_id`),
  KEY `fk_matricula_evaluacion_evaluacion1` (`evaluacion_id`),
  KEY `fk_matricula_evaluacion_matricula1_idx` (`matricula_id`),
  CONSTRAINT `fk_matricula_evaluacion_evaluacion1` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluacion` (`evaluacion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_evaluacion_matricula1` FOREIGN KEY (`matricula_id`) REFERENCES `matricula` (`matricula_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matricula_evaluacion`
--

/*!40000 ALTER TABLE `matricula_evaluacion` DISABLE KEYS */;
INSERT INTO `matricula_evaluacion` (`matricula_evaluacion_id`,`evaluacion_id`,`matricula_id`,`fecha_evaluacion`,`activo`) VALUES 
 (1,1,1,NULL,1),
 (2,1,2,'2017-08-30',1),
 (3,1,3,'2017-09-05',1),
 (4,1,4,NULL,1);
/*!40000 ALTER TABLE `matricula_evaluacion` ENABLE KEYS */;


--
-- Definition of table `periodo`
--

DROP TABLE IF EXISTS `periodo`;
CREATE TABLE `periodo` (
  `periodo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(512) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`periodo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periodo`
--

/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
INSERT INTO `periodo` (`periodo_id`,`nombre`,`descripcion`,`estado`) VALUES 
 (1,'Prueba','sdlsldaaqwdsññsd',0),
 (5,'Abril 2017- Septiembre 2017','sdlsdsd.sd.sd',1);
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;


--
-- Definition of table `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
CREATE TABLE `pregunta` (
  `pregunta_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(512) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pregunta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pregunta`
--

/*!40000 ALTER TABLE `pregunta` DISABLE KEYS */;
INSERT INTO `pregunta` (`pregunta_id`,`nombre`,`descripcion`,`estado`) VALUES 
 (1,'Informa con claridaad el plan del curso (Programa, Objetivos, Bibliografía, Tutorias).','Informa con claridaad el plan del curso (Programa, Objetivos, Bibliografía, Tutorias).',1),
 (2,'Sus clases se ajustan a lo previsto en el plan de asignatura.','Sus clases se ajustan a lo previsto en el plan de asignatura.',1),
 (3,'Informa con claridad de los criterios y el método de evaluación.','Informa con claridad de los criterios y el método de evaluación.',1),
 (4,'Cumple los horarios de tutoria.','Cumple los horarios de tutoria.',1),
 (5,'Se muestra accesible y está dispuesto a atender las consultas de los estudiantes.','Se muestra accesible y está dispuesto a atender las consultas de los estudiantes.',1),
 (6,'Demuestra dominar la materia impartida.','Demuestra dominar la materia impartida.',1),
 (7,'Actualiza los contenidos de las asignaturas.','Actualiza los contenidos de las asignaturas.',1),
 (8,'Prepara, organiza y estructura bien las clases.','Prepara, organiza y estructura bien las clases.',1),
 (9,'Atiende y responde con claridad las consultas realizadas en clase.','Atiende y responde con claridad las consultas realizadas en clase.',1),
 (10,'Es respetuoso con los alumnos.','Es respetuoso con los alumnos.',1),
 (11,'Tiene en cuenta trabajos, intervenciones en clase u otras actividades para la evaluación.','Tiene en cuenta trabajos, intervenciones en clase u otras actividades para la evaluación.',1),
 (12,'Relaciona los contenidos del programa entre si y con los de otras materias.','Relaciona los contenidos del programa entre si y con los de otras materias.',1),
 (13,'Realiza suficientes prácticas y casos para la correcta comprensión de la asignatura.','Realiza suficientes prácticas y casos para la correcta comprensión de la asignatura.',1),
 (14,'Motiva la participación critica y activa de los alumnos en el desarrollo de la clase.','Motiva la participación critica y activa de los alumnos en el desarrollo de la clase.',1),
 (15,'Los materiales de estudio (Libros, Textos y Otros) indicados por el profesor son útiles.','Los materiales de estudio (Libros, Textos y Otros) indicados por el profesor son útiles.',1),
 (16,'El docente falta constantemente a clases.','El docente falta constantemente a clases.',1),
 (17,'En general, estoy satisfecho con la labor de este profesor.','En general, estoy satisfecho con la labor de este profesor.',1);
/*!40000 ALTER TABLE `pregunta` ENABLE KEYS */;


--
-- Definition of table `respuesta`
--

DROP TABLE IF EXISTS `respuesta`;
CREATE TABLE `respuesta` (
  `respuesta_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `valor` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`respuesta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `respuesta`
--

/*!40000 ALTER TABLE `respuesta` DISABLE KEYS */;
INSERT INTO `respuesta` (`respuesta_id`,`nombre`,`valor`,`estado`) VALUES 
 (1,'Nunca',1,1),
 (2,'En Desacuerdo',2,1),
 (3,'De Acuerdo',3,1),
 (4,'Totalmente de Acuerdo',4,1);
/*!40000 ALTER TABLE `respuesta` ENABLE KEYS */;


--
-- Definition of table `respuesta_evaluacion`
--

DROP TABLE IF EXISTS `respuesta_evaluacion`;
CREATE TABLE `respuesta_evaluacion` (
  `respuesta_evaluacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` int(11) NOT NULL,
  `respuesta_id` int(11) NOT NULL,
  `evaluacion_pregunta_id` int(11) NOT NULL,
  `matricula_evaluacion_id` int(11) NOT NULL,
  PRIMARY KEY (`respuesta_evaluacion_id`),
  KEY `fk_respuesta_evaluacion_respuesta1` (`respuesta_id`),
  KEY `fk_respuesta_evaluacion_evaluacion_pregunta1_idx` (`evaluacion_pregunta_id`),
  CONSTRAINT `fk_respuesta_evaluacion_evaluacion_pregunta1` FOREIGN KEY (`evaluacion_pregunta_id`) REFERENCES `evaluacion_pregunta` (`evaluacion_pregunta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_respuesta_evaluacion_respuesta1` FOREIGN KEY (`respuesta_id`) REFERENCES `respuesta` (`respuesta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `respuesta_evaluacion`
--

/*!40000 ALTER TABLE `respuesta_evaluacion` DISABLE KEYS */;
INSERT INTO `respuesta_evaluacion` (`respuesta_evaluacion_id`,`valor`,`respuesta_id`,`evaluacion_pregunta_id`,`matricula_evaluacion_id`) VALUES 
 (3,1,1,1,2),
 (4,3,3,2,2),
 (5,2,2,1,3),
 (6,3,3,2,3),
 (7,2,2,3,3),
 (8,4,4,4,3),
 (9,4,4,5,3),
 (10,4,4,6,3),
 (11,4,4,7,3),
 (12,3,3,8,3),
 (13,3,3,9,3),
 (14,3,3,10,3),
 (15,3,3,11,3),
 (16,3,3,12,3),
 (17,3,3,13,3),
 (18,3,3,14,3),
 (19,3,3,15,3),
 (20,3,3,16,3),
 (21,3,3,17,3);
/*!40000 ALTER TABLE `respuesta_evaluacion` ENABLE KEYS */;


--
-- Definition of table `seccion`
--

DROP TABLE IF EXISTS `seccion`;
CREATE TABLE `seccion` (
  `seccion_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(512) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`seccion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seccion`
--

/*!40000 ALTER TABLE `seccion` DISABLE KEYS */;
INSERT INTO `seccion` (`seccion_id`,`nombre`,`descripcion`,`estado`) VALUES 
 (1,'Diurna','Diurna',1),
 (2,'Nocturna','Nocturna',1),
 (3,'Sección 3','seccion 2',0),
 (4,'ksksaka','lals',0),
 (5,'secicon','aslasl',0);
/*!40000 ALTER TABLE `seccion` ENABLE KEYS */;


--
-- Definition of table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE `tipo_usuario` (
  `tipo_usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tipo_usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_usuario`
--

/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` (`tipo_usuario_id`,`nombre`,`estado`) VALUES 
 (1,'Administrador',1),
 (2,'Docente',1),
 (3,'Estudiante',1);
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(10) NOT NULL,
  `nombres` varchar(128) NOT NULL,
  `apellidos` varchar(128) NOT NULL,
  `password` varchar(45) NOT NULL,
  `direccion` varchar(512) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `celular` varchar(10) DEFAULT NULL,
  `email` varchar(512) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `tipo_usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `fk_usuario_tipo_usuario` (`tipo_usuario_id`),
  CONSTRAINT `fk_usuario_tipo_usuario` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipo_usuario` (`tipo_usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`usuario_id`,`cedula`,`nombres`,`apellidos`,`password`,`direccion`,`telefono`,`celular`,`email`,`estado`,`tipo_usuario_id`) VALUES 
 (1,'0600034201','Pedro','Padilla','e10adc3949ba59abbe56e057f20f883e','ssk','388383883',NULL,'b@g.com',1,1),
 (2,'0602567802','Juan','Perez','e10adc3949ba59abbe56e057f20f883e','dslld','929929299',NULL,'a@hotmail.com',1,2),
 (3,'0600034202','Aleja','Valle','e10adc3949ba59abbe56e057f20f883e','sl','032940026','0994006084','c@hotmail.com',1,3),
 (4,'0603718578','Fabian','Villa','202cb962ac59075b964b07152d234b70','la paz','111111111','1111111111','la@g.com',1,3);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

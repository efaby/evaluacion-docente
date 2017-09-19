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
-- Definition of table `docente_evaluacion`
--

DROP TABLE IF EXISTS `docente_evaluacion`;
CREATE TABLE `docente_evaluacion` (
  `docente_evaluacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `administrativo_id` int(11) NOT NULL,
  `docente_id` int(11) NOT NULL,
  `evaluacion_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `fecha_evaluacion` date DEFAULT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`docente_evaluacion_id`),
  KEY `fk_docente_evaluacion_1_idx` (`administrativo_id`),
  KEY `fk_docente_evaluacion_2_idx` (`docente_id`),
  KEY `fk_docente_evaluacion_3_idx` (`evaluacion_id`),
  KEY `fk_docente_evaluacion_4_idx` (`periodo_id`),
  CONSTRAINT `fk_docente_evaluacion_1` FOREIGN KEY (`administrativo_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_docente_evaluacion_2` FOREIGN KEY (`docente_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_docente_evaluacion_3` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluacion` (`evaluacion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_docente_evaluacion_4` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`periodo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `docente_evaluacion`
--

/*!40000 ALTER TABLE `docente_evaluacion` DISABLE KEYS */;
INSERT INTO `docente_evaluacion` (`docente_evaluacion_id`,`administrativo_id`,`docente_id`,`evaluacion_id`,`periodo_id`,`fecha_evaluacion`,`activo`) VALUES 
 (10,5,2,3,5,'2017-09-17',1);
/*!40000 ALTER TABLE `docente_evaluacion` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluacion`
--

/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
INSERT INTO `evaluacion` (`evaluacion_id`,`nombre`,`descripcion`,`estado`) VALUES 
 (1,'Evaluación 11','Evaluación 11',1),
 (2,'Evaluación 2','Evaluación 2',0),
 (3,'Evaluación Docente','Evaluacion Docente',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

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
 (17,1,17),
 (18,3,18),
 (19,3,19),
 (20,3,20),
 (21,3,21),
 (22,3,22),
 (23,3,23),
 (24,3,24);
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
 (1,1,1,'2017-09-07',1),
 (2,1,2,'2017-09-07',1),
 (3,1,3,'2017-09-07',1),
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
  `unica` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pregunta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pregunta`
--

/*!40000 ALTER TABLE `pregunta` DISABLE KEYS */;
INSERT INTO `pregunta` (`pregunta_id`,`nombre`,`descripcion`,`estado`,`unica`) VALUES 
 (1,'Informa con claridaad el plan del curso (Programa, Objetivos, Bibliografía, Tutorias).','Informa con claridaad el plan del curso (Programa, Objetivos, Bibliografía, Tutorias).',1,0),
 (2,'Sus clases se ajustan a lo previsto en el plan de asignatura.','Sus clases se ajustan a lo previsto en el plan de asignatura.',1,0),
 (3,'Informa con claridad de los criterios y el método de evaluación.','Informa con claridad de los criterios y el método de evaluación.',1,0),
 (4,'Cumple los horarios de tutoria.','Cumple los horarios de tutoria.',1,0),
 (5,'Se muestra accesible y está dispuesto a atender las consultas de los estudiantes.','Se muestra accesible y está dispuesto a atender las consultas de los estudiantes.',1,0),
 (6,'Demuestra dominar la materia impartida.','Demuestra dominar la materia impartida.',1,0),
 (7,'Actualiza los contenidos de las asignaturas.','Actualiza los contenidos de las asignaturas.',1,0),
 (8,'Prepara, organiza y estructura bien las clases.','Prepara, organiza y estructura bien las clases.',1,0),
 (9,'Atiende y responde con claridad las consultas realizadas en clase.','Atiende y responde con claridad las consultas realizadas en clase.',1,0),
 (10,'Es respetuoso con los alumnos.','Es respetuoso con los alumnos.',1,0),
 (11,'Tiene en cuenta trabajos, intervenciones en clase u otras actividades para la evaluación.','Tiene en cuenta trabajos, intervenciones en clase u otras actividades para la evaluación.',1,0),
 (12,'Relaciona los contenidos del programa entre si y con los de otras materias.','Relaciona los contenidos del programa entre si y con los de otras materias.',1,0),
 (13,'Realiza suficientes prácticas y casos para la correcta comprensión de la asignatura.','Realiza suficientes prácticas y casos para la correcta comprensión de la asignatura.',1,0),
 (14,'Motiva la participación critica y activa de los alumnos en el desarrollo de la clase.','Motiva la participación critica y activa de los alumnos en el desarrollo de la clase.',1,0),
 (15,'Los materiales de estudio (Libros, Textos y Otros) indicados por el profesor son útiles.','Los materiales de estudio (Libros, Textos y Otros) indicados por el profesor son útiles.',1,0),
 (16,'El docente falta constantemente a clases.','El docente falta constantemente a clases.',1,1),
 (17,'En general, estoy satisfecho con la labor de este profesor.','En general, estoy satisfecho con la labor de este profesor.',1,0),
 (18,'Aplicación de Didáctica Educativa','Aplicación de Didáctica Educativa',1,0),
 (19,'Interacción con los alumnos','Interacción con los alumnos',1,0),
 (20,'Tratamiento de Conflictos','Tratamiento de Conflictos',1,0),
 (21,'Relación Interpersonal con la Institución','Relación Interpersonal con la Institución',1,0),
 (22,'Relación Interpersonal con la Administración','Relación Interpersonal con la Administración',1,0),
 (23,'Aporte de Vinculación con la Colectividad','Aporte de Vinculación con la Colectividad',1,0),
 (24,'Elaboración o participación en proyectos','Elaboración o participación en proyectos',1,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `respuesta`
--

/*!40000 ALTER TABLE `respuesta` DISABLE KEYS */;
INSERT INTO `respuesta` (`respuesta_id`,`nombre`,`valor`,`estado`) VALUES 
 (1,'Nunca',1,1),
 (2,'En Desacuerdo',2,1),
 (3,'De Acuerdo',3,1),
 (4,'Totalmente de Acuerdo',4,1),
 (5,'Si',1,1),
 (6,'No',0,1);
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
  `matricula_evaluacion_id` int(11) DEFAULT NULL,
  `docente_evaluacion_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`respuesta_evaluacion_id`),
  KEY `fk_respuesta_evaluacion_respuesta1` (`respuesta_id`),
  KEY `fk_respuesta_evaluacion_evaluacion_pregunta1_idx` (`evaluacion_pregunta_id`),
  CONSTRAINT `fk_respuesta_evaluacion_evaluacion_pregunta1` FOREIGN KEY (`evaluacion_pregunta_id`) REFERENCES `evaluacion_pregunta` (`evaluacion_pregunta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_respuesta_evaluacion_respuesta1` FOREIGN KEY (`respuesta_id`) REFERENCES `respuesta` (`respuesta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `respuesta_evaluacion`
--

/*!40000 ALTER TABLE `respuesta_evaluacion` DISABLE KEYS */;
INSERT INTO `respuesta_evaluacion` (`respuesta_evaluacion_id`,`valor`,`respuesta_id`,`evaluacion_pregunta_id`,`matricula_evaluacion_id`,`docente_evaluacion_id`) VALUES 
 (22,2,2,1,2,NULL),
 (23,3,3,2,2,NULL),
 (24,4,4,3,2,NULL),
 (25,3,3,4,2,NULL),
 (26,3,3,5,2,NULL),
 (27,3,3,6,2,NULL),
 (28,2,2,7,2,NULL),
 (29,3,3,8,2,NULL),
 (30,4,4,9,2,NULL),
 (31,1,1,10,2,NULL),
 (32,3,3,11,2,NULL),
 (33,2,2,12,2,NULL),
 (34,4,4,13,2,NULL),
 (35,2,2,14,2,NULL),
 (36,3,3,15,2,NULL),
 (37,2,2,16,2,NULL),
 (38,1,1,17,2,NULL),
 (39,2,2,1,1,NULL),
 (40,3,3,2,1,NULL),
 (41,2,2,3,1,NULL),
 (42,4,4,4,1,NULL),
 (43,3,3,5,1,NULL),
 (44,2,2,6,1,NULL),
 (45,3,3,7,1,NULL),
 (46,1,1,8,1,NULL),
 (47,4,4,9,1,NULL),
 (48,1,1,10,1,NULL),
 (49,4,4,11,1,NULL),
 (50,2,2,12,1,NULL),
 (51,3,3,13,1,NULL),
 (52,4,4,14,1,NULL),
 (53,3,3,15,1,NULL),
 (54,3,3,16,1,NULL),
 (55,2,2,17,1,NULL),
 (56,2,2,1,3,NULL),
 (57,3,3,2,3,NULL),
 (58,4,4,3,3,NULL),
 (59,4,4,4,3,NULL),
 (60,3,3,5,3,NULL),
 (61,3,3,6,3,NULL),
 (62,2,2,7,3,NULL),
 (63,3,3,8,3,NULL),
 (64,3,3,9,3,NULL),
 (65,4,4,10,3,NULL),
 (66,4,4,11,3,NULL),
 (67,1,1,12,3,NULL),
 (68,2,2,13,3,NULL),
 (69,3,3,14,3,NULL),
 (70,2,2,15,3,NULL),
 (71,2,2,16,3,NULL),
 (72,3,3,17,3,NULL),
 (73,1,5,18,NULL,10),
 (74,1,5,19,NULL,10),
 (75,1,5,20,NULL,10),
 (76,1,5,21,NULL,10),
 (77,0,6,22,NULL,10),
 (78,0,6,23,NULL,10),
 (79,0,6,24,NULL,10);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_usuario`
--

/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` (`tipo_usuario_id`,`nombre`,`estado`) VALUES 
 (1,'Administrador',1),
 (2,'Docente',1),
 (3,'Estudiante',1),
 (4,'Administrativo',1);
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
  `especialidad_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `fk_usuario_tipo_usuario` (`tipo_usuario_id`),
  CONSTRAINT `fk_usuario_tipo_usuario` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipo_usuario` (`tipo_usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`usuario_id`,`cedula`,`nombres`,`apellidos`,`password`,`direccion`,`telefono`,`celular`,`email`,`estado`,`tipo_usuario_id`,`especialidad_id`) VALUES 
 (1,'0600034201','Pedro','Padilla','e10adc3949ba59abbe56e057f20f883e','ssk','388383883',NULL,'b@g.com',1,1,NULL),
 (2,'0602567802','Juan','Perez','e10adc3949ba59abbe56e057f20f883e','dslld','929929299',NULL,'a@hotmail.com',1,2,1),
 (3,'0600034202','Aleja','Valle','e10adc3949ba59abbe56e057f20f883e','sl','032940026','0994006084','c@hotmail.com',1,3,NULL),
 (4,'0603718578','Fabian','Villa','e10adc3949ba59abbe56e057f20f883e','la paz','111111111','1111111111','la@g.com',1,3,NULL),
 (5,'0603108770','Jane','Concha','202cb962ac59075b964b07152d234b70','soaoas','032883288','0282383288','lajane2020@hotmail.com',1,4,NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

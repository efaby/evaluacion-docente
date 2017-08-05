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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `curso`
--

/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`curso_id`,`nombre`,`descripcion`,`especialidad_id`,`estado`) VALUES 
 (1,'Curso 1','el curso',2,1),
 (2,'Juan11','Pedro',1,0),
 (3,'Curso 3','sls',1,0),
 (4,'aa','bb',2,0),
 (5,'sakksa','ldsldsl',1,0),
 (6,'Curso2','otro curso22',1,1),
 (7,'dslsdl','dsldsl',1,0),
 (9,'dsllds','sdñds',1,0),
 (10,'sdkkds11333','sd',1,1);
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
 (1,'Especialidad 1',1,'eslfk',1),
 (2,'Especialidad 2',2,'Esccc',1),
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluacion`
--

/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluacion_pregunta`
--

/*!40000 ALTER TABLE `evaluacion_pregunta` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materia`
--

/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` (`materia_id`,`nombre`,`descripcion`,`curso_id`,`estado`) VALUES 
 (1,'Materia','sdlsd',1,0),
 (2,'Materia 1','Las materias',1,1),
 (3,'aslas','laslsa',1,0),
 (4,'Materia 2','Las materias 2',1,1),
 (5,'Materia 3','ajaja',1,0),
 (6,'Mamr','111',1,0),
 (7,'Materia 3','saññas',1,1);
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
  PRIMARY KEY (`materia_periodo_id`),
  KEY `fk_matricula_materia1` (`materia_id`),
  KEY `fk_matricula_periodo1` (`periodo_id`),
  KEY `fk_matricula_usuario1_idx` (`docente_id`),
  CONSTRAINT `fk_matricula_materia1` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`materia_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_periodo1` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`periodo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_usuario1` FOREIGN KEY (`docente_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materia_periodo`
--

/*!40000 ALTER TABLE `materia_periodo` DISABLE KEYS */;
INSERT INTO `materia_periodo` (`materia_periodo_id`,`fecha_registro`,`materia_id`,`periodo_id`,`docente_id`) VALUES 
 (27,'2017-07-28',2,1,2),
 (30,'2017-07-29',4,1,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matricula`
--

/*!40000 ALTER TABLE `matricula` DISABLE KEYS */;
INSERT INTO `matricula` (`matricula_id`,`usuario_id`,`materia_periodo_id`,`fecha_registro`) VALUES 
 (18,3,27,'2017-07-29');
/*!40000 ALTER TABLE `matricula` ENABLE KEYS */;


--
-- Definition of table `matricula_evaluacion`
--

DROP TABLE IF EXISTS `matricula_evaluacion`;
CREATE TABLE `matricula_evaluacion` (
  `matricula_evaluacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluacion_id` int(11) NOT NULL,
  `matricula_id` int(11) NOT NULL,
  `fecha_evaluacion` date NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`matricula_evaluacion_id`),
  KEY `fk_matricula_evaluacion_evaluacion1` (`evaluacion_id`),
  KEY `fk_matricula_evaluacion_matricula1_idx` (`matricula_id`),
  CONSTRAINT `fk_matricula_evaluacion_evaluacion1` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluacion` (`evaluacion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_evaluacion_matricula1` FOREIGN KEY (`matricula_id`) REFERENCES `matricula` (`matricula_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matricula_evaluacion`
--

/*!40000 ALTER TABLE `matricula_evaluacion` DISABLE KEYS */;
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
 (5,'wqkkqw','sdlsdsd.sd.sd',1);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pregunta`
--

/*!40000 ALTER TABLE `pregunta` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `respuesta`
--

/*!40000 ALTER TABLE `respuesta` DISABLE KEYS */;
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
  PRIMARY KEY (`respuesta_evaluacion_id`),
  KEY `fk_respuesta_evaluacion_respuesta1` (`respuesta_id`),
  KEY `fk_respuesta_evaluacion_evaluacion_pregunta1_idx` (`evaluacion_pregunta_id`),
  CONSTRAINT `fk_respuesta_evaluacion_evaluacion_pregunta1` FOREIGN KEY (`evaluacion_pregunta_id`) REFERENCES `evaluacion_pregunta` (`evaluacion_pregunta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_respuesta_evaluacion_respuesta1` FOREIGN KEY (`respuesta_id`) REFERENCES `respuesta` (`respuesta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `respuesta_evaluacion`
--

/*!40000 ALTER TABLE `respuesta_evaluacion` DISABLE KEYS */;
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
 (1,'Sección 1','aslals',1),
 (2,'Sección 2','Sdkds',1),
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
  `email` varchar(512) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `tipo_usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `fk_usuario_tipo_usuario` (`tipo_usuario_id`),
  CONSTRAINT `fk_usuario_tipo_usuario` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipo_usuario` (`tipo_usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`usuario_id`,`cedula`,`nombres`,`apellidos`,`password`,`direccion`,`telefono`,`email`,`estado`,`tipo_usuario_id`) VALUES 
 (1,'0600034201','Pedro','Padilla','202cb962ac59075b964b07152d234b70','ssk','388383883','b@g.com',0,1),
 (2,'0602567802','Juan','Perez','202cb962ac59075b964b07152d234b70','dslld','929929299','a@hotmail.com',1,2),
 (3,'0600034201','Aleja','Valle','202cb962ac59075b964b07152d234b70','sl','888888888','c@hotmail.com',1,3);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

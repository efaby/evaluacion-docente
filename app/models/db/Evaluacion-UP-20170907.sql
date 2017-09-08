CREATE DATABASE  IF NOT EXISTS `evaluacion` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `evaluacion`;
-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: evaluacion
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso`
--

LOCK TABLES `curso` WRITE;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` VALUES (1,'Primero','Primero',1,1),(2,'Juan11','Pedro',1,0),(3,'Curso 3','sls',1,0),(4,'aa','bb',2,0),(5,'sakksa','ldsldsl',1,0),(6,'Segundo','Segundo',1,1),(7,'dslsdl','dsldsl',1,0),(9,'dsllds','sdñds',1,0),(10,'Tercero','Tercero',1,1),(11,'Cuarto','Cuarto',1,1);
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidad`
--

DROP TABLE IF EXISTS `especialidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidad`
--

LOCK TABLES `especialidad` WRITE;
/*!40000 ALTER TABLE `especialidad` DISABLE KEYS */;
INSERT INTO `especialidad` VALUES (1,'Informatica',1,'Informatica',1),(2,'Contabilidad',1,'Contabilidad',1),(3,'laslls',1,'sdllds',0),(4,'epsepss',1,'slslls',0);
/*!40000 ALTER TABLE `especialidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluacion`
--

DROP TABLE IF EXISTS `evaluacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluacion` (
  `evaluacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(1024) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`evaluacion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluacion`
--

LOCK TABLES `evaluacion` WRITE;
/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
INSERT INTO `evaluacion` VALUES (1,'Evaluación 11','Evaluación 11',1),(2,'Evaluación 2','Evaluación 2',0);
/*!40000 ALTER TABLE `evaluacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluacion_pregunta`
--

DROP TABLE IF EXISTS `evaluacion_pregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluacion_pregunta`
--

LOCK TABLES `evaluacion_pregunta` WRITE;
/*!40000 ALTER TABLE `evaluacion_pregunta` DISABLE KEYS */;
INSERT INTO `evaluacion_pregunta` VALUES (1,1,1),(2,1,3),(3,1,2),(4,1,4),(5,1,5),(6,1,6),(7,1,7),(8,1,8),(9,1,9),(10,1,10),(11,1,11),(12,1,12),(13,1,13),(14,1,14),(15,1,15),(16,1,16),(17,1,17);
/*!40000 ALTER TABLE `evaluacion_pregunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES (1,'Materia','sdlsd',1,0),(2,'Matematicas','Matematicas',1,1),(3,'aslas','laslsa',1,0),(4,'Fundamentos Inf','Fundamentos Inf',1,1),(5,'Materia 3','ajaja',1,0),(6,'Mamr','111',1,0),(7,'Fisica','Fisica',1,1),(8,'Didactica','Didactica',1,1);
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia_periodo`
--

DROP TABLE IF EXISTS `materia_periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia_periodo`
--

LOCK TABLES `materia_periodo` WRITE;
/*!40000 ALTER TABLE `materia_periodo` DISABLE KEYS */;
INSERT INTO `materia_periodo` VALUES (27,'2017-07-28',2,1,2,0),(30,'2017-07-29',4,1,2,0),(31,'2017-07-31',2,5,2,1),(32,'2017-07-31',7,5,2,1),(33,'2017-08-23',4,5,2,1),(34,'2017-08-23',8,5,2,1);
/*!40000 ALTER TABLE `materia_periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matricula`
--

DROP TABLE IF EXISTS `matricula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matricula`
--

LOCK TABLES `matricula` WRITE;
/*!40000 ALTER TABLE `matricula` DISABLE KEYS */;
INSERT INTO `matricula` VALUES (1,3,31,'2017-08-27'),(2,3,33,'2017-08-27'),(3,4,31,'2017-09-05'),(4,4,32,'2017-09-05');
/*!40000 ALTER TABLE `matricula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matricula_evaluacion`
--

DROP TABLE IF EXISTS `matricula_evaluacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matricula_evaluacion`
--

LOCK TABLES `matricula_evaluacion` WRITE;
/*!40000 ALTER TABLE `matricula_evaluacion` DISABLE KEYS */;
INSERT INTO `matricula_evaluacion` VALUES (1,1,1,'2017-09-07',1),(2,1,2,'2017-09-07',1),(3,1,3,'2017-09-07',1),(4,1,4,NULL,1);
/*!40000 ALTER TABLE `matricula_evaluacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodo`
--

DROP TABLE IF EXISTS `periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodo` (
  `periodo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(512) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`periodo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo`
--

LOCK TABLES `periodo` WRITE;
/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
INSERT INTO `periodo` VALUES (1,'Prueba','sdlsldaaqwdsññsd',0),(5,'Abril 2017- Septiembre 2017','sdlsdsd.sd.sd',1);
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pregunta` (
  `pregunta_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(512) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `unica` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pregunta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pregunta`
--

LOCK TABLES `pregunta` WRITE;
/*!40000 ALTER TABLE `pregunta` DISABLE KEYS */;
INSERT INTO `pregunta` VALUES (1,'Informa con claridaad el plan del curso (Programa, Objetivos, Bibliografía, Tutorias).','Informa con claridaad el plan del curso (Programa, Objetivos, Bibliografía, Tutorias).',1,0),(2,'Sus clases se ajustan a lo previsto en el plan de asignatura.','Sus clases se ajustan a lo previsto en el plan de asignatura.',1,0),(3,'Informa con claridad de los criterios y el método de evaluación.','Informa con claridad de los criterios y el método de evaluación.',1,0),(4,'Cumple los horarios de tutoria.','Cumple los horarios de tutoria.',1,0),(5,'Se muestra accesible y está dispuesto a atender las consultas de los estudiantes.','Se muestra accesible y está dispuesto a atender las consultas de los estudiantes.',1,0),(6,'Demuestra dominar la materia impartida.','Demuestra dominar la materia impartida.',1,0),(7,'Actualiza los contenidos de las asignaturas.','Actualiza los contenidos de las asignaturas.',1,0),(8,'Prepara, organiza y estructura bien las clases.','Prepara, organiza y estructura bien las clases.',1,0),(9,'Atiende y responde con claridad las consultas realizadas en clase.','Atiende y responde con claridad las consultas realizadas en clase.',1,0),(10,'Es respetuoso con los alumnos.','Es respetuoso con los alumnos.',1,0),(11,'Tiene en cuenta trabajos, intervenciones en clase u otras actividades para la evaluación.','Tiene en cuenta trabajos, intervenciones en clase u otras actividades para la evaluación.',1,0),(12,'Relaciona los contenidos del programa entre si y con los de otras materias.','Relaciona los contenidos del programa entre si y con los de otras materias.',1,0),(13,'Realiza suficientes prácticas y casos para la correcta comprensión de la asignatura.','Realiza suficientes prácticas y casos para la correcta comprensión de la asignatura.',1,0),(14,'Motiva la participación critica y activa de los alumnos en el desarrollo de la clase.','Motiva la participación critica y activa de los alumnos en el desarrollo de la clase.',1,0),(15,'Los materiales de estudio (Libros, Textos y Otros) indicados por el profesor son útiles.','Los materiales de estudio (Libros, Textos y Otros) indicados por el profesor son útiles.',1,0),(16,'El docente falta constantemente a clases.','El docente falta constantemente a clases.',1,1),(17,'En general, estoy satisfecho con la labor de este profesor.','En general, estoy satisfecho con la labor de este profesor.',1,0);
/*!40000 ALTER TABLE `pregunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respuesta`
--

DROP TABLE IF EXISTS `respuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `respuesta` (
  `respuesta_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `valor` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`respuesta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respuesta`
--

LOCK TABLES `respuesta` WRITE;
/*!40000 ALTER TABLE `respuesta` DISABLE KEYS */;
INSERT INTO `respuesta` VALUES (1,'Nunca',1,1),(2,'En Desacuerdo',2,1),(3,'De Acuerdo',3,1),(4,'Totalmente de Acuerdo',4,1);
/*!40000 ALTER TABLE `respuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respuesta_evaluacion`
--

DROP TABLE IF EXISTS `respuesta_evaluacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respuesta_evaluacion`
--

LOCK TABLES `respuesta_evaluacion` WRITE;
/*!40000 ALTER TABLE `respuesta_evaluacion` DISABLE KEYS */;
INSERT INTO `respuesta_evaluacion` VALUES (22,2,2,1,2),(23,3,3,2,2),(24,4,4,3,2),(25,3,3,4,2),(26,3,3,5,2),(27,3,3,6,2),(28,2,2,7,2),(29,3,3,8,2),(30,4,4,9,2),(31,1,1,10,2),(32,3,3,11,2),(33,2,2,12,2),(34,4,4,13,2),(35,2,2,14,2),(36,3,3,15,2),(37,2,2,16,2),(38,1,1,17,2),(39,2,2,1,1),(40,3,3,2,1),(41,2,2,3,1),(42,4,4,4,1),(43,3,3,5,1),(44,2,2,6,1),(45,3,3,7,1),(46,1,1,8,1),(47,4,4,9,1),(48,1,1,10,1),(49,4,4,11,1),(50,2,2,12,1),(51,3,3,13,1),(52,4,4,14,1),(53,3,3,15,1),(54,3,3,16,1),(55,2,2,17,1),(56,2,2,1,3),(57,3,3,2,3),(58,4,4,3,3),(59,4,4,4,3),(60,3,3,5,3),(61,3,3,6,3),(62,2,2,7,3),(63,3,3,8,3),(64,3,3,9,3),(65,4,4,10,3),(66,4,4,11,3),(67,1,1,12,3),(68,2,2,13,3),(69,3,3,14,3),(70,2,2,15,3),(71,2,2,16,3),(72,3,3,17,3);
/*!40000 ALTER TABLE `respuesta_evaluacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seccion`
--

DROP TABLE IF EXISTS `seccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seccion` (
  `seccion_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(512) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`seccion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seccion`
--

LOCK TABLES `seccion` WRITE;
/*!40000 ALTER TABLE `seccion` DISABLE KEYS */;
INSERT INTO `seccion` VALUES (1,'Diurna','Diurna',1),(2,'Nocturna','Nocturna',1),(3,'Sección 3','seccion 2',0),(4,'ksksaka','lals',0),(5,'secicon','aslasl',0);
/*!40000 ALTER TABLE `seccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `tipo_usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tipo_usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (1,'Administrador',1),(2,'Docente',1),(3,'Estudiante',1);
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'0600034201','Pedro','Padilla','e10adc3949ba59abbe56e057f20f883e','ssk','388383883',NULL,'b@g.com',1,1),(2,'0602567802','Juan','Perez','e10adc3949ba59abbe56e057f20f883e','dslld','929929299',NULL,'a@hotmail.com',1,2),(3,'0600034202','Aleja','Valle','e10adc3949ba59abbe56e057f20f883e','sl','032940026','0994006084','c@hotmail.com',1,3),(4,'0603718578','Fabian','Villa','e10adc3949ba59abbe56e057f20f883e','la paz','111111111','1111111111','la@g.com',1,3);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-07 20:25:41

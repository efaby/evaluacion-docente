DELETE FROM evaluacion_pregunta;
DELETE FROM matricula_evaluacion;
DELETE FROM respuesta_evaluacion;
DELETE FROM evaluacion_pregunta;
DELETE FROM docente_evaluacion;
DELETE FROM matricula_evaluacion;
DELETE FROM matricula;
DELETE FROM evaluacion;
DELETE FROM materia_periodo;
DELETE FROM materia;
DELETE FROM curso;
DELETE FROM especialidad;
DELETE FROM periodo;
DELETE FROM seccion;


TRUNCATE matricula_evaluacion;
TRUNCATE respuesta_evaluacion;
ALTER TABLE evaluacion AUTO_INCREMENT = 1;
ALTER TABLE materia_periodo AUTO_INCREMENT = 1;
ALTER TABLE materia AUTO_INCREMENT = 1;
ALTER TABLE evaluacion_pregunta AUTO_INCREMENT = 1;
ALTER TABLE docente_evaluacion AUTO_INCREMENT = 1;
ALTER TABLE matricula_evaluacion AUTO_INCREMENT = 1;
ALTER TABLE matricula AUTO_INCREMENT = 1;
ALTER TABLE materia AUTO_INCREMENT = 1;
ALTER TABLE curso AUTO_INCREMENT = 1;
ALTER TABLE especialidad AUTO_INCREMENT = 1;
ALTER TABLE periodo AUTO_INCREMENT = 1;
ALTER TABLE seccion AUTO_INCREMENT = 1;


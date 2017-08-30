<?php $title = "Evaluación";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="card">
<div class="card-header">
    	<h3>Evaluación</h3>
</div>
<div class="card-block">
	<div class="row">
		<div class="col-sm-12 text-center">	
		<?php echo $evaluacion->evaluacion; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">	
			<strong>Materia:</strong> <?php echo $evaluacion->materia; ?>
		</div>
		<div class="col-sm-3">	
			<strong>Docente:</strong> <?php echo $evaluacion->nombres ." ". $evaluacion->apellidos; ?>
		</div>
		<div class="col-sm-3">	
			<strong>Curso:</strong> <?php echo $evaluacion->curso; ?>
		</div>
		<div class="col-sm-3">	
			<strong>Especialidad:</strong> <?php echo $evaluacion->especialidad; ?>
		</div>
	</div>	
<br><br>
	<div class="row">
	<form id="frmItem" method="post" action="../guardarEvaluacion/" style="width: 100%">	

		<div class="col-sm-12">
			<table class="table table-th-block table-bordered">
				<thead>
				<tr>
					<th rowspan="2" style="width: 70%; vertical-align: middle;">PREGUNTAS</th>
					<th colspan="4" style="text-align:center">VALORACIÓN</th>
				</tr>
			<tr>
				<?php foreach ($respuestas as $resp) { ?>
				<th style="text-align:center"><?php echo $resp->nombre; ?></th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($preguntas as $item) { ?>
				<tr class='form-group'>
				<td><?php echo $item->nombre; ?></td>
				<?php foreach ($respuestas as $resp) { ?>
					<td style="text-align:center"><input type="radio"  class='form-control' name="respuesta<?php echo $item->evaluacion_pregunta_id;?>" value="<?php echo $resp->respuesta_id ."-".$resp->valor; ?>" /></td>
				<?php } ?>
				</tr>				
			<?php } ?>
		</tbody>
		</table>
		</div>

		
		<div class="col-sm-12">
			<input type='hidden' name='matricula_evaluacion_id' class='form-control' value="<?php echo $itemId; ?>">		
			<button type="submit" class="btn btn-success boton" id="boton">Guardar</button>
			<a href="../listar/" class="btn btn-default boton" id="boton">Cancelar</a>		
		</div>
		</form>
	</div>

	
	
</div>
</div>


<?php include_once PATH_TEMPLATE.'/footer.php';?>   
<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>
<script src="<?php echo PATH_JS; ?>/currentList.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">

<script type="text/javascript">
$(document).ready(function() {
    $('#frmItem').formValidation({
    	message: 'This value is not valid',
		fields: {	
			<?php foreach ($preguntas as $item) { 
				echo "respuesta".$item->evaluacion_pregunta_id.": {
                validators: {
                    notEmpty: {
                        message: 'Por favor selecione una opcion.'
                    }
                }
            },"; 
            } ?>
		}
	});

});
</script>
</body>
</html>
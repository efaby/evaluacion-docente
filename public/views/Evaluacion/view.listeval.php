<?php $title = "Evaluación/Pregunta";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>
<!-- Main row -->
<div class="card">
<div class="card-header">
    	<h3>Evaluación <?php echo $evaluacion->nombre;?></h3>
</div>
<form id="frmItem" method="post" action="../guardar/">
	<br>
	<?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
		<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert"
					aria-hidden="true">&times;</button>
				  <?php echo $_SESSION['message'];$_SESSION['message'] = ''?>
		</div>
	<?php endif;?>
	<div class="col-lg-12">
		 <button type="button" data-id="<?php echo $evaluacion->evaluacion_id;?>" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
          	Añadir
         </button>
	</div>
	<br>
	<div class="form-group col-sm-12">
		<table class="table table-striped" id="dataTables-example">		
			<thead>		
				<tr>
					<th>Código</th>
					<th>Pregunta</th>
					<th></th>					
				</tr>
			</thead>
    		<tbody>
		    		<?php 
						if($items != null){
							foreach ($items as $item){	
								$id = $item->id.'-'.$evaluacion->evaluacion_id;
							?>							
					<tr><td><?php echo $item->id;?></td>
						<td><?php echo $item->pregunta_nombre;?></td>
						<td>
							<?php echo "<a href='javascript:if(confirm(\"Est\u00e1 seguro que desea eliminar el elemento seleccionado?\")){redirect1(\"$id\");}' class='btn btn-danger btn-sm' title='Eliminar'><i class='fa fa-trash'></i></a>"?>
						</td>
					</tr>
					<?php 	}
						}else{?>
					<tr><td colspan="4" align="center">No existe Preguntas asignadas a esta Evaluación</td></tr>
					<?php }?>
			</tbody>		
		</table>		
	</div>
	<div class="form-group col-sm-12">
		<a href="../listar/" class="btn btn-default boton">Regresar</a>
	</div>	
</form>
<div class="modal modal1 fade" id="myModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true" >
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">				
				<h4 class="modal-title">Preguntas</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                 </button>
			</div>			
			<div class="modal-body"></div>

		</div>
	</div>
</div>

<?php include_once PATH_TEMPLATE.'/footer.php';?>   
<link href="<?php echo PATH_CSS; ?>/dataTables.bootstrap.css" rel="stylesheet">
<script src="<?php echo PATH_JS; ?>/jquery.dataTables.min.js"></script>
<script src="<?php echo PATH_JS; ?>/dataTables.bootstrap.min.js"></script>
<script src="<?php echo PATH_JS; ?>/table.js"></script>
<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/currentList.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">

<script type="text/javascript">
$(document).ready(function() {
    $('#frmItem').formValidation({
        message: 'This value is not valid',
    	fields: {			
				docente_id: {
	                validators: {
		                    notEmpty: {
		                        message: 'No existe un docente válido.'
		                    }
	                	}
	        	},
				especialidad_id: {
	                validators: {
		                    notEmpty: {
		                        message: 'Seleccione una especialidad.'
		                    }
	                	}
	        	},
	        	'materia_id[]':{
	    			validators: {                    
	                        notEmpty: {
	                       	message: 'Las materias no pueden ser vacías.'
	                         }
	                    }
	        	}
		}
	});        
    
});
</script>
</body>
</html>
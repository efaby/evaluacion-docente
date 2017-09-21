<?php $title = "Materia/Docente";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>
<!-- Main row -->
<div class="card">
<div class="card-header">
    	<h3>Materias del Estudiante <?php echo $estudiante->nombres.' '.$estudiante->apellidos?> - Período <?php echo $periodo->nombre;?></h3>
</div>
<form id="frmItem" method="post" action="../guardar/">
	<br>
	<div class="col-lg-12">
		 <button type="button" data-id="<?php echo $estudiante->id;?>" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
          	Añadir
         </button>
	</div>
	<br>
	<div class="form-group col-sm-12">
		<table class="table table-striped">
			<thead>		
				<tr>
					<th>Código</th>
					<th>Curso</th>
					<th>Materia</th>
					<th>Evaluaci&oacute;n</th>
					<th>Opción</th>
				<tr>
			</thead>
    		<tbody>
		    		<?php 
						if(count($items)>0){
							foreach ($items as $item){
							$id = $item->matricula_id.'-'.$estudiante->id;
								?>							
					<tr><td><?php echo $item->id;?></td>
						<td><?php echo $item->materia_nombre;?></td>
						<td><?php echo $item->curso_nombre;?></td>
						<td><?php echo $item->evaluacion;?></td>
						<td><?php if($item->fecha_evaluacion == null){
							echo "<a href='javascript:if(confirm(\"Est\u00e1 seguro que desea eliminar el elemento seleccionado?\")){redirect(\"$id\");}' class='btn btn-danger btn-sm' title='Eliminar'><i class='fa fa-trash'></i></a>";
						}?>
						</td>
					<?php 	}
						}else{?>
					<tr><td colspan="5" align="center">No existe Materias asignadas al estudiante</td></tr>
					<?php }?>
			</tbody>		
		</table>		
	</div>	
</form>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true" >
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">				
				<h4 class="modal-title">Materias</h4>
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
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>
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
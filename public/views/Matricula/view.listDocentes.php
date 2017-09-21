<?php $title = "Materia/Docente";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>
<!-- Main row -->
<div class="card">
<div class="card-header">
    	<h3>Listado de Docentes a Evaluar por <?php echo $administrativo->nombres.' '.$administrativo->apellidos?> - Período <?php echo $periodo->nombre;?></h3>
</div>
<form id="frmItem" method="post" action="../guardar/">
	<br>
	<div class="col-lg-12">
		 <button type="button" data-id="<?php echo $administrativo->id;?>" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
          	Añadir
         </button>
	</div>
	<br>
	<div class="form-group col-sm-12">
		<table class="table table-striped" id="dataTables-example">
			<thead>		
				<tr>
					<th>Código</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Área</th>
					<th>Evaluaci&oacute;n</th>
					<th></th>
				</tr>
			</thead>
    		<tbody>
		    		<?php 
						if(count($items)>0){
							foreach ($items as $item){
							$id = $item->docente_evaluacion_id. '-'.$administrativo->id;
								?>							
					<tr><td><?php echo $item->docente_evaluacion_id;?></td>
						<td><?php echo $item->nombres;?></td>
						<td><?php echo $item->apellidos;?></td>
						<td><?php echo $item->area;?></td>
						<td><?php echo $item->evaluacion;?></td>
						<td><?php echo "<a href='javascript:if(confirm(\"Est\u00e1 seguro que desea eliminar el elemento seleccionado?\")){redirect2(\"$id\");}' class='btn btn-danger btn-sm' title='Eliminar'><i class='fa fa-trash'></i></a>"?>
						</td>
					<?php 	}
						}else{?>
					<tr><td colspan="6" align="center">No existe Docentes asignados al Administrativo</td></tr>
					<?php }?>
			</tbody>		
		</table>		
	</div>	
</form>
<div class="modal modal2 fade" id="myModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true" >
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">				
				<h4 class="modal-title">Docentes</h4>
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
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">

<script type="text/javascript">
$(document).on('show.bs.modal', '.modal2', function (event) {
	 var button = $(event.relatedTarget) // Button that triggered the modal
	 var id = button.data('id') 
	$('.modal-body').load('../editarDocentes/' + id  ,function(result){	    
	});
});

function redirect2(id){
	var url = '../eliminarDocente/' + id;
	location.href = url;
}


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
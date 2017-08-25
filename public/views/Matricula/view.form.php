<form id="frmMaterias" method="post" action="../guardar/">
	<br>
	<div class="form-group col-sm-12">
		<label class="control-label">Sección</label> 
		<select class='form-control' id="seccion_id" name="seccion_id">
			<option value="" >Seleccione</option>
		<?php foreach ($secciones as $dato) { ?>
			<option value="<?php echo $dato->id;?>"><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>
	</div>
	<div class="form-group col-sm-12">
		<label class="control-label">Especialidad</label> 
		<select class='form-control' id="especialidad_id" name="especialidad_id" <?php echo $dato->id==0? "disabled=disabled ": ''; ?>>
			<option value="" >Seleccione</option>
		<?php foreach ($especialidades as $dato) { ?>
			<option value="<?php echo $dato->id;?>"  <?php if($item->especialidad_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>
	</div>
	<div class="form-group col-sm-12">
		<label class="control-label">Curso</label> 
		<select class='form-control' id="curso_id" name="curso_id" <?php echo $dato->id==0? "disabled=disabled ": ''; ?>>
			<option value="" >Seleccione</option>
		<?php foreach ($cursos as $dato) { ?>
			<option value="<?php echo $dato->id;?>"><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>
	</div>
	<div class="form-group col-sm-12">
		<div id="materias">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<label class="control-label">Evaluación</label> 
		<select class='form-control' id="evaluacion_id" name="evaluacion_id">
			<option value="" >Seleccione</option>
		<?php foreach ($evaluaciones as $dato) { ?>
			<option value="<?php echo $dato->evaluacion_id;?>"><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>
	</div>	
	<div class="form-group">
		<input type='hidden' name='estudiante_id' class='form-control' value="<?php echo $estudiante->id; ?>">
		<button type="submit" class="btn btn-success boton" id="boton">Guardar</button>
		<button type="button" class="btn btn-default boton" id="boton" data-dismiss="modal">Cancelar</button>
	</div>	
</form>
<script type="text/javascript">
$(document).ready(function() {
    $('#frmMaterias').formValidation({
        message: 'This value is not valid',
    	fields: {			
				seccion_id: {
	                validators: {
		                    notEmpty: {
		                        message: 'Seleccione una sección.'
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
	        	curso_id: {
	                validators: {
		                    notEmpty: {
		                        message: 'Seleccione un curso.'
		                    }
	                	}
	        	},
	        	evaluacion_id: {
	                validators: {
	                    notEmpty: {
	                        message: 'Seleccione una evaluación.'
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

    $('#seccion_id').change(function(){
	    var seccion_id = jQuery("#seccion_id").val();
	    $('#especialidad_id').html(null);
    	$('#curso_id').html('<option value="0">Seleccionar</option>');    	
	    if(seccion_id != null){
		    jQuery.ajax({
			        type: "POST",
			        url: '../obtenerEspecialidades/',
			        data: {
			        	"id": seccion_id		        	
			        },
			        success:function(response) {			        
				      $('#especialidad_id').html(response);
	    	          $("#especialidad_id").prop('disabled', false);			        		        				    			           	
			        }
			        
			});
	    }	    	    
	});
	       
    $('#especialidad_id').change(function(){
	    var seccion_id = jQuery("#seccion_id").val();
	    var especialidad_id = jQuery("#especialidad_id").val();
	    jQuery.ajax({
		    type: "POST",
		    url: '../obtenerCursos/',
		    data: {
		      	"id": especialidad_id		        	
		    },
		    success:function(response) {			        
		      $('#curso_id').html(response);	          		        		        				    			           	
		   }
			        
		});	   	    	    
	});

    $('#curso_id').change(function(){
	    var curso_id = jQuery("#curso_id").val();
	    jQuery.ajax({
		    type: "POST",
		    url: '../obtenerMaterias/',
		    data: {
		      	"id": curso_id		        	
		    },
		    success:function(response) {			        
		      $('#materias').html(response);	          		        		        				    			           	
		   }
			        
		});	   	    	    
	});
});
</script>
</body>
</html>
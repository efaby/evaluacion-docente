<form id="frmItem" method="post" action="../guardar/">
	<div class="form-group col-sm-12">
		<label class="control-label">Sección</label> 
		<select class='form-control' id="seccion_id" name="seccion_id">
			<option value="" >Seleccione</option>
		<?php foreach ($secciones as $dato) { ?>
			<option value="<?php echo $dato->id;?>"  <?php if($item->seccion_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
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
			<option value="<?php echo $dato->id;?>"  <?php if($item->curso_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>
	</div>	
	<div class="form-group col-sm-12">
		<label class="control-label">Nombre</label> <input type='text'
			name='nombre' class='form-control'
			value="<?php echo $item->nombre; ?>" id="nombre">
	</div>
	<div class="form-group col-sm-12">
		<label class="control-label">Descripción</label> <input type='text'
			name='descripcion' class='form-control'
			value="<?php echo $item->descripcion; ?>" id="descripcion">
	</div>

	<div class="form-group">
		<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">		
		<button type="submit" class="btn btn-success boton" id="boton">Guardar</button>
		<button type="button" class="btn btn-default boton" id="boton" data-dismiss="modal">Cancelar</button>
	</div>

</form>

<script type="text/javascript">
$(document).ready(function() {
    $('#frmItem').formValidation({
    	message: 'This value is not valid',
		fields: {			
				nombre: {
					message: 'El Nombre no es válido',
					validators: {
								notEmpty: {
									message: 'El Nombre no puede ser vacío.'
								},
								regexp: {
									regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\.\,\_\s\-]+$/,
									message: 'Ingrese un Nombre válido.'
								}
							}
				},
				descripcion: {
					message: 'La Descripción no es válida',
					validators: {
								regexp: {
									regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\.\,\_\s\-]+$/,
									message: 'Ingrese una Descripción válida.'
								}
							}
				},
				curso_id: {
	                validators: {
		                    notEmpty: {
		                        message: 'Seleccione un curso.'
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
			        url: '../getEspecialidadesSelect/',
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
	    var especialidad_id = jQuery("#especialidad_id").val();
	    jQuery.ajax({
		        type: "POST",
		        url: '../getCursosSelect/',
		        data: {
		        	"id": especialidad_id		        	
		        },
		        success:function(response) {			        
			      $('#curso_id').html(response);
    	          $("#curso_id").prop('disabled', false);			        		        				    			           	
		        }
		        
		});	    
	});
});
</script>
<style>
.boton {
	margin-left: 15px;
}
</style>
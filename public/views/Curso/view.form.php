<form id="frmItem" method="post" action="../guardar/">
	<div class="form-group col-sm-12">
		<label class="control-label">Especialidad</label> 
		<select class='form-control' name="especialidad_id">
			<option value="" >Seleccione</option>
		<?php foreach ($especialidades as $dato) { ?>
			<option value="<?php echo $dato->id;?>"  <?php if($item->especialidad_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
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
				especialidad_id: {
	                validators: {
		                    notEmpty: {
		                        message: 'Seleccione una especialidad.'
		                    }
	                	}
	        	}
		}
	});
});
</script>
<style>
.boton {
	margin-left: 15px;
}
</style>
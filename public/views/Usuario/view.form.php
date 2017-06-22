<form id="frmUsuario" method="post" action="../guardar/">
<div style="overflow: auto;">
	<div class="form-group  col-sm-6">
		<label class="control-label">Tipo Usuario</label>
		<select class='form-control' name="tipo_usuario_id">
			<option value="" >Seleccione</option>
		<?php foreach ($tipos as $dato) { ?>
			<option value="<?php echo $dato->id;?>"  <?php if($item->tipo_usuario_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>
	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Identificación</label> <input type='text'
			name='identificacion' class='form-control'
			value="<?php echo $item->identificacion; ?>" id="identificacion">
	</div>	
	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Nombres</label> <input type='text'
			name='nombres' class='form-control' 
			value="<?php echo $item->nombres; ?>" id="nombres">
	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Apellidos</label> <input type='text'
			name='apellidos' class='form-control' 
			value="<?php echo $item->apellidos; ?>" id="apellidos">
	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Contraseña</label>
		<input type="password"
			name='password' class='form-control'
			value="<?php echo $item->password; ?>">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Repetir Contraseña</label>
		<input type="password"
			name='password1' class='form-control'
			value="<?php echo $item->password1; ?>">

	</div>
		<div class="form-group col-sm-12">
		<label class="control-label">Email</label> <input type='text'
			name='email' class='form-control'
			value="<?php echo $item->email; ?>" id="email">
	</div>	
	<div class="form-group">
		<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">		
		<button type="submit" class="btn btn-success boton" id="boton">Guardar</button>
	</div>

</form>

<script type="text/javascript">
$(document).ready(function() {
    $('#frmUsuario').formValidation({
    	message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {			
			identificacion: {
				message: 'El Número de Identificación no es válido',
				validators: {
							notEmpty: {
								message: 'El Número de Identificación no puede ser vacío.'
							},					
							regexp: {
								regexp: /^(?:\+)?\d{10,13}$/,
								message: 'Ingrese un Número de Identificación válido.'
							},
							remote: {
		                        message: 'El Número de Identificación ya existe.',
		                        url: '../getUsuarioByIde/',
		                        data: function(validator, $field, value) {
		                            return {
		                                id: validator.getFieldElements('id').val()
		                            };
		                        },

		                        
		                        type: 'POST'
		                    },									
							callback: {
				                message: 'El Número de Identificación no es válido.',
                 				callback: function (value, validator, $field) {
						    var cedula = value;
						    try {
						        array = cedula.split("");
						    }
						    catch (e) {
						        //array = null;
						    }
						    num = array.length;
						    if (num === 10) {
						        total = 0;
						        digito = (array[9] * 1);
						        for (i = 0; i < (num - 1); i++) {
						            mult = 0;
						            if ((i % 2) !== 0) {
						                total = total + (array[i] * 1);
						            } else {
						                mult = array[i] * 2;
						                if (mult > 9)
						                    total = total + (mult - 9);
						                else
						                    total = total + mult;
						            }
						        }
						        decena = total / 10;
						        decena = Math.floor(decena);
						        decena = (decena + 1) * 10;
						        final = (decena - total);
						        if ((final === 10 && digito === 0) || (final === digito)) {
						
						            return true;
						        } else {
						
						            return false;
						        }
						    } else {
						
						        return false;
						    }
						}
						}
				}
			},
						
			nombres: {
						message: 'El Nombre no es válido',
						validators: {
									notEmpty: {
										message: 'El Nombre no puede ser vacío.'
									},
									regexp: {
										regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ \.\s]+$/,
										message: 'Ingrese un Nombre válido.'
									}
								}
							},
			apellidos: {
						message: 'El Apellido no es válido',
						validators: {
										notEmpty: {
										message: 'El Apellido no puede ser vacío.'
									},
									regexp: {
										regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ \.\s]+$/,
										message: 'Ingrese un Nombre válido.'
									}
								}
						},
					
			tipo_usuario_id: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Tipo de Usuario'
					}
				}
			},
			
			password: {
				message: 'La Contraseña no es válida',
				validators: {
					notEmpty: {
						message: 'La Contraseña no puede ser vacía.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\.\,\_\-]+$/,						
						message: 'Ingrese una Contraseña válido.'
					}
				}
			},
			password1: {
				validators: {
					notEmpty: {
						message: 'La contraseña no puede ser vacia.'
					},
					identical: {
						field: 'password',
						message: 'La contraseña debe ser la misma'
					}
				}
			},
			email: {
				message: 'El email no es válida',
				validators: {
					regexp: {
						regexp: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
						message: 'Ingrese un email válido.'
					}
				}
			},
			
		}
	});
});
</script>
<style>
.boton {
	margin-left: 15px;
}
</style>
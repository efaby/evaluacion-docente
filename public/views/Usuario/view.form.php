<form id="frmUsuario" method="post" action="../guardar/">
<div class="row rowForm">
	<div class="form-group  col-sm-6">
		<label class="control-label">Tipo Usuario</label>
		<select class='form-control' name="tipo_usuario_id" id="tipo_usuario_id">
			<option value="" >Seleccione</option>
		<?php foreach ($tipos as $dato) { ?>
			<option value="<?php echo $dato->id;?>"  <?php if($item->tipo_usuario_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>
	</div>
	<div class="form-group  col-sm-6" id="ddocente" >
		<label class="control-label" id="ldocente" style="<?php echo $disabled; ?>">&Aacute;rea</label>
		<select class='form-control' name="especialidad_id" id="sdocente" style="<?php echo $disabled; ?>">
			<option value="" >Seleccione</option>
		<?php foreach ($especialidades as $dato) { ?>
			<option value="<?php echo $dato->id;?>"  <?php if($item->especialidad_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>
	</div>
</div>
<div class="row rowForm">
	<div class="form-group col-sm-6">
		<label class="control-label">C&eacute;dula </label> <input type='text'
			name='identificacion' class='form-control'
			value="<?php echo $item->identificacion; ?>" id="identificacion">
	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Email</label> <input type='text'
			name='email' class='form-control'
			value="<?php echo $item->email; ?>" id="email">
	</div>
</div>	
<div class="row rowForm">
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
</div>
<div class="row rowForm">
	<div class="form-group col-sm-6">
		<label class="control-label">Teléfono</label> <input type='text'
			name='telefono' class='form-control' 
			value="<?php echo $item->telefono; ?>" id="telefono">
	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Celular</label> <input type='text'
			name='celular' class='form-control' 
			value="<?php echo $item->celular; ?>" id="celular">
	</div>
</div>
<div class="row rowForm">
	<div class="form-group col-sm-12">
		<label class="control-label">Dirección</label> <input type='text'
			name='direccion' class='form-control' 
			value="<?php echo $item->direccion; ?>" id="direccion">
	</div>
</div>
		
<div class="row rowForm">
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
</div>
<div class="form-group">
	<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">		
	<button type="submit" class="btn btn-success boton" id="boton">Guardar</button>
	<button type="button" class="btn btn-default boton" id="boton" data-dismiss="modal">Cancelar</button>
</div>
</form>

<script type="text/javascript">
$(document).ready(function() {
    $('#frmUsuario').formValidation({
    	message: 'This value is not valid',
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

			especialidad_id: {
				enabled: <?php echo ($disabled === "" )? "true":"false"; ?>,
				validators: {
					notEmpty: {
						message: 'Seleccione una Especialidad'
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
			direccion: {
				message: 'LaDirección no es válida',
				validators: {
					notEmpty: {
						message: 'La Dirección no puede ser vacía.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\.\,\s\_\-]+$/,						
						message: 'Ingrese una Dirección válido.'
					}
				}
			},
			telefono: {
				message: 'El Número de Teléfono no es válido',
				validators: {
					notEmpty: {
						message: 'El Número de Teléfono no puede ser vacío.'
					},					
							regexp: {
								regexp: /^(?:\+)?\d{9}$/,
								message: 'Ingrese un Número de Teléfono válido.'
							}
						}
				
			},
			celular: {
				message: 'El Número de Celular no es válido',
				validators: {
					notEmpty: {
						message: 'El Número de Celular no puede ser vacío.'
					},					
							regexp: {
								regexp: /^(?:\+)?\d{10}$/,
								message: 'Ingrese un Número de Celular válido.'
							}
						}
				
			}
			
		}
	});
});


$( "#tipo_usuario_id" ).change(function() {
  if( $(this).val() == 2) {
  	$("#ldocente").show();
  	$("#sdocente").show();
  	$('#frmUsuario').formValidation('enableFieldValidators', 'especialidad_id', true);
  } else {
  	$("#ldocente").hide();
  	$("#sdocente").hide();
  	$("#ddocente .help-block").hide();
  	$('#frmUsuario').formValidation('enableFieldValidators', 'especialidad_id', false);
  }
});



</script>
<style>
.boton {
	margin-left: 15px;
}
</style>
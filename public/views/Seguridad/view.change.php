<?php $title = "Inicio";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="card">
<div class="card-header">
    	<h3 class="page-header">Cambiar Contrase&ntilde;a</h3>
</div>
<div class="card-block">


<?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
		<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert"
					aria-hidden="true">&times;</button>
				  <?php echo $_SESSION['message'];$_SESSION['message'] = ''?>
		</div>
	<?php endif;?>
			<form method="post" action="../guardarContrasena/" id="frmUsuario" name="frmUsuario">
					<div class="form-group col-sm-12 rows">

						<div class="form-group col-sm-4">
							<label class="control-label">Nueva Contraseña</label> <input
								type="password" name='password'
								class='form-control border-input' value="">

						</div>
						<div class="form-group col-sm-4">
							<label class="control-label">Repetir Contraseña</label> <input
								type="password" name='password1'
								class='form-control border-input' value="">
						</div>
					</div>

					<div class="form-group rowBottom">
						<input type='hidden' name='guardar' value="1">
						<button type="submit" class="btn btn-info">Cambiar Contraseña</button>
					</div>

				</form>
	
	</div>

<?php include_once PATH_TEMPLATE.'/footer.php';?>  


<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">



<script type="text/javascript">

$(document).ready(function() {
    $('#frmUsuario').formValidation({
    	message: 'This value is not valid',
		fields: {			

			password: {
				message: 'La Contraseña no es válida',
				validators: {
					notEmpty: {
						message: 'La Contraseña no puede ser vacía.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9-_ \.]+$/,
						message: 'Ingrese una Contraseña válida.'
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
			
		}
	});

});
</script> 
</body>
</html>
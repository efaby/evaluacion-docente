<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->
    <link rel="shortcut icon" href="<?php echo PATH_IMAGES; ?>/favicon.png">

    <title>Sistema de Evaluaci&oacute;n Docente</title>

    <!-- Icons -->
    <link href="<?php echo PATH_CSS; ?>/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo PATH_CSS; ?>/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="<?php echo PATH_CSS; ?>/style.css" rel="stylesheet">

</head>

<body class="app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group mb-0">
                    <div class="card p-4">
                    <?php $url = $_SERVER["REQUEST_URI"];?>
						<form  id="frmLogin" name="frmLogin" class="login-form form-signin" action="<?php echo (strpos($url, '/Seguridad/'))?'../validar/':'Seguridad/validar/';?>" method="POST">
                        <div class="card-block">
                            <h1>Login</h1>
                            <p class="text-muted">Ingrese las credenciales.</p>
                            <div class="form-group input-group mb-3">
                                <span class="input-group-addon"><i class="icon-user"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Username" name="username" id="username" class=" input username">
                            </div>
                            <div class="form-group input-group mb-4">
                                <span class="input-group-addon"><i class="icon-lock"></i>
                                </span>
                                <input type="password" class="form-control" placeholder="Password" name="password" id="password" class=" input password">
                            </div>
                            <div class="alert alert-danger alert-dismissable" style="display: none; padding: 6px; " id="mensaje">
								<span id="mensajeValidacion"></span>
							</div>
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary px-4">Inicias Sesi&oacute;n</button>
                                </div>
                                <div class="col-6 text-right">
                                    <!-- <button type="button" class="btn btn-link px-0">Forgot password?</button> -->
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="card card-inverse card-primary py-5 d-md-down-none" style="width:44%">
                        <div class="card-block text-center">
                            <div>
                                <img src="<?php echo PATH_IMAGES; ?>/san_gabriel.jpg" height="200px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and necessary plugins -->


    <script src="<?php echo PATH_JS; ?>/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo PATH_JS; ?>/tether.min.js"></script>
	<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
	<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>
	<script src="<?php echo PATH_JS; ?>/currentList.js"></script>
	<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">
   

    <script type="text/javascript">

						$(document).ready(function(){
							
							$('#frmLogin').formValidation({
						    	message: 'This value is not valid',
								feedbackIcons: {
									validating: 'glyphicon glyphicon-refresh'
								},
								fields: {			
									username: {
										message: 'El Usuario no es válido',
										validators: {
													notEmpty: {
														message: 'El Usuario no puede ser vacío.'
													},					
													regexp: {
														regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9-_ \.]+$/,
														message: 'Ingrese un Usuario válido.'
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
												regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9-_ \.]+$/,
												message: 'Ingrese una ContraseÃ±a válida.'
											}
										}
									},
													
									
								},								
							}) .on('success.form.fv', function(e) {
					            // Prevent form submission
					            e.preventDefault();

					            var $form = $(e.target),
					                fv    = $form.data('formValidation');

					            // Use Ajax to submit form data
					            $.ajax({
					                url: $form.attr('action'),
					                type: 'POST',
					                data: $form.serialize(),
					                dataType: 'json',
					                success: function(result) {
						                console.log(result)
					                	var obj = JSON.parse(JSON.stringify(result));
										 if( obj.band === 1 ){											
											 $("#mensajeValidacion").html(obj.data);
									     	 $("#mensaje").css('display','block');	
										 } else {
											 window.location = obj.data;
										      return false;
										 }
					                }
					            });
					        }).on('err.field.fv', function(e, data) {
				            data.element
				                .data('fv.messages')
				                .find('.help-block[data-fv-for="' + data.field + '"]').hide();
				        });


						
						});		
						</script>	
    

    
</body>

</html>
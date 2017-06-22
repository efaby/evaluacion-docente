<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
 <link rel="shortcut icon" type="image/x-icon" href="<?php echo PATH_IMAGES.'/favicon.ico'?>" />
    <title>SAM-W&L</title>
    <link href="<?php echo PATH_CSS; ?>/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo PATH_CSS; ?>/login.css" rel="stylesheet">
	<link href="<?php echo PATH_CSS; ?>/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

<div id="contenedor">

<div id="temafondo">
		<div id="logoindex">
		<div id="logoEspoch"><img src="<?php echo PATH_IMAGES; ?>/espoch-verde.svg" height="150px"></div>
		<div class="titulo">SAM-W&L</div>
		<div id="logo"><img src="<?php echo PATH_IMAGES; ?>/logo.png" height="50px"></div>
		
		</div>
        <div id="logosombra">
		</div>
        <div id="formsombra">
        </div>
	</div>
	
	<!--WRAPPER-->
	<div id="wrapper">
		<!--SLIDE-IN ICONS-->
    	<div class="user-icon"></div>
    	<div class="pass-icon"></div>
    	<!--END SLIDE-IN ICONS-->
<!--LOGIN FORM-->
<?php $url = $_SERVER["REQUEST_URI"];?>
<form  id="frmLogin" name="frmLogin" class="login-form form-signin" action="<?php echo (strpos($url, '/Seguridad/listar/'))?'../validar/':'Seguridad/validar/';?>" method="POST">


	<!--HEADER-->
    <div class="header">
    <!--TITLE--><h1>Autentificaci&oacute;n</h1><!--END TITLE-->
    <!--DESCRIPTION--><span>Ingrese su usuario, contrase&ntilde;a y tipo de usuario en el siguiente formulario.</span><!--END DESCRIPTION-->
   
	</div>
    <!--END HEADER-->
	<!--CONTENT-->
    <div class="content">
    
    <div class="form-group"> 
		<input name="username" id="username" type="text" placeholder="NOMBRE DE USUARIO" class=" input username"/>
	</div>
	<div class="form-group">
    	<input name="password" id="password" type="password" placeholder="CONTRASE&Ntilde;A" class="input password"/>
	</div>
	<div class="form-group">
		<select class="input selectTipo"  style="width:240px;" name="tipousuario" required>
		<option value=NULL>TIPO DE USUARIO</option>
		<?php foreach ($tipos as $item):?>
		<option value="<?php echo $item->id; ?>"><?php echo $item->nombre; ?></option>
		<?php endforeach;?>
		</select>
	</div>
    </div>
    <!--END CONTENT-->    
    <!--FOOTER-->
    <div class="alert alert-danger fade in alert-dismissable" style="display: none; padding: 6px; margin-left: 10px; margin-right: 10px;" id="mensaje">
				<span id="mensajeValidacion"></span>
			</div> 
    <div class="footer">
    <!--LOGIN BUTTON--><input type="submit" name="submit" value="INGRESAR" class="btn-primary btn" style="float: right" /><!--END LOGIN BUTTON-->
    </div>
    <!--END FOOTER-->

</form>
<!--END LOGIN FORM-->

</div>
<!--END WRAPPER-->


</div>

       
    
    <script src="<?php echo PATH_JS; ?>/jquery.min.js" type="text/javascript"></script>
    
	<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
	<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>
	<script src="<?php echo PATH_JS; ?>/currentList.js"></script>
	<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet"> 
    <script type="text/javascript">

						$(document).ready(function(){

							$(".username").focus(function() {
					    		$(".user-icon").css("left","-48px");
					    	});
					    	$(".username").blur(function() {
					    		$(".user-icon").css("left","0px");
					    	});
					    	
					    	$(".password").focus(function() {
					    		$(".pass-icon").css("left","-48px");
					    	});
					    	$(".password").blur(function() {
					    		$(".pass-icon").css("left","0px");
					    	});
							
							$('#frmLogin').formValidation({
						    	message: 'This value is not valid',
								feedbackIcons: {
									validating: 'glyphicon glyphicon-refresh'
								},
								fields: {			
									username: {
										message: 'El Usuario no es vÃ¡lido',
										validators: {
													notEmpty: {
														message: 'El Usuario no puede ser vacÃ­o.'
													},					
													regexp: {
														regexp: /^[a-zA-ZÃ¡Ã©Ã­Ã³ÃºÃ�Ã‰Ã�Ã“ÃšÃ±Ã‘0-9-_ \.]+$/,
														message: 'Ingrese un Usuario vÃ¡lido.'
													}
												}
											},	
									password: {
										message: 'La ContraseÃ±a no es vÃ¡lida',
										validators: {
											notEmpty: {
												message: 'La ContraseÃ±a no puede ser vacÃ­a.'
											},					
											regexp: {
												regexp: /^[a-zA-ZÃ¡Ã©Ã­Ã³ÃºÃ�Ã‰Ã�Ã“ÃšÃ±Ã‘0-9-_ \.]+$/,
												message: 'Ingrese una ContraseÃ±a vÃ¡lida.'
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
					        });


						
						});		
						</script>	
    

    
</body>

</html>
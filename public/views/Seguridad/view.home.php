<?php $title = "Inicio";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="row">
	<div class="col-lg-12">
    	<h1 class="page-header">Bienvenido <?php echo $_SESSION['SESSION_USER']->nombres; ?></h1>
   	</div>
</div>
<?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
		<div class="alert alert-success fade in alert-dismissable">
				<button type="button" class="close" data-dismiss="alert"
					aria-hidden="true">&times;</button>
								  <?php echo $_SESSION['message'];$_SESSION['message'] = ''?>
								</div>
		<?php endif;?>
<div class="row">
<div style="text-align: center;">
<img src="<?php echo PATH_IMAGES.'/mecanica.jpg'?>" style="width: 80%;  padding-top: 50px;" />
</div>
	
	</div>

<?php include_once PATH_TEMPLATE.'/footer.php';?>   
</body>
</html>
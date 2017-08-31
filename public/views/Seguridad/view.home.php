<?php $title = "Inicio";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="card">
<div class="card-header">
    	<h3 class="page-header">Bienvenido <?php echo $_SESSION['SESSION_USER']->nombres; ?></h3>
</div>
<div class="card-block">

<div style="text-align: center;">
<img src="<?php echo PATH_IMAGES; ?>/banner_eva5.jpg" style="width: 95%; padding-top: 30px; padding-bottom: 30px;" ></td>
</div>
	
	</div>

<?php include_once PATH_TEMPLATE.'/footer.php';?>   
</body>
</html>
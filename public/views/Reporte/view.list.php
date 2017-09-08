<?php $title = "Reporte";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="card">
<div class="card-header">
    	<h3>Reporte de Materias del Docente <?php echo $datos[0]->docente;?></h3>
</div>
<div class="card-block">
	<?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
		<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert"
					aria-hidden="true">&times;</button>
				  <?php echo $_SESSION['message'];$_SESSION['message'] = ''?>
		</div>
	<?php endif;?>
	<table class="table table-striped" id="dataTables-example" >
    <thead>
	    <tr>
	    	<th>Código</th>
	    	<th>Nombre</th>	    
	    	<th style="text-align: center; width: 20%">Acciones</th>
	    </tr>
    </thead>
    <tbody>
    	<?php foreach ($datos as $item) {
    		echo "<tr><td>".$item->id."</td>";
    		echo "<td>".$item->nombre."</td>";
    		echo "<td align='center'>
					<span class=ti-download></span><span class=icon-name>
						<a href='../verPdf/".$item->id."' target=_blank>Descargar
						</a>		
					</span>
				   </td></tr>";
    	}?>
    </tbody>
    </table>

</div>
</div>
<?php include_once PATH_TEMPLATE.'/footer.php';?>   
<link href="<?php echo PATH_CSS; ?>/dataTables.bootstrap.css" rel="stylesheet">
<script src="<?php echo PATH_JS; ?>/jquery.dataTables.min.js"></script>
<script src="<?php echo PATH_JS; ?>/dataTables.bootstrap.min.js"></script>
<script src="<?php echo PATH_JS; ?>/table.js"></script>
<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>
<script src="<?php echo PATH_JS; ?>/currentList.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">
</body>
</html>
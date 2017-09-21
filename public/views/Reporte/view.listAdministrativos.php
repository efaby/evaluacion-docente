<?php $title = "Materia/Docente";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="card">
<div class="card-header">
    	<h3>Listado de Directivos evaluadores de <?php echo $usuario->nombres ." ". $usuario->apellidos; ?></h3>
</div>
<div class="card-block">
	<table class="table table-striped" id="dataTables-example" >
    <thead>
	    <tr>
	    	<th>Código</th>
	    	<th>Nombres</th>			   
	    	<th>Apellidos</th>
	    	<th>Per&iacute;odo</th>
	    	<th style="text-align: center; width: 20%">Acciones</th>
	    </tr>
    </thead>
    <tbody>
    	<?php foreach ($datos as $item) {
    		$id = $item->id.'-'.$usuario->usuario_id;
    		echo "<tr><td>".$item->id."</td>";
    		echo "<td>".$item->nombres."</td>";
    		echo "<td>".$item->apellidos."</td>"; 
    		echo "<td>".$item->periodo."</td>";    		
    		echo "<td align='center'>
					<span class=ti-download></span><span class=icon-name>
						<a href='../verPdfAdmin/".$id."' target=_blank>Descargar
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
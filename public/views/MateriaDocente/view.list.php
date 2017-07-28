<?php $title = "Materia/Docente";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="card">
<div class="card-header">
    	<h3>Docentes</h3>
</div>
<div class="card-block">
	<table class="table table-striped" id="dataTables-example" >
    <thead>
	    <tr>
	    	<th>Código</th>
	    	<th>Nombres</th>			   
	    	<th>Apellidos</th>
	    	<th style="text-align: center; width: 20%">Acciones</th>
	    </tr>
    </thead>
    <tbody>
    	<?php foreach ($datos as $item) {
    		echo "<td>".$item->id."</td>";
    		echo "<td>".$item->nombres."</td>";
    		echo "<td>".$item->apellidos."</td>";
    		echo "<td align='center'>
						<a class='btn btn-warning btn-sm' href='../listarMaterias/".$item->id."' title='Editar'>
							<i class='fa fa-pencil'></i>
						</a>
					  	<a href='javascript:if(confirm(\"Est\u00e1 seguro que desea eliminar el elemento seleccionado?\")){redirect(".$item->id.");}' class='btn btn-danger btn-sm' title='Eliminar'>
							<i class='fa fa-trash'></i>
						</a>
		 		</td>";
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
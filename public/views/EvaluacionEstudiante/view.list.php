<?php $title = "Mis Evaluaciones";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="card">
<div class="card-header">
    	<h3>Evaluación Estudiante</h3>
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
	    	<th>Materia</th>
	    	<th>Curso</th>	    
	    	<th>Especialidad</th>
	    	<th>Fecha Evaluación</th>
		    <th style="text-align: center; width: 20%">Acciones</th>
	    </tr>
    </thead>
    <tbody>
    	<?php foreach ($datos as $item) {
    		echo "<tr><td>".$item->nombre."</td>";
    		echo "<td>".$item->curso."</td>"; 		
    		echo "<td>".$item->especialidad."</td>";
    		echo "<td>".$item->fecha_evaluacion."</td>";
    		echo "<td align='center'><a href='#' class='btn btn-warning btn-sm' data-id='".$item->matricula_evaluacion_id."' data-toggle='modal' data-target='#myModal' title='Evaluar' ><i class='fa fa-pencil'> </i></a>
					  
  		  		  </td> </tr>";
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
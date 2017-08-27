<form id="frmPreguntas" method="post" action="../guardareval/">
	<br>
	<div class="form-group col-sm-12">
		<table class="table table-striped" id="dataTables-example" >
			<thead>		
				<tr>
					<th>Código</th>
					<th>Pregunta</th>
					<th></th>					
				<tr>
			</thead>
    		<tbody>
		    		<?php 
						if(count($preguntas) >0){
							foreach ($preguntas as $pregunta){														
					?>							
					<tr>
						<td><?php echo $pregunta->id;?></td>
						<td><?php echo $pregunta->nombre;?></td>
						<td><input type='checkbox' name='pregunta_id[]'  value="<?php echo $pregunta->id;?>"></td>
					</tr>
					<?php } 
						}?>						
			</tbody>
		</table>			
	</div>
	<div class="form-group">
		<input type='hidden' name='eval_id' class='form-control' value="<?php echo $eval_id; ?>">
		<button type="submit" class="btn btn-success boton" id="boton">Guardar</button>
		<button type="button" class="btn btn-default boton" id="boton" data-dismiss="modal">Cancelar</button>
	</div>
</form>	

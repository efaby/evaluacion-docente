<form id="frmDocentes" method="post" action="../guardarDocentes/">
	<div class="form-group col-sm-12">
		<label class="control-label">Listado de Docentes</label>
	</div>
	<?php foreach ($docentes as $val) { ?>
		<div class="form-group col-sm-4">
			<input type='checkbox' name='docente_id[]' value="<?php echo $val->id;?>"> <?php echo $val->nombre;?>
		</div>
	<?php }?>	
	<br>
	<div class="form-group col-sm-12">
		<label class="control-label">Evaluación</label> 
		<select class='form-control' id="evaluacion_id" name="evaluacion_id">
			<option value="" >Seleccione</option>
		<?php foreach ($evaluaciones as $dato) { ?>
			<option value="<?php echo $dato->evaluacion_id;?>"><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>
	</div>	
	<div class="form-group">
		<input type='hidden' name='admin_id' class='form-control' value="<?php echo $admin_id; ?>">
		<button type="submit" class="btn btn-success boton" id="boton">Guardar</button>
		<button type="button" class="btn btn-default boton" id="boton" data-dismiss="modal">Cancelar</button>
	</div>	
</form>

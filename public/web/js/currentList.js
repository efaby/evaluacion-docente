
	$(document).on('show.bs.modal', '.modal', function (event) {
		 var button = $(event.relatedTarget) // Button that triggered the modal
		 var id = button.data('id') 
		$('.modal-body').load('../editar/' + id  ,function(result){	    
		});
	});
	function redirect(id){
		var url = '../eliminar/' + id;
		location.href = url;
	}
	
	function loadModalAction(id,action){
		$('.modal-body').load('../'+action+'/' + id,function(result){
			$('#titles').html('Asignar Tecnico');
			if(action=='reparar'){
				$('#titles').html('Reparar Novedad');
			}
		    $('#atenderNovedad').modal({show:true});
		});
	}
	
	$(document).on('show.bs.modal', '.modal1', function (event) {
		 var button = $(event.relatedTarget) // Button that triggered the modal
		 var id = button.data('id') 
		$('.modal-body').load('../listarPreguntas/' + id  ,function(result){	    
		});
	});
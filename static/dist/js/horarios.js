jQuery(document).ready(function($){

	$(".horario-edit").on('click',function(){
	 	var idHorario = $(this).attr('data-id');
	 	$("tr#tr-"+idHorario).load(base_url()+'portal-informatica-administracion-load-tr-horario/'+idHorario+"/1");
	 });
	$(".horario-cancel").on('click',function(){
	 	var idHorario = $(this).attr('data-id');
	 	$("tr#tr-"+idHorario).load(base_url()+'portal-informatica-administracion-load-tr-horario/'+idHorario+"/2");
	 });
	$("select#horario-add-plan").change(function(){
	 	var idPlan = $(this).val();
	 	$("select#horario-add-materia").load(base_url()+'portal-informatica-secretaria-academica-carga-academica-materias/'+idPlan);
	 });

	$("select#horario-add-plan").change(function(){
	 	var idPlan = $(this).val();
	 	//alert(idPlan);
	 	$("#add-materia-carga").load(base_url()+'portal-informatica-secretaria-academica-carga-academica-materias/'+idPlan);
	 });
	var pasa = true;
	$(".btn-horario-check").click(function(){
	 	var aula = $(this).attr('id');
	 	var width = document.getElementById('add-materia-carga').offsetWidth
	 	//alert(width);
	 	pasa = true;
	 	$("div#add-materia-carga").load(base_url()+'portal-informatica-secretaria-academica-aulas-load/'+aula+'/'+width);
	 });


	$("#hh-trigger-data").click(function(){
		var periodo = $("#hh-idPeriodo").val();
		var cveMaestro = $("#hh-cveProfesor").val();
		//console.log(periodo);
		//console.log(cveMaestro);
		$("div#load-horario-historico").load(base_url()+'portal-informatica-secretaria-academica-historico-load/'+periodo+'/'+cveMaestro);
	});
	var pasa1 = true;
	$(document).on('click','.btn-horario-check-hh',function(){
		 	var aula = $(this).attr('id');
		 	var periodo = $(this).attr('data-id');
		 	var cveMaestro = $(this).attr('data-row');
		 	//alert(width);
		 	pasa1 = true;
		 	$("div#add-materia-carga").load(base_url()+'portal-informatica-secretaria-academica-aulas-load-hh/'+aula+'/'+periodo+'/'+cveMaestro);
	});
	$(document).on('change','#idPlan-aula',function(){
		var idPlan = $(this).val();
		$("#actividad-idMateria").load("portal-informatica-secretaria-academica-load-extra-materias/"+idPlan);
	});
	$(document).on('click','#btn-cancel-add-actividad',function(){
		var width = $("#form-aula-horario-add").attr('data-id');
		if(!pasa){
			pasa = true; 
			$( "#form-aula-horario-add" ).animate({
			    left: "+="+width+"px"
			  }, 1000, function() {
			    // Animation complete.
			});	
		}
	}); 
	$(document).on('click','.item-horario',function(){
	 	var width = $("#form-aula-horario-add").attr('data-id');
	 	var dia = $(this).attr('data-id');
	 	var hora = $(this).attr('data-row');
	 	$("#hrI-data").html('<option value="'+hora+'">'+hora+' hrs.</option>');
	 	var diaText = ''; 
	 	dia--;
	 	switch(dia){
	 		case 1: 
	 			diaText = "Lunes";
	 			break; 
	 		case 2: 
	 			diaText = "Martes";
	 			break; 
	 		case 3: 
	 			diaText = "Miercoles";
	 			break; 
	 		case 4: 
	 			diaText = "Jueves";
	 			break; 
	 		case 5: 
	 			diaText = "Viernes";
	 			break; 	
	 	}

	 	$("#dia-data").html('<option value="'+dia+'">'+diaText+'</option>');
	 	var dataHtml = ''; 
	 	var rango = parseInt(hora) + 1; 
	 	
	 	for(var i = rango ; i <= 20 ; i++ ){
	 		dataHtml += '<option value="'+i+'">'+i+' hrs.</option>'; 
	 		
	 	}

	 	//alert(dataHtml);
	 	$("#hrF-data").html(dataHtml);
		//alert(width);
		if(pasa){
			pasa = false; 
			$( "#form-aula-horario-add" ).animate({
			    left: "-="+width+"px"
			  }, 1000, function() {
			    // Animation complete.
			});	
		}
		
	 });


	 $(".horario-delete").on('click',function(){
	 	var texto = $(this).val();
	 	$.ajax({
			url : base_url()+"portal-informatica-validar-usuario",
			dataType : 'json',
			type : 'POST',
			data : "usuario="+texto,
			success : function(data) {
				//$("div#load-info-califiaciones").html(data.html)
			}
		})
	 })
	 

	 var flagFormAdd = true; 
	 $(document).on('click','.btn-add-profesor-materia',function(){
	 	var id = $(this).attr('data-id');
	 	//alert(id);
	 	if(flagFormAdd){
	 		flagFormAdd = false;
	 		$("#form-"+id).stop().slideDown(0);
	 		$("#btn-"+id).html('<i class="fa fa-times"></i> Cancelar');
	 	} else {
	 		flagFormAdd = true;
	 		$("#form-"+id).stop().slideUp(0);
	 		$("#btn-"+id).html('<i class="fa fa-plus"></i> Asignar a profesor');
	 	}
	 });
	 



	 $(document).on('submit','.form-add-materia-profesor',function(event){
	 	event.preventDefault();
	 	var str = $(this).serialize();
	 	$.ajax({
			url : base_url()+'portal-informatica-secretaria-academica-carga-academica-add-profesor',
			dataType : 'json',
			type : 'POST',
			data : str,
			success : function(data) {
				if(data.response == 'true'){
					if(data.v == 1){
						$("#tbody-item-"+data.idMateria).append(data.html);	
					} else {
						$("#div-item-"+data.idMateria).html(data.html);
					}
					

					$("#error-modal .modal-dialog > .modal-content > .modal-body").stop().html('<span style="width:100%; text-align:center; display:block;"> <i class="fa fa-check-circle fa-4x"></i> <br/>Información agregada satisfactoriamente.</span>');
					$('#error-modal').modal('show');
				} else {
					$("#error-modal .modal-dialog > .modal-content > .modal-body").html('Ocurrió un error al agregar tu información, intenta nuevamente.');
					$('#error-modal').modal('show');
				}
			}
		})
	 });
	 $(document).on('submit','.form-edit-materia-profesor',function(event){
	 	event.preventDefault();
	 	var str = $(this).serialize();
	 	$.ajax({
			url : base_url()+'portal-informatica-secretaria-academica-carga-academica-edit-profesor',
			dataType : 'json',
			type : 'POST',
			data : str,
			success : function(data) {
				if(data.response == 'true'){
					$("#tr-item-carga-horaria-"+data.id).remove();
					$("#tbody-item-"+data.idMateria).append('<tr id="tr-item-carga-horaria-'+data.id+'">'
						+'<td id="hr-'+data.id+'-grupo" >'+data.grupo+'</td>'
						+'<td id="hr-'+data.id+'-prof">'+data.nombre+'</td>'
						+'<td>'
						+'<button type="button" class="btn btn-default hr-edit-grpo" data-id="'+data.id+'" data-row="'+data.grupo+'">'
						+'<i class="fa fa-edit"></i>'
						+'</button> '
						+'</td>'
						+'<td>'
						+'<button type="button" class="btn btn-default hr-delete-prof" id="'+data.id+'">'
						+'<i class="fa fa-times"></i>'
						+'</button>'
						+'</td></tr>');

					$("#error-modal .modal-dialog > .modal-content > .modal-body").stop().html('<span style="width:100%; text-align:center; display:block;"> <i class="fa fa-check-circle fa-4x"></i> <br/>Información agregada satisfactoriamente.</span>');
					$('#error-modal').modal('show');
				} else {
					$("#error-modal .modal-dialog > .modal-content > .modal-body").html('Ocurrió un error al agregar tu información, intenta nuevamente.');
					$('#error-modal').modal('show');
				}
			}
		})
	 });



	 $(document).on('click','.hr-edit-grpo',function(){
	 	var idHorario = $(this).attr('data-id');
	 	var idMateria = $(this).attr('data-row');
	 	
	 	$.ajax({
			url : base_url()+'portal-informatica-secretaria-academica-carga-academica-get-horario',
			dataType : 'json',
			type : 'POST',
			data : "idHorario="+idHorario+"&idMateria="+idMateria,
			success : function(data) {
				if(data.response == 'true'){
					$("#tr-item-carga-horaria-"+idHorario).remove();
					$("#tbody-item-"+idMateria).stop().append(data.html);
				} else {
					$("#error-modal .modal-dialog > .modal-content > .modal-body").html('Ocurrió un error al actualizar tu información, intenta nuevamente.');
					$('#error-modal').modal('show');
				}
			}
		})

	 });
	 $(document).on('click','.cancel-action',function(){
	 	var idHorario = $(this).attr('data-id');
	 	var idMateria = $(this).attr('data-row');
	 	$.ajax({
			url : base_url()+'portal-informatica-secretaria-academica-carga-academica-cancel-get-horario',
			dataType : 'json',
			type : 'POST',
			data : "idHorario="+idHorario+"&idMateria="+idMateria,
			success : function(data) {
				if(data.response == 'true'){
					$("#tr-item-carga-horaria-"+idHorario).remove();
					$("#tbody-item-"+idMateria).append(data.html);
				} else {
					$("#error-modal .modal-dialog > .modal-content > .modal-body").html('Ocurrió un error al actualizar tu información, intenta nuevamente.');
					$('#error-modal').modal('show');
				}
			}
		})
	 });
	 $(document).on('click','.hr-delete-prof',function(){
	 	var id = $(this).attr('id');
	 	
	 	$.ajax({
			url : base_url()+'portal-informatica-secretaria-academica-carga-academica-delete',
			dataType : 'json',
			type : 'POST',
			data : "idHorario="+id,
			success : function(data) {
				if(data.response == 'true'){
					$("#tr-item-carga-horaria-"+id).slideUp();

					$("#error-modal .modal-dialog > .modal-content > .modal-body").stop().html('<span style="width:100%; text-align:center; display:block;"> <i class="fa fa-check-circle fa-4x"></i> <br/>Información eliminada satisfactoriamente.</span>');
					$('#error-modal').modal('show');
				} else {
					$("#error-modal .modal-dialog > .modal-content > .modal-body").html('Ocurrió un error al eliminar tu información, intenta nuevamente.');
					$('#error-modal').modal('show');
				}
			}
		})
	 });

	 $(document).on('click','.delete-item-horario-ajax',function(event){
	 	event.preventDefault(); 
	 	var id = $(this).attr('href');
	 	var dia = $(this).attr('data-id');
	 	dia1 = dia-1;
	 	$.ajax({
			url : base_url()+'portal-informatica-secretaria-academica-carga-academica-delete',
			dataType : 'json',
			type : 'POST',
			data : "idHorario="+id+"&dia="+dia1,
			success : function(data) {
				if(data.response == 'true'){
					$("#item-"+id+'-'+dia).slideUp();

					$("#error-modal .modal-dialog > .modal-content > .modal-body").stop().html('<span style="width:100%; text-align:center; display:block;"> <i class="fa fa-check-circle fa-4x"></i> <br/>Información eliminada satisfactoriamente.</span>');
					$('#error-modal').modal('show');
				} else {
					$("#error-modal .modal-dialog > .modal-content > .modal-body").html('Ocurrió un error al eliminar tu información, intenta nuevamente.');
					$('#error-modal').modal('show');
				}
			}
		})
	 });
	 

	 $("#eliminar-todo-form").submit(function(event){
	 	
	 	if(confirm("¿Desea eliminar la carga actual?")){
	 		return true; 
	 	} else {
	 		event.preventDefault();
	 		return false; 
	 	}
	 });
	 var flagBtnAula = true; 
	 $("#trigger-btn-aulas").click(function(){
	 	if(flagBtnAula){
	 		flagBtnAula= false; 
	 		$("#trigger-btn-aulas").stop().html('<i class="fa fa-minus-square-o fa-2x"></i>');
	 		$("#body-aulas").stop().slideDown();
	 	} else {
	 		flagBtnAula= true;
	 		$("#trigger-btn-aulas").stop().html('<i class="fa fa-plus-square-o fa-2x"></i>');
	 		$("#body-aulas").stop().slideUp();
	 	}
	 });
	
	$(".btn-horario-materia").click(function(){
	 	var aula = $(this).attr('id');
	 	//alert(width);
	 	pasa = true;
	 	$("div#add-horario-materia").load(base_url()+'portal-informatica-secretaria-academica-aulas-load/'+aula+'/'+width);
	 });
	$("#idPlan-schedule").change(function(){
		var idPlan = $(this).val();
		var bloque = $("select#bloque-schedule").val();
		$("div#materiasXplan").load(base_url()+'portal-informatica-secretaria-academica-load-materias-schedule/'+idPlan+'/'+bloque)
	});
	$("button#reload-materias").click(function(){
		var idPlan = $("select#idPlan-schedule").val();
		var bloque = $("select#bloque-schedule").val();
		$("div#materiasXplan").load(base_url()+'portal-informatica-secretaria-academica-load-materias-schedule/'+idPlan+'/'+bloque)
	});

	$("#aula-list").change(function(){
		var aula = $(this).val();
		$("div#horario-grid").load(base_url()+'portal-informatica-secretaria-academica-load-aulas-schedule/'+aula)
	});
	 $(document).on('click','button#aula-list-reload',function(event){
		var aula = $(this).attr('data-id');
		$("div#horario-grid").load(base_url()+'portal-informatica-secretaria-academica-load-aulas-schedule/'+aula)
	});
	/*

	 var altura = $("#panel-contro-consola").offset().top; 
                         
      $(window).scroll(function(){
             
            if($(window).scrollTop() >= altura){
                  var calculo =    $(window).scrollTop() - altura; 
                  calculo = calculo +100; 
                 $("#horario-grid").css("margin-bottom",calculo+"px");

                 //$("#horario-grid").animate("position","fixed");
                               
            }else{
                                     
                 $("#horario-grid").css("margin-top","100px");
                 $("#horario-grid").css("position","relative");
                               
            }
                         
      });*/
      /*
      $( ".draggable" ).on( "dragstop", function( event, ui ) {
      		console.log(event)
    	console.log(ui)

      } );*/
      var flagBtnAddAula = 0; 
      $("#add-btn-aula").click(function(event){
      	event.preventDefault(); 
      	if(flagBtnAddAula == 1){
      		flagBtnAddAula = 0; 
      		$("#add-btn-aula").stop().html('<i class="fa fa-plus"></i>'); 
      		$("#add-form-aula").stop().slideUp();

      	} else {
      		flagBtnAddAula = 1;
      		$("#add-btn-aula").stop().html('<i class="fa fa-minus"></i>'); 
      		$("#add-form-aula").stop().slideDown();
      	}
      });
      $(document).on('click','.edit-aula-form',function(event){
		 	var idAula = $(this).attr('data-id');
		 	//alert(idAula);
		 	//pasa = true;
		 	
		 	$("tr#aula-"+idAula).load(base_url()+'portal-informatica-secretaria-academica-configuracion-aulas-edit/'+idAula);
		});
      $(document).on('click','.cancel-action-aula',function(event){
		 	var idAula = $(this).attr('data-id');
		 	//alert(idAula);
		 	//pasa = true;
		 	
		 	$("tr#aula-"+idAula).load(base_url()+'portal-informatica-secretaria-academica-configuracion-aulas-cancel/'+idAula);
		});

      // Add Groups to preregistros.

      $(document).on('click','.add-input-group',function(event){
      		event.preventDefault(); 
		 	var idMateria = $(this).attr('data-id');
		 	var html = '<input type="text" name="grupo[]" class="form-control input-add-grupo-'+idMateria+'" style="margin-top:5px;"/>'; 
		 	$("#groups-"+idMateria).append(html); 	
		 	
	   });
      $(document).on('click','.delete-input-group',function(event){
      		event.preventDefault(); 
		 	var idMateria = $(this).attr('data-id');
		 	//$("#groups-"+idMateria).append(html); 	
		 	$('div#groups-'+idMateria+' input:last-child').remove();
	   });
      $(document).on('click','.add-grupo',function(event){
      		event.preventDefault(); 
		 	var idMateria = $(this).attr('data-id');

		 	if($("#add-grupo-"+idMateria).hasClass('abierto')){
		 		$("#add-grupo-"+idMateria).stop().removeClass('abierto'); 
		 		$("#add-grupo-"+idMateria).stop().addClass('cerrado'); 
		 		$("#add-grupo-"+idMateria).stop().slideUp();
		 	} else {
		 		$("#add-grupo-"+idMateria).stop().removeClass('cerrado'); 
		 		$("#add-grupo-"+idMateria).stop().addClass('abierto'); 
		 		$("#add-grupo-"+idMateria).stop().slideDown();
		 	}
	   });
      $(document).on('click','.li-delete-grupo',function(event){
      		event.preventDefault(); 
      		//alert('asfasf'); 
		 	var idHorario = $(this).attr('data-id');
		 	//alert(idHorario);
		 	if(confirm('¿Desea eliminar el grupo?')){
		 		$.ajax({
					url : base_url()+'portal-informatica-secretaria-academica-delete-grupo',
					dataType : 'json',
					type : 'POST',
					data : "idHorario="+idHorario,
					success : function(data) {
						if(data.response == 'true'){
							$("#li-grupo-add-"+idHorario).remove();
							$("#error-modal .modal-dialog > .modal-content > .modal-body").html('Grupo eliminado con éxito.');
							$('#error-modal').modal('show');
						} else {
							$("#error-modal .modal-dialog > .modal-content > .modal-body").html('Ocurrió un error al eliminar la información, intentalo nuevamente.');
							$('#error-modal').modal('show');
						}
					}
				})
		 	}
		 	
		 	
	   });
      $(document).on('change','.cve-maestro-carga',function(event){
      		
      		//alert('asfasf'); 
		 	var idHorario  = $(this).attr('data-id');
		 	var cveMaestro = $(this).val();
		 	//alert(idHorario); 
		 	
		 	$("div#list-profesor-materia-"+idHorario).load(base_url()+'portal-informatica-secretaria-academica-carga-academica-get-profesor-materias/'+cveMaestro)
		 	
		 	
	   });      
});


	function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        var idHorario = document.getElementById(data).getAttribute("data-id");
        var idDia = document.getElementById(data).getAttribute("data-diaf");
        //console.log(document.getElementById(data));
        var dia = ev.target.getAttribute("data-dia");
        dia = dia - 1 ; 
        var hrI = ev.target.getAttribute("data-hi");
        var hrF = ev.target.getAttribute("data-hrf");
        var aula = ev.target.getAttribute("data-aula");
        ev.target.appendChild(document.getElementById(data));
        $.ajax({
			url : base_url()+'portal-informatica-secretaria-academica-add-schedule',
			dataType : 'json',
			type : 'POST',
			data : "idHorario="+idHorario+"&diaf="+idDia+"&dia="+dia+"&hri="+hrI+"&hrf="+hrF+"&aula="+aula,
			success : function(data) {
				if(data.response == 'true'){
					
				} else {
					
				}
			}
		})
    }


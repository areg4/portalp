jQuery(document).ready(function($){
	var flagBtnAddAula = 0; 
      var flagBtnAddMaestro = 0;
      var flagBtnAddPlan = 0; 
      var flagBtnAddMateria = 0;
      var flagBtnAddAviso = 0;

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


      // $(document).on('click', '.add-aula', function(event){
      //       aula = $('#aula').val();
      //       descripcion = $('#descripcion').val();
      //       tipo = $('#tipo').val();
      //       asignable = $('#asignable').val();

      //       if (aula!="" && descripcion!="" && tipo!="" && asignable!="") {
      //             msj = aula+"\n"+descripcion+"\n"+tipo+"\n"+asignable;
      //             alert(msj);



      //       }else{
      //             alert("Favor de llenar todos los datos");
      //       }
      // });

      $("#add-btn-maestro").click(function(event){
            event.preventDefault(); 
            if(flagBtnAddMaestro == 1){
                  flagBtnAddMaestro = 0; 
                  $("#add-btn-maestro").stop().html('<i class="fa fa-plus"></i>'); 
                  $("#add-form-maestro").stop().slideUp();

            } else {
                  flagBtnAddMaestro = 1;
                  $("#add-btn-maestro").stop().html('<i class="fa fa-minus"></i>'); 
                  $("#add-form-maestro").stop().slideDown();
            }
      });
      $(document).on('click','.edit-maestro-form',function(event){
                  var idMaestro = $(this).attr('data-id');
                  //alert(idAula);
                  //pasa = true;
                  
                  $("tr#maestro-"+idMaestro).load(base_url()+'portal-informatica-secretaria-academica-configuracion-maestros-edit/'+idMaestro);
            });
      $(document).on('click','.cancel-action-maestro',function(event){
                  var idMaestro = $(this).attr('data-id');
                  //alert(idAula);
                  //pasa = true;
                  
                  $("tr#maestro-"+idMaestro).load(base_url()+'portal-informatica-secretaria-academica-configuracion-maestros-cancel/'+idMaestro);
            });


      $("#add-btn-plan").click(function(event){
            event.preventDefault(); 
            if(flagBtnAddPlan == 1){
                  flagBtnAddPlan = 0; 
                  $("#add-btn-plan").stop().html('<i class="fa fa-plus"></i>'); 
                  $("#add-form-plan").stop().slideUp();

            } else {
                  flagBtnAddPlan = 1;
                  $("#add-btn-plan").stop().html('<i class="fa fa-minus"></i>'); 
                  $("#add-form-plan").stop().slideDown();
            }
      });
      $(document).on('click','.edit-plan-form',function(event){
                  var idPlan = $(this).attr('data-id');
                  //alert(idAula);
                  //pasa = true;
                  
                  $("tr#plan-"+idPlan).load(base_url()+'portal-informatica-secretaria-academica-configuracion-planes-edit/'+idPlan);
            });
      $(document).on('click','.cancel-action-plan',function(event){
                  var idPlan = $(this).attr('data-id');
                  //alert(idAula);
                  //pasa = true;
                  
                  $("tr#plan-"+idPlan).load(base_url()+'portal-informatica-secretaria-academica-configuracion-planes-cancel/'+idPlan);
            });


      $("#add-btn-materia").click(function(event){
            event.preventDefault(); 
            if(flagBtnAddMateria == 1){
                  flagBtnAddMateria = 0; 
                  $("#add-btn-materia").stop().html('<i class="fa fa-plus"></i>'); 
                  $("#add-form-materia").stop().slideUp();

            } else {
                  flagBtnAddMateria = 1;
                  $("#add-btn-materia").stop().html('<i class="fa fa-minus"></i>'); 
                  $("#add-form-materia").stop().slideDown();
            }
      });
      $(document).on('click','.edit-materia-form',function(event){
                  var idMateria = $(this).attr('data-id');
                  //alert(idAula);
                  //pasa = true;
                  
                  $("tr#materia-"+idMateria).load(base_url()+'portal-informatica-secretaria-academica-configuracion-materias-edit/'+idMateria);
            });
      $(document).on('click','.cancel-action-materia',function(event){
                  var idMateria = $(this).attr('data-id');
                  //alert(idAula);
                  //pasa = true;
                  
                  $("tr#materia-"+idMateria).load(base_url()+'portal-informatica-secretaria-academica-configuracion-materias-cancel/'+idMateria);
            });

      
      //acciones de cambios de email y cubiculo de profesor
      $(document).on('click','.edit-Correo-Cubiculo-Profe',function(event){
            
            var idProfe = $(this).attr('data-id');
            // alert(idProfe);
            //pasa = true;
            
            $("#panelDatosProfe").load(base_url()+'portal-informatica-mi-cuenta-cambiar-email-cubiculo/'+idProfe);
      });

      $(document).on('click','.cancel-action-edit-email-cubiculo',function(event){
            // var idProfe = $(this).attr('data-id');
            // alert(idMateria);
            //pasa = true;
            
            // $(document).load(base_url()+'portal-informatica-mi-cuenta');
            $(location).attr('href', base_url()+'portal-informatica-mi-cuenta');
      });

      // sección de avisos
      $("#add-btn-aviso").click(function(event){
            event.preventDefault(); 
            if(flagBtnAddAviso == 1){
                  flagBtnAddAviso = 0; 
                  $("#add-btn-aviso").stop().html('<i class="fa fa-plus"></i>'); 
                  $("#add-form-aviso").stop().slideUp();

            } else {
                  flagBtnAddAviso = 1;
                  $("#add-btn-aviso").stop().html('<i class="fa fa-minus"></i>'); 
                  $("#add-form-aviso").stop().slideDown();
            }
      });
      $(document).on('click','.edit-aviso-form',function(event){
                  var idAviso = $(this).attr('data-id');
                  //alert(idAula);
                  //pasa = true;
                  
                  $("tr#aviso-"+idAviso).load(base_url()+'portal-informatica-secretaria-academica-avisos-edit/'+idAviso);
            });
      $(document).on('click','.cancel-action-aviso',function(event){
                  var idAviso = $(this).attr('data-id');
                  //alert(idAula);
                  //pasa = true;
                  
                  $("tr#aviso-"+idAviso).load(base_url()+'portal-informatica-secretaria-academica-avisos-cancel/'+idAviso);
            });

      $(document).on('click','.edit-aviso-form-coord',function(event){
                  var idAviso = $(this).attr('data-id');
                  //alert(idAula);
                  //pasa = true;
                  
                  $("tr#aviso-"+idAviso).load(base_url()+'portal-informatica-coord-avisos-edit/'+idAviso);
            });

      $(document).on('click','.cancel-action-aviso-coord',function(event){
                  var idAviso = $(this).attr('data-id');
                  //alert(idAula);
                  //pasa = true;
                  
                  $("tr#aviso-"+idAviso).load(base_url()+'portal-informatica-coord-avisos-cancel/'+idAviso);
            });

      $(document).on('click','.edit-aviso-form-controlE',function(event){
                  var idAviso = $(this).attr('data-id');
                  //alert(idAula);
                  //pasa = true;
                  
                  $("tr#aviso-"+idAviso).load(base_url()+'portal-informatica-control-escolar-avisos-edit/'+idAviso);
            });
      $(document).on('click','.cancel-action-aviso-controlE',function(event){
                  var idAviso = $(this).attr('data-id');
                  //alert(idAula);
                  //pasa = true;
                  
                  $("tr#aviso-"+idAviso).load(base_url()+'portal-informatica-control-escolar-avisos-cancel/'+idAviso);
            });
});
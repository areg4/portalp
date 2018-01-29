jQuery(document).ready(function($){
	$(".btn-show-info").click(function(){
		var folio = $(this).attr('data-id');
		$("#data-dynamic").load(base_url()+'alumno/getHistoricoTicket/'+folio);
		$("#myModalLabel").html("Histórico de ticket F-"+folio);
	});

	$(".btn-close-ticket").click(function(){
		var folio = $(this).attr('data-id');
		var continuar = confirm("¿Deseas concluir el ticket F-"+folio+" ?");
		if(continuar){
			$.ajax({
                url: base_url()+'alumno/cerrarTicketUpdate/',
                dataType: 'json',
                type: "POST",
                cache: false,
                data : "folio="+folio,
				success : function(data) {
					if(data.response == 'true'){
						location.reload();
					}
				}
            });
		}
	});
	
});

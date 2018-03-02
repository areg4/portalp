jQuery(document).ready(function($){

	$("select#periodoSa").change(function(){
	 	var texto = $(this).val();
	 	$.ajax({
			url : base_url()+"portal-informatica-secretaria-academica-change-periodo",
			dataType : 'json',
			type : 'POST',
			data : "idPeriodo="+texto,
			success : function(data) {
				if(data.response == 'true'){
					location.reload(true);
				} else {
					$('#error-modal').modal('show');
				}
			}
		})
	 })

	//Des habilitar botones de envio de formulario on submit
	 $("form.form").submit(function(){
	 	$("button.submit").attr('disabled','disabled');
	 });
	 /* fin de deshabilitar los botones de envio*/
	 $('.toggle-option').bootstrapToggle();

	 $('.fancy-checkbox').checkboxpicker({
	  html: true,
	  offLabel: '<span class="glyphicon glyphicon-remove">',
	  onLabel: '<span class="glyphicon glyphicon-ok">'
	});
	 var flag = 1; 
	 $('.dropdown-modulo').click(function(){
	 	var id = $(this).attr('id');
	 	if(flag == 1){
	 		flag = 0; 
	 		$(this).html('<i class="fa fa-minus"></i>');
	 		$("#table-"+id).stop().slideDown(0);
	 	} else {
	 		flag = 1; 
	 		$(this).html('<i class="fa fa-plus"></i>');
	 		$("#table-"+id).stop().slideUp(0);
	 	}
	 	
	 })
	 $("select#idSistema").change(function(){
	 	var idSistema = $(this).val();
	 	$("select#idModulo").load(base_url()+'portal-informatica-administracion-load-modulos-by-sistema/'+idSistema);
	 });

	 $("input#usuario").focusout(function(){
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
	 $(".item").click(function() {
	 	var idMateria = $(this).attr('id');
	 	var cve = $(this).attr('data-cve');
	 	var materia = $(this).attr('data-id');
	 	var bloque = $(this).attr('data-bloque');
	 	var creditos = $(this).attr('data-cred');
	 	var html = '';
	 	//alert(idMateria)
	 	if($(this).hasClass('active')){
	 		$(this).removeClass('active');
	 		$(this).addClass('shadow'); 
	 		$("input#materia-"+idMateria).prop('checked',false);
	 		$("#row-"+idMateria).remove();
	 	} else {
	 		$(this).addClass('active');
	 		$(this).removeClass('shadow');
	 		$("input#materia-"+idMateria).prop('checked', true);
	 		html = funcion_htmlTr(idMateria,cve, materia, bloque, creditos);
	 		$("#table-body-selected-materias").append(html);
	 	}
	 	
	 });
	 $("#btn-clean-form").click(function() {
		 $(".input-materia").prop('checked',false);
		 $(".item").removeClass('active');
		 $("#table-body-selected-materias").html('');
	 });
	 
	 $('#btn-confirm-form').on('click', function(e){
		    var $form=$(this).closest('form'); 
		    e.preventDefault();
		    $('#confirm').modal({ backdrop: 'static', keyboard: false })
		        .one('click', '#delete', function() {
		            $form.trigger('submit'); // submit the form
		        });
		        // .one() is NOT a typo of .on()
		});
	 
	 $("select#optionFiltroHorario").change(function(){
	 	var tipo =  $(this).val();
	 	$("select#dataFiltro").load(base_url()+'portal-informatica-administracion-horarios-filtro/'+tipo);	
	 })

	
	
	
	$('.trigger-evento').click(function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		if($(this).hasClass('evento-close')){
			$(this).stop().removeClass('evento-close');
			$(this).stop().addClass('evento-open');
			$("#trigger-evento-"+id).stop().html('<i class="fa fa-minus"></i>');
			$("#evento-"+id).stop().slideDown();
		} else {
			$(this).stop().removeClass('evento-open');
			$(this).stop().addClass('evento-close');
			$("#trigger-evento-"+id).stop().html('<i class="fa fa-plus"></i>');
			$("#evento-"+id).stop().slideUp();
		}
	});
}); // FIN DE LOAD



function funcion_htmlTr(idMateria,cve, materia, bloque, creditos){
	var html = ''; 
	html += '<tr id="row-'+idMateria+'">';
	html += '<td>'+cve+'</td>';
	html += '<td>'+materia+'</td>';
	html += '<td>'+bloque+'</td>';
	html += '<td>'+creditos+'</td>';
	html += '</tr>';
	return html;
}

function verModal(tipo, texto, textoBtnSi,textoBtnNo, parrafo) {
	bgNegro = document.getElementById('bg-negro');
	modal = document.getElementById('modal');

	bgNegro.classList.add('verModal');
	modal.classList.add('verModal');

	if (tipo == 'chico') {
		parrafo = ""
	}else{
		parrafo = parrafo;
	}

	modal.innerHTML="<h1>"+texto+"</h1>"+
		"<p>"+parrafo+"</p>"+
		"<div class='div2'></div>"+
		"<button onclick='success()' class='div4 menta'>"+textoBtnSi+"</button>"+
		"<button onclick='cerrar()' class='div4 menta'>"+textoBtnNo+"</button>";

	modal.classList.add('chico');

	tipo = tipo;
}
function success(){
	return true; 
}

function cerrar () {
	bgNegro.classList.remove('verModal');
	modal.classList.remove('verModal');

	if (modal.classList.contains('chico')) {
		modal.classList.remove('chico');
	}else{
		modal.classList.remove('grande');
	}
	return false; 
}

// funciones fer
function cambiarIcon(id){
	imagen = document.getElementById(id);
	imagen.src = "http://localhost/portalp/static/img/upload.png";
}
function cambiarI(id){
	imagen1 = document.getElementById(id);
	imagen1.src = "http://localhost/portalp/static/img/upload.png";
}
function bajar(){
	document.querySelector('.bajar').classList.add('ver-bajar');
}
function quitar(){
	document.querySelector('.bajar').classList.remove('ver-bajar');
}
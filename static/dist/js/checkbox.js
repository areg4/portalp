jQuery(document).ready(function($){
	var totales = 0; 
	$("input.radio-response").click(function(){
		var val 	= $(this).val();
		var nombre 	= $(this).attr('name')
		totales 	= totales + parseInt(val); 
		$('[name="'+nombre+'"]').prop('disabled', true)
		alert(totales);
	});
});
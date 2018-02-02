jQuery(document).ready(function($){

  $("#btnTramite").click(function(){
    // alert("hoa");
    var tipoTramiteA = $("#tipoTramiteA").val();
    window.location.href = base_url()+'portal-informatica-alumnos-tramites-alta';
    // alert(tipoTramiteA);
  });

  $(".tr-notifi-alumno").click(function(){
    var data = $(this).attr('data');
    alert(data);
    window.location.href = base_url()+'portal-informatica-alumnos-tramites-datos/'+data;
  });


  // $(".btn-horario-check").click(function(){
  //   var aula = $(this).attr('id');
  //   var width = document.getElementById('add-materia-carga').offsetWidth
  //   //alert(width);
  //   pasa = true;
  //   $("div#add-materia-carga").load(base_url()+'portal-informatica-secretaria-academica-aulas-load/'+aula+'/'+width);
  //  });

});

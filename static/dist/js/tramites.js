jQuery(document).ready(function($){

  $(".btnTramite").click(function(){
    // alert("hoa");
    // var tipoTramiteA = $("#tipoTramiteA").val();
    // var data = $(this).attr('data');
    var dataId = $(this).attr('data-id-T');
    // alert(data);
    window.location.href = base_url()+'portal-informatica-alumnos-tramites-alta/'+dataId;
    // alert(tipoTramiteA);
  });

  $(".tr-notifi-alumno").click(function(){
    var data = $(this).attr('data');
    // alert(data);
    window.location.href = base_url()+'portal-informatica-alumnos-tramites-datos/'+data;
  });

  $(".tr-notifi").click(function(){
    var data = $(this).attr('data');
    // alert($(this).attr('data'));
    window.location.href = base_url()+'portal-informatica-tramites-datos/'+data;
  });

  $(".btnUpdateFile").click(function() {
    var idRT = $(this).attr('data-id');
    var fkRu = $("#file-"+idRT).val();
    if(fkRu != ""){
      var formData = new FormData($("#form-update-file-id-"+idRT)[0]);
      console.log(formData);
      $.ajax({
        url: base_url()+"portal-informatica-alumnos-tramites-updateFile",
        type: 'post',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success:function(response) {
          // alert(response);
          // window.location.href = base_url()+'portal-informatica-alumnos-tramites-datos/'+response;
          window.location.reload();
        }
      });
    }
    // alert(idRT);
  });

  $(".btn-enviar-revision").click(function() {
    var idTramite = $(this).attr('data-id');
    parametros = {
      'idTramite' : idTramite
    };

    $.ajax({
      url: base_url()+"portal-informatica-alumnos-tramites-updateTramite",
      type: 'post',
      data: parametros,
      success:function(data) {
        // alert(response);
        // window.location.href = base_url()+'portal-informatica-alumnos-tramites-datos/'+response;
        window.location.reload();
      }
    });
    // alert(idRT);
  });


  // $(".btn-horario-check").click(function(){
  //   var aula = $(this).attr('id');
  //   var width = document.getElementById('add-materia-carga').offsetWidth
  //   //alert(width);
  //   pasa = true;
  //   $("div#add-materia-carga").load(base_url()+'portal-informatica-secretaria-academica-aulas-load/'+aula+'/'+width);
  //  });

});

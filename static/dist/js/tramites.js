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

  $(".tr-notifi-investigacion").click(function(){
    var data = $(this).attr('data');
    // alert($(this).attr('data'));
    window.location.href = base_url()+'portal-informatica-investigacion-tramite-datos/'+data;
  });

  $(".tr-notifi-consejo").click(function(){
    var data = $(this).attr('data');
    // alert($(this).attr('data'));
    window.location.href = base_url()+'portal-informatica-consejo-tramite-datos/'+data;
  });

  $(".ArchivoNuevo").change(function () {
    $(".btnUpdateFile").click();
  });

  $(".btnUpdateFile").click(function() {
    // alert("update");
    var idRT      = $(this).attr('data-id');
    var fkRu      = $("#file-"+idRT).val();
    var idTramite = $(this).attr('data-tramite-id');
    // alert(fkRu);
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

          if (response=="OK") {
            window.location.reload();
          }

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
        window.location.reload();
      }
    });
  });

  $(".aprobFile").change(function () {
    var idRT = $(this).attr('data-id');
    var estatus = $(this).val();

    parametros = {
      'idRT' : idRT,
      'estatus' : estatus
    };

    $.ajax({
      url     : base_url()+"portal-informatica-tramites-updateFileAR",
      type    : 'post',
      data    : parametros,
      success : function(data){
        // console.log(data);
        if (data=='OK') {
          window.location.reload();
        }
      }
    });
  });

  $("#btn-enviar-observacion").click(function () {
    var idTramite   = $(this).attr('data-id');
    var idAlumno    = $(this).attr('data-id-u');
    var comentario  = $("#comentarios").val();
    comentario      = $.trim(comentario);
    if (comentario != "") {

      parametros = {
        'idTramite'   : idTramite,
        'idAlumno'    : idAlumno,
        'comentario'  : comentario
      };
      $.ajax({
        url     : base_url()+"portal-informatica-tramites-addComentario",
        type    : 'post',
        data    : parametros,
        success : function (data) {
          if (data=='OK') {
            window.location.reload();
          }
        }
      });
      // alert(comentario);
    }else{
      $("#error-modal .modal-dialog > .modal-content > .modal-body").html('El comentario no puede ir vacío');
      $('#error-modal').modal('show');
      // alert("El comentario no puede ir vacío");
    }
  });

  $(".btn-buscar-archivo").click(function () {
    var criterio  = $("#criterioB").val();
    criterio      = $.trim(criterio);
    criterio      = criterio.toUpperCase();
    parametros    = {
      'criterio'  : criterio
    };
    if(criterio != ""){
      $.ajax({
        url     : base_url()+"portal-informatica-tramites-buscar-archivo",
        type    : 'post',
        data    : parametros,
        success : function (data) {
          $("#tabla").html(data);
        }
      });
    }
    // alert(criterio);
  });

  $("#criterioB").keyup(function () {
    var criterio  = $("#criterioB").val();
    criterio      = $.trim(criterio);
    criterio      = criterio.toUpperCase();
    parametros    = {
      'criterio'  : criterio
    };
    if(criterio != ""){
      $.ajax({
        url     : base_url()+"portal-informatica-tramites-buscar-archivo",
        type    : 'post',
        data    : parametros,
        success : function (data) {
          $("#tabla").html(data);
        }
      });
    }
  });

  $("#criterioB").keydown(function () {
    var criterio  = $("#criterioB").val();
    criterio      = $.trim(criterio);
    criterio      = criterio.toUpperCase();
    parametros    = {
      'criterio'  : criterio
    };
    if (criterio != ""){
      $.ajax({
        url     : base_url()+"portal-informatica-tramites-buscar-archivo",
        type    : 'post',
        data    : parametros,
        success : function (data) {
          $("#tabla").html(data);
        }
      });
    }
  });

  $(".btnEnvInves").click(function () {
    var idTramite   = $(this).attr("data-id");
    parametros      = {
      'idTramite' : idTramite,
      'estatus'   : "INVESTIGACION"
    };

    $.ajax({
      url     : base_url()+"portal-informatica-tramites-enviarA",
      type    : 'post',
      data    : parametros,
      success : function (data) {
        window.location.reload();
      }
    });
  });

  $(".btnEnvCons").click(function () {
    var idTramite   = $(this).attr("data-id");
    parametros      = {
      'idTramite' : idTramite,
      'estatus'   : "CONSEJO"
    };

    $.ajax({
      url     : base_url()+"portal-informatica-tramites-enviarA",
      type    : 'post',
      data    : parametros,
      success : function (data) {
        window.location.reload();
      }
    });
  });

  $(".btnEnvPreacta").click(function () {
    var idTramite   = $(this).attr("data-id");
    parametros      = {
      'idTramite' : idTramite,
      'estatus'   : "PREACTA"
    };

    $.ajax({
      url     : base_url()+"portal-informatica-tramites-enviarA",
      type    : 'post',
      data    : parametros,
      success : function (data) {
        window.location.reload();
      }
    });
  });

  $(".btnResAprobado").click(function () {
    var idTramite   = $(this).attr("data-id");
    parametros      = {
      'idTramite' : idTramite,
      'estatus'   : "APROBADO"
    };

    $.ajax({
      url     : base_url()+"portal-informatica-tramites-enviarA",
      type    : 'post',
      data    : parametros,
      success : function (data) {
        window.location.reload();
      }
    });
  });

  $(".btnResRechazado").click(function () {
    var idTramite   = $(this).attr("data-id");
    parametros      = {
      'idTramite' : idTramite,
      'estatus'   : "RECHAZADO"
    };

    $.ajax({
      url     : base_url()+"portal-informatica-tramites-enviarA",
      type    : 'post',
      data    : parametros,
      success : function (data) {
        window.location.reload();
      }
    });
  });

  $(".btnGenerarPreacta").click(function () {
    alert("PREACTA");
  });

});

function goToTramiteDatos(idTramite) {
  // var data = $(this).attr('data');
  var data = idTramite;
  // alert(data);
  // alert($(this).attr('data'));
  window.location.href = base_url()+'portal-informatica-tramites-datos/'+data;
}

function cambiarIcon(id){
  cambio = document.getElementById(id);
  cambio.src = "http://localhost/portalp/static/img/upload.png";
}

function cambiarI(id){
  cambio2 = document.getElementById(id);
  cambio2.src = "http://localhost/portalp/static/img/upload.png";
}
function cambiarIP(id){
  cambio3 = document.getElementById(id);
  cambio3.src = "http://localhost/portalp/static/img/upload.png";
}
function cambiarIP2(id){
  cambio4 = document.getElementById(id);
  cambio4.src = "http://localhost/portalp/static/img/upload.png";
}
function bajar(id){
  menu = document.getElementById(id);
  menu.style.display = "block";
}
function quitar(id){
  menu = document.getElementById(id);
  menu.style.display = "none";
}

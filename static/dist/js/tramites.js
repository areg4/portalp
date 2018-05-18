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
    var file = event.target.files[0];
    if(!file.type.match('application/pdf')) {
      $("#error-modal .modal-dialog > .modal-content > .modal-body").html('Sólo archivos con exensión .pdf');
      $('#error-modal').modal('show');
      $(this).val("");
   }else {
     $(".btnUpdateFile").click();
   }
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
            setTimeout(function(){
                window.location.reload();
              }, 2500);
            $("#error-modal .modal-dialog > .modal-content > .modal-body").html('Observación enviada');
            $('#error-modal').modal('show');
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
    var idTramite     = $(this).attr("data-id");
    var recomendacion = $(".recomendacion").html();
    if (recomendacion == "ATENDIDO") {
      $("#error-modal .modal-dialog > .modal-content > .modal-body").html('El trámite no ha sido atendido por los miembros del comité correspondiente.');
      $('#error-modal').modal('show');
    }else{
      // alert(recomendacion);
      parametros      = {
        'idTramite' : idTramite,
        'estatus'   : "PREACTA",
        'recomendacion' : recomendacion
      };

      $.ajax({
        url     : base_url()+"portal-informatica-tramites-enviarA",
        type    : 'post',
        data    : parametros,
        success : function (data) {
          window.location.reload();
        }
      });
    }
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

  $(".btnAproInves").click(function () {
    var idTramite   = $(this).attr("data-id");
    var idUsuario   = $(this).attr("data-user");
    var comentarios = $("#comentarios").val();
    parametros      = {
      'idTramite'   : idTramite,
      'idUsuario'   : idUsuario,
      'comentarios' : comentarios
    };

    $.ajax({
      url     : base_url()+"portal-informatica-investigacion-tramite-aprobar",
      type    : 'post',
      data    : parametros,
      success : function (data) {
        if (data == "OK") {
          window.location.reload();
        }else{
          window.location.reload();
        }
      }
    });
  });

  $(".btnRechaInves").click(function () {
    var idTramite   = $(this).attr("data-id");
    var idUsuario   = $(this).attr("data-user");
    var comentarios = $("#comentarios").val();
    parametros      = {
      'idTramite'   : idTramite,
      'idUsuario'   : idUsuario,
      'comentarios' : comentarios
    };

    $.ajax({
      url     : base_url()+"portal-informatica-investigacion-tramite-rechazar",
      type    : 'post',
      data    : parametros,
      success : function (data) {
        if (data == "OK") {
          window.location.reload();
        }else{
          window.location.reload();
        }
      }
    });
  });

  $(".btnAproConsejo").click(function () {
    var idTramite   = $(this).attr("data-id");
    var idUsuario   = $(this).attr("data-user");
    var comentarios = $("#comentarios").val();
    parametros      = {
      'idTramite'   : idTramite,
      'idUsuario'   : idUsuario,
      'comentarios' : comentarios
    };

    $.ajax({
      url     : base_url()+"portal-informatica-consejo-tramite-aprobar",
      type    : 'post',
      data    : parametros,
      success : function (data) {
        if (data == "OK") {
          window.location.reload();
        }else{
          window.location.reload();
        }
      }
    });
  });

  $(".btnRechaConsejo").click(function () {
    var idTramite   = $(this).attr("data-id");
    var idUsuario   = $(this).attr("data-user");
    var comentarios = $("#comentarios").val();
    parametros      = {
      'idTramite'   : idTramite,
      'idUsuario'   : idUsuario,
      'comentarios' : comentarios
    };

    $.ajax({
      url     : base_url()+"portal-informatica-consejo-tramite-rechazar",
      type    : 'post',
      data    : parametros,
      success : function (data) {
        if (data == "OK") {
          window.location.reload();
        }else{
          window.location.reload();
        }
      }
    });
  });

  // Validaciones de PDF desde JS
  var rutaIcono;

  $(".file").click(function() {
    rutaIcono = $(this).find("img").attr("data-default-icon");
    // alert(rutaIcono);
  });
  $(".file").on('change', function (event) {
    var file = event.target.files[0];
    if(!file.type.match('application/pdf')) {
       $("#error-modal .modal-dialog > .modal-content > .modal-body").html('Sólo archivos con extensión .pdf');
       $('#error-modal').modal('show');
       $(this).css("background","#FA474B");
       $(this).css("transition","width 1s, background 2s");
       $(this).find("img").attr("src", rutaIcono);
       $(this).find(".fileUp").val("");
   }
   else{
    $(this).css("background", "#359AFF");
    // cambio = document.getElementById(id);
    $(this).find("img").attr("src", base_url()+'static/img/upload.png');
    // console.log(cambio);
    // cambio.src = base_url()+'static/img/upload.png';
   }
 });

 $(".btnEnvDesig").click(function () {
   var idsAsig      = [];
   var idTramite    = $(this).attr('data-id');
   var idPresi      = $(this).attr('data-user');
   var comentarioP  = $("#comentarios").val();
   var elementos = $(".designaciones").find("input:checked").each(function() {
     idUser = $(this).attr('data-user-id');
     asignacion = $("input[name=desig-"+idUser+"]:checked").val();
     // idsAsig[idUser] = asignacion;
     // alert(idUser);
     // obj = {};
     // obj[idUser] = asignacion;
     // idsAsig.push(obj);
     idsAsig.push({idUser : idUser, asignacion : asignacion});
     // console.log(asignacion);
   });

   $.ajax({
     url     : base_url()+"portal-informatica-investigacion-tramite-asignacion-presidente",
     type    : 'post',
     data    : {
       asignaciones : JSON.stringify(idsAsig),
       idTramite    : idTramite,
       idPresi      : idPresi,
       comentarioP  : comentarioP
     },
     success : function (data) {
       // alert(data);
       if (data == "OK") {
         window.location.reload();
       }else{
         window.location.reload();
       }
     }
   });

   // console.log(idsAsig);

 });

 $(".btnEnvDesigTitu").click(function () {
   var idsAsig      = [];
   var idTramite    = $(this).attr('data-id');
   var idPresi      = $(this).attr('data-user');
   var comentarioP  = $("#comentarios").val();
   var elementos = $(".designaciones").find("input:checked").each(function() {
     idUser = $(this).attr('data-user-id');
     asignacion = $("input[name=desig-"+idUser+"]:checked").val();
     // idsAsig[idUser] = asignacion;
     // alert(idUser);
     // obj = {};
     // obj[idUser] = asignacion;
     // idsAsig.push(obj);
     idsAsig.push({idUser : idUser, asignacion : asignacion});
     // console.log(asignacion);
   });

   $.ajax({
     url     : base_url()+"portal-informatica-consejo-tramite-asignacion-presidente",
     type    : 'post',
     data    : {
       asignaciones : JSON.stringify(idsAsig),
       idTramite    : idTramite,
       idPresi      : idPresi,
       comentarioP  : comentarioP
     },
     success : function (data) {
       // alert(data);
       if (data == "OK") {
         window.location.reload();
       }else{
         window.location.reload();
       }
     }
   });

   // console.log(idsAsig);
   // alert("titu");

 });

 $("#formAlta").submit(function (e) {
   if ($("#formAlta").find(".materias").val() != 0) {
     // alert($("#formAlta").find(".materias").val());
     // e.preventDefault();
     return;
   }else {
     alert("Por favor elija la materia a la cual aplicar.");
     e.preventDefault();
   }
 })

 $(".btnApro").click(function () {
   $("#decision").val("APROBADO");
   $("#formRespuesta").submit(function (e) {
     if ($("#decision").val()=="APROBADO") {
       $(".requerido").each(function () {
         $(this).val($.trim((this.value)));
         if (($(this).val().length < 1)) {
           $(this).addClass('requerido_alert');
           $("#error-modal .modal-dialog > .modal-content > .modal-body").html('Todos los campos son requeridos.');
           $('#error-modal').modal('show');
           e.preventDefault();
         }
         else{
          $(this).removeClass('requerido_alert');
         }
       });
     }
   });
 });

 $(".btnRech").click(function () {
   $("#decision").val("RECHAZADO");
 });

 $(".txtNoOficio").keyup(function () {
   return this.value.toUpperCase();
 });

 //  $("#formRespuesta").submit(function (e) {
 //   // if ($("#formRespuesta").find(".decision").val() != 0) {
 //     // alert($("#formAlta").find(".materias").val());
 //     // e.preventDefault();
 //     alert($("#decision").val());

 //     e.preventDefault();
 //   // }else {
 //   //   alert("");
 //   //   e.preventDefault();
 //   // }
 // })

});

function goToTramiteDatos(idTramite) {
  // var data = $(this).attr('data');
  var data = idTramite;
  // alert(data);
  // alert($(this).attr('data'));
  window.location.href = base_url()+'portal-informatica-tramites-datos/'+data;
}

// function cambiarIcon(id){
//   cambio = document.getElementById(id);
//   cambio.src = base_url()+'static/img/upload.png';
// }

function bajar(id){
  menu = document.getElementById(id);
  menu.style.display = "block";
}

function quitar(id){
  menu = document.getElementById(id);
  menu.style.display = "none";
}

function mostrarImg(){
  var ruta = document.getElementById("archivo");
  var id_ruta = ruta.getAttribute("data-ruta");
  // var nombre_archivo = id_ruta;
  inicio = 0;
  fin  = 4;
  // console.log(ruta);
  $('#contenedor>div').each(function(e){
    subCadena =  $(this).children("p").html().substring(inicio,fin);
    if(subCadena == 'soli'){
    var imagen = document.getElementById("img_"+this.id);
    imagen.setAttribute("src", base_url()+'static/img/solicitud.png');
  }

  if(subCadena == 'kard'){
    var imagen = document.getElementById("img_"+this.id);
    imagen.setAttribute("src", base_url()+'static/img/kardex.png');
  }

  if(subCadena == 'cart'){
    var imagen = document.getElementById("img_"+this.id);
    imagen.setAttribute("src", base_url()+'static/img/carta.png');
  }

  if(subCadena == 'trab'){
    var imagen = document.getElementById("img_"+this.id);
    imagen.setAttribute("src", base_url()+'static/img/trabajo.png');
  }

  if(subCadena == 'prot'){
    var imagen = document.getElementById("img_"+this.id);
    imagen.setAttribute("src", base_url()+'static/img/protocolo.png');
  }

  if(subCadena == 'pror'){
    var imagen = document.getElementById("img_"+this.id);
    imagen.setAttribute("src", base_url()+'static/img/prorroga.png');
  }

  if(subCadena == 'reci'){
    var imagen = document.getElementById("img_"+this.id);
    imagen.setAttribute("src", base_url()+'static/img/recibo.png');
  }

  if(subCadena == 'mapa'){
    var imagen = document.getElementById("img_"+this.id);
    imagen.setAttribute("src", base_url()+'static/img/mapa.png');
  }

  });


}

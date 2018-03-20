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

          // alert(response);

          if (response=="OK") {
            window.location.reload();
          }
          //
          //   $.confirm({
          //     title: 'Confirm!',
          //     content: 'Simple confirm!',
          //     buttons: {
          //         confirm: function () {
          //             window.location.href = base_url()+'portal-informatica-alumnos-tramites-datos/'+idTramite;
          //         },
          //         cancel: function () {
          //             $.alert('Canceled!');
          //         },
          //         somethingElse: {
          //             text: 'Something else',
          //             btnClass: 'btn-blue',
          //             keys: ['enter', 'shift'],
          //             action: function(){
          //                 $.alert('Something else?');
          //             }
          //         }
          //     }
          // });

            // if (confirm("Archivo Actualizado!")) {
            //   location.href = base_url()+'portal-informatica-alumnos-tramites-datos/'+idTramite;
            // }
            // window.location.reload();

          // }
          // alert(response);
          // window.location.href = base_url()+'portal-informatica-alumnos-tramites-datos/'+response;

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
  cambio.src = base_url()+'static/img/upload.png';
}

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


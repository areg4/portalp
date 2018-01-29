jQuery(document).ready(function($){
  $("#buscar").click(function(){
    var dia   = $("#dia").val();
    var hora  = $("#hora").val();
    var parametros = {
      'dia'   : dia,
      'hora'  : hora
    };
    // alert(dia+" "+hora);
    // alert(parametros);
    $.ajax({
      url : base_url()+'portal-informatica-asistencias-dia-hora',
      type : 'POST',
      data : parametros,
      success : function(data) {
        // alert(data);
        $("#tbodyHorario").html(data);
        // $("#guardar").show();
        $("#guardar").prop("disabled", false);
      }
    })
  });

  $("#guardar").click(function(){
    formE = document.getElementsByName('dAsis[]');
    // console.log(formE.forEach());
    // alert(formE);

    var parametros = [{}];

    // console.log(formE);
    //
    formE.forEach(function(elemento, index) {
      // console.log("ElementoN "+index+" elemento: "+elemento.value);
      parametros[index] = elemento.value;
    });

    console.log(parametros);

    parametros = {
      'datosG' : parametros
    }

    $.ajax({
      url : base_url()+'portal-informatica-asistencias-guardar',
      type : 'POST',
      data : parametros,
      success : function(data) {
        location.href = base_url()+data;
      }
    })
  })

  $("#buscarH").click(function(){
    var fecha1 = $("#date1").val();
    var fecha2 = $("#date2").val();
    var cve_maestro = $("#cve_maestro").val();
    if (fecha1 != "" && fecha2 != "" && cve_maestro != "") {
      // alert("historial");

      var parametros = {
        "date1" : fecha1,
        "date2" : fecha2,
        "cve_maestro" : cve_maestro
      };

      $.ajax({
        url : base_url()+'portal-informatica-asistencias-historial-profesor',
        type : 'POST',
        data : parametros,
        success : function(data) {
          // alert(data);
          $("#tableHistorial").html(data);
          // $("#modificarH").show();
          $("#modificarH").prop("disabled",false);
        }
      })
    }
  });

  $("#modificarH").click(function(){
    // alert("modificar");
    formE = document.getElementsByName('dAsisM[]');
    // console.log(formE.forEach());
    // alert(formE);

    var parametros = [{}];

    // console.log(formE);
    //
    formE.forEach(function(elemento, index) {
      // console.log("ElementoN "+index+" elemento: "+elemento.value);
      parametros[index] = elemento.value;
    });

    console.log(parametros);

    parametros = {
      'datosG' : parametros
    }

    $.ajax({
      url : base_url()+'portal-informatica-asistencias-historial-modificar',
      type : 'POST',
      data : parametros,
      success : function(data) {
        // alert(data);
        location.href = base_url()+data;
      }
    })
  });

  $("#generarR").click(function(){
    var tipoReporte = $("#tipo_reporte").val();
    var fecha1 = $("#date1").val();
    var fecha2 = $("#date2").val();

    if (fecha1 != "" && fecha2 !="") {
      if (tipoReporte=="rep_Ge") {
        window.open(base_url()+"portal-informatica-asistencias-reporte-general/"+fecha1+"/"+fecha2,'_blank');
      }else if (tipoReporte=="rep_De") {
        // alert("deta");
        var cveMaestro = $("#cve_maestro").val();
        if(cveMaestro != ""){
          window.open(base_url()+"portal-informatica-asistencias-reporte-detallado/"+fecha1+"/"+fecha2+"/"+cveMaestro,'_blank');
        }
      }else if (tipoReporte=="rep_Mat") {
        // alert("mater");
        var cveMaestro = $("#cve_maestro").val();
        if(cveMaestro != ""){
          window.open(base_url()+"portal-informatica-asistencias-reporte-materias/"+fecha1+"/"+fecha2+"/"+cveMaestro,'_blank');
        }
      }
    }
    // alert(tipoReporte);
  });

  $("#tipo_reporte").change(function(){
    var tipoReporte = $("#tipo_reporte").val();
    if (tipoReporte=="rep_Ge") {
      $(".cveMaestro").hide();
    }else if (tipoReporte=="rep_De") {
      $(".cveMaestro").show();
    }else if (tipoReporte=="rep_Mat") {
      $(".cveMaestro").show();
    }
    // alert(tipoReporte);
  });
})

function cambiarA(id){
  var elementoM = $("#"+id).val();

  valorA = elementoM.slice(-1);
  if (valorA == 0) {
    elementoM = elementoM.slice(0,-1);
    elementoM = elementoM + 1;
    $("#"+id).val(elementoM);
  }else{
    elementoM = elementoM.slice(0,-1);
    elementoM = elementoM + 0;
    $("#"+id).val(elementoM);
  }
  // alert(elementoM);
}

function cambiarTipoR(){

}

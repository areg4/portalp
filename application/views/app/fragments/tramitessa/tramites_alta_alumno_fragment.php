<div class="col-xs-12 col-sm-12 text-center">
  <h1 class="h1 tamañoh1 text-center">Formulario de alta<br><?=$tramite->tramite; ?></h1>
</div>
<?php
  if(!is_null($alumno)){

?>
<div class="col-xs-12">
<br>
  <form enctype="multipart/form-data" action="<?php echo base_url().'portal-informatica-alumnos-tramites-add' ?>" method="post" >
    <div class="form-group col-xs-12 col-sm-12 col-md-6 text-center mtop">
      <label for="nombre">Nombre</label>
      <?php if (!is_null($alumno->nombre_alumno)): ?>
        <p name="nombre" id="nombre"><?php echo $alumno->nombre_alumno; ?></p>
      <?php else: ?>
        <p name="nombre" id="nombre"><?php echo $alumno->apellidoPaterno." ".$alumno->apellidoMaterno." ".$alumno->nombre;?></p>
      <?php endif; ?>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-6 text-center mtop">
      <label for="text">Expediente</label>
      <p name="expediente" id="expediente"><?php echo $alumno->expediente; ?></p>
    </div>

    <!-- <?php if ($examenV): ?>
        <?php if (!is_null($materiasV)): ?>
          <label for="text">Materia:</label>
          <select class="" name="materiaVol">
            <?php foreach ($materiasV as $materiaV): ?>
              <option value="<?=$materiaV->idMateria?>"> <?=$materiaV->nombreMateria?> </option>
            <?php endforeach; ?>
          </select>
        <?php endif; ?>
      </div>
    <?php endif; ?> -->
    <div class="form-group col-xs-12 col-sm-12">

    </div>


    <div class="col-xs-12 leyenda">
      <p><b>Importante:</b> Los documentos deberán ser escaneados y subidos como archivo extensión .pdf</p>
    </div>

    <div class="col-xs-12 archivos">
    <!-- archivos -->
      <!-- <div class="col-xs-12 col-sm-12 col-md-2 archivo">
        <p>Solicitud</p>
        <div class=" file">
          <img src="<?=base_url()?>static/img/s.png" id="3">
          <input class="ocultar"  id="" type="file" name="solicitudEV" required onchange="cambiarIcon(3)">
        </div>
      </div> -->


      <?php if ($tramite->tramite == "Examen Voluntario"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class=" file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1">
            <input class="ocultar"  id="" type="file" name="solicitudEV" accept="application/pdf" required onchange="cambiarIcon(1)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Kárdex</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/kardex.png" id="2">
              <input class="ocultar"  id="" type="file" name="kardexEV" required onchange="cambiarIcon(2)">
              <input type="hidden" name="idTramite" value="<?=$tramite->idCatTramite; ?>">
              <input type="hidden" name="tramite" value="<?=$tramite->tramite; ?>" >
          </div>
        </div>
      <?php endif; ?>
    </div>

      <div class="col-xs-12 archivos">
      <?php if ($tramite->tramite == "Prórroga de Licenciatura"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
        <p>Prórroga Papel 1</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/prorroga.png" id="3">
            <input class="ocultar"  id="" type="file" name="archivoPorS[]" required onchange="cambiarIcon(3)">
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Prórroga Papel 2</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/prorroga.png" id="4">
            <input class="ocultar"  id="" type="file" name="archivoPorS[]" required onchange="cambiarIcon(4)">
            <input type="hidden" name="idTramite" value="<?=$tramite->idCatTramite; ?>" >
            <input type="hidden" name="tramite" value="<?=$tramite->tramite; ?>" >
          </div>
        </div>
      <?php endif; ?>
      </div>

      <div class="col-xs-12 archivos">
      <?php if ($tramite->tramite == "Readquisición de Pasantía"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class=" file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1">
            <input class="ocultar"  id="" type="file" name="solicitudRP" accept="application/pdf" required onchange="cambiarIcon(1)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Carta Calificación Diplomado</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/carta.png" id="2">
              <input class="ocultar"  id="" type="file" name="cartaCalifDiploRP" accept="application/pdf" required onchange="cambiarIcon(2)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Recibo del Diplomado</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/recibo.png" id="3">
              <input class="ocultar"  id="" type="file" name="reciboDiploRP" accept="application/pdf" required onchange="cambiarIcon(3)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Kardex</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/kardex.png" id="4">
              <input class="ocultar"  id="" type="file" name="kardexRP" accept="application/pdf" required onchange="cambiarIcon(4)">
          </div>
        </div>
      <?php endif; ?>
      </div>

      <div class="archivos col-xs-12">
      <?php if ($tramite->tramite == "Cursos y Diplomados de Actualización y de Profundización Disciplinaria"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class=" file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1">
            <input class="ocultar"  id="" type="file" name="solicitudCD" accept="application/pdf" required onchange="cambiarIcon(1)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Carta Calificación Diplomado</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/carta.png" id="2">
              <input class="ocultar"  id="" type="file" name="cartaCalifDiploCD" accept="application/pdf" required onchange="cambiarIcon(2)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Recibo del Diplomado</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/recibo.png" id="3">
              <input class="ocultar"  id="" type="file" name="reciboDiploCD" accept="application/pdf" required onchange="cambiarIcon(3)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Kardex</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/kardex.png" id="4">
              <input class="ocultar"  id="" type="file" name="kardexCD" accept="application/pdf" required onchange="cambiarIcon(4)">
          </div>
        </div>
      <?php endif; ?>
      </div>


      <div class="archivos col-xs-12">
      <?php if ($tramite->tramite == "Guía del Maestro"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class=" file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1">
            <input class="ocultar"  id="" type="file" name="solicitudGM" accept="application/pdf" required onchange="cambiarIcon(1)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Protocolo</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/protocolo.png" id="2">
              <input class="ocultar"  id="" type="file" name="protocoloGM" accept="application/pdf" required onchange="cambiarIcon(2)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Carta Aceptación del maestro responsable de la materia</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/carta.png" id="3">
              <input class="ocultar"  id="" type="file" name="cartaAeptacionMRespoGM" accept="application/pdf" required onchange="cambiarIcon(3)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Kardex</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/kardex.png" id="4">
              <input class="ocultar"  id="" type="file" name="kardexGM" accept="application/pdf" required onchange="cambiarIcon(4)">
          </div>
        </div>
      <?php endif; ?>
      </div>

      <div class="archivos col-xs-12">
      <?php if ($tramite->tramite == "Memoria de Trabajo"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class=" file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1">
            <input class="ocultar"  id="" type="file" name="solicitudMT" accept="application/pdf" required onchange="cambiarIcon(1)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Protocolo</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/protocolo.png" id="2">
              <input class="ocultar"  id="" type="file" name="protocoloMT" accept="application/pdf" required onchange="cambiarIcon(2)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Carta del lugar de trabajo</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/carta.png" id="3">
              <input class="ocultar"  id="" type="file" name="cartaLugarTrabajoMT" accept="application/pdf" required onchange="cambiarIcon(3)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Carta del Asesor Académico</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/carta.png" id="4">
              <input class="ocultar"  id="" type="file" name="cartaAsesorAcadeMT" accept="application/pdf" required onchange="cambiarIcon(4)">
          </div>
        </div>
      <?php endif; ?>
      </div>

      <div class="archivos col-xs-12">
      <?php if ($tramite->tramite == "Trabajo Terminado"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class=" file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1">
            <input class="ocultar"  id="" type="file" name="solicitudTT" accept="application/pdf" required onchange="cambiarIcon(1)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Trabajo Terminado</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/trabajo.png" id="2">
              <input class="ocultar"  id="" type="file" name="trabajoTT" accept="application/pdf" required onchange="cambiarIcon(2)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Carta Asesor Académico</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/carta.png" id="3">
              <input class="ocultar"  id="" type="file" name="cartaAsesorTT" accept="application/pdf" required onchange="cambiarIcon(3)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Carta del lugar de trabajo</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/carta.png" id="4">
              <input class="ocultar"  id="" type="file" name="cartaTrabajoTT" accept="application/pdf" required onchange="cambiarIcon(4)">
          </div>
        </div>
      <?php endif; ?>
      </div>


      <div class="archivos col-xs-12">
      <?php if ($tramite->tramite == "Tesis Individual"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class=" file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1">
            <input class="ocultar"  id="" type="file" name="solicitudTI" accept="application/pdf" required onchange="cambiarIcon(1)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Kardex CU</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/kardexc.png" id="2">
              <input class="ocultar"  id="" type="file" name="kardexTI" accept="application/pdf" required onchange="cambiarIcon(2)">
          </div>
        </div>
      <?php endif; ?>
      </div>

      <div class="archivos col-xs-12">
      <?php if ($tramite->tramite == "Promedio"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class=" file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1">
            <input class="ocultar"  id="" type="file" name="solicitudPro" accept="application/pdf" required onchange="cambiarIcon(1)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Kardex CU</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/kardexc.png" id="2">
              <input class="ocultar"  id="" type="file" name="kardexPro" accept="application/pdf" required onchange="cambiarIcon(2)">
          </div>
        </div>
      <?php endif; ?>
      </div>

      <div class="archivos col-xs-12">
      <?php if ($tramite->tramite == "Acreditación de Posgrado"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class=" file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1">
            <input class="ocultar"  id="" type="file" name="solicitudAP" accept="application/pdf" required onchange="cambiarIcon(1)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Carta de la escuela donde se está cursando la maestría</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/carta.png" id="2">
              <input class="ocultar"  id="" type="file" name="cartaECMAP" accept="application/pdf" required onchange="cambiarIcon(2)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Mapa Curricular</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/mapa.png" id="3">
              <input class="ocultar"  id="" type="file" name="mapaCurriAP" accept="application/pdf" required onchange="cambiarIcon(3)">
          </div>
        </div>
      <?php endif; ?>
      </div>

      <input type="hidden" name="idTramite" value="<?=$tramite->idCatTramite; ?>">
      <input type="hidden" name="tramite" value="<?=$tramite->tramite; ?>" >

    <!-- fin archivos -->

    <div class="col-xs-12 leyenda">
      <p> <b>Recuerda: </b>Deberás tener los documentos en estado físico y pasar a Servicios Académicos a dejarlos. <br> Recibirás la respuesta de tu trámite pronto.</p>
      <br>
    </div>
    <div class="form-group text-center col-xs-12">
      <button type="submit" class="btn btn-success">Tramitar</button>
      <br>
    </div>

  </form>
</div>

<?php } ?>

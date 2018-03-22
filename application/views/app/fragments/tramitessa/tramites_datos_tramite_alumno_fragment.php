<body onload="mostrarImg()">
<div class="text-center">
  <h3 class="h3">Datos del trámite</h3>
  <h4 class="h4 tamañoh4" id="id-tramite"><?=$catTramites[$tramite->idCatTramite] ?></h4>
</div>

<div class="col-xs-12">
<br>
    <div class="form-group col-xs-12 col-sm-12 col-md-5 text-center">
      <label for="nombre">Nombre:</label>
      <?php if (!is_null($alumno->nombre_alumno)): ?>
        <p name="nombre" id="nombre"><?php echo $alumno->nombre_alumno; ?></p>
      <?php else: ?>
        <p name="nombre" id="nombre"><?php echo $alumno->apellidoPaterno." ".$alumno->apellidoMaterno." ".$alumno->nombre;?></p>
      <?php endif; ?>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-3 text-center">
      <label for="text">Expediente:</label>
      <p name="expediente" id="expediente"><?php echo $alumno->expediente; ?></p>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-4 text-center">
      <label for="text">Fecha Inicio Trámite:</label>
      <p name="fecIniTram" id="fecIniTram"><?= fancy_date($tramite->fechaInicio); ?></p>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-3 text-center">
      <label for="text">Estatus:</label>
      <p name="estatus" id="estatus">
        <?php if ($tramite->estatus=="ALTA" OR $tramite->estatus=="APROBADO" OR $tramite->estatus=="RECHAZADO"): ?>
          <?=$tramite->estatus; ?>
        <?php else: ?>
          PROCESO
        <?php endif; ?>
      </p>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-3 text-center">
      <label for="text">Periodo:</label>
      <p name="periodo" id="periodo"><?=$periodoTramite;?></p>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-3 text-center">
      <label for="text">Fecha de Última Modificación:</label>
      <p name="fecUltMod" id="fecUltMod"><?=fancy_date($tramite->feculmod); ?></p>
    </div>

    <?php if ($tramite->estatus == "FINALIZADO"): ?>
      <div class="form-group col-xs-12 col-sm-12 col-md-3 text-center">
        <label for="text">Fecha de Finalización:</label>
        <p name="fecFin" id="fecFin"><?=fancy_date($tramite->fechaFin); ?></p>
      </div>
    <?php endif; ?>

    <?php if (!is_null($observacion)): ?>
    <div class="form-group col-xs-12 col-sm-12 col-md-4 text-center">
      <label for="text">Observaciones:</label>
      <p name="expediente" id="expediente"><?=$observacion->observacion?></p>
    </div>
    <?php else: ?>
      <div class="form-group col-xs-12 col-sm-12 col-md-3 text-center">
        <label for="text">Observaciones:</label>
        <p name="expediente" id="expediente">Sin observaciones por el momento</p>
      </div>
    <?php endif; ?>

    <div class="col-xs-12 leyenda">
      <br>
      <p><b>Documentos subidos</b><br>Los documentos son revisados de forma individual.</p>
    </div>

    <div class="col-xs-12 archivos" id="contenedor">
    <?php if (!is_null($archivos)): ?>
      <?php foreach ($archivos as $archivo): ?>
          <div class="col-xs-8 col-sm-6 col-md-2 archivo" id="archivo<?=$archivo->idRT?>" onmouseenter="bajar(<?=$archivo->idRT?>)" onmouseleave="quitar(<?=$archivo->idRT?>)">
            <p><?=$archivo->ruta?></p>
            <div class="file <?php if ($archivo->estatus == "RECIBIDO" ) {
                  echo "alta";
                } if ($archivo->estatus == "RECHAZADO") {
                  echo "observaciones";
                } if ($archivo->estatus == "REVISANDO") {
                  echo "nproceso";
                } if ($archivo->estatus == "APROBADO") {
                  echo "finalizado";
                }?>" data-ruta="<?=$archivo->ruta?>" id="archivo">
                <img src="" id="img_archivo<?=$archivo->idRT?>">
            </div>
            <figcaption class="bajar" id="<?=$archivo->idRT?>">
                <form onsubmit="return false" id="form-update-file-id-<?=$archivo->idRT?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="idRT" value="<?=$archivo->idRT?>">
                  <input type="hidden" name="idTramite" value="<?=$archivo->idTramite?>">
                  <input type="hidden" name="nombreF" value="<?=$archivo->ruta?>">
                  <?php if ($archivo->estatus == 'RECHAZADO' AND $tramite->estatus=="PROCESO"): ?>
                    <span>Subir archivo</span><input class="ArchivoNuevo"  id="file-<?=$archivo->idRT?>" type="file" name="file" accept="application/pdf" required onchange="cambiarIcon(1)">
                    <input style="display:none;" class="btn btnUpdateFile" data-tramite-id="<?=$archivo->idTramite?>" data-id="<?=$archivo->idRT?>" type="submit" name="" value="Actualizar">
                  <?php endif; ?>
                  <a href="<?=base_url()?>docs/tramites/<?=$alumno->expediente?>/<?=$archivo->idTramite?>/<?=$archivo->ruta?>" target="_blank" class="">Descargar</a>
                </form>
            </figcaption>
          </div>
      <?php endforeach; ?>
    <?php endif; ?>
    </div>

    <?php if ($tramite->estatus=="APROBADO" OR $tramite->estatus=="RECHAZADO"): ?>
      <div class="col-md-12 respuestaFinal">
        <h1>Tu trámite ha sido finalizado con una respuesta de: <?=$tramite->estatus?></h1> <br>
        <h2>Favor de pasar a Secretaría Académica para recoger la hoja correspondiente.</h2>
      </div>
    <?php endif; ?>

    <?php if ($tramite->estatus == "OBSERVACIONES"): ?>
      <div class="form-group text-center col-xs-12">
        <button type="submit" class="btn btn-success btn-enviar-revision" data-id="<?=$tramite->idTramite?>">Enviar a revisión</button>
      </div>
    <?php endif; ?>
</div>
</body>

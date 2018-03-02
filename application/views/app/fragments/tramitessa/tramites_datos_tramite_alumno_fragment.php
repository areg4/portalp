<div class="text-center">
  <h3 class="h3">Datos del trámite</h3>
  <h4 class="h4 tamañoh4" id="id-tramite"><?=$catTramites[$tramite->idCatTramite] ?></h4>
</div>

<div class="col-xs-12" onclick="">
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
      <p name="estatus" id="estatus"><?=$tramite->estatus; ?></p>
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

    <?php if (!is_null($archivos)): ?>
      <?php foreach ($archivos as $archivo): ?>
          <div class="col-md-2 col-xs-hidden"></div>
          <div class="col-xs-12 col-sm-12 col-md-2 archivo centrado_p" onmouseenter="bajar()" onmouseleave="quitar()" >
            <p>Documento </p>
            <div class="file <?php if ($archivo->estatus == "RECIBIDO") {
                  echo "alta";
                } if ($archivo->estatus == "RECHAZADO") {
                  echo "observaciones";
                } if ($archivo->estatus == "REVISANDO") {
                  echo "nproceso";
                } if ($archivo->estatus == "APROBADO") {
                  echo "finalizado";
                }?>">
              <img src="<?=base_url()?>static/img/s.png" id="1">
            </div>
            <figcaption class="bajar">
                <form id="form-update-file-id-<?=$archivo->idRT?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="idRT" value="<?=$archivo->idRT?>">
                  <input type="hidden" name="idTramite" value="<?=$archivo->idTramite?>">
                  <input type="hidden" name="nombreF" value="<?=$archivo->ruta?>">
                  <?php if ($archivo->estatus == 'RECHAZADO'): ?>
                    <span>Subir archivo</span><input class="btn"  id="file-<?=$archivo->idRT?>" type="file" name="file" required onchange="cambiarIcon(1)">
                    <input class="btn" data-id="<?=$archivo->idRT?>" type="submit" name="" value="Actualizar">
                  <?php endif; ?>
                  <a href="<?=base_url()?>docs/tramites/<?=$alumno->expediente?>/<?=$archivo->idTramite?>/<?=$archivo->ruta?>" target="_blank" class="">Descargar</a>
                </form>
              </figcaption>
          </div>
          <div class="col-xs-hidden col-md-2"></div>
      <?php endforeach; ?>
    <?php endif; ?>

    <?php if ($tramite->estatus == "OBSERVACIONES"): ?>
      <div class="form-group text-center col-xs-12">
        <br>
        <button type="submit" class="btn btn-success btn-enviar-revision" data-id="<?=$tramite->idTramite?>">Enviar a revisión</button>
      </div>
    <?php endif; ?>
</div>

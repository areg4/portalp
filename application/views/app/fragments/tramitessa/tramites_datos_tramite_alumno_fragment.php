<div class="text-center">
  <h3 class="h3">Datos del Trámite</h3>
  <h4 class="h4" id="id-tramite"><?=$catTramites[$tramite->idCatTramite] ?></h4>
</div>

<div class="col-xs-12">
<br>
    <div class="form-group col-xs-12 col-sm-12 col-md-5">
      <label for="nombre">Nombre:</label>
      <?php if (!is_null($alumno->nombre_alumno)): ?>
        <p name="nombre" id="nombre"><?php echo $alumno->nombre_alumno; ?></p>
      <?php else: ?>
        <p name="nombre" id="nombre"><?php echo $alumno->apellidoPaterno." ".$alumno->apellidoMaterno." ".$alumno->nombre;?></p>
      <?php endif; ?>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-3">
      <label for="text">Expediente:</label>
      <p name="expediente" id="expediente"><?php echo $alumno->expediente; ?></p>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-3">
      <label for="text">Fecha Inicio Trámite:</label>
      <p name="fecIniTram" id="fecIniTram"><?= fancy_date($tramite->fechaInicio); ?></p>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-3">
      <label for="text">Estatus:</label>
      <p name="estatus" id="estatus"><?=$tramite->estatus; ?></p>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-3">
      <label for="text">Fecha de Última Modificación:</label>
      <p name="fecUltMod" id="fecUltMod"><?=fancy_date($tramite->feculmod); ?></p>
    </div>

    <?php if ($tramite->estatus == "FINALIZADO"): ?>
      <div class="form-group col-xs-12 col-sm-12 col-md-3">
        <label for="text">Fecha de Finalización:</label>
        <p name="fecFin" id="fecFin"><?=fancy_date($tramite->fechaFin); ?></p>
      </div>
    <?php endif; ?>

    <?php if (!is_null($observacion)): ?>
      <div class="form-group col-xs-12 col-sm-12 col-md-3">
        <label for="text">Observaciones:</label>
        <p name="expediente" id="expediente"><?=$observacion->observacion?></p>
      </div>
    <?php else: ?>
      <div class="form-group col-xs-12 col-sm-12 col-md-3">
        <label for="text">Observaciones:</label>
        <p name="expediente" id="expediente">Sin observaciones por el momento</p>
      </div>
    <?php endif; ?>

    <div class="form-group col-xs-12 col-sm-12">

    </div>


    <div class="col-xs-12 leyenda">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc hendrerit lectus purus, in porttitor tortor congue non. </p>
    </div>

    <?php if (!is_null($archivos)): ?>
      <?php foreach ($archivos as $archivo): ?>
        <div class="col-xs-12 col-sm-12 col-md-4 file"> K
          <form id="form-update-file-id-<?=$archivo->idRT?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="idRT" value="<?=$archivo->idRT?>">
            <input type="hidden" name="idTramite" value="<?=$archivo->idTramite?>">
            <input type="hidden" name="nombreF" value="<?=$archivo->ruta?>">
            <?php if ($archivo->estatus == 'RECHAZADO'): ?>
              <input class="ocultar"  id="file-<?=$archivo->idRT?>" type="file" name="file" required>
              <br>
              <input class="btn btnUpdateFile" data-id="<?=$archivo->idRT?>" type="submit" name="" value="Actualizar">
            <?php endif; ?>
          </form>
          <a href="<?=base_url()?>docs/tramites/<?=$alumno->expediente?>/<?=$archivo->idTramite?>/<?=$archivo->ruta?>" target="_blank" class="btn">Descargar</a>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>

    <!-- <div class="col-xs-12 col-sm-12 col-md-4 file">
      <label for="text">Documento b</label>
      <input class=" btn-menta"  id="" type="file" name="">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 file">
      <label for="text">Documento c</label>
      <input class=" btn-menta"  id="" type="file" name="">
    </div> -->

    <div class="form-group col-xs-12 col-sm-12"><br></div>

    <div class="col-xs-12 leyenda">
      <p>
        <b>Recuerda: </b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc hendrerit lectus purus, in porttitor tortor congue non.
      </p>
      <br>
    </div>
    <?php if ($tramite->estatus == "OBSERVACIONES"): ?>
      <div class="form-group text-center col-xs-12">
        <button type="submit" class="btn btn-success btn-enviar-revision" data-id="<?=$tramite->idTramite?>">Enviar a Revisión</button>
      </div>
    <?php endif; ?>
</div>

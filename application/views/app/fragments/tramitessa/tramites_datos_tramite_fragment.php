<div class="text-center">
  <h3 class="h3">Datos del Trámite</h3>
  <h4 class="h4" id="id-tramite"><?=$catTramites[$tramite->idCatTramite]?></h4>
</div>

<div class="col-xs-12">
<br>
    <!-- <div class="form-group col-xs-12 col-sm-12 col-md-5">
      <label for="nombre">Nombre:</label>
      <p>María Fernanda Juárez Tirado</p>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-3">
      <label for="text">Expediente:</label>
      <p>234661</p>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-4">
      <label for="text">Materia:</label>
      <p>Estructura de Datos y Algoritmos</p>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-4">
      <label for="text">Profesor:</label>
      <p>Gerardo Rojano</p>
    </div>

    <div class="form-group col-xs-12 col-sm-12">

    </div> -->


    <!-- <div class="col-xs-12 col-sm-12 col-md-4 file">
      <label for="text">Documento a</label>
      <p>Documento agregado exitosamente</p>
      <input class="ocultar"  id="" type="file" name="">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 file">
      <label for="text">Documento b</label>
      <input class=" btn-menta"  id="" type="file" name="">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 file">
      <label for="text">Documento c</label>
      <p>Documento agregado exitosamente</p>
      <input class="btn-menta"  id="" type="file" name="">
    </div> -->

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
      <p><?=$alumno->expediente?></p>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-3">
      <label for="text">Email:</label>
      <?php if (!is_null($alumno->emailUsuario) AND $alumno->emailUsuario != ""): ?>
        <p><?=$alumno->emailUsuario?></p>
      <?php else: ?>
        <p>No hay dato</p>
      <?php endif; ?>

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
          <a href="<?=base_url()?>docs/tramites/<?=$alumno->expediente?>/<?=$archivo->idTramite?>/<?=$archivo->ruta?>" target="_blank" class="btn">Descargar</a>
          <input type="radio" class="aprobFile" data-id="<?=$archivo->idRT?>" name="aprobado-<?=$archivo->idRT?>" <?php if ($archivo->estatus == "APROBADO") { echo "checked";} ?> value="APROBADO" >Aprobado
          <input type="radio" class="aprobFile" data-id="<?=$archivo->idRT?>" name="aprobado-<?=$archivo->idRT?>" <?php if ($archivo->estatus == "RECHAZADO") { echo "checked";} ?> value="RECHAZADO" >Rechazado
        </div>
      <?php endforeach; ?>
    <?php endif; ?>

    <div class="form-group col-xs-12 col-sm-12"><br></div>

    <?php if (!is_null($observacion)): ?>
      <div class="form-group col-xs-12 col-sm-12 col-md-11">
        <h4>Comentario(s):</h4>
        <br>
        <p>Hay observaciones pendientes por atender</p>
      </div>
    <?php else: ?>
      <div class="col-xs-12">
        <h4>Comentario(s):</h4>
        <br>
        <textarea id="comentarios" rows="8" cols="80"></textarea>
        <br>
      </div>
    <?php endif; ?>

    <div class="form-group text-center col-xs-12">
      <button type="submit" class="btn btn-success" data-id="<?=$tramite->idTramite?>">Enviar a CA</button>
      <button type="submit" class="btn btn-success" data-id="<?=$tramite->idTramite?>">Enviar a CI</button>

      <?php if (is_null($observacion)): ?>
        <button type="submit" class="btn btn-success" id="btn-enviar-observacion" data-id="<?=$tramite->idTramite?>" data-id-u="<?=$alumno->idAlumno?>" >Enviar Observación</button>
      <?php endif; ?>
      <button type="submit" class="btn btn-success" data-id="<?=$tramite->idTramite?>">Enviar Respuesta</button>
    </div>
</div>

<body onload="mostrarImg()">
<div class="text-center">
  <h3 class="h3">Datos del Trámite</h3>
  <h4 class="h4 tamañoh4" id="id-tramite"><?=$catTramites[$tramite->idCatTramite]?></h4>
</div>

<div class="col-xs-12">
<br>

    <div class="form-group col-xs-12 col-sm-12 col-md-5 text-center">
      <label for="nombre">Nombre</label>
      <?php if (!is_null($alumno->nombre_alumno)): ?>
        <p name="nombre" id="nombre"><?php echo $alumno->nombre_alumno; ?></p>
      <?php else: ?>
        <p name="nombre" id="nombre"><?php echo $alumno->apellidoPaterno." ".$alumno->apellidoMaterno." ".$alumno->nombre;?></p>
      <?php endif; ?>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-3 text-center">
      <label for="text">Expediente</label>
      <p><?=$alumno->expediente?></p>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-4 text-center">
      <label for="text">Email</label>
      <?php if (!is_null($alumno->emailUsuario) AND $alumno->emailUsuario != ""): ?>
        <p><?=$alumno->emailUsuario?></p>
      <?php else: ?>
        <p>No hay dato</p>
      <?php endif; ?>

    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-3 text-center">
      <label for="text">Fecha Inicio Trámite</label>
      <p name="fecIniTram" id="fecIniTram"><?= fancy_date($tramite->fechaInicio); ?></p>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-3 text-center">
      <label for="text">Estatus</label>
      <p name="estatus" id="estatus"><?=$tramite->estatus; ?></p>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-3 text-center">
      <label for="text">Periodo</label>
      <p name="periodo" id="periodo"><?=$periodoTramite; ?></p>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-3 text-center">
      <label for="text">Fecha de Última Modificación</label>
      <p name="fecUltMod" id="fecUltMod"><?=fancy_date($tramite->feculmod); ?></p>
    </div>

    <?php if ($tramite->estatus == "FINALIZADO"): ?>
      <div class="form-group col-xs-12 col-sm-12 col-md-3 text-center">
        <label for="text">Fecha de Finalización</label>
        <p name="fecFin" id="fecFin"><?=fancy_date($tramite->fechaFin); ?></p>
      </div>
    <?php endif; ?>

    <?php if (!is_null($observacion)): ?>
      <div class="form-group col-xs-12 col-sm-12 col-md-3 text-center">
        <label for="text">Observaciones</label>
        <p name="expediente" id="expediente"><?=$observacion->observacion?></p>
      </div>
    <?php else: ?>
      <div class="form-group col-xs-12 col-sm-12 col-md-3 text-center">
        <label for="text">Observaciones</label>
        <p name="expediente" id="expediente">Sin observaciones por el momento</p>
      </div>
    <?php endif; ?>

    <div class="col-xs-12 archivos" id="contenedor">
    <?php if (!is_null($archivos)): ?>
      <?php foreach ($archivos as $archivo): ?>
          <div class="col-xs-8 col-sm-6 col-md-2 archivo" id="archivo<?=$archivo->idRT?>" onmouseenter="bajar(<?=$archivo->idRT?>)" onmouseleave="quitar(<?=$archivo->idRT?>)">
          <p><?=$archivo->ruta?></p>
            <div class="file <?php if ($archivo->estatus == "RECIBIDO") {
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
              <a href="<?=base_url()?>docs/tramites/<?=$alumno->expediente?>/<?=$archivo->idTramite?>/<?=$archivo->ruta?>" target="_blank" class="">Descargar</a>
              <?php if ($tramite->estatus=="PROCESO"): ?>
                <div class="radios">
                  <label><input type="radio" class="aprobFile" data-id="<?=$archivo->idRT?>" name="aprobado-<?=$archivo->idRT?>" <?php if ($archivo->estatus == "APROBADO") { echo "checked";} ?> value="APROBADO" >&nbsp;Aprobado</label>
                </div>
                <div class="radios">
                  <label><input type="radio" class="aprobFile" data-id="<?=$archivo->idRT?>" name="aprobado-<?=$archivo->idRT?>" <?php if ($archivo->estatus == "RECHAZADO") { echo "checked";} ?> value="RECHAZADO" >&nbsp;Rechazado</label>
                </div>
              <?php endif; ?>

            </figcaption>
          </div>
      <?php endforeach; ?>
    <?php endif; ?>
    </div>

    <?php if ($tramite->estatus=="PROCESO"): ?>
      <?php if (!is_null($observacion)): ?>
        <div class="form-group col-xs-12 col-sm-12 col-md-12">
          <h3 class="tamañoh3">Comentario(s)</h3>
          <p>Hay observaciones pendientes por atender</p>
        </div>
      <?php else: ?>
        <div class="col-xs-12 text-center center">
          <h3 class="tamañoh3">Comentario(s)</h3>
          <textarea id="comentarios" rows="10" cols="80" class="col-xs-6" re></textarea>
          <br>
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <?php if ($tramite->estatus=="INVESTIGACION" OR $tramite->estatus=="CONSEJO"): ?>
      <div class="col-md-6 listaInv" id="listaInv">
        <h1>Lista de Investigación</h1>
        <table>
          <tr>
            <th>Miembro</th>
            <th>Aprobación</th>
            <th>Comentario</th>
          </tr>
          <tr>
            <td>Miembro1</td>
            <td>X</td>
            <td>Comentario 1</td>
          </tr>
          <tr>
            <td>Miembro2</td>
            <td>/</td>
            <td>Comentario 2</td>
          </tr>
        </table>
      </div>
      <div class="col-md-6 listaConsejo" id="listaConsejo">
        <h1>Lista de Consejo</h1>
        <table>
          <tr>
            <th>Miembro</th>
            <th>Aprobación</th>
            <th>Comentario</th>
          </tr>
          <tr>
            <td>Miembro1</td>
            <td>X</td>
            <td>Comentario 1</td>
          </tr>
          <tr>
            <td>Miembro2</td>
            <td>/</td>
            <td>Comentario 2</td>
          </tr>
        </table>
      </div>
    <?php endif; ?>

    <div class="col-xs-12 opciones-t-sa">
      <?php if ($tramite->estatus=="PROCESO" AND $tramite->estatus!="INVESTIGACION"): ?>
        <button type="submit" class="btn btn-success btnEnvInves" data-id="<?=$tramite->idTramite?>">Enviar a Mesa de Investigación</button>
        <button type="submit" class="btn btn-success btnEnvCons" data-id="<?=$tramite->idTramite?>">Enviar a Consejo Académico</button>
      <?php endif; ?>

      <?php if ($tramite->estatus=='INVESTIGACION'): ?>
        <button type="submit" class="btn btn-success btnEnvCons" data-id="<?=$tramite->idTramite?>">Enviar a Consejo Académico</button>
      <?php endif; ?>

      <?php if (is_null($observacion) AND $tramite->estatus=="PROCESO"): ?>
        <button type="submit" class="btn btn-success" id="btn-enviar-observacion" data-id="<?=$tramite->idTramite?>" data-id-u="<?=$alumno->idAlumno?>" >Enviar observación</button>
      <?php endif; ?>
      <?php if ($tramite->estatus=="PREACTA"): ?>
        <button type="submit" class="btn btn-success btnResAprobado" data-id="<?=$tramite->idTramite?>">Enviar respuesta APROBADO</button>
        <button type="submit" class="btn btn-success btnResRechazado" data-id="<?=$tramite->idTramite?>">Enviar respuesta RECHAZADO</button>
      <?php endif; ?>

      <?php if ($tramite->estatus=="CONSEJO"): ?>
        <button type="submit" class="btn btn-success btnEnvPreacta" data-id="<?=$tramite->idTramite?>">Enviar a Preacta</button>
      <?php endif; ?>
    </div>
</div>
</form>

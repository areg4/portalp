<body onload="mostrarImg()">
<div class="text-center">
  <h3 class="h3">Datos del Trámite</h3>
  <h4 class="h4 tamañoh4" id="id-tramite"><?=$catTramites[$tramite->idCatTramite]?></h4>
</div>

<input type="hidden" name="idTramite" value="<?=$tramite->idTramite?>">

<div class="col-xs-12">
<br>
    <div class="form-group col-xs-12 col-sm-12 col-md-4 text-center">
      <label for="text">Expediente</label>
      <p><?=$alumno->expediente?></p>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-4 text-center">
      <label for="nombre">Nombre</label>
      <?php if (!is_null($alumno->nombre_alumno)): ?>
        <p name="nombre" id="nombre"><?php echo $alumno->nombre_alumno; ?></p>
      <?php else: ?>
        <p name="nombre" id="nombre"><?php echo $alumno->apellidoPaterno." ".$alumno->apellidoMaterno." ".$alumno->nombre;?></p>
      <?php endif; ?>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-4 text-center">
      <label for="text">Email</label>
      <?php if (!is_null($alumno->emailUsuario) AND $alumno->emailUsuario != ""): ?>
        <p><?=$alumno->emailUsuario?></p>
      <?php else: ?>
        <p>No hay dato</p>
      <?php endif; ?>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-2 text-center">
      <label for="text">Periodo</label>
      <p name="periodo" id="periodo"><?=$periodoTramite; ?></p>
    </div>

    <?php if (!is_null($materia)): ?>
      <div class="form-group col-xs-12 col-sm-12 col-md-8 text-center">
        <label for="text">Materia:</label>
        <p name="materia" id="materia"><?=$materia->cveMateria." | ".$materia->nombreMateria?></p>
      </div>
    <?php endif; ?>

    <div class="form-group col-xs-12 col-sm-12 col-md-2 text-center">
      <label for="text">Estatus</label>
      <p name="estatus" id="estatus"><?=$tramite->estatus; ?></p>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-4 text-center">
      <label for="text">Fecha Inicio Trámite</label>
      <p name="fecIniTram" id="fecIniTram"><?= fancy_date($tramite->fechaInicio); ?></p>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-4 text-center">
      <label for="text">Fecha de Última Modificación</label>
      <p name="fecUltMod" id="fecUltMod"><?=fancy_date($tramite->feculmod); ?></p>
    </div>

    <?php if ($tramite->estatus == "APROBADO" OR $tramite->estatus == "RECHAZADO"): ?>
      <div class="form-group col-xs-12 col-sm-12 col-md-4 text-center">
        <label for="text">Fecha de Finalización</label>
        <p name="fecFin" id="fecFin"><?=fancy_date($tramite->fechaFin); ?></p>
      </div>
    <?php endif; ?>

    <?php if (!is_null($tramite->nombreTrabajo)): ?>
      <div class="form-group col-xs-12 col-sm-12 text-center">
        <label for="text">Título del Trabajo:</label>
        <p name="nTrabajo" id="nTrabajo"><?=$tramite->nombreTrabajo?></p>
      </div>
    <?php endif; ?>

    <?php if (!is_null($observacion)): ?>
      <div class="form-group col-xs-12 col-sm-12 text-center">
        <label for="text">Observaciones</label>
        <p name="expediente" id="expediente"><?=$observacion->observacion?></p>
      </div>
    <?php else: ?>
      <div class="form-group col-xs-12 col-sm-12 text-center">
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

    <?php if ($tramite->estatus=="INVESTIGACION" OR $tramite->estatus=="TITULACION"): ?>
      <?php if (!is_null($investigadores)AND (!is_null($aprobacionesInves))): ?>
        <div id="listaInv">
          <div id="tabla" class="col-xs-12">
            <h3 class="h3">Comité de Investigación</h3>
            <table class="table responsive">
              <thead>
                <tr>
                  <th>Miembro</th>
                  <th>Aprobación</th>
                  <th>Comentario</th>
                  <th>Fecha respuesta</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($investigadores as $investigador): ?>
                <?php
                  if ($aprobacionesInves[$investigador->idUsuario]->aprobacion == 0) {
                    $aprobacion = "NO ATENDIDA";
                  }if ($aprobacionesInves[$investigador->idUsuario]->aprobacion == 1) {
                    $aprobacion = "APROBADO";
                  }if ($aprobacionesInves[$investigador->idUsuario]->aprobacion == 2) {
                    $aprobacion = "RECHAZADO";
                  }

                  if ($aprobacionesInves[$investigador->idUsuario]->comentario == "" or is_null($aprobacionesInves[$investigador->idUsuario]->comentario)) {
                    $comenInv = "SIN COMENTARIOS";
                  }else {
                    $comenInv = $aprobacionesInves[$investigador->idUsuario]->comentario;
                  }
                ?>
                <tr>
                  <td class="sincursor" data-title="Miembro"><?php echo $investigador->nombre." ".$investigador->apellidoPaterno." ".$investigador->apellidoMaterno; ?></td>
                  <td class="sincursor" data-title="Aprobación"><?php echo $aprobacion; ?></td>
                  <td class="sincursor" data-title="Comentario"><?php echo $comenInv; ?></td>
                  <td class="sincursor" data-title="Fecha respuesta"><?=(($aprobacionesInves[$investigador->idUsuario]->fechaHora)!=0) ? fancy_date($aprobacionesInves[$investigador->idUsuario]->fechaHora) : " - " ; ?></td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      <?php endif; ?>

      <?php if (!is_null($miemsTitulacion) AND !is_null($aprobacionesTitu)): ?>
        <div class="" id="listaConsejo">
          <div class="col-xs-12" id="tabla">
            <h3 class="h3">Comité de Titulación</h3>
            <table class="table responsive">
              <thead>
                <tr>
                  <th>Miembro</th>
                  <th>Aprobación</th>
                  <th>Comentario</th>
                  <th>Fecha respuesta</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($miemsTitulacion as $miemTitulacion): ?>
                  <?php
                    if ($aprobacionesTitu[$miemTitulacion->idUsuario]->aprobacion == 0) {
                      $aprobacion = "NO ATENDIDA";
                    }if ($aprobacionesTitu[$miemTitulacion->idUsuario]->aprobacion == 1) {
                      $aprobacion = "APROBADO";
                    }if ($aprobacionesTitu[$miemTitulacion->idUsuario]->aprobacion == 2) {
                      $aprobacion = "RECHAZADO";
                    }

                    if ($aprobacionesTitu[$miemTitulacion->idUsuario]->comentario == "" or is_null($aprobacionesTitu[$miemTitulacion->idUsuario]->comentario)) {
                      $comenInv = "SIN COMENTARIOS";
                    }else {
                      $comenInv = $aprobacionesTitu[$miemTitulacion->idUsuario]->comentario;
                    }
                  ?>
                  <tr>
                    <td data-title="Miembro"><?php echo $miemTitulacion->nombre." ".$miemTitulacion->apellidoPaterno." ".$miemTitulacion->apellidoMaterno; ?></td>
                    <td data-title="Aprobación"><?php echo $aprobacion; ?></td>
                    <td data-title="Comentario"><?php echo $comenInv; ?></td>
                    <td data-title="Fecha respuesta"><?=(($aprobacionesTitu[$miemTitulacion->idUsuario]->fechaHora)!=0) ? fancy_date($aprobacionesTitu[$miemTitulacion->idUsuario]->fechaHora) : " - " ; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <?php if (($tramite->estatus=="TITULACION") AND !is_null($recomendacion)): ?>

      <div class="col-xs-12">
        <h3 class="h3 text-center">Recomendación</h3>
        <p class="text-center">De acuerdo a los miembros del Comité de Titulación, se recomienda que el trámite sea:</p>
        <h3 class="tamañoh3 recomendacion text-center"><?=$recomendacion?></h3>
      </div>
    <?php endif; ?>

    <?php if ($tramite->estatus=="PREACTA"): ?>
        <form id="formRespuesta" class="formularioCampos col-xs-12" method="POST" action="<?=base_url()?>portal-informatica-tramites-generadorPDF">

          <input type="hidden" name="idTramite" value="<?=$tramite->idTramite?>">
          <!-- <input type="hidden" name="idMateria" value="<?=$materia->idMateria?>"> -->

          <div class="col-xs-12 col-sm-12 col-md-3 campos">
            <label for="text">Fecha que se celebró el Consejo</label><br>
            <input type="date" name="fechaConsejo" min="2018-01-01" required>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-3 campos">
            <label for="text">No. Oficio</label><br>
            <input type="text" class="txtNoOficio col-xs-12" name="noOficio" style="text-transform:uppercase" required>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-3 campos">
            <label for="text">Tipo de Sesión</label><br>
            <select class="" name="tipoSesion" required>
              <option value="ordinaria">Ordinaria</option>
              <option value="extraordinaria">Extraordinaria</option>
            </select>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-3 campos">
            <label for="text">No. Acta</label><br>
            <input type="number" name="noActa" class="col-xs-12" placeholder="000" min="0" required>
          </div>

          <div class="col-xs-12 border"><br></div>

          <?php if ($tramite->idCatTramite==1): ?>

          <div class="col-xs-12 col-md-3 campos">
            <label for="text">Fecha aplicación examen</label><br>
            <input type="date" class="requerido" id="fechaApliExam" name="fechaApliExam" min="2018-01-01">
          </div>


          <div class="col-xs-12 col-md-3 campos">
            <label for="text">Hora de Inicio</label><br>
            <input type="time" class="requerido" id="horaInicio" name="horaInicio">
          </div>


          <div class="col-xs-12 col-md-3 campos">
            <label for="text">Hora de Finalización</label><br>
            <input type="time" class="requerido" id="horaFin" name="horaFin">
          </div>

          <div class="col-xs-12 col-md-3 campos">
            <label for="text">Aula</label><br>
            <select class="col-xs-12 aula requerido" id="aula" name="aula">
              <option value="">Seleccione el aula</option>
              <?php if (!is_null($aula)): ?>
                <?php foreach ($aula as $aula): ?>
                  <option value="<?=$aula->descripcion?>"><?=$aula->descripcion?></option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>

          <div class="col-xs-12"><br></div>

          <div class="col-xs-12 col-md-4 campos">
            <label for="text">Presidente</label>
            <select class="col-xs-12 presidente requerido" id="presidente" name="presidente">
              <option value="">Seleccione al presidente</option>
              <?php if (!is_null($maestros)): ?>
                <?php foreach ($maestros as $maestro): ?>
                  <option value="<?=$maestro->idMaestro?>"><?=$maestro->cveMaestro." | ".$maestro->nombreMaestro?></option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>

          <div class="col-xs-12 col-md-4 campos">
            <label for="text">Sinodal</label>
            <select class="col-xs-12 sinodal1 requerido" id="sinodal1" name="sinodal1">
              <option value="">Seleccione al sinodal</option>
              <?php if (!is_null($maestros)): ?>
                <?php foreach ($maestros as $maestro): ?>
                  <option value="<?=$maestro->idMaestro?>"><?=$maestro->cveMaestro." | ".$maestro->nombreMaestro?></option>
                 <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>

          <div class="col-xs-12 col-md-4 campos">
            <label for="text">Sinodal</label>
            <select class="col-xs-12 sinodal2 requerido" id="sinodal2" name="sinodal2">
              <option value="">Seleccione al sinodal</option>
              <?php if (!is_null($maestros)): ?>
                <?php foreach ($maestros as $maestro): ?>
                  <option value="<?=$maestro->idMaestro?>"><?=$maestro->cveMaestro." | ".$maestro->nombreMaestro?></option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>
          <?php endif; ?>

          <?php if ($tramite->idCatTramite==3): ?>

            <div class="col-xs-12 col-md-4 campos">
              <label for="text">Tiempo solicitado</label>
              <input type="text" class="requerido" id="tiempoSoli" name="tiempoSoli" placeholder="uno, dos, tres años">
            </div>

            <div class="col-xs-12 col-md-4 campos">
              <label for="text">Periodo del Curso</label>
              <input type="text" class="requerido" name="periodoCurso" placeholder="de enero a junio del 2018">
            </div>

            <div class="col-xs-12 col-md-4 campos">
              <label for="text">Fecha Vencimiento Pasantía</label>
              <input type="date" class="requerido" name="fechaVenciPas" min="2018-01-01">
            </div>

            <div class="col-xs-12"><br></div>

          <?php endif; ?>

          <?php if ($tramite->estatus=="PREACTA"): ?>
            <div class="col-xs-12 right">
              <br>
              <br>
              <p class="tamañop">En base a las respuestas del Consejo Académico, seleccione el estatus del trámite para finalizar.</p>
            </div>
          <?php endif; ?>

            <div class="col-xs-12 right">
              <input type="submit" class="btn btn-success btnApro" data-id="<?=$tramite->idTramite?>" value="APROBADO" target="_blank">
              <input type="submit" class="btn btn-danger  btnRech" data-id="<?=$tramite->idTramite?>" value="RECHAZADO" target="_blank">
              <input type="hidden" id="decision" name="decision" value="<?=$tramite->estatus?>">
              <br>
            </div>
        </form>
    <?php endif; ?>

    <div class="col-xs-12 opciones-t-sa">
      <?php if ($tramite->estatus=="PROCESO" AND $tramite->estatus!="INVESTIGACION"): ?>
        <button type="submit" class="btn btn-info btnEnvInves" data-id="<?=$tramite->idTramite?>">Enviar a Comité de Investigación</button>
        <button type="submit" class="btn btn-info btnEnvTitu" data-id="<?=$tramite->idTramite?>">Enviar a Comité de Titulación</button>
      <?php endif; ?>

      <?php if ($tramite->estatus=='INVESTIGACION'): ?>
        <button type="submit" class="btn btn-info btnEnvTitu" data-id="<?=$tramite->idTramite?>">Enviar a Comité de Titulación</button>
      <?php endif; ?>

      <?php if (is_null($observacion) AND $tramite->estatus=="PROCESO"): ?>
        <button type="submit" class="btn btn-warning" id="btn-enviar-observacion" data-id="<?=$tramite->idTramite?>" data-id-u="<?=$alumno->idAlumno?>" >Enviar observación</button>
      <?php endif; ?>

      <div class="form-group col-xs-12 col-sm-12 text-center">
      <?php if ($tramite->estatus=="TITULACION"): ?>
        <button type="submit" class="btn btn-success btnEnvPreacta" data-id="<?=$tramite->idTramite?>">Enviar a Preacta</button>
      <?php endif; ?>
      </div>

      <div class="form-group col-xs-12 col-sm-12 text-center">
        <?php if ($tramite->estatus=="APROBADO" OR $tramite->estatus=="RECHAZADO"): ?>
          <?php if (!is_null($rutaRespuesta)):
            $link = "docs/tramites/".$alumno->expediente."/".$tramite->idTramite."/respuesta/".$rutaRespuesta->ruta.".pdf";
          ?>
            <a class="btn btn-success" href="<?=base_url().$link?>" target="_blank">Imprimir PDF</a>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
</div>
</form>

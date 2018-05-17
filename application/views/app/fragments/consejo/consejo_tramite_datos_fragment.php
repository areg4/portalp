<body onload="mostrarImg()">
<div>
  <h3 class="h3 text-center">Datos del Trámite</h3>
  <h4 class="h4 tamañoh4 text-center" id="id-tramite"><?=$catTramites[$tramite->idCatTramite]?></h4>
</div>

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

    <div class="form-group col-xs-12 col-sm-12 col-md-4 text-center">
      <label for="text">Fecha Inicio Trámite</label>
      <p name="fecIniTram" id="fecIniTram"><?= fancy_date($tramite->fechaInicio); ?></p>
    </div>

    <!-- Sección que aparece si el trámite ya fue atendido -->

    <?php if ($aprobacionesConse[$idUsuario]->aprobacion != 0): ?>
      <div class="form-group col-xs-12 col-sm-12 col-md-4 text-center">
        <label for="text">Determinación</label>
        <p name="determinacion" id="determinacion"><?php
          if ($aprobacionesConse[$idUsuario]->aprobacion == 1) {
            echo "APROBADO";
          }else {
            echo "RECHAZADO";
          }?>
        </p>
      </div>

      <div class="form-group col-xs-12 col-sm-12 col-md-4 text-center">
        <label for="text">Fecha Determinación</label>
        <p name="fecDetermi" id="fecDetermi"><?=(($aprobacionesConse[$idUsuario]->fechaHora)!=0) ? fancy_date($aprobacionesConse[$idUsuario]->fechaHora) : "" ; ?></p>
      </div>
    <?php endif; ?>

    <?php if (!is_null($materia)): ?>
      <div class="form-group col-xs-12 col-sm-12 col-md-12 text-center">
        <label for="text">Materia:</label>
        <p name="materia" id="materia"><?=$materia->cveMateria." | ".$materia->nombreMateria?></p>
      </div>
    <?php endif; ?>

    <!-- Fin de sección -->
    <?php if (!is_null($tramite->nombreTrabajo)): ?>
      <div class="form-group col-xs-12 col-sm-12 text-center">
        <label for="text">Título del Trabajo:</label>
        <p name="nTrabajo" id="nTrabajo"><?=$tramite->nombreTrabajo?></p>
      </div>
    <?php endif; ?>

    <div class="archivos col-xs-12" id="contenedor">
    <?php if (!is_null($archivos)): ?>
      <?php foreach ($archivos as $archivo): ?>
          <div class="col-xs-8 col-sm-6 col-md-2 archivo" id="archivo<?=$archivo->idRT?>" onmouseenter="bajar(<?=$archivo->idRT?>)" onmouseleave="quitar(<?=$archivo->idRT?>)">
          <p><?=$archivo->ruta?> </p>
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
                  <input type="radio" class="aprobFile" data-id="<?=$archivo->idRT?>" name="aprobado-<?=$archivo->idRT?>" <?php if ($archivo->estatus == "APROBADO") { echo "checked";} ?> value="APROBADO" ><span> Aprobado</span>
                </div>
                <div class="radios">
                  <input type="radio" class="aprobFile" data-id="<?=$archivo->idRT?>" name="aprobado-<?=$archivo->idRT?>" <?php if ($archivo->estatus == "RECHAZADO") { echo "checked";} ?> value="RECHAZADO" ><span>Rechazado </span>
                </div>
              <?php endif; ?>

            </figcaption>
          </div>
      <?php endforeach; ?>
    <?php endif; ?>
    </div>

    <?php if (!is_null($investigadores)AND (!is_null($aprobacionesInves))): ?>
      <div class="col-md-12" id="tabla">
        <h3 class="h3 tamañoh3">Investigación</h3>
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
            <?php if ($investigador->idUsuario != $idUsuario): ?>
              <?php
                if ($aprobacionesInves[$investigador->idUsuario]->aprobacion == 0) {
                  $aprobacion = "NO ATENDIDA";
                }if ($aprobacionesInves[$investigador->idUsuario]->aprobacion == 1) {
                  $aprobacion = "APROBADO";
                }if ($aprobacionesInves[$investigador->idUsuario]->aprobacion == 2) {
                  $aprobacion = "RECHAZADO";
                }

                if ($aprobacionesInves[$investigador->idUsuario]->comentario == "" or is_null($aprobacionesInves[$investigador->idUsuario]->comentario)) {
                  $comenInv = "Sin comentarios";
                }else {
                  $comenInv = $aprobacionesInves[$investigador->idUsuario]->comentario;
                }
              ?>
              <tr>
                <td data-title="Miembro"><?php echo $investigador->nombre." ".$investigador->apellidoPaterno." ".$investigador->apellidoMaterno; ?></td>
                <td data-title="Aprobación"><?php echo $aprobacion; ?></td>
                <td data-title="Comentario"><?php echo $comenInv; ?></td>
                <td data-title="Fecha respuesta"><?=(($aprobacionesInves[$investigador->idUsuario]->fechaHora)!=0) ? fancy_date($aprobacionesInves[$investigador->idUsuario]->fechaHora) : " - " ; ?></td>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>

    <?php if ($idRol != 10): //rol de presidente?>
      <?php if (!is_null($consejeros) AND (!is_null($aprobacionesConse))): ?>
        <div class="col-md-6" id="tabla">
          <h3 class="h3 tamañoh3">Lista de Consejo</h3>
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
              <?php foreach ($consejeros as $consejero): ?>
                <?php if ($consejero->idUsuario != $idUsuario): ?>
                  <?php
                    if ($aprobacionesConse[$consejero->idUsuario]->aprobacion == 0) {
                      $aprobacion = "NO ATENDIDA";
                    }if ($aprobacionesConse[$consejero->idUsuario]->aprobacion == 1) {
                      $aprobacion = "APROBADO";
                    }if ($aprobacionesConse[$consejero->idUsuario]->aprobacion == 2) {
                      $aprobacion = "RECHAZADO";
                    }

                    if ($aprobacionesConse[$consejero->idUsuario]->comentario == "" or is_null($aprobacionesConse[$consejero->idUsuario]->comentario)) {
                      $comenInv = "Sin comentarios";
                    }else {
                      $comenInv = $aprobacionesConse[$consejero->idUsuario]->comentario;
                    }
                  ?>
                  <tr>
                    <td data-title="Miembro"><?php echo $consejero->nombre." ".$consejero->apellidoPaterno." ".$consejero->apellidoMaterno; ?></td>
                    <td data-title="Aprobación"><?php echo $aprobacion; ?></td>
                    <td data-title="Comentario"><?php echo $comenInv; ?></td>
                    <td data-title="Fecha respuesta"><?=(($aprobacionesConse[$consejero->idUsuario]->fechaHora)!=0) ? fancy_date($aprobacionesConse[$consejero->idUsuario]->fechaHora) : " - " ; ?></td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    <?php else: ?>
      <?php if (!is_null($consejeros) AND (!is_null($aprobacionesConse))): ?>
        <div class="col-md-12" id="tabla">
          <h3 class="h3">Consejo</h3>
          <table class="table responsive">
            <thead>
              <tr>
                <th>Miembro</th>
                <th>Aprobación</th>
                <th>Comentario</th>
                <th>Fecha respuesta</th>
                <th>Designación</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($consejeros as $consejero): ?>
                  <?php
                    if ($aprobacionesConse[$consejero->idUsuario]->aprobacion == 0) {
                      $aprobacion = "NO ATENDIDA";
                    }if ($aprobacionesConse[$consejero->idUsuario]->aprobacion == 1) {
                      $aprobacion = "APROBADO";
                    }if ($aprobacionesConse[$consejero->idUsuario]->aprobacion == 2) {
                      $aprobacion = "RECHAZADO";
                    }

                    if ($aprobacionesConse[$consejero->idUsuario]->comentario == "" or is_null($aprobacionesConse[$consejero->idUsuario]->comentario)) {
                      $comenInv = "Sin comentarios";

                    }else {
                      $comenInv = $aprobacionesConse[$consejero->idUsuario]->comentario;
                    }
                  ?>
                  <tr>
                    <td data-title="Miembro"><?php echo $consejero->nombre." ".$consejero->apellidoPaterno." ".$consejero->apellidoMaterno; ?></td>
                    <td data-title="Aprobación"><?php echo $aprobacion; ?></td>
                    <td data-title="Comentario"><?php echo $comenInv; ?></td>
                    <td data-title="Fecha respuesta"><?=(($aprobacionesConse[$consejero->idUsuario]->fechaHora)!=0) ? fancy_date($aprobacionesConse[$consejero->idUsuario]->fechaHora) : " - " ; ?></td>
                    <td data-title="Designacion" class="sincursor designaciones" style="height: 80px !important;">
                      <label><input type="radio" class="" data-user-id="<?=$consejero->idUsuario?>" name="desig-<?=$consejero->idUsuario?>" value="1" <?=($aprobacionesConse[$consejero->idUsuario]->aprobacion)==1 ? "checked" : "";?>>&nbsp;Aprobado</label><br>
                      <label><input type="radio" class="" data-user-id="<?=$consejero->idUsuario?>" name="desig-<?=$consejero->idUsuario?>" value="2" <?=($aprobacionesConse[$consejero->idUsuario]->aprobacion)==2 ? "checked" : "";?> >&nbsp;Rechazado</label>
                    </td>
                  </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <?php if (($aprobacionesConse[$idUsuario]->aprobacion == 0) AND ($tramite->estatus == "CONSEJO")): ?>
      <div class="col-xs-12 text-center center">
        <h3 class="tamañoh3">Comentario(s)</h3>
        <textarea id="comentarios" rows="10" cols="80" class="col-xs-6"></textarea>
        <br>
      </div>
    <?php else: ?>
      <div class="col-xs-12 text-center center">
        <h3 class="tamañoh3">Comentario(s)</h3>
        <p name="comen" id="comen"><?php
        if ($aprobacionesConse[$idUsuario]->comentario == "" or is_null($aprobacionesConse[$idUsuario]->comentario)) {
          echo "Sin comentarios";
        }else {
          echo $aprobacionesConse[$idUsuario]->comentario;
        }
          // echo $aprobacionesConse[$idUsuario]->comentario;
        ?>
        </p>
        <br>
      </div>
    <?php endif; ?>

    <?php if ($idRol != 10): ?>
      <?php if (($aprobacionesConse[$idUsuario]->aprobacion == 0) AND ($tramite->estatus == "CONSEJO")): ?>
        <div class="col-xs-12 opciones-t-sa">
          <button type="submit" class="btn btn-success btnAproConsejo" data-id="<?=$tramite->idTramite?>" data-user="<?=$idUsuario?>">Aprobar</button>
          <button type="submit" class="btn btn-danger btnRechaConsejo" data-id="<?=$tramite->idTramite?>" data-user="<?=$idUsuario?>">Rechazar</button>
        </div>
      <?php endif; ?>

    <?php else: ?>
      <?php if (($aprobacionesConse[$idUsuario]->aprobacion == 0) AND ($tramite->estatus=="CONSEJO")): ?>
        <div class="col-xs-12 right">
          <br>
          <button type="submit" class="btn btn-success  btnEnvDesigTitu" data-id="<?=$tramite->idTramite?>" data-user="<?=$idUsuario?>">Enviar Designaciones</button>
        </div>
      <?php endif; ?>
    <?php endif; ?>


</div>
</body>

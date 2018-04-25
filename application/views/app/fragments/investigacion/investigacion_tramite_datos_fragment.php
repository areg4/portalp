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

    <!-- Sección que aparece si el trámite ya fue atendido -->

    <?php if ($aprobacionesInves[$idUsuario]->aprobacion != 0): ?>
      <div class="form-group col-xs-12 col-sm-12 col-md-3 text-center">
        <label for="text">Determinación</label>
        <p name="determinacion" id="determinacion"><?php
          if ($aprobacionesInves[$idUsuario]->aprobacion == 1) {
            echo "APROBADO";
          }else {
            echo "RECHAZADO";
          }?>
        </p>
      </div>

      <div class="form-group col-xs-12 col-sm-12 col-md-3 text-center">
        <label for="text">Fecha Determinación</label>
        <p name="fecDetermi" id="fecDetermi"><?=(($aprobacionesInves[$idUsuario]->fechaHora)!=0) ? fancy_date($aprobacionesInves[$idUsuario]->fechaHora) : "" ; ?></p>
      </div>
    <?php endif; ?>

    <!-- Fin de sección -->

    <div class="archivos col-xs-12" id="contenedor">
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
      <div class="col-md-6 listaInv" id="listaInv">
        <h1>Lista de Investigación</h1>
        <table>
          <tr>
            <th>Miembro</th>
            <th>Aprobación</th>
            <th>Comentario</th>
            <th>Fecha Atendido</th>
          </tr>
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

                if ($aprobacionesInves[$investigador->idUsuario]->comentario == "" or is_null($aprobacionesInves[$investigador->idUsuario]->comentario) or $aprobacionesInves[$investigador->idUsuario]->comentario == 0) {
                  $comenInv = "SIN COMENTARIOS";
                }else {
                  $comenInv = $aprobacionesInves[$investigador->idUsuario]->comentario;
                }
              ?>
              <tr>
                <td><?php echo $investigador->nombre." ".$investigador->apellidoPaterno." ".$investigador->apellidoMaterno; ?></td>
                <td><?php echo $aprobacion; ?></td>
                <td><?php echo $comenInv; ?></td>
                <td><?=(($aprobacionesInves[$investigador->idUsuario]->fechaHora)!=0) ? fancy_date($aprobacionesInves[$investigador->idUsuario]->fechaHora) : "" ; ?></td>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
        </table>
      </div>
    <?php endif; ?>

    <?php if ($aprobacionesInves[$idUsuario]->aprobacion == 0): ?>
      <div class="col-xs-12 text-center center">
        <h3 class="tamañoh3">Comentario(s)</h3>
        <textarea id="comentarios" rows="10" cols="80" class="col-xs-6"></textarea>
        <br>
      </div>
    <?php else: ?>
      <div class="col-xs-12 text-center center">
        <h3 class="tamañoh3">Comentario(s)</h3>
        <p name="comen" id="comen"><?php
        if ($aprobacionesInves[$idUsuario]->comentario == "" or is_null($aprobacionesInves[$idUsuario]->comentario)) {
          echo "SIN COMENTARIOS";
        }else {
          echo $aprobacionesInves[$idUsuario]->comentario;
        }
          // echo $aprobacionesInves[$idUsuario]->comentario;
        ?>
        </p>
        <br>
      </div>
    <?php endif; ?>

    <?php if ($aprobacionesInves[$idUsuario]->aprobacion == 0): ?>
      <div class="col-xs-12 opciones-t-sa">
        <button type="submit" class="btn btn-success btnAproInves" data-id="<?=$tramite->idTramite?>" data-user="<?=$idUsuario?>">Aprobar</button>
        <button type="submit" class="btn btn-success btnRechaInves" data-id="<?=$tramite->idTramite?>" data-user="<?=$idUsuario?>">Rechazar</button>
      </div>
    <?php endif; ?>
</div>
</body>

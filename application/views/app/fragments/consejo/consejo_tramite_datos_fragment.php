<body onload="mostrarImg()">
<div>
  <h3 class="h3 text-center">Datos del Trámite</h3>
  <h4 class="h4 tamañoh4 text-center" id="id-tramite"><?=$catTramites[$tramite->idCatTramite]?></h4>
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

    <div class="col-xs-12 text-center center">
      <h3 class="tamañoh3">Comentario(s)</h3>
      <textarea id="comentarios" rows="10" cols="80" class="col-xs-6" re></textarea>
      <br>
    </div>

    <div class="col-xs-12 opciones-t-sa">
      <button type="submit" class="btn btn-success btnAproConsejo" data-id="<?=$tramite->idTramite?>">Aprobar</button>
      <button type="submit" class="btn btn-success btnRechaConsejo" data-id="<?=$tramite->idTramite?>">Rechazar</button>
    </div>
</div>
</body>

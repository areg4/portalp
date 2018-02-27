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
      <div class="col-xs-12 col-sm-12 col-md-2 archivo">
        <p>Solicitud</p>
        <div class=" file">
          <img src="<?=base_url()?>static/img/s.png" id="1">
          <input class="ocultar"  id="" type="file" name="solicitudEV" required onchange="cambiarIcon(1)">
        </div>
      </div>

      <?php if ($tramite->tramite == "Examen Voluntario"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Kárdex</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/k.png" id="2">
              <input class="ocultar"  id="" type="file" name="kardexEV" required onchange="cambiarI(2)">
              <input type="hidden" name="idTramite" value="<?=$tramite->idCatTramite; ?>">
              <input type="hidden" name="tramite" value="<?=$tramite->tramite; ?>" >
          </div>
        </div>
      <?php endif; ?>
    </div>

      <?php if ($tramite->tramite == "Prórroga de Licenciatura"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <div class="col-xs-12 col-sm-12 col-md-4 file">
            <label for="text">Prórroga papel 1</label>
            <input class="ocultar"  id="" type="file" name="archivoPorS[]" required>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <div class="col-xs-12 col-sm-12 col-md-4 file">
            <label for="text">Prórroga papel 2</label>
            <input class="ocultar"  id="" type="file" name="archivoPorS[]" required>
            <input type="hidden" name="idTramite" value="<?=$tramite->idCatTramite; ?>" >
            <input type="hidden" name="tramite" value="<?=$tramite->tramite; ?>" >
          </div>
        </div>
      <?php endif; ?>

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
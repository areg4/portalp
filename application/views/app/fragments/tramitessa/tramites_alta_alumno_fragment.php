<div class="col-xs-12 col-sm-12 text-center">
  <h1 class="h1 ">Formulario de alta para <?=$tramite->tramite; ?> </h1>
</div>
<?php
  if(!is_null($alumno)){

?>
<div class="col-xs-12">
<br>
  <form enctype="multipart/form-data" action="<?php echo base_url().'portal-informatica-alumnos-tramites-add' ?>" method="post" >
    <div class="form-group col-xs-12 col-sm-12 col-md-5">
      <label for="nombre">Nombre:</label>
      <!-- <input class="form-control" id="nombre" type="text" name="nombre" > -->
      <?php if (!is_null($alumno->nombre_alumno)): ?>
        <p name="nombre" id="nombre"><?php echo $alumno->nombre_alumno; ?></p>
      <?php else: ?>
        <p name="nombre" id="nombre"><?php echo $alumno->apellidoPaterno." ".$alumno->apellidoMaterno." ".$alumno->nombre;?></p>
      <?php endif; ?>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-3">
      <label for="text">Expediente:</label>
      <!-- <input class="form-control"  id="" type="text" name="" > -->
      <p name="expediente" id="expediente"><?php echo $alumno->expediente; ?></p>
    </div>
    <!-- <?php if ($examenV): ?>
      <div class="form-group col-xs-12 col-sm-12 col-md-4">
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
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc hendrerit lectus purus, in porttitor tortor congue nona </p>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 file">
      <label for="text">Solicitud corresponiente</label>
      <input class="ocultar"  id="" type="file" name="solicitudEV" required>
    </div>
    <?php if ($tramite->tramite == "Examen Voluntario"): ?>
      <div class="col-xs-12 col-sm-12 col-md-4 file">
        <label for="text">Kardex</label>
        <input class="ocultar"  id="" type="file" name="kardexEV" required>
        <input type="hidden" name="idTramite" value="<?=$tramite->idCatTramite; ?>" >
        <input type="hidden" name="tramite" value="<?=$tramite->tramite; ?>" >
      </div>
    <?php endif; ?>



    <?php if ($tramite->tramite == "Prorroga de Licenciatura"): ?>
      <div class="col-xs-12 col-sm-12 col-md-4 file">
        <label for="text">Prorroga papel 1</label>
        <input class="ocultar"  id="" type="file" name="archivoPorS[]" required>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 file">
        <label for="text">Prorroga papel 2</label>
        <input class="ocultar"  id="" type="file" name="archivoPorS[]" required>
        <input type="hidden" name="idTramite" value="<?=$tramite->idCatTramite; ?>" >
        <input type="hidden" name="tramite" value="<?=$tramite->tramite; ?>" >
      </div>
    <?php endif; ?>

    <!-- <div class="col-xs-12 col-sm-12 col-md-4 file">
      <label for="text">Documento b</label>
      <input class=" btn-menta"  id="" type="file" name="">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 file">
      <label for="text">Documento c</label>
      <input class="btn-menta"  id="" type="file" name="">
    </div> -->


    <div class="col-xs-12 leyenda">
      <p> <b>Recuerda:</b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc hendrerit lectus purus, in porttitor tortor congue nona </p>
      <br>
    </div>
    <div class="form-group text-center col-xs-12">
      <button type="submit" class="btn btn-success">Tramitar</button>
    </div>
  </form>
</div>

<?php } ?>

<!-- <div class="">
  <h1>Formulario de alta para tramite</h1>
</div>
<div class="">
  <form class="" action="#" method="post">
    <input type="text" name="" value="">
    <input type="text" name="" value="">
    <input type="text" name="" value="">
    <input type="file" name="" value="">
    <input type="file" name="" value="">
    <input type="file" name="" value="">
    <input type="file" name="" value="">
    <input type="submit" name="" value="Dar de Alta">
  </form>
</div> -->

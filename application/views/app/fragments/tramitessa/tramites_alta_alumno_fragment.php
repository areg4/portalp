<div class="col-xs-12 col-sm-12 text-center">
  <h1 class="h1 tamañoh1 text-center">Formulario de alta <br><?=$tramite->tramite; ?></h1>
</div>
<?php
  if(!is_null($alumno)){

?>
<div class="col-xs-12 bottom">
<br>
  <form id="formAlta" enctype="multipart/form-data" action="<?php echo base_url().'portal-informatica-alumnos-tramites-add' ?>" method="post" >
    <div class="form-group col-xs-12 col-sm-12 col-md-4 text-center mtop">
      <label for="text">Expediente</label>
      <p name="expediente" id="expediente"><?php echo $alumno->expediente; ?></p>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-4 text-center mtop">
      <label for="nombre">Nombre</label>
      <?php if (!is_null($alumno->nombre_alumno)): ?>
        <p name="nombre" id="nombre"><?php echo $alumno->nombre_alumno; ?></p>
      <?php else: ?>
        <p name="nombre" id="nombre"><?php echo $alumno->apellidoPaterno." ".$alumno->apellidoMaterno." ".$alumno->nombre;?></p>
      <?php endif; ?>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-4 text-center mtop">
      <label for="text">Periodo</label>
      <p name="expediente" id="expediente"><?php echo $periodo; ?></p>
    </div>
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

    <div class="col-xs-12 formularioCampos">
      <?php if ($tramite->tramite == "Examen Voluntario"): ?>
      <div class="col-xs-12 text-center campos">
          <b class="tamañop">Materia</b> <br>
          <select class="materias" name="materia" required>
            <option value="0" style="display: none">Selecciona la materia</option>
            <?php foreach ($materias as $materia): ?>
              <option value="<?=$materia->idMateria?>"><?=$materia->cveMateria?> | <?=$materia->nombreMateria?> </option>
            <?php endforeach; ?>
          </select>
      </div>
      <?php endif; ?>

      <?php if ($tramite->tramite == "Readquisición de Pasantía"): ?>
      <div class="col-xs-12 text-center campos">
          <b class="tamañop">Nombre del Curso de Actualización</b><br>
          <input type="nTrabajo" name="nTrabajo" required placeholder="Escriba aquí el curso" class="materias">
      </div>
      <?php endif; ?>

      <?php if ($tramite->tramite == "Guía del Maestro"): ?>
        <div class="col-xs-12 text-center campos">
          <b class="tamañop">Materia</b><br>
          <select class="materias" name="materia" required>
            <option value="">Seleccionar la Materia</option>
            <?php foreach ($materias as $materia): ?>
              <option value="<?=$materia->idMateria?>"><?=$materia->cveMateria?> | <?=$materia->nombreMateria?> </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-xs-12 text-center campos">
          <b class="tamañop">Asesor</b><br>
          <select class="materias" name="maestro" required>
              <option value="">Seleccione al asesor</option>
                <?php foreach ($maestros as $maestro): ?>
                  <option value="<?=$maestro->idMaestro?>"><?=$maestro->cveMaestro." | ".$maestro->nombreMaestro?></option>
                <?php endforeach; ?>
            </select>
        </div>
      <?php endif; ?>

      <?php if ($tramite->tramite == "Tesis Individual"): ?>
      <div class="col-xs-12 text-center campos">
          <b class="tamañop">Título de la Tesis</b><br>
          <input type="text" name="nTrabajo" required placeholder="Escriba el título de la tesis" class="materias">
      </div>
      <?php endif; ?>

      <?php if ($tramite->tramite == "Trabajo Terminado"): ?>
      <div class="col-xs-12 text-center campos">
          <b class="tamañop">Título de Memoria de Trabajo</b><br>
          <input type="text" name="nTrabajo" required placeholder="Escriba el título de la memoria de trabajo" class="materias">
      </div>

      <div class="col-xs-12 text-center campos">
          <b class="tamañop">Asesor</b><br>
          <select class="materias" name="maestro" required>
              <option value="">Seleccione al asesor</option>
                <?php foreach ($maestros as $maestro): ?>
                  <option value="<?=$maestro->idMaestro?>"><?=$maestro->cveMaestro." | ".$maestro->nombreMaestro?></option>
                <?php endforeach; ?>
            </select>
        </div>
      <?php endif; ?>

    </div>

    <div class="col-xs-12 archivos">
      <?php if ($tramite->tramite == "Examen Voluntario"): ?>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1" data-default-icon="<?=base_url()?>static/img/solicitud.png">
            <input class="ocultar fileUp"  id="" type="file" name="solicitudEV" accept="application/pdf" required onchange="cambiarIcon(1)">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Kárdex</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/kardex.png" id="2" data-default-icon="<?=base_url()?>static/img/kardex.png">
              <input class="ocultar fileUp"  id="" type="file" name="kardexEV" accept="application/pdf" required>
              <!-- <input type="hidden" name="idTramite" value="<?=$tramite->idCatTramite; ?>">
              <input type="hidden" name="tramite" value="<?=$tramite->tramite; ?>" > -->
          </div>
        </div>
      <?php endif; ?>
    </div>

      <div class="col-xs-12 archivos">
      <?php if ($tramite->tramite == "Prórroga de Licenciatura"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
        <p>Prórroga Papel 1</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/prorroga.png" id="3" data-default-icon="<?=base_url()?>static/img/prorroga.png">
            <input class="ocultar fileUp"  id="" type="file" name="archivoPorS[]" required>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Prórroga Papel 2</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/prorroga.png" id="4" data-default-icon="<?=base_url()?>static/img/prorroga.png">
            <input class="ocultar fileUp"  id="" type="file" name="archivoPorS[]" required>
            <!-- <input type="hidden" name="idTramite" value="<?=$tramite->idCatTramite; ?>" >
            <input type="hidden" name="tramite" value="<?=$tramite->tramite; ?>" > -->
          </div>
        </div>
      <?php endif; ?>
      </div>

      <div class="col-xs-12 archivos">
      <?php if ($tramite->tramite == "Readquisición de Pasantía"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1" data-default-icon="<?=base_url()?>static/img/solicitud.png">
            <input class="ocultar fileUp"  id="" type="file" name="solicitudRP" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Carta Calificación Diplomado</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/carta.png" id="2" data-default-icon="<?=base_url()?>static/img/carta.png">
              <input class="ocultar fileUp"  id="" type="file" name="cartaCalifDiploRP" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Recibo del Diplomado</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/recibo.png" id="3" data-default-icon="<?=base_url()?>static/img/recibo.png">
              <input class="ocultar fileUp"  id="" type="file" name="reciboDiploRP" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Kardex</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/kardex.png" id="4" data-default-icon="<?=base_url()?>static/img/kardex.png">
              <input class="ocultar fileUp"  id="" type="file" name="kardexRP" accept="application/pdf" required>
          </div>
        </div>
      <?php endif; ?>
      </div>

      <div class="archivos col-xs-12">
      <?php if ($tramite->tramite == "Cursos y Diplomados de Actualización y de Profundización Disciplinaria"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1">
            <input class="ocultar fileUp"  id="" type="file" name="solicitudCD" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Carta Calificación Diplomado</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/carta.png" id="2" data-default-icon="<?=base_url()?>static/img/carta.png">
              <input class="ocultar fileUp"  id="" type="file" name="cartaCalifDiploCD" accept="application/pdf">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Recibo del Diplomado</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/recibo.png" id="3" data-default-icon="<?=base_url()?>static/img/recibo.png">
              <input class="ocultar fileUp"  id="" type="file" name="reciboDiploCD" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Kardex</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/kardex.png" id="4" data-default-icon="<?=base_url()?>static/img/kardex.png">
              <input class="ocultar fileUp"  id="" type="file" name="kardexCD" accept="application/pdf" required>
          </div>
        </div>
      <?php endif; ?>
      </div>


      <div class="archivos col-xs-12">
      <?php if ($tramite->tramite == "Guía del Maestro"): ?>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1" data-default-icon="<?=base_url()?>static/img/solicitud.png">
            <input class="ocultar fileUp"  id="" type="file" name="solicitudGM" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Protocolo</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/protocolo.png" id="2" data-default-icon="<?=base_url()?>static/img/protocolo.png">
              <input class="ocultar fileUp"  id="" type="file" name="protocoloGM" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Carta Aceptación del maestro responsable</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/carta.png" id="3" data-default-icon="<?=base_url()?>static/img/carta.png">
              <input class="ocultar fileUp"  id="" type="file" name="cartaAeptacionMRespoGM" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Kardex</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/kardex.png" id="4" data-default-icon="<?=base_url()?>static/img/kardex.png">
              <input class="ocultar fileUp"  id="" type="file" name="kardexGM" accept="application/pdf" required>
          </div>
        </div>
      <?php endif; ?>
      </div>

      <div class="archivos col-xs-12">
      <?php if ($tramite->tramite == "Memoria de Trabajo"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1" data-default-icon="<?=base_url()?>static/img/solicitud.png">
            <input class="ocultar fileUp"  id="" type="file" name="solicitudMT" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Protocolo</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/protocolo.png" id="2" data-default-icon="<?=base_url()?>static/img/protocolo.png">
              <input class="ocultar fileUp"  id="" type="file" name="protocoloMT" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Carta del lugar de trabajo</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/carta.png" id="3" data-default-icon="<?=base_url()?>static/img/carta.png">
              <input class="ocultar fileUp"  id="" type="file" name="cartaLugarTrabajoMT" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Carta del Asesor Académico</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/carta.png" id="4" data-default-icon="<?=base_url()?>static/img/carta.png">
              <input class="ocultar fileUp"  id="" type="file" name="cartaAsesorAcadeMT" accept="application/pdf" required>
          </div>
        </div>
      <?php endif; ?>
      </div>

      <div class="archivos col-xs-12">
      <?php if ($tramite->tramite == "Trabajo Terminado"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1" data-default-icon="<?=base_url()?>static/img/solicitud.png">
            <input class="ocultar fileUp"  id="" type="file" name="solicitudTT" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Trabajo Terminado</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/trabajo.png" id="2" data-default-icon="<?=base_url()?>static/img/trabajo.png">
              <input class="ocultar fileUp"  id="" type="file" name="trabajoTT" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Carta Asesor Académico</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/carta.png" id="3" data-default-icon="<?=base_url()?>static/img/carta.png">
              <input class="ocultar fileUp"  id="" type="file" name="cartaAsesorTT" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Carta del lugar de trabajo</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/carta.png" id="4" data-default-icon="<?=base_url()?>static/img/carta.png">
              <input class="ocultar fileUp"  id="" type="file" name="cartaTrabajoTT" accept="application/pdf" required>
          </div>
        </div>
      <?php endif; ?>
      </div>


      <div class="archivos col-xs-12">
      <?php if ($tramite->tramite == "Tesis Individual"): ?>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1" data-default-icon="<?=base_url()?>static/img/solicitud.png">
            <input class="ocultar fileUp"  id="" type="file" name="solicitudTI" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Kardex CU</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/kardex.png" id="2" data-default-icon="<?=base_url()?>static/img/kardex.png">
              <input class="ocultar fileUp"  id="" type="file" name="kardexTI" accept="application/pdf" required>
          </div>
        </div>
      <?php endif; ?>
      </div>

      <div class="archivos col-xs-12">
      <?php if ($tramite->tramite == "Promedio"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1" data-default-icon="<?=base_url()?>static/img/solicitud.png">
            <input class="ocultar fileUp"  id="" type="file" name="solicitudPro" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Kardex CU</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/kardex.png" id="2" data-default-icon="<?=base_url()?>static/img/kardex.png">
              <input class="ocultar fileUp"  id="" type="file" name="kardexPro" accept="application/pdf" required>
          </div>
        </div>
      <?php endif; ?>
      </div>

      <div class="archivos col-xs-12">
      <?php if ($tramite->tramite == "Acreditación de Posgrado"): ?>
        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Solicitud</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/solicitud.png" id="1" data-default-icon="<?=base_url()?>static/img/solicitud.png">
            <input class="ocultar fileUp"  id="" type="file" name="solicitudAP" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Carta de la escuela donde se está cursando la maestría</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/carta.png" id="2" data-default-icon="<?=base_url()?>static/img/carta.png">
              <input class="ocultar fileUp"  id="" type="file" name="cartaECMAP" accept="application/pdf" required>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 archivo">
          <p>Mapa Curricular</p>
          <div class="file">
            <img src="<?=base_url()?>static/img/mapa.png" id="3" data-default-icon="<?=base_url()?>static/img/mapa.png">
              <input class="ocultar fileUp"  id="" type="file" name="mapaCurriAP" accept="application/pdf" required>
          </div>
        </div>
      <?php endif; ?>
      </div>

      <input type="hidden" name="idTramite" value="<?=$tramite->idCatTramite; ?>">
      <input type="hidden" name="tramite" value="<?=$tramite->tramite; ?>" >

    <!-- fin archivos -->

    <div class="col-xs-12 leyenda">
      <br>
      <p><b>Importante:</b> Los documentos deberán ser escaneados y subidos como archivo extensión .pdf</p>
    </div4

    <div class="col-xs-12 leyenda">
      <p>Deberás tener los documentos en estado físico y pasar a Servicios Académicos a dejarlos. <br> Recibirás la respuesta de tu trámite pronto.</p>
      <br>
    </div>
    <div class="form-group text-center col-xs-12">
      <button type="submit" class="btn btn-success">Tramitar</button>
      <br>
    </div>

  </form>
</div>

<?php } ?>

<div class="">
  <h1 class="h1 text-center tamañoh1">Trámites de la Preacta</h1>
</div>
<div class="col-xs-12" id="tabla">
  <?php
    $apro = "<u><b>Aprobadas</b></u> para que puedan continuar con sus trámites-------------------------------------------------------------------
    -------------------------------------------------------------------------------------------------------------------------------------------";
    $recha = "<u><b>Rechazadas</b></u> ----------------------------------------------------------------------------------------------------------
    ---------------------------------------------------------------------------------------------------------------------------------------------";
  ?>
  <?php if (!is_null($tramites)): ?>

    <?php foreach ($catTramites as $catTramite): ?>

      <?php for ($i=1; $i < 3; $i++) { ?>



        <?php if ($catTramite->tramite == "Examen Voluntario"): ?>
          <p>A continuación, se presentan las siguientes solicitudes para <b><?=$catTramite->tramite?></b>, a fin de que el H. Consejo Académico las analice y dictamine:</p>
          <table class="table responsive" style="border: 3px solid black; border-collapse: collapse;">
            <thead>
              <tr class="" style="border: 3px solid black; border-collapse: collapse;">
                <th class="" style="border: 3px solid black; border-collapse: collapse;">ALUMNO</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">EXPEDIENTE</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">PLAN</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">MATERIA</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">CLAVE</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">OBSERV.</th>
              </tr>
            </thead>
            <tbody>

          <?php if ($i==1): ?>

            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "APROBADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                    <tr style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                      <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                        <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                      <?php else: ?>
                        <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                      <?php endif; ?>
                      <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                      <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                      <td data-title="MATERIA" style="border: 3px solid black; border-collapse: collapse;"><?=$catMaterias[$tramite->idMateria]->nombreMateria?></td>
                      <td data-title="CLAVE" style="border: 3px solid black; border-collapse: collapse;"><?=$catMaterias[$tramite->idMateria]->cveMateria?></td>
                      <td data-title="OBSERV" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                    </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>

          <?php if ($i==2): ?>
            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "RECHAZADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                <tr style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                  <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                  <?php else: ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                  <?php endif; ?>
                  <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                  <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                  <td data-title="MATERIA" style="border: 3px solid black; border-collapse: collapse;"><?=$catMaterias[$tramite->idMateria]->nombreMateria?></td>
                  <td data-title="CLAVE" style="border: 3px solid black; border-collapse: collapse;"><?=$catMaterias[$tramite->idMateria]->cveMateria?></td>
                  <td data-title="OBSERV" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($catTramite->tramite == "Readquisición de Pasantía"): ?>
          <p>A continuación, se presentan las siguientes solicitudes para <b><?=$catTramite->tramite?></b>, a fin de que el H. Consejo Académico las analice y dictamine:</p>
          <table class="table responsive" style="border: 3px solid black; border-collapse: collapse;">
            <thead>
              <tr class="" style="border: 3px solid black; border-collapse: collapse;">
                <th class="" style="border: 3px solid black; border-collapse: collapse;">ALUMNO</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">EXPEDIENTE</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">PLAN</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">CURSO</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">DICTAMEN</th>
              </tr>
            </thead>
            <tbody>

          <?php if ($i==1): ?>

            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "APROBADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                    <tr style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                      <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                        <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                      <?php else: ?>
                        <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                      <?php endif; ?>
                      <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                      <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                      <td data-title="CURSO" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->nombreTrabajo?></td>
                      <td data-title="OBSERV" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                    </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>

          <?php if ($i==2): ?>
            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "RECHAZADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                <tr style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                  <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                  <?php else: ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                  <?php endif; ?>
                  <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                  <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                  <td data-title="CURSO" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->nombreTrabajo?></td>
                  <td data-title="OBSERV" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($catTramite->tramite == "Cursos y Diplomados de Actualización y de Profundización Disciplinaria"): ?>
          <p>A continuación, se presentan las siguientes solicitudes de opción de titulación por: <b><?=$catTramite->tramite?></b>, a fin de que el H. Consejo Académico las analice y dictamine:</p>
          <table class="table responsive" style="border: 3px solid black; border-collapse: collapse;">
            <thead>
              <tr class="" style="border: 3px solid black; border-collapse: collapse;">
                <th class="" style="border: 3px solid black; border-collapse: collapse;">ALUMNO</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">EXPEDIENTE</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">PLAN</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">CURSOS Y DIPLOMADOS DE ACTUALIZACIÓN Y DE PROFUNDIZACIÓN DISCIPLINARIA</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">DICTAMEN</th>
              </tr>
            </thead>
            <tbody>

          <?php if ($i==1): ?>

            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "APROBADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                    <tr style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                      <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                        <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                      <?php else: ?>
                        <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                      <?php endif; ?>
                      <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                      <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                      <td data-title="CURSO" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->nombreTrabajo?></td>
                      <td data-title="DICTAMEN" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                    </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>

          <?php if ($i==2): ?>
            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "RECHAZADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                <tr style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                  <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                  <?php else: ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                  <?php endif; ?>
                  <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                  <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                  <td data-title="CURSO" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->nombreTrabajo?></td>
                  <td data-title="DICTAMEN" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($catTramite->tramite == "Guía del Maestro"): ?>
          <p>A continuación, se presentan las siguientes solicitudes de <b><?=$catTramite->tramite?></b>, a fin de que el H. Consejo Académico las analice y dictamine:</p>
          <table class="table responsive" style="border: 3px solid black; border-collapse: collapse;">
            <thead>
              <tr class="" style="border: 3px solid black; border-collapse: collapse;">
                <th class="" style="border: 3px solid black; border-collapse: collapse;">ALUMNO</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">EXPEDIENTE</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">PLAN</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">ASESOR</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">MATERIA</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">DICTAMEN</th>
              </tr>
            </thead>
            <tbody>

          <?php if ($i==1): ?>

            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "APROBADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                    <tr style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                      <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                        <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                      <?php else: ?>
                        <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                      <?php endif; ?>
                      <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                      <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                      <td data-title="ASESOR" style="border: 3px solid black; border-collapse: collapse;"><?=$catMaestros[$tramite->idMaestro]->nombreMaestro?></td>
                      <td data-title="MATERIA" style="border: 3px solid black; border-collapse: collapse;"><?=$catMaterias[$tramite->idMateria]->nombreMateria?></td>
                      <td data-title="DICTAMEN" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                    </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>

          <?php if ($i==2): ?>
            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "RECHAZADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                <tr style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                  <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                  <?php else: ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                  <?php endif; ?>
                  <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                  <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                  <td data-title="ASESOR" style="border: 3px solid black; border-collapse: collapse;"><?=$catMaestros[$tramite->idMaestro]->nombreMaestro?></td>
                  <td data-title="MATERIA" style="border: 3px solid black; border-collapse: collapse;"><?=$catMaterias[$tramite->idMateria]->nombreMateria?></td>
                  <td data-title="DICTAMEN" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($catTramite->tramite == "Memoria de Trabajo"): ?>
          <p>A continuación, se presentan las siguientes solicitudes de <b><?=$catTramite->tramite?></b>, a fin de que el H. Consejo Académico las analice y dictamine:</p>
          <table class="table responsive" style="border: 3px solid black; border-collapse: collapse;">
            <thead>
              <tr class="" style="border: 3px solid black; border-collapse: collapse;">
                <th class="" style="border: 3px solid black; border-collapse: collapse;">ALUMNO</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">EXPEDIENTE</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">PLAN</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">ASESOR</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">TÍTULO</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">DICTAMEN</th>
              </tr>
            </thead>
            <tbody>

          <?php if ($i==1): ?>

            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "APROBADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                    <tr style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                      <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                        <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                      <?php else: ?>
                        <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                      <?php endif; ?>
                      <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                      <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                      <td data-title="ASESOR" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->idMaestro?></td>
                      <td data-title="TÍTULO" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->nombreTrabajo?></td>
                      <td data-title="DICTAMEN" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                    </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>

          <?php if ($i==2): ?>
            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "RECHAZADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                <tr style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                  <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                  <?php else: ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                  <?php endif; ?>
                  <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                  <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                  <td data-title="ASESOR" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->idMaestro?></td>
                  <td data-title="TÍTULO" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->nombreTrabajo?></td>
                  <td data-title="DICTAMEN" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($catTramite->tramite == "Trabajo Terminado"): ?>
          <p>A continuación, se presentan las siguientes solicitudes de <b><?=$catTramite->tramite?></b>, a fin de que el H. Consejo Académico las analice y dictamine:</p>
          <table class="table responsive" style="border: 3px solid black; border-collapse: collapse;">
            <thead>
              <tr class="" style="border: 3px solid black; border-collapse: collapse;">
                <th class="" style="border: 3px solid black; border-collapse: collapse;">ALUMNO</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">EXPEDIENTE</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">PLAN</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">ASESOR</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">MATERIA</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">DICTAMEN</th>
              </tr>
            </thead>
            <tbody>

          <?php if ($i==1): ?>

            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "APROBADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                <tr style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                  <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                  <?php else: ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                  <?php endif; ?>
                  <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                  <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                  <td data-title="ASESOR" style="border: 3px solid black; border-collapse: collapse;"><?=$catMaestros[$tramite->idMaestro]->nombreMaestro?></td>
                  <td data-title="MATERIA" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->nombreTrabajo?></td>
                  <td data-title="DICTAMEN" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>

          <?php if ($i==2): ?>
            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "RECHAZADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                <tr style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                  <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                  <?php else: ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                  <?php endif; ?>
                  <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                  <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                  <td data-title="ASESOR" style="border: 3px solid black; border-collapse: collapse;"><?=$catMaestros[$tramite->idMaestro]->nombreMaestro?></td>
                  <td data-title="MATERIA" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->nombreTrabajo?></td>
                  <td data-title="DICTAMEN" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($catTramite->tramite == "Tesis Individual"): ?>
          <p>A continuación, se presentan las siguientes solicitudes de opción de titulación por: <b><?=$catTramite->tramite?></b>, a fin de que el H. Consejo Académico las analice y dictamine:</p>
          <table class="table responsive" style="border: 3px solid black; border-collapse: collapse;">
            <thead>
              <tr class="" style="border: 3px solid black; border-collapse: collapse;">
                <th class="" style="border: 3px solid black; border-collapse: collapse;">ALUMNO</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">EXPEDIENTE</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">PLAN</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">TÍTULO</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">DICTAMEN</th>
              </tr>
            </thead>
            <tbody>

          <?php if ($i==1): ?>

            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "APROBADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                    <tr style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                      <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                        <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                      <?php else: ?>
                        <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                      <?php endif; ?>
                      <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                      <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                      <td data-title="TÍTULO" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->nombreTrabajo?></td>
                      <td data-title="OBSERV" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                    </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>

          <?php if ($i==2): ?>
            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "RECHAZADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                <tr style="border: 3px solid black; border-collapse: collapse;" style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                  <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                  <?php else: ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                  <?php endif; ?>
                  <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                  <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                  <td data-title="TÍTULO" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->nombreTrabajo?></td>
                  <td data-title="OBSERV" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($catTramite->tramite == "Promedio"): ?>
          <p>A continuación, se presentan las siguientes solicitudes de opción de titulación por: <b><?=$catTramite->tramite?></b>, a fin de que el H. Consejo Académico las analice y dictamine:</p>
          <table class="table responsive" style="border: 3px solid black; border-collapse: collapse;">
            <thead>
              <tr class="" style="border: 3px solid black; border-collapse: collapse;">
                <th class="" style="border: 3px solid black; border-collapse: collapse;">ALUMNO</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">EXPEDIENTE</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">PLAN</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">PROMEDIO</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">DICTAMEN</th>
              </tr>
            </thead>
            <tbody>

          <?php if ($i==1): ?>

            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "APROBADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                    <tr style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                      <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                        <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                      <?php else: ?>
                        <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                      <?php endif; ?>
                      <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                      <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                      <td data-title="PROMEDIO" style="border: 3px solid black; border-collapse: collapse;"></td>
                      <td data-title="DICTAMEN" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                    </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>

          <?php if ($i==2): ?>
            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "RECHAZADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                <tr style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                  <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                  <?php else: ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                  <?php endif; ?>
                  <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                  <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                  <td data-title="PROMEDIO" style="border: 3px solid black; border-collapse: collapse;"></td>
                  <td data-title="DICTAMEN" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($catTramite->tramite == "Acreditación de Posgrado"): ?>
          <p>A continuación, se presentan las siguientes solicitudes de opción de titulación por: <b><?=$catTramite->tramite?></b>, a fin de que el H. Consejo Académico las analice y dictamine:</p>
          <table class="table responsive" style="border: 3px solid black; border-collapse: collapse;">
            <thead>
              <tr class="" style="border: 3px solid black; border-collapse: collapse;">
                <th class="" style="border: 3px solid black; border-collapse: collapse;">ALUMNO</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">EXPEDIENTE</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">PLAN</th>
                <th class="" style="border: 3px solid black; border-collapse: collapse;">DICTAMEN</th>
              </tr>
            </thead>
            <tbody>

          <?php if ($i==1): ?>

            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "APROBADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                    <tr style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                      <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                        <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                      <?php else: ?>
                        <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                      <?php endif; ?>
                      <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                      <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                      <td data-title="DICTAMEN" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                    </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>

          <?php if ($i==2): ?>
            <?php foreach ($tramites as $tramite): ?>
              <?php if ($tramite->recomendacion == "RECHAZADO" AND $tramite->idCatTramite == $catTramite->idCatTramite): ?>
                <tr style="border: 3px solid black; border-collapse: collapse;" class="tr-notifi" data="<?=$tramite->idTramite?>">
                  <?php if (!is_null($expAlumno[$tramite->idAlumno]->nombre_alumno)): ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->nombre_alumno; ?></td>
                  <?php else: ?>
                    <td data-title="ALUMNO" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->apellidoPaterno." ".$expAlumno[$tramite->idAlumno]->apellidoMaterno." ".$expAlumno[$tramite->idAlumno]->nombre ?></td>
                  <?php endif; ?>
                  <td data-title="EXPEDIENTE" style="border: 3px solid black; border-collapse: collapse;"><?=$expAlumno[$tramite->idAlumno]->expediente;?></td>
                  <td data-title="PLAN" style="border: 3px solid black; border-collapse: collapse;"><?=$catPlanes[$expAlumno[$tramite->idAlumno]->idPlan]->cvePlan?></td>
                  <td data-title="DICTAMEN" style="border: 3px solid black; border-collapse: collapse;"><?=$tramite->recomendacion?></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        <?php endif; ?>
          <p>Después de su revisión, se recomienda sean <?php echo ($i == 1) ? $apro : $recha ; ?> </p>
      <?php } ?>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="col-xs-12 text-center">
      <h3 class="sintra">No hay trámites para preacta</h3>
    </div>
  <?php endif; ?>
</div>

<!-- <style>
  table, th, tr, td{
    border: 3px solid black;
    border-collapse: collapse;
  }
</style> -->

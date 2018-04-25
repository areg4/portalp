<div class="">
  <h1 class="h1 text-center tamañoh1">Trámites de Investigación</h1>
</div>

<div class="" id="tabla1">
  <div class="noAtendidos">
    <h1 class="h1">Tramites No Atendidos</h1>
    <?php if (!is_null($tramitesNA)): ?>
      <table class="table responsive">
        <thead>
          <tr class="">
            <th class="">Expediente</th>
            <th class="">Tipo de Trámite</th>
            <th class="">Fecha de Inicio</th>
            <th class="">Aprobación</th>
          </tr>
        </thead>
        <tbody>

            <?php foreach ($tramitesNA as $tramite):
              // die(var_dump($tramites));
              ?>
              <tr class="tr-notifi-investigacion" data="<?=$tramite->idTramite?>">
                <td data-title="Expediente"><?=$expAlumno[$tramite->idAlumno]?></td>
                <td data-title="Tipo de Trámite"><?=$catTramites[$tramite->idCatTramite]?></td>
                <td data-title="Fecha de Inicio"><?=fancy_date($tramite->fechaInicio)?></td>
                <td data-title="Aprobación"><?php
                if ($tramite->aprobacion == 0) {
                  echo "NO ATENDIDA";
                }if ($tramite->aprobacion == 1) {
                  echo "APROBADO";
                }if ($tramite->aprobacion == 2) {
                  echo "RECHAZADO";
                }
                ?></td>
              </tr>
            <?php endforeach; ?>
    <?php endif; ?>
    <?php if (is_null($tramitesNA)): ?>
            <div class="col-xs-12 text-center">
            <h3 class="h3">No hay trámites por atender</h3>
          </div>
        </tbody>
      </table>
    <?php endif; ?>
  </div>

</div>
<div class="tabla2">
  <div class="atendidos">
    <h1>Tramites Atendidos</h1>
    <?php if (!is_null($tramitesA)): ?>
      <table class="table responsive">
        <thead>
          <tr class="">
            <th class="">Expediente</th>
            <th class="">Tipo de Trámite</th>
            <th class="">Fecha de Inicio</th>
            <th class="">Aprobación</th>
            <th class="">Fecha Atendida</th>
          </tr>
        </thead>
        <tbody>

            <?php foreach ($tramitesA as $tramite):
              // die(var_dump($tramites));
              ?>
              <tr class="tr-notifi-investigacion" data="<?=$tramite->idTramite?>">
                <td data-title="Expediente"><?=$expAlumno[$tramite->idAlumno]?></td>
                <td data-title="Tipo de Trámite"><?=$catTramites[$tramite->idCatTramite]?></td>
                <td data-title="Fecha de Inicio"><?=fancy_date($tramite->fechaInicio)?></td>
                <td data-title="Aprobación"><?php
                if ($tramite->aprobacion == 0) {
                  echo "NO ATENDIDA";
                }if ($tramite->aprobacion == 1) {
                  echo "APROBADO";
                }if ($tramite->aprobacion == 2) {
                  echo "RECHAZADO";
                }
                ?></td>

                <td data-title="Fecha Atendida"><?=$tramite->fechaAtendida?></td>
              </tr>
            <?php endforeach; ?>
    <?php endif; ?>
    <?php if (is_null($tramitesA)): ?>
            <div class="col-xs-12 text-center">
            <h3>No hay trámites atendidos</h3>
          </div>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</div>

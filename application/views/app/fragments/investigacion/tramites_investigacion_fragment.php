<div class="">
  <h1 class="h1 text-center tamañoh1">Trámites de Investigación</h1>
</div>

<div class="col-xs-12 col-md-6" id="tabla">
  <h3 class="h3 tamañoh4-border center">Trámites no atendidos</h3>
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
            <?php foreach ($tramitesNA as $tramite): ?>
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
        </tbody>
      </table>
    <?php endif; ?>
    <?php if (is_null($tramitesNA)): ?>
          <div class="col-xs-12 text-center">
            <p class="p sintra">No hay trámites por atender</p>
          </div>
    <?php endif; ?>
</div>

<div class="tabla2 col-xs-12 col-md-6" id="tabla">
  <h3 class="h3 tamañoh4-border center">Trámites atendidos</h3>
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
          </tbody>
        </table>
    <?php endif; ?>
    <?php if (is_null($tramitesA)): ?>
          <div class="col-xs-12 text-center">
            <p class="sintra">No hay trámites atendidos</p>
          </div>
    <?php endif; ?>
</div>

<div class="">
  <h1 class="h1 text-center tamañoh1">Trámites de Comité de Titulación</h1>
</div>

<details class="col-xs-12" open="open">
  <summary class="tamaño-s">Trámites no atendidos</summary>
  <div class="" id="tabla">
      <?php if (!is_null($tramitesNA)): ?>
        <table class="table responsive">
          <thead>
            <tr class="">
              <th class="">Exp</th>
              <th class="">Trámite</th>
              <th class="">Fecha de Inicio</th>
              <th class="">Aprobación</th>
            </tr>
          </thead>
          <tbody>

              <?php foreach ($tramitesNA as $tramite):
                ?>
                <tr class="tr-notifi-titulacion" data="<?=$tramite->idTramite?>">
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
              <p class="sintra">No hay trámites por atender</p>
            </div>
      <?php endif; ?>
  </div>
</details>

<details class="col-xs-12">
  <summary class="tamaño-s">Trámites atendidos</summary>
  <div class="tabla2" id="tabla">
      <?php if (!is_null($tramitesA)): ?>
        <table class="table responsive">
          <thead>
            <tr class="">
              <th class="">Exp</th>
              <th class="">Trámite</th>
              <th class="">Fecha de Inicio</th>
              <th class="">Aprobación</th>
              <th class="">Fecha<br>resultado</th>
            </tr>
          </thead>
          <tbody>

              <?php foreach ($tramitesA as $tramite):
                ?>
                <tr class="tr-notifi-titulacion" data="<?=$tramite->idTramite?>">
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
</details>

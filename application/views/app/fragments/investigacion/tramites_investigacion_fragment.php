<div class="">
  <h1 class="h1 text-center tamañoh1">Trámites de Investigación</h1>
</div>

<details open="open" class="col-xs-12">
  <summary class="tamaño-s">Trámites no atendidos</summary>
  <div id="tabla">
  <!--   <h3 class="h3 tamañoh4-border center">Trámites no atendidos</h3> -->
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
</details>

<details class="col-xs-12">
  <summary class="tamaño-s">Trámites atendidos</summary>
  <div class="tabla2" id="tabla">
    <!-- <h3 class="h3 tamañoh4-border center">Trámites atendidos</h3> -->
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
</details>

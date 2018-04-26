<div class="">
  <h1 class="h1 text-center tamañoh1">Trámites en proceso</h1>
</div>

<div class="col-xs-12 leyenda">
  <b>Debes de estar al pendiente de las observaciones de cada uno de los procesos.</b>
</div>

<?php if (!is_null($tramitesP)): ?>
  <div class="col-xs-12" id="tabla">
    <table class="table responsive">
      <thead>
        <tr class="">
          <th>Tipo de trámite</th>
          <th>Estatus</th>
          <th>Periodo</th>
          <th>Fecha de Inicio</th>
          <th>Observaciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tramitesP as $tramite): ?>
          <!-- Con $tramite->estatus se obtiene el estatus del trámite para ver el color de la fila -->
          <tr class="tr-notifi-alumno <?php if ($tramite->estatus == "ALTA") {
            echo "alta";
          } elseif ($tramite->estatus == "OBSERVACIONES") {
            echo "observaciones";
          }elseif ($tramite->estatus == "APROBADO") {
            echo "finalizado";
          } elseif ($tramite->estatus == "RECHAZADO") {
            echo "finalizado";
          } else{
            echo "nproceso";
          } ?>" data="<?=$tramite->idTramite?>" title="Ir a más información">
            <td data-title="Tipo de trámite"><?=$catTramites[$tramite->idCatTramite];?></td>
            <td data-title="Estatus">
              <?php if ($tramite->estatus=="ALTA" OR $tramite->estatus=="APROBADO" OR $tramite->estatus=="RECHAZADO" OR $tramite->estatus=="OBSERVACIONES"): ?>
                <?=$tramite->estatus; ?>
              <?php else: ?>
                PROCESO
              <?php endif; ?>
            </td>
            <td data-title="Periodo"><?=$tramite->idPeriodo?></td>
            <td data-title="Fecha de Inicio"><?=fancy_date($tramite->fechaInicio);?></td>
            <?php if (!is_null($observaciones)): ?>
              <?php if (array_key_exists ( $tramite->idTramite , $observaciones )): ?>
                <td data-title="Observaciones"><?=$observaciones[$tramite->idTramite]; ?></td>
              <?php else: ?>
                <td data-title="Observaciones">Sin Observaciones</td>
              <?php endif; ?>
            <?php else: ?>
              <td data-title="Observaciones">Sin Observaciones</td>
            <?php endif; ?>
          </tr>

        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

<?php else: ?>
  <div class="col-xs-12 text-center">
    <h3 class="sintra">No hay trámites en proceso por el momento</h3>
  </div>
<?php endif; ?>

<div class="">
  <h1 class="h1 text-center tamañoh1">Trámites en proceso</h1>
</div>

<div class="col-xs-12 leyenda">
  <p>Debes de estar al pendiente de las observaciones de cada uno de los procesos.</p>
</div>

<?php if (!is_null($tramitesP)): ?>
  <div class="col-xs-12" id="tabla">
    <table class="table responsive">
      <thead>
        <tr class="">
          <th>Tipo de trámite</th>
          <th>Estatus</th>
          <th>Fecha de Inicio</th>
          <th>Observaciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tramitesP as $tramite): ?>
          <!-- Con $tramite->estatus se obtiene el estatus del trámite para ver el color de la fila -->
          <tr class="tr-notifi-alumno <?php if ($tramite->estatus == "ALTA") {
            echo "alta";
          } if ($tramite->estatus == "OBSERVACIONES") {
            echo "observaciones";
          } if ($tramite->estatus == "PROCESO") {
            echo "nproceso";
          } if ($tramite->estatus == "FINALIZADO") {
            echo "finalizado";
          }?>" data="<?=$tramite->idTramite?>" title="Ir a más información">
            <td data-title="Tipo de trámite"><?=$catTramites[$tramite->idCatTramite];?></td>
            <td data-title="Estatus"><?=$tramite->estatus;?></td>
            <td data-title="Fecha de Inicio"><?=fancy_date($tramite->fechaInicio);?></td>
            <?php if (array_key_exists ( $tramite->idTramite , $observaciones )): ?>
              <td data-title="Observaciones"><?=$observaciones[$tramite->idTramite]; ?></td>
            <?php else: ?>
              <td data-title="Observaciones">Sin Observaciones</td>
            <?php endif; ?>
          </tr>

        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

<?php else: ?>
  <p>No hay trámites en proceso</p>
<?php endif; ?>

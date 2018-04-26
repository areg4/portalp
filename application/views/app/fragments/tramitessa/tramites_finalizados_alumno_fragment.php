<div class="">
  <h1 class="h1 text-center tamañoh1">Trámites finalizados</h1>
</div>

<div class="col-xs-12 leyenda">
  <p></p>
</div>

<?php if (!is_null($tramitesF)): ?>
  <div class="" id="tabla">
    <table class="table responsive">
      <thead>
        <tr class="">
          <th>Tipo de Trámite</th>
          <th>Estatus</th>
          <th>Periodo</th>
          <th>Fecha Inicio</th>
          <th>Fecha Finalización</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tramitesF as $tramite): ?>
          <!-- Con $tramite->estatus se obtiene el estatus del trámite para ver el color de la fila -->
          <tr class="tr-notifi-alumno" data="<?=$tramite->idTramite?>" title="Ir a más información">
            <td data-title="Tipo de trámite"><?=$catTramites[$tramite->idCatTramite];?></td>
            <td data-title="Estatus"><?=$tramite->estatus;?></td>
            <td data-title="Estatus"><?=$tramite->idPeriodo;?></td>
            <td data-title="Fecha Inicio"><?=fancy_date($tramite->fechaInicio)?></td>
            <td data-title="Fecha Finalización"><?=fancy_date($tramite->fechaFin)?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

<?php else: ?>
  <div class="col-xs-12 text-center">
    <h3 class="sintra">No hay trámites finalizados por el momento</h3>
  </div>
<?php endif; ?>

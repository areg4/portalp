<div class="">
  <h1 class="h1 text-center">Trámites Finalizados</h1>
</div>

<div class="col-xs-12">
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc hendrerit lectus purus, in porttitor tortor congue non.</p>
</div>

<?php if (!is_null($tramitesF)): ?>
  <div class="" id="tabla">
    <table class="table responsive">
      <thead>
        <tr class="">
          <th>Tipo de Trámite</th>
          <th>Estatus</th>
          <th>Fecha de Inicio</th>
          <th>Fecha de Finalización</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tramitesF as $tramite): ?>
          <!-- Con $tramite->estatus se obtiene el estatus del trámite para ver el color de la fila -->
          <tr class="tr-notifi-alumno denegado" data="<?=$tramite->idTramite?>" title="Ir a más información">
            <td data-title="Tipo de trámite"><?=$catTramites[$tramite->idCatTramite];?></td>
            <td data-title="Estatus"><?=$tramite->estatus;?></td>
            <td data-title="Fecha de Finalización"><?=fancy_date($tramite->fechaInicio)?></td>
            <td data-title="Fecha de Finalización"><?=fancy_date($tramite->fechaFin)?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

<?php else: ?>
  <p>No hay Trámites Finalizados</p>
<?php endif; ?>

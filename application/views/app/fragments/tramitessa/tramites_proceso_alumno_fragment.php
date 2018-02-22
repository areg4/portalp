<div class="">
  <h1 class="h1 text-center">Trámites en Proceso</h1>
</div>

<div class="col-xs-12">
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc hendrerit lectus purus, in porttitor tortor congue non.</p>
</div>

<?php if (!is_null($tramitesP)): ?>
  <div class="" id="tabla">
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
          <tr class="tr-notifi-alumno denegado" data="<?=$tramite->idTramite?>" title="Ir a más información">
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

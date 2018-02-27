<div class="">
  <h1 class="h1 text-center">Trámites en Proceso</h1>
</div>

<div class="" id="tabla">
  <table class="table responsive">
    <thead>
      <tr class="">
        <th class="">ID Trámite</th>
        <th class="">Expediente</th>
        <th class="">Tipo de Trámite</th>
        <th class="">Estatus</th>
        <th class="">Observaciones</th>
        <th class="">Fecha de Inicio</th>
        <th class="">Fecha de Última Modificación</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!is_null($tramites)): ?>
        <?php foreach ($tramites as $tramite): ?>
          <tr class="tr-notifi" data="<?=$tramite->idTramite?>">
            <td data-title="ID Trámite"><?=$tramite->idTramite?></td>
            <td data-title="Expediente"><?=$expAlumno[$tramite->idAlumno]?></td>
            <td data-title="Tipo de Trámite"><?=$catTramites[$tramite->idCatTramite]?></td>
            <td data-title="Estatus"><?=$tramite->estatus?></td>

            <?php if (array_key_exists ( $tramite->idTramite , $observaciones )): ?>
              <td data-title="Observaciones"><?=$observaciones[$tramite->idTramite]; ?></td>
            <?php else: ?>
              <td data-title="Observaciones">Sin Observaciones</td>
            <?php endif; ?>

            <td data-title="Fecha de Inicio"><?=fancy_date($tramite->fechaInicio)?></td>
            <td data-title="Fecha de Última Modificación"><?=fancy_date($tramite->feculmod)?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <h1>No hay trámites</h1>
      <?php endif; ?>
    </tbody>
  </table>
</div>

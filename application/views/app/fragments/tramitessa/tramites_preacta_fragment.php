<div class="">
  <h1 class="h1 text-center tamañoh1">Trámites de la Preacta</h1>
</div>

<div class="col-xs-12" id="tabla">
  <?php if (!is_null($tramites)): ?>
    <div class="">
      <button class="btn btnGenerarPreacta">Generar Preacta</button>
    </div>
  <table class="table responsive">
    <thead>
      <tr class="">
        <th class="">ID Trámite</th>
        <th class="">Expediente</th>
        <th class="">Tipo de Trámite</th>
        <th class="">Estatus</th>
        <th class="">Periodo</th>
        <th class="">Recomendación</th>
        <th class="">Fecha Inicio</th>
      </tr>
    </thead>
    <tbody>

        <?php foreach ($tramites as $tramite): ?>
          <tr class="tr-notifi" data="<?=$tramite->idTramite?>">
            <td data-title="ID Trámite"><?=$tramite->idTramite?></td>
            <td data-title="Expediente"><?=$expAlumno[$tramite->idAlumno]?></td>
            <td data-title="Tipo de Trámite"><?=$catTramites[$tramite->idCatTramite]?></td>
            <td data-title="Estatus"><?=$tramite->estatus?></td>
            <td data-title="Periodo"><?=$tramite->idPeriodo?></td>
            <td data-title="Recomendacion"><?=$tramite->recomendacion?></td>
            <td data-title="Fecha Inicio"><?=fancy_date($tramite->fechaInicio)?></td>
          </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
  <?php else: ?>
    <div class="col-xs-12 text-center">
      <h3 class="sintra">No hay trámites para preacta</h3>
    </div>
  <?php endif; ?>
</div>

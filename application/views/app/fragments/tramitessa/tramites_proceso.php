<div class="">
  <h1 class="h1 text-center tamañoh1">Trámites en Proceso</h1>
</div>

<div class="" id="tabla">
  <table class="table responsive">
    <?php if (!is_null($tramites)): ?>
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

        <?php foreach ($tramites as $tramite): ?>
          <tr class="tr-notifi <?php if ($tramite->estatus == "ALTA") {
            echo "alta";
          } elseif ($tramite->estatus == "OBSERVACIONES") {
            echo "observaciones";
          } elseif ($tramite->estatus == "APROBADO") {
            echo "finalizado";
          } elseif ($tramite->estatus == "RECHAZADO") {
            echo "finalizado";
          } else{
            echo "nproceso";
          } ?>" data="<?=$tramite->idTramite?>">
            <td data-title="ID Trámite"><?=$tramite->idTramite?></td>
            <td data-title="Expediente"><?=$expAlumno[$tramite->idAlumno]?></td>
            <td data-title="Tipo de Trámite"><?=$catTramites[$tramite->idCatTramite]?></td>
            <td data-title="Estatus"><?=$tramite->estatus?></td>

            <?php if (!is_null($observaciones)): ?>
              <?php if (array_key_exists ( $tramite->idTramite , $observaciones )): ?>
                <td data-title="Observaciones"><?=$observaciones[$tramite->idTramite]; ?></td>
              <?php else: ?>
                <td data-title="Observaciones">Sin Observaciones</td>
              <?php endif; ?>
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

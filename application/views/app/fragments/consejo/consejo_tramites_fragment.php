<div class="">
  <h1 class="h1 text-center tamañoh1">Trámites de Consejo</h1>
</div>

<div class="" id="tabla">
  <table class="table responsive">
    <?php if (!is_null($tramites)): ?>
    <thead>
      <tr class="">
        <th class="">Expediente</th>
        <th class="">Tipo de Trámite</th>
        <th class="">Fecha de Inicio</th>
      </tr>
    </thead>
    <tbody>

        <?php foreach ($tramites as $tramite): ?>
          <tr class="tr-notifi-consejo" data="<?=$tramite->idTramite?>">
            <td data-title="Expediente"><?=$expAlumno[$tramite->idAlumno]?></td>
            <td data-title="Tipo de Trámite"><?=$catTramites[$tramite->idCatTramite]?></td>
            <td data-title="Fecha de Inicio"><?=fancy_date($tramite->fechaInicio)?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <h1>No hay trámites</h1>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- propuesta de diseño -->
<!-- propuesta 1  -->
<div class="col-xs-12">
	<h3 class="h3">Licenciatura</h3>
</div>

<<<<<<< Updated upstream
<?php if (!is_null($tramitesL)): ?>
	<?php foreach ($tramitesL as $tramite): ?>
		<div class="col-xs-12 col-sm-12 col-md-3  center ficha2">
			<h3 class="h3 text-center"> <?=$tramite->tramite; ?> </h3>
			<p>Recuerda que al realizar este trámite, deberás contar con los siguientes requisitos: </p>
			<ul class="">
				<?php foreach ($relaTramReq as $relacion): ?>
						<?php if ($relacion->idCatTramite == $tramite->idCatTramite): ?>
							<li><?=$catRequisitos[$relacion->idRequisito]?></li>
						<?php endif; ?>
				<?php endforeach; ?>
			</ul>
			<button class="btn color btnTramite menta" type="button" name="button" data-id-T="<?=$tramite->idCatTramite; ?>" >Realizar</button>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
=======
<div class="col-xs-12 col-sm-12 col-md-3  center ficha2">
	<h3 class="h3 text-center">Examen <br> voluntario</h3>
	<p>Recuerda que al realizar este trámite, deberás contar con los siguientes requisitos: </p>
	<ul class="">
		<li>Estar reinscrito (recibo de pago) </li>
		<li>No tener NA en la materia</li>
		<li>Kárdex</li>
	</ul>
</div>
>>>>>>> Stashed changes



<!-- <div class="col-xs-12 col-sm-12 col-md-3 center ficha2">
	<h3 class="h3 text-center">Titulación por<br> Promedio</h3>
	<p>Recuerda que al realizar este trámite, deberás contar con los siguientes requisitos: </p>
	<ul class="">
		<li>Solicitud de titulación por promedio</li>
		<li>Estado Académico de CU</li>
		<li>Promedio de 9 y 8 vectores</li>
	</ul>
<<<<<<< Updated upstream
	<button class="btn menta btnTramite" type="button" name="button" data="tramite-2">Realizar</button>
</div> -->
=======
</div>
>>>>>>> Stashed changes

<div class="col-xs-12">
	<h3 class="h3">Posgrado</h3>
</div>



<!-- <div class="">
  <select class="" name="" id="tipoTramiteA">
    <option value="tramite1">Tramite 1</option>
    <option value="tramite2">Tramite 2</option>
    <option value="tramite3">Tramite 3</option>
  </select>
</div>

<div class="">
  <button class="btn menta" type="button" name="button" id="btnTramite">Aceptar</button>
</div> -->

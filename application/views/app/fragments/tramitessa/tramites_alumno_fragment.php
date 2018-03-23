<!-- propuesta de diseño -->
<!-- propuesta 1  -->
<div class="col-xs-12">
	<h3 class="h3">Licenciatura</h3>
</div>

<?php if (!is_null($tramitesL)): ?>
	<?php foreach ($tramitesL as $tramite): ?>
		<div class="col-xs-12 col-sm-10 col-md-3 ficha2">
			<h3 class="h3 text-center"> <?=$tramite->tramite; ?></h3>
			<p>Recuerda que al realizar este trámite, debes contar con los siguientes requisitos: </p>
			<ul class="">
				<?php foreach ($relaTramReq as $relacion): ?>
						<?php if ($relacion->idCatTramite == $tramite->idCatTramite): ?>
							<li><?=$catRequisitos[$relacion->idRequisito]?></li>
						<?php endif; ?>
				<?php endforeach; ?>
			</ul>
			<button class="btnTramite" type="button" name="button" data-id-T="<?=$tramite->idCatTramite; ?>" ></button>
		</div>
	<?php endforeach; ?>
<?php endif; ?>


<div class="col-xs-12">
	<h3 class="h3">Posgrado</h3>
</div>

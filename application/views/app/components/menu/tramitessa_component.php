<li class="<?=($app_sub_menu == 'inicio')? 'actual' : ''?>">
	<a href="<?=base_url()?>portal-informatica-tramites">
		<i class="fa fa-home"></i> Inicio
	</a>
</li>
<!-- <li class="<?=($app_sub_menu == 'iTramite')? 'actual' : ''?>">
	<a href="<?=base_url()?>portal-informatica-tramites-alta">
		<i class="fa fa-tags"></i> Tramites
	</a>
</li> -->

<li class="dropdown <?=($app_sub_menu == 'iTramite')? 'actual open':''?>">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<i class="fa fa-clock-o"></i> Tramites<b class="caret"></b>
	</a>
	<ul class="dropdown-menu">
		<?php $subnav = ($app_sub_menu_item == 'tramite-1')? 'active':''; ?>
		<li class="<?=$subnav?>">
			<a href="<?=base_url()?>portal-informatica-tramites-alta/tramite-1">
					<i class="fa fa-angle-right"></i> Tramite 1
			</a>
		</li>
		<?php $subnav = ($app_sub_menu_item == 'tramite-2')? 'active':''; ?>
		<li class="<?=$subnav?>">
			<a href="<?=base_url()?>portal-informatica-tramites-alta/tramite-2" >
				<i class="fa fa-angle-right"></i>  Tramite 2
			</a>
		</li>
		<?php $subnav = ($app_sub_menu_item == 'tramite-3')? 'active':''; ?>
		<li class="<?=$subnav?>">
			<a href="<?=base_url()?>portal-informatica-tramites-alta/tramite-3" >
				<i class="fa fa-angle-right"></i> Tramite 3
			</a>
		</li>
	</ul>
</li>

<li class="<?=($app_sub_menu == 'notifiTramites')? 'actual' : ''?>">
	<a href="<?=base_url()?>portal-informatica-tramites-notificaciones">
		<i class="fa fa-tags"></i> Notifiaciones Tramites
	</a>
</li>

<li class="<?=($app_sub_menu == 'archivoTramites')? 'actual' : ''?>">
	<a href="<?=base_url()?>portal-informatica-tramites-archivo">
		<i class="fa fa-tags"></i> Archivo
	</a>
</li>

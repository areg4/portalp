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
		<?php $subnav = ($app_sub_menu_item == 'tramitesProceso')? 'active':''; ?>
		<li class="<?=$subnav?>">
			<a href="<?=base_url()?>portal-informatica-tramites-proceso" >
				<i class="fa fa-angle-right"></i>  Proceso
			</a>
		</li>
		<?php $subnav = ($app_sub_menu_item == 'tramitesArchivo')? 'active':''; ?>
		<li class="<?=$subnav?>">
			<a href="<?=base_url()?>portal-informatica-tramites-archivo" >
				<i class="fa fa-angle-right"></i> Archivo
			</a>
		</li>
		<?php $subnav = ($app_sub_menu_item == 'tramitesPreacta')? 'active':''; ?>
		<li class="<?=$subnav?>">
			<a href="<?=base_url()?>portal-informatica-tramites-preacta" >
				<i class="fa fa-angle-right"></i> Preacta
			</a>
		</li>
	</ul>
</li>

<!-- <li class="<?=($app_sub_menu == 'notifiTramites')? 'actual' : ''?>">
	<a href="<?=base_url()?>portal-informatica-tramites-notificaciones">
		<i class="fa fa-tags"></i> Notifiaciones<i class="fa fa-bell not"></i>
	</a>
</li>

<li class="<?=($app_sub_menu == 'archivoTramites')? 'actual' : ''?>">
	<a href="<?=base_url()?>portal-informatica-tramites-archivo">
		<i class="fa fa-tags"></i> Archivo
	</a>
</li> -->

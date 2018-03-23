<li class="<?=($app_sub_menu == 'inicio')? 'actual' : ''?>">
	<a href="<?=base_url()?>portal-informatica-alumnos">
		<i class="fa fa-home"></i> Inicio
	</a>
</li>
<!-- <li class="<?=($app_sub_menu == 'preregistro')? 'actual' : ''?>">
	<a href="<?=base_url()?>portal-informatica-alumnos-preregistro-materias">
		<i class="fa fa-tags"></i> Pre-Registro de materias
	</a>
</li>
<li class="<?=($app_sub_menu == 'simulador')? 'actual' : ''?>">
	<a href="<?=base_url()?>portal-informatica-alumnos-simulador">
		<i class="fa fa-check"></i> Simulador de altas
	</a>
</li>
<li class="<?=($app_sub_menu == 'tickets')? 'actual' : ''?>">
	<a href="<?=base_url()?>portal-informatica-alumnos-tickets">
		<i class="fa fa-ticket"></i> Tickets
	</a>
</li>
<li class="<?=($app_sub_menu == 'tickets')? 'actual' : ''?>">
	<a href="<?=base_url()?>portal-informatica-sac-pdf">
		<i class="fa fa-bookmark"></i> SAC 2017
	</a>
</li>

<li class="<?=($app_sub_menu == 'evIndAlumno')? 'actual' : ''?>">
	<a href="<?=base_url()?>portal-informatica-alumnos-tutorias-IndAlumno">
		<i class="fa fa-pencil-square-o "></i> Evaluación de tutoría Individual
	</a>
</li>

<li class="<?=($app_sub_menu == 'evGrupAlumno')? 'actual' : ''?>">
	<a href="<?=base_url()?>portal-informatica-alumnos-tutorias-GrupAlumno">
		<i class="fa fa-pencil-square-o "></i> Evaluación de tutoría Grupal
	</a>
</li> -->

<!-- <li class="<?=($app_sub_menu == 'iTramite')? 'actual' : ''?>">
	<a href="<?=base_url()?>portal-informatica-alumnos-tramites">
		<i class="fa fa-tags"></i> Tramites
	</a>
</li>
<li class="<?=($app_sub_menu == 'notifiTramites')? 'actual' : ''?>">
	<a href="<?=base_url()?>portal-informatica-alumnos-tramites-notificaciones">
		<i class="fa fa-tags"></i> Notifiaciones <i class="fa fa-bell not"></i>
	</a>
</li> -->


<li class="dropdown <?=($app_sub_menu == 'iTramite')? 'actual open':''?>">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<i class="fa fa-clock-o"> </i> Tramites <b class="caret"></b> <!-- <i class="fa fa-circle size"></i> -->
	</a>
	<ul class="dropdown-menu">
		<?php $subnav = ($app_sub_menu_item == 'altaTramiteA')? 'active':''; ?>
		<li class="<?=$subnav?>">
			<a href="<?=base_url()?>portal-informatica-alumnos-tramites">
					<i class="fa fa-angle-right"></i> Alta
			</a>
		</li>
		<?php $subnav = ($app_sub_menu_item == 'tramitesProcesoA')? 'active':''; ?>
		<li class="<?=$subnav?>">
			<a href="<?=base_url()?>portal-informatica-alumnos-tramites-proceso" >
				<i class="fa fa-angle-right"></i>  Proceso
			</a>
		</li>
		<?php $subnav = ($app_sub_menu_item == 'tramitesFinalizadosA')? 'active':''; ?>
		<li class="<?=$subnav?>">
			<a href="<?=base_url()?>portal-informatica-alumnos-tramites-finalizados" >
				<i class="fa fa-angle-right"></i> Finalizados
			</a>
		</li>
	</ul>
</li>

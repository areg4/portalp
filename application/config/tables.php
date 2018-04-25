<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 *
 * TABLAS NECESARIAS
 *
 */
 $config['tablas']['usuario']       		   	   = 'sys_usuario';
 $config['tablas']['usuario_detalle']  		   	   = 'sys_usuario_detalle';
 $config['tablas']['rol']       		   	   	   = 'sys_rol';
 $config['tablas']['permiso']       		   	   = 'sys_permiso';
 $config['tablas']['modulo']       		   	   	   = 'sys_modulo';
 $config['tablas']['sistema']       		   	   = 'sys_sistema';
 $config['tablas']['rol_detalle']       		   = 'sys_rol_detalle';


 $config['tablas']['periodo']      		   	  	   = 'app_periodo';
 $config['tablas']['alumno']       		   	  	   = 'app_alumno';
 $config['tablas']['profesor']       		   	   = 'app_maestro';
 $config['tablas']['areaconocimiento']       	   = 'app_area_conocimiento';
 $config['tablas']['materia']       		   	   = 'app_materia';
 $config['tablas']['plan'] 		      		   	   = 'app_plan';
 $config['tablas']['aula'] 		      		   	   = 'app_aula';
 $config['tablas']['equivalencia']				   = 'app_equivalencia';
 /* ========================================================== SEMANA ACADEMICA Y CULTURAL*/
$config['tablas']['sac'] 		       			   = 'app_sac';
$config['tablas']['sacevento'] 		       		   = 'app_sac_evento';
$config['tablas']['saccodigos']					   = 'app_sac_codigo';
$config['tablas']['sacalumnocodigo']			   = 'app_sac_alumno_codigo';
$config['tablas']['sactipoevento']				   = 'app_sac_tipo_evento';

 /* ========================================================== SECRETARIA ACADEMICA*/
$config['tablas']['grupo'] 		       			   = 'app_grupo';
$config['tablas']['horario'] 		       		   = 'app_horario';
$config['tablas']['horarioAlumno']				   = 'app_horario_alumno';
$config['tablas']['prealumnomateria'] 		       = 'app_pre_alumno_materia';
$config['tablas']['docsprealumnomateria'] 		   = 'docs_pre_alumno_materia';


/*============================================================ TUTORIAS*/
$config['tablas']['tutGrupAlumnos']				   = 'app_eval_grup_alumnos';
$config['tablas']['tutGrupTutores']				   = 'app_eval_grup_tutores';
$config['tablas']['tutIndAlumnos']				   = 'app_eval_ind_alumnos';
$config['tablas']['tutIndTutores']				   = 'app_eval_ind_tutores';
$config['tablas']['cuestionarioPeriodo']		   = 'app_valida_cuestionario_periodo';

//nuevas tablas de tutorias
$config['tablas']['catPreguntas']		   			= 'cat_preg_tutoria';
$config['tablas']['catRespuestas']		   			= 'cat_resp_tutoria';
$config['tablas']['evalTutoria']		   			= 'app_eval_tutoria';


// tablas de avisos
$config['tablas']['aviso']		   					= 'app_aviso';

// tabla coordinador
$config['tablas']['coord']		   					= 'app_coordinador';

/* ====================================================================== TICKETS */

$config['tablas']['bitacora']					 = 'tickets.bitacora';
$config['tablas']['datosalumno'] 		      	 = 'tickets.datosalumno';
$config['tablas']['dependencia'] 		  		 = 'tickets.dependencia';
$config['tablas']['responsable'] 				 = 'tickets.responsable';
$config['tablas']['respuesta'] 		  			 = 'tickets.respuesta';
$config['tablas']['ticket'] 		  			 = 'tickets.ticket';
$config['tablas']['turnoticket'] 		  		 = 'tickets.turnoticket';


/**************** ASISTENCIAS */

$config['tablas']['asistencias']				   = 'asistencias_verificadas';



/********TRÁMITES*********/
$config['tablas']['catTramites']				           = 'cat_tramite';
$config['tablas']['catRequisitos']				         = 'cat_requisito';
$config['tablas']['catTramiteRequisito']				   = 'cat_tramite_requisito';
$config['tablas']['tramites']				               = 'app_tramite';
$config['tablas']['rutaTramites']				           = 'app_ruta_tramite';
$config['tablas']['observacionesTramites']				 = 'app_observacion_tramite';
$config['tablas']['aprobacionTramites']				     = 'app_aprobacion_tramite';

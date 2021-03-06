<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] 				= 'alumno';
// $route['404_override'] 						= 'login/errorPage';
// $route['translate_uri_dashes'] 				= FALSE;
// $route['portal-informatica-cerrar-sesion']	= 'sesion/logout/login';
/***** ALUMNOS **/
$route['portal-informatica-alumnos']											= 'alumno/index';

//alumno tramitessa
$route['portal-informatica-alumnos-tramites']							      = 'tramitessa/tramitesAlumno';
$route['portal-informatica-alumnos-tramites-alta/(:any)']				= 'tramitessa/tramitesAlumnoAlta/$1';
$route['portal-informatica-alumnos-tramites-proceso']		        = 'tramitessa/tramitesAlumnoProceso';
$route['portal-informatica-alumnos-tramites-datos/(:num)']		  = 'tramitessa/tramitesAlumnoDatos/$1';
$route['portal-informatica-alumnos-tramites-finalizados']		    = 'tramitessa/tramitesAlumnoFinalizados';

$route['portal-informatica-alumnos-tramites-add']				        = 'tramitessa/tramitesAlumnoAdd';
$route['portal-informatica-alumnos-tramites-updateFile']				= 'tramitessa/updateFile';
$route['portal-informatica-alumnos-tramites-updateTramite']			= 'tramitessa/updateTramite';

/**
 * tramites de Secretaría Académica
 */
$route['portal-informatica-tramites']											            = 'tramitessa/index';
$route['portal-informatica-tramites-alta/(:num)']                     = 'tramitessa/tramitesAlta/$1';
$route['portal-informatica-tramites-proceso']                         = 'tramitessa/tramitesProceso';
$route['portal-informatica-tramites-archivo']                         = 'tramitessa/tramitesArchivo';
$route['portal-informatica-tramites-datos/(:num)']		                = 'tramitessa/tramitesDatos/$1';

$route['portal-informatica-tramites-updateFileAR']                    = 'tramitessa/tramitesArchivoUpdateAR';
$route['portal-informatica-tramites-addComentario']                   = 'tramitessa/tramitesAddComentario';

$route['portal-informatica-tramites-buscar-archivo']                  = 'tramitessa/tramitesBuscarArchivo';


$route['portal-informatica-tramites-enviarA']                         = 'tramitessa/tramitesEnviarA';

$route['portal-informatica-tramites-respuesta-aprobado']              = 'tramitessa/tramitesRespuestaAprobado';
$route['portal-informatica-tramites-respuesta-rechazado']             = 'tramitessa/tramitesRespuestaRechazado';

$route['portal-informatica-tramites-preacta']                         = 'tramitessa/tramitesPreacta';
$route['portal-informatica-tramites-generadorPDF']			              = 'tramitessa/tramitesPdf';
$route['portal-informatica-tramites-generar-preacta']                 = 'tramitessa/generarDocPreacta';

/***************************TRÁMITES INVESTIGACIÓN*****************************/
$route['portal-informatica-investigacion-tramites']                       = 'investigacion/tramites';
$route['portal-informatica-investigacion-tramite-datos/(:num)']		        = 'investigacion/tramiteDatos/$1';
$route['portal-informatica-investigacion-tramite-aprobar']		            = 'investigacion/aprobarTramite';
$route['portal-informatica-investigacion-tramite-rechazar']		            = 'investigacion/rechazarTramite';
$route['portal-informatica-investigacion-tramite-asignacion-presidente']  = 'investigacion/asignacionPresidente';


/***************************TRÁMITES TITULACIÓN*****************************/
$route['portal-informatica-titulacion-tramites']                            = 'titulacion/tramites';
$route['portal-informatica-titulacion-tramite-datos/(:num)']		            = 'titulacion/tramiteDatos/$1';
$route['portal-informatica-titulacion-tramite-aprobar']		                  = 'titulacion/aprobarTramite';
$route['portal-informatica-titulacion-tramite-rechazar']		                = 'titulacion/rechazarTramite';
$route['portal-informatica-titulacion-tramite-asignacion-presidente']       = 'titulacion/asignacionPresidente';

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tramitessa extends CI_Controller {
	function __construct() {
		parent::__construct();
		# Funcion constructor carga librerias, modelos y atributos globales de la clase.
		//$this->load->library('session');

		// if(!is_online()){
		// 	$this->session->set_flashdata('error', 'sesionOff');
		// 	redirect('login');
		// }

		$this->load->model('common_model');
		$this->load->model('alumno_model');
		// $this->idAlumno 					= $this->session->userdata('idUsuario');
		// $this->idRol 						= $this->session->userdata('idRol');
		$this->idAlumno 					= 2249;
		$this->folder 						= 'tramitessa';
		$this->periodo 						= $this->common_model->getPeriodoActivo();
		$this->alumno 						= $this->alumno_model->getAlumno($this->idAlumno);
		$this->fecha    					= date('Y-m-d');
		$this->hora    						= date('H:i:s');
		// $this->limiteMateriasPreregistro 	= 10;
		// //die(var_dump($this->common_model->getPeriodoActivo()));
		// if($this->idRol != 999){
		// 	redirect('');
		// }
    //
		// header("Cache-Control: no-store,no-cache,must-revalidate;");
		// header("Cache-Control: post-check=0,pre-check=0", FALSE);
		// header("Pragma:no-chache");

	}

	// public function index()
	// {
	// 	$data['sys_app_title'] 	= 'TRAMITES';
	// 	$data['app_title'] 	= '<i class="fa fa-user"></i>  TRAMITES';
	// 	$data['app_sub_menu'] 	= 'inicio';
	// 	// $data['user']      	= $this->usuario;
	// 	$data['menu_app']   = $this->load->view('app/components/menu/tramitessa_component', $data, TRUE);
	// 	$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
  //
	// 	$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/dashboard_fragment', $data, TRUE);
	// 	$this->load->view('app/main_view', $data, FALSE);
	// }

  public function tramitesAlumno()
  {
    $data['sys_app_title'] 	= 'TRAMITES ALUMNO';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRAMITES';
		$data['app_sub_menu'] 	= 'iTramite';
		// $data['user']      	= $this->usuario;
		$data['menu_app']   = $this->load->view('app/components/menu/alumno_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
    $data['js']       = array('tramites');
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/tramites_alumno_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
  }

  public function tramitesAlumnoAlta()
  {
    $data['sys_app_title'] 	= 'TRAMITES ALUMNO';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRAMITES';
		$data['app_sub_menu'] 	= 'iTramite';
		// $data['user']      	= $this->usuario;
		$data['menu_app']   = $this->load->view('app/components/menu/alumno_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
    $data['js']       = array('tramites');
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/tramites_alta_alumno_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
  }

  public function tramitesAlumnoNotificaciones()
  {
    $data['sys_app_title'] 	= 'TRAMITES ALUMNO';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRAMITES';
		$data['app_sub_menu'] 	= 'notifiTramites';
		// $data['user']      	= $this->usuario;
		$data['menu_app']   = $this->load->view('app/components/menu/alumno_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
    $data['js']       = array('tramites');
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/tramites_notificaciones_alumno_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
  }

  public function tramitesAlumnoDatos($idTramite)
  {
    $data['sys_app_title'] 	= 'TRAMITES ALUMNO';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRAMITES';
		$data['app_sub_menu'] 	= 'notifiTramites';
		// $data['user']      	= $this->usuario;
		$data['menu_app']   = $this->load->view('app/components/menu/alumno_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
    $data['js']       = array('tramites');
    $data['idTramite']       = $idTramite;
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/tramites_datos_tramite_alumno_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
  }
}

/* End of file alumno.php */
/* Location: ./application/controllers/alumno.php */

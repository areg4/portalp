<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumno extends CI_Controller {
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
		$this->folder 						= 'alumno';
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

	public function index()
	{
		$data['sys_app_title'] 	= 'ALUMNOS';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  ALUMNO';
		$data['app_sub_menu'] 	= 'inicio';
		$data['app_sub_menu_item'] = '';
		$data['user']      	= $this->alumno;
		$data['menu_app']   = $this->load->view('app/components/menu/alumno_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
		// $data['avisos']		= $this->aviso_model->getAvisosAlumno();
		// $data['avisosE']	= $this->aviso_model->getAvisosAlumnoByPlan($this->alumno->idPlan);
		$data['avisos']		= null;
		$data['avisosE']	= null;
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/dashboard_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
	}
}

/* End of file alumno.php */
/* Location: ./application/controllers/alumno.php */

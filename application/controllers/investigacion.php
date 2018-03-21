<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Investigacion extends CI_Controller {
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
    // modelo de trámites
		$this->load->model('investigacion_model');
    $this->load->model('tramitessa_model');
		$this->folder 						= 'investigacion';
		$this->periodo 						= $this->common_model->getPeriodoActivo();
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
	}

  public function tramites()
  {
    $data['sys_app_title'] 	= 'TRÁMITES INVESTIGACIÓN';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRÁMITES INVESTIGACIÓN';
		$data['app_sub_menu'] 	= 'iTramiteInv';
		// $data['user']      	= $this->usuario;
		$data['js']       = array('tramites');
		$data['menu_app']   = $this->load->view('app/components/menu/investigacion_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
		$data['catTramites'] = $this->catTramites();
    $data['expAlumno'] = $this->catAlumnosExp();
		$data['tramites'] = $this->investigacion_model->getTramitesInvestigacion();
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/tramites_investigacion_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
  }

	public function tramiteDatos($idTramite)
	{
		$tramite = $this->tramitessa_model->getTramitePById($idTramite);
		$alumno = $this->alumno_model->getAlumno($tramite->idAlumno);
		$archivos = $this->tramitessa_model->getArchivosByTramite($idTramite);

		$data['sys_app_title'] 	= 'TRÁMITES INVESTIGACIÓN';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRÁMITES INVESTIGACIÓN';
		$data['app_sub_menu'] 	= 'iTramiteInv';
		// $data['user']      	= $this->usuario;
		$data['menu_app']   = $this->load->view('app/components/menu/investigacion_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
    $data['js']       = array('tramites');
		$data['alumno']     = $alumno;
		$data['catTramites'] = $this->catTramites();
		$data['archivos']		 = $archivos;
		$data['tramite']		=	$tramite;
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/investigacion_tramite_datos_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
	}

	public function tramitesAddComentario()
	{
		$idTramite 	= $this->input->post('idTramite');
		$idAlumno 	=	$this->input->post('idAlumno');
		$comentario = $this->input->post('comentario');

		$arrInsert = array(
			'idTramite' 		=> $idTramite,
			'idAlumno'			=> $idAlumno,
			'observacion' 	=> $comentario,
			// 'usumod'				=> $idUsuario,
			'fecha'					=> $this->fecha,
			'habilitado'		=> 1
		);

		if ($this->tramitessa_model->insertObservacion($arrInsert)) {
			if ($this->updateTramiteTo($idTramite, 'OBSERVACIONES')) {
				echo "OK";
			}else{
				echo "ERROR";
			}
		}else {
			echo "ERROR";
		}
	}

	private function catTramites()
	{
		$arrayTramites = array();
		$catTramites = $this->tramitessa_model->getCatTramites();
		foreach ($catTramites as $tramite) {
			$arrayTramites[$tramite->idCatTramite] = $tramite->tramite;
		}
		// die(var_dump($arrayTramites));
		return $arrayTramites;
	}

	private function catAlumnosExp()
	{
		$arrayExpAlumnos = array();
		$catExpAlumnos = $this->tramitessa_model->getCatExpAlumnos();
		foreach ($catExpAlumnos as $expAlumno) {
			$arrayExpAlumnos[$expAlumno->idAlumno] = $expAlumno->expediente;
		}
		// die(var_dump($arrayTramites));
		return $arrayExpAlumnos;
	}
}

/* End of file tramitessa.php */
/* Location: ./application/controllers/alumno.php */

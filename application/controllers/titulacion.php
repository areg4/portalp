<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Titulacion extends CI_Controller {
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
		$this->load->model('titulacion_model');
    $this->load->model('tramitessa_model');
		$this->folder 						= 'titulacion';
		$this->periodo 						= $this->common_model->getPeriodoActivo();
		$this->fecha    					= date('Y-m-d');
		$this->hora    						= date('H:i:s');
		$this->idUsuario 					= 9;					//que jale el de sesión
		$this->idRol 							= 10;					//id del rol del usuario
		// $this->idRol 							= $this->session->userdata('idRol');
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
    $data['sys_app_title'] 	= 'TRÁMITES TITULACIÓN';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRÁMITES TITULACIÓN';
		$data['app_sub_menu'] 	= 'iTramiteTitu';
		// $data['user']      	= $this->usuario;
		$data['js']       = array('tramites');
		$data['menu_app']   = $this->load->view('app/components/menu/titulacion_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
		$data['catTramites'] = $this->catTramites();
    $data['expAlumno'] = $this->catAlumnosExp();
		$data['tramitesA'] 	= $this->listaTramitesAtendidosByMiemTitulacion($this->idUsuario);
		$data['tramitesNA'] = $this->listaTramitesNoAtendidosByMiemTitulacion($this->idUsuario);
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/titulacion_tramites_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
  }

	public function tramiteDatos($idTramite)
	{
		if (is_null($this->titulacion_model->accesoTramiteTitu($idTramite, $this->idUsuario, "TITULACION"))) {
			$this->session->set_flashdata('error', 'accessTramiteFail');
			redirect('portal-informatica-titulacion-tramites');
		}
		$tramite = $this->tramitessa_model->getTramitePById($idTramite);
		$alumno = $this->alumno_model->getAlumno($tramite->idAlumno);
		$archivos = $this->tramitessa_model->getArchivosByTramite($idTramite);
		$investigadores = $this->tramitessa_model->getInvestigadores();
		$miemsTitulacion = $this->tramitessa_model->getMiemsTitulacion();
		$aprobacionesInves = $this->ordenarAprobacionTramiteByIdMiembro($idTramite, "INVESTIGACION");
		$aprobacionesTitu = $this->ordenarAprobacionTramiteByIdMiembro($idTramite, "TITULACION");

		$data['sys_app_title'] 	= 'TRÁMITES TITULACIÓN';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRÁMITES TITULACIÓN';
		$data['app_sub_menu'] 	= 'iTramiteInv';
		$data['menu_app']   = $this->load->view('app/components/menu/titulacion_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
    $data['js']       = array('tramites');
		$data['alumno']     = $alumno;
		$data['catTramites'] = $this->catTramites();
		$data['archivos']		 = $archivos;
		$data['tramite']		=	$tramite;
		$data['investigadores']		=		$investigadores;
		$data['miemsTitulacion']				=		$miemsTitulacion;
		$data['aprobacionesInves']		=		$aprobacionesInves;
		$data['aprobacionesTitu']		=		$aprobacionesTitu;
		$data['idUsuario'] 	=	$this->idUsuario;
		$data['idRol']			= $this->idRol;
		$data['materia']			= $this->tramitessa_model->getMateriaById($tramite->idMateria);
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/titulacion_tramite_datos_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
	}

	// public function tramitesAddComentario()
	// {
	// 	$idTramite 	= $this->input->post('idTramite');
	// 	$idAlumno 	=	$this->input->post('idAlumno');
	// 	$comentario = $this->input->post('comentario');
  //
	// 	$arrInsert = array(
	// 		'idTramite' 		=> $idTramite,
	// 		'idAlumno'			=> $idAlumno,
	// 		'observacion' 	=> $comentario,
	// 		// 'usumod'				=> $idUsuario,
	// 		'fecha'					=> $this->fecha,
	// 		'habilitado'		=> 1
	// 	);
  //
	// 	if ($this->tramitessa_model->insertObservacion($arrInsert)) {
	// 		if ($this->updateTramiteTo($idTramite, 'OBSERVACIONES')) {
	// 			echo "OK";
	// 		}else{
	// 			echo "ERROR";
	// 		}
	// 	}else {
	// 		echo "ERROR";
	// 	}
	// }

	private function catTramites()
	{
		$arrayTramites = array();
		$catTramites = $this->tramitessa_model->getCatTramites();
		foreach ($catTramites as $tramite) {
			$arrayTramites[$tramite->idCatTramite] = $tramite->tramite;
		}
		return $arrayTramites;
	}

	private function catAlumnosExp()
	{
		$arrayExpAlumnos = array();
		$catExpAlumnos = $this->tramitessa_model->getCatExpAlumnos();
		foreach ($catExpAlumnos as $expAlumno) {
			$arrayExpAlumnos[$expAlumno->idAlumno] = $expAlumno->expediente;
		}
		return $arrayExpAlumnos;
	}

	private function ordenarAprobacionTramiteByIdMiembro($idTramite, $estatus)
	{
		$arrayAprobaciones = array();
		$catAprobaciones = $this->tramitessa_model->getAprobacionesByidTramite($idTramite, $estatus);
		if (!is_null($catAprobaciones)) {
			foreach ($catAprobaciones as $aprobacion) {
				$arrayAprobaciones[$aprobacion->idMiembro] = $aprobacion;
			}
			return $arrayAprobaciones;
		}else{
			return null;
		}
	}

	public function listaTramitesAtendidosByMiemTitulacion($idUsuario)
	{
		$idTramitesAprobTitul = $this->titulacion_model->getIdsTramitesAprobAtendidos($idUsuario);
		$allTramites = $this->tramitessa_model->getAllTramitesH();

		if (is_null($idTramitesAprobTitul) or is_null($allTramites)) {
			return null;
		}

		$arrayAllTramites = array();
		$arrayLista = array();

		foreach ($allTramites as $tramite) {
			$arrayAllTramites[$tramite->idTramite] = $tramite;
		}

		foreach ($idTramitesAprobTitul as $idApro) {
			if (isset($arrayAllTramites[$idApro->idTramite])) {
				$arrayConver = (array)$arrayAllTramites[$idApro->idTramite];
				$arrayConver['aprobacion'] = $idApro->aprobacion;
				$arrayConver['fechaAtendida']	= fancy_date($idApro->fechaHora);
				$arrayConver = (object)$arrayConver;
				array_push($arrayLista, $arrayConver);
			}
		}
		return $arrayLista;
	}

	public function listaTramitesNoAtendidosByMiemTitulacion($idUsuario)
	{
		$idTramitesAprobTitul = $this->titulacion_model->getIdsTramitesAprobNoAtendidos($idUsuario);
		$allTramites = $this->tramitessa_model->getAllTramitesH();

		if (is_null($idTramitesAprobTitul) or is_null($allTramites)) {
			return null;
		}

		$arrayAllTramites = array();
		$arrayLista = array();

		foreach ($allTramites as $tramite) {
			$arrayAllTramites[$tramite->idTramite] = $tramite;
		}

		foreach ($idTramitesAprobTitul as $idApro) {
			if (isset($arrayAllTramites[$idApro->idTramite])) {
				$arrayConver = (array)$arrayAllTramites[$idApro->idTramite];
				$arrayConver['aprobacion'] = $idApro->aprobacion;
				$arrayConver = (object)$arrayConver;
				array_push($arrayLista, $arrayConver);
			}
		}
		return $arrayLista;
	}

	public function aprobarTramite()
	{
		$idTramite 	= $this->input->post('idTramite');
		$idUsuario 	= $this->input->post('idUsuario');
		$comentario = $this->input->post('comentarios');

		$fecha = date('Y-m-d H:i:s');

		$arrUpdate = array(
			'aprobacion'	=> 1,
			'comentario'	=> $comentario,
			'fechaHora'		=> $fecha
		);

		if ($this->tramitessa_model->updateAprobacion($idTramite, $idUsuario, "TITULACION", $arrUpdate)) {
			$this->session->set_flashdata('error', 'updateOk');
			echo "OK";
		}else{
			$this->session->set_flashdata('error', 'updateFail');
			echo "ERROR";
		}
	}

	public function rechazarTramite()
	{
		$idTramite 	= $this->input->post('idTramite');
		$idUsuario 	= $this->input->post('idUsuario');
		$comentario = $this->input->post('comentarios');

		$fecha = date('Y-m-d H:i:s');

		$arrUpdate = array(
			'aprobacion'	=> 2,
			'comentario'	=> $comentario,
			'fechaHora'		=> $fecha
		);

		if ($this->tramitessa_model->updateAprobacion($idTramite, $idUsuario, "TITULACION", $arrUpdate)) {
			$this->session->set_flashdata('error', 'updateOk');
			echo "OK";
		}else{
			$this->session->set_flashdata('error', 'updateFail');
			echo "ERROR";
		}
	}
	public function asignacionPresidente()
	{
		$idTramite 		= $this->input->post('idTramite');
		$asignaciones = $this->input->post('asignaciones');
		$idPresi 			= $this->input->post('idPresi');
		$comentarioP 	= $this->input->post('comentarioP');
		$asignaciones = json_decode($asignaciones);
		$fecha = date('Y-m-d H:i:s');
		foreach($asignaciones as $asignacion) {
			$idUsuario = $asignacion->idUser;
			$arrUpdate = array(
				'aprobacion'	=>	$asignacion->asignacion,
				'fechaHora'		=>	$fecha
			);
			$this->tramitessa_model->updateAprobacion($idTramite, $idUsuario, "TITULACION", $arrUpdate);
		}

		$arrUpdate	=	array(
			'comentario'	=>	$comentarioP
		);

		$this->tramitessa_model->updateAprobacion($idTramite, $idPresi, "TITULACION", $arrUpdate);
		$this->session->set_flashdata('error', 'updateOk');
		echo "OK";
	}
}

/* End of file titulacion.php */
/* Location: ./application/controllers/titulacion.php */

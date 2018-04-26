<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consejo extends CI_Controller {
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
		$this->load->model('consejo_model');
    $this->load->model('tramitessa_model');
		$this->folder 						= 'consejo';
		$this->periodo 						= $this->common_model->getPeriodoActivo();
		$this->fecha    					= date('Y-m-d');
		$this->hora    						= date('H:i:s');
		$this->idUsuario 					= 12;					//que jale el de sesión
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
    $data['sys_app_title'] 	= 'TRÁMITES CONSEJO';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRÁMITES CONSEJO';
		$data['app_sub_menu'] 	= 'iTramiteConse';
		// $data['user']      	= $this->usuario;
		$data['js']       = array('tramites');
		$data['menu_app']   = $this->load->view('app/components/menu/consejo_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
		$data['catTramites'] = $this->catTramites();
    $data['expAlumno'] = $this->catAlumnosExp();
		// $data['tramites'] = $this->consejo_model->getTramitesConsejo();
		$data['tramitesA'] 	= $this->listaTramitesAtendidosByConsejero($this->idUsuario);
		$data['tramitesNA'] = $this->listaTramitesNoAtendidosByConsejero($this->idUsuario);
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/consejo_tramites_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
  }

	public function tramiteDatos($idTramite)
	{
		if (is_null($this->consejo_model->accesoTramiteConse($idTramite, $this->idUsuario, "CONSEJO"))) {
			$this->session->set_flashdata('error', 'accessTramiteFail');
			redirect('portal-informatica-consejo-tramites');
		}
		$tramite = $this->tramitessa_model->getTramitePById($idTramite);
		$alumno = $this->alumno_model->getAlumno($tramite->idAlumno);
		$archivos = $this->tramitessa_model->getArchivosByTramite($idTramite);
		$investigadores = $this->tramitessa_model->getInvestigadores();
		$consejeros = $this->tramitessa_model->getConsejeros();
		$aprobacionesInves = $this->ordenarAprobacionTramiteByIdMiembro($idTramite, "INVESTIGACION");
		$aprobacionesConse = $this->ordenarAprobacionTramiteByIdMiembro($idTramite, "CONSEJO");

		$data['sys_app_title'] 	= 'TRÁMITES CONSEJO';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRÁMITES CONSEJO';
		$data['app_sub_menu'] 	= 'iTramiteInv';
		// $data['user']      	= $this->usuario;
		$data['menu_app']   = $this->load->view('app/components/menu/consejo_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
    $data['js']       = array('tramites');
		$data['alumno']     = $alumno;
		$data['catTramites'] = $this->catTramites();
		$data['archivos']		 = $archivos;
		$data['tramite']		=	$tramite;
		$data['investigadores']		=		$investigadores;
		$data['consejeros']				=		$consejeros;
		$data['aprobacionesInves']		=		$aprobacionesInves;
		$data['aprobacionesConse']		=		$aprobacionesConse;
		$data['idUsuario'] 	=	$this->idUsuario;
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/consejo_tramite_datos_fragment', $data, TRUE);
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

	private function ordenarAprobacionTramiteByIdMiembro($idTramite, $estatus)
	{
		$arrayAprobaciones = array();
		$catAprobaciones = $this->tramitessa_model->getAprobacionesByidTramite($idTramite, $estatus);
		if (!is_null($catAprobaciones)) {
			foreach ($catAprobaciones as $aprobacion) {
				$arrayAprobaciones[$aprobacion->idMiembro] = $aprobacion;
			}
			// die(var_dump($arrayAprobaciones));
			return $arrayAprobaciones;
		}else{
			return null;
		}
	}

	public function listaTramitesAtendidosByConsejero($idUsuario)
	{
		$idTramitesAprobConse = $this->consejo_model->getIdsTramitesAprobAtendidos($idUsuario);
		$allTramites = $this->tramitessa_model->getAllTramitesH();

		if (is_null($idTramitesAprobConse) or is_null($allTramites)) {
			return null;
		}

		$arrayAllTramites = array();
		$arrayLista = array();

		foreach ($allTramites as $tramite) {
			$arrayAllTramites[$tramite->idTramite] = $tramite;
		}

		foreach ($idTramitesAprobConse as $idApro) {
			if (isset($arrayAllTramites[$idApro->idTramite])) {
				$arrayConver = (array)$arrayAllTramites[$idApro->idTramite];
				$arrayConver['aprobacion'] = $idApro->aprobacion;
				$arrayConver['fechaAtendida']	= fancy_date($idApro->fechaHora);
				// array_push($arrayConver, $idApro->aprobacion);
				// array_push($arrayLista, $arrayAllTramites[$idApro->idTramite]);
				$arrayConver = (object)$arrayConver;
				array_push($arrayLista, $arrayConver);
			}
		}
		// die(var_dump($arrayLista));
		// $arrayLista = (object)$arrayLista;
		return $arrayLista;
	}

	public function listaTramitesNoAtendidosByConsejero($idUsuario)
	{
		$idTramitesAprobConse = $this->consejo_model->getIdsTramitesAprobNoAtendidos($idUsuario);
		$allTramites = $this->tramitessa_model->getAllTramitesH();

		if (is_null($idTramitesAprobConse) or is_null($allTramites)) {
			return null;
		}

		$arrayAllTramites = array();
		$arrayLista = array();

		foreach ($allTramites as $tramite) {
			$arrayAllTramites[$tramite->idTramite] = $tramite;
		}

		foreach ($idTramitesAprobConse as $idApro) {
			if (isset($arrayAllTramites[$idApro->idTramite])) {
				$arrayConver = (array)$arrayAllTramites[$idApro->idTramite];
				$arrayConver['aprobacion'] = $idApro->aprobacion;
				// array_push($arrayConver, $idApro->aprobacion);
				// array_push($arrayLista, $arrayAllTramites[$idApro->idTramite]);
				$arrayConver = (object)$arrayConver;
				array_push($arrayLista, $arrayConver);
			}
		}
		// die(var_dump($arrayLista));
		// $arrayLista = (object)$arrayLista;
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

		if ($this->tramitessa_model->updateAprobacion($idTramite, $idUsuario, "CONSEJO", $arrUpdate)) {
			$this->session->set_flashdata('error', 'updateOk');
			// redirect('portal-informatica-investigacion-tramite-datos/'.$idTramite);
			echo "OK";
		}else{
			$this->session->set_flashdata('error', 'updateFail');
			echo "ERROR";
			// redirect('portal-informatica-investigacion-tramite-datos/'.$idTramite);
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

		if ($this->tramitessa_model->updateAprobacion($idTramite, $idUsuario, "CONSEJO", $arrUpdate)) {
			$this->session->set_flashdata('error', 'updateOk');
			// redirect('portal-informatica-investigacion-tramite-datos/'.$idTramite);
			echo "OK";
		}else{
			$this->session->set_flashdata('error', 'updateFail');
			// redirect('portal-informatica-investigacion-tramite-datos/'.$idTramite);
			echo "ERROR";
		}
	}
}

/* End of file tramitessa.php */
/* Location: ./application/controllers/alumno.php */

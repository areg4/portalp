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
		$this->load->model('file_model');
    // modelo de trámites
		$this->load->model('tramitessa_model');
		// $this->idAlumno 					= $this->session->userdata('idUsuario');
		// $this->idRol 						= $this->session->userdata('idRol');
		// $this->idAlumno 					= 2519; //id Jaz
		$this->idAlumno 					= 2670; //id Fer
		// $this->idAlumno 					= 2249; //id Gera
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

	public function index()
	{
		$data['sys_app_title'] 	= 'TRÁMITES';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRÁMITES';
		$data['app_sub_menu'] 	= 'inicio';
		$data['app_sub_menu_item'] = '';
		// $data['user']      	= $this->usuario;
		$data['menu_app']   = $this->load->view('app/components/menu/tramitessa_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);

		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/dashboard_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
	}

	// public function tramitesAlta($tTramite)
	// {
	// 	$data['sys_app_title'] 	= 'TRAMITES ALTA';
	// 	$data['app_title'] 	= '<i class="fa fa-user"></i>  TRAMITES';
	// 	$data['app_sub_menu'] 	= 'iTramite';
	// 	$data['app_sub_menu_item'] = $tTramite;
	// 	// $data['user']      	= $this->usuario;
	// 	$data['tTramite']		=	$tTramite;
	// 	$data['menu_app']   = $this->load->view('app/components/menu/tramitessa_component', $data, TRUE);
	// 	$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
  //
	// 	$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/tramites_alta', $data, TRUE);
	// 	$this->load->view('app/main_view', $data, FALSE);
	// }

	public function tramitesProceso()
	{
		$data['sys_app_title'] 	= 'TRÁMITES ALTA';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRÁMITES';
		$data['app_sub_menu'] 	= 'iTramite';
		$data['app_sub_menu_item'] = 'tramitesProceso';
		// $data['user']      	= $this->usuario;
		$data['js']       = array('tramites');
		$data['menu_app']   = $this->load->view('app/components/menu/tramitessa_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
		$data['catTramites'] = $this->catTramites();

		$tramites = $this->tramitessa_model->getTramites();

		if (!is_null($tramites)) {
			foreach ($tramites as $tramite) {
				$tramite->idPeriodo = $this->common_model->getPeriodo($tramite->idPeriodo)->periodo;
			}
		}
		$data['tramites'] = $tramites;
		$data['expAlumno'] = $this->catAlumnosExp();
		$data['observaciones'] = $this->observacionesG();
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/tramites_proceso', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
	}

	public function tramitesDatos($idTramite)
	{
		$tramite = $this->tramitessa_model->getTramitePById($idTramite);
		if (is_null($tramite)) {
			redirect('portal-informatica-tramites-proceso');
		}
		$alumno = $this->alumno_model->getAlumno($tramite->idAlumno);
		$archivos = $this->tramitessa_model->getArchivosByTramite($idTramite);

		$investigadores = null;
		$consejeros = null;
		$aprobacionesInves = null;
		$aprobacionesConse = null;

		$recomendacion = null;

		$maestros = null;

		$aula = null;
		$rutaRespuesta = null;

		$data['sys_app_title'] 	= 'TRÁMITES';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRÁMITES';
		$data['app_sub_menu'] 	= 'notifiTramites';
		$data['app_sub_menu_item'] = 'tramitesProceso';
		// $data['user']      	= $this->usuario;
		$data['menu_app']   = $this->load->view('app/components/menu/tramitessa_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
    $data['js']       = array('tramites');


		$data['alumno']     = $alumno;
		$data['catTramites'] = $this->catTramites();
		$data['observacion'] = $this->tramitessa_model->getObservacionByTramite($idTramite);



		if ($tramite->estatus =='ALTA') {
			if ($this->updateTramiteTo($idTramite, 'PROCESO')) {
				$tramite = $this->tramitessa_model->getTramitePById($idTramite);
			}
		}

		if (!is_null($archivos)) {
			foreach ($archivos as $archivo) {
				if ($archivo->estatus=="RECIBIDO") {
					if ($this->updateArchivoTo($archivo->idRT, "REVISANDO")) {
						$archivos = $this->tramitessa_model->getArchivosByTramite($idTramite);
					}
				}
			}
		}

		if ($tramite->estatus == "INVESTIGACION") {
			$investigadores = $this->tramitessa_model->getInvestigadores();
			$aprobacionesInves = $this->ordenarAprobacionTramiteByIdMiembro($idTramite, "INVESTIGACION");
		}
		if ($tramite->estatus == "CONSEJO") {
			$investigadores = $this->tramitessa_model->getInvestigadores();
			$consejeros = $this->tramitessa_model->getConsejeros();

			$aprobacionesInves = $this->ordenarAprobacionTramiteByIdMiembro($idTramite, "INVESTIGACION");
			$aprobacionesConse = $this->ordenarAprobacionTramiteByIdMiembro($idTramite, "CONSEJO");
			$recomendacion = $this->recomendacion($consejeros, $aprobacionesConse);
		}

		if ($tramite->estatus == "PREACTA" AND $tramite->idCatTramite == 1) {
			$maestros = $this->tramitessa_model->getMaestros();
			$aula = $this->tramitessa_model->getAulasByTipo();
		}

		if ($tramite->estatus == "APROBADO" OR $tramite->estatus == "RECHAZADO") {
			$rutaRespuesta = $this->tramitessa_model->getRutaRespuesta($idTramite);
		}

		$data['investigadores']		=		$investigadores;
		$data['consejeros']				=		$consejeros;
		$data['aprobacionesInves']		=		$aprobacionesInves;
		$data['aprobacionesConse']		=		$aprobacionesConse;
		$data['recomendacion']				=		$recomendacion;
		$data['aula'] 					= $aula;
		$data['rutaRespuesta'] 		= $rutaRespuesta;

		$data['archivos']		 = $archivos;
		$data['tramite']		=	$tramite;
		$data['materia']			= $this->tramitessa_model->getMateriaById($tramite->idMateria);
		$data['maestros']			= $maestros;
		$data['periodoTramite'] = $this->common_model->getPeriodo($tramite->idPeriodo)->periodo;
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/tramites_datos_tramite_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
	}

	private function updateTramiteTo($idTramite, $estatus)
	{
		$arrUpdate = array(
			'estatus' => 	$estatus,
			'feculmod' => $this->fecha
		);
		return $this->tramitessa_model->updateTramite($idTramite, $arrUpdate);
	}

	private function updateArchivoTo($idRT, $estatus)
	{
		$arrUpdate = array(
			'estatus' => $estatus
		);
		return $this->tramitessa_model->updateRutaTramite($idRT, $arrUpdate);
	}

	public function tramitesArchivoUpdateAR()
	{
		$idRT 		= $this->input->post('idRT');
		$estatus 	= $this->input->post('estatus');
		if ($this->updateArchivoTo($idRT, $estatus)) {
			echo "OK";
		}else{
			echo "ERROR";
		}
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

	public function tramitesArchivo()
	{
		$data['sys_app_title'] 	= 'TRÁMITES ALTA';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRÁMITES';
		$data['app_sub_menu'] 	= 'archivoTramites';
		$data['app_sub_menu_item'] = '';
		// $data['user']      	= $this->usuario;
		$data['js']       = array('tramites');
		$data['menu_app']   = $this->load->view('app/components/menu/tramitessa_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);

		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/tramites_archivo_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
	}

	public function tramitesBuscarArchivo()
	{
		$criterio = $this->input->post('criterio');

		$catTramites 		= $this->catTramites();
		$expAlumno 			= $this->catAlumnosExp();
		$observaciones	= $this->observacionesG();

		if (in_array($criterio, $expAlumno)) {
			$criterio = array_search($criterio, $expAlumno);
		}

		if (!is_null($this->tramitessa_model->getTramitesByCriterio($criterio))) {
			$tramites = $this->tramitessa_model->getTramitesByCriterio($criterio);
			$strTable = '<table class="table responsive">
		    <thead>
		      <tr class="">
						<th class="">ID Trámite</th>
						<th class="">Expediente</th>
						<th class="">Tipo de Trámite</th>
						<th class="">Estatus</th>
						<th class="">Periodo</th>
						<th class="">Observaciones</th>
						<th class="">Fecha de Inicio</th>
						<th class="">Fecha de Última Modificación</th>
						<th class="">Fecha de Finalización</th>
		      </tr>
		    </thead>
		    <tbody>';

				foreach ($tramites as $tramite) {
					$strTable .= '<tr class="tr-notifi" onclick="goToTramiteDatos('.$tramite->idTramite.')" data="'.$tramite->idTramite.'">
            <td data-title="ID Trámite">'.$tramite->idTramite.'</td>
            <td data-title="Expediente">'.$expAlumno[$tramite->idAlumno].'</td>
            <td data-title="Tipo de Trámite">'.$catTramites[$tramite->idCatTramite].'</td>
            <td data-title="Estatus">'.$tramite->estatus.'</td>
						<td data-title="Periodo">'.$this->common_model->getPeriodo($tramite->idPeriodo)->periodo.'</td>';

						if (!is_null($observaciones)) {
							if (array_key_exists ( $tramite->idTramite , $observaciones )){
								$strTable.='<td data-title="Observaciones">'.$observaciones[$tramite->idTramite].'</td>';
							}else{
								$strTable.='<td data-title="Observaciones">Sin Observaciones</td>';
							}
						}else{
							$strTable.='<td data-title="Observaciones">Sin Observaciones</td>';
						}

						$strTable.='<td data-title="Fecha de Inicio">'.fancy_date($tramite->fechaInicio).'</td>
            <td data-title="Fecha de Última Modificación">'.fancy_date($tramite->feculmod).'</td>';
						if ($tramite->fechaFin != 0) {
							$strTable .= '<td data-title="Fecha de Finalización">'.fancy_date($tramite->fechaFin).'</td>';
						}else {
							$strTable .= '<td data-title="Fecha de Finalización">Sigue en proceso</td>';
						}

          $strTable .= '</tr>';
				}
				$strTable .= '</tbody>
		  </table>';
			echo $strTable;
		}else{
			echo "<p>No hay coincidencias</p>";
		}
	}

  public function tramitesAlumno()
  {
    $data['sys_app_title'] 	= 'TRÁMITES ALUMNO';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRÁMITES ALUMNO';
		$data['app_sub_menu'] 	= 'iTramite';
		$data['app_sub_menu_item'] = 'altaTramiteA';
		// $data['alumno']      	= $this->alumno;
		$data['catRequisitos'] = $this->catRequisitos();
		$data['relaTramReq']	= $this->tramitessa_model->getRelacionRequisitoTramite();
		$data['tramitesL']	= $this->tramitessa_model->getTramitesByNivel("LICENCIATURA");
		$data['tramitesP']	= $this->tramitessa_model->getTramitesByNivel("POSGRADO");
		$data['menu_app']   = $this->load->view('app/components/menu/alumno_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
    $data['js']       = array('tramites');
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/tramites_alumno_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
  }

  public function tramitesAlumnoAlta($idTramite)
  {
		// $tTramite = urldecode($tTramite);
    $data['sys_app_title'] 	= 'TRÁMITES ALUMNO';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRÁMITES ALUMNO';
		$data['app_sub_menu'] 	= 'iTramite';
		$data['app_sub_menu_item'] = 'altaTramiteA';
		// Se obtienen los datos del alumno para iniciar el proceso
		$data['alumno']      	= $this->alumno;
		// if ($tTramite == "Examen Voluntario") {
		// 	$data['examenV'] = true;
		// 	$data['materiasV']	= $this->tramitessa_model->getMateriasByPlan($this->alumno->idPlan);
		// }
		$data['menu_app']   = $this->load->view('app/components/menu/alumno_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
    $data['js']       = array('tramites');
		$data['tramite']		= (!is_null($this->tramitessa_model->getTramiteById($idTramite))) ? $this->tramitessa_model->getTramiteById($idTramite) : redirect("portal-informatica-alumnos-tramites") ;	;
		$data['periodo']		= $this->periodo->periodo;
		$data['materias']		= $this->tramitessa_model->getMateriasByPlan($this->alumno->idPlan);
		$data['maestros']		= $this->tramitessa_model->getMaestros();
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/tramites_alta_alumno_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
  }

	public function tramitesAlumnoAdd(){
		$this->form_validation->set_rules('idTramite', '', 'trim|required|xss_clean');
		$this->form_validation->set_rules('tramite', '', 'trim|required|xss_clean');

		$this->form_validation->set_message('required', 'El campo "%s" es requerido');
		$this->form_validation->set_message('xss_clean', 'El campo "%s" contiene un posible ataque XSS');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		// Ejecuto la validacion de campos de lado del servidor

		// if (!$this -> form_validation -> run()) {
		// 	$this -> session -> set_flashdata('error', 'noSuficienteDatos');
		// 	redirect('portal-informatica-alumnos-tramites-alta/'.$idTramite);
		// 	return false;
		// }

		$this->load->model('file_model');

		// die(var_dump($this->path));

		$alumno = $this->alumno_model->getAlumno($this->idAlumno);

		$rutaPrincipal = "docs/tramites/".$alumno->expediente;

		$tramite 			= $this->input->post('tramite');

		$idTramite 		= $this->input->post('idTramite');

		$idMateria		= $this->input->post('materia') ? $this->input->post('materia') : null;

		$idMaestro		= $this->input->post('maestro') ? $this->input->post('maestro') : null;

		$nombreTrabajo= $this->input->post('nTrabajo') ? $this->input->post('nTrabajo') : null;
		// print_r(die(var_dump($nombreTrabajo)));

		if ($idTramite <= 0 OR is_null($idTramite)) {
			$this->session->set_flashdata('error', 'insertFail');
			redirect('portal-informatica-alumnos-tramites');
		}

		$idAlumno 		= $this->idAlumno;
		$estatus			= "ALTA";
		$idPeriodo		= $this->periodo->idPeriodo;
		$fechaInicio	= date("Y-m-d H:i:s");
		$feculmod			= $this->fecha;
		$usumod				= $this->idAlumno;
		$habilitado		= 1;

		$arrInsert = array(
			'idCatTramite' 	=> 	$idTramite,
			'idAlumno' 			=> 	$idAlumno,
			'estatus' 			=> 	$estatus,
			'idPeriodo'			=>	$idPeriodo,
			'idMateria'			=>	$idMateria,
			'idMaestro'			=>	$idMaestro,
			'nombreTrabajo'	=>	$nombreTrabajo,
			'fechaInicio'		=>  $fechaInicio,
			'feculmod'			=>  $feculmod,
			'usumod'				=> $usumod,
			'habilitado'		=> $habilitado
		);

		if ($this->tramitessa_model->insertTramite($arrInsert)) {

			// $this->session->set_flashdata('error', 'insertOk');

			$tramiteProceso = $this->tramitessa_model->getTramiteByFechaI($fechaInicio);

			if (!(file_exists($rutaPrincipal))) {
				mkdir($rutaPrincipal, 0777);
			}

			if (!(file_exists($rutaPrincipal."/".$tramiteProceso->idTramite))) {
				mkdir($rutaPrincipal."/".$tramiteProceso->idTramite, 0777);
			}


			if ($tramite == "Examen Voluntario") {
				// $solicitudEV	= $this->input->post('solicitudEV');
				// $kardexEV			= $this->input->post('kardexEV');
				$nuevoArchivoS = explode(".", $_FILES['solicitudEV']["name"]);
				$nuevoArchivoK = explode(".", $_FILES['kardexEV']["name"]);
				//die(var_dump($nuevoArchivoS[1]));
				if($nuevoArchivoS[1] != "pdf" || $nuevoArchivoK[1] != "pdf")
				{
					$this->borrarTramite($tramiteProceso->idTramite);
					$this->session->set_flashdata('error', 'altaPDFFail');
					redirect('portal-informatica-alumnos-tramites-alta/'.$idTramite);
				}

				$namesFiles = array();

				// archivo de solicitud
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'solicitudEV', "solicitudEV-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de kardex
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'kardexEV', "kardexEV-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				foreach ($namesFiles as $nf) {
					// die(var_dump($nf));
					$arrInsert = array(
						'idTramite'		=>	$tramiteProceso->idTramite,
						'ruta'				=> 	$nf,
						'estatus'			=>	'RECIBIDO',
						'habilitado'	=>	1
					);
					$this->tramitessa_model->insertRutaTramite($arrInsert);
				}
			}

			if ($tramite == "Readquisición de Pasantía") {
				// $solicitudRP					= $this->input->post('solicitudRP');
				// $cartaCalifDiploRP		= $this->input->post('cartaCalifDiploRP');
				$nuevoArchivoSRP 				= explode(".", $_FILES['solicitudRP']["name"]);
				$nuevoArchivoCRP 				= explode(".", $_FILES['cartaCalifDiploRP']["name"]);
				$nuevoArchivoRRP 				= explode(".", $_FILES['reciboDiploRP']["name"]);
				$nuevoArchivoKRP 				= explode(".", $_FILES['kardexRP']["name"]);

				if($nuevoArchivoSRP[1] != "pdf" || $nuevoArchivoCRP[1] != "pdf" || $nuevoArchivoRRP[1] != "pdf" || $nuevoArchivoKRP[1] != "pdf")
				{
					$this->borrarTramite($tramiteProceso->idTramite);
					$this->session->set_flashdata('error', 'altaPDFFail');
					redirect('portal-informatica-alumnos-tramites-alta/'.$idTramite);
				}

				$namesFiles = array();

				// archivo de solicitud
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'solicitudRP', "solicitudRP-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de cartaCalifDiploRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'cartaCalifDiploRP', "cartaCalifDiploRP-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de reciboDiploRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'reciboDiploRP', "reciboDiploRP-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de kardexRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'kardexRP', "kardexRP-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				foreach ($namesFiles as $nf) {
					// die(var_dump($nf));
					$arrInsert = array(
						'idTramite'		=>	$tramiteProceso->idTramite,
						'ruta'				=> 	$nf,
						'estatus'			=>	'RECIBIDO',
						'habilitado'	=>	1
					);
					$this->tramitessa_model->insertRutaTramite($arrInsert);
				}
			}

			if ($tramite == "Cursos y Diplomados de Actualización y de Profundización Disciplinaria") {
				// $solicitudRP					= $this->input->post('solicitudRP');
				// $cartaCalifDiploRP		= $this->input->post('cartaCalifDiploRP');
				$nuevoArchivoSCD				= explode(".", $_FILES['solicitudCD']["name"]);
				$nuevoArchivoCCD				= explode(".", $_FILES['cartaCalifDiploCD']["name"]);
				$nuevoArchivoRCD				= explode(".", $_FILES['reciboDiploCD']["name"]);
				$nuevoArchivoKCD				= explode(".", $_FILES['kardexCD']["name"]);

				if($nuevoArchivoSCD[1] != "pdf" || $nuevoArchivoCCD[1] != "pdf" || $nuevoArchivoRCD[1] != "pdf" || $nuevoArchivoKCD[1] != "pdf")
				{
					$this->borrarTramite($tramiteProceso->idTramite);
					$this->session->set_flashdata('error', 'altaPDFFail');
					redirect('portal-informatica-alumnos-tramites-alta/'.$idTramite);
				}

				$namesFiles = array();

				// archivo de solicitud
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'solicitudCD', "solicitudCD-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de cartaCalifDiploRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'cartaCalifDiploCD', "cartaCalifDiploCD-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de reciboDiploRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'reciboDiploCD', "reciboDiploCD-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de kardexRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'kardexCD', "kardexCD-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				foreach ($namesFiles as $nf) {
					// die(var_dump($nf));
					$arrInsert = array(
						'idTramite'		=>	$tramiteProceso->idTramite,
						'ruta'				=> 	$nf,
						'estatus'			=>	'RECIBIDO',
						'habilitado'	=>	1
					);
					$this->tramitessa_model->insertRutaTramite($arrInsert);
				}
			}

			if ($tramite == "Guía del Maestro") {
				// $solicitudRP					= $this->input->post('solicitudRP');
				// $cartaCalifDiploRP		= $this->input->post('cartaCalifDiploRP');
				$nuevoArchivoSGM				= explode(".", $_FILES['solicitudGM']["name"]);
				$nuevoArchivoPGM				= explode(".", $_FILES['protocoloGM']["name"]);
				$nuevoArchivoCAMRGM			= explode(".", $_FILES['cartaAeptacionMRespoGM']["name"]);
				$nuevoArchivoKGM				= explode(".", $_FILES['kardexGM']["name"]);

				if($nuevoArchivoSGM[1] != "pdf" || $nuevoArchivoPGM[1] != "pdf" || $nuevoArchivoCAMRGM[1] != "pdf" || $nuevoArchivoKGM[1] != "pdf")
				{
					$this->borrarTramite($tramiteProceso->idTramite);
					$this->session->set_flashdata('error', 'altaPDFFail');
					redirect('portal-informatica-alumnos-tramites-alta/'.$idTramite);
				}

				$namesFiles = array();

				// archivo de solicitud
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'solicitudGM', "solicitudGM-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de cartaCalifDiploRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'protocoloGM', "protocoloGM-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de reciboDiploRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'cartaAeptacionMRespoGM', "cartaAeptacionMRespoGM-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de kardexRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'kardexGM', "kardexGM-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				foreach ($namesFiles as $nf) {
					// die(var_dump($nf));
					$arrInsert = array(
						'idTramite'		=>	$tramiteProceso->idTramite,
						'ruta'				=> 	$nf,
						'estatus'			=>	'RECIBIDO',
						'habilitado'	=>	1
					);
					$this->tramitessa_model->insertRutaTramite($arrInsert);
				}
			}

			if ($tramite == "Memoria de Trabajo") {
				// $solicitudRP					= $this->input->post('solicitudRP');
				// $cartaCalifDiploRP		= $this->input->post('cartaCalifDiploRP');
				$nuevoArchivoSMT				= explode(".", $_FILES['solicitudMT']["name"]);
				$nuevoArchivoPMT				= explode(".", $_FILES['protocoloMT']["name"]);
				$nuevoArchivoCLTMT			= explode(".", $_FILES['cartaLugarTrabajoMT']["name"]);
				$nuevoArchivoCAAMT			= explode(".", $_FILES['cartaAsesorAcadeMT']["name"]);

				if($nuevoArchivoSMT[1] != "pdf" || $nuevoArchivoPMT[1] != "pdf" || $nuevoArchivoCLTMT[1] != "pdf" || $nuevoArchivoCAAMT[1] != "pdf")
				{
					$this->borrarTramite($tramiteProceso->idTramite);
					$this->session->set_flashdata('error', 'altaPDFFail');
					redirect('portal-informatica-alumnos-tramites-alta/'.$idTramite);
				}

				$namesFiles = array();

				// archivo de solicitud
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'solicitudMT', "solicitudMT-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de cartaCalifDiploRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'protocoloMT', "protocoloMT-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de reciboDiploRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'cartaLugarTrabajoMT', "cartaLugarTrabajoMT-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de kardexRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'cartaAsesorAcadeMT', "cartaAsesorAcadeMT-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				foreach ($namesFiles as $nf) {
					// die(var_dump($nf));
					$arrInsert = array(
						'idTramite'		=>	$tramiteProceso->idTramite,
						'ruta'				=> 	$nf,
						'estatus'			=>	'RECIBIDO',
						'habilitado'	=>	1
					);
					$this->tramitessa_model->insertRutaTramite($arrInsert);
				}
			}

			if ($tramite == "Trabajo Terminado") {
				// $solicitudRP					= $this->input->post('solicitudRP');
				// $cartaCalifDiploRP		= $this->input->post('cartaCalifDiploRP');
				$nuevoArchivoSTT				= explode(".", $_FILES['solicitudTT']["name"]);
				$nuevoArchivoTTT				= explode(".", $_FILES['trabajoTT']["name"]);
				$nuevoArchivoCAATT			= explode(".", $_FILES['cartaAsesorTT']["name"]);
				$nuevoArchivoCTTT				= explode(".", $_FILES['cartaTrabajoTT']["name"]);

				if($nuevoArchivoSTT[1] != "pdf" || $nuevoArchivoTTT[1] != "pdf" || $nuevoArchivoCAATT[1] != "pdf" || $nuevoArchivoCTTT[1] != "pdf")
				{
					$this->borrarTramite($tramiteProceso->idTramite);
					$this->session->set_flashdata('error', 'altaPDFFail');
					redirect('portal-informatica-alumnos-tramites-alta/'.$idTramite);
				}

				$namesFiles = array();

				// archivo de solicitud
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'solicitudTT', "solicitudTT-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de cartaCalifDiploRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'trabajoTT', "trabajoTT-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de reciboDiploRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'cartaAsesorTT', "cartaAsesorTT-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de kardexRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'cartaTrabajoTT', "cartaTrabajoTT-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				foreach ($namesFiles as $nf) {
					// die(var_dump($nf));
					$arrInsert = array(
						'idTramite'		=>	$tramiteProceso->idTramite,
						'ruta'				=> 	$nf,
						'estatus'			=>	'RECIBIDO',
						'habilitado'	=>	1
					);
					$this->tramitessa_model->insertRutaTramite($arrInsert);
				}
			}

			if ($tramite == "Tesis Individual") {
				// $solicitudRP					= $this->input->post('solicitudRP');
				// $cartaCalifDiploRP		= $this->input->post('cartaCalifDiploRP');
				$nuevoArchivoSTI				= explode(".", $_FILES['solicitudTI']["name"]);
				$nuevoArchivoKTI				= explode(".", $_FILES['kardexTI']["name"]);

				if($nuevoArchivoSTI[1] != "pdf" || $nuevoArchivoKTI[1] != "pdf")
				{
					$this->borrarTramite($tramiteProceso->idTramite);
					$this->session->set_flashdata('error', 'altaPDFFail');
					redirect('portal-informatica-alumnos-tramites-alta/'.$idTramite);
				}

				$namesFiles = array();

				// archivo de solicitud
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'solicitudTI', "solicitudTI-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de cartaCalifDiploRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'kardexTI', "kardexTI-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				foreach ($namesFiles as $nf) {
					// die(var_dump($nf));
					$arrInsert = array(
						'idTramite'		=>	$tramiteProceso->idTramite,
						'ruta'				=> 	$nf,
						'estatus'			=>	'RECIBIDO',
						'habilitado'	=>	1
					);
					$this->tramitessa_model->insertRutaTramite($arrInsert);
				}
			}

			if ($tramite == "Promedio") {
				// $solicitudRP					= $this->input->post('solicitudRP');
				// $cartaCalifDiploRP		= $this->input->post('cartaCalifDiploRP');
				$nuevoArchivoSPro				= explode(".", $_FILES['solicitudPro']["name"]);
				$nuevoArchivoKPro				= explode(".", $_FILES['kardexPro']["name"]);

				if($nuevoArchivoSPro[1] != "pdf" || $nuevoArchivoKPro[1] != "pdf")
				{
					$this->borrarTramite($tramiteProceso->idTramite);
					$this->session->set_flashdata('error', 'altaPDFFail');
					redirect('portal-informatica-alumnos-tramites-alta/'.$idTramite);
				}

				$namesFiles = array();

				// archivo de solicitud
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'solicitudPro', "solicitudPro-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de cartaCalifDiploRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'kardexPro', "kardexPro-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				foreach ($namesFiles as $nf) {
					// die(var_dump($nf));
					$arrInsert = array(
						'idTramite'		=>	$tramiteProceso->idTramite,
						'ruta'				=> 	$nf,
						'estatus'			=>	'RECIBIDO',
						'habilitado'	=>	1
					);
					$this->tramitessa_model->insertRutaTramite($arrInsert);
				}
			}

			if ($tramite == "Acreditación de Posgrado") {
				// $solicitudRP					= $this->input->post('solicitudRP');
				// $cartaCalifDiploRP		= $this->input->post('cartaCalifDiploRP');
				$nuevoArchivoSAP			= explode(".", $_FILES['solicitudAP']["name"]);
				$nuevoArchivoCEMAP		= explode(".", $_FILES['cartaECMAP']["name"]);
				$nuevoArchivoMCAP			= explode(".", $_FILES['mapaCurriAP']["name"]);

				if($nuevoArchivoSAP[1] != "pdf" || $nuevoArchivoCEMAP[1] != "pdf" || $nuevoArchivoMCAP[1] != "pdf" )
				{
					$this->borrarTramite($tramiteProceso->idTramite);
					$this->session->set_flashdata('error', 'altaPDFFail');
					redirect('portal-informatica-alumnos-tramites-alta/'.$idTramite);
				}

				$namesFiles = array();

				// archivo de solicitud
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'solicitudAP', "solicitudAP-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de cartaCalifDiploRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'cartaECMAP', "cartaECMAP-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				// archivo de cartaCalifDiploRP
				$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'mapaCurriAP', "mapaCurriAP-".$alumno->expediente."-".$this->fecha);
				$namesFiles[] = $file;

				foreach ($namesFiles as $nf) {
					// die(var_dump($nf));
					$arrInsert = array(
						'idTramite'		=>	$tramiteProceso->idTramite,
						'ruta'				=> 	$nf,
						'estatus'			=>	'RECIBIDO',
						'habilitado'	=>	1
					);
					$this->tramitessa_model->insertRutaTramite($arrInsert);
				}
			}

			// die(var_dump($arrInsert));
			$this->session->set_flashdata('error', 'altaTramiteOk');
			redirect('portal-informatica-alumnos-tramites-alta/'.$idTramite);
		}else{
			$this->session->set_flashdata('error', 'insertFail');
			redirect('portal-informatica-alumnos-tramites-alta/'.$idTramite);
		}
	}

  public function tramitesAlumnoProceso()
  {
    $data['sys_app_title'] 	= 'TRÁMITES ALUMNO';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRÁMITES ALUMNO';
		$data['app_sub_menu'] 	= 'iTramite';
		$data['app_sub_menu_item'] = 'tramitesProcesoA';
		// $data['user']      	= $this->usuario;
		$data['menu_app']   = $this->load->view('app/components/menu/alumno_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
    $data['js']       = array('tramites');
		$tramitesP = $this->tramitessa_model->getTramitesProcesoByIdAlumno($this->idAlumno);
		if (!is_null($tramitesP)) {
			foreach ($tramitesP as $tramite) {
				$tramite->idPeriodo = $this->common_model->getPeriodo($tramite->idPeriodo)->periodo;
			}
		}
		$data['tramitesP']		=	$tramitesP;
		$data['catTramites'] 	= $this->catTramites();
		$data['observaciones'] = $this->observacionesByAlumno($this->idAlumno);
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/tramites_proceso_alumno_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
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

	private function observacionesByAlumno($idAlumno)
	{
		$arrayObservaciones = array();
		$observaciones = $this->tramitessa_model->getObserByIdA($idAlumno);
		if (!is_null($observaciones)) {
			foreach ($observaciones as $observacion) {
				$arrayObservaciones[$observacion->idTramite] = $observacion->observacion;
			}
			// die(var_dump($arrayTramites));
			return $arrayObservaciones;
		}else{
			return null;
		}

	}

	private function observacionesG()
	{
		$arrayObservaciones = array();
		$observaciones = $this->tramitessa_model->getObservaciones();
		if (!is_null($observaciones)) {
			foreach ($observaciones as $observacion) {
				$arrayObservaciones[$observacion->idTramite] = $observacion->observacion;
			}
			// die(var_dump($arrayTramites));
			return $arrayObservaciones;
		}else{
			return null;
		}

	}

  public function tramitesAlumnoDatos($idTramite)
  {
		$tramite = $this->tramitessa_model->getTramitePById($idTramite);
		if (!($this->alumno->idAlumno == $tramite->idAlumno)) {
			redirect('portal-informatica-alumnos-tramites-proceso');
		}

    $data['sys_app_title'] 	= 'TRAMITES ALUMNO';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRAMITES ALUMNO';
		$data['app_sub_menu'] 	= 'notifiTramites';

		if ($tramite->estatus == "FINALIZADO") {
			$data['app_sub_menu_item'] = 'tramitesFinalizadosA';
		}else {
			$data['app_sub_menu_item'] = 'tramitesProcesoA';
		}

		// $data['user']      	= $this->usuario;
		$data['menu_app']   = $this->load->view('app/components/menu/alumno_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
    $data['js']       = array('tramites');
    // $data['idTramite']       = $idTramite;
		$data['tramite']		=	$tramite;
		$data['periodoTramite'] =	$this->common_model->getPeriodo($tramite->idPeriodo)->periodo;
		$data['alumno']      	= $this->alumno;
		$data['catTramites'] = $this->catTramites();
		$data['observacion'] = $this->tramitessa_model->getObservacionByTramite($idTramite);
		$data['archivos']		 = $this->tramitessa_model->getArchivosByTramite($idTramite);
		$data['materia']			= $this->tramitessa_model->getMateriaById($tramite->idMateria);
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/tramites_datos_tramite_alumno_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
  }

	public function updateFile()
	{

		$this->load->model('file_model');

		$idRT 				= $this->input->post('idRT');
		$idTramite 		= $this->input->post('idTramite');
		$nombreF			=	$this->input->post('nombreF');
		$nombreF 			= explode('-', $nombreF);
		$nombreF			=	$nombreF[0];

		$alumno = $this->alumno_model->getAlumno($this->idAlumno);

		$rutaRechazados = "docs/tramites/".$alumno->expediente."/".$idTramite."/rechazados";

		$rutaPrincipal = "docs/tramites/".$alumno->expediente."/".$idTramite;

		if (!(file_exists($rutaRechazados))) {
			mkdir($rutaRechazados, 0777);
		}

    // mover archivos
		if (rename($rutaPrincipal."/".$this->input->post('nombreF'), $rutaRechazados."/".$this->input->post('nombreF'))) {

			$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$idTramite, $data = false, 'file', $nombreF."-".$alumno->expediente."-".$this->fecha);

			// die(var_dump($file));

			$arrUpdate  = array(
				'habilitado'	=>	0
			);

			$arrInsert = array(
				'idTramite'		=>	$idTramite,
				'ruta'				=>	$file,
				'estatus'			=> 	'RECIBIDO',
				'habilitado'	=>	1
			);

			if ($this->tramitessa_model->updateRutaTramite($idRT, $arrUpdate)) {
				if ($this->tramitessa_model->insertRutaTramite($arrInsert)) {
					$this->session->set_flashdata('error', 'updateFileOk');
					echo "OK";
				}else{
					echo "ERROR";
				}
			}else {
				echo "ERROR";
			}

			// echo $idTramite;
			// redirect('portal-informatica-alumnos-tramites');
		}
	}

	public function updateTramite()
	{
		$idTramite = $this->input->post('idTramite');

		$arrUpdate  = array(
			'estatus'	=>	'ALTA'
		);

		if ($this->tramitessa_model->updateTramite($idTramite, $arrUpdate)) {
			if ($this->quitarObservacionesByTramite($idTramite)) {
				$this->session->set_flashdata('error', 'updateOk');
			}
		}
	}

	public function borrarTramite($idTramite)
	{
		$arrUpdate  = array(
			'habilitado'	=>	0
		);

		$this->tramitessa_model->updateTramite($idTramite, $arrUpdate);
	}

	public function quitarObservacionesByTramite($idTramite)
	{
		$arrUpdate = array(
			'habilitado' => 0
		);
		return $this->tramitessa_model->updateObserByTramite($idTramite, $arrUpdate);
	}

	public function tramitesAlumnoFinalizados()
	{
		$data['sys_app_title'] 	= 'TRAMITES ALUMNO';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRAMITES ALUMNO';
		$data['app_sub_menu'] 	= 'iTramite';
		$data['app_sub_menu_item'] = 'tramitesFinalizadosA';
		// $data['user']      	= $this->usuario;
		$data['menu_app']   = $this->load->view('app/components/menu/alumno_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
    $data['js']       = array('tramites');

		$tramitesF				=	$this->tramitessa_model->getTramitesFinalizadosByIdAlumno($this->idAlumno);

		if (!is_null($tramitesF)) {
			foreach ($tramitesF as $tramite) {
				$tramite->idPeriodo = $this->common_model->getPeriodo($tramite->idPeriodo)->periodo;
			}
		}

		$data['tramitesF']		=	$tramitesF;
		$data['catTramites'] = $this->catTramites();
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/tramites_finalizados_alumno_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
	}

	private function catRequisitos()
	{
		$arrayRequisitos = array();
		$catRequisitos = $this->tramitessa_model->getCatRequisitos();
		foreach ($catRequisitos as $requisito) {
			$arrayRequisitos[$requisito->idRequisito] = $requisito->requisito;
		}
		// die(var_dump($arrayTramites));
		return $arrayRequisitos;
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

	public function tramitesEnviarA()
	{
		$idTramite 	= $this->input->post('idTramite');
		$estatus		= $this->input->post('estatus');

		if ($estatus == "INVESTIGACION") {
			$investigadores = $this->tramitessa_model->getInvestigadores();

			if (!is_null($investigadores)) {
				foreach ($investigadores as $investigador) {
					$arrInsert = array(
						'idTramite'		=>		$idTramite,
						'idMiembro'		=>		$investigador->idUsuario,
						'estatus'			=>		$estatus,
						'aprobacion'	=>		0					// 0 => NoAtendido,		1 => Aprobado,		2 => Rechazado
					);

					$this->tramitessa_model->insertAprobacionTramite($arrInsert);

				}
			}
		}

		if ($estatus == "CONSEJO") {
			$consejeros = $this->tramitessa_model->getConsejeros();

			if (!is_null($consejeros)) {
				foreach ($consejeros as $consejero) {
					$arrInsert = array(
						'idTramite'		=>		$idTramite,
						'idMiembro'		=>		$consejero->idUsuario,
						'estatus'			=>		$estatus,
						'aprobacion'	=>		0					// 0 => NoAtendido,		1 => Aprobado,		2 => Rechazado
					);

					$this->tramitessa_model->insertAprobacionTramite($arrInsert);

				}
			}
		}

		if ($estatus == "PREACTA") {
			$recomendacion = $this->input->post('recomendacion');
			$arrUpdate = array(
				'recomendacion' => $recomendacion
			);
			$this->tramitessa_model->updateTramite($idTramite, $arrUpdate);
		}

		if ($estatus == "APROBADO" OR $estatus== "RECHAZADO") {
			$arrUpdate = array(
				'fechaFin'	=> $this->fecha
			);
			$this->tramitessa_model->updateTramite($idTramite, $arrUpdate);
		}

		if ($this->updateTramiteTo($idTramite, $estatus)) {
			$this->session->set_flashdata('error', 'updateOk');
		}else{
			$this->session->set_flashdata('error', 'updateFail');
		}
	}

	public function tramitesPreacta()
	{
		$data['sys_app_title'] 	= 'TRÁMITES PREACTA';
		$data['app_title'] 	= '<i class="fa fa-user"></i>  TRÁMITES';
		$data['app_sub_menu'] 	= 'iTramite';
		$data['app_sub_menu_item'] = 'tramitesPreacta';
		// $data['user']      	= $this->usuario;
		$data['js']       = array('tramites');
		$data['menu_app']   = $this->load->view('app/components/menu/tramitessa_component', $data, TRUE);
		$data['menu'] 		= $this->load->view('app/components/head_component',$data,TRUE);
		$data['catTramites'] = $this->catTramites();

		$tramites						=	$this->tramitessa_model->getTramitesPreacta();

		if (!is_null($tramites)) {
			foreach ($tramites as $tramite) {
				$tramite->idPeriodo	=	$this->common_model->getPeriodo($tramite->idPeriodo)->periodo;
			}
		}

		$data['tramites'] =	$tramites;
		$data['expAlumno'] = $this->catAlumnosExp();
		$data['observaciones'] = $this->observacionesG();
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/tramites_preacta_fragment', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
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

	private function recomendacion($consejeros, $aprobacionesConse)
	{
		if (is_null($consejeros) or is_null($aprobacionesConse)) {
			return null;
		}
		$aFavor = 0;
		$contra = 0;
		$abstinencias = 0;
		foreach ($consejeros as $consejero) {
			if ($aprobacionesConse[$consejero->idUsuario]->aprobacion == 0) {
				$abstinencias++;
			}if ($aprobacionesConse[$consejero->idUsuario]->aprobacion == 1) {
				$aFavor++;
			}if ($aprobacionesConse[$consejero->idUsuario]->aprobacion == 2) {
				$contra++;
			}
		}
		$totalC = count($consejeros);

		$aFavor 			= ($aFavor/$totalC)*100;
		$contra 			= ($contra/$totalC)*100;
		$abstinencias = ($abstinencias/$totalC)*100;

		if ($aFavor >= 50) {
			return "APROBADO";
		}
		if($contra > 50) {
			return "RECHAZADO";
		}
		if ($abstinencias >= 50) {
			return "ATENDIDO";
		}
	}

	public function tramitesPdf(){
		// $tramite = $this->tramitessa_model->getTramites();
		$noOficio = strtoupper($this->input->post("noOficio"));
		$idTramite = $this->input->post('idTramite');
		$fechaCon = $this->input->post('fechaConsejo');
		$tramite = $this->tramitessa_model->getTramitePById($idTramite);

		if ($tramite->idCatTramite == 1){
			$idPresidente = $this->input->post('presidente');
			$sinodalUno = $this->input->post('sinodal1');
			$sinodalDos = $this->input->post('sinodal2');
			$fechaApliExam = $this->input->post('fechaApliExam');
			$horaI = $this->input->post('horaInicio');
			$horaF = $this->input->post('horaFin');
			$aula = $this->input->post('aula');
			$decision = $this->input->post('decision');

			$materia = $this->tramitessa_model->getMateriaById($tramite->idMateria);
			$plan = $this->alumno_model->getPlan($this->alumno->idPlan);
			$presidente = $this->tramitessa_model->getMaestrosById($idPresidente);
			$sinodalUno = $this->tramitessa_model->getMaestrosById($sinodalUno);
			$sinodalDos = $this->tramitessa_model->getMaestrosById($sinodalDos);

			$info['alumno']	= $this->alumno;
			$info['plan'] = $plan;
			$info['materia'] = $materia;
			$info['presidente'] = $presidente;
			$info['sinodalUno'] = $sinodalUno;
			$info['sinodalDos'] = $sinodalDos;
			$info['fechaApliExam'] = $fechaApliExam;
			$info['horaI'] = $horaI;
			$info['horaF'] = $horaF;
			$info['aula'] = $aula;
			$info['decision'] = ($decision == 'APROBADO') ? 'autorizar' : 'rechazar' ;
			$info['fechaCon'] = $fechaCon;
			$info['noOficio']	= $noOficio;

			//crea el pdf
			$info['body'] = $this->load->view('app/fragments/'.$this->folder.'/tramites/examen_vol', $info, true);
			$html = $this->load->view('app/fragments/'.$this->folder.'/tramites/principal_tr', $info, true);
		}

		if ($tramite->idCatTramite == 3){
			$tiempoSoli = $this->input->post('tiempoSoli');
			$periodoCurso = $this->input->post('periodoCurso');
			$fechaVenciPas = $this->input->post('fechaVenciPas');
			$decision = $this->input->post('decision');

			$info['alumno']	= $this->alumno;
			$info['nombreTrabajo'] = $tramite->nombreTrabajo;
			$info['periodoCurso'] = $periodoCurso;
			$info['fechaVenciPas'] = $fechaVenciPas;
			$info['tiempoSoli'] = $tiempoSoli;
			$info['decision'] = ($decision == 'APROBADO') ? 'autorizar' : 'rechazar' ;
			$info['fechaCon'] = $fechaCon;
			$info['noOficio']	= $noOficio;

			//crea el pdf
			$info['body'] = $this->load->view('app/fragments/'.$this->folder.'/tramites/readqui_pasantia', $info, true);
			$html = $this->load->view('app/fragments/'.$this->folder.'/tramites/principal_tr', $info, true);
		}

		if ($tramite->idCatTramite == 4){
			$decision = $this->input->post('decision');

			$info['alumno']	= $this->alumno;
			$info['decision'] = ($decision == 'APROBADO') ? 'Autorizar' : 'Rechazar' ;
			$info['fechaCon'] = $fechaCon;
			$info['noOficio']	= $noOficio;

			//crea el pdf
			$info['body'] = $this->load->view('app/fragments/'.$this->folder.'/tramites/curso_diplomado', $info, true);
			$html = $this->load->view('app/fragments/'.$this->folder.'/tramites/principal_tr', $info, true);
		}

		if ($tramite->idCatTramite == 5){
			$decision = $this->input->post('decision');

			$materia = $this->tramitessa_model->getMateriaById($tramite->idMateria);
			$plan = $this->alumno_model->getPlan($this->alumno->idPlan);
			$maestro = $this->tramitessa_model->getMaestrosById($tramite->idMaestro);

			// print_r(die(var_dump($maestro)));

			$info['alumno']	= $this->alumno;
			$info['decision'] = ($decision == 'APROBADO') ? 'Autorizar' : 'Rechazar' ;
			$info['materia'] = $materia;
			$info['plan'] = $plan;
			$info['maestro'] = $maestro;
			$info['fechaCon'] = $fechaCon;
			$info['noOficio']	= $noOficio;

			//crea el pdf
			$info['body'] = $this->load->view('app/fragments/'.$this->folder.'/tramites/guia_del_maestro', $info, true);
			$html = $this->load->view('app/fragments/'.$this->folder.'/tramites/principal_tr', $info, true);
		}

		if ($tramite->idCatTramite == 8){
			$decision = $this->input->post('decision');

			$plan = $this->alumno_model->getPlan($this->alumno->idPlan);

			$info['alumno']	= $this->alumno;
			$info['decision'] = ($decision == 'APROBADO') ? 'Aprobado' : 'Rechazado' ;
			$info['nombreTrabajo'] = $tramite->nombreTrabajo;
			$info['fechaCon'] = $fechaCon;
			$info['plan'] = $plan;
			$info['noOficio']	= $noOficio;

			//crea el pdf
			$info['body'] = $this->load->view('app/fragments/'.$this->folder.'/tramites/tesis_individual', $info, true);
			$html = $this->load->view('app/fragments/'.$this->folder.'/tramites/principal_tr', $info, true);
		}

		if ($tramite->idCatTramite == 9){
			$decision = $this->input->post('decision');

			$info['alumno']	= $this->alumno;
			$info['decision'] = ($decision == 'APROBADO') ? 'Autorizar' : 'Rechazar' ;
			$info['fechaCon'] = $fechaCon;
			$info['noOficio']	= $noOficio;

			//crea el pdf
			$info['body'] = $this->load->view('app/fragments/'.$this->folder.'/tramites/promedio', $info, true);
			$html = $this->load->view('app/fragments/'.$this->folder.'/tramites/principal_tr', $info, true);
		}
		// print_r (die(var_dump($decision)));

		$rutaPrincipal = 'docs/tramites/'.$this->alumno->expediente.'/'.$idTramite.'/respuesta';

		if (!(file_exists($rutaPrincipal))) {
			mkdir($rutaPrincipal, 0777);
		}
		// print_r (die(var_dump($this->alumno)));

		$filename = 'respuesta_'.$this->alumno->expediente.'_'.$this->fecha;
		$target = 'tramites/'.$this->alumno->expediente.'/'.$idTramite.'/respuesta';

		//configuraciones
		$acentos = array('Á','á','Ó','ó','É','é','Í','í','Ú', 'ú','Ñ', 'ñ','#');
		$replac = array('&Aacute;','&aacute;','&Oacute;','&oacute;','&Eacute;','&eacute;','&Iacute;','&iacute;','&Uacute;','&uacute;','&Ntilde;','&ntilde;');
		$html = str_replace($acentos, $replac, $html);

		// print_r (die(var_dump($html)));

		$this->load->library('dompdf_lib');
		$dompdf = new Dompdf_lib();

		$dompdf->pdf_create($html, $filename, false, 'portrait', $target);
		// $ruta = 'docs/tramites/'.$this->alumno->expediente.'/'.$idTramite.'/respuesta';
		// print_r (die(var_dump($idTramite)));
		$arrUpdate = array(
			'fechaFin'	=> $this->fecha
		);
		$this->tramitessa_model->updateTramite($idTramite, $arrUpdate);
		$this->updateTramiteTo($idTramite, $decision);


		$arrInsert = array(
			'idTramite' => $idTramite,
			'ruta' => $filename,
			'noOficio' => $noOficio,
			'habilitado' => 1 );

		$this->tramitessa_model->insertTramiteRespuesta($arrInsert);

		// $link = 'docs/'.$target.'/'.$filename.'.pdf';
		$this->session->set_flashdata('error', 'respuestaOk');
		redirect(base_url().'portal-informatica-tramites-datos/'.$idTramite);
	}
}

/* End of file tramitessa.php */
/* Location: ./application/controllers/alumno.php */

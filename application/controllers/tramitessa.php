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
		// $this->idAlumno 					= 2249;
		$this->idAlumno 					= 2670;
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
		$data['tramites'] = $this->tramitessa_model->getTramites();
		$data['expAlumno'] = $this->catAlumnosExp();
		$data['observaciones'] = $this->observacionesG();
		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/tramites_proceso', $data, TRUE);
		$this->load->view('app/main_view', $data, FALSE);
	}

	public function tramitesDatos($idTramite)
	{
		$tramite = $this->tramitessa_model->getTramitePById($idTramite);
		$alumno = $this->alumno_model->getAlumno($tramite->idAlumno);
		$archivos = $this->tramitessa_model->getArchivosByTramite($idTramite);

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

		$data['archivos']		 = $archivos;
		$data['tramite']		=	$tramite;
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

		$data['fragment']  	= $this->load->view('app/fragments/'.$this->folder.'/tramites_archivo', $data, TRUE);
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
            <td data-title="Estatus">'.$tramite->estatus.'</td>';

            if (array_key_exists ( $tramite->idTramite , $observaciones )){
							$strTable.='<td data-title="Observaciones">'.$observaciones[$tramite->idTramite].'</td>';
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
		$data['tramite']		=	$this->tramitessa_model->getTramiteById($idTramite);
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

		if (!$this -> form_validation -> run()) {
			$this -> session -> set_flashdata('error', 'noSuficienteDatos');
			redirect('portal-informatica-alumnos-tramites-notificaciones');
			return false;
		}

		$this->load->model('file_model');

		// die(var_dump($this->path));

		$alumno = $this->alumno_model->getAlumno($this->idAlumno);

		$rutaPrincipal = "docs/tramites/".$alumno->expediente;

		$tramite 			= $this->input->post('tramite');

		$idTramite 		= $this->input->post('idTramite');

		$idAlumno 		= $this->idAlumno;
		$estatus			= "ALTA";
		$fechaInicio	= date("Y-m-d H:i:s");
		$feculmod			= $this->fecha;
		$usumod				= $this->idAlumno;
		$habilitado		= 1;

		$arrInsert = array(
			'idCatTramite' 		=> 	$idTramite,
			'idAlumno' 			=> 	$idAlumno,
			'estatus' 			=> 	$estatus,
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

			// if ($tramite == "Readquisición de Pasantía") {
			// 	// $solicitudRP					= $this->input->post('solicitudRP');
			// 	// $cartaCalifDiploRP		= $this->input->post('cartaCalifDiploRP');
			// 	$nuevoArchivoSRP 				= explode(".", $_FILES['solicitudRP']["name"]);
			// 	$nuevoArchivoCRP 				= explode(".", $_FILES['cartaCalifDiploRP']["name"]);
			// 	$nuevoArchivoRRP 				= explode(".", $_FILES['reciboDiploRP']["name"]);
			// 	$nuevoArchivoKRP 				= explode(".", $_FILES['kardexRP']["name"]);
      //
			// 	if($nuevoArchivoSRP[1] != "pdf" || $nuevoArchivoCRP[1] != "pdf" || $nuevoArchivoRRP[1] != "pdf" || $nuevoArchivoKRP[1] != "pdf")
			// 	{
			// 		$this->borrarTramite($tramiteProceso->idTramite);
			// 		$this->session->set_flashdata('error', 'altaPDFFail');
			// 		redirect('portal-informatica-alumnos-tramites-alta/'.$idTramite);
			// 	}
      //
			// 	$namesFiles = array();
      //
			// 	// archivo de solicitud
			// 	$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'solicitudRP', "solicitudRP-".$alumno->expediente."-".$this->fecha);
			// 	$namesFiles[] = $file;
      //
			// 	// archivo de cartaCalifDiploRP
			// 	$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'cartaCalifDiploRP', "cartaCalifDiploRP-".$alumno->expediente."-".$this->fecha);
			// 	$namesFiles[] = $file;
      //
			// 	// archivo de reciboDiploRP
			// 	$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'reciboDiploRP', "reciboDiploRP-".$alumno->expediente."-".$this->fecha);
			// 	$namesFiles[] = $file;
      //
			// 	// archivo de kardexRP
			// 	$file = $this->file_model->uploadNonImage("tramites/".$alumno->expediente."/".$tramiteProceso->idTramite, $data = false, 'kardexRP', "kardexRP-".$alumno->expediente."-".$this->fecha);
			// 	$namesFiles[] = $file;
      //
			// 	foreach ($namesFiles as $nf) {
			// 		// die(var_dump($nf));
			// 		$arrInsert = array(
			// 			'idTramite'		=>	$tramiteProceso->idTramite,
			// 			'ruta'				=> 	$nf,
			// 			'estatus'			=>	'RECIBIDO',
			// 			'habilitado'	=>	1
			// 		);
			// 		$this->tramitessa_model->insertRutaTramite($arrInsert);
			// 	}
			// }

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
			redirect('portal-informatica-alumnos-tramites');
		}else{
			$this->session->set_flashdata('error', 'insertFail');
			redirect('portal-informatica-alumnos-tramites');
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
		$data['tramitesP']= $this->tramitessa_model->getTramitesProcesoByIdAlumno($this->idAlumno);
		$data['catTramites'] = $this->catTramites();
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
		foreach ($observaciones as $observacion) {
			$arrayObservaciones[$observacion->idTramite] = $observacion->observacion;
		}
		// die(var_dump($arrayTramites));
		return $arrayObservaciones;
	}

	private function observacionesG()
	{
		$arrayObservaciones = array();
		$observaciones = $this->tramitessa_model->getObservaciones();
		foreach ($observaciones as $observacion) {
			$arrayObservaciones[$observacion->idTramite] = $observacion->observacion;
		}
		// die(var_dump($arrayTramites));
		return $arrayObservaciones;
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
		$data['alumno']      	= $this->alumno;
		$data['catTramites'] = $this->catTramites();
		$data['observacion'] = $this->tramitessa_model->getObservacionByTramite($idTramite);
		$data['archivos']		 = $this->tramitessa_model->getArchivosByTramite($idTramite);
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

			$this->tramitessa_model->updateRutaTramite($idRT, $arrUpdate);
			$this->tramitessa_model->insertRutaTramite($arrInsert);

			$this->session->set_flashdata('error', 'updateFileOk');

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
		$data['tramitesF']= $this->tramitessa_model->getTramitesFinalizadosByIdAlumno($this->idAlumno);
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
}

/* End of file tramitessa.php */
/* Location: ./application/controllers/alumno.php */

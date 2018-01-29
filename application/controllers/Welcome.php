<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html

	 araceli.garcia.contreras@uaq.mx

	 */
	public function index()
	{
		//$this->load->view('checkbox');
		echo 'Hola, tu no debés estar aquí. :) ';
	}
	public function miTraeAlumYa(){
		$this->load->model('alumno_model');
		$exp 	= $this->input->get('expediente');
		$alumno = $this->alumno_model->getAlumnoByExp($exp);
		$alumno = (!is_null($alumno))? $alumno : NULL ; 
		
		echo json_encode($alumno);
	}
	public function updateDatosAlumnosCross(){
		$this->load->model('alumno_model');
		$exp 	= $this->input->get('expediente');
		$tipo 	= $this->input->get('tipo');
		$data 	= $this->input->get('data');
		$alumno = $this->alumno_model->getAlumnoByExp($exp);
		//die(var_dump($alumno));
		if(!is_null($alumno)){
			$arrUpdate = ($tipo == 1)? array('telefono' => $data) : array('emailUsuario' => $data);
			$this->alumno_model->updateAlumno($alumno->idAlumno, $arrUpdate);
		} 
		// Fin de la función que edita el alumno
	}
	public function getSelectTickets(){
		$this->load->model('common_model');
		
		echo json_encode($data);
	}
	public function setContrasena(){
		$this->load->model('user_model');
		$this->load->model('auth_model');
		$alumnos = $this->user_model->getUsuarios();
		$c = 1; 
		foreach ($alumnos as $row) {
			echo $row->cveMaestro .' - '.$c.'<br/>';
			$contrasena = '@'.$row->cveMaestro.'.';
			$hashPassword = $this->auth_model-> hashPassword($contrasena);
			$arrUpdate = array('contrasenaUsuario' => $hashPassword);
			$this->user_model->updateProfesor($row->idMaestro, $arrUpdate);
			$c++;
		}
	}

	private function setContrasenaAlumno(){
		$this->load->model('user_model');
		$this->load->model('auth_model');
		$alumnos = $this->user_model->getAlumnos();
		//die(var_dump($alumnos));
		$c = 1; 

		foreach ($alumnos as $row) {
			if($row->expediente == 265491){
				echo $row->expediente .' - '.$c.'<br/>';
				$contrasena = $row->expediente.'.';
				$hashPassword = $this->auth_model-> hashPassword($contrasena);
				$arrUpdate = array('contrasenaUsuario' => $hashPassword);
				$this->user_model->updateAlumno($row->idAlumno, $arrUpdate);
				$c++;
			}
			
		}
	}
	private function fixName(){
		$this->load->model('user_model');
		$alumnos = $this->user_model->getUsuarios();
		$c = 1; 
		foreach ($alumnos as $row) {
			echo $row->expediente .' - '.$c.'<br/>';
			$apellidos 		= $row->apellidoPaterno.' '.$row->apellidoMaterno;
			$nombreCompleto = $row->nombre_alumno; 
			$pos2 			= strlen($nombreCompleto);
			$pos      		= strlen($apellidos);
			$pos = $pos2 - $pos;
			//var_dump($nombreCompleto);
			$nombre 		=  substr($nombreCompleto, -$pos); 
			$arrUpdate 		= array('nombre' => $nombre);
			echo $nombre.' <br/><br/>';
			$this->user_model->updateAlumno($row->idAlumno, $arrUpdate);
			
			$c++;

		}
	}
}

<?php
/**
 * @author Melchor Leal
 * @version 2.0.1
 * @copyright Centro de desarrollo FI. Todos los Derechos reservados
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumno_model extends CI_Model {
	var $tablas = array();
	private $db_b;
	private $db_c;

	# Constructor
	function __construct()
	{
		parent::__construct();
		$this -> load -> config('tables', TRUE);
		$this -> tablas = $this -> config -> item('tablas', 'tables');
		$this->db_b = $this->load->database('malumno', TRUE);
		$this->db_c = $this->load->database('saalumno', TRUE);
		$this->db_d = $this->load->database('tick', TRUE);
		$this->db_portal = 'fif_portal';
		$this->db_portal_sa = 'fif_portal_sa';
	} # end constructor

	/**
	 * @return Array (DB result)
	*/

	public function getAlumnoByExp($exp){
		$a = $this->tablas['alumno'];
		$b = $this->tablas['plan'];
		$this->db_b->join($b, $b.'.idPlan = '.$a.'.idPlan');
		$this->db_b->where($a.'.expediente',$exp);
		$query = $this->db_b->get($a);
		return ($query->num_rows() == 1)? $query->row() : NULL;
	}
	public function getAlumno($idAlumno){
		$a = $this->tablas['alumno'];
		$this->db_b->where('idAlumno',$idAlumno);
		$query = $this->db_b->get($a);
		return ($query->num_rows() == 1)? $query->row() : NULL;
	}
	public function updateAlumno($exp, $arrUpdate){
		$a = $this->tablas['alumno'];
		$this->db_b->where('expediente',$exp);
		$this->db_b->update($a, $arrUpdate);
		return true;
	}
	public function insertAlumno($arrInsert){
		$a = $this->tablas['alumno'];
		$this->db_b->insert($a, $arrInsert);
		return true;
	} 
	public function getMateria($idMateria){
		$a = $this->tablas['materia'];
		$this->db_b->where($a.'.idMateria', $idMateria);
		$this->db_b->where($a.'.estatus', 1);
		$query = $this->db_b->get($a);
		return ($query->num_rows() == 1)? $query->row() : NULL; 
	}
	public function getPlan($idPlan){
		$a = $this->tablas['plan'];
		$this->db_b->where('idPlan',$idPlan);
		$query = $this->db_b->get($a);
		return ($query->num_rows() == 1)? $query->row() : NULL; 
	}
}

/* End of file root_model.php */
/* Location: ./application/models/root_model.php */

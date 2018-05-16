<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {
	//variables de la clase
	var $tablas = array();
	private $db_b;
	# Constructor
	
	function __construct()
	{
		parent::__construct();
		$this -> load -> config('tables', TRUE);
		$this -> tablas = $this -> config -> item('tablas', 'tables');
		$this->db_b = $this->load->database('madmin', TRUE); 
	} # end constructor

	/**
	 * @return Array (DB row)
	*/
	public function getPeriodoActivo(){
		$a = $this->tablas['periodo'];
		$this->db_b->where('estatus', 1);
		$this->db_b->order_by('idPeriodo', 'asc');
		$this->db_b->limit(1);
		$query = $this->db_b->get($a);
		//die(var_dump($query->row()));
		return ( $query->num_rows() == 1 ) ? $query->row() : NULL; 
	}
	public function getPeriodoActivoSa(){
		$a = $this->tablas['periodo'];
		$this->db_b->where('sa', 1);
		$this->db_b->order_by('idPeriodo', 'asc');
		$this->db_b->limit(1);
		$query = $this->db_b->get($a);
		//die(var_dump($query->row()));
		return ( $query->num_rows() == 1 ) ? $query->row() : NULL; 
	}
	
	public function updatePeriodos($idPeriodo,$arrUpdate){
		$a = $this->tablas['periodo'];
		$this->db_b->where('idPeriodo', $idPeriodo);
		$this->db_b->update($a, $arrUpdate);
		return true; 
	}
	public function resetPeriodosSa(){
		$a = $this->tablas['periodo'];
		$this->db_b->update($a, array("sa" => 0));
		return true; 
	}
	public function getPeriodos(){
		$a = $this->tablas['periodo'];
		$this->db_b->order_by('idPeriodo','desc');
		$query = $this->db_b->get($a);
		return ( $query->num_rows() >= 1 ) ? $query->result() : NULL; 
	}
	public function getPeriodo($idPeriodo){
		$a = $this->tablas['periodo'];
		$this->db_b->where('idPeriodo', $idPeriodo);
		$query = $this->db_b->get($a);
		return ( $query->num_rows() == 1 ) ? $query->row() : NULL; 
	}
	public function getPlanes($tipo = null){
		$a = $this->tablas['plan'];
		if(!is_null($tipo)){
			$this->db_b->where('tipo', $tipo);	
		}
		$this->db_b->where('estatus', 1);
		$query = $this->db_b->get($a);
		return ( $query->num_rows() >= 1 ) ? $query->result() : NULL; 
	}
	public function getPlanesByTipo($tipo){
		// Tipo es un array de los tipos 
		$a = $this->tablas['plan'];
		$this->db_b->where('estatus', 1);
		$this->db_b->where_in('tipo', $tipo);
		$query = $this->db_b->get($a);
		return ( $query->num_rows() >= 1 ) ? $query->result() : NULL; 
	}
	public function getPlan($idPlan){
		$a = $this->tablas['plan'];
		$this->db_b->where('idPlan',$idPlan);
		$this->db_b->where('estatus', 1);
		$query = $this->db_b->get($a);
		return ( $query->num_rows() == 1 ) ? $query->row() : NULL; 
	}

	public function getPlanByCve($cvePlan){
		$a = $this->tablas['plan'];
		$this->db_b->where('cvePlan',$cvePlan);
		$query = $this->db_b->get($a);
		return ( $query->num_rows() == 1 ) ? $query->row() : NULL;	
	}
	public function getAulas(){
		$a = $this->tablas['aula'];
		$this->db_b->where('estatus', 1);
		$query = $this->db_b->get($a);
		return ( $query->num_rows() >= 1 ) ? $query->result() : NULL; 
	}
	
	public function getAreasConoci(){
		$a = $this->tablas['areaconocimiento'];
		$query = $this->db_b->get($a);
		return ( $query->num_rows() >= 1 ) ? $query->result() : NULL; 
	}
	public function getMaterias(){
		$a = $this->tablas['materia'];
		$this->db_b->where('estatus', 1);
		$query = $this->db_b->get($a);
		return ( $query->num_rows() >= 1 ) ? $query->result() : NULL; 
	}
	public function getMateriasOrderByClv(){
		$a = $this->tablas['materia'];
		$this->db_b->where('estatus', 1);
		$this->db_b->order_by("cveMateria", "asc");
		$query = $this->db_b->get($a);
		return ( $query->num_rows() >= 1 ) ? $query->result() : NULL; 
	}

}

/* End of file common_model.php */
/* Location: ./application/models/common_model.php */
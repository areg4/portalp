<?php
/**
 * @author Gerardo Gudiño
 * @version 2.0.1
 * @copyright Centro de desarrollo FI. Todos los Derechos reservados
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Tramitessa_model extends CI_Model {
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
		$this->db_portal = 'fif_portal';
		$this->db_portal_sa = 'fif_portal_sa';
	} # end constructor

	/**
	 * @return Array (DB result)
	*/
  /**
   * Esta función regresa las materias de acuerdo al plan del alumno para
   * exámenes voluntarios.
   */
  public function getMateriasByPlan($idPlan)
  {
    $a = $this->tablas['materia'];
		$this->db_b->where('idPlan',$idPlan);
    $this->db_b->where('bloque >',1);
    $this->db_b->where('estatus', 1);
		$query = $this->db_b->get($a);
		return ($query->num_rows() >= 1) ? $query->result() : NULL;
  }

  public function getTramitesByNivel($nivel)
  {
    $a = $this->tablas['catTramites'];
		$this->db_b->where('nivel',$nivel);
    $this->db_b->where('habilitado', 1);
		$query = $this->db_b->get($a);
		return ($query->num_rows() >= 1) ? $query->result() : NULL;
  }

  public function getTramiteById($idCatTramite)
  {
    $a = $this->tablas['catTramites'];
		$this->db_b->where('idCatTramite ',$idCatTramite);
    $this->db_b->where('habilitado', 1);
		$query = $this->db_b->get($a);
		return ($query->num_rows() == 1) ? $query->row() : NULL;
  }

	public function getTramiteByFechaI($fechaInicio)
	{
		$a = $this->tablas['tramites'];
		$this->db_b->where('fechaInicio ', $fechaInicio);
    $this->db_b->where('habilitado', 1);
		$query = $this->db_b->get($a);
		return ($query->num_rows() == 1) ? $query->row() : NULL;
	}

	public function insertTramite($arrInsert){
		$a = $this->tablas['tramites'];
		$this->db_b->insert($a, $arrInsert);
		return true;
	}

	public function insertRutaTramite($arrInsert){
		$a = $this->tablas['rutaTramites'];
		$this->db_b->insert($a, $arrInsert);
		return true;
	}

	public function getTramitesProcesoByIdAlumno($idAlumno)
	{
		$a = $this->tablas['tramites'];
		$this->db_b->where('idAlumno',$idAlumno);
		$this->db_b->where('estatus <>', "FINALIZADO");
    $this->db_b->where('habilitado', 1);
		$query = $this->db_b->get($a);
		return ($query->num_rows() >= 1) ? $query->result() : NULL;
	}

	public function getCatTramites()
	{
		$a = $this->tablas['catTramites'];
    $this->db_b->where('habilitado', 1);
		$query = $this->db_b->get($a);
		return ($query->num_rows() >= 1) ? $query->result() : NULL;
	}

	public function getCatRequisitos()
	{
		$a = $this->tablas['catRequisitos'];
    $this->db_b->where('habilitado', 1);
		$query = $this->db_b->get($a);
		return ($query->num_rows() >= 1) ? $query->result() : NULL;
	}

	public function getRelacionRequisitoTramite()
	{
		$a = $this->tablas['catTramiteRequisito'];
		$query = $this->db_b->get($a);
		return ($query->num_rows() >= 1) ? $query->result() : NULL;
	}

	public function getObserByIdA($idAlumno)
	{
		$a = $this->tablas['observacionesTramites'];
		$this->db_b->where('idAlumno', $idAlumno);
    $this->db_b->where('habilitado', 1);
		$query = $this->db_b->get($a);
		return ($query->num_rows() >= 1) ? $query->result() : NULL;
	}

	public function getTramitePById($idTramite)
  {
    $a = $this->tablas['tramites'];
		$this->db_b->where('idTramite ',$idTramite);
    $this->db_b->where('habilitado', 1);
		$query = $this->db_b->get($a);
		return ($query->num_rows() == 1) ? $query->row() : NULL;
  }

	public function getObservacionByTramite($idTramite)
	{
		$a = $this->tablas['observacionesTramites'];
		$this->db_b->where('idTramite', $idTramite);
    $this->db_b->where('habilitado', 1);
		$query = $this->db_b->get($a);
		return ($query->num_rows() == 1) ? $query->row() : NULL;
	}

	public function getArchivosByTramite($idTramite)
	{
		$a = $this->tablas['rutaTramites'];
		$this->db_b->where('idTramite', $idTramite);
    $this->db_b->where('habilitado', 1);
		$query = $this->db_b->get($a);
		return ($query->num_rows() >= 1) ? $query->result() : NULL;
	}
	public function updateRutaTramite($idRT, $arrUpdate)
	{
		$a = $this->tablas['rutaTramites'];
		$this->db_b->where('idRT', $idRT);
		$this->db_b->update($a, $arrUpdate);
		return true;
	}
	public function updateTramite($idTramite, $arrUpdate)
	{
		$a = $this->tablas['tramites'];
		$this->db_b->where('idTramite', $idTramite);
		$this->db_b->update($a, $arrUpdate);
		return true;
	}
	public function updateObserByTramite($idTramite, $arrUpdate)
	{
		$a = $this->tablas['observacionesTramites'];
		$this->db_b->where('idTramite', $idTramite);
		$this->db_b->update($a, $arrUpdate);
		return true;
	}

	public function getTramitesFinalizadosByIdAlumno($idAlumno)
	{
		$a = $this->tablas['tramites'];
		$this->db_b->where('idAlumno',$idAlumno);
		$this->db_b->where('estatus', "FINALIZADO");
    $this->db_b->where('habilitado', 1);
		$this->db_b->order_by('fechaFin', 'asc');
		$query = $this->db_b->get($a);
		return ($query->num_rows() >= 1) ? $query->result() : NULL;
	}

	public function getCatExpAlumnos()
	{
		$a = $this->tablas['alumno'];
		$this->db_b->select('idAlumno');
		$this->db_b->select('expediente');
    $this->db_b->where('estatus', 1);
		$query = $this->db_b->get($a);
		return ($query->num_rows() >= 1) ? $query->result() : NULL;
	}

	public function getTramites()
	{
		$a = $this->tablas['tramites'];
		$this->db_b->where('estatus <>', "FINALIZADO");
    $this->db_b->where('habilitado', 1);
		$this->db_b->order_by('estatus', 'asc');
		$query = $this->db_b->get($a);
		return ($query->num_rows() >= 1) ? $query->result() : NULL;
	}

	public function getObservaciones()
	{
		$a = $this->tablas['observacionesTramites'];
    $this->db_b->where('habilitado', 1);
		$query = $this->db_b->get($a);
		return ($query->num_rows() >= 1) ? $query->result() : NULL;
	}
}

/* End of file root_model.php */
/* Location: ./application/models/root_model.php */

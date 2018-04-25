<?php
/**
 * @author Gerardo Gudiño
 * @version 2.0.1
 * @copyright Centro de desarrollo FI. Todos los Derechos reservados
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Investigacion_model extends CI_Model {
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
  public function getTramitesInvestigacion()
  {
    $a = $this->tablas['tramites'];
		$this->db_b->where('estatus', 'INVESTIGACION');
    $this->db_b->where('habilitado', 1);
		$query = $this->db_b->get($a);
		return ($query->num_rows() >= 1) ? $query->result() : NULL;
  }

	public function getIdsTramitesAprobAtendidos($idUsuario)
	{
		$a = $this->tablas['aprobacionTramites'];
		$this->db_b->where('idMiembro', $idUsuario);
		$this->db_b->where('aprobacion <>', 0);
		$this->db_b->where('estatus', "INVESTIGACION");
		$query = $this->db_b->get($a);
		return ($query->num_rows() >= 1) ? $query->result() : NULL;
	}
	public function getIdsTramitesAprobNoAtendidos($idUsuario)
	{
		$a = $this->tablas['aprobacionTramites'];
		$this->db_b->where('idMiembro', $idUsuario);
		$this->db_b->where('aprobacion', 0);
		$this->db_b->where('estatus', "INVESTIGACION");
		$query = $this->db_b->get($a);
		return ($query->num_rows() >= 1) ? $query->result() : NULL;
	}
	public function accesoTramiteInvest($idTramite, $idMiembro, $estatus)
	{
		$a = $this->tablas['aprobacionTramites'];
		$this->db_b->where('idTramite', $idTramite);
		$this->db_b->where('idMiembro', $idMiembro);
		$this->db_b->where('estatus', $estatus);
		$query = $this->db_b->get($a);
		return ($query->num_rows() == 1) ? $query->row() : NULL;
	}
}

/* End of file root_model.php */
/* Location: ./application/models/root_model.php */

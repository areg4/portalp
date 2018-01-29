<?php
/**
 * @author Melchor Leal
 * @version 2.0.1
 * @copyright UAQ-Facultad de informática, 2016. Todos los Derechos reservados
*/

date_default_timezone_set("America/Mexico_City");



if(!function_exists("site_name")){
	function site_name(){
		return "Portal de informática";

	} # en if
} # en if
if(!function_exists("host")){
	function host(){
		return 'http://127.0.0.1/';

	} # en if
} # en if
if(!function_exists("site")){
	function site(){
		return base_url();

	} # en if
} # en if
/**
 * @return boolean
 */
if(!function_exists("is_online")){
	function is_online(){
		$CI = &get_instance();

		return (($CI->session->userdata("isLogged")==TRUE) && ($CI->session->userdata("idUsuario")!=NULL)) ? TRUE : FALSE;

	} # en if
} # en if

if(!function_exists("getGruposByPlan")){
	function getGruposByPlan($cveMateria,$cvePlan,$idPeriodo){
		$CI = &get_instance();
		$CI->load->model('sa_model');
		switch ($cvePlan) {
			case 4:
				$arrGrupos = array(60,61,62,63,64,66,66,67,68,69); 
				break;
			case 6:
				$arrGrupos = array(50,51,52,53,54,55,56,57,58,59); 
				break;
			case 7:
				$arrGrupos = array(90,91,92,93,94,99,96,97,98,99); 
				break;
			case 13:
				$arrGrupos = array(70,71,72,73,74,77,76,77,78,79); 
				break;
			case 15:
				$arrGrupos = array(80,81,82,83,84,88,86,87,88,89); 
				break;
		}
		$materias = $CI->sa_model->getMateriasByClave($cveMateria); 
		$arrMaterias = array(); 
		if(!is_null($materias)){
			foreach ($materias as $v) {
				$arrMaterias[] = $v->idMateria; 
			}
		} else {
			$arrMaterias = array(0); 
		}
		$grupos = $CI->sa_model->getGruposByIdPeriodo($arrMaterias,$idPeriodo,$arrGrupos); 
		return $grupos;
	} # en if
} # en if


/**
 * @return boolean
 */
if(!function_exists("access_key")){
	function access_key($idUsuario, $idRol,$idRolNecesario){
		$CI = &get_instance();
		$CI->load->model('auth_model');
		
	} # en if
} # en if

/**
* @return boolean
*/

if(!function_exists("execMobile")){
	function execMobile()
	{
		$CI =& get_instance();
		$CI->load->library('mobile_detect_lib');

		$deviceView = new Mobile_detect_lib();

		return ($deviceView->isMobile()) ? TRUE : FALSE;
	}
}
# end if

/**
 * @param tipoUsuario 
 * @param idPermiso
 * @return boolean
 */
if(!function_exists("can_access")){
	function can_access($tipoUsuario, $idPermiso){

		$CI = &get_instance();

		$CI->load->model('auth_model');

		return ($CI->auth_model->can_access( (int) $tipoUsuario, (int) $idPermiso)) ? TRUE : FALSE;

	} # en can_access()

} # en if

/**
 * @param idUser (Cliente)
 * @param idUser (Gestor)
 * @return boolean
 */
if(!function_exists("is_allowed")){

	function is_allowed($id_cliente, $id_consultor)
	{

		$CI =& get_instance();

		$CI->load->model("user_model");

		return ($CI->user_model->have_permission($id_cliente, $id_consultor)) ? TRUE : FALSE;
		
	} # end is_allowed()

} # ends if

/**
 * @param idPeriodo (Periodo actual)
 * @param idPlan (plan de la materia)
 * @param idMateria (Materia)
 * @return object 
 */
if(!function_exists("horariosGet")){

	function horariosGet($idPeriodo, $idPlan, $idMateria)
	{

		$CI =& get_instance();

		$CI->load->model("sa_model");
		$horarios = $CI->sa_model->getHorarioByPeriodoBloquePlan($idPeriodo,$idPlan,$idMateria);
		return $horarios;
		
	} # end horariosGet()

} # ends if




if(!function_exists("safe_string")) 
{
	function safe_string($String)
	{
		$String = str_replace(array('á','à','â','ã','ª','ä'),"a",$String);
	    $String = str_replace(array('Á','À','Â','Ã','Ä'),"A",$String);
	    $String = str_replace(array('Í','Ì','Î','Ï'),"I",$String);
	    $String = str_replace(array('í','ì','î','ï'),"i",$String);
	    $String = str_replace(array('é','è','ê','ë'),"e",$String);
	    $String = str_replace(array('É','È','Ê','Ë'),"E",$String);
	    $String = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$String);
	    $String = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$String);
	    $String = str_replace(array('ú','ù','û','ü'),"u",$String);
	    $String = str_replace(array('Ú','Ù','Û','Ü'),"U",$String);
	    $String = str_replace(array('[','^','´','`','¨','~',']'),"",$String);
	    $String = str_replace("ç","c",$String);
	    $String = str_replace("Ç","C",$String);
	    $String = str_replace("ñ","n",$String);
	    $String = str_replace("Ñ","N",$String);
	    $String = str_replace("Ý","Y",$String);
	    $String = str_replace("ý","y",$String);
	    $String = str_replace(" ","-",$String);
	     
	    $String = str_replace("&aacute;","a",$String);
	    $String = str_replace("&Aacute;","A",$String);
	    $String = str_replace("&eacute;","e",$String);
	    $String = str_replace("&Eacute;","E",$String);
	    $String = str_replace("&iacute;","i",$String);
	    $String = str_replace("&Iacute;","I",$String);
	    $String = str_replace("&oacute;","o",$String);
	    $String = str_replace("&Oacute;","O",$String);
	    $String = str_replace("&uacute;","u",$String);
	    $String = str_replace("&Uacute;","U",$String);
	    
	    $String = str_replace("¡","",$String);
	    $String = str_replace("!","",$String);
	    $String = str_replace("¿","",$String);
	    $String = str_replace("?","",$String);
	    
	    $String = str_replace(",","",$String);
	    $String = str_replace(":","",$String);
	    $String = str_replace(";","",$String);
	    $String = str_replace("(","",$String);
	    $String = str_replace(")","",$String);
	    $String = str_replace("+","",$String);
	    

	    return $String;
	}
}
if (!function_exists('guioner')) {
	// funcion agrega todos espacios
	function guioner($url) {
		//        $cdn = trim($cdn);
		//        $cdn = str_replace(" ", "-", $cdn);
		//        return $cdn;
		if ($url != null) {
			$url = strtolower($url);
			$buscar = array(' ', '&', '+');
			$url = str_replace($buscar, '-', $url);
			$buscar = array('Ã¡', 'Ã©', 'Ã­', 'Ã³', 'Ãº', 'Ã±');
			$remplzr = array('a', 'e', 'i', 'o', 'u', 'n');
			$url = str_replace($buscar, $remplzr, $url);
			$buscar = array('/[^a-z0-9-<>]/', '/[-]+/', '/<[^>]*>/');
			$remplzr = array('', '-', '');
			$url = preg_replace($buscar, $remplzr, $url);
			return $url;
		}
	}
}

if (!function_exists('fancy_date')) {
	function fancy_date($sql_date, $request_type = null)
	{
		$arrMonth = array(				
			'01' => 'Enero', 
			'02' => 'Febrero', 
			'03' => 'Marzo', 
			'04' => 'Abril', 
			'05' => 'Mayo', 
			'06' => 'Junio', 
			'07' => 'Julio', 
			'08' => 'Agosto', 
			'09' => 'Septiembre', 
			'10' => 'Octubre', 
			'11' => 'Noviembre', 
			'12' => 'Diciembre'
		);

		$arrWeek = array(				
			'Mon'  => 'Lunes', 
			'Tue'  => 'Martes', 
			'Wed'  => 'Miercoles', 
			'Thu'  => 'Jueves', 
			'Fri'  => 'Viernes', 
			'Sat'  => 'Sabado', 
			'Sun'  => 'Domingo'
		);
		
		$year = substr($sql_date, 0, 4); 
		$month = substr($sql_date, 5, 2);
		$day = substr($sql_date, 8, 2);
		
		if(checkdate($month, $day, $year)){
			$timestamp = strtotime($sql_date);
			$str_day = date('D', $timestamp);
			$day = (int) $day; 

			switch ($request_type) {
				case 'm-y': //SOLO REGRESAREMOS EL MES Y EL AÑO
					return $arrMonth[$month] . ' de ' . $year;
					break;
				case 'm': //SOLO REGRESAREMOS EL MES Y EL AÑO
					return $arrMonth[$month];
					break;

				case 'd-m-y': //REGRESAREMOS EL DIA, MES Y EL AÑO
					return $day . ' de ' . $arrMonth[$month] . ' de ' . $year;
					break;

				case 'd-m': //REGRESAREMOS EL DIA Y EL MES
					return $day . ' de ' . $arrMonth[$month];
					break;

				case 'w-d-m-y': //REGRESA EL DIA DE LA SEMANA, DIA DEL MES, MES Y AÑO
					return $arrWeek[$str_day] . ' ' . $day . ' de ' . $arrMonth[$month] . ' de  ' . $year;
					break;
				case 'w-d-m': //REGRESA EL DIA DE LA SEMANA, DIA DEL MES, MES Y AÑO
					return $arrWeek[$str_day] . ' ' . $day . ' de ' . $arrMonth[$month];
					break;
				default:
					return $day . ' de ' . $arrMonth[$month] . ' de ' . $year;
					break;

			} # ends switch

		} #ends if 

		else{
			return "El formato de la fecha no corresponde a 'aaaa-mm-dd'";
		} # ends else

	} # ends function

} # ends if

/* End of file app_helper.php */
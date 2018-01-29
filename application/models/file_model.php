<?php
/**
 * @author Melchor Leal
 * @version 2.0.1
 * @copyright Centro de desarrollo FI. Todos los Derechos reservados
*/
if (!defined('BASEPATH')) {
	die();
}
class File_model extends CI_Model {
	private $path;
	private $ftp_root = '/static/';
	function __construct() {
		parent::__construct();
		$this -> path = 'docs/';
		$this -> pathFoto = 'docs/imgs/';
		$this -> load -> library('upload');
		$this->load->library('ftp');
	}
	public function name($filename, $date = false, $random = false, $user_id = null, $custom_text = null) {
		$returningName = '';
		if ($date)
			$returningName .= date('Y-m-d').'-';
		if ($random)
			$returningName .= substr(md5(uniqid(rand(), true)), 0, 5).'-';
		if ($user_id != null)
			$returningName .= $user_id.'-';
		if($custom_text!=null)
			$returningName .= $custom_text;
		if($filename!=false){
			$returningName .= $filename;
		}
		return $returningName;
	}
	public function uploadItem($target, $data = false, $file, $resize = false) {
		/*
		 * target = directorio
		 * data = array ('
		 * 			date'=>true||false,'random'=>true||false,
		 * random => true||false
		 * 		'user_id'=>session user id||null,
		 * 		'width'=>600||null,
		 * 		'height'=>400||null);
		 * file = input que sube
		 * resize = boolean
		 * */
		$ori_name = $_FILES[$file]['name'];
		$config['upload_path'] = $this -> path . $target;

		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|xlsx|pdf|doc|docx';
		// $config['allowed_types'] = '*';
		// $config['encrypt_name'] = 'TRUE';

		$config['max_size']   = '9999';
		$config['max_width']  = '4096';
		$config['max_height'] = '4096';

		$config['file_name'] = $this -> name($ori_name, $data['date'], $data['random'], $data['user_id']);
		$this -> upload -> initialize($config);
		if (!$this -> upload -> do_upload($file)) {
			$error = $this -> upload -> display_errors();
			$nombre = null;
			$return = array();
			$return['nombre'] = null;
			$return['error'] = $error;
			return $return;
		} else {
			$imgData = $this -> upload -> data();
			if ($resize == 10) {
				$this -> resizeImage($imgData['file_name'], $data['width'], $data['height'], $target, $target);
				$preReturningName = explode('.', $imgData['file_name']);
				$extension = end($preReturningName);
				return $imgData['file_name'] . '_thumb' . $extension;
			} else {
				return $imgData['file_name'];
			}
		}
	}
	private function getName($id){
		$pass_chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($pass_chars) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 5; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $pass_chars[$n];
	    }
	    $pass = implode($pass);
	    return $pass.'-'.$id;
	}
	public function uploadImage($target, $data = false, $file, $resize,$id = NULL) {
		/*
		 * target = directorio
		 * data = array ('
		 * 			date'=>true||false,'random'=>true||false,
		 * random => true||false
		 * 		'user_id'=>session user id||null,
		 * 		'width'=>600||null,
		 * 		'height'=>400||null);
		 * file = input que sube
		 * resize = boolean
		 * */

		$ori_name = $_FILES[$file]['name'];
		$config['upload_path'] = $this -> path . $target;
		//die(var_dump($config['upload_path']));
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		// $config['allowed_types'] = '*';
		// $config['encrypt_name'] = 'TRUE';
		if(!is_null($id)){
			$nameImg = $this->getName($id);	
		}else {
			$nameImg = $ori_name;
		}
		
		$config['max_size']   = '9999';
		$config['max_width']  = '4096';
		$config['max_height'] = '4096';
		$config['file_name'] = $this -> name($nameImg, TRUE, $data['random'], $data['user_id']);
		$this -> upload -> initialize($config);
		if (!$this -> upload -> do_upload($file)) {
			$error = $this -> upload -> display_errors();
			$nombre = null;
			$return = array();
			$return['nombre'] = null;
			$return['error'] = $error;
			return $return;
		} else {
			$imgData = $this -> upload -> data();
			if ($resize) {
				$this -> resizeImage($imgData['file_name'], $data['width'], $data['height'], $target, $target);
				$preReturningName = explode('.', $imgData['file_name']);
				$extension = end($preReturningName);
				return $imgData['file_name'] . '_thumb' . $extension;
			} else {
				return $imgData['file_name'];
			}
		}
	}
	public function uploadImageAlumno($target, $data = false, $file, $matricula,$resize) {
		/*
		 * target = directorio
		 * data = array ('
		 * 			date'=>true||false,'random'=>true||false,
		 * random => true||false
		 * 		'user_id'=>session user id||null,
		 * 		'width'=>600||null,
		 * 		'height'=>400||null);
		 * file = input que sube
		 * resize = boolean
		 * */
		$ori_name = $_FILES[$file]['name'];
		$config['upload_path'] = $this -> pathFoto;

		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		// $config['allowed_types'] = '*';
		// $config['encrypt_name'] = 'TRUE';
		$nameImg = $matricula;
		$config['max_size']   = '9999';
		$config['max_width']  = '4096';
		$config['max_height'] = '4096';
		$config['file_name'] = $matricula;
		$config['overwrite'] = TRUE;
		//die(var_dump($ori_name));
		$this -> upload -> initialize($config);
		if (!$this -> upload -> do_upload($file)) {
			$error = $this -> upload -> display_errors();
			$nombre = null;
			$return = array();
			$return['nombre'] = null;
			$return['error'] = $error;
			return $return;
		} else {
			$imgData = $this -> upload -> data();
			if ($resize) {
				$this -> resizeImage($imgData['file_name'], $data['width'], $data['height'], $target, $target);
				$preReturningName = explode('.', $imgData['file_name']);
				$extension = end($preReturningName);
				return $imgData['file_name'] . '_thumb' . $extension;
			} else {
				return $imgData['file_name'];
			}
		}
	}
	public function uploadNonImage($target, $data = false, $file, $nameFile = null) {
		/*
		 * target = directorio
		 * data = array ('
		 	     date'=>true||false,
		 * 		random => true||false
		 * 		'user_id'=>session user id||null,
		 *		'custom_text' = string.
		 *		'or_name' = true||false
		 * )
		 * file = input que sube
		 * */
		if(!is_null($nameFile)){
			$ori_name = $nameFile;
		} else {
			if($data['or_name']){
				$ori_name = $_FILES[$file]['name'];
			}
			else{
				$ori_name = false;
			}	
		}
		
		$config['upload_path'] = $this->path . $target;
		$config['allowed_types'] = '*';
		// $config['allowed_types'] = '*';
		// $config['encrypt_name'] = 'TRUE';
		$config['max_size'] = '9999';
		$config['file_name'] = $this -> name($ori_name, $data['date'], $data['random'], $data['user_id'], $data['custom_text']);
		$this -> upload -> initialize($config);
		if (!$this -> upload -> do_upload($file)) {
			$error = $this -> upload -> display_errors();
			$nombre = null;
			$return = array();
			$return['nombre'] = null;
			$return['error'] = $error;
			return $return;
		} else {
			$fileData = $this -> upload -> data();
			return $fileData['file_name'];
		}
	}
	public function deleteItem($file_name, $folder) {
		if ($file_name !== null) {
			if (@unlink($this -> pagination . $folder . $file_name))
				return true;
			return false;
		} else {
			return false;
		}
	}
	private function resizeImage($imgName, $width, $height, $source, $target) {
		$this -> load -> library('image_lib');
		$config['image_library']  = 'gd2';
		$config['source_image']   = 'docs/userpic/' . $imgName;
		$config['create_thumb']   = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']          = $width;
		$config['height']         = $height;
		$this -> image_lib -> initialize($config);
		if (!$this -> image_lib -> resize())
			return false;
		return true;
	}
	public function uploadify($target,$type,$data) {

		$fileTypes = array();
		switch ($type) {
			case 'doc':
				$fileTypes = array('doc','docx','pdf');
				break;
			case 'image':
				$fileTypes = array('jpg','jpeg','gif','png');
				break;
		}
		if (!empty($_FILES)) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $this->path.$target;
			$name = $_FILES['Filedata']['name'];
			$name = str_replace(' ', '_', $name);
			$name = $this -> name($name, $data['date'], $data['random'], $data['user_id']);
			$targetFile = rtrim($targetPath,'/') . '/' . $name;

			$fileParts = pathinfo($_FILES['Filedata']['name']);

			if (in_array($fileParts['extension'],$fileTypes)) {
				if(move_uploaded_file($tempFile,$targetFile));
					return $name;
				return false;
			}
		}
	}
	function cropImage($arrDimensions, $img, $pathOrImg, $pathThumb){
		$config['image_library'] = 'imagemagick';
		$config['library_path']  = '/usr/bin/';
		$config['source_image']	 = $pathOrImg.$img;
		//$config['new_image'] = $pathOrImg."cropped".$img;
		$config['create_thumb']   = false;
		$config['maintain_ratio'] = false;
		$config['x_axis']         = $arrDimensions['x'];
		$config['y_axis']         = $arrDimensions['y'];
		$config['width']          = $arrDimensions['w'];
		$config['height']         = $arrDimensions['h'];
		$this->image_lib->initialize($config);
		if ( ! $this->image_lib->crop()){
		    die(var_dump($this->image_lib->display_errors()));
		}

		$this->image_lib->clear();
		return $config['source_image'];
	}
	function ftpConnect($task){$this->ftp->{$task}();}
	function renameFile($path,$file,$newName,$ext=null){
		$this->ftpConnect('connect');
		$fileName = file_ext_strip($file);
		$fileExtension = file_ext($file);
		$newName = $newName.'.'.$fileExtension;
		return $this->ftp->rename($this->ftp_root.'docs/'.$path.'/'.$file,$this->ftp_root.'docs/'.$path.'/'.$newName);
		$this->ftpConnect('close');		
	}
}
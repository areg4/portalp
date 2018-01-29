<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */
class Phpexcel_lib
{

	function __construct()
	{
		//define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
		require_once (APPPATH.'libraries/PHPExcel/Classes/PHPExcel/IOFactory.php'); 
		require_once (APPPATH.'libraries/PHPExcel/Classes/PHPExcel.php'); 
		require_once (APPPATH.'libraries/PHPExcel/Classes/PHPExcel/RichText.php'); 
		
	} 

	public function objExcel(){
		$objPHPExcel = new PHPExcel();
		return $objPHPExcel;
	}
	public function readExcel(){
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		return $objReader;
	}
	public function doExcel($obj,$filename){
		// Redirect output to a client’s web browser (Excel2007)
		$objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
		$objWriter->save(str_replace('.php', '.xlsx', __FILE__));	

		$oldDir = FCPATH . 'application/libraries/phpexcel_lib.xlsx';
		$newDir = FCPATH . "docs/sa/".$filename.".xlsx";

		rename($oldDir, $newDir);
		redirect(base_url().'docs/sa/'.$filename.'.xlsx');
		// rename("","../../); 
		/*
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		*/
		
	}

}
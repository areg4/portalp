<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



/**

 * Try increasing memory available, mostly for PDF generation

 */

//ini_set("memory_limit", "512M");



class Dompdf_lib{

    function pdf_create($html, $filename, $stream=TRUE, $orientation="portrait",$path=null) {

       if(is_file(APPPATH."libraries/dompdf/dompdf_config.inc.php")){

            require_once(APPPATH."libraries/dompdf/dompdf_config.inc.php");
            $this->papel = $orientation;
            $dompdf = new DOMPDF();
            $dompdf->set_base_path(APPPATH.'../css/');
            $dompdf->load_html(utf8_decode($html));
            if( $this->papel == 'credencial'){
                $dompdf->set_paper('legal', 'landscape');
                $dompdf->render('legal', 'landscape');
            } else {
                $dompdf->set_paper('letter', 'portrait');
                $dompdf->render('letter', 'portrait');
            }


            if ($stream) {

                    $dompdf->stream($filename.".pdf");


            }

            else {

                    $CI =&get_instance();

                    $CI->load->helper('file');

                    $to_save_path = (!is_null($path))?"./docs/$path/$filename.pdf":"./docs/$filename.pdf";

                    write_file($to_save_path, $dompdf->output());


            }

        }

        else{

                die(';(');

        }

    }

}



?>

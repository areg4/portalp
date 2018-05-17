<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$sys_app_title?></title>
    <link rel="stylesheet" href="<?=base_url()?>static/dist/css/cd-fi-uaq.css">
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?=base_url()?>static/sb/js/bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" href="<?=base_url()?>static/dist/css/bootstrap-toggle.min.css" >
    <!-- MetisMenu CSS -->
    <link href="<?=base_url()?>static/sb/js/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/dist/js/DataTables/datatables.min.css"/>
    <!-- Custom CSS -->
    <link href="<?=base_url()?>static/sb/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?=base_url()?>static/sb/js/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=base_url()?>static/sb/js/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="<?=base_url()?>static/sb/js/jquery/jquery.min.js"></script>
    
    <script type="text/javascript" src="<?=base_url()?>static/dist/js/DataTables/datatables.js"></script>
    <?php 
        if($sys_app_title == 'SECRETARÍA ACADÉMICA'):
    ?>
        <script src="<?=base_url()?>static/dist/js/highcharts/highcharts.js"></script>
        <script src="<?=base_url()?>static/dist/js/highcharts/exporting.js"></script>
    <?php
        endif;
    ?>
    <?php
    if (isset($css)) {
      for ($i = 0; $i < count($css); $i++) {
        echo "\t<link rel=\"stylesheet\" href=\"" . base_url() . "static/dist/css/" . $css[$i] . ".css\">\n";
      }
    }
    ?>
    <?php
    if (isset($js)) {
      for ($i = 0; $i < count($js); $i++) {
        echo "\t<script type=\"text/javascript\" src=\"" . base_url() . "static/dist/js/" . $js[$i] . ".js\"></script>\n";
      }
    }
    ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <div id="page-wrapper" style="min-height: none !important;">
         <?=$fragment?> 
        </div>
        <!-- /#page-wrapper -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error-modal" class="modal fade" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Aviso:</h4>
                </div>
                <div class="modal-body" >
                    <?=$this->lang->line(((isset($error))?($error):(trim($this->session->flashdata('error')))))?>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="col-md-4 menta col-md-offset-4" type="button">Ok</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
      </div>
    </div>
    <!-- /#wrapper -->
    <div id="footer">
    <!-- jQuery -->
    

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url()?>static/sb/js/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=base_url()?>static/sb/js/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?=base_url()?>static/sb/js/raphael/raphael.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url()?>static/dist/js/sb-admin-2.js"></script>
    
        <script src="<?=base_url()?>static/dist/js/custom-cd.js"></script>
    <script src="<?=base_url()?>static/dist/js/bootstrap-toggle.min.js"></script>
    <script src="<?=base_url()?>static/dist/js/bootstrap-checkbox.min.js"></script>
    <script src="<?=base_url()?>static/dist/js/jquery-ui.js"></script>
    <script src="<?=base_url()?>static/dist/js/jquery-ui-timepicker-addon.js"></script>
    
    
    <script type="text/javascript">
    jQuery(document).ready(function($){
        var height = $(window).height();
        height = height - 50; //$(".sidebar-nav").css('height',height+'px');
        <?php if(isset($error) || $this->session->flashdata('error')):?>
        
               $('#error-modal').modal('show');
        <?php endif ?>
    })
    function base_url(){
        var base_url  = "<?=base_url()?>";
        return base_url;
    }
    </script>
    </div>
</body>

</html>





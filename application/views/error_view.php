<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>:( - Portal Informatica</title>
	<link rel="icon" href="<?=base_url()?>static/img/favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" href="<?=base_url()?>static/dist/css/bootstrap.css">
	<link rel="stylesheet" href="<?=base_url()?>static/dist/css/cd-fi-uaq.css">
    <link rel="stylesheet" href="<?=base_url()?>static/dist/css/bootstrap-toggle.min.css">
	<link rel="stylesheet" href="<?=base_url()?>static/dist/css/awesome-bootstrap-checkbox/bower_components/Font-Awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?=base_url()?>static/dist/css/awesome-bootstrap-checkbox/build.css"/>

	<!-- Latest compiled and minified JavaScript -->
	

</head>

<body>
	<nav class="navbar navbar-default navbar-static-top" role="navigation" id="barra-titulo">
     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
       <i class="glyphicon glyphicon-menu-hamburger"></i>
      </button> 
      <div class="titulo">
            <h1>PORTAL INFORMÁTICA</h1>
        </div>
<!-- DATOS DE LOGIN -->
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
    
    </div><!-- /.navbar-collapse -->
  </nav>   
	<div id="contenido" style="width:97%; ">
	  <div class="col-md-12">
        
        <h1 style="font-size: 8em !important; text-align: center !important;" class="text-primary">
            <i class="fa fa-chain-broken"></i>
        </h1>
        <h3 style="font-size: 1.5em !important; text-align: center !important;" class="text-primary">
            Contenido no encontrado
        </h3>
        <h4 class="text-center" style="font-size: 1.2em !important; color: #414243 !important; text-align: center">
            El contenido que buscas no está disponible, prueba regresando a la pagina anterior 
            <a href="javascript:history.back(1)">Regresar</a>
           
        </h4>
    </div>
		
	</div>
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
    <!-- jQuery -->
    <script src="<?=base_url()?>static/dist/js/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url()?>static/dist/js/bootstrap.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url()?>static/dist/js/sb-admin-2.js"></script>
    <script src="<?=base_url()?>static/dist/js/cd-fi-uaq.js"></script>
    <script src="<?=base_url()?>static/dist/js/bootstrap-toggle.min.js"></script>
    <script src="<?=base_url()?>static/dist/js/bootstrap-checkbox.min.js"></script>
    <script src="<?=base_url()?>static/dist/js/custom-cd.js"></script>
    
</body>
</html>
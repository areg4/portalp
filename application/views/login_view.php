<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Portal Facultad de Informática</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>static/imgs/favicon.ico" />
    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url()?>static/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom CSS -->
    <!-- <link href="<?=base_url()?>static/dist/css/login.css" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <!-- <link href="<?=base_url()?>static/dist/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
    <link href="<?=base_url()?>static/dist/css/bootstrapValidator.min.css" rel="stylesheet"></link>
    <link rel="stylesheet" href="<?=base_url()?>static/dist/css/cd-fi-uaq.css">
    <link rel="stylesheet" href="<?=base_url()?>static/dist/font-awesome/css/font-awesome.css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <title>Portal Informática</title>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/login/css/estilo.css">
    <!-- <script type="text/javascript" src="js/funciones.js"></script> -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>
    <!-- <script type="text/javascript" src="fun_tickets.js"></script> -->
<!-- jQuery -->
    <script src="<?=base_url()?>static/dist/js/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url()?>static/dist/js/bootstrap.min.js"></script>



    
</head>

<body >

<header>
    <!-- DATOS DE LOGIN -->
    <div id="barra-titulo">
        <div class="titulo" style="width:100%">
            <h1>PORTAL INFORMÁTICA</h1>
        </div>

    
    </div>
    <div id="barra-subtitulo">
        <div class="app-titulo menta" style="width:100%"><h1>Facultad de Informática</h1></div>
    </div>
</header>

<div class="col-md-12 login" id="login">
    <h1>Iniciar Sesión</h1>
    <div class="col-md-12">
    <form role="form" method="post" action="<?=base_url()?>sesion/login" id="loginForm" class="form">
        
            <div id="login-inputs" >
                <div class="form-group">
                    <input class="form-control" placeholder="Usuario" name="emailUsuario" type="text" autofocus>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Contraseña" name="contrasenaUsuario" type="password">
                </div>
            </div>
                <div class="form-group">    
                    <button class="btn menta mobile-center" type="submit">Iniciar</button>     
                </div> 
       
    </form>
    </div>
   
</div>

<!-- <div class="col-md-12 login" id="login">
    <h1>Aviso de Contraseña</h1>
    <h4 class="text-justify">Por el momento nos encontramos en proceso de renovación del Portal de Informática. Estamos realizando cambios en la arquitectura y funcionalidad
        para brindar un mejor servicio. Como parte de estos cambios, y como medida de seguridad adicional, fue necesario resetear la contraseña de todas las cuentas de usuario,
        por lo cual para poder acceder necesitas ingresar como contraseña tu expediente seguido de un punto. <br> <br>
        Ejemplo <br>
        Expediente: 123456 <br>
        Contraseña: 123456.
    </h3>

</div> -->





 <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error-modal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="myModalLabel" class="modal-title text-center">Aviso</h4>
            </div>
            <div class="modal-body text-center" >
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


    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url()?>static/dist/js/sb-admin-2.js"></script>
    <script src="<?=base_url()?>static/dist/js/bootstrapValidator.min.js"></script> 
    <script type="text/javascript" src="<?=base_url()?>static/dist/js/validator_login.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function($){
        
       

        <?php if(isset($error) || $this->session->flashdata('error')):?>
             $('#error-modal').modal('show');
        <?php endif ?>
    })
    </script>

</html>

<?php

	session_start();

	if (isset($_GET['logout'])) {
		echo "cerraste sesion";
		session_unset(); 
		session_destroy(); 
	}
?>

<!DOCTYPE html>

<html>
<head>
	<title>Portal Informática</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<script type="text/javascript" src="js/funciones.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="fun_tickets.js"></script>


</head>
<body>


<header>
	<!-- DATOS DE LOGIN -->
	<div id="barra-titulo">
		<div class="titulo" style="width:100%">
			<h1>PORTAL INFORMÁTICA</h1>
		</div>

	
	</div>
	<div id="barra-subtitulo">
		<div class="app-titulo menta" style="width:100%"><h1>Administración de Tickets</h1></div>
	</div>
</header>



<div class="login" id="login">
	<h1>Iniciar Sesión</h1>
	<div class="div1"></div>
	<input id="user" type="text" placeholder="Usuario" class="div10" onfocus="restablecer()">
	<div class="div1"></div>

	<div class="break"></div>

	<div class="div1"></div>
	<input id="pass" type="password" placeholder="Contraseña" class="div10" onfocus="restablecer()">
	<div class="div1"></div>

	<div class="break"></div>

	<div class="div1"></div>
	<label class="div10"><input type="checkbox">Mantener Iniciada la Sesión</label>
	<div class="div1"></div>

	<div class="div4"></div>
	<button class="div4 menta" onclick="iniciarSesion()">Iniciar</button>
	<div class="div4"></div>

</div>







</body>
</html>
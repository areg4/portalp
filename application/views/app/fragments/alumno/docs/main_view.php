<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Documento</title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>
<?php 
		if(isset($sac)){
	?>
		<body style="font-family:sans-serif; width:800px;"> 
	<?php 
		} else {
	?>
		<body style="font-family:sans-serif; width:700px;"> 
	<?php 

		}

	?>

	<div class="header" id="header">
	
	<img src="<?=base_url()?>static/img/info_escudo_70.png" style="width:70px; position: absolute; top:10px; left:40px; z-index:0 !important;">
	<?php 
		if(isset($sac)){
	?>
		<img src="<?=base_url()?>static/img/logo.jpg" style="width:100px; position: absolute; top:10px; right:75px; z-index:0 !important;">
	<?php 
		} else {
	?>
		<img src="<?=base_url()?>static/img/uaq_escudo_70.png" style="width:70px; position: absolute; top:10px; right:0px; z-index:0 !important;">
	<?php 

		}

	?>
	
	
	<h2 style="text-align:center;  width:400px; font-size: 16px; position: absolute; top:5px; left:150px; z-index:0 !important;">
		UNIVERSIDAD AUTÓNOMA DE QUERÉTARO <br/> FACULTAD DE INFORMÁTICA
	</h2>
	</div>
	<div class="body" id="body">
		<?=$body?>
	</div>
</body>
</html>
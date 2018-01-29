<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Hola mundo</title>
	<link rel="icon" href="<?=base_url()?>static/img/favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" href="<?=base_url()?>static/dist/css/bootstrap.css">
	<!-- jQuery -->
    <script src="<?=base_url()?>static/dist/js/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url()?>static/dist/js/bootstrap.min.js"></script>
    </head>
	<body>
		<div class="col-md-12">
			<h1 class="text-danger">Hola</h1>
			<form action="#" class="form" method="get">
				<div class="col-md-12">
					<h3>PREGUNTA 1 ¿LOREM IPSUM NO SE QUE?</h3>
					<div class="form-group">
						<label>
							Respuesta 1
							<input type="radio" name="bs-radio-group-1" value="0" class="radio-response">
						</label>
					</div>
					<div class="form-group">
						<label>
							Respuesta 2
							<input type="radio" name="bs-radio-group-1" value="0" class="radio-response">
						</label>
					</div>
					<div class="form-group">
						<label>
							Respuesta 3
							<input type="radio" name="bs-radio-group-1" value="1" class="radio-response">
						</label>
					</div>
				</div>
				<div class="col-md-12">
					<h3>PREGUNTA 2 ¿LOREM IPSUM NO SE QUE?</h3>
					<div class="form-group">
						<label>
							Respuesta 1
							<input type="radio" name="bs-radio-group-2" value="1" class="radio-response">
						</label>
					</div>
					<div class="form-group">
						<label>
							Respuesta 2
							<input type="radio" name="bs-radio-group-2" value="0" class="radio-response">
						</label>
					</div>
					<div class="form-group">
						<label>
							Respuesta 3
							<input type="radio" name="bs-radio-group-2" value="0" class="radio-response">
						</label>
					</div>
				</div>
				<div class="col-md-12">
					<h3>PREGUNTA 3 ¿LOREM IPSUM NO SE QUE?</h3>
					<div class="form-group">
						<label>
							Respuesta 1
							<input type="radio" name="bs-radio-group-3" value="0" class="radio-response">
						</label>
					</div>
					<div class="form-group">
						<label>
							Respuesta 2
							<input type="radio" name="bs-radio-group-3" value="1" class="radio-response">
						</label>
					</div>
					<div class="form-group">
						<label>
							Respuesta 3
							<input type="radio" name="bs-radio-group-3" value="0" class="radio-response">
						</label>
					</div>
				</div>
				<div class="col-md-12">
					<button class="btn btn-primary" type="submit">
						Enviar
					</button>
				</div>	
			</form>
		</div>
		<script src="<?=base_url()?>static/dist/js/checkbox.js"></script>
	</body>
</html>
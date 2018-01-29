$('#add-user-form').bootstrapValidator({
	 message: 'Este valor no es valido',
	 feedbackIcons: {
		 valid: 'fa fa-check ',
		 invalid: 'fa fa-remove',
		 validating: 'fa fa-refresh'
	 },
	 fields: {
		 nombre: {
			 validators: {
				 notEmpty: {
					 message: 'El nombre del usuario es requerido'
				 }
			 }
		 },
		 apellidoPaterno: {
			 validators: {
				 notEmpty: {
					 message: 'El apellido paterno del usuario es requerido'
				 }
			 }
		 },
		 apellidoMaterno: {
			 validators: {
				 notEmpty: {
					 message: 'El apellido materno del usuario es requerido'
				 }
			 }
		 },
		 sexo: {
			 validators: {
				 notEmpty: {
					 message: 'El sexo del usuario es requerido'
				 }
			 }
		 },
		 idRol: {
			 validators: {
				 notEmpty: {
					 message: 'La credencial de acceso es requerida'
				 }
			 }
		 },
		 emailUsuario: {
			 validators: {
				 notEmpty: {
					 message: 'El email del usuario es requerido'
				 }
			 }
		 },
		 usuario: {
			 validators: {
				 notEmpty: {
					 message: 'El alias del usuario es requerido'
				 }
			 }
		 },
		 contrasenaUsuario: {
			 validators: {
				 notEmpty: {
					 message: 'La contraseña es requerida'
				 }
			 }
		 }
	 }
});





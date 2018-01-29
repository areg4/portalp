$('#loginForm').bootstrapValidator({
	 message: 'Este valor no es valido',
	 feedbackIcons: {
		 valid: 'fa fa-check top',
		 invalid: 'fa fa-remove top',
		 validating: 'fa fa-refresh'
	 },
	 fields: {
		 emailUsuario: {
			 validators: {
				 notEmpty: {
					 message: 'El nombre de usuario es requerido'
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
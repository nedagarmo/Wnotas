// Funciones JS del módulo

// Ejecución posterior al "Load" de la página.
$(document).ready(function () {
	$.post( "../core/server.classes/myprofile.c.server.class.php", function(data) {
		var profile = JSON.parse(data);
		$("#myprofile_name").val(profile.nombres);
		$("#myprofile_lastname").val(profile.apellidos);
		$("#myprofile_document").val(profile.documento);
		$("#myprofile_email").val(profile.correo);
		$("#myprofile_password").val(profile.clave);
	});
	
	//Re-load records when user click 'load records' button.
	$('#btn_save_profile').click(function (e) {
		e.preventDefault();
		if($("#myprofile_email").val() != "" && $("#myprofile_password").val() != ""){
			if($("#myprofile_email").val().indexOf('@', 0) == -1 || $("#myprofile_email").val().indexOf('.', 0) == -1){
				alert("El correo no es válido.");
			}else{
				$.post( "../core/server.classes/myprofile.u.server.class.php", $("#frm_myprofile_update").serialize(), function(data) {
					alert("Se han guardado correctamente los datos");
				});
			}
		}else{
			alert("Todos los campos son obligatorios.");
		}
	});
});
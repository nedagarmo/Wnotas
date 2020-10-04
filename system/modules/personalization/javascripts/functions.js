// Funciones JS del módulo

// Ejecución posterior al "Load" de la página.
$(document).ready(function(){
 
	var button = $('#personalization_upload'), interval;
	new AjaxUpload(button,{
		action: '../core/server.classes/personalizations.server.class.php?action=upload',
		name: 'image',
		onSubmit : function(file, ext){
			if(ext === "jpg"){
				// cambiar el texto del boton cuando se selecicione la imagen
				button.text('Subiendo');
				// desabilitar el boton
				this.disable();

				interval = window.setInterval(function(){
					var text = button.text();
					if (text.length < 11){
						button.text(text + '.');
					} else {
						button.text('Subiendo');
					}
				}, 200);
			}else{
				alert("Archivo no válido, sólo se permiten imágenes *.jpg");
				return false;
			}
		},
		onComplete: function(file, response){
			button.text('Subir Fondo');

			window.clearInterval(interval);

			// Habilitar boton otra vez
			this.enable();

			// Añadiendo las imagenes a mi lista

			if($('#personalization_gallery li').length == 0){
				$('#personalization_gallery').html(response).fadeIn("fast");
				$('#personalization_gallery li').eq(0).hide().show("slow");
			}else{
				$('#personalization_gallery').prepend(response);
				$('#personalization_gallery li').eq(0).hide().show("slow");
			}
		}
	});

	// Listar  fondos que hay en mi tabla
	$("#personalization_gallery").load("../core/server.classes/personalizations.server.class.php?action=list");
});

function update_personalization_background(new_background)
{
	$.post( "../core/server.classes/personalizations.server.class.php?action=update", { background: new_background }, function(data) {
		$("#personalization_gallery li").each(function( index ) {
			$(this).css("background","#9AF099");
		});
		$("#"+new_background.replace('.','_')).css("background","#D30707");
		$("#wallpaper").attr("src", "../images/backgrounds/"+new_background);
	});
}
// Funciones JS del módulo

// Ejecución posterior al "Load" de la página.
$(document).ready(function () {

	$('#notes_table_container').jtable({
		title: 'Notas del Estudiante',
		paging: true,
		pageSize: 10,
		sorting: true,
		defaultSorting: 'usuario ASC',
		actions: {
			listAction: '../core/server.classes/notes.server.class.php?action=search',
			deleteAction: '../core/server.classes/notes.server.class.php?action=delete',
			updateAction: '../core/server.classes/notes.server.class.php?action=update',
			createAction: '../core/server.classes/notes.server.class.php?action=create'
		},
		fields: {
			id: {
				key: true,
				create: false,
				edit: false,
				list: false
			},
			materia: {
				title: 'Materia',
				options: function (data) {
					//This code runs when user opens edit/create form or changes continental combobox on an edit/create form.
					//data.source == 'edit' || data.source == 'create'
					if(data.source == 'edit' || data.source == 'create'){	
						data.clearCache();
					}
					return '../core/server.classes/drop.down.lists/ddlsubjects.server.class.php';
				},
				inputClass: 'validate[required]'
			},
			grupo: {
				title: 'Grupo',
				dependsOn: 'materia', //jTable builds cascade dropdowns!
				options: function (data) {
					//This code runs when user opens edit/create form or changes continental combobox on an edit/create form.
					//data.source == 'edit' || data.source == 'create'
					if(data.source == 'edit' || data.source == 'create'){	
						data.clearCache();
					}
					return '../core/server.classes/drop.down.lists/ddlgroups.server.class.php?subject=' + data.dependedValues.materia;
				},
				
				inputClass: 'validate[required]',
				list: false
			},
			usuario: {
				title: 'Estudiante',
				dependsOn: 'grupo', //jTable builds cascade dropdowns!
				options: function (data) {
					//This code runs when user opens edit/create form or changes continental combobox on an edit/create form.
					//data.source == 'edit' || data.source == 'create'
					if(data.source == 'edit' || data.source == 'create'){	
						data.clearCache();
					}
					return '../core/server.classes/drop.down.lists/ddlusers.server.class.php?registered=true&students=true&group=' + data.dependedValues.grupo;
				},
				
				inputClass: 'validate[required]'
			},
			tipo_nota: {
				title: 'Tipo Nota',
				options: function (data) {
					//This code runs when user opens edit/create form or changes continental combobox on an edit/create form.
					//data.source == 'edit' || data.source == 'create'
					if(data.source == 'edit' || data.source == 'create'){	
						data.clearCache();
					}
					return '../core/server.classes/drop.down.lists/ddltype_notes.server.class.php';
				},
				inputClass: 'validate[required]'
			},
			nota: {
				title: 'Nota',
				inputClass: 'validate[required]'
			},
			equivalencia: {
				title: 'Equivalencia',
				inputClass: 'validate[required, custom[onlyNumberSp]]'
			}
		},
		//Initialize validation logic when a form is created
		formCreated: function (event, data) {
			data.form.validationEngine();
		},
		//Validate form when it is being submitted
		formSubmitting: function (event, data) {
			return data.form.validationEngine('validate');
		},
		//Dispose validation logic when form is closed
		formClosed: function (event, data) {
			data.form.validationEngine('hide');
			data.form.validationEngine('detach');
		}
	});

	//Re-load records when user click 'load records' button.
	$('#search_notes_records').click(function (e) {
		e.preventDefault();
		$('#notes_table_container').jtable('load', {
			name: $('#name_notes').val(),
			group: $('#group_notes').val()
		});
	});

	//Load all records when page is first shown
	$('#search_notes_records').click();
	
	/*
	Subir archivo de notas
	---------------------------------------------------------------------------------------*/
	
	var button = $('#notes_upload'), interval;
	new AjaxUpload(button,{
		action: '../core/server.classes/notes.file.server.class.php?action=process',
		name: 'file_notes',
		onSubmit : function(file, ext){
			if(ext === "csv"){
				// cambiar el texto del boton cuando se selecicione la imagen
				button.html('<img src="../images/general/btn_csv.png" border="0" width="40" /><p>Subiendo<p>');
				// desabilitar el boton
				this.disable();

				interval = window.setInterval(function(){
					var text = button.text();
					if (text.length < 11){
						button.text(text + '.');
					} else {
						button.html('<img src="../images/general/btn_csv.png" border="0" width="40" /><p>Procesando Archivo...<p>');
					}
				}, 200);
			}else{
				alert("Archivo no válido, sólo se permiten archivos *.csv");
				return false;
			}
		},
		onComplete: function(file, response){
			button.html('<img src="../images/general/btn_csv.png" border="0" width="40" /><p>Procesar Archivo de Notas<p>');
			window.clearInterval(interval);
			alert(response);

			// Habilitar boton otra vez
			this.enable();
		}
	});
});

// Funciones JS del módulo

// Ejecución posterior al "Load" de la página.
$(document).ready(function(){
 
	
});
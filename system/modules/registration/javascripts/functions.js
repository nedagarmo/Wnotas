// Funciones JS del módulo

// Ejecución posterior al "Load" de la página.
$(document).ready(function () {

	$('#registration_table_container').jtable({
		title: 'Materias Inscritas por Usuarios',
		paging: true,
		pageSize: 10,
		sorting: true,
		defaultSorting: 'usuario ASC',
		actions: {
			listAction: '../core/server.classes/registrations.server.class.php?action=search',
			deleteAction: '../core/server.classes/registrations.server.class.php?action=delete',
			updateAction: '../core/server.classes/registrations.server.class.php?action=update',
			createAction: '../core/server.classes/registrations.server.class.php?action=create'
		},
		fields: {
			id: {
				key: true,
				create: false,
				edit: false,
				list: false
			},
			usuario: {
				title: 'Usuario',
				options: function (data) {
					//This code runs when user opens edit/create form or changes continental combobox on an edit/create form.
					//data.source == 'edit' || data.source == 'create'
					if(data.source == 'edit' || data.source == 'create'){	
						data.clearCache();
					}
					return '../core/server.classes/drop.down.lists/ddlusers.server.class.php?registered=true';
				},
				inputClass: 'validate[required]'
			},
			carrera: {
				title: 'Carrera',
				dependsOn: 'usuario', //jTable builds cascade dropdowns!
				options: function (data) {
					//This code runs when user opens edit/create form or changes continental combobox on an edit/create form.
					//data.source == 'edit' || data.source == 'create'
					if(data.source == 'edit' || data.source == 'create'){	
						data.clearCache();
					}
					return '../core/server.classes/drop.down.lists/ddlcareers.server.class.php?user=' + data.dependedValues.usuario;
				},
				inputClass: 'validate[required]'
			},
			semestre: {
				title: 'Semestre',
				dependsOn: 'carrera', //jTable builds cascade dropdowns!
				options: function (data) {
					//This code runs when user opens edit/create form or changes continental combobox on an edit/create form.
					//data.source == 'edit' || data.source == 'create'
					if(data.source == 'edit' || data.source == 'create'){	
						data.clearCache();
					}
					return '../core/server.classes/drop.down.lists/ddlsemesters.server.class.php?career=' + data.dependedValues.carrera;
				},
				inputClass: 'validate[required]'
			},
			materia: {
				title: 'Materia',
				dependsOn: 'carrera,semestre', //jTable builds cascade dropdowns!
				options: function (data) {
					//This code runs when user opens edit/create form or changes continental combobox on an edit/create form.
					//data.source == 'edit' || data.source == 'create'
					if(data.source == 'edit' || data.source == 'create'){	
						data.clearCache();
					}
					return '../core/server.classes/drop.down.lists/ddlsubjects.server.class.php?career=' + data.dependedValues.carrera + '&semester=' + data.dependedValues.semestre;
				},
				inputClass: 'validate[required]'
			},
			grupo: {
				title: 'Grupo',
				dependsOn: 'carrera,semestre,materia',
				options: function (data) {
					//This code runs when user opens edit/create form or changes continental combobox on an edit/create form.
					//data.source == 'edit' || data.source == 'create'
					if(data.source == 'edit' || data.source == 'create'){	
						data.clearCache();
					}
					return '../core/server.classes/drop.down.lists/ddlgroups.server.class.php?career=' + data.dependedValues.carrera + '&semester=' + data.dependedValues.semestre + '&subject=' + data.dependedValues.materia;
				},
				inputClass: 'validate[required]'
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
	$('#search_registration_records').click(function (e) {
		e.preventDefault();
		$('#registration_table_container').jtable('load', {
			user: $('#name_registration').val(),
			group: $('#group_registration').val()
		});
	});

	//Load all records when page is first shown
	$('#search_registration_records').click();
});
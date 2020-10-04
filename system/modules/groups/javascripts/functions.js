// Funciones JS del módulo

// Ejecución posterior al "Load" de la página.
$(document).ready(function () {

	$('#groups_table_container').jtable({
		title: 'Lista de Grupos de la Universidad',
		paging: true,
		pageSize: 10,
		sorting: true,
		defaultSorting: 'nombre ASC',
		actions: {
			listAction: '../core/server.classes/groups.server.class.php?action=search',
			deleteAction: '../core/server.classes/groups.server.class.php?action=delete',
			updateAction: '../core/server.classes/groups.server.class.php?action=update',
			createAction: '../core/server.classes/groups.server.class.php?action=create'
		},
		fields: {
			id: {
				key: true,
				create: false,
				edit: false,
				list: false
			},
			nombre: {
				title: 'Nombre',
				inputClass: 'validate[required]'
			},
			descripcion: {
				title: 'Descripción',
				inputClass: 'validate[required]',
				type: 'textarea'
			},
			inicio: {
				title: 'Fecha de Inicio',
				inputClass: 'validate[required]',
				type: 'date'
			},
			fin: {
				title: 'Fecha de Finalización',
				inputClass: 'validate[required]',
				type: 'date'
			},
			carrera: {
				title: 'Carrera',
				options: function (data) {
					//This code runs when user opens edit/create form or changes continental combobox on an edit/create form.
					//data.source == 'edit' || data.source == 'create'
					if(data.source == 'edit' || data.source == 'create'){	
						data.clearCache();
					}
					return '../core/server.classes/drop.down.lists/ddlcareers.server.class.php';
				},
				inputClass: 'validate[required]',
				//edit: false,
				list: false
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
				inputClass: 'validate[required]',
				//edit: false,
				list: false
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
				// edit: false
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
	$('#search_groups_records').click(function (e) {
		e.preventDefault();
		$('#groups_table_container').jtable('load', {
			name: $('#groups_name').val()
		});
	});

	//Load all records when page is first shown
	$('#search_groups_records').click();
});
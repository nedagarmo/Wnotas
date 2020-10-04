// Funciones JS del módulo

// Ejecución posterior al "Load" de la página.
$(document).ready(function () {

	$('#associates_table_container').jtable({
		title: 'Carreras - Semestres - Materias',
		paging: true,
		pageSize: 10,
		sorting: true,
		defaultSorting: 'carrera ASC',
		actions: {
			listAction: '../core/server.classes/associates.server.class.php?action=search',
			deleteAction: '../core/server.classes/associates.server.class.php?action=delete',
			updateAction: '../core/server.classes/associates.server.class.php?action=update',
			createAction: '../core/server.classes/associates.server.class.php?action=create'
		},
		fields: {
			id: {
				key: true,
				create: false,
				edit: false,
				list: false
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
				inputClass: 'validate[required]'
			},
			semestre: {
				title: 'Semestre',
				options: function (data) {
					//This code runs when user opens edit/create form or changes continental combobox on an edit/create form.
					//data.source == 'edit' || data.source == 'create'
					if(data.source == 'edit' || data.source == 'create'){	
						data.clearCache();
					}
					return '../core/server.classes/drop.down.lists/ddlsemesters.server.class.php';
				},
				inputClass: 'validate[required]'
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
	$('#search_associates_records').click(function (e) {
		e.preventDefault();
		$('#associates_table_container').jtable('load', {
			career: $('#career_associates').val()
		});
	});

	//Load all records when page is first shown
	$('#search_associates_records').click();
});
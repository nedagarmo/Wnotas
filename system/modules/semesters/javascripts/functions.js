// Funciones JS del módulo

// Ejecución posterior al "Load" de la página.
$(document).ready(function () {

	$('#semesters_table_container').jtable({
		title: 'Semestres',
		paging: true,
		pageSize: 10,
		sorting: true,
		defaultSorting: 'id ASC',
		actions: {
			listAction: '../core/server.classes/semesters.server.class.php?action=search',
			deleteAction: '../core/server.classes/semesters.server.class.php?action=delete',
			updateAction: '../core/server.classes/semesters.server.class.php?action=update',
			createAction: '../core/server.classes/semesters.server.class.php?action=create'
		},
		fields: {
			id: {
				key: true,
				create: false,
				edit: false,
				list: false
			},
			sigla: {
				title: 'Sigla',
				inputClass: 'validate[required]'
			},
			nombre: {
				title: 'Nombre',
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
	$('#search_semesters_records').click(function (e) {
		e.preventDefault();
		$('#semesters_table_container').jtable('load', {
			name: $('#name_semesters').val()
		});
	});

	//Load all records when page is first shown
	$('#search_semesters_records').click();
});
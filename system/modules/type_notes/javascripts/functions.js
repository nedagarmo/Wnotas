// Funciones JS del módulo

// Ejecución posterior al "Load" de la página.
$(document).ready(function () {

	$('#type_notes_table_container').jtable({
		title: 'Lista de Tipos de Notas',
		paging: true,
		pageSize: 10,
		sorting: true,
		defaultSorting: 'id ASC',
		actions: {
			listAction: '../core/server.classes/type_notes.server.class.php?action=search',
			deleteAction: '../core/server.classes/type_notes.server.class.php?action=delete',
			updateAction: '../core/server.classes/type_notes.server.class.php?action=update',
			createAction: '../core/server.classes/type_notes.server.class.php?action=create'
		},
		fields: {
			id: {
				title: 'Id',
				key: true,
				create: false,
				edit: false,
				list: true
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
	$('#search_type_notes_records').click(function (e) {
		e.preventDefault();
		$('#type_notes_table_container').jtable('load', {
			name: $('#name_type_notes').val()
		});
	});

	//Load all records when page is first shown
	$('#search_type_notes_records').click();
});
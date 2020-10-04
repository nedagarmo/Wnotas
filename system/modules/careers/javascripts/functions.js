// Funciones JS del módulo

// Ejecución posterior al "Load" de la página.
$(document).ready(function () {

	$('#careers_table_container').jtable({
		title: 'Lista de Carreras de la Universidad',
		paging: true,
		pageSize: 10,
		sorting: true,
		defaultSorting: 'sigla ASC',
		actions: {
			listAction: '../core/server.classes/careers.server.class.php?action=search',
			deleteAction: '../core/server.classes/careers.server.class.php?action=delete',
			updateAction: '../core/server.classes/careers.server.class.php?action=update',
			createAction: '../core/server.classes/careers.server.class.php?action=create'
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
			},
			descripcion: {
				title: 'Descripcion',
				inputClass: 'validate[required]',
				type: 'textarea'
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
	$('#careers_search_records').click(function (e) {
		e.preventDefault();
		$('#careers_table_container').jtable('load', {
			name: $('#careers_name').val()
		});
	});

	//Load all records when page is first shown
	$('#careers_search_records').click();
});
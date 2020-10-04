// Funciones JS del módulo

// Ejecución posterior al "Load" de la página.
$(document).ready(function () {

	$('#mygroups_table_container').jtable({
		title: 'Mi Lista de Grupos',
		paging: true,
		pageSize: 10,
		sorting: true,
		defaultSorting: 'nombre ASC',
		actions: {
			listAction: '../core/server.classes/groups.server.class.php?action=search&profile=true'
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
				title: 'Descripcion',
				inputClass: 'validate[required]',
				type: 'textarea'
			},
			reporte_notas: {
                title: 'Notas',
                display: function(data) {
                     return '<a href="../core/service.classes/notes.group.grid.service.class.php?group=' + data.record.id + '" title="Ver notas de los integrantes del grupo">Formato 1</a> | <a href="../core/service.classes/notes.group.service.class.php?group=' + data.record.id + '" title="Ver notas de los integrantes del grupo">Formato 2</a> ';
                }
            },
			reporte_alumnos: {
                title: 'Lista Integrantes',
                display: function(data) {
                     return '<a href="../core/service.classes/participants.group.service.class.php?group=' + data.record.id + '" title="Ver lista de los integrantes del grupo">Ver Lista</a> ';
                }
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
	$('#search_mygroups_records').click(function (e) {
		e.preventDefault();
		$('#mygroups_table_container').jtable('load', {
			name: $('#mygroups_name').val()
		});
	});

	//Load all records when page is first shown
	$('#search_mygroups_records').click();
});
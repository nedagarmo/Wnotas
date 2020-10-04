// Funciones JavaScript Del Módulo

$.getJSON('../core/server.classes/history.server.class.php', function(data) {
    var table = '<table class="hi_table_worked jtable" style="width: 100%;">';
    table += '<thead><tr><th>Materia</th><th>Tipo de Nota</th><th>Nota</th></tr></thead><tbody>';
    /* loop over each object in the array to create rows*/
    $.each( data, function( index, item){
        /* add to html string started above*/
        table += '<tr><td>' + item.n_materia + '</td><td>' + item.n_tipo_nota + '</td><td>' + item.nota + '</td></tr>';       
    });
    table += '</tbody></table>';
    
    /* insert the html string*/
    $("#history_table_container").html( table );
    
    apply_style_tables();
    
});
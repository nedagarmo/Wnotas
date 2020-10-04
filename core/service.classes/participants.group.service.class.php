<?php

/**
 * Clase de servidor que ejecuta operaciones crud sobre la tabla.
 *
 * @author Nelson D. Garzón M.
 */
 
session_start();
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../data.access.objects/users.dao.class.php');
include_once(dirname(__FILE__) . '/../data.access.objects/groups.dao.class.php');

$dao = new users();
$dao_group = new groups();

$results_group = $dao_group->get_group_by_id($group);
$results = $dao->get_all_users_list_by_group($group);

// esto le indica al navegador que muestre el diálogo de descarga aún sin haber descargado todo el contenido 
header("Content-type: application/octet-stream");
//indicamos al navegador que se está devolviendo un archivo
header("Content-Disposition: attachment; filename=lista.csv");
//con esto evitamos que el navegador lo grabe en su caché
header("Pragma: no-cache");
header("Expires: 0");

echo "Nombre;Documento;Grupo;30;30;40\n";
if(!$results->EOF){
	echo $results->fields[1].";".$results->fields[2].";".$results_group->fields[1].";;;";
	$results->MoveNext();
}
	
?>
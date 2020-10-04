<?php

/**
 * Clase de servidor que consulta el histórico de notas de un usuario.
 *
 * @author Nelson D. Garzón M.
 */
 
session_start(); 
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../data.access.objects/notes.dao.class.php');

$dao = new notes();
$result = $dao->get_notes_by_user($_SESSION['id']);

$rows = array();
while (!$result->EOF){				
	$rows[] = $result->fields;
	$result->MoveNext();
}

print json_encode($rows);

?>
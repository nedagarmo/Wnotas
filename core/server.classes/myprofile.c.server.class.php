<?php

/**
 * Clase de servidor que ejecuta operaciones crud sobre la tabla.
 *
 * @author Nelson D. Garzón M.
 */

session_start();
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../data.access.objects/users.dao.class.php');

$dao = new users();		
$result = $dao->get_user_profile($_SESSION['id']);
$row = $result->fields;
echo json_encode($row);

?>
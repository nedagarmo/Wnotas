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
$result = $dao->update_user_profile($_SESSION['id'], $myprofile_email, $myprofile_password);
echo $result;

?>
<?php

/**
 * Clase de servidor que devuelve una lista de datos para alimentar un control dropdownlist
 *
 * @author Nelson D. Garzón M.
 */

session_start();
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../../data.access.objects/careers.dao.class.php');

$dao = new careers();

if(isset($user)){
	$result = $dao->get_all_careers_list_by_user($user);
}else{
	$result = $dao->get_all_careers_list();
}

if($result != null){
	$rows = array();
	$counter = 0;
	while (!$result->EOF){				
		$rows[$counter]['DisplayText'] = $result->fields[1];
		$rows[$counter]['Value'] = $result->fields[0] + 0;
		$counter ++;
		$result->MoveNext();
	}
	$jtable_result['Result'] = "OK";
	$jtable_result['Options'] = $rows;
}else{
	$jtable_result['Result'] = "ERROR";
	$jtable_result['Message'] = "No se encontraron datos en el sistema.";
}

print json_encode($jtable_result);
?>

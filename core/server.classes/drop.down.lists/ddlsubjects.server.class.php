<?php

/**
 * Clase de servidor que devuelve una lista de datos para alimentar un control dropdownlist
 *
 * @author Nelson D. Garzón M.
 */

session_start();
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../../data.access.objects/subjects.dao.class.php');

$dao = new subjects();
if($_SESSION['role'] == 1){
	if(isset($semester) && isset($career)){
		$result = $dao->get_all_subjects_list_by_semester($career, $semester);
	}else{
		$result = $dao->get_all_subjects_list();
	}
}else if($_SESSION['role'] == 2){
	$result = $dao->get_all_subjects_list_by_session($_SESSION['id']);
} else if($_SESSION['role'] == 3){
	if(isset($semester) && isset($career)){
		$result = $dao->get_all_subjects_list_by_semester($career, $semester);
	}else{
		$result = $dao->get_all_subjects_list();
	}
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

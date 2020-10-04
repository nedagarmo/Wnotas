<?php

/**
 * Clase de servidor que devuelve una lista de datos para alimentar un control dropdownlist
 *
 * @author Nelson D. Garzón M.
 */

session_start();
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../../data.access.objects/groups.dao.class.php');
include_once(dirname(__FILE__) . '/../../data.access.objects/associates.dao.class.php');

$dao = new groups();
$dao_aux = new associates();

if(isset($career) && isset($semester) && isset($subject)){
	$carrera_semetre_materia = $dao_aux->getId($career, $semester, $subject);
	$result = $dao->get_all_groups_list_by_csm($carrera_semetre_materia);
}else if(isset($subject)){
	$result = $dao->get_all_groups_list_by_subject($subject, $_SESSION['id']);
}else{
	$result = $dao->get_all_groups_list();
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

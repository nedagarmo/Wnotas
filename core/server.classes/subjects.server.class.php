<?php

/**
 * Clase de servidor que ejecuta operaciones crud sobre la tabla.
 *
 * @author Nelson D. Garzón M.
 */

extract($_REQUEST);
include_once(dirname(__FILE__) . '/../data.access.objects/subjects.dao.class.php');

$dao = new subjects();
$jtable_result = array();

switch($action){
	case "create":
		$result = $dao->insert_subject($nombre, $descripcion);
		if($result){
			$jtable_result['Result'] = "OK";
			$jtable_result['Record'] = $dao->get_subject($nombre)->fields;
		} else {
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "No se guardaron los datos en el sistema. ".print_r($result);
		}
		break;
	case "update":
		$result = $dao->update_subject($id, $nombre, $descripcion);
		if($result){
			$jtable_result['Result'] = "OK";
		} else {
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "No se guardaron los datos en el sistema.";
		}
		break;
	case "delete":
		$result = $dao->delete_subject($id);
		if($result){
			$jtable_result['Result'] = "OK";
		} else {
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "No se pudo eliminar el registro del sistema.";
		}
		break;
	case "search":
		if(empty($name)){
			$result = $dao->get_all_subjects($jtSorting, $jtStartIndex, $jtPageSize);
		}else{
			$result = $dao->get_subject_search($name, $jtSorting, $jtStartIndex, $jtPageSize);
		}

		if($result != null){
			$rows = array();
			while (!$result->EOF){				
				$rows[] = $result->fields;
				$result->MoveNext();
			}
			$jtable_result['Result'] = "OK";
			$jtable_result['Records'] = $rows;
			$jtable_result['TotalRecordCount'] = $dao->get_all_count_subjects()->fields[0];	
		}else{
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "No se encontraron datos en el sistema.";
		}
		break;
	default:
		$jtable_result['Result'] = "ERROR";
		$jtable_result['Message'] = "El sistema ha identificado un error en los parametros. Utilice la interfaz desarrollada para usted.";
		break;
}

print json_encode($jtable_result);

?>

<?php

/**
 * Clase de servidor que ejecuta operaciones crud sobre la tabla.
 *
 * @author Nelson D. Garzón M.
 */
 
session_start();
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../data.access.objects/groups.dao.class.php');
include_once(dirname(__FILE__) . '/../data.access.objects/associates.dao.class.php');

$dao = new groups();
$dao_aux = new associates();
$jtable_result = array();

if(isset($carrera) && isset($semestre) && isset($materia)){
	$carrera_semetre_materia = $dao_aux->getId($carrera, $semestre, $materia);
}

switch($action){
	case "create":
		$result = $dao->insert_groups($nombre, $descripcion, $inicio, $fin, $carrera_semetre_materia);
		if($result){
			$jtable_result['Result'] = "OK";
			$jtable_result['Record'] = $dao->get_groups($nombre)->fields;
		} else {
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "No se guardaron los datos en el sistema.";
		}
		break;
	case "update":
		$result = $dao->update_groups($id, $nombre, $descripcion, $inicio, $fin, $carrera_semetre_materia);
		if($result){
			$jtable_result['Result'] = "OK";
		} else {
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "No se guardaron los datos en el sistema.";
		}
		break;
	case "delete":
		$result = $dao->delete_groups($id);
		if($result){
			$jtable_result['Result'] = "OK";
		} else {
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "No se pudo eliminar el registro del sistema.";
		}
		break;
	case "search":
		if(!isset($profile)){
			if(empty($name)){
				$result = $dao->get_all_groups($jtSorting, $jtStartIndex, $jtPageSize);
			}else{
				$result = $dao->get_groups_search($name, $jtSorting, $jtStartIndex, $jtPageSize);
			}
		}else{
			if(empty($name)){
				$result = $dao->get_all_groups_by_user($jtSorting, $jtStartIndex, $jtPageSize, $_SESSION['id']);
			}else{
				$result = $dao->get_groups_by_user_search($name, $jtSorting, $jtStartIndex, $jtPageSize, $_SESSION['id']);
			}
		}

		if($result != null){
			$rows = array();
			while (!$result->EOF){				
				$rows[] = $result->fields;
				$result->MoveNext();
			}
			$jtable_result['Result'] = "OK";
			$jtable_result['Records'] = $rows;
			$jtable_result['TotalRecordCount'] = $dao->get_all_count_groups()->fields[0];	
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
<?php

/**
 * Clase de servidor que ejecuta operaciones crud sobre la tabla.
 *
 * @author Nelson D. Garzón M.
 */

session_start();
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../data.access.objects/registrations.dao.class.php');
include_once(dirname(__FILE__) . '/../data.access.objects/associates.dao.class.php');

$dao = new registrations();
$dao_aux = new associates();
$jtable_result = array();

if(isset($carrera) && isset($semestre) && isset($materia)){
	$carrera_semetre_materia = $dao_aux->getId($carrera, $semestre, $materia);
}

switch($action){
	case "create":
		if($dao->get_registration($usuario, $grupo, $carrera_semetre_materia)->fields == false){
			$result = $dao->insert_registration($grupo, $carrera_semetre_materia, $usuario);
			if($result){
				$jtable_result['Result'] = "OK";
				$jtable_result['Record'] = $dao->get_registration($usuario, $grupo, $carrera_semetre_materia)->fields;
			} else {
				$jtable_result['Result'] = "ERROR";
				$jtable_result['Message'] = "No se guardaron los datos en el sistema.";
			}
		} else {
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "No se guardaron los datos en el sistema.  Ya hay un registro con estos mismos datos.";
		}
		break;
	case "update":
		$result = $dao->update_registration($id, $grupo, $carrera_semetre_materia, $usuario);
		if($result){
			$jtable_result['Result'] = "OK";
		} else {
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "No se guardaron los datos en el sistema.";
		}
		break;
	case "delete":
		$result = $dao->delete_registration($id);
		if($result){
			$jtable_result['Result'] = "OK";
		} else {
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "No se pudo eliminar el registro del sistema.";
		}
		break;
	case "search":
		if(empty($group) && empty($user)){
			if($_SESSION['role'] == 3){
				$result = $dao->get_all_registrations_by_student($_SESSION['id'],$jtSorting, $jtStartIndex, $jtPageSize);
			} else {
				$result = $dao->get_all_registrations($jtSorting, $jtStartIndex, $jtPageSize);
			}
		}else{
			$result = $dao->get_registration_search($user, $group, $jtSorting, $jtStartIndex, $jtPageSize);
		}

		if($result != null){
			$rows = array();
			while (!$result->EOF){				
				$rows[] = $result->fields;
				$result->MoveNext();
			}
			$jtable_result['Result'] = "OK";
			$jtable_result['Records'] = $rows;
			$jtable_result['TotalRecordCount'] = $dao->get_all_count_registrations()->fields[0];	
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
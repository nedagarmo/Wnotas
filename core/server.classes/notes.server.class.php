<?php

/**
 * Clase de servidor que ejecuta operaciones crud sobre la tabla.
 *
 * @author Nelson D. Garzón M.
 */
 
session_start();
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../service.classes/global.vars.service.class.php');
include_once(dirname(__FILE__) . '/../data.access.objects/notes.dao.class.php');

$dao = new notes();
$jtable_result = array();

switch($action){
	case "create":
		if($nota <= $nota_maxima){
			if($dao->validate_equivalence($usuario, $materia, $tipo_nota, $nota, $equivalencia, false, 0)){
				$result = $dao->insert_note($usuario, $materia, $tipo_nota, $nota, $equivalencia);
				if($result){
					$jtable_result['Result'] = "OK";
					$jtable_result['Record'] = $dao->get_note($usuario, $materia, $tipo_nota, $nota, $equivalencia)->fields;
				} else {
					$jtable_result['Result'] = "ERROR";
					$jtable_result['Message'] = "No se guardaron los datos en el sistema.";
				}
			}else{
				$jtable_result['Result'] = "ERROR";
				$jtable_result['Message'] = "El valor de la equivalencia no es correcto, pues, debe sumar con las otras notas hasta un 100%.";
			}
		}else{
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "La nota debe ser menor o igual a ".$nota_maxima;
		}
		break;
	case "update":
		if($nota <= $nota_maxima){
			if($dao->validate_equivalence($usuario, $materia, $tipo_nota, $nota, $equivalencia, true, $id)){
				$result = $dao->update_note($id, $usuario, $materia, $tipo_nota, $nota, $equivalencia);
				if($result){
					$jtable_result['Result'] = "OK";
				} else {
					$jtable_result['Result'] = "ERROR";
					$jtable_result['Message'] = "No se guardaron los datos en el sistema.";
				}
			}else{
				$jtable_result['Result'] = "ERROR";
				$jtable_result['Message'] = "El valor de la equivalencia no es correcto, pues, debe sumar con las otras notas hasta un 100%.";
			}
		}else{
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "La nota debe ser menor o igual a ".$nota_maxima;
		}
		break;
	case "delete":
		$result = $dao->delete_note($id);
		if($result){
			$jtable_result['Result'] = "OK";
		} else {
			$jtable_result['Result'] = "ERROR";
			$jtable_result['Message'] = "No se pudo eliminar el registro del sistema.";
		}
		break;
	case "search":
		if(empty($name)){
			if($_SESSION['role'] == 2){
				$result = $dao->get_all_notes_by_teacher($_SESSION['id'], $group, $jtSorting, $jtStartIndex, $jtPageSize);
			}else{
				$result = $dao->get_all_notes($group, $jtSorting, $jtStartIndex, $jtPageSize);
			}
		}else{
			if($_SESSION['role'] == 2){
				$result = $dao->get_note_search_by_teacher($_SESSION['id'], $group, $name, $jtSorting, $jtStartIndex, $jtPageSize);
			}else{
				$result = $dao->get_note_search($group, $name, $jtSorting, $jtStartIndex, $jtPageSize);
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
			$jtable_result['TotalRecordCount'] = $dao->get_all_count_notes()->fields[0];	
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
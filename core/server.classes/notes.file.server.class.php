<?php

/**
 * Clase de servidor que ejecuta una carga masiva de notas.
 *
 * @author Nelson D. Garzón M.
 */
 
session_start();
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../service.classes/global.vars.service.class.php');
include_once(dirname(__FILE__) . '/../data.access.objects/users.dao.class.php');
include_once(dirname(__FILE__) . '/../data.access.objects/subjects.dao.class.php');
include_once(dirname(__FILE__) . '/../data.access.objects/notes.dao.class.php');

$directorio = dirname(__FILE__)."/../../system/uploads/";

$dao = new notes();
$dao_users = new users();
$dao_subjets = new subjects();

$all_data = array();

if($action == 'process')
{
    if(isset($_FILES['file_notes'])){
 
        $name = time();
        $temp   = $_FILES['file_notes']['tmp_name'];
 
        // subir archivo al servidor
        move_uploaded_file($temp, $directorio.$name);
		
		/*
		Procesar el archivo de notas
		--------------------------------------------------------------------------*/
		$fp = fopen ( $directorio.$name , "r" ); 
		try{
			$first_line = true;
			$equivalence = 0;
			$equivalences = array();
			while (( $data = fgetcsv ( $fp , 2048, ";","\\" )) !== false ) { // Mientras hay líneas que leer...
				$i = 0;
				$data_student = array();
				
				if($first_line){
					foreach($data as $row) {
						if($i > 1){
							$equivalences[] = $row;
							$equivalence += $row;
						}
						$i++ ;
					}
					$first_line = false;
					
					if($equivalence != 100)
					{
						die("Error: El porcentaje de equivalencia de las notas no suma 100%");
					}
				}else{
					foreach($data as $row) {
						if($i < 2){
							$data_student[] = $row;
						} else {
							if($row <= $nota_maxima){
								$student = $dao_users->get_user_only_students($data_student[0]);
								if($student->fields == false){
									die("Error: El estudiante ".$data_student[0]." no existe o no se le ha sido asignado.");
								}
								
								$subject = $dao_subjets->get_subject_by_group($data_student[1]);
								if($subject->fields == false){
									die("Error: El grupo ".$data_student[1]." no ha sido asignado a ninguna materia. informelo al administrador del sistema");
								}
								
								if($dao->validate_equivalence($student->fields[0], $subject->fields[0], 1, $row, $equivalences[$i - 2], false, 0)){	
									// Registramos nota por nota del estudiante con su respectiva equivalencia
									$all_data[] = array($student->fields[0], $subject->fields[0], 1, $row, $equivalences[$i - 2]);
								}else{
									die(utf8_encode("Usted ya había registrado notas para el estudiante ".$data_student[0].", por ende, la equivalencia excede el 100%."));
								}
							}else{
								die("Error: La nota debe ser menor o igual a ".$nota_maxima);
							}
						}
						$i++;
					}
				}
			}
			
			foreach($all_data as $reg){
				$dao->insert_note($reg[0], $reg[1], $reg[2], $reg[3], $reg[4]);
			}
		
			fclose ( $fp );
			unlink($directorio.$name);
			die("Se han registrado las notas correctamente!");
			
		}catch(Exception $e){
			fclose ( $fp );
			unlink($directorio.$name);
			die("Error: El formato del archivo es incorrecto.");
		}
    }
}

?>
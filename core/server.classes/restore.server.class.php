<?php

/**
 * Clase de servidor que env�a la contrase�a al email del usuario
 *
 * @author Nelson D. Garz�n M.
 */

session_start();
extract($_REQUEST);
include_once(dirname(__FILE__) . '/../data.access.objects/users.dao.class.php');

$dao = new users();
$result = $dao->get_user_login_by_email($email);

if($result != null){
    while (!$result->EOF){
		$new_password = md5(time());
		$dao->change_password($result->fields[0], $new_password);
		
		$body_message = "Apreciado usuario,\n\r";
		$body_message .= "Sus credenciales de acceso al sistema de notas de la universidad son: \n\r";
		$body_message .= "Usuario: ".$result->fields[1]."\n\r";
		$body_message .= "Contrase�a: ".$new_password."\n\r\n\r";
		$body_message .= "Por favor, no olvide cambiar su contrase�a inmediatamente ingrese al sistema. \n\r\n\r";
		$body_message .= "Atte.\n\r";
		$body_message .= "Equipo WNotas\n\r";
		$body_message .= "Universitaria de Colombia";
		
		
		mail($result->fields[3],"Recuperaci�n de Contrase�a",$body_message);
		
		$result->MoveNext();
        die("1");
    }
    die("0");
}else{
    die("0");
}
?>

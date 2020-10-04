<?php

/**
 * Clase de servidor que alimenta las variables de configuración del sistema
 *
 * @author Nelson D. Garzón M.
 */

extract($_REQUEST);
include_once(dirname(__FILE__) . '/../data.access.objects/configurations.dao.class.php');

$dao = new configurations();
$result = $dao->get_all_configurations_vars();

if($result != null){
    while (!$result->EOF){
        $GLOBALS[$result->fields['nombre']] = $result->fields['valor'];
		$result->MoveNext();
    }
}

?>

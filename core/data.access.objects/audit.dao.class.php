<?php

/**
 * Clase de m�todos de inserci�n, modificaci�n, eliminaci�n y consulta sobre la tabla auditoria
 *
 * @author Nelson D. Garz�n M.
 */
include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class audit {
    private $conn;
    
    function audit()
    {
        $this->conn = new connection();        
    }
    
    function register_audit($operation, $sentence, $user)
    {
        return $this->conn->db->Execute('INSERT INTO auditoria(operacion, sentencia, fecha, usuario) VALUES(?,?,CURDATE(),?) ', 
			   array($operation, $sentence, $user));
    }
}
?>

<?php

/**
 * Clase de conexión a la base de datos postgres del sistema.
 *
 * @author Nelson D. Garzón M.
 */

// ini_set('display_errors', 'On');
include_once(dirname(__FILE__) . '/../../libraries/adodb5/adodb.inc.php');

class connection {
    public $db;
    private $driver = "mysql";
    private $server = "localhost";
    // private $server = "localhost";
    // private $user = "aulavirt_wnotas";
    private $user = "root";
    // private $password = "WNotas@01";
    private $password = "";
    // private $database = "aulavirt_wnotas";
    private $database = "wnotas";
    
    function connection()
    {
        try {
            $this->db = ADONewConnection($this->driver);
            // $this->db->debug = true;
            $this->db->Connect($this->server, $this->user, $this->password, $this->database);
        } catch (Exception $e) {
            $this->db->Close();
            die($e->getMessage());
        }
    }
}
?>
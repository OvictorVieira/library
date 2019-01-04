<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 26/06/18
 * Time: 13:04
 */

class IncConexDataBase
{
    protected $server_name = 'mysql';
    protected $user = 'secundario';
    protected $password = 'Usu@r1o';
    protected $db_name = 'biblioteca';
    protected $conn;

    /**
     * IncConexDataBase constructor.
     */
    public function conectDatabase() {
        $this->conn = mysqli_connect($this->server_name,$this->user,$this->password,$this->db_name);

        if($this->conn) {
            return $this->conn;
        }

        return false;
    }

    public function returnLastId() {

        $lastId = mysqli_insert_id($this->conn);

        return $lastId;
    }
}
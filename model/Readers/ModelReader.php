<?php
/**
 * Created by PhpStorm.
 * Reader: victor
 * Date: 08/06/18
 * Time: 09:56
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/incConex/IncConexDataBase.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/class/Reader.php";

class ModelReader extends IncConexDataBase {

    /**
     * @param $email
     * @param string $id
     * @return Reader
     */
    public function getReader($email, $id = '')
    {

        if(!empty($id)) {
            $sql = "SELECT id, name, cpf, birth_date, email FROM readers WHERE id = '$id'";
        }
        else {
            $sql = "SELECT id, name, cpf, birth_date, email FROM readers WHERE email = '$email'";
        }

        $reader = new Reader();

        $conex = new IncConexDataBase();

        $resultQuery = mysqli_query($conex->conectDatabase(), $sql);

        if(mysqli_num_rows($resultQuery) == 1) {

            $resultReaders = mysqli_fetch_array($resultQuery);
            $reader->setName($resultReaders['name']);
            $reader->setCpf($resultReaders['cpf']);
            $reader->setId($resultReaders['id']);
        }

        return $reader;
    }

    public function setReader($name, $cpf)
    {

        $cpf = preg_replace("/\D+/", "", $cpf);

        $sql = "INSERT INTO readers (name, cpf) VALUES ( '%s','%s')";
        $createReader = sprintf($sql,$name, $cpf);

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $createReader);
    }

    /**
     * @param $id
     * @param $name
     * @param $cpf
     * @return bool|mysqli_result
     */
    public function updateReader($id, $name, $cpf)
    {

        $cpf = preg_replace("/\D+/", "", $cpf);

        $sql = "UPDATE readers SET name = '%s', cpf = '%s' WHERE id = '%s'";
        $updateReader = sprintf($sql,$name, $cpf, $id);

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $updateReader);
    }

    public function deleteReader($id) {
        $sql = "DELETE FROM readers WHERE id = '%d'";
        $deleteReader = sprintf($sql,$id);

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $deleteReader);
    }

    public function getAllReader()
    {
        $sql = "SELECT id, name, cpf FROM readers ORDER BY name";

        $conex = new IncConexDataBase();

        $queryExec = mysqli_query($conex->conectDatabase(), $sql);

        $arrayReaders = [];

        if($queryExec) {

            while ($listReaders = mysqli_fetch_assoc($queryExec)) {

                $reader = new Reader();

                $reader->setFullName($listReaders['name']);
                $reader->setCpf($listReaders['cpf']);
                $reader->setId($listReaders['id']);

                $arrayReaders[] = $reader;
            }
        }

        return $arrayReaders;
    }
}
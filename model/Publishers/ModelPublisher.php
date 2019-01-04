<?php
/**
 * Created by PhpStorm.
 * Reader: victor
 * Date: 08/06/18
 * Time: 09:56
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/incConex/IncConexDataBase.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/class/Publisher.php";

class ModelPublisher {

    public function getPublisher($id)
    {

        $sql = "SELECT id, name FROM publishers WHERE id = '$id'";

        $conex = new IncConexDataBase();

        $resultQuery = mysqli_query($conex->conectDatabase(), $sql);

        $publisher = new Publisher();

        if(mysqli_num_rows($resultQuery) == 1) {

            $resultPublisher = mysqli_fetch_array($resultQuery);

            $publisher->setPublisherName($resultPublisher['name']);
            $publisher->setId($resultPublisher['id']);
        }

        return $publisher;
    }

    public function setPublisher($name)
    {

        $sql = "INSERT INTO publishers (name) VALUES ('%s')";
        $createPublisher = sprintf($sql,$name);

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $createPublisher);
    }

    public function updatePublisher($id, $name)
    {

        $sql = "UPDATE publishers SET name = '%s' WHERE id = '%d'";
        $updatePublisher = sprintf($sql,$name, $id);

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $updatePublisher);
    }

    public function deletePublisher($id)
    {
        $sql = "DELETE FROM publishers WHERE id = '%s'";
        $deletePublisher = sprintf($sql,$id);

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $deletePublisher);
    }

    public function getAllPublisher()
    {
        $sql = "SELECT id, name FROM publishers ORDER BY name";
        $conex = new IncConexDataBase();

        $queryExec = mysqli_query($conex->conectDatabase(), $sql);

        $arrayPublisher = [];

        if($queryExec) {

            while ($listPublishers = mysqli_fetch_assoc($queryExec)) {
                $publisher = new Publisher();
                $publisher->setPublisherName($listPublishers['name']);
                $publisher->setId($listPublishers['id']);
                $arrayPublisher[] = $publisher;
            }
        }

        return $arrayPublisher;
    }
}















<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 26/06/18
 * Time: 13:20
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/incConex/IncConexDataBase.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/class/Author.php';

class ModelAuthor extends IncConexDataBase
{

    /**
     * @param $name
     * @return bool|mysqli_result
     */
    public function setAuthor($name)
    {

        $sqlQuery = "INSERT INTO authors (name) VALUES ('%s')";
        $createAuthor = sprintf($sqlQuery,$name);

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $createAuthor);
    }

    /**
     * @param $id
     * @return array|null
     */
    public function getAuthor($id)
    {

        $sqlQuery = "SELECT name FROM authors WHERE id = '$id'";

        $conex = new IncConexDataBase();
        $resultQuery = mysqli_query($conex->conectDatabase(), $sqlQuery);

        $author = new Author();

        if(mysqli_num_rows($resultQuery) == 1) {

            $resultAuthor = mysqli_fetch_assoc($resultQuery);

            $author->setAuthorName($resultAuthor['name']);
            $author->setAuthorId($resultAuthor['id']);
        }

        return $author;
    }

    /**
     * @param $id
     * @param $name
     * @return bool|mysqli_result
     */
    public function updateAuthor($id, $name)
    {
        $sqlQuery = "UPDATE authors SET name = '%s' WHERE id = '%d'";
        $updateAuthor = sprintf($sqlQuery,$name, $id);

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $updateAuthor);
    }

    /**
     * @param $id
     * @return bool|mysqli_result
     */
    public function deleteAuthor($id)
    {
        $sqlQuery = "DELETE FROM authors WHERE id = '%d'";
        $deleteAuthor = sprintf($sqlQuery,$id);

        $conex = new IncConexDataBase();
        $queryExec = mysqli_query($conex->conectDatabase(), $deleteAuthor);

        return $queryExec;
    }

    /**
     * @return array of Authors
     */
    public function getAllAuthors()
    {

        $sqlQuery = "SELECT id, name FROM authors ORDER BY name";
        $conex = new IncConexDataBase();
        $queryExec = mysqli_query($conex->conectDatabase(), $sqlQuery);

        $arrayAuthors = [];

        if($queryExec) {

            while ($listAuthors = mysqli_fetch_assoc($queryExec)) {
                $author = new Author();
                $author->setFullName($listAuthors['name']);
                $author->setId($listAuthors['id']);
                $arrayAuthors[] = $author;
            }
        }

        return $arrayAuthors;
    }
}
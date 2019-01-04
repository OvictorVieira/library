<?php
/**
 * Created by PhpStorm.
 * Reader: victor
 * Date: 08/06/18
 * Time: 09:56
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/incConex/IncConexDataBase.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/class/Genre.php";

class ModelGenre {

    /**
     * @param $id
     * @return array|null|string
     */
    public function getGenre($id)
    {

        $sql = "SELECT id, name FROM genres WHERE id = '$id'";

        $conex = new IncConexDataBase();
        $resultQuery = mysqli_query($conex->conectDatabase()->conectDatabase(), $sql);

        $genre = new Genre();

        if(mysqli_num_rows($resultQuery) == 1) {

            $resultGenre = mysqli_fetch_array($resultQuery);

            $genre->setGenreName($resultGenre['name']);
            $genre->setId($resultGenre['id']);
        }

        return $genre;
    }

    /**
     * @param $name
     * @return bool|mysqli_result
     */
    public function setGenre($name)
    {

        $sql = "INSERT INTO genres (name) VALUES ('%s')";
        $createGenre = sprintf($sql,$name);

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $createGenre);
    }

    /**
     * @param $id
     * @param $name
     * @return bool|mysqli_result
     */
    public function updateGenre($id, $name)
    {

        $sql = "UPDATE genres SET name = '%s' WHERE id = '%d'";
        $updateGenre = sprintf($sql,$name, $id);

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $updateGenre);
    }

    /**
     * @param $id
     * @return bool|mysqli_result
     */
    public function deleteGenre($id)
    {
        $sql = "DELETE FROM genres WHERE id = %d";
        $deleteGenre = sprintf($sql,$id);

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $deleteGenre);
    }

    /**
     * @return array
     */
    public function getAllGenres()
    {
        $sql = "SELECT id, name FROM genres ORDER BY name";
        $conex = new IncConexDataBase();

        $queryExec = mysqli_query($conex->conectDatabase(), $sql);

        $arrayGenre = [];

        if($queryExec) {

            while ($listGenres = mysqli_fetch_assoc($queryExec)) {
                $genre = new Genre();
                $genre->setGenreName($listGenres['name']);
                $genre->setId($listGenres['id']);
                $arrayGenre[] = $genre;
            }
        }

        return $arrayGenre;
    }
}
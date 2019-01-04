<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 08/06/18
 * Time: 09:56
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/class/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/incConex/IncConexDataBase.php";

class ModelUser extends IncConexDataBase
{
    /**
     * @param $email
     * @return User or False
     */
    public function getUser($email)
    {
        $sql = "SELECT id, name, cpf, birth_date, email, image FROM users WHERE email = '$email'";

        $conex = new IncConexDataBase();

        $resultQuery = mysqli_query($conex->conectDatabase(), $sql);

        $user = new User();

        if(mysqli_num_rows($resultQuery) == 1) {

            $resultUser = mysqli_fetch_assoc($resultQuery);

            $user->setFullName($resultUser['name']);
            $user->setCpf($resultUser['cpf']);
            $user->setBirthDate($resultUser['birth_date']);
            $user->setEmail($resultUser['email']);
            $user->setId($resultUser['id']);
            $user->setImage($resultUser['image']);

        }

        return $user;
    }

    /**
     * @param $fullName
     * @param $cpf
     * @param $bithDate
     * @param $email
     * @param $passwordUser
     * @return bool|mysqli_result
     */
    public function setUser($fullName, $cpf, $bithDate, $email, $passwordUser)
    {
        $cpf = preg_replace("/\D+/", "", $cpf);
        $bithDate = date('Y-m-d', strtotime($bithDate));

        $sql = "INSERT INTO users (name, cpf, birth_date, email, password) VALUES ( '%s','%s','%s','%s','%s')";
        $createUser = sprintf($sql,$fullName, $cpf, $bithDate, $email, md5($passwordUser));

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $createUser);
    }

    /**
     * @param $email
     * @param $passwordUser
     * @return bool
     */
    public function getLoginUser($email, $passwordUser)
    {
        $password = md5($passwordUser);
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

        $conex = new IncConexDataBase();
        $resultQuery = mysqli_query($conex->conectDatabase(), $sql);

        if(mysqli_num_rows($resultQuery) == 1) {

            $modelUser = new ModelUser();
            $_SESSION['nome'] = $modelUser->getUser($email)->getFullName();
            return true;
        }

        return false;
    }

    /**
     * @param $id
     * @param $fullName
     * @param $cpf
     * @param $bithDate
     * @param $email
     * @param $passwordUser
     * @return bool|mysqli_result
     */
    public function updateUser($id, $fullName, $cpf, $bithDate, $email, $passwordUser, $imgUser)
    {
        $cpf = preg_replace("/\D+/", "", $cpf);
        $bithDate = date('Y-m-d', strtotime($bithDate));

        if(!empty($passwordUser) && empty($imgUser)) {
            $sql = "UPDATE users SET name = '%s', cpf = '%s', birth_date = '%s', email = '%s', password = '%s' WHERE id = '%s'";
            $updateUser = sprintf($sql,$fullName, $cpf, $bithDate, $email, md5($passwordUser), $id);
        }
        elseif (!empty($imgUser) && empty($passwordUser)){
            $sql = "UPDATE users SET name = '%s', cpf = '%s', birth_date = '%s', email = '%s', image = '%s' WHERE id = '%s'";
            $updateUser = sprintf($sql,$fullName, $cpf, $bithDate, $email, $imgUser, $id);
        }
        elseif (!empty($imgUser) && !empty($passwordUser)){
            $sql = "UPDATE users SET name = '%s', cpf = '%s', birth_date = '%s', email = '%s', password = '%s', image = '%s' WHERE id = '%s'";
            $updateUser = sprintf($sql,$fullName, $cpf, $bithDate, $email, md5($passwordUser), $imgUser, $id);
        }
        else {
            $sql = "UPDATE users SET name = '%s', cpf = '%s', birth_date = '%s', email = '%s' WHERE id = '%s'";
            $updateUser = sprintf($sql,$fullName, $cpf, $bithDate, $email, $id);
        }

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $updateUser);
    }

    /**
     * @param $id
     * @return bool|mysqli_result
     */
    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = '%s'";
        $deleteUser = sprintf($sql,$id);

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $deleteUser);
    }

    /**
     * @return array of Users
     */
    public function getAllUser()
    {
        $sql = "SELECT id, name, cpf, birth_date, email FROM users ORDER BY name";
        $conex = new IncConexDataBase();

        $queryExec = mysqli_query($conex->conectDatabase(), $sql);

        $arrayUsers = [];

        if($queryExec) {


            while ($listUsers = mysqli_fetch_assoc($queryExec)) {

                $user = new User();

                $user->setFullName($listUsers['name']);
                $user->setCpf($listUsers['cpf']);
                $user->setBirthDate($listUsers['birth_date']);
                $user->setEmail($listUsers['email']);
                $user->setId($listUsers['id']);
                $arrayUsers[] = $user;
            }
        }

        return $arrayUsers;
    }
}















<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 26/06/18
 * Time: 15:57
 */

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Users/ModelUser.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/validations/ValidateInputs.php";

class ValidateAcessRegister
{
    /**
     * @param $post
     */
    public function validateAcess($post)
    {
        $validateInputs = new ValidateInputs();

        if($validateInputs->validadeInput($post)) {

            $modelUser = new ModelUser();

            if($modelUser->getLoginUser($post['username'], $post['password'])) {

                $_SESSION['user'] = $post['username'];
                $_SESSION['password'] = $post['password'];
                $_SESSION['email'] = $modelUser->getUser($post['username'])->getEmail();
                $_SESSION['name'] = $modelUser->getUser($post['username'])->getFullName();
                $_SESSION['user_id'] = $modelUser->getUser($post['username'])->getId();
                header('Location: /dashboard.php');
            }
            else {
                $_SESSION['messege'] = 'Usuário ou senha inválido.';
                $_SESSION['type_messege'] = 'error';
                header('Location: /login.php');
            }
        }
        else{
            $_SESSION['messege'] = 'Informe o usuário e a senha para acessar o sistema.';
            $_SESSION['type_messege'] = 'error';
            header('Location: /login.php');
        }
    }

    /**
     * @param $post
     */
    public function validateRegister($post)
    {

        $validateInputs = new ValidateInputs();

        if($validateInputs->validadeInput($post)) {

            $modelUser = new ModelUser();

            if($modelUser->setUser($_POST['full_name'], $_POST['cpf_number'], $_POST['birth_date'], $_POST['email'], $_POST['password'])) {

                $_SESSION['user'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
                $name = explode(' ', $_POST['full_name']);
                $_SESSION['name'] = $name[0].$name[1];
                $_SESSION['email'] = $modelUser->getUser($post['email'])->getEmail();
                $_SESSION['user_id'] = $modelUser->getUser($post['email'])->getId();

                header('Location: /dashboard.php');
            }
            else {
                $_SESSION['messege'] = 'Verfique se os dados foram inseridos corretamente.';
                $_SESSION['type_messege'] = 'error';
                header('Location: /login.php');
            }
        }
        else {
            $_SESSION['messege'] = 'Para se registrar é necessário informar todos os dados.';
            $_SESSION['type_messege'] = 'error';
            header('Location: /login.php');
        }
    }
}
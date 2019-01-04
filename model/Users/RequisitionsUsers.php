<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 12/06/18
 * Time: 12:06
 */

@session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Users/ModelUser.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/validations/ValidateInputs.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/validations/ImageUploads.php";

class RequisitionsUsers
{

    // Criação de Usuários

    /**
     * @param $post
     */
    public function createUsers($post)
    {

        $validateInputs = new ValidateInputs();

        if($validateInputs->validadeInput($post)) {

            $modelUser = new ModelUser();

            if($modelUser->setUser($post['full_name'], $post['cpf_number'], $post['birth_date'], $post['email'], $post['password'])) {
                $_SESSION['messege'] = 'Usuário cadastrado com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {

                $_SESSION['messege'] = 'Erro ao cadastrar usuário. Verifique se os dados foram preenchidos corretamente.';
                $_SESSION['type_messege'] = 'error';
            }
        }
        else {
            $_SESSION['messege'] = 'Verifique se todos os dados foram preenchidos corretamente.';
            $_SESSION['type_messege'] = 'error';
        }

        header('Location: /view/user/users.php');
    }

    // Edição de Usuparios

    /**
     * @param $post
     */
    public function updateUsers($post)
    {
        $validateInputs = new ValidateInputs();

        if($validateInputs->validadeInput($post) || empty($post['password'])) {

            $modelUser = new ModelUser();

            if(isset($_FILES['img_user'])) {

                $imageUpload = new ImageUploads();

                $arrayAnswer = $imageUpload->imageUpload();

                if($arrayAnswer['sucess']) {
                    $imageName = $arrayAnswer['file_name'];
                }
                else {
                    $_SESSION['messege'] = $arrayAnswer['messege'];
                    $_SESSION['type_messege'] = 'error';

                    header('Location: /view/user/users.php');
                }
            }

            if($modelUser->updateUser($post['update_id'], $post['full_name'], $post['cpf_number'], $post['birth_date'], $post['email'], $post['password'], $imageName)) {
                $_SESSION['messege'] = 'Dados atualizados com sucesso.';
                $_SESSION['type_messege'] = 'sucess';

            }
            else {
                $_SESSION['messege'] = 'Erro ao atualizar dados do usuário. Verifique se os dados foram preenchidos corretamente.';
                $_SESSION['type_messege'] = 'error';
            }

        }
        else {
            $_SESSION['messege'] = 'Verifique se todos os dados foram preenchidos corretamente.';
            $_SESSION['type_messege'] = 'error';
        }

        header('Location: /view/user/users.php');
    }

    // Exclusão de Usuparios
    public function deleteUsers($get)
    {

        $validateInputs = new ValidateInputs();

        if($validateInputs->validadeInput($get)) {
            $modelUser = new ModelUser();

            if($modelUser->deleteUser($get['delete_id'])) {
                $_SESSION['messege'] = 'Usuário <strong>' . $get['name'] . '</strong> excluido com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {
                $_SESSION['messege'] = 'Erro ao excluir usuário <strong>'.$get['name'].'</strong>. Verifique se o mesmo não possui locações vinculadas a ele.';
                $_SESSION['type_messege'] = 'error';
            }
        }
        else {
            $_SESSION['messege'] = 'Erro ao excluir usuário <strong>' . $get['name'] . '</strong>, tente novamente.';
            $_SESSION['type_messege'] = 'error';
        }
        header('Location: /view/user/users.php');
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 12/06/18
 * Time: 12:06
 */

@session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Genres/ModelGenre.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/validations/ValidateInputs.php";

class RequisitionsGenre {
    // Criação de Gênero
    public function createGenre($post)
    {

        $validateInputs = new ValidateInputs();

        if($validateInputs->validadeInput($post)) {
            $modelGenre = new ModelGenre();

            if($modelGenre->setGenre($post['nome'])) {
                $_SESSION['messege'] = 'Gênero cadastrado com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {
                $_SESSION['messege'] = 'Erro ao cadastrar Gênero. Verifique se os dados foram preenchidos corretamente.';
                $_SESSION['type_messege'] = 'error';
            }
        }
        else {
            $_SESSION['messege'] = 'Verifique se todos os campos foram preenchidos corretamente.';
            $_SESSION['type_messege'] = 'error';
        }

        header('Location: /view/genre/genre.php');
    }

    // Edição de Gênero
    public function updateGenre($post)
    {
        $validateInputs = new ValidateInputs();

        if($validateInputs->validadeInput($post)) {
            $modelGenre = new ModelGenre();

            if($modelGenre->updateGenre($_POST['update_id'], $_POST['name'])) {
                $_SESSION['messege'] = 'Dados atualizados com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {
                $_SESSION['messege'] = 'Erro ao atualizar dados do Gênero. Verifique se os dados foram preenchidos corretamente.';
                $_SESSION['type_messege'] = 'error';
            }
        }
        else {
            $_SESSION['messege'] = 'Verifique se todos os campos foram preenchidos corretamente.';
            $_SESSION['type_messege'] = 'error';
        }

        header('Location: /view/genre/genre.php');
    }

    // Exclusão de Gênero
    public function deleteGenre($get)
    {
        $validateInputs = new ValidateInputs();

        if($validateInputs->validadeInput($get)) {
            $modelGenre = new ModelGenre();

            if($modelGenre->deleteGenre($get['delete_id'])) {
                $_SESSION['messege'] = 'Gênero <strong>'.$get['name'].'</strong> excluido com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {
                $_SESSION['messege'] = 'Erro ao excluir Gênero <strong>'.$get['name'].'</strong>. Tente novamente.';
                $_SESSION['type_messege'] = 'error';
            }
        }
        else {
            $_SESSION['messege'] = 'Não foi possível excluir o Gênero <strong>'.$get['name'].'</strong>, tente novamente.';
            $_SESSION['type_messege'] = 'error';
        }

        header('Location: /view/genre/genre.php');
    }

}
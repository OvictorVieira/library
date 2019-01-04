<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 26/06/18
 * Time: 15:53
 */

@session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Authors/ModelAuthor.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/validations/ValidateInputs.php";

class RequisitionsAuthor
{
    /**
     * @param $post
     */
    public function createAuthor($post)
    {

        $validateInputs = new ValidateInputs();

        if($validateInputs->validadeInput($post)) {
            $modelAuthor = new ModelAuthor();

            if($modelAuthor->setAuthor($post['name'])) {

                $_SESSION['messege'] = 'Autor cadastrado com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {

                $_SESSION['messege'] = 'Erro ao cadastrar Autor. Verifique se os dados foram preenchidos corretamente.';
                $_SESSION['type_messege'] = 'error';
            }
        }
        else {

            $_SESSION['messege'] = 'Verifique se todos os campos foram preenchidos corretamente.';
            $_SESSION['type_messege'] = 'error';
        }

        header('Location: /view/author/authors.php');
    }

    /**
     *
     */
    public function updateAuthor($post)
    {

        $validateInputs = new ValidateInputs();

        if($validateInputs->validadeInput($post)){

            $modelAuthor = new ModelAuthor();

            if($modelAuthor->updateAuthor($post['update_id'], $post['name'], $post['cpf'])) {
                $_SESSION['messege'] = 'Dados atualizados com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {

                $_SESSION['messege'] = 'Erro ao atualizar dados do Autor. Tente novamente.';
                $_SESSION['type_messege'] = 'error';
            }
        }
        else {

            $_SESSION['messege'] = 'Verifique se todos os campos foram preenchidos corretamente.';
            $_SESSION['type_messege'] = 'error';
        }
        header('Location: /view/author/authors.php');
    }

    /**
     * @param $get
     */
    public function deleteAuthor($get)
    {

        $validateInputs = new ValidateInputs();

        if($validateInputs->validadeInput($get)) {

            $modelAuthor = new ModelAuthor();

            if($modelAuthor->deleteAuthor($get['delete_id'])) {
                $_SESSION['messege'] = 'Autor <strong>'.$get['name'].'</strong> excluido com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {

                $_SESSION['messege'] = 'Erro ao excluir Autor <strong>'.$get['name'].'</strong>. Tente novamente.';
                $_SESSION['type_messege'] = 'error';
            }
        }
        else {

            $_SESSION['messege'] = 'Não foi possível excluir o Autor <strong>'.$get['name'].'</strong>, tente novamente.';
            $_SESSION['type_messege'] = 'error';
        }
        header('Location: /view/author/authors.php');
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 12/06/18
 * Time: 12:06
 */

@session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Publishers/ModelPublisher.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/validations/ValidateInputs.php";

class RequisitionsPublisher
{

    // Criação de Editora
    /**
     * @param $post
     */
    public function createPublisher($post)
    {
        $validadeInput = new ValidateInputs();

        if ($validadeInput->validadeInput($post)) {

            $modelPublisher = new ModelPublisher();

            if($modelPublisher->setPublisher($post['name'])) {
                $_SESSION['messege'] = 'Editora cadastrado com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {
                $_SESSION['messege'] = 'Erro ao cadastrar Editora. Verifique se os dados foram preenchidos corretamente.';
                $_SESSION['type_messege'] = 'error';
            }
        }
        else {
            $_SESSION['messege'] = 'Erro, verifique se todos os dados foram preenchidos.';
            $_SESSION['type_messege'] = 'error';
        }

        header('Location: /view/publisher/publishers.php');
    }

    // Edição de Editora

    /**
     * @param $post
     */
    public function updatePublisher($post)
    {
        $validadeInput = new ValidateInputs();

        if ($validadeInput->validadeInput($post)) {

            $modelPublisher = new ModelPublisher();

            if($modelPublisher->updatePublisher($post['update_id'], $post['name'])) {
                $_SESSION['messege'] = 'Dados atualizados com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {
                $_SESSION['messege'] = 'Erro ao atualizar dados da Editora. Verifique se os dados foram preenchidos corretamente.';
                $_SESSION['type_messege'] = 'error';
            }
        }
        else {
            $_SESSION['messege'] = 'Erro, verifique se todos os dados foram preenchidos.';
            $_SESSION['type_messege'] = 'error';
        }

        header('Location: /view/publisher/publishers.php');
    }

    // Exclusão de Editora

    /**
     * @param $get
     */
    public function deletePublisher($get)
    {
        $validadeInput = new ValidateInputs();

        if ($validadeInput->validadeInput($get)) {

            $modelPublisher = new ModelPublisher();

            if($modelPublisher->deletePublisher($get['delete_id'])) {
                $_SESSION['messege'] = 'Editora <strong>'.$get['name'].'</strong> excluido com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {
                $_SESSION['messege'] = 'Erro ao excluir Editora <strong>'.$_GET['name'].'</strong>. Tente novamente.';
                $_SESSION['type_messege'] = 'error';
            }
        }
        else {
            $_SESSION['messege'] = 'Erro, verifique se todos os dados foram preenchidos.';
            $_SESSION['type_messege'] = 'error';
        }

        header('Location: /view/publisher/publishers.php');
    }
}
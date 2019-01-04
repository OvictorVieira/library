<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 12/06/18
 * Time: 12:06
 */

@session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Readers/ModelReader.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/validations/ValidateInputs.php";

class RequisitionsReader {

    // Criação de leitores

    /**
     * @param $post
     */
    public function createReaders($post)
    {
        $validateInputs = new ValidateInputs();

        if($validateInputs->validadeInput($post)) {

            $modelReader = new ModelReader();

            if($modelReader->setReader($post['name'], $post['cpf'])) {
                $_SESSION['messege'] = 'leitor cadastrado com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {
                $_SESSION['messege'] = 'Erro ao cadastrar leitor. Verifique se os dados foram preenchidos corretamente.';
                $_SESSION['type_messege'] = 'error';
            }
        }
        else {
            $_SESSION['messege'] = 'Erro ao cadastrar leitor. Verifique se os dados foram preenchidos corretamente.';
            $_SESSION['type_messege'] = 'error';
        }

        header('Location: /view/reader/readers.php');
    }

    // Edição de leitores

    /**
     * @param $post
     */
    public function updateReaders($post)
    {
        $validateInputs = new ValidateInputs();

        if($validateInputs->validadeInput($post)) {

            $modelReader = new ModelReader();

            if($modelReader->updateReader($post['update_id'], $post['name'], $post['cpf'])) {
                $_SESSION['messege'] = 'Dados atualizados com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {
                $_SESSION['messege'] = 'Erro ao atualizar dados do leitor. Verifique se os dados foram preenchidos corretamente.';
                $_SESSION['type_messege'] = 'error';
            }

            header('Location: /view/reader/readers.php');
        }
    }

    // Exclusão de leitores

    /**
     * @param $get
     */
    public function deleteReaders($get)
    {
        $validateInputs = new ValidateInputs();

        if($validateInputs->validadeInput($get)) {

            $modelReader = new ModelReader();

            if($modelReader->deleteReader($get['delete_id'])) {
                $_SESSION['messege'] = 'leitor <strong>'.$get['name'].'</strong> excluido com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {
                $_SESSION['messege'] = 'Erro ao excluir leitor <strong>'.$get['name'].'</strong>. Verifique se o mesmo não possui locações vinculadas a ele.';
                $_SESSION['type_messege'] = 'error';
            }
        }
        else {
            $_SESSION['messege'] = 'Erro ao excluir leitor <strong>'.$get['name'].'</strong>, tente novamente.';
            $_SESSION['type_messege'] = 'error';
        }

        header('Location: /view/reader/readers.php');

    }
}
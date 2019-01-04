<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 12/06/18
 * Time: 12:06
 */

@session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Loans/ModelLoan.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Users/ModelUser.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/validations/ValidateInputs.php";

class RequisitionsLoan
{
    // Criação de Emprestimos
    /**
     * @param $post
     */
    public function createLoan($post)
    {
        $validationInputs = new ValidateInputs();

        if(($validationInputs->validadeInput($post)) && $_POST['return_date'] >= date('Y-m-d')) {

            $modelLoan = new ModelLoan();

            if($modelLoan->setLoan($_POST['id_book'], $_POST['reader'], $_SESSION['user'], $_POST['return_date'])) {
                $_SESSION['messege'] = 'Empréstimo cadastrado com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {
                $_SESSION['messege'] = 'Erro ao cadastrar Empréstimo. Dados inválidos.';
                $_SESSION['type_messege'] = 'error';
            }
        }
        else {
            $_SESSION['messege'] = 'Verifique se todos os dados foram inseridos corretamente ou se a data de devolução é inferior a data atual.';
            $_SESSION['type_messege'] = 'error';
        }

        header('Location: /view/loan/loans.php');
    }

    // Edição de Status dos Emprestimos
    public function updateStatusLoan($post)
    {
        $validationInputs = new ValidateInputs();

        if($validationInputs->validadeInput($post)) {

            $modelLoan = new ModelLoan();

            if($modelLoan->updateLoan($_POST['update_id'], $_POST['status'])) {
                $_SESSION['messege'] = 'Status atualizados com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {
                $_SESSION['messege'] = 'Erro ao atualizar o status. Tente novamente.';
                $_SESSION['type_messege'] = 'error';
            }
        }
        else {
            $_SESSION['messege'] = 'Erro ao atualizar o status. Verifique se os campos estão corretos.';
            $_SESSION['type_messege'] = 'error';
        }

        header('Location: /view/loan/loans.php');
    }
}
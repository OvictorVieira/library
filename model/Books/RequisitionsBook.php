<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 12/06/18
 * Time: 12:06
 */

@session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Books/ModelBook.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/validations/ValidateInputs.php";

class RequisitionsBook {

    // Criação de Livro
    public function createBook($post)
    {

        $validationInput = new ValidateInputs();

        if($validationInput->validadeInput($post)) {

            $modelBook = new ModelBook();

            if($modelBook->setBook($post['title'],$post['publication_date'],$post['genre'],$post['author'],$post['publisher'])) {
                $_SESSION['messege'] = 'Livro cadastrado com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {
                $_SESSION['messege'] = 'Erro ao cadastrar Livro. Verifique se os dados foram preenchidos corretamente.';
                $_SESSION['type_messege'] = 'error';
            }
        }
        else {
            $_SESSION['messege'] = 'Verifique se os dados foram preenchidos corretamente.';
            $_SESSION['type_messege'] = 'error';
        }

        header('Location: /view/book/books.php');
    }

    // Edição de Livro
    public function updateBook($post)
    {
        $validationInput = new ValidateInputs();

        if($validationInput->validadeInput($post)) {

            $modelBook = new ModelBook();

            if($modelBook->updateBook($post['update'], $post['title'], $post['publication_date'], $post['genre'], $post['author'], $post['publisher'])) {
                $_SESSION['messege'] = 'Dados atualizados com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {
                $_SESSION['messege'] = 'Erro ao atualizar dados da Livro. Verifique se os dados foram preenchidos corretamente.';
                $_SESSION['type_messege'] = 'error';
            }
        }
        else {
            $_SESSION['messege'] = 'Verifique se os dados foram preenchidos corretamente.';
            $_SESSION['type_messege'] = 'error';
        }

        header('Location: /view/book/books.php');
    }

    // Exclusão de Livro
    public function deleteBook($get)
    {
        $validationInput = new ValidateInputs();

        if($validationInput->validadeInput($get)) {

            $modelBook = new ModelBook();

            if($modelBook->deleteBook($get['delete_id'])) {
                $_SESSION['messege'] = 'Livro <strong>'.$get['bookTitle'].'</strong> excluido com sucesso.';
                $_SESSION['type_messege'] = 'sucess';
            }
            else {
                $_SESSION['messege'] = 'Erro ao excluir Livro <strong>'.$get['bookTitle'].'</strong>. Verifique se o mesmo está vinculado a algum empréstimo.';
                $_SESSION['type_messege'] = 'error';
            }
        }

        header('Location: /view/book/books.php');
    }
}
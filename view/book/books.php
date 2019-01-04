<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/06/18
 * Time: 11:51
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardHeader.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Books/ModelBook.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/class/Book.php";

?>

    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="h2">Livros Cadastrados</h4>
                <hr>
                <br>
                <div class="row">
                    <div class="col-12 mb-4">
                        <a href="createBook.php">
                            <button type="button" class="btn btn-success">
                                <i class="fas fa-book"></i>
                                Cadastrar
                            </button>
                        </a>
                        <?php
                            if(isset($_SESSION['messege'])) {
                                require_once $_SERVER['DOCUMENT_ROOT'] . '/view/messeges/messeges.php';
                                unset($_SESSION['messege']);
                            }
                        ?>
                    </div>

                    <div class="col-12">
                        <table class="table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="w-25">Título</th>
                                    <th class="text-left">Gênero</th>
                                    <th class="text-left">Autor</th>
                                    <th class="text-left">Editora</th>
                                    <th class="text-left">Data de Publicação</th>
                                    <th class="text-center">Editar</th>
                                    <th class="text-center">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    $modelBook = new ModelBook();

                                    $tableBook = '';

                                    foreach($modelBook->getAllBook() as $book) {

                                        $tableBook .= '<tr>';
                                        $tableBook .= '<input type="hidden" id="'. $book->getId() .'">';
                                        $tableBook .= '<td>'. $book->getTitle() .'</td>';
                                        $tableBook .= '<td>'. $book->getGenreName() .'</td>';
                                        $tableBook .= '<td>'. $book->getAuthorName() .'</td>';
                                        $tableBook .= '<td>'. $book->getPublisherName() .'</td>';
                                        $tableBook .= '<td>'.($publicationDate = date('d/m/Y', strtotime($book->getPublicationDate()))).'</td>';
                                        $tableBook .= '<td class="text-center">
                                                                    <a href="editionBook.php?code='. $book->getId() .'&name='. $book->getTitle() .'&genreId='. $book->getGenreId() .'&authorId='. $book->getAuthorId() .'&publisherId='. $book->getPublisherId() .'&publicationDate='. $book->getPublicationDate() .'">
                                                                        <button type="button" class="btn btn-info"><i class="mdi mdi-border-color"></i>Editar</button>
                                                                    </a>
                                                                </td>';
                                        $tableBook .= '<td class="text-center">
                                                                    <a href="/model/Books/ControlBooks.php?delete_id='. $book->getId() .'&name='. $book->getTitle() .'">
                                                                        <button type="button" class="btn btn-danger"><i class="mdi mdi-delete"></i>Excluir</button>
                                                                    </a>
                                                                </td>';
                                        $tableBook .= '</tr>';
                                    }

                                    echo $tableBook;

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardFooter.php"; ?>
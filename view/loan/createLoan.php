<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/06/18
 * Time: 11:51
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardHeader.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Books/ModelBook.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Readers/ModelReader.php";

?>

    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="h2">Realizar Empréstimo</h4>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <?php
                            if(isset($_SESSION['messege'])) {
                                require_once $_SERVER['DOCUMENT_ROOT'] . '/view/messeges/messeges.php';
                                unset($_SESSION['messege']);
                            }
                        ?>
                    </div>

                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form action="/model/Loans/ControlLoan.php" method="post" class="forms-sample">
                                    <input type="hidden" name="create" value="create">
                                    <div class="form-group">
                                        <label for="title">Livros</label>
                                        <select class="form-control" id="id_book" name="id_book">
                                            <?php

                                                $modelBook = new ModelBook();

                                                foreach ($modelBook->getAllBook() as $book) {
                                                    echo '<option value="' . $book->getId() . '">' . $book->getTitle() . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="genre">Leitor</label>
                                        <select class="form-control" id="reader" name="reader">
                                            <?php

                                                $modelReader = new ModelReader();

                                                foreach ($modelReader->getAllReader() as $reader) {
                                                    echo '<option value="' . $reader->getId() . '">' . $reader->getFullName() . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="return_date">Data de Devolução</label>
                                        <input type="date" class="form-control" name="return_date" required>
                                    </div>
                                    <button type="submit" class="btn btn-success mr-2">Cadastrar</button>
                                    <a href="loans.php">
                                        <button type="button" class="btn btn-light">Cancelar</button>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardFooter.php"; ?>
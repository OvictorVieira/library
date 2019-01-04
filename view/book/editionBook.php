<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/06/18
 * Time: 11:51
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardHeader.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Genres/ModelGenre.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Authors/ModelAuthor.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Publishers/ModelPublisher.php";

?>

    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="h2">Edição de Livros</h4>
                <hr>
                <br>
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
                                <form action="/model/ModelBooks/RequisitionsBook.php" method="post" class="forms-sample">
                                    <input type="hidden" name="update" value="<?php echo $_GET['code'] ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="title" value="<?php echo $_GET['name'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control date" name="publication_date" value="<?php echo $_GET['publicationDate'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="genre">Gênero</label>
                                        <select class="form-control" id="genre" name="genre">
                                            <?php

                                                $modelGenres = new ModelGenre();

                                                foreach ($modelGenres->getAllGenres() as $genre) {
                                                    if($genre->getId() == $_GET['genreId']) {
                                                        echo '<option value="' . $genre->getId() . '" selected>' . $genre->getGenreName() . '</option>';
                                                    }
                                                    else {
                                                        echo '<option value="' . $genre->getId() . '">' . $genre->getGenreName() . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="author">Autor</label>
                                        <select class="form-control" id="author" name="author">
                                            <?php

                                                $modelAuthors = new ModelAuthor();

                                                foreach ($modelAuthors->getAllAuthors() as $author) {
                                                    if($author->getId() == $_GET['authorId']) {
                                                        echo '<option value="' . $author->getId() . '" selected>' . $author->getFullName() . '</option>';
                                                    }
                                                    else {
                                                        echo '<option value="' . $author->getId() . '">' . $author->getFullName() . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="author">Editora</label>
                                        <select class="form-control" id="publisher" name="publisher">
                                            <?php

                                                $modelPublishers = new ModelPublisher();

                                                foreach ($modelPublishers->getAllPublisher() as $publisher) {
                                                    if($publisher->getId() == $_GET['publisherId']) {
                                                        echo '<option value="' . $publisher->getId() . '" selected>' . $publisher->getPublisherName() . '</option>';
                                                    }
                                                    else {
                                                        echo '<option value="' . $publisher->getId() . '">' . $publisher->getPublisherName() . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success mr-2">Salvar</button>
                                    <a href="books.php">
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
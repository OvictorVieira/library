<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/06/18
 * Time: 11:51
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardHeader.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Genres/ModelGenre.php";

?>

    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="h2">Listagem de Gêneros</h4>
                <hr>
                <br>
                <div class="row">
                    <div class="col-12 mb-4">
                        <a href="createGenre.php">
                            <button type="button" class="btn btn-success">
                                <i class="fas fa-pencil-alt"></i>
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
                        <table id="order-listing" class="table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="w-50">Gênero</th>
                                    <th class="text-center">Editar</th>
                                    <th class="text-center">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $modelGenre = new ModelGenre();

                                    $tableGenres = '';

                                    foreach($modelGenre->getAllGenres() as $genre) {
                                        $tableGenres .= '<tr>';
                                        $tableGenres .= '<input type="hidden" id="'. $genre->getId() .'">';
                                        $tableGenres .= '<td>'. $genre->getGenreName() .'</td>';
                                        $tableGenres .= '<td class="text-center">
                                                                    <a href="editionGenre.php?code='. $genre->getId() .'&name='. $genre->getGenreName() .'">
                                                                        <button type="button" class="btn btn-info"><i class="mdi mdi-border-color"></i>Editar</button>
                                                                    </a>
                                                                </td>';
                                        $tableGenres .= '<td class="text-center">
                                                                    <a href="/model/Genres/ControlGenres.php?delete_id='. $genre->getId() .'&name='. $genre->getGenreName() .'">
                                                                        <button type="button" class="btn btn-danger"><i class="mdi mdi-delete"></i>Excluir</button>
                                                                    </a>
                                                                </td>';
                                        $tableGenres .= '</tr>';
                                    }

                                    echo $tableGenres;

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardFooter.php"; ?>
<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/06/18
 * Time: 11:51
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardHeader.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Authors/ModelAuthor.php";

?>

    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="h2">Listagem de Autores</h4>
                <hr>
                <br>
                <div class="row">
                    <div class="col-12 mb-4">
                        <a href="createAuthor.php">
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
                                    <th class="w-50">Nome</th>
                                    <th class="text-center">Editar</th>
                                    <th class="text-center">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $modelAuthors = new ModelAuthor();

                                    $tableAuthors = '';

                                    foreach ($modelAuthors->getAllAuthors() as $author) {
                                        $tableAuthors .= '<tr>';
                                        $tableAuthors .= '<input type="hidden" id="'. $author->getId() .'">';
                                        $tableAuthors .= '<td>'. $author->getFullName() .'</td>';
                                        $tableAuthors .= '<td class="text-center">
                                                              <a href="editionAuthor.php?code='. $author->getId() .'&name='. $author->getFullName() .'">
                                                                 <button type="button" class="btn btn-info"><i class="mdi mdi-border-color"></i>Editar</button>
                                                              </a>
                                                          </td>';
                                        $tableAuthors .= '<td class="text-center">
                                                              <a href="/model/Authors/ControlAuthors.php?delete_id='. $author->getId() .'&name='. $author->getFullName() .'">
                                                                 <button type="button" class="btn btn-danger"><i class="mdi mdi-delete"></i>Excluir</button>
                                                              </a>
                                                          </td>';
                                        $tableAuthors .= '</tr>';
                                    }

                                    echo $tableAuthors;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardFooter.php"; ?>
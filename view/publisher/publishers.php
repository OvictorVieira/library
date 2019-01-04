<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/06/18
 * Time: 11:51
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardHeader.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Publishers/ModelPublisher.php";

?>

    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="h2">Listagem de Editoras</h4>
                <hr>
                <br>
                <div class="row">
                    <div class="col-12 mb-4">
                        <a href="createPublisher.php">
                            <button type="button" class="btn btn-success">
                                <i class="fas fa-address-book"></i>
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
                                    <th class="w-50">Nome</th>
                                    <th class="text-center">Editar</th>
                                    <th class="text-center">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $modelPublisher = new ModelPublisher();

                                    $tablePublisher = '';

                                    foreach($modelPublisher->getAllPublisher() as $publisher) {
                                        $tablePublisher .= '<tr>';
                                        $tablePublisher .= '<input type="hidden" id="'. $publisher->getId() .'">';
                                        $tablePublisher .= '<td>'. $publisher->getPublisherName() .'</td>';
                                        $tablePublisher .= '<td class="text-center">
                                                                <a href="editionPublisher.php?code='. $publisher->getId() .'&name='. $publisher->getPublisherName() .'">
                                                                    <button type="button" class="btn btn-info"><i class="mdi mdi-border-color"></i>Editar</button>
                                                                </a>
                                                            </td>';
                                        $tablePublisher .= '<td class="text-center">
                                                                <a href="/model/Publishers/ControlPublisher.php?delete_id='. $publisher->getId() .'&name='. $publisher->getPublisherName() .'">
                                                                    <button type="button" class="btn btn-danger"><i class="mdi mdi-delete"></i>Excluir</button>
                                                                </a>
                                                            </td>';
                                        $tablePublisher .= '</tr>';
                                    }

                                    echo $tablePublisher;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardFooter.php"; ?>
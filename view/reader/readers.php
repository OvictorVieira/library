<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/06/18
 * Time: 11:51
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardHeader.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Readers/ModelReader.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/mask.php";

?>

    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="h2">Listagem de Leitores</h4>
                <hr>
                <br>
                <div class="row">
                    <div class="col-12 mb-4">
                        <a href="createReader.php">
                            <button type="button" class="btn btn-success">
                                <i class="fas fa-user-graduate"></i>
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
                                    <th class="w-25">CPF</th>
                                    <th class="text-center">Editar</th>
                                    <th class="text-center">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    $modelReader = new ModelReader();

                                    $tableReaders = '';

                                    foreach ($modelReader->getAllReader() as $reader) {
                                        $tableReaders .= '<tr>';
                                        $tableReaders .= '<input type="hidden" id="' . $reader->getId() . '">';
                                        $tableReaders .= '<td>' . $reader->getFullName() . '</td>';
                                        $tableReaders .= '<td>' . Mask($reader->getCpf()) . '</td>';
                                        $tableReaders .= '<td class="text-center">
                                                            <a href="editionReader.php?code=' . $reader->getId()  . '&name=' . $reader->getFullName() . '&cpf=' . $reader->getCpf() . '">
                                                                <button type="button" class="btn btn-info"><i class="mdi mdi-border-color"></i>Editar</button>
                                                            </a>
                                                          </td>';
                                        $tableReaders .= '<td class="text-center">
                                                            <a href="/model/Readers/ControlReaders.php?delete_id=' . $reader->getId()  . '&name=' . $reader->getFullName() . '">
                                                                <button type="button" class="btn btn-danger"><i class="mdi mdi-delete"></i>Excluir</button>
                                                            </a>
                                                          </td>';
                                        $tableReaders .= '</tr>';
                                    }

                                    echo $tableReaders;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardFooter.php"; ?>
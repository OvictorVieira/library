<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/06/18
 * Time: 11:51
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardHeader.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Users/ModelUser.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/mask.php";

?>

    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="h2">Listagem de Usuários</h4>
                <hr>
                <br>
                <div class="row">
                    <div class="col-12 mb-4">
                        <a href="createUser.php">
                            <button type="button" class="btn btn-success">
                                <i class="fas fa-user-alt"></i>
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
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Data de Nascimento</th>
                                    <th>E-mail</th>
                                    <th class="text-center">Editar</th>
                                    <th class="text-center">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    $modelUser = new ModelUser();

                                    $tableUsers = '';

                                    foreach ($modelUser->getAllUser() as $user) {
                                        $tableUsers .= '<tr>';
                                        $tableUsers .= '<input type="hidden" id="'. $user->getId() .'">';
                                        $tableUsers .= '<td>'. $user->getFullName() .'</td>';
                                        $tableUsers .= '<td>'. Mask($user->getCpf()) .'</td>';
                                        $tableUsers .= '<td>'. ($birthDate = date('d/m/Y', strtotime($user->getBirthDate()))) .'</td>';
                                        $tableUsers .= '<td>'. $user->getEmail() .'</td>';
                                        $tableUsers .= '<td class="text-center">
                                                            <a href="editionUser.php?code='. $user->getId() .'&name='. $user->getFullName() .'&cpf='. $user->getCpf() .'&birthDate='. $birthDate .'&email='. $user->getEmail() .'">
                                                                <button type="button" class="btn btn-info"><i class="mdi mdi-border-color"></i>Editar</button>
                                                            </a>
                                                        </td>';
                                        $tableUsers .= '<td class="text-center">
                                                            <a href="/model/Users/ControlUsers.php?delete_id='. $user->getId() .'&name='. $user->getFullName() .'">
                                                                <button type="button" class="btn btn-danger"><i class="mdi mdi-delete"></i>Excluir</button>
                                                            </a>
                                                        </td>';
                                    }

                                    echo $tableUsers;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardFooter.php"; ?>
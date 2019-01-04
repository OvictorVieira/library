<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/06/18
 * Time: 11:51
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardHeader.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Loans/ModelLoan.php";

?>

    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="h2">Emprestimos</h4>
                <hr>
                <br>
                <div class="row">
                    <div class="col-12 mb-4">
                        <a href="createLoan.php">
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
                                    <th class="text-left">Título</th>
                                    <th class="text-left">Data do Empréstimo</th>
                                    <th class="text-left">Data de Devolução</th>
                                    <th class="text-left">Status</th>
                                    <th class="text-left">Usuário/Funcionário</th>
                                    <th class="text-left">Leitor</th>
                                    <th class="text-left">Data de Cancelamento</th>
                                    <th class="text-left">Data de Entrega</th>
                                    <th class="text-center">Alterar Status</th>
                                </tr>
                            </thead>
                            <div class="table-responsive">
                                <tbody>
                                    <?php

                                        $modelLoan = new ModelLoan();

                                        $tableLoans = '';

                                        foreach ($modelLoan->getAllLoans() as $loan) {
                                            if($loan->getStatusId() == 1) {

                                                $tableLoans .= '<tr>';
                                                $tableLoans .= '<input type="hidden" id="' . $loan->getId() . '">';
                                                $tableLoans .= '<td>' . $loan->getBookTitle() . '</td>';

                                                $loanDateFormat = date('d/m/Y', strtotime( $loan->getLoanDate() ));

                                                $tableLoans .= '<td>' . $loanDateFormat . '</td>';

                                                $returnDateFormat = date('d/m/Y', strtotime( $loan->getReturnDate() ));

                                                $tableLoans .= '<td>' . $returnDateFormat . '</td>';

                                                if ($loan->getStatusId() == 1) {
                                                    $status = '<label class="badge badge-info">Emprestado</label>';
                                                }

                                                $tableLoans .= '<td>' . $status . '</td>';
                                                $tableLoans .= '<td>' . $loan->getUserName() . '</td>';
                                                $tableLoans .= '<td>' . $loan->getReaderName() . '</td>';

                                                if ($loan->getCancellationDate() == null || $loan->getCancellationDate() == '') {
                                                    $cancellationDate = '<td class="text-muted">Não Cancelado</td>';
                                                }

                                                if ($loan->getDateReturned() == null || $loan->getDateReturned() == '') {
                                                    $dateReturned = '<td class="text-danger">Pendente</td>';
                                                }

                                                $tableLoans .= $cancellationDate;
                                                $tableLoans .= $dateReturned;

                                                $tableLoans .= '<td class="text-center">
                                                                    <a href="editionLoanStatus.php?code=' . $loan->getId() . '&bkTitle=' . $loan->getBookTitle() . '&loan_date=' . $loan->getLoanDate() . '&readerName=' . $loan->getReaderName() . '&status_id=' . $loan->getStatusId() . '">
                                                                        <button type="button" class="btn btn-info"><i class="mdi mdi-border-color"></i>Editar</button>
                                                                    </a>
                                                                </td>';

                                                $tableLoans .= '</tr>';
                                            }
                                        }

                                        echo $tableLoans;

                                    ?>
                                </tbody>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardFooter.php"; ?>
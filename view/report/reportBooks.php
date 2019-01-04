<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/06/18
 * Time: 11:51
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardHeader.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Reports/ModelReportsBooks.php";

?>

    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="h2">Livros Mais Retirados</h4>
                <hr>
                <br>
                <div class="row">

                    <div class="col-12">
                        <table class="table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="w-25">Título</th>
                                    <th class="text-left">Gênero</th>
                                    <th class="text-left">Autor</th>
                                    <th class="text-left">Editora</th>
                                    <th class="text-left">Data de Publicação</th>
                                    <th class="text-right">Quantidade de Empréstimos</th>
                                </tr>
                            </thead>
                            <div class="table-responsive">
                                <tbody>
                                    <?php

                                        $modelReportBook = new ModelReportsBooks();

                                        $tableReportsBook = '';

                                        foreach($modelReportBook->getReportBook() as $reportBook) {

                                            $tableReportsBook .= '<tr>';
                                                $tableReportsBook .= '<input type="hidden" id="'. $reportBook['book_id'] .'">';
                                                $tableReportsBook .= '<td>'.$reportBook['book_title'].'</td>';
                                                $tableReportsBook .= '<td>'.$reportBook['genre_name'].'</td>';
                                                $tableReportsBook .= '<td>'.$reportBook['author_name'].'</td>';
                                                $tableReportsBook .= '<td>'.$reportBook['publisher_name'].'</td>';
                                                $tableReportsBook .= '<td>'.($reportBook['publication_date'] = date('d/m/Y', strtotime($reportBook['publication_date']))).'</td>';
                                                $tableReportsBook .= '<td class="text-center"><strong>'.$reportBook['qtd'].'</strong></td>';

                                            $tableReportsBook .= '</tr>';

                                        }

                                        echo $tableReportsBook;

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
<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardHeader.php";

?>

            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-12 grid-margin">
                        <div class="card overflow-hidden dashboard-curved-chart">
                            <div class="card-body mx-3">
                                <span class="h5">Bem vindo, </span><span class="h3"><?php echo $_SESSION['name'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardFooter.php"; ?>

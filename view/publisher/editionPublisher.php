<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/06/18
 * Time: 11:51
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardHeader.php";

?>

    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="h2">Edição de Leitores</h4>
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
                                <form action="/model/Publishers/ControlPublisher.php" method="post" class="forms-sample">
                                    <input type="hidden" name="update_id" value="<?php echo $_GET['code'] ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Nome" value="<?php echo $_GET['name'] ?>">
                                    </div>
                                    <button type="submit" class="btn btn-success mr-2">Salvar</button>
                                    <a href="publishers.php">
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
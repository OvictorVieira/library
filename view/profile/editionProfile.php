<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/06/18
 * Time: 11:51
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardHeader.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Users/ModelUser.php";

?>

    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="h2">Perfil do Usuário</h4>
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

                    <div id="box-create-user" class="container-fluid grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <?php
                                    $modelUser = new ModelUser();

                                    $user = $modelUser->getUser($_SESSION['email']);
                                ?>

                                <form action="/model/Users/ControlUsers.php" method="post" class="forms-sample" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="update_id" value="<?php echo $user->getId() ?>">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="full_name" placeholder="Nome" value="<?php echo $user->getFullName() ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control cpf" name="cpf_number" placeholder="CPF" value="<?php echo $user->getCpf() ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control date" name="birth_date" placeholder="Data de Nascimento" value="<?php echo date('d/m/Y', strtotime($user->getBirthDate())) ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" placeholder="E-mail" value="<?php echo $user->getEmail() ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" name="password" placeholder="Senha">
                                            </div>
                                            <button type="submit" class="btn btn-success mr-2">Salvar</button>
                                            <a href="/dashboard.php">
                                                <button type="button" class="btn btn-light">Cancelar</button>
                                            </a>
                                        </div>
                                        <div class="offset-1 col-md-4 offset-1 grid-margin stretch-card">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <img src="/assets/images/users/<?php echo is_null($user->getImage()) ? 'user.svg' : $user->getImage() ?>" class="img-lg rounded-circle mb-2"/>
                                                    <h4><?php echo $user->getFullName() ?></h4>
                                                    <br>
                                                    <div class="form-group">
                                                        <div class="input-group col-xs-12">
                                                            <input type="file" name="img_user" class="file-upload-info form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/dashboardFooter.php"; ?>
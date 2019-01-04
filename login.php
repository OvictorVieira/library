<?php
    session_start();

    include_once 'header.html';

    if(isset($_SESSION['user'])) {
        header('Location: /dashboard.php');
    }
?>

        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55 m-t-150 m-b-150">
                    <?php
                        if(isset($_SESSION['messege'])) {
                            require_once $_SERVER['DOCUMENT_ROOT'] . '/view/messeges/messeges.php';
                            unset($_SESSION['messege']);
                        }
                    ?>

                    <form action="/validations/validate.php" method="post" class="login100-form validate-form flex-sb flex-w">
                        <input class="input100" type="hidden" name="login" value="login">
                        <span class="login100-form-title p-b-20">
                            Entrar
                        </span>

                        <span class="txt1 p-b-11">
                            Usuário
                        </span>
                        <div class="wrap-input100 validate-input m-b-36" data-validate = "É necessário informar o nome de usuário">
                            <input class="input100" type="email" name="username">
                            <span class="focus-input100"></span>
                        </div>

                        <span class="txt1 p-b-11">
                            Senha
                        </span>
                        <div class="wrap-input100 validate-input m-b-12" data-validate = "É necessário informar a senha">
                            <span class="btn-show-pass">
                                <i class="fa fa-eye"></i>
                            </span>
                            <input class="input100" type="password" name="password" >
                            <span class="focus-input100"></span>
                        </div>

                        <div class="flex-sb-m w-full p-b-48">
                            <div class="contact100-form-checkbox">
                                <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                                <label class="label-checkbox100" for="ckb1">
                                    Lembre-se
                                </label>
                            </div>

                            <div class="d-none">
                                <a href="#" class="txt3">
                                    Esqueceu sua senha?
                                </a>
                            </div>
                        </div>

                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn">
                                Entrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include_once "footer.html" ?>
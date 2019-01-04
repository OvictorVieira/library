<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 06/06/18
 * Time: 10:03
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/validations/ValidateAcessRegister.php";

// É a tela de login?
if(isset($_POST['login'])) {
    $acess = new ValidateAcessRegister();
    $acess->validateAcess($_POST);
}
// É a tela de Registro?
elseif (isset($_POST['register'])) {
    $register = new ValidateAcessRegister();
    $register->validateRegister($_POST);
}

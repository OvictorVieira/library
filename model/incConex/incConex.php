<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 07/06/18
 * Time: 09:49
 */

function conectDataBase() {

    $server_name = 'mysql';
    $user = 'secundario';
    $password = 'Usu@r1o';
    $db_name = 'biblioteca';

    $conn = mysqli_connect($server_name,$user,$password,$db_name);

    if(!$conn) {
        die('A conexão falhou: ' . mysqli_connect_error());
    }
    else {
        return $conn;
    }

    return false;
}
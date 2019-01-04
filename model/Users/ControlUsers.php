<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 14/06/18
 * Time: 09:12
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Users/RequisitionsUsers.php";

if(isset($_POST['create'])) {

    $requisitionsUser = new RequisitionsUsers();

    $requisitionsUser->createUsers($_POST);
}

if(isset($_POST['update_id'])) {

    $requisitionsUser = new RequisitionsUsers();

    $requisitionsUser->updateUsers($_POST);
}

if(isset($_GET['delete_id'])) {

    $requisitionsUser = new RequisitionsUsers();

    $requisitionsUser->deleteUsers($_GET);
}
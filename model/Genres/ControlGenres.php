<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 14/06/18
 * Time: 09:12
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Genres/RequisitionsGenre.php";

if(isset($_POST['create'])) {
    $requisitionsGenre = new RequisitionsGenre();
    $requisitionsGenre->createGenre($_POST);
}

if(isset($_POST['update_id'])) {
    $requisitionsGenre = new RequisitionsGenre();
    $requisitionsGenre->updateGenre($_POST);
}

if(isset($_GET['delete_id'])) {
    $requisitionsGenre = new RequisitionsGenre();
    $requisitionsGenre->deleteGenre($_GET);
}
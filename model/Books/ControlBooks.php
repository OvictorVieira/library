<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 14/06/18
 * Time: 09:12
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Books/RequisitionsBook.php";

if(isset($_POST['create'])) {

    $requisitionsBook = new RequisitionsBook();
    $requisitionsBook->createBook($_POST);
}

if(isset($_POST['update_id'])) {

    $requisitionsBook = new RequisitionsBook();
    $requisitionsBook->updateBook($_POST);
}

if(isset($_GET['delete_id'])) {

    $requisitionsBook = new RequisitionsBook();
    $requisitionsBook->deleteBook($_GET);
}
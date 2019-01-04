<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 14/06/18
 * Time: 09:12
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Authors/RequisitionsAuthor.php";

if(isset($_POST['create'])) {

    $requisitionsAuthor = new RequisitionsAuthor();
    $requisitionsAuthor->createAuthor($_POST);
}

if(isset($_POST['update_id'])) {

    $requisitionsAuthor = new RequisitionsAuthor();
    $requisitionsAuthor->updateAuthor($_POST);
}

if(isset($_GET['delete_id'])) {

    $requisitionsAuthor = new RequisitionsAuthor();
    $requisitionsAuthor->deleteAuthor($_GET);
}
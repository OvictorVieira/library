<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 14/06/18
 * Time: 09:12
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Readers/RequisitionsReader.php";

if(isset($_POST['create'])) {

    $requisitionsReader = new RequisitionsReader();
    $requisitionsReader->createReaders($_POST);
}

if(isset($_POST['update_id'])) {

    $requisitionsReader = new RequisitionsReader();
    $requisitionsReader->updateReaders($_POST);
}

if(isset($_GET['delete_id'])) {
    $requisitionsReader = new RequisitionsReader();
    $requisitionsReader->deleteReaders($_GET);
}
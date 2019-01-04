<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 14/06/18
 * Time: 09:12
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Publishers/RequisitionsPublisher.php";

if(isset($_POST['create'])) {
    $requisitionsPublisher = new RequisitionsPublisher();
    $requisitionsPublisher->createPublisher($_POST);
}

if(isset($_POST['update_id'])) {
    $requisitionsPublisher = new RequisitionsPublisher();
    $requisitionsPublisher->updatePublisher($_POST);
}

if(isset($_GET['delete_id'])) {
    $requisitionsPublisher = new RequisitionsPublisher();
    $requisitionsPublisher->deletePublisher($_GET);
}
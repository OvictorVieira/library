<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 14/06/18
 * Time: 09:12
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Loans/RequisitionsLoan.php";

if(isset($_POST['create'])) {
    $requisitionsLoan = new RequisitionsLoan();
    $requisitionsLoan->createLoan($_POST);
}

if(isset($_POST['update_id'])) {
    $requisitionsLoan = new RequisitionsLoan();
    $requisitionsLoan->updateStatusLoan($_POST);
}
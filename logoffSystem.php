<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 25/06/18
 * Time: 15:38
 */

session_start();

unset($_SESSION[user]);

header('Location: index.php');
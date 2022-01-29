<?php 
include "../../PHP/db.php";
include "functions.php";
session_start();
ob_start(); 

if(isset($_POST['login'])) {
    $username = escape($_POST['username']);
    $password = escape($_POST['password']);

    loginUser($username, $password);
}

ob_end_flush(); 
?>


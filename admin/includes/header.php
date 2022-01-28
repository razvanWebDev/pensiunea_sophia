<?php ob_start(); ?>
<?php include "../includes/db.php" ?>
<?php include "functions.php" ?>
<?php session_start(); 
if(!isset($_SESSION["username"])){
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- dropzonejs -->
  <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- CKEeditor-->
  <script src="plugins/CKEditor/build/ckeditor.js"></script>
  <!-- CKEditor output style -->
  <link rel="stylesheet" href="dist/css/ckeditor.css">
  <!-- Custom style -->
  <link rel="stylesheet" href="dist/css/admin.css">


</head>

<body class="hold-transition sidebar-mini">
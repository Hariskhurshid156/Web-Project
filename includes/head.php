<?php session_start(); 
include('includes/connection.php');
include('includes/functions.php');
if (!isset($_SESSION['id'])) {
  header('location: index.php');
}if (isset($_SESSION['tid'])) {
  header('location: app-counselor-dashboard.php');
}
?>
<!DOCTYPE html>
<html class="st-layout ls-top-navbar-large ls-bottom-footer show-sidebar sidebar-l3" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>ACCS | Advisory & Career counseling System</title>
  <link href="css/vendor/all.css" rel="stylesheet">
  <link href="css/app/app.css" rel="stylesheet">
  <link rel="stylesheet" href="css/news.css">

   <link rel="shortcut icon" type="image/png" href="images/logo.png"/>

  <script src="js/vendor/jquery-3.3.1.js"></script>

</head>

<body>
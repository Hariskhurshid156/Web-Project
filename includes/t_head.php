<?php session_start(); 
include('includes/connection.php');
include('includes/functions.php');
if (!isset($_SESSION['tid'])) {
  header('location: index.php');
}if (isset($_SESSION['id'])) {
  header('location: app-student-dashboard.php');
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

   <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>


  <script src="js/vendor/jquery-3.3.1.js"></script>
   <link rel="shortcut icon" type="image/png" href="images/logo.png"/>
</head>

<style type="text/css">
  .btn-primary{
    background-color: #42a5f5;
  }
</style>

<body>
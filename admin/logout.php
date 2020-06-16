<?php 
include("includes/functions.php");
session_start(); 
if(check_sessions()){
	session_destroy();
	header("location:login.php");
}else{
	header("location:login.php");
}

?>
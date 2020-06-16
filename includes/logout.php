<?php
session_start();
if ($_GET['for'] == 'counselor') {
	unset($_SESSION['type']);
	unset($_SESSION['tid']);
	unset($_SESSION['tname']);
	unset($_SESSION['tdepartment']);
	unset($_SESSION['tpicture']);
}
if ($_GET['for'] == 'student') {
	unset($_SESSION['type']);
	unset($_SESSION['id']);
	unset($_SESSION['name']);
	unset($_SESSION['program']);
	unset($_SESSION['picture']);
}
header('location: ../index.php');
?>
<?php
function checkstudentlogin(){
	if (!isset($_SESSION['id'])) {
		header('location: index.php');
	}if (isset($_SESSION['tid'])) {
		header('location: counselor-login.php');
	}
}
function checkcounselorlogin(){
	if (!isset($_SESSION['tid'])) {
		header('location: index.php');
	}if (isset($_SESSION['id'])) {
		header('location: student-login.php');
	}
}

function getaverage($cid){
	include('includes/connection.php');
	$count = 0;
$get = "SELECT * FROM ratings where counselor_id = '$cid'";
$gettotal = mysqli_query($con,$get);
if(mysqli_num_rows($gettotal) > 0) {

  while($result = mysqli_fetch_array($gettotal)) {
     $count = $count + $result['rating'];
  }

  $totalrating = mysqli_num_rows($gettotal);
  $sumrating = $totalrating * 5;

  $averagerating = ($count / $sumrating)*5; 
  $averagerating = round($averagerating, 1);
  return $averagerating;

}
}

function updateaverage($cid , $average){
	include('includes/connection.php');
	$sql = "UPDATE counselor SET average_rating = '$average' where id = '$cid'";
	mysqli_query($con , $sql);
}
?>
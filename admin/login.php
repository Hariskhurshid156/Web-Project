<?php

include "includes/functions.php";
include "includes/connection.php";

$UerrorClass =$PerrorClass= $userErr = $PwdErr ="";

if(check_sessions()){
	header("location:index.php");
	die;
}

if(isset($_POST['login']))

{
	
	$username=$_POST['username'];			
	$pwd=$_POST['pwd'];

	if(empty($username)){
		$userErr="Email is Required";
		$UerrorClass="error";		}
	if(empty($pwd)){
		$PwdErr="Password is Required";
		$PerrorClass="error";
		}
	
	if(empty($userErr) && empty($PwdErr)){
		 if(login($username,$pwd)){
			 header("location:index.php");
			 die;
			 }	
		}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  
   <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Login Page </title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

   
</head>

<body class="login-img3-body">

  <div class="container">

    <form class="login-form" action="login.php" method="POST">
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="text" class="form-control <?php echo $UerrorClass ?> " name="username" placeholder="username">
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
           <input type="password" class="form-control <?php echo $PerrorClass ?>" placeholder="Password" name="pwd">
        </div>
        <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        <button class="btn btn-primary btn-lg btn-block" type="submit" name="login">Login</button>
      
      </div>
    </form>
    <div class="text-right">
      <div class="credits">
         
          Designed by <a href="https://bootstrapmade.com/">ACCS</a>
          
        </div>
    </div>
  </div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>

</body>

</html>
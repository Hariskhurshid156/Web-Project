  <?php
include('includes/connection.php');
if (isset($_SESSION['id'])) {
    header('location: app-student-dashboard.php');
  }
  if (isset($_SESSION['tid']) && isset($_SESSION['type']) && $_SESSION['type']=='counselor') {
    header('location: app-counselor-dashboard.php');
  }
$emailErr = $PassErr = $Error = '';
if(isset($_POST['signinbtn']))
{
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    if (empty($email)) {
      $emailErr = "Email is required"; 
    }
    if (empty($password)) {
      $PassErr = "Password is required";
    }

    $chkmail = "SELECT email FROM counselor WHERE email = '$email'";
    $res = mysqli_query($con,$chkmail);
    if ($res) {
      if (mysqli_num_rows($res) == 0) {
          $emailErr = "Invalid Email Account";
      }
    }

    if (empty($emailErr) && empty($PassErr)) {
      $password = md5($password);
      
      $sql = "SELECT * from counselor where email = '$email' && password='$password'";
      $result = mysqli_query($con,$sql);
      if ($result) {
        if (mysqli_num_rows($result) > 0) {
          $data=mysqli_fetch_array($result);
          session_start();
          $_SESSION['type'] = 'counselor';
          $_SESSION['tid'] = $data['id'];
          $_SESSION['name'] = $data['name'];
          $_SESSION['picture'] = $data['picture'];
          $_SESSION['department'] = $data['department'];
          header('location: app-counselor-dashboard.php');
        }else{
          $PassErr = "Invalid Password";
        }
      }else{
        $Error = "Some error occcured... Please try again..!"; 
      }
    }

}

?>

<!DOCTYPE html>
<html class="hide-sidebar ls-bottom-footer" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>ACCS | Advisory & Career counseling System</title>
  <link href="css/vendor/all.css" rel="stylesheet">
  <link href="css/app/app.css" rel="stylesheet">

  <link rel="shortcut icon" type="image/png" href="images/logo.png"/>
</head>
<body class="login">

<div class="navbar navbar-default navbar-fixed-top navbar-size-large navbar-size-xlarge paper-shadow" data-z="0" data-animated role="navigation">
    <div class="" >
      <div class="navbar-header" style="background-color: #42a5f5">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="navbar-brand navbar-brand-logo" >
          <a class="" href="index.php">
           <img src="images/logo.png" height="50" width="100" style="padding-left: 15px">
          </a>
        </div>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="main-nav" style="margin-right: 50px">
       
        <div class="navbar-right" >
          <ul class="nav navbar-nav navbar-nav-bordered navbar-nav-margin-right">
            
          </ul>
          <a href="student-login.php" class="navbar-btn btn btn-primary">Log In As Student</a> &nbsp
            <a href="counselor-login.php" class="navbar-btn btn btn-primary">Log In As Counselor</a>
        </div>
      </div>
      <!-- /.navbar-collapse -->

    </div>
  </div>



  <div id="content" >
    <div class="container-fluid">
      <div class="" style="padding-top: 100px">
        <div class="panel panel-default text-center paper-shadow" data-z="0.5">
          <h1 class="text-display-1 text-center margin-bottom-none">Counselor Login</h1><br>
          <img src="images/logo.png" class=" width-200">
            <div class="panel-body">

          <form method="POST" action="counselor-login.php">
                
              <div class="form-group">
                <div class="form-control-material">
                  <input class="form-control" id="email" name="email" type="email" placeholder="Your Email">
                  <label for="email">Email</label>
                </div><span style="color: red;"><?php echo $emailErr; ?></span>
              </div>

              <div class="form-group">
                <div class="form-control-material">
                  <input class="form-control" id="password" name="password" type="password" placeholder="Enter Password">
                  <label for="password">Password</label>
                </div><span style="color: red;"><?php echo $PassErr; ?></span>
              </div><br>
              <button type="submit" name="signinbtn" class="btn btn-primary paper-shadow relative" data-z="0.5" data-hover-z="1" data-animated><i class="fa fa-fw fa-unlock-alt"></i> Login</button><br><br>
          </form>

              <a href="#" class="forgot-password">Forgot password?</a>
              
            </div>
        </div>
      </div>

      <div class="panel">
        <?php echo $Error; ?>
      </div>
    </div>
  </div>

 <?php include('includes/footer.php') ?>
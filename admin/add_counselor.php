<?php
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';


$clrName = $clrEmail = $clrDept  = $clrNameErrStd = $clrEmailErrStd = $clrDeptErrStd = $clrNameErr = $clrEmailErr = $clrDeptErr = '';

if (isset($_POST['addclr'])) {

    $clrName = mysqli_real_escape_string($con,$_POST['clrName']);
    $clrEmail = mysqli_real_escape_string($con,$_POST['clrEmail']);
    $clrDept = mysqli_real_escape_string($con,$_POST['clrDept']);

    //echo "<script> alert('$regno'); </script>";

    if (empty($clrDept)) {
      $clrDeptErr = 'Registration number is required';
      $clrDeptErrstd = 'error';
    }
    if (empty($clrName)) {
      $clrNameErr = 'Name is required';
      $clrNameErrstd = 'error';
    }
    if (empty($clrEmail)) {
      $clrEmailErr = 'Email is required';
      $clrEmailErrstd = 'error';
    }

    $sql = "SELECT * From counselor where email = '$clrEmail'";
    $result = mysqli_query($con , $sql);
    if ($result) {
      if (mysqli_num_rows($result)>0) {
        $clrEmailErr = 'Email already exist';
        $clrEmailErrstd = 'error';
      }
    }

    $str1 = substr(str_shuffle("asdfghjklqwertyuiop"), 4, 6);
    $str2 = rand(100, 1000);
    $pass = $str1 . '@' . $str2;

    $passhash = md5($pass);

    if (empty($clrDeptErr) && empty($clrNameErr) && empty($clrEmailErr) ) {
      
        $query = "INSERT into counselor (`name` , `email` , `password` , `department`) VALUES('$clrName' , '$clrEmail' , '$passhash' , '$clrDept')";

        $run = mysqli_query($con, $query);
        if ($run) {


          require_once('PHPMailer-5.2.25/PHPMailerAutoload.php');

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth =true;
            $mail->SMTPSecure = 'tls';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = '587';
            $mail->isHTML(true);
            $mail->Username = 'accsiiui@gmail.com';
            $mail->Password = 'Asdqwe123';
            $mail->SetFrom('accsiiui@gmail.com','ACCS');
            $mail->Subject = 'Counselor Login Credentials';
            $mail->Body    =   "
                    Hi $clrName, <br> <br>

                    Your credentials for the the login(as a counselor) are:<br><br>

                    
                    Email: $clrEmail <br>
                    Password:  $pass <br><br>

                    Kind Regards,<br>

                    ACCS.
                    <br><br><br><br>
                    Note: Please Don't share this information with anyone else.
                    
                  ";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->AddAddress($clrEmail);

            //$mail->Send();

            if(!$mail->Send()) {
              $_SESSION['info'] = "Mail cannot be send";
            exit;
            }

                  if($mail->send()){
                    $_SESSION['info'] = "Login Credentials Sent";
                  }
                  else{
                    $_SESSION['info'] = "Something wrong";
                  }


          $_SESSION['success'] = "Counselor Added Successfully";
        }else{
          $_SESSION['error'] = "Counselor went wrong";
        }
    }


}



 ?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php include 'includes/breadcrumb.php'; ?>
    <!-- Main content -->
    <section class="content">
     
      <!-- Main row -->
      <div class="row">
        <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Adding Counselor</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
            <form method="POST" action="add_counselor.php" role="form">
                <!-- text input -->
                
                <div class="form-group">
                  <label>Counselor Name</label>
                  <input value="<?php echo $clrName; ?>" class="form-control <?php echo $clrNameErrStd; ?>" type="text" placeholder="Enter Counselor Name" name="clrName"><span style="color: red;"><?php echo $clrNameErr; ?></span>
                </div>
                <div class="form-group">
                  <label>Counselor Email</label>
                  <input value="<?php echo $clrEmail; ?>" class="form-control <?php echo $clrEmailErrStd; ?>" type="text" placeholder="Enter counselor Email" name="clrEmail"><span style="color: red;"><?php echo $clrEmailErr; ?></span>
                </div>
                  
                <div>
                  <label>Counselor Department</label>
                   <select name="clrDept" class="form-control <?php echo $clrDeptErrStd; ?>" value="<?php echo $clrDept; ?>">
                   <option value="Computer Sciences" selected>Computer Sciences</option>
                   <option value="Electrical">Electrical</option>
                   <option value="Civil">Civil</option>
                   <option value="Mechanical">Mechanical</option>
                   <option value="Management">Management</option>
                   <option value="Maths">Maths</option>
                </div>
                <span style="color: red;"><?php echo $clrDeptErr; ?></span>

                <div class="form-group">
                   <input type="submit" name="addclr" class="btn btn-sm btn-info" value="Add Counselor">
                </div>


              </form>
            </div>
              <?php include('includes/flash_messages.php'); ?>
            <!-- /.box-body -->
          </div>
       
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'includes/footer.php'; ?>
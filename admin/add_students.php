<?php
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';


$regno = $stdName = $stdEmail = $stdSemester = $StudentRegNoErrstd = $StudentNameErrStd = $StudentEmailErrStd = $StudentNameErr = $StudentRegNoErr = $StudentEmailErr = '';

if (isset($_POST['addStd'])) {

    $regno = mysqli_real_escape_string($con,$_POST['StudentRegno']);
    $stdName = mysqli_real_escape_string($con,$_POST['StudentName']);
    $stdEmail = mysqli_real_escape_string($con,$_POST['StudentEmail']);
    $stdSemester = mysqli_real_escape_string($con,$_POST['StudentSemester']);
    $stdProgram = mysqli_real_escape_string($con,$_POST['StudentProgram']);
    //echo "<script> alert('$regno'); </script>";

    if (empty($regno)) {
      $StudentRegNoErr = 'Registration number is required';
      $StudentRegNoErrstd = 'error';
    }
    if (empty($stdName)) {
      $StudentNameErr = 'Name is required';
      $StudentNameErrstd = 'error';
    }
    if (empty($stdEmail)) {
      $StudentEmailErr = 'Email is required';
      $StudentEmailErrstd = 'error';
    }

    $sql = "SELECT * From students where id = '$regno'";
    $result = mysqli_query($con , $sql);
    if ($result) {
      if (mysqli_num_rows($result)>0) {
        $StudentRegNoErr = 'Registration number already exist';
        $StudentRegNoErrstd = 'error';
      }
    }
    $sql = "SELECT * From students where email = '$stdEmail'";
    $result = mysqli_query($con , $sql);
    if ($result) {
      if (mysqli_num_rows($result)>0) {
        $StudentEmailErr = 'Email already exist';
        $StudentEmailErrstd = 'error';
      }
    }

    $str1 = substr(str_shuffle("asdfghjklqwertyuiop"), 4, 6);
    $str2 = rand(100, 1000);
    $pass = $str1 . '@' . $str2;

    $passhash = md5($pass);

    if (empty($StudentRegNoErr) && empty($StudentNameErr) && empty($StudentEmailErr) ) {
      
        $query = "INSERT into students (`id` , `name` , `email` , `password` , `semester` , `program`) VALUES('$regno' , '$stdName' , '$stdEmail' , '$passhash' , '$stdSemester' , '$stdProgram')";

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
            $mail->Subject = 'Student Login Credentials';
            $mail->Body    =   "
                    Hi $stdName, <br> <br>

                    Your credentials for the the login(as a student) are:<br><br>

                    
                    RegNo: $regno <br>
                    Password:  $pass <br><br>

                    Kind Regards,<br>

                    ACCS.

                    <br><br><br><br>

                    Note: Please Don't share this information with anyone else.
                  ";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->AddAddress($stdEmail);

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


          $_SESSION['success'] = "Student Added Successfully";
        }else{
          $_SESSION['error'] = "Something went wrong";
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
              <h3 class="box-title">Adding Student</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
            <form method="POST" action="add_students.php" role="form">
                <!-- text input -->
                <div class="form-group">
                  <label>Student Reg. No.</label>
                  <input value="<?php echo $regno; ?>" id="regno" class="form-control <?php echo $StudentRegNoErrstd; ?>" type="text" placeholder="0000-XXXX/XXXX/F00" name="StudentRegno"><span style="color: red;"><?php echo $StudentRegNoErr; ?></span>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
                <script type="text/javascript">
                  $("#regno").inputmask({ "mask": "9999-a{4,4}/a{4,4}/a{1,1}9{2,2}" , "placeholder":"0000-XXXX/XXXX/X00"});
                </script>
                <div class="form-group">
                  <label>Student Name</label>
                  <input value="<?php echo $stdName; ?>" class="form-control <?php echo $StudentNameErrStd; ?>" type="text" placeholder="Enter Student Name" name="StudentName"><span style="color: red;"><?php echo $StudentNameErr; ?></span>
                </div>
                <div class="form-group">
                  <label>Student Email</label>
                  <input value="<?php echo $stdEmail; ?>" class="form-control <?php echo $StudentEmailErrStd; ?>" type="text" placeholder="Enter Student Email" name="StudentEmail"><span style="color: red;"><?php echo $StudentEmailErr; ?></span>
                </div>
                

                <div class="form-group">
                  <label>Student Semester</label>
                   <select name="StudentSemester" class="form-control">
                   <option value="1" selected>1st</option>
                   <option value="2">2nd</option>
                   <option value="3">3rd</option>
                   <option value="4">4th</option>
                   <option value="5">5th</option>
                   <option value="6">6th</option>
                   <option value="7">7th</option>
                   <option value="8">8th</option>
                 </select>
                </div>


                <div class="form-group">
                  <label>Student Program</label>
                   <select name="StudentProgram" class="form-control">
                     <option value="Computer Sciences" selected>Computer Sciences</option>
                     <option value="Electrical">Electrical</option>
                     <option value="Civil">Civil</option>
                     <option value="Mechanical">Mechanical</option>
                     <option value="Management">Management</option>
                     <option value="Maths">Maths</option>
                   </select>
                </div>

          
                
               <div >
                 <input type="submit" name="addStd" class="btn btn-sm btn-info" value="Add Student">
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
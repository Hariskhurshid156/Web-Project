<?php include('includes/head.php'); ?>
<?php  
  $courses  = 'active open';
  $takecourse = 'active';
  $crsdrop ='in'; 
  $accountprofile = $dashboard = $account = $messages = $mycourse = $courselist = $accountpass = $accdrop=$counselor ='';
  $creditErr=$total = $credit=0;
  

  $id = $_SESSION['id'];
  $query = "SELECT * FROM students WHERE id = '$id'";
  $row = mysqli_fetch_array(mysqli_query($con, $query));
  $std_Semester = $row['semester'];
  $std_program = $row['program'];


  if (isset($_POST['registercourse'])) {

     $id = $_SESSION['id'];
    if(!empty($_POST['check_list'])) {

      //to get student present semeter

      $getsem = "SELECT semester from students WHERE id = '$id'";
      $getsem = mysqli_query($con,$getsem);
      $stdsem = mysqli_fetch_array($getsem);

      $sem = $stdsem['semester'];

      //to get already registered credit hours
      $alreadyreg = "SELECT * FROM registered_courses where id='$id' && status = 'registered'";
      $alreadyrun =mysqli_query($con , $alreadyreg);
      if (mysqli_num_rows($alreadyrun) >0) {
        while ($data = mysqli_fetch_array($alreadyrun)) {
             $total = $total + $data['credit_hours'];
           }
      }


          // Loop to store and display values of individual checked checkbox.
    foreach($_POST['check_list'] as $course) {
      $crsCode = $course; 
       $sql = "SELECT credit_hours,pre_requisites from subjects WHERE course_code='$crsCode'";
       $ress = mysqli_query($con, $sql);
       $row = mysqli_fetch_array($ress);
       $credit = $row['credit_hours'];

       $total = $total + $credit;
       if ($total > 21) { 
        $_SESSION['error'] = "Maximum Registration Limit is 21 Credit Hours";
        $creditErr == 1;
        }
    }//endforeach
  if ($creditErr == 0) {
    foreach($_POST['check_list'] as $selected) {
       $coursecode = $selected;

       $sqll = "SELECT * FROM registered_courses WHERE reg_no = '$id' && course_code = '$coursecode' && (status = 'registered' || status='cleared' || status='failed')";
       $runn = mysqli_query($con , $sqll);
       if (mysqli_num_rows($runn) == 0) {
          $insert = "INSERT into registered_courses (`reg_no` ,  `course_code` , `status` , `semester`) VALUES('$id' , '$coursecode' , 'registered' , '$sem')";
           $run = mysqli_query($con , $insert);
           if ($run) {
             $_SESSION['success'] = "Courses Registered Successfully";
           }else{
             $_SESSION['error'] = "Some Error Occured";
           }
       }elseif (mysqli_num_rows($runn) > 0) {
          $checkfail = mysqli_fetch_array($runn);
          if ($checkfail['status'] == 'failed') {
            $updateold = "UPDATE registered_courses set status = 'registered', grade = '' , semester='$sem' where reg_no = '$id' && course_code='$coursecode' && status = 'failed'";
            $runupdate = mysqli_query($con , $updateold);
          }else{
            $_SESSION['error'] = "Subject already taken";
          }
       }
        
      }//end foreach
   }else{
       $_SESSION['error'] = "Maximum Registration Limit is 21 Credit Hours";
   }
  }else{
      $_SESSION['error'] = "No Course Selected";
  }
}
?>
  <div class="st-container">

    <!-- Fixed navbar -->
    <?php include('includes/header.php'); ?>
    <!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->
    <?php include('includes/sidebar.php'); ?>


    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

      <!-- this is the wrapper for the content -->
      <div class="st-content">

        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner padding-none">

          <div class="container-fluid">
<?php include('includes/flash_messages.php'); ?>  
            <div class="page-section">
              <div class="media v-middle">
                <div class="media-body">
                  <h1 class="text-display-1 margin-none">Register Courses</h1>
                  <p class="text-subhead">Select the Courses to Register. you can register maximum 21 credit hours.</p>
                  <p class="">This is a one time registration. Make sure before proceeding.</p>
                  <span style="font-size: 15px; font-style: bold italic;">Currently Registered CH: </span><span class="text-subhead" style="color: green; "><?php echo $total; ?></span>
                </div>
                
              </div>
            </div>
  <form method="post" action="app-register-course.php">
    <div class="row">
      <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr style="background-color: #42a5f5;">
              <th>Select</th>
              <th>Course Code</th>
              <th>Subject Name</th>
              <th>Pre_reqisites</th>
              <th>Credit Hours</th>
              <th>Offered Semester</th>
              <th>Program</th>            
            </tr>
          </thead>
      <?php 
        $sql = "SELECT * FROM subjects
                WHERE offered_sem <= '$std_Semester' && program = '$std_program' ORDER BY offered_sem ASC ";
        $res = mysqli_query($con , $sql);
        $i=1;
        while ($row=mysqli_fetch_array($res)) {

      ?>
          <tbody>
            <tr>
              <?php if (empty($row['pre_requisites'])) { 
                      $chkcode = $row['course_code'];
                      $chkstatus = "SELECT * FROM registered_courses where course_code = '$chkcode' && reg_no = '$id'";
                      $statusrun = mysqli_query($con , $chkstatus);
                      if (mysqli_num_rows($statusrun) > 0) { 
                        $statuss = mysqli_fetch_array($statusrun); 
                        if ($statuss['status'] == 'registered') { 
              ?>
                            <td style="text-align: center"><i style="color: green" class=" fa fa-check">&nbsp; <?php echo $statuss['status']; ?></i></td>
                      <?php  }elseif($statuss['status'] == 'cleared'){ ?>
                            <td style="text-align: center"><i style="color: green" class=" fa fa-check">&nbsp; <?php echo $statuss['status']; ?></i></td>
                      <?php  }elseif ($statuss['status'] == 'failed') { ?>
                            <td><input style="text-align: center; " type="checkbox" name="check_list[]" value="<?php echo $row['course_code']; ?>">&nbsp; &nbsp; <i style="color: red; " class=" fa fa-remove">&nbsp; <?php echo $statuss['status']; ?></i></td>
                      
                      <?php
                      } 
                      } else{
                      ?>
            
              <td><input type="checkbox" name="check_list[]" value="<?php echo $row['course_code']; ?>"></td>

              <?php } } else{
                $prereqcode = $row['pre_requisites'];
                 $chk = "SELECT * FROM registered_courses where course_code = '$prereqcode' && reg_no = '$id' && status = 'cleared'";
                    $rslt = mysqli_query($con, $chk);
                    if (mysqli_num_rows($rslt) > 0) {
                      $sub_code = $row['course_code'];
                      $prereqreg = "SELECT * FROM registered_courses where course_code = '$sub_code' && reg_no = '$id'";
                      $prerun = mysqli_query($con , $prereqreg);
                      $prerundata = mysqli_fetch_array($prerun);
                      if ($prerundata['status'] == 'registered') { 
              ?>
                       <td style="text-align: center"><i style="color: green" class=" fa fa-check">&nbsp; registered</i></td> 
              <?php }elseif($prerundata['status'] == 'cleared'){ ?>    
                      <td style="text-align: center"><i style="color: green" class=" fa fa-check">&nbsp; cleared</i></td> 
              <?php }elseif ($prerundata['status'] == 'failed') { ?>
                <td><input style="text-align: center" type="checkbox" name="check_list[]" value="<?php echo $row['course_code']; ?>"> <i style="color: red" class=" fa fa-remove">&nbsp; Failed</i> </td>
              <?php }else{ ?>
                <td><input style="text-align: center" type="checkbox" name="check_list[]" value="<?php echo $row['course_code']; ?>"> </td>
             <?php } }else{ ?>
                <td style="color: red">PreReq Required</td>
              <?php } } ?>
              <td><?php echo $row['course_code']; ?></td>
              <td><?php echo $row['subject_name']; ?></td>
              <td><?php echo $row['pre_requisites']; ?></td>
              <td><?php echo $row['credit_hours']; ?></td>
              <td><?php echo $row['offered_sem']; ?></td>
              <td><?php echo $row['program']; ?></td>
            </tr>
          </tbody>
      <?php $i++; }  ?>
      </table>
    </div>

    <div class="form-group margin-none">
      <div class="col-md-offset-5 col-md-10">
        <button type="submit" name="registercourse" class="btn btn-primary paper-shadow relative" data-z="0.5" data-hover-z="1" data-animated>Register</button>
      </div>
    </div>
  </form>
<?php

    ?>
    
    </div>
        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->

    <!-- Footer -->
   <?php include('includes/footer.php'); ?>
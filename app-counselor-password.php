<?php include('includes/t_head.php'); ?>
<?php  
  $account  = 'active open';
  $accountpass = 'active';
  $accdrop = 'in';
  $reviews =$accountprofile = $dashboard = '';

  $oldErr = $newErr = '';
  $id = $_SESSION['tid'];
  if (isset($_POST['resetpassword'])) {
    $old = $_POST['oldpass'];
    $new = $_POST['newpass'];
    $confirm = $_POST['confirmpass'];

    if (empty($old)) {
        $oldErr = "Current password cannot be empty";
    }
    if (!empty($old)) {
      $old = md5($old);
      $sql = "SELECT password from counselor where id = '$id' && password = '$old'";
      if (mysqli_num_rows(mysqli_query($con , $sql)) == 0) {
        $oldErr = "Current Password is incorrect";
      }
    }
    if (empty($new) && empty($confirm)) {
        $newErr = "New Password and confirm Password are required";
    }
    if (strlen($new) < 8) {
        $newErr = "Password must be minimum 8 characters long";
    }
    if ($new != $confirm) {
        $newErr = "New and Confirm password does'nt match";
    }
    if ($old == md5($new)) {
        $newErr = "OLd and new Password can't be same";
    }

    if (empty($oldErr) && empty($newErr)) {
     $new = md5($new);
      $sql = "UPDATE counselor
              SET password = '$new'
              WHERE id = '$id'";
      if (mysqli_query($con,$sql)) {
        $_SESSION['success'] = "Password updated Successfully";
      }else{
        $_SESSION['error'] = "Something went wrong";
      }
    }

  }
  
?>

  <!-- Wrapper required for sidebar transitions -->
  <div class="st-container">

    <!-- Fixed navbar -->
   <?php include('includes/header.php'); ?>
   <?php include('includes/sidebar.php');?>
    <!-- sidebar effects OUTSIDE of st-pusher: -->
    <!-- st-effect-1, st-effect-2, st-effect-4, st-effect-5, st-effect-9, st-effect-10, st-effect-11, st-effect-12, st-effect-13 -->

    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

      <!-- sidebar effects INSIDE of st-pusher: -->
      <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->

      <!-- this is the wrapper for the content -->
      <div class="st-content">

        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner padding-none">

          <div class="container-fluid">

            <div class="page-section third">
              <!-- Tabbable Widget -->
              <div class="tabbable paper-shadow relative" data-z="0.5">

                <!-- Tabs -->
                <ul class="nav nav-tabs">
                  <li><a href="app-student-profile.php"><i class="fa fa-fw fa-cog"></i> <span class="hidden-sm hidden-xs">Manage Account</span></a></li>
                  <li class="active"><a href="app-student-password.php"><i class="fa fa-fw fa-lock"></i> <span class="hidden-sm hidden-xs">Reset Password</span></a></li>
                </ul>
                <!-- // END Tabs -->

                <!-- Panes -->
                <div class="tab-content">

                  <div id="account" class="tab-pane active">
                    <form class="form-horizontal" method="post" action="app-counselor-password.php">
                      
                      <div class="form-group">
                        <label for="inputEmail3" class="col-md-2 control-label">Old Password</label>
                        <div class="col-md-4">
                          <div class="form-control-material">
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                              <input type="password" class="form-control used" id="oldpass" name="oldpass" placeholder="Old Password">
                              <label for="oldpass">Old Password</label>
                            </div>
                          </div><br><span style="color: red;"><?php echo $oldErr; ?></span>
                        </div>
                        <div class="col-md-5">  
                          <?php include('includes/flash_messages.php'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="newpass" class="col-md-2 control-label">New Password</label>
                        <div class="col-md-8">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-control-material">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control used" id="newpass" name="newpass" placeholder="Enter new Password">
                                <label for="newpass">New Password</label>
                              </div>
                              </div><br><span style="color: red;"><?php echo $newErr; ?></span>

                            </div>
                            <div class="col-md-6">
                              <div class="form-control-material">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control used" id="confirmpass" name="confirmpass" placeholder="Confirm your password">
                                <label for="confirmpass">Confirm Password</label>
                              </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      
                      
                      <div class="form-group margin-none">
                        <div class="col-md-offset-2 col-md-10">
                          <button type="submit" name="resetpassword" class="btn btn-primary paper-shadow relative" data-z="0.5" data-hover-z="1" data-animated>Save Changes</button>
                        </div>
                      </div>
                    </form>
                  </div>

                </div>
                <!-- // END Panes -->

              </div>
              <!-- // END Tabbable Widget -->

            </div>

          </div>

        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->

    <?php include('includes/footer.php'); ?>
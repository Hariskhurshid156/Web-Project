<?php include('includes/head.php'); ?>
<?php  

  $account  = 'active open';
  $accountprofile = 'active';
  $accdrop = 'in';
  $accountpass = $dashboard = $courses = $messages = $mycourse = $takecourse = $courselist = $crsdrop =$counselor ='';

$id = $_SESSION['id'];
  
    if (isset($id)) {
    $sql = "SELECT * from students where id = '$id'";
    $res = mysqli_query($con , $sql);
    if ($res) {
      $row = mysqli_fetch_array($res);
      $oldname = explode(' ', $row['name']); 
    }
    }

  $emailErr=$nameErr='';

  if (isset($_POST['editprofile'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];

    $name = $fname. ' ' .$lname;
    $email = $_POST['email'];
    $skype = $_POST['skype'];
    $phone = $_POST['phno'];
    $address = $_POST['address'];

    if (empty($fname) || empty($lname)) {
      $nameErr = "First & Last name are required";
    }
    if (empty($email)) {
      $emailErr = "Email is required";
    }
    if (!empty($email)) {
      $sql="SELECT email from students where email = '$email' && id != '$id'";
      $result = mysqli_query($con , $sql);
      if (mysqli_num_rows($result) > 0) {
          $emailErr = "Email already exist";
        }  
    }
    if (empty($_FILES['image']['name'])) {
      $filename = $row['picture'];
    }else{
    //adding picture
     $filename = $_FILES['image']['name'];
        $filetmp = $_FILES["image"]["tmp_name"];
        $filetype = $_FILES["image"]["type"];
        $filesize = $_FILES["image"]["size"];
          $check_ext = pathinfo($filename,PATHINFO_EXTENSION);
          if($check_ext =='png' || $check_ext =='jpg' || $check_ext =='gif'  ){

            $div = explode('.', $filename);
            $file_ext = strtolower(end($div));

            $unique_image ="img_".substr(str_shuffle("abcdef"),0,2).substr(str_shuffle("1234567890"),0,4).'.'.$file_ext;
            $filename ="images/profiles/" .$unique_image;


            if($filesize > 500000 && $filesize < 1200000){
              $picErr =  "file must be atleast of 500kb";
            }
            else{
              $picErr = "";
            }
            }else{
              $picErr = "File must be of jpg,png or gif format";
            }
          } 

    if (empty($emailErr) && empty($nameErr)) {
      $query = "UPDATE students 
                SET 
                name='$name' , email='$email' , skype_id='$skype' , phone_number='$phone' , address='$address' , picture='$filename'
                WHERE id='$id'";
      $results = mysqli_query($con , $query);
      if ($results) {
        move_uploaded_file($_FILES['image']['tmp_name'], "$filename");
        $_SESSION['success'] = "Profile Updated Successfully";
        $_SESSION['picture'] = $filename;
        $_SESSION['name'] = $name;
      }else{
        $_SESSION['error'] = "Some Error Occured";
      }
    }

  }

  
?>

  <!-- Wrapper required for sidebar transitions -->
  <div class="st-container">

    <!-- Fixed navbar -->
   <?php include('includes/header.php'); ?>
   <?php include('includes/sidebar.php');?>
   

    <div class="st-pusher" id="content">

      <div class="st-content">

        <div class="st-content-inner padding-none">

          <div class="container-fluid">

            <div class="page-section third">
              <div class="tabbable paper-shadow relative" data-z="0.5">

                <!-- Tabs -->
                <ul class="nav nav-tabs">
                  <li class="active"><a href="app-student-profile.php"><i class="fa fa-fw fa-cog"></i> <span class="hidden-sm hidden-xs">Manage Account</span></a></li>
                  <li><a href="app-student-password.php"><i class="fa fa-fw fa-lock"></i> <span class="hidden-sm hidden-xs">Reset Password</span></a></li>
                </ul>
                <!-- // END Tabs -->

                <!-- Panes -->
                <div class="tab-content">
                  
                  <div id="account" class="tab-pane active">
                    <form class="form-horizontal" method="post" action="app-student-profile.php" enctype="multipart/form-data">
                      <?php
                         if (isset($id)) {
                            $sql = "SELECT * from students where id = '$id'";
                            $res = mysqli_query($con , $sql);
                            if ($res) {
                              $row = mysqli_fetch_array($res);
                              $oldname = explode(' ', $row['name']); 
                            }
                          }
                      ?>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Picture</label>
                        <div class="col-md-4">
                          <div class="media v-middle">
                            <div class="media-left">
                              <div class="icon-block width-100 bg-grey-100">
                              <?php if(empty($row['picture'])){ ?>
                                <i class="fa fa-photo text-light"></i>
                              <?php }else{ ?>
                                <i><img class="img-circle width-90" src="<?php echo $row['picture']; ?>" ></i>
                              <?php } ?>
                              </div>
                            </div>
                            <div class="media-body">
                              <a onclick="document.getElementById('file').click(); return false"class="btn btn-white btn-sm paper-shadow relative" data-z="0.5" data-hover-z="1" data-animated style="margin-top: 25px"> Add Image<i class="fa fa-upl"></i></a>
                              <input type="file" id="file" name="image" style="visibility: hidden;" value="<?php echo $row['picture']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-5">
                          <?php include('includes/flash_messages.php'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="Name" class="col-md-2 control-label has-error">Full Name</label>
                        <div class="col-md-8">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-control-material">
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" name="firstname" class="form-control used" id="Name" placeholder="Your first name" value="<?php echo $oldname[0]; ?>">
                                <label for="exampleInputFirstName">First name</label>
                              </div>
                              </div><br><span style="color: red;"><?php echo $nameErr; ?></span>
                            </div>
                            <div class="col-md-6">
                              <div class="form-control-material">
                                <input type="text" name="lastname" class="form-control used" id="exampleInputLastName" placeholder="Your last name" value="<?php echo $oldname[1]; ?>">
                                <label for="exampleInputLastName">Last name</label>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                        
                      </div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-md-2 control-label">Email</label>
                        <div class="col-md-6">
                          <div class="form-control-material">
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                              <input type="email" name="email" class="form-control used" id="inputEmail3" placeholder="Email" value="<?php echo $row['email']; ?>">
                              <label for="inputEmail3">Email address</label>
                            </div>
                          </div><br><span style="color: red;"><?php echo $emailErr; ?></span>
                        </div>
                        
                      </div>
                      <div class="form-group">
                        <label for="skype" class="col-md-2 control-label">Skype ID</label>
                        <div class="col-md-6">
                          <div class="form-control-material">
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-skype"></i></span>
                              <input type="text" name="skype" class="form-control used" id="skype" placeholder="skype id" value="<?php echo $row['skype_id']; ?>">
                              <label for="skype">Skype ID</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="phno" class="col-md-2 control-label">Phone Number</label>
                        <div class="col-md-6">
                          <div class="form-control-material">
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                              <input type="text" class="form-control used" id="phno" name="phno" placeholder="Phone Number" value="<?php echo $row['phone_number']; ?>">
                              <label for="phno">Phone No.</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="address" class="col-md-2 control-label">Address</label>
                        <div class="col-md-6">
                          <div class="form-control-material">
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                              <input type="text" class="form-control used" id="address" name="address" placeholder="Your Address" value="<?php echo $row['address']; ?>">
                              <label for="address">Address</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="form-group margin-none">
                        <div class="col-md-offset-2 col-md-10">
                          <button type="submit" name="editprofile" class="btn btn-primary paper-shadow relative" data-z="0.5" data-hover-z="1" data-animated>Save Changes</button>
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
<?php if ($_SESSION['type'] == 'counselor') { ?>
  <div class="sidebar left sidebar-size-3 sidebar-offset-0 sidebar-visible-desktop sidebar-visible-mobile sidebar-skin-blue" id="sidebar-menu" data-type="collapse">
      <div data-scrollable>

        <div class="sidebar-block">
          <div class="profile">
            <a href="#">
              <img src="<?php echo $_SESSION['picture'] ?>" alt="people" class="img-circle width-80" />
            </a>
            <h4 class="text-display-1 margin-none"><?php echo $_SESSION['name']; ?></h4>
          </div>
        </div>

        <ul class="sidebar-menu">
          <li class="<?php echo $dashboard; ?>"><a href="app-counselor-dashboard.php"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
          <li class="<?php echo $reviews; ?>"><a href="app-counselor-reviews.php"><i class="fa fa-bar-chart-o"></i><span>Rating & Reviews</span></a></li>
          <li class="hasSubmenu <?php echo $account;?>">
            <a href="#account-menu"><i class="fa fa-user"></i><span>Account</span></a>
            <ul id="account-menu" class="<?php echo $accdrop; ?>">
              <li class="<?php echo $accountprofile; ?>"><a href="app-counselor-profile.php"><span>Edit Profile</span></a></li>
              <li class="<?php echo $accountpass; ?>"><a href="app-counselor-password.php"><span>Edit Password</span></a></li>
            </ul>
          </li>
          <li><a href="includes/logout.php?for=<?php echo $_SESSION['type']; ?>"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>
        </ul>
      </div>
    </div>
<?php }elseif ($_SESSION['type'] == 'student') {?>

    <div class="sidebar left sidebar-size-3 sidebar-offset-0 sidebar-visible-desktop sidebar-visible-mobile sidebar-skin-dark" id="sidebar-menu" data-type="collapse">
      <div data-scrollable>

        <div class="sidebar-block">
          <div class="profile">
            <a href="#">
              <img src="<?php echo $_SESSION['picture']; ?>" alt="people" class="img-circle width-80" />
            </a>
            <h4 class="text-display-1 margin-none"><?php echo $_SESSION['name']; ?></h4>
            <h5 style="color: white">( <?php echo $_SESSION['program']; ?> )</h5>
          </div>
        </div>

        <ul class="sidebar-menu">
          <li class="<?php echo $dashboard; ?>"><a href="app-student-dashboard.php"><i class="fa fa-bar-chart-o"></i><span>Dashboard</span></a></li>
          <li class="hasSubmenu <?php echo $courses; ?>">
            <a href="#course-menu"><i class="fa fa-mortar-board"></i><span>Courses</span></a>
            <ul id="course-menu" class="<?php echo $crsdrop; ?>">
              <li class="<?php echo $mycourse; ?>"><a href="app-my-courses.php"><span>My Courses</span></a></li>
              <?php
               $id = $_SESSION['id'];
               $check = "SELECT * FROM registered_courses where reg_no = '$id' && status='registered'";
               $run = mysqli_query($con , $check);
               if (mysqli_num_rows($run) == 0) {
               ?>
              <li class="<?php echo $takecourse; ?>"><a href="app-register-course.php"><span>Register Course</span></a></li>
              <?php } else{
                  $total = 0;
                  while($data=mysqli_fetch_array($run)){
                    $code = $data['course_code'];
                    $chk = "SELECT * FROM subjects where course_code = '$code'";
                    $runn = mysqli_query($con , $chk);
                    $row = mysqli_fetch_array($runn);

                    $credit = $row['credit_hours'];
                    $total = $total + $credit;
                  }
                  if ($total <= 21) { ?>
                    <li class="<?php echo $takecourse; ?>"><a href="app-register-course.php"><span>Register Course</span></a></li>
                <?php
                  } }
                ?>
              <li class="<?php echo $courselist; ?>"><a href="app-courses-list.php"><span>Courses List</span></a></li>
            </ul>
          </li>
            <li class="hasSubmenu <?php echo $account;?>">
            <a href="#account-menu"><i class="fa fa-user"></i><span>Account</span></a>
            <ul id="account-menu" class="<?php echo $accdrop; ?>">
              <li class="<?php echo $accountprofile; ?>"><a href="app-student-profile.php"><span>Edit Profile</span></a></li>
              <li class="<?php echo $accountpass; ?>"><a href="app-student-password.php"><span>Edit Password</span></a></li>
            </ul>
          </li>
          
          <li class="<?php echo $messages; ?>"><a href="app-student-result.php"><i class="fa fa-comments"></i><span>Results</span></a></li>
          <li class="<?php echo $counselor; ?>"><a href="app-list-counselors.php"><i class="fa fa-user"></i><span>Counselors</span></a></li>
          <li><a href="includes/logout.php?for=<?php echo $_SESSION['type']; ?>"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>
        </ul>
      </div>
    </div>
    <?php } ?>
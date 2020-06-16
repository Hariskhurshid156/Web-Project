  <?php  
  $dashboard  = 'active';
  $accountpass = $account = $accountprofile = $courses = $messages = $mycourse = $takecourse = $courselist = $accdrop= $crsdrop =$counselor ='';
  
?>
<?php include('includes/head.php'); ?>

  <div class="st-container">

    <!-- Fixed navbar -->
    <?php include('includes/header.php'); ?>

    <?php include('includes/sidebar.php'); ?>

    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

      <div class="st-content">
        <div class="st-content-inner padding-none">

          <div class="container-fluid">

            <div class="page-section">
              <div class="col-lg-10">
                 <h1 class="text-display-1 margin-none">Dashboard:</h1>
              </div>
             
              <a href="https://join.slack.com/t/accs-co/shared_invite/enQtNzAwMjkwNTkyNjQ0LTg2MDI0NjU0MDU4OTI1OWEwMTNmNWE1Y2I4MjlkMDZiMTMwZjFlNTgzNDVhN2Q0OTlhYjAxNDg0MzJlNGM2Y2M" class="btn btn-primary media-right">Join Group Chat</a>
            </div>

            <div class="panel panel-default">
              <div class="media v-middle">
                <div class="media-left">
                  <div class="bg-green-400 text-white">
                    <div class="panel-body">
                      <i class="fa fa-credit-card fa-fw fa-2x"></i>
                    </div>
                  </div>
                </div>
                <div class="media-body">
                  <?php include('includes/news.php'); ?>                
                </div><br>
                
              </div>
            </div>

            <div class="row" data-toggle="isotope">

              <div class="item col-xs-12 col-lg-6">
                <div class="panel panel-default paper-shadow" data-z="0.5">
                  <div class="panel-heading" style="background-color: #42a5f5;">
                    <h4 class="text-headline margin-none">Scholarships</h4>
                    <p class="text-subhead text-white">Recent scholarships</p>
                  </div>
                  <ul class="list-group">
                    <?php
                      $query = "SELECT * FROM scholarships where status = '1'";
                      $getscholar = mysqli_query($con, $query);
                      if (mysqli_num_rows($getscholar)>0) {
                        while ($scholar = mysqli_fetch_array($getscholar)) {
                    ?>
                    <li class="list-group-item media v-middle">
                      <div class="media-body">
                        <h4 class="text-subhead margin-none">
                          <a href="<?php echo $scholar['link']; ?>" class="list-group-link"><?php echo $scholar['subject']; ?></a>
                        </h4>
                        <div class="caption">
                          <span class="">Link:</span>
                          <a href="<?php echo $scholar['link']; ?>"><?php echo $scholar['link']; ?></a>
                        </div>
                        <div class="caption">
                          <span class="">Last Date:</span>
                          <span class="text-light"><?php echo $scholar['lastdate']; ?></span>
                        </div>
                        <div class="caption">
                          <span class="">Description:</span>
                          <span class="text-light"><?php echo $scholar['body']; ?></span>
                        </div>
                        
                      </div>
                      
                    </li>

                    <?php } } ?>

                    
                  </ul>
                </div>
              </div>  

              <div class="item col-xs-12 col-lg-6">
                <div class="panel panel-default paper-shadow" data-z="0.5">
                  <div class="panel-heading" style="background-color: #42a5f5;">
                    <h4 class="text-headline margin-none">Registered Courses</h4>
                    <p class="text-subhead text-white">Your current courses</p>
                  </div>
                  <ul class="list-group">
                     <?php 
                      $sql = "SELECT * FROM registered_courses
                              WHERE reg_no = '$id' && status = 'registered' ";
                      $res = mysqli_query($con , $sql);
                      if (mysqli_num_rows($res) > 0) {
                      while ($data=mysqli_fetch_array($res)) {

                        $ccode = $data['course_code'];

                        $query = "SELECT * FROM subjects where course_code = '$ccode'";
                        $ress = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_array($ress)) {
                    ?>
                    <li class="list-group-item media v-middle">
                      <div class="media-body">
                        <a href="#" class="text-subhead list-group-link"><?php echo $row['subject_name']; ?></a>
                      </div>
                      <div class="media-right">
                        <div class="media-right text-center">
                        <div class=""><?php echo $row['credit_hours']; ?></div>
                        <span class="caption text-light">CH</span>
                      </div>
                      </div>
                    </li>
                  <?php } } } ?>
                    
                  </ul>
                  <div class="panel-footer text-right">
                    <a href="app-my-courses.php" class="btn btn-primary paper-shadow relative" data-z="0" data-hover-z="1" data-animated href="app-my-courses.php"> View Details</a>
                  </div>
                </div>
              </div>  
              
            </div>
<div class="page-section">
              <h1 class="text-display-1 margin-none">Results Overview:</h1>
            </div>
            <div class="row" data-toggle="isotope">
              
              <?php 
                  $sql = "SELECT * FROM students
                          WHERE id = '$id'";
                  $res = mysqli_query($con , $sql);
                  $semester = mysqli_fetch_array($res);
                  $total = $semester['semester'];
                  $i=1;
                  while ($i <= $total) {
                    
                ?>
               <div class="item col-xs-12 col-lg-6">
                <div class="panel panel-default paper-shadow" data-z="0.5">
                  <div class="panel-heading" style="background-color: #42a5f5;">
                    <h4 class="text-headline margin-none">Semester <?php echo $i; ?></h4>
                    <p class="text-subhead text-white">Your Results</p>
                  </div>
                  <ul class="list-group">
                     <?php 
                        $result = "SELECT * FROM registered_courses where reg_no = '$id' && semester = '$i' && status != 'registered' ";
                        $getresult = mysqli_query($con , $result);
                        if (mysqli_num_rows($getresult) > 0) {

                          while ($subdata = mysqli_fetch_array($getresult)) {
                            $c_code = $subdata['course_code'];
                            $subjectdata = "SELECT * from subjects WHERE course_code = '$c_code'";
                            $runsub = mysqli_query($con ,$subjectdata);
                            $suball = mysqli_fetch_array($runsub);          
                      ?> 
                    <li class="list-group-item media v-middle">
                      <div class="media-body">
                        <a href="app-take-course.html" class="text-subhead list-group-link"><?php echo $suball['subject_name']; ?></a>

                        <?php if ($subdata['status'] == 'cleared') {
                  echo "<i class='fa fa-check media-right' style='color: green'> ". $subdata['status'] ."  </i>";
                }elseif ($subdata['status'] == 'failed') {
                  echo "<i class='fa fa-remove media-right' style='color: red'> ". $subdata['status'] ."  </i>";
                }

                      ?>
                      </div>

                      <div class="media-right">
                        <?php echo $subdata['grade']; ?><div class="progress progress-mini width-150 margin-none">
                          <?php 
                            if($subdata['grade'] == 'A'){
                              echo '<div class="progress-bar progress-bar-green-300" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:0%;"></div>';
                            }if($subdata['grade'] == 'B+'){
                              echo '<div class="progress-bar progress-bar-green-300" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:0%;"></div>';
                            }if($subdata['grade'] == 'B'){
                              echo '<div class="progress-bar progress-bar-green-300" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:0%;"></div>';
                            }if($subdata['grade'] == 'C+'){
                              echo '<div class="progress-bar progress-bar-yellow-300" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:0%;"></div>';
                            }if($subdata['grade'] == 'C'){
                              echo '<div class="progress-bar progress-bar-yellow-300" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:0%;"></div>';
                            }if($subdata['grade'] == 'D+'){
                              echo '<div class="progress-bar progress-bar-orange-300" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:0%;"></div>';
                            }if($subdata['grade'] == 'D'){
                              echo '<div class="progress-bar progress-bar-orange-300" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%;"></div>';
                            }if($subdata['grade'] == 'F'){
                              echo '<div class="progress-bar progress-bar-red-300" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:0%;"></div>';
                            }
                          ?>
                          
                        </div>
                      </div>
                    </li>

                    <?php } 
                      }else
                      echo "<i style ='margin-left: 150px; color: red' >No result found for Semester ".$i ." </i>";
                    ?>
                  </ul>
                  <div class="panel-footer text-right">
                    <a href="app-student-result.php" class="btn btn-primary paper-shadow relative" data-z="0" data-hover-z="1" data-animated> View Details</a>
                  </div>
                </div>
              </div>  

              <?php $i++; } ?> 
            </div>

            <br/>

          </div>

        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->

<?php include('includes/footer.php'); ?>
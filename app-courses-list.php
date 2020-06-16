<?php include('includes/head.php'); ?>
<?php  
  $courses  = 'active open';
  $courselist = 'active';
  $crsdrop ='in'; 
  $accountprofile = $dashboard = $account = $messages = $mycourse = $takecourse = $accountpass = $accdrop='';
?>
  <div class="st-container">

    <!-- Fixed navbar -->
    <?php include('includes/header.php'); ?>
    <!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->
    <?php include('includes/sidebar.php'); ?>


    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

      <!-- sidebar effects INSIDE of st-pusher: -->
      <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->

      <!-- this is the wrapper for the content -->
      <div class="st-content">

        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner padding-none">

          <div class="container-fluid">

            <div class="page-section">
              <div class="media v-middle">
                <div class="media-body">
                  <h1 class="text-display-1 margin-none">Courses</h1>
                  <p class="text-subhead">Browse All Courses of institute</p>
                </div>
                
              </div>
            </div>
        <div class="row">
          <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr style="background-color: #42a5f5;">
              <th>Course Code</th>
              <th>Subject Name</th>
              <th>Pre_reqisites</th>
              <th>Credit Hours</th>
              <th>Offered Semester</th>
              <th>Program</th>    
              <th>Status</th>        
            </tr>
          </thead>

          <div class="col-md-12">  
          <?php $sql = "SELECT * FROM subjects ORDER By Offered_sem asc";
                $res = mysqli_query($con,$sql);
                while ($row=mysqli_fetch_array($res)) {
          ?>

          <tbody>
            <tr>
              <td><?php echo $row['course_code']; ?></td>
              <td><?php echo $row['subject_name']; ?></td>
              <td><?php echo $row['pre_requisites']; ?></td>
              <td><?php echo $row['credit_hours']; ?></td>
              <td><?php echo $row['offered_sem']; ?></td>
              <td><?php echo $row['program']; ?></td>
              <td>
                <?php if ($row['status'] == 0) { ?>
                        <span style="color: red" class="pull-right">(Not Offered)</span>
                <?php }elseif ($row['status'] == 1) { ?>
                         <span style="color: green" class="pull-right">(Offered)</span>
                <?php } ?>
              </td>
            </tr>
          </tbody>
            
          <?php } ?>

          </div></table>
        </div>

    </div>

        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->

    <!-- Footer -->
   <?php include('includes/footer.php'); ?>
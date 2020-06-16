<?php include('includes/head.php'); ?>
<?php  
  $courses  = 'active open';
  $mycourse = 'active';
  $crsdrop ='in'; 
  $accountprofile = $dashboard = $account = $messages = $takecourse = $courselist = $accountpass = $accdrop= $counselor ='';

  $id = $_SESSION['id'];
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
 
            <div class="page-section">
              <div class="media v-middle">
                <div class="media-body">
                  <h1 class="text-display-1 margin-none">Registered Courses</h1>
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
            </tr>
          </thead>
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
          <tbody>
            <tr>
              <td><?php echo $row['course_code']; ?></td>
              <td><?php echo $row['subject_name']; ?></td>
              <td><?php echo $row['pre_requisites']; ?></td>
              <td><?php echo $row['credit_hours']; ?></td>
              <td><?php echo $row['offered_sem']; ?></td>
              <td><?php echo $row['program']; ?></td>
            </tr>
          </tbody>
      <?php } } }else
        $_SESSION['error'] = "No Registered Subjects";
      ?>
      </table>
    </div>
    <?php include('includes/flash_messages.php'); ?> 
    </div>
        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->

    <!-- Footer -->
   <?php include('includes/footer.php'); ?>
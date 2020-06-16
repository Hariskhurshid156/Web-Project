<?php include('includes/head.php'); ?>
<?php  
  $messages  = 'active';
  $accountpass = $account = $accountprofile = $courses = $dashboard = $mycourse = $takecourse = $courselist = $accdrop= $crsdrop =$counselor ='';
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
<?php include('includes/flash_messages.php'); ?>  
            <div class="page-section">
              <div class="media v-middle">
                <div class="media-body">
                  <h1 class="text-display-1 margin-none">Results:</h1>
                  <p class="text-subhead">Following is your semester vise Result.</p>           
                </div>
                
              </div>
            </div>
             <div class="row">
 <?php 
        $sql = "SELECT * FROM students
                WHERE id = '$id'";
        $res = mysqli_query($con , $sql);
        $semester = mysqli_fetch_array($res);
        $total = $semester['semester'];
        $i=1;
        while ($i <= $total) {
        	
      ?>
      <div class="media-body">
        <h3 class="text-display-5 margin-none">Semester <?php echo $i; ?></h3><br>
      </div>
   
      <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr style="background-color: #42a5f5;">
              <th width="200px">Course Code</th>
              <th width="200px">Subject Name</th>
              <th width="200px">Credit Hours</th>
              <th width="200px">Status</th>
              <th width="150px">Grade</th>            
            </tr>
          </thead>
    
    <?php 
    	$result = "SELECT * FROM registered_courses where reg_no = '$id' && semester = '$i' ";
        	$getresult = mysqli_query($con , $result);
        	if (mysqli_num_rows($getresult) > 0) {

        		while ($subdata = mysqli_fetch_array($getresult)) {
        			$c_code = $subdata['course_code'];
        			$subjectdata = "SELECT * from subjects WHERE course_code = '$c_code'";
        			$runsub = mysqli_query($con ,$subjectdata);
        			$suball = mysqli_fetch_array($runsub);       		
    ?> 
          <tbody>
            <tr>
              <td><?php echo $c_code; ?> </td>
              <td><?php echo $suball['subject_name']; ?></td>
              <td><?php echo $suball['credit_hours']; ?></td>
              <td>
              	<?php if ($subdata['status'] == 'cleared') {
              		echo "<i class='fa fa-check' style='color: green'> ". $subdata['status'] ."  </i>";
              	}elseif ($subdata['status'] == 'failed') {
              		echo "<i class='fa fa-remove' style='color: red'> ". $subdata['status'] ."  </i>";
              	}elseif ($subdata['status'] == 'registered') {
              		echo "<i class='fa fa-check' style='color: red'> ". $subdata['status'] ."  </i>";
              	}	?>

              </td>
              <td><?php echo $subdata['grade']; ?>
                <div class="progress  width-150">
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
              </td>
              <td></td>
            </tr>
          </tbody>
   
   <?php } 
		}else
		echo "<i style ='margin-left: 400px; color: red' >No result found for Semester ".$i ." </i>";
		 $i++; 
	echo "</table>";
	  }  
	?>

    </div><br><br>
    </div>
        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->

    <!-- Footer -->
   <?php include('includes/footer.php'); ?>
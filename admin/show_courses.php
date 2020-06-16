<?php
ob_start();
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';

if(isset($_GET['id'])){
	$id=$_GET['id'];
	if(!empty($id)){
		if (delete_record('subjects',$id)){
			header("location:show_courses.php");
		}
	}
}
 ?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <?php include 'includes/breadcrumb.php'; ?>
    <!-- Main content -->
    <section class="content">
      
      <!-- Main row -->
      <div class="row">
       <div class="box">
            <div class="box-header">
              <h3 class="box-title">Courses</h3><?php include('includes/flash_messages.php'); ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php
                $sql = "SELECT * FROM `subjects` ORDER BY `subject_name` ASC";
                $result = mysqli_query($con,$sql);
                if($result){
                  if(mysqli_num_rows($result)>0){

                    ?>
                      <table id="example2" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Sr.No</th>
                            <th>Course Code</th>
                            <th>Subject Name</th>
                            <th>Pre_reqisites</th>
                            <th>Credit Hours</th>
                            <th>Offered Semester</th>
                            <th>Program</th>
                            <th>Status</th>
                            <th>Action</th>
                            
                          </tr>
                        </thead>
                        <?php
                        $srno = 1;
                          while($row = mysqli_fetch_assoc($result)){
                            ?>
                               <tbody>
                                <tr>
                                  <td><?php echo $srno; ?></td>
                                  <td><?php echo $row['course_code']; ?></td>
                                  <td><?php echo $row['subject_name']; ?></td>
                                  <td><?php echo $row['pre_requisites']; if (empty($row['pre_requisites'])) {
                                    echo "Null";
                                  } ?></td>
                                  <td><?php echo $row['credit_hours']; ?></td>
                                  <td><?php echo $row['offered_sem']; ?></td>
                                  <td><?php echo $row['program']; ?></td>
                                  <td> <?php echo getStatus($row['status']) ?></td>
                                  <td>
                                    <a class="btn btn-success" href="edit_courses.php?id=<?php echo $row['id'];?>">Edit</a> 
                                    
                                    
                                    <a class="btn btn-danger" onclick="confDel(<?php echo $row['id'];?>);" href="javascript:;">Delete</a>
                                  </td>
                                 
                                </tr>
                                </tbody>
                                
                            <?php
                            $srno++;
                          }

                         ?>
                      </table>
                    <?php

                }else{
                  echo "No Record found";
                }
              }
               ?>
             
                
               
            </div>
            <?php include('includes/flash_messages.php'); ?>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
       
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'includes/footer.php'; ?>
<!-- Bootstrap 3.3.7 -->

<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
  <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
  
 
  function confDel(id){
	  var conf = confirm("Are you sure to Delete this?");
	  if(conf){
		  window.location.href="show_courses.php?id="+id;
	  }
  }
  
  
  
</script>


<?php
ob_start();
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';


if (isset($_POST['search'])){

	$keyword = $_POST['keyword'];
 
}else{
  header('location: index.php');
}

 ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <?php include 'includes/breadcrumb.php'; ?>
    <!-- Main content -->
    <section class="content">
    	<div class="row">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Search Results</h3>
            </div>
        </div>
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
            
            <h4>Students: </h4>
            <table id="example2" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Reg. No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Skype Id</th>
                            <th>Semester</th>
                            <th>Phone No.</th>
                            <th>Address</th>
                            <th>Program</th>
                            <th>Status</th>
                            <th>Action</th>
                            
                          </tr>
                        </thead>
            <?php 
              $sql = "SELECT * FROM students where name LIKE '%$keyword%' || id LIKE '%$keyword%'";
              $run = mysqli_query($con, $sql);
             if (mysqli_num_rows($run) > 0) {
                while ( $row = mysqli_fetch_Array($run)) {
            ?>

             <tbody>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td> <?php echo $row['skype_id'] ?></td>
                  <td> <?php echo $row['semester'] ?></td>
                  <td> <?php echo $row['phone_number'] ?></td>
                  <td> <?php echo $row['address'] ?></td>
                  <td> <?php echo $row['program'] ?></td>
                  <td> <?php echo getStatus($row['status']) ?></td>
                  <td>
                    <a class="btn btn-success" href="add_results.php?id=<?php echo $row['id'];?>">Result</a> 
                    <a class="btn btn-danger" onclick="stdDel('<?php echo $row['id'];?>');" href="javascript:;">Delete</a>
                  </td>
                 
                </tr>
            </tbody>
                    <?php
                      }
                    ?>
                      
                    <?php
                      }else{
                           echo "<span style='color: red; margin-left: 450px  '> No record found </span>";
                      }
                    ?>
                    </table>
            </div>
        </div>

        <div class="box">
           
            <!-- /.box-header -->
            <div class="box-body">
            
            <h4>Subjects: </h4>
            <table id="example2" class="table table-bordered table-hover">
                        <thead>
                          <tr>
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
              $sql = "SELECT * FROM subjects where subject_name LIKE '%$keyword%' || course_code LIKE '%$keyword%'";
              $run = mysqli_query($con, $sql);
             if (mysqli_num_rows($run) > 0) {
                while ( $row = mysqli_fetch_Array($run)) {
            ?>

            <tbody>
                                <tr>
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
                      }
                    ?>
                      
                    <?php
                      }else{
                           echo "<span style='color: red; margin-left: 450px  '> No record found </span>";
                      }
                    ?>
                    </table>
            </div>
        </div>


        <div class="box">
           
            <!-- /.box-header -->
            <div class="box-body">
            
            <h4>Counselors: </h4>
            <table id="example2" class="table table-bordered table-hover">
                        <thead>
                         <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Skype Id</th>
                            <th>Qualification</th>
                            <th>Phone No.</th>
                            <th>Status</th>
                            <th>Rating(%)</th>
                            <th>Action</th>
                            
                          </tr>
                        </thead>
            <?php 
              $sql = "SELECT * FROM counselor where name LIKE '%$keyword%' || email LIKE '%$keyword%'";
              $run = mysqli_query($con, $sql);
             if (mysqli_num_rows($run) > 0) {
                while ( $row = mysqli_fetch_Array($run)) {
            ?>

            <tbody>
              <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td> <?php echo $row['skype_id'] ?></td>
                    <td> <?php echo $row['qualification'] ?></td>
                    <td> <?php echo $row['phone_number'] ?></td>
                    <td> <?php echo getStatus($row['status']) ?></td>
                    <td>
                      <?php 
                        $rating  = $row['average_rating'];
                        $total = ($rating/5)*100;
                      ?>
                       <div class="text-center">
                          <input type="text" class="knob" value="<?php echo $total; ?>" data-width="50" data-height="50" data-fgColor="green">
                          </div>
                    </td>
                    <td>
                      <a class="btn btn-danger" onclick="confDel(<?php echo $row['id'];?>);" href="javascript:;">Delete</a>
                    </td>
                   
                  </tr>
            </tbody>
                    <?php
                      }
                    ?>
                      
                    <?php
                      }else{
                            echo "<span style='color: red; margin-left: 450px  '> No record found </span>";
                      }
                    ?>
                    </table>
            </div>
        </div>
      </div>
    </section>

  </div>

   <?php include 'includes/footer.php'; ?>
<!-- Bootstrap 3.3.7 -->

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

   function stdDel(id){
    var conf=confirm("are you sure to delete this?");
    if(conf){
      window.location.href="show_students.php?id="+id;

    }
  }
</script>
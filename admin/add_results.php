<?php
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';


if(isset($_GET['id'])){
  $id=$_GET['id'];
}else{
  header('location: show_students.php');
}

if (isset($_POST['addresult'])) {
  $j=1;
   $id = $_POST['id'];

    if (isset($_POST['addsem'])) {
      $sql = "UPDATE students set semester = semester+1 where id = '$id'";
      $run = mysqli_query($con , $sql);
    }
    while(isset($_POST['status'.$j.''])){
    $data = $_POST['status'.$j.''];
    $data = explode(' ', $data);
    $coursecode = $data[0];
    $status = $data[1];
   
    $grade = $_POST['grade'.$j.''];

    $que = "UPDATE registered_courses SET status = '$status' , grade = '$grade' WHERE reg_no = '$id' && course_code='$coursecode'";
    $rslt = mysqli_query($con , $que);
    if ($rslt) {
      $_SESSION['success'] = "Results Updated Successfully";
    }else{
      $_SESSION['error'] = "Error occured while updating results";
    }
    $j++;
  }
  header('location: show_students.php');
}

 ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php include 'includes/breadcrumb.php'; ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
          <div class="box-header with-border">
              <h3 class="box-title">Adding Results For: ( <?php echo $id; ?> )</h3>
            </div>
          <div class="box-body">
              <form method="post" action="add_results.php">
                      <table id="example2" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Sr. No</th>
                            <th>Course Code</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Grade</th>
                          </tr>
                        </thead>
                        <tbody>
                      <?php
                        $sql = "SELECT * FROM registered_courses where reg_no = '$id' && status = 'registered'";
                        $run = mysqli_query($con , $sql);
                        if (mysqli_num_rows($run) > 0) {
                          $i=1;

                         while ($row = mysqli_fetch_array($run)) {
                          $C_code = $row['course_code'];
                          $query = "SELECT * from subjects where course_code = '$C_code'";
                          $runn = mysqli_query($con , $query);
                          $data = mysqli_fetch_array($runn);
                         
                      ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['course_code']; ?></td>
                            <td><?php echo $data['subject_name']; ?></td>
                            <td>
                              <div class="form-group">
                                 <select name="status<?php echo $i; ?>" class="form-control">
                                  <option value='<?php echo $row['course_code']; ?> cleared'>Cleared</option>
                                  <option value="<?php echo $row['course_code']; ?> failed">Failed</option>
                                </select>
                              </div>
                            </td>

                            <td>
                              <div class="form-group">
                                 <select name="grade<?php echo $i; ?>" class="form-control">
                                  <option value='A'>A</option>
                                  <option value="B+">B+</option>
                                  <option value="B">B</option>
                                  <option value="C+">C+</option>
                                  <option value="C">C</option>
                                  <option value="D+">D+</option>
                                  <option value="D">D</option>
                                  <option value="F">F</option>
                                </select>
                              </div>
                            </td>
                            
                          </tr>
                      <?php $i++; } }else
                        echo "<i style='color: red; margin-left: 400px; font-size: 20px' > No Registered Subjects </i>";
                       ?>
                        </tbody>
                      </table>
                      <div class="form-group" style="margin-left: 870px">
                        <label for="addsem">Update Semester</label>
                        <input type="checkbox" name="addsem" id="addsem">
                      </div>
                      <div style="margin-left: 900px" >
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                       <input type="submit" name="addresult" class="btn btn-sm btn-info" value="Update">
                     </div>
                    </form>
                    
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
 <?php include 'includes/footer.php'; ?>
<?php
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';

$Sub = $Body = $Date = $Status = $Link = $SubErr = $LinkErr = $BodyErr = $DateErr = $SubErrClass = $LinkErrClass = $BodyErrClass = $DateErrClass = "";

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;

if(isset($_POST['addscholar'])){
	
  $Sub = mysqli_real_escape_string($con,$_POST['s_sub']);
   $Body = mysqli_real_escape_string($con,$_POST['s_body']);
    $Date = mysqli_real_escape_string($con,$_POST['s_date']);
   $Status = mysqli_real_escape_string($con,$_POST['s_status']);
   $Link = mysqli_real_escape_string($con,$_POST['s_link']);
  
   
   
   if(empty($Sub)){
    $SubErr = "News Subject Is Required";
    $SubErrClass = "error";
   }
   if(empty($Link)){
    $LinkErr = "News Link Is Required";
    $LinkErrClass = "error";
   }
	
   if(empty($Body)){
    $BodyErr = "News Content Is Required";
    $BodyErrClass = "error";
   }

   if(empty($Date)){
     $DateErr = "Date Is Required";
     $DateErrClass = "error";
   }

  

   if(empty($SubErr) && empty( $DateErr) && empty( $BodyErr) && empty( $LinkErr)){
		global $con;
		$sql = "INSERT INTO scholarships (`subject`,`body`,`lastdate`,`status` , `link`) VALUES ('$Sub','$Body','$Date' , '$Status' , '$Link')";
		$result = mysqli_query($con,$sql);
		if($result){
    $_SESSION['success'] ="Scholarship added Successfully";
		}        
	//header("location:show_courses.php");  // for redirect
	
      else{
       $_SESSION['error']=   "Scholarship is Not added Please try again";       
      }
   }else{
     $_SESSION['warning'] ="Some error occured";
   }
 }

 ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php include 'includes/breadcrumb.php'; ?>
    <!-- Main content -->
    <section class="content">
     
      <!-- Main row -->
      <div class="row">
        <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Adding Scholarships</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form method="POST" action="add_scholarship.php" role="form">
                <!-- text input -->
                <div class="form-group">
                 
                <div class="form-group">
                  <label>Subject</label>
                  <input value="<?php echo $Sub; ?>" class="form-control <?php echo $SubErrClass; ?>" type="text" placeholder="Enter Subject" name="s_sub"><span style="color: red;"><?php echo $SubErr; ?></span>
                </div>
                
                 <div class="form-group">
                  <label>Body</label>
                  <TEXTAREA value="<?php echo $Body; ?>" class="form-control <?php echo $BodyErrClass; ?>" type="text" placeholder="Enter Scholarship Body" name="s_body"></TEXTAREA><span style="color: red;"><?php echo $BodyErr; ?></span>
                </div>

                <div class="form-group">
                  <label>Link:</label>
                  <input value="<?php echo $Link; ?>" class="form-control <?php echo $LinkErrClass; ?>" type="text" placeholder="Add Link" name="s_link"><span style="color: red;"><?php echo $LinkErr; ?></span>
                </div>

                <div class="form-group">
                  <label>Last Date:</label>
                  <input value="<?php echo $today; ?>" class="form-control <?php echo $DateErrClass; ?>" type="date" placeholder="Enter Date" name="s_date"><span style="color: red;"><?php echo $DateErr; ?></span>
                </div>

                
               
                <div class="form-group<?php echo $CoursetatusErrClass;?>">
                  <label>Status</label>
                   <select name="s_status" class="form-control">
                    <option value="1" selected>Active</option>
                    <option value="0">Block</option>
                  </select>
                </div>
                
               <div >
                 <input type="submit" name="addscholar" class="btn btn-sm btn-info" value="Add Scholarship">
               </div>


              </form>
            </div>
            <?php include('includes/flash_messages.php'); ?>
            <!-- /.box-body -->
          </div>
       
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
 <?php include 'includes/footer.php'; ?>
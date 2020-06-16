<?php
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';

$NewsSub = $NewsBody = $NewsDate = $NewsStatus = $NewsSubErr = $NewsBodyErr = $NewsDateErr = $NewsSubErrClass = $NewsBodyErrClass = $NewsDateErrClass = "";

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;

if(isset($_POST['addnews'])){
	
  $NewsSub = mysqli_real_escape_string($con,$_POST['n_sub']);
   $NewsBody = mysqli_real_escape_string($con,$_POST['n_body']);
    $NewsDate = mysqli_real_escape_string($con,$_POST['n_date']);
   $NewsStatus = mysqli_real_escape_string($con,$_POST['c_status']);
  
   
   
   if(empty($NewsSub)){
    $NewsSubErr = "News Subject Is Required";
    $NewsSubErrClass = "error";
   }
	
   if(empty($NewsBody)){
    $NewsBodyErr = "News Content Is Required";
    $NewsBodyErrClass = "error";
   }

   if(empty($NewsDate)){
     $NewsDateErr = "Date Is Required";
     $NewsDateErrClass = "error";
   }

  

   if(empty($NewsSubErr) && empty( $NewsDateErr) && empty( $NewsBodyErr)){
		global $con;
		$sql = "INSERT INTO news (`subject`,`body`,`date` , `status`) VALUES ('$NewsSub','$NewsBody','$NewsDate' , '$NewsStatus')";
		$result = mysqli_query($con,$sql);
		if($result){
    $_SESSION['success'] ="News added Successfully";
		}        
	//header("location:show_courses.php");  // for redirect
	
      else{
       $_SESSION['error']=   "News is Not added Please try again";       
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
              <h3 class="box-title">Adding News</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form method="POST" action="add_news.php" role="form">
                <!-- text input -->
                <div class="form-group">
                 
                <div class="form-group">
                  <label>News Subject</label>
                  <input class="form-control <?php echo $NewsSubErrClass; ?>" type="text" placeholder="Enter News Subject" name="n_sub"><span style="color: red;"><?php echo $NewsSubErr; ?></span>
                </div>
                
                 <div class="form-group">
                  <label>News Body</label>
                  <TEXTAREA class="form-control <?php echo $NewsBodyErrClass; ?>" type="text" placeholder="Enter News Body" name="n_body"></TEXTAREA><span style="color: red;"><?php echo $NewsBodyErr; ?></span>
                </div>

                <div class="form-group">
                  <label>Date:</label>
                  <input value="<?php echo $today; ?>" class="form-control <?php echo $NewsSubErrClass; ?>" type="date" placeholder="Enter Date" name="n_date"><span style="color: red;"><?php echo $NewsDateErr; ?></span>
                </div>
               
                <div class="form-group<?php echo $CoursetatusErrClass;?>">
                  <label>Status</label>
                   <select name="c_status" class="form-control">
                    <option value="1" selected>Active</option>
                    <option value="0">Block</option>
                  </select>
                </div>
                
               <div >
                 <input type="submit" name="addnews" class="btn btn-sm btn-info" value="Add News">
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
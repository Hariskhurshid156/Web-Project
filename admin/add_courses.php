<?php
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';

$CourseCodeErr = $CourseCodeErrClass = $SubjectNameErr = $SubjectNameErrClass = $Pre_requisitesErr = $Pre_requisitesErrClass= $CreditHoursErr= $CreditHoursErrClass= $CourseCode = $SubjectName= $CourseStatus = $Pre_requisites=  $CreditHours = $InsertionMsg = $CoursetatusErrClass = $CourseStatusErr =  $CourseSemErr = $CourseSemErrClass = $PreReqErr = $PreReqErrClass = ""; 


if(isset($_POST['addCourse'])){
	
  $CourseCode = mysqli_real_escape_string($con,$_POST['c_code']);
   $SubjectName = mysqli_real_escape_string($con,$_POST['c_name']);
    $Pre_requisites = mysqli_real_escape_string($con,$_POST['c_prereq']);
   $CreditHours = mysqli_real_escape_string($con,$_POST['c_credithour']);
   $CourseStatus = mysqli_real_escape_string($con,$_POST['c_status']);
  $CourseSem = mysqli_real_escape_string($con,$_POST['c_sem']);
  $CourseProgram = mysqli_real_escape_string($con,$_POST['c_program']);
   if(empty($CourseCode)){
    $CourseCodeErr = "Course code Is Required";
    $CourseCodeErrClass = "error";
   }
	if(checkCourseCode($CourseCode)){
       $CourseCodeErr = "Course Code already exists";
        $CourseCodeErrClass = "error";
   }
   if(empty($SubjectName)){
    $SubjectNameErr = "Subject Name Is Required";
    $SubjectNameErrClass = "error";
   }

   if(empty($SubjectNameErr)){
   }
    if(checkSubjectName($SubjectName)){
       $SubjectNameErr = "Subject already exists";
        $SubjectNameErrClass = "error";
    }
	
   if(empty($CreditHours)){
     $CreditHoursErr = "Credit Hour Is Required";
     $CreditHoursErrClass = "error";
   }
   if (!empty($Pre_requisites) && $CourseSem ==  1) {
     $PreReqErr = "1st Semester subject cannot have a pre requisite";
     $PreReqErrClass = "error";
   }

  

   if(empty($SubjectNameErr) && empty( $CourseCodeErr) && empty( $CreditHoursErr) && empty($PreReqErr)){

		global $con;
		$sql = "INSERT INTO subjects (`course_code`,`subject_name`,`pre_requisites` , `credit_hours` , `status` , `offered_sem`, `program`) VALUES ('$CourseCode','$SubjectName','$Pre_requisites' , '$CreditHours' , '$CourseStatus' , '$CourseSem' , '$CourseProgram')";
		$result = mysqli_query($con,$sql);
		if($result){
		$InsertionMsg = "Course is added Successfully";
    $_SESSION['success'] ="Successfully added";
		}        
	//header("location:show_courses.php");  // for redirect
	
      else{
       $_SESSION['error'] = $InsertionMsg = "Course is Not added Please try again";       
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
              <h3 class="box-title">Adding Courses</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form method="POST" action="add_courses.php" role="form">
                <!-- text input -->
                <div class="form-group">
                 
                <div class="form-group">
                  <label>Course Code</label>
                  <input value="<?php echo $CourseCode; ?>" class="form-control <?php echo $CourseCodeErrClass; ?>" type="text" placeholder="Enter Course Code" name="c_code"><span style="color: red;"><?php echo $CourseCodeErr; ?></span>
                </div>
                
                 <div class="form-group">
                  <label>Subject Name</label>
                  <input value="<?php echo $SubjectName; ?>" class="form-control <?php echo $SubjectNameErrClass; ?>" type="text" placeholder="Enter Subject Name" name="c_name"><span style="color: red;"><?php echo $SubjectNameErr; ?></span>
                </div>
                <div class="form-group">
                 <label>Pre_requisites</label>
                  
                  <select name="c_prereq" class="form-control">
                    <option value="" selected="">None</option>
                  <?php $sql="SELECT * from subjects ORDER By subject_name ASC";
                  $res =mysqli_query($con,$sql);
                  while($data = mysqli_fetch_array($res)){ ?>
                    <option value='<?php echo $data['course_code']; ?>'><?php echo $data['subject_name']; ?></option>
                  <?php } ?>
                    
                  </select>
                </div>
                <div class="form-group">
                 <label>Credit Hours</label>
                  <input value="<?php echo  $CreditHours; ?>" class="form-control <?php echo  $CreditHoursErrClass; ?>" type="text" placeholder="Enter Total Credit Hours For this Course" name="c_credithour"><span style="color: red;"><?php echo  $CreditHoursErr; ?></span>
                </div>
                <div class="form-group<?php echo $CourseSemErrClass;?>">
                  <label>Offered Semester</label>
                   <select name="c_sem" class="form-control">
                    <option value='1'>1st</option>
                    <option value="2">2nd</option>
                    <option value="3">3rd</option>
                    <option value="4">4th</option>
                    <option value="5">5th</option>
                    <option value="6">6th</option>
                    <option value="7">7th</option>
                    <option value="8">8th</option>
                  </select>
                  <span style="color: red;"><?php echo $CourseSemErr; ?></span>
                </div>

                 <div class="form-group">
                  <label>Course Program</label>
                   <select name="c_program" class="form-control">
                     <option value="Computer Sciences" selected>Computer Sciences</option>
                     <option value="Electrical">Electrical</option>
                     <option value="Civil">Civil</option>
                     <option value="Mechanical">Mechanical</option>
                     <option value="Management">Management</option>
                     <option value="Maths">Maths</option>
                   </select>
                </div>
                <div class="form-group<?php echo $CoursetatusErrClass;?>">
                  <label>Status</label>
                   <select name="c_status" class="form-control">
                    <option value="1" selected>Offer</option>
                    <option value="0">Block</option>
                  </select>
                  <span style="color: red;"><?php echo $CourseStatusErr; ?></span>
                </div>
                
               <div >
                 <input type="submit" name="addCourse" class="btn btn-sm btn-info" value="Add Course">
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
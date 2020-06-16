<?php
ob_start();
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';


$CourseCode = $SubjectName = $CreditHour = $CourseStatus = $PreReq = $CourseCodeErr = $CoursestatusErrClass = $SubjectNameErr = $SubjectNameErrClass = $CreditHourErr = $CreditHourErrClass = $CourseStatusErr = $PreReqErr = $PreReqErrClass = $CourseSemErr = $CourseSemErrClass= "";

if(isset($_GET['id'])){
	$id=$_GET['id'];

	$sql = "SELECT * FROM subjects WHERE id= '$id' ";
  $result = mysqli_query($con,$sql);
    if($result){
        if(mysqli_num_rows($result)>0){          
            $row= mysqli_fetch_array($result);
            $CourseCode=$row['course_code'];
            $SubjectName=$row['subject_name'];
            $CreditHour = $row['credit_hours'];
            $PreReq = $row['pre_requisites'];
            $CourseStatus=$row['status'];
            $CourseSem = $row['offered_sem'];
        }
    }
}

				  
if (isset($_POST['editCourse'])){
		$SubjectName= $_POST['c_name'];
	  $CourseCode=$_POST['c_code'];
    $CreditHour=$_POST['c_credithour'];
	  $CourseStatus=$_POST['c_status'];
    $PreReq = $_POST['c_prereq'];
    $CourseSem = $_POST['c_sem'];
    $CourseProgram = $_POST['c_program'];
    $id = $_POST['id'];
					  
					  if(empty($CourseCode)){
						  $CourseCodeErr= " Course code is required" ;
						  $CourseCodeErrClass= "error";
					  }
            if(checkCourseCode($CourseCode,$id)){
              $CourseCodeErr="Course Code Already Exists" ;
              $CourseCodeErrClass="error";
            }
					  if(empty($SubjectName)){
						  $SubjectNameErr= " Subjct name is required" ;
						 $SubjectNameErrClass="error";
					  }
            if(empty($CreditHour)){
              $CreditHourErr= " CreditHours are required" ;
             $CreditHourErrClass="error";
            }
            if(empty($CourseStatus)){
              $CourseStatusErr= " Course Status is required" ;
             $CoursestatusErrClass="error";
            }
            if(empty($CourseSem)){
              $CourseSemErr= " Course Semester is required" ;
             $CourseSemErrClass="error";
            }
            if (!empty($PreReq) && $CourseSem ==  1) {
             $PreReqErr = "1st Semester subject cannot have a pre requisite";
             $PreReqErrClass = "error";
           }

    if(empty($CourseCodeErr)&& empty($SubjectNameErr) && empty($PreReqErr)){
      //$data=array('subject_name='."'".$SubjectName."'",'course_code='."'".$CourseCode."'",'status='."'".$courseStatus."'");
      // if(editRecord("subjects",$data,$id)){
      //   header("location:show_courses.php");
      // }else{
      //   $UpdationMsg="SomeThing Going Wrong Please Try again";
      // }
      $query = "UPDATE subjects 
                SET course_code='$CourseCode' , subject_name='$SubjectName' , pre_requisites='$PreReq', status = '$CourseStatus' , offered_sem = '$CourseSem' , program = '$CourseProgram'
                WHERE id = $id";
      if (mysqli_query($con,$query)) {
        $_SESSION['success'] = "Course Updated Succesfully";
         header("location:show_courses.php");
      }else{
        $_SESSION['error'] = "Error Occured";
      }
    }
  
}

?>
 <div class="content-wrapper">
    <?php
    include 'includes/breadcrumb.php';
    ?>

    <!-- Main content -->
    <section class="content">
   
      <div class="row">
       

<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Course</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <form method="POST" action="edit_courses.php" role="form">
                 
                  
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
                  <?php $sql="SELECT * from subjects where id != '$id' ORDER By subject_name ASC";
                  $res =mysqli_query($con,$sql);
                  while($data = mysqli_fetch_array($res)){ ?>
                    <option value='<?php echo $data['course_code']; ?>'><?php echo $data['subject_name']; ?></option>
                  <?php } ?>
                    
                  </select>
                </div>
                <div class="form-group">
                 <label>Credit Hours</label>
                  <input value="<?php echo  $CreditHour; ?>" class="form-control <?php echo  $CreditHourErrClass; ?>" type="text" placeholder="Enter Total Credit Hours For this Course" name="c_credithour"><span style="color: red;"><?php echo  $CreditHourErr; ?></span>
                </div> 

                <div class="form-group<?php echo $CourseSemErrClass;?>">
                  <label>Offered Semester</label>
                   <select name="c_sem" class="form-control">
                    <option <?php if ($CourseSem=='1'){echo "selected";}?> value='1'>1st</option>
                    <option <?php if ($CourseSem=='2'){echo "selected";}?> value="2">2nd</option>
                    <option <?php if ($CourseSem=='3'){echo "selected";}?> value="3">3rd</option>
                    <option <?php if ($CourseSem=='4'){echo "selected";}?> value="4">4th</option>
                    <option <?php if ($CourseSem=='5'){echo "selected";}?> value="5">5th</option>
                    <option <?php if ($CourseSem=='6'){echo "selected";}?> value="6">6th</option>
                    <option <?php if ($CourseSem=='7'){echo "selected";}?> value="7">7th</option>
                    <option <?php if ($CourseSem=='8'){echo "selected";}?> value="8">8th</option>
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
                <div class="form-group<?php echo $CoursestatusErrClass;?>">
                  <label>Status</label>
                   <select name="c_status" class="form-control">
                    <option <?php if ($CourseStatus=='1'){echo "selected";}?> value='1'>Offer</option>
                    <option <?php if ($CourseStatus=='0'){echo "selected";}?> value="0">Block</option>
                  </select>
                  <span style="color: red;"><?php echo $CourseStatusErr; ?></span>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">



                <div>
                  <input type="submit" name="editCourse" class="btn btn-sm btn-info" value="Edit Course">
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
						  
		  
				 



  
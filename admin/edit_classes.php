<?php
ob_start();
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';


$ClassTitleErr = $ClassTitleErrClass = $ClassCodeErr = $ClassCodeErrClass =$classStatus=$UpdationMsg= $ClassTitle = $ClassCode= $updataionMsg = $ClassStatusErrClass= $ClassStatusErr ="";

if(isset($_GET['id'])){
	$id=$_GET['id'];
	
}



$sql = "SELECT * FROM classes WHERE id= '$id' ";
                $result = mysqli_query($con,$sql);
                if($result){
                  if(mysqli_num_rows($result)>0){
					  
					  $row= mysqli_fetch_array($result);
					  $ClassCode=$row['class_code'];
					  $ClassTitle=$row['class_name'];
					  $classStatus=$row['status'];
				  }
				  }
				  
				  if (isset($_POST['editClass'])){
					  $ClassTitle= $_POST['ClassTitle'];
					  $ClassCode=$_POST['ClassCode'];
					  $classStatus=$_POST['classStatus'];
					  
					  if(empty($ClassCode)){
						  $ClassCodeErr= " Class code is required" ;
						  $ClassCodeErrClass= "error";
					  }
					  if(empty($ClassTitle)){
						   $ClassTitleErr= " Class name is required" ;
						  $ClassTitleErrClass="error";
						  
					  }
					  if(!empty($ClassCode)){
  if(checkCourseCode($ClassCode,$id)){
    $ClassCodeErr="Class Code is Already Exist" ;
    $ClassCodeErrClass="error";

  }else{
    if(empty($ClassCodeErr)&& empty($ClassTitleErr)){
      $data=array('class_name='."'",$ClassTitle."'",'Class_code='."'".$ClassCode."'",'Status='."'".$classStatus."'");
      if(editRecord("classes",$data,$id)){
        header("location:show_classes.php");
      }else{
        $UpdationMsg="SomeThing Going Wrong Please Try again";
      }
    }
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
              <h3 class="box-title">Edit Class</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php echo $UpdationMsg; ?>
               <form method="POST" action="edit_classes.php?id=<?php echo $id;?>" role="form">
                 
                  
                    <div class="form-group">
                  <label>Class Title</label>
                  <input  class="form-control <?php echo $ClassTitleErrClass; ?>" type="text" placeholder="Enter Class Title" name="ClassTitle" value="<?php echo $ClassTitle; ?>"><span style="color: red;"><?php echo $ClassTitleErr; ?></span>

                </div>

                <div class="form-group">
                  <label>Class Code</label>

                  <input  class="form-control <?php echo $ClassCodeErrClass; ?>" type="text" placeholder="Enter Class Code" name="ClassCode" value="<?php echo $ClassCode; ?>" ><span style="color: red;"><?php echo $ClassCodeErr; ?> </span>
                  
                </div>

                <div class="form-group<?php echo $ClassstatusErrClass;?>">
                  <label>Status</label>
                   <select name="classStatus" class="form-control">
                    <option <?php if ($classStatus=='1'){echo "selected";}?> value='1'>Activate</option>
                    <option<?php if ($classStatus=='0'){echo "selected";}?> value="0">Block</option>
                  </select>
                  <span style="color: red;"><?php echo $ClassStatusErr; ?></span>
                </div>



                <div>
                  <input type="submit" name="editClass" class="btn btn-sm btn-info" value="Edit Class">
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
						  
		  
				 



  
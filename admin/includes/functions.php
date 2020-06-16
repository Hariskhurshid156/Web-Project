<?php 
include("connection.php"); //db connection  


function check_sessions(){
	if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])  && isset($_SESSION['user_type'])  && isset($_SESSION['user_status'])  && isset($_SESSION['name'])){
		return true;
	}else{
		return false;
	}
}
function login($username,$password){
	global $con;
	$ency_pass = md5(md5($password));

	$sql = "SELECT * FROM admin WHERE username = '$username' and password = '$ency_pass'";
	$result = mysqli_query($con,$sql);
	if($result){
		if(mysqli_num_rows($result)>0){
			$row = mysqli_fetch_assoc($result);

			$_SESSION['user_id'] = $row['id'];
			$_SESSION['user_name'] = $row['username'];
			$_SESSION['user_type'] = $row['type'];
			$_SESSION['user_status'] = $row['status'];
			$_SESSION['name'] = $row['fullname'];

			if(check_sessions()){
				return true;
			}

		}else{
			echo "Wrong username or password please try again";
			return false;
		}
	}

}


function addCourse($CourseCode,$SubjectName){
	global $con;
	$sql = "INSERT INTO subjects (`course_code`,`subject_name`) VALUES ('$CourseCode','$SubjectName')";
	$result = mysqli_query($con,$sql);
	if($result){
		return true;
	}
}



function editRecord($tbl_name,$data,$id)
{
	global $con;
	$data = implode(",", $data);
	
	//UPDATE subjects SET class_name ='Ecom WebWe',class_code ='WDD10E' WHERE id= '12'

	$sql = "UPDATE ".$tbl_name." SET ".$data. " WHERE id= '$id'";
	$result = mysqli_query($con,$sql);
	if($result){
		return true;
	}
}



function checkCourseCode($CourseCode,$id=""){
	global $con;

	if(!empty($id)){
		$whereClause = "WHERE course_code = '$CourseCode' and id != '$id'";
	}else{
		$whereClause = "WHERE course_code = '$CourseCode'";
	}
	$sql = "SELECT course_code FROM subjects ".$whereClause;
	$result = mysqli_query($con,$sql);
	if($result){
		if(mysqli_num_rows($result)>0){
			return true;
		}
	}
}

function checkSubjectName($SubjectName,$id=""){
	global $con;


	if(!empty($id)){
		$whereClause = "WHERE subject_name = '$SubjectName' and id != '$id'";
	}else{
		$whereClause = "WHERE subject_name= '$SubjectName'";
	}
	$sql = "SELECT subject_name FROM subjects ".$whereClause;
	$result = mysqli_query($con,$sql);
	if($result){
		if(mysqli_num_rows($result)>0){
			return true;
		}
	}
}
function getStatus($status){
			if($status == "1"){
				return "Active <i style='color:green;' class='fa fa-check'></i>";
			}
			if($status == "0"){
				return "Blocked <i style='color:red;' class='fa fa-close'></i>";
			}
}




function getName($tbl_name,$id){
	global $con;
	$sql = "SELECT subject_name FROM ".$tbl_name." WHERE id = '$id'";
	$result = mysqli_query($con,$sql);
	if($result){
		if(mysqli_num_rows($result)>0){
			$row = mysqli_fetch_assoc($result); 
			return $row['subject_name'];
		}
	}
}



function delete_record($tbl_name,$id)
{
	global $con;
	$sql = "DELETE FROM ".$tbl_name." WHERE id = '$id'";
	$result = mysqli_query($con,$sql);
	if($result){
		return true;
	}
}



function getTotal($tbl_name,$status="1"){     
	global $con;
	//$sql="SELECT count(*) as tot_rec FROM tbl";
	$sql = "SELECT * FROM ".$tbl_name;
	$result = mysqli_query($con,$sql);
	if($result){
		return mysqli_num_rows($result);
	}
}




function getAllClasses($stdClass=""){
	global $con;
	$options = $selected = "";

	$sql = "SELECT * FROM  subjects ORDER BY id DESC";
	$result = mysqli_query($con,$sql);
	if($result){
		if( mysqli_num_rows($result) >0){
			while ($row = mysqli_fetch_array($result)) {
				$id = $row['id'];
				$class = $row['subject_name'];

				if($stdClass == $id){
					$selected = "selected=selected";
				}else{
					$selected ="";
				}

				 $options .= "<option $selected  value='$id'>".$class."</option>";
			}
			return $options ;
		}
	}
}



function addStd($stdName,$stdFather,$stdClass,$stdAddress){


	global $con;
	$sql = "INSERT INTO students (`class_id`,`name`,`fname`,`address`) VALUES ('$stdClass','$stdName','$stdFather','$stdAddress')";
	$result = mysqli_query($con,$sql);
	if($result){
		return true;
	}

}



?> 

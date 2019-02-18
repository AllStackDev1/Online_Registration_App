<?php

//Login Function 
	function AdminLogIn($db="",$user_email="",$user_pass="") {

		$strSQL 	= "SELECT * FROM `admin_tb` WHERE email='$user_email'";
		$query 		= mysqli_query($db, $strSQL);
		$numrows 	= @mysqli_num_rows($query);

		if($numrows > 0){
		    while($row = mysqli_fetch_assoc($query)){
			    $dbuser_name  = $row['name'];
			    $dbuser_email = $row['email'];
			    $dbuser_pass  = $row['password'];

		    }
			if($user_pass === $dbuser_pass){
		    	$retVal = array('success' => true, 'admin_name' => $dbuser_name, 'admin_email' => $dbuser_email);
		        echo json_encode($retVal);
		    }else{
		    	$retVal = array('success' => false, 'error' => '-1', 'reason' => 'Email or Password is Incorrect');
		        echo json_encode($retVal);
		    }
		}else{
		    $retVal = array('success' => false, 'error' => '-2', 'reason' => 'Email or Password is Incorrect');
			echo json_encode($retVal);
		}
	}

	function Login($db="",$user_email="",$user_pass="") {
		$strSQL 	= "SELECT * FROM `user_tb` WHERE user_email='$user_email'";
		$query 		= mysqli_query($db, $strSQL);
		$numrows 	= @mysqli_num_rows($query);

		if($numrows > 0){
		    while($row = mysqli_fetch_assoc($query)){
			    $dbuser_name  = $row['user_name'];
			    $dbuser_email = $row['user_email'];
			    $dbuser_pass  = $row['user_pass'];
			    $dbuser_schoolids = explode(",", $row['sz_schoolid']);

		    }
			if($user_pass === $dbuser_pass){
		    	$retVal = array('success' => true, 'user_name' => $dbuser_name, 'user_email' => $dbuser_email, 'user_schoolid' => $dbuser_schoolids[0]);
		        echo json_encode($retVal);
		    }else{
		    	$retVal = array('success' => false, 'error' => '-1', 'reason' => 'Email or Password is Incorrect');
		        echo json_encode($retVal);
		    }
		}else{
		    $retVal = array('success' => false, 'error' => '-2', 'reason' => 'Email or Password is Incorrect');
			echo json_encode($retVal);
		}
	}
// Get User Data
	function GetPersonalData($db="",$user_email="") {
		$strSQL 	= "SELECT * FROM `user_tb` WHERE user_email='$user_email'";
		$query 		= mysqli_query($db, $strSQL);
		$numrows 	= @mysqli_num_rows($query);

		if($numrows > 0) {
		    while($row = mysqli_fetch_assoc($query)) {

				$rows[] = $row;
			}
			echo json_encode($rows);
		}else {
			$error = array('success' => false, 'reason' => array('message' => 'No Record Found'));
		    echo json_encode($error);
		}
	}

	function GetGuardianData($db="",$user_email="") {
		$strSQL 	= "SELECT * FROM `guardian_tb` WHERE user_email='$user_email'";
		$query 		= mysqli_query($db, $strSQL);
		$numrows 	= @mysqli_num_rows($query);

		if($numrows > 0) {
		    while($row = mysqli_fetch_assoc($query)) {

				$rows[] = $row;
			}
			echo json_encode($rows);
		}else {
			$error = array('success' => false, 'reason' => array('message' => 'No Record Found'));
		    echo json_encode($error);
		}
	}

	function GetEducationData($db="",$user_email="") {
		$strSQL 	= "SELECT * FROM `education_history_tb` WHERE user_email='$user_email'";
		$query 		= mysqli_query($db, $strSQL);
		$numrows 	= @mysqli_num_rows($query);

		if($numrows > 0) {
		    while($row = mysqli_fetch_assoc($query)) {

				$rows[] = $row;
			}
			echo json_encode($rows);
		}else {
			$error = array('success' => false, 'reason' => array('message' => 'No Record Found'));
		    echo json_encode($error);
		}
	}

	function GetExamsResultsData($db="",$user_email="") {
		$strSQL 	= "SELECT * FROM `exams_results_tb` WHERE user_email='$user_email'";
		$query 		= mysqli_query($db, $strSQL);
		$numrows 	= @mysqli_num_rows($query);

		if($numrows > 0) {
		    while($row = mysqli_fetch_assoc($query)) {

				$rows[] = $row;
			}
			echo json_encode($rows);
		}else {
			$error = array('success' => false, 'reason' => array('message' => 'No Record Found'));
		    echo json_encode($error);
		}
	}

	function GetProgramsData($db="",$user_email="") {
		$strSQL 	= "SELECT * FROM `programs_tb` WHERE user_email='$user_email'";
		$query 		= mysqli_query($db, $strSQL);
		$numrows 	= @mysqli_num_rows($query);

		if($numrows > 0) {
		    while($row = mysqli_fetch_assoc($query)) {

				$rows[] = $row;
			}
			echo json_encode($rows);
		}else {
			$error = array('success' => false, 'reason' => array('message' => 'No Record Found'));
		    echo json_encode($error);
		}
	}

	function CheckRegCodeValid($db="",$reg_code="", $sz_schoolid="") {
		$strSQL 	= "SELECT `reg_code` FROM `reg_code_tb` WHERE `reg_code`='$reg_code' AND `sz_schoolid`='$sz_schoolid'";
		$query 		= mysqli_query($db, $strSQL);
		$numrows 	= @mysqli_num_rows($query);

		if($numrows === 1){
			$retVal = 	json_encode(array('success' => true, 'reason' => 'Registration code is valid'));
			echo $retVal;
		}else{
			$retVal = 	json_encode(array('success' => false, 'reason' => 'Registration code is invalid'));
			echo $retVal;
		}
	}	
// Registration Function
	function Registration($db="",$sz_schoolid="",$reg_code="",$user_name="",$user_email="",$user_pass="") {
		$db 		= new mysqli('localhost','root','','ikoliluonlineapp_db');
		$strSQL 	= "SELECT `user_email` FROM `user_tb` WHERE `user_email`='$user_email'";
		$query 		= mysqli_query($db, $strSQL);
		$numrows 	= @mysqli_num_rows($query);

		if($numrows == 0){

			$strSQL 	= "INSERT INTO `user_tb`(`id`, `user_name`, `user_email`, `user_pass`, `reg_code`, `sz_schoolid`) VALUES ('','$user_name','$user_email','$user_pass','$reg_code','$sz_schoolid')";
			$query 		= mysqli_query($db, $strSQL);

			if($query) {
				$retVal = 	json_encode(array('success' => true, 'reason' => 'Registration Successful'));
				echo $retVal;
			} else {
		    	$retVal = 	json_encode(array('success' => false, 'error_no' => '-1', 'reason' => 'An unexpected error occur while saving data. Please try again'));
				echo $retVal;
			}			
		}else{
			$retVal = 	json_encode(array('success' => false, 'error_no' => '-2', 'reason' => 'Email has been registered.'));
			echo $retVal;
		}
	}
// Change Password Function
	function ChangePassword($db="",$user_email="",$user_pass=""){
		$strSQL 	= "SELECT `user_email` FROM `user_tb` WHERE `user_email`='$user_email'";
		$query 		= mysqli_query($db, $strSQL);
		$numrows 	= @mysqli_num_rows($query);

		if($numrows > 0){

			$strSQL 	= "INSERT INTO `user_tb`(`id`, `user_name`, `user_email`, `user_pass`, `reg_code`, `sz_schoolid`) VALUES ('','$user_name','$user_email','$user_pass','$reg_code','$sz_schoolid')";
			$query 		= mysqli_query($db, $strSQL);

			if($query) {
				$retVal = 	json_encode(array('success' => true, 'reason' => 'Password Successfully Changed...'));
				echo $retVal;
			} else {
		    	$retVal = 	json_encode(array('success' => false, 'error_no' => '-1', 'reason' => 'An unexpected error occur while saving data. Please try again'));
				echo $retVal;
			}			
		}else{
			$retVal = 	json_encode(array('success' => false, 'error_no' => '-2', 'reason' => 'Email not Registered...'));
			echo $retVal;
		}
	}
// User New School Application Function
	function UserNewSchoolApplication($db="",$sz_schoolid="",$reg_code="",$user_email="") {
		$strSQL 	= "SELECT `sz_schoolid`,`reg_code` FROM `user_tb` WHERE `user_email`='$user_email'";
		$query 		= mysqli_query($db, $strSQL);
		$numrows 	= @mysqli_num_rows($query);


		if($numrows > 0){

		    $row = mysqli_fetch_assoc($query);
			$dbsz_schoolid 	= $row['sz_schoolid'];
			$dbreg_code 	= $row['reg_code'];

			$newsz_schoolid = $dbsz_schoolid.','.$sz_schoolid;
			$newreg_code 	= $dbreg_code.','.$reg_code;
			
			$strSQL 	= "UPDATE `user_tb` SET `sz_schoolid`='$newsz_schoolid',`reg_code`='$newreg_code' WHERE `user_email`='$user_email'";
			$query 		= mysqli_query($db, $strSQL);

				if($query) {
					$retVal = 	json_encode(array('success' => true, 'reason' => 'School Added'));
					echo $retVal;
				} else {
			    	$retVal = 	json_encode(array('success' => false, 'reason' => 'An unexpected error occur while saving data. Please try again'));
					echo $retVal;
				}			

		}else {
			$error = array('success' => false, 'reason' => array('message' => 'Fatal Error Occur'));
		    echo json_encode($error);
		}
	}
// Schools With Open Application Function
	function SchoolWithOpenApplication($db="") {
		$strSQL 	= "SELECT `sz_schoolid`, `sz_schoolname` FROM `open_application_tb`";
		$query 		= mysqli_query($db, $strSQL);
		$numrows 	= @mysqli_num_rows($query);

		if($numrows > 0) {
		    while($row = mysqli_fetch_assoc($query)) {

				$rows[] = $row;
			}
			echo json_encode($rows);
		}else {
			$error = array('success' => false, 'reason' => array('message' => 'No Record Found'));
		    echo json_encode($error);
		}
	}
// User Schools Function
	function UserSchools($db="",$user_email="") {
		$strSQL 	= "SELECT `sz_schoolid` FROM `user_tb` WHERE `user_email`='$user_email'";
		$query 		= mysqli_query($db, $strSQL);
		$numrows 	= @mysqli_num_rows($query);

		if($numrows > 0) {
			$row = mysqli_fetch_assoc($query);
			
			$sz_schoolids = explode(",", $row['sz_schoolid']);
			$dataarray = '[';
			foreach($sz_schoolids as $sz_schoolid) {

				$strSQL_schoolname  	= "SELECT `sz_schoolname` FROM `open_application_tb` WHERE `sz_schoolid`='$sz_schoolid'";
				$query_schoolname  		= mysqli_query($db, $strSQL_schoolname);
				$row_schoolname 		= mysqli_fetch_assoc($query_schoolname);

				$sz_schoolname	= $row_schoolname['sz_schoolname'];
				$dataarray .= '{"sz_schoolid":"'.$sz_schoolid.'","sz_schoolname":"'.$sz_schoolname.'"},';
			
			}
			$dataarray = chop($dataarray, ',');
			$dataarray .= ']';
			echo $dataarray;
			
		}else {
			$error = array('success' => false, 'reason' => array('message' => 'No Record Found'));
		    echo json_encode($error);
		}
	}
// Updating user data
	function UpdatePersonal($db="",$image="",$title="",$firstname="",$lastname="",$othername="",$gender="",$dateofbirth="",$nationality="",$religion="",$country="",$home="",$region="",$phone="",$address="",$user_email=""){

		$user_name = $lastname.' '.$firstname.' '.$othername;

		$strSQL = "UPDATE `user_tb` SET `user_name`= '$user_name',`image`='$image',`title`='$title',`gender`='$gender',`dateofbirth`='$dateofbirth',`nationality`='$nationality',`religion`='$religion',`country`='$country',`home`='$home',`region`='$region',`phone`='$phone',`address`='$address' WHERE `user_email`='$user_email'";

		$query 	= mysqli_query($db, $strSQL);

		if($query){
			$retVal = 	json_encode(array('success' => true, 'message' => 'Data Successfully Saved'));
			echo $retVal;
		}else {
			$error = array('success' => false, 'message' => 'Error While Saving Data');
		    echo json_encode($error);
		}
	}

	function AddEducation($db="",$school_name="",$startyear="",$endyear="",$certificate="",$user_email=""){

		$strSQL 	= "INSERT INTO `education_history_tb`(`id`, `school_name`, `startyear`, `endyear`, `certificate`, `user_email`) VALUES ('','$school_name','$startyear','$endyear','$certificate','$user_email')";
		$query 		= mysqli_query($db, $strSQL);

		if($query) {
			$retVal = 	json_encode(array('success' => true, 'message' => 'Data Successfully Saved'));
			echo $retVal;
		} else {
	    	$retVal = 	json_encode(array('success' => false, 'message' => 'Error while saving data. Please try again'));
			echo $retVal;
		}			
	}

	function AddGuardian($db="",$relation_type="",$relation_name="",$relation_phone_no="",$relation_email="",$relation_occupation="",$relation_e_contact="",$relation_address="",$user_email=""){

		$strSQL 	= "INSERT INTO `guardian_tb`(`id`, `relation_type`, `relation_name`, `relation_phone_no`, `relation_email`, `relation_occupation`, `relation_e_contact`, `relation_address`, `user_email`) VALUES ('','$relation_type','$relation_name','$relation_phone_no','$relation_email','$relation_occupation','$relation_e_contact','$relation_address','$user_email')";
		$query 		= mysqli_query($db, $strSQL);

		if($query) {
			$retVal = 	json_encode(array('success' => true, 'message' => 'Data Successfully Saved'));
			echo $retVal;
		} else {
	    	$retVal = 	json_encode(array('success' => false, 'message' => 'Error while saving data. Please try again'));
			echo $retVal;
		}

	}

	function AddPrograms($db="",$ismatured="",$programme="",$choice_one="",$choice_two="",$choice_three="",$user_email=""){

		$strSQL 	= "INSERT INTO `programs_tb`(`id`, `ismatured`, `programme`, `first_choice`, `second_choice`, `third_choice`, `user_email`) VALUES ('','$ismatured','$programme','$choice_one','$choice_two','$choice_three','$user_email')";
		$query 		= mysqli_query($db, $strSQL);

		if($query) {
			$retVal = 	json_encode(array('success' => true, 'message' => 'Data Successfully Saved'));
			echo $retVal;
		} else {
	    	$retVal = 	json_encode(array('success' => false, 'message' => 'Error while saving data. Please try again'));
			echo $retVal;
		}

	}

	function AddExamsHistory($db="",$type="",$sitting="",$year="",$index_no="",$user_email=""){

		$strSQL 	= "INSERT INTO `exams_results_tb`(`id`, `type`, `sitting`, `year`, `index_no`, `user_email`) VALUES ('','$type','$sitting','$year','$index_no','$user_email')";
		$query 		= mysqli_query($db, $strSQL);

		if($query) {
			$retVal = 	json_encode(array('success' => true, 'message' => 'Data Successfully Saved'));
			echo $retVal;
		} else {
	    	$retVal = 	json_encode(array('success' => false, 'message' => 'Error while saving data. Please try again'));
			echo $retVal;
		}

	}

	function AddExamsResults($db="",$grade,$subject,$user_email=""){

		$strSQL 	= "INSERT INTO `exams_results_tb`(`id`, `grade`, `subject`, `user_email`) VALUES ('','$grade','$subject',$user_email')";
		$query 		= mysqli_query($db, $strSQL);

		if($query) {
			$retVal = 	json_encode(array('success' => true, 'message' => 'Data Successfully Saved'));
			echo $retVal;
		} else {
	    	$retVal = 	json_encode(array('success' => false, 'message' => 'Error while saving data. Please try again'));
			echo $retVal;
		}

	}
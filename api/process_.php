<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once 'ikolilu_ORAPI_.php';
require_once 'function_.php';

// client request..
$apiPathURL = trim($_SERVER['REQUEST_URI']);

$construct = new CreateFunction($apiPathURL);

$functionName = $construct->GetEndPoint();

$db = new mysqli('localhost','root', '','ikoliluonlineapp_db');

  switch($functionName) {
  	case 'AdminLogIn':
  		$user_email 	= $_REQUEST['email'];
		$user_pass 		= $_REQUEST['password'];
		return AdminLogIn($db,$user_email,$user_pass);
  		break;
  	case 'Login':
  		$user_email 	= $_REQUEST['user_email'];
		$user_pass 		= $_REQUEST['user_pass'];
		return Login($db,$user_email,$user_pass);
  		break;
  	case 'GetPersonalData':
		$user_email 	= $_REQUEST['user_email'];
  		return GetPersonalData($db,$user_email);
  		break;
  	case 'GetGuardianData':
		$user_email 	= $_REQUEST['user_email'];
  		return GetGuardianData($db,$user_email);
  		break;
  	case 'GetEducationData':
		$user_email 	= $_REQUEST['user_email'];
  		return GetEducationData($db,$user_email);
  		break;
  	case 'GetExamsResultsData':
		$user_email 	= $_REQUEST['user_email'];
  		return GetExamsResultsData($db,$user_email);
  		break;
  	case 'GetProgramsData':
		$user_email 	= $_REQUEST['user_email'];
  		return GetProgramsData($db,$user_email);
  		break;
  	case 'CheckRegCodeValid':
	  	$sz_schoolid 	= $_REQUEST['sz_schoolid'];
		$reg_code 	 	= $_REQUEST['reg_code'];
  		return CheckRegCodeValid($db,$reg_code,$sz_schoolid);
  		break;
  	case 'Registration':
		$sz_schoolid 	= $_REQUEST['sz_schoolid'];
		$reg_code 		= $_REQUEST['reg_code'];
		$user_name 		= $_REQUEST['user_name'];
		$user_email 	= $_REQUEST['user_email'];
		$user_pass 		= $_REQUEST['user_pass'];
		return Registration($db,$sz_schoolid,$reg_code,$user_name,$user_email,$user_pass);
  		break;
  	case 'ChangePassword':
		$user_email 	= $_REQUEST['u_email'];
		$user_pass 		= $_REQUEST['u_new_password'];
		return ChangePassword($db,$user_email,$user_pass);
		break;
	case 'UserNewSchoolApplication':
		$sz_schoolid 	= $_REQUEST['sz_schoolid'];
		$reg_code 		= $_REQUEST['reg_code'];
		$user_email 	= $_REQUEST['user_email'];
		return UserNewSchoolApplication($sz_schoolid,$reg_code,$user_email);
		break;
	case 'UserSchools':
		$user_email 	= $_REQUEST['user_email'];
		return UserSchools($db,$user_email);
		break;
  	case 'SchoolWithOpenApplication':
  		return SchoolWithOpenApplication($db);
  		break;
  	case 'UpdatePersonal':

		$image 			= mysqli_real_escape_string($db, $_REQUEST['image']);
		$title 			= $_REQUEST['title'];
		$firstname 		= $_REQUEST['firstname'];
		$lastname 		= $_REQUEST['lastname'];
		$othername 		= $_REQUEST['othername'];
		$gender 		= $_REQUEST['gender'];
		$dateofbirth 	= $_REQUEST['dateofbirth'];
		$nationality 	= $_REQUEST['nationality'];
		$religion 		= $_REQUEST['religion'];
		$country 		= $_REQUEST['country'];
		$home 			= $_REQUEST['home'];
		$region 		= $_REQUEST['region'];
		$phone 			= $_REQUEST['phone'];
		$address 		= $_REQUEST['address'];
		$user_email 	= $_REQUEST['user_email'];

  		return UpdatePersonal($db,$image,$title,$firstname,$lastname,$othername,$gender,$dateofbirth,$nationality,$religion,$country,$home,$region,$phone,$address,$user_email);
  		break;	
  	case 'AddEducation':
		$school_name 	= $_REQUEST['school_name'];
		$startyear 	= $_REQUEST['startyear'];
		$endyear 	= $_REQUEST['endyear'];
		$certificate 	= $_REQUEST['certificate'];
		$user_email 	= $_REQUEST['user_email'];
		return AddEducation($db,$school_name,$startyear,$endyear,$certificate,$user_email);
		break;
  	case 'AddGuardian':
		$relation_type 	= $_REQUEST['relation_type'];
		$relation_name 	= $_REQUEST['relation_name'];
		$relation_phone_no 	= $_REQUEST['relation_phone_no'];
		$relation_email 	= $_REQUEST['relation_email'];
		$relation_occupation 	= $_REQUEST['relation_occupation'];
		$relation_e_contact 	= $_REQUEST['relation_e_contact'];
		$relation_address 	= $_REQUEST['relation_address'];
		$user_email 	= $_REQUEST['user_email'];
		return AddGuardian($db,$relation_type,$relation_name,$relation_phone_no,$relation_email,$relation_occupation,$relation_e_contact,$relation_address,$user_email);
		break;
  	case 'AddPrograms':
		$ismatured 		= $_REQUEST['ismatured'];
		$programme 		= $_REQUEST['programme'];
		$choice_one 	= $_REQUEST['choice_one'];
		$choice_two 	= $_REQUEST['choice_two'];
		$choice_three 	= $_REQUEST['choice_three'];
		$user_email 	= $_REQUEST['user_email'];
		return AddPrograms($db,$ismatured,$programme,$choice_one,$choice_two,$choice_three,$user_email);
		break;
  	case 'AddExamsHistory':
		$type 	= $_REQUEST['type'];
		$sitting 	= $_REQUEST['sitting'];
		$year 	= $_REQUEST['year'];
		$index_no 	= $_REQUEST['index_no'];
		$user_email 	= $_REQUEST['user_email'];
		return AddExamsHistory($db,$type,$sitting,$year,$index_no,$user_email);
		break;
  	case 'AddExamsResults':
		$grade 	= $_REQUEST['grade'];
		$subject 	= $_REQUEST['subject'];
		$user_email 	= $_REQUEST['user_email'];
		return AddExamsResults($db,$grade,$subject,$user_email);
		break;
	default:
	  	$error = array('success' => false, 'error' => 'No End Point Found');
	    echo json_encode($error);
  }

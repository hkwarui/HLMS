<?php
require_once('../includes/Dbconnect.php');
include("../auth.php");
  $eid = $_SESSION['username'];
$form_name = $_POST['form_name'];


if($form_name == 'add_user'){
	$leave_type = mysqli_real_escape_string($DBcon, $_POST['leave_type']);
	$date_from = mysqli_real_escape_string($DBcon, $_POST['date_from']);
	$date_to = mysqli_real_escape_string($DBcon, $_POST['date_to']);
	$comment = mysqli_real_escape_string($DBcon, $_POST['comment']);
	$employee_id = $eid;
	

	$query = "INSERT INTO leave_request(leave_request_employee_id, leave_request_type, leave_request_start_date, leave_request_end_date, leave_request_comments )
			  values('$eid','$leave_type','$date_from','$date_to','$comment')";
	$result = mysqli_query($DBcon, $query) or die(mysqli_error($DBcon));
	if($result)
		echo "1";
	else
		echo "0";
}

if($form_name == "del_user"){
	$chk_val = 0;
	$tbl_id = mysqli_real_escape_string($DBcon, $_POST['tbl_id']);

	if( $chk_val == 0){
		$query = "DELETE  FROM  leave_request  WHERE leave_id ='$tbl_id'";
		$result = mysqli_query($DBcon, $query) or die(mysqli_error($DBcon));
		if($result)
			echo "1";
		else
			echo "0";
	}
	else{
		echo "404-del";
	}
}

?>

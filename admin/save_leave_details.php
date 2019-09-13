<?php
require_once('../includes/Dbconnect.php');

$form_name = $_POST['form_name'];

if($form_name == "edit_user"){
   $action_leave = mysqli_real_escape_string($DBcon, $_POST['action_leave']);
   $edit_id = mysqli_real_escape_string($DBcon, $_POST['edit_id']);

    $query = "UPDATE leave_request SET leave_request_status = '$action_leave' WHERE leave_id ='$edit_id'";

    $result = mysqli_query($DBcon, $query) or die(mysqli_error($DBcon));
    if($result)
        echo "1";
    else
        echo "0";
}

?>

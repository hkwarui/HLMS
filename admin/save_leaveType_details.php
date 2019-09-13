<?php
require_once('../includes/Dbconnect.php');

$form_name = $_POST['form_name'];

if($form_name == 'add_user'){
    $type_name = mysqli_real_escape_string($DBcon, $_POST['type_name']);
    $type_max_days = mysqli_real_escape_string($DBcon, $_POST['type_max_days']);

    $query = "INSERT INTO leaveType_table ( leave_type_name, leave_type_maxDays)VALUES('$type_name', '$type_max_days')";

    $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
    if($result)
        echo "1";
    else
        echo "0";
}

?>

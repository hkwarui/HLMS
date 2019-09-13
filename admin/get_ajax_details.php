<?php
require_once('../includes/Dbconnect.php');
$cmd = $_REQUEST['cmd'];

if($cmd == "get_user_details"){
    $tbl_id = $_REQUEST['tbl_id'];
    $out_put = array();
    $query = "select * from employee_table where employ_id='$tbl_id'";
    $result = mysqli_query($DBcon, $query) or die(mysqli_error($DBcon));
    $row = mysqli_fetch_assoc($result);

    echo json_encode($row);
}

?>

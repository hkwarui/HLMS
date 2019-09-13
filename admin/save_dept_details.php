<?php
require_once('../includes/Dbconnect.php');

$form_name = $_POST['form_name'];

if($form_name == 'add_user'){

    $dept_name = mysqli_real_escape_string($DBcon, $_POST['dept_name']);
    $dept_summary = mysqli_real_escape_string($DBcon, $_POST['dept_summary']);
    $dept_hod = mysqli_real_escape_string($DBcon, $_POST['dept_hod']);
    $dept_ext = mysqli_real_escape_string($DBcon, $_POST['dept_ext']);

    $query = "INSERT INTO department (dept_name, dept_summary, dept_hod, dept_ext) VALUES ('$dept_name', '$dept_summary', '$dept_hod','$dept_ext')";

    $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
    if($result)
        echo "1";
    else
        echo "0";
}

if($form_name == "edit_user"){

    $dept_name = mysqli_real_escape_string($DBcon, $_POST['dept_name']);
    $dept_summary = mysqli_real_escape_string($DBcon, $_POST['dept_summary']);
    $dept_hod = mysqli_real_escape_string($DBcon, $_POST['dept_hod']);
    $dept_ext = mysqli_real_escape_string($DBcon, $_POST['dept_ext']);
    $edit_id = mysqli_real_escape_string($DBcon, $_POST['edit_id']);

    $query = "UPDATE department SET dept_name = '$dept_name', dept_summary ='$dept_summary', dept_hod ='$dept_hod', dept_ext ='$dept_ext' WHERE dept_id ='$edit_id'";

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
        $query = "DELETE FROM department  WHERE dept_id ='$tbl_id'";
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

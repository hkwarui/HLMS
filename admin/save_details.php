<?php
require_once('../includes/Dbconnect.php');
include('../auth.php');
$eid = $_SESSION['username'];

$form_name = $_POST['form_name'];

if($form_name == 'add_user'){
    $first_name = mysqli_real_escape_string($DBcon, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($DBcon, $_POST['last_name']);
    $employee_id= mysqli_real_escape_string($DBcon, $_POST['employee_id']);
    $gender = mysqli_real_escape_string($DBcon, $_POST['gender']);
    $contact = mysqli_real_escape_string($DBcon, $_POST['contact']);
    $email = mysqli_real_escape_string($DBcon,  $_POST['email']);
    $title = mysqli_real_escape_string($DBcon, $_POST['title']);
    $address = mysqli_real_escape_string($DBcon, $_POST['address']);
    $department = mysqli_real_escape_string($DBcon, $_POST['department']);
    $dob = mysqli_real_escape_string($DBcon, $_POST['dob']);
    $user = "user";
    $pass = sha1($user);

    $query = "INSERT INTO employee_table(employee_fname, employee_lname, employee_email, employee_id, employee_gender,employee_title, employee_contact ,employee_address, employee_department, employee_date_of_birth ,employee_date_employed)VALUES('$first_name', '$last_name', '$email','$employee_id','$gender','$title','$contact','$address','$department','$dob',Now() )";

    $query1 = "INSERT INTO login_table(login_username, login_password)VALUES('$employee_id','$pass')";

    $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
    $result1 = mysqli_query($DBcon,$query1) or die(mysqli_error($DBcon));
    if($result && $result1)
        echo "1";
    else
        echo "0";
}

if($form_name == "edit_user"){
    $first_name = mysqli_real_escape_string($DBcon, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($DBcon, $_POST['last_name']);
    $employee_id= mysqli_real_escape_string($DBcon, $_POST['employee_id']);
    $gender = mysqli_real_escape_string($DBcon, $_POST['gender']);
    $contact = mysqli_real_escape_string($DBcon, $_POST['contact']);
    $email = mysqli_real_escape_string($DBcon,  $_POST['email']);
    $title = mysqli_real_escape_string($DBcon, $_POST['title']);
    $address = mysqli_real_escape_string($DBcon, $_POST['address']);
    $department = mysqli_real_escape_string($DBcon, $_POST['department']);
    $dob  = mysqli_real_escape_string($DBcon, $_POST['dob']);
    $edit_id = mysqli_real_escape_string($DBcon, $_POST['edit_id']);

    $query = "UPDATE employee_table SET employee_id = '$employee_id', employee_fname='$first_name', employee_lname='$last_name', employee_gender ='$gender',employee_email = '$email',employee_title ='$title', employee_department ='$department', employee_address = '$address', employee_date_of_birth = '$dob', employee_contact = '$contact' WHERE employ_id ='$edit_id'";

    $result = mysqli_query($DBcon, $query) or die(mysqli_error($DBcon));
    if($result)
        echo "1";
    else
        echo "0";
}


if($form_name == "user_status"){
   $query3 = "SELECT * FROM department ";

    $tbl_id = mysqli_real_escape_string($DBcon, $_POST['tbl_id']);
    $status = mysqli_real_escape_string($DBcon, $_POST['status']);

    $qry = "SELECT employee_id FROM employee_table WHERE employ_id = $tbl_id";
    $result2 = mysqli_query($DBcon,$qry) or die(mysqli_error($DBcon));
    $row = mysqli_fetch_array($result2);
    $login_id = $row['employee_id'];

    $query = "UPDATE employee_table SET employee_status='$status' WHERE employ_id ='$tbl_id'";
    $query1 = "UPDATE login_table SET login_status = '$status' WHERE login_username = '$login_id'";

    $result = mysqli_query($DBcon, $query) or die(mysqli_error($DBcon));
    $result1 = mysqli_query($DBcon,$query1) or die(mysqli_error($DBcon));
    if($result && $result1)
        echo "1";
    else
        echo "0";
}

if($form_name == "del_user"){
    $chk_val = 0;
    $tbl_id = mysqli_real_escape_string($DBcon, $_POST['tbl_id']);

    $qry = "SELECT employee_id FROM employee_table WHERE employ_id = $tbl_id";
    $result2 = mysqli_query($DBcon,$qry) or die(mysqli_error($DBcon));
    $row = mysqli_fetch_array($result2);
    $login_id = $row['employee_id'];

    if( $chk_val == 0){
        $query1 = "DELETE FROM login_table  WHERE login_username ='$login_id'";
        $query = "DELETE FROM employee_table  WHERE employ_id='$tbl_id'";
        $result = mysqli_query($DBcon, $query) or die(mysqli_error($DBcon));
        $result1 = mysqli_query($DBcon, $query1) or die(mysqli_error($DBcon));
        if($result && $result1)
            echo "1";
        else
            echo "0";
    }
    else{
        echo "404-del";
    }
}

?>

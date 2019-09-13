<?php 
    header("Content-Type:application/json");
    if (isset($_GET['username']) &&($_GET['username'] !="")) {
        include("../includes/Dbconnect.php");

        $user = $_GET['username'];
        $result = mysqli_query( $DBcon , "SELECT login_id, login_username, login_password, login_status FROM login_table WHERE login_username = $user");
        if (mysqli_num_rows($result)>0) {          
             $row = mysqli_fetch_array($result);
             $loginId = $row['login_id'];
             $username =$row['login_username'];
             $password = $row['login_password'];
             $userStatus = intval($row['login_status']);

      
            response(200, "Request Successful", $loginId, $username, $password, $userStatus );
            mysqli_close($DBcon);
        } else  {
            response(200, "No Record Found", NULL, NULL,NULL, NULL);
        }
    } else {
        response(400,"Invalid Request",NULL,NULL,NULL, NULL);
    }

    function response ($status,$status_message,$loginId, $username,$password,$userStatus){
    
        header("Access-Control-Allow-Origin: *");
        $response['status'] = $status;
        $response['status_response'] =$status_message;
        $response['loginId'] = $loginId;
        $response['username'] = $username;
        $response['password'] = $password;
        $response['userStatus'] = $userStatus;

        $json_response = json_encode($response);
        echo $json_response;
    }
?>
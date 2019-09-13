
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../includes/Dbconnect.php';

// Take raw data from the request


// Converts it into a PHP object
//$data = json_decode($json);

//echo $data;
 
// make sure data is not empty
if(isset($_REQUEST['name']) && ($_REQUEST['name'] != "")){
    //$json = file_get_contents("php://input");
    //$data = json_decode($json);
    //$dept_name = $data[0];
    $dept_name = $_POST['name'];
    $dept_summary = $_POST['summary'];
    $dept_hod = $_POST['hod'];
    $dept_ext = $_POST['ext'];

    //$dept_name = mysqli_real_escape_string($DBcon, $_POST['dept_name']);
    //$dept_summary = mysqli_real_escape_string($DBcon, $_POST['dept_summary']);
    //$dept_hod = mysqli_real_escape_string($DBcon, $_POST['dept_hod']);
    //$dept_ext = mysqli_real_escape_string($DBcon, $_POST['dept_ext']);

    $query = "INSERT INTO department (dept_name, dept_summary, dept_hod, dept_ext) VALUES ('$dept_name', '$dept_summary', '$dept_hod','$dept_ext')";

    $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
    if($result)
    {
         // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Product was created."));
    }
    else {
         http_response_code(400);
        echo json_encode(array("message" => "Something went wrong !"));
    }
       
} else {

     // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }

?>
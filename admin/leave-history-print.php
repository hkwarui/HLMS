  <?php
      date_default_timezone_set('Africa/Nairobi');
      $date1 = date("d/m/y");
      include("../includes/Dbconnect.php");
   ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HLMS | Employees </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="shortcut icon" href="../dist/img/hospital.png" type="image/x-icon">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- <link rel="stylesheet" href="../dist/css/print.css"> -->

   <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();" >
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
        <img src="../dist/img/hospital.png" alt="Smiley face" height="32" width="32"><b style="color: red"> LMS</b> <span class="text-center"> Leave Request History</span>
          <small class="pull-right"><?php echo $date1 ; ?></small>
        </h2>
      </div>
      <!-- /.col -->

          <div class="col-xs-12 table-responsive">
              <!-- My Documents start -->
              <table id="example2" class="table  table-striped ">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Staff Name</th>
                      <th>Staff ID</th>
                      <th>Leave type</th>
                      <th>Start date</th>
                      <th>End date</th>
                      <th>Days</th>
                      <th>Comments</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sno = 1;
                  $query = "SELECT leave_request.leave_id, leave_request.leave_request_type, leave_request.leave_request_start_date, leave_request.leave_request_end_date, leave_request.leave_request_employee_id, leave_request.leave_request_comments,leave_request.leave_request_status, employee_table.employee_fname, employee_table.employee_lname  FROM leave_request INNER JOIN employee_table ON leave_request.leave_request_employee_id = employee_table.employee_id  ORDER BY leave_request.leave_request_type";;
                  $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
                   while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                      <td><?php echo $sno++; ?></td>
                      <td><?php echo $row['employee_fname']." ".$row['employee_lname']; ?></td>
                      <td><?php echo $row['leave_request_employee_id']; ?></td>
                      <td><?php echo $row['leave_request_type']; ?></td>
                      <td><?php $date1 = $row['leave_request_start_date']; echo date("d/m/y ", strtotime($date1)); ?></td>
                      <td><?php $date2 = $row['leave_request_end_date']; echo date("d/m/y ", strtotime($date2)); ?></td>
                          <?php
                           $start = date_create($row['leave_request_start_date']);
                           $end  = date_create($row['leave_request_end_date']);
                           $diff = date_diff( $start, $end );
                          ?>
                      <td><?php echo $diff->d ; ?></td>
                      <td><?php echo $row['leave_request_comments']; ?></td>
                      <td><?php echo $row['leave_request_status']; ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
       </section>
  <!-- /.content -->

</body>
</html>

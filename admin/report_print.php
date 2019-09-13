  <?php
      date_default_timezone_set('Africa/Nairobi');
      $date2= date("d/m/y");
      $date1 = date("Y-m-d");
      include("../includes/Dbconnect.php");
   ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HLMS | Leave request </title>
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
        <img src="../dist/img/hospital.png" alt="Smiley face" height="32" width="32"><b style="color: red"> LMS</b> <span class="text-center"> Leave  Report</span>
          <small class="pull-right"><?php echo $date2 ; ?></small>
        </h2>
      </div>
    </div>
         <div class="row">
           <h5 class="text-muted text-center">Staff on leave</h5>
            <strong><hr/></strong>
              <div class="col-xs-12 table-responsive">
                <table id="example1" class="table table-hover table-striped" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Name</th>
                      <th>Staff Id.</th>
                      <th>Type</th>
                      <th>Start date</th>
                      <th>End date</th>
                      <th>Department</th>
                      <th>Title</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sno = 1;
                  $query = "SELECT employee_table.employee_fname, employee_table.employee_lname , employee_table.employee_id, employee_table.employee_department, employee_table.employee_title, leave_request.leave_request_type, leave_request.leave_request_start_date, leave_request.leave_request_end_date FROM employee_table  INNER JOIN leave_request ON employee_table.employee_id = leave_request.leave_request_employee_id WHERE leave_request_end_date >= '$date1' AND leave_request_start_date <='$date1' ORDER BY leave_request_end_date";
                   $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
                   while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                      <td><?php echo $sno++;?></td>
                      <td><?php echo $row['employee_fname']." ".$row['employee_lname']; ?></td>
                      <td><?php echo $row['employee_id']; ?></td>
                      <td><?php echo $row['leave_request_type']; ?></td>
                      <td><?php $date3 = $row['leave_request_start_date']; echo date("d/m/y ", strtotime($date3)); ?></td>
                      <td><?php $date2 = $row['leave_request_end_date']; echo date("d/m/y ", strtotime($date2)); ?></td>
                      <td><?php echo $row['employee_department']; ?></td>
                      <td><?php echo $row['employee_title']; ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>

            <b><strong><hr/></strong></b>
            <div class="row">
              <h5 class="text-muted text-center">Upcoming leave</h5>
                <strong><hr/></strong>
                  <div class="col-xs-12 table-responsive">
                <table id="example2" class="table table-hover table-striped"  cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Name</th>
                      <th>Staff Id.</th>
                      <th>Type</th>
                      <th>Start date</th>
                      <th>End date</th>
                      <th>Department</th>
                      <th>Title</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sno = 1;
                  $query = "SELECT employee_table.employee_fname, employee_table.employee_lname , employee_table.employee_id, employee_table.employee_department, employee_table.employee_title, leave_request.leave_request_type, leave_request.leave_request_start_date, leave_request.leave_request_end_date, leave_request.leave_request_status FROM employee_table  INNER JOIN leave_request ON employee_table.employee_id = leave_request.leave_request_employee_id WHERE leave_request_start_date >='$date1' AND leave_request_status = 'approved' ORDER BY leave_request_end_date";
                   $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
                   while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                      <td><?php echo $sno++;?></td>
                      <td><?php echo $row['employee_fname']." ".$row['employee_lname']; ?></td>
                      <td><?php echo $row['employee_id']; ?></td>
                      <td><?php echo $row['leave_request_type']; ?></td>
                      <td><?php $date3 = $row['leave_request_start_date']; echo date("d/m/y ", strtotime($date3)); ?></td>
                      <td><?php $date2 = $row['leave_request_end_date']; echo date("d/m/y ", strtotime($date2)); ?></td>
                      <td><?php echo $row['employee_department']; ?></td>
                      <td><?php echo $row['employee_title']; ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                  </tbody>
                  <tfoot>
                  </tr>
                     <th>S.No</th>
                      <th>Name</th>
                      <th>Staff Id.</th>
                      <th>Leave type</th>
                      <th>leave start date</th>
                      <th>Leave end date</th>
                      <th>Department</th>
                      <th>Title</th>
                    </tr>
                  </tfoot>
                </table>
              </div>

            </div>
     </section>
</body>
</html>

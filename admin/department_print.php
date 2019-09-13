  <?php
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
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="shortcut icon" href="../dist/img/hospital.png" type="image/x-icon">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
        <img src="../dist/img/hospital.png" alt="Smiley face" height="32" width="32"><b style="color:red;"> LMS </b> <span class="text-center">Department</span>
          <small class="pull-right"><?php echo $date1 ; ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
  <!-- /.content -->
            <div class="row">
              <div class="col-xs-12 table-responsive">
                <table id="example2" class="table table-hover table-striped"  width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Dept. Name</th>
                      <th>Dept Summary</th>
                      <th>Supervisor</th>
                      <th>Staff Id</th>
                      <th>Dept. phone ext</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sno = 1;
                  $query = "SELECT department.dept_id, department.dept_ext, department.dept_summary, department.dept_name, department.dept_hod ,employee_table.employee_id, employee_table.employee_fname, employee_table.employee_lname FROM department INNER JOIN employee_table ON department.dept_hod = employee_table.employee_id  ORDER BY department.dept_name";
                  $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
                   while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                     <td><?php echo $sno++; ?></td>
                     <td><?php echo $row['dept_name']; ?></td>
                     <td><?php echo $row['dept_summary']; ?></td>
                     <td><?php echo $row['employee_fname']." ".$row['employee_lname']; ?></td>
                     <td><?php echo $row['dept_hod']; ?></td>
                     <td><?php echo $row['dept_ext']; ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div
     </section>
<!-- ./wrapper -->
</body>
</html>

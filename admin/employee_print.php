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
        <img src="../dist/img/hospital.png" alt="Smiley face" height="32" width="32"><b style="color:red;"> LMS </b> <span class="text-center">Employees</span>
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
                      <th>Name</th>
                      <th>Staff Id</th>
                      <th>Email</th>
                      <th>Contact </th>
                      <th>address</th>
                      <th>Department</th>
                      <th>Title</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sno = 1;
                  $query = "SELECT * FROM employee_table ORDER BY employee_date_employed";
                  $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
                   while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                      <td><?php echo $sno++; ?></td>
                      <td><?php echo $row['employee_fname']." ".$row['employee_lname']; ?></td>
                      <td><?php echo $row['employee_id'];?></td>
                      <td><?php echo $row['employee_email'];?></td>
                      <td><?php echo $row['employee_contact'];?></td>
                      <td><?php echo $row['employee_address'];?></td>
                      <td><?php echo $row['employee_department'];?></td>
                      <td><?php echo $row['employee_title'];?></td>
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

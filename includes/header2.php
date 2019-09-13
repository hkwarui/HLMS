 <?php
     include("../includes/Dbconnect.php");
     include("../auth.php");

      $user_type = $_SESSION['categorySession'];
      if($user_type != 1)
        {
            header('Location:./../index.php');
            exit;
        }
      $eid = $_SESSION['username'];
      $query = $DBcon->query("SELECT * FROM employee_table WHERE employee_id ='$eid'");
      $row=$query->fetch_array();

      //User profile picture
    $userPicture = !empty($row['picture'])?$row['picture']:'no-image.png';
    $userPictureURL = '../uploads/images/'.$userPicture;
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" type="text/css" href="../dist/css/modal_input/app_style.css">
   <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="shortcut icon" href="../dist/img/hospital.png" type="image/x-icon">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
   <!-- DataTables -->
 <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
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
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="home.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><img src="../dist/img/hospital.png" alt="Smiley face" height="42" width="42"></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b style="red"><img src="../dist/img/hospital.png" alt="Smiley face" height="42" width="42"> LMS</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $userPictureURL; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $row['employee_fname']."  ". $row['employee_lname'] ;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $userPictureURL; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $row['employee_fname'] ." - ".$row['employee_title'] ;?>
                  <small> Staff Since  <?php  echo $row['employee_date_employed']; ?></small>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="./../logout.php?logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
     <!-- Sidebar user panel -->
    <section class="sidebar">
l
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $userPictureURL; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $row['employee_fname']."  ". $row['employee_lname'] ;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
    <section class="sidebar">

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header active">MAIN NAVIGATION</li>
        <li>
          <a href="home.php">
            <i class="fa fa-th"></i> <span>Dashboard</span>
            <span class="pull-right-container"> </span>
          </a>
        </li>

        <li>
          <a href="employee.php">
            <i class="fa fa-users"></i> <span>Employees</span>
            <span class="pull-right-container"> </span>
          </a>
        </li>

         <li>
          <a href="leave.php">
            <i class="fa fa-file-o"></i> <span>Leave</span>
            <span class="pull-right-container"></span>
          </a>
        </li>

        <li>
          <a href="department.php">
            <i class="fa fa-home"></i> <span>Department</span>
            <span class="pull-right-container"> </span>
          </a>
        </li>

         <li>
          <a href="profile.php">
            <i class="fa fa-user"></i> <span>Myprofile</span>
            <span class="pull-right-container"> </span>
          </a>
        </li>

        <li>
          <a href="reports.php">
            <i class="fa fa-print"></i> <span>Reports</span>
            <span class="pull-right-container"> </span>
          </a>
        </li>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->



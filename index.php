
<?php
session_start();
require_once 'includes/Dbconnect.php';

if (isset($_SESSION['username'])!="") {
 header("Location: staff/home.php");
 exit;
}

if (isset($_POST['btn-login'])) {

 $username =  trim($_POST['username']);
 $password =  trim($_POST['password']);

 $username = strip_tags($_POST['username']);
 $password = strip_tags($_POST['password']);

 $username = $DBcon->real_escape_string($username);
 $password = $DBcon->real_escape_string($password);
 $pass = sha1($password);


 $query = $DBcon->query("SELECT login_username, login_status, login_category,login_password FROM login_table WHERE login_username ='$username' AND login_password = '$pass' ");
 $row=$query->fetch_array();


 $count = $query->num_rows; // if username/password are correct returns must be 1 row

 if ($count==1) {

    if($row['login_status'] == 1)
      {
        if($row['login_category'] == 0)
          {
             $_SESSION['username'] = $row['login_username'];
             $_SESSION['categorySession'] = $row['login_category'];
             $_SESSION['status'] = $row['login_status'];

             header("Location: staff/home.php");
             exit;
          }

       if($row['login_category'] == 1)
          {
            $_SESSION['username'] = $row['login_username'];
            $_SESSION['categorySession'] = $row['login_category'];
            $_SESSION['status'] = $row['login_status'];

            header("Location: admin/home.php");
            exit;
          }
      }

    if($row['login_status'] == 0)
      {
            $msg = "<div class='alert alert-danger'>
            <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Account is deactivated!. Contact Admin
            </div>";

      }
 }
 else {
  $msg = "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !
    </div>";

 }

 $DBcon->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title >HLMS | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="./bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="./bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="shortcut icon" href="./dist/img/hospital.png" type="image/x-icon">
  <link rel="stylesheet" href="./dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="color:#E8E8E8" ); ">
<div class="login-box">
  <div class="login-logo">
        <a href=""><img src="./dist/img/hospital.png" alt="Smiley face" height="82" width="82">
<b style="color: red">LMS</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Please Sign In</p>

    <form  method="post" id="login-form" class="form-signin">
   <?php
         if(isset($msg)){
         echo $msg;
  }?>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Employee Id" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">

        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-login">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="./bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="./plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>

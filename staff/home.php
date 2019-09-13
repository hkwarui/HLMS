<?php
//include auth.php file on all secure pages
include("../includes/Dbconnect.php");
include("../includes/header.php");
$eid = $_SESSION['username'];


       $query = "SELECT count(leave_id) AS leave_info  FROM leave_request WHERE leave_request_status ='pending' OR leave_request_status ='declined' OR leave_request_status ='approved'";
       $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
       $row = mysqli_fetch_array($result);

       $query1 = "SELECT count(leave_id) AS leave_pending  FROM leave_request WHERE leave_request_status ='pending' ";
       $result1 = mysqli_query($DBcon,$query1) or die(mysqli_error($DBcon));
       $row1 = mysqli_fetch_array($result1);

       $query2 = "SELECT count(leave_id) AS leave_declined  FROM leave_request WHERE leave_request_status ='declined'";
       $result2 = mysqli_query($DBcon,$query2) or die(mysqli_error($DBcon));
       $row2 = mysqli_fetch_array($result2);

       $query3 = "SELECT count(leave_id) AS leave_approved  FROM leave_request WHERE leave_request_status ='approved'";
       $result3 = mysqli_query($DBcon,$query3) or die(mysqli_error($DBcon));
       $row3 = mysqli_fetch_array($result3);
  ?>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="background-color: #fbfbfb; padding: 5px; border-bottom:solid:2px;">
      <h4>
        <b>Employee</b>
        <small>self service</small>
      </h4>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>

    </section>
     <!-- Main content -->
    <section class="content">
       <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Leave History</span>
              <span class="info-box-number"><?php echo $row['leave_info'] ; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Leave pending</span>
              <span class="info-box-number"><?php echo $row1['leave_pending'] ;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-thumbs-o-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Approved leaves</span>
              <span class="info-box-number"><?php echo $row3['leave_approved'] ;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-thumbs-o-down"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Declined leaves</span>
              <span class="info-box-number"><?php echo $row2['leave_declined'] ;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

     </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php  include("../includes/footer.php"); ?>





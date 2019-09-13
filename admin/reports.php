
<?php  include("../includes/header2.php");
         $date1 = date("Y-m-d");
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="background-color: #fbfbfb; padding: 5px; border-bottom:solid:2px";>
      <h4>Reports
        <small>statistics</small>
      </h4>

      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Report</li>
      </ol>
    </section>

       <!-- Main content -->
    <section class="content">
      <a href="report_print.php" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-print"></i> Print</a> </p>

        <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs  pull-right">
              <li><a href="#tab_2" data-toggle="tab"<btn class="btn btn-defaut btn-xs">Upcoming leave</btn></a></li>
              <li class="active"><a href="#tab_1" data-toggle="tab" <btn class="btn btn-default btn-xs">Staff on leave</btn></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="table table-responsive">
                <table id="example1" class="table table-bordered table-striped"  width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Name</th>
                      <th>Staff Id.</th>
                      <th>Leave Type</th>
                      <th>leave start date</th>
                      <th>Leave end date</th>
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
              <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_2">
                <div class="table table-responsive">
                <table id="example2" class="table table-bordered table-striped"  width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Name</th>
                      <th>Staff Id.</th>
                      <th>Leave Type</th>
                      <th>leave start date</th>
                      <th>Leave end date</th>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php  include("../includes/footer.php"); ?>

<script>
  $(document).ready(function()  {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'processing'  : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

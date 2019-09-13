
<?php  include("../includes/header2.php"); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="background-color: #fbfbfb; padding: 5px; border-bottom:solid:2px;">
      <h4>
        <b> Leave</b>
        <small>Management</small>
      </h4>

      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Leave</li>
      </ol>
    </section>

       <!-- Main content -->
    <section class="content">
       <p><btn class ="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_leaveType_modal"><i class="fa fa-plus"> New leave Type</i></btn>
         <a href="leave-history-print.php" target="_blank" class="btn btn-default pull-center" ><i class="fa fa-print"></i> Print</a> </p>

          <!-- Modal -->
<div class="modal fade" id="add_employee_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">

 <form id="hd_form" method="post">
 <input type="hidden" id="form_name" name="form_name" value="add_user" />
 <input type="hidden" id="edit_id" name="edit_id" value="0" />

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel"><strong>Action on leave</strong></h4>
</div>
<div class="modal-body">

  <div class="alert icon-alert with-arrow alert-success form-alter" role="alert" style="display:none;">
       <i class="fa fa-fw fa-check-circle"></i>
      <strong> Success ! </strong> Data saved successfully.
  </div>
  <div class="alert icon-alert with-arrow alert-danger form-alter" role="alert" style="display:none;">
    <i class="fa fa-fw fa-times-circle"></i>
    <strong> Note !</strong> Data saving failed.
  </div>

 <div class="form-group required">
    <label for="action_leave"> Take Action</label>
    <select class="form-control selectpicker show-tick" id="action_leave" name="action_leave" data-live-search="true" required="required" />
     <option value="">-- select --</option>
     <option value="approved"> approved </option>
     <option value="declined"> declined </option>
      </select>
</div>
</div>

<div class="clearfix"></div>
<div class="modal-footer">
  <button type="button" class="btn btn-primary btn-form-action btn-submit2">Submit</button>
  <button type="button" class="btn btn-danger btn-form-action btn-reset">Clear</button>
 </div>
</form>

</div>
</div>
</div>


<div class="modal fade" id="add_leaveType_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">

 <form id="hk_form" method="post">
 <input type="hidden" id="form_name" name="form_name" value="add_user" />
 <input type="hidden" id="edit_id" name="edit_id" value="0" />

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel"><strong>Add Leave type</strong></h4>
</div>
<div class="modal-body">

  <div class="alert icon-alert with-arrow alert-success form-alter" role="alert" style="display:none;">
       <i class="fa fa-fw fa-check-circle"></i>
      <strong> Success ! </strong> Data saved successfully.
  </div>
  <div class="alert icon-alert with-arrow alert-danger form-alter" role="alert" style="display:none;">
    <i class="fa fa-fw fa-times-circle"></i>
    <strong> Note !</strong> Data saving failed.
  </div>

<div class="form-group required">
<label for="type_name">Name</label>
<input type="text" id="type_name" name="type_name" class="form-control" required="required" />
</div>
<div class="form-group required">
<label for="type_max_days">Maximum Leave Days</label>
<input type="text" id="type_max_days" name="type_max_days" class="form-control" required="required" />
</div>
</div>

<div class="clearfix"></div>
<div class="modal-footer">
  <button type="button" class="btn btn-primary btn-form-action btn-submit3">Submit</button>
  <button type="button" class="btn btn-danger btn-form-action btn-reset">Clear</button>
 </div>
</form>

</div>
</div>
</div>

      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs  pull-right">
              <li><a href="#tab_2" data-toggle="tab"<btn class="btn btn-defaut btn-xs">Leave History</btn></a></li>
              <li class="active"><a href="#tab_1" data-toggle="tab" <btn class="btn btn-default btn-xs">Leave Peanding</btn></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">

                <div class="table-responsive">
                <table id="example1"  class="table table-bordered table-striped ">
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
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sno = 1;
                  $query = "SELECT leave_request.leave_id, leave_request.leave_request_type, leave_request.leave_request_start_date, leave_request.leave_request_end_date, leave_request.leave_request_employee_id, leave_request.leave_request_comments,leave_request.leave_request_status, employee_table.employee_fname, employee_table.employee_lname  FROM leave_request INNER JOIN employee_table ON leave_request.leave_request_employee_id = employee_table.employee_id  WHERE leave_request.leave_request_status = 'pending' ORDER BY leave_request_date DESC";
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
                           $diff = date_diff( $start, $end ); ?>
                      <td><?php echo $diff->d ; ?></td>
                      <td><?php echo $row['leave_request_comments']; ?></td>
                      <td><span class="label label-warning" ><?php echo $row['leave_request_status']; ?> </span></td>
                      <td align="center">
                           <div class="form-group">
                          <button type="button" class="btn btn-xs btn-primary btn-edit1" id="<?php echo $row['leave_id']; ?>" title="Edit details" data-target="#confirmModal" >
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                  </tbody>
                  <tfoot>
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
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
               </div>
              <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
          <table id="example2" class="table table-bordered table-striped ">
               <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Staff Name</th>
                      <th>Staff ID</th>
                      <th>Leave type</th>
                      <th>Start date</th>
                      <th>End date</th>
                      <th>Day(s)</th>
                      <th>Comments</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sno = 1;
                  $query = "SELECT leave_request.leave_id, leave_request.leave_request_type, leave_request.leave_request_start_date, leave_request.leave_request_end_date, leave_request.leave_request_employee_id, leave_request.leave_request_comments,leave_request.leave_request_status, employee_table.employee_fname, employee_table.employee_lname  FROM leave_request INNER JOIN employee_table ON leave_request.leave_request_employee_id = employee_table.employee_id WHERE leave_request_status = 'declined' OR leave_request_status = 'approved' OR leave_request_status = 'pending' ORDER BY leave_request_date DESC";
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
                      <?php  if(($row['leave_request_status']) == 'approved')
                      { ?>
                        <td><span class="label label-success" > <?php echo $row['leave_request_status']; ?> </span></td>
                     <?php  }
                      elseif(($row['leave_request_status']) == 'declined') { ?>
                         <td> <span class="label label-danger" > <?php echo $row['leave_request_status']; ?> </span></td>
                     <?php }
                       else { ?>
                         <td> <span class="label label-warning" > <?php echo $row['leave_request_status']; ?> </span></td>
                     <?php } ?>

                    </tr>
                  <?php
                  }
                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>S.No</th>
                      <th>Staff Name</th>
                      <th>Staff ID</th>
                      <th>Leave type</th>
                      <th>Start date</th>
                      <th>Day(s)</th>
                      <th>End date</th>
                      <th>Comments</th>
                      <th>Status</th>
                    </tr>
                  </tfoot>
                </table>
            </div>
          </div>
        </div>
      </div>

          <!-- col -->
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

    <script type="text/javascript">
    //Manage leave

  $(document).ready(function(e){
    $("#hd_form").validate({
      // Specify the validation rules
      rules: {
        action_leave: {
          required: true
        },

      },
      // Specify the validation error messages
      messages: {
        action_leave :"Please Take an action !"
      },
      submitHandler: function(form) {
        form.submit();
      }
    });

        $(document).on('click', '.btn-submit2', function(ev){
      ev.preventDefault();
      var btn_button = $(this);
      if($("#hd_form").valid() == true){
        var data = $("#hd_form").serialize();
        btn_button.html(' <i class="fa fa fa-spinner fa-spin"></i> Processing...');
        btn_button.attr("disabled",true);
        $.post('save_leave_details.php', data, function(data, status){
          console.log("Data: " + data + "\nStatus: " + status);
          if( data == "1"){
            //alert("Data: " + data + "\nStatus: " + status);
            $(".alert-danger").hide();
            $(".alert-success").fadeIn(800);
            btn_button.html('<i class="fa fa fa-check-circle"></i> Done');
            setTimeout(function(){  location.reload(); }, 2000);
          }
          else{
            //alert("Data: " + data + "\nStatus: " + status);
            $(".alert-success").hide();
            $(".alert-danger").fadeIn(800);
            btn_button.html('Submit').attr("disabled",false);
          }
        });
      }
    });

       $(document).on('click', '.btn-edit1', function(ev){
      ev.preventDefault();
      var btn_button = $(this);
      btn_button.html(' <i class="fa fa fa-spinner fa-spin"></i> ');
      var tbl_id = $(this).attr("id");
      $('.btn-reset').trigger('click');
      $.ajax({
        cache: false,
        url: 'get_leave_ajax_details.php', // url where to submit the request
        type : "GET", // type of action POST || GET
        dataType : 'json', // data type
        data : { cmd: "get_user_details", tbl_id: tbl_id }, // post data || get data
        success : function(result) {
        btn_button.html(' <i class="fa fa fa-pencil-square-o"></i> ');
        console.log(result);
        $("#add_employee_modal").modal("show");
        $("#form_name").val("edit_user");
        $("#edit_id").val(result['leave_id']);
       $("#action_leave").val(result['action_leave']);
      },

        error: function(xhr, resp, text) {
        console.log(xhr, resp, text);
        }
      });
    });



     $(document).on('click', '.btn-reset', function(ev){
      ev.preventDefault();
      $("#form_name").val("add_user");
      $("#edit_id").val('');
      $("#action_leave").val('').focus();
      $(".dup-chek-details").html('');
      $("label.error").hide('');
    });
});


    //Add leave ltype and max days

  $(document).ready(function(e){
    $("#hk_form").validate({
      // Specify the validation rules
      rules: {
        type_name: {
          required: true
        },
        type_max_days: {
          required: true
        },

      },
      // Specify the validation error messages
      messages: {
        type_name :"Please enter leave type !",
        type_max_days : "Please enter max leave days",
      },
      submitHandler: function(form) {
        form.submit();
      }
    });

        $(document).on('click', '.btn-submit3', function(ev){
      ev.preventDefault();
      var btn_button = $(this);
      if($("#hk_form").valid() == true){
        var data = $("#hk_form").serialize();
        btn_button.html(' <i class="fa fa fa-spinner fa-spin"></i> Processing...');
        btn_button.attr("disabled",true);
        $.post('save_leaveType_details.php', data, function(data, status){
          console.log("Data: " + data + "\nStatus: " + status);
          if( data == "1"){
            //alert("Data: " + data + "\nStatus: " + status);
            $(".alert-danger").hide();
            $(".alert-success").fadeIn(800);
            btn_button.html('<i class="fa fa fa-check-circle"></i> Done');
            setTimeout(function(){  location.reload(); }, 2000);
          }
          else{
            //alert("Data: " + data + "\nStatus: " + status);
            $(".alert-success").hide();
            $(".alert-danger").fadeIn(800);
            btn_button.html('Submit').attr("disabled",false);
          }
        });
      }
    });

       $(document).on('click', '.btn-edit1', function(ev){
      ev.preventDefault();
      var btn_button = $(this);
      btn_button.html(' <i class="fa fa fa-spinner fa-spin"></i> ');
      var tbl_id = $(this).attr("id");
      $('.btn-reset').trigger('click');
      $.ajax({
        cache: false,
        url: 'get_leave_ajax_details.php', // url where to submit the request
        type : "GET", // type of action POST || GET
        dataType : 'json', // data type
        data : { cmd: "get_user_details", tbl_id: tbl_id }, // post data || get data
        success : function(result) {
        btn_button.html(' <i class="fa fa fa-pencil-square-o"></i> ');
        console.log(result);
        $("#add_employee_modal").modal("show");
        $("#form_name").val("edit_user");
        $("#edit_id").val(result['leave_id']);
       $("#action_leave").val(result['action_leave']);
      },

        error: function(xhr, resp, text) {
        console.log(xhr, resp, text);
        }
      });
    });



     $(document).on('click', '.btn-reset', function(ev){
      ev.preventDefault();
      $("#form_name").val("add_user");
      $("#edit_id").val('');
      $("#action_leave").val('').focus();
      $(".dup-chek-details").html('');
      $("label.error").hide('');
    });
});

</script>






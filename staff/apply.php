
<?php  include("../includes/header.php");
       include("../includes/Dbconnect.php");
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="background-color: #fbfbfb; padding: 5px; border-bottom:solid:2px;">
      <h4>
        <b>Leave</b>
        <small>overview</small>
      </h4>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

       <!-- Main content -->
    <section class="content">

 <p><btn class ="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_employee_modal"><i class="fa fa-plus">Apply</i></btn></p>


<!-- Bootstrap Modal - To Add New Record -->
<!-- Modal -->

<div class="modal fade" id="add_employee_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">

 <form id="hl_form" method="post">
 <input type="hidden" id="form_name" name="form_name" value="add_user" />
 <input type="hidden" id="edit_id" name="edit_id" value="0" />

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel"><strong>Apply Leave</strong></h4>
</div>
<div class="modal-body">

  <div class="alert icon-alert with-arrow alert-success form-alter" role="alert" style="display:none;">
       <i class="fa fa-fw fa-check-circle"></i>
      <strong> Success ! </strong>Request sent.
  </div>
  <div class="alert icon-alert with-arrow alert-danger form-alter" role="alert" style="display:none;">
    <i class="fa fa-fw fa-times-circle"></i>
    <strong> Note !</strong> Data saving failed.
  </div>

 <div class="form-group required">
    <label for="leave_type">Leave type</label>
    <select class="form-control selectpicker show-tick" id="leave_type" name="leave_type" data-live-search="true" required="required">
    <option value="">-- select --</option>
     <?php
     $query = "SELECT * FROM leavetype_table ORDER BY leave_type_name";
      $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
      while($row = mysqli_fetch_array($result)){ ?>
      <option value="<?php echo $row['leave_type_name'] ; ?>"><?php echo $row['leave_type_name']; ?></option>
      <?php } ?>
   </select>
</div>

<div class="row">
  <div class="col-xs-6">
<div class="form-group required">
     <label for= "date_from">Date from:</label>
   <input  type="date" class="form-control pull-right" name="date_from" id="date_from" placeholder="yyyy-mm-dd" required="required" />
 </div>
</div>

  <div class="col-xs-6">
 <div class="form-group required">
    <label for= "date_to">Date to:</label>
   <input  type="date" class="form-control pull-right" name="date_to" id="date_to" placeholder="yyyy-mm-dd" required="required" />
 </div>
</div>
</div>

<div class="form-group required">
    <label for= "comment">Comment:</label>
   <textarea rows ="2" class="form-control pull-right" name="comment" id="comment"  required="required" ></textarea>
</div>

 </div> <!-- end of colmn -->


<div class="clearfix"></div>
<div class="modal-footer">
  <button type="button" class="btn btn-primary btn-form-action btn-submit">Submit</button>
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
              <li><a href="#tab_2" data-toggle="tab"<btn class="btn btn-default btn-xs">Leave History</btn></a></li>
              <li class="active"><a href="#tab_1" data-toggle="tab"<btn class="btn btn-default btn-xs">Leave Peanding</btn></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">

              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>

                    <tr>
                      <th>S.No</th>
                      <th>Type</th>
                      <th>Start</th>
                      <th>End</th>
                      <th>Comments</th>
                      <th>Day(s)</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sno = 1;
                  $query = "SELECT * FROM  leave_request  WHERE leave_request_status = 'pending' AND leave_request_employee_id ='$eid' ORDER BY leave_request_date DESC";
                  $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
                   while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                      <td><?php echo $sno++; ?></td>
                      <td><?php echo $row['leave_request_type']; ?></td>
                      <td><?php $date1 = $row['leave_request_start_date']; echo date("d/m/y ", strtotime($date1)); ?></td>
                      <td><?php $date2 = $row['leave_request_end_date']; echo date("d/m/y ", strtotime($date2)); ?></td>
                      <td><?php echo $row['leave_request_comments']; ?></td>
                      <?php
                           $start = date_create($row['leave_request_start_date']);
                           $end  = date_create($row['leave_request_end_date']);
                           $diff = date_diff( $start, $end ); ?>
                      <td><?php echo $diff->d ; ?></td>
                      <td><span class="label label-warning"><?php echo $row['leave_request_status']; ?></span></td>
                      <td align="center">
                        <div class="form-group">

                          <button type="button" class="btn btn-sm btn-danger btn-delete" id="<?php echo $row['leave_id']; ?>" title="Delete details" data-toggle="modal" data-target="#confirmModal" >
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
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
                      <th>Type</th>
                      <th>Start</th>
                      <th>End</th>
                      <th>Comments</th>
                      <th>Day(s)</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">

              <div class="table-responsive">
              <table id="example2" class="table table-bordered  table-striped ">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Type</th>
                      <th>Start</th>
                      <th>End</th>
                      <th>Comment(s)</th>
                      <th>Day(s)</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sno = 1;
                  $query = "SELECT * FROM  leave_request  WHERE  leave_request_employee_id = '$eid'  AND (leave_request_status = 'declined' OR leave_request_status = 'approved' OR leave_request_status = 'pending' ) ORDER BY leave_request_date DESC ";
                  $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
                   while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                      <td><?php echo $sno++; ?></td>
                      <td><?php echo $row['leave_request_type']; ?></td>
                      <td><?php $date1 = $row['leave_request_start_date']; echo date("d/m/y ", strtotime($date1)); ?></td>
                      <td><?php $date2 = $row['leave_request_end_date']; echo date("d/m/y ", strtotime($date2)); ?></td>
                      <td><?php echo $row['leave_request_comments']; ?></td>
                            <?php
                           $start = date_create($row['leave_request_start_date']);
                           $end  = date_create($row['leave_request_end_date']);
                           $diff = date_diff( $start, $end );
                            ?>
                      <td><?php echo $diff->d ; ?></td>
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
                      <th>Type</th>
                      <th>Start</th>
                      <th>End</th>
                      <th>Comment(s)</th>
                      <th>Day(s)</th>
                      <th>Status</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                like Aldus PageMaker including versions of Lorem Ipsum.
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
        </div>


              <!-- Small Size -->
  <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content modal-col-danger">
        <div class="modal-header">
          <h4 class="modal-title" id="smallModalLabel">Confirmation:</h4>
        </div>
        <div class="modal-body">
          Do you want to Delete This Record ?
        </div>
        <div class="modal-footer">
          <button type="button " class="btn btn-danger btn-confirm-delete">Confirm</button>
          <button type="button" class="btn btn-default btn-confirm-close" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Small Size -->
  <div class="modal fade" id="warningModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="smallModalLabel"><b>Info:</b></h4>
        </div>
        <div class="modal-body warning-modal-message">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-warning-close" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



      </section>
    <!-- /.content -->
  </div>
   <!-- /.content-wrapper -->
<?php  include("../includes/footer.php"); ?>
  <script>
  $(document).ready(function() {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'processing'  : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>


<script type="text/javascript">

// Apply leave script

  $(document).ready(function(e){
    $("#hl_form").validate({
      // Specify the validation rules
      rules: {
        leave_type: {
          required: true
        },
        date_from :{
          required : true

        },
        date_to : {
          required : true
        },
        comment: {
          required: true,
        },

      },
      // Specify the validation error messages
      messages: {
        leave_type: "Please select leave type",
        date_from : "Please enter start date.",
        date_to: "Please enter end date.",
        comment: "Please enter comment.",
      },
      submitHandler: function(form) {
        form.submit();
      }
    });

    $(document).on('click', '.btn-submit', function(ev){
      ev.preventDefault();
      var btn_button = $(this);
      if($("#hl_form").valid() == true){
        var data = $("#hl_form").serialize();
        btn_button.html(' <i class="fa fa fa-spinner fa-spin"></i> Processing...');
        btn_button.attr("disabled",true);
        $.post('save_details.php', data, function(data, status){
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

    $(document).on('click', '.btn-reset', function(ev){
      ev.preventDefault();
      $("#form_name").val("add_user");
      $("#edit_id").val('');
      $("#leave_type").val('').focus();
      $("#date_from").val('');
      $("#date_to").val('');
      $("#coment").val('');
      $(".dup-chek-details").html('');
      $("label.error").hide('');
    });

    $(document).on('click', '.btn-confirm-delete', function(ev){
      ev.preventDefault();
      var btn_button = $(this);
      var tbl_id = $('.btn-confirm-delete').attr("id");
      $('#confirmModal').modal('hide');

      $.post('save_details.php', { form_name: "del_user", tbl_id: tbl_id }, function(data,status){
        console.log(data);
        if(data == "1"){
          btn_button.html('<i class="fa fa fa-check-circle "></i> Done');
          $('.warning-modal-message').html("This details deleted successfully.");
          $('#warningModal').modal('show');
          setTimeout(function(){  location.reload(); }, 2000);
        }
        else if(data == "404-del"){
          $('.warning-modal-message').html("This details reflect in another record. So you can't delete !!!");
          $('#warningModal').modal('show');
        }
        else{
          $('.warning-modal-message').html("Data deletion failed.");
          btn_button.html('Yes');
        }
      });
    });

    $(document).on('click', '.btn-delete', function(ev){
      ev.preventDefault();
      $(".btn-confirm-delete").attr("id",$(this).attr('id'));
    });

    $(document).on('click', '.btn-confirm-close', function(ev){
      ev.preventDefault();
      $(".btn-confirm-delete").attr("id","0");
    });


  });
  </script>





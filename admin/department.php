
<?php  include("../includes/header2.php");
       include("../includes/Dbconnect.php");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
 <section class="content-header" style="background-color: #fbfbfb; padding: 5px; border-bottom:solid:2px;">
      <h4>
        <b>Department</b>
        <small>management</small>
      </h4>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">department</li>
      </ol>
    </section>
       <!-- Main content -->
<section class="content">

<p><btn class ="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_employee_modal"><i class="fa fa-plus"> New</i></btn>
  <a href="department_print.php" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> </p>
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
<h4 class="modal-title" id="myModalLabel"><strong>Add Department</strong></h4>
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
<label for="dept_name">Dept. Name</label>
<input type="text" id="dept_name" name="dept_name" class="form-control" required="required" />
</div>

<div class="form-group required">
<label for="dept_summary">Dept.  Summary</label>
<textarea class="form-control" id="dept_summary" name="dept_summary" rows="3" placeholder="Enter ..." required="required"></textarea>
</div>

<div class="form-group ">
<label for="dept_hod">H.O.D/Supervisor</label>
<select class="form-control selectpicker show-tick" id="dept_hod" name="dept_hod" data-live-search="true"  /> <option value="">-- select --</option>
 <?php
  $query = "SELECT * FROM employee_table ORDER BY employee_fname";
  $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
  while($row = mysqli_fetch_array($result)){ ?>
 <option value="<?php echo $row['employee_id'] ; ?>"><?php echo $row['employee_fname']. " ". $row['employee_lname']; ?></option>
      <?php } ?>
</select>
</div>

<div class="form-group required">
<label for="dept_ext">Phone ext.</label>
<input type="text" id="dept_ext" name="dept_ext"  class="form-control" required="required" />
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

<div class="box box primary" style="padding:1%;">
  <!-- My Documents start -->

    <table id="example2"  class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>S.No</th>
          <th>Dept. Name</th>
          <th>Dept Summary</th>
          <th>Supervisor</th>
          <th>Staff Id</th>
          <th>Dept. phone ext</th>
          <th>Action</th>
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
          <td align="center">
          <div class="form-group">
          <button type="button" class="btn btn-xs btn-primary btn-edit" id="<?php echo $row['dept_id']; ?>" title="Edit details"  data-target="#confirmModal" >
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          </button>
          <button type="button" class="btn btn-xs btn-danger btn-delete" id="<?php echo $row['dept_id']; ?>" title="Delete details" data-toggle="modal" data-target="#confirmModal" >
            <i class="fa fa-trash-o" aria-hidden="true"></i>
          </button>
          </div>
          </td>
        </tr>
           <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <th>S.No</th>
          <th>Dept. Name</th>
          <th>Dept Summary</th>
          <th>Supervisor</th>
          <th>Staff Id</th>
          <th>Dept. phone ext</th>
          <th>Action</th>
        </tr>
     </tfoot>
    </table>
</div>
      <!-- Small Size -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content modal-col-danger">
      <div class="modal-header">
        <h4 class="modal-title" id="smallModalLabel"><b>Confirmation:</b></h4>
      </div>
      <div class="modal-body">
        <p> Do you want to <b> Delete </b> This Record ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-confirm-delete "> Confirm </button>
        <button type="button" class="btn btn-primary btn-confirm-close" data-dismiss="modal"> Close </button>
      </div>
   </div>
  </div>
</div>


<!-- Small Size -->
  <div class="modal fade" id="warningModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="smallModalLabel">Info:</h4>
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

</div>
  <!-- /.content-wrapper -->
 <?php  include("../includes/footer.php"); ?>


  <script>
  $(document).ready(function()  {
    $('#example2').DataTable({

        buttons: [
            'copy',
            'excel',
            'csv',
            'pdf',
            'print'
        ]
    })
  })
</script>

<script type="text/javascript">
//===============================================================================================
// Apply leave script
//=============================================================================================================================================================
  $(document).ready(function(e){
    $("#hl_form").validate({
      // Specify the validation rules
      rules: {
        dept_name: {
          required: true
        },
        dept_summary: {
          required: true,
        },
        dept_ext: {
          required: true
        },
      },
      // Specify the validation error messages
      messages: {
        dept_name: "Please enter dept. name",
        dept_summary: "Please enter dept. roles summary",
        phone_ext: "Please enter dept_ext",
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
        $.post('save_dept_details.php', data, function(data, status){
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
      $("#dept_name").val('').focus();
      $("#dept_summary").val('');
      $("#dept_ext").val('');
      $("#dept_hod").val('');
      $(".dup-chek-details").html('');
      $("label.error").hide('');
    });

    $(document).on('click', '.btn-edit', function(ev){
      ev.preventDefault();
      var btn_button = $(this);
      btn_button.html(' <i class="fa fa fa-spinner fa-spin"></i> ');
      var tbl_id = $(this).attr("id");
      $('.btn-reset').trigger('click');
      $.ajax({
        cache: false,
        url: 'get_dept_ajax_details.php', // url where to submit the request
        type : "GET", // type of action POST || GET
        dataType : 'json', // data type
        data : { cmd: "get_user_details", tbl_id: tbl_id }, // post data || get data
        success : function(result) {
        btn_button.html(' <i class="fa fa fa-pencil-square-o"></i> ');
        console.log(result);
        $("#add_employee_modal").modal("show");
        $("#form_name").val("edit_user");
        $("#edit_id").val(result['dept_id']);
        $("#dept_name").val(result['dept_name']).focus();
        $("#dept_summary").val(result['dept_summary']);
        $("#dept_hod").val(result['dept_hod']);
        $("#dept_ext").val(result['dept_ext']).change();
        },

        error: function(xhr, resp, text) {
        console.log(xhr, resp, text);
        }
      });
    });
     $(document).on('click', '.btn-confirm-delete', function(ev){
      ev.preventDefault();
      var btn_button = $(this);
      var tbl_id = $('.btn-confirm-delete').attr("id");
      $('#confirmModal').modal('hide');

      $.post('save_dept_details.php', { form_name: "del_user", tbl_id: tbl_id }, function(data,status){
        console.log(data);
        if(data == "1"){
          btn_button.html('<i class="fa fa fa-check-circle "></i> Done');
          $('.warning-modal-message').html("This details deleted successfully.");
          $('#warningModal').modal('show');
          setTimeout(function(){  location.reload(); }, 1500);
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




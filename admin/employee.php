<?php
       include("../includes/header2.php");
       include("../includes/Dbconnect.php");

       $query = "SELECT MAX(employ_id) AS staff_id  FROM employee_table";
       $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
       $row = mysqli_fetch_array($result);
       $new_staff = $row['staff_id'] + 1 ;

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="background-color:#fbfbfb; padding:5px; border-bottom:solid:2px;">
      <h4><b>Employee</b>
        <small>managment</small>
      </h4>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">employee</li>

      </ol>
    </section>

       <!-- Main content -->
    <section class="content">

 <p><btn class ="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_employee_modal"><i class="fa fa-plus"> New</i></btn>
 <a href="employee_print.php" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-print"></i> Print</a> </p>

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
<h4 class="modal-title" id="myModalLabel"><strong>Add Employee</strong></h4>
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

<div class="col-md-6">
<div class="form-group required">
<label for="employee_id">Employee ID</label>
<input type="text" id="employee_id" name="employee_id" class="form-control" value="<?php echo "LMS".$new_staff; ?>" required="required"  readonly="readonly" />
</div>

<div class="form-group required">
<label for="first_name">First Name</label>
<input type="text" id="first_name" name="first_name" class="form-control" required="required" />
</div>

<div class="form-group required">
<label for="last_name">Last Name</label>
<input type="text" id="last_name" name="last_name" class="form-control" required="required" />
</div>

 <div class="form-group required">
    <label for="gender">Gender</label>
    <select class="form-control selectpicker show-tick" id="gender" name="gender" data-live-search="true" required="required" />
    <option value="">-- select --</option>
    <option value="male">male</option>
    <option value="female">female</option>
    <option value="other">other</option>
   </select>
</div>

<div class="form-group required">
<label for="email">Email Address</label>
<input type="text" id="email" name="email"  class="form-control" required="required" />
</div>

</div> <!-- end of colmn -->
<div class="row">
<div class="col-md-6">
<div class="form-group  required">
<label for="title">Job title</label>
<input type="text" id="title" name="title" class="form-control" required="required" />
</div>

<div class="form-group required">
<label for="contact">Phone No.</label>
<input type="text" id="contact" name="contact" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-masks />
</div>

<div class="form-group required">
<label for="address">Address</label>
<input type="text" id="address" name="address" class="form-control" required="required" />
</div>

 <div class="form-group required">
    <label for="department">Department</label>
    <select class="form-control selectpicker show-tick" id="department" name="department" data-live-search="true" required="required" />
      <option value="">-- select --</option>
        <?php
     $query = "SELECT * FROM department ORDER BY dept_name";
      $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
      while($row = mysqli_fetch_array($result)){ ?>
      <option value="<?php echo $row['dept_name'] ; ?>"><?php echo $row['dept_name']; ?></option>
      <?php } ?>
   </select>
</div>

 <div class="form-group required">
    <label for= "dob">Date:</label>
   <input  type="date" class="form-control pull-right" name="dob" id="dob" placeholder="yyyy-mm-dd" required="required" />
</div>
 </div> <!-- end of colmn -->
</div>
</div>

<div class="clearfix"></div>
<div class="modal-footer">
  <button type="button" class="btn btn-primary btn-form-action btn-submit">Submit</button>
  <button type="button" class="btn btn-danger btn-form-action btn-reset">Clear</button>
</div>
</form>

</div>
</div>
</div>


          <div class="box box-default" style="padding:1%;">
              <!-- My Documents start -->
                <table id="example2" class="table table-bordered table-striped"  width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Name</th>
                      <th>Staff Id.</th>
                      <th>D.O.B</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>address</th>
                      <th>Department</th>
                      <th>Title</th>
                      <th>Action</th>
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
                      <td><?php echo $sno++;?></td>
                      <td><?php echo $row['employee_fname']." ".$row['employee_lname']; ?></td>
                      <td><?php echo $row['employee_id']; ?></td>
                      <td><?php $date3 = $row['employee_date_of_birth']; echo date("d/m/y ", strtotime($date3)); ?></td>
                      <td><?php echo $row['employee_email']; ?></td>
                      <td><?php echo $row['employee_contact']; ?></td>
                      <td><?php echo $row['employee_address']; ?></td>
                      <td><?php echo $row['employee_department']; ?></td>
                      <td><?php echo $row['employee_title']; ?></td>
                      <td>
                          <button type="button" class="btn btn-xs btn-primary btn-edit" id="<?php echo $row['employ_id']; ?>" title="Edit details" data-target="#confirmModal" >
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                          </button>
                          <button type="button" class="btn btn-xs btn-warning btn-status" id="<?php echo $row['employ_id']; ?>" data-status="<?php echo $row['employee_status']; ?>" title="Active/Deactive details" >
                            <?php if(empty($row['employee_status'])){ ?>
                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                            <?php }else{ ?>
                            <i class="fa fa-ban" aria-hidden="true"></i>
                            <?php } ?>
                          </button>
                          <button type="button" class="btn btn-xs btn-danger btn-delete" id="<?php echo $row['employ_id']; ?>" title="Delete details" data-toggle="modal" data-target="#confirmModal" >
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                          </button>
                      </td>
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
                      <th>D.O.B</th>
                      <th>Email</th>
                      <th>Contact </th>
                      <th>address</th>
                      <th>Department</th>
                      <th>Title</th>
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
          <h4 class="modal-title" id="smallModalLabel">Confirmation:</h4>
        </div>
        <div class="modal-body">
          Do you want to Delete This Record ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-confirm-delete">Confirm</button>
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
    <!-- /.content -->



  </div>
  <!-- /.content-wrapper -->

<?php  include("../includes/footer.php"); ?>

<script>
  $(document).ready(function()  {
    $('#example2').DataTable({
      "Paginate": true,
      "LengthChange": false,
      "Filter": true,
      "Sort": true,
      "Info": true,
      "AutoWidth": true,
    })
  })
</script>
<script>
//Employee managment
//=============================================================================================================================================================
  $(document).ready(function(e){
    $("#hl_form").validate({
      // Specify the validation rules
      rules: {
        first_name: {
          required: true
        },
        email: {
          required: true,
          email: true
        },
        employee_id: {
          required: true
        },
        last_name: {
          required: true,
        },
        gender: {
          required: true
        },
        employee_contact: {
          required: true,

        },
        employee_title: {
          required: true,
      },
      address: {
          required: true
       },
      department: {
          required: true
      },
      dob: {
        required: true


        },
      },
      // Specify the validation error messages
      messages: {
        first_name: "Please enter  first Name",
        last_name: "Please enter  last Name",
        email: "Please enter a valid  Email name",
        gender: "Please choose gender",
        contact: "Please enter contact",
        department: "Please choose department",
        title :"Please choose Job title",
        dob: "Please enter date of birth",
        address: "Please enter address",
        employee_id: "Please enter Emmployee Id"

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
      $("#first_name").val('').focus()
      $("#last_name").val('');
      $("#email").val('');
      $("#address").val('');
      $("#gender").val('').change();
      $("#contact").val('');
      $("#department").val('').change();
      $("#title").val('');
      $("#dob").val('');
      $("#employee_id").val('');
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
        url: 'get_ajax_details.php', // url where to submit the request
        type : "GET", // type of action POST || GET
        dataType : 'json', // data type
        data : { cmd: "get_user_details", tbl_id: tbl_id }, // post data || get data
        success : function(result) {
        btn_button.html(' <i class="fa fa fa-pencil-square-o"></i> ');
        console.log(result);
        $("#add_employee_modal").modal("show");
        $("#form_name").val("edit_user");
        $("#edit_id").val(result['employ_id']);
        $("#gender").val(result['employee_gender']);
        $("#first_name").val(result['employee_fname']).focus();
        $("#last_name").val(result['employee_lname']);
        $("#email").val(result['employee_email']);
        $("#contact").val(result['employee_contact']);
        $("#address").val(result['employee_address']);
        $("#title").val(result['employee_title']);
        $("#department").val(result['employee_department']);
        $("#dob").val(result['employee_date_of_birth']);
        $("#employee_id").val(result['employee_id']).change();
        },

        error: function(xhr, resp, text) {
        console.log(xhr, resp, text);
        }
      });
    });

    $(document).on('click', '.btn-status', function(ev){
      ev.preventDefault();
      var btn_button = $(this);
      var status = 0;
      btn_button.html(' <i class="fa fa fa-spinner fa-spin"></i> ');
      var tbl_id = $(this).attr("id");
      var tbl_status = $(this).data("status");
      if(tbl_status == 0) status = 1;
      else status = 0;

      $.post('save_details.php', { form_name: "user_status", tbl_id: tbl_id, status: status }, function(data,status){
        console.log(data);
        if(data == "1"){
          $('.warning-modal-message').html("Record status changed successfully.");
          $('#warningModal').modal('show');
          setTimeout(function(){  location.reload(); }, 2000);
        }
        else{
          $('.warning-modal-message').html("Data deletion failed.");
        }
      });
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





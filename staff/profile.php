<?php

//include auth.php file on all secure pages
include("../includes/Dbconnect.php");
include("../includes/header.php");
$eid = $_SESSION['username'];

//Get all employeee details
 $query = $DBcon->query("SELECT * FROM employee_table WHERE employee_id ='$eid'");
 $row = $query->fetch_array();

 ?>


<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" type="text/css" href="../dist/css/profile_style.css"">

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="background-color: #fbfbfb; padding: 5px; border-bottom:solid:2px;">
      <h4>
        <b>Profile</b>
        <small>details</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

       <!-- Main content -->
 <section class="content">
  <div class="row">

    <div class="col-md-3">
    <div class="box box-primary">
    <div class="user-box">
    <div class="img-relative">
      <!-- Loading image -->
      <div class="overlay uploadProcess" style="display: none;">
        <div class="overlay-content"><img src="../images/loading.gif"/></div>
      </div>
      <!-- Hidden upload form -->
      <form method="post" action="../upload.php" enctype="multipart/form-data" id="picUploadForm" target="uploadTarget">
        <input type="file" name="picture" id="fileInput"  style="display:none"/>
      </form>
      <iframe id="uploadTarget" name="uploadTarget" src="#" style="width:0;height:0;border:0 :solid #fff;"></iframe>
      <!-- Image update link -->
      <a class="editLink" href="javascript:void(0);"><img src="../images/edit.png"/></a>
      <!-- Profile image -->
      <img src="<?php echo $userPictureURL; ?>" id="imagePreview" style ="height: 200px;" >
     </div>
        <div class="name">
            <h4 class="text-center"><?php echo $row['employee_fname']."  ".$row['employee_lname']; ?></h4>
        </div>
    </div>
  </div>
<!-- About Me Box -->

<div class="box box-default collapsed-box box-solid">
  <div class="box-header with-border">
     <h3 class="box-title">Change Password</h3>
      <div class="box-tools pull-right">
         <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
      </div>
   </div>
    <!-- /.box-header -->
  <div class="box-body">
     <form role="form">

        <div class="form-group">
           <label for="exampleInputPassword1">Current Password</label>
           <input type="password" class="form-control" id="InputPassword1" placeholder="current password" autocomplete="none">
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">New Password</label>
            <input type="password" class="form-control" id="InputPassword2" placeholder="new password" autocomplete="none">
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1"> Confirm Password</label>
           <input type="password" class="form-control" id="InputPassword3" placeholder="Confirm password" autocomplete="none">
       </div>

      <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">Submit</button>
      </div>
    </form>
  </div>
</div>
</div>
    <!-- /.box -->

 <div class="col-md-4">
    <div class="panel panel-info">
     <div class="panel-heading">
          <h3 class="panel-title"><b><?php echo $row['employee_fname'] ."   " .$row['employee_lname'] ;?></b></h3>
     </div>
    <div class="panel-body">

                  <table class="table table-user-information">
                    <tbody>
                       <tr>
                        <td><strong>Staff ID</strong></td>
                        <td><?php echo $eid ;?></td>
                      </tr>
                      <tr>
                        <td><strong>Job Title</strong></td>
                        <td><?php echo $row['employee_title'];?></td>
                      </tr>
                      <tr>
                        <td><strong>Department</strong></td>
                        <td><?php echo $row['employee_department'];?></td>
                      </tr>
                      <tr>
                        <td><strong>Hire date</strong></td>
                        <td><?php $date4 = $row['employee_date_employed']; echo date("d/m/y ", strtotime($date4)); ?></td>
                      </tr>
                      <tr>
                        <td><strong>Date of Birth</strong></td>
                        <td><?php $date5 = $row['employee_date_of_birth']; echo date("d/m/y ", strtotime($date5)); ?></td>
                      </tr>
                      <tr>
                        <td><strong>Gender</strong></td>
                        <td><?php echo $row['employee_gender'];?></td>
                      </tr>
                      <tr>
                        <td><strong>Home Address</strong></td>
                        <td><?php echo $row['employee_address'];?></td>
                      </tr>
                      <tr>
                        <td><strong>Email</strong></td>
                        <td><?php echo $row['employee_email'];?></td>
                      </tr>
                        <td><strong>Phone Number</strong></td>
                        <td><?php echo $row['employee_contact'];?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
             </div>
           </div>
      <!-- /.row -->
      <div class="col-md-4">
    <div class="panel panel-info">
     <div class="panel-heading">
          <h3 class="panel-title"><b> Recent Requests</b></h3>
     </div>
    <div class="panel-body">

                  <table class="table table-user-information">
                    <tbody>
                       <?php
              $qry = "SELECT * FROM leave_request WHERE leave_request_employee_id ='$eid' ORDER BY leave_id DESC LIMIT 10";
              $result = mysqli_query($DBcon,$qry) or die(mysqli_error($DBcon));
              if(mysqli_num_rows($result)>0){
              while($row = mysqli_fetch_array($result)){
                  ?>
                       <tr>
                        <td><strong><?php $date3 = $row['leave_request_date']; echo date("d/m/y ", strtotime($date3)); ?></strong></td>
                        <td><?php echo $row['leave_request_type']."   for  ";
                           $start = date_create($row['leave_request_start_date']);
                           $end  = date_create($row['leave_request_end_date']);
                           $diff = date_diff( $start, $end );
                           echo $diff->d ."  Days "; ?></td>
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
                    <?php }} else echo "No activity !" ;?>
                  </tbody>
                  </table>
                </div>
            </div>

      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php  include("../includes/footer.php"); ?>

<script type="text/javascript">
$(document).ready(function () {
    //If image edit link is clicked
    $(".editLink").on('click', function(e){
        e.preventDefault();
        $("#fileInput:hidden").trigger('click');
    });

    //On select file to upload
    $("#fileInput").on('change', function(){
        var image = $('#fileInput').val();
        var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

    //validate file type
        if(!img_ex.exec(image)){
            alert('Please upload only .jpg/.jpeg/.png/.gif file.');
            $('#fileInput').val('');
            return false;
        }else{
            $('.uploadProcess').show();
            $('#uploadForm').hide();
            $( "#picUploadForm" ).submit();
        }
    });
});

//After completion of image upload process
function completeUpload(success, fileName) {
  if(success == 1){
    $('#imagePreview').attr("src", "");
    $('#imagePreview').attr("src", fileName);
    $('#fileInput').attr("value", fileName);
    $('.uploadProcess').hide();
    location.reload();
  }else{
    $('.uploadProcess').hide();
    alert('There was an error during file upload!');
  }
  return true;
}
</script>


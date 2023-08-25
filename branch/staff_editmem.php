<?php session_start();
include "../connect.php";
 
$userid = $_POST['id'];
 
$sql = "SELECT * FROM staff_tbl join branch_tbl on staff_tbl.staff_branch = branch_tbl.branch_id  where staff_id =".$userid;
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result) ){
?>

 <form id="updateStaffForm2" method="post" enctype="multipart/form-data">
    <div class="row">
        
   
 
 </div>
        <div class="row">
           
           
            <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Firstname</label>
                      <input type="text" class="form-control" name="estaff_fname" id="eclassroom_name" required placeholder="" value="<?php echo $row['staff_fname']; ?>">
                       
                  </div>
              </div>
               <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Lastname</label>
                      <input type="text" class="form-control" name="estaff_lname" id="eclassroom_name" required placeholder="" value="<?php echo $row['staff_lname']; ?>">
                       
                  </div>
              </div>
               <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Email</label>
                      <input type="text" class="form-control" name="estaff_email" id="eclassroom_name" required placeholder="" value="<?php echo $row['staff_email']; ?>">
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Branch</label>
                       <select class="form-control" name="ebranchId">
                      <?php
                      $branchId =  $_SESSION['branch_idd'];
                      $queryBranch = "select * from branch_tbl where branch_isactive = '1' and branch_id = '$branchId'";
                        $resqueryBranch = mysqli_query($con, $queryBranch);

                        while($rowBranch = mysqli_fetch_assoc($resqueryBranch))
                        {
                           
                            ?>
                           
                                <option value="<?php echo $rowBranch['branch_id'] ?>"><?php echo $rowBranch['branch_name'] ?></option>
                          
                            <?php

                        }
                      ?>
                        </select>
                      
                       
                  </div>
              </div>
              
               <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Change Password</label>
                      <input type="text" class="form-control" name="estaff_pass" id="eclassroom_name" required placeholder="" value="<?php echo $row['staff_pass']; ?>">
                       
                  </div>
              </div>
              
            
            <input type="hidden" name="id" id="id" value="<?php echo $row['staff_id']; ?>">

            
        </div>
         
    
     <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       <button type="submit" data-id='<?php echo $row['staff_id']; ?>'  class="btn btn-primary">Save</button> 
       </div>                

  </form>


<script type="text/javascript">
$(document).on('submit', '#updateStaffForm2', function(e) {
    e.preventDefault();
    var form = $('#updateStaffForm2')[0];
    var formdata = new FormData(form);
    $.ajax({
        type: 'POST',
        url: 'staff_memedit.php',
        data: formdata,
        contentType: false,
        processData: false,
        success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
                $('#memClassroomModal').modal('hide');
                $('#addStaffModal').modal('hide');
                mytable = $('#tabledataStaff').DataTable();

                swal({
                    title: "Success",
                    text: "Staff Updated",
                    icon: "success",
                    button: false,
                    timer: 1000 
                  
                    
                });

                 
                     setTimeout(function() {
                  location.reload();
              }, 1000);
            } else {
                swal("Error", "Staff Update Error", "error");
            }
        }
    });
});







</script>
 
 
<?php } 


?>
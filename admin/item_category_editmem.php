<?php session_start();
include "../connect.php";
 
$userid = $_POST['id'];
 
$sql = "SELECT * FROM item_category_tbl join branch_tbl on item_category_tbl.item_category_branch = branch_tbl.branch_id  where item_category_id =".$userid;
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result) ){
?>

 <form id="updateStaffForm2" method="post" enctype="multipart/form-data">
    <div class="row">
        
   
 
 </div>
        <div class="row">
           
           
            <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Category name</label>
                      <input type="text" class="form-control" name="ecatName" id="ecatName" required placeholder="" value="<?php echo $row['item_category_name']; ?>">
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Branch</label>
                     

                      <select class="form-control" name="ebranchId">
                    <option value="<?php echo $row['branch_id'] ?>" hidden><?php echo $row['branch_name'] ?></option>
                      <?php
                      $queryBranch = "select * from branch_tbl where branch_isactive = '1' and branch_id != '3'";
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
         
              
            
            <input type="hidden" name="id" id="id" value="<?php echo $row['item_category_id']; ?>">

            
        </div>
         
    
     <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       <button type="submit" data-id='<?php echo $row['item_category_id']; ?>'  class="btn btn-primary">Save</button> 
       </div>                

  </form>


<script type="text/javascript">
$(document).on('submit', '#updateStaffForm2', function(e) {
    e.preventDefault();
    var form = $('#updateStaffForm2')[0];
    var formdata = new FormData(form);
    $.ajax({
        type: 'POST',
        url: 'item_category_memedit.php',
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
                    text: "Category Updated",
                    icon: "success",
                    button: false,
                    timer: 1000 
                  
                    
                });

                 
                     setTimeout(function() {
                  location.reload();
              }, 1000);
            } else {
                swal("Error", "Category Update Error", "error");
            }
        }
    });
});







</script>
 
 
<?php } 


?>
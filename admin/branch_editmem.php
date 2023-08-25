<?php session_start();
include "../connect.php";
 
$userid = $_POST['id'];
 
$sql = "SELECT * FROM branch_tbl where branch_id = '$userid' ";
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result) ){
?>

 <form id="updateStaffForm2" method="post" enctype="multipart/form-data">
    <div class="row">
        
   
 
 </div>
        <div class="row">
           
           
            <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Branch name</label>
                      <input type="text" class="form-control" name="ebranchNAme" id="eclassroom_name" required placeholder="" value="<?php echo $row['branch_name']; ?>">
                       
                  </div>
              </div>
               
           
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Availbility</label>
                     

                      <select class="form-control" name="ebranchAvail">
                        <option value="1">Active</option>
                         <option value="0">Not Active</option>
                      
                                            
                          
                        </select>
                       
                  </div>
              </div>
            
              
            
            <input type="hidden" name="id" id="id" value="<?php echo $row['branch_id']; ?>">

            
        </div>
         
    
     <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       <button type="submit" data-id='<?php echo $row['branch_id']; ?>'  class="btn btn-primary">Save</button> 
       </div>                

  </form>


<script type="text/javascript">
$(document).on('submit', '#updateStaffForm2', function(e) {
    e.preventDefault();
    var form = $('#updateStaffForm2')[0];
    var formdata = new FormData(form);
    $.ajax({
        type: 'POST',
        url: 'branch_memedit.php',
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
                    text: "Branch Updated",
                    icon: "success",
                    button: false,
                    timer: 1000 
                  
                    
                });

                 
                     setTimeout(function() {
                  location.reload();
              }, 1000);
            } else {
                swal("Error", "Branch Update Error", "error");
            }
        }
    });
});







</script>
 
 
<?php } 


?>
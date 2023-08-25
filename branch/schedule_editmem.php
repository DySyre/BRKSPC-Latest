<?php session_start();
include "../connect.php";
 
$userid = $_POST['id'];
 
$sql = "SELECT * FROM schedule_tbl  where schedule_id  =".$userid;
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result) ){
?>

 <form id="updateschedForm2" method="post" enctype="multipart/form-data">
    <div class="row">
        
   
 
 </div>
        <div class="row">
           
           
            <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Schedule Date</label>
                      <input type="date" class="form-control" name="schedule_date" id="eclassroom_name" required placeholder="" value="<?php echo $row['schedule_date']; ?>" readonly>
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Availbility</label>
                     

                      <select class="form-control" name="availibility">
                 <option value="1">Available</option>
                 <option value="0">Not Available</option>

                    </select>
                       
                  </div>
              </div>
            
              
            
            <input type="hidden" name="id" id="id" value="<?php echo $row['schedule_id']; ?>">

            
        </div>
         
    
     <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       <button type="submit" data-id='<?php echo $row['schedule_id']; ?>'  class="btn btn-primary">Save</button> 
       </div>                

  </form>


<script type="text/javascript">
$(document).on('submit', '#updateschedForm2', function(e) {
    e.preventDefault();
    var form = $('#updateschedForm2')[0];
    var formdata = new FormData(form);
    $.ajax({
        type: 'POST',
        url: 'schedule_memedit.php',
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
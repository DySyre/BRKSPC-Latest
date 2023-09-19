<?php 
 include 'include/header.php';
 include '../connect.php';
$ActionName = $_POST['id'];
$staaffId = $_POST['staaffId'];

$schedId = $_POST['schedId'];
$appointID = $_POST['appointID'];
$braIdd = $_POST['braIdd'];


if($ActionName == 'approve')
{
    ?>
   <div class="row">
          <div class="col-md-4 mt-2">
    <input type="hidden" class="form-control" id="StaffIdss" value="<?php echo $staaffId ?>" >
      
    <input type="hidden" class="form-control" name="StaffId" value="<?php echo $staaffId ?>" >
    <input type="hidden" class="form-control" name="schedIdd" value="<?php echo $schedIdd ?>" >

    <input type="hidden" class="form-control" name="appointID" value="<?php echo $appointID ?>" >



    <input type="hidden" class="form-control" name="startTimeSched" required><br>
    <label>Reminder/Comment:</label>
     <textarea rows="4" cols="50" name="ReasonNmae" placeholder="Enter 255 characters only" required></textarea>

</div>
          <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       <button type="submit" data-id='<?php echo $row['appointment_payment_id']; ?>'  class="btn btn-primary">Save</button> 
       </div>  
      </div>
    <div class="row" id="ans2">
       
    </div>
    <?php

}
else
{
    ?>
    <div class="col-md-12">
     <label >Reason/Comment</label>
     <br>
     <!-- <input type="text-area" name=""> -->
     <textarea rows="4" cols="50" name="ReasonNmaeCancel" placeholder="Enter 255 characters only" required></textarea>

 </div>
 <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       <button type="submit"  class="btn btn-primary">Save</button> 
       </div>  
    <?php

}
 ?>
 <script type="text/javascript">
     
function selectStaff(){
      
      var x = document.getElementById("selectStaffId").value;
      // document.getElementById("potek").disabled = true;
      var y = document.getElementById("schedId2").value;
      var StaffIdss = document.getElementById("StaffIdss").value;

      
      var z = document.getElementById("appointID").value;

      
     //alert(x);
        $.ajax({
                url:"appointment_showstaff.php",
                method:"POST",
                data:{
                  id: x,
                  schedIdd: y,
                  appointID: z,
                  StaffIdss:StaffIdss
                },
                success: function(data){
                  $("#ans2").html(data);

                }
              })

      }
 </script>
 
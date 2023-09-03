<?php session_start();
include "connect.php";
  $clientId =  $_SESSION['client_id'];
$ActionName = $_POST['id'];
$appIDd = $_POST['appIDd'];

if($ActionName == 'Resched')
{
    ?>
  
     <div class="col-md-4">
     <label >Note</label>
     <br>
     <input type="hidden" name="resched" value="resched">
      <input type="hidden" name="appdd" value="<?php echo $appIDd ?>">
     
     <!-- <input type="text-area" name=""> -->

     <?php 
$CheckServId1 = "SELECT * FROM `appointment_tbl` WHERE appointment_payment_id = '$appIDd'";
                      $reCheckServId1 = mysqli_query($con, $CheckServId1);
                      $rowreCheckServId1 = mysqli_fetch_assoc($reCheckServId1);
                      $eventid = $rowreCheckServId1['appointment_date'];
     ?>
       <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Available Date for Resched:</label>
                      <select class="form-control" name="newSchedId">
            
                      <?php
                      $queryBranch = "SELECT *
FROM schedule_tbl
WHERE  (schedule_id != '$eventid' AND scheduledate_count != '6') AND schedule_date >= DATE_ADD(CURDATE(), INTERVAL 2 DAY);
";
                        $resqueryBranch = mysqli_query($con, $queryBranch);

                        while($rowBranch = mysqli_fetch_assoc($resqueryBranch))
                        {
                           
                            ?>
                           <option value="<?php echo $rowBranch['schedule_id'] ?>"><?php echo $rowBranch['schedule_date'] ?></option>
                                
                          
                            <?php

                        }
                      ?>
                        </select>
                       
                  </div>
              </div>
    

 </div>
 <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       <button type="submit"  class="btn btn-primary">Submit</button> 
  </div> 
          <?php

}
else if($ActionName == 'Cancel')
{
  ?>
    
  <input type="hidden" name="cancelName" value="cancel">
      <input type="hidden" name="appdd" value="<?php echo $appIDd ?>">

  <label style="font-size: 2rem; text-shadow: 0 0 10px #fff;" class="btn btn-danger">Reminder, If You Cancel Your Appointment we will not refund your payment.</label>
<div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       <button type="submit"  class="btn btn-primary">Submit</button> 
       </div>  

  <?php

}




?>
<script type="text/javascript">
  $(document).on('submit', '#formAppoint', function(e) {
      e.preventDefault();
        var form =$('#formAppoint')[0];
        var formdata = new FormData(form);
        $.ajax({
    type: 'POST',
    url:'myappointment_cancel_or_resched.php',
    data: formdata,
    contentType: false,
    processData: false,
   success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'Cancel') {
            $('#memViewAppointmentModal').modal('hide');
            
              swal("Success", "Appointment Cancel", "success");

              setTimeout(function() {
                  location.reload();
              }, 1000);


            }
             else if (status == 'Resched') {
            $('#memViewAppointmentModal').modal('hide');
            
              swal("Success", "Appointment Resched, Wait For Approval!", "success");

              setTimeout(function() {
                  location.reload();
              }, 4000);


            }
            else if (status == 'already') {
              
             swal("Error", "Appointment Already Assigned", "error");


            }
            
            
             else if (status == 'false') {
              
              swal("Error", "Staff Added Error", "error");
            }
          }
    
  });
         
    });
</script>
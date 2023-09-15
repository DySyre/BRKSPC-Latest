<?php 
 include 'include/header.php';
 include '../connect.php';
$StaffId = $_POST['id'];
$schedIdd = $_POST['schedIdd'];
$appointID = $_POST['appointID'];




$query2 = "select * from staff_schedule_tbl where schedule_date_idfk = '$schedIdd' AND (staff_idfk = '$StaffId' AND staff_schedule_status = 'assign')";
$result2 = mysqli_query($con, $query2);

if(mysqli_num_rows($result2) > 0)
{
  ?>
    <div class="row">
       <label>Not Available Time:</label><br>
     <?php
$openTime = strtotime('8:00am');
$closeTime = strtotime('5:00pm');

$notAvailableTimeSlots = array();

while ($RowschedData = mysqli_fetch_assoc($result2)) {
    $startTime = strtotime($RowschedData['staff_schedule_time']);
    $endTime = strtotime($RowschedData['staff_schedule_endtime']);

    $formattedStartTime = date("H:i", $startTime);
    $formattedEndTime = date("H:i", $endTime);

    $notAvailableTimeSlots[] = $formattedStartTime . ' - ' . $formattedEndTime;
}

// Output the not available time slots
foreach ($notAvailableTimeSlots as $timeSlot) {
    ?>
    <div class="col-md-3">
        <label style="color: red;"><?php echo $timeSlot; ?></label>
    </div>
    <?php
}

// Get the available time slots
$availableTimeSlots = array_diff($notAvailableTimeSlots, array(''));

?>


 </div>
    <div class="row">
          <div class="col-md-4 mt-2">
            
    <input type="hidden" class="form-control" name="StaffId" value="<?php echo $StaffId ?>" >
    <input type="hidden" class="form-control" name="schedIdd" value="<?php echo $schedIdd ?>" >

    <input type="hidden" class="form-control" name="appointID" value="<?php echo $appointID ?>" >


    <label>Set Time For This Appointment:</label><br>
    <input type="time" class="form-control" name="startTimeSched" required><br>
    <label>Reminder/Comment:</label>
     <textarea rows="4" cols="50" name="ReasonNmae" placeholder="Enter 255 characters only"></textarea>

</div>
          <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       <button type="submit" data-id='<?php echo $row['appointment_payment_id']; ?>'  class="btn btn-primary">Save</button> 
       </div>  
      </div>

    <?php
    



}
else
{
   ?>
   

      <div class="row">
          <div class="col-md-4 mt-2">
            
    <input type="hidden" class="form-control" name="StaffId" value="<?php echo $StaffId ?>" >
    <input type="hidden" class="form-control" name="schedIdd" value="<?php echo $schedIdd ?>" >

    <input type="hidden" class="form-control" name="appointID" value="<?php echo $appointID ?>" >


    <label>Set Time For This Appointment:</label><br>
    <input type="time" class="form-control" name="startTimeSched" required><br>
    <label>Reminder/Comment:</label>
     <textarea rows="4" cols="50" name="ReasonNmae" placeholder="Enter 255 characters only"></textarea>

</div>
          <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       <button type="submit" data-id='<?php echo $row['appointment_payment_id']; ?>'  class="btn btn-primary">Save</button> 
       </div>  
      </div>
   <?php 
}

 ?>
 <script type="text/javascript">
     

 </script>
 
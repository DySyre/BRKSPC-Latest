<?php 
 include("connect.php");

$StaffId = $_POST['id'];
$schedIdd = $_POST['schedIdd'];

$query2 = "select * from staff_schedule_tbl where schedule_date_idfk = '$schedIdd' AND staff_idfk = '$StaffId'   limit 1";
$result2 = mysqli_query($con, $query2);



if(mysqli_num_rows($result2) > 0)
{

         ?>
    <div class="row">


        <label>Not Available Time:</label>

        <input type="hidden" name="staffIds" value="<?php echo $StaffId ?> ">
<?php

    while($rowData = mysqli_fetch_assoc($result2))
    {
         $idSched = $rowData['staff_schedule_id'];

      

//


       $openTime = '8:00';
        $endTime = '17:00';

$queryTime1 = "SELECT count(staff_id) as staffRows FROM staff_tbl where staff_type = '2' and staff_branch = '8'";
$resqueryTime1 = mysqli_query($con, $queryTime1);
$rowTime1 = mysqli_fetch_assoc($resqueryTime1);





$queryTime = "select * from staff_schedule_tbl where schedule_date_idfk = '$schedIdd' AND staff_idfk = '$StaffId' AND (staff_schedule_status = 'assigned' OR staff_schedule_status = 'assign' ) order by staff_schedule_time asc";
$resqueryTime = mysqli_query($con, $queryTime);

$NotAvailableTime = array();

while ($rowTime = mysqli_fetch_assoc($resqueryTime)) 
{

    $NotAvailableTime1 = date('H:i', strtotime($rowTime['staff_schedule_time']) - 15 * 60);
    $NotAvailableTime[] = $NotAvailableTime1 . '-' . $rowTime['staff_schedule_endtime'];


                               ?>
                              
                                 <div class="col-md-3">

                    <label style="color: red;"><?php echo date("g:ia", strtotime($rowTime['staff_schedule_time'])); ?> to <?php echo date("g:ia", strtotime($rowTime['staff_schedule_endtime'])); ?></label>
                                </div>
                              
                               
                               <?php
}

$openDateTime = new DateTime($openTime);
$endDateTime = new DateTime($endTime);



$timeIntervals = array();



while ($openDateTime <= $endDateTime) {
    $formattedTime = $openDateTime->format('H:i');
    $interval = $formattedTime;

    // Check if the current interval is within any of the intervals in $NotAvailableTime
    $intervalToRemove = false;

    foreach ($NotAvailableTime as $removeInterval) {
        list($start, $end) = explode('-', $removeInterval);
        if ($interval >= $start && $interval < $end) {
            $intervalToRemove = true;
            break;
        }
    }

    if (!$intervalToRemove) {
        $timeIntervals[] = $interval;
    }

    $openDateTime->add(new DateInterval('PT15M'));
}



?>
<div class="col-md-12">
    <label for="timeSelect">Available Time:</label>
<select class="form-control" id="timeSelect" name="startTimeSched">
    <?php foreach ($timeIntervals as $interval): ?>
        <option value="<?php echo $interval; ?>"><?php echo date("g:ia", strtotime($interval)); ?></option>
    <?php endforeach; ?>
</select> 
</div>
    
  </div>

 
  <?php
    } // end while

} // end if
else
{

$openTime = '8:00';
$endTime = '17:00';

$openDateTime = new DateTime($openTime);
$endDateTime = new DateTime($endTime);

$timeIntervals = array();

while ($openDateTime <= $endDateTime) {
    $timeIntervals[] = $openDateTime->format('H:i');
    $openDateTime->add(new DateInterval('PT15M'));
}
?>

<div class="row">
    <input type="hidden" name="staffIds" value="<?php echo $StaffId ?> ">
    <div class="col-md-4">
    <label for="timeSelect">Available Time:</label>

<select class="form-control" id="timeSelect" name="startTimeSched">
        <?php foreach ($timeIntervals as $interval): ?>
            <option value="<?php echo $interval; ?>"><?php echo $interval; ?></option>
        <?php endforeach; ?>
    </select>
</div>
</div>

   <?php 
}

 ?>
 <script type="text/javascript">
     

 </script>
 
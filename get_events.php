<?php
// Connect to the database
session_start();
$branchdd = $_SESSION['branch_idd'];

include("connect.php");

$start = $_GET['start'];
$end = $_GET['end'];



// Fetch the events from the database for the date range
$query = "SELECT * FROM `schedule_tbl`  WHERE schedule_isavail = '1' AND (schedule_date >= '$start' AND schedule_date <= '$end' AND schedule_branch = '$branchdd')";
$result = mysqli_query($con, $query);

// Convert the event data into JSON format
$events = array();
while ($row = mysqli_fetch_assoc($result)) {
  $event = array(
    'id' => $row['schedule_id'],
    'title' => 'Available',
    'start' => $row['schedule_date'],
    'end' => $row['schedule_date'],
    'startTime' => $row['schedule_startTime'],
    'doc_time_status' => $row['schedule_isavail'],
    'schedule_branch' => $row['schedule_branch'],
    'schedCount' => $row['scheduledate_count'],
    
 
  );
  array_push($events, $event);
}
echo json_encode($events);
mysqli_close($con);
?>



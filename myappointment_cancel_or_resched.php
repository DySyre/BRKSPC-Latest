<?php 
session_start();
include('connect.php'); 

$appdds = $_POST['appdd'];

if(isset($_POST['cancelName']))
{
  
        $sql = "UPDATE `appointment_tbl` SET `appointment_payment_status`='cancel' WHERE  appointment_payment_id ='$appdds'";

         $query= mysqli_query($con,$sql);
         $lastId = mysqli_insert_id($con);

         $CheckServId1 = "SELECT * FROM `appointment_tbl` WHERE appointment_payment_id = '$appdds'";
                      $reCheckServId1 = mysqli_query($con, $CheckServId1);
                      $rowreCheckServId1 = mysqli_fetch_assoc($reCheckServId1);
                      $eventid = $rowreCheckServId1['appointment_date'];

          $CheckServId = "SELECT * FROM `schedule_tbl` WHERE schedule_id = '$eventid'";
                      $reCheckServId = mysqli_query($con, $CheckServId);
                      $rowreCheckServId = mysqli_fetch_assoc($reCheckServId);
                      $countSched = $rowreCheckServId['scheduledate_count'];

                      $schedCount = $countSched - 1;

                       $sql22 = "UPDATE `schedule_tbl` SET `scheduledate_count`='$schedCount' WHERE  schedule_id ='$eventid'";

                      $query22= mysqli_query($con,$sql22);

            
                $data = array(
            'status'=>'Cancel',    
        );
        echo json_encode($data);
          

}
else if(isset($_POST['resched']))
{ 
  $newSchedId = $_POST['newSchedId'];

    $sql = "UPDATE `appointment_tbl` SET `appointment_date`='$newSchedId' WHERE  appointment_payment_id ='$appdds'";

         $query= mysqli_query($con,$sql);
         $lastId = mysqli_insert_id($con);


         $CheckServId1 = "SELECT * FROM `appointment_tbl` WHERE appointment_payment_id = '$appdds'";
                      $reCheckServId1 = mysqli_query($con, $CheckServId1);
                      $rowreCheckServId1 = mysqli_fetch_assoc($reCheckServId1);
                      $eventid = $rowreCheckServId1['appointment_date'];

          $CheckServId = "SELECT * FROM `schedule_tbl` WHERE schedule_id = '$eventid'";
                      $reCheckServId = mysqli_query($con, $CheckServId);
                      $rowreCheckServId = mysqli_fetch_assoc($reCheckServId);
                      $countSched = $rowreCheckServId['scheduledate_count'];

                      $schedCount = $countSched + 1;

                       $sql22 = "UPDATE `schedule_tbl` SET `scheduledate_count`='$schedCount' WHERE  schedule_id ='$eventid'";

                      $query22= mysqli_query($con,$sql22);

            
                $data = array(
            'status'=>'Resched',    
        );
        echo json_encode($data);
  

}
?>


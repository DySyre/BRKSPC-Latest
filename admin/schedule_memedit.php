<?php session_start();
include "../connect.php";

$availibility =$_POST['availibility'];
$schedule_date =$_POST['schedule_date'];

$id = $_POST["id"];


// Image extension validation

        $sql = "UPDATE `schedule_tbl` SET `schedule_isavail`='$availibility' WHERE  schedule_id  ='$id'";

         $query= mysqli_query($con,$sql);
         $lastId = mysqli_insert_id($con);
        if($query ==true)
            {
   
            $data = array(
            'status'=>'true',
       
            );

             echo json_encode($data);
            }
        else
            {
            $data = array(
            'status'=>'false',
      
            );

            echo json_encode($data);
            }   

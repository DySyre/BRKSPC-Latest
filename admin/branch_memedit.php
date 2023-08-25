<?php session_start();
include "../connect.php";

$ebranchNAme =$_POST['ebranchNAme'];
$ebranchAvail =$_POST['ebranchAvail'];


$id = $_POST["id"];


// Image extension validation

        $sql = "UPDATE `branch_tbl` SET `branch_name`='$ebranchNAme',`branch_isactive`='$ebranchAvail' WHERE  branch_id ='$id'";

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

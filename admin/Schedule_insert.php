<?php include('../connect.php'); 

$schedDate = $_POST['schedDate'];
$branchId = $_POST['branchId'];




    $sql2 = "SELECT * FROM `schedule_tbl` WHERE `schedule_date` = '$schedDate' AND (schedule_isavail = '1' AND schedule_branch = '$branchId')";
    $result2 = mysqli_query($con, $sql2);

    if (mysqli_num_rows($result2)==1)
    {
        $data = array(
            'status'=>'already',    
        );
        echo json_encode($data);
    }
    else
    {
        
     
        $sql = "INSERT INTO `schedule_tbl`(`schedule_date`,`schedule_branch`) VALUES ('$schedDate','$branchId')";

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
        
       
   
    }
  


  



    
?>
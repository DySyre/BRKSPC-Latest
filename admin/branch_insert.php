<?php include('../connect.php'); 

$bname = $_POST['bname'];





    $sql2 = "SELECT * FROM `branch_tbl` WHERE `branch_name` = '$bname';";
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
        
     
        $sql = "INSERT INTO `branch_tbl`(`branch_name`, `branch_isactive`) VALUES ('$bname','1')";

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
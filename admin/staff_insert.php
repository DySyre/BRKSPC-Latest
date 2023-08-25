<?php include('../connect.php'); 

$branchId = $_POST['branchId'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$userType = $_POST['userType'];




    $sql2 = "SELECT * FROM `staff_tbl` WHERE `staff_email` = '$email';";
    $result2 = mysqli_query($con, $sql2);

    if (mysqli_num_rows($result2)==1)
    {
        if($userType == '2')
        {
            $sql = "INSERT INTO `staff_tbl`(`staff_fname`, `staff_lname`, `staff_branch`, `staff_email`, `staff_pass`,`staff_type`) VALUES ('$fname','$lname','$branchId','$email','$pass','$userType')";

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
        else
        {
             $data = array(
            'status'=>'already',    
        );
        echo json_encode($data);

        }


       
    }
    else
    {

     
        $sql = "INSERT INTO `staff_tbl`(`staff_fname`, `staff_lname`, `staff_branch`, `staff_email`, `staff_pass`,`staff_type`) VALUES ('$fname','$lname','$branchId','$email','$pass','$userType')";

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
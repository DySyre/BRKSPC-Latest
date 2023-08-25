<?php include('../connect.php'); 

$CatName = $_POST['CatName'];
// $fname = $_POST['fname'];
// $lname = $_POST['lname'];
// $email = $_POST['email'];
// $pass = $_POST['pass'];



    $sql2 = "SELECT * FROM `category_tbl` WHERE `category_name` = '$CatName';";
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
        
     
        $sql = "INSERT INTO `category_tbl`(`category_name`) VALUES ('$CatName')";

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
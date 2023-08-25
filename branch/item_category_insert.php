<?php include('../connect.php'); 

$branchId = $_POST['branchId'];
$catName = $_POST['catName'];





    $sql2 = "SELECT * FROM `item_category_tbl` WHERE `item_category_name` = '$catName' AND item_category_branch ='$branchId'";
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
        
     
        $sql = "INSERT INTO `item_category_tbl`(`item_category_name`, `item_category_branch`) VALUES ('$catName','$branchId')";

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
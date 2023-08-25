<?php session_start();
include "../connect.php";

$estaff_fname =$_POST['ecatName'];

$ebranchId =$_POST['ebranchId'];

$id = $_POST["id"];


// Image extension validation

        $sql = "UPDATE `item_category_tbl` SET `item_category_name`='$estaff_fname',`item_category_branch`='$ebranchId' WHERE  item_category_id ='$id'";

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

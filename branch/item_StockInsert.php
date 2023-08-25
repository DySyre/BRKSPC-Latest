<?php session_start();
include "../connect.php";


$eItemName = $_POST['eItemName'];
$eStockName = $_POST['eStockName'];
$neweStockName = $_POST['neweStockName'];
$newStock = 0;
$id = $_POST["id"];


$newStock = $eStockName + $neweStockName;

// Image extension validation

        $sql = "UPDATE `item_tbl` SET `item_stock`='$newStock' WHERE  item_id ='$id'";

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

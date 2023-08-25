<?php session_start();
include "../connect.php";


$eItemName = $_POST['eItemName'];
$eItemCatId = $_POST['eItemCatId'];
$eBuyingName = $_POST['eBuyingName'];
$eSellingName = $_POST['eSellingName'];
$eStockName = $_POST['eStockName'];
$eExpirationName = $_POST['eExpirationName'];

$id = $_POST["id"];


// Image extension validation

        $sql = "UPDATE `item_tbl` SET `item_name`='$eItemName',`item_categoryidfk`='$eItemCatId',`item_buying_price`='$eBuyingName',`item_selling_price`='$eSellingName',`item_stock`='$eStockName',`item_expiration` ='$eExpirationName' WHERE  item_id ='$id'";

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

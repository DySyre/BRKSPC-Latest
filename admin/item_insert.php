<?php include('../connect.php'); 

$itmCode = $_POST['itmCode'];
$ItemName = $_POST['ItemName'];
$ItemCatId = $_POST['ItemCatId'];
$BuyingName = $_POST['BuyingName'];
$SellingName = $_POST['SellingName'];
$StockName = $_POST['StockName'];
$ExpirationName = $_POST['ExpirationName'];



    $sql2 = "SELECT * FROM `item_tbl` WHERE `item_name` = '$ItemName' AND item_categoryidfk = '$ItemCatId';";
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
        
     
        $sql = "INSERT INTO `item_tbl`(`item_code`, `item_name`, `item_categoryidfk`, `item_buying_price`, `item_selling_price`,`item_stock`,`item_expiration`) VALUES ('$itmCode','$ItemName','$ItemCatId','$BuyingName','$SellingName','$StockName','$ExpirationName')";

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
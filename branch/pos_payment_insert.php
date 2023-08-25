<?php session_start();
include "../connect.php";

$ordernum = $_POST['idd'];
$payment = $_POST['payment'];
$TotalAmounts = $_POST['TotalAmounts'];
$changeBals = $_POST['changeBals'];





$sql = "INSERT INTO `pos_ordered_tbl`(`pos_ordered_numidfk`, `pos_ordered_totalamnt`, `pos_ordered_payment`, `pos_ordered_change`) VALUES ('$ordernum','$TotalAmounts','$payment','$changeBals')";

$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);



if($query == true)
{
    $sql = "DELETE FROM pos_order_list_tbl";
$delQuery =mysqli_query($con,$sql);

$sql2 = "DELETE FROM pos_purchase_tbl";
$delQuery2 =mysqli_query($con,$sql2);

 $sql3 = "UPDATE `pos_purchase_his_tbl` SET `isProceed` = 1 WHERE  pos_purchase_hisordrnum ='$ordernum'";

 $query3= mysqli_query($con,$sql3);

 if( $query3 == true)
 {


    $CheckServId = "SELECT * FROM `pos_purchase_his_tbl` WHERE  pos_purchase_hisordrnum ='$ordernum' AND isProceed = '1'";
    $reCheckServId = mysqli_query($con, $CheckServId);

while($rowreCheckServId = mysqli_fetch_assoc($reCheckServId))
 {
    $itemId = $rowreCheckServId['pos_purchase_hisitemidfk'];
    $itemQty = $rowreCheckServId['pos_purchase_hisitemqty'];

    $CheckStock = "SELECT * FROM `item_tbl` WHERE  item_id ='$itemId'";
    $reCheckStock = mysqli_query($con, $CheckStock);
    $rowreCheckStock = mysqli_fetch_assoc($reCheckStock);
    $itemStock = $rowreCheckStock['item_stock'];
    
    $newQty = $itemStock - $itemQty;



     $sql4 = "UPDATE `item_tbl` SET `item_stock`= '$newQty'  WHERE item_id = '$itemId' ";

         $query4= mysqli_query($con,$sql4);

 }

    $_SESSION['ordernumSes'] = $ordernum;
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
            'status'=>'false',    
        );
        echo json_encode($data);
}


?>
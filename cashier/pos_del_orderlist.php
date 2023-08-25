<?php include('../connect.php');

$id = $_POST['idd'];
$sql = "DELETE FROM pos_order_list_tbl WHERE pos_order_list_id   ='$id'";
$delQuery =mysqli_query($con,$sql);
 

?>
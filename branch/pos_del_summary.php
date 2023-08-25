<?php include('../connect.php');

$id = $_POST['idd'];
$sql = "DELETE FROM pos_purchase_tbl WHERE pos_purchase_id   ='$id'";
$delQuery =mysqli_query($con,$sql);

$sql1 = "DELETE FROM pos_purchase_his_tbl WHERE lastid   ='$id'";
$delQuery1 =mysqli_query($con,$sql1);
 

?>
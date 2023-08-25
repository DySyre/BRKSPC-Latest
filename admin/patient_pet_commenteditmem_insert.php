<?php session_start();
include "../connect.php";

$billId = $_POST['idd'];
$payment = $_POST['payment'];


$sql = "UPDATE `pet_services_his_tbl` SET `history_coment`='$payment'  WHERE pet_services_his_id = '$billId'";

$query= mysqli_query($con,$sql);


 if( $query == true)
 {


    // $_SESSION['ordernumSes'] = $ordernum;
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


    




?>
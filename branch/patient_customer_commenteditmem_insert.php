<?php session_start();
include "../connect.php";

$billId = $_POST['idd'];
$payment = $_POST['payment'];


$sql = "UPDATE `appointment_tbl` SET `appointment_coment`='$payment'  WHERE appointment_payment_id = '$billId'";

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
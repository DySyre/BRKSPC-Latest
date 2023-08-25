<?php session_start();
include "../connect.php";

$billId = $_POST['idd'];
$payment = $_POST['payment'];
$TotalAmounts = $_POST['TotalAmounts'];
$changeBals = $_POST['changeBals'];

$sumRem = 0;
$sumAmm = 0;

$sql3 = "SELECT * FROM `appointment_bill_tbl` WHERE appointment_bill_id = '$billId'";

$totalQuery3 = mysqli_query($con,$sql3);
$row3 = mysqli_fetch_assoc($totalQuery3);

 $appointment_bill_payment = $row3['appointment_bill_payment'];
 $appointment_bill_total = $row3['appointment_bill_total'];

$sumRem = $appointment_bill_payment + $payment;

$sumAmm  = $sumRem - $appointment_bill_total;

$sql = "UPDATE `appointment_bill_tbl` SET `appointment_bill_payment`='$sumRem', `appointment_bill_bal`='$sumAmm' WHERE appointment_bill_id = '$billId'";

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
<?php 
session_start();
include('../connect.php'); 
include("../assets/libs/enc-dec/enc-dec.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require('../assets/libs/email/PHPMailer/Exception.php');
require('../assets/libs/email/PHPMailer/SMTP.php');
require('../assets/libs/email/PHPMailer/PHPMailer.php');



if(isset($_POST['approvedName']))
{
      $services_id = $_POST['services_id'];
$amount = $_POST['amount'];
$qty = $_POST['qty'];
$price = $_POST['pricess'];
$appointMentID = $_POST['appointMentID'];
$grandTotal = $_POST['grandTotal'];
$cashAmount = $_POST['cashAmount'];
$changeBalAmount = $_POST['changeBalAmount'];
$new = $_POST['sameIdAppointid'];
$StaffIdDd = $_POST['StaffIdDdName'];
$noteName = $_POST['noteName'];





foreach ($services_id as $indexs => $services_id) 
{
      $new_name = $services_id;
      $new_amount= $amount[$indexs];
      $new_qty = $qty[$indexs];
       $new_price = $price[$indexs];

      $sql = "INSERT INTO `appointment_completed_tbl`(`appointment_completed_idfk`, `appointment_services_idfk`,`app_com_price`,`appointment_completed_qty`, `appointment_completed_amount`,`user_add`) VALUES ('$appointMentID','$new_name','$new_price','$new_qty','$new_amount','$new')";

$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);


}
if($query == true)
{
     $sql = "UPDATE `appointment_tbl` SET `appointment_payment_status`='completed', `appointment_coment` ='$noteName' WHERE  appointment_payment_id ='$appointMentID'";

         $query= mysqli_query($con,$sql);
         $lastId = mysqli_insert_id($con);


         $sql2 = "INSERT INTO `appointment_bill_tbl`(`appointment_idfk`, `appointment_bill_total`,`appointment_bill_payment`,`appointment_bill_bal`,`appon_bill_comment`) VALUES ('$appointMentID','$grandTotal ','$cashAmount','$changeBalAmount','$noteName')";

      $query2= mysqli_query($con,$sql2);
 


 $sql6 = "UPDATE `staff_schedule_tbl` SET `staff_schedule_status`='completed' WHERE  staff_schedule_id ='$StaffIdDd '";

         $query6= mysqli_query($con,$sql6);



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
else if(isset($_POST['cancelA']))
{
      $appointMentID = $_POST['appointMentID'];
      $StaffIdDd = $_POST['StaffIdDdName'];
          $ReasonNmae1 = $_POST['ReasonNmae1'];

        $sql = "UPDATE `appointment_tbl` SET `appointment_payment_status`='refund' WHERE  appointment_payment_id ='$appointMentID'";





$CheckServId = "SELECT * FROM `appointment_tbl`  WHERE appointment_payment_id = '$appointMentID'";
$reCheckServId = mysqli_query($con, $CheckServId);

$rowreCheckServId = mysqli_fetch_assoc($reCheckServId);
$ownerId =  $rowreCheckServId['pet_ownerid'];

$CheckServId1 = "SELECT * FROM `users_balagtas`  WHERE id = '$ownerId'";
$reCheckServId1 = mysqli_query($con, $CheckServId1);

$rowreCheckServId1 = mysqli_fetch_assoc($reCheckServId1);
$staffNAme =  $rowreCheckServId1['user_name'];
$stafflNAme =  $rowreCheckServId1['last_name'];
$Email =  $rowreCheckServId1['email'];


$mail = new PHPMailer(true);
$email = $Email;
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'barkspace2020@gmail.com';
            $mail->Password   = 'gwarcvkvajmhrdwx';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
        
            //Recipients
            $mail->setFrom('barkspace2020@gmail.com', 'APPOINTMENT DETAILS');
            $mail->addAddress($email);
            //Content
            $mail->isHTML(true);
            $mail->Subject = 'APPOINTMENT CANCEL';
            $message = '<html>
            <head>
              <style>
                .pymntRow{
                  border-radius: 10px;
                  border: 1px solid lightgray;
                  padding-top: 20px;
                  padding-left: 10px;
                  padding-right: 10px;
                  padding-bottom: 20px;
                }.pymntLabel{
                  color:gray;
                  font-size: 12px;
                  text-align: center;
                  font-weight: bold;
                  padding-top: 3px;
                  padding-bottom: 3px;
                  padding-left:10px;
                }
                .pymntVal{
                  color:black;
                  font-size: 14px;
                  text-align: left;
                  font-weight: bold;
                  padding-top: 3px;
                  padding-bottom: 3px;
                }
                .pymntSchedRow{
                  border-top: 1px solid lightgray;
                  padding-top: 10px;
                }
                .pymntLabelFee{
                  color:gray;
                  font-size: 20px;
                  text-align: center;
                  font-weight: bold;
                }
                .pymntValFee{
                  color:black;
                  font-size: 20px;
                  text-align: left;
                  font-weight: bold;
                }
                .pymntImg{
                  width: 100px;
                  height: 100px;
                }
              </style>
            </head>
            <body>';
            $message .= '<div class="row pymntRow">';
              $message .= '<label class="pymntLabel">WHAT:</label>';
            $message .= '<label class="pymntVal">APPOINTMENT CANCEL</label><br/>';
           
            $message .= '<label class="pymntVal">'.$staffNAme.' '.$stafflNAme.'</label><br/>';

            $message .= '<label class="pymntVal">'.$ReasonNmae1.'</label><br/>';

         
            $message .= '<label class="pymntLabel">EMAIL: </label>';
            $message .= '<label class="pymntVal">'.$email.'</label><br/>';
            $message .= '<br/><br/>';
            $message .= '<div class="row" align="center">';
            $message .= '</div>';
            $message .= '</div>';
            $message .= '</div>';
            $message .= "</body></html>";
                      
            $mail->Body = $message;

          

            $mail->send();
            
                $data = array(
            'status'=>'true',    
        );
        echo json_encode($data);
          
        } catch (Exception $e) {
          $enc2 = encrypt($random,"");
          header("location: index.php?error=$enc2");
        }






     $query= mysqli_query($con,$sql);
         $lastId = mysqli_insert_id($con);


      






}

?>
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




if(isset($_POST['ReasonNmaeCancel']))
{
  $Email = $_POST['emailuser'];
  $appointID = $_POST['appointID'];
  $ReasonNmaeCancel = $_POST['ReasonNmaeCancel'];

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
            $message .= '<label class="pymntVal">'.$ReasonNmaeCancel.'</label><br/>';

         
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

             $sql = "UPDATE `appointment_tbl` SET `appointment_payment_status`='cancel' WHERE  appointment_payment_id ='$appointID'";

         $query= mysqli_query($con,$sql);
         $lastId = mysqli_insert_id($con);

$update1 = "UPDATE `staff_schedule_tbl` SET `staff_schedule_status`='cancel'  WHERE  appointment_idfk = '$appointID'";

        $queryupdate1= mysqli_query($con,$update1);
                         $CheckServId1 = "SELECT * FROM `appointment_tbl` WHERE appointment_payment_id = '$appointID'";
                      $reCheckServId1 = mysqli_query($con, $CheckServId1);
                      $rowreCheckServId1 = mysqli_fetch_assoc($reCheckServId1);
                      $eventid = $rowreCheckServId1['appointment_date'];

          $CheckServId = "SELECT * FROM `schedule_tbl` WHERE schedule_id = '$eventid'";
                      $reCheckServId = mysqli_query($con, $CheckServId);
                      $rowreCheckServId = mysqli_fetch_assoc($reCheckServId);
                      $countSched = $rowreCheckServId['scheduledate_count'];

                      $schedCount = $countSched - 1;

                       $sql22 = "UPDATE `schedule_tbl` SET `scheduledate_count`='$schedCount' WHERE  schedule_id ='$eventid'";

                      $query22= mysqli_query($con,$sql22);

            
                $data = array(
            'status'=>'true',    
        );
        echo json_encode($data);
          
        } 
        catch (Exception $e) {
          $enc2 = encrypt($random,"");
          header("location: index.php?error=$enc2");
        }


}
else
{ 
 $occupied = 3;
 $occupieds = 3;

  //
$StaffId = $_POST['StaffId'];
$schedIdd = $_POST['schedIdd'];
$appointID = $_POST['appointID'];
$startTimeSched = $_POST['startTimeSched'];
$ReasonNmae = $_POST['ReasonNmae'];
$minutesToAdd = $_POST['SumConsume'];
$Email = $_POST['emailuser'];
$appDate = $_POST['appDate'];
$appDay = $_POST['appDay'];
$openTime = strtotime('8:00am');
$closeTime = strtotime('5:00pm');



$notAvailableTimeSlots = array();
$query2 = "select * from staff_schedule_tbl where schedule_date_idfk = '$schedIdd' AND (staff_idfk = '$StaffId' AND staff_schedule_status = 'assign')";
$result2 = mysqli_query($con, $query2);
if(mysqli_num_rows($result2) > 0)
{
  while ($RowschedData = mysqli_fetch_assoc($result2)) 
  {
    $startTime = strtotime($RowschedData['staff_schedule_time']);
    $endTime = strtotime($RowschedData['staff_schedule_endtime']);

    $formattedStartTime = date("H:i", $startTime);
    $formattedEndTime = date("H:i", $endTime);

    $notAvailableTimeSlots[] = $formattedStartTime . ' - ' . $formattedEndTime;
  }

  // Output the not available time slots
  foreach ($notAvailableTimeSlots as $timeSlot) 
  {

  $timeSlotParts = explode(' - ', $timeSlot);
  $startTimeSlot = $timeSlotParts[0];
  $endTimeSlot = $timeSlotParts[1];



    if ($startTimeSched >= $startTimeSlot && $startTimeSched <= $endTimeSlot) 
    {
        

          $occupied = 1;
          $occ[] = $occupied;
    }
    else
    {
          $occupied = 2;
          $occ[] = $occupied;

    }

    



  }
sort($occ);
foreach ($occ as $timeSlots)
{
    if (strpos($timeSlots, '1') !== false) 
    {
        $data = array(
            'status'=>'occupied',    
        );
        echo json_encode($data);
        break; // Stop the loop when encountering the first number containing the digit 1
    }
    else
    {
       $startTimeSeconds = strtotime($startTimeSched);

      // Add the minutes in seconds to the start time
      $endTimeSeconds = $startTimeSeconds + ($minutesToAdd * 60);

      // Convert the end time back to the time format
      $endTime = date("H:i", $endTimeSeconds);


        foreach ($notAvailableTimeSlots as $timeSlotd) 
        {

        $timeSlotParts = explode(' - ', $timeSlotd);
        $startTimeSlot = $timeSlotParts[0];
        $endTimeSlot = $timeSlotParts[1];
      
          if ($endTime >= $startTimeSlot && $endTime <= $endTimeSlot) 
          {  

                $occupieds = 1;
                $occs[] = $occupieds;

          }
          else if($endTime > $closeTime)
          {
              $occupieds = 1;
                $occs[] = $occupieds;
          }
          else
          {
            $occupieds = 2;
            $occs[] = $occupieds;

          }

          



        }
        sort($occs);
        foreach ($occs as $timeSlotf)
        {
          if (strpos($timeSlotf, '1') !== false) 
            {
                $data = array(
                    'status'=>'occupied',    
                );
                echo json_encode($data);
                break; // Stop the loop when encountering the first number containing the digit 1
            }

            else
            {
              // start else
       
      $startTimeSeconds = strtotime($startTimeSched);

      // Add the minutes in seconds to the start time
      $endTimeSeconds = $startTimeSeconds + ($minutesToAdd * 60);

      // Convert the end time back to the time format
      $endTime = date("H:i:s", $endTimeSeconds);

     


           $update = "UPDATE `appointment_tbl` SET `appointment_payment_status`='approved',
     `appointment_coment` = '$ReasonNmae'  WHERE  appointment_payment_id = '$appointID'";

        $queryupdate= mysqli_query($con,$update);


        $update1 = "UPDATE `staff_schedule_tbl` SET `staff_schedule_status`='assigned'  WHERE  appointment_idfk = '$appointID'";

        $queryupdate1= mysqli_query($con,$update1);
      if($queryupdate1 == true)
      {
          $query2 = "select * from staff_tbl where staff_id = '$StaffId'";
          $result2 = mysqli_query($con, $query2);
          $user_data = mysqli_fetch_assoc($result2);

          $staffNAme = $user_data['staff_fname'];
          $stafflNAme = $user_data['staff_lname'];



         

               ////Create an instance; passing `true` enables exceptions
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
                  $mail->Subject = 'APPOINTMENT APPROVED';
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
                  $message .= '<label class="pymntVal">APPOINTMENT APPROVED</label><br/>';
                  $message .= '<label class="pymntLabel">WHEN:</label>';
                  $message .= '<label class="pymntVal">'.$appDate.' '.$appDay.'</label><br/>';
                  $message .= '<label class="pymntLabel">WHERE:</label>';
                  $message .= '<label class="pymntVal">Camangyan Road, Brgy. Sta Rosa II, Marilao Bulacan</label><br/>';
                   $message .= '<label class="pymntLabel">TIME:</label>';
                  $message .= '<label class="pymntVal">'.$startTimeSched.'</label><br/>';
                  $message .= '<label class="pymntLabel">Look For:</label>';
                  $message .= '<label class="pymntVal">'.$staffNAme.' '.$stafflNAme.'</label><br/>';

                  $message .= '<label class="pymntVal">'.$ReasonNmae.'</label><br/>';

               
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

          
      }
      else
      {
          $data = array(
                  'status'=>'false',    
              );
              echo json_encode($data);

      }
       break; // Stop the loop when encountering the first number containing the digit 1
              
            }

        }

break;
  
}
  break;

}


}


else
{

    //start else 1

  // start else
       
      $startTimeSeconds = strtotime($startTimeSched);

      // Add the minutes in seconds to the start time
      $endTimeSeconds = $startTimeSeconds + ($minutesToAdd * 60);

      // Convert the end time back to the time format
      $endTime = date("H:i:s", $endTimeSeconds);
    $update = "UPDATE `appointment_tbl` SET `appointment_payment_status`='approved',
     `appointment_coment` = '$ReasonNmae'  WHERE  appointment_payment_id = '$appointID'";

               $queryupdate= mysqli_query($con,$update);

               $update1 = "UPDATE `staff_schedule_tbl` SET `staff_schedule_status`='assigned'  WHERE  appointment_idfk = '$appointID'";

        $queryupdate1= mysqli_query($con,$update1);
      if($queryupdate1 == true)
      {
          $query2 = "select * from staff_tbl where staff_id = '$StaffId'";
          $result2 = mysqli_query($con, $query2);
          $user_data = mysqli_fetch_assoc($result2);

          $staffNAme = $user_data['staff_fname'];
          $stafflNAme = $user_data['staff_lname'];



           

               ////Create an instance; passing `true` enables exceptions
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
                  $mail->Subject = 'APPOINTMENT APPROVED';
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
                  $message .= '<label class="pymntVal">APPOINTMENT APPROVED</label><br/>';
                  $message .= '<label class="pymntLabel">WHEN:</label>';
                  $message .= '<label class="pymntVal">'.$appDate.' '.$appDay.'</label><br/>';
                  $message .= '<label class="pymntLabel">WHERE:</label>';
                  $message .= '<label class="pymntVal">Camangyan Road, Brgy. Sta Rosa II, Marilao Bulacan</label><br/>';
                   $message .= '<label class="pymntLabel">TIME:</label>';
                  $message .= '<label class="pymntVal">'.$startTimeSched.'</label><br/>';
                  $message .= '<label class="pymntLabel">Look For:</label>';
                  $message .= '<label class="pymntVal">'.$staffNAme.' '.$stafflNAme.'</label><br/>';

                  $message .= '<label class="pymntVal">'.$ReasonNmae.'</label><br/>';

               
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

          
      }
      else
      {
          $data = array(
                  'status'=>'false',    
              );
              echo json_encode($data);

      }
 


    // start else 2



}

}
?>


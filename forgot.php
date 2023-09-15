
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Your Password In Php</title>
    <link rel="stylesheet" href="css/forgot.css">
</head>

<body>
    <div id="container">
        <h2>Email Check</h2>
        <p>It's quick and easy.</p>
        <div id="line"></div>
        <form action="#" method="POST" autocomplete="off">
        

            <input type="email" name="email" placeholder="Email"><br>
            <input type="submit" name="forgot_password" value="Check">
        </form>
    </div>
</body>

</html>

<?php
include("connect.php");
include("functions.php");
include("assets/libs/enc-dec/enc-dec.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require('assets/libs/email/PHPMailer/Exception.php');
require('assets/libs/email/PHPMailer/SMTP.php');
require('assets/libs/email/PHPMailer/PHPMailer.php');

$mail = new PHPMailer(true);
$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    // Rest of your code for handling the email
    $verification = (rand(000000,999999));
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
        $mail->setFrom('barkspace2020@gmail.com', 'Verification');
        $mail->addAddress($email);
        //Content
        $mail->isHTML(true);
        $mail->Subject = 'OTP CODE';
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
        $message .= '<label class="pymntLabel">Verification code: </label>';
        $message .= '<label class="pymntVal">Click <a href="localhost/barkspace2/newPassword.php?token=$token">here</a> 
        to reset your password.</label><br/>';
     
        $message .= '<label class="pymntLabel">EMAIL: </label>';
        $message .= '<label class="pymntVal">'.$email.'</label><br/>';
        $message .= '<br/><br/>';
        $message .= '<div class="row" align="center">';
        $message .= '</div>';
        $message .= '</div>';
        $message .= '</div>';
        $message .= "</body></html>";
                  
        $mail->Body = $message;

      try{

      

        $mail->send();
      }catch (Exception $e){
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
      }
      echo "Message sent, please check your inbox.";
            $data = array(
        'status'=>'true',    
    );
    // echo json_encode($data);
    // header("location: otp.php");
    //  catch (Exception $e) {
    //   $enc2 = encrypt($random,"");
    // //   header("location: index.php?error=$enc2");
    // }

} else {
    // Handle the case where 'email' index is not set

}
        
     



?>
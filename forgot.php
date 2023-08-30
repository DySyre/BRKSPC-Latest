<?php 
include_once ("controller.php");
include("connect.php");
include("functions.php");
include("assets/libs/enc-dec/enc-dec.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require('assets/libs/email/PHPMailer/Exception.php');
require('assets/libs/email/PHPMailer/SMTP.php');
require('assets/libs/email/PHPMailer/PHPMailer.php');
// require ('assets/libs/email/PHPMailer/PHPMailerAutoload.php');

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "login_db";

$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

$errors = [];

//count errors
if (count($errors) === 0) {
    $insertQuery = "INSERT INTO users_balagtas (user_id,email,user_name,last_name,password,user_branch) 
    VALUES ('$user_id','$email','$user_name','$last_name','$password','$branch')";
    $insertInfo = mysqli_query($con, $insertQuery);

 // generate a random Code
 $code = rand(999999, 111111);
 // set Status
 $status = "Not Verified";


//  $mail = new PHPMailer(true);
//  $email = $Email;
//          try {
//              //Server settings
//              // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
//              $mail->isSMTP();
//              $mail->Host       = 'smtp.gmail.com';
//              $mail->SMTPAuth   = true;
//              $mail->Username   = 'barkspace2020@gmail.com';
//              $mail->Password   = 'gwarcvkvajmhrdwx';
//              $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
//              $mail->Port       = 465;
 
//  // Set email content
//  $mail->setFrom('your-email@example.com', 'Your Name');
//  $mail->addAddress($email);
//  $mail->Subject = $subject;
//  $mail->Body = $message;
//  $mail->AltBody = 'Plain text message';
 
//  // Send email
//  if ($mail->send()) {
//      $message = "We've sent a verification code to your Email <br> $email";
//      $_SESSION['message'] = $message;
//      header('location: verifyEmail.php');
//  } else {
//      $errors['email_error'] = 'Email could not be sent.';
//  }
 

         
//              //Recipients
//              $mail->setFrom('barkspace2020@gmail.com', 'Verification');
//              $mail->addAddress($email);
//              //Content
//              $mail->isHTML(true);
//              $mail->Subject = 'OTP CODE';
//              $message = '<html>
//              <head>
//                <style>
//                  .pymntRow{
//                    border-radius: 10px;
//                    border: 1px solid lightgray;
//                    padding-top: 20px;
//                    padding-left: 10px;
//                    padding-right: 10px;
//                    padding-bottom: 20px;
//                  }.pymntLabel{
//                    color:gray;
//                    font-size: 12px;
//                    text-align: center;
//                    font-weight: bold;
//                    padding-top: 3px;
//                    padding-bottom: 3px;
//                    padding-left:10px;
//                  }
//                  .pymntVal{
//                    color:black;
//                    font-size: 14px;
//                    text-align: left;
//                    font-weight: bold;
//                    padding-top: 3px;
//                    padding-bottom: 3px;
//                  }
//                  .pymntSchedRow{
//                    border-top: 1px solid lightgray;
//                    padding-top: 10px;
//                  }
//                  .pymntLabelFee{
//                    color:gray;
//                    font-size: 20px;
//                    text-align: center;
//                    font-weight: bold;
//                  }
//                  .pymntValFee{
//                    color:black;
//                    font-size: 20px;
//                    text-align: left;
//                    font-weight: bold;
//                  }
//                  .pymntImg{
//                    width: 100px;
//                    height: 100px;
//                  }
//                </style>
//              </head>
//              <body>';
//              $message .= '<div class="row pymntRow">';
//              $message .= '<label class="pymntLabel">Verification code: </label>';
//              $message .= '<label class="pymntVal">'.$verification.'</label><br/>';
          
//              $message .= '<label class="pymntLabel">EMAIL: </label>';
//              $message .= '<label class="pymntVal">'.$email.'</label><br/>';
//              $message .= '<br/><br/>';
//              $message .= '<div class="row" align="center">';
//              $message .= '</div>';
//              $message .= '</div>';
//              $message .= '</div>';
//              $message .= "</body></html>";
                       
//              $mail->Body = $message;
 
           
 
//              $mail->send();
             
//                  $data = array(
//              'status'=>'true',    
//          );
//          echo json_encode($data);
           
//          } catch (Exception $e) {
//            $enc2 = encrypt($random,"");
//            header("location: index.php?error=$enc2");
//          }
 
      
 
//      }

    // Send Varification Code In Gmail
    if ($insertInfo) {
        // Configure Your Server To Send Mail From Local Host Link In Video Description (How To Config LocalHost Server)
        $subject = 'Email Verification Code';
        $message = "our verification code is $code";
        $sender = 'From: barkspace2020@gmail.com';

        if (mail($email, $subject, $message, $sender)) {
            $message = "We've sent a verification code to your Email <br> $email";

            $_SESSION['message'] = $message;
            header('location: otp.php');
        } else {
            $errors['otp_errors'] = 'Failed while sending code!';
        }
    } else {
        $errors['db_errors'] = "Failed while inserting data into database!";
    }
}



// if forgot button will clicked
if (isset($_POST['forgot_password'])) {
    $email = $_POST['email'];
    $_SESSION['email'] = $email;

    $emailCheckQuery = "SELECT * FROM users_balagtas WHERE email = '$email'";
    $emailCheckResult = mysqli_query($con, $emailCheckQuery);

    // if query run
    if ($emailCheckResult) {
        // if email matched
        if (mysqli_num_rows($emailCheckResult) > 0) {
            $code = rand(999999, 111111);
            $updateQuery = "UPDATE users_balagtas SET code = $code WHERE email = '$email'";
            $updateResult = mysqli_query($con, $updateQuery);
            if ($updateResult) {
                $subject = 'Email Verification Code';
                $message = "our verification code is $code";
                $sender = 'From: ma382793@gmail.com';

                if (mail($email, $subject, $message, $sender)) {
                    $message = "We've sent a verification code to your Email <br> $email";

                    $_SESSION['message'] = $message;
                    header('location: verifyEmail.php');
                } else {
                    $errors['otp_errors'] = 'Failed while sending code!';
                }
            } else {
                $errors['db_errors'] = "Failed while inserting data into database!";
            }
        }else{
            $errors['invalidEmail'] = "Invalid Email Address";
        }
    }else {
        $errors['db_error'] = "Failed while checking email from database!";
    }
}
if(isset($_POST['verifyEmail'])){
$_SESSION['message'] = "";
$OTPverify = mysqli_real_escape_string($con, $_POST['OTPverify']);
$verifyQuery = "SELECT * FROM users_balagtas WHERE code = $OTPverify";
$runVerifyQuery = mysqli_query($con, $verifyQuery);
if($runVerifyQuery){
    if(mysqli_num_rows($runVerifyQuery) > 0){
        $newQuery = "UPDATE users_balagtas SET code = 0";
        $run = mysqli_query($con,$newQuery);
        header("location: newPassword.php");
    }else{
        $errors['verification_error'] = "Invalid Verification Code";
    }
}else{
    $errors['db_error'] = "Failed while checking Verification Code from database!";
}
}

// change Password
if(isset($_POST['changePassword'])){
$password = md5($_POST['password']);
$confirmPassword = md5($_POST['confirmPassword']);

if (strlen($_POST['password']) < 8) {
    $errors['password_error'] = 'Use 8 or more characters with a mix of letters, numbers & symbols';
} else {
    // if password not matched so
    if ($_POST['password'] != $_POST['confirmPassword']) {
        $errors['password_error'] = 'Password not matched';
    } else {
        $email = $_SESSION['email'];
        $updatePassword = "UPDATE users_balagtas SET password = '$password' WHERE email = '$email'";
        $updatePass = mysqli_query($con, $updatePassword) or die("Query Failed");
        session_unset($email);
        session_destroy();
        header('location: login.php');
    }
}
}

?>
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
        <form action="forgot.php" method="POST" autocomplete="off">
            <?php
            if ($errors > 0) {
                foreach ($errors as $displayErrors) {
            ?>
                    <div id="alert"><?php echo $displayErrors; ?></div>
            <?php
                }
            }
            ?>
            <input type="email" name="email" placeholder="Email"><br>
            <input type="submit" name="forgot_password" value="Check">
        </form>
    </div>
</body>

</html>
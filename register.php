<?php
session_start();
include("connect.php");
include("functions.php");
include("assets/libs/enc-dec/enc-dec.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require('assets/libs/email/PHPMailer/Exception.php');
require('assets/libs/email/PHPMailer/SMTP.php');
require('assets/libs/email/PHPMailer/PHPMailer.php');


$Firstname = test_input($_POST['user_name']);
$Lastname = test_input($_POST['last_name']);
$Fname = preg_replace("/[^a-zA-Z0-9]+/", "", $Firstname);
$Lname = preg_replace("/[^a-zA-Z0-9]+/", "", $Lastname);
$Email = test_input($_POST['email']);
$Password = test_input($_POST['password']);
$confirmPassword = test_input($_POST['confirmPassword']);
$branch = test_input($_POST['branch']);

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// function name($str) {
//   $str= preg_replace("/[^a-zA-Z0-9]/",'', $str);
//   return $str;
// }
 
  

if($Password != $confirmPassword)
{
  $data = array(
            'status'=>'passnotmacth',
  );
  echo json_encode($data);

}
else
{

         
            // // SAVE TO DATABASE
            // $user_id = random_num(20);
            
            // $query2 = "insert into users_balagtas (email,user_id,last_name,user_name,password,user_branch) values ('$email','$user_id','$last_name','$user_name','$password','$branch')";
            
            // mysqli_query($con, $query2);

           
            // header("Location: login.php");
            // die;
         
    $sql2 = "SELECT * FROM `users_balagtas` WHERE `email` = '$Email';";
    $result2 = mysqli_query($con, $sql2);

    if (mysqli_num_rows($result2)==1)
    {
        $data = array(
            'status'=>'already',    
        );
        echo json_encode($data);
    }
    else
    {
       $_SESSION['Fname'] = $Fname;
        $_SESSION['Lname'] =$Lname;
        $_SESSION['Firstname'] = $Firstname;
        $_SESSION['Lastname'] =$Lastname;
        $_SESSION['Email'] =$Email;
        $_SESSION['Password'] =$Password;
        $_SESSION['confirmPassword'] =$confirmPassword;
         $_SESSION['branch'] =$branch;
        $verification = (rand(000000,999999));
        $_SESSION['verification'] = $verification;
//Create an instance; passing `true` enables exceptions
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
            $message .= '<label class="pymntVal">'.$verification.'</label><br/>';
         
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


}








?>
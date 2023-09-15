<?php
session_start();


include './connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require('assets/libs/email/PHPMailer/Exception.php');
require('assets/libs/email/PHPMailer/SMTP.php');
require('assets/libs/email/PHPMailer/PHPMailer.php');

function send_password_reset($get_name,$get_email,$staffpass)
{
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "stmp.gmail.com";
    $mail->Username = "'barkspace2020@gmail.com'";
    $mail->Password = "";

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    //RECEIPTIENTS
    $mail->setFrom('barkspace2020@gmail.com', 'Verification');
    $mail->addAddress("$get_email", "$get_name");     // Add a recipient
    
    $mail->isHTML(true);
    $mail->Subject = "Reset Password Notification";

    $email_template = "
    <h2>Hello</h2>
    <h3>You are receiving this email because we received a password reset request for your account.</h3>
    <br></br>
   
    ";
    
    $mail->Body = $email_template;
    $mail->send();
}

if(isset($_POST['password_reset_link']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $reset_token_hash = md5(rand());

    $check_email = "SELECT staff_email FROM staff_tbl WHERE staff_email='$email' LIMIT 1";
    $check_email_run = mysqli_query($con, $check_email);

    if(mysqli_num_rows($check_email_run) > 0)
    {
        $row = mysqli_fetch_array($check_email_run);
        $get_name = $row['reset_token_hash'];
        $get_email = $row['staff_email'];

        $update_reset_token_hash = "UPDATE staff_tbl SET staff_pass='$reset_token_hash' WHERE staff_email='$get_email' LIMIT 1 ";
        $update_reset_token_hash_run = mysqli_query($con, $update_reset_token_hash);

        if($update_reset_token_hash)
        {
            send_password_reset($get_name,$get_email,$reset_token_hash);
            $_SESSION['status'] = "We e-mailed you a password reset link";
            header("Location: password_reset.php");
            exit(0);
        }
        else
        {
            $_SESSION['status'] = "Something went wrong! #1";
        header("Location: password_reset.php");
        exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "No Email Found!";
        header("Location: password_reset.php");
        exit(0);

       
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification Form</title>
    <link rel="stylesheet" href="css/otp.css">
</head>
<body>
    <div id="container">
        <h2>Reset Password</h2>
        <p>It's quick and easy.</p>
        <div id="line"></div>
        <form action="#" method="POST" autocomplete="off">
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
            require('assets/libs/email/PHPMailer/PHPMailerAutoload.php');
            // if Verify Button Clicked
    if (isset($_POST['verify'])) {
        $_SESSION['message'] = "";
        $otp = mysqli_real_escape_string($con, $_POST['otp']);
        $otp_query = "SELECT * FROM users_balagtas WHERE email = $otp";
        $otp_result = mysqli_query($con, $otp_query);

        if (mysqli_num_rows($otp_result) > 0) {
            $fetch_data = mysqli_fetch_assoc($otp_result);
            $fetch_code = $fetch_data['email'];

            $update_status = "Active";
            $update_code = 0;

           

    //         if ($update_result) {
    //             header('location: login.php');
    //         } else {
    //             $errors['db_error'] = "Failed To Insering Data In Database!";
    //         }
    //     } else {
    //         $errors['otp_error'] = "You enter invalid verification code!";
    //     }
    // }

    session_start();
    if(isset($_POST["verify"])){
        $otp = $_SESSION['otp'];
        $email = $_SESSION['mail'];
        
        $otp_code = $_POST['otp_code'];

        if($otp != $otp_code){
            ?>
           <script>
               alert("Invalid OTP code");
           </script>
           <?php
        }else{
           echo '<script> window.location.href = "newPassword.php";</script>';
            ?>
             <script>
                 alert("Verifiy account done, you may reset your password");
                   window.location.replace("newPassword.php");
             </script>
             <?php
        }
    }
}
    }
            ?>      
            <input type="number" name="otp" placeholder="Verification Code" required><br>
            <input type="submit" name="verify" value="Verify">
        </form>
    </div>
</body>
</html>
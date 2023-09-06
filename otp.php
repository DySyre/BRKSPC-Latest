
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
            // if Verify Button Clicked
    // if (isset($_POST['verify'])) {
    //     $_SESSION['message'] = "";
    //     $otp = mysqli_real_escape_string($con, $_POST['otp']);
    //     $otp_query = "SELECT * FROM users_balagtas WHERE code = $otp";
    //     $otp_result = mysqli_query($con, $otp_query);

    //     if (mysqli_num_rows($otp_result) > 0) {
    //         $fetch_data = mysqli_fetch_assoc($otp_result);
    //         $fetch_code = $fetch_data['code'];

    //         $update_status = "Active";
    //         $update_code = 0;

    //         $update_query = "UPDATE users_balagtas SET status = '$update_status' , code = $update_code WHERE code = $fetch_code";
    //         $update_result = mysqli_query($con, $update_query);

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
                 alert("Verfiy account done, you may sign in now");
                   window.location.replace("newPassword.php");
             </script>
             <?php
        }

    }

            ?>      
            <input type="number" id="otp" name="otp_code" placeholder="Verification Code" required><br>
            <input type="submit" name="verify" value="Verify">
        </form>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <script src="java/validation.js"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript">


    
//     $(document).on('submit', '#verifyCode2', function(e) {
//     e.preventDefault();
//     var form = $('#verifyCode2')[0];
//     var formdata = new FormData(form);
//     $.ajax({
//     type: 'POST',
//     url:'verifyCode2.php',
//     data: formdata,
//     contentType: false,
//     processData: false,
//    success: function(data) {
//             var json = JSON.parse(data);
//             var status = json.status;
//             if (status == 'true') {
//             $('#verificationModal').modal('hide');
            
//                   window.location.href = "dashboard.php";

//             }
            
            
//             else if (status == 'veriWrong') { 
              
//              swal("Error", "Wrong Verification Code", "error");


//             }
            
            
//             else if (status == 'false') {
              
//              swal("Error", "Register error", "error");


//             }
            
//           }
    
//   });
//   });
//     </script>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</html>

<?php 
  

?>
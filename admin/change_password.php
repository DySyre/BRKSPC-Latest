<?php



include '../connect.php';
include 'include/header.php';



?>

<html>
    <head>
    <title>Change Password</title>
        <body>  
            <?php
                

                if(isset($_POST['Submit'])){

                    $email = $_POST['useremail'];
                    $opwd = $_POST['opwd'];
                    $npwd = $_POST['npwd'];
                    $cpwd = $_POST['cpwd'];


                    $query = mysqli_query($con, "SELECT staff_email,staff_pass from staff_tbl where staff_email = '$email' AND staff_pass = '$opwd' ");
                    $num = mysqli_fetch_array($query);

                    if($num>0){
                        $con = mysqli_query($con, "UPDATE staff_tbl set staff_pass = '$npwd' where staff_email = '$email' ");

                        $_SESSION['msg1'] = "Password Change Successfull";
                    }else{
                        $_SESSION['msg2'] = "Password does not match";
                    }
                        
                    
                }
            ?>

                <p style="color: red;"><?php echo $_SESSION['msg1'];?> <?php $_SESSION['msg1'] =""; ?></p>

                <form action="" name="chngpwd" method="post" onsubmit="return valid();">
                <div class="form-control mt-5 mb-2">
                    <h1 align="center">Change Password</h1>
                <table align="center">
                        <tr height="50">
                            <td>Email ID:</td>
                            <td><input class="form-control" type="text" name="useremail" id="useremail" placeholder="" required></td>
                        </tr>
                        <tr height="50">
                            <td>Old Password:</td>
                            <td><input class="form-control" type="password" name="opwd" id="opwd" required></td>
                        </tr>
                        <tr height="50">
                            <td>New Password:</td>
                            <td><input class="form-control" type="password" name="npwd" id="npwd" required>
                            
                            </td>
                            
                        </tr>
                        <tr height="50">
                            <td>Confirm Password:</td>
                            <td><input class="form-control" type="password" name="cpwd" id="cpwd" required></td>
                        </tr>
                        <tr height="50">
                            <td><a href="admin.php" id="bth" class="form-control" style="text-decoration: none;">Back to home</a></td>
                            <td><input class="form-control" id="btn" type="submit" name="Submit" value="Change Password" style="cursor: pointer;"></td>
                        </tr>
                    </table>
                    <style>
                        #btn:hover{
                            background-color: #008CBA;
                            color: white;
                            }
                        #bth:hover{
                            background-color: #f44336;
                            color: white;
                        }
                    </style>
                </div>
                
                </form>
               
        </body>
    </head>
</html>
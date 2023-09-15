<?php
session_start();
include_once 'connect.php';

      
        $Email = $_SESSION['Email'];
        $Password = $_SESSION['Password'];
        $confirmPassword = $_SESSION['confirmPassword'];

         
        
        $verification = $_SESSION['verification'];
        $veiCode = $_POST['vericode'];


        if(empty($Email))
        {
             echo '<script> window.location.href = "landing.html";</script>';
        }
        else
        {
            if($veiCode != $verification)
            {
                        $data = array(
                    'status'=>'veriWrong',    
                );
                echo json_encode($data);


            }
            else
            {
                 
                
                echo '<script> window.location.href = "newPassword.php";</script>';
             
            
              
          
              
            }
        }

       




?>
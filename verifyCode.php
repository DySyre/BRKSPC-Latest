<?php
session_start();
include_once 'connect.php';

       $Firstname = $_SESSION['Firstname'];

        $Lastname = $_SESSION['Lastname'];
 
        $Email = $_SESSION['Email'];
        $Password = $_SESSION['Password'];
        $confirmPassword = $_SESSION['confirmPassword'];

         $branch = $_SESSION['branch'];
        
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
                 
                 $user_id = (rand(0000000000,9999999999));
            
               $query2 = "insert into users_balagtas (user_id,email,user_name,last_name,password,user_branch) values ('$user_id','$Email','$Firstname','$Lastname','$Password','$branch')";
            
                mysqli_query($con, $query2);
          
              

                $Firstname = $_SESSION['Firstname'];

                $Lastname = $_SESSION['Lastname'];
                $branch = $_SESSION['branch'] ;
                $Email = $_SESSION['Email'];
                $Password = $_SESSION['Password'];
                $confirmPassword = $_SESSION['confirmPassword'];
                
                $verification = $_SESSION['verification'];
                $veiCode = $_POST['vericode'];
                
                
                unset($_SESSION['Firstname']);
                unset($_SESSION['Lastname']);
                unset($_SESSION['branch']);
                unset($_SESSION['Email']);
                unset($_SESSION['Password']);
                unset($_SESSION['confirmPassword']);
                unset($_SESSION['verification']);
                
                
                if($query2)
                {

                   $_SESSION['client_id'] = $user_id;
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
           

        }

       




?>
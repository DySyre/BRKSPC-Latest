<?php
session_start();

    include("connect.php");
    include("functions.php");


    
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        // SOMETHING WAS POSTED
        $email = $_POST['email'];
        $user_name = $_POST['user_name'];  
        $last_name = $_POST['last_name']; 
        $password = $_POST['password'];
        // $select = $_POST['selected'];
        // $marilao = $_POST['Marilao'];
        // $balagtas = $_POST['Balagtas'];
        $branch = $_POST['branch'];

    
        
            if($branch == 'Marilao')  
            {
                // SAVE TO DATABASE
            $user_id = random_num(20);
            $query = "insert into users_balagtas (email,user_id,last_name,user_name,password,user_branch) values ('$email','$user_id','$last_name','$user_name','$password','$branch')";       
            $msq=mysqli_query($con, $query);
            
            header("Location: login.php");
            die;
            }elseif($branch == 'Balagtas')
            {
            // SAVE TO DATABASE
            $user_id = random_num(20);
            
            $query2 = "insert into users_balagtas (email,user_id,last_name,user_name,password,user_branch) values ('$email','$user_id','$last_name','$user_name','$password','$branch')";
            
            mysqli_query($con, $query2);

           
            header("Location: login.php");
            die;
            }
        
        }
        
      
?>
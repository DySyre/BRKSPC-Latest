<?php
session_start();

    include("connect.php");
    include("functions.php");


    
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        // SOMETHING WAS POSTED
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        // $select = $_POST['selected'];
        // $marilao = $_POST['Marilao'];
        // $balagtas = $_POST['Balagtas'];
        $branch = $_POST['branch'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {
            if($branch == 'Marilao')
            {
                // SAVE TO DATABASE
            $user_id = random_num(20);
            $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";       
            $msq=mysqli_query($con, $query);
            
            header("Location: login.php");
            die;
            }elseif($branch == 'Balagtas')
            {
            // SAVE TO DATABASE
            $user_id = random_num(20);
            
            $query2 = "insert into users_balagtas (user_id,user_name,password) values ('$user_id','$user_name','$password')";
            
            mysqli_query($con, $query2);

           
            header("Location: login.php");
            die;
            }
        
        }
        else
        {
            echo "Please enter some valid information!";
        }
    }  
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Signup</title>
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/signup.css">
    </head>
    <body>
        
        <div id="logo">
            <form class="login" method="post">
            <div class="title">Signup</div>
  
            <input id="text" type="text" name="user_name" placeholder="Username" >
            <input id="text"type="password" name="password" placeholder="Password">

            <div class="dropdown">
                <!-- <div class="select">
                    <span class="selected" name="selected">Branch</span>
                    
                    <div class="caret"></div>
                </div>
                <ul class="menu">
                    <li value="Marilao">Marilao</li>
                    <li value="Balagtas">Balagtas</li>
                    
                </ul><br/> -->
                <select class="select" name="branch">
                        <option class="menu" value="">Branch</option>
                        <option value="Marilao">Marilao</option>
                        <option value="Balagtas">Balagtas</option>
                    </select>
            </div>
            <br/>
            <button id="button" type="submit">Submit</button>
            <a href="login.php">Click to Login</a><br><br>
            </form>
        </div>
        <script src="java/signup.js"></script>
    </body>
</html>
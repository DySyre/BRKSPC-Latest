<?php
session_start();

  include("connect.php");
  include("functions.php");


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    // SOMETHING WAS POSTED
    $user_name = $_POST['email'];
    $password = $_POST['password'];
    // $destination = $_POST['destination'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {
        // READ FROM DATABASE

        // $query = "select * from users where destination = '$destination' ";
    
        $query2 = "select * from users_balagtas where email = '$user_name' limit 1";
        $result2 = mysqli_query($con, $query2);


          if (mysqli_num_rows($result2)==1)
            {

              $user_data = mysqli_fetch_assoc($result2);
              
              if($user_data['password'] === md5($password))
              {
                $_SESSION['user_id'] = $user_data['user_id'];
                $_SESSION['client_id'] = $user_data['user_id'];
                header("Location: dashboard.php");
              }
              else
              {
                $text = "Wrong username and password!";
                echo $text;   

              }
            }
            else
            {
                 $query3= "select * from staff_tbl where staff_email = '$user_name' limit 1";
                 $result3 = mysqli_query($con, $query3);


           

                if (mysqli_num_rows($result3)==1)
                {
                  $user_data = mysqli_fetch_assoc($result3);
                    if($user_data['staff_pass'] === $password)
                    {
                        if($user_data['staff_type'] == '0')
                        {
                          //admin
                          $_SESSION['Enduser_id'] = $user_data['staff_id'];
                            header("Location: admin/admin.php");

                         

                          


                        }
                        else if ($user_data['staff_type'] == '1')
                        {
                          //doctor
                           
                            // balagtas
                             $_SESSION['Enduser_id'] = $user_data['staff_id'];
                            header("Location: branch/branch.php");

                          
                        
                        }
                        else
                        {
                          echo "NOT ADMIN!";
                        }




                     
                    }
                    else
                    {
                      $text = "Wrong username and password!";
                      echo $text;   

                    }

                }
                else{
                  echo "Please enter some valid information!";

                }



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
    <title>BarkspaceLogin Form</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/login.css">

  </head>
  <body>
    <style>
        body {
  background-color: #454f6b;
  font-family: "Asap", sans-serif;

  }
.logo{
    width: 100%;
    height: 100%;
    text-align: center;
    justify-content: center;
    align-items: center;
    /* background-size: contain; */
    /* background-repeat: no-repeat; */
}

.login .title{
  font-size: 35px;
  font-weight: 600;
  text-align: center;
  line-height: 100px;
  color: #fff;
  user-select: none;
  border-radius: 15px 15px 15px 15px;
  background: linear-gradient(-135deg, #2a2f3b, #586279);
  margin-bottom: 60px;
}

.login {
  

  overflow: hidden;
  background-color: white;
  padding: 40px 30px 30px 30px;
  border-radius: 10px;
  position: absolute;
  top: 50%;
  left: 50%;
  width: 400px;
  height: 450px;
  transform: translate(-50%, -50%);
  transition: transform 300ms, box-shadow 300ms;
  box-shadow: 5px 5px 10px 10px rgba(2, 128, 144, 0.2); 
  
}
.login::before,
.login::after {
  content: "";
  position: absolute;
  width: 600px;
  height: 600px;
  border-top-left-radius: 40%;
  border-top-right-radius: 45%;
  border-bottom-left-radius: 35%;
  border-bottom-right-radius: 40%;
  z-index: -1;
}
.login::before {
  left: 45%;
  bottom: -70%;
  background-color: rgba(69, 105, 144, 0.15);
  animation: wawes 6s infinite linear;
}
.login::after {
  left: 45%;
  bottom: -70%;
  background-color: rgba(2, 128, 144, 0.2);
  animation: wawes 7s infinite;
}
.login > input {
  font-family: "Asap", sans-serif;
  display: block;
  border-radius: 5px;
  font-size: 16px;
  background: white;
  width: 100%;
  border: 1;
  padding: 10px 10px;
  margin: 15px -10px;
}
.login > button {
  font-family: "Asap", sans-serif;
  cursor: pointer;
  color: #fff;
  font-size: 19px;
  text-transform: uppercase;
  align-items: center;
  width: 300px;
  height: 45px;
  border: 0;
  padding: 10px 0;
  margin-top: 10px;
  margin-left: 50px;
  border-radius: 5px;
  background-color: #586279;
  transition: background-color 300ms;
  
}
.login > button:hover {
  background-color: #2a2f3b;
}
/* .login a{
    font-family: "Asap", sans-serif;
    text-decoration: none;
    color: #fff;
    font-size: 1rem;
    padding: 10px 10px;
    margin-top: 10px;
    margin-left: 160px;
    text-transform: uppercase;
    width: 10px;
    border-radius: 10px;
    background-color: #586279;
    transition: background-color 300ms;
}
.login a:hover{
    background-color: #2a2f3b;
} */
.dropbtn {
  background-color: #586279;
  color: white;
  padding: 16px;
  font-size: 16px;
  width: 90px;
  margin-top: 2px;
  margin-right: 2px;
  text-transform: uppercase;
  border: none;
  cursor: pointer;
  border-radius: 5px;
}

.dropdown {
  position: relative;
  display: inline-block;
  border-radius: 10px;
}
.dropbtn:hover{
    background-color: #f24353;
}
.dropdown-content {
  display: none;
  position: absolute;
  border-radius: 10px;
  right: 0;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 10px 80px;
  justify-content: center;
  text-align: center;
  align-items: center;
  margin-left: 10px;
  text-decoration: none;
  display: grid;
}

.dropdown-content a:hover {background-color:#2a2f3b;}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #2a2f3b;
}
h4{
  text-align: center;
}

@keyframes wawes {
  from {
    transform: rotate(100%);
  }
  to {
    transform: rotate(360deg);
  }
}

    </style>
    <div class="logo">
    <img src="images/1.jpg" alt="" style="height: 100%; width: 100%; background: transparent;">
    </div>
  
    <form class="login" action="login.php" method="post">
     
    
      <div class="title"><span style="color: pink;">Bark</span><span style="color: skyblue;">Space</span></div>
      <style>
        .title{
          text-transform: uppercase;
        }
      </style>
      <input type="email" name="email" placeholder="Email" />
      <input id="password_validation" type="password" name="password" placeholder="Password" required />
      
      <a href="forgot.php" style="text-decoration:none" >Forgot Password?</a><br>
    
            
     
      <br/>
      <!-- <a href="signup.php">Click to Signup</a>
      <style>
        a, button{
          text-decoration:none !important ;
          font-size : medium!important;
          font-weight: bold!important;
          text-transform: uppercase;
          font-family:'Poppins', sans-serif;
          font-weight:bold;
          padding:.5em  4em;
          border-radius:7%;
          border:solid thin white;
          box-shadow:-8px -9px 10px rgba(255,255,255,.1),
          inset 8px 9px 10px rgba(0,0,0,.1) ,
        }
        a{
          top: 100px;
        }
      </style>
      <button type="submit">Login</button> -->
      
     <button type="submit" class="btn active" id="log">Login</button><br>
     <style>
              .btn{
                pointer-events: none;
              }
              .btn.active{
                pointer-events: auto;
              }
              
            </style>
      <h4>Don't have a account? <a href="signup.php" style="text-decoration:none">Click to Signup</a><br>
      <!-- <style>
        a, button{
          text-decoration:none !important ;
          font-size : small!important;
          font-weight: bold!important;
          text-transform: uppercase;
          font-family:'Poppins', sans-serif;
          font-weight:bold;
          /* padding:.5em  4em; */
          
        }
        a{
          top: 100px;
        }
      </style> -->
      
      <!-- <button class="dropbtn">Branch</button>
      <div class="dropdown-content" style="left:0;">
      <a href="#">Marilao</a>
      <a href="#">Balagtas</a>
      </div> -->
      </div> <br/><br/>
      <a href="landing.html" style="text-decoration:none">Back</a>
      
    </form>
  </body>
  <script src="java/validation.js"></script>
</html>

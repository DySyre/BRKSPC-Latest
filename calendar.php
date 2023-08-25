<?php

include 'connect.php'; 
if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $code=$_POST['code'];
    $schedule=$_POST['schedule'];
    $owner_name=$_POST['owner_name'];
    $contact=$_POST['contact'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $category_id=$_POST['category_id'];
    $breed=$_POST['breed'];
    $age=$_POST['age'];
    $service_ids=$_POST['service_ids'];
    $status=$_POST['status'];
    $date_created=$_POST['date_created'];
    $date_updated=$_POST['date_updated'];

    
  
  
    $sql="insert into `appointment_list`(id,code,schedule,owner_name,contact,email,address,category_ids,breed,age,service_ids,status,date_created,date_updated)
    values('$id','$code','$schedule','$owner_name','$contact','$email','$address','$category_id','$breed','$age','$service_ids','$status','$date_created','date_updated')";
    $result=mysqli_query($con,$sql);
  
    header("Location: calendar.php");
  }


if (isset($_GET['schedule'])) {
    $schedule = $_GET['schedule'];
    // Rest of your code that uses the $schedule variable
  } else {
    // Handle the case when the 'schedule' parameter is not set
    $schedule = ''; // Set a default value or handle the error accordingly
  }


function build_calendar($month, $year){

     $mysqli = new mysqli('localhost','root','','login_db');
     $stmt = $mysqli->prepare('select * from bookings where MONTH(date) = ? AND YEAR(date) = ?');
     $stmt->bind_param('ss', $month, $year);
     $bookings = array();
     if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['date'];
            }
            $stmt->close();
        }
     }



    $daysOfWeek = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
    $firstDayOfMonth = mktime(0,0,0,$month, 1,$year);
    $numberDays = date('t', $firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];
    $dateToday = date('Y-m-d');
    
    $prev_month = date('m',mktime(0,0,0,$month-1, 1,$year));
    $prev_year = date('Y',mktime(0,0,0,$month-1, 1,$year));
    $next_month = date('m',mktime(0,0,0,$month+1, 1,$year));
    $next_year = date('Y',mktime(0,0,0,$month+1, 1,$year));
    $calendar = "<center><h2>$monthName $year</h2>";
    $calendar.="<a class='btn btn-primary btn-xs' href='?month=".$prev_month."&year=".$prev_year."'>Prev Month</a>";
    $calendar.="<a class='btn btn-primary btn-xs' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a>";
    $calendar.="<a class='btn btn-primary btn-xs' href='?month=".$next_month."&year=".$next_year."'>Next Month</a></center>";
    $calendar.="<br><table class='table table-bordered'>";
    $calendar.="<tr>";
    foreach($daysOfWeek as $day){
        $calendar.= "<th class='header'>$day</th>";
    }
    
    $calendar.= "</tr><tr>";
    $currentDay = 1;
    if($dayOfWeek > 0) {
        for($k = 0; $k < $dayOfWeek; $k++){
            $calendar.= "<td class='empty'></td>";
        }
    }
    
    $month = str_pad($month, 2,"0", STR_PAD_LEFT);
    while($currentDay <= $numberDays){
        if($dayOfWeek == 7){
            $dayOfWeek = 0;
            $calendar.= "</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 2,"0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";
        $dayName = strtolower(date('|', strtotime($date)));
        $today = $date==date('Y-m-d') ? 'today' : '';
        if(in_array($date, $bookings)){
           $calendar.="<td class='$today'><h3>$currentDay</h3> <a class='btn btn-danger btn-xs'>Booked</a></td>";
        }else{
            $calendar.="<td class='$today'><h3>$currentDay</h3>
            <button type='button' class='btn btn-success' type='submit'>
                Set
            </button>";
        }
        
        


        $currentDay++;
        $dayOfWeek++;

    }

    // if($date<date('Y-m-d')){
    //     $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>N/A</button>";
    // }

    if($dayOfWeek<7) {
        $remainingDays = 7 - $dayOfWeek;
        for($i =0; $i < $remainingDays; $i++){
            $calendar.="<td class='empty'></td>";
        }
    }

    $calendar.="</tr></table>";

    
    return $calendar;
}


?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
            body{
                background-color: #454f6b;
                color: #fff;
            }
            .container .row .col-md-12{
                color: #fff;
            }
            @media only screen and (max-width: 760px),
            (min-device-width: 802px) and (max-device-width: 1020px) {
                /* Force table to not be like tables aanymore */
                table,
                thead,
                tbody,
                th,
                td,
                tr{
                    display: block;
                    
                }
                .empty{
                    display: none;
                }
                /* Hide table headers (but not display: none:, for accessibility) */
                th{
                    position: absolute;
                    top: -9999px;
                    left: -9999px;
                }
                tr{
                    border: 1px solid #ccc;
                }
                td{
                    /* Behave like a "row" */
                    border: none;
                    border-bottom: 1px solid #eee;
                    position: relative;
                    padding-left: 50%;
                }
                /* Label the daata */
                td:nth-of-type(1):before{
                    content: "Sunday";
                }
                td:nth-of-type(2):before{
                    content: "Monday";
                }
                td:nth-of-type(3):before{
                    content: "Tuesday";
                }
                td:nth-of-type(4):before{
                    content: "Wednesday";
                }
                td:nth-of-type(5):before{
                    content: "Thursday";
                }
                td:nth-of-type(6):before{
                    content: "Friday";
                }
                td:nth-of-type(7):before{
                    content: "Saturday";
                }
            }

            /* Smartphones (portrait and landscape) ------------ */
            @media only screen and (min-device-width: 320px) and (max-device-width: 480px){
                body{
                    padding: 0;
                    margin: 0;
                }
            }
            /* iPaads -------------- */
            @media only screen and (min-device-width: 802px) and (max-device-width: 1020px){
                body{
                    width: 600px;
                }
            }
            @media (min-width:641px){
                table {
                    table-layout: fixed;
                }
                td{
                    width: 33%;
                }
            }
            .row{
                margin-top: 20px;
            }
            .today {
                background: green;
            }
            .today td{
                color: #fff;
            }
                    
        </style>

</head>
    <body>
            
        
    <header class="sticky">
        <div class="nav-bar">
          <a href="" class="logo"
          ><span class="red" style="color: pink">Bark</span
          ><span class="red" style="color: skyblue">space</span></a>
          <div class="navigation">
            <div class="nav-items">
              <i class="uil uil-times nav-close-btn"></i>
              <a href="landing.html"><i class="uil uil-home"></i>Home</a>
              <a href="treatment.html"
                ><i class="uil uil-airplay"></i>Treatment</a
              >
              <a href="services.html"><i class="uil uil-plus-square"></i>Services</a>
              <a href="calendar.php"><i class="uil uil-book-open"></i>Appointment</a>
            </div>
          </div>
          <a href="login.php">LOGIN</a>
          <i class="uil uil-apps nav-menu-btn"></i>
        </div>
      </header>
      
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                       
                        <?php

                            $dateComponents = getdate();
                            if(isset($_GET['month']) && isset($_GET['year'])){
                                $month = $_GET['month'];
                                $year = $_GET['year'];
                            }else{
                                $month = $dateComponents['mon'];
                                $year = $dateComponents['year'];
                            }
                            
                            echo build_calendar($month, $year);                          
                        ?>
                        
                            
                        
                    </div>
                    
                </div>
                
                <a href="landing.html" style=" position: relative; text-align: center; align-items: center; justify-content: center; font-family: 'Asap', sans-serif; text-decoration: none; padding: 10px 10px; margin-top: 10px; margin-left:160px; text-transform: capitalize; width:10px; border-radius:10px; background-color: #f0747eb9; transition: background-color 300ms; color: #fff;">Back</a><br><br>
            </div>
                        

    </body>
</html>
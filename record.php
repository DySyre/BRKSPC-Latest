<?php
session_start();

  include("connect.php");
  include("functions.php");

  if(empty($_SESSION['client_id']))
  {
    header("Location: empty.php");
  }
  else
  {
   $clientId =  $_SESSION['client_id'];
    $query2 = "select * from users_balagtas where user_id = '$clientId' limit 1";
    $result2 = mysqli_query($con, $query2);

       $user_data = mysqli_fetch_assoc($result2);

       $fname = $user_data['user_name'];
       $user_id = $user_data['id'];
    ?>
    <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <script src="https://kit.fontawesome.com/6b23de7647.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
    <link rel="icon" href="images/logo.png" type="image/icon type" />
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
    />
    <link rel="stylesheet" href="style.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <title>Barkspace</title>
  </head>
  <body>
    <header class="sticky">
      <div id="preloader">
      <div class="container">
        <div class="loader">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
    </div>
      <div class="nav-bar">
        <a href="dashboard.php" class="logo"
          ><span class="red" style="color: pink">Bark</span
          ><span class="red" style="color: skyblue">space</span></a
        >
        <div class="navigation">
          <div class="nav-items">
            <i class="uil uil-times nav-close-btn"></i>
            <a href="dashboard.php" class="active"><i class="uil uil-home"></i>Home</a>
            <!-- <a href="treatment.html"
              ><i class="uil uil-airplay"></i>Treatment</a
            >
            <a href="services.html"
              ><i class="uil uil-plus-square"></i>Services</a
            > -->
           <!--  <a href="add_appointment.php"
              ><i class="uil uil-book-open"></i>Appointment</a
            > -->
            
          </div>
        </div>
     
        <a href="record.php"> <?php echo $fname?> </a>
        <a href=""> Record </a>
           <a href="logout.php"> LOGOUT </a>
           <li class="dropdown">
                            <div  class="dropdown-toggle text-light" id="noti_count" style="cursor: pointer;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="counter">0</span><i class="fas fa-bell" style="font-size: 20px;"></i>
                            </div>
                            
                            <div class="dropdown-menu overflow-h-menu dropdown-menu-right">
                                <div class="notification">

                                </div>
                            </div>
                        </li>


                        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script type="text/javascript">

    $(document).ready(function (){

        $('.notification').load('Ajax/Notification.php');
        $('.counter').text('0').hide();

        var counter = 0;

        $('#form-submit').on('submit', function(event){
            event.preventDefault();
            
            var subject = $('#subject').val().trim();
            var comment = $('#comment').val().trim();

            $('#sub-error').text('');
            $('#com-error').text('');

            if(subject != '' && comment != ''){
                
                $.ajax({
                    type: "POST",
                    url: "Ajax/Ins_notification.php",
                    data: { 'subject' : subject, 'comment' : comment },
                    success: function (response) {
                        var status = JSON.parse(response);
                        if(status.status == 101){
                            counter++;
                            $('.counter').text(counter).show();
                            $('.notification').load('Ajax/Notification.php');
                            $("#form-submit").trigger("reset");
                            console.log(status.msg);
                        }
                        else{
                           console.log(status.msg);
                        }
                    }
                });

            }
            else{
            
                if(subject == ''){
                    $('#sub-error').text("Please Enter Subject");
                }
                if(comment == ''){
                    $('#com-error').text("Please Enter Comment");
                }
            }

        });

        $('#noti_count').on('click',function (){
            counter = 0;
            $('.counter').text('0').hide();
        });

    });


</script>
                        
                        
        <!-- <button href="login.php" class="read-btn">
          LOGIN <i class="uil uil-arrow-right"></i>
        </button> -->
        <i class="uil uil-apps nav-menu-btn"></i>
      </div>
    </header>
    <section class="home" >

      <div class="swiper bg-slider">
        <div class="swiper-wrapper">
          <div class="swiper-slide dark-layer" >
            <div class="row mt-5" >
        
            <!-- <div class="imgDog" > -->
                 <div class="row mt-5 ms-2" style="color: white; font-size: bold;">
        <!-- <style type="text/css">
          
          th{
            width: 20%;
            
          }

          .itemss{
            position: absolute;
            top: 35%;
            left: 50%;
            transform: translate(-50%, -50%);
          }
        </style> -->

        <style>
          .home{
            width: 100%;
            height: auto;
            background: #202834;
            @media (max-width:450px) and(min-width:320px){
              
              }
              /* Small devices (landscape phones, 576px and up) */
              @media only screen and (min-device-width : 320px) and (max-device-width : 480)
              {
                body{
                  background:#fff!important;}
                  #abtimg img{
                    height:19.5vh}
                    }
                    /* Extra large devices (large laptops and desktops, 1200px and up) */
                    @media only screen and (min-width: 1200px )
                    {
                      }

          }
          table {
            background: #fff;
            border: solid thin #000;
            padding: 100%;
            font-size: 1rem;
            text-transform: capitalize;
            border-collapse: collapse;
            margin: auto;
            text-align: center;
            box-shadow:  0px 0px 20px white,
            inset 0px 0px 5px rgba(0, 0, 0, 0.1);
            }

        </style>



     <center><h4>My Appointment's Record</h4></center> 
     <style>
      td ,th{
        height :6vh ;
        color:#000 !important;
        border:solid thin black;
        vertical-align: middle!important;
        line-height: normal;
        }
        td{
          width:8vw;
          font-weight: initial;
          font-size: 19px;
        }
        th{
          width:7vw;
    
        }
     </style>
         <div class="table-responsive itemss" >
                     <table id="mytabledataAppointment" class="table table table-striped" >
                      <thead>
                       
                        <th>Appointment Date</th>
                        <th>Status</th>  
            
                        <th>Date Applied</th>  
                        <th>Action</th>   
                        
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                </div>
               
      </div>
            </div>
      
          </div>

      
        </div>
      </div>
           
      <!--ABOUT SECTION-->

      <div class="about mt-5" >
        <style>
          .about h3 {
            text-transform: uppercase;
            margin-bottom: -2rem;
            }
            @media (max-width:450px) and(min-width:320px){
              #abtimg img{
                height:6vh !important ;
                }
              }
              /* Small devices (landscape phones, 576px and up) */
              @media only screen and (min-device-width : 320px) and (max-device-width : 480)
              {
                body{
                  background:#fff!important;}
                  #abtimg img{
                    height:19.5vh}
                    }
                    /* Extra large devices (large laptops and desktops, 1200px and up) */
                    @media only screen and (min-width: 1200px )
                    {
                      }

        </style>
        
        <div class="aboutText" data-aos="fade-up" data-aous-duration="1000">
          <h1>
            Our Patients are at the Center <br />
            <span style="color: #2f8be0; font-size: 2vw"
              >of everything We Do</span
            >
          </h1>
          <img src="images/pic.jpg" width="300" height="450" alt="" />
        </div>
        <div class="aboutList" data-aos="fade-left" data-aous-duration="1000">
          <ol>
            <li>
              <span><i class="uil uil-arrow-right"></i></span>
              <p>Pet Grooming</p>
            </li>
            <li>
              <span><i class="uil uil-arrow-right"></i></span>
              <p>Pet Supplies.</p>
            </li>
            <li>
              <span><i class="uil uil-arrow-right"></i></span>
              <p>Vaccination</p>
            </li>
            <li>
              <span><i class="uil uil-arrow-right"></i></span>
              <p>Veterinary Services</p>
            </li>
            <a href=""><button>Read More</button></a>
          </ol>
        </div>
      </div>
      <!--INFO SECTION-->
      <div class="infoSection">
        <div class="infoHeader" data-aos="fade-up" data-aous-duration="1000">
          <h1>
            We analyse Your Pet Health States <br />
            <span style="color: #e0501b">In Order to Top Services</span>
          </h1>
        </div>
        <div class="infoCards">
          <div class="card one" data-aos="fade-up" data-aous-duration="1000">
            <img
              src="images/protect.png"
              class="cardoneImg"
              alt=""
              data-aos="fade-up"
              data-aous-duration="1100"
            />
            <div class="cardbgone">
              <div class="cardContent">
                <h2>Health Services</h2>
                <p>
                  An so vulgar to on points wanted rapture our resolving
                  continued household.
                </p>
                <a href="services.html">
                  <div class="cardBtn">
                    <img src="images/right.png" alt="" class="cardIcon" />
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="card two" data-aos="fade-up" data-aous-duration="1300">
            <img
              src="images/protect.png"
              class="cardtwoImg"
              alt=""
              data-aos="fade-up"
              data-aous-duration="1300"
            />
            <div class="cardbgtwo">
              <div class="cardContent">
                <h2>Appointment</h2>
                <p>
                  An so vulgar to on points wanted rapture our resolving
                  continued household.
                </p>
                <a href="calendar.html">
                  <div class="cardBtn">
                    <img src="images/right.png" alt="" class="cardIcon" />
                  </div>
                </a>
              </div>
            </div>
          </div>

          <div class="card three" data-aos="fade-up" data-aous-duration="1600">
            <img
              src="images/protect.png"
              class="cardthreeImg"
              alt=""
              data-aos="fade-up"
              data-aous-duration="1300"
            />
            <div class="cardbgthree">
              <div class="cardContent">
                <h2>Treatments</h2>
                <p>
                  An so vulgar to on points wanted rapture our resolving
                  continued household.
                </p>
                <a href="treatment.html">
                  <div class="cardBtn">
                    <img src="images/right.png" alt="" class="cardIcon" />
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        
        <!-- <iframe width="560" height="315" src="" title="YouTube video player" frameborder="0" allow="accelorometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
      
    </section>
    <!-- modal -->

<div class="modal fade" id="memViewAppointmentModal" role="dialog">
                <div class="modal-dialog modal-xl">
                <style>
                    .modal-content{
                      background: #fff;
                      border-radius: 10px !important ;
                      box-shadow: none!important
                      ;;
                      }
                  </style>
                    <div class="modal-content">
                    <style>
                        .modal-header, h4 , .close { position:relative; text-align: center; justify-content: center;
                        align-items: center; text-transform: uppercase;}
                        /* #myModalLabel{
                          color:#fff !important ;
                          }
                          body{
                            background-color :#f9c851!important;} */

                      </style>
                        <div class="modal-header">
                            <h4 class="modal-title" style=" color: white; text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;">Details</h4>
                            <style>
                              /* The Modal (background) */
                              .modal {
                                display: none; /* Hidden by default */
                                position: fixed; /* Stay in place */
                                z-index: 999999999999999999999999;
                                left: 0;
                                top: 0;
                                width: 100%;
                                height: 100vh; /* Full height */
                                overflow: auto; /* Enable scroll if needed */
      
                                background-color:transparent;/* Fallback color */
                                padding-top: 3rem;
                                border-radius:.2em;
                                box-shadow: inset  0   0     rgba(0,0,0,.1),
                                0         0      rgba(0,0,0,.1);
                                transition: all ease-in-out
                                .3s;
                                margin-left:auto;
                                margin-right:auto;}

                            </style>
                        </div>
                        <div class="modal-body modalresponseViewAppointment">
                        <style>
                            .modalresponseViewAppointment{
                              padding: 0px;
                              margin: auto!important ;
                              width: 85% !important ;
                              height: auto !important;
                              border-radius: 7rem;
                              background: #fff;
                              box-shadow:.6em.9em rgba(0,0,0,.5);
                              display: flex;
                              align-items: center;
                              justify-content: space-between;
                              overflow: hidden;
                              position: relative;
                              z-index: -1;
                              transition: all ease.5s;
                              transform: scale(.9) translateY(10%);
                              opacity: 0;
                              visibility: hidden;
                              /* animation: slideInFromLeft.5s forwards;*/
                              color:#fff;
                              font-size: large;
                              text-align: left;
                              line-height: normal;
                              letter-spacing:-.4px;
                              word-spacing:normal;
                              font-weight: bold;
                              
                            }
                          </style>
                       
                        </div>
                    </div>
                </div>
        </div>

    <!-- modal -->

    <script>
      var loader = document.getElementById("preloader");
      window.addEventListener("load", function(){
        loader.style.display = "none";
      })
    </script>



    <script src="java/slider.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
    <script>
      AOS.init();
    </script>

    <script src="java/swiper-bundle.min.js"></script>
    <script src="java/main.js"></script>

    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css' rel='stylesheet' />
  <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/locale-all.min.js'></script>


     <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <script src="js/script.js"></script>
 <script>


 $(document).ready(function() {
      $('#mytabledataAppointment').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'myappointment_fetch.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [2]
          },

        ]
      });
    });

   $('#mytabledataAppointment').on('click', '.btnViewAppointment', function(event) {
      var table = $('#mytabledataAppointment').DataTable();
      var trid = $(this).closest('tr').attr('id');
      var id = $(this).data('id');
     

      $.ajax({
        url: "myappointment_editmem.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(response) {
            $('.modalresponseViewAppointment').html(response); 
            $('#memViewAppointmentModal').modal('show');
        }
      })
    });
    
  </script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  </body>
</html>
    <?php

  }

?>







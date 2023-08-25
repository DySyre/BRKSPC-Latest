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
    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
    <link rel="icon" href="images/logo.png" type="image/icon type" />
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
    />
    <link rel="stylesheet" href="style1.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6b23de7647.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/style.css">
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
        <style>
          .navbar{
            background: #fff;
            }
            @media (max-width: 769px) {
              header nav ul li a span i::before{
                display: none !important ;
                }
                }
                
                  
                 
                  
                       
                
        </style>
        <a href="" class="logo"
          ><span class="red" style="color: pink">Bark</span
          ><span class="red" style="color: skyblue">space</span></a
        >
        <div class="navigation">
          <div class="nav-items">
            <i class="uil uil-times nav-close-btn"></i>
            <a href="#" class="active"><i class="uil uil-home"></i>Home</a>
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
        <a href="record.php"> Record </a>
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
        <!-- <button href="login.php" class="read-btn">
          LOGIN <i class="uil uil-arrow-right"></i>
        </button> -->
        <i class="uil uil-apps nav-menu-btn"></i>
      </div>
    </header>
    <section class="home" style="background:#202834;">

      <div class="swiper bg-slider">
        <div class="swiper-wrapper">
          <div class="swiper-slide dark-layer" >
            
            <div class="row mt-2" style="background: #202834;">
            
                <div class="row mt-5" style="background: #202834;">
                
                  <div class="col-md-2 mt-5" style="background: ;">
                    
                   <div class="form-group">
                    
                   
             
                       <select class="form-control" name="branchId" id="idBranch" onchange="selectBranch()" >
                        <option hidden >Branches</option>
                        
                      <?php
                      $queryBranch = "select * from branch_tbl where branch_isactive = '1' and branch_id !='3'";
                        $resqueryBranch = mysqli_query($con, $queryBranch);

                        while($rowBranch = mysqli_fetch_assoc($resqueryBranch))
                        {
                           
                            ?>
                           
                                <option value="<?php echo $_SESSION['branch_idd'] = $rowBranch['branch_id'] ?>"><?php echo $rowBranch['branch_name'] ?></option>
                          
                            <?php

                        }
                      ?>
                      
                        </select>

                     
                      
                     
                  </div>
              </div>
            </div>
            </div>
            <h1>Welcome to <span class="red" style="color: pink">Bark</span>
            <span class="red" style="color: skyblue">space</span> Inc.</h1>
            <style>
              h1{
                padding: 30px;
                color : white;
                font-family:'Poppins', sans-serif !important;;
                align-items: center;
                justify-content: center;
                text-align: center;
                font-weight: bolder;
                text-transform: uppercase;
              }
            </style>
            <div class="imgDog" style="background: ;">
            
            
               <img src="images/h1.jpg" />
               <style>
                .imgDog{
                  width : auto;
                  /* left: 15%; */
                  height : auto%;
                  position: relative;
                  
                  box-shadow:  0px 0px 20px white,
            inset 0px 0px 5px rgba(0, 0, 0, 0.1);
                  }
                  .img{
                    position: absolute !important;;
                    top: -6px!important;
                    left:-79%!important;}
                    @media only screen and (max-width: 600px)
                    {.img{position: relative}}
                    
                  
               </style>
            </div>

                    

          


        <div class="row mt-5 cal">

                <div class="container col-9" style="background: #87CEEB; height: auto;">
                <!-- <style>
                  .cal{
                    background:transparent !important;}
                    @media screen and (max-width: 600px)
                    {
                      .cal{
                        width :auto!important}
                        }

                  

                </style> -->
               
                    <form class="contact-panel__form" method="post" action="" id="submit-button">
               
                
                    <div id='calendar'>
                      
                    </div>
                   
                 
                
          
              </form>
               
                
                  
                </div>
                
              </div>
           
          </div>


      
        </div>
   
       
      </div>
      
           
      <!--ABOUT SECTION-->

      <div class="about mt-5">

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
<div class="modal fade" id="eventModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
  <div class="modal-dialog modal-xl" role="document" >
    <div class="modal-content" style="background-color:white ;">
      <div class="modal-header">
        <h3 style="font-size:2 rem; color: #0DCAF0; font-weight:bold; font-style:italic;" class="modal-title" id="eventModalLabel">Make An Appointment For Your Pet's</h3>

        <hr>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modalresponseViewAppointment">
                       
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
 <script>


function itemSelected(){
      
      var x = document.getElementById("ebranchIdSelect").value;


      
   
        $.ajax({
                url:"app_show_services.php",
                method:"POST",
                data:{
                  id: x,
                  orderNumId: orderNumIdd
                },
                success: function(data){
                  $("#ShowOrder").html(data);

                }
              })

      }
  

var divToHide = document.querySelector(".cal");
    divToHide.style.display = "none";

function selectBranch() 
{
      var divToHide = document.querySelector(".cal");
    divToHide.style.display = "block";
    divToHide.style.textAlign = "center";

    var divToHide1 = document.querySelector(".imgDog");
    divToHide1.style.display = "none";

    var x = document.getElementById("idBranch").value;

     
        $.ajax({
                url:"get_events2.php",
                method:"POST",
                data:{
                  id: x
                },
                success: function(data){
                  $("#ans").html(data);

                }
              })

        var start = moment().startOf('month').format('YYYY-MM-DD');
  var end = moment().endOf('month').format('YYYY-MM-DD');
  var eventSource = 'get_events.php?start=' + start + '&end=' + end;
  var status; // Define status as a global variable
  // Initialize the FullCalendar
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    locale: 'en',
    defaultView: 'month',
    editable: false,
    eventLimit: true, // allow "more" link when too many events
    selectable: true, // allow clicking on dates
    events: eventSource, 
    eventRender: function(event, element) 
    {
  
        var today = moment().startOf('day');
var formattedDate = today.format('YYYY-MM-DD');
var formatdayStart = event.start.format('YYYY-MM-DD');

var daysDifference = moment(formatdayStart).diff(formattedDate, 'days');

      if (event.doc_time_status == '0') {
        element.css('background-color', '#D21312'); // set the background color of events
       
        element.css('color', '#ffffff'); // set the text color of events
        element.find('.fc-title').css('font-size', '14px'); // Change the font size of event titles
      } 
      else if(event.schedCount == '6')
      {
        element.css('background-color', '#D21312'); // set the background color of events
   
        element.css('color', '#ffffff'); // set the text color of events
        element.find('.fc-title').css('font-size', '14px'); 
        element.find('.fc-title').text('Fully Booked');
  


      }

       else if(formatdayStart <= formattedDate)
      {
        element.css('background-color', 'black'); // set the background color of events
         element.css('display', 'none');
        element.css('color', '#ffffff'); // set the text color of events
        element.find('.fc-title').css('font-size', '14px'); 
      }
     

      else if (daysDifference <= 1) {
        element.css('background-color', 'blue'); // set the background color to green
          element.css('display', 'none');
        element.css('color', '#ffffff'); // set the text color of events
        element.find('.fc-title').css('font-size', '14px');
      } 

      else {

        element.css('background-color', '#378006'); // set the background color of events
        element.css('color', '#ffffff'); // set the text color of events
        element.find('.fc-title').css('font-size', '14px'); // Change the font size of event titles
      }
    },
    eventClick: function(calEvent, jsEvent, view) {
      if (calEvent.doc_time_status == '0') 
      {
        alert("NO AVAILABLE APPOINTMENT");
      }
     else  if (calEvent.schedCount == '6') 
      {
        alert("Fully Booked");
      }

       else
        {

           // Set the event details in the modal
        // $('#eventDetails').html(
        //   'Doctor Name: ' + calEvent.title + '<br>' +
        //   'Start Time Available: : ' + moment(calEvent.startTime, 'HH:mm:ss').format('h:mm:ss a')
        // );
        // Set the value of the input field
        $('#event-id').val(calEvent.id);
        $('#event-startTime').val(calEvent.startTime);
        $('#event-start').val(calEvent.start);
        $('#event-doc_time_status').val(calEvent.doc_time_status);
        var today = moment().startOf('day');
        var formattedDate = today.format('YYYY-MM-DD');
        console.log(formattedDate);
              
        var formatdayStart = calEvent.start.format('YYYY-MM-DD');

        if(formatdayStart <= formattedDate) 
        {
            console.log(formatdayStart);
            alert("CANNOT APPOINT CURRENT DATE");

        } 

        else {
            // Show the modal

          $.ajax({
        type: "POST",
        url: "store_event_id_showPet.php", // The URL to the PHP script
        data: { event_id: calEvent.id }, // The data to be sent to the PHP script
        success: function(response) {
            // Check the response from the PHP script if needed
            
                // Show the modal
           $('.modalresponseViewAppointment').html(response); 
        
                $('#eventModal').modal('show');
            
        },
        error: function() {
            // Handle AJAX errors if necessary
            alert("An error occurred during the AJAX call.");
        }
    });



            //
            // $('#eventModal').modal('show');
        }
       
      }
    }
  });



document.getElementById("idBranch").disabled = true;

    
  
 
}



$(document).ready(function() {
  // Fetch the event data from the database for the current month
  
});





function selectDep(){
      
      var catID = document.getElementById("potek").value;
      var userId = document.getElementById("userId").value;
      var timeID = document.getElementById("event-id").value;
      var timeStart = document.getElementById("event-startTime").value;
       var dateStart = document.getElementById("event-start").value;
        $.ajax({
                url:"ShowCategory.php",
                method:"POST",
                data:{
                  catID: catID,
                  userId: userId,
                  timeID: timeID,
                  timeStart: timeStart,
                  dateStart:dateStart
                },
                success: function(data){
                  $("#ans").html(data);

                }
              })

      }




  $(document).on('submit', '#FormModal', function(e) {
      e.preventDefault();
        var form =$('#FormModal')[0];
        var formdata = new FormData(form);
        $.ajax({
    type: 'POST',
    url:'saveData.php',
    data: formdata,
    contentType: false,
    processData: false,
   success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
            $('#eventModal').modal('hide');
          
              swal("Success", "Appointment Submit", "success");


            }
            else if (status == 'alreadys') {
              
             swal("Error", "Appointments Alreadys Exist", "error");


            }
            else if (status == 'occupied') {
              
             swal("Error", "Please Select Another Time  ", "error");


            }
            else if (status == 'already') {
              
             swal("Error", "Error Occured> please reload the page", "error");


            }
             else if (status == 'qrnotvalid') {
              
             swal("Error", "Proof of Payment Invalid", "error");


            }
            
            
             else if (status == 'false') {
              
              swal("Error", "Services Added Error", "error");
            }
          }
    
  });
         
    });

$(document).ready(function(){
          $(document).on('click','.remove-btn-mybtnn', function(){
            $(this).closest('.row0-51').remove();

document.getElementById("addpet").style.display = "inline";
          });
        $(document).on('click', '.add-more-form-0-5', function() {
        document.getElementById("addpet").style.display = "none";

        var PetidCode = document.getElementById("petIDChose").value;
     
     console.log(PetidCode);

        $.ajax({
                url:"store_petChoseid.php",
                method:"POST",
                data:{
                  PetidCode: PetidCode
              
                },
                success: function(data){
                  $("#ans44").html(data);
                }
              })
           
        });
      });

$(document).ready(function(){
          $(document).on('click','.remove-btn-mybtnn1', function(){
            $(this).closest('.row0-5').remove();

document.getElementById("addpet1").style.display = "inline";
          });
        $(document).on('click', '.add-more-form-0-51', function() {

        document.getElementById("addpet1").style.display = "none";




           $('.paste-new-forms_0-5').append('<div class="row row0-5">\
                      <div class="col-md-3">\
               <div class="form-group">\
                  <label for="">Pet Name <label style="color:red; font-size: 1.2rem;">*</label></label>\
                  <input type="hidden" class="form-control"  name="userid" value="<?php echo $user_id; ?>">\
                  <input type="hidden" class="form-control"  name="petid2[]" value = "0">\
                  <input type="text" class="form-control"  name="nchild_name2[]" required>\
                  <input type="hidden" class="form-control"  name="pet" value="pet2">\
              </div>\
            </div>\
             <div class="col-md-2">\
                <div class="form-group">\
                 <label for="gender">Gender <label style="color: #435D7D;"></label> <label style="color:red; font-size: 1.2rem;">*</label></label>\
                  <select name="nchild_kasarian2[]"  class="form-control" required="required">\
                    <option value="female">Female</option>\
                    <option value="male">Male</option>\
                 </select>\
              </div>\
            </div>\
             <div class="col-md-2">\
                <div class="form-group">\
                <label for="dob">Date of Birth<label style="color: #435D7D;"></label><label style="color:red; font-size: 1.2rem;">*</label></label>\
                <input type="date" class="form-control" name="nchild_birthday2[] " required>\
              </div>\
            </div>\
             <div class="col-md-2">\
                <div class="form-group">\
                 <label for="gender">Pet Type <label style="color: #435D7D;"></label> <label style="color:red; font-size: 1.2rem;">*</label></label>\
                  <select name="petType2[]"  class="form-control" required="required">\
                    <option value="cat">Cat</option>\
                    <option value="dog">Dog</option>\
                     <option value="fosh">Fish</option>\
                 </select>\
              </div>\
            </div>\
              <div class="col-md-3">\
                <div class="form-group">\
                <label for="dob">Breed(optional)<label style="color: #435D7D;"></label><label style="color:red; font-size: 1.2rem;"></label></label>\
                <input type="text" class="form-control" name="breed2[] ">\
              </div>\
            </div>\
            <?php
 $queryCategory = "SELECT * FROM services_tbl join category_tbl on services_tbl.category_idfk = category_tbl.category_id WHERE services_isactive = '1'";
$resQueryCategory = mysqli_query($con, $queryCategory);

$categories = array(); // Array to store unique category names

while ($rowCategory = mysqli_fetch_assoc($resQueryCategory)) {
    $categoryName = $rowCategory['category_name'];
    $serviceName = $rowCategory['services_name'];
    $price = $rowCategory['services_price'];
     $category_id = $rowCategory['category_id'];
     $servId = $rowCategory['services_id'];

    if (!isset($categories[$categoryName])) {
        // Add the category to the array if it's not already present
        $categories[$categoryName] = array();
    }

    // Add the service to the corresponding category in the array
    $categories[$categoryName][] = array(
        'name' => $serviceName,
        'price' => $price,
        'servId' => $servId,
        'category_id' => $category_id
    );
}
?>
<div class="row mt-2">\
  <div class="col">\
    <?php
    $index = 0;
    foreach ($categories as $categoryName => $services) {
      if ($index % 2 == 0) {
         ?>
        <h5 style="color:#210062 ; font-size:1.5 rem; background-color:;"><?php echo $categoryName ?></h5>\
        <?php
    
        foreach ($services as $service) {

          ?>
          <div class="mt-1 mb-3 shadow p-3 bg-info rounded" style="background-color:whitesmoke; border: 1px solid skyblue; font-size:1.2rem;">\
             <input type="checkbox" name="cat2[]" value="<?php echo $service['servId'] ?>" style="transform: scale(1.2);margin-left: 2px;">\
<input type="hidden" name="servicesName2[]" value="<?php echo $service['name'] ?>">\
<label style="width:50%; color: #044350;"><?php echo $service['name'] ?></label>\
<!-- <label>₱<?php echo $service['price'] ?></label><br> -->\
          </div>\
          <?php

        }
      }
      $index++;
    }
    ?>
  </div>\
  <div class="col">\
    <?php
    $index = 0;
    foreach ($categories as $categoryName => $services) {
      if ($index % 2 != 0) {
        ?>
        <h5 style="color:#210062 ; font-size:1.5 rem; background-color:;"><?php echo $categoryName ?></h5>\
        <?php
    
        foreach ($services as $service) {

          ?>
          <div class="mt-1 mb-3 shadow p-3 bg-info rounded" style="background-color:whitesmoke; border: 1px solid skyblue; font-size:1.2rem;">\
            <input type="checkbox" name="cat2[]" value="<?php echo $service['servId'] ?>" style="transform: scale(1.2);">\
<input type="hidden" name="servicesName2[]" value="<?php echo $service['name'] ?>">\
<label style="width:50%; color: #044350;"><?php echo $service['name'] ?></label>\
<!-- <label>₱<?php echo $service['price'] ?></label><br> -->\
          </div>\
          <?php

        }
      }
      $index++;
    }
    ?>
  </div>\
</div>\
             <div class="col-md-6 mt-2">\
                <div class="form-group">\
               <button type="button" class="remove-btn-mybtnn1 btn btn-danger">Remove</button>\
            </div>\
            </div>\
      </div>');
        });
      });
  </script>
<script type="text/javascript">
              function selectPet(){
      
      var x = document.getElementById("selectPetd").value;
      // document.getElementById("potek").disabled = true;
     
      var y = document.getElementById("schedId2").value;
      
     // alert(x);
        $.ajax({
                url:"store_event_id.php",
                method:"POST",
                data:{
                  selectPetd: x,
                  schedIdd: y
               
                },
                success: function(data){
                  $("#ansShowStaff").html(data);

                }
              })

      }
            </script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  </body>
</html>
    <?php

  }

?>







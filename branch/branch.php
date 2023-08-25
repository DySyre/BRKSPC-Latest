<?php

include '../connect.php';
 include 'include/header.php';



if(empty($_SESSION['Enduser_id']))
{

}
else
{



    $Enduser_id =  $_SESSION['Enduser_id'];
     $query3= "select * from staff_tbl where staff_id  = '$Enduser_id' limit 1";
     $result3 = mysqli_query($con, $query3);
     $user_data = mysqli_fetch_assoc($result3);

     $adminFname = $user_data['staff_fname'];
     $branchId = $user_data['staff_branch'];

     $query4= "select * from branch_tbl where branch_id  = '$branchId' limit 1";
     $result4 = mysqli_query($con, $query4);

    $user_data1 = mysqli_fetch_assoc($result4);

     $branch_name = $user_data1['branch_name'];

    ?>

    <!DOCTYPE html>
<html lang="en">
  
<body class="sb-nav-fixed">
       
       <div id="layoutSidenav">
           <div id="layoutSidenav_content">
               <main>
                   <div class="container-fluid px-4">
                       <h1 class="mt-4">Barkspace</h1>
                       <style>
                           h1{
                               color: #0275d8;
                               
                           }
                            li{
                               font-size: larger !important ;
                           }
                       </style>
                       
                       <ol class="breadcrumb mb-4">
                           <li class="breadcrumb-item active">Dashboard</li>
                       </ol>
                       <div class="row">
                           <style>
                               .row{
                                   margin: 5px;
                                   padding: 5px;
                               }
                           </style>
                           
                           <div class="col-xl-3 col-md-6">
                               <div class="card bg-warning text-white mb-4">
                                   <div class="card-body">Pending Request</div>
                                   <style>
                               .card {
                                   box-shadow: 0px 5px 28px #ECEFF1;
                                   border-radius: 6px !important;
                                   transition: all ease 0.3s;
                                   margin-bottom: 30px ;
                                   /* background:gray!important; */
                                   padding :  7% 9%;
                                   font-size: 1.5rem;
                                   font-weight: bold;
                                   justify-content: center;
                                   text-align: center;
                                   align-items: center;
                                   cursor:s-resize;
                                   }           
                                   </style>
                                   
                                   <div class="card-footer d-flex align-items-center justify-content-between">
                                       <a class="small text-white stretched-link" href="appointment.php">View Details</a>
                                       
                                       <div class="medium text-white"><i class="fas fa-angle-right"></i></div>
                                   </div>
                               </div>
                           </div>

                           <div class="col-xl-3 col-md-6">
                               <div class="card bg-success text-white mb-4">
                                   <div class="card-body">Approved Request</div>
                                   <div class="card-footer d-flex align-items-center justify-content-between">
                                       <a class="small text-white stretched-link" href="appointment_approved.php">View Details</a>
                                       <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                   </div>
                               </div>
                           </div>

                           <div class="col-xl-3 col-md-6">
                               <div class="card bg-primary text-white mb-4">
                                   <div class="card-body">Appointment Complete </div>
                                   <div class="card-footer d-flex align-items-center justify-content-between">
                                       <a class="small text-white stretched-link" href="appointment_completed.php">View Details</a>
                                       <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                   </div>
                               </div>
                           </div>

                           <div class="col-xl-3 col-md-6">
                               <div class="card bg-danger text-white mb-4">
                                   <div class="card-body">Cancel Request</div>
                                   <div class="card-footer d-flex align-items-center justify-content-between">
                                       <a class="small text-white stretched-link" href="appointment_cancel.php">View Details</a>
                                       <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       
                      
                   </div>
               </main>
               <footer class="py-4 bg-light mt-auto">
                   <div class="container-fluid px-4">
                       <div class="d-flex align-items-center justify-content-between small">
                           <div class="text-muted">Copyright &copy; Your Website 2023</div>
                           <div>
                               <a href="#">Privacy Policy</a>
                               &middot;
                               <a href="#">Terms &amp; Conditions</a>
                           </div>
                       </div>
                   </div>
               </footer>
           </div>
       </div>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
       <script src="js/scripts.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
       <script src="assets/demo/chart-area-demo.js"></script>
       <script src="assets/demo/chart-bar-demo.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
       <script src="js/datatables-simple-demo.js"></script>
   </body>
</html>


    <?php
}


?>




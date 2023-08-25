<?php


session_start();
if(empty($_SESSION['Enduser_id']))
{

}
else
{


    include '../connect.php';
    $Enduser_id =  $_SESSION['Enduser_id'];
     $query3= "select * from staff_tbl where staff_id  = '$Enduser_id' limit 1";
     $result3 = mysqli_query($con, $query3);
     $user_data = mysqli_fetch_assoc($result3);

     $adminFname = $user_data['staff_fname'];
     $adminlname = $user_data['staff_lname'];
     $branchId = $user_data['staff_branch'];

     $_SESSION['branch_idd'] = $branchId;

     $query4= "select * from branch_tbl where branch_id  = '$branchId' limit 1";
     $result4 = mysqli_query($con, $query4);

    $user_data1 = mysqli_fetch_assoc($result4);

     $branch_name = $user_data1['branch_name'];
    ?>

    <!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>BARKSPACE</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
          <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

              <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    </head>
    <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <style>
                .navbar {
                    background: #2957a0;
                    }
            </style>
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html"><?php  echo $adminFname ?> - <?php  echo $branch_name ?></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
               
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav" >
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion"> 
                <style>
                        .sb-sidenav {
                            width: 100%;
                            }
                            
                    </style>
                    <div class="sb-sidenav-menu">
                        <div class="nav">

                            <a class="nav-link" href="/admin/admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading"><hr></div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts1">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-check"></i></div>
                                Appointment's
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                          
                            <!-- <div class="sb-sidenav-menu-heading">Interface</div> -->
                            

                            <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="appointment.php">Pending</a>
                                    <a class="nav-link" href="appointment_approved.php">Approved</a>
                                    <a class="nav-link" href="appointment_completed.php">Completed</a>
                                    <a class="nav-link" href="appointment_cancel.php">Cancel</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts3">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-hospital-user"></i></div>
                                Patient Information
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="./patient_customer.php">Customer</a>
                                    <a class="nav-link" href="patient_pet.php">Pet</a>
                                   
                                   
                                </nav>
                            </div>

                            <a class="nav-link" href="./customer_info.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-laptop-medical"></i></i></div>
                                Appointment History
                            </a>

                            <a class="nav-link" href="./walkin.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-person-walking"></i></div>
                                Walk In
                            </a>

                              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts2">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Inventory
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="item.php">Item</a>
                                    <a class="nav-link" href="item_category.php">Item Category</a>
                                    <a class="nav-link" href="item_summary.php">Item Summary</a>
                                   
                                </nav>
                            </div>

                            <a class="nav-link" href="./pos.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                                POS
                            </a>
                            
                            <a class="nav-link" href="./item_sales.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-universal-access"></i></div>
                                Sale's History
                            </a>


                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>
                                Maintenance
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="staff.php">Staff</a>
                                    <a class="nav-link" href="services.php">Services</a>
                                    <a class="nav-link" href="schedule.php">Schedule</a>
                                </nav>
                            </div>

                             
                          <!--   <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Reports
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a> -->
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            
                         
                        </div>
                    </div>
                    <!-- <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div> -->
                </nav>
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




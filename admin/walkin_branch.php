<?php
 include '../connect.php';
$branchID = $_POST['id'];


?>


<form id="MYformS">
              <div class="row">
                            <div class="col-xl-6" style=" height: 20vh;">
                                <div class="card" style="background-color: #FFF0F5;">
                                    <div class="card-header" style="background-color:  #FFF0F5; ">
                                        <input type="hidden" name="branchIDName" value="<?php echo $branchID ?>">
                                        <h3 style="justify-content: center; align-items: center; text-align: center; color: blue; ">Walk In Form</h3>
                                        <input type="hidden" id="orderNumId" value="<?php  echo $orderNumber;?>" name="ordernumberName">
                                    </div>
                                    <div class="card-body">
                                      <!-- <canvas id="myAreaChart" width="100%" height="40"></canvas> -->
                                   
                                   <div class="row">

                                    <div class="col-md-6">
                                  
                                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Firstname</label>

                                     <input type="text" name="custfName" required class="form-control" placeholder="">
                                      
                                    </div>
                                      <div class="col-md-6">
                                      
                                     
                                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Lastname</label>

                                     <input type="text" name="custlName" required class="form-control" placeholder="">
                                      
                                    </div>
                                     
                                       
                                  </div>
                                    <div class="row">

                                    <div class="col-md-12 mt-3">
                                  
                                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Email</label>
                                     

                                     <input type="email" name="custeName" required class="form-control" placeholder="">
                                      
                                    </div>
                                    
                                     
                                       
                                  </div>
              

                                    </div>
                                </div>
                                
                                <div class="card mb-4" style="height:68vh; background-color: #FFD1DA;">
                                    <div class="card-body">
                                      <!-- <canvas id="myAreaChart" width="100%" height="40"></canvas> -->
                                   
                                   <div class="form-group" id="" style="justify-content: center; align-items: center; text-align: center; color: blue; padding: 10px; font-weight: bold; ">
                                      <label style="font-size: 1.5rem;" for="fname">Pet's Info</label>
                                      <div class="row" id="ShowOrder">
                                        
                                      </div>
                                     
                                       
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6" >
                                      <label style="font-size: 1rem;" for="fname">Pet Name</label>

                                      <input type="text" name="petName" class="form-control" required placeholder="">
                                    </div>
                                    <div class="col-md-6" >
                                      <label style="font-size: 1rem;" for="fname">Breed</label>

                                      <input type="text" name="petBreed" class="form-control" placeholder="">
                                    </div>

                                     <div class="col-md-4" >
                                      <label style="font-size: 1rem;" for="fname">Pet Type</label>

                                      <input type="text" name="petType" class="form-control" placeholder="">
                                    </div>


                                  <div class="col-md-4" >

                                      <label style="font-size: 1rem;" for="fname">Gender</label>

                                  <select class="form-control" name="petGender">
                                      <option value="female">Female</option>
                                     <option value="male">Male</option>
                                       
                                  </select>
                                    </div>
                                    <div class="col-md-4" >
                                      <label style="font-size: 1rem;" for="fname">B-day</label>

                                      <input type="date" name="petBday" class="form-control" placeholder="">
                                    </div>



                                  </div>
                                 
    <div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color:  #FFF0F5; " >
        <label style="font-size: 1rem;" for="fname">Services</label>

        <select class="form-control" name="petServices" onchange="addSelectedValue(this)">
                      <?php
                      $queryBranch = "SELECT * FROM `services_tbl` JOIN category_tbl ON services_tbl.services_id = category_tbl.category_id";
                        $resqueryBranch = mysqli_query($con, $queryBranch);

                        while($rowBranch = mysqli_fetch_assoc($resqueryBranch))
                        {
                           
                            ?>
                           
                                <option value="<?php echo $rowBranch['services_id'] ?>"><?php echo $rowBranch['category_name']. '->'.$rowBranch['services_name']  ?></option>
                          
                            <?php

                        }
                      ?>
        </select>
    </div>
    <ul id="selectedValue" style="text-align: justify; text-decoration: underline; font-size: 1.3rem; font-weight: large;"></ul>
    <style>
      #selectedValue{
        background-color: #FFF0F5;
        border-style: solid;
        border-color: #FFF0F5;
        box-shadow: 10px 5px #888888;
      }
      
    </style>
   
                                    </div>
                                </div>
                            
                                 
                            </div>

                           <div class="col-xl-6" style="height: 90vh;">
                              <div class="card mb-4" style="height: 100%;">
                                <div class="card-header">
                                  <i class="fas fa-chart-bar me-1"></i>
                                  FOR TODAY'S APPOINTMENT
                                </div>
                                <style>
                              .responsive-th {
                                white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis;

                              }
                              
                            </style>
                                <div class="card-body" style="height: 100%;">
                                  <div class="table-responsive" style="height: 100%;" id="ShowPruchases">

                                     <div class="row">
                                      <label style="color: black;">Not Available Time:</label>
                <?php

                $dateToday = date('Y-m-d');
                $query21 = "select * from schedule_tbl where schedule_date = '$dateToday' AND schedule_branch = '$branchID' ";
                $result21 = mysqli_query($con, $query21);
             
                if(mysqli_num_rows($result21) > 0 )
                {
                  // start may date


                  $rowDate = mysqli_fetch_assoc($result21);
                  $schedIdd = $rowDate['schedule_id'];
                  $query2 = "SELECT * from staff_schedule_tbl join staff_tbl on staff_schedule_tbl.staff_idfk = staff_tbl.staff_id where schedule_date_idfk = '$schedIdd' ORDER BY staff_idfk asc";
                  $result2 = mysqli_query($con, $query2);
                   ?>
                  <input type="hidden" name="dateTodayName" value="<?php echo $schedIdd ?>">
                  <?php
                  if(mysqli_num_rows($result2) > 0)
                  {


                    $seenStaffIds = array();

                    while ($rowSched = mysqli_fetch_assoc($result2)) 
                    {
                        $staffId = $rowSched['staff_idfk'];
                         $staff_fname = $rowSched['staff_fname'];
                         $staff_lname = $rowSched['staff_lname'];

                      
                        if (in_array($staffId, $seenStaffIds))
                         {
                            // Action to be taken when the staff ID is repeated
                            
                            // Perform your action here
                        } 
                        else 
                        {
                          $query3 = "SELECT * from staff_schedule_tbl where schedule_date_idfk = '$schedIdd' AND staff_idfk = '$staffId'";
                          $result3 = mysqli_query($con, $query3);
                           
                            
                            ?>
                            
                            <label style="color: black;"><?php echo $staff_fname; ?> <?php echo $staff_lname ?></label>

                            <?php
                           while ($rowStafSched= mysqli_fetch_assoc($result3)) 
                           {
                               $SchedStartTime = strtotime($rowStafSched['staff_schedule_time']);
                               $SchedEndTime = strtotime($rowStafSched['staff_schedule_endtime']);

                               $formattedStartTime = date("g:i", $SchedStartTime);
                                $formattedEndTime = date("g:i", $SchedEndTime);

                               ?>
                              
                                 <div class="col-md-3">
                                    <label style="color: red;"><?php echo $formattedStartTime; ?> to <?php echo $formattedEndTime ?></label>
                                </div>
                              
                               
                               <?php

                             
                           }


                           


                            // Perform your action here
                        }
                      
                        // Add the staff ID to the seenStaffIds array
                        $seenStaffIds[] = $staffId;


                      }

                    ?>
                </div>
                    <div class="row mt-2">
                     
                            <div class="col-md-5  ">
                        <label>Select Staff</label>
                         <select class="form-control" id="selectStaffId"  name="staffIds">
                             <option hidden>Choose</option>
                            <?php
                            $queryBranch = "select * from staff_tbl where staff_isactive = '1' and staff_branch = '$branchID' ";
                            $resqueryBranch = mysqli_query($con, $queryBranch);
                            while($rowBranch = mysqli_fetch_assoc($resqueryBranch))
                            {
                                ?>
                                <option value="<?php echo $rowBranch['staff_id'] ?>"><?php echo $rowBranch['staff_fname'].' '.$rowBranch['staff_lname'] ?></option>
                                <?php
                            }
                            ?>
                            </select>
                                
                            </div>
                            
                      
                    </div>
                      
                      <div class="row">
                            <div class="col-md-5 mt-2">
                              

                      <!-- <input type="text" class="form-control" name="schedIdd" value="<?php echo $schedIdd ?>" > -->

                      


                      <label>Set Time For This Appointment:</label><br>
                      <input type="time" class="form-control" name="startTimeSchedwalk" required><br>


                  </div>
                            
                        </div>

                      <?php
                    }
                    else
                    {
                      // echo "walang sched saa staff";
                      ?>

                      <div class="row mt-2">
                     
                            <div class="col-md-5  ">
                        <label>Select Staff</label>
                         <select class="form-control" id="selectStaffId"  name="staffIds">
                             <option hidden>Choose</option>
                            <?php
                            $queryBranch = "select * from staff_tbl where staff_isactive = '1' and staff_branch = '$branchID'";
                            $resqueryBranch = mysqli_query($con, $queryBranch);
                            while($rowBranch = mysqli_fetch_assoc($resqueryBranch))
                            {
                                ?>
                                <option value="<?php echo $rowBranch['staff_id'] ?>"><?php echo $rowBranch['staff_fname'].' '.$rowBranch['staff_lname'] ?></option>
                                <?php
                            }
                            ?>
                            </select>
                                
                            </div>
                            
                      
                    </div>
                      
                      <div class="row">
                            <div class="col-md-5 mt-2">
                              

                      <!-- <input type="text" class="form-control" name="schedIdd" value="<?php echo $schedIdd ?>" > -->

                      


                      <label>Set Time For This Appointment:</label><br>
                      <input type="time" class="form-control" name="startTimeSchedwalk" required><br>


                  </div>
                            
                        </div>

                      <?php
                    }
                
                     $noApp = 'no';
                } // end if my date
                else
                {

                
                   $noApp = 'yes';



                
                  

                  
                }

if($noApp  == 'yes')
{

  ?>
  <label>PLEASE ADD SCHEDULE DATE FOR TODAY</label>


  <?php

}
else
{
  ?>

  <div class="row mb-2">
  <div class="col-md-5">
    <label>Does the customer want to reserve a time?</label>
    <select class="form-control" name="reserveTime" id="reserveTimeId" onchange="selectReserve()">
      <option hidden>Choose</option>
      <option value="1">Yes</option>
      <option value="0">No</option>

    </select>
  </div>
</div>

  <?php
}

?>




<div class="row mb-2" id="ans3">
     
</div>

          
</form>
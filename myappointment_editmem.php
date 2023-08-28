<?php session_start();
include "connect.php";
  $clientId =  $_SESSION['client_id'];

$userid = $_POST['id'];
 
$sql = "SELECT * FROM `appointment_tbl` JOIN users_balagtas ON appointment_tbl.pet_ownerid = users_balagtas.id JOIN schedule_tbl ON appointment_tbl.appointment_date = schedule_tbl.schedule_id  WHERE `appointment_payment_id` =".$userid;
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result) ){
?>
<input type="hidden" id="appIDd" name="" value="<?php echo $userid ?>">
 <form id="formAppoint" method="post" enctype="multipart/form-data">
    <div class="row">
<<<<<<< Updated upstream
 </div>
   <div class="row">
            <div class="col-md-4">
=======
      
    </div>
   <div class="row" style="margin: 2%;">
   <div class="col-md-12 mt-8" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
>>>>>>> Stashed changes
                   <div class="form-group">
                    <?php
                    $date = $row['schedule_date'];
                    $dateOnly = date('d-m-Y', strtotime($date));
                    $daayOnly = date('l', strtotime($dateOnly));

                    $branchIds = $row['appointment_branch'];

                    $sqlBranch = "SELECT * FROM `branch_tbl` WHERE branch_id = '$branchIds'";
                    $resqlBranch = mysqli_query($con, $sqlBranch);
                    $rowresqlBranch = mysqli_fetch_array($resqlBranch);


                    ?>
                      <label style="font-size: 1rem; font-weight: bold; width: 50%;" for="fname">Appointment Date</label>
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Branch:</label>
                      <label style="font-size: 1rem; font-weight: ;" for="fname"><?php echo $rowresqlBranch['branch_name'] ?></label>
                      <br>
                      <label style="font-size: 1rem;" for="fname"><?php echo $dateOnly; ?> - <?php echo $daayOnly; ?></label>


                      <input type="hidden" id="schedId" name="schedId" value="<?php echo $row['schedule_id'] ?>">
                      <input type="hidden" id="appointID" name="appointID" value="<?php echo $row['appointment_payment_id'] ?>">
                      <input type="hidden" id="schedId" name="pet_ownerid" value="<?php echo $row['pet_ownerid'] ?>">
                        <input type="hidden" id="schedId" name="emailuser" value="<?php echo $row['email'] ?>">
                        <input type="hidden" id="sameIdAppoint" name="emailuser" value="<?php echo $row['appointment_payment_same'] ?>">

                  </div>
              </div>
        </div>
<<<<<<< Updated upstream
        <div class="row">     
            <div class="col-md-4">
=======
        <div class="row" style="margin: 2%;">   
          
        <div class="col-md-12 mt-8" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
>>>>>>> Stashed changes
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Firstname</label><br>
                      <label style="font-size: 1rem;" for="fname"><?php echo $row['user_name']; ?></label>
                      <!-- <input type="text" class="form-control nborder" name="estaff_fname" id="eclassroom_name" required placeholder="" value="<?php echo $row['user_name']; ?>" readonly> -->
                       
                  </div>
              </div>
<<<<<<< Updated upstream
               <div class="col-md-4">
=======
              <div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
>>>>>>> Stashed changes
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Lastname</label><br>
                      <label style="font-size: 1rem;" for="fname"><?php echo $row['last_name']; ?></label>  
                  </div>
              </div>
<<<<<<< Updated upstream
               <div class="col-md-4">
=======
              <div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
>>>>>>> Stashed changes
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Email</label><br>
                      <label style="font-size: 1rem;" for="fname"><?php echo $row['email']; ?></label>   
                  </div>
              </div>
              
           <!--    <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Branch</label>
                     

                      <select class="form-control" name="ebranchId">
                    <option value="<?php echo $row['branch_id'] ?>" hidden><?php echo $row['branch_name'] ?></option>
                      <?php
                      $queryBranch = "select * from branch_tbl where branch_isactive = '1'";
                        $resqueryBranch = mysqli_query($con, $queryBranch);

                        while($rowBranch = mysqli_fetch_assoc($resqueryBranch))
                        {
                           
                            ?>
                           <option value="<?php echo $rowBranch['branch_id'] ?>"><?php echo $rowBranch['branch_name'] ?></option>
                                
                          
                            <?php

                        }
                      ?>
                        </select>
                       
                  </div>
              </div> -->
            <input type="hidden" name="id" id="id" value="<?php echo $row['appointment_payment_id']; ?>">
        </div>
<<<<<<< Updated upstream
        <div class="row">
            <div class="col-md-4">
=======
        <div class="row" style="margin: 2%">
        <div c class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
>>>>>>> Stashed changes
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Status</label><br>
                      <label style="font-size: 1rem; text-transform: capitalize;" for="fname"><?php echo $row['appointment_payment_status']; ?></label>   
                  </div>
              </div>
              <?php 

              if($row['appointment_payment_status'] == 'completed')
              {
                ?>

<<<<<<< Updated upstream
                <div class="col-md-4">
=======
<div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
>>>>>>> Stashed changes
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Staff Asigned</label><br>
                      <?php
                       $qStaffSched = "select * from staff_schedule_tbl where appointment_idfk = '$userid'";
                        $resStaffScehd = mysqli_query($con, $qStaffSched);
                        $rowresStaffScehd = mysqli_fetch_assoc($resStaffScehd);
                        $getStaffId = $rowresStaffScehd['staff_idfk'];

                        $qStaff = "select * from staff_tbl where staff_id = '$getStaffId'";
                        $resStaff = mysqli_query($con, $qStaff);
                        $rowresStaff = mysqli_fetch_assoc($resStaff);
                      ?>
                      <label style="font-size: 1rem;" for="fname"><?php echo  $rowresStaff['staff_fname']. ' ' .$rowresStaff['staff_lname'] ; ?></label>   
                  </div>
              </div>

<<<<<<< Updated upstream
              <div class="col-md-4">
                   <div class="form-group">
=======
              <div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
                  
>>>>>>> Stashed changes
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Start Time</label><br>
                      <?php
                       $qStaffSched = "select * from staff_schedule_tbl where appointment_idfk = '$userid'";
                        $resStaffScehd = mysqli_query($con, $qStaffSched);
                        $rowresStaffScehd = mysqli_fetch_assoc($resStaffScehd);


                    $startTime = $rowresStaffScehd['staff_schedule_time'];
                    //  $TimeDura = $rowresStaffScehd['staff_schedule_dura'];
                    // $endTime = $rowresStaffScehd['staff_schedule_endtime'];

                    $formattedStartTime = date("g:ia", strtotime($startTime));
                    // $formattedEndTime = date("g:ia", strtotime($endTime));                     
                    ?>
                      <label style="font-size: 1rem;" for="fname"><?php echo  $formattedStartTime?></label>   
                  </div>
              </div>

<<<<<<< Updated upstream
              <div class="col-md-12">
                   <div class="form-group">
=======
              <div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
                
                   <div class="form-group" >
>>>>>>> Stashed changes
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Comment</label><br>
                      <?php
                       $qStaffSched = "select * from appointment_tbl where appointment_payment_id = '$userid'";
                        $resStaffScehd = mysqli_query($con, $qStaffSched);
                        $rowresStaffScehd = mysqli_fetch_assoc($resStaffScehd);


                                  
                    ?>
                <label style="font-size: 1rem;" for="fname"><?php echo  $rowresStaffScehd['appointment_coment'] ?></label>   
                  </div>
              </div>

                <?php

              }
              else if($row['appointment_payment_status'] == 'approved')
              {
                ?>

                <div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Staff Asigned</label><br>
                      <?php
                       $qStaffSched = "select * from staff_schedule_tbl where appointment_idfk = '$userid'";
                        $resStaffScehd = mysqli_query($con, $qStaffSched);
                        $rowresStaffScehd = mysqli_fetch_assoc($resStaffScehd);
                        $getStaffId = $rowresStaffScehd['staff_idfk'];

                        $qStaff = "select * from staff_tbl where staff_id = '$getStaffId'";
                        $resStaff = mysqli_query($con, $qStaff);
                        $rowresStaff = mysqli_fetch_assoc($resStaff);
                      ?>
                      <label style="font-size: 1rem;" for="fname"><?php echo  $rowresStaff['staff_fname']. ' ' .$rowresStaff['staff_lname'] ; ?></label>   
                  </div>
              </div>

              <div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Start Time</label><br>
                      <?php
                       $qStaffSched = "select * from staff_schedule_tbl where appointment_idfk = '$userid'";
                        $resStaffScehd = mysqli_query($con, $qStaffSched);
                        $rowresStaffScehd = mysqli_fetch_assoc($resStaffScehd);


                    $startTime = $rowresStaffScehd['staff_schedule_time'];
                    //  $TimeDura = $rowresStaffScehd['staff_schedule_dura'];
                    // $endTime = $rowresStaffScehd['staff_schedule_endtime'];

                    $formattedStartTime = date("g:ia", strtotime($startTime));
                    // $formattedEndTime = date("g:ia", strtotime($endTime));                     
                    ?>
                      <label style="font-size: 1rem;" for="fname"><?php echo  $formattedStartTime?></label>   
                  </div>
              </div>
               <div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Estimated End Time</label><br>
                      <?php
                       $qStaffSched = "select * from staff_schedule_tbl where appointment_idfk = '$userid'";
                        $resStaffScehd = mysqli_query($con, $qStaffSched);
                        $rowresStaffScehd = mysqli_fetch_assoc($resStaffScehd);


                    $startTime = $rowresStaffScehd['staff_schedule_endtime'];
                    //  $TimeDura = $rowresStaffScehd['staff_schedule_dura'];
                    // $endTime = $rowresStaffScehd['staff_schedule_endtime'];

                    $formattedStartTime = date("g:ia", strtotime($startTime));
                    // $formattedEndTime = date("g:ia", strtotime($endTime));                     
                    ?>
                      <label style="font-size: 1rem;" for="fname"><?php echo  $formattedStartTime?></label>   
                  </div>
              </div>

              <div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Comment</label><br>
                      <?php
                       $qStaffSched = "select * from appointment_tbl where appointment_payment_id = '$userid'";
                        $resStaffScehd = mysqli_query($con, $qStaffSched);
                        $rowresStaffScehd = mysqli_fetch_assoc($resStaffScehd);


                                  
                    ?>
                <label style="font-size: 1rem;" for="fname"><?php echo  $rowresStaffScehd['appointment_coment'] ?></label>   
                  </div>
              </div>

                <?php

              }
              else
              {

              }

              ?>
              

              
        </div>
      <div class="row" style="margin: 2%;">

<<<<<<< Updated upstream
            <div class="col-md-4 mt-4">
=======
            <div class="col-md-12 mt-8" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
>>>>>>> Stashed changes
                   <div class="form-group">

                    <?php 
                    $sameId =  $row['appointment_payment_same'];
                    $ChecksameId = "select * from pet_services_tbl where pet_service_cat = '$sameId'";
                    $reChecksameId = mysqli_query($con, $ChecksameId);
                    $catIdnew = '0';

                    while($rowreChecksameId = mysqli_fetch_assoc($reChecksameId))
                    {
                        ?>
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Pet's name:</label>

                      <?php
                       $petNameId =  $rowreChecksameId['pet_name_id'];
                        $CheckpetNameId = "select * from pets where id = '$petNameId'";
                        $reCheckpetNameId = mysqli_query($con, $CheckpetNameId);

                      while($rowrCheckpetNameId = mysqli_fetch_assoc($reCheckpetNameId)){
                        ?>
                        <label style="font-size: 1rem; text-shadow: 2px 2px 5px green; text-decoration: underline; text-transform: capitalize;" for="fname"><?php echo $rowrCheckpetNameId['pet_name']; ?></label><br>
                        <?php

                      }
                      ?>
                                          
                      <!-- <label style="font-size: 1rem;" for="fname"><?php echo $rowreChecksameId['pet_services_name']; ?></label><br> -->

                      <?php
                      $ServId =  $rowreChecksameId['pet_services_id'];
                      $CheckServId = "SELECT * FROM `pet_services_his_tbl` JOIN services_tbl ON pet_services_his_tbl.pet_services_his_name = services_tbl.services_id WHERE pet_services_his_servidfk = '$ServId'";
                      $reCheckServId = mysqli_query($con, $CheckServId);

                      while($rowreCheckServId = mysqli_fetch_assoc($reCheckServId))
                        {
                                $catId =  $rowreCheckServId['category_idfk'];
                                 $CheckcatId = "SELECT * FROM `category_tbl` WHERE category_id = '$catId'";
                                 $reCheckcatId = mysqli_query($con, $CheckcatId);
                                 if($catId == $catIdnew)
                                {

                                }
                                else
                                {
                                    while($rowreCheckcatId = mysqli_fetch_assoc($reCheckcatId))
                                     {
                                        $catIdnew = $rowreCheckServId['category_idfk'];

                                        ?>
                                         <label style="font-size: 1rem; font-weight: bold;" for="fname">Category:</label>

<<<<<<< Updated upstream
                                        <label class="" style="font-size: 1rem; font-weight:bold; font-style: italic;" for="fname"><?php echo $rowreCheckcatId['category_name']; ?></label><br>
                                        <label class="ms-2" style="font-size: 1rem; font-weight:bold; font-style: italic;" for="fname">Services</label><br>
=======
                                        <label class="ms-3" style="font-size: 1rem; text-shadow: 2px 2px 5px green; text-transform: capitalize; text-decoration: underline;" for="fname"><?php echo $rowreCheckcatId['category_name']; ?></label><br>
                                        <label class="ms-1" style="font-size: 1.5rem; font-weight:bolder;" for="fname">Services</label><br>
>>>>>>> Stashed changes
                                        <?php

                                     }

                                }
                              ?>
                                 <label class="ms-2" style="font-size: 1rem;" for="fname"><?php echo $rowreCheckServId['services_name']; ?></label><br>
                             <?php
                        }
                    }
                     ?>
                  </div>
              </div>
            <div class="col-md-8 mt-4" style="text-align: center;">
                 <label style="font-size: 1rem; font-weight: bold;" for="fname">Proof of Payment</label><br>
                   <img src="images/<?php echo $row['appointment_payment_proof']; ?>" style="max-width: 60%; height: auto;">  
            </div>
            
        </div>

        <?php 

        if($row['appointment_payment_status'] == 'completed')
{
   $sql = "SELECT * FROM `appointment_tbl` JOIN users_balagtas ON appointment_tbl.pet_ownerid = users_balagtas.id JOIN schedule_tbl ON appointment_tbl.appointment_date = schedule_tbl.schedule_id  WHERE appointment_payment_status = 'completed' and `appointment_payment_id` =".$userid;
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result) ){
?>
   
      <div class="row">
 <div class="col-md-8 mt-4" style="text-align: left;">
                 <label style="font-size: 1rem; font-weight: bold;" for="fname">Bill</label><br>
                <hr>   
            </div>
            <div class="col-md-12 mt-4">
                   <div class="form-group">

                    <?php 
                    $sameId =  $row['appointment_payment_same'];
                    $ChecksameId = "select * from pet_services_tbl where pet_service_cat = '$sameId'";
                    $reChecksameId = mysqli_query($con, $ChecksameId);
                    $catIdnew = '0';

                    while($rowreChecksameId = mysqli_fetch_assoc($reChecksameId))
                    {
                        ?>
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Pet's name:</label>

                      <?php
                       $petNameId =  $rowreChecksameId['pet_name_id'];
                        $CheckpetNameId = "select * from pets where id = '$petNameId'";
                        $reCheckpetNameId = mysqli_query($con, $CheckpetNameId);

                      while($rowrCheckpetNameId = mysqli_fetch_assoc($reCheckpetNameId)){

                        $petIdd =  $rowrCheckpetNameId['id'];
                        ?>
                        <label style="font-size: 1rem;" for="fname"><?php echo $rowrCheckpetNameId['pet_name']; ?></label>
                      <br>
                        <?php

                      }
                      ?>
                                          
                      <!-- <label style="font-size: 1rem;" for="fname"><?php echo $rowreChecksameId['pet_services_name']; ?></label><br> -->

                      <?php
                      $ServId =  $rowreChecksameId['pet_services_id'];
                      $CheckServId = "SELECT * FROM `appointment_completed_tbl` left JOIN appointment_tbl on appointment_completed_tbl.appointment_completed_idfk = appointment_tbl.appointment_payment_id JOIN pet_services_his_tbl ON appointment_completed_tbl.appointment_services_idfk = pet_services_his_tbl.pet_services_his_name JOIN pet_services_tbl ON pet_services_his_tbl.pet_services_his_servidfk = pet_services_tbl.pet_services_id JOIN pets ON pet_services_tbl.pet_name_id = pets.id JOIN services_tbl ON appointment_completed_tbl.appointment_services_idfk = services_tbl.services_id  WHERE appointment_completed_idfk = '$userid' and pet_services_id = '$ServId'";
                      $reCheckServId = mysqli_query($con, $CheckServId);

                      $CheckServIdCount = "SELECT count(pet_services_id) as totalServices FROM `appointment_completed_tbl` left JOIN appointment_tbl on appointment_completed_tbl.appointment_completed_idfk = appointment_tbl.appointment_payment_id JOIN pet_services_his_tbl ON appointment_completed_tbl.appointment_services_idfk = pet_services_his_tbl.pet_services_his_name JOIN pet_services_tbl ON pet_services_his_tbl.pet_services_his_servidfk = pet_services_tbl.pet_services_id JOIN pets ON pet_services_tbl.pet_name_id = pets.id JOIN services_tbl ON appointment_completed_tbl.appointment_services_idfk = services_tbl.services_id  WHERE appointment_completed_idfk = '$userid' and pet_services_id = '$ServId'";
                      $reCheckServIdCount = mysqli_query($con, $CheckServIdCount);
                      $rowreCheckServIdCount = mysqli_fetch_assoc($reCheckServIdCount);
                      $countServ = $rowreCheckServIdCount['totalServices'];

                      while($rowreCheckServId = mysqli_fetch_assoc($reCheckServId))
                        {
                                $sameIdAp = $rowreCheckServId['pet_services_his_sameappoint'];

                                 $sql4 = "SELECT *
                                FROM `appointment_completed_tbl`
                                LEFT JOIN `pet_services_his_tbl` ON `appointment_completed_tbl`.`appointment_services_idfk` = `pet_services_his_tbl`.`pet_services_his_name`
                                WHERE `user_add` = '$sameIdAp' AND `pet_services_his_id` IS NULL;
                                ";
                                $result4 = mysqli_query($con,$sql4);

                                
                                if(mysqli_num_rows($result4) != 0)
                                {
                                    $row4 = mysqli_fetch_array($result4);
                                    $idappSEr =  $row4['appointment_services_idfk'];
                                }
                                else
                                {
                                    $idappSEr = 0;

                                }

                                
                                





                                $catId =  $rowreCheckServId['category_idfk'];
                                 $CheckcatId = "SELECT * FROM `category_tbl` WHERE category_id = '$catId'";
                                 $reCheckcatId = mysqli_query($con, $CheckcatId);
                                 if($catId == $catIdnew)
                                {

                                }
                                else
                                {
                                    while($rowreCheckcatId = mysqli_fetch_assoc($reCheckcatId))
                                     {
                                        $catIdnew = $rowreCheckServId['category_idfk'];

                                        ?>
                                         <label style="font-size: 1rem; font-weight: bold;" for="fname">Category:</label>

                                        <label class="" style="font-size: 1rem; font-weight:bold; font-style: italic;" for="fname"><?php echo $rowreCheckcatId['category_name']; ?></label><br>
                                        <label class="ms-2" style="width: 20%; font-size: 1rem; font-weight:bold; font-style: italic;" for="fname">Services</label>
                                         <label class="" style="font-size: 1rem; font-weight:bold; font-style: italic; margin-left: 50px;" for="fname">Qty</label>
                                          <label class="" style="font-size: 1rem; font-weight:bold; font-style: italic; margin-left: 80px;" for="fname">Price</label>
                                          <label class="" style="font-size: 1rem; font-weight:bold; font-style: italic; margin-left: 80px;" for="fname">Amount</label><br>
                                        <?php

                                     }

                                }

                                  
                                 $price2 =  $rowreCheckServId['services_price'];
                                 $grandTotal = $rowreCheckServId['appointment_completed_amount'];
                      

                                 $grandQty = $rowreCheckServId['appointment_completed_qty'];
                          


                                  // echo $idAppoinmentCom = $rowreCheckServId['appointment_services_idfk'];



                                 
         
                              ?>
                              <input type="hidden" name="" class="price" id="priceID<?php echo $rowreCheckServId['services_id']; ?>"  value="<?php echo $price2; ?>" readonly>
                                 <label class="ms-2" style="width: 20%; font-size: 1rem;" for="fname"><?php echo $rowreCheckServId['services_name']; ?></label>
                          

                                    <input type="number" style="border: none; background-color: transparent; width: 7%; margin-left: 50px;" name="qty[]" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?php echo $rowreCheckServId['appointment_completed_qty']; ?>" readonly >

                              <input type="hidden" name="services_id[]" style="width: 7%;" id="price" value="<?php echo $rowreCheckServId['services_id']; ?>">

                                 <input type="hidden" name="" style="background-color: transparent; width: 10%; margin-left: 50px; border: none;"  id="price" value="₱<?php echo $rowreCheckServId['services_price']; ?>">

                                 <input type="text" name="pricess[]" style="background-color: transparent; width: 10%; margin-left: 50px; border: none;"  id="price" value="₱<?php echo $rowreCheckServId['app_com_price']; ?>">




                                 <input type="hidden" name="" class="price" style="background-color: transparent; width: 10%; margin-left: 50px; border: none;" id="priceIDd<?php echo $rowreCheckServId['services_id']; ?>"  value="₱<?php echo number_format($price2,2); ?>" readonly>

                                 <input type="text" name="amount[]" class="price" style="background-color: transparent; width: 12%; margin-left: 50px; border: none;" value="₱<?php echo $rowreCheckServId['appointment_completed_amount']; ?>" readonly>

    

                                 <br>

                               
                             <?php


                        }
                    }
                     ?>
                  </div>
              </div>
         <!--    <div class="col-md-8 mt-4" style="text-align: center;">
                 <label style="font-size: 1rem; font-weight: bold;" for="fname">Proof of Payment</label><br>
                   <img src="../images/<?php echo $row['appointment_payment_proof']; ?>" style="max-width: 60%; height: auto;">  
            </div> -->
        </div>
        <div class="row">
            
            <?php 
             $sql5 = "SELECT * FROM `services_tbl` JOIN category_tbl ON services_tbl.category_idfk = category_tbl.category_id JOIN appointment_completed_tbl ON services_tbl.services_id = appointment_completed_tbl.appointment_services_idfk WHERE services_id = '$idappSEr'";
$result5 = mysqli_query($con,$sql5);

if(mysqli_num_rows($result5) != 0)
{

        while( $row5 = mysqli_fetch_array($result5) ){
        ?>
        <div class="col-md-12 mt-3"><h5>Additional</h5></div>
        <div class="col-md-12">
             <label style="font-size: 1rem; font-weight: bold;" for="fname">Category:</label>
             <label class="" style="font-size: 1rem; font-weight:bold; font-style: italic; width:20%;" for="fname"><?php echo $row5['category_name']; ?></label>
              <label style="font-size: 1rem; font-weight: bold; width:11%;" for="fname">QTY</label>
               <label style="font-size: 1rem; font-weight: bold;width:16%; font-style: italic;" for="fname">Price</label>
               <label style="font-size: 1rem; font-weight: bold;width:15%; font-style: italic;" for="fname">Amount</label><br> 
        </div>
         <div class="col-md-12 ms-2">
             <label style="font-size: 1rem; font-weight: bold; font-style: italic;" for="fname">Services:</label><br> 
             <label class="" style="font-size: 1rem;  width:30%;" for="fname"><?php echo $row5['services_name']; ?></label>
             <label class="" style="font-size: 1rem;  width:10%;" for="fname"><?php echo $row5['appointment_completed_qty']; ?></label>
             <label class="" style="font-size: 1rem; width:17%;" for="fname">₱<?php echo $row5['app_com_price']; ?></label>
             <label class="" style="font-size: 1rem;" for="fname">₱<?php echo $row5['appointment_completed_amount']; ?></label>


        </div>
    <?php
    }
}
else
{
   

}
$sql6 = "SELECT SUM(appointment_completed_qty) AS sumQty FROM `appointment_bill_tbl` JOIN appointment_completed_tbl ON appointment_bill_tbl.appointment_idfk = appointment_completed_tbl.appointment_completed_idfk WHERE appointment_idfk = '$userid'";
$result6 = mysqli_query($con,$sql6);
$row6 = mysqli_fetch_array($result6);

$sql7 = "SELECT COUNT(appointment_bill_id) AS rowsCount FROM `appointment_bill_tbl` JOIN appointment_completed_tbl ON appointment_bill_tbl.appointment_idfk = appointment_completed_tbl.appointment_completed_idfk WHERE appointment_idfk = '$userid'";
$result7 = mysqli_query($con,$sql7);
$row7 = mysqli_fetch_array($result7);

$sql8 = " SELECT sum(appointment_completed_amount) AS totalSumAmount FROM `appointment_bill_tbl` JOIN appointment_completed_tbl ON appointment_bill_tbl.appointment_idfk = appointment_completed_tbl.appointment_completed_idfk WHERE appointment_idfk = '$userid'";
$result8 = mysqli_query($con,$sql8);
$row8 = mysqli_fetch_array($result8)

// $formattedTotal = number_format($row8['totalSumAmount'], 2, '.', ',');
// echo $formattedTotal;


            ?>
        </div>
        <div class="row">
            <div class="col-md-12 mt-4">
              
            <label class="lbl" style="width:27% ;">Item's: <?php echo $row7['rowsCount'] ?> </label>
             <label class="lbl" style="width:32% ;">Qty's: <?php echo $row6['sumQty'] ?>  </label>
             <label class="lbl" style="width:25% ;">Total: ₱<?php echo number_format($row8['totalSumAmount'], 2, '.', ',') ?> </label>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php 

                $qSelect = "select * from appointment_bill_tbl where appointment_idfk = '$userid' limit 1";
                $resqSelect = mysqli_query($con, $qSelect);
                $rowresqSelect = mysqli_fetch_assoc($resqSelect);



                ?>
              
            <label class="lbl" style="width:27% ;"></label>
             <label class="lbl" style="width:32% ;"></label>
             <label class="lbl" style="width:25% ;">Cash: ₱<?php echo number_format($rowresqSelect['appointment_bill_payment'], 2, '.', ',') ?> </label>
            </div>
            
        </div>

          <div class="row">
            <div class="col-md-12">
            
            <label class="lbl" style="width:27% ;"></label>
             <label class="lbl" style="width:32% ;"></label>
            <?php
                $balChange = $rowresqSelect['appointment_bill_bal'];

                if ($balChange < 0) {
                    $balChange = abs($balChange);

                     $balChange =  number_format($balChange, 2, '.', ',');

                  ?>
                   <label class="lbl" style="width:25% ;">Balance: ₱<?php echo $balChange ?> </label>

                  <?php
                } else {
                    $balChange =  number_format($balChange, 2, '.', ',');
                 ?>

                  <label class="lbl" style="width:25% ;">Change: ₱<?php echo $balChange ?> </label>

                 <?php
                }
                ?>

             
            
            </div>
            
        </div>

        <div class="row">
            
            <div class="col-md-12">
                 <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <!-- <button type="button" onclick="printModalContent()" class="btn btn-primary">Print</button> -->
       </div>  
            </div>
        </div>

    
<!-- Your modal content -->


  <?php
}

}

        else if( $row['appointment_payment_status'] == 'pending')
        {
            ?>
             <div class="row" style="margin: 2%;">
            <div class="col-md-4">
                
                <select class="form-control" id="ChooseActionId" onchange="ChooseAction()">
                    <option hidden >Choose Action</option>
                    <option value="Resched"  >Resched</option>
                    <option value="Cancel"  >Cancel</option>
                </select>
            </div>
        </div>
        <div class="row" id="ans3" style="font-size: 1.2rem; justify-content: center; text-align: center; align-items: center;">

        </div>
            
            <?php
        }
        else if( $row['appointment_payment_status'] == 'approved')
        {

        }
        ?>
        
   <!--      <div class="row">
            <div class="col-md-4">
                <select class="form-control" id="ChooseActionCompleteId" onchange="ChooseActionComplete()">
                    <option hidden >Choose Action</option>
                    <option value="complete"  >Complete</option>
                    <option value="other"  >Other</option>
                </select>
            </div>
        </div> -->
    <!--     <div class="row" id="ans3">
            
            
        </div> -->
         
    
                   

  </form>


<script type="text/javascript">

function ChooseAction()
{
      
      var x = document.getElementById("ChooseActionId").value;
      var appIDds = document.getElementById("appIDd").value;

      
        $.ajax({
                url:"myappointment_chooseresched.php",
                method:"POST",
                data:{
                  id: x,
                  appIDd: appIDds
              

                },
                success: function(data){
                  $("#ans3").html(data);

                }
              })
}






function ChooseActionComplete(){
      
      var x = document.getElementById("ChooseActionCompleteId").value;
      // document.getElementById("potek").disabled = true;
      var y = document.getElementById("appointID").value;
      var z = document.getElementById("sameIdAppoint").value;

     
   

      
        $.ajax({
                url:"appointment_complete.php",
                method:"POST",
                data:{
                  id: x,
                  idx: y,
                  sameIdAppoint: z

                },
                success: function(data){
                  $("#ans3").html(data);

                }
              })

      }




</script>
 
 
<?php } 


?>
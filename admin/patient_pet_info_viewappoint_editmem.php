<?php session_start();
include "../connect.php";
 
$userid = $_POST['id'];
$sql = "SELECT * FROM `appointment_tbl` JOIN users_balagtas ON appointment_tbl.pet_ownerid = users_balagtas.id JOIN schedule_tbl ON appointment_tbl.appointment_date = schedule_tbl.schedule_id join branch_tbl on appointment_tbl.appointment_branch = branch_tbl.branch_id WHERE appointment_payment_status = 'completed' and `appointment_payment_id` =".$userid;
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result) ){
?>


    <div class="row">
 </div>
   <div class="row" style="margin: 2%;">
            <div class="col-md-12 mt-8" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
                   <div class="form-group">
                    <?php
                    $date = $row['schedule_date'];
                    $dateOnly = date('d-m-Y', strtotime($date));
                    $daayOnly = date('l', strtotime($dateOnly));
                    ?>
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Appointment Date</label><br>
                      <label style="font-size: 1rem;" for="fname"><?php echo $dateOnly; ?> - <?php echo $daayOnly; ?></label>
                      
                      <input type="hidden" id="schedId" name="schedId" value="<?php echo $row['schedule_id'] ?>">
                      <input type="hidden" id="appointID" name="appointID" value="<?php echo $row['appointment_payment_id'] ?>">
                      <input type="hidden" id="schedId" name="pet_ownerid" value="<?php echo $row['pet_ownerid'] ?>">
                        <input type="hidden" id="schedId" name="emailuser" value="<?php echo $row['email'] ?>">
                  </div>
                  
              </div>
              <div class="col-md-12 mt-8" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
                   <div class="form-group">
                    
                 
                  <label style="font-size: 1rem; font-weight: bold;" for="fname">Appointment Branch</label><br>
                      <label style="font-size: 1rem;" for="fname"><?php echo $row['branch_name']; ?></label>
                       </div>
              </div>
        </div>
        <div class="row" style="margin: 2%;">     
            <div class="col-md-12 mt-8" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Firstname</label><br>
                      <label style="font-size: 1rem;" for="fname"><?php echo $row['user_name']; ?></label>
                      <!-- <input type="text" class="form-control nborder" name="estaff_fname" id="eclassroom_name" required placeholder="" value="<?php echo $row['user_name']; ?>" readonly> -->
                       
                  </div>
              </div>
               <div class="col-md-12 mt-8" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Lastname</label><br>
                      <label style="font-size: 1rem;" for="fname"><?php echo $row['last_name']; ?></label>  
                  </div>
              </div>
               <div class="col-md-12 mt-8" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
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
        <div class="row" style="margin: 2%;">
            <div class="col-md-12 mt-8" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Status</label><br>
                      <label style="font-size: 1rem;" for="fname"><?php echo $row['appointment_payment_status']; ?></label>   
                  </div>
              </div>
              <div class="col-md-12 mt-8" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
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

              <div class="col-md-12 mt-8" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Time</label><br>
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
              <div class="col-md-12 mt-8" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Comment</label><br>
                      
                      <label style="font-size: 1rem;" for="fname"><?php echo  $row['appointment_coment']?></label>   
                  </div>
              </div>
        </div>
      
       
        <div class="row" id="ans3">
            <?php
$sumGrandtotal = 0;
$sumGrandqty = 0;
$sumgrandItem = 0;


   $sql = "SELECT * FROM `appointment_tbl` JOIN users_balagtas ON appointment_tbl.pet_ownerid = users_balagtas.id JOIN schedule_tbl ON appointment_tbl.appointment_date = schedule_tbl.schedule_id  WHERE appointment_payment_status = 'completed' and `appointment_payment_id` =".$userid;
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result) ){
?>


    <div  id="modalContent">

   <div class="row" >
            <div class="col-md-4">
                   <div class="form-group">
                    <?php
                    $date = $row['schedule_date'];
                    $dateOnly = date('d-m-Y', strtotime($date));
                    $daayOnly = date('l', strtotime($dateOnly));
                    ?>
                    <br>
                      
                      <input type="hidden" id="schedId" name="schedId" value="<?php echo $row['schedule_id'] ?>">
                      <input type="hidden" id="appointID" name="appointID" value="<?php echo $row['appointment_payment_id'] ?>">
                      <input type="hidden" id="schedId" name="pet_ownerid" value="<?php echo $row['pet_ownerid'] ?>">
                        <input type="hidden" id="schedId" name="emailuser" value="<?php echo $row['email'] ?>">

                        <input type="hidden" name="appointMentID" value="<?php echo $userid ?>">
                  </div>
              </div>
        </div>
      <div class="row" style="margin: 2%;">

            <div class="col-md-12 mt-8" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
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
                        <label style="font-size: 1rem; text-shadow: 2px 2px 5px green; text-decoration: underline; text-transform: capitalize;" for="fname"><?php echo $rowrCheckpetNameId['pet_name']; ?></label>
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
                                         <label style="font-size: 1rem; font-weight: bold; padding: 10px;" for="fname">Category:</label>

                                        <label class="" style="font-size: 1rem; text-shadow: 2px 2px 5px green; text-transform: capitalize; text-decoration: underline;" for="fname"><?php echo $rowreCheckcatId['category_name']; ?></label><br>
                                        <label class="ms-2" style="width: 20%; font-size: 1rem; font-weight:bold; font-style: italic; display: inline-block;" for="fname">Services</label>
                                         <label class="" style="font-size: 1rem; font-weight:bold;  margin-left: 50px; color: green;display: inline-block;" for="fname">Qty</label>
                                          <label class="" style="font-size: 1rem; font-weight:bold;  margin-left: 80px; color: red;display: inline-block;" for="fname">Price</label>
                                          <label class="" style=" width: 20%; padding: 20px; font-size: 1rem; font-weight:bold;  margin-left: 80px; color: blue;display: inline-block;" for="fname">Amount</label><br>
                                        <?php

                                     }

                                }

                                  
                                 $price2 =  $rowreCheckServId['services_price'];
                                 $grandTotal = $rowreCheckServId['appointment_completed_amount'];
                                 $sumGrandtotal += $grandTotal;

                                 $grandQty = $rowreCheckServId['appointment_completed_qty'];
                                 $sumGrandqty += $grandQty;


                                 
         
                              ?>
                              <input type="hidden" name="" class="price" id="priceID<?php echo $rowreCheckServId['services_id']; ?>"  value="<?php echo $price2; ?>" readonly>
                                 <label class="ms-2" style="width: 20%; font-size: 1rem; font-weight:bold; font-style: bold; color:green; text-transform: capitalize;" for="fname"><?php echo $rowreCheckServId['services_name']; ?></label>
                          

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
        <div class="row" style="margin: 2%;">
            <div class="col-md-12 mt-8" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
              
            <label class="lbl" style="width:27% ; font-weight: bold;">Item's: <?php echo $countServ ?> </label>
             <label class="lbl" style="width:32% ;font-weight: bold;">Qty's: <?php echo $sumGrandqty ?> </label>
             <label class="lbl" style="width:25% ;font-weight: bold; color: blue;">Total: ₱<?php echo $sumGrandtotal ?> </label>
            </div>
            
        </div>
        <div class="row" style="margin: 2%;">
            <div class="col-md-12 mt-8" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
                <?php 

                $qSelect = "select * from appointment_bill_tbl where appointment_idfk = '$userid' limit 1";
                $resqSelect = mysqli_query($con, $qSelect);
                $rowresqSelect = mysqli_fetch_assoc($resqSelect);



                ?>
              
            <label class="lbl" style="width:27% ;"></label>
             <label class="lbl" style="width:32% ;"></label>
             <label class="lbl" style="width:25% ; color: green; font-weight: bold;">Cash: ₱<?php echo $rowresqSelect['appointment_bill_payment'] ?> </label>
            </div>
            
        </div>

          <div class="row" style="margin: 2%;">
            <div class="col-md-12 mt-8" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
            
            <label class="lbl" style="width:27% ;"></label>
             <label class="lbl" style="width:32% ;"></label>
            <?php
                $balChange = $rowresqSelect['appointment_bill_bal'];

                if ($balChange < 0) {
                    $balChange = abs($balChange);

                  ?>
                   <label class="lbl" style="width:25% ; color: red; font-weight: bold;">Balance: ₱<?php echo $balChange ?> </label>

                  <?php
                } else {

                 ?>
                  <label class="lbl" style="width:25% ; color: red; font-weight: bold;">Change: ₱<?php echo $balChange ?> </label>

                 <?php
                }
                ?>

             
            
            </div>
            
        </div>
 </div>
        <div class="row">
            
            <div class="col-md-12">
                 <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" onclick="printModalContent()" class="btn btn-primary">Print</button>
       </div>  
            </div>
        </div>

    

<!-- Your modal content -->


<script>
function printModalContent() {
    // Get the modal content element
    var modalContent = document.getElementById("modalContent");

    // Create a new window for printing
    var printWindow = window.open("", "_blank");

    // Write the modal content to the new window
    printWindow.document.open();
    printWindow.document.write('<html><head><title>Print Modal</title>');
    printWindow.document.write('<style>');
    printWindow.document.write('body { text-align: left; }');
    printWindow.document.write('.qty { margin-left: 200px; }');
    printWindow.document.write('h4 { margin-top: 5px; margin-bottom: 5px; }');
    printWindow.document.write('</style></head><body>');
    printWindow.document.write('<center><h4>Barkspace Pet Grooming</h4></center>');
    printWindow.document.write('<center><h4>And Wellness Center</h4></center>');
    printWindow.document.write('<center><h4>0968-477-8008</h4></center>');
    printWindow.document.write(modalContent.innerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();

    // Wait for the content to load before printing
    printWindow.onload = function() {
        printWindow.print();
        printWindow.close();
    };
}


</script>
  
                   


 

  <?php
}



 ?>
 <script type="text/javascript">
     
     

 </script>
 
            
            
        </div>
         
    
                   




<script type="text/javascript">


function ChooseActionComplete(){
      
      var x = document.getElementById("ChooseActionCompleteId").value;
      // document.getElementById("potek").disabled = true;
      var y = document.getElementById("appointID").value;

     
   

      
        $.ajax({
                url:"appointment_receipt_show.php",
                method:"POST",
                data:{
                  id: x,
                  idx: y

                },
                success: function(data){
                  $("#ans3").html(data);

                }
              })

      }




</script>
 
 
<?php } 


?>
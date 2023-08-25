<?php session_start();
include "../connect.php";
 
$userid = $_POST['id'];
 
$sql = "SELECT * FROM `appointment_tbl` JOIN users_balagtas ON appointment_tbl.pet_ownerid = users_balagtas.id JOIN schedule_tbl ON appointment_tbl.appointment_date = schedule_tbl.schedule_id  WHERE appointment_payment_status = 'completed' and `appointment_payment_id` =".$userid;
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result) ){
?>


    <div class="row">
 </div>
   <div class="row">
            <div class="col-md-4">
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
        </div>
        <div class="row">     
            <div class="col-md-4">
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Firstname</label><br>
                      <label style="font-size: 1rem;" for="fname"><?php echo $row['user_name']; ?></label>
                      <!-- <input type="text" class="form-control nborder" name="estaff_fname" id="eclassroom_name" required placeholder="" value="<?php echo $row['user_name']; ?>" readonly> -->
                       
                  </div>
              </div>
               <div class="col-md-4">
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Lastname</label><br>
                      <label style="font-size: 1rem;" for="fname"><?php echo $row['last_name']; ?></label>  
                  </div>
              </div>
               <div class="col-md-4">
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
        <div class="row">
            <div class="col-md-4">
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Status</label><br>
                      <label style="font-size: 1rem;" for="fname"><?php echo $row['appointment_payment_status']; ?></label>   
                  </div>
              </div>
              <div class="col-md-4">
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

              <div class="col-md-4">
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
        </div>
      
        <div class="row">
            <div class="col-md-4">
                <select class="form-control" id="ChooseActionCompleteId" onchange="ChooseActionComplete()">
                    <option hidden >Choose Action</option>
                    <option value="bill"  >bill</option>
                    <option value="other"  >Other</option>
                </select>
            </div>
        </div>
        <div class="row" id="ans3">
            
            
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
<?php session_start();
include "../connect.php";
 
$userid = $_POST['id'];
$SumConsume = 0;
$sql = "SELECT * FROM `appointment_tbl` JOIN users_balagtas ON appointment_tbl.pet_ownerid = users_balagtas.id JOIN schedule_tbl ON appointment_tbl.appointment_date = schedule_tbl.schedule_id  WHERE appointment_payment_status = 'pending' and `appointment_payment_id` =".$userid;
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result) ){
?>

 <form id="appointAssign" method="post" enctype="multipart/form-data">
    <div class="row">
        
 </div>
   <div class="row" style="margin: 2%;">
   <div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 0 0 5px; margin: 0; background-color: whitesmoke; ">
                   <div class="form-group">
                    <?php
                    $date = $row['schedule_date'];
                    $dateOnly = date('d-m-Y', strtotime($date));
                    $daayOnly = date('l', strtotime($dateOnly));

                 
                    $braId =   $row['appointment_branch'];
                    ?>
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Appointment Date</label><br>
                      <label style="font-size: 1rem;" for="fname"><?php echo $dateOnly; ?> - <?php echo $daayOnly; ?></label>
                      <input type="hidden" id="braIdd" value="<?php echo $braId ?>">
                      <input type="hidden" id="appDate" name="appDate" value="<?php echo $dateOnly ?>">
                       <input type="hidden" id="appDay" name="appDay" value="<?php echo $daayOnly ?>">
                      <input type="hidden" id="schedId" name="schedId" value="<?php echo $row['schedule_id'] ?>">
                      <input type="hidden" id="appointID" name="appointID" value="<?php echo $row['appointment_payment_id'] ?>">
                      <input type="hidden" id="pet_ownerid" name="pet_ownerid" value="<?php echo $row['pet_ownerid'] ?>">
                        <input type="hidden" id="emailuser" name="emailuser" value="<?php echo $row['email'] ?>">





                  </div>
              </div>

        </div>
        <div class="row" style="margin: 2%;">
           
           
        <div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 0 0 5px; margin: 0; background-color: whitesmoke;  ">
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold; " for="fname">Firstname</label><br>
                      <label style="font-size: 1rem;" for="fname"><?php echo $row['user_name']; ?></label>
                      <!-- <input type="text" class="form-control nborder" name="estaff_fname" id="eclassroom_name" required placeholder="" value="<?php echo $row['user_name']; ?>" readonly> -->
                       
                  </div>
              </div>
              <div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 0 0 5px; margin: 0; background-color: whitesmoke; ">
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Lastname</label><br>
                      <label style="font-size: 1rem;" for="fname"><?php echo $row['last_name']; ?></label>

                   
                       
                  </div>
              </div>
              <div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 0 0 5px; margin: 0; background-color: whitesmoke; ">
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
         <div class="row" style="margin: 1%;">
         <div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 0 0 5px; margin: 0; background-color: whitesmoke; ">
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Status</label><br>
                      <label style="font-size: 1rem;" for="fname"><?php echo $row['appointment_payment_status']; ?></label>   
                  </div>
              </div>
              <div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 0 0 5px; margin: 0; background-color: whitesmoke; ">
                   <div class="form-group">
                      <label style="font-size: 1rem; font-weight: bold;" for="fname">Staff Asigned</label><br>
                      <?php
                       $qStaffSched = "select * from staff_schedule_tbl where appointment_idfk = '$userid'";
                        $resStaffScehd = mysqli_query($con, $qStaffSched);
                        $rowresStaffScehd = mysqli_fetch_assoc($resStaffScehd);
                        $getStaffId = $rowresStaffScehd['staff_idfk'];
                        $staff_schedule_id = $rowresStaffScehd['staff_schedule_id'];

                        $qStaff = "select * from staff_tbl where staff_id = '$getStaffId'";
                        $resStaff = mysqli_query($con, $qStaff);
                        $rowresStaff = mysqli_fetch_assoc($resStaff);
                      ?>
                      <input type="hidden" name="" id="getStaffIdDs" value="<?php echo $getStaffId ?>">

                      <input type="hidden" name="" id="getStaffIdD" value="<?php echo $staff_schedule_id ?>">
                      <label style="font-size: 1rem;" for="fname"><?php echo  $rowresStaff['staff_fname']. ' ' .$rowresStaff['staff_lname'] ; ?></label>   
                  </div>
              </div>

              <div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 0 0 5px; margin: 0; background-color: whitesmoke; ">
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
      <div class="row" style="margin: 2%;">

      <div class="col-md-12 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 0 0 5px; margin: 0; background-color: whitesmoke; ">
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
                        <label style="font-size: 1rem; text-shadow: 2px 2px 5px green; text-transform: capitalize; text-decoration: underline;" for="fname"><?php echo $rowrCheckpetNameId['pet_name']; ?></label>

                        <br><label style="font-size: 1rem; font-weight: bold; padding: 5px; " for="fname">Age:</label>
                         <label style="font-size: 1rem; text-shadow: 2px 2px 5px green; text-decoration: underline;" for="fname"><?php echo $rowrCheckpetNameId['pet_age'].'Months'; ?></label>
                         <br><label style="font-size: 1rem; font-weight: bold;  padding: 5px; " for="fname">Type:</label>
                         <label style="font-size: 1rem; text-shadow: 2px 2px 5px green; text-transform: capitalize; text-decoration: underline; " for="fname"><?php echo $rowrCheckpetNameId['pet_type']; ?></label>
                         <br><label style="font-size: 1rem;  padding: 5px; font-weight: bold;" for="fname">Breed:</label>
                         <label style="font-size: 1rem; text-shadow: 2px 2px 5px green; text-transform: capitalize; text-decoration: underline;" for="fname"><?php echo $rowrCheckpetNameId['pet_breed']; ?></label>
                         <br>
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
                                         <label style="font-size: 1rem; font-weight: bold; " for="fname">Category:</label>

                                        <label class="" style="font-size: 1rem; text-shadow: 2px 2px 5px green; text-transform: capitalize; text-decoration: underline;" for="fname"><?php echo $rowreCheckcatId['category_name']; ?></label><br>
                                        <label class="ms-2" style="font-size: 1rem; font-weight:bold; font-style: bold;" for="fname">Services:</label><br>
                                        <?php

                                     }

                                }

                                
                                $SumConsume += $rowreCheckServId['services_tconsume'];

                              ?>
                               <label class="ms-2" style="font-size: 1rem; text-shadow: 2px 2px 5px green; text-transform: capitalize; text-decoration: underline;" for="fname"><?php echo $rowreCheckServId['services_name']; ?></label><br>

                                 <!-- <input type="text" name="timeConsume[]" value="<?php echo $SumConsume; ?>"> -->



                             <?php

                        }

                    
                    }

                     ?>
                   
                  </div>
              </div>
            <div class="col-md-6 mt-4" style="justify-content:center; align-items: center; text-align: center">
                 <label style="font-size: 1rem; font-weight: bold; " for="fname">Proof of Payment</label><br>
                   <img src="../images/<?php echo $row['appointment_payment_proof']; ?>" style="max-width: 80%; height: auto; ">  
            </div>



        </div>
        <div class="row" style="margin: 2%;" >
            <div class="col-md-5">
                <input type="hidden" name="SumConsume" value="<?php echo $SumConsume ?>">
                <select class="form-control" id="ChooseActionId" onchange="ChooseAction()">
                    <option hidden >Choose Action</option>
                    <option value="approve"  >Approve</option>
                    <option value="cancel"  >Cancel</option>
                </select>
            </div>
            
        </div>
        <div class="row" id="ans1">
            
            
        </div>
         
    
                   

  </form>


<script type="text/javascript">


function ChooseAction(){
      
      var x = document.getElementById("ChooseActionId").value;
      // document.getElementById("potek").disabled = true;
     
     // alert(x);

      var staaffId = document.getElementById("getStaffIdDs").value;

      var braId = document.getElementById("braIdd").value;

      var y = document.getElementById("schedId").value;
      var z = document.getElementById("appointID").value;

        $.ajax({
                url:"appointment_showaction.php",
                method:"POST",
                data:{
                  id: x,
                  schedId: y,
                  appointID: z,
                  braIdd: braId,
                  staaffId:staaffId

                },
                success: function(data){
                  $("#ans1").html(data);

                }
              })

      }

$(document).on('submit', '#appointAssign', function(e) {
      e.preventDefault();
        var form =$('#appointAssign')[0];
        var formdata = new FormData(form);
        $.ajax({
    type: 'POST',
    url:'appointment_assign.php',
    data: formdata,
    contentType: false,
    processData: false,
   success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
            $('#memViewAppointmentModal').modal('hide');
            
              swal("Succes", "Appointment Assigned", "success");

              setTimeout(function() {
                  location.reload();
              }, 1000);


            }
            
            else if (status == 'occupied') {
              
             swal("Error", "Please Choose Another Time", "error");


            }
            else if (status == 'already') {
              
             swal("Error", "Appointment Already Assigned", "error");


            }
            
            
             else if (status == 'false') {
              
              swal("Error", "Staff Added Error", "error");
            }
          }
    
  });
         
    });


</script>
 
 
<?php } 


?>
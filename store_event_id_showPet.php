<?php
// Start the session (if not already started)
session_start();
 include("connect.php");
  include("functions.php");
 $checkBranch  = $_SESSION['branch_idd'];
if (isset($_POST['event_id'])) {
    // Sanitize and store the event_id in a session variable
    $even_id = $_POST['event_id'];

    $clientId =  $_SESSION['client_id'];
    $query2 = "select * from users_balagtas where user_id = '$clientId' limit 1";
    $result2 = mysqli_query($con, $query2);

       $user_data = mysqli_fetch_assoc($result2);

       $fname = $user_data['user_name'];
       $user_id = $user_data['id'];
// show pet
       
        $queryCheckPet = "select * from pets where pet_user_id = '$user_id'";
        $resqueryCheckPet = mysqli_query($con, $queryCheckPet);
if(mysqli_num_rows($resqueryCheckPet) > 0)
{
  ?>
  <div class="col-md-12 mt-4">
        <div class="col-md-4">
          <input type="hidden" id="schedId2" value="<?php echo $even_id ?>">
    <label>Select Pet:</label>
    

    
     <select class="form-control" id="selectPetd" onchange="selectPet()" name="">
         <option hidden>Choose</option>
        <?php
        $queryPet = "select * from pets where pet_user_id = '$user_id'";
        $resqqueryPet = mysqli_query($con, $queryPet);
        while($rowresqqueryPet = mysqli_fetch_assoc($resqqueryPet))
        {
            ?>
            <option value="<?php echo $rowresqqueryPet['id'] ?>"><?php echo $rowresqqueryPet['pet_name'] ?></option>
            <?php
        }
        ?>
         <option value="newPet">New pet</option>
        </select>
            
        </div>
        
    </div>
      <div class="row" id="ansShowStaff">
       
    </div>

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
    <?php

}
else
{
  // walang pet

  ?>

 <div class="col-md-12 mt-4">
        <div class="col-md-4">
    <label>Select Staff:</label>
    
<input type="hidden" id="schedId2" value="<?php echo $even_id ?>">
    
     <select class="form-control" id="selectStaffId" onchange="selectStaff()" name="">
         <option hidden>Choose</option>
        <?php
        $queryBranch = "select * from staff_tbl where staff_isactive = '1' AND staff_branch = '$checkBranch '";
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
 <form  id='FormModal'  method="post" enctype="multipart/form-data">
  <input type="hidden" name="MypetNa" value="0">
      <div class="row" id="ans2">
       
    </div>

<!-- ID -->
               <div class="input-group">
                <div class="input-group-prepend">
                  <p style="font-size: 18px;" id="eventDetails"></p>
                </div>
               
              </div>


<!-- ID TIME  -->
              <div class="input-group">
                <div class="input-group-prepend">
                  <input type="hidden" name="event-id" id="event-id" value="<?php echo $even_id; ?>">
                </div>
             
              </div>


             
<!--  TIME  -->

              <div class="input-group">
                <div class="input-group-prepend">
                  <input type="hidden" name="vent-startTimee" id="event-startTime" value="">
                </div>
             
              </div>
<!-- userID -->
               
<!-- date -->
               <div class="input-group">
                <div class="input-group-prepend">
                  <input type="hidden" name="event-start" id="event-start" value="">
                </div>
              </div>
<!-- howmany pets -->
               
             
              <div  class="row gy-1">
      
        <div class="row row0-5">  

            <div class="col-md-3">
               <div class="form-group">
                  <label for="">Pet Name <label style="color:red; font-size: 1.2rem;">*</label></label>
                  <input type="hidden" class="form-control"  name="userid" value="<?php echo $user_id; ?>">
                   <input type="hidden" class="form-control"  name="petid1[]" value="0">
                  <input type="text" class="form-control"  name="nchild_name1[]" required>
                  <input type="hidden" class="form-control"  name="pet1" value="pet1">   
                   

                                    
              </div>  
            </div>
             <div class="col-md-2">
                <div class="form-group"> 
                 <label for="gender">Gender <label style="color: #435D7D;"></label> <label style="color:red; font-size: 1.2rem;">*</label></label>
                  <select name="nchild_kasarian1[]"  class="form-control" required="required">
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                 </select> 
              </div>       
            </div> 
             <div class="col-md-2">
                <div class="form-group">
                <label for="dob">Date of Birth<label style="color: #435D7D;"></label><label style="color:red; font-size: 1.2rem;">*</label></label>
                <input type="date" class="form-control" name="nchild_birthday1[] " required>
              </div>       
            </div>
              <div class="col-md-2">
                <div class="form-group"> 
                 <label for="gender">Pet Type <label style="color: #435D7D;"></label> <label style="color:red; font-size: 1.2rem;">*</label></label>
                  <select name="petType1[]"  class="form-control" required="required">
      
                  <option value="cat">Cat</option>
                    <option value="dog">Dog</option>
                     <option value="fish">Fish</option>
                     <option value="rabbit">rabbit</option>
                      <option value="bird">bird</option>
                      <option value="reptile">reptile</option>
                 </select> 
              </div>       
            </div> 
              <div class="col-md-3">
                <div class="form-group">
                <label for="dob">Breed(optional)<label style="color: #435D7D;"></label><label style="color:red; font-size: 1.2rem;"></label></label>
                <input type="text" class="form-control" name="breed1[] ">
              </div>       
            </div>
              <div class="form-group" id="">
                                      <label style="font-size: 1.5rem;" for="fname">Services List</label>
                                      <div class="row" id="ShowOrder">
                                        
                                      </div>
                                     
                                       
                                  </div>


            <?php
 $queryCategory = "SELECT * FROM services_tbl join category_tbl on services_tbl.category_idfk = category_tbl.category_id WHERE services_isactive = '1'";
$resQueryCategory = mysqli_query($con, $queryCategory);

$categories = array(); // Array to store unique category names

while ($rowCategory = mysqli_fetch_assoc($resQueryCategory)) {
    $categoryName = $rowCategory['category_name'];
    $category_id = $rowCategory['category_id'];
    $serviceName = $rowCategory['services_name'];
    $price = $rowCategory['services_price'];
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
<div class="row mt-2">
  <div class="col">
    <?php
    $index = 0;
    foreach ($categories as $categoryName => $services) {
      if ($index % 2 == 0) {
        ?>
        <h5 style="color:#210062   ; font-size:1.5 rem; background-color:;"><?php echo $categoryName ?></h5>
        <?php
    
        foreach ($services as $service) {

          ?>
          <div class="mt-1 mb-3 shadow p-3 bg-info rounded" style="background-color:whitesmoke; border: 1px solid skyblue; font-size:1.2rem;">
           <input type="checkbox" name="cat1[]" value="<?php echo $service['servId'] ?>" style="transform: scale(1.2); "> 

<input type="hidden" name="servicesName1[]" value="<?php echo $service['name'] ?>">
<label style="width:50%; color: #044350;"><?php echo $service['name'] ?></label>

<!-- <label>₱<?php echo $service['price'] ?></label><br> -->
            
          </div>

          <?php
          


        }
      }
      $index++;
    }
    ?>
  </div>
  <div class="col">
    <?php
    $index = 0;
    foreach ($categories as $categoryName => $services) {
      if ($index % 2 != 0){
        ?>
        <h5 style="color:#210062  ; font-size:1.5 rem; background-color:;"><?php echo $categoryName ?></h5>
        <?php
    
        foreach ($services as $service) {

          ?>
          <div class="mt-1 mb-3 shadow p-3 bg-info rounded" style="background-color:darkblue; border: 1px solid skyblue; font-size:1.2rem;">
           <input type="checkbox" name="cat1[]" value="<?php echo $service['servId'] ?>" style="transform: scale(1.2);"> 
<input type="hidden" name="servicesName1[]" value="<?php echo $service['name'] ?>">
<label style="width:50%;"><?php echo $service['name'] ?></label>

<!-- <label>₱<?php echo $service['price'] ?></label><br> -->
            
          </div>

          <?php
          


        }
      }
      $index++;
    }
    ?>
  </div>
</div>

             <div class="col-md-6 mt-2">
                <div class="form-group">              
                <a href="javascript:void(0)" class="add-more-form-0-51 float-left btn btn-primary" id="addpet1">ADD PET</a>

               <!--<button type="button" class="remove-btn-mybtnn btn btn-danger">Remove</button>-->
                 </div>    
            </div>         
      </div>
     
      <div class="paste-new-forms_0-5"></div>
 
        </div>
           
              <div class="input-group mb-3 col-12">          
              </div>
                <div class="mb-3 col-md-12" style="text-align: center;">    
                
                  <img src="img/sampleqr.png" style="max-width: 60%; height: auto;">  
               

              </div>
             <div class="">
              <style type="text/css">
                .col-2-custom {
  width: 40%;
}
              </style>
              <center>
                
                <label for="">Please Pay the Appointment Fee ₱20.00 And Upload Proof of Payment</label>
                <input type="file" name="qrpic" class="form-control col-2-custom">
                <div class="modal-footer">
                <div class="modal-body text-center"> <!-- Center align the content -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                  Terms and Conditions
                </button>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Terms and Conditions</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                
            </div>
            <div class="modal-body" style="font-weight: bold;display: block;
  margin-top: 1em;
  margin-bottom: 1em;
  margin-left: 0;
  margin-right: 0;" align="left">
                <!-- Content goes here -->
                <p>⚫ Please note that you are expected to come 5 minutes earlier than scheduled.
                Our policy is first-come, first-served and will prioritize emergencies.
                </p>
                <p>⚫ Appointment fee is rebateable upon successful transaction in clinic.</p>
                <p>⚫ After sending appointment fee, please upload proof of payment.
                      You will receive an email and notification on system regarding to status of your appointment.
                </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="$('#exampleModalCenter').modal('hide');">Got it!</button>
            </div>
        </div>
    </div>
</div>

              </center>
            </div>




                <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
            </form>

            <script type="text/javascript">
              function selectStaff(){
      
      var x = document.getElementById("selectStaffId").value;
      // document.getElementById("potek").disabled = true;
     
 var y = document.getElementById("schedId2").value;
      
     // alert(x);
        $.ajax({
                url:"store_event_id_showStaff.php",
                method:"POST",
                data:{
                  id: x,
                  schedIdd: y
               
                },
                success: function(data){
                  $("#ans2").html(data);

                }
              })

      }

      //


            </script>
            <?php

  // end walng pet

}

   ?>    
           
<?php

} 
else 
{
   
}
?>

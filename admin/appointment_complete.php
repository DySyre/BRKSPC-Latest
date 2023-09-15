<?php 
 include 'include/header.php';
 include '../connect.php';
 
$CompletId = $_POST['id'];
$userid = $_POST['idx'];
$sameIdAppoint = $_POST['sameIdAppoint'];
$StaffIdD = $_POST['StaffIdD'];


$price2Sum = 0;

if($CompletId == 'complete')
{
   $sql = "SELECT * FROM `appointment_tbl` JOIN users_balagtas ON appointment_tbl.pet_ownerid = users_balagtas.id JOIN schedule_tbl ON appointment_tbl.appointment_date = schedule_tbl.schedule_id  WHERE appointment_payment_status = 'approved' and `appointment_payment_id` =".$userid;
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result)
 ){

  
// // SQL query to copy data from appointment to notification id to
// $sql = "INSERT INTO notification (user_petnotifid)
//         SELECT user_id
//         FROM users_balagtas";

// if ($con->query($sql) === TRUE) {
//     echo "Data copied successfully.";
// } else {
//     echo "Error copying data: " . $con->error;
// }

// // Close the connection
// $con->close();


// // SQL query to copy data from appointment to notification subject head to
// $sql = "INSERT INTO notification (n_sub)
//         SELECT appointment_payment_status
//         FROM appointment_tbl";

// if ($con->query($sql) === TRUE) {
//     echo "Data copied successfully.";
// } else {
//     echo "Error copying data: " . $con->error;
// }

// // Close the connection
// $con->close();


// // SQL query to copy data from appointment to notification message to body
// $sql = "INSERT INTO notification (n_msg)
//         SELECT appointment_coment
//         FROM appointment_tbl";

// if ($con->query($sql) === TRUE) {
//     echo "Data copied successfully.";
// } else {
//     echo "Error copying data: " . $con->error;
// }

// // Close the connection
// $con->close();
// ?>


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
                      <input type="hidden" id="sameIdAppoint" name="sameIdAppointid" value="<?php echo $sameIdAppoint ?>">
                       <input type="hidden" id="StaffIdDd" name="StaffIdDdName" value="<?php echo $StaffIdD ?>">
                      
                 
                      <input type="hidden" id="schedId" name="schedId" value="<?php echo $row['schedule_id'] ?>">
                      <input type="hidden" id="appointID" name="appointID" value="<?php echo $row['appointment_payment_id'] ?>">
                      <input type="hidden" id="schedId" name="pet_ownerid" value="<?php echo $row['pet_ownerid'] ?>">
                        <input type="hidden" id="schedId" name="emailuser" value="<?php echo $row['email'] ?>">

                        <input type="hidden" name="appointMentID" value="<?php echo $userid ?>">
                  </div>
              </div>
        </div>
      <div class="row" style="margin: 2%;">

            <div class="col-md-11 mt-4" style=" margin: 20px; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
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
                        <input type="hidden" name="petId[]" value="<?php echo $rowrCheckpetNameId['id']; ?>"><br>
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

                                        <label class="" style="font-size: 1rem; font-weight:bold; font-style: italic;" for="fname"><?php echo $rowreCheckcatId['category_name']; ?></label><br>
                                        <label class="ms-2" style="width: 20%; font-size: 1rem; font-weight:bold; font-style: italic;" for="fname">Services</label>
                                         <label class="" style="font-size: 1rem; font-weight:bold; font-style: italic; margin-left: 50px;" for="fname">Qty</label>
                                          <label class="" style="font-size: 1rem; font-weight:bold; font-style: italic; margin-left: 80px;" for="fname">Price</label>
                                          <label class="" style="font-size: 1rem; font-weight:bold; font-style: italic; margin-left: 80px;" for="fname">Amount</label><br>
                                        <?php

                                     }

                                }

                                  
                                 $price2 =  $rowreCheckServId['services_price'];

                                 $price2Sum +=  $price2;
                               
         
                              ?>
                              <input type="hidden" name="" class="" id="priceID<?php echo $rowreCheckServId['pet_services_his_id']; ?>"  value="<?php echo $price2; ?>" readonly>
                                 <label class="ms-2" style="width: 20%; font-size: 1rem;" for="fname"><?php echo $rowreCheckServId['services_name']; ?></label>
                          

                                    <input type="number" style="width: 7%; margin-left: 50px;" name="qty[]" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1" onchange="StockChange('<?php echo $rowreCheckServId['pet_services_his_id']; ?>')" id="Quanti_<?php echo $rowreCheckServId['pet_services_his_id']; ?>">

                              <input type="hidden" name="services_id[]" style="width: 7%;" id="" value="<?php echo $rowreCheckServId['services_id']; ?>">

                                 <input type="text" name="" style="background-color: transparent; width: 10%; margin-left: 50px; border: none;"  id="price" value="₱<?php echo $rowreCheckServId['services_price']; ?>">

                                 <input type="hidden" name="pricess[]" style="background-color: transparent; width: 10%; margin-left: 50px; border: none;"  id="" value="<?php echo $rowreCheckServId['services_price']; ?>">


                                 <input type="text" name="" class="" style="background-color: transparent; width: 10%; margin-left: 50px; border: none;" id="priceIDd<?php echo $rowreCheckServId['pet_services_his_id']; ?>"  value="₱<?php echo number_format($price2,2); ?>" readonly>

                                 <input type="hidden" name="amount[]" class="price" style="background-color: transparent; width: 10%; margin-left: 50px; border: none;" id="priceIDdd<?php echo $rowreCheckServId['pet_services_his_id']; ?>"  value="<?php echo $price2; ?>" readonly>

    

                                 <br>


                                  <script type="text/javascript">
                                      

function StockChange(pid) {
  var quantity = document.getElementById("Quanti_" + pid).value;
  var pricePro = document.getElementById("priceID" + pid).value;

  var totalPrice = quantity * pricePro;

  document.getElementById("priceIDdd" + pid).value = totalPrice;
  totalPrice = totalPrice.toLocaleString(undefined, {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  });

  
  document.getElementById("priceIDd" + pid).value = "₱" + totalPrice;

  
calculateTotal();

   
  
}

function calculateTotal() {
  var priceElements = document.getElementsByClassName("price");
  var totalAmount = 0;

  for (var i = 0; i < priceElements.length; i++) {
    var price = parseFloat(priceElements[i].value);
    if (!isNaN(price)) {
      totalAmount += price;
    }
  }

  var formattedTotal = totalAmount.toLocaleString(undefined, {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  });

   document.getElementById("totalAmountInput").value = "₱" + formattedTotal;
  document.getElementById("totalAmountInput2").value = totalAmount;

console.log(totalAmount);
}

function CashChange(){

    var cash = document.getElementById("cashAmountId").value;
    var totalAmount = document.getElementById("totalAmountInput2").value;


    var bal =  cash-totalAmount;

  document.getElementById("changeBalAmountId").value = bal;





}






 


      

  </script>
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
             <div class="col-md-11 mt-4" style=" margin: 20px; padding: 10px;  justify-content: center; text-align: center; align-items: center;">
                <div class="form-group">              
                <a href="javascript:void(0)" class="add-more-services float-right btn btn-primary" id="addServ">ADD SERVICES</a>
               

               <!--<button type="button" class="remove-btn-mybtnn btn btn-danger">Remove</button>-->
                 </div>       
            </div> 
        </div>
         <div class="row paste-new-services">

            
           </div>

        <div class="row" style="margin: 2%; padding: 10px;">
            <div class="col-md-11 mt-4" style=" margin: 20px; color: blue; font-weight: bold; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
                <label>TOTAL:</label>
              <input type="text" id="totalAmountInput" name=""  style="background-color: transparent; color: red; width: 15%; margin-left: 100px; border: none;" readonly value="₱<?php echo $price2Sum ?>">

              <input type="hidden" id="totalAmountInput2" name="grandTotal"  style="background-color: transparent; width: 15%; margin-left: 50px; border: none;" readonly value="<?php echo $price2Sum ?>">


            </div>

             <div class="col-md-11 mt-4" style=" margin: 20px; color: green; font-weight: bold; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
                <label>PAYMENT:</label>
              <input type="text" id="cashAmountId" name="cashAmount" onchange="CashChange()" style="width: 15%; margin-left: 80px;" iredrequ>

              
            </div>

            <div class="col-md-11 mt-4" style=" margin: 20px; font-weight: bold; padding: 10px; box-shadow: 10px 5px #888888; margin: 0; background-color: whitesmoke; ">
                <label>CHANGE/BAL:</label>
              <input type="text" id="changeBalAmountId" name="changeBalAmount"  style="background-color: transparent; color: blue; width: 15%; margin-left: 45px; border: none;"  value="" readonly>

               
            </div>
            <label for="noteName" style="color: blue; font-weight: bold;">Note:</label>
            <div class="col-md-11 mt-4" >
            
                 <style>
    /* Style the textarea element */
    textarea {
      width: 300px; /* You can adjust this value to set the desired width */
      height: 150px; /* You can adjust this value to set the desired height */
      resize: none; /* Prevent resizing of the textarea by the user */
      /* You can also set other CSS properties like font-size, padding, etc. here */
    }
  </style>
               
                <textarea name="noteName" id="noteName"></textarea>
                
            </div>
            
            
        </div>
       
          
       
        <div class="row">
            <div class="col-md-12">
                 <div class="modal-footer">
                    <input type="hidden" name="approvedName" value="0">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       <button type="submit"  class="btn btn-primary">Save</button> 
       </div>  
            </div>

         
        </div>
  
    
         
    
                   


 

  <?php
}

}
else if($CompletId == 'Cancel')
{
    $sql = "SELECT * FROM `appointment_tbl` JOIN users_balagtas ON appointment_tbl.pet_ownerid = users_balagtas.id JOIN schedule_tbl ON appointment_tbl.appointment_date = schedule_tbl.schedule_id  WHERE appointment_payment_status = 'approved' and `appointment_payment_id` =".$userid;
     $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result);
    ?>
    <div class="row">
            <div class="col-md-4">
                   <div class="form-group">
                    <?php
                    $date = $row['schedule_date'];
                    $dateOnly = date('d-m-Y', strtotime($date));
                    $daayOnly = date('l', strtotime($dateOnly));
                    ?>
                      <input type="hidden" id="sameIdAppoint" name="sameIdAppointid" value="<?php echo $sameIdAppoint ?>">
                       <input type="hidden" id="StaffIdDd" name="StaffIdDdName" value="<?php echo $StaffIdD ?>">
                      
                 
                      <input type="hidden" id="schedId" name="schedId" value="<?php echo $row['schedule_id'] ?>">
                      <input type="hidden" id="appointID" name="appointID" value="<?php echo $row['appointment_payment_id'] ?>">
                      <input type="hidden" id="schedId" name="pet_ownerid" value="<?php echo $row['pet_ownerid'] ?>">
                        <input type="hidden" id="schedId" name="emailuser" value="<?php echo $row['email'] ?>">

                        <input type="hidden" name="appointMentID" value="<?php echo $userid ?>">
                  </div>
              </div>
        </div>

    <div class="col-md-12">
     <label >Reason/Comment</label>
     <br>
     <!-- <input type="text-area" name=""> -->
     <textarea rows="4" cols="50" name="ReasonNmae1"></textarea>



 </div>

  <div class="row">
            <div class="col-md-12">
                 <div class="modal-footer">
                    <input type="hidden" name="cancelA" value="0">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       <button type="submit"  class="btn btn-primary">Save</button> 
       </div>  
            </div>

         
        </div>
    <?php

}
 ?>


 <script type="text/javascript">
     
     
$(document).on('submit', '#billForm', function(e) {
      e.preventDefault();
        var form =$('#billForm')[0];
        var formdata = new FormData(form);
        $.ajax({
    type: 'POST',
    url:'appointment_complted_insert.php',
    data: formdata,
    contentType: false,
    processData: false,
   success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
            $('#memViewAppointmentModal2').modal('hide');
            
              swal("Succes", "Appointment Completed", "success");
              setTimeout(function() {
                  location.reload();
              }, 1000);


            }
            else if (status == 'already') {
              
             swal("Error", "Appointment Completed", "error");


            }
            else if (status == 'refund') {
              
             swal("Succes", "Appointment Cancel", "success");
              setTimeout(function() {
                  location.reload();
              }, 2000);


            }
            
            
             else if (status == 'false') {
              
              swal("Error", "Appointment Completed Error", "error");
            }
          }
    
  });
         
    });

$(document).ready(function(){
     $(document).on('click','.remove-btn-mybtnn', function(){

                $(this).closest('.row0-5').remove();
             document.getElementById("addServ").disabled= false;

          });
     $(document).on('click', '.add-more-services', function() {

        document.getElementById("addServ").disabled= true;

   $('.paste-new-services').append('<div class="row row0-5">\
                      <div class="col-md-7">\
                       <select class="form-control" name="ecatId" id="servChange" onchange="selectDep()" required>\
                        <option hidden>Choose</option>\
                      <?php
                      $queryBranch = "select * from category_tbl JOIN services_tbl ON category_tbl.category_id = services_tbl.category_idfk where category_isactive = '1'";
                        $resqueryBranch = mysqli_query($con, $queryBranch);

                        while($rowBranch = mysqli_fetch_assoc($resqueryBranch))
                        {
                           
                            ?>
                           <option value="<?php echo $rowBranch['services_id'] ?>"><?php echo $rowBranch['category_name']. ': ' .$rowBranch['services_name']  ?></option>\
                            <?php

                        }
                      ?>
                        </select>\
            </div>\
            <div class="row" id="ansSer"></div>\
            <div class="col-md-6 mt-2">\
                <div class="form-group">\
               <button type="button" class="remove-btn-mybtnn btn btn-danger">Remove</button>\
            </div>\
            </div>\
      </div>');
      });
      });



 function selectDep(){
      
      var x = document.getElementById("servChange").value;
 
 console.log(x);
     
    $.ajax({
                url:"Showservices.php",
                method:"POST",
                data:{
                  id: x
                },
                success: function(data){
                  $("#ansSer").html(data);

                }
              })

      }
 </script>
 
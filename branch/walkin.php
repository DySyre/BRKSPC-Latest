<?php 
 include 'include/header.php';
 include '../connect.php';

$branchID  = $_SESSION['branch_idd'];

$orderNumber  = (rand(0000000000,9999999999));

$sql = "DELETE FROM pos_order_list_tbl";
$delQuery =mysqli_query($con,$sql);

$sql2 = "DELETE FROM pos_purchase_tbl";
$delQuery2 =mysqli_query($con,$sql2);
$noApp = 'maybe';
 ?>


 <main class="mt-5 pt-4">
     <div class="row">

        <div class="container">
 <div class="input-group">
    
                     <!-- <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addStaffModal" class="btn btn-primary btn-sm me-md-2">ADD STAFF</a> -->
                
                </div>
               
  
            <div class="container-fluid mt-2" >

              <form id="MYformS">
              <div class="row">
                            <div class="col-xl-6" style="background-color:; height: 20vh;">
                                <div class="card">
                                    <div class="card-header">
                                        <input type="hidden" name="branchIDName" value="<?php echo $branchID ?>">
                                        <h3>Walk In Form</h3>
                                        <input type="hidden" id="orderNumId" value="<?php  echo $orderNumber;?>" name="ordernumberName">
                                    </div>
                                    <div class="card-body">
                                      <!-- <canvas id="myAreaChart" width="100%" height="40"></canvas> -->
                                   
                                   <div class="row">

                                    <div class="col-md-6">
                                  
                                      <label style="font-size: 1rem;" for="fname">Firstname</label>

                                     <input type="text" name="custfName" required class="form-control" placeholder="">
                                      
                                    </div>
                                      <div class="col-md-6">
                                      
                                     
                                      <label style="font-size: 1rem;" for="fname">Lastname</label>

                                     <input type="text" name="custlName" required class="form-control" placeholder="">
                                      
                                    </div>
                                     
                                       
                                  </div>
                                    <div class="row">

                                    <div class="col-md-12 mt-3">
                                  
                                      <label style="font-size: 1rem;" for="fname">Email</label>
                                     

                                     <input type="email" name="custeName" required class="form-control" placeholder="">
                                      
                                    </div>
                                    
                                     
                                       
                                  </div>
              

                                    </div>
                                </div>
                                
                                <div class="card mb-4" style="height:68vh;">
                                    <div class="card-body">
                                      <!-- <canvas id="myAreaChart" width="100%" height="40"></canvas> -->
                                   
                                   <div class="form-group" id="">
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
                                 
    <div class="col-md-4 mb-2">
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
    <ul id="selectedValue"></ul>
   
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

                                          
                                      
            </div>

                                </div>
                              </div>
                            </div>

                        </div>
                       
                         
                        
            </div>
            
        </div>
         
     </div>              
</main>
<!-- modal -->

 <!-- Add user Modal -->
  <div class="modal fade " id="addStaffModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ADD STAFF</h5>
          <h1></h1>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
        </div>
       

      </div>
    </div>
  </div>

  <div class="modal fade" id="memViewAppointmentModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Appointment Details</h4>
                        </div>
                        <div class="modal-body modalresponseViewAppointment">
                       
                        </div>
                    </div>
                </div>
        </div>

        <style type="text/css">
          .flat-button {
    background-color: transparent;
    border: solid 1px black;
    color: #000;
    cursor: pointer;
    padding: 0;
    font-size: 14px;
    margin-left: 5px;
    padding: 2px;
    /* Add any other styles you want */
}
        </style>
<!-- modal -->
  <!-- <script src="./js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>
    <script src="../js/script.js"></script>

    <script type="text/javascript">


    


//       $(document).ready(function() {
//   $('#tabledataSale').DataTable({
//     "fnCreatedRow": function(nRow, aData, iDataIndex) {
//       $(nRow).attr('id', aData[0]);
//     },
//     'serverSide': true,
//     'processing': true,
//     'paging': false,
//     'ordering': false,
//     'scrollY': '300px', // Adjust the height as needed
//     'scrollCollapse': true,
//     'ajax': {
//       'url': 'pos_fetch.php',
//       'type': 'post',
//     },
//     "columnDefs": [{
//       "targets": [3],
//       "sortable": false,
//     }]
//   });
// });

      

function addSelectedValue(selectElement) {
    var selectedOptions = Array.from(selectElement.selectedOptions);
    var selectedValues = selectedOptions.map(option => option.value);
    var selectedTexts = selectedOptions.map(option => option.textContent);
    var selectedValueList = document.getElementById("selectedValue");

    selectedValues.forEach((value, index) => {
        var newItem = document.createElement("li");
        newItem.textContent = selectedTexts[index];

        // Create a hidden input field to store the value
        var hiddenInput = document.createElement("input");
        hiddenInput.type = "text";
        hiddenInput.value = value;
        hiddenInput.name = "selectedValues[]";
        hiddenInput.class = ""; 
        hiddenInput.style.display = "none"; 

        // Create a remove button for the item
        var removeButton = document.createElement("button");
        removeButton.textContent = "x";
       removeButton.className = "flat-button"; // Add a class name for styling 
        removeButton.addEventListener("click", function() {
            this.parentNode.remove(); // Remove the item when the button is clicked
        });

        newItem.appendChild(hiddenInput);
        newItem.appendChild(removeButton);
        selectedValueList.appendChild(newItem);
    });
}

$(document).on('submit', '#MYformS', function(e) {
      e.preventDefault();
        var form =$('#MYformS')[0];
        var formdata = new FormData(form);
 swal({
  title: "Are you sure You Want To Proceed?",
  text: "",
  icon: "warning",
   buttons: {
      cancel: "No",
      confirm: "Yes"
    },
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    $.ajax({
      type: 'POST',
    url:'walkin_insert.php',
    data: formdata,
    contentType: false,
    processData: false,
   success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
        
              swal("Succes", "Staff Added", "success");


            }
            else if (status == 'already') {
              
             swal("Error", "Staff Already Exist", "error");


            }
           else  if (status == 'occupied') {
              
             swal("Error", "Time is occupied! Please Select Another Time.", "error");


            }
            
            
             else if (status == 'false') {
              
              swal("Error", "Staff Added Error", "error");
            }
          }
        
        });
   
  } else {
    return null;
    swal("Your file is safe!");
  }
});    
         
    });

function submitSelectedValues() {
    var selectedValueElements = document.querySelectorAll("#selectedValue li input[type='text']");
    var selectedValues = Array.from(selectedValueElements).map(input => input.value); // Get the values from the hidden input fields

    // Send the selected values to the server-side PHP script for database insertion
    var formData = new FormData();
    selectedValues.forEach(value => {
        formData.append("selectedValues[]", value);
        

        
    });

    // AJAX request to the PHP script
    $.ajax({
        url: 'walkin_insert.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
          
              swal("Succes", "Success", "success");


            }
            else if (status == 'already') {
              
              swal("Error", "Time is occupied! Please Select Another Time.", "error");


            }
             if (status == 'occupied') {
              
             swal("Error", "Time is occupied! Please Select Another Time.", "error");


            }
            
            
            
             else if (status == 'false') {
              
              swal("Error", "Staff Added Error", "error");
            }
          }
        // success: function(response) {
        //     console.log(response); // Log the response from the PHP script
        // },
        // error: function(xhr, status, error) {
        //     console.error(error); // Log any errors
        // }
    });
}


     
function selectReserve(){
      
      var x = document.getElementById("reserveTimeId").value;

        $.ajax({
                url:"walkin_reserve_yes.php",
                method:"POST",
                data:{
                  id: x
                  
                },
                success: function(data){
                  $("#ans3").html(data);

                }
              })

      }

    

  </script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
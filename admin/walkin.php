<?php 
 include 'include/header.php';
 include '../connect.php';


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
                <div class="row col-md-4" style="justify-content: center; text-align: center; align-items: center;">
                  <select class="form-control" name="newStudSelectDepart" id="potek" onchange="selectDep()" required>
        <?php 
        include('connection.php');
        $res = mysqli_query($con,"SELECT * from branch_tbl where `branch_isactive` = '1' AND branch_id != '3'");
        while($row=mysqli_fetch_array($res))
        {
          ?>
          <option hidden>Choose</option>
          <option id="" value="<?php echo $row["branch_id"];?>"><?php echo $row["branch_name"];?></option>
          <?php
        }
        ?>
      </select>
                  
                </div>
  
            <div class="container-fluid mt-2" id= 'foms'>

                                          
                                      
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
        color: green;
        cursor: pointer;
        padding: 50px;
        font-size: 14px;
        margin-left: 100px;
        position: relative;
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

      function selectDep(){
      
      var x = document.getElementById("potek").value;
     
     
        $.ajax({
                url:"walkin_branch.php",
                method:"POST",
                data:{
                  id: x
                },
                success: function(data){
                  $("#foms").html(data);

                }
              })

      }

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
        removeButton.textContent = "❌";
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
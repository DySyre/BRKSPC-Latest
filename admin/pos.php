<?php 
 include 'include/header.php';
 include '../connect.php';


$orderNumber  = (rand(0000000000,9999999999));

$sql = "DELETE FROM pos_order_list_tbl";
$delQuery =mysqli_query($con,$sql);

$sql2 = "DELETE FROM pos_purchase_tbl";
$delQuery2 =mysqli_query($con,$sql2);
 ?>


 <main class="mt-5 pt-4">
     <div class="row">

        <div class="container">
 <div class="input-group">
    
                     <!-- <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addStaffModal" class="btn btn-primary btn-sm me-md-2">ADD STAFF</a> -->
                
                </div>
            <div class="container-fluid" >
              <div class="row">
                            <div class="col-xl-6" style="background-color: #EAD2D2; height: 100%; box-shadow: 5px 10px #888888;">
                                <div class="card">
                                    <div class="card-header" style="background-color: #EAD2D2; font-weight: bold; justify-content: center; align-items: center; text-align: center; font-size: 1.8rem;">
                                        <i class="fas fa-chart-area me-1"></i>
                                        POS
                                        <input type="hidden" id="orderNumId" value="<?php  echo $orderNumber;?>" name="ordernumberName">
                                    </div>
                                    <div class="card-body">
                                      <!-- <canvas id="myAreaChart" width="100%" height="40"></canvas> -->
                                   
                                   <div class="form-group" >
                                      <label style="font-size: 1.5rem; font-weight: bold;" for="fname">Select Item:</label>
                          <input type="text" class="form-control" id="searchInput" placeholder="Search for an item">
                                     

                                      <select class="form-control" name="ebranchIdSelectNmae" id="ebranchIdSelect" >
                                        <option hidden >Choose</option>
                                      <?php
                                      $queryBranch = "SELECT * FROM `item_tbl` join item_category_tbl ON item_tbl.item_categoryidfk = item_category_tbl.item_category_id JOIN branch_tbl ON item_category_tbl.item_category_branch = branch_tbl.branch_id where item_stock != '0'";
                                        $resqueryBranch = mysqli_query($con, $queryBranch);

                                        while($rowBranch = mysqli_fetch_assoc($resqueryBranch))
                                        {
                                           
                                            ?>
                                           <option value="<?php echo $rowBranch['item_id'] ?>"><?php echo $rowBranch['item_name'].': '. $rowBranch['item_category_name'].': '.$rowBranch['branch_name'] ?></option>
                                                
                                          
                                            <?php

                                        }
                                      ?>
                                        </select>
                                       
                                  </div>
              <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to filter the dropdown options based on user input
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#ebranchIdSelect option").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>

                                    </div>
                                </div>
                                
                                <div class="card mb-4 mt-4" style="height:68vh;">
                                    <div class="card-body">
                                      <!-- <canvas id="myAreaChart" width="100%" height="40"></canvas> -->
                                   
                                   <div class="form-group" id="">
                                      <label style="font-size: 1.5rem; font-weight:bold; " for="fname"><i class="fa-solid fa-cart-shopping"></i> Cart</label>
                                      
                                      <div class="row" id="ShowOrder">
                                       
                                        
                                      </div>
                                     
                                       
                                  </div>
              

                                    </div>
                                </div>
                            
                                 
                            </div>

                           <div class="col-xl-6" style="height: 90vh;">
                              <div class="card mb-4" style="height: 50vh; background-color: skyblue; font-weight: bold; font-size: 1.5rem; justify-content: center; align-items: center; text-align: center; box-shadow:  5px 10px #888888;">
                                <div class="card-header">
                                <i class="fa-solid fa-sort"></i>
                                  ORDER SUMMARY
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
          <form id="addStaff" method="post" enctype="multipart/form-data">
        <div class="row row0-5">
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Firstname</label>
                      <input type="text" class="form-control" name="fname" id="classroom_name" required placeholder="">
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Lastname</label>
                      <input type="text" class="form-control" name="lname" id="classroom_name" required placeholder="">
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Branch</label>
                       <select class="form-control" name="branchId">
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
              </div>
                <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Email</label>
                     <input type="email" class="form-control" name="email" id="classroom_name" required placeholder="">
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Password</label>
                     <input type="password" class="form-control" name="pass" id="classroom_name" required placeholder="">
                       
                  </div>
              </div>
          </div>
         
          
            
                                     
          
           
      <div class="form-group">  
      <br>      
                <button type="submit" name="btnSave" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> ADD</button>      
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>  
  </form>
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


 $(document).ready(function() {
  $('#tabledataSale').DataTable({
    "fnCreatedRow": function(nRow, aData, iDataIndex) {
      $(nRow).attr('id', aData[0]);
    },
    'serverSide': true,
    'processing': true,
    'paging': false,
    'ordering': false,
    'scrollY': '300px',
    'searching': false,
    'lengthChange': false,
    'ajax': {
      'url': 'pos_fetch.php',
      'type': 'post',
    },
    "columnDefs": [{
      "targets": [3],
      "sortable": false,
    }],
    "language": {
      "info": "",
      "infoEmpty": "",
      "emptyTable": "No data available",
      "zeroRecords": "",
      "paginate": {
        "previous": "Previous",
        "next": "Next"
      }
    }
  });
});


function itemSelected(){
      
      var x = document.getElementById("ebranchIdSelect").value;
      var orderNumIdd = document.getElementById("orderNumId").value;

      
   
        $.ajax({
                url:"pos_show_order.php",
                method:"POST",
                data:{
                  id: x,
                  orderNumId: orderNumIdd
                },
                success: function(data){
                  $("#ShowOrder").html(data);

                }
              })

      }
  
   

    $(document).on('submit', '#addStaff', function(e) {
      e.preventDefault();
        var form =$('#addStaff')[0];
        var formdata = new FormData(form);
        $.ajax({
    type: 'POST',
    url:'staff_insert.php',
    data: formdata,
    contentType: false,
    processData: false,
   success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
            $('#addStaffModal').modal('hide');
            mytable = $('#tabledataAppointment').DataTable();
            mytable.draw();
              swal("Succes", "Staff Added", "success");


            }
            else if (status == 'already') {
              
             swal("Error", "Staff Already Exist", "error");


            }
            
            
             else if (status == 'false') {
              
              swal("Error", "Staff Added Error", "error");
            }
          }
    
  });
         
    });



    $(document).on('click', '.deleteBtnClassroom', function(event) {
      var table = $('#tabledataAppointment').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      swal({
  title: "You want to delete this file?",
  text: "This file cannot be recovered!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    $.ajax({
          url: "staff_del.php",
          data: {
            id: id
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              mytable = $('#tabledataAppointment').DataTable();
            mytable.draw();
               swal("Succes","Staff has been deleted!", {
      icon: "success",
    });
             
            } else {
              swal("Error","file has not been deleted!", {
      icon: "error",
    });
            }
          }
        });
   
  } else {
    return null;
    swal("Your file is safe!");
  }
});

    });



  $('#tabledataAppointment').on('click', '.btnViewAppointment', function(event) {
      var table = $('#tabledataAppointment').DataTable();
      var trid = $(this).closest('tr').attr('id');
      var id = $(this).data('id');
     

      $.ajax({
        url: "appointment_editmem.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(response) {
            $('.modalresponseViewAppointment').html(response); 
            $('#memViewAppointmentModal').modal('show');
        }
      })
    });

    
    
   
    

  </script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
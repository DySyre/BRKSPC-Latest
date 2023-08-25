<?php 
 include 'include/header.php';
 include '../connect.php';

 ?>


 <main class="mt-5 pt-4">
     <div class="row">

        <div class="container" style="margin-left: 220px;">

            <div class="container-fluid">
              <div class="input-group">
    
                     <!-- <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addStaffModal" class="btn btn-primary btn-sm me-md-2">ADD STAFF</a> -->
                     <h2>Sale's History</h2>
                </div>

                  <div class="input-group">
    
                </div>
                

                <div class="table-responsive">
                     <style>
  .responsive-th {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
</style>
 <div class="row mb-1" >
    <div class="col-md-6">
      <form id="myFormSale">
      
    
          <div class="input-daterange" >

            <div class="col-md-2" style="display: inline-block;">
             <input type="date" name="start_date" id="start_date" class="form-control" />
            </div>
             <div class="col-md-2" style="display: inline-block;">
             <input type="date" name="end_date" id="end_date" class="form-control" />
            </div>
            </div>
            <div class="col-md-3 mt-1" style="display: inline-block;">
           <a href="javascript:void();"  class="btn btn-sm btnAddSales text-white btn-primary"  style="border: none; background-color:;"> Sales Search By Date</a>
           </div>
    </form>
    </div>
     <div class="col-md-6" id="ShowPruchases">
     
    </div>
    
  </div> 

<table id="tabledataStaff" class="table table">
  <thead>
    <th>Order Number</th>
    <th class="responsive-th">Item</th>
     <th>Price</th>
    <th>Total Amount</th>
      <th>Branch</th>
    <th>Date</th>
  </thead>
  <tbody>
  </tbody>
</table>

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
          <h5 class="modal-title" id="exampleModalLabel">ADD ITEM</h5>
          <h1></h1>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addStaff" method="post" enctype="multipart/form-data">
        <div class="row row0-5">
          <?php 

          $CheckServId = "SELECT * FROM `item_tbl` ORDER BY item_code DESC LIMIT 1";
          $reCheckServId = mysqli_query($con, $CheckServId);
          $rowreCheckServId = mysqli_fetch_assoc($reCheckServId);

          $lastItemCode = $rowreCheckServId['item_code'];

          // Extract the numeric portion of the item code
          $numericPart = substr($lastItemCode, 4);
          $numericPart = (int)$numericPart; // Convert to integer

          // Increment the numeric portion
          $numericPart++;

          // Format the incremented numeric part with leading zeros
          $nextItemCode = 'ITM-' . str_pad($numericPart, 5, '0', STR_PAD_LEFT);

   




          ?>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">ITEM CODE</label>
                      <input type="text" class="form-control" name="itmCode" id="classroom_name" required placeholder="" value="<?php echo $nextItemCode ?>"  readonly>
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Item</label>
                      <input type="text" class="form-control" name="ItemName" id="classroom_name" required placeholder="">
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Item Category</label>
                       <select class="form-control" name="ItemCatId">
                      <?php
                      $queryBranch = "SELECT * FROM `item_category_tbl` JOIN branch_tbl ON item_category_tbl.item_category_branch = branch_tbl.branch_id";
                        $resqueryBranch = mysqli_query($con, $queryBranch);

                        while($rowBranch = mysqli_fetch_assoc($resqueryBranch))
                        {
                           
                            ?>
                           
                                <option value="<?php echo $rowBranch['item_category_id'] ?>"><?php echo $rowBranch['item_category_name'].'->'.$rowBranch['branch_name'] ?></option>
                          
                            <?php

                        }
                      ?>
                        </select>
                      
                       
                  </div>
              </div>
                <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Buying Price</label>
                    <input type="number" class="form-control" name="BuyingName" id="" required placeholder="" step="0.01" pattern="[0-9]+(\.[0-9]+)?">

                       
                  </div>
              </div>
               <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Selling Price</label>
                      <input type="number" class="form-control" name="SellingName" id="" required placeholder="" step="0.01" pattern="[0-9]+(\.[0-9]+)?">
                   
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Stock</label>
                     <input type="number" class="form-control" name="StockName" id="classroom_name" required placeholder="">
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Expiration</label>
                     <input type="date" class="form-control" name="ExpirationName" id="classroom_name"  placeholder="">
                       
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

  <div class="modal fade" id="memClassroomModal" role="dialog">
                <div class="modal-dialog modal-l">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Item</h4>
                        </div>
                        <div class="modal-body modalresponseClassroom">
                       
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
    $(document).ready(function(){
      
      $('#tabledataStaff').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'item_sales_fetch.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [4]
          },

        ]
      });
    });
    $('#myFormSale').on('click', '.btnAddSales', function(event) {
  
  var start_date = parseInt($('#start_date').val());
   var end_date = $('#end_date').val();

  $.ajax({
    url: "item_sales_show.php",
    method: "POST",
    data: {
      start_dates: start_date,
      end_dates: end_date
    },
    success: function(data) {
      // Remove the clicked row from the table
      $("#ShowPruchases").html(data);
      
    }
  });
});
   

    $(document).on('submit', '#addStaff', function(e) {
      e.preventDefault();
        var form =$('#addStaff')[0];
        var formdata = new FormData(form);
        $.ajax({
    type: 'POST',
    url:'item_insert.php',
    data: formdata,
    contentType: false,
    processData: false,
   success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
            $('#addStaffModal').modal('hide');
            mytable = $('#tabledataStaff').DataTable();
            mytable.draw();
              swal("Succes", "Item Added", "success");


            }
            else if (status == 'already') {
              
             swal("Error", "Item Already Exist", "error");


            }
            
            
             else if (status == 'false') {
              
              swal("Error", "Item Added Error", "error");
            }
          }
    
  });
         
    });



    $(document).on('click', '.deleteBtnClassroom', function(event) {
      var table = $('#tabledataStaff').DataTable();
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
          url: "item_del.php",
          data: {
            id: id
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              mytable = $('#tabledataStaff').DataTable();
            mytable.draw();
               swal("Succes","Item has been deleted!", {
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



  $('#tabledataStaff').on('click', '.editbtnClassroom', function(event) {
      var table = $('#tabledataStaff').DataTable();
      var trid = $(this).closest('tr').attr('id');
      var id = $(this).data('id');
     

      $.ajax({
        url: "item_editmem.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(response) {
            $('.modalresponseClassroom').html(response); 
            $('#memClassroomModal').modal('show');
        }
      })
    });

    
    
   
    

  </script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
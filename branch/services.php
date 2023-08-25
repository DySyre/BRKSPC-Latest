<?php 
 include 'include/header.php';
 include '../connect.php';

 ?>


 <main class="mt-5 pt-4">
     <div class="row">

        <div class="container" style="margin-left: 220px;">

            <div class="container-fluid">
                  <div class="input-group">
     <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="btn btn-primary btn-sm me-md-2">ADD CATEGORY</a>
                     <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addServicesModal" class="btn btn-primary btn-sm me-md-2">ADD SERVICES</a>
                </div>

                <div class="table-responsive">
                     <table id="tabledataServices" class="table table table-striped" >
                      <thead>
                        <th>ID</th>
                        <th>Category</th>

                        <th>Services</th>
                        <th>Decription</th>    

                        <th>TimeConsume</th>   
                        <th>Price</th>    

                        <th>Action</th>
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
  <div class="modal fade " id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ADD CATEGORY</h5>
          <h1></h1>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addCategory" method="post" enctype="multipart/form-data">
        <div class="row row0-5">
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Category Name</label>
                      <input type="text" class="form-control" name="CatName" id="classroom_name" required placeholder="">
                       
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

   <div class="modal fade " id="addServicesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ADD SERVICES</h5>
          <h1></h1>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addServices" method="post" enctype="multipart/form-data">
        <div class="row row0-5">
              
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Category</label>
                       <select class="form-control" name="catId">
                      <?php
                      $queryCAtegory = "select * from category_tbl where category_isactive = '1'";
                        $resqueryCAtegory = mysqli_query($con, $queryCAtegory);

                        while($rowCAtegory = mysqli_fetch_assoc($resqueryCAtegory))
                        {
                           
                            ?>
                           
                                <option value="<?php echo $rowCAtegory['category_id'] ?>"><?php echo $rowCAtegory['category_name'] ?></option>
                          
                            <?php

                        }
                      ?>
                        </select>
                      
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Services name</label>
                      <input type="text" class="form-control" name="Sname" id="classroom_name" required placeholder="">
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Services description</label>
                      <input type="text" class="form-control" name="Sdes" id="classroom_name" required placeholder="">
                       
                  </div>
              </div>
                <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Services Time Consume</label>
                     <input type="number" class="form-control" name="StimeCons" id="classroom_name" required placeholder="">
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Service Price</label>
                     <input type="number" class="form-control" name="Sprice" id="Sprice" required placeholder="">
                       
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

  <div class="modal fade" id="memServicesModal" role="dialog">
                <div class="modal-dialog modal-l">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Services</h4>
                        </div>
                        <div class="modal-body modalresponseServicesUpdate">
                       
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
    $(document).ready(function() {
      $('#tabledataServices').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'service_fetch.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [6]
          },

        ]
      });
    });
    
   

    $(document).on('submit', '#addCategory', function(e) {
      e.preventDefault();
        var form =$('#addCategory')[0];
        var formdata = new FormData(form);
        $.ajax({
    type: 'POST',
    url:'category_insert.php',
    data: formdata,
    contentType: false,
    processData: false,
   success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
            $('#addCategoryModal').modal('hide');
            mytable = $('#tabledataServices').DataTable();
            mytable.draw();
              swal("Succes", "Category Added", "success");


            }
            else if (status == 'already') {
              
             swal("Error", "Category Already Exist", "error");


            }
            
            
             else if (status == 'false') {
              
              swal("Error", "Category Added Error", "error");
            }
          }
    
  });
         
    });


    $(document).on('submit', '#addServices', function(e) {
      e.preventDefault();
        var form =$('#addServices')[0];
        var formdata = new FormData(form);
        $.ajax({
    type: 'POST',
    url:'services_insert.php',
    data: formdata,
    contentType: false,
    processData: false,
   success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
            $('#addServicesModal').modal('hide');
            mytable = $('#tabledataServices').DataTable();
            mytable.draw();
              swal("Succes", "Services Added", "success");


            }
            else if (status == 'already') {
              
             swal("Error", "Services Already Exist", "error");


            }
            
            
             else if (status == 'false') {
              
              swal("Error", "Services Added Error", "error");
            }
          }
    
  });
         
    });



    $(document).on('click', '.deleteBtnServices', function(event) {
      var table = $('#tabledataServices').DataTable();
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
          url: "services_del.php",
          data: {
            id: id
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              mytable = $('#tabledataServices').DataTable();
            mytable.draw();
               swal("Succes","Services has been deleted!", {
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



  $('#tabledataServices').on('click', '.editbtnSevices', function(event) {
      var table = $('#tabledataServices').DataTable();
      var trid = $(this).closest('tr').attr('id');
      var id = $(this).data('id');
     

      $.ajax({
        url: "services_editmem.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(response) {
            $('.modalresponseServicesUpdate').html(response); 
            $('#memServicesModal').modal('show');
        }
      })
    });

    
    
   
    

  </script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
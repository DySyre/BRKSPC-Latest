<?php 
 include 'include/header.php';
 include '../connect.php';

 ?>


 <main class="mt-5 pt-4">
     <div class="row">

        <div class="container" style="margin-left: 220px;">

            <div class="container-fluid">
                  <div class="input-group">
    
                     <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addStaffModalSched" class="btn btn-primary btn-sm me-md-2">ADD SCHEDULE</a>
                </div>

                <div class="table-responsive">
                     <table id="tabledataSched" class="table table table-striped" >
                      <thead>
                        <th>ID</th>
                        <th>schedule_date</th>
                        <th>Availbility</th>
                        <th>Branch</th>
                            
                         
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
  <div class="modal fade " id="addStaffModalSched" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ADD SCHEDULE</h5>
          <h1></h1>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addSched" method="post" enctype="multipart/form-data">
        <div class="row row0-5">
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Schedule Date</label>
                      <input type="date" class="form-control" name="schedDate" id="classroom_name" required placeholder="">
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Branch</label>
                     

                      <select class="form-control" name="branchId">
           
                      <?php
                      $queryBranch = "select * from branch_tbl where branch_isactive = '1' and branch_id != '3'";
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
                            <h4 class="modal-title">Update Schedule</h4>
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
    $(document).ready(function() {
      $('#tabledataSched').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'schedule_fetch.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [3]
          },

        ]
      });
    });
    
   

    $(document).on('submit', '#addSched', function(e) {
      e.preventDefault();
        var form =$('#addSched')[0];
        var formdata = new FormData(form);
        $.ajax({
    type: 'POST',
    url:'Schedule_insert.php',
    data: formdata,
    contentType: false,
    processData: false,
   success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
            $('#addStaffModalSched ').modal('hide');
            mytable = $('#tabledataSched').DataTable();
            mytable.draw();
              swal("Success", "Schedule Added", "success");


            }
            else if (status == 'already') {
              
             swal("Error", "Schedule Already Exist", "error");


            }
            
            
             else if (status == 'false') {
              
              swal("Error", "Schedule Added Error", "error");
            }
          }
    
  });
         
    });



    $(document).on('click', '.deleteBtnClassroom', function(event) {
      var table = $('#tabledataSched').DataTable();
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
              mytable = $('#tabledataSched').DataTable();
            mytable.draw();
               swal("Success","Schedule has been deleted!", {
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



  $('#tabledataSched').on('click', '.editbtnClassroom', function(event) {
      var table = $('#tabledataSched').DataTable();
      var trid = $(this).closest('tr').attr('id');
      var id = $(this).data('id');
     

      $.ajax({
        url: "schedule_editmem.php",
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
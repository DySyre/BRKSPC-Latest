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
                     <h2>Pending Appointment's</h2>
                </div>

                <div class="table-responsive">
                     <table id="tabledataAppointment" class="table table table-striped" >
                      <thead>
                       
                        <th>Lastname</th>
                        <th>Firstname</th>  
                         <th width="20%">Appointment Date</th>   
                        <th>Status</th>    
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
  <style>
      
          
      .modal-header {
        background-color:gray !important;
        color:#fff !important;
        text-align: center;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-size: 30px;
      }
      h4{
        padding-bottom: 6px;
        text-align: center;
        font-size: 30px;

      }
      .close{
        opacity : 1.0!important;

      }
    </style>

                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <style>
                        /* #view_appointment_form label{
                          margin-top:-5%;
                          } */
                          .modal-body input[type=text]{
                            width:87% ;
                            height:3vh;
                            text-align: center;
                            justify-content: center;
                            align-items: center;
                            border-radius: none;
                            outline:none;
                            box-shadow:none;
                            border:solid thin gray;
                            margin-left: 6%;
                            font-weight:bold;
                          }
                            @media only screen and (max-width: 768px)
                            {#view_appointment_form label,input
                              {
                                display:block;
                                float:right;
                                clear:both;                 
                                margin-left:auto;
                                margin-right: auto}
                        }
                        
           
                      </style>
                        <div class="modal-header">
                            <h4 class="modal-title" style=" color: white; text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;">Appointment Details</h4>
                            <style>
                              /* The Modal (background) */
                              .modal {
                                display: none; /* Hidden by default */
                                position: fixed; /* Stay in place */
                                z-index: 999999999999999999999999;
                                left: 0;
                                top: 0;
                                width: 100%;
                                height: 100vh; /* Full height */
                                overflow: auto; /* Enable scroll if needed */
                                background-color:transparent;/* Fallback color */
                                padding-top: 3rem;
                                border-radius:.2em;
                                box-shadow: inset  0   0     rgba(0,0,0,.1),
                                0         0      rgba(0,0,0,.1);
                                transition: all ease-in-out
                                .3s;
                                margin-left:auto;
                                margin-right:auto;
                                
                              }
                              .table td{
                                font-weight: bolder;
                                background-color:whitesmoke;
                                border:solid thin black;
                                font-size:1rem;
                              }
                            </style>
                        </div>
                        <div class="modal-body modalresponseViewAppointment">
                        <style>
                             table {
                            text-align: center !important;
                            padding:5px;
                            height :6vh ;
                            color:#000 !important;
                            border:solid thin black;
                            vertical-align: middle!important;
                            line-height: normal;
                            text-transform: capitalize;
                            /* padding:5px;*/
                            font-size: 1rem;
                            
                          }
                          th{
                            width: 5%;
                            border:solid thin black;
                            color: green;
                            
                          }
                          td{
                            width: 5%;
                            vertical-align: middle!important;
                            border:solid thin black;
                           

                          }
                          </style>
                       
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
      $('#tabledataAppointment').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'appointment_fetch.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [4]
          },

        ]
      });
    });
    
   

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
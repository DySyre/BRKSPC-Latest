<?php 
 include 'include/header.php';
 include '../connect.php';
if (isset($_GET['id'])) {
  $pet_id = $_GET['id'];
  // Now you can use $id as needed in your PHP code
  // For example, display it on the page:

    $sqlPetOwner = "SELECT * FROM `pets` WHERE id = '$pet_id'";

$totalsqlPetOwner = mysqli_query($con,$sqlPetOwner);
$rowtotalsqlPetOwner = mysqli_fetch_assoc($totalsqlPetOwner);
$id = $rowtotalsqlPetOwner['pet_user_id'];
$petName = $rowtotalsqlPetOwner['pet_name'];

$sumRem = 0;
?>
 <main class="mt-5 pt-4">
     <div class="row">

        <div class="container" style="margin-left: 220px;">

            <div class="container-fluid">
                  <div class="input-group">
    
                     <a href="patient_pet.php"  class="btn btn-secondary btn-sm me-md-2" >Back</a>
                        
                </div>

                <div class="">
                    <h3>Pet <span style="color: royalblue; "><?php echo $petName?> </span> Information</h3>
                    <div class="row">
                    
                        
                        <div class="col-md-4">
                             
                             <hr>
                             <h4 style="color:#30406D;">Owner</h4>
                    <?php 
                    $sql = "SELECT * FROM `users_balagtas` WHERE id = '$id'";

                    $totalQuery = mysqli_query($con,$sql);

                    while($row = mysqli_fetch_assoc($totalQuery))
                    {
                        ?>
                        <label style="font-weight: bold;">Last Name: </label><span> <?php   echo $row['last_name']; ?></span>  <br>
                        <label style="font-weight: bold;">First Name: </label><span> <?php   echo $row['user_name']; ?></span> <br>
                         <label style="font-weight: bold;">Email: </label><span> <?php   echo $row['email']; ?></span>  <br>


                        <?php

                       $custId =  $row['id'];

                      $namelast =  $row['last_name'];
                      $namefirst =  $row['user_name'];
                    }




                    ?>
                     </div>
                     <div class="col-md-6">
                              <div class="table-responsive">
                                  <style>
                              .responsive-th {
                                white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis;
                              }
                            </style>

                               <form id="MyForm">   
                                <hr>
                                <h4 style="color:#30406D;">Appointment History</h4>
                                <table class="table">

                                    <thead>
                                        <th class="responsive-th">Date</th>
                                        <th class="responsive-th"></th>
                                    </thead>
                                    <tbody>
                                     <?php 
                                $sql1 = "SELECT * FROM `pet_services_tbl` WHERE pet_name_id = '$pet_id'";

                                $totalQuery1 = mysqli_query($con,$sql1);

                                while($row1 = mysqli_fetch_assoc($totalQuery1))
                                {
                                    $appoitHist =  $row1['pet_service_cat'];

                                    $sqlHis = "SELECT * FROM `appointment_tbl` join schedule_tbl on appointment_tbl.appointment_date = schedule_tbl.schedule_id WHERE appointment_payment_same = '$appoitHist'";

                                    $totasqlHis = mysqli_query($con,$sqlHis);

                                    while($rowtotasqlHis = mysqli_fetch_assoc($totasqlHis))
                                    {
                                    ?>

                                        <tr>
                                         
                                          <td><?php echo  $rowtotasqlHis['schedule_date']; ?></td>
                                                                                      
                                          <td><a href="javascript:void();" data-id="<?php echo $rowtotasqlHis['appointment_payment_id'] ?>"  class="btn btn-sm btnViewAppotnment text-white"style="border: none; background-color: green;">View</a></td>
                                          </tr>
                                       

                                        <?php
                                    }
                                    




                                }


                                ?>
                                    
                                    </tbody>
                                </table>
                               </div> 
                     </div>
                    </div>
                    </form>  
                    <!-- billing history -->
                   
                    <div class="row" id="printableContent" style="display:;">
                    
                       <form id="MyForm1">   
                        <div class="col-md-10 mt-5">
                           <h4 class="sevicesRecord">Services Record</h4>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-striped" id="billTAble">
                                    <thead>
                                        <th class="responsive-th">Date</th>
                                        <th class="responsive-th">Category</th>
                                        <th class="responsive-th">Services</th>
                                        <th class="responsive-th">Comment</th>
                                        <th class="responsive-th"></th>
                                    </thead>
                                    <tbody>
                                    <?php 
                                $sql12 = "SELECT * FROM `pet_services_tbl` WHERE pet_name_id = '$pet_id'";

                                $totalQuery12 = mysqli_query($con,$sql12);

                                while($row12 = mysqli_fetch_assoc($totalQuery12))
                                {
                                    $appoitHist12 =  $row12['pet_service_cat'];

                                    $sqlHis1 = "SELECT * FROM `pet_services_his_tbl` join services_tbl on pet_services_his_tbl.pet_services_his_name = services_tbl.services_id join category_tbl on services_tbl.category_idfk = category_tbl.category_id join appointment_tbl on pet_services_his_tbl.pet_services_his_sameappoint = appointment_tbl.appointment_payment_same join schedule_tbl on appointment_tbl.appointment_date = schedule_tbl.schedule_id join pet_services_tbl on pet_services_his_tbl.pet_services_his_servidfk = pet_services_tbl.pet_services_id  WHERE pet_services_his_sameappoint = '$appoitHist12' and pet_name_id = '$pet_id' ";

                                    $totasqlHis1 = mysqli_query($con,$sqlHis1);

                                    while($rowtotasqlHis1 = mysqli_fetch_assoc($totasqlHis1))
                                    {
                                      
                                    ?>

                                            <tr>
                                          <td><?php echo $rowtotasqlHis1['schedule_date'] ?></td>

                                          <td><?php echo $rowtotasqlHis1['category_name'] ?></td>

                                         
                                          <td><?php echo $rowtotasqlHis1['services_name'] ?></td>
                                          <td><?php echo $rowtotasqlHis1['history_coment'] ?></td>
                                                                                      
                                          <td><a href="javascript:void();" data-id="<?php echo $rowtotasqlHis1['pet_services_his_id'] ?>"  class="btn btn-sm btnRegisPayComment text-white"style="border: none; background-color: brown;">Comment</a></td>
                                          </tr>
                                       

                                        <?php
                                    }
                                    




                                }


                                ?>


                                
                                    
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </form>
                    
                    </div>
                     <div class="input-group">
    
                      <button onclick="togglePrintableContent()" style="float: right; margin-right: 10px;"  class="btn btn-print no-print btn-primary"><i class="fa fa-print"></i>Print</button>
                </div>

                </div>
               

                
            </div>
            
        </div>
         
     </div>              
</main>
<!-- modal -->

 <!-- Add user Modal -->
  <div class="modal fade" id="memViewAppointmentModal1" role="dialog">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Details</h4>
                        </div>
                        <div class="modal-body modalresponseViewAppointment1">
                       
                        </div>
                    </div>
                </div>
        </div>

        <div class="modal fade" id="memViewAppointmentModal12" role="dialog">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Details</h4>
                        </div>
                        <div class="modal-body modalresponseViewAppointment12">
                       
                        </div>
                    </div>
                </div>
        </div>

  
<!-- modal -->

<div class="modal fade" id="RegisPayModal1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-l">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Comment</h4>
                        </div>
                        <div class="modal-body modalresponseRegisPay1">
                       
                        </div>
                    </div>
                </div>
        </div>

  


?>

  <!-- <script src="./js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>
    <script src="../js/script.js"></script>

    <script type="text/javascript">
     $(document).ready(function() {
      $('#mytabledataAppointment').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'patient_customer_fetch.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [3]
          },

        ]
      });
    });

$('#MyForm1').on('click', '.btnRegisPayComment', function(event) {
     
     
      var idx = $(this).data('id');
     

      $.ajax({
        url: "patient_pet_commenteditmem.php",
        data: {
          idx: idx
        },
        type: 'post',
        success: function(response) {
            $('.modalresponseRegisPay1').html(response); 
            $('#RegisPayModal1').modal('show');
        }
      })
    });


$('#MyForm').on('click', '.btnRegisPayView', function(event) {
     
     
      var idx = $(this).data('id');
     

      $.ajax({
        url: "patient_customer_info_editmem.php",
        data: {
          id: idx
        },
        type: 'post',
        success: function(response) {
            $('.modalresponseViewAppointment1').html(response); 
            $('#memViewAppointmentModal1').modal('show');
        }
      })
    });
$('#MyForm').on('click', '.btnViewAppotnment', function(event) {
     
     
      var idx = $(this).data('id');
     

      $.ajax({
        url: "patient_pet_info_viewappoint_editmem.php",
        data: {
          id: idx
        },
        type: 'post',
        success: function(response) {
            $('.modalresponseViewAppointment12').html(response); 
            $('#memViewAppointmentModal12').modal('show');
        }
      })
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

const fontSizeSelect = document.getElementById('font-size-select');
  const table = document.getElementById('billTAble');

  fontSizeSelect.addEventListener('change', () => {
    table.style.fontSize = fontSizeSelect.value;
  });
    function togglePrintableContent() {

    var printableContent = document.getElementById("printableContent");
    var printContents = printableContent.innerHTML;
    var printContentsWithoutButtons = $(printContents).find(".btnRegisPayView").remove().end().prop('outerHTML');
    var printContentsWithoutButtons1 = $(printContentsWithoutButtons).find(".btnRegisPay").remove().end().prop('outerHTML');
    var printContentsWithoutButtons2 = $(printContentsWithoutButtons1).find(".sevicesRecord").remove().end().prop('outerHTML');
    var printContentsWithoutButtons3 = $(printContentsWithoutButtons2).find(".btnRegisPayComment").remove().end().prop('outerHTML');

    

    var originalContents = document.body.innerHTML;
    var popupWin = window.open('', '_blank', 'width=800,height=600');
    popupWin.document.open();
    popupWin.document.write('<html><head><title></title><style type="text/css">\
        th {\
        text-align: left;\
        }\
        @media print {\
        table {\
            width: 100%;\
            border-collapse: collapse;\
        }\
        th, td {\
            word-break: break-all;\
            word-wrap: break-word;\
        }\
        }\
        </style></head><br><br><center><h3>Barkspace Pet Grooming And Wellness Center</h3><h4>Pet Record SUMMARY</h4></center><body><?php echo 'Fullname: '.$namelast.' '.$namefirst  ?><br> <?php echo 'Petname: '.$petName  ?>'  +   printContentsWithoutButtons3 + '</body></html>');
    popupWin.document.close();
    popupWin.focus();
    popupWin.print();
    popupWin.close();
    return false;
}

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



 




    
    
   
      window.location.href = 'patient_customer_info.php?id=' + id;
   
  </script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <?php
}
else
{
    
?>
  <script>
    window.location.href = 'patient_customer.php';
   
  </script>

<?php
}

<?php 
 include 'include/header.php';
 include '../connect.php';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  // Now you can use $id as needed in your PHP code
  // For example, display it on the page:

$sumRem = 0;
?>
 <main class="mt-5 pt-4">
     <div class="row">

        <div class="container" style="margin-left: 220px;">

            <div class="container-fluid">
                  <div class="input-group">
    
                     <a href="patient_customer.php"  class="btn btn-secondary btn-sm me-md-2" >Back</a>
                        
                </div>

                <div class="">
                    <div class="row">
                        
                        <div class="col-md-4">
                             <h4>Customer Information</h4>
                             <hr>
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

                                <h4>Pet's</h4>
                                <hr>
                                <table class="table">
                                    <thead>
                                        <th class="responsive-th">Name</th>
                                        <th class="responsive-th">Type</th>
                                    </thead>
                                    <tbody>
                                     <?php 
                                $sql1 = "SELECT * FROM `pets` WHERE pet_user_id = '$custId'";

                                $totalQuery1 = mysqli_query($con,$sql1);

                                while($row1 = mysqli_fetch_assoc($totalQuery1))
                                {
                                   
                                    ?>
                                    <tr>
                                            <td><?php echo  $row1['pet_name']; ?></td>
                                            
                                          <td><?php echo  $row1['pet_type']; ?></td>
                                          </tr>
                                       

                                    <?php




                                }


                                ?>
                                    
                                    </tbody>
                                </table>
                               </div> 
                     </div>
                    </div>
                    <!-- billing history -->
                     <h4>Billing History</h4>
                    <div class="row" id="printableContent">
                    <form id="MyForm">
                       
                        <div class="col-md-10 mt-5">
                           
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-striped" id="billTAble">
                                    <thead>
                                        <th class="responsive-th">Date</th>
                                        <th class="responsive-th">Status</th>
                                        <th class="responsive-th">Payable</th>
                                        <th class="responsive-th">Remaining</th>
                                        <th class="responsive-th"></th>
                                    </thead>
                                    <tbody>
                                     <?php 
                                $sql2 = "SELECT * FROM `appointment_tbl` WHERE pet_ownerid = '$custId' and appointment_payment_status = 'completed'";

                                $totalQuery2 = mysqli_query($con,$sql2);

                                while($row2 = mysqli_fetch_assoc($totalQuery2))
                                {
                                    $appointId =  $row2['appointment_payment_id'];

                                    $sql3 = "SELECT * FROM `appointment_bill_tbl` WHERE appointment_idfk = '$appointId'";

                                    $totalQuery3 = mysqli_query($con,$sql3);
                                    while($row3 = mysqli_fetch_assoc($totalQuery3))
                                    {

                                        $appointment_bill_total = $row3['appointment_bill_total'];
                                        $appointment_bill_payment = $row3['appointment_bill_payment'];

                                        if($appointment_bill_payment < $appointment_bill_total)
                                        {
                                            // may balance
                                            $sumRem = $appointment_bill_total - $appointment_bill_payment;


                                            ?>

                                            <tr>
                                             <td><?php echo  $row3['appointment_bill_dor']; ?></td>
                                             <td>Partially Paid</td>

                                            
                                             <td><?php echo  $row3['appointment_bill_total']; ?></td>
                                             <td><?php echo  number_format($sumRem,2) ?></td>
                                             <td> <a href="javascript:void();" data-id="<?php echo $appointId ?>"  class="btn btn-sm btnRegisPayView text-white"style="border: none; background-color: green;">View</a> <a href="javascript:void();" data-id="<?php echo $appointId ?>"  class="btn btn-sm btnRegisPayComment text-white"style="border: none; background-color: brown;">Comment</a> <a href="javascript:void();" data-id="<?php echo $row3['appointment_bill_id'] ?>"  class="btn btn-sm btnRegisPay text-white"style="border: none; background-color: #0159DE;">Pay
                                             </a> </td>

                                            </tr>
                                       

                                            <?php
                                        }
                                        else
                                        {
                                            // walng balance

                                            ?>
                                            <tr>
                                             <td><?php echo  $row3['appointment_bill_dor']; ?></td>
                                             <td>Fully Paid</td>

                                            
                                             <td><?php echo  $row3['appointment_bill_total']; ?></td>
                                             <td>0.00</td>
                                             <td> <a href="javascript:void();" data-id="<?php echo $appointId ?>"  class="btn btn-sm btnRegisPayView text-white"style="border: none; background-color: green;">View</a> <a href="javascript:void();" data-id="<?php echo $appointId ?>"  class="btn btn-sm btnRegisPayComment text-white"style="border: none; background-color: brown;">Comment</a></td>
                                            </tr>
                                       

                                            <?php
                                        }





                                         

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
                            <h4 class="modal-title" style=" color: white; text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;">Details</h4>
                        </div>
                        <div class="modal-body modalresponseViewAppointment1">
                       
                        </div>
                    </div>
                </div>
        </div>
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
  
<!-- modal -->

<div class="modal fade" id="RegisPayModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-l">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Payment</h4>
                        </div>
                        <div class="modal-body modalresponseRegisPay">
                       
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

$('#MyForm').on('click', '.btnRegisPay', function(event) {
     
     
      var idx = $(this).data('id');
     

      $.ajax({
        url: "patient_customer_payremaining.php",
        data: {
          idx: idx
        },
        type: 'post',
        success: function(response) {
            $('.modalresponseRegisPay').html(response); 
            $('#RegisPayModal').modal('show');
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
$('#MyForm').on('click', '.btnRegisPayComment', function(event) {
     
     
      var idx = $(this).data('id');
     

      $.ajax({
        url: "patient_customer_commenteditmem.php",
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

    var printContentsWithoutButtons2 = $(printContentsWithoutButtons1).find(".btnRegisPayComment").remove().end().prop('outerHTML');

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
        </style></head><br><br><center><h3>Barkspace Pet Grooming And Wellness Center</h3><h4>Billing SUMMARY</h4></center><body><?php echo 'Fullname: '.$namelast.' '.$namefirst  ?>' + printContentsWithoutButtons2 + '</body></html>');
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
